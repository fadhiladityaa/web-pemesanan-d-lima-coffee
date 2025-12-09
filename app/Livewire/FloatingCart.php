<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Models\CartItem;
// use Illuminate\Container\Attributes\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FloatingCart extends Component
{
    public $itemCount = 0;

    #[On('cart_updated')]
    public function mount()
    {
        $this->itemCount = CartItem::where('user_id', Auth::id())
            ->sum('quantity');
    }


    public function render()
    {

        return view('livewire.floating-cart', [
            'count' => $this->itemCount,
        ]);
    }
}
