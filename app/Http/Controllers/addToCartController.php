<?php

namespace App\Http\Controllers;

use App\Models\Daftar_menu;
use Illuminate\Http\Request;

class addToCartController extends Controller
{
    public function addToCart(Daftar_menu $daftar_menu)
    {
        $data = Daftar_menu::findOrFail($daftar_menu);
        $cart = session()->get('cart', []);

        if(isset($cart[$daftar_menu])){
            $cart[$daftar_menu]['quantity']++;
        } else {
            $cart[$daftar_menu] = [
                'menu' => $data->nama_menu,
                'quantity' => 1,
                'harga' => $data->harga
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil masuk ke keranjang!');
    }
}
