<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Permohonan;

$ids = [1, 2, 3];
$count = Permohonan::whereIn('id', $ids)->delete();
echo "Deleted $count records.\n";
