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

            // relasi ke table orders
            $table->foreignId('order_id')->constrained(
               table: 'order',
               indexName: 'order_items_order_id' 
            );
            $table->timestamps();

            // relasi ke table menus
            $table->foreignId('menu_id')->constrained(
                table: 'daftar_menus',
                indexName: 'order_items_menu_id'
            );

            $table->integer('quantity');
            $table->decimal('harga', 10, 2);
            $table->decimal('subTotal', 10, 2);
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
