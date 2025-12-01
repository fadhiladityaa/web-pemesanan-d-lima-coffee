<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmallWarning extends Model
{
    protected $guarded = ['id'];

    public function menu ()
    {
        return $this->hasMany(Daftar_menu::class);
    }
}
