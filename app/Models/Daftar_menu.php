<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\KandunganMenu;

class Daftar_menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function cart_item()
    {
        return $this->hasMany(CartItem::class);
    }

    public function kandungan()
    {
        return $this->hasOne(KandunganMenu::class);
    }
}
