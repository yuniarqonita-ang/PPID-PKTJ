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

        // Helper function to insert child menu if missing or update URL
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
            } else {
                DB::table('custom_menus')->where('slug', $slug)->update([
                    'url'        => $url,
                    'updated_at' => now(),
                ]);
            }
        };

        // 1. PROFIL
        $profilId = $ensureParent('PROFIL', 'profil-menu', null, 1);
        $ensureChild($profilId, 'Profil PPID', 'profil-ppid-sub', '/profil/ppid', 1);
        $ensureChild($profilId, 'Visi dan Misi', 'visi-misi-sub', '/profil/visi-misi', 2);
        $ensureChild($profilId, 'Tugas, Fungsi & Tanggung Jawab', 'tugas-fungsi-sub', '/profil/tugas-fungsi', 3);
        $ensureChild($profilId, 'Struktur Organisasi', 'struktur-organisasi-sub', '/profil/struktur-organisasi', 4);
        $ensureChild($profilId, 'Regulasi / Dasar Hukum', 'regulasi-sub', '/profil/regulasi', 5);
        $ensureChild($profilId, 'Kontak & Lokasi', 'kontak-sub', '/profil/kontak', 6);

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
        $ensureChild($layananId, 'JDIH BPSDM Kemenhub', 'jdih-sub', 'https://bpsdm.kemenhub.go.id/jdih/', 6);

        // 4. PROSEDUR
        $prosedurId = $ensureParent('PROSEDUR', 'prosedur-menu', null, 4);
        $ensureChild($prosedurId, 'SOP Permintaan Informasi Publik', 'sop-permintaan-sub', '/prosedur/sop-permintaan', 1);
        $ensureChild($prosedurId, 'SOP Penanganan Keberatan', 'sop-keberatan-sub', '/prosedur/sop-keberatan', 2);
        $ensureChild($prosedurId, 'SOP Pengajuan Sengketa Informasi Publik', 'sop-sengketa-sub', '/prosedur/sop-sengketa', 3);

        // Clean up deleted submenus
        DB::table('custom_menus')->whereIn('slug', ['sop-penetapan-sub', 'sop-pengujian-sub', 'sop-pendokumentasian-sub'])->delete();

        // 5. FAQ
        $ensureParent('FAQ', 'faq-menu', '/faq', 5);
    }
}
