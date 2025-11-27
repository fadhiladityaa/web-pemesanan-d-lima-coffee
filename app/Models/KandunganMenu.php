<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KandunganMenu extends Model
{
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->hasOne(Daftar_menu::class);
    }
}
