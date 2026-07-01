<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

$output = [];

// 1. Dokumens Table
if (Schema::hasTable('dokumens')) {
    $output['dokumens'] = DB::table('dokumens')->select('kategori', 'judul', 'file_name', 'file_path', 'aktif')->get()->toArray();
} else {
    $output['dokumens'] = 'Table dokumens does not exist.';
}

// 2. Profil PPID
if (Schema::hasTable('profil_ppids')) {
    $output['profil_ppids'] = DB::table('profil_ppids')->select('type', 'judul', 'is_blurred')->get()->toArray();
} else {
    $output['profil_ppids'] = 'Table profil_ppids does not exist.';
}

// 3. Peraturan Table
if (Schema::hasTable('peraturans')) {
    $output['peraturans'] = DB::table('peraturans')->select('kategori', 'judul', 'file_path', 'is_active')->get()->toArray();
} else {
    $output['peraturans'] = 'Table peraturans does not exist.';
}

// 4. Dashboards Table (Settings)
if (Schema::hasTable('dashboards')) {
    $output['dashboards'] = DB::table('dashboards')->where('aktif', true)->pluck('value', 'key')->toArray();
} else {
    $output['dashboards'] = 'Table dashboards does not exist.';
}

file_put_contents('inspect_db_results.json', json_encode($output, JSON_PRETTY_PRINT));
echo "DONE\n";
