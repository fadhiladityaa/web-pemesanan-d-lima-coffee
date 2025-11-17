<?php

namespace App\Livewire;

use App\Models\Daftar_menu;
use App\Models\Cart as CartModel;
use App\Models\CartItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    public function addToCart($menu_id)
    {
        $user_id = Auth::id();
        // dd($user_id);

        $cart = CartModel::firstOrCreate(
            ['user_id' => $user_id, 'status' => 'pending'],
            ['created_at' => now()],
        );

        $item = CartItem::where('cart_id', $cart->id)
            ->where('daftar_menu_id', $menu_id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $menu = Daftar_menu::findOrfail($menu_id);

            CartItem::create([
                'cart_id' => $cart->id,
                'daftar_menu_id' => $menu->id,
                'quantity' => 1,
                'price' => $menu->harga,
            ]);
        };
        $this->dispatch('cart_updated');
    }

    public $search = '';

    public function render()
    {

        $query = Daftar_menu::query();

        if ($this->search) {
            $query->where('nama_menu', 'like', '%' . $this->search . '%');
        }


        return view('livewire.products', [
            'menus' => $query->get()
        ]);
    }
}
