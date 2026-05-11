<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsBlurredToMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profil_ppids', function (Blueprint $table) {
            $table->boolean('is_blurred')->default(false)->after('gambaran');
        });
        Schema::table('faqs', function (Blueprint $table) {
            $table->boolean('is_blurred')->default(false)->after('aktif');
        });
        Schema::table('agendas', function (Blueprint $table) {
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
        Schema::table('profil_ppids', function (Blueprint $table) {
            $table->dropColumn('is_blurred');
        });
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('is_blurred');
        });
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn('is_blurred');
        });
    }
}
