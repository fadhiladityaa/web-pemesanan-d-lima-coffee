<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Daftar_menu;

class Cart_item extends Model
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
