<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$rows = \Illuminate\Support\Facades\DB::table('dashboards')
    ->where('key', 'like', '%hero%')
    ->get();

if ($rows->isEmpty()) {
    echo "TIDAK ADA hero keys di database!\n";
} else {
    foreach ($rows as $r) {
        echo "Key: " . $r->key . " | Value: " . substr($r->value, 0, 80) . "\n";
    }
}
