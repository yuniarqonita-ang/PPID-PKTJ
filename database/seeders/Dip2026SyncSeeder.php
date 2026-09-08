<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Dip2026SyncSeeder extends Seeder
{
    /**
     * Sinkronisasi Daftar Informasi Publik (DIP) Resmi 2026
     * Berdasarkan Kolom Paling Kanan (LINK DOKUMEN SENSOR UNTUK PUBLIK)
     * Hanya memasukkan dokumen yang telah memiliki link sensor resmi.
     */
    public function run(): void
    {
        // 1. Update Pejabat Title
        if (Schema::hasTable('pejabats')) {
            DB::table('pejabats')
                ->where('nama', 'like', '%SUGIANTO%')
                ->update(['jabatan' => 'Kepala Bagian Keuangan dan Administrasi Umum']);
        }

        // 2. Official Laporan Layanan & Laporan Akses (Single File Link Drive)
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
                    'judul' => 'Rekapitulasi Pelayanan Informasi Publik Bulanan PKTJ TA 2024',
                    'file_path' => 'https://drive.google.com/file/d/1qucNCvXKKfXm8XjP14hRYRE0buqa2vKD/view?usp=sharing',
                    'file_name' => 'Rekapitulasi_Layanan_Informasi_Bulanan_PKTJ_2024.pdf',
                    'file_size' => '2.1 MB',
                    'file_type' => 'pdf',
                    'kategori' => 'Laporan Akses',
                    'tanggal' => '2024-12-31',
                    'deskripsi' => 'Rekapitulasi permohonan informasi publik bulanan Politeknik Keselamatan Transportasi Jalan Tahun Anggaran 2024.',
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

        // 3. Clean legacy tables to prevent stale or duplicate entries
        if (Schema::hasTable('informasi_berkalas')) {
            DB::table('informasi_berkalas')->delete();
        }
        if (Schema::hasTable('informasi_sertamertas')) {
            DB::table('informasi_sertamertas')->delete();
        }
        if (Schema::hasTable('informasi_setiap_saats')) {
            DB::table('informasi_setiap_saats')->delete();
        }
        if (Schema::hasTable('informasi_setiapsaats')) {
            DB::table('informasi_setiapsaats')->delete();
        }

        // 4. Clean daftar_informasis (keep informasi-dikecualikan)
        if (Schema::hasTable('daftar_informasis')) {
            DB::table('daftar_informasis')->where('kategori', '!=', 'informasi-dikecualikan')->delete();
        }

        // Helper to insert item
        $insertItem = function (string $kategori, array $item) {
            $richContent = '<p>' . htmlspecialchars($item['ringkasan']) . '</p>' .
                '<div style="margin-top: 14px; padding: 14px 18px; background-color: #f0f7ff; border-left: 4px solid #004a99; border-radius: 8px;">' .
                '<p style="margin: 0; font-size: 14px; color: #1e293b;">' .
                '<strong>Tautan Dokumen Resmi Google Drive:</strong><br>' .
                '<a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700; display: inline-block; margin-top: 6px;">' .
                '<i class="fas fa-external-link-alt" style="margin-right: 6px;"></i> Buka Dokumen (Google Drive)' .
                '</a>' .
                '</p>' .
                '</div>';

            DB::table('daftar_informasis')->insert([
                'judul_informasi'    => $item['judul'],
                'kategori'           => $kategori,
                'tipe_informasi'     => 'dokumen',
                'isi_informasi'      => $richContent,
                'pejabat_penguasa'   => $item['pejabat'] ?? 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit_informasi' => $item['penerbit'] ?? 'Politeknik Keselamatan Transportasi Jalan',
                'tempat_pembuatan'   => $item['tempat'] ?? 'Tegal',
                'penanggung_jawab'   => $item['penerbit'] ?? 'PKTJ Tegal',
                'waktu_pembuatan'    => $item['waktu'] ?? '2025',
                'bentuk_informasi'   => $item['bentuk'] ?? 'Softcopy',
                'jangka_waktu'       => $item['retensi'] ?? '1 Tahun',
                'file_informasi'     => $item['link'],
                'aktif'              => 1,
                'is_blurred'         => 0,
                'bisa_download'      => 1,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        };

        // 5. INFORMASI BERKALA (20 Items Resmi Kolom Paling Kanan)
        $berkalaData = [
            [
                'judul' => 'Akreditasi Prodi',
                'ringkasan' => 'Dokumen Laporan Evaluasi Diri Program Studi (LED), dan Laporan Kinerja Program Studi (LKPS) Prodi RSTJ, TRO, TO yang di Upload pada sistem SAKTI Lam Teknik untuk Akreditasi Prodi',
                'pejabat' => 'Ka SPM',
                'penerbit' => 'Tim SPM dan masing-masing Prodi',
                'bentuk' => 'Soft Copy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1cn3kpfAolP2XXpMwIeFjIbyLyJzMsDGT/view?usp=drive_link',
            ],
            [
                'judul' => 'Audit Mutu Internal',
                'ringkasan' => 'Audit Mutu Internal Tahun 2025 yang dilakukan oleh Auditor internal kepada masing-masing bagian atau Auditee',
                'pejabat' => 'Ka SPM',
                'penerbit' => 'Tim SPM dan Auditor',
                'bentuk' => 'Soft Copy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '2 tahun',
                'link' => 'https://drive.google.com/file/d/1SgWVM5rXisRA03X2mP1V4XE-n_vx7n1A/view?usp=drive_link',
            ],
            [
                'judul' => 'Jadwal Kegiatan Softskill Taruna Tahun 2025',
                'ringkasan' => 'Jadwal kegiatan softskill taruna tentang literasi kesehatan menta; tahun 2025',
                'pejabat' => 'Pengasuh Praja',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1UKgitogU1fpLfSizig91wbB_XVHSEgxz/view?usp=drive_link',
            ],
            [
                'judul' => 'Jadwal Perkuliahan D3 Teknologi Otomotif Semester Ganjil TA 2025/2026',
                'ringkasan' => 'Membahas ploting dosen terlebih dahulu untuk penyusunan Jadwal Perkuliahan/ semester',
                'pejabat' => 'Kepala Progam Studi Diploma III Teknologi Otomotif (TO)',
                'penerbit' => 'Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1P4_gCmIeBuj2-NKea-66BFfCutwCc7UX/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Kegiatan Pengawasan Mutu dan Manajemen Sistem Penyelenggaraan Makanan',
                'ringkasan' => 'Laporan kegiatan pengawasan mutu dan manajemen sistem penyelenggawaan makanan, yang berisi evaluasi penyelenggaraan permakanan taruna selama tahun 2025',
                'pejabat' => 'Nutrisionis Terampil',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/12hNO6rPTU_0uWUe7jht2aYNH0vGK2M62/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Kegiatan Pengukuran Indeks Massa Tubuh (IMT) Taruna Tahun 2025',
                'ringkasan' => 'Laporan kegiatan pengukuran Indeks Massa Tubuh (IMT) yang berisi hasil pengukuran Indeks Massa Tubuh (IMT) Taruna pada Semester 1 dan Semester 2 Tahun 2025',
                'pejabat' => 'Nutrisionis Terampil',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1Yfm4P60ku-VES3DguWMX-hUmwKPYIP2e/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Kegiatan Softkill Taruna Tahun 2025',
                'ringkasan' => 'Laporan kegiatan softkill taruna tentang literasi kesehatan mental tahun 2025',
                'pejabat' => 'Pengasuh Praja',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1IfqfbuDqsbUskq1H_tFHUwRJcxuoynga/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Penilian Samapta Periodik Taruna Tahun 2025',
                'ringkasan' => 'Laporan penilaian samapta periodik berisi hasil penilaian samapta atau kebugaran jasmani taruna yang dilakukan pada semester ganjil dan semester genap tahun 2025',
                'pejabat' => 'Pengasuh Praja',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1OfKfPGUfovfe34wYQ0IvmB-Gn0JJEynA/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Perkuliahan Semester Genap',
                'ringkasan' => 'Laporan Perkuliahan Semester Genap',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Program Studi RSTJ',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'selama masih berlaku',
                'link' => 'https://docs.google.com/document/d/1zi2nbLa-2L8tMP9WRwI2uzwUzuUu5A16/edit?usp=drive_link&ouid=104167484510276306286&rtpof=true&sd=true',
            ],
            [
                'judul' => 'Laporan Tracer Study 2025',
                'ringkasan' => 'Laporan ini merupakan hasil dari kegiatan tracer study yang dilaksanakan
terhadap lulusan tahun 2024 dan 2023 dari tiga program studi, yaitu Sarjana Terapan
Rekayasa Sistem Transportasi Jalan (RSTJ), Sarjana Terapan Teknologi Rekayasa
Otomotif (TRO), dan Diploma III Teknologi Otomotif (TO).',
                'pejabat' => 'Katim Substansi Bidang Administrasi Ketarunaan dan Alumni',
                'penerbit' => 'Tim Administrasi Ketarunaan dan Alumni',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 (lima) tahun',
                'link' => 'https://drive.google.com/file/d/1_R9FtirHJn8EYshWXI8JpgmJ9ad1SkWO/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan Ujikom Andalalin',
                'ringkasan' => 'Diawali dengan kegiatan Pra Ujikom Penilai Andalalin pd tgl 14 s.d 15 Agustus 2025dan di lanjutkan dengan Ujikom Penilai Andalalin pd tgl 19 s.d 21 Agustus 2025',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '12 bulan',
                'link' => 'https://drive.google.com/file/d/1Ilhf0YdRhQ7dxrekCkvdzJ4CJCtaGPYP/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan Ujikom Pembantu PKB',
                'ringkasan' => 'Diawali dengan kegiatan Pra Ujikom Pembantu PKB pd tgl 13 s.d 15 dan di lanjutkan dengan Ujikom Pembantu PKB pd tgl 19 s.d 21 Agustus 2025 yang diikuti oleh 31 Mahasiswa/i Mandiri',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1T0e51-oIN1zi70Tp96Et7tu2WheeAXa7/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan Ujikom Pemeliharaan Jalan',
                'ringkasan' => 'Diawali dengan kegiatan Pelatihan Pemeliharaan Jalan pd tgl 15 Agustus 2025 dan di lanjutkan dengan Ujikom/Assesment Pemeliharaan Jalan pd tgl 28 Agustus 2025',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '12 bulan',
                'link' => 'https://drive.google.com/file/d/1qnwCoURKV1qnMPuCGXVUwpFn9MlP0Jx8/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan Ujikom Sistem Manajemen Keselamatan',
                'ringkasan' => 'Diawali dengan kegiatan Pra Ujikom SMK pd tgl 13 s.d 14 dan di lanjutkan dengan Ujikom SMK pd tgl 18 s.d 19 Agustus 2025 yang diikuti oleh 57 Mahasiswa/i Pola Pembibitan (Polbit)',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1YsTHPUBSn-LhG4dhs1xFjmHrEF9UwT2s/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan UTS dan UAS - Nota Dinas Pelaksanaan No. 86',
                'ringkasan' => 'Pelaksanaan mengikuti Kalender Akademik di dukung dengan 7x pertemuan pembelajaran, minimal 6x pertemuan untuk pelaksanaan kegiata UTS dan UAS 14x pertemuan',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/file/d/15vXKG0Fm8zNr7i-tuC9gHhygv_0rgdIE/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan UTS dan UAS - Nota Dinas Pelaksanaan UAS Ganjil',
                'ringkasan' => 'Pelaksanaan mengikuti Kalender Akademik di dukung dengan 7x pertemuan pembelajaran, minimal 6x pertemuan untuk pelaksanaan kegiata UTS dan UAS 14x pertemuan',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1cFjBfLtGgOkYsjud8uMLu9qXd5jWbix8/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan UTS dan UAS - Pengumuman Pelaksanaan UTS Ganjil',
                'ringkasan' => 'Pelaksanaan mengikuti Kalender Akademik di dukung dengan 7x pertemuan pembelajaran, minimal 6x pertemuan untuk pelaksanaan kegiata UTS dan UAS 14x pertemuan',
                'pejabat' => 'Kepala Progam Studi Diploma III Teknologi Otomotif (TO)',
                'penerbit' => 'Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1gAl4oo672SWlv05qOeAupBflSJ8DY-F7/view?usp=drive_link',
            ],
            [
                'judul' => 'Screening gigi kepada taruna/i PKTJ',
                'ringkasan' => 'Kegiatan rutin screening TBC yang merupakan program dari Dinas Kesehatan Kota Tegal',
                'pejabat' => 'Kanit Kesehatan',
                'penerbit' => 'Nakes Unit Kesehatan',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ tegal',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1wt1p7rf2tFoYkEHk3nJxTrc86Oxcea5p/view?usp=drive_link',
            ],
            [
                'judul' => 'Surveillance ISO 21001 : 2018',
                'ringkasan' => 'Audit Surveillance dari SGS Indonesia, Penerapan ISO 21001 : 2018.
 Standar ini menekankan pentingnya kepuasan peserta didik, proses pembelajaran yang efektif, pemenuhan kebutuhan seluruh pemangku kepentingan pendidikan, serta perbaikan berkelanjutan dalam layanan pendidikan',
                'pejabat' => 'Ka SPM',
                'penerbit' => 'Tim SPM',
                'bentuk' => 'Soft Copy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '2 tahun',
                'link' => 'https://drive.google.com/file/d/1ipXcaEhEjIAUnyCitdhBxGV2cc2rputU/view?usp=drive_link',
            ],
            [
                'judul' => 'Survey Kepuasan Masyarakat Semester I',
                'ringkasan' => 'Laporan berisi nilai Indeks kepuasan masyarakat dan nilai indeks presepsi korupsi',
                'pejabat' => 'Ka SPM',
                'penerbit' => 'Tim SPM',
                'bentuk' => 'Soft Copy dan Hard Copy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 tahun',
                'link' => 'https://drive.google.com/drive/folders/1ZDALUWnp5ReH7QRUZt4bXYXjHlGOk6yq?usp=drive_link',
            ],
        ];

        foreach ($berkalaData as $item) {
            $insertItem('informasi-berkala', $item);
        }

        // 6. INFORMASI SERTA MERTA (8 Items Resmi Kolom Paling Kanan)
        $sertaMertaData = [
            [
                'judul' => 'Daftar MoU / Kerjasama',
                'ringkasan' => 'Dokumen kerjasama perpustakaan PKTJ dengan perpustakaan perguruan tinggi lain atau instansi.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Kerjasama / Perpustakaan PKTJ',
                'bentuk' => 'Hardcopy & Sofcopy',
                'waktu' => 'Tegal. Sesuai Tanggal MoU',
                'tempat' => 'Tegal',
                'retensi' => 'Sesuai masa berlaku MoU (biasanya 3-5 tahun)',
                'link' => 'https://drive.google.com/drive/folders/1P5NJV8CwYmMiGFawvehtpbGQHrTeBBNG?usp=drive_link',
            ],
            [
                'judul' => 'Laporan kebersihan asrama',
                'ringkasan' => 'pengecekan kebersihan asrama',
                'pejabat' => 'kanit asrama',
                'penerbit' => 'unit asrama',
                'bentuk' => 'softfile',
                'waktu' => 'PKTJ Tegal di tiap akhir bulan',
                'tempat' => 'Tegal',
                'retensi' => '2 tahun',
                'link' => 'https://drive.google.com/drive/folders/1qU81c6u8w7zy6oCCF2mLxN_FxIouESxW?usp=drive_link',
            ],
            [
                'judul' => 'Pemeriksaan Kesehatan Gratis Pengemudi Ojek Online Dalam Rangka Hari Perhubungan Nasional Tahun 2025',
                'ringkasan' => 'Kegiatan pemeriksaan kesehatan gratis meliputi pemeriksaan tekanan darah, gula darah sewaktu, kolesterol, dan asam urat bagi  pengemudi Ojek online',
                'pejabat' => 'Kanit Kesehatan',
                'penerbit' => 'Nakes Unit Kesehatan',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ Tegal',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1a3nUuc1aFcz38juWmUw-FTrpL3QkErkE/view?usp=drive_link',
            ],
            [
                'judul' => 'Pemeriksaan Kesehatan Gratis Pengemudi Ojek Online Dalam Rangka HUT RI ke 80',
                'ringkasan' => 'Kegiatan pemeriksaan kesehatan gratis meliputi pemeriksaan tekanan darah, gula darah sewaktu, kolesterol, dan asam urat bagi  pengemudi Ojek online',
                'pejabat' => 'Kanit Kesehatan',
                'penerbit' => 'Nakes Unit Kesehatan',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ Tegal',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/14qD_iSgw9QYvEDjeexFzMOqjQBE4O9R7/view?usp=drive_link',
            ],
            [
                'judul' => 'Profil Progam Studi RSTJ',
                'ringkasan' => 'Memuat Visi Misi, Lulusan, Dosen, Prestasi Taruna/i Prodi RSTJ dan kegiatan Pembelajaran Prodi RSTJ',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama masih berlaku /  Diperbarui jika ada perubahan',
                'link' => 'https://drive.google.com/drive/folders/1_uPmo1JucI1DNNpRdtWci5n0Oxyunouq?usp=drive_link',
            ],
            [
                'judul' => 'Profil Unit Perpustakaan PKTJ',
                'ringkasan' => 'Memuat sejarah, visi misi, struktur organisasi, jam layanan, dan fasilitas perpustakaan.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Hardcopy & Sofcopy',
                'waktu' => 'Tegal, 2023',
                'tempat' => 'Tegal',
                'retensi' => 'Selama berlaku / Diperbarui jika ada perubahan',
                'link' => 'https://drive.google.com/file/d/1dTJ_sBSr8JU1tnKSkavIZ1r2nUOUrMrx/view?usp=drive_link',
            ],
            [
                'judul' => 'Sosialisasi P4GN (Pencegahan, Pemberantasan, Penyalahgunaan dan Peredaran Gelap Narkotika) kepada Taruna PKTJ',
                'ringkasan' => 'Kegiatan Sosialisasi P4GN dilakukan secara online',
                'pejabat' => 'Kanit Kesehatan',
                'penerbit' => 'Dokter Unit Kesehatan PKTJ',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ Tegal',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1-Nv0oNJwzwEHTP6pUEWR9cQbTLzc-7wy/view?usp=drive_link',
            ],
            [
                'judul' => 'SPI CHARTER (Piagam SPI)',
                'ringkasan' => 'Piagam Satuan Pengawas Internal (Audit Charter SPI) adalah dokumen formal yang berisi tentang komitmen pimpinan berupa pengakuan keberadaan dan berfungsinya Satuan Pengawas Internal di sebuah organisasi. Piagam Satuan Pengawas Internal PKTJ mencakup visi, misi, kedudukan, tugas, fungsi, dan ruang lingkup serta persetujuan dan pengesahan dari Pimpinan Organisasi.',
                'pejabat' => 'Kepala SPI',
                'penerbit' => 'SPI Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy dan Hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 (satu) tahun',
                'link' => 'https://drive.google.com/file/d/1H14Y7vILtPAGoSluY3Zv9zlYk69gDPZl/view?usp=drive_link',
            ],
        ];

        foreach ($sertaMertaData as $item) {
            $insertItem('informasi-serta-merta', $item);
        }

        // 7. INFORMASI SETIAP SAAT (19 Items Resmi Kolom Paling Kanan)
        $setiapSaatData = [
            [
                'judul' => 'Dokumen Kurikulum Sarjana Terapan RSTJ (KP-BPSDMP 173/2025)',
                'ringkasan' => 'Hasil review kurikulum Prodi RSTJ. Kurikulum lama (tahun 2020) diganti dengan kurikulum baru (2025)',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama masih berlaku',
                'link' => 'https://drive.google.com/file/d/1y6IgSsr8_Nan6lx9x3MS8tNNodGIzxYM/view?usp=drive_link',
            ],
            [
                'judul' => 'Dokumen Kurikulum Sarjana Terapan TRO (KP-BPSDMP 181/2025)',
                'ringkasan' => 'Hasil review kurikulum Prodi TRO. Kurikulum lama (tahun 2020) diganti dengan kurikulum baru (2025)',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2026',
                'tempat' => 'Tegal',
                'retensi' => 'Selama masih berlaku',
                'link' => 'https://drive.google.com/file/d/1JvAj5qveSh5KW55HlTzEPNWd2XeQuFSU/view?usp=drive_link',
            ],
            [
                'judul' => 'Dokumen Kurikulum D3 Teknologi Otomotif (Kurikulum 2020)',
                'ringkasan' => 'Kurikulum Prodi TO. Kurikulum lama (tahun 2020) diganti dengan kurikulum baru (2025)',
                'pejabat' => 'Kepala Progam Studi Diploma III Teknologi Otomotif (TO)',
                'penerbit' => 'Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama masih berlaku',
                'link' => 'https://drive.google.com/file/d/1cyX-7EgNPsdcsgT2CiBt6b5skNLHGcgv/view?usp=drive_link',
            ],
            [
                'judul' => 'Dokumen Kurikulum Hasil Review D3 Teknologi Otomotif 2025',
                'ringkasan' => 'Hasil review kurikulum Prodi TO. Kurikulum lama (tahun 2020) diganti dengan kurikulum baru (2025)',
                'pejabat' => 'Kepala Progam Studi Diploma III Teknologi Otomotif (TO)',
                'penerbit' => 'Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama masih berlaku',
                'link' => 'https://drive.google.com/file/d/1jCxlNseEQufG024MQCutbXfFRLGlnjY3/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Pedoman Pembelajaran TeFa RSTJ',
                'ringkasan' => 'Pedoman TeFa RSTJ',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/file/d/1U_0Gxo_VDiR44WPU1d3kgzGUWWxwEJZM/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Progres TeFa RSTJ Semester Ganjil',
                'ringkasan' => 'Progres TeFa RSTJ',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/file/d/1thfMdVSo7D-kf2cFTtffKmGeDIg-h1gw/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Produk TeFa RSTJ Kelas A',
                'ringkasan' => 'Produk TeFa RSTJ Kelas A',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/drive/folders/1JRi9kaNpvPbNkFxWoCl-DMyRkQVRbWog?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Produk TeFa RSTJ Kelas B',
                'ringkasan' => 'Produk TeFa RSTJ Kelas B',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/drive/folders/1Q1Hlce9Fc8ndhC5vRVHcW10KdtnsGkeC?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - SK Penunjukan Tim TeFa 2025',
                'ringkasan' => 'SK PENUNJUKAN TIM TeFa 2025',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1UqUH_JDSE84qvKkT-KrdFjCb53XJTX0i/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Produk TeFa Prodi TRO',
                'ringkasan' => 'Produk TeFa TRO',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/drive/folders/1aa9YRTIqn9ivjQcX05aA-YJbj-kuC2DF?usp=drive_link',
            ],
            [
                'judul' => 'Kontrak',
                'ringkasan' => 'Kontrak adalah kesepakatan atau perjanjian mengikat secara hukum antara dua pihak atau lebih yang menciptakan kewajiban tertentu bagi masing-masing pihak, mengatur hak dan tanggung jawab mereka, serta dapat ditegakkan secara hukum jika terjadi wanprestasi, bisa dalam bentuk lisan atau tulisan, dan seringkali merupakan bagian dari perjanjian yang lebih luas (perikatan).',
                'pejabat' => 'Katim Kerjasama',
                'penerbit' => 'Tim Kerjasama',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 tahun',
                'link' => 'https://drive.google.com/drive/folders/1FbW3mYEQqomLvakp-TtHWCnm-JwPZMDh?usp=drive_link',
            ],
            [
                'judul' => 'Laporan kebersihan asrama',
                'ringkasan' => 'pengecekan kebersihan asrama',
                'pejabat' => 'kanit asrama',
                'penerbit' => 'unit asrama',
                'bentuk' => 'softfile',
                'waktu' => 'PKTJ Tegal di tiap akhir bulan',
                'tempat' => 'Tegal',
                'retensi' => '2 tahun',
                'link' => 'https://drive.google.com/drive/folders/1qU81c6u8w7zy6oCCF2mLxN_FxIouESxW?usp=drive_link',
            ],
            [
                'judul' => 'Laporan penanganan keluhan asrama',
                'ringkasan' => 'tindak lanjut penanganan kekuhan oenghuni asrama',
                'pejabat' => 'kanit asrama',
                'penerbit' => 'unit asrama',
                'bentuk' => 'softfile',
                'waktu' => 'PKTJ Tegal di tiap akhir bulan',
                'tempat' => 'Tegal',
                'retensi' => '2 tahun',
                'link' => 'https://drive.google.com/drive/folders/1v8dWY5Rpkn0raSdHKxtx21oGclXt0-W_?usp=drive_link',
            ],
            [
                'judul' => 'Laporan perbaikan fasilitas asrama',
                'ringkasan' => 'perbaikan yang dilakukan oleh tim unit asrama',
                'pejabat' => 'kanit asrama',
                'penerbit' => 'unit asrama',
                'bentuk' => 'softfile',
                'waktu' => 'PKTJ Tegal di tiap akhir bulan',
                'tempat' => 'Tegal',
                'retensi' => '2 tahun',
                'link' => 'https://drive.google.com/drive/folders/1dZYayP713qQ2FLxguvs5wGmFc1vv9Sel?usp=drive_link',
            ],
            [
                'judul' => 'MoU',
                'ringkasan' => 'MoU (Memorandum of Understanding) adalah nota kesepahaman atau perjanjian pendahuluan yang berisi pernyataan niat dan kesepakatan awal antara dua pihak atau lebih sebelum membuat kontrak formal yang lebih mengikat secara hukum. MoU berfungsi sebagai landasan awal untuk menjajaki kerja sama, menguraikan tujuan, dan ruang lingkup, namun biasanya tidak mengikat secara hukum seperti kontrak, kecuali ada klausul khusus yang ditambahkan',
                'pejabat' => 'Katim Kerjasama',
                'penerbit' => 'Tim Kerjasama',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/drive/folders/1FbW3mYEQqomLvakp-TtHWCnm-JwPZMDh?usp=drive_link',
            ],
            [
                'judul' => 'Perjanjian Kerja Sama',
                'ringkasan' => 'Perjanjian Kerja Sama (PKS) adalah kesepakatan formal dan mengikat secara hukum antara dua pihak atau lebih untuk bekerja sama mencapai tujuan bersama, yang merinci hak, kewajiban, tanggung jawab, dan pembagian sumber daya untuk suatu proyek atau usaha tertentu, seringkali lebih mengikat daripada MoU (Memorandum of Understanding) yang bersifat pra-kontrak.',
                'pejabat' => 'Katim Kerjasama',
                'penerbit' => 'Tim Kerjasama',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/drive/folders/1FbW3mYEQqomLvakp-TtHWCnm-JwPZMDh?usp=drive_link',
            ],
            [
                'judul' => 'Program Kerja SPI',
                'ringkasan' => 'Program Kerja SPI merupakan dokumen yang berisi tentang rencana tahunan kegiatan pengawasan (audit, reviu, evaluasi) untuk memastikan tujuan organisasi tercapai, pengelolaan keuangan dan aset aman, serta kepatuhan terhadap aturan, mencakup aspek kelembagaan, sistem pengendalian, SDM, dan tindak lanjut temuan audit di PKTJ.',
                'pejabat' => 'Kepala SPI',
                'penerbit' => 'SPI Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy dan Hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 (satu) tahun',
                'link' => 'https://drive.google.com/file/d/17fHyAY4ctzyzVUIPzhHM2F9o-2Hc0RSi/view?usp=drive_link',
            ],
            [
                'judul' => 'Roadmap Penelitian Dan Pengabdian Kepada Masyarakat',
                'ringkasan' => 'Roadmap Penelitian Dan Pengabdian Kepada Masyarakat Berisi Tema-Tema Penelitian dan PKM selama 5 tahun',
                'pejabat' => 'Kepala P3M',
                'penerbit' => 'P3M Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2024',
                'tempat' => 'Tegal',
                'retensi' => '5 (lima) tahun',
                'link' => 'https://drive.google.com/file/d/1kg1sCnGls8xv_ZQB2gVQK_Os2kLtu12a/view?usp=drive_link',
            ],
            [
                'judul' => 'SPK/SPMK (Surat Perjanjian Kerja)/(Surat Perintah Mulai Kerja)',
                'ringkasan' => 'Surat Perjanjian Kerja/Surat Perintah Kerja /Surat Perintah Mulai Kerja adalah dokumen legal yang mengikat secara hukum, berisi perintah resmi dari pemberi kerja (perusahaan/instansi) kepada pekerja/penyedia jasa untuk memulai suatu pekerjaan, serta merinci syarat-syarat kerja, hak, kewajiban, ruang lingkup pekerjaan, batas waktu (durasi), hingga biaya atau nilai kontrak, menjadikannya landasan hukum pelaksanaan proyek atau tugas',
                'pejabat' => 'Katim Kerjasama',
                'penerbit' => 'Tim Kerjasama',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 tahun',
                'link' => 'https://drive.google.com/drive/folders/1FbW3mYEQqomLvakp-TtHWCnm-JwPZMDh?usp=drive_link',
            ],
        ];

        foreach ($setiapSaatData as $item) {
            $insertItem('informasi-setiap-saat', $item);
        }

        // Sinkronisasi menu navigasi
        $this->call(DefaultMenuSeeder::class);

        // Update Dashboard Settings
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
