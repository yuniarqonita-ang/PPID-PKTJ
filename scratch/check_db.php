<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "Permohonan columns:\n";
print_r(Schema::getColumnListing('permohonan'));

echo "\nKeberatans columns:\n";
print_r(Schema::getColumnListing('keberatans'));
