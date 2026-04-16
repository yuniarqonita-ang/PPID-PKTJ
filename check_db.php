<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== TABLE dashboards EXISTS: " . (Schema::hasTable('dashboards') ? 'YES' : 'NO') . "\n";
echo "=== COLUMNS: \n";
$cols = Schema::getColumnListing('dashboards');
print_r($cols);
echo "=== DATA COUNT: " . DB::table('dashboards')->count() . "\n";
echo "=== DATA: \n";
$data = DB::table('dashboards')->get();
print_r($data);
?>
