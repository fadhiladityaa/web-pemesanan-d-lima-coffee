<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Daftar_menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $guarded = ['id'];

    public function order () : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function daftar_menu()
    {
        return $this->belongsTo(Daftar_menu::class);
    }
}
