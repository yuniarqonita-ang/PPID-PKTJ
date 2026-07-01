<?php

// Bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Dashboard;
use App\Models\ProfilPpid;

// 1. Ensure ProfilPpid record for 'kontak' exists
$profil = ProfilPpid::where('type', 'kontak')->first();
if (!$profil) {
    ProfilPpid::create([
        'type' => 'kontak',
        'judul' => 'Hubungi Kami',
        'tagline_hero' => 'Kami Siap Melayani Kebutuhan Informasi Anda',
        'konten_pembuka' => '<p>Silakan hubungi kami melalui saluran resmi atau kirim pesan Anda menggunakan form di bawah ini.</p>',
    ]);
    echo "Created ProfilPpid kontak entry.\n";
}

// 2. Insert settings into dashboards table
$settings = [
    'kontak_facebook_link' => 'https://www.facebook.com/PKTJTegal/',
    'kontak_instagram_link' => 'https://www.instagram.com/pktj_tegal/',
    'kontak_twitter_link' => 'https://twitter.com/PKTJ_Tegal',
    'kontak_youtube_link' => 'https://www.youtube.com/channel/UC9BbdnU-cczfaZ5FHulYPZA',
    'kontak_linktree_link' => 'https://linktr.ee/pktj_tegal',
    'kontak_whatsapp_link' => 'https://wa.me/6283351061',
    'kontak_kampus_1_nama' => 'Politeknik Keselamatan Transportasi Jalan Kampus I',
    'kontak_kampus_1_alamat' => 'Jl. Perintis Kemerdekaan No. 17, Slerok, Tegal Timur, Kota Tegal',
    'kontak_kampus_1_email' => 'pktj@pktj.ac.id',
    'kontak_kampus_1_telepon' => '(0283) 351061',
    'kontak_kampus_1_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.23846665793!2d109.1396263!3d-6.8687256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb797c0000001%3A0xbd8ffc1a1154737d!2sPoliteknik%20Keselamatan%20Transportasi%20Jalan!5e0!3m2!1sid!2sid!4v1717575000000!5m2!1sid!2sid" width="100%" height="250" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
    'kontak_kampus_2_nama' => 'Politeknik Keselamatan Transportasi Jalan Kampus II',
    'kontak_kampus_2_alamat' => 'Jl. KH. Abdul Syukur No. 17, Margadana, Kota Tegal',
    'kontak_kampus_2_email' => 'pktj@pktj.ac.id',
    'kontak_kampus_2_telepon' => '(0283) 351061',
    'kontak_kampus_2_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.077224213794!2d109.09886317578768!3d-6.882898767355088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb86a87799d19%3A0x644265697669d255!2sPKTJ%20Kampus%20I!5e0!3m2!1sid!2sid!4v1717575000000!5m2!1sid!2sid" width="100%" height="250" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
];

foreach ($settings as $key => $value) {
    Dashboard::updateOrCreate(
        ['key' => $key],
        [
            'value' => $value,
            'type' => 'text',
            'description' => 'Pengaturan halaman kontak ' . str_replace('kontak_', '', $key),
            'aktif' => true
        ]
    );
    echo "Seeded setting: $key\n";
}

echo "Done seeding contact settings successfully!\n";
