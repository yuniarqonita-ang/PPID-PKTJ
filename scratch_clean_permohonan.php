<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Permohonan;

$all = Permohonan::all(['id', 'nama_pemohon']);
echo "Total records: " . $all->count() . "\n";
foreach ($all as $p) {
    echo "ID {$p->id}: {$p->nama_pemohon}\n";
}
