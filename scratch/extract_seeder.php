<?php
// Script to extract titles and categories from the seeder file
$filePath = __DIR__ . '/../database/migrations/2026_06_05_160000_seed_daftar_informasi_data.php';

if (!file_exists($filePath)) {
    die("File not found at $filePath\n");
}

$content = file_get_contents($filePath);

// We want to extract the $records array from the anonymous class.
// We can do this by matching the records array.
// To make it easy and robust, we can use preg_match_all to find all matching arrays.
preg_match_all("/'judul_informasi'\s*=>\s*'([^']*)'.*?'kategori'\s*=>\s*'([^']*)'/s", $content, $matches);

$berkala = [];
$sertamerta = [];
$setiapsaat = [];

if (!empty($matches[0])) {
    for ($i = 0; $i < count($matches[1]); $i++) {
        $judul = $matches[1][$i];
        $kategori = $matches[2][$i];
        
        if ($kategori === 'informasi-berkala') {
            $berkala[] = $judul;
        } elseif ($kategori === 'informasi-serta-merta') {
            $sertamerta[] = $judul;
        } elseif ($kategori === 'informasi-setiap-saat') {
            $setiapsaat[] = $judul;
        }
    }
}

echo "BERKALA (" . count($berkala) . "):\n";
print_r($berkala);

echo "\nSERTA MERTA (" . count($sertamerta) . "):\n";
print_r($sertamerta);

echo "\nSETIAP SAAT (" . count($setiapsaat) . "):\n";
print_r($setiapsaat);
