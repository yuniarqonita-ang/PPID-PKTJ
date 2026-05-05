<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$count = \App\Models\Prosedur::count();
echo "Total Prosedur records: " . $count . "\n";

$prosedurs = \App\Models\Prosedur::all();
foreach ($prosedurs as $p) {
    echo "- " . $p->judul . " (Kategori: " . $p->kategori . ")\n";
}
