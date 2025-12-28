<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
#[Title('Pesanan Saya')]
class PesananSaya extends Component
{
    public $snapToken;

    /**
     * Generate Snap Token dan kirim event ke frontend
     */
    public function bayar($orderId)
    {
        $order = Order::findOrFail($orderId);

        $params = [
            'transaction_details' => [
                'order_id'     => $order->id . '-' . time(),
                'gross_amount' => (int) $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'phone'      => $order->user->noHp,
            ],
            'enabled_payments' => [
                'qris',
                'gopay',
                'dana',
            ],
        ];

        try {
            // Manual API Call to bypass library error 10023
            $serverKey = trim(config('midtrans.server_key')); // TRIM spasi yang mungkin terbawa saat copy-aste
            $isProduction = config('midtrans.is_production');

            // Debugging: Cek nilai config yang terbaca
            \Illuminate\Support\Facades\Log::info('Midtrans Config Debug:', [
                'server_key_prefix' => substr($serverKey, 0, 10) . '...', // Hide full key for security
                'is_production' => $isProduction,
                'resolved_url' => $isProduction
                    ? 'https://app.midtrans.com/snap/v1/transactions'
                    : 'https://app.sandbox.midtrans.com/snap/v1/transactions'
            ]);

            $auth = base64_encode($serverKey . ':');
            $url = $isProduction
                ? 'https://app.midtrans.com/snap/v1/transactions'
                : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . $auth
            ]);

            // Konfigurasi Network Fix (Sama seperti test_connect.php yang berhasil)
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            if ($error) {
                throw new \Exception('cURL Error: ' . $error);
            }

            if ($httpCode >= 400) {
                throw new \Exception('Midtrans Error (' . $httpCode . '): ' . $response);
            }

            $result = json_decode($response, true);

            if (!isset($result['token'])) {
                throw new \Exception('Invalid Response: ' . $response);
            }

            $this->snapToken = $result['token'];
            $this->dispatch('openPayment', snapToken: $this->snapToken);
        } catch (\Exception $e) {
            $this->addError('payment', 'Error: ' . $e->getMessage());
        }
    }

    #[On('updateOrderStatus')]
    public function updateOrderStatus($status, $result)
    {
        $realId = strtok($result['order_id'], '-');

        $order = Order::find($realId);
        if ($order) {
            $paymentStatus = match ($status) {
                'selesai', 'completed', 'settlement' => 'paid',
                'pending', 'proses'                  => 'pending',
                'gagal', 'canceled', 'expire'        => 'failed',
                default                              => 'pending',
            };

            $order->update([
                'payment_status' => $paymentStatus,
                'payment_result' => json_encode($result),
            ]);
        }
    }

    public function render()
    {
        $orders = Auth::user()
            ->orders()
            ->with('order_items.daftar_menu')
            ->latest()
            ->get();

        return view('livewire.pesanan-saya', [
            'orders' => $orders
        ]);
    }
}
