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
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('tipe', 50); // tugas, visi, struktur, regulasi, kontak
            $table->string('judul', 255);
            $table->longText('konten'); // HTML content
            $table->string('gambar', 500)->nullable(); // untuk struktur organisasi
            $table->boolean('aktif')->default(true);
            $table->timestamps();
            
            $table->unique(['tipe']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
