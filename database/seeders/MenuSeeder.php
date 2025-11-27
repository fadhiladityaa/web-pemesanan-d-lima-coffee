<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Daftar_menu;
use App\Models\MenuDetail;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Menu 1
        $kopiSusu = Daftar_menu::create([
            'nama_menu' => 'Kopi Susu D’Lima',
            'harga' => 12000,
            'gambar' => 'kopi-susu.jpg',
            'deskripsi' => 'Kopi susu khas D’Lima dengan rasa creamy dan sedikit pahit, cocok untuk pagi hari.'
        ]);

        MenuDetail::create([
            'daftar_menu_id' => $kopiSusu->id,
            'bahan_baku' => 'Espresso 12gr',
            'energi_total' => 115,
            'protein' => 0.3,
            'lemak_total' => 0.1,
            'lemak_jenuh' => 0,
            'karbohidrat' => 2.5,
            'gula' => 0,
            'garam_natrium' => 5,
            'kafein' => 80,
            'batas_konsumsi' => 'Maksimal 2 gelas per hari untuk penderita asam lambung.'
        ]);

        MenuDetail::create([
            'daftar_menu_id' => $kopiSusu->id,
            'bahan_baku' => 'Susu Kental Manis 20gr',
            'energi_total' => 65,
            'protein' => 1.2,
            'lemak_total' => 1.5,
            'lemak_jenuh' => 0.8,
            'karbohidrat' => 10.5,
            'gula' => 9.8,
            'garam_natrium' => 15,
            'kafein' => 0,
            'batas_konsumsi' => 'Kurangi konsumsi jika sedang diet atau memiliki diabetes.'
        ]);

        // Menu 2
        $kopiHitam = Daftar_menu::create([
            'nama_menu' => 'Kopi Hitam Arabika',
            'harga' => 10000,
            'gambar' => 'kopi-hitam.jpg',
            'deskripsi' => 'Kopi hitam tanpa gula, cocok untuk penderita asam lambung dan yang ingin kopi murni.'
        ]);

        MenuDetail::create([
            'daftar_menu_id' => $kopiHitam->id,
            'bahan_baku' => 'Arabika Medium Roast 10gr',
            'energi_total' => 5,
            'protein' => 0.1,
            'lemak_total' => 0,
            'lemak_jenuh' => 0,
            'karbohidrat' => 0.2,
            'gula' => 0,
            'garam_natrium' => 2,
            'kafein' => 70,
            'batas_konsumsi' => 'Aman untuk penderita asam lambung jika tidak dikonsumsi saat perut kosong.'
        ]);
    }
}
