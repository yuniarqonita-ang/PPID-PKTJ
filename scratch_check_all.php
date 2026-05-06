<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- PERMOHONAN ---\n";
foreach (\App\Models\Permohonan::all(['id', 'nama_pemohon']) as $p) {
    echo "ID {$p->id}: {$p->nama_pemohon}\n";
}

echo "\n--- KEBERATAN ---\n";
foreach (\App\Models\Keberatan::all(['id', 'nama_pemohon']) as $k) {
    echo "ID {$k->id}: {$k->nama_pemohon}\n";
}

echo "\n--- ALL MAKLUMAT KEYS ---\n";
foreach (\App\Models\Dashboard::where('key', 'like', 'maklumat_pelayanan_%')->get() as $d) {
    echo "Key: {$d->key} - Value: {$d->value}\n";
}
