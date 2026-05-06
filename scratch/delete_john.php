<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Permohonan;

$deleted = Permohonan::where('nama_pemohon', 'like', '%John%')->delete();
echo "Deleted $deleted records.";
