<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegisterFieldsToPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->string('npwp')->nullable()->after('pekerjaan');
            $table->boolean('status_informasi_dikuasai')->default(true)->after('deskripsi_permohonan');
            $table->boolean('status_informasi_belum_didokumentasikan')->default(false)->after('status_informasi_dikuasai');
            $table->string('bentuk_informasi_salinan')->nullable()->after('status_informasi_belum_didokumentasikan'); // Softcopy, Hardcopy
            $table->string('jenis_permohonan_salinan')->nullable()->after('bentuk_informasi_salinan'); // Melihat, Meminta Salinan
            $table->text('alasan_penolakan_text')->nullable()->after('status');
            $table->string('penolakan_pasal_uu')->nullable()->after('alasan_penolakan_text'); // Untuk SK Penolakan
            $table->date('tanggal_pemberitahuan_tertulis')->nullable()->after('penolakan_pasal_uu');
            $table->date('tanggal_pemberian_informasi')->nullable()->after('tanggal_pemberitahuan_tertulis');
            $table->decimal('biaya_salinan', 15, 2)->default(0)->after('tanggal_pemberian_informasi');
            $table->string('cara_pembayaran')->nullable()->after('biaya_salinan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permohonan', function (Blueprint $table) {
            //
        });
    }
}
