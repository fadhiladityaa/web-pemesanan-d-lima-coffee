<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix for cart_items blocking deletion of cart
        
        DB::statement('PRAGMA foreign_keys = OFF');

        Schema::create('cart_items_temp', function (Blueprint $table) {
            $table->id();
            // Upstream migration (2025_09_06_074728) had a foreign key to cart. We need to MATCH foreign keys.
            // We want cart_items to disappear if cart disappears.
            $table->foreignId('cart_id')->constrained('cart')->cascadeOnDelete();
            
            $table->foreignId('daftar_menu_id')->constrained('daftar_menus');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 12, 2); // Check schema for precision, 12,2 is safe default based on orders
            $table->timestamps();
        });

        // Need to inspect columns exact type?
        // inspect_children showed: "price" numeric not null.
        // Let's copy data.
        DB::statement('INSERT INTO cart_items_temp SELECT * FROM cart_items');

        Schema::drop('cart_items');
        Schema::rename('cart_items_temp', 'cart_items');
        
        DB::statement('PRAGMA foreign_keys = ON');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Irreversible
    }
};
