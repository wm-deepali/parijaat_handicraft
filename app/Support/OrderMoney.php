<?php

namespace App\Support;

use App\Models\Currency;
use App\Models\Order;

class OrderMoney
{
    /** [symbol, decimals] for a currency code; falls back to the default currency. */
    private static function meta(?string $code): array
    {
        $cur = $code ? Currency::where('code', $code)->first() : null;

        if (!$cur) {
            $region = app(Region::class);

            return [$region->defaultSymbol(), $region->defaultDecimals()];
        }

        return [(string) ($cur->symbol ?: $cur->code), (int) ($cur->decimals ?? 2)];
    }

    private static function space(string $symbol): string
    {
        return ($symbol !== '' && ctype_alpha(str_replace(' ', '', $symbol))) ? ' ' : '';
    }

    /**
     * Formats a stored (default-currency) amount in the currency the customer paid in.
     * Same ratio as the order snapshot: total_customer / total_default.
     */
    public static function formatter(Order $order): \Closure
    {
        $hasSnap = $order->currency_code && $order->total_customer !== null;

        [$symbol, $decimals] = self::meta($order->currency_code ?: $order->default_currency_code);
        $space = self::space($symbol);

        $factor = ($hasSnap && (float) $order->total_default > 0)
            ? (float) $order->total_customer / (float) $order->total_default
            : 1.0;

        return fn($v) => $symbol . $space . number_format((float) $v * $factor, $decimals);
    }

    /** The exact amount the customer paid / will pay. */
    public static function total(Order $order): string
    {
        if (!($order->currency_code && $order->total_customer !== null)) {
            return self::formatter($order)($order->grand_total);
        }

        [$symbol, $decimals] = self::meta($order->currency_code);

        return $symbol . self::space($symbol) . number_format((float) $order->total_customer, $decimals);
    }

    /** An amount exactly as stored (default currency of the order's day): for admin-facing text. */
    public static function stored(Order $order, $amount): string
    {
        [$symbol, $decimals] = self::meta($order->default_currency_code);

        return $symbol . self::space($symbol) . number_format((float) $amount, $decimals);
    }
}