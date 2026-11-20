<?php

namespace App\Support;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Support\Collection;

class Region
{
    private ?Collection $options = null;
    private ?Country $current = null;
    private ?Country $default = null;

    public function default(): ?Country
    {
        return $this->default ??= Country::where('is_default', true)->with('currency')->first();
    }

    /** Customer jo countries chun sakta hai: enabled + exchange rate maujood (default hamesha). */
    public function options(): Collection
    {
        if ($this->options) {
            return $this->options;
        }

        $defaultRate = (float) ($this->default()?->currency?->usd_rate ?? 0);

        return $this->options = Country::enabled()->with('currency')
            ->orderByDesc('is_default')->orderBy('name')->get()
            ->filter(fn($c) => $c->is_default
                || ($defaultRate > 0 && (float) ($c->currency?->usd_rate ?? 0) > 0))
            ->values();
    }

    /** Cookie se country, warna default country. */
    public function current(): ?Country
    {
        if ($this->current) {
            return $this->current;
        }

        $iso = strtoupper((string) request()->cookie('country'));

        return $this->current = $this->options()->firstWhere('iso2', $iso)
            ?? $this->options()->firstWhere('is_default', true)
            ?? $this->default();
    }

    /** Sirf exchange rate: 1 default currency = ? customer currency (Extra % ke bina). */
    public function fxRate(): float
    {
        $cur = $this->current();
        $def = $this->default();

        if (!$cur || !$def || $cur->currency_code === $def->currency_code) {
            return 1.0;
        }

        $from = (float) ($def->currency?->usd_rate ?? 0);
        $to = (float) ($cur->currency?->usd_rate ?? 0);

        return ($from > 0 && $to > 0) ? $to / $from : 1.0;
    }

    /** Default currency -> customer currency ka multiplier (Extra % + exchange rate), bina round kiye. */
    public function factor(): float
    {
        $cur = $this->current();

        if (!$cur || !$this->default()) {
            return 1.0;
        }

        return (1 + ((float) $cur->price_adjustment / 100)) * $this->fxRate();
    }

    /** Default currency ka amount -> customer ki currency me. */
    public function convert($amount): float
    {
        return round((float) $amount * $this->factor(), $this->decimals());
    }

    /** Customer currency amount -> default currency (inverse of convert, unrounded). */
    public function toBase($amount): float
    {
        $f = $this->factor();

        return $f > 0 ? (float) $amount / $f : (float) $amount;
    }

    public function format($amount = null, bool $convert = true): string
    {
        if ($amount === null || $amount === '') {
            return '';
        }

        $value = $convert ? $this->convert($amount) : (float) $amount;

        return $this->symbol() . ($this->symbolNeedsSpace() ? ' ' : '') . number_format($value, $this->decimals());
    }

    public function symbol(): string
    {
        $currency = $this->current()?->currency;

        return (string) ($currency?->symbol ?: $currency?->code ?? Setting::first()?->currency_symbol ?? '');
    }

    /** "AED" jaisa letters wala symbol ho to number se pehle space. */
    public function symbolNeedsSpace(): bool
    {
        $symbol = $this->symbol();

        return $symbol !== '' && ctype_alpha(str_replace(' ', '', $symbol));
    }

    public function decimals(): int
    {
        return (int) ($this->current()?->currency?->decimals ?? 2);
    }

    /** Symbol of the store's DEFAULT currency (admin side; ignores the visitor's country). */
    public function defaultSymbol(): string
    {
        $currency = $this->default()?->currency;

        return (string) ($currency?->symbol ?: $currency?->code ?? Setting::first()?->currency_symbol ?? '');
    }

    public function defaultDecimals(): int
    {
        return (int) ($this->default()?->currency?->decimals ?? 2);
    }

    public function defaultCode(): string
    {
        return (string) ($this->default()?->currency_code ?? '');
    }

    /** Plain number in the default currency, no symbol (for Excel/CSV cells): "3,450.00" */
    public function numberDefault($amount): string
    {
        return number_format((float) $amount, $this->defaultDecimals());
    }

    /** Amount already in the default currency, shown as-is: "$120.00" / "AED 440.70" */
    public function formatDefault($amount = null): string
    {
        if ($amount === null || $amount === '') {
            return '';
        }

        $symbol = $this->defaultSymbol();
        $space = ($symbol !== '' && ctype_alpha(str_replace(' ', '', $symbol))) ? ' ' : '';

        return $symbol . $space . number_format((float) $amount, $this->defaultDecimals());
    }


    /** Detail page ki JS ke liye. */
    public function js(): array
    {
        return [
            'factor' => $this->factor(),
            'symbol' => $this->symbol(),
            'space' => $this->symbolNeedsSpace(),
            'decimals' => $this->decimals(),
        ];
    }

    /**
     * Order lagte hi freeze hone wali values. $defaultTotal = default currency me grand total.
     * Khali array = country ya default country set nahi (freeze skip).
     */
    public function snapshot(float $defaultTotal): array
    {
        $cur = $this->current();
        $def = $this->default();

        if (!$cur || !$def) {
            return [];
        }

        $adj = (float) $cur->price_adjustment;
        $adjAmount = round($defaultTotal * $adj / 100, 3);
        $fx = $this->fxRate();

        // 1 default currency = ? INR (us din ke rate par)
        $inrPerDefault = null;
        if ($def->currency_code === 'INR') {
            $inrPerDefault = 1.0;
        } else {
            $inr = Currency::where('code', 'INR')->first();
            $defRate = (float) ($def->currency?->usd_rate ?? 0);

            if ($inr && (float) $inr->usd_rate > 0 && $defRate > 0) {
                $inrPerDefault = (float) $inr->usd_rate / $defRate;
            }
        }

        return [
            'country_code' => $cur->iso2,
            'currency_code' => $cur->currency_code,
            'default_currency_code' => $def->currency_code,
            'exchange_rate' => $fx,
            'price_adjustment_percent' => $adj,
            'price_adjustment_amount' => $adjAmount,
            'tax_handling' => $cur->tax_handling,
            'total_default' => round($defaultTotal, 3),
            'total_customer' => round(($defaultTotal + $adjAmount) * $fx, $this->decimals()),
            'inr_rate' => $inrPerDefault,
            'total_inr' => $inrPerDefault ? round(($defaultTotal + $adjAmount) * $inrPerDefault, 2) : null,
        ];
    }
}