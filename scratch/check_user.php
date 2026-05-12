<?php
use Illuminate\Support\Facades\Hash;
use App\Models\User;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = 'admin@pktj.ac.id';
$user = User::where('email', $email)->first();

if ($user) {
    echo "User exists: " . $user->name . " (" . $user->email . ")\n";
} else {
    echo "User does not exist. Creating...\n";
    User::create([
        'name' => 'Admin PPID',
        'email' => $email,
        'password' => Hash::make('admin123'),
        'email_verified_at' => now(),
    ]);
    echo "User created successfully.\n";
}
