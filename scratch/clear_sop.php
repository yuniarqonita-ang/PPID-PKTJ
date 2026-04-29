<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$deleted = DB::table('dashboards')
    ->where('key', 'like', 'sop_permintaan%')
    ->orWhere('key', 'like', 'sop-permintaan%')
    ->delete();

echo "Deleted $deleted records from dashboards table.";
