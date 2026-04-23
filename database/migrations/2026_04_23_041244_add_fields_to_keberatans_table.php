<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToKeberatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keberatans', function (Blueprint $table) {
            $table->string('nomor_telepon_kuasa')->nullable()->after('alamat_kuasa');
            $table->string('file_ktp')->nullable()->after('nomor_telepon_kuasa');
            $table->string('file_surat_kuasa')->nullable()->after('file_ktp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keberatans', function (Blueprint $table) {
            $table->dropColumn([
                'nomor_telepon_kuasa',
                'file_ktp',
                'file_surat_kuasa'
            ]);
        });
    }
}
