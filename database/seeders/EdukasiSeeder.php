<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Edukasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class EdukasiSeeder extends Seeder
{
    public function run(): void
    {
        // Matikan Foreign Key Check (Opsional, untuk keamanan)
        Schema::disableForeignKeyConstraints();
        Edukasi::truncate();

        $edukasis = [
            // ARTIKEL 1: Tentang Kopi Robusta (Bahan utama menu Coffee)
            [
                'judul' => 'Kenapa Robusta Bikin "Melek" Lebih Lama?',
                'ringkasan' => 'Fakta di balik tendangan kafein kopi Robusta dibanding Arabica.',
                'konten' => 'Tahukah kamu? Menu "Kopi Hitam" kami menggunakan 100% biji Robusta. Robusta memiliki kandungan kafein 2x lipat lebih tinggi (sekitar 2.2% - 2.7%) dibandingkan Arabica. Inilah sebabnya satu cangkir saja sudah cukup membuat matamu "melek" seharian. Cocok banget buat yang lagi dikejar deadline!',
                'kategori' => 'Pengetahuan Kopi',
                'image' => 'edukasi_robusta.jpg', 
                'created_at' => Carbon::now(),
            ],

            // ARTIKEL 2: Tentang Gula Aren (Bahan Kopi Susu Aren)
            [
                'judul' => 'Gula Aren vs Gula Putih: Mana Teman Kopi Terbaik?',
                'ringkasan' => 'Alasan kenapa Kopi Susu Gula Aren jadi best seller.',
                'konten' => 'Selain memberikan rasa manis yang legit dan aroma "smoky" yang khas, Gula Aren memiliki Indeks Glikemik (IG) yang sedikit lebih rendah dibanding gula pasir putih. Ini membuat lonjakan gula darah tidak se-ekstrem gula biasa, meski tetap harus dikonsumsi dalam batas wajar ya!',
                'kategori' => 'Bahan Baku',
                'image' => 'edukasi_aren.jpg',
                'created_at' => Carbon::now()->subDays(1),
            ],

            // ARTIKEL 3: Tips Kesehatan (Relevan dengan menu "Kopi Susu")
            [
                'judul' => 'Awas! Jangan Minum Kopi Saat Perut Kosong',
                'ringkasan' => 'Tips aman menikmati kopi bagi pemilik lambung sensitif.',
                'konten' => 'Kopi Robusta memiliki tingkat keasaman yang cukup kuat. Meminumnya saat perut kosong dapat memicu asam lambung naik (GERD). Kami sangat menyarankan untuk makan "Roti Bakar" atau "Nasi Goreng" terlebih dahulu sebelum menikmati segelas Kopi Susu favoritmu agar lambung tetap nyaman.',
                'kategori' => 'Kesehatan',
                'image' => 'edukasi_lambung.jpg',
                'created_at' => Carbon::now()->subDays(2),
            ],

            // ARTIKEL 4: Tentang Teh (Menu Non-Coffee)
            [
                'judul' => 'Theine: Rahasia Rileks dalam Segelas Teh',
                'ringkasan' => 'Kenapa minum teh bikin tenang, beda dengan kopi?',
                'konten' => 'Jika kopi membuatmu bersemangat, teh membuatmu rileks. Ini berkat kandungan L-Theanine (asam amino) yang menyeimbangkan efek kafein pada teh. Jadi, jika kamu sedang stres berat dan butuh ketenangan, "Teh Susu Hangat" adalah pilihan yang jauh lebih baik daripada kopi.',
                'kategori' => 'Pengetahuan',
                'image' => 'edukasi_teh.jpg',
                'created_at' => Carbon::now()->subDays(3),
            ],

            // ARTIKEL 5: Fakta Soda (Menu Mocktail)
            [
                'judul' => 'Mitos atau Fakta: Soda Susu Membersihkan Paru-paru?',
                'ringkasan' => 'Meluruskan anggapan populer tentang Soda Gembira.',
                'konten' => 'Sering dengar kalau soda susu bisa bersihkan paru-paru dari debu jalanan? Faktanya, itu MITOS. Soda masuk ke saluran pencernaan, sedangkan debu masuk ke saluran pernapasan. Namun, "Soda Gembira" memang ampuh memberikan kesegaran instan di siang yang terik karena sensasi karbonasinya!',
                'kategori' => 'Mitos & Fakta',
                'image' => 'edukasi_soda.jpg',
                'created_at' => Carbon::now()->subDays(4),
            ],

            // ARTIKEL 6: Pairing Makanan (Menu Pisang Goreng)
            [
                'judul' => 'Kenapa Kopi Pahit & Pisang Goreng Berjodoh?',
                'ringkasan' => 'Psikologi rasa di balik kombinasi kuliner legendaris.',
                'konten' => 'Dalam dunia kuliner, ini disebut "Contrast Pairing". Rasa pahit dan sepat dari Kopi Hitam Robusta akan "dibilas" oleh rasa manis dan tekstur berminyak dari Pisang Goreng. Keduanya saling melengkapi sehingga tidak membuat eneg. Cobalah celupkan pisangmu ke kopi, rasanya unik!',
                'kategori' => 'Tips Nikmat',
                'image' => 'edukasi_pairing.jpg',
                'created_at' => Carbon::now()->subDays(5),
            ],

            // ARTIKEL 7: Manfaat Rempah (Menu Sarebba/Jahe)
            [
                'judul' => 'Jahe Merah: Si Pedas Penghangat Tubuh',
                'ringkasan' => 'Manfaat menu Wedang Jahe/Sarebba saat musim hujan.',
                'konten' => 'Jahe merah mengandung Gingerol yang bersifat anti-inflamasi dan menghangatkan suhu tubuh dari dalam. Menu "Sarebba" atau "Teh Jahe" sangat direkomendasikan saat kamu merasa tidak enak badan, masuk angin, atau sekadar kedinginan di malam hari.',
                'kategori' => 'Kesehatan',
                'image' => 'edukasi_jahe.jpg',
                'created_at' => Carbon::now()->subDays(6),
            ],

            // ARTIKEL 8: Green Tea vs Matcha (Menu Es Green Tea)
            [
                'judul' => 'Thai Green Tea vs Matcha: Serupa Tapi Tak Sama',
                'ringkasan' => 'Jangan salah pesan, ini bedanya Thai Tea Hijau dan Matcha Jepang.',
                'konten' => 'Menu "Es Green Tea" kami menggunakan daun teh Thailand (Cha Tra Mue) yang diseduh, menghasilkan aroma melati yang kuat dan warna hijau terang. Berbeda dengan Matcha Jepang yang merupakan bubuk daun teh murni dengan rasa "umami" rumput laut. Kamu tim yang mana?',
                'kategori' => 'Tren',
                'image' => 'edukasi_matcha.jpg',
                'created_at' => Carbon::now()->subDays(7),
            ],

            // ARTIKEL 9: Makan Berat (Nasi Goreng)
            [
                'judul' => 'Awas "Food Coma" Setelah Makan Nasi Goreng!',
                'ringkasan' => 'Kenapa kita mengantuk setelah makan porsi besar?',
                'konten' => 'Pernah merasa sangat ngantuk setelah menghabiskan "Nasi Goreng Spesial"? Itu disebut Food Coma. Kandungan karbohidrat tinggi memicu produksi serotonin dan melatonin (hormon tidur). Tips: Imbangi dengan "Es Americano" atau "Es Lemon Tea" agar matamu kembali segar setelah makan siang.',
                'kategori' => 'Kesehatan',
                'image' => 'edukasi_foodcoma.jpg',
                'created_at' => Carbon::now()->subDays(8),
            ],

            // ARTIKEL 10: Es Batu (Umum)
            [
                'judul' => 'Kenapa Barista Peka Sekali Soal Es Batu?',
                'ringkasan' => 'Pentingnya takaran es dalam menjaga rasa minuman.',
                'konten' => 'Pernah merasa minumanmu jadi hambar karena es mencair? Es batu bukan sekadar pendingin, tapi bagian dari resep (dilution). Kami menakar es batu dengan presisi agar saat ia mencair, rasa "Es Kopi Susu" kamu tetap creamy dan tidak berubah menjadi air keran. Segera habiskan sebelum 30 menit ya!',
                'kategori' => 'Tips Barista',
                'image' => 'edukasi_esbatu.jpg',
                'created_at' => Carbon::now()->subDays(9),
            ],
        ];

        foreach ($edukasis as $edukasi) {
            Edukasi::create($edukasi);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}