<?php

namespace App\Support;

use App\Models\Country;
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

    /** Default currency -> customer currency ka multiplier (Extra % + exchange rate), bina round kiye. */
    public function factor(): float
    {
        $cur = $this->current();
        $def = $this->default();

        if (!$cur || !$def) {
            return 1.0;
        }

        $factor = 1 + ((float) $cur->price_adjustment / 100);

        if ($cur->currency_code !== $def->currency_code) {
            $from = (float) ($def->currency?->usd_rate ?? 0);
            $to = (float) ($cur->currency?->usd_rate ?? 0);

            if ($from > 0 && $to > 0) {
                $factor *= $to / $from;
            }
        }

        return $factor;
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

    /** "₹1,299.00", "$120.00" ya "AED 440.70" */
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
}