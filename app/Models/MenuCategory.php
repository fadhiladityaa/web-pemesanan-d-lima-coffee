<?php

namespace App\Models;

use App\Models\Daftar_menu;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $guarded = ['id'];

    public function daftar_menus()
    {
        return $this->hasMany(Daftar_menu::class);
    }
}
