<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsBlurredToDaftarInformasisAndDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftar_informasis', function (Blueprint $table) {
            $table->boolean('is_blurred')->default(false)->after('aktif');
        });

        Schema::table('dokumens', function (Blueprint $table) {
            $table->boolean('is_blurred')->default(false)->after('file_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_informasis', function (Blueprint $table) {
            $table->dropColumn('is_blurred');
        });

        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropColumn('is_blurred');
        });
    }
}
