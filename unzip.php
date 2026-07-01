<?php
// Script Unzip & Clear Cache Otomatis untuk PPID PKTJ
$zipFile = __DIR__ . '/../Laravel-Core/update.zip';
if (!file_exists($zipFile)) {
    // Coba path alternatif jika ditaruh di folder yang sama
    $zipFile = __DIR__ . '/update.zip';
}

$extractTo = dirname($zipFile) . '/';

if (!file_exists($zipFile)) {
    echo "<h3 style='font-family: sans-serif; color: red;'>Error: File update.zip tidak ditemukan!</h3>";
    echo "<p style='font-family: sans-serif;'>Pastikan file <b>update.zip</b> sudah diupload ke folder <b>Laravel-Core</b>.</p>";
    echo "<p style='font-family: sans-serif; font-size: 12px; color: gray;'>Lokasi pencarian: " . $zipFile . "</p>";
    exit;
}

$zip = new ZipArchive;
if ($zip->open($zipFile) === TRUE) {
    // 1. Ekstrak ZIP
    $zip->extractTo($extractTo);
    $zip->close();
    
    // 2. Bersihkan Laravel View Cache secara otomatis
    $viewsDir = dirname($zipFile) . '/storage/framework/views/';
    $cacheCount = 0;
    if (is_dir($viewsDir)) {
        $files = glob($viewsDir . '*');
        foreach ($files as $file) {
            if (is_file($file) && basename($file) !== '.gitignore') {
                unlink($file);
                $cacheCount++;
            }
        }
    }
    
    echo "<h2 style='color: green; font-family: sans-serif;'>🎉 SUKSES LUAR BIASA!</h2>";
    echo "<p style='font-family: sans-serif; font-weight: bold;'>File update.zip berhasil diekstrak dan $cacheCount file cache tampilan Laravel telah dibersihkan!</p>";
    echo "<p style='font-family: sans-serif;'>Sekarang, silakan buka kembali website Anda di HP, tombol garis tiga pasti langsung aktif!</p>";
    
    // Hapus script ini demi keamanan setelah berhasil
    unlink(__FILE__);
} else {
    echo "<h2 style='color: red; font-family: sans-serif;'>❌ GAGAL membuka file update.zip!</h2>";
}
?>
