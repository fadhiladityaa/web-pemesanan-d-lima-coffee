<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        $menus = Menu::all();
        return view('home', [
            'title' => 'Home',
            'menus' => $menus,
            'coba' => "data berhasil terkirim"
        ]);
    }
}
