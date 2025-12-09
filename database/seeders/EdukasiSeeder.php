<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Edukasi;

class EdukasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $edukasis = [
            [
                'judul' => 'Manfaat Kopi untuk Kesehatan',
                'konten' => 'Kopi mengandung antioksidan yang baik untuk kesehatan...',
                'kategori' => 'Kesehatan',
                'ringkasan' => 'Temukan manfaat kesehatan dari minum kopi secara rutin',
                'image' => null,
                'content_type' => 'article',
            ],
            // Tambahkan data dummy lainnya
        ];
         foreach ($edukasis as $edukasi) {
            Edukasi::create($edukasi);
         }
    }
}
