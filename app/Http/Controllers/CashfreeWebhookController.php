<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CashfreeService;
use App\Traits\FinalizesOrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CashfreeWebhookController extends Controller
{
    use FinalizesOrderPayment;

    public function handle(Request $request, CashfreeService $cf)
    {
        $raw = $request->getContent();

        if (!$cf->verifySignature($raw, $request->header('x-webhook-timestamp'), $request->header('x-webhook-signature'))) {
            Log::warning('Cashfree webhook: invalid signature');
            return response()->json(['status' => 'invalid signature'], 400);
        }

        $payload = json_decode($raw, true) ?: [];

        if (($payload['type'] ?? '') !== 'PAYMENT_SUCCESS_WEBHOOK') {
            return response()->json(['status' => 'ignored']);
        }

        $orderNo = $payload['data']['order']['order_id'] ?? null;
        $order   = $orderNo ? Order::where('order_number', $orderNo)->first() : null;

        if (!$order) {
            return response()->json(['status' => 'order not found']);
        }

        try {
            if ($order->payment_status !== 'paid') {
                // never trust the payload alone: ask Cashfree
                $paymentId = $cf->confirmPaid($order);

                if ($paymentId) {
                    $this->finalizeOnlinePayment($order->id, $paymentId, 'cashfree', 'Cashfree Webhook');
                }
            }
        } catch (\Throwable $e) {
            Log::error('Cashfree webhook failed: ' . $e->getMessage(), ['order' => $orderNo]);
            return response()->json(['status' => 'error'], 500); // Cashfree will retry
        }

        return response()->json(['status' => 'ok']);
    }
}