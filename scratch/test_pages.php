<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

$urls = [
    '/informasi-publik/berkala',
    '/informasi-publik/serta-merta',
    '/informasi-publik/setiap-saat',
    '/informasi-publik/dikecualikan'
];

foreach ($urls as $url) {
    try {
        echo "Testing URL: $url\n";
        $request = Request::create($url, 'GET');
        $response = $app->handle($request);
        echo "Status Code: " . $response->getStatusCode() . "\n";
        if ($response->getStatusCode() >= 500) {
            echo "ERROR RESPONSE:\n";
            // Print first 500 chars of response
            echo substr($response->getContent(), 0, 1000) . "\n";
        }
    } catch (\Exception $e) {
        echo "Exception caught for URL $url:\n";
        echo $e->getMessage() . "\n";
        echo $e->getTraceAsString() . "\n";
    }
    echo "--------------------------------------------------\n";
}
