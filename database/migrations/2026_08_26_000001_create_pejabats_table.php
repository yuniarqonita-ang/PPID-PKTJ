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
        if (!Schema::hasTable('pejabats')) {
            Schema::create('pejabats', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('nip')->nullable();
                $table->string('jabatan');
                $table->string('tempat_tanggal_lahir')->nullable();
                $table->string('foto')->nullable();
                $table->integer('foto_width')->nullable()->default(160);
                $table->integer('foto_height')->nullable()->default(240);
                $table->integer('foto_card_height')->nullable()->default(390);
                $table->string('foto_position')->nullable()->default('top center');
                $table->string('foto_radius')->nullable()->default('14px');
                $table->text('biografi')->nullable();
                $table->json('pendidikan')->nullable();
                $table->json('riwayat_jabatan')->nullable();
                $table->json('penghargaan')->nullable();
                $table->string('lhkpn_link')->nullable();
                $table->string('lhkpn_file')->nullable();
                $table->string('lhkpn_tahun')->nullable()->default('2025/2026');
                $table->integer('urutan')->default(0);
                $table->boolean('aktif')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabats');
    }
};
