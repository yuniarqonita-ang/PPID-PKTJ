<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

try {
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    echo "Kernel created successfully\n";
    
    $status = $kernel->handle(
        $input = new Symfony\Component\Console\Input\ArgvInput(['artisan', 'list']),
        new Symfony\Component\Console\Output\ConsoleOutput()
    );
    
    echo "Artisan executed with status: $status\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}
?>
