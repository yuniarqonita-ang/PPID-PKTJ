<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\InformasiBerkala;
use App\Models\InformasiSertaMerta;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiDikecualikan;
use App\Models\DaftarInformasi;
use App\Models\Peraturan;

echo "=== JUMLAH DATA SAAT INI ===\n";
echo "Informasi Berkala: " . (class_exists(InformasiBerkala::class) ? InformasiBerkala::count() : 0) . "\n";
echo "Informasi Serta Merta: " . (class_exists(InformasiSertaMerta::class) ? InformasiSertaMerta::count() : 0) . "\n";
echo "Informasi Setiap Saat: " . (class_exists(InformasiSetiapSaat::class) ? InformasiSetiapSaat::count() : 0) . "\n";
echo "Informasi Dikecualikan: " . (class_exists(InformasiDikecualikan::class) ? InformasiDikecualikan::count() : 0) . "\n";
echo "Daftar Informasi: " . (class_exists(DaftarInformasi::class) ? DaftarInformasi::count() : 0) . "\n";
echo "Peraturan/Regulasi: " . (class_exists(Peraturan::class) ? Peraturan::count() : 0) . "\n";

echo "\n--- Contoh 5 Data Informasi Berkala ---\n";
foreach (InformasiBerkala::take(5)->get() as $item) {
    echo "ID: {$item->id} | Judul: {$item->judul} | File: {$item->file_path}\n";
}
