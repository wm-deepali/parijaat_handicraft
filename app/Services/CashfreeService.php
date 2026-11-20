<?php

namespace App\Services;

use App\Models\Order;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CashfreeService
{
    /**
     * true  = charge in the customer's currency (needs international payments enabled on the Cashfree account)
     * false = always charge the INR value (orders.total_inr)
     */
    public const CHARGE_IN_CUSTOMER_CURRENCY = true;

    private const API_VERSION = '2025-01-01';

    private bool $live;
    private string $appId;
    private string $secret;

    public function __construct()
    {
        $s = PaymentSetting::first();

        $this->live   = (bool) ($s?->live_mode ?? false);
        $this->appId  = (string) ($this->live ? $s?->cf_live_app_id : $s?->cf_test_app_id);
        $this->secret = (string) ($this->live ? $s?->cf_live_secret : $s?->cf_test_secret);
    }

    /** Value for the JS SDK: sandbox | production */
    public function mode(): string
    {
        return $this->live ? 'production' : 'sandbox';
    }

    private function baseUrl(): string
    {
        return $this->live ? 'https://api.cashfree.com/pg' : 'https://sandbox.cashfree.com/pg';
    }

    private function client()
    {
        if ($this->appId === '' || $this->secret === '') {
            throw new \RuntimeException('Cashfree keys are not configured.');
        }

        return Http::withHeaders([
            'x-client-id'     => $this->appId,
            'x-client-secret' => $this->secret,
            'x-api-version'   => self::API_VERSION,
        ])->acceptJson()->asJson()->timeout(20);
    }

    /** [currency, amount] this order must be paid in. Used at order creation AND at verification. */
    public function expectedCharge(Order $order): array
    {
        if (self::CHARGE_IN_CUSTOMER_CURRENCY) {
            return [
                strtoupper($order->currency_code ?: 'INR'),
                round((float) ($order->total_customer ?? $order->grand_total), 2),
            ];
        }

        return ['INR', round((float) ($order->total_inr ?? $order->grand_total), 2)];
    }

    /** Creates the Cashfree order (order_id = our order_number). Returns the API response. */
    public function createOrder(Order $order): array
    {
        [$currency, $amount] = $this->expectedCharge($order);

        $phone = substr(preg_replace('/\D+/', '', (string) $order->customer_phone), -10);
        if (strlen($phone) < 10) {
            $phone = '9999999999';
        }

        $payload = [
            'order_id'         => $order->order_number,
            'order_amount'     => $amount,
            'order_currency'   => $currency,
            'customer_details' => [
                'customer_id'    => 'cust_' . $order->customer_id,
                'customer_name'  => Str::limit((string) $order->customer_name, 90, ''),
                'customer_email' => $order->customer_email,
                'customer_phone' => $phone,
            ],
            'order_note'       => 'Order ' . $order->order_number,
        ];

        // Cashfree only accepts https URLs here (skipped automatically on a local http site)
        $meta   = [];
        $return = route('checkout.cashfree.return') . '?order_id={order_id}';
        $notify = route('cashfree.webhook');

        if (str_starts_with($return, 'https://')) {
            $meta['return_url'] = $return;
        }
        if (str_starts_with($notify, 'https://')) {
            $meta['notify_url'] = $notify;
        }
        if ($meta) {
            $payload['order_meta'] = $meta;
        }

        $res = $this->client()->post($this->baseUrl() . '/orders', $payload);

        if (!$res->successful() || !$res->json('payment_session_id')) {
            throw new \RuntimeException('Cashfree create order failed: ' . ($res->json('message') ?: $res->status()));
        }

        return $res->json();
    }

    /** Cashfree's view of the order ([] if Cashfree does not know it). */
    public function fetchOrder(string $orderId): array
    {
        $res = $this->client()->get($this->baseUrl() . '/orders/' . urlencode($orderId));

        if ($res->status() === 404) {
            return [];
        }
        if (!$res->successful()) {
            throw new \RuntimeException('Cashfree fetch order failed: ' . ($res->json('message') ?: $res->status()));
        }

        return $res->json() ?: [];
    }

    private function fetchPayments(string $orderId): array
    {
        $res = $this->client()->get($this->baseUrl() . '/orders/' . urlencode($orderId) . '/payments');

        return $res->successful() ? ($res->json() ?: []) : [];
    }

    /**
     * Asks Cashfree whether this order is really paid (and for the right amount/currency).
     * Returns the Cashfree payment id when paid, otherwise null.
     */
    public function confirmPaid(Order $order): ?string
    {
        $data = $this->fetchOrder($order->order_number);

        if (($data['order_status'] ?? '') !== 'PAID') {
            return null;
        }

        [$currency, $amount] = $this->expectedCharge($order);

        if (
            strtoupper((string) ($data['order_currency'] ?? '')) !== $currency
            || abs((float) ($data['order_amount'] ?? 0) - $amount) > 0.01
        ) {
            Log::warning('Cashfree amount/currency mismatch', [
                'order' => $order->order_number,
                'expected' => [$currency, $amount],
                'got' => [$data['order_currency'] ?? null, $data['order_amount'] ?? null],
            ]);

            return null;
        }

        foreach ($this->fetchPayments($order->order_number) as $p) {
            if (($p['payment_status'] ?? '') === 'SUCCESS') {
                return (string) ($p['cf_payment_id'] ?? $data['cf_order_id'] ?? $order->order_number);
            }
        }

        return (string) ($data['cf_order_id'] ?? $order->order_number);
    }

    /** Webhook signature: base64(HMAC-SHA256(timestamp . rawBody, secretKey)) */
    public function verifySignature(string $rawBody, ?string $timestamp, ?string $signature): bool
    {
        if ($this->secret === '' || !$timestamp || !$signature) {
            return false;
        }

        $computed = base64_encode(hash_hmac('sha256', $timestamp . $rawBody, $this->secret, true));

        return hash_equals($computed, $signature);
    }
}