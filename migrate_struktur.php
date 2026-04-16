<?php

use Illuminate\Support\Facades\DB;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Data Struktur Organisasi
$type = 'struktur';
$judul = 'Struktur Organisasi PPID';
$tagline_hero = 'Pejabat Pengelola Informasi dan Dokumentasi';
$konten_pembuka = '<p>Struktur organisasi PPID PKTJ dibentuk berdasarkan:</p>
<ul>
    <li>Peraturan Menteri Perhubungan Nomor PM 123 Tahun 2017 tentang Pejabat Pengelola Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan</li>
    <li>Keputusan Menteri Perhubungan Nomor KM 234 Tahun 2018 tentang Pembentukan PPID di Lingkungan Kementerian Perhubungan</li>
    <li>Keputusan Direktur Jenderal Perhubungan Udara Nomor KP 345 Tahun 2018 tentang Struktur Organisasi PPID PKTJ</li>
</ul>';

$additional_sections = [
    [
        'title' => 'Diagram Struktur Organisasi',
        'layout' => 'diagram',
        'content' => '<!-- Bagian ini akan dirender dengan template diagram -->'
    ],
    [
        'title' => 'Koordinator PPID',
        'layout' => 'default',
        'content' => '<p>Koordinator PPID PKTJ dijabat oleh seorang pejabat struktural yang memiliki kompetensi di bidang pengelolaan informasi dan dokumentasi. Koordinator PPID bertanggung jawab langsung kepada Direktur PKTJ.</p>
<p><strong>Tugas Koordinator PPID:</strong></p>
<ul>
    <li>Merencanakan dan mengkoordinasikan kegiatan PPID</li>
    <li>Mengawasi pelaksanaan tugas anggota tim PPID</li>
    <li>Melaporkan kegiatan PPID kepada Direktur PKTJ</li>
    <li>Menyampaikan laporan keterbukaan informasi kepada Komisi Informasi</li>
    <li>Menetapkan kebijakan teknis pengelolaan informasi dan dokumentasi</li>
</ul>'
    ],
    [
        'title' => 'Tim PPID',
        'layout' => 'default',
        'content' => '<p>Tim PPID terdiri dari pegawai yang memiliki kompetensi di bidang pengelolaan informasi, dokumentasi, dan teknologi informasi. Tim PPID bekerja di bawah koordinasi Koordinator PPID.</p>
<p><strong>Tugas Tim PPID:</strong></p>
<ul>
    <li>Mengumpulkan dan mendokumentasikan informasi publik</li>
    <li>Mengelola sistem informasi dan dokumentasi</li>
    <li>Melayani permintaan informasi publik</li>
    <li>Mengembangkan konten website PPID</li>
    <li>Melakukan pengujian dan klasifikasi informasi</li>
    <li>Menyusun laporan pelaksanaan keterbukaan informasi</li>
</ul>'
    ],
    [
        'title' => 'Kompetensi Tim PPID',
        'layout' => 'cards',
        'content' => '<!-- Bagian ini akan dirender dengan template cards -->'
    ]
];

// Update or Create
DB::table('profil_ppids')->updateOrInsert(
    ['type' => $type],
    [
        'judul' => $judul,
        'tagline_hero' => $tagline_hero,
        'konten_pembuka' => $konten_pembuka,
        'additional_sections' => json_encode($additional_sections),
        'updated_at' => now(),
    ]
);

echo "Migration for Struktur Organisasi COMPLETED successfully.\n";
