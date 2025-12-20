<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Buat instance notification
        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            // Fallback jika notification gagal init (misal signature key tidak match di lib)
            // Tapi biasanya kita baca dari $request->all() manual kalau library bermasalah
            // Untuk sekarang asumsi library jalan
            return response()->json(['message' => 'Notification init failed', 'error' => $e->getMessage()], 500);
        }

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $orderId = $notification->order_id; // Format: ID-TIMESTAMP

        // Ambil ID asli
        $realOrderId = explode('-', $orderId)[0];
        $order = Order::find($realOrderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->update(['payment_status' => 'pending']);
                } else {
                    $order->update(['payment_status' => 'paid', 'order_status' => 'proses']);
                }
            }
        } else if ($status == 'settlement') {
            $order->update(['payment_status' => 'paid', 'order_status' => 'proses']);
        } else if ($status == 'pending') {
            $order->update(['payment_status' => 'pending']);
        } else if ($status == 'deny') {
            $order->update(['payment_status' => 'failed', 'order_status' => 'gagal']);
        } else if ($status == 'expire') {
            $order->update(['payment_status' => 'failed', 'order_status' => 'gagal']);
        } else if ($status == 'cancel') {
            $order->update(['payment_status' => 'failed', 'order_status' => 'gagal']);
        }

        return response()->json(['message' => 'Callback received successfully']);
    }
}
