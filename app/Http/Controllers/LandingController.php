<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daftar_menu;
use App\Models\MenuCategory;

class LandingController extends Controller
{
    public function index()
    {
        // Highlight 6 menu items on landing page
        $menus = Daftar_menu::take(6)->get();
        return view('landing', compact('menus'));
    }

    public function allMenu(Request $request)
    {
        $query = Daftar_menu::query();

        // Search Filter
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_menu', 'like', '%' . $request->search . '%');
        }

        // Category Filter
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $menus = $query->get();
        $categories = MenuCategory::all();

        return view('landing.menu', compact('menus', 'categories'));
    }
}
