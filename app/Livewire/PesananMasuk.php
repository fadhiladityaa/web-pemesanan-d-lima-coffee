<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class PesananMasuk extends Component
{


    public function render()
    {
        $orders = Order::with('user', 'order_items')->latest()->get();

        return view('livewire.pesanan-masuk', compact('orders')) ;
    }
}
