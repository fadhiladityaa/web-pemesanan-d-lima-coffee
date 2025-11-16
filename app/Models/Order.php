<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order_item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $guarded = ['id'];

    public function users(): BelongsTo
    {
       return  $this->belongsTo(User::class);
    }

    public function order_items() {
        return $this->hasMany(Order_item::class);
    }
}
