<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$keys = \App\Models\Dashboard::where('key', 'like', 'sop_%')
    ->orWhere('key', 'like', 'prosedur_%')
    ->get();

$prefixes = [];
foreach ($keys as $k) {
    // Get prefix (everything before the first underscore of the actual field name)
    // Actually, our prefixes are like sop_permintaan, sop_keberatan, etc.
    // Let's just collect all keys and see the patterns.
    echo "KEY: " . $k->key . "\n";
}
