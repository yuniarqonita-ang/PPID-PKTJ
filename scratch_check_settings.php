<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Dashboard;

$settings = Dashboard::where('key', 'like', 'maklumat_pelayanan_%')->pluck('value', 'key')->toArray();
print_r($settings);
