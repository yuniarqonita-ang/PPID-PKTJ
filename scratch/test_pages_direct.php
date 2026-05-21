<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\InformasiPublikController;

$controller = new InformasiPublikController();

try {
    echo "Calling informasiBerkala()...\n";
    $view = $controller->informasiBerkala();
    $html = $view->render();
    echo "Rendered informasiBerkala successfully!\n";
} catch (\Exception $e) {
    echo "Exception in informasiBerkala:\n";
    echo $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n";
}

try {
    echo "Calling informasiSertamerta()...\n";
    $view = $controller->informasiSertamerta();
    $html = $view->render();
    echo "Rendered informasiSertamerta successfully!\n";
} catch (\Exception $e) {
    echo "Exception in informasiSertamerta:\n";
    echo $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n";
}

try {
    echo "Calling informasiSetiapsaat()...\n";
    $view = $controller->informasiSetiapsaat();
    $html = $view->render();
    echo "Rendered informasiSetiapsaat successfully!\n";
} catch (\Exception $e) {
    echo "Exception in informasiSetiapsaat:\n";
    echo $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n";
}

try {
    echo "Calling informasiDikecualikan()...\n";
    $view = $controller->informasiDikecualikan(request());
    $html = $view->render();
    echo "Rendered informasiDikecualikan successfully!\n";
} catch (\Exception $e) {
    echo "Exception in informasiDikecualikan:\n";
    echo $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n";
}
