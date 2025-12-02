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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('alamat');
            $table->string('no_hp');
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
