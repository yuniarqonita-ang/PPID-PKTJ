<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── informasi_berkalas ──
        if (!Schema::hasColumn('informasi_berkalas', 'tanggal')) {
            DB::statement('ALTER TABLE informasi_berkalas ADD COLUMN tanggal DATE NULL AFTER deskripsi');
        }
        DB::statement('ALTER TABLE informasi_berkalas MODIFY file_path VARCHAR(500) NULL');
        DB::statement('ALTER TABLE informasi_berkalas MODIFY file_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE informasi_berkalas MODIFY file_size VARCHAR(50) NULL');
        DB::statement('ALTER TABLE informasi_berkalas MODIFY file_type VARCHAR(100) NULL');

        // ── informasi_sertamertas ──
        if (!Schema::hasColumn('informasi_sertamertas', 'tanggal')) {
            DB::statement('ALTER TABLE informasi_sertamertas ADD COLUMN tanggal DATE NULL AFTER deskripsi');
        }
        DB::statement('ALTER TABLE informasi_sertamertas MODIFY file_path VARCHAR(500) NULL');
        DB::statement('ALTER TABLE informasi_sertamertas MODIFY file_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE informasi_sertamertas MODIFY file_size VARCHAR(50) NULL');
        DB::statement('ALTER TABLE informasi_sertamertas MODIFY file_type VARCHAR(100) NULL');

        // ── informasi_setiapsaats ──
        if (!Schema::hasColumn('informasi_setiapsaats', 'tanggal')) {
            DB::statement('ALTER TABLE informasi_setiapsaats ADD COLUMN tanggal DATE NULL AFTER deskripsi');
        }
        DB::statement('ALTER TABLE informasi_setiapsaats MODIFY file_path VARCHAR(500) NULL');
        DB::statement('ALTER TABLE informasi_setiapsaats MODIFY file_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE informasi_setiapsaats MODIFY file_size VARCHAR(50) NULL');
        DB::statement('ALTER TABLE informasi_setiapsaats MODIFY file_type VARCHAR(100) NULL');

        // ── informasi_dikecualikans ──
        if (!Schema::hasColumn('informasi_dikecualikans', 'tanggal')) {
            DB::statement('ALTER TABLE informasi_dikecualikans ADD COLUMN tanggal DATE NULL AFTER deskripsi');
        }
        DB::statement('ALTER TABLE informasi_dikecualikans MODIFY file_path VARCHAR(500) NULL');
        DB::statement('ALTER TABLE informasi_dikecualikans MODIFY file_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE informasi_dikecualikans MODIFY file_size VARCHAR(50) NULL');
        DB::statement('ALTER TABLE informasi_dikecualikans MODIFY file_type VARCHAR(100) NULL');
    }

    public function down(): void
    {
        $tables = [
            'informasi_berkalas',
            'informasi_sertamertas',
            'informasi_setiapsaats',
            'informasi_dikecualikans',
        ];
        foreach ($tables as $tbl) {
            if (Schema::hasColumn($tbl, 'tanggal')) {
                DB::statement("ALTER TABLE {$tbl} DROP COLUMN tanggal");
            }
        }
    }
};
