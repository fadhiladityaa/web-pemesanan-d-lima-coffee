<?php

namespace App\Livewire;


use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Layout('layouts.admin')]
#[Title('Detail Pesanan')]
class DetailPesanan extends Component
{
    public $order;

    public function mount(Order $order)
    {
        // load relasi agar detail lengkap
        $this->order = $order->load('user', 'order_items.daftar_menu');
    }

    public function updateStatus($status)
    {
        $this->order->update(['order_status' => $status]);
    }

    public function render()
    {
        return view('livewire.detail-pesanan');
    }
}
