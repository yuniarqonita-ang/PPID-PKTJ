<?php
// 1. Aktifkan penayangan error secara penuh
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>🛠️ DIAGNOSTIC SCRIPT - PPID PKTJ</h2>";
echo "<hr>";

// 2. Info PHP
echo "<b>1. Info PHP:</b><br>";
echo "Versi PHP: " . phpversion() . "<br>";
echo "User Server: " . get_current_user() . "<br><br>";

// 3. Cek Lokasi & Path Utama
$baseDir = '/home/ppid2026/Laravel-Core';
$publicDir = '/home/ppid2026/public_html';

echo "<b>2. Verifikasi Path Core & Permissions:</b><br>";
$paths = [
    'Laravel-Core Directory' => $baseDir,
    'vendor/autoload.php'    => $baseDir . '/vendor/autoload.php',
    'bootstrap/app.php'      => $baseDir . '/bootstrap/app.php',
    'storage directory'      => $baseDir . '/storage',
    'storage/framework'      => $baseDir . '/storage/framework',
    'storage/logs'           => $baseDir . '/storage/logs',
    '.env file'              => $baseDir . '/.env',
];

foreach ($paths as $name => $path) {
    $exists = file_exists($path) ? "✅ ADA" : "❌ TIDAK ADA";
    $readable = is_readable($path) ? "✅ BISA DIBACA" : "❌ TIDAK BISA DIBACA";
    $writable = is_writable($path) ? "✅ BISA DITULIS" : "❌ TIDAK BISA DITULIS";
    
    // Ambil permission octal jika ada
    $perms = file_exists($path) ? substr(sprintf('%o', fileperms($path)), -4) : 'N/A';
    
    echo "- <b>$name</b> ($path):<br>";
    echo "  * Status: $exists<br>";
    if (file_exists($path)) {
        echo "  * Permissions: $perms (Read: $readable, Write: $writable)<br>";
    }
    echo "<br>";
}

// 4. Test Autoloading
echo "<b>3. Menguji Loader Laravel (Autoload & App Boot):</b><br>";
try {
    $autoloadPath = $baseDir . '/vendor/autoload.php';
    if (file_exists($autoloadPath)) {
        require $autoloadPath;
        echo "✅ vendor/autoload.php berhasil di-include!<br>";
    } else {
        echo "❌ vendor/autoload.php tidak bisa di-include karena file tidak ada!<br>";
    }
    
    $appPath = $baseDir . '/bootstrap/app.php';
    if (file_exists($appPath)) {
        $app = require_once $appPath;
        echo "✅ bootstrap/app.php berhasil di-include!<br>";
        
        $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
        echo "✅ Laravel Kernel berhasil di-load!<br>";
    } else {
        echo "❌ bootstrap/app.php tidak bisa di-include karena file tidak ada!<br>";
    }
} catch (\Throwable $e) {
    echo "❌ <b>ERROR SAAT BOOTSTRAP:</b> " . $e->getMessage() . "<br>";
    echo "File: " . $e->getFile() . " (Line: " . $e->getLine() . ")<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre><br>";
}

// 5. Test Database Connection
echo "<br><b>4. Uji Koneksi Database dari .env:</b><br>";
if (file_exists($baseDir . '/.env')) {
    $envContent = file_get_contents($baseDir . '/.env');
    $lines = explode("\n", $envContent);
    $dbConfig = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $dbConfig[trim($key)] = trim(trim($value), '"\'');
        }
    }
    
    $dbHost = $dbConfig['DB_HOST'] ?? '127.0.0.1';
    $dbName = $dbConfig['DB_DATABASE'] ?? '';
    $dbUser = $dbConfig['DB_USERNAME'] ?? '';
    $dbPass = $dbConfig['DB_PASSWORD'] ?? '';
    
    echo "- DB_HOST: $dbHost<br>";
    echo "- DB_DATABASE: $dbName<br>";
    echo "- DB_USERNAME: $dbUser<br>";
    
    try {
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
        echo "✅ Koneksi database berhasil!<br>";
    } catch (\PDOException $e) {
        echo "❌ Gagal koneksi database: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ File .env tidak ditemukan, tidak bisa menguji database.<br>";
}
?>
