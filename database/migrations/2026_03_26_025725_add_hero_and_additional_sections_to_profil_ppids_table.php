<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profil_ppids', function (Blueprint $table) {
            if (!Schema::hasColumn('profil_ppids', 'tagline_hero')) {
                $table->string('tagline_hero')->nullable()->after('judul');
            }
            if (!Schema::hasColumn('profil_ppids', 'image_hero')) {
                $table->string('image_hero')->nullable()->after('tagline_hero');
            }
            if (!Schema::hasColumn('profil_ppids', 'additional_sections')) {
                $table->longText('additional_sections')->nullable()->after('link_dokumen');
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
        Schema::table('profil_ppids', function (Blueprint $table) {
            $table->dropColumn(['tagline_hero', 'image_hero', 'additional_sections']);
        });
    }
};
