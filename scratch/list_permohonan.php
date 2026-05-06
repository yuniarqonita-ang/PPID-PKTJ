<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Permohonan;

$items = Permohonan::latest()->get();
foreach($items as $i) {
    echo "ID: " . $i->id . " | Nama: " . $i->nama_pemohon . "\n";
}
