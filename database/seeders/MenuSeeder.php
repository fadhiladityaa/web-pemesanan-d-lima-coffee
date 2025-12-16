<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Daftar_menu;
use App\Models\MenuCategory;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat atau ambil 5 kategori yang akan digunakan
        $categories = [
            'Coffee'        => MenuCategory::firstOrCreate(['name' => 'Coffee']),
            'Non Coffee'    => MenuCategory::firstOrCreate(['name' => 'Non Coffee']),
            'Moctail'       => MenuCategory::firstOrCreate(['name' => 'Moctail']),
            'Makanan Ringan'=> MenuCategory::firstOrCreate(['name' => 'Makanan Ringan']),
            'Makanan Berat' => MenuCategory::firstOrCreate(['name' => 'Makanan Berat']),
        ];

        // 2. Definisikan 5 data menu (satu per kategori)
        $menusData = [
            // 1. COFFEE
            [
                'nama_menu'   => 'Cappuccino',
                'category_id' => $categories['Coffee']->id,
                'harga'       => 28000,
                'gambar'      => 'cappuccino.jpg',
                'deskripsi'   => 'Kopi espresso dengan foam susu kental.',
                'pesan'       => 'Klasik Italia',
                'kandungan'   => [
                    'energi_total'  => 120, 'takaran_saji'  => 200, 'protein' => 6,
                    'lemak_total'   => 3, 'lemak_jenuh'   => 2, 'karbohidrat' => 12,
                    'gula'          => 5, 'garam_natrium' => 1, 'kafein' => 60,
                    'batas_konsumsi' => 'Nikmat di pagi hari',
                ],
                'bahan_baku'  => [
                    ['nama_bahan' => 'Espresso', 'takaran' => '30ml'],
                    ['nama_bahan' => 'Susu Segar', 'takaran' => '150ml'],
                ],
            ],
            // 2. NON COFFEE
            [
                'nama_menu'   => 'Red Velvet',
                'category_id' => $categories['Non Coffee']->id,
                'harga'       => 30000,
                'gambar'      => 'red_velvet.jpg',
                'deskripsi'   => 'Minuman manis dengan rasa red velvet dan krim.',
                'pesan'       => 'Warna cerah, rasa unik',
                'kandungan'   => [
                    'energi_total'  => 300, 'takaran_saji'  => 300, 'protein' => 4,
                    'lemak_total'   => 10, 'lemak_jenuh'   => 5, 'karbohidrat' => 45,
                    'gula'          => 20, 'garam_natrium' => 2, 'kafein' => 0,
                    'batas_konsumsi' => 'Paling disukai remaja',
                ],
                'bahan_baku'  => [
                    ['nama_bahan' => 'Red Velvet Powder', 'takaran' => '40gr'],
                    ['nama_bahan' => 'Susu', 'takaran' => '200ml'],
                ],
            ],
            // 3. MOCTAIL
            [
                'nama_menu'   => 'Virgin Mojito',
                'category_id' => $categories['Moctail']->id,
                'harga'       => 25000,
                'gambar'      => 'mojito.jpg',
                'deskripsi'   => 'Minuman segar dengan mint, lime, dan soda.',
                'pesan'       => 'Penyegar dahaga',
                'kandungan'   => [
                    'energi_total'  => 150, 'takaran_saji'  => 350, 'protein' => 0,
                    'lemak_total'   => 0, 'lemak_jenuh'   => 0, 'karbohidrat' => 38,
                    'gula'          => 35, 'garam_natrium' => 0, 'kafein' => 0,
                    'batas_konsumsi' => 'Sangat segar',
                ],
                'bahan_baku'  => [
                    ['nama_bahan' => 'Daun Mint', 'takaran' => '5 lembar'],
                    ['nama_bahan' => 'Lime Juice', 'takaran' => '30ml'],
                    ['nama_bahan' => 'Soda Water', 'takaran' => '250ml'],
                ],
            ],
            // 4. MAKANAN RINGAN
            [
                'nama_menu'   => 'French Fries',
                'category_id' => $categories['Makanan Ringan']->id,
                'harga'       => 22000,
                'gambar'      => 'fries.jpg',
                'deskripsi'   => 'Kentang goreng renyah dengan taburan garam.',
                'pesan'       => 'Cemilan wajib',
                'kandungan'   => [
                    'energi_total'  => 400, 'takaran_saji'  => 150, 'protein' => 4,
                    'lemak_total'   => 20, 'lemak_jenuh'   => 8, 'karbohidrat' => 50,
                    'gula'          => 0, 'garam_natrium' => 3, 'kafein' => 0,
                    'batas_konsumsi' => 'Gorengan',
                ],
                'bahan_baku'  => [
                    ['nama_bahan' => 'Kentang', 'takaran' => '150gr'],
                    ['nama_bahan' => 'Minyak Goreng', 'takaran' => 'Secukupnya'],
                ],
            ],
            // 5. MAKANAN BERAT
            [
                'nama_menu'   => 'Nasi Goreng Kampung',
                'category_id' => $categories['Makanan Berat']->id,
                'harga'       => 35000,
                'gambar'      => 'nasi_goreng.jpg',
                'deskripsi'   => 'Nasi goreng dengan bumbu tradisional dan telur mata sapi.',
                'pesan'       => 'Porsi mengenyangkan',
                'kandungan'   => [
                    'energi_total'  => 650, 'takaran_saji'  => 350, 'protein' => 20,
                    'lemak_total'   => 25, 'lemak_jenuh'   => 10, 'karbohidrat' => 80,
                    'gula'          => 5, 'garam_natrium' => 5, 'kafein' => 0,
                    'batas_konsumsi' => 'Menu makan siang',
                ],
                'bahan_baku'  => [
                    ['nama_bahan' => 'Nasi Putih', 'takaran' => '200gr'],
                    ['nama_bahan' => 'Telur', 'takaran' => '1 butir'],
                    ['nama_bahan' => 'Bumbu Nasi Goreng', 'takaran' => 'Secukupnya'],
                ],
            ],
        ];

        // 3. Loop melalui array data dan masukkan ke database
        foreach ($menusData as $data) {
            // Pisahkan data menu utama dari data relasi
            // Data menu utama (tanpa 'kandungan' dan 'bahan_baku')
            $menuAttributes = array_filter($data, function($key) {
                return !in_array($key, ['kandungan', 'bahan_baku']);
            }, ARRAY_FILTER_USE_KEY);
            
            $kandunganData = $data['kandungan'];
            $bahanBakuData = $data['bahan_baku'];

            // 4. Buat menu utama
            $menu = Daftar_menu::create($menuAttributes);

            // 5. Isi kandungan via relasi One-to-One
            $menu->kandungan()->create($kandunganData);

            // 6. Isi bahan baku via relasi One-to-Many
            $menu->bahanBaku()->createMany($bahanBakuData);
        }
    }
}