<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Edukasi;
use Carbon\Carbon;

class EdukasiSeeder extends Seeder
{
    public function run(): void
    {
        // KITA GUNAKAN STRUKTUR DARI SCREENSHOT KAMU:
        // judul, ringkasan, konten, kategori, image
        
        $edukasis = [
            [
                'judul' => 'Jangan Minum Kopi Saat Bangun Tidur!',
                'ringkasan' => 'Waktu terbaik minum kopi bukan saat baru melek.',
                'konten' => 'Ternyata jam terbaik menikmati kopi bukan saat mata baru melek. Saat bangun, hormon kortisol (hormon stres) sedang tinggi-tingginya. Waktu terbaik adalah jam 09.30 - 11.30 pagi.',
                'kategori' => 'Kesehatan',
                'image' => null, 
                'created_at' => Carbon::now(),
            ],
            [
                'judul' => 'Rahasia V60: Kenapa Kopimu Terasa Asam?',
                'ringkasan' => 'Penyebab kopi manual brew terasa kecut dan solusinya.',
                'konten' => 'Kopi asam (sour) biasanya terjadi karena "Under-extraction". Artinya air tidak sempat mengambil rasa manis dari biji kopi. Coba gunakan air mendidih (93-96 derajat Celcius) dan haluskan sedikit gilinganmu.',
                'kategori' => 'Tips Barista',
                'image' => null,
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'judul' => 'Robusta vs Arabica: Mana Jodohmu?',
                'ringkasan' => 'Perbedaan rasa, kafein, dan karakter dua kopi terpopuler.',
                'konten' => 'Arabica rasanya asam buah dan wangi bunga. Robusta rasanya pahit, "nendang", dan punya kafein 2x lipat lebih tinggi. Kamu tim penikmat rasa atau tim butuh melek?',
                'kategori' => 'Pengetahuan',
                'image' => null,
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'judul' => 'Oat Milk: Kenapa Barista Menyukainya?',
                'ringkasan' => 'Alasan susu gandum jadi primadona di kedai kopi kekinian.',
                'konten' => 'Oat milk memiliki tekstur yang paling mendekati susu sapi. Saat di-steam, ia menghasilkan foam yang tebal dan creamy, sangat cocok untuk Latte Art. Rasanya gurih dan tidak menutupi karakter asli biji kopi.',
                'kategori' => 'Tren',
                'image' => null,
                'created_at' => Carbon::now()->subDays(3),
            ],
        ];

        foreach ($edukasis as $edukasi) {
            Edukasi::create($edukasi);
        }
    }
}