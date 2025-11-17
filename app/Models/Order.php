<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $guarded = ['id'];
    protected $table = 'orders'; 


    public function user(): BelongsTo
    {
       return  $this->belongsTo(User::class);
    }

    public function order_items() {
        return $this->hasMany(OrderItem::class);
    }
}
