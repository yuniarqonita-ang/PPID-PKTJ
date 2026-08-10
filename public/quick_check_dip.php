<?php
header('Content-Type: text/plain');
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=db_ppid_final", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get top 20 items ordered by COALESCE(waktu_pembuatan, '0') DESC, id ASC
    $stmt = $pdo->query("SELECT id, judul_informasi, waktu_pembuatan FROM daftar_informasis WHERE aktif = 1 ORDER BY COALESCE(waktu_pembuatan, '0') DESC, id ASC LIMIT 25");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($items as $item) {
        echo "ID: {$item['id']} | Year: '{$item['waktu_pembuatan']}' | Title: {$item['judul_informasi']}\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
