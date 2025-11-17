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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('order_id')->constrained(
                table: 'orders',
                indexName: 'order_items_order_id'
            );

            $table->foreignId('daftar_menu_id')->constrained(
                table: 'daftar_menus',
                indexName: 'order_items_daftar_menu_id'
            );

            $table->integer('quantity');
            $table->decimal('harga', 10, 2);
            $table->decimal('sub_total', 10, 2); // snake_case lebih konsisten
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
