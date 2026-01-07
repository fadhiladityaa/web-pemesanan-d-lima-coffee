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
        // SQLite safe migration: Recreate tables with correct constraints
        // MUST disable FK checks to allow dropping tables referenced by others (e.g., orders referenced by order_items)
        DB::statement('PRAGMA foreign_keys = OFF');

        try {
            // 0. Cleanup temp tables if they exist from failed runs
            Schema::dropIfExists('orders_temp');
            Schema::dropIfExists('cart_temp');

            // 1. ORDERS TABLE
            // Create temp table with new schema matching ACTUAL DB
            Schema::create('orders_temp', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                // New FK definition: Nullable and Set Null
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                
                // Columns from actual schema (tipe_pesanan REMOVED as it is missing in DB)
                $table->string('alamat');
                $table->string('no_hp');
                // $table->enum('tipe_pesanan', ['Take away', 'Dine in']); // MISSING IN DB
                $table->string('metode_pembayaran');
                $table->enum('payment_status', ['pending', 'paid', 'failed', 'canceled', 'completed'])->default('pending');
                $table->enum('order_status', [
                    'proses',
                    'siap',
                    'sedang diantar',
                    'completed',
                    'canceled',
                    'selesai',
                    'gagal'
                ])->default('proses');
                $table->decimal('total', 12, 2);
                $table->decimal('uang_dibayar', 12, 2)->nullable();
                $table->decimal('kembalian', 12, 2)->nullable();
            });

            // Insert columns that ACTUALLY EXIST
            DB::statement('INSERT INTO orders_temp (
                id, created_at, updated_at, user_id, alamat, no_hp, metode_pembayaran, payment_status, order_status, total, uang_dibayar, kembalian
            ) SELECT 
                id, created_at, updated_at, user_id, alamat, no_hp, metode_pembayaran, payment_status, order_status, total, uang_dibayar, kembalian
            FROM orders');

            // Swap tables
            Schema::drop('orders');
            Schema::rename('orders_temp', 'orders');


            // 2. CART TABLE
            Schema::create('cart_temp', function (Blueprint $table) {
                $table->id();
                // New FK definition: Cascade
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                
                $table->string('status');
                $table->timestamps();
            });

            // Cart has: id, user_id, status, created_at, updated_at (5 columns)
            DB::statement('INSERT INTO cart_temp (id, user_id, status, created_at, updated_at) SELECT id, user_id, status, created_at, updated_at FROM cart');
            
            Schema::drop('cart');
            Schema::rename('cart_temp', 'cart');
            
        } finally {
            // Re-enable FK checks
            DB::statement('PRAGMA foreign_keys = ON');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Irreversible structural change for this context
    }
};
