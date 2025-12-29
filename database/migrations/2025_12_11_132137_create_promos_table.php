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
            $table->id();
            // Pastikan nama kolom ini 'judul', bukan 'title' atau 'name'
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->integer('persentase_diskon');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->string('status')->default('aktif'); // aktif / tidak_aktif
            $table->string('gambar')->nullable();
            $table->timestamps();
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
