<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Daftar_menu;

class CartItem extends Model
{
    protected $guarded = ['id'];

    public function daftar_menu()
    {
        return $this->belongsTo(Daftar_menu::class);
    }

    public function cart()
    {
        return $this-> belongsTo(Cart::class);
    }
}
