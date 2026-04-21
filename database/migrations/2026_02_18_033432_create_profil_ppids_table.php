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
        Schema::create('profil_ppids', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['profil', 'tugas', 'visi', 'struktur', 'regulasi', 'kontak'])->unique();
            $table->string('judul')->nullable();
            $table->longText('konten_pembuka')->nullable();
            $table->string('judul_sub')->nullable();
            $table->longText('konten_detail')->nullable();
            $table->string('gambar')->nullable();
            $table->string('link_dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_ppids');
    }
};
