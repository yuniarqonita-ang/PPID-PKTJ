<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$user = \App\Models\User::first();
auth()->login($user);
$request = Illuminate\Http\Request::create('/admin/pesan-kontak', 'GET');
$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
if ($response->getStatusCode() == 500) {
    echo "Content:\n";
    $content = $response->getContent();
    preg_match('/<title>(.*?)<\/title>/s', $content, $matches);
    if(isset($matches[1])) echo trim($matches[1]);
}
