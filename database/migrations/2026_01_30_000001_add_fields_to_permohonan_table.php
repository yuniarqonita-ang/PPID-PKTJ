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
        Schema::table('permohonan', function (Blueprint $table) {
            $table->string('username')->after('id')->unique();
            $table->enum('jenis_identitas', ['ktp', 'paspor', 'sim', 'lainnya'])->after('nama_pemohon')->default('ktp');
            $table->string('pekerjaan')->nullable()->after('nomor_telepon');
            $table->string('password')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropColumn(['username', 'jenis_identitas', 'pekerjaan', 'password']);
        });
    }
};
