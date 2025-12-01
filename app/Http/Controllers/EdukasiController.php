<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class edukasiController extends Controller
{
    public function index()
    {
        return view('components.edukasi', [
            'title' => 'Halaman Edukasi',
        ]);
    }
}
