<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

$table = 'informasi_dikecualikans';
if (Schema::hasTable($table)) {
    $columns = Schema::getColumnListing($table);
    echo "Columns for $table:\n";
    print_r($columns);
} else {
    echo "Table $table does not exist.\n";
}
