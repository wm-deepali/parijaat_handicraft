<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Order;
use App\Models\Country;
use App\Support\Region;

trait InvoiceHelpers
{
    /** Symbol of the current default currency */
    private function defaultSymbol($currencies): string
    {
        $code = app(Region::class)->default()?->currency_code;
        $cur = $code ? ($currencies[$code] ?? null) : null;

        return (string) ($cur?->symbol ?: $code ?: '₹');
    }

    /** Symbol of the currency this order's amounts were stored in (default currency on the order's day) */
    private function orderSymbol(Order $order, $currencies): string
    {
        $code = $order->default_currency_code;
        $cur = $code ? ($currencies[$code] ?? null) : null;

        return $cur ? (string) ($cur->symbol ?: $cur->code) : $this->defaultSymbol($currencies);
    }

    private function plainNumber($n, int $dec = 6): string
    {
        return rtrim(rtrim(number_format((float) $n, $dec, '.', ''), '0'), '.');
    }

    /**
     * "International Order" block: what the customer paid, rate, extra %, default-currency total, INR, tax.
     * Null = old order (no snapshot) or a simple India order.
     */
    private function regionInfo(Order $order, $currencies): ?array
    {
        if (!$order->currency_code || $order->total_customer === null) {
            return null;
        }

        $defCode = $order->default_currency_code ?: app(Region::class)->default()?->currency_code;
        $same = $defCode === $order->currency_code;
        $adj = (float) $order->price_adjustment_percent;

        if ($same && $adj <= 0 && in_array($order->tax_handling, [null, 'india_gst'], true)) {
            return null;
        }

        $cust = $currencies[$order->currency_code] ?? null;
        $def = $defCode ? ($currencies[$defCode] ?? null) : null;
        $inr = $currencies['INR'] ?? null;

        $custDec = (int) ($cust->decimals ?? 2);
        $defDec = (int) ($def->decimals ?? 2);

        return [
            'country' => Country::where('iso2', $order->country_code)->value('name') ?? $order->country_code,
            'customer_currency' => $order->currency_code,
            'customer_symbol' => $cust?->symbol ?: $order->currency_code,
            'customer_total' => number_format((float) $order->total_customer, $custDec),

            'default_currency' => $defCode,
            'default_symbol' => $def?->symbol ?: $defCode,
            'list_total' => number_format((float) $order->total_default, $defDec),
            'default_total' => number_format((float) $order->total_default + (float) $order->price_adjustment_amount, $defDec),

            'has_adjustment' => $adj > 0,
            'adjustment_percent' => $this->plainNumber($adj, 2),
            'adjustment_amount' => number_format((float) $order->price_adjustment_amount, $defDec),

            'same_currency' => $same,
            'rate' => ($same || !$order->exchange_rate)
                ? null
                : '1 ' . $defCode . ' = ' . $this->plainNumber($order->exchange_rate) . ' ' . $order->currency_code,

            'inr_symbol' => $inr?->symbol ?: '₹',
            'inr_total' => $order->total_inr !== null ? number_format((float) $order->total_inr, 2) : null,
            'inr_rate' => ($order->inr_rate && $defCode !== 'INR')
                ? '1 ' . $defCode . ' = ' . $this->plainNumber($order->inr_rate) . ' INR'
                : null,

            'tax_label' => match ($order->tax_handling) {
                'export' => 'Export (no tax)',
                'destination_vat' => 'Destination VAT',
                default => 'India GST',
            },
            'tax_amount' => (float) $order->tax_amount,
        ];
    }
}