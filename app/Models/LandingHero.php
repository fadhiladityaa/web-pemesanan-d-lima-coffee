<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingHero extends Model
{
    protected $fillable = ['image_path', 'title', 'order', 'is_active'];
}
