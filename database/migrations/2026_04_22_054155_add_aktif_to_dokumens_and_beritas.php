<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAktifToDokumensAndBeritas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dokumens', function (Blueprint $table) {
            if (!Schema::hasColumn('dokumens', 'aktif')) {
                $table->boolean('aktif')->default(true)->after('user_id');
            }
        });

        Schema::table('beritas', function (Blueprint $table) {
            if (!Schema::hasColumn('beritas', 'aktif')) {
                $table->boolean('aktif')->default(true)->after('is_published');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });

        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
    }
}
