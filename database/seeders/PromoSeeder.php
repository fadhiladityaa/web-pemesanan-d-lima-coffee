<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;
use App\Models\Daftar_menu;
use Carbon\Carbon;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil beberapa menu acak untuk dihubungkan ke promo
        // Pastikan tabel daftar_menus sudah ada isinya sebelum menjalankan ini!
        $menus = Daftar_menu::inRandomOrder()->limit(3)->get();

        if ($menus->isEmpty()) {
            $this->command->warn('Tabel Daftar Menu masih kosong. Harap seed menu terlebih dahulu agar relasi promo berfungsi.');
            return;
        }

        // ==========================================
        // PROMO 1: KOPI PAGI (Diskon 20%)
        // ==========================================
        $promo1 = Promo::create([
            'judul' => 'Semangat Pagi',
            'deskripsi' => 'Awali harimu dengan diskon 20% untuk varian kopi pilihan. Berlaku sampai jam 11 siang.',
            'kode_promo' => 'KOPIPAGI',
            'persentase_diskon' => 20,
            'tanggal_mulai' => Carbon::now(),
            'tanggal_berakhir' => Carbon::now()->addDays(30),
            'status' => 'aktif',
            // Pastikan file gambar ini ada di storage, atau biarkan null jika ingin pakai placeholder
            'gambar' => null, 
        ]);

        // Hubungkan promo ini ke menu pertama yang kita ambil tadi
        // Ini yang membuat fitur SCROLL OTOMATIS bekerja
        $promo1->menus()->attach($menus[0]->id);


        // ==========================================
        // PROMO 2: HEMAT AKHIR BULAN (Diskon 50%)
        // ==========================================
        $promo2 = Promo::create([
            'judul' => 'Hemat Akhir Bulan',
            'deskripsi' => 'Dompet menipis? Tenang, D\'Lima punya solusi diskon setengah harga!',
            'kode_promo' => 'GAJIAN',
            'persentase_diskon' => 50,
            'tanggal_mulai' => Carbon::now(),
            'tanggal_berakhir' => Carbon::now()->addDays(7),
            'status' => 'aktif',
            'gambar' => null,
        ]);

        // Hubungkan promo ini ke menu kedua
        // Jika menu kedua tersedia, pasang relasinya
        if (isset($menus[1])) {
            $promo2->menus()->attach($menus[1]->id);
        }


        // ==========================================
        // PROMO 3: PAKET NONGKRONG (Diskon 10%)
        // ==========================================
        $promo3 = Promo::create([
            'judul' => 'Paket Nongkrong',
            'deskripsi' => 'Ajak temanmu nongkrong asik dengan potongan harga spesial.',
            'kode_promo' => 'NONGKI',
            'persentase_diskon' => 10,
            'tanggal_mulai' => Carbon::now()->subDays(1), // Sudah mulai kemarin
            'tanggal_berakhir' => Carbon::now()->addMonths(1),
            'status' => 'aktif',
            'gambar' => null,
        ]);

        // Hubungkan promo ini ke menu ketiga
        if (isset($menus[2])) {
            $promo3->menus()->attach($menus[2]->id);
        }
    }
}