<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MenuDetail;

class Daftar_menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function cart_item()
    {
        return $this->hasMany(CartItem::class);
    }

    public function details()
    {
        return $this->hasMany(MenuDetail::class, 'menu_id');
    }
}
