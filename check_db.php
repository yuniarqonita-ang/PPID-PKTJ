<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- INFORMASI SERTA MERTA ---\n";
$items = \App\Models\InformasiSertaMerta::all();
foreach($items as $item) {
    echo "ID: {$item->id}, Judul: {$item->judul}, Path: {$item->file_path}\n";
}

echo "\n--- DASHBOARD SETTINGS ---\n";
$settings = \App\Models\Dashboard::all();
foreach($settings as $s) {
    $val = is_string($s->value) ? substr($s->value, 0, 50) : "NON-STRING";
    echo "Key: {$s->key}, Value: {$val}...\n";
}
