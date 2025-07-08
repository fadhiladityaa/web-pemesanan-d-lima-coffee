<?php

namespace App\Http\Controllers;

use App\Models\Daftar_menu;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.menu-management', [
            'title' => 'Dashboard',
            'menu' => Daftar_menu::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.menu-create', [
            'title' => 'Tambah menu',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'nama_menu' => 'required|string|unique:daftar_menus,nama_menu',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,gif|file|max:1024',
            'deskripsi' => 'required|string',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('menu-images', 'public');
        }


        Daftar_menu::create($validated);
        return redirect('/dashboard/menu-management')->with('success', 'Menu barhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Daftar_menu $daftar_menu)
    {
        // dd($daftar_menu);
        return view('dashboard.menu-edit', [
            'title' => 'Edit Menu',
            'id' => $daftar_menu->id,
            'nama_menu' => $daftar_menu->nama_menu,
            'harga' => $daftar_menu->harga,
            'deskripsi' => $daftar_menu->deskripsi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Daftar_menu $daftar_menu)
    {
        $rules = ([
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->nama_menu != $daftar_menu->nama_menu) {
            $rules['nama_menu'] = 'required|string|unique:daftar_menus,nama_menu';
        };

        $validatedData = $request->validate($rules);
        $daftar_menu->update($validatedData);

        return redirect('/dashboard/menu-management')->with('success', 'Menu barhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Daftar_menu $daftar_menu)
    {
        Daftar_menu::destroy($daftar_menu->id);
        return redirect('/dashboard/menu-management')->with('success', 'Menu barhasil dihapus');
    }
}
