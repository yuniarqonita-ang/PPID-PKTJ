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
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->string('sumber_informasi', 50)->default('website'); // 'website' or 'sosial_media'
            $table->string('nomor_registrasi')->nullable();
            $table->string('nama')->nullable();
            $table->string('usia', 50)->nullable(); // '< 20 Tahun', '21-30 Tahun', '31-40 Tahun', '> 41 Tahun'
            $table->string('kemudahan_prosedur', 50)->nullable(); // 'Sangat Mudah', 'Mudah', 'Kurang Mudah', 'Tidak Mudah'
            $table->string('kesesuaian_jawaban', 50)->nullable(); // 'Sangat Sesuai', 'Sesuai', 'Kurang Sesuai', 'Tidak Sesuai'
            $table->text('informasi_diterima')->nullable();
            $table->string('ui_ux', 100)->nullable(); // 'Sangat menarik dan sangat mudah dipahami', 'Menarik dan mudah dipahami', etc.
            $table->integer('rating')->default(5); // 1 - 5
            $table->text('saran_masukan')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
