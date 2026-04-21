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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('email');
            $table->string('nomor_identitas');
            $table->text('alamat');
            $table->string('perusahaan_instansi')->nullable();
            $table->string('nomor_telepon');
            $table->string('jenis_informasi');
            $table->text('deskripsi_permohonan');
            $table->string('format_informasi')->default('digital');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->timestamp('tanggal_permohonan')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};
