<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;
use App\Models\Daftar_menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        // Matikan Foreign Key Check untuk reset data
        Schema::disableForeignKeyConstraints();
        Promo::truncate();
        // Hapus data di tabel pivot menu_promo juga
        DB::table('menu_promo')->truncate(); 

        // 1. Ambil ID Menu dari Database untuk Relasi
        $menuKopiSusu     = Daftar_menu::where('nama_menu', 'Kopi Susu')->first();
        $menuNasgor       = Daftar_menu::where('nama_menu', 'Nasi Goreng Spesial + Es Teh')->first();
        $menuPisangGoreng = Daftar_menu::where('nama_menu', 'Pisang Goreng')->first();
        $menuSodaGembira  = Daftar_menu::where('nama_menu', 'Soda Gembira')->first();
        $menuUbiGoreng    = Daftar_menu::where('nama_menu', 'Ubi Goreng')->first();
        $menuKopiAren     = Daftar_menu::where('nama_menu', 'Es Kopi Susu Gula Aren')->first();

        // ==================== PROMO 1: SARAPAN HEMAT ====================
        $promo1 = Promo::create([
            'judul'             => 'Morning Booster',
            'deskripsi'         => 'Awali harimu dengan segelas Kopi Susu hangat dan Pisang Goreng renyah.',
            'persentase_diskon' => 20,
            'tanggal_mulai'     => Carbon::now(),
            'tanggal_berakhir'  => Carbon::now()->addMonths(1),
            'status'            => 'aktif',
            'gambar'            => 'promo_morning.jpg',
        ]);

        if ($menuKopiSusu && $menuPisangGoreng) {
            $promo1->menus()->attach([$menuKopiSusu->id, $menuPisangGoreng->id]);
        }

        // ==================== PROMO 2: MAKAN KENYANG ====================
        $promo2 = Promo::create([
            'judul'             => 'Paket Kenyang Puas',
            'deskripsi'         => 'Makan siang hemat! Nasi Goreng Spesial sudah termasuk Es Teh jumbo.',
            'persentase_diskon' => 15,
            'tanggal_mulai'     => Carbon::now(),
            'tanggal_berakhir'  => Carbon::now()->addMonths(1),
            'status'            => 'aktif',
            'gambar'            => 'promo_lunch.jpg',
        ]);

        if ($menuNasgor) {
            $promo2->menus()->attach([$menuNasgor->id]);
        }

        // ==================== PROMO 3: NON-COFFEE CHILL ====================
        $promo3 = Promo::create([
            'judul'             => 'Segar Sore Ceria',
            'deskripsi'         => 'Nikmati sore santai dengan Soda Gembira dan Ubi Goreng.',
            'persentase_diskon' => 10,
            'tanggal_mulai'     => Carbon::now(),
            'tanggal_berakhir'  => Carbon::now()->addWeeks(2),
            'status'            => 'aktif',
            'gambar'            => 'promo_chill.jpg',
        ]);

        if ($menuSodaGembira && $menuUbiGoreng) {
            $promo3->menus()->attach([$menuSodaGembira->id, $menuUbiGoreng->id]);
        }

        // ==================== PROMO 4: BEST SELLER ====================
        $promo4 = Promo::create([
            'judul'             => 'Flash Sale Gula Aren',
            'deskripsi'         => 'Diskon spesial untuk menu favorit Es Kopi Susu Gula Aren.',
            'persentase_diskon' => 25,
            'tanggal_mulai'     => Carbon::now(),
            'tanggal_berakhir'  => Carbon::now()->addDays(7),
            'status'            => 'aktif',
            'gambar'            => 'promo_aren.jpg',
        ]);

        if ($menuKopiAren) {
            $promo4->menus()->attach([$menuKopiAren->id]);
        }

        Schema::enableForeignKeyConstraints();
    }
}