<?php

namespace App\Http\Controllers;

use App\Models\Daftar_menu;
use Illuminate\Http\Request;

class addToCartController extends Controller
{
    public function store(Daftar_menu $daftar_menu)
    {
        $data = $daftar_menu->id;
        echo $data;
    }
}
