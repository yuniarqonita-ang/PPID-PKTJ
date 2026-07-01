<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "=== Dokumens Table Schema ===\n";
if (Schema::hasTable('dokumens')) {
    $columns = Schema::getColumnListing('dokumens');
    print_r($columns);
    
    echo "\n=== Dokumens Records ===\n";
    $records = DB::table('dokumens')->get();
    foreach ($records as $rec) {
        echo "ID: {$rec->id}\n";
        echo "Judul: {$rec->judul}\n";
        echo "File Path: " . ($rec->file_path ?? 'NULL') . "\n";
        echo "Kategori: " . ($rec->kategori ?? 'NULL') . "\n";
        echo "Deskripsi: " . ($rec->deskripsi ?? 'NULL') . "\n";
        echo "Tanggal: " . ($rec->tanggal ?? 'NULL') . "\n";
        echo "Aktif: " . ($rec->aktif ?? 'NULL') . "\n";
        echo "Bisa Download: " . ($rec->bisa_download ?? 'NULL') . "\n";
        echo "Is Blurred: " . ($rec->is_blurred ?? 'NULL') . "\n";
        echo "--------------------------\n";
    }
} else {
    echo "Table 'dokumens' does not exist.\n";
}
