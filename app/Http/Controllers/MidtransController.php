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
        // Validasi Manual Signature Key (Anti-Manipulation)
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed !== $request->signature_key) {
           return response()->json(['message' => 'Invalid Signature'], 403);
        }

        // Server-to-Server Check (Anti-Spoofing)
        // Panggil kembali API Midtrans Get Status untuk memastikan status valid
        $baseUrl = config('midtrans.is_production') 
            ? 'https://api.midtrans.com/v2' 
            : 'https://api.sandbox.midtrans.com/v2';
            
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$baseUrl/$request->order_id/status");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($serverKey . ':')
        ]);
        
        // Bypass SSL di Sandbox/Dev untuk mencegah error "certificate file" lokal
        if (!config('midtrans.is_production')) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }

        $response = curl_exec($ch);
        curl_close($ch);

        $midtransStatus = json_decode($response);

        // Pastikan response valid
        if (!isset($midtransStatus->transaction_status)) {
            return response()->json(['message' => 'Failed to verify with Midtrans'], 500);
        }

        // Gunakan status dari S2S verification
        $status = $midtransStatus->transaction_status;
        $type = $midtransStatus->payment_type;
        $fraud = $midtransStatus->fraud_status;
        $orderId = $midtransStatus->order_id;

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

        return response()->json(['message' => 'Callback verified and processed successfully']);
    }
}
