<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            if (!Schema::hasColumn('agendas', 'lokasi')) {
                $table->string('lokasi')->nullable()->after('tanggal');
            }
            if (!Schema::hasColumn('agendas', 'waktu')) {
                $table->string('waktu')->nullable()->after('lokasi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            if (Schema::hasColumn('agendas', 'lokasi')) {
                $table->dropColumn('lokasi');
            }
            if (Schema::hasColumn('agendas', 'waktu')) {
                $table->dropColumn('waktu');
            }
        });
    }
};
