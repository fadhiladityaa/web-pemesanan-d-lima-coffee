<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Midtrans\Snap;
use App\Models\Order;

#[Layout('layouts.app')]
#[Title('Pesanan Saya')]
class PesananSaya extends Component
{
    public $orders;
    public $snapToken;

    public function mount()
    {
        // Ambil semua pesanan milik user yang login
        $this->orders = auth()->user()
            ->orders()
            ->with('order_items.daftar_menu')
            ->latest()
            ->get();
    }

    /**
     * Generate Snap Token dan kirim event ke frontend
     */
    public function bayar($orderId)
    {
        // dd('tes');
        $order = Order::findOrFail($orderId);

        try {
            $params = [
                'transaction_details' => [
                    'order_id'     => $order->id . '-' . time(),
                    'gross_amount' => $order->total,
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'phone'      => $order->user->noHp,
                ],
            ];

            $this->snapToken = Snap::getSnapToken($params);
            // dd($this->snapToken);
            // kirim event ke frontend untuk trigger Snap JS
            $this->dispatch('openPayment', snapToken: $this->snapToken);
        } catch (\Exception $e) {
            $this->addError('payment', 'Gagal generate token pembayaran: ' . $e->getMessage());
            // dd($e->getMessage());
        }
    }

    /**
     * Update status order setelah transaksi Snap
     */
    #[On('updateOrderStatus')]
    public function updateOrderStatus($status, $result)
    {
        //  dd($status, $result);
        // $order = Order::find($result['order_id']);

        // $realId = explode('-', $result['order_id'])[0];
        $realId = strtok($result['order_id'], '-');


        $order = Order::find($realId);
        if ($order) {

            // Mapping status Midtrans ke payment_status internal
            $paymentStatus = match ($status) {
                'selesai', 'completed', 'settlement' => 'paid',
                'pending', 'proses'                  => 'pending',
                'gagal', 'canceled', 'expire'        => 'failed',
                default                              => 'pending',
            };

            $order->update([
                // 'order_status'   => $status,
                'payment_status' => $paymentStatus,
                'payment_result' => json_encode($result),
            ]);
        }

        // refresh daftar orders
        $this->orders = auth()->user()
            ->orders()
            ->with('order_items.daftar_menu')
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.pesanan-saya');
    }
}
