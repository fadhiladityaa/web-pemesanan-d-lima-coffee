<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Models\Daftar_menu;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'title' => 'Home',
        ]);
    }

    public function addToCart(Daftar_menu $daftar_menu)
    {
        $data = Daftar_menu::findOrfail();
    }
}
