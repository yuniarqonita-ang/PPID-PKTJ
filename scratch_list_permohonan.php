<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Permohonan;

$latest = Permohonan::latest()->take(10)->get();
echo "Latest 10 records:\n";
foreach ($latest as $l) {
    echo "ID: {$l->id}, Name: {$l->nama_pemohon}, Created: {$l->created_at}\n";
}
