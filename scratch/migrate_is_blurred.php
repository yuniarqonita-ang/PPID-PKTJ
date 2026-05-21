<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

$tables = ['informasi_berkalas', 'informasi_sertamertas', 'informasi_setiapsaats', 'informasi_dikecualikans'];
foreach ($tables as $table) {
    if (Schema::hasTable($table)) {
        if (!Schema::hasColumn($table, 'is_blurred')) {
            Schema::table($table, function (Blueprint $tableObj) {
                $tableObj->boolean('is_blurred')->default(false)->after('aktif');
            });
            echo "Added is_blurred to $table\n";
        } else {
            echo "is_blurred already exists in $table\n";
        }
    } else {
        echo "Table $table does not exist!\n";
    }
}

// Check details for informasi_dikecualikans
$dikecualikanTable = 'informasi_dikecualikans';
if (Schema::hasTable($dikecualikanTable)) {
    Schema::table($dikecualikanTable, function (Blueprint $tableObj) use ($dikecualikanTable) {
        if (!Schema::hasColumn($dikecualikanTable, 'tanggal')) {
            $tableObj->date('tanggal')->nullable()->after('deskripsi');
            echo "Added tanggal to $dikecualikanTable\n";
        }
        if (!Schema::hasColumn($dikecualikanTable, 'dasar_hukum')) {
            $tableObj->text('dasar_hukum')->nullable()->after('tanggal');
            echo "Added dasar_hukum to $dikecualikanTable\n";
        }
        if (!Schema::hasColumn($dikecualikanTable, 'konsekuensi_dibuka')) {
            $tableObj->text('konsekuensi_dibuka')->nullable()->after('dasar_hukum');
            echo "Added konsekuensi_dibuka to $dikecualikanTable\n";
        }
        if (!Schema::hasColumn($dikecualikanTable, 'konsekuensi_ditutup')) {
            $tableObj->text('konsekuensi_ditutup')->nullable()->after('konsekuensi_dibuka');
            echo "Added konsekuensi_ditutup to $dikecualikanTable\n";
        }
        if (!Schema::hasColumn($dikecualikanTable, 'jangka_waktu')) {
            $tableObj->string('jangka_waktu')->nullable()->after('konsekuensi_ditutup');
            echo "Added jangka_waktu to $dikecualikanTable\n";
        }
        if (!Schema::hasColumn($dikecualikanTable, 'penanggung_jawab')) {
            $tableObj->string('penanggung_jawab')->nullable()->after('jangka_waktu');
            echo "Added penanggung_jawab to $dikecualikanTable\n";
        }
    });
}
