<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class beritaController extends Controller
{
    public function index()
    {
        return view('components.berita', [
            'title' => 'Halaman Berita',
        ]);
    }
}
