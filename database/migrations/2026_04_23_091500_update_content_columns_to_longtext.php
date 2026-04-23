<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE informasi_berkalas MODIFY deskripsi LONGTEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE informasi_sertamertas MODIFY deskripsi LONGTEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE informasi_setiapsaats MODIFY deskripsi LONGTEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE informasi_dikecualikans MODIFY deskripsi LONGTEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE permohonan MODIFY deskripsi_permohonan LONGTEXT');
        
        // Keberatans fields
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE keberatans MODIFY alasan_keberatan_lainnya LONGTEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE keberatans MODIFY kasus_posisi LONGTEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE keberatans MODIFY keputusan_atasan_ppid LONGTEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE keberatans MODIFY tanggapan_pemohon LONGTEXT');
    }

    public function down(): void
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE informasi_berkalas MODIFY deskripsi TEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE informasi_sertamertas MODIFY deskripsi TEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE informasi_setiapsaats MODIFY deskripsi TEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE informasi_dikecualikans MODIFY deskripsi TEXT');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE permohonan MODIFY deskripsi_permohonan TEXT');
    }
};
