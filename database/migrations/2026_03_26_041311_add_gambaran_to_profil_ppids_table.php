<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_ppids', function (Blueprint $table) {
            $table->longText('gambaran')->nullable()->after('konten_detail');
        });
    }

    public function down(): void
    {
        Schema::table('profil_ppids', function (Blueprint $table) {
            $table->dropColumn('gambaran');
        });
    }
};
