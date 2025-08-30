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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'orders_user_id'
            );
            $table->decimal('harga', 12, 2);
            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'canceled',
                'completed'
            ])->default('pending');
            $table->enum('order_status', [
                'proses',
                'siap',
                'sedang diantar',
                'completed',
                'canceled'
            ])->default('proses');
            $table->string('metode_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
