<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportingFieldsToPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->timestamp('tanggal_selesai')->nullable()->after('tanggal_permohonan');
            $table->enum('kategori_laporan', ['berkala', 'sertamerta', 'setiapsaat', 'dikecualikan'])->nullable()->after('tanggal_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->dropColumn(['tanggal_selesai', 'kategori_laporan']);
        });
    }
}
