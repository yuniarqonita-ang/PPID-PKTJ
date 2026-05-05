<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keys = \App\Models\Dashboard::where('key', 'like', 'maklumat%')->get();

foreach ($keys as $k) {
    echo "KEY: " . $k->key . " | VALUE: " . $k->value . "\n";
}
if ($keys->isEmpty()) {
    echo "Nothing found.\n";
}
