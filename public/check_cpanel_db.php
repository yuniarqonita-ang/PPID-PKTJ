<?php
// Standalone DB Checker for cPanel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

header('Content-Type: text/html; charset=utf-8');
echo "<html><head><title>cPanel Database Inspector</title>";
echo "<style>body { font-family: sans-serif; line-height: 1.5; padding: 20px; max-width: 900px; margin: 0 auto; background: #f8fafc; color: #1e293b; }";
echo "h2 { color: #004a99; border-bottom: 2px solid #ffc107; padding-bottom: 10px; }";
echo "table { width: 100%; border-collapse: collapse; margin: 20px 0; background: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }";
echo "th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e2e8f0; }";
echo "th { background-color: #004a99; color: white; font-weight: bold; }";
echo "tr:hover { background-color: #f1f5f9; }";
echo ".badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; }";
echo ".badge-primary { background: #dbeafe; color: #1e40af; }";
echo "</style></head><body>";

echo "<h2>Live cPanel Database Tables</h2>";
try {
    $tables = DB::select('SHOW TABLES');
    echo "<ul>";
    foreach ($tables as $table) {
        $tableName = array_values((array)$table)[0];
        echo "<li><code>$tableName</code></li>";
    }
    echo "</ul>";
} catch (\Exception $e) {
    echo "<p style='color: red;'>Error listing tables: " . $e->getMessage() . "</p>";
}

echo "<h2>profil_ppids Content (Live Database)</h2>";
try {
    $rows = DB::table('profil_ppids')->get();
    echo "<table>";
    echo "<thead><tr><th>ID</th><th>Type</th><th>Judul</th><th>Pembuka (150 chars)</th><th>Detail (150 chars)</th><th>Gambaran</th></tr></thead>";
    echo "<tbody>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>{$row->id}</td>";
        echo "<td><span class='badge badge-primary'>{$row->type}</span></td>";
        echo "<td>" . htmlspecialchars($row->judul) . "</td>";
        echo "<td>" . htmlspecialchars(substr(strip_tags($row->konten_pembuka), 0, 150)) . "...</td>";
        echo "<td>" . htmlspecialchars(substr(strip_tags($row->konten_detail), 0, 150)) . "...</td>";
        echo "<td>" . htmlspecialchars(substr(strip_tags($row->gambaran), 0, 150)) . "...</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} catch (\Exception $e) {
    echo "<p style='color: red;'>Error reading profil_ppids: " . $e->getMessage() . "</p>";
}

echo "<h2>custom_menus Content (Live Database)</h2>";
try {
    $menus = DB::table('custom_menus')->get();
    echo "<table>";
    echo "<thead><tr><th>ID</th><th>Parent</th><th>Nama</th><th>Slug</th><th>URL</th></tr></thead>";
    echo "<tbody>";
    foreach ($menus as $m) {
        echo "<tr>";
        echo "<td>{$m->id}</td>";
        echo "<td>" . ($m->parent_id ?? '-') . "</td>";
        echo "<td>" . htmlspecialchars($m->nama) . "</td>";
        echo "<td>" . htmlspecialchars($m->slug) . "</td>";
        echo "<td>" . htmlspecialchars($m->url) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} catch (\Exception $e) {
    echo "<p style='color: red;'>Error reading custom_menus: " . $e->getMessage() . "</p>";
}

echo "</body></html>";
