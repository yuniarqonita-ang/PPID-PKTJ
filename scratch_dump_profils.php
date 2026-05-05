<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$types = ['maklumat-pelayanan', 'laporan-akses', 'laporan-layanan', 'laporan-survey', 'sop_permintaan', 'sop_keberatan', 'sop_sengketa', 'sop_penetapan', 'sop_pengujian', 'sop_pendokumentasian'];
$profils = \App\Models\ProfilPpid::whereIn('type', $types)->get();

foreach ($profils as $p) {
    echo "TYPE: " . $p->type . "\n";
    echo "JUDUL: " . $p->judul . "\n";
    echo "PEMBUKA: " . substr(strip_tags($p->konten_pembuka), 0, 100) . "...\n";
    echo "DETAIL: " . substr(strip_tags($p->konten_detail), 0, 100) . "...\n";
    echo "GAMBARAN: " . substr(strip_tags($p->gambaran), 0, 100) . "...\n";
    echo "-------------------\n";
}
if ($profils->isEmpty()) {
    echo "No profil_ppids records found for these types.\n";
}
