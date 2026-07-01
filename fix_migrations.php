<?php
/**
 * Script untuk sinkronisasi tabel migrations dengan database db_ppid_final
 */

$host = '127.0.0.1';
$db   = 'db_ppid_final';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage() . "\n");
}

echo "=== Terhubung ke database: $db ===\n\n";

// Migrasi yang ada di folder tapi belum tercatat di migrations table
// (hasil dari migrate:status yang menunjukkan 'No')
$migrasiToFake = [
    '2026_01_29_081012_create_dokumens_table',
    '2026_01_30_000000_create_permohonan_table',
    '2026_01_30_000001_add_fields_to_permohonan_table',
    '2026_02_18_000000_create_faqs_table',
    '2026_02_18_000100_create_beritas_table',
    '2026_02_18_033432_create_profil_ppids_table',
    '2026_02_18_033433_create_tugas_ppids_table',
    '2026_02_19_000001_add_columns_to_beritas_table',
    '2026_02_20_032623_create_peraturans_table',
    '2026_03_02_030109_create_sessions_table',
    '2026_03_03_022523_create_informasi_berkalas_table',
    '2026_03_03_022539_create_informasi_sertamertas_table',
    '2026_03_03_022555_create_informasi_setiapsaats_table',
    '2026_03_03_022609_create_informasi_dikecualikans_table',
    '2026_03_03_022620_create_prosedurs_table',
    '2026_03_03_024254_create_dashboards_table',
    '2026_03_03_024441_create_profils_table',
    '2026_03_06_000001_create_galeris_table',
    '2026_03_06_000002_create_videos_table',
    '2026_03_06_000003_create_visitors_table',
    '2026_03_06_000004_add_view_count_to_beritas_table',
    '2026_03_06_022910_add_view_count_to_beritas_table',
    '2026_03_09_000000_create_beritas_table',
    '2026_03_10_000000_make_permohonan_fields_nullable',
    '2026_04_16_070518_add_role_to_users_table',
    '2026_04_22_054155_add_aktif_to_dokumens_and_beritas',
    '2026_05_20_200000_drop_keberatans_table',
];

// Cek batch tertinggi
$stmt = $pdo->query("SELECT MAX(batch) FROM migrations");
$maxBatch = (int)$stmt->fetchColumn();
$newBatch = $maxBatch + 1;

echo "Batch tertinggi saat ini: $maxBatch\n";
echo "Akan fake dengan batch: $newBatch\n\n";

// Cek yang sudah ada
$stmt = $pdo->query("SELECT migration FROM migrations");
$existing = $stmt->fetchAll(PDO::FETCH_COLUMN);

$faked = 0;
$skipped = 0;

foreach ($migrasiToFake as $migration) {
    if (in_array($migration, $existing)) {
        echo "  ↷ SKIP (sudah ada): $migration\n";
        $skipped++;
    } else {
        $stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)");
        $stmt->execute([$migration, $newBatch]);
        echo "  ✓ FAKE berhasil: $migration\n";
        $faked++;
    }
}

// Juga cek kolom tags di beritas
$stmt = $pdo->query("SHOW COLUMNS FROM beritas LIKE 'tags'");
$hasTagsColumn = $stmt->fetch();

echo "\n=== Status Kolom 'tags' di tabel beritas ===\n";
if ($hasTagsColumn) {
    echo "  ✓ Kolom 'tags' SUDAH ADA\n";
    // Fake migration tags juga
    $stmt = $pdo->query("SELECT migration FROM migrations WHERE migration = '2026_05_06_085226_add_tags_to_beritas_table'");
    $hasTags = $stmt->fetch();
    if (!$hasTags) {
        $stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)");
        $stmt->execute(['2026_05_06_085226_add_tags_to_beritas_table', $newBatch]);
        echo "  ✓ FAKE migration tags\n";
        $faked++;
    }
} else {
    echo "  ✗ Kolom 'tags' BELUM ADA — akan dibuat saat migrate\n";
}

echo "\n=== SELESAI ===\n";
echo "Total di-fake : $faked\n";
echo "Total di-skip : $skipped\n";
echo "\n>>> Sekarang jalankan: php artisan migrate --force\n";
