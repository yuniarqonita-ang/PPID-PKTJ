<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$prefixes = [
    'maklumat_pelayanan',
    'laporan_akses',
    'laporan_layanan',
    'laporan_survey',
    'sop_permintaan',
    'sop_keberatan',
    'sop_sengketa',
    'sop_pengujian',
    'sop_pendokumentasian',
    'sop_penetapan'
];

foreach ($prefixes as $pfx) {
    $exists = \App\Models\Dashboard::where('key', 'like', $pfx . '%')->exists();
    echo "PREFIX: " . str_pad($pfx, 25) . " | EXISTS IN DB: " . ($exists ? 'YES' : 'NO') . "\n";
}
