<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daftar_informasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul_informasi');
            $table->string('kategori')->nullable();
            $table->string('tipe_informasi')->nullable();
            $table->longText('isi_informasi')->nullable();
            $table->string('pejabat_penguasa')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('waktu_pembuatan')->nullable();
            $table->string('bentuk_informasi')->nullable();
            $table->string('jangka_waktu')->nullable();
            $table->string('file_informasi')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_informasis');
    }
};
