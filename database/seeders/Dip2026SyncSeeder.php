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
            DB::table('daftar_informasis')->insert([
                'judul_informasi'    => $item['judul'],
                'kategori'           => $kategori,
                'tipe_informasi'     => 'dokumen',
                'isi_informasi'      => $item['ringkasan'],
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

        // 5. INFORMASI BERKALA (21 Items Resmi Kolom Paling Kanan - TERSENSOR)
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
                'link' => 'https://drive.google.com/file/d/1rvltyYA70k88Icn1dUpuyD9jpSlhhdDY/view?usp=drive_link',
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
                'link' => 'https://drive.google.com/file/d/1k9sOdvKbToFwcTiE2McZ2B73KO0_4fkY/view?usp=drive_link',
            ],
            [
                'judul' => 'Jadwal Kegiatan Softskill Taruna Tahun 2025',
                'ringkasan' => 'Jadwal kegiatan softskill taruna tentang literasi kesehatan mental tahun 2025',
                'pejabat' => 'Pengasuh Praja',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1xPtTCgRHcI_uA9vlTRv2QvYPm42DINeH/view?usp=drive_link',
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
                'link' => 'https://drive.google.com/file/d/1tY4S4T279H3GIRLw1Pkd96TBUZdNQrJS/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Kegiatan Pengawasan Mutu dan Manajemen Sistem Penyelenggaraan Makanan',
                'ringkasan' => 'Laporan kegiatan pengawasan mutu dan manajemen sistem penyelenggaraan makanan, yang berisi evaluasi penyelenggaraan permakanan taruna selama tahun 2025',
                'pejabat' => 'Nutrisionis Terampil',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1lbc6mAZtkDVIkVrpsQg8uuYBn_FL33zn/view?usp=drive_link',
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
                'link' => 'https://drive.google.com/file/d/1AzLms44HlcLDJncxnUcDV_wFZZOgxdch/view?usp=drive_link',
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
                'link' => 'https://drive.google.com/file/d/1xPtTCgRHcI_uA9vlTRv2QvYPm42DINeH/view?usp=drive_link',
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
                'link' => 'https://drive.google.com/file/d/1dklOY3q0RlCz6m-NTLlgjwG1mG1anUrk/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Perkuliahan Semester Genap',
                'ringkasan' => 'Laporan Evaluasi dan Monitoring Perkuliahan Semester Genap Tahun Akademik 2024/2025',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Program Studi RSTJ',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'selama masih berlaku',
                'link' => 'https://drive.google.com/file/d/1whVnOxu2OAIrLjGQOi4UVnSODDvWSFtN/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Tracer Study 2025',
                'ringkasan' => 'Laporan hasil kegiatan tracer study yang dilaksanakan terhadap lulusan tahun 2024 dan 2023 dari tiga program studi (RSTJ, TRO, TO).',
                'pejabat' => 'Katim Substansi Bidang Administrasi Ketarunaan dan Alumni',
                'penerbit' => 'Tim Administrasi Ketarunaan dan Alumni',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 (lima) tahun',
                'link' => 'https://drive.google.com/file/d/1Z03rj5TTeSRbyoJbvoI1OVNeHDeJnmr2/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan Ujikom Andalalin',
                'ringkasan' => 'Diawali dengan kegiatan Pra Ujikom Penilai Andalalin pd tgl 14 s.d 15 Agustus 2025 dan dilanjutkan dengan Ujikom Penilai Andalalin pd tgl 19 s.d 21 Agustus 2025',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '12 bulan',
                'link' => 'https://drive.google.com/file/d/1hgqfwqJATIAUnQMK89_WqFOsXvgNyxLq/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan Ujikom Pembantu PKB',
                'ringkasan' => 'Diawali dengan kegiatan Pra Ujikom Pembantu PKB pd tgl 13 s.d 15 dan dilanjutkan dengan Ujikom Pembantu PKB pd tgl 19 s.d 21 Agustus 2025 yang diikuti oleh 31 Mahasiswa/i Mandiri',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1bkVuYjckwiflyopuFsEhQn75Jr3KUAmn/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan Ujikom Pemeliharaan Jalan',
                'ringkasan' => 'Diawali dengan kegiatan Pelatihan Pemeliharaan Jalan pd tgl 15 Agustus 2025 dan dilanjutkan dengan Ujikom/Assesment Pemeliharaan Jalan pd tgl 28 Agustus 2025',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '12 bulan',
                'link' => 'https://drive.google.com/file/d/1NhA8-ImFldPpGCTGJm0YzEnmSK4zgJnn/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan Ujikom Penguji Berkala Kendaraan Bermotor Tingkat 3',
                'ringkasan' => 'Pelaksanaan Uji Kompetensi Penguji Berkala Kendaraan Bermotor Tingkat 3 bagi lulusan mahasiswa PKTJ',
                'pejabat' => 'Kepala Progam Studi Diploma III Teknologi Otomotif (TO)',
                'penerbit' => 'Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/drive/folders/10bFBQqAABU4xr-UZ4-nD9n_AjTKuVl9U?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan Ujikom Sistem Manajemen Keselamatan',
                'ringkasan' => 'Diawali dengan kegiatan Pra Ujikom SMK pd tgl 13 s.d 14 dan dilanjutkan dengan Ujikom SMK pd tgl 18 s.d 19 Agustus 2025 yang diikuti oleh 57 Mahasiswa/i Pola Pembibitan (Polbit)',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/13R7DxU7BzK53vXcvyDPZaGFA2HQvucVz/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan UTS dan UAS - Nota Dinas Pelaksanaan No. 86',
                'ringkasan' => 'Pelaksanaan mengikuti Kalender Akademik didukung dengan 7x pertemuan pembelajaran, minimal 6x pertemuan untuk pelaksanaan kegiatan UTS dan UAS 14x pertemuan',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/file/d/1skDjqrJrioh7lhKpvN1fAWYkSsqPKFj-/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan UTS dan UAS - Nota Dinas Pelaksanaan UAS Ganjil',
                'ringkasan' => 'Pelaksanaan mengikuti Kalender Akademik didukung dengan 7x pertemuan pembelajaran, minimal 6x pertemuan untuk pelaksanaan kegiatan UTS dan UAS 14x pertemuan',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1ez4_J3ZyLFN41OY-tBchy3W0k8AeOAAx/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan UTS dan UAS - Pengumuman Pelaksanaan UTS Ganjil',
                'ringkasan' => 'Pelaksanaan mengikuti Kalender Akademik didukung dengan 7x pertemuan pembelajaran, minimal 6x pertemuan untuk pelaksanaan kegiatan UTS dan UAS 14x pertemuan',
                'pejabat' => 'Kepala Progam Studi Diploma III Teknologi Otomotif (TO)',
                'penerbit' => 'Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1hlV5Ac65SPio7VLsn9E8Zvx5Deecatxe/view?usp=drive_link',
            ],
            [
                'judul' => 'Screening TB kepada Taruna/i PKTJ',
                'ringkasan' => 'Kegiatan rutin screening TB/kesehatan yang merupakan program kerjasama dengan Dinas Kesehatan Kota Tegal',
                'pejabat' => 'Kanit Kesehatan',
                'penerbit' => 'Nakes Unit Kesehatan',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1cs5uk0mhMAnJA50LLm7MTgTkC9a7fULp/view?usp=drive_link',
            ],
            [
                'judul' => 'Surveillance ISO 21001 : 2018',
                'ringkasan' => 'Audit Surveillance dari SGS Indonesia, Penerapan ISO 21001 : 2018. Standar ini menekankan pentingnya kepuasan peserta didik, proses pembelajaran yang efektif, pemenuhan kebutuhan seluruh pemangku kepentingan pendidikan, serta perbaikan berkelanjutan dalam layanan pendidikan',
                'pejabat' => 'Ka SPM',
                'penerbit' => 'Tim SPM',
                'bentuk' => 'Soft Copy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '2 tahun',
                'link' => 'https://drive.google.com/file/d/1RP4Mq6eUcA24hvZMDNmL7XxPp27A_Vhz/view?usp=drive_link',
            ],
            [
                'judul' => 'Survey Kepuasan Masyarakat Semester I',
                'ringkasan' => 'Laporan berisi nilai Indeks Kepuasan Masyarakat (IKM) dan nilai Indeks Persepsi Korupsi (IPK) Semester I Tahun 2025',
                'pejabat' => 'Ka SPM',
                'penerbit' => 'Tim SPM',
                'bentuk' => 'Soft Copy dan Hard Copy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 tahun',
                'link' => 'https://drive.google.com/file/d/1gYZNEK_IFgG0hlYSmbHXG9R1Q688Z68_/view?usp=drive_link',
            ],
        ];

        foreach ($berkalaData as $item) {
            $insertItem('informasi-berkala', $item);
        }

        // 6. INFORMASI SERTA MERTA (10 Items Resmi Kolom Paling Kanan - TERSENSOR)
        $sertaMertaData = [
            [
                'judul' => 'Daftar MoU / Kerjasama Perpustakaan',
                'ringkasan' => 'Dokumen kerjasama perpustakaan PKTJ dengan perpustakaan perguruan tinggi lain atau instansi mitra.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Kerjasama / Perpustakaan PKTJ',
                'bentuk' => 'Hardcopy & Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Sesuai masa berlaku MoU (biasanya 3-5 tahun)',
                'link' => 'https://drive.google.com/drive/folders/1P5NJV8CwYmMiGFawvehtpbGQHrTeBBNG?usp=drive_link',
            ],
            [
                'judul' => 'Jumlah Kunjungan Pasien Klinik Pratama PKTJ Tahun 2025',
                'ringkasan' => 'Kunjungan Pasien tahun 2025 meliputi taruna, pegawai, dan masyarakat umum',
                'pejabat' => 'Kanit Kesehatan',
                'penerbit' => 'Nakes Unit Kesehatan',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ Tegal di tiap akhir bulan',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1jY-CngE5yJKKUDvqpVAKa_SC5Ab2cFME/view?usp=sharing',
            ],
            [
                'judul' => 'Laporan Kebersihan, Penanganan Keluhan, dan Perbaikan Fasilitas Asrama',
                'ringkasan' => 'Laporan berkala kegiatan pengelolaan asrama mencakup pengawasan kebersihan lingkungan asrama, penanganan dan tindak lanjut keluhan penghuni asrama, serta perbaikan sarana dan prasarana fasilitas asrama PKTJ.',
                'pejabat' => 'Kanit Asrama',
                'penerbit' => 'Unit Asrama',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ Tegal di tiap akhir bulan',
                'tempat' => 'Tegal',
                'retensi' => '2 tahun',
                'link' => 'https://drive.google.com/drive/folders/1qU81c6u8w7zy6oCCF2mLxN_FxIouESxW?usp=drive_link',
            ],
            [
                'judul' => 'Pemeriksaan Kesehatan Gratis Pengemudi Ojek Online Dalam Rangka Hari Perhubungan Nasional Tahun 2025',
                'ringkasan' => 'Kegiatan pemeriksaan kesehatan gratis meliputi pemeriksaan tekanan darah, gula darah sewaktu, kolesterol, dan asam urat bagi pengemudi Ojek online',
                'pejabat' => 'Kanit Kesehatan',
                'penerbit' => 'Nakes Unit Kesehatan',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1PCJ7TjFLh--7npmi85dXwP8Yi6cO6wlF/view?usp=drive_link',
            ],
            [
                'judul' => 'Pemeriksaan Kesehatan Gratis Pengemudi Ojek Online Dalam Rangka HUT RI ke 80',
                'ringkasan' => 'Kegiatan pemeriksaan kesehatan gratis meliputi pemeriksaan tekanan darah, gula darah sewaktu, kolesterol, dan asam urat bagi pengemudi Ojek online',
                'pejabat' => 'Kanit Kesehatan',
                'penerbit' => 'Nakes Unit Kesehatan',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1k1lxiDvvRFcCvI5OIfXOZbfo00Bw0sZI/view?usp=drive_link',
            ],
            [
                'judul' => 'Penghapusan BMN Tahun 2025',
                'ringkasan' => 'Surat Permohonan Penghapusan BMN Berupa Bangunan Gedung dengan Kondisi Rusak Berat pada PKTJ Tegal beserta lampiran berkas kelengkapan.',
                'pejabat' => 'Kepala Bagian Keuangan dan Administrasi Umum',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '10 Tahun',
                'link' => 'https://drive.google.com/file/d/1aRbozmigMYPH-3LQwjApjdCT4iI1OuAG/view?usp=drive_link',
            ],
            [
                'judul' => 'Profil Program Studi RSTJ',
                'ringkasan' => 'Memuat Visi Misi, Lulusan, Dosen, Prestasi Taruna/i Prodi RSTJ dan kegiatan Pembelajaran serta Kurikulum Prodi RSTJ',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama masih berlaku / Diperbarui jika ada perubahan',
                'link' => 'https://drive.google.com/file/d/1qOzwfGGg3V2edOgdxBD4Fjj1DncRU30X/view?usp=drive_link',
            ],
            [
                'judul' => 'Profil Unit Perpustakaan PKTJ',
                'ringkasan' => 'Memuat sejarah, visi misi, struktur organisasi, jam layanan, dan fasilitas perpustakaan.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Hardcopy & Softcopy',
                'waktu' => 'Tegal, 2023',
                'tempat' => 'Tegal',
                'retensi' => 'Selama berlaku / Diperbarui jika ada perubahan',
                'link' => 'https://drive.google.com/file/d/1hcC1XY8hd7XWF-AHqW1fdDoUzyyED934/view?usp=drive_link',
            ],
            [
                'judul' => 'Sosialisasi P4GN (Pencegahan, Pemberantasan, Penyalahgunaan dan Peredaran Gelap Narkotika) kepada Taruna PKTJ',
                'ringkasan' => 'Kegiatan Sosialisasi P4GN dilakukan secara daring/luring kepada seluruh taruna/i PKTJ',
                'pejabat' => 'Kanit Kesehatan',
                'penerbit' => 'Dokter Unit Kesehatan PKTJ',
                'bentuk' => 'Softfile',
                'waktu' => 'PKTJ Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1CZsernmJspWDeXuq0c-1V0LE0ufnsMZK/view?usp=drive_link',
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
                'link' => 'https://drive.google.com/file/d/1XY_1ktDrqGwQJ2nuK_sslnYrP0Ddv4nx/view?usp=drive_link',
            ],
        ];

        foreach ($sertaMertaData as $item) {
            $insertItem('informasi-serta-merta', $item);
        }

        // 7. INFORMASI SETIAP SAAT (22 Items Resmi Kolom Paling Kanan - TERSENSOR)
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
                'link' => 'https://drive.google.com/file/d/1Yq1cQU5fVWRM0ogGBIlONl-p6AtbHcOT/view?usp=drive_link',
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
                'link' => 'https://drive.google.com/file/d/14Z2niInObd5DyMfw1LL_9QYdX3jGbPS6/view?usp=drive_link',
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
                'link' => 'https://drive.google.com/file/d/1GRN5PAXrJwYUc01QqVskbyHpF-Uo-WKi/view?usp=drive_link',
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
                'link' => 'https://drive.google.com/file/d/1JzIqbOa5BZy49tJYKfdICmkh1Ysi0yNQ/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Pedoman Pembelajaran TeFa RSTJ',
                'ringkasan' => 'Pedoman Pelaksanaan Pembelajaran Teaching Factory (TeFa) Prodi RSTJ',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/file/d/1Q4KCRsbVOCqY2VTlOhwZ8OOnBRmnkN54/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Progres TeFa RSTJ Semester Ganjil',
                'ringkasan' => 'Laporan Progres Pembelajaran Teaching Factory (TeFa) Prodi RSTJ Semester Ganjil 2025-2026',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/file/d/1xYhKYTH3JSQyrZsnV09DR28GIpPgRq9l/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Produk TeFa RSTJ Kelas A',
                'ringkasan' => 'Dokumentasi dan Laporan Produk TeFa RSTJ Kelas A (Kelompok 1 sampai 6)',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/file/d/1a-yG1DvOuosOMRKt5-77hUGzlL5N3_vo/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Produk TeFa RSTJ Kelas B',
                'ringkasan' => 'Dokumentasi dan Laporan Produk TeFa RSTJ Kelas B (Kelompok 1 sampai 6)',
                'pejabat' => 'Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 bulan',
                'link' => 'https://drive.google.com/file/d/1z5qQ6l5LGVjSaClxwCaSDIYDwm3ds66-/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - SK Penunjukan Tim TeFa 2025',
                'ringkasan' => 'Surat Keputusan Direktur PKTJ tentang Penunjukan Tim Pengelola Teaching Factory (TeFa) Tahun 2025',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1QFpmVataYKiB9UNgr_l9-p0Z7m4dchhG/view?usp=drive_link',
            ],
            [
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Produk TeFa Prodi TRO',
                'ringkasan' => 'Kumpulan Logbook dan Laporan Mingguan Project Teaching Factory (TeFa) Program Studi TRO',
                'pejabat' => 'Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/drive/folders/1-KoetVPqIyiJ3VXd3EaVwpZkaC2bzRcB?usp=drive_link',
            ],
            [
                'judul' => 'Kontrak',
                'ringkasan' => 'Kontrak pengujian ketidakrataan dan kekesatan jalan serta dokumen kesepakatan atau perjanjian mengikat secara hukum antara Politeknik Keselamatan Transportasi Jalan dengan pihak ketiga/penyedia jasa.',
                'pejabat' => 'Katim Kerjasama',
                'penerbit' => 'Tim Kerjasama',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 tahun',
                'link' => 'https://drive.google.com/file/d/1LUoIDHDwphNHlW6a0lx1v1waAobKJPxy/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Kebersihan, Penanganan Keluhan, dan Perbaikan Fasilitas Asrama',
                'ringkasan' => 'Laporan berkala kegiatan pengelolaan asrama mencakup pengawasan kebersihan lingkungan asrama, penanganan dan tindak lanjut keluhan penghuni asrama, serta perbaikan sarana dan prasarana fasilitas asrama PKTJ.',
                'pejabat' => 'Kanit Asrama',
                'penerbit' => 'Unit Asrama',
                'bentuk' => 'softfile',
                'waktu' => 'PKTJ Tegal di tiap akhir bulan',
                'tempat' => 'Tegal',
                'retensi' => '2 tahun',
                'link' => 'https://drive.google.com/drive/folders/1qU81c6u8w7zy6oCCF2mLxN_FxIouESxW?usp=drive_link',
            ],
            [
                'judul' => 'MoU',
                'ringkasan' => 'Dokumen Kesepakatan Bersama (Memorandum of Understanding) antara PKTJ Tegal dengan PT Suzuki Indomobil Motor serta mitra industri lainnya untuk penjajakan kerja sama tridharma perguruan tinggi.',
                'pejabat' => 'Katim Kerjasama',
                'penerbit' => 'Tim Kerjasama',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1lm5RH7NM7YTS5OETZyY1nJ2iLMxgRWtD/view?usp=drive_link',
            ],
            [
                'judul' => 'Perjanjian Kerja Sama',
                'ringkasan' => 'Dokumen Perjanjian Kerja Sama (PKS) dan Implementation Agreement (IA) antara Politeknik Keselamatan Transportasi Jalan dengan Fakultas Psikologi Universitas Diponegoro (Undip) serta mitra institusi terkait.',
                'pejabat' => 'Katim Kerjasama',
                'penerbit' => 'Tim Kerjasama',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '5 tahun',
                'link' => 'https://drive.google.com/file/d/1opXQdCZ9G3kKIqTcmgEcEbU-Bxjc0mUz/view?usp=drive_link',
            ],
            [
                'judul' => 'Program Kerja SPI',
                'ringkasan' => 'Program Kerja SPI merupakan dokumen yang berisi tentang rencana tahunan kegiatan pengawasan (audit, reviu, evaluasi) untuk memastikan tujuan organisasi tercapai, pengelolaan keuangan dan aset aman, serta kepatuhan terhadap aturan di PKTJ.',
                'pejabat' => 'Kepala SPI',
                'penerbit' => 'SPI Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy dan Hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 (satu) tahun',
                'link' => 'https://drive.google.com/file/d/11SVPDZoPM8apJYh8KDgFGrip_92Kz9zm/view?usp=drive_link',
            ],
            [
                'judul' => 'Rekapan Pengelolaan CCTV Kampus PKTJ',
                'ringkasan' => 'Rekapan monitoring operasional, pemeliharaan berkala, dan data penempatan CCTV Kampus Politeknik Keselamatan Transportasi Jalan.',
                'pejabat' => 'Kanit TI / Pengelola Sarpras',
                'penerbit' => 'Unit Teknologi Informasi',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 tahun',
                'link' => 'https://drive.google.com/drive/folders/1kBOEMVmvaqK-GkNwlFkldbE0tnXIDWxW?usp=drive_link',
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
                'judul' => 'SOP Pemberian Layanan Jasa Perpustakaan Dan Informasi Mengenai Sumber Pembelajaran',
                'ringkasan' => 'Standar Operasional Prosedur pelaksanaan layanan jasa perpustakaan, sirkulasi peminjaman, dan akses informasi sumber pembelajaran di PKTJ.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama berlaku',
                'link' => 'https://drive.google.com/drive/folders/12LcansqF1ms4T-fTUj1BRyJm-ZK94TaA?usp=drive_link',
            ],
            [
                'judul' => 'SOP Pembuatan Surat Bebas Pustaka',
                'ringkasan' => 'Standar Operasional Prosedur penerbitan surat keterangan bebas pinjaman bahan pustaka bagi taruna dan pegawai PKTJ.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama berlaku',
                'link' => 'https://drive.google.com/drive/folders/1xm0_eKUn8Sd419Cr3f_lgj5y2PjlUddg?usp=drive_link',
            ],
            [
                'judul' => 'SOP Pengadaan Bahan Pustaka',
                'ringkasan' => 'Standar Operasional Prosedur tata cara usulan, seleksi, dan pengadaan bahan pustaka baru di Perpustakaan PKTJ.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama berlaku',
                'link' => 'https://drive.google.com/drive/folders/1FE5gflmJ0NoXv51HMzmbz4Q2HRX21zqA?usp=drive_link',
            ],
            [
                'judul' => 'SPK/SPMK (Surat Perjanjian Kerja)/(Surat Perintah Mulai Kerja)',
                'ringkasan' => 'Surat Perjanjian Kerja (SPK) dan Surat Perintah Mulai Kerja (SPMK) pekerjaan jasa uji reflektifitas tahap I serta pelaksanaan proyek pengadaan sarana/prasarana di lingkungan PKTJ.',
                'pejabat' => 'Katim Kerjasama',
                'penerbit' => 'Tim Kerjasama',
                'bentuk' => 'softcopy dan hardcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => '1 tahun',
                'link' => 'https://drive.google.com/file/d/1jP_z3VAlXuB4Dti4_UPhEv_GAD-rJszw/view?usp=drive_link',
            ],
            [
                'judul' => 'Struktur Organisasi Unit Teknologi Informasi',
                'ringkasan' => 'Bagan susunan struktur organisasi, pembagian tugas dan fungsi personel Unit Teknologi Informasi PKTJ.',
                'pejabat' => 'Kepala Unit Teknologi Informasi',
                'penerbit' => 'Unit TI PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => 'Tegal, 2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama berlaku',
                'link' => 'https://drive.google.com/file/d/1lLKLUvNEDY8OAUCoOIvV24aFZg3u9JHJ/view?usp=drive_link',
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
