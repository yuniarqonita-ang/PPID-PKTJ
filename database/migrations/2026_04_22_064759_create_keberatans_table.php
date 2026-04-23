<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeberatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keberatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permohonan_id')->nullable();
            $table->string('nomor_registrasi_keberatan')->nullable();
            $table->date('tanggal_keberatan')->nullable();
            
            // Identitas Pemohon (Jika berbeda atau untuk kemudahan report)
            $table->string('nama_pemohon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('npwp')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->nullable();
            
            // Identitas Kuasa (Jika ada)
            $table->string('nama_kuasa')->nullable();
            $table->text('alamat_kuasa')->nullable();
            
            // Detail
            $table->text('rincian_informasi')->nullable();
            $table->text('tujuan_penggunaan')->nullable();
            
            // Alasan Keberatan (a-g) - Store as JSON or individual booleans
            // a: Penolakan atas permintaan informasi
            // b: Tidak disediakannya informasi berkala
            // c: Tidak ditanggapinya permintaan informasi
            // d: Permintaan informasi ditanggapi tidak sebagaimana yang diminta
            // e: Tidak dipenuhinya permintaan informasi
            // f: Pengenaan biaya yang tidak wajar
            // g: Penyampaian informasi yang melebihi waktu yang ditentukan
            $table->json('alasan_keberatan_list')->nullable(); 
            $table->text('alasan_keberatan_lainnya')->nullable();
            
            $table->text('kasus_posisi')->nullable();
            $table->date('tanggal_tanggapan_keberatan')->nullable();
            $table->text('keputusan_atasan_ppid')->nullable();
            $table->string('nama_atasan_ppid')->nullable();
            $table->string('posisi_atasan_ppid')->nullable();
            $table->text('tanggapan_pemohon')->nullable();
            
            $table->string('status')->default('pending'); // pending, processed, completed
            
            $table->timestamps();

            $table->foreign('permohonan_id')->references('id')->on('permohonan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keberatans');
    }
}
