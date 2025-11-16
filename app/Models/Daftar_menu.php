<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart_item;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Daftar_menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function cart_item()
    {
        return $this->hasMany(Cart_item::class);
    }
}
