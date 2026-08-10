<?php
if (function_exists('opcache_reset')) {
    try {
        @opcache_reset();
        echo "Cache OPcache berhasil dibersihkan!";
    } catch (\Throwable $e) {
        echo "OPcache reset gagal: " . $e->getMessage();
    }
} else {
    echo "OPcache tidak aktif atau fungsi opcache_reset dinonaktifkan di server hosting Anda.";
}
