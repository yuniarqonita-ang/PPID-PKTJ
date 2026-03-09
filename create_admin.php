<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create admin user
$user = new \App\Models\User();
$user->name = 'Admin PPID';
$user->email = 'admin@pktj.ac.id';
$user->password = \Hash::make('admin123');
$user->save();

echo "Admin user created successfully!\n";
echo "Email: admin@pktj.ac.id\n";
echo "Password: admin123\n";
?>
