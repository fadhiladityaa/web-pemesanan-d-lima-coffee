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
        Schema::create('menu_details', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('daftar_menu_id');
            $table->string('bahan_baku')->nullable();
            $table->integer('energi_total')->nullable(); // kkal
            $table->decimal('protein', 5, 2)->nullable(); // gram
            $table->decimal('lemak_total', 5, 2)->nullable(); // gram
            $table->decimal('lemak_jenuh', 5, 2)->nullable(); // gram
            $table->decimal('karbohidrat', 5, 2)->nullable(); // gram
            $table->decimal('gula', 5, 2)->nullable(); // gram
            $table->integer('garam_natrium')->nullable(); // mg
            $table->integer('kafein')->nullable(); // mg
            $table->text('batas_konsumsi')->nullable();
            $table->timestamps();
            
            // Relasi ke menus
            $table->foreign('daftar_menu_id')->references('id')->on('daftar_menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_details');
    }
};
