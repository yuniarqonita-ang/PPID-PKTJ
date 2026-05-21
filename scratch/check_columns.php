<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

$tables = ['informasi_berkalas', 'informasi_sertamertas', 'informasi_setiapsaats', 'informasi_dikecualikans'];
foreach ($tables as $table) {
    if (Schema::hasTable($table)) {
        $columns = Schema::getColumnListing($table);
        echo "Table: $table\n";
        echo "Columns: " . implode(', ', $columns) . "\n\n";
    } else {
        echo "Table $table does not exist.\n\n";
    }
}
