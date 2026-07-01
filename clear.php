<?php
// Script Clear View Cache Otomatis untuk PPID PKTJ
$viewsDir = __DIR__ . '/../Laravel-Core/storage/framework/views/';
if (!is_dir($viewsDir)) {
    // Coba path alternatif jika struktur folder berbeda
    $viewsDir = __DIR__ . '/storage/framework/views/';
}

if (is_dir($viewsDir)) {
    $files = glob($viewsDir . '*');
    $count = 0;
    foreach ($files as $file) {
        if (is_file($file) && basename($file) !== '.gitignore') {
            unlink($file);
            $count++;
        }
    }
    echo "<h2 style='color: green; font-family: sans-serif;'>🎉 SUKSES! Cache tampilan Laravel berhasil dihapus ($count file cache dibersihkan).</h2>";
    echo "<p style='font-family: sans-serif;'>Sekarang, silakan buka kembali website Anda di HP, menu garis tiga pasti langsung muncul!</p>";
    // Hapus script ini setelah berhasil dijalankan demi keamanan
    unlink(__FILE__);
} else {
    echo "<h2 style='color: red; font-family: sans-serif;'>❌ GAGAL: Direktori cache Laravel tidak ditemukan!</h2>";
    echo "<p style='font-family: sans-serif;'>Lokasi pencarian: " . $viewsDir . "</p>";
}
?>
