<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate table and reseed cleanly to ensure exact and clean navigation
        DB::table('custom_menus')->truncate();

        // Helper function to insert parent menu
        $insertParent = function($nama, $slug, $url, $urutan) {
            return DB::table('custom_menus')->insertGetId([
                'nama'       => $nama,
                'slug'       => $slug,
                'url'        => $url,
                'aktif'      => true,
                'urutan'     => $urutan,
                'penempatan' => 'both',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };

        // Helper function to insert child menu
        $insertChild = function($parentId, $nama, $slug, $url, $urutan) {
            return DB::table('custom_menus')->insertGetId([
                'parent_id'  => $parentId,
                'nama'       => $nama,
                'slug'       => $slug,
                'url'        => $url,
                'aktif'      => true,
                'urutan'     => $urutan,
                'penempatan' => 'header',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };

        // 1. PROFIL
        $profilId = $insertParent('PROFIL', 'profil-menu', null, 1);
        $insertChild($profilId, 'Profil PPID', 'profil-ppid-sub', '/profil/profil-ppid', 1);
        $insertChild($profilId, 'Visi dan Misi', 'visi-misi-sub', '/profil/visi-misi', 2);
        $insertChild($profilId, 'Tugas, Fungsi & Tanggung Jawab', 'tugas-fungsi-sub', '/profil/tugas-dan-fungsi-ppid', 3);
        $insertChild($profilId, 'Struktur Organisasi', 'struktur-organisasi-sub', '/profil/struktur-organisasi', 4);
        $insertChild($profilId, 'Regulasi / Dasar Hukum', 'regulasi-sub', '/profil/regulasi', 5);
        $insertChild($profilId, 'Kontak & Lokasi', 'kontak-sub', '/profil/kontak', 6);

        // 2. INFORMASI PUBLIK
        $infoId = $insertParent('INFORMASI PUBLIK', 'informasi-publik-menu', null, 2);
        $insertChild($infoId, 'Informasi Berkala', 'informasi-berkala-sub', '/informasi-publik/berkala', 1);
        $insertChild($infoId, 'Informasi Setiap Saat', 'informasi-setiap-saat-sub', '/informasi-publik/setiap-saat', 2);
        $insertChild($infoId, 'Informasi Serta Merta', 'informasi-serta-merta-sub', '/informasi-publik/serta-merta', 3);
        $insertChild($infoId, 'Informasi Dikecualikan', 'informasi-dikecualikan-sub', '/informasi-publik/dikecualikan', 4);

        // 3. LAYANAN INFORMASI
        $layananId = $insertParent('LAYANAN INFORMASI', 'layanan-informasi-menu', null, 3);
        $insertChild($layananId, 'Maklumat dan Standar Biaya Layanan', 'maklumat-dan-standar-biaya-layanan-sub', '/layanan-informasi/maklumat-dan-standar-biaya-layanan', 1);
        $insertChild($layananId, 'Laporan Layanan Informasi Publik', 'laporan-layanan-sub', '/layanan-informasi/laporan', 2);
        $insertChild($layananId, 'Laporan Akses Informasi Publik', 'laporan-akses-sub', '/layanan-informasi/laporan-akses', 3);
        $insertChild($layananId, 'Laporan Survey Kepuasan Layanan', 'laporan-survey-sub', '/layanan-informasi/laporan-survey', 4);
        $insertChild($layananId, 'JDIH BPSDM Kemenhub', 'jdih-sub', 'https://bpsdm.kemenhub.go.id/jdih/', 5);

        // 4. PROSEDUR
        $prosedurId = $insertParent('PROSEDUR', 'prosedur-menu', null, 4);
        $insertChild($prosedurId, 'Prosedur Permintaan Informasi Publik', 'prosedur-permintaan-sub', '/prosedur/permintaan-informasi', 1);
        $insertChild($prosedurId, 'Prosedur Penanganan Keberatan', 'prosedur-keberatan-sub', '/prosedur/penanganan-keberatan', 2);
        $insertChild($prosedurId, 'Prosedur Pengajuan Sengketa Informasi Publik', 'prosedur-sengketa-sub', '/prosedur/sengketa-informasi', 3);

        // 5. FAQ
        $insertParent('FAQ', 'faq-menu', '/faq', 5);
    }
}
