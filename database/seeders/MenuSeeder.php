<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Daftar_menu;
use App\Models\MenuCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage; // Untuk akses folder tujuan
use Illuminate\Support\Facades\File;    // Untuk akses folder asal (mentahan)

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan Foreign Key Check untuk reset data yang aman
        Schema::disableForeignKeyConstraints();
        
        // Kosongkan tabel agar tidak terjadi duplikasi data
        Daftar_menu::truncate();
        MenuCategory::truncate();

        // 1. Buat Kategori
        $categories = [
            'Coffee'         => MenuCategory::create(['name' => 'Coffee']),
            'Non Coffee'     => MenuCategory::create(['name' => 'Non Coffee']),
            'Moctail'        => MenuCategory::create(['name' => 'Moctail']),
            'Makanan Ringan' => MenuCategory::create(['name' => 'Makanan Ringan']),
            'Makanan Berat'  => MenuCategory::create(['name' => 'Makanan Berat']),
        ];

        // 2. Data Menu (30 Item Pilihan dari Spreadsheet)
        $menusData = [
            // ================== KATEGORI: COFFEE (7 Menu) ==================
            [
                'category' => 'Coffee',
                'nama_menu' => 'Kopi Susu',
                'harga' => 10000,
                'gambar' => 'kopi_susu.jpg',
                'deskripsi' => 'Espresso Robusta Blend dengan susu kental manis dan creamer.',
                'pesan' => 'Extra Strong',
                'kandungan' => [
                    'energi_total' => 115, 'takaran_saji' => 90, 'protein' => 1.5, 'lemak_total' => 4,
                    'lemak_jenuh' => 2.5, 'karbohidrat' => 19, 'gula' => 15, 'garam_natrium' => 45, 'kafein' => 240,
                    'batas_konsumsi' => "Kategori 'Extra Strong'. Nikmati maksimal 1-2 gelas sehari. Bagi lambung sensitif, disarankan minum setelah makan.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Espresso (Robusta Blend)', 'takaran' => '12 gr'],
                    ['nama_bahan' => 'Susu Kental Manis (Omela)', 'takaran' => '30 gr'],
                    ['nama_bahan' => 'Creamer Bubuk (Javaland)', 'takaran' => '2 gr'],
                ]
            ],
            [
                'category' => 'Coffee',
                'nama_menu' => 'Kopi Hitam',
                'harga' => 10000,
                'gambar' => 'kopi_hitam.jpg',
                'deskripsi' => 'Espresso Robusta 100% murni. Rasa bold dan intens.',
                'pesan' => 'Bold & Intens',
                'kandungan' => [
                    'energi_total' => 3, 'takaran_saji' => 90, 'protein' => 0.2, 'lemak_total' => 0,
                    'lemak_jenuh' => 0, 'karbohidrat' => 0.5, 'gula' => 0, 'garam_natrium' => 5, 'kafein' => 240,
                    'batas_konsumsi' => "Karakter rasa Bold dan Intens. Ideal dinikmati 1-2 cangkir sehari. Pastikan perut sudah terisi untuk kenyamanan lambung.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Espresso (Robusta Blend)', 'takaran' => '12 gr'],
                    ['nama_bahan' => 'Air Putih', 'takaran' => 'Secukupnya'],
                ]
            ],
            [
                'category' => 'Coffee',
                'nama_menu' => 'Kopi Susu Gula Aren',
                'harga' => 15000,
                'gambar' => 'kopi_susu_aren.jpg',
                'deskripsi' => 'Manis legit gula aren berpadu dengan Robusta kuat dan susu.',
                'pesan' => 'Manis Legit',
                'kandungan' => [
                    'energi_total' => 115, 'takaran_saji' => 90, 'protein' => 1, 'lemak_total' => 1.5,
                    'lemak_jenuh' => 1, 'karbohidrat' => 24, 'gula' => 22, 'garam_natrium' => 20, 'kafein' => 240,
                    'batas_konsumsi' => "Manis legit gula aren berpadu dengan Robusta kuat. Nikmati maksimal 1-2 gelas sehari sebagai penyemangat aktivitas.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Espresso (Robusta Blend)', 'takaran' => '12 gr'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '15 gr'],
                    ['nama_bahan' => 'Gula Aren Cair', 'takaran' => '20 gr'],
                ]
            ],
            [
                'category' => 'Coffee',
                'nama_menu' => 'Kopi Gula Aren',
                'harga' => 15000,
                'gambar' => 'kopi_aren.jpg',
                'deskripsi' => 'Opsi segar tanpa susu (Dairy-Free) dengan gula aren cair.',
                'pesan' => 'Pre-Workout',
                'kandungan' => [
                    'energi_total' => 65, 'takaran_saji' => 90, 'protein' => 0, 'lemak_total' => 0,
                    'lemak_jenuh' => 1, 'karbohidrat' => 16, 'gula' => 15, 'garam_natrium' => 5, 'kafein' => 240,
                    'batas_konsumsi' => "Opsi segar tanpa susu. Cocok sebagai 'Pre-Workout' alami. Aman dikonsumsi 1-2 gelas sehari.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Espresso (Robusta Blend)', 'takaran' => '12 gr'],
                    ['nama_bahan' => 'Gula Aren Cair', 'takaran' => '20 gr'],
                ]
            ],
            [
                'category' => 'Coffee',
                'nama_menu' => 'Chappuchino',
                'harga' => 10000,
                'gambar' => 'chappuchino.jpg',
                'deskripsi' => 'Top Kopi Cappuchino dengan susu dan creamer.',
                'pesan' => 'Rendah Kafein',
                'kandungan' => [
                    'energi_total' => 195, 'takaran_saji' => 230, 'protein' => 2, 'lemak_total' => 6,
                    'lemak_jenuh' => 4, 'karbohidrat' => 36, 'gula' => 24, 'garam_natrium' => 90, 'kafein' => 50,
                    'batas_konsumsi' => "Rasa manis dan sangat creamy. Aman bagi lambung (Rendah Kafein). Disarankan maksimal 1 porsi per hari.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Top Kopi Chappuchino', 'takaran' => '25 gr'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '15 gr'],
                    ['nama_bahan' => 'Creamer Bubuk', 'takaran' => '5 gr'],
                ]
            ],
            [
                'category' => 'Coffee',
                'nama_menu' => 'Es Kopi Susu',
                'harga' => 15000,
                'gambar' => 'es_kopi_susu.jpg',
                'deskripsi' => 'Sensasi Full Cream yang gurih dan lembut dengan tekstur bold.',
                'pesan' => 'Full Cream',
                'kandungan' => [
                    'energi_total' => 161, 'takaran_saji' => 250, 'protein' => 3.5, 'lemak_total' => 6.5,
                    'lemak_jenuh' => 4, 'karbohidrat' => 22, 'gula' => 18, 'garam_natrium' => 80, 'kafein' => 220,
                    'batas_konsumsi' => "Sensasi 'Full Cream' yang gurih. Mengandung kafein tinggi (~220mg). Nikmati maksimal 1-2 cup sehari.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Espresso (Robusta Blend)', 'takaran' => '11 gr'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '30 gr'],
                    ['nama_bahan' => 'Creamer Bubuk', 'takaran' => '3 gr'],
                    ['nama_bahan' => 'Es Batu', 'takaran' => '40 gr'],
                    ['nama_bahan' => 'Milk Life UHT', 'takaran' => '70 ml'],
                ]
            ],
            [
                'category' => 'Coffee',
                'nama_menu' => 'Es Americano',
                'harga' => 10000,
                'gambar' => 'es_americano.jpg',
                'deskripsi' => 'Espresso Robusta dingin dengan air. 0% Gula & Lemak.',
                'pesan' => 'Extra Strong',
                'kandungan' => [
                    'energi_total' => 5, 'takaran_saji' => 250, 'protein' => 0.3, 'lemak_total' => 0,
                    'lemak_jenuh' => 0, 'karbohidrat' => 1, 'gula' => 0, 'garam_natrium' => 10, 'kafein' => 300,
                    'batas_konsumsi' => "Kandungan Kafein Tertinggi (Extra Strong). 0% Gula. Cukup 1 gelas sehari untuk fokus maksimal.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Espresso (Robusta Blend)', 'takaran' => '15 gr'],
                    ['nama_bahan' => 'Air Putih', 'takaran' => '100 ml'],
                    ['nama_bahan' => 'Es Batu', 'takaran' => '40 gr'],
                ]
            ],

            // ================== KATEGORI: NON COFFEE (6 Menu) ==================
            [
                'category' => 'Non Coffee',
                'nama_menu' => 'Teh Hangat',
                'harga' => 6000,
                'gambar' => 'teh_hangat.jpg',
                'deskripsi' => 'Teh celup Sosro hangat dengan gula kristal.',
                'pesan' => 'Ringan & Tenang',
                'kandungan' => [
                    'energi_total' => 50, 'takaran_saji' => 220, 'protein' => 0, 'lemak_total' => 0,
                    'lemak_jenuh' => 0, 'karbohidrat' => 12, 'gula' => 12, 'garam_natrium' => 0, 'kafein' => 40,
                    'batas_konsumsi' => "Pilihan ringan dan menenangkan. Aman dikonsumsi 2-3 cangkir sehari sebagai teman santai.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sosro Teh Celup', 'takaran' => '1 bag'],
                    ['nama_bahan' => 'Gula Kristal', 'takaran' => '12 gr'],
                ]
            ],
            [
                'category' => 'Non Coffee',
                'nama_menu' => 'Teh Susu Hangat',
                'harga' => 8000,
                'gambar' => 'teh_susu.jpg',
                'deskripsi' => 'Teh hangat dengan susu kental manis dan creamer.',
                'pesan' => 'Comfort Drink',
                'kandungan' => [
                    'energi_total' => 116, 'takaran_saji' => 230, 'protein' => 1, 'lemak_total' => 4,
                    'lemak_jenuh' => 2.5, 'karbohidrat' => 19, 'gula' => 16, 'garam_natrium' => 45, 'kafein' => 40,
                    'batas_konsumsi' => "Sensasi creamy dan menenangkan. Kandungan kafein rendah, cocok dinikmati kapan saja.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sosro Teh Celup', 'takaran' => '1 bag'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '30 gr'],
                    ['nama_bahan' => 'Creamer Bubuk', 'takaran' => '3 gr'],
                ]
            ],
            [
                'category' => 'Non Coffee',
                'nama_menu' => 'Teh Madu Hangat',
                'harga' => 10000,
                'gambar' => 'teh_madu.jpg',
                'deskripsi' => 'Teh hangat dengan madu TJ murni.',
                'pesan' => 'Booster Stamina',
                'kandungan' => [
                    'energi_total' => 95, 'takaran_saji' => 220, 'protein' => 0, 'lemak_total' => 0,
                    'lemak_jenuh' => 0, 'karbohidrat' => 25, 'gula' => 24, 'garam_natrium' => 5, 'kafein' => 40,
                    'batas_konsumsi' => "Minuman herbal alami. Sangat baik untuk menghangatkan tubuh. Aman dikonsumsi 1-2 gelas sehari.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sosro Teh Celup', 'takaran' => '1 bag'],
                    ['nama_bahan' => 'Madu TJ Asli', 'takaran' => '30 gr'],
                ]
            ],
            [
                'category' => 'Non Coffee',
                'nama_menu' => 'Lemon Tea Hangat',
                'harga' => 10000,
                'gambar' => 'lemon_tea_hot.jpg',
                'deskripsi' => 'Teh dengan irisan jeruk nipis dan gula.',
                'pesan' => 'Vitamin C',
                'kandungan' => [
                    'energi_total' => 52, 'takaran_saji' => 230, 'protein' => 0.1, 'lemak_total' => 0,
                    'lemak_jenuh' => 0, 'karbohidrat' => 13, 'gula' => 12, 'garam_natrium' => 5, 'kafein' => 40,
                    'batas_konsumsi' => "Kaya antioksidan dan Vitamin C. Sangat segar dan baik untuk daya tahan tubuh. Aman dikonsumsi 2-3 gelas sehari.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sosro Teh Celup', 'takaran' => '1 bag'],
                    ['nama_bahan' => 'Jeruk Nipis', 'takaran' => '2 slice'],
                    ['nama_bahan' => 'Gula Kristal', 'takaran' => '12 gr'],
                ]
            ],
            [
                'category' => 'Non Coffee',
                'nama_menu' => 'Coklat Hangat',
                'harga' => 10000,
                'gambar' => 'coklat_hangat.jpg',
                'deskripsi' => 'Delfi hot cocoa mix dengan susu dan creamer.',
                'pesan' => 'High Sugar',
                'kandungan' => [
                    'energi_total' => 228, 'takaran_saji' => 230, 'protein' => 3, 'lemak_total' => 7,
                    'lemak_jenuh' => 4, 'karbohidrat' => 40, 'gula' => 34, 'garam_natrium' => 90, 'kafein' => 5,
                    'batas_konsumsi' => "Rasa cokelat pekat dan manis. Disarankan dibatasi 1 gelas per hari karena kandungan gulanya cukup tinggi.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Delfi Hot Cocoa', 'takaran' => '25 gr'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '20 gr'],
                    ['nama_bahan' => 'Frisian Flag Coklat', 'takaran' => '10 gr'],
                ]
            ],
            [
                'category' => 'Non Coffee',
                'nama_menu' => 'Es Teh',
                'harga' => 7000,
                'gambar' => 'es_teh.jpg',
                'deskripsi' => 'Es teh klasik dengan gula cair.',
                'pesan' => 'Klasik',
                'kandungan' => [
                    'energi_total' => 100, 'takaran_saji' => 270, 'protein' => 0, 'lemak_total' => 0,
                    'lemak_jenuh' => 0, 'karbohidrat' => 25, 'gula' => 25, 'garam_natrium' => 5, 'kafein' => 40,
                    'batas_konsumsi' => "Kesegaran klasik. Mengandung gula sekitar 25g. Disarankan tidak berlebihan jika membatasi asupan gula.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sosro Teh Celup', 'takaran' => '1 bag'],
                    ['nama_bahan' => 'Gula Cair', 'takaran' => '25 gr'],
                    ['nama_bahan' => 'Es Batu', 'takaran' => 'Secukupnya'],
                ]
            ],

            // ================== KATEGORI: MOCTAIL (6 Menu) ==================
            [
                'category' => 'Moctail',
                'nama_menu' => 'Soda Gembira',
                'harga' => 15000,
                'gambar' => 'soda_gembira.jpg',
                'deskripsi' => 'Soda dengan sirup coco pandan dan susu.',
                'pesan' => 'High Sugar',
                'kandungan' => [
                    'energi_total' => 205, 'takaran_saji' => 250, 'protein' => 1, 'lemak_total' => 2,
                    'lemak_jenuh' => 1, 'karbohidrat' => 48, 'gula' => 47, 'garam_natrium' => 40, 'kafein' => 0,
                    'batas_konsumsi' => "Sangat segar dan manis. Hampir memenuhi batas konsumsi gula harian dalam satu gelas.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sirup Coco Pandan', 'takaran' => '35 gr'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '20 gr'],
                    ['nama_bahan' => 'Es Batu', 'takaran' => '40 gr'],
                    ['nama_bahan' => 'Soda', 'takaran' => '100 ml'],
                ]
            ],
            [
                'category' => 'Moctail',
                'nama_menu' => 'Cream Soda Susu',
                'harga' => 10000,
                'gambar' => 'cream_soda.jpg',
                'deskripsi' => 'Cream soda dengan susu dan creamer.',
                'pesan' => 'Creamy Fizz',
                'kandungan' => [
                    'energi_total' => 196, 'takaran_saji' => 250, 'protein' => 1, 'lemak_total' => 5,
                    'lemak_jenuh' => 3, 'karbohidrat' => 38, 'gula' => 35, 'garam_natrium' => 60, 'kafein' => 0,
                    'batas_konsumsi' => "Sensasi unik bersoda dan creamy ala 'Float'. Mengandung gas dan gula cukup tinggi.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Cream Soda', 'takaran' => '250 ml'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '30 gr'],
                    ['nama_bahan' => 'Es Batu', 'takaran' => '40 gr'],
                    ['nama_bahan' => 'Creamer Bubuk', 'takaran' => '5 gr'],
                ]
            ],
            [
                'category' => 'Moctail',
                'nama_menu' => 'Moctail Vanila',
                'harga' => 15000,
                'gambar' => 'moctail_vanila.jpg',
                'deskripsi' => 'Soda vanila dengan susu dan gula cair.',
                'pesan' => 'Aromatik',
                'kandungan' => [
                    'energi_total' => 260, 'takaran_saji' => 250, 'protein' => 1, 'lemak_total' => 3,
                    'lemak_jenuh' => 1.5, 'karbohidrat' => 62, 'gula' => 60, 'garam_natrium' => 45, 'kafein' => 0,
                    'batas_konsumsi' => "Sensasi soda vanila segar. Mengandung gula sangat tinggi. Nikmati sebagai 'Treat' sesekali.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sirup Vanila', 'takaran' => '35 gr'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '30 gr'],
                    ['nama_bahan' => 'Es Batu', 'takaran' => '40 gr'],
                    ['nama_bahan' => 'Soda', 'takaran' => '100 ml'],
                ]
            ],
            [
                'category' => 'Moctail',
                'nama_menu' => 'Moctail Strawberry',
                'harga' => 15000,
                'gambar' => 'moctail_strawberry.jpg',
                'deskripsi' => 'Soda strawberry dengan susu.',
                'pesan' => 'Fruity',
                'kandungan' => [
                    'energi_total' => 260, 'takaran_saji' => 250, 'protein' => 1, 'lemak_total' => 3,
                    'lemak_jenuh' => 1.5, 'karbohidrat' => 62, 'gula' => 60, 'garam_natrium' => 45, 'kafein' => 0,
                    'batas_konsumsi' => "Perpaduan rasa buah segar dan soda creamy. Kandungan gula sangat tinggi (mendekati 60g).",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sirup Strawberry', 'takaran' => '35 gr'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '30 gr'],
                    ['nama_bahan' => 'Es Batu', 'takaran' => '40 gr'],
                    ['nama_bahan' => 'Soda', 'takaran' => '100 ml'],
                ]
            ],
            [
                'category' => 'Moctail',
                'nama_menu' => 'Moctail Melon',
                'harga' => 15000,
                'gambar' => 'moctail_melon.jpg',
                'deskripsi' => 'Soda melon dengan susu.',
                'pesan' => 'Fresh Melon',
                'kandungan' => [
                    'energi_total' => 260, 'takaran_saji' => 250, 'protein' => 1, 'lemak_total' => 3,
                    'lemak_jenuh' => 1.5, 'karbohidrat' => 62, 'gula' => 60, 'garam_natrium' => 45, 'kafein' => 0,
                    'batas_konsumsi' => "Aroma melon harum berpadu dengan soda creamy. Mengandung gula sangat tinggi.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sirup Melon', 'takaran' => '35 gr'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '30 gr'],
                    ['nama_bahan' => 'Es Batu', 'takaran' => '40 gr'],
                    ['nama_bahan' => 'Soda', 'takaran' => '100 ml'],
                ]
            ],
            [
                'category' => 'Moctail',
                'nama_menu' => 'Moctail Mocha',
                'harga' => 15000,
                'gambar' => 'moctail_mocha.jpg',
                'deskripsi' => 'Soda mocha dengan susu.',
                'pesan' => 'Choco Coffee Soda',
                'kandungan' => [
                    'energi_total' => 260, 'takaran_saji' => 250, 'protein' => 1, 'lemak_total' => 3,
                    'lemak_jenuh' => 1.5, 'karbohidrat' => 62, 'gula' => 60, 'garam_natrium' => 45, 'kafein' => 0,
                    'batas_konsumsi' => "Sensasi unik soda dengan aroma mocha. Sangat manis dan menyegarkan.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Sirup Mocha', 'takaran' => '35 gr'],
                    ['nama_bahan' => 'Susu Kental Manis', 'takaran' => '30 gr'],
                    ['nama_bahan' => 'Es Batu', 'takaran' => '40 gr'],
                    ['nama_bahan' => 'Soda', 'takaran' => '100 ml'],
                ]
            ],

            // ================== KATEGORI: MAKANAN RINGAN (5 Menu) ==================
            [
                'category' => 'Makanan Ringan',
                'nama_menu' => 'Ubi Goreng',
                'harga' => 10000,
                'gambar' => 'ubi_goreng.jpg',
                'deskripsi' => 'Ubi jalar goreng dengan sambal tumis.',
                'pesan' => 'Manis Pedas',
                'kandungan' => [
                    'energi_total' => 350, 'takaran_saji' => 150, 'protein' => 3, 'lemak_total' => 16,
                    'lemak_jenuh' => 6, 'karbohidrat' => 52, 'gula' => 10, 'garam_natrium' => 350, 'kafein' => 0,
                    'batas_konsumsi' => "Kombinasi unik manis ubi dan pedas gurih sambal terasi khas Sulsel. Tinggi karbohidrat.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Ubi Jalar', 'takaran' => '200 gr'],
                    ['nama_bahan' => 'Sambal Tumis', 'takaran' => '25 gr'],
                    ['nama_bahan' => 'Minyak Goreng', 'takaran' => 'Secukupnya'],
                ]
            ],
            [
                'category' => 'Makanan Ringan',
                'nama_menu' => 'Pisang Goreng',
                'harga' => 10000,
                'gambar' => 'pisang_goreng.jpg',
                'deskripsi' => 'Pisang kepok goreng dengan sambal tumis.',
                'pesan' => 'Khas Makassar',
                'kandungan' => [
                    'energi_total' => 380, 'takaran_saji' => 150, 'protein' => 3, 'lemak_total' => 18,
                    'lemak_jenuh' => 8, 'karbohidrat' => 58, 'gula' => 22, 'garam_natrium' => 320, 'kafein' => 0,
                    'batas_konsumsi' => "Sensasi unik 'Manis-Pedas'. Cukup 1 porsi sebagai pendamping kopi hitam.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Pisang Kepok', 'takaran' => '4 pcs'],
                    ['nama_bahan' => 'Adonan Tepung', 'takaran' => 'Secukupnya'],
                    ['nama_bahan' => 'Sambal Tumis', 'takaran' => '25 gr'],
                ]
            ],
            [
                'category' => 'Makanan Ringan',
                'nama_menu' => 'Bakwan Goreng',
                'harga' => 10000,
                'gambar' => 'bakwan.jpg',
                'deskripsi' => 'Bakwan sayur dengan sambal tumis.',
                'pesan' => 'Sharing Snack',
                'kandungan' => [
                    'energi_total' => 500, 'takaran_saji' => 150, 'protein' => 8, 'lemak_total' => 32,
                    'lemak_jenuh' => 14, 'karbohidrat' => 65, 'gula' => 4, 'garam_natrium' => 480, 'kafein' => 0,
                    'batas_konsumsi' => "Kategori 'Sharing Snack'. Sangat tinggi kalori dan minyak. Disarankan untuk dimakan beramai-ramai.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Tepung Terigu', 'takaran' => '100 gr'],
                    ['nama_bahan' => 'Sayuran (Kol, Wortel)', 'takaran' => 'Secukupnya'],
                    ['nama_bahan' => 'Sambal Tumis', 'takaran' => '25 gr'],
                ]
            ],
            [
                'category' => 'Makanan Ringan',
                'nama_menu' => 'Pisang Epe',
                'harga' => 10000,
                'gambar' => 'pisang_epe.jpg',
                'deskripsi' => 'Pisang kepok bakar dengan pilihan topping.',
                'pesan' => 'Bebas Minyak',
                'kandungan' => [
                    'energi_total' => 450, 'takaran_saji' => 150, 'protein' => 4, 'lemak_total' => 6,
                    'lemak_jenuh' => 3, 'karbohidrat' => 98, 'gula' => 55, 'garam_natrium' => 80, 'kafein' => 0,
                    'batas_konsumsi' => "Kuliner khas Makassar yang dibakar (Bebas Minyak Goreng). Tinggi gula dari saus spesialnya.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Pisang Kepok Bakar', 'takaran' => '8 pcs'],
                    ['nama_bahan' => 'Topping (Durian/Coklat/Keju)', 'takaran' => 'Secukupnya'],
                ]
            ],
            [
                'category' => 'Makanan Ringan',
                'nama_menu' => 'Omelet',
                'harga' => 10000,
                'gambar' => 'omelet.jpg',
                'deskripsi' => 'Telur dadar dengan sosis dan sayuran.',
                'pesan' => 'High Protein',
                'kandungan' => [
                    'energi_total' => 325, 'takaran_saji' => 150, 'protein' => 17, 'lemak_total' => 26,
                    'lemak_jenuh' => 8, 'karbohidrat' => 6, 'gula' => 1, 'garam_natrium' => 450, 'kafein' => 0,
                    'batas_konsumsi' => "Menu tinggi protein yang mengenyangkan (Low Carb). Sangat baik untuk sarapan atau makan malam tanpa nasi.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Telur Ayam', 'takaran' => '2 butir'],
                    ['nama_bahan' => 'Sosis Ayam', 'takaran' => '1/2'],
                    ['nama_bahan' => 'Wortel & Daun Bawang', 'takaran' => 'Secukupnya'],
                ]
            ],

            // ================== KATEGORI: MAKANAN BERAT (6 Menu) ==================
            [
                'category' => 'Makanan Berat',
                'nama_menu' => 'Nasi Goreng Spesial + Es Teh',
                'harga' => 25000,
                'gambar' => 'nasgor_spesial.jpg',
                'deskripsi' => 'Nasi goreng spesial dengan topping lengkap.',
                'pesan' => 'Kenyang Maksimal',
                'kandungan' => [
                    'energi_total' => 730, 'takaran_saji' => 400, 'protein' => 28, 'lemak_total' => 30,
                    'lemak_jenuh' => 10, 'karbohidrat' => 85, 'gula' => 25, 'garam_natrium' => 950, 'kafein' => 25,
                    'batas_konsumsi' => "Paket kenyang maksimal (High Protein & High Energy). Mengandung natrium tinggi.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Nasi Putih', 'takaran' => '1 porsi'],
                    ['nama_bahan' => 'Topping (Ayam, Bakso, Sosis, Udang)', 'takaran' => 'Lengkap'],
                    ['nama_bahan' => 'Es Teh', 'takaran' => '190 ml'],
                ]
            ],
            [
                'category' => 'Makanan Berat',
                'nama_menu' => 'Nasi Goreng Terasi + Es Teh',
                'harga' => 25000,
                'gambar' => 'nasgor_terasi.jpg',
                'deskripsi' => 'Nasi goreng terasi udang khas.',
                'pesan' => 'Umami',
                'kandungan' => [
                    'energi_total' => 730, 'takaran_saji' => 400, 'protein' => 28, 'lemak_total' => 30,
                    'lemak_jenuh' => 10, 'karbohidrat' => 82, 'gula' => 20, 'garam_natrium' => 1100, 'kafein' => 25,
                    'batas_konsumsi' => "Cita rasa Umami (Terasi) yang kuat. Mengandung Natrium (garam) sangat tinggi.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Nasi Putih', 'takaran' => '1 porsi'],
                    ['nama_bahan' => 'Terasi Udang', 'takaran' => 'Khas'],
                    ['nama_bahan' => 'Es Teh', 'takaran' => '190 ml'],
                ]
            ],
            [
                'category' => 'Makanan Berat',
                'nama_menu' => 'Nasi Goreng Sambel Hijau + Es Teh',
                'harga' => 25000,
                'gambar' => 'nasgor_ijo.jpg',
                'deskripsi' => 'Nasi goreng dengan sambal hijau.',
                'pesan' => 'Pedas Segar',
                'kandungan' => [
                    'energi_total' => 720, 'takaran_saji' => 400, 'protein' => 28, 'lemak_total' => 32,
                    'lemak_jenuh' => 11, 'karbohidrat' => 80, 'gula' => 18, 'garam_natrium' => 900, 'kafein' => 25,
                    'batas_konsumsi' => "Sensasi pedas segar cabai hijau. Mengenyangkan dan kaya protein.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Nasi Putih', 'takaran' => '1 porsi'],
                    ['nama_bahan' => 'Sambal Hijau', 'takaran' => 'Khas'],
                    ['nama_bahan' => 'Es Teh', 'takaran' => '190 ml'],
                ]
            ],
            [
                'category' => 'Makanan Berat',
                'nama_menu' => 'Nasi Ayam Geprek + Es Teh',
                'harga' => 15000,
                'gambar' => 'ayam_geprek.jpg',
                'deskripsi' => 'Nasi ayam geprek sambal bawang.',
                'pesan' => 'Pedas Nampol',
                'kandungan' => [
                    'energi_total' => 650, 'takaran_saji' => 350, 'protein' => 25, 'lemak_total' => 25,
                    'lemak_jenuh' => 8, 'karbohidrat' => 75, 'gula' => 18, 'garam_natrium' => 850, 'kafein' => 25,
                    'batas_konsumsi' => "Menu favorit pecinta pedas. Hati-hati bagi penderita asam lambung karena level kepedasan tinggi.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Ayam Goreng Krispi', 'takaran' => '1 potong'],
                    ['nama_bahan' => 'Sambal Bawang', 'takaran' => 'Khas'],
                    ['nama_bahan' => 'Es Teh', 'takaran' => '190 ml'],
                ]
            ],
            [
                'category' => 'Makanan Berat',
                'nama_menu' => 'Nasi Ikan Bandeng Goreng + Es Teh',
                'harga' => 20000,
                'gambar' => 'bandeng_goreng.jpg',
                'deskripsi' => 'Nasi ikan bandeng tanpa tulang.',
                'pesan' => 'Best Value',
                'kandungan' => [
                    'energi_total' => 630, 'takaran_saji' => 350, 'protein' => 28, 'lemak_total' => 22,
                    'lemak_jenuh' => 7, 'karbohidrat' => 80, 'gula' => 18, 'garam_natrium' => 800, 'kafein' => 25,
                    'batas_konsumsi' => "Menu 'Best Value'. Sumber protein ikan yang lezat tanpa repot duri. Sangat mengenyangkan.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Ikan Bandeng Tanpa Tulang', 'takaran' => '1 ekor'],
                    ['nama_bahan' => 'Nasi Putih', 'takaran' => '1 porsi'],
                    ['nama_bahan' => 'Es Teh', 'takaran' => '190 ml'],
                ]
            ],
            [
                'category' => 'Makanan Berat',
                'nama_menu' => 'Nasi Telur Dadar + Es Teh',
                'harga' => 13000,
                'gambar' => 'nasi_telur.jpg',
                'deskripsi' => 'Nasi telur dadar hemat.',
                'pesan' => 'Hemat',
                'kandungan' => [
                    'energi_total' => 430, 'takaran_saji' => 300, 'protein' => 10, 'lemak_total' => 12,
                    'lemak_jenuh' => 4, 'karbohidrat' => 70, 'gula' => 18, 'garam_natrium' => 400, 'kafein' => 25,
                    'batas_konsumsi' => "Menu hemat ramah kantong. Protein telur cukup untuk energi aktivitas ringan. Aman dikonsumsi kapan saja.",
                ],
                'bahan_baku' => [
                    ['nama_bahan' => 'Telur Dadar', 'takaran' => '1 butir'],
                    ['nama_bahan' => 'Nasi Putih', 'takaran' => '1 porsi'],
                    ['nama_bahan' => 'Es Teh', 'takaran' => '190 ml'],
                ]
            ],
        ];

        // 3. Eksekusi Insert Data
        foreach ($menusData as $data) {
            $category = $categories[$data['category']];
            
            // Simpan Menu Utama
            $menu = Daftar_menu::create([
                'nama_menu' => $data['nama_menu'],
                'category_id' => $category->id,
                'harga' => $data['harga'],
                'gambar' => $data['gambar'],
                'deskripsi' => $data['deskripsi'],
                'pesan' => $data['pesan'],
            ]);

            // Simpan Relasi (Kandungan Nutrisi)
            $menu->kandungan()->create($data['kandungan']);

            // Simpan Relasi (Bahan Baku)
            $menu->bahanBaku()->createMany($data['bahan_baku']);
        }

        // Aktifkan kembali Foreign Key Check
        Schema::enableForeignKeyConstraints();
    }
}