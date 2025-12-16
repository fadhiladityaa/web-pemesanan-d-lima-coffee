<?php

namespace App\Models;

use App\Models\Daftar_menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function daftar_menus()
    {
        return $this->hasMany(Daftar_menu::class, 'category_id');
    }
}
