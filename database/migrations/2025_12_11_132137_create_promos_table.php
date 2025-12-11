<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id(); // ID Unik (Otomatis)
            
            // --- KOLOM YANG KITA TAMBAHKAN ---
            $table->string('judul');                // Nama Promo
            $table->text('deskripsi')->nullable();  // Penjelasan (Boleh kosong)
            $table->string('kode_promo')->unique(); // Kode Voucher (Harus beda satu sama lain)
            $table->integer('persentase_diskon');   // Besar diskon (misal: 10, 20, 50)
            $table->string('gambar')->nullable();   // Link foto banner (Boleh kosong)
            
            $table->date('tanggal_mulai');          // Kapan promo dimulai
            $table->date('tanggal_berakhir');       // Kapan promo berakhir
            
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif'); // Status on/off
            // ---------------------------------

            $table->timestamps(); // Created_at & Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};