<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Update password untuk admin@pktj.ac.id
$user = \App\Models\User::where('email', 'admin@pktj.ac.id')->first();
if ($user) {
    $user->password = \Hash::make('admin123');
    $user->save();
    echo "Password updated successfully for admin@pktj.ac.id\n";
} else {
    echo "User not found\n";
}

// Check all users
$users = \App\Models\User::all();
echo "All users:\n";
foreach ($users as $u) {
    echo "- ID: {$u->id}, Email: {$u->email}, Name: {$u->name}\n";
}
?>
