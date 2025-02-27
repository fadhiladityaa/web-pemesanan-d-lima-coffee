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

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|unique:daftar_menus,nama_menu',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('menu_images', 'public'); 
            $validated['gambar'] = $gambarPath; 
        }

        Daftar_menu::create($validated);

        return redirect('/dashboard')->with('success', 'Menu barhasil ditambahkan');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
