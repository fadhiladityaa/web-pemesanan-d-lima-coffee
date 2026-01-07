<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log Facade
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    /**
     * Handle Midtrans Payment Notification
     * 
     * Security:
     * - Signature Key validation (SHA-512)
     * - Server-side check (Optional but recommended)
     * - Status handling
     */
    public function callback(Request $request)
    {
        // 1. Log Raw Payload (Critical for Debugging)
        Log::info('MIDTRANS_WEBHOOK: Incoming', ['payload' => $request->all(), 'ip' => $request->ip()]);

        // 2. Extract Data
        $serverKey = config('midtrans.server_key');
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $reqSignature = $request->signature_key;

        // 3. Validation: Check for Missing Credentials/Signature
        if (!$serverKey) {
            Log::error('MIDTRANS_WEBHOOK: Server Key configuration missing.');
            return response()->json(['message' => 'Configuration Error'], 500);
        }

        if (!$reqSignature) {
            // Likely a Redirect (Finish URL) or Fake Request
            Log::warning('MIDTRANS_WEBHOOK: Missing signature_key. Ignoring possible redirect.', ['user_agent' => $request->userAgent()]);
            return response()->json(['message' => 'Invalid Request: Missing Signature'], 400);
        }

        // 4. Manual SHA-512 Signature Calculation
        // Pattern: order_id + status_code + gross_amount + ServerKey
        $generatedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        // 5. Compare Signatures (Timing Attack Safe)
        if (!hash_equals($generatedSignature, $reqSignature)) {
            Log::error('MIDTRANS_WEBHOOK: Signature Mismatch', [
                'expected' => $generatedSignature, // Safe to log locally, never expose
                'received' => $reqSignature
            ]);
            return response()->json(['message' => 'Invalid Signature'], 403);
        }

        Log::info('MIDTRANS_WEBHOOK: Signature Validated. Processing Order: ' . $orderId);

        // 6. Resolve Order
        // Handle potentially appended timestamps by Midtrans (e.g., ORDER-123-162738)
        $realOrderId = explode('-', $orderId)[0];
        $order = Order::where('id', $realOrderId)->first(); // Assuming ID is string/int matching realOrderId

        // Fallback: try finding by exact order_id if logic differs
        if (!$order) {
            $order = Order::where('id', $orderId)->first();
        }

        if (!$order) {
            Log::error('MIDTRANS_WEBHOOK: Order not found: ' . $orderId);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 7. Update Status
        $transactionStatus = $request->transaction_status;
        $fraudStatus = $request->fraud_status;
        $paymentType = $request->payment_type;

        switch ($transactionStatus) {
            case 'capture':
                if ($paymentType == 'credit_card') {
                    if ($fraudStatus == 'challenge') {
                        $order->update(['payment_status' => 'pending']);
                    } else {
                        $order->update(['payment_status' => 'paid', 'order_status' => 'proses']);
                    }
                }
                break;
            case 'settlement':
                $order->update(['payment_status' => 'paid', 'order_status' => 'proses']);
                break;
            case 'pending':
                $order->update(['payment_status' => 'pending']);
                break;
            case 'deny':
            case 'expire':
            case 'cancel':
                $order->update(['payment_status' => 'failed', 'order_status' => 'gagal']);
                break;
            default:
                Log::info('MIDTRANS_WEBHOOK: Unhandled transaction status', ['status' => $transactionStatus]);
                break;
        }

        // 8. Return 200 OK
        return response()->json(['status' => 'OK']);
    }
}
