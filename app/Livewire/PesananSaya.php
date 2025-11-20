<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Layout('layouts.app')]
#[Title('Pesanan Saya')]
class PesananSaya extends Component
{

     public $orders;

    public function mount()
    {
        // Ambil semua pesanan milik user yang login
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
