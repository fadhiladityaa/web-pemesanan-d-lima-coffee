<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    // Kolom mana saja yang boleh diisi manual oleh Admin?
    protected $fillable = [
        'judul',
        'deskripsi',
        'kode_promo',
        'persentase_diskon',
        'gambar',
        'tanggal_mulai',
        'tanggal_berakhir',
        'status',
    ];

    // Mengubah format tanggal agar otomatis jadi objek Carbon (Mudah diolah)
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_berakhir' => 'date',
    ];
}