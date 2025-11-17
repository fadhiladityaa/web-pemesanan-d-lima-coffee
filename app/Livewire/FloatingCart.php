<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Models\Cart_item;
use Livewire\Component;

class FloatingCart extends Component
{
    public $itemCount = 0;
    
    #[On('cart_updated')]
    public function mount()
    {
        $this->itemCount = Cart_item::sum('quantity');
    }

    public function render()
    {

        return view('livewire.floating-cart', [
            'count' => $this->itemCount,
        ]);
    }
}
