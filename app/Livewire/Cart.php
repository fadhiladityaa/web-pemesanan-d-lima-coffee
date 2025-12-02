<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\CartItem;
// use App\Models\Daftar_menu;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Cart extends Component
{

    #[On('cart_updated')]
    public function render()
    {
        $cart = CartModel::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->with('cart_items.daftar_menu') // ✅ relasi yang benar
            ->first();

        return view('livewire.cart', [
            'cart' => $cart
        ]);
    }

    public function incrementQuantity($menu_id)
    {
        // dd($menu_id);
        $item = CartItem::where('id', $menu_id)->first();
        if ($item) {
            $item->increment('quantity');
        }
        $this->dispatch('cart_updated');
    }

    public function decrementQuantity($id)
    {
        $item = CartItem::where('id', $id)->first();
        if ($item->quantity < 2) {
            $item->delete();
        } else {
            $item->decrement('quantity');
        }

        $this->dispatch('cart_updated');
    }

    public function removeItem($id)
    {
        $item = CartItem::where('id', $id)->first();
        $item->delete();

        $this->dispatch('cart_updated');
    }
}
