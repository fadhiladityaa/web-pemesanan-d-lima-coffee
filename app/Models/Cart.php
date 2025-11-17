<?php

namespace App\Models;

use App\Models\CartItem;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $guarded = ['id'];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }
}
