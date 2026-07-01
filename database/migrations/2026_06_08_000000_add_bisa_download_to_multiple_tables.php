<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBisaDownloadToMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = [
            'dokumens',
            'informasi_berkalas',
            'informasi_sertamertas',
            'informasi_setiapsaats',
            'informasi_dikecualikans',
            'daftar_informasis'
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'bisa_download')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->boolean('bisa_download')->default(false);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = [
            'dokumens',
            'informasi_berkalas',
            'informasi_sertamertas',
            'informasi_setiapsaats',
            'informasi_dikecualikans',
            'daftar_informasis'
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'bisa_download')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('bisa_download');
                });
            }
        }
    }
}
