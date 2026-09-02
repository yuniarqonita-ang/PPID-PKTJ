<?php

namespace Database\Seeders;

use App\Models\Peraturan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RegulasiBpsdmPktjSeeder extends Seeder
{
    public function run(): void
    {
        // Fail-safe: ensure columns exist
        if (!Schema::hasColumn('peraturans', 'link_download')) {
            try {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            } catch (\Throwable $e) {}
        }

        $regulasiList = [
            // =========================================================================
            // 1. UNDANG-UNDANG
            // =========================================================================
            [
                'judul' => 'Undang-Undang Nomor 14 Tahun 2008',
                'nomor' => 'UU No. 14 Tahun 2008',
                'tahun' => 2008,
                'deskripsi' => 'tentang Keterbukaan Informasi Publik (KIP)',
                'kategori' => 'Undang-Undang',
                'urutan' => 1,
                'link_download' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/20200728111256.uu14-2008_keterbukaan_informasi_publikascas.pdf',
                'is_active' => true,
            ],
            [
                'judul' => 'Undang-Undang Nomor 25 Tahun 2009',
                'nomor' => 'UU No. 25 Tahun 2009',
                'tahun' => 2009,
                'deskripsi' => 'tentang Pelayanan Publik',
                'kategori' => 'Undang-Undang',
                'urutan' => 2,
                'link_download' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/20200728111618.UU_25_Tahun_2009dsd.pdf',
                'is_active' => true,
            ],
            [
                'judul' => 'Undang-Undang Nomor 43 Tahun 2009',
                'nomor' => 'UU No. 43 Tahun 2009',
                'tahun' => 2009,
                'deskripsi' => 'tentang Kearsipan',
                'kategori' => 'Undang-Undang',
                'urutan' => 3,
                'link_download' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/20200728111804.UU_43_Tahun_2009cxzaaa.pdf',
                'is_active' => true,
            ],
            [
                'judul' => 'Undang-Undang Nomor 40 Tahun 1999',
                'nomor' => 'UU No. 40 Tahun 1999',
                'tahun' => 1999,
                'deskripsi' => 'tentang Pers',
                'kategori' => 'Undang-Undang',
                'urutan' => 4,
                'link_download' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/20200728111403.UU_No._40_Tahun_1999_Tentang_Pers_sdcds.pdf',
                'is_active' => true,
            ],

            // =========================================================================
            // 2. KOMISI INFORMASI PUSAT
            // =========================================================================
            [
                'judul' => 'Peraturan Komisi Informasi Pusat Nomor 1 Tahun 2021',
                'nomor' => 'Peraturan KIP No. 1 Tahun 2021',
                'tahun' => 2021,
                'deskripsi' => 'tentang Standar Layanan Informasi Publik (SLIP)',
                'kategori' => 'Komisi Informasi Pusat',
                'urutan' => 5,
                'link_download' => 'https://jdih.komisiinformasi.go.id/dokumen/view?id=3',
                'is_active' => true,
            ],
            [
                'judul' => 'Peraturan Komisi Informasi Pusat Nomor 1 Tahun 2013',
                'nomor' => 'Peraturan KIP No. 1 Tahun 2013',
                'tahun' => 2013,
                'deskripsi' => 'tentang Prosedur Penyelesaian Sengketa Informasi Publik',
                'kategori' => 'Komisi Informasi Pusat',
                'urutan' => 6,
                'link_download' => 'https://jdih.komisiinformasi.go.id/dokumen/view?id=32',
                'is_active' => true,
            ],

            // =========================================================================
            // 3. KEMENTERIAN PERHUBUNGAN
            // =========================================================================
            [
                'judul' => 'Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018',
                'nomor' => 'PM 46 Tahun 2018',
                'tahun' => 2018,
                'deskripsi' => 'tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan',
                'kategori' => 'Kementerian Perhubungan',
                'urutan' => 7,
                'link_download' => 'https://jdih.dephub.go.id/peraturan/detail?data=Gr3vFlNp4Kt7QFFckUxgA84ZI0WMg9fay4q9UjKV2wyZ8cQCY4NLOGj8MPnzt0Vmtu4jsBWzb0uHu4TwfZYTYVvd8W2gwcUFOmD4jpL4RJYs9W5LoU8994HTYDTO4pLhhdiMIQb9fXR66mY0ZhgiScyCWT',
                'is_active' => true,
            ],
            [
                'judul' => 'Keputusan Menteri Perhubungan Nomor KM 117 Tahun 2022',
                'nomor' => 'KM 117 Tahun 2022',
                'tahun' => 2022,
                'deskripsi' => 'tentang Standar Operasional Prosedur (SOP) PPID di Lingkungan Kementerian Perhubungan',
                'kategori' => 'Kementerian Perhubungan',
                'urutan' => 8,
                'link_download' => 'https://jdih.dephub.go.id/peraturan/detail?data=DVtNwoS7MPwJH0L0fbMu888Qjvn9iOPTh8bMhTUoAkmH4ZGSMY8uwti4ZFAni36o6v4q9G43QwoOl4uSLnLEkb4P8W3k8dWBke54PXA0mVPAXKGke20ssIBJo225ZPgJyXPb0vjy5JCBIsLBGRejUHttlN',
                'is_active' => true,
            ],
            [
                'judul' => 'Keputusan Sekretaris Jenderal Kemenhub Nomor KP-SKJ 15 Tahun 2025',
                'nomor' => 'KP-SKJ 15 Tahun 2025',
                'tahun' => 2025,
                'deskripsi' => 'tentang Penetapan Daftar Informasi Publik (DIP) Kementerian Perhubungan Tahun 2025',
                'kategori' => 'Kementerian Perhubungan',
                'urutan' => 9,
                'link_download' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/KP-SKJ-15-TAHUN-2025-DIP.pdf',
                'is_active' => true,
            ],
            [
                'judul' => 'Keputusan Sekretaris Jenderal Kemenhub Nomor KP-SKJ 16 Tahun 2025',
                'nomor' => 'KP-SKJ 16 Tahun 2025',
                'tahun' => 2025,
                'deskripsi' => 'tentang Perubahan Kedua Atas Keputusan Sekjen KP 591 Tahun 2023 tentang Informasi yang Dikecualikan',
                'kategori' => 'Kementerian Perhubungan',
                'urutan' => 10,
                'link_download' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/KP-SKJ-16-TAHUN-2025-22072025142932.pdf',
                'is_active' => true,
            ],
            [
                'judul' => 'Keputusan Sekretaris Jenderal Kemenhub Nomor KP-SKJ 25 Tahun 2024',
                'nomor' => 'KP-SKJ 25 Tahun 2024',
                'tahun' => 2024,
                'deskripsi' => 'tentang Daftar Informasi Publik (DIP) Kementerian Perhubungan Tahun 2024',
                'kategori' => 'Kementerian Perhubungan',
                'urutan' => 11,
                'link_download' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/20240610102903.DIP_Kemenhub_Tahun_2024.pdf',
                'is_active' => true,
            ],
            [
                'judul' => 'Keputusan Sekretaris Jenderal Kemenhub Nomor KP-SKJ 24 Tahun 2024',
                'nomor' => 'KP-SKJ 24 Tahun 2024',
                'tahun' => 2024,
                'deskripsi' => 'tentang Perubahan Atas Keputusan Sekretaris Jenderal Nomor KP 591 Tahun 2023 tentang Informasi yang Dikecualikan',
                'kategori' => 'Kementerian Perhubungan',
                'urutan' => 12,
                'link_download' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/20240610103259.DIK_Kemenhub_Tahun_2024.pdf',
                'is_active' => true,
            ],

            // =========================================================================
            // 4. PKTJ TEGAL & BPSDM PERHUBUNGAN
            // =========================================================================
            [
                'judul' => 'Keputusan Direktur PKTJ tentang Penetapan Pengelola PPID Pelaksana PKTJ Tegal',
                'nomor' => 'SK Direktur PKTJ 2025',
                'tahun' => 2025,
                'deskripsi' => 'tentang Struktur Organisasi dan Penunjukan Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana Politeknik Keselamatan Transportasi Jalan Tegal',
                'kategori' => 'PKTJ Tegal',
                'urutan' => 13,
                'link_download' => 'https://pktj.ac.id/ppid',
                'is_active' => true,
            ],
            [
                'judul' => 'Maklumat Pelayanan Informasi Publik PPID PKTJ Tegal',
                'nomor' => 'Maklumat PKTJ 2025/2026',
                'tahun' => 2025,
                'deskripsi' => 'Komitmen dan Janji Pelayanan Informasi Publik Politeknik Keselamatan Transportasi Jalan Sesuai Standar Layanan KIP',
                'kategori' => 'PKTJ Tegal',
                'urutan' => 14,
                'link_download' => 'https://pktj.ac.id/ppid',
                'is_active' => true,
            ],
            [
                'judul' => 'SOP Tata Kelola dan Pelayanan Informasi Publik Politeknik Keselamatan Transportasi Jalan',
                'nomor' => 'SOP-PPID-PKTJ-01',
                'tahun' => 2025,
                'deskripsi' => 'Pedoman Teknis dan Alur Prosedur Pelayanan Permohonan Informasi, Pengajuan Keberatan, Pendokumentasian, dan Uji Konsekuensi Informasi di PKTJ',
                'kategori' => 'PKTJ Tegal',
                'urutan' => 15,
                'link_download' => 'https://pktj.ac.id/ppid',
                'is_active' => true,
            ],
        ];

        foreach ($regulasiList as $reg) {
            Peraturan::updateOrCreate(
                ['judul' => $reg['judul']],
                $reg
            );
        }
    }
}
