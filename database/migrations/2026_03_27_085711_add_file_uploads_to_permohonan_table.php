<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->string('foto_ktp')->nullable()->after('nomor_identitas');
            $table->string('berkas_pendukung')->nullable()->after('format_informasi');
        });
    }

    public function down(): void
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->dropColumn(['foto_ktp', 'berkas_pendukung']);
        });
    }
};
