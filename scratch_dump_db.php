USERNAME admin@pktj.ac.id

PASSWORDNYA admin123<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keys = \App\Models\Dashboard::where('key', 'like', 'laporan_akses%')
    ->orWhere('key', 'like', 'laporan_layanan%')
    ->orWhere('key', 'like', 'laporan_survey%')
    ->orWhere('key', 'like', 'maklumat%')
    ->get();

foreach ($keys as $k) {
    echo "KEY: " . $k->key . "\n";
    echo "VALUE: " . substr($k->value, 0, 100) . (strlen($k->value) > 100 ? "..." : "") . "\n";
    echo "-------------------\n";
}
