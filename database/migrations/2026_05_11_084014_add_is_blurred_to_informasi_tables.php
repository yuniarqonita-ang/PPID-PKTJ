<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsBlurredToInformasiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informasi_berkalas', function (Blueprint $table) {
            $table->boolean('is_blurred')->default(false)->after('aktif');
        });
        Schema::table('informasi_sertamertas', function (Blueprint $table) {
            $table->boolean('is_blurred')->default(false)->after('aktif');
        });
        Schema::table('informasi_setiapsaats', function (Blueprint $table) {
            $table->boolean('is_blurred')->default(false)->after('aktif');
        });
        Schema::table('informasi_dikecualikans', function (Blueprint $table) {
            $table->boolean('is_blurred')->default(false)->after('aktif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('informasi_berkalas', function (Blueprint $table) {
            $table->dropColumn('is_blurred');
        });
        Schema::table('informasi_sertamertas', function (Blueprint $table) {
            $table->dropColumn('is_blurred');
        });
        Schema::table('informasi_setiapsaats', function (Blueprint $table) {
            $table->dropColumn('is_blurred');
        });
        Schema::table('informasi_dikecualikans', function (Blueprint $table) {
            $table->dropColumn('is_blurred');
        });
    }
}
