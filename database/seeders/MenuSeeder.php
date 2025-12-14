<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Daftar_menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Menu 1
        $menu = [
            [
                'nama_menu' => 'Kopi Susu D’Lima',
                'harga' => 12000,
                'gambar' => 'kopi-susu.jpg',
                'deskripsi' => 'Kopi susu khas D’Lima dengan rasa creamy dan sedikit pahit, cocok untuk pagi hari.'
            ],
            [
                'nama_menu' => 'Kopi Susu D’Lima',
                'harga' => 12000,
                'gambar' => 'kopi-susu.jpg',
                'deskripsi' => 'Kopi susu khas D’Lima dengan rasa creamy dan sedikit pahit, cocok untuk pagi hari.'
            ],
            [
                'nama_menu' => 'Kopi Susu D’Lima',
                'harga' => 12000,
                'gambar' => 'kopi-susu.jpg',
                'deskripsi' => 'Kopi susu khas D’Lima dengan rasa creamy dan sedikit pahit, cocok untuk pagi hari.'
            ],
        ];
    }
}
