<?php

namespace App\Http\Controllers;

use App\Models\Daftar_menu;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Redis;

class menuController extends Controller
{
    public function index()
    {
        return view('dashboard.menu-management', [
            'title' => 'Dashboard',
            'menu' => Daftar_menu::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.menu-create', [
            'title' => 'Tambah menu',
        ]);
    }
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

    public function edit(Daftar_menu $daftar_menu)
    {
        // dd($daftar_menu);
        return view('dashboard.menu-edit', [
            'title' => 'Edit Menu',
            'id' => $daftar_menu->id,
            'nama_menu' => $daftar_menu->nama_menu,
            'harga' => $daftar_menu->harga,
            'gambar' => $daftar_menu->gambar,
            'deskripsi' => $daftar_menu->deskripsi,
        ]);
    }

    public function update(Request $request, Daftar_menu $daftar_menu)
    {
        $rules = ([
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,gif|file|max:1024',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->nama_menu != $daftar_menu->nama_menu) {
            $rules['nama_menu'] = 'required|string|unique:daftar_menus,nama_menu';
        };

        $validatedData = $request->validate($rules);
        
        // upload updated gambar setelah validasi
        if ($request->hasFile('gambar')) {
            // dd($request->oldImage);
            if($request->oldImage) {
                Storage::disk('public')->delete($request->oldImage);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('menu-images', 'public');
        }
        
        $daftar_menu->update($validatedData);

        return redirect('/dashboard/menu-management')->with('success', 'Menu barhasil diupdate!');
    }

    public function destroy(Daftar_menu $daftar_menu)
    {

        if($daftar_menu->gambar) {
            Storage::disk('public')->delete($daftar_menu->gambar);
        }
        $daftar_menu->delete();
        return redirect('/dashboard/menu-management')->with('success', 'Menu barhasil dihapus');
    }
}
