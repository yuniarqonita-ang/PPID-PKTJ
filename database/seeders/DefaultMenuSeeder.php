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
        $insertChild($profilId, 'Profil Pejabat', 'profil-pejabat-sub', '/profil/pejabat', 2);
        $insertChild($profilId, 'Data & Statistik Kepegawaian', 'statistik-pegawai-sub', '/profil/pejabat#statistik-pegawai', 3);
        $insertChild($profilId, 'Visi & Misi', 'visi-misi-sub', '/profil/visi-misi', 4);
        $insertChild($profilId, 'Struktur Organisasi', 'struktur-organisasi-sub', '/profil/struktur-organisasi', 5);
        $insertChild($profilId, 'Tugas & Fungsi PPID', 'tugas-fungsi-sub', '/profil/tugas-dan-fungsi-ppid', 6);
        $insertChild($profilId, 'Kontak & Lokasi', 'kontak-sub', '/profil/kontak', 7);

        // 2. INFORMASI PUBLIK
        $infoId = $insertParent('INFORMASI PUBLIK', 'informasi-publik-menu', null, 2);
        $insertChild($infoId, 'Informasi Berkala', 'informasi-berkala-sub', '/informasi-publik/berkala', 1);
        $insertChild($infoId, 'Informasi Setiap Saat', 'informasi-setiap-saat-sub', '/informasi-publik/setiap-saat', 2);
        $insertChild($infoId, 'Informasi Serta Merta', 'informasi-serta-merta-sub', '/informasi-publik/serta-merta', 3);
        $insertChild($infoId, 'Informasi Dikecualikan', 'informasi-dikecualikan-sub', '/informasi-publik/dikecualikan', 4);

        // 3. PROSEDUR
        $prosedurId = $insertParent('PROSEDUR', 'prosedur-menu', null, 3);
        $insertChild($prosedurId, 'SOP Permintaan Informasi', 'sop-permintaan-sub', '/prosedur/sop-permintaan', 1);
        $insertChild($prosedurId, 'SOP Penanganan Keberatan', 'sop-keberatan-sub', '/prosedur/sop-keberatan', 2);
        $insertChild($prosedurId, 'SOP Penyelesaian Sengketa', 'sop-sengketa-sub', '/prosedur/sop-sengketa', 3);
        $insertChild($prosedurId, 'SOP Standar Biaya', 'sop-standar-biaya-sub', '/prosedur/sop-standar-biaya', 4);
        $insertChild($prosedurId, 'SOP Standar Waktu', 'sop-standar-waktu-sub', '/prosedur/sop-standar-waktu', 5);

        // 4. LAYANAN INFORMASI
        $layananId = $insertParent('LAYANAN INFORMASI', 'layanan-informasi-menu', null, 4);
        $insertChild($layananId, 'Maklumat Pelayanan', 'maklumat-pelayanan-sub', '/layanan-informasi/maklumat', 1);
        $insertChild($layananId, 'Laporan Layanan Informasi', 'laporan-layanan-sub', '/layanan-informasi/laporan', 2);
        $insertChild($layananId, 'Laporan Akses Informasi', 'laporan-akses-sub', '/layanan-informasi/laporan-akses', 3);
        $insertChild($layananId, 'Formulir Permohonan Cetak', 'formulir-permohonan-cetak-sub', '/dokumen/formulir-permohonan-cetak', 4);
        $insertChild($layananId, 'Formulir Keberatan Cetak', 'formulir-keberatan-cetak-sub', '/dokumen/formulir-keberatan-cetak', 5);
        $insertChild($layananId, 'Formulir Braille Cetak', 'formulir-braille-cetak-sub', '/dokumen/formulir-braille-cetak', 6);

        // 5. REGULASI
        $regulasiId = $insertParent('REGULASI', 'regulasi-menu', null, 5);
        $insertChild($regulasiId, 'Regulasi PPID PKTJ', 'regulasi-pktj-sub', '/regulasi', 1);
        $insertChild($regulasiId, 'Maklumat Pelayanan', 'maklumat-pelayanan-regulasi-sub', '/layanan-informasi/maklumat', 2);
        $insertChild($regulasiId, 'JDIH BPSDM Kemenhub', 'jdih-sub', 'https://bpsdm.kemenhub.go.id/jdih/', 3);

        // 6. BERITA
        $insertParent('BERITA', 'berita-menu', '/berita', 6);

        // 7. FAQ
        $insertParent('FAQ', 'faq-menu', '/faq', 7);
    }
}
