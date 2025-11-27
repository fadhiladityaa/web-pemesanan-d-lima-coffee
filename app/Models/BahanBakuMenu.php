<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBakuMenu extends Model
{
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->hasOne(Daftar_menu::class);
    }
}
