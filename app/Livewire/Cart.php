<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Cart as CartModel; 
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Cart extends Component
{
    protected $listeners = ['cartUpdated' => 'render'];


    #[On('cartUpdated')]
    public function render()
    {
        $cart = CartModel::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->with('items.daftar_menu') // relasi ke cart_items + menu
            ->first();

        return view('livewire.cart', [
            'cart' => $cart
        ]);
    }
}
