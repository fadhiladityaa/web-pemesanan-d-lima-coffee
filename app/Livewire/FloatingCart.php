<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Models\CartItem;
use Livewire\Component;

class FloatingCart extends Component
{
    public $itemCount = 0;
    
    #[On('cart_updated')]
    public function mount()
    {
        $this->itemCount = CartItem::sum('quantity');
    }

    public function render()
    {

        return view('livewire.floating-cart', [
            'count' => $this->itemCount,
        ]);
    }
}
