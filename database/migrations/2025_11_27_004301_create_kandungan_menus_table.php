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
        Schema::create('kandungan_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daftar_menu_id')->constrained('daftar_menus')->cascadeOnDelete();
            $table->integer('energi_total')->nullable();
            $table->integer('takaran_saji')->nullable();
            $table->decimal('protein', 5, 2)->nullable();
            $table->decimal('lemak_total', 5, 2)->nullable();
            $table->decimal('lemak_jenuh', 5, 2)->nullable();
            $table->decimal('karbohidrat', 5, 2)->nullable();
            $table->decimal('gula', 5, 2)->nullable();
            $table->integer('garam_natrium')->nullable();
            $table->integer('kafein')->nullable();
            $table->text('batas_konsumsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kandungan_menus');
    }
};
