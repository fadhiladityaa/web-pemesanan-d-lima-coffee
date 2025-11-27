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
        Schema::create('bahan_baku_menus', function (Blueprint $table) {
            $table->id();
            // relasi ke tabel daftar_menus
            $table->foreignId('daftar_menu_id')
                ->constrained('daftar_menus')
                ->cascadeOnDelete();

            // kolom bahan baku
            $table->string('nama_bahan');   // contoh: "Espresso (12gr Robusta 100%)"
            $table->string('takaran')->nullable(); // contoh: "12 gr", "90 ml"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_baku_menus');
    }
};
