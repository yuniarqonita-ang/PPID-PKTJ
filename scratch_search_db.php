<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keys = \App\Models\Dashboard::where('value', 'like', '%45,678%')
    ->orWhere('value', 'like', '%Statistik Akses%')
    ->orWhere('value', 'like', '%Kanal Akses%')
    ->get();

foreach ($keys as $k) {
    echo "KEY: " . $k->key . "\n";
    echo "VALUE: " . substr($k->value, 0, 500) . "\n";
    echo "-------------------\n";
}
if ($keys->isEmpty()) {
    echo "Nothing found in DB.\n";
}
