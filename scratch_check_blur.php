<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Dashboard;
use App\Models\DaftarInformasi;

$settings = Dashboard::pluck('value', 'key')->toArray();
echo "Premium View Enabled: " . ($settings['premium_view_enabled'] ?? 'NULL') . "\n";

$file = 'storage/daftar-informasi/1778038630_5377-12883-1-SM.pdf';
$di = DaftarInformasi::where('file_informasi', $file)->first();
if ($di) {
    echo "Daftar Informasi found! is_blurred: " . ($di->is_blurred ? 'YES' : 'NO') . "\n";
} else {
    echo "Daftar Informasi NOT found for path: $file\n";
    // Let's see some samples
    echo "Sample paths in DB:\n";
    foreach(DaftarInformasi::limit(3)->get() as $item) {
        echo "- " . $item->file_informasi . "\n";
    }
}
