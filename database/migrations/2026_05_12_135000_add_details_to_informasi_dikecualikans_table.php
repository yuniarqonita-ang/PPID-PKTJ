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
        Schema::table('informasi_dikecualikans', function (Blueprint $table) {
            if (!Schema::hasColumn('informasi_dikecualikans', 'tanggal')) {
                $table->date('tanggal')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('informasi_dikecualikans', 'is_blurred')) {
                $table->boolean('is_blurred')->default(false)->after('aktif');
            }
            if (!Schema::hasColumn('informasi_dikecualikans', 'dasar_hukum')) {
                $table->text('dasar_hukum')->nullable()->after('tanggal');
            }
            if (!Schema::hasColumn('informasi_dikecualikans', 'konsekuensi_dibuka')) {
                $table->text('konsekuensi_dibuka')->nullable()->after('dasar_hukum');
            }
            if (!Schema::hasColumn('informasi_dikecualikans', 'konsekuensi_ditutup')) {
                $table->text('konsekuensi_ditutup')->nullable()->after('konsekuensi_dibuka');
            }
            if (!Schema::hasColumn('informasi_dikecualikans', 'jangka_waktu')) {
                $table->string('jangka_waktu')->nullable()->after('konsekuensi_ditutup');
            }
            if (!Schema::hasColumn('informasi_dikecualikans', 'penanggung_jawab')) {
                $table->string('penanggung_jawab')->nullable()->after('jangka_waktu');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi_dikecualikans', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal',
                'is_blurred',
                'dasar_hukum',
                'konsekuensi_dibuka',
                'konsekuensi_ditutup',
                'jangka_waktu',
                'penanggung_jawab'
            ]);
        });
    }
};
