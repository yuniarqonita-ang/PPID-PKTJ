<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$migrations = [
    '2026_05_11_084014_add_is_blurred_to_informasi_tables',
    '2026_05_12_135000_add_details_to_informasi_dikecualikans_table'
];

foreach ($migrations as $migration) {
    $exists = DB::table('migrations')->where('migration', $migration)->exists();
    if (!$exists) {
        // Find max batch
        $maxBatch = DB::table('migrations')->max('batch') ?? 0;
        $nextBatch = $maxBatch + 1;
        DB::table('migrations')->insert([
            'migration' => $migration,
            'batch' => $nextBatch
        ]);
        echo "Inserted migration record for $migration in batch $nextBatch\n";
    } else {
        echo "Migration record for $migration already exists\n";
    }
}
