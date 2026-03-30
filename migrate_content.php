<?php

use Illuminate\Support\Facades\DB;
use App\Models\ProfilPpid;

// This script will scrape the restored Blade files and import their content into the database.

$pages = [
    'profil' => 'profil-ppid.blade.php',
    'tugas' => 'profil-tugas-tanggung-jawab.blade.php',
    'visi' => 'profil-visi-misi.blade.php',
    'struktur' => 'profil-struktur-organisasi.blade.php',
    'regulasi' => 'profil-regulasi.blade.php',
    'kontak' => 'profil-kontak.blade.php',
    'maklumat-pelayanan' => 'maklumat-pelayanan.blade.php',
    'sop-permintaan' => 'sop-permintaan.blade.php',
    'sop-keberatan' => 'sop-penanganan-keberatan.blade.php',
    'sop-sengketa' => 'sop-sengketa.blade.php',
    'sop-penetapan' => 'sop-pemutakhiran-daftar.blade.php',
    'sop-pengujian' => 'sop-pengujian-konsekuensi.blade.php',
    'sop-pendokumentasian' => 'sop-pendokumentasian.blade.php',
    'laporan-layanan' => 'laporan-layanan-informasi.blade.php',
    'laporan-akses' => 'laporan-akses-informasi-publik.blade.php',
    'laporan-survey' => 'laporan-survey-kepuasan.blade.php',
];

foreach ($pages as $type => $file) {
    if (!file_exists(resource_path("views/$file"))) {
        echo "File $file not found. Skipping...\n";
        continue;
    }

    $content = file_get_contents(resource_path("views/$file"));
    
    // Extract everything inside <div class="content-box"> or similar
    // This is a rough estimation, we'll refine it for each page type if needed.
    
    $payload = [
        'type' => $type,
        'title' => ucfirst(str_replace('-', ' ', $type)),
        'konten_pembuka' => '',
        'konten_detail' => '',
    ];

    if ($type == 'profil') {
        $payload['title'] = 'Profil PPID';
        $payload['tagline_hero'] = 'PROFIL PEJABAT PENGELOLA INFORMASI DAN DOKUMENTASI';
        // Box 1
        if (preg_match('/<!-- SECTION: PROFILE PPID -->.*?<p.*?>(.*?)<\/p>.*?<p.*?>(.*?)<\/p>/s', $content, $matches)) {
            $payload['konten_pembuka'] = "<p>{$matches[1]}</p><p>{$matches[2]}</p>";
        }
        // Box 2
        if (preg_match('/<!-- SECTION: GAMBARAN SINGKAT PPID -->.*?<p.*?>(.*?)<\/p>.*?<p.*?>(.*?)<\/p>.*?<p.*?>(.*?)<\/p>/s', $content, $matches)) {
            $payload['konten_detail'] = "<p>{$matches[1]}</p><p>{$matches[2]}</p><p>{$matches[3]}</p>";
        }
        $payload['judul'] = 'GAMBARAN SINGKAT PEMBENTUKAN PPID KEMENHUB';
    }

    if ($type == 'tugas') {
        $payload['title'] = 'Tugas dan Tanggung Jawab PPID';
        if (preg_match('/<ol class="task-list">(.*?)<\/ol>/s', $content, $matches)) {
            $payload['konten_pembuka'] = "<ol class=\"task-list\">{$matches[1]}</ol>";
        }
        if (preg_match('/<table class="responsibility-table">(.*?)<\/table>/s', $content, $matches)) {
            $payload['konten_detail'] = "<table class=\"table table-bordered\">{$matches[1]}</table>";
        }
    }

    if ($type == 'visi') {
        $payload['title'] = 'Visi dan Misi PPID';
        if (preg_match('/<!-- VISI SECTION -->(.*?)<!-- MISI SECTION -->/s', $content, $matches)) {
            $payload['konten_pembuka'] = $matches[1];
        }
        if (preg_match('/<!-- MISI SECTION -->(.*?)<\/div>/s', $content, $matches)) {
            $payload['konten_detail'] = $matches[1];
        }
    }

    if ($type == 'struktur') {
        $payload['title'] = 'Struktur Organisasi';
        if (preg_match('/<div class="org-chart">(.*?)<\/div>.*?<\/div>/s', $content, $matches)) {
            $payload['konten_detail'] = "<div class=\"org-chart\">{$matches[1]}</div>";
        }
        if (preg_match('/<h2 class="section-title">Dasar Hukum Pembentukan<\/h2>(.*?)<\/div>/s', $content, $matches)) {
            $payload['konten_pembuka'] = $matches[1];
        }
    }

    if ($type == 'regulasi') {
        $payload['title'] = 'Regulasi PPID';
        if (preg_match('/<ul class="regulation-list">(.*?)<\/ul>/s', $content, $matches)) {
            $payload['konten_detail'] = "<ul class=\"list-group list-group-flush\">{$matches[1]}</ul>";
        }
    }

    if ($type == 'maklumat-pelayanan') {
        $payload['title'] = 'Maklumat Pelayanan';
        $payload['konten_pembuka'] = '<p>Maklumat Pelayanan merupakan janji penyelenggara pelayanan kepada masyarakat untuk memberikan pelayanan yang berkualitas, mudah, cepat, dan transparan.</p>';
    }

    // Update or Create
    ProfilPpid::updateOrCreate(['type' => $type], $payload);
    echo "Imported content for $type\n";
}
