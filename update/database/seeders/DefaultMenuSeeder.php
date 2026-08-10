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
        // Do NOT truncate the table to preserve user edits and custom menus!

        // Helper function to insert parent menu if missing
        $ensureParent = function($nama, $slug, $url, $urutan) {
            $existing = DB::table('custom_menus')->where('slug', $slug)->first();
            if ($existing) {
                return $existing->id;
            }
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

        // Helper function to insert child menu if missing
        $ensureChild = function($parentId, $nama, $slug, $url, $urutan) {
            $existing = DB::table('custom_menus')->where('slug', $slug)->first();
            if (!$existing) {
                DB::table('custom_menus')->insert([
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
            }
        };

        // 1. PROFIL PPID
        $profilId = $ensureParent('PROFIL PPID', 'profil-menu', null, 1);
        $ensureChild($profilId, 'Profil PPID', 'profil-ppid-sub', '/profil-ppid.html', 1);
        $ensureChild($profilId, 'Visi & Misi', 'visi-misi-sub', '/profil-visi-misi.html', 2);
        $ensureChild($profilId, 'Tugas & Tanggung Jawab', 'tugas-tanggung-jawab-sub', '/profil-tugas-tanggung-jawab.html', 3);
        $ensureChild($profilId, 'Struktur Organisasi', 'struktur-organisasi-sub', '/profil-struktur-organisasi.html', 4);
        $ensureChild($profilId, 'Regulasi', 'regulasi-sub', '/profil-regulasi.html', 5);
        $ensureChild($profilId, 'Kontak', 'kontak-sub', '/profil-kontak.html', 6);

        // 2. INFORMASI PUBLIK
        $infoId = $ensureParent('INFORMASI PUBLIK', 'informasi-publik-menu', null, 2);
        $ensureChild($infoId, 'Informasi Berkala', 'informasi-berkala-sub', '/informasi-publik/berkala', 1);
        $ensureChild($infoId, 'Informasi Serta Merta', 'informasi-serta-merta-sub', '/informasi-publik/serta-merta', 2);
        $ensureChild($infoId, 'Informasi Setiap Saat', 'informasi-setiap-saat-sub', '/informasi-publik/setiap-saat', 3);
        $ensureChild($infoId, 'Informasi Dikecualikan', 'informasi-dikecualikan-sub', '/informasi-publik/dikecualikan', 4);

        // 3. LAYANAN INFORMASI
        $layananId = $ensureParent('LAYANAN INFORMASI', 'layanan-informasi-menu', null, 3);
        $ensureChild($layananId, 'Daftar Informasi Publik', 'daftar-informasi-sub', '/layanan-informasi/daftar', 1);
        $ensureChild($layananId, 'Maklumat Pelayanan & Standar Biaya', 'maklumat-pelayanan-sub', '/layanan-informasi/maklumat', 2);
        $ensureChild($layananId, 'Laporan Layanan Informasi Publik', 'laporan-layanan-sub', '/layanan-informasi/laporan', 3);
        $ensureChild($layananId, 'Laporan Akses Informasi Publik', 'laporan-akses-sub', '/layanan-informasi/laporan-akses', 4);
        $ensureChild($layananId, 'Laporan Survey Kepuasan Layanan', 'laporan-survey-sub', '/layanan-informasi/laporan-survey', 5);
        $ensureChild($layananId, 'JDIH Kementerian Perhubungan', 'jdih-sub', 'https://jdih.dephub.go.id/', 6);

        // 4. PROSEDUR
        $prosedurId = $ensureParent('PROSEDUR', 'prosedur-menu', null, 4);
        $ensureChild($prosedurId, 'SOP Permintaan Informasi Publik', 'sop-permintaan-sub', '/prosedur/sop-permintaan', 1);
        $ensureChild($prosedurId, 'SOP Penanganan Keberatan', 'sop-keberatan-sub', '/prosedur/sop-keberatan', 2);
        $ensureChild($prosedurId, 'SOP Pengajuan Sengketa Informasi Publik', 'sop-sengketa-sub', '/prosedur/sop-sengketa', 3);
        $ensureChild($prosedurId, 'SOP Penetapan dan Pemutakhiran Daftar Informasi Publik', 'sop-penetapan-sub', '/prosedur/sop-penetapan', 4);
        $ensureChild($prosedurId, 'SOP Pengujian Konsekuensi', 'sop-pengujian-sub', '/prosedur/sop-pengujian', 5);
        $ensureChild($prosedurId, 'SOP Pendokumentasian Informasi Publik', 'sop-pendokumentasian-sub', '/prosedur/sop-pendokumentasian', 6);

        // 5. AGENDA
        $ensureParent('AGENDA', 'agenda-menu', '/agenda', 5);

        // 6. FAQ
        $ensureParent('FAQ', 'faq-menu', '/faq', 6);
    }
}
