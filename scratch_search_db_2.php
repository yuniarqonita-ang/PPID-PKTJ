<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keys = \App\Models\Dashboard::where('value', 'like', '%Waktu Pelayanan%')
    ->orWhere('value', 'like', '%Dasar Hukum%')
    ->orWhere('value', 'like', '%Maklumat Pelayanan%')
    ->get();

foreach ($keys as $k) {
    echo "KEY: " . $k->key . "\n";
    echo "VALUE: " . substr($k->value, 0, 200) . "...\n";
    echo "-------------------\n";
}
