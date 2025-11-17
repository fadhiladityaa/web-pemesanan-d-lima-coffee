<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\Cart_item;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Cart extends Component
{

    #[On('cart_updated')]
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

    public function incrementQuantity($menu_id)
    {
        // dd($menu_id);
        $item = Cart_item::where('id', $menu_id)->first();
        if($item) {
            $item->increment('quantity');
        }
        $this->dispatch('cart_updated');
    }

    public function decrementQuantity($id)
    {
        $item = Cart_item::where('id', $id)->first();
        if($item->quantity < 2) {
            // $item->decrement('quantity');
            // dd('yakin ingin hapus?');
            $item->delete();
        } else {
            $item->decrement('quantity');
        }

        $this->dispatch('cart_updated');
    }

    public function removeItem($id) 
    {
        $item = Cart_item::where('id', $id)->first();
        $item->delete();

        $this->dispatch('cart_updated');
    }

    
}
