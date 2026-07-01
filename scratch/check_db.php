<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$dokumens = \App\Models\Dokumen::all();
foreach ($dokumens as $dok) {
    echo "ID: " . $dok->id . "\n";
    echo "Judul: " . $dok->judul . "\n";
    echo "Kategori: " . $dok->kategori . "\n";
    echo "Deskripsi: " . var_export($dok->deskripsi, true) . "\n";
    echo "Aktif: " . ($dok->aktif ? 'Ya' : 'Tidak') . "\n";
    echo "---------------------------\n";
}
