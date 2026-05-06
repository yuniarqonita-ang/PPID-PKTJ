<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Permohonan;

$johns = Permohonan::where('nama_pemohon', 'like', '%john%')->get();
echo "Found " . $johns->count() . " records.\n";
foreach ($johns as $j) {
    echo "ID: {$j->id}, Name: {$j->nama_pemohon}\n";
    // $j->delete(); // I'll uncomment this after verification if I'm sure
}
