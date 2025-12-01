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
        Schema::create('daftar_menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu')->unique;
            $table->integer('harga');
            $table->string('gambar')->nullable();
            $table->text('deskripsi');
            $table->foreignId('small_warning_id')->constrained(
                table: 'small_warnings',
                indexName: 'warning_menu_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_menus');
    }
};
