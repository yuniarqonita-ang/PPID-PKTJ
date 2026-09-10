<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Dip2026SyncSeeder extends Seeder
{
    /**
     * Sinkronisasi Daftar Informasi Publik (DIP) Resmi 2026
     * Berdasarkan Kolom Paling Kanan (LINK DOKUMEN SENSOR UNTUK PUBLIK / _TERSENSOR)
     * - Link mengarah langsung ke dokumen berlabel _TERSENSOR.pdf
     * - Laporan Asrama (kebersihan, keluhan, perbaikan) digabung menjadi satu judul & deskripsi
     * - Kontrak, MoU, PKS, dan SPK/SPMK dipisah masing-masing dengan link tersensor spesifik
     * - Memanggil PoltradaBaliDipSeeder, PejabatSeeder, dan DefaultMenuSeeder
     */
    public function run(): void
    {
        // 1. Official Laporan Layanan & Laporan Akses (Single File Link Drive)
        if (Schema::hasTable('dokumens')) {
            $laporanSeeds = [
                [
                    'judul' => 'Laporan Tahunan Pelaksanaan Program Kerja dan Pengelolaan Keuangan PKTJ Tahun 2025',
                    'file_path' => 'https://drive.google.com/file/d/1pe1vqLCRemRpA6G5q2VpC0L6KhTGriEo/view?usp=sharing',
                    'file_name' => 'Laporan Tahunan PKTJ Tahun 2025.pdf',
                    'file_size' => '2.72 MB',
                    'file_type' => 'pdf',
                    'kategori' => 'Laporan Layanan',
                    'tanggal' => '2025-12-31',
                    'deskripsi' => 'Laporan Tahunan komprehensif memuat evaluasi program kerja, capaian operasional, dan pengelolaan keuangan Politeknik Keselamatan Transportasi Jalan Tahun Anggaran 2025.',
                    'aktif' => 1,
                    'bisa_download' => 1,
                    'is_blurred' => 0
                ],
                [
                    'judul' => 'Penyampaian Laporan Tahunan Pelayanan Informasi Publik PKTJ Tahun 2025 ke PPID Utama Kementerian Perhubungan',
                    'file_path' => 'https://drive.google.com/file/d/1NabSL0TAkoFyp7aEEiyeXbWrkBDbMGyx/view?usp=drive_link',
                    'file_name' => 'Penyampaian Laporan Permohonan Informasi PKTJ Tahun 2025.pdf',
                    'file_size' => '1.05 MB',
                    'file_type' => 'pdf',
                    'kategori' => 'Laporan Layanan',
                    'tanggal' => '2025-12-31',
                    'deskripsi' => 'Surat pengantar resmi nomor UM.006/2/16/PKTJ/2025 dan tanda terima pengiriman laporan tahunan pelayanan informasi publik PKTJ Tegal ke PPID Utama Kementerian Perhubungan.',
                    'aktif' => 1,
                    'bisa_download' => 1,
                    'is_blurred' => 0
                ],
                [
                    'judul' => 'Ringkasan Eksekutif Laporan Kinerja Instansi Pemerintah (LKjIP / LAKIP) PKTJ Tahun 2025',
                    'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                    'file_name' => 'Ringkasan_Eksekutif_LKjIP_PKTJ_2025.pdf',
                    'file_size' => '290 KB',
                    'file_type' => 'pdf',
                    'kategori' => 'Laporan Layanan',
                    'tanggal' => '2025-12-31',
                    'deskripsi' => 'Ringkasan eksekutif akuntabilitas kinerja instansi pemerintah (LKjIP) PKTJ Tahun 2025 yang merangkum pencapaian Indikator Kinerja Utama (IKU).',
                    'aktif' => 1,
                    'bisa_download' => 1,
                    'is_blurred' => 0
                ],
                [
                    'judul' => 'Laporan Tahunan Layanan Informasi Publik PKTJ Tahun 2024',
                    'file_path' => 'https://drive.google.com/file/d/1WzJYrLqNvVcXtJRU0TD8czhsJmpYgumh/view?usp=sharing',
                    'file_name' => 'Laporan_Tahunan_Layanan_Informasi_Publik_PKTJ_2024.pdf',
                    'file_size' => '3.9 MB',
                    'file_type' => 'pdf',
                    'kategori' => 'Laporan Layanan',
                    'tanggal' => '2024-12-31',
                    'deskripsi' => 'Laporan tahunan pelaksanaan pelayanan informasi publik dan keterbukaan informasi PPID Pelaksana UPT Politeknik Keselamatan Transportasi Jalan Tahun Anggaran 2024 (Dokumen Resmi B1-B4).',
                    'aktif' => 1,
                    'bisa_download' => 1,
                    'is_blurred' => 0
                ],
                [
                    'judul' => 'Laporan Tahunan Layanan Informasi Publik PKTJ Tahun 2023',
                    'file_path' => 'https://drive.google.com/file/d/1hcC1XY8hd7XWF-AHqW1fdDoUzyyED934/view?usp=sharing',
                    'file_name' => 'Laporan_Tahunan_Layanan_Informasi_Publik_PKTJ_2023.pdf',
                    'file_size' => '2.5 MB',
                    'file_type' => 'pdf',
                    'kategori' => 'Laporan Layanan',
                    'tanggal' => '2023-12-31',
                    'deskripsi' => 'Laporan tahunan pelaksanaan pelayanan informasi publik dan keterbukaan informasi PPID Pelaksana UPT Politeknik Keselamatan Transportasi Jalan Tahun Anggaran 2023.',
                    'aktif' => 1,
                    'bisa_download' => 1,
                    'is_blurred' => 0
                ],
                [
                    'judul' => 'Laporan Tahunan Layanan Informasi Publik PKTJ Tahun 2022',
                    'file_path' => 'https://drive.google.com/file/d/1qucNCvXKKfXm8XjP14hRYRE0buqa2vKD/view?usp=sharing',
                    'file_name' => 'Laporan_Tahunan_Layanan_Informasi_Publik_PKTJ_2022.pdf',
                    'file_size' => '2.1 MB',
                    'file_type' => 'pdf',
                    'kategori' => 'Laporan Layanan',
                    'tanggal' => '2022-12-31',
                    'deskripsi' => 'Laporan tahunan pelaksanaan pelayanan informasi publik dan keterbukaan informasi PPID Pelaksana UPT Politeknik Keselamatan Transportasi Jalan Tahun Anggaran 2022.',
                    'aktif' => 1,
                    'bisa_download' => 1,
                    'is_blurred' => 0
                ],
                [
                    'judul' => 'Rekapitulasi Pelayanan Informasi Publik dan Pertanyaan Masuk di Media Sosial PKTJ TA 2026',
                    'file_path' => 'https://docs.google.com/spreadsheets/d/1q8R8llMqjE8wNysRQ39q8vafcsXcvKxNRSEkIe-JR_c/edit?usp=sharing',
                    'file_name' => 'LAPORAN pertanyaan masuk di sosmed PKTJ TAHUN 2026.xlsx',
                    'file_size' => '157 KB',
                    'file_type' => 'xlsx',
                    'kategori' => 'Laporan Akses',
                    'tanggal' => '2026-08-31',
                    'deskripsi' => 'Rekapitulasi log bulanan permohonan informasi dan pertanyaan masuk di kanal media sosial resmi Politeknik Keselamatan Transportasi Jalan Tahun Berjalan 2026.',
                    'aktif' => 1,
                    'bisa_download' => 1,
                    'is_blurred' => 0
                ],
            ];

            foreach ($laporanSeeds as $ls) {
                \App\Models\Dokumen::updateOrCreate(['judul' => $ls['judul']], $ls);
            }
        }

        // 2. Delegate directly to PoltradaBaliDipSeeder for full and clean dataset
        $this->call(PoltradaBaliDipSeeder::class);

        // 3. Ensure official leadership data is synchronized
        $this->call(PejabatSeeder::class);

        // 4. Ensure navigation menu is clean and standardized
        $this->call(DefaultMenuSeeder::class);

        // 5. Update Dashboard Settings
        $updateSetting = function($key, $val) {
            DB::table('dashboards')->updateOrInsert(
                ['key' => $key],
                ['value' => $val, 'type' => 'text', 'updated_at' => now()]
            );
        };

        $updateSetting('maklumat_pelayanan_judul_hero', 'Maklumat dan Standar Biaya Layanan');
        $updateSetting('maklumat_pelayanan_judul_standar', 'Standar Biaya Layanan Informasi');
        $updateSetting('sop_keb_diagram_judul', 'Prosedur Penanganan Keberatan Informasi');
        $updateSetting('sop_perm_diagram_judul', 'Prosedur Permohonan Informasi Publik');
        $updateSetting('sop_seng_diagram_judul', 'Prosedur Pengajuan Sengketa Informasi Publik');

        // Kosongkan sop_permintaan_konten default agar tidak muncul kotak sampai admin mengisinya
        DB::table('dashboards')->where('key', 'sop_permintaan_konten')->update(['value' => '']);
    }
}
