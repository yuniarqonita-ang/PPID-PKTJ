<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Dashboard;

Dashboard::updateOrCreate(['key' => 'premium_view_enabled'], ['value' => '1', 'type' => 'text', 'aktif' => true]);
echo "Premium View Enabled successfully.\n";
