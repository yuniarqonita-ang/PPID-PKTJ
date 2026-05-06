<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = Illuminate\Support\Facades\DB::select('SHOW TABLES');
foreach ($tables as $table) {
    $name = array_values((array)$table)[0];
    $count = Illuminate\Support\Facades\DB::table($name)->count();
    echo "Table: $name - Count: $count\n";
    if ($count > 0 && $count < 10) {
        $rows = Illuminate\Support\Facades\DB::table($name)->get();
        foreach ($rows as $row) {
            foreach ((array)$row as $col => $val) {
                if (stripos((string)$val, 'john') !== false) {
                    echo "  FOUND 'john' in $name.$col: $val (ID: " . ($row->id ?? 'N/A') . ")\n";
                }
            }
        }
    }
}
