<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToDaftarInformasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('daftar_informasis', function (Blueprint $table) {
            $table->string('penerbit_informasi')->nullable()->after('pejabat_penguasa');
            $table->string('tempat_pembuatan')->nullable()->after('penerbit_informasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_informasis', function (Blueprint $table) {
            $table->dropColumn(['penerbit_informasi', 'tempat_pembuatan']);
        });
    }
}
