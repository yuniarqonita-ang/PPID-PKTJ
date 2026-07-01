<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$items = App\Models\DaftarInformasi::where('aktif', true)->where('kategori', 'informasi-serta-merta')->get(['id', 'judul_informasi', 'file_informasi']);
echo 'Total serta-merta aktif: ' . $items->count() . PHP_EOL;
foreach($items->take(5) as $i) {
    echo 'ID: ' . $i->id . ' | Judul: ' . substr($i->judul_informasi, 0, 50) . ' | File: ' . ($i->file_informasi ? substr($i->file_informasi, 0, 60) : 'NULL') . PHP_EOL;
}

$items2 = App\Models\DaftarInformasi::where('aktif', true)->where('kategori', 'informasi-berkala')->get(['id', 'judul_informasi', 'file_informasi']);
echo PHP_EOL . 'Total berkala aktif: ' . $items2->count() . PHP_EOL;
foreach($items2->take(3) as $i) {
    echo 'ID: ' . $i->id . ' | Judul: ' . substr($i->judul_informasi, 0, 50) . ' | File: ' . ($i->file_informasi ? substr($i->file_informasi, 0, 60) : 'NULL') . PHP_EOL;
}

$items3 = App\Models\DaftarInformasi::where('aktif', true)->where('kategori', 'informasi-setiap-saat')->get(['id', 'judul_informasi', 'file_informasi']);
echo PHP_EOL . 'Total setiap-saat aktif: ' . $items3->count() . PHP_EOL;
foreach($items3->take(3) as $i) {
    echo 'ID: ' . $i->id . ' | Judul: ' . substr($i->judul_informasi, 0, 50) . ' | File: ' . ($i->file_informasi ? substr($i->file_informasi, 0, 60) : 'NULL') . PHP_EOL;
}

// Categories
$allCats = App\Models\DaftarInformasi::select('kategori', DB::raw('count(*) as total'))->groupBy('kategori')->get();
echo PHP_EOL . 'Semua kategori:' . PHP_EOL;
foreach($allCats as $c) {
    echo '  ' . $c->kategori . ': ' . $c->total . PHP_EOL;
}
