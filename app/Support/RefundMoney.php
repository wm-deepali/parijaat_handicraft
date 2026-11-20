<?php

namespace App\Support;

use App\Models\Currency;
use App\Models\Order;

class RefundMoney
{
    /** Default currency amount -> customer currency, order ke frozen rate (aur extra %) se. */
    public static function customerAmount(Order $order, float $amountDefault): ?float
    {
        if (!$order->currency_code || $order->total_customer === null || (float) $order->total_default <= 0) {
            return null;
        }

        $ratio = (float) $order->total_customer / (float) $order->total_default;
        $dec = (int) (Currency::where('code', $order->currency_code)->value('decimals') ?? 2);

        return round($amountDefault * $ratio, $dec);
    }

    /** refund_transactions ke naye columns. Khali array = purana order (snapshot nahi). */
    public static function columns(Order $order, float $amountDefault): array
    {
        $amount = self::customerAmount($order, $amountDefault);

        return $amount === null
            ? []
            : ['currency_code' => $order->currency_code, 'amount_customer' => $amount];
    }

    public static function label(Order $order, float $amountDefault): string
    {
        $amount = self::customerAmount($order, $amountDefault);

        $code = $amount !== null
            ? $order->currency_code
            : ($order->default_currency_code ?: app(Region::class)->default()?->currency_code);

        $cur = $code ? Currency::where('code', $code)->first() : null;
        $symbol = (string) ($cur?->symbol ?: $code ?: '₹');
        $space = ctype_alpha(str_replace(' ', '', $symbol)) ? ' ' : '';

        return $symbol . $space . number_format($amount ?? $amountDefault, (int) ($cur->decimals ?? 2));
    }
}