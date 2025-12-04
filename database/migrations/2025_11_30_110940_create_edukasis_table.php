<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('edukasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('konten');
            
            // Kolom tambahan untuk fitur lengkap
            $table->string('kategori')->nullable();
            $table->text('ringkasan')->nullable();
            $table->string('image')->nullable();
            
            // Untuk fitur video/interaktif
            // $table->string('video_url')->nullable();
            // $table->string('secondary_image')->nullable();
            // $table->enum('content_type', ['article', 'video', 'mixed'])->default('article');
            // $table->boolean('has_parallax')->default(false);
            // $table->string('parallax_intensity')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('edukasis');
    }
};