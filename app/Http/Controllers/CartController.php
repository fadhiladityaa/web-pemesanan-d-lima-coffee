<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Daftar_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function buyNow($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $menu = Daftar_menu::findOrFail($id);

        // Find or create pending cart
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'pending'],
            ['user_id' => $user->id, 'status' => 'pending']
        );

        // Check if item exists in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('daftar_menu_id', $menu->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'daftar_menu_id' => $menu->id,
                'quantity' => 1,
                'price' => $menu->harga, 
            ]);
        }

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang');
    }
}
