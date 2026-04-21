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
            $table->string('judul')->default('Profil PPID');
            $table->text('konten_pembuka')->nullable(); // Untuk Penjelasan Profil
            $table->string('gambar')->nullable(); // Foto Profil/Kantor
            
            $table->string('judul_sub')->default('Tugas & Tanggung Jawab');
            $table->text('konten_detail')->nullable(); // Untuk Tugas & Tanggung Jawab
            $table->string('gambar_sub')->nullable(); // Foto Struktur/Tugas (Opsional)
            
            $table->string('judul_visi')->default('Visi & Misi');
            $table->text('konten_visi')->nullable(); // Untuk Visi Misi (Poin-poin)
            $table->string('gambar_visi')->nullable(); // Foto Visi Misi (Opsional)
            
            // Tambahan untuk Struktur Organisasi
            $table->string('judul_struktur')->default('Struktur Organisasi');
            $table->text('konten_struktur')->nullable();
            $table->string('gambar_struktur')->nullable();

            // Tambahan untuk Regulasi & Kontak
            $table->string('judul_regulasi')->default('Regulasi');
            $table->text('konten_regulasi')->nullable(); // Berisi link/tabel regulasi
            $table->text('konten_kontak')->nullable(); // Berisi info kontak

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