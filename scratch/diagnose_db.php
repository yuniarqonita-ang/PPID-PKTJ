<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "=== DATABASE DIAGNOSTIC ===\n";

$tables = ['dokumens', 'permohonan', 'keberatans'];
foreach ($tables as $table) {
    if (Schema::hasTable($table)) {
        echo "Table: $table exists!\n";
        $columns = Schema::getColumnListing($table);
        echo "Columns: " . implode(', ', $columns) . "\n\n";
    } else {
        echo "Table: $table DOES NOT exist!\n";
    }
}

echo "=== DOKUMENS ROWS ===\n";
try {
    $rows = DB::table('dokumens')->get();
    foreach ($rows as $row) {
        echo "ID: " . $row->id . "\n";
        echo "Judul: " . $row->judul . "\n";
        echo "Kategori: " . $row->kategori . "\n";
        echo "File Path: " . var_export($row->file_path ?? null, true) . "\n";
        echo "Deskripsi: " . var_export($row->deskripsi ?? null, true) . "\n";
        if (isset($row->bisa_download)) {
            echo "Bisa Download: " . var_export($row->bisa_download, true) . "\n";
        }
        if (isset($row->tanggal)) {
            echo "Tanggal: " . var_export($row->tanggal, true) . "\n";
        }
        echo "---------------------------\n";
    }
} catch (\Exception $e) {
    echo "Error reading dokumens table: " . $e->getMessage() . "\n";
}
