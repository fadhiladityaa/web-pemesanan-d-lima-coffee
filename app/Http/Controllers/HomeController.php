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
            'menus' => Daftar_menu::all()
        ]);
    }
}
