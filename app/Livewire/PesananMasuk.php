<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class PesananMasuk extends Component
{

    #[Layout('layouts.admin')]
    #[Title('Pesanan Masuk')]
    public function render()
    {
        $orders = Order::with('user', 'order_items')->latest()->get();

        return view('livewire.pesanan-masuk', compact('orders')) ;
    }
}
