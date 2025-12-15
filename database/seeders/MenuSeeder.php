<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Daftar_menu;
// use App\Models\KandunganMenu;
use App\Models\MenuCategory;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $coffeeCategory = MenuCategory::firstOrCreate(['name' => 'Coffee']);

        $menu = Daftar_menu::create([
            'nama_menu'   => 'Latte',
            'category_id' => $coffeeCategory->id,
            'harga'       => 25000,
            'gambar'      => 'latte.jpg',
            'deskripsi'   => 'Kopi susu lembut',
            'pesan'       => 'Best seller',
        ]);

        // isi kandungan via relasi
        $menu->kandungan()->create([
            'energi_total'  => 100,
            'takaran_saji'  => 200,
            'protein'       => 5,
            'lemak_total'   => 2,
            'lemak_jenuh'   => 1,
            'karbohidrat'   => 10,
            'gula'          => 3,
            'garam_natrium' => 1,
            'kafein'        => 0,
            'batas_konsumsi' => 'Aman dikonsumsi',
        ]);

        // isi bahan baku via relasi
        $menu->bahanBaku()->createMany([
            ['nama_bahan' => 'Kopi Arabica', 'takaran' => '50gr'],
            ['nama_bahan' => 'Susu Full Cream', 'takaran' => '100ml'],
        ]);
    }
}
