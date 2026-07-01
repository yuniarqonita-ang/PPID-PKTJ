<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Dashboard;
$val = Dashboard::where('key', 'profil_youtube_link')->first();
if ($val) {
    echo "profil_youtube_link is: '" . $val->value . "'\n";
} else {
    echo "profil_youtube_link key not found in dashboards table!\n";
}

// Let's also check all keys matching %youtube%
$all = Dashboard::where('key', 'like', '%youtube%')->get();
foreach ($all as $d) {
    echo "Key: " . $d->key . " = '" . $d->value . "'\n";
}
