<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. DEDUPLICATE: Remove duplicate records based on file_informasi URLs
        // (keeping the lowest ID for each duplicate URL group)
        if (Schema::hasTable('daftar_informasis')) {
            $duplicateUrls = DB::table('daftar_informasis')
                ->select('file_informasi', DB::raw('COUNT(*) as count'))
                ->whereNotNull('file_informasi')
                ->where('file_informasi', '<>', '')
                ->where('file_informasi', '<>', '#')
                ->groupBy('file_informasi')
                ->having('count', '>', 1)
                ->pluck('file_informasi')
                ->toArray();

            foreach ($duplicateUrls as $url) {
                // Find all records with this file URL
                $records = DB::table('daftar_informasis')
                    ->where('file_informasi', $url)
                    ->orderBy('id', 'asc')
                    ->get();

                if ($records->count() > 1) {
                    $keepId = $records->first()->id;

                    // Delete duplicates
                    DB::table('daftar_informasis')
                        ->where('file_informasi', $url)
                        ->where('id', '<>', $keepId)
                        ->delete();
                }
            }
        }

        // 2. SEED & CATEGORIZE: Scraped documents from pktj.ac.id/tentang/98-ppid-pktj
        if (Schema::hasTable('daftar_informasis')) {
            $scrapedDocs = [
                [
                    'judul_informasi' => 'Daftar Informasi Publik PKTJ',
                    'kategori' => 'layanan-daftar',
                    'tipe_informasi' => 'berkala',
                    'isi_informasi' => 'Informasi Berkala, Informasi Setiap Saat, Informasi Serta Merta, Informasi Dikecualikan',
                    'file_informasi' => 'https://drive.google.com/file/d/12shaENmT8JCNwJh6cEYkTWPtDsslIddw/view?usp=sharing',
                ],
                [
                    'judul_informasi' => 'Video Profil PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Video profil resmi Politeknik Keselamatan Transportasi Jalan',
                    'file_informasi' => 'https://drive.google.com/file/d/13vldq7_KuOC_FamDsdlv_x-juI0YpqsB/view?usp=sharing',
                ],
                [
                    'judul_informasi' => 'Jalur Penerimaan PKTJ Tegal',
                    'kategori' => 'informasi-serta-merta',
                    'tipe_informasi' => 'sertamerta',
                    'isi_informasi' => 'Penerimaan Calon Taruna (CATAR) di Politeknik Keselamatan Transportasi Jalan dilaksanakan melalui Jalur Pola Pembibitan, Reguler, dan Mandiri.',
                    'file_informasi' => 'https://pktj.ac.id/program-studi/34-jalur-penerimaan',
                ],
                [
                    'judul_informasi' => 'Program Studi di PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Politeknik Keselamatan Transportasi Jalan memiliki 3 program studi.',
                    'file_informasi' => 'https://pktj.ac.id/program-studi',
                ],
                [
                    'judul_informasi' => 'Akreditasi PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Informasi mengenai akreditasi PKTJ serta prodi di PKTJ.',
                    'file_informasi' => 'https://pktj.ac.id/program-studi/36-akreditasi',
                ],
                [
                    'judul_informasi' => 'Fasilitas Alat Praktek PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Fasilitas Alat Praktek PKTJ',
                    'file_informasi' => 'https://pktj.ac.id/galeri/13-fasilitas-alat-praktek-pktj',
                ],
                [
                    'judul_informasi' => 'Brosur PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Brosur Politeknik Keselamatan Transportasi Jalan.',
                    'file_informasi' => 'https://pktj.ac.id/program-studi/33-brosur-pktj',
                ],
                [
                    'judul_informasi' => 'Ketarunaan dan Alumni',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Informasi mengenai Ketarunaan dan Alumni.',
                    'file_informasi' => 'https://pktj.ac.id/kategori/alumni',
                ],
                [
                    'judul_informasi' => 'Karir Alumni',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Informasi mengenai karir dan alumni PKTJ.',
                    'file_informasi' => 'https://pktj.ac.id/kategori/alumni',
                ],
                [
                    'judul_informasi' => 'e-learning PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Portal e-learning PKTJ',
                    'file_informasi' => 'https://lms.pktj.ac.id/',
                ],
                [
                    'judul_informasi' => 'Siakad PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Sistem Informasi Akademik Online PKTJ',
                    'file_informasi' => 'https://online.sim.pktj.ac.id:8083/',
                ],
                [
                    'judul_informasi' => 'Perpustakaan Online PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Website Perpustakaan Online PKTJ dapat dibuka pada link berikut',
                    'file_informasi' => 'https://library.pktj.ac.id/',
                ],
                [
                    'judul_informasi' => 'Sipencatar Pola Pembibitan',
                    'kategori' => 'informasi-serta-merta',
                    'tipe_informasi' => 'sertamerta',
                    'isi_informasi' => 'Berikut adalah link informasi Sipencatar Pola Pembibitan',
                    'file_informasi' => 'https://sipencatar.kemenhub.go.id/',
                ],
                [
                    'judul_informasi' => 'Sipencatar Mandiri',
                    'kategori' => 'informasi-serta-merta',
                    'tipe_informasi' => 'sertamerta',
                    'isi_informasi' => 'Berikut adalah link informasi Sipencatar Mandiri',
                    'file_informasi' => 'http://sipencatar.pktj.ac.id/',
                ],
                [
                    'judul_informasi' => 'E-Journal PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Berikut link untuk mengakses E-Journal Keselamatan Transportasi Jalan (Indonesian Journal of Road Safety)',
                    'file_informasi' => 'https://ktj.pktj.ac.id/index.php/ktj',
                ],
                [
                    'judul_informasi' => 'Pengabdian Masyarakat PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Informasi mengenai Pengabdian Masyarakat',
                    'file_informasi' => 'https://pktj.ac.id/arsip/pengabdian',
                ],
                [
                    'judul_informasi' => 'Sijamu PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Berikut adalah link informasi mengenai Satuan Penjaminan Mutu (Sijamu)',
                    'file_informasi' => 'https://spm.pktj.ac.id/',
                ],
                [
                    'judul_informasi' => 'Pernyataan Kebijakan & Maklumat Pelayanan',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Pernyataan Kebijakan dan Maklumat Pelayanan PKTJ',
                    'file_informasi' => 'https://pktj.ac.id/program-studi/50-pernyataan-kebijakan-dan-maklumat-pelayanan-pktj',
                ],
                [
                    'judul_informasi' => 'Dokumen SPMI PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Dokumen SPMI PKTJ',
                    'file_informasi' => 'https://pktj.ac.id/program-studi/47-dokumen-spmi',
                ],
                [
                    'judul_informasi' => 'Survey Kepuasan Masyarakat PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Berikut adalah hasil survei kepuasan masyarakat di lingkungan Politeknik Keselamatan transportasi Jalan',
                    'file_informasi' => 'https://pktj.ac.id/program-studi/54-survey-kepuasan-masyarakat',
                ],
                [
                    'judul_informasi' => 'Sister PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Sistem Informasi Sumberdaya Terintegrasi Politeknik Keselamatan Transportasi Jalan',
                    'file_informasi' => 'https://sister.pktj.ac.id/auth/login',
                ],
                [
                    'judul_informasi' => 'Tarif Layanan Diklat PKTJ',
                    'kategori' => 'informasi-berkala',
                    'tipe_informasi' => 'berkala',
                    'isi_informasi' => 'Informasi mengenai Tarif Layanan Diklat',
                    'file_informasi' => 'https://taplink.cc/diklatpktj2025',
                ],
                [
                    'judul_informasi' => 'Layanan Diklat PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Informasi mengenai Layanan Diklat PKTJ',
                    'file_informasi' => 'https://taplink.cc/diklatpktj2025',
                ],
                [
                    'judul_informasi' => 'Leaflet Diklat PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Leaflet Diklat PKTJ',
                    'file_informasi' => 'https://drive.google.com/file/d/1dJCR5jags9W8LJCpkq2x5Uj20j-DAkq6/view?usp=sharing',
                ],
                [
                    'judul_informasi' => 'Penawaran Diklat PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Informasi mengenai Penawaran Diklat PKTJ',
                    'file_informasi' => 'https://taplink.cc/diklatpktj2025',
                ],
                [
                    'judul_informasi' => 'Proposal Penjajakan Kerjasama',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Informasi mengenai Proposal Penjajakan Kerjasama',
                    'file_informasi' => 'https://drive.google.com/file/d/1vlSRZIPLlKuopUbcY_f6ydTzWSZYABAY/view?usp=sharing',
                ],
                [
                    'judul_informasi' => 'Aplikasi Peminjaman Lab PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Aplikasi Peminjaman Lab',
                    'file_informasi' => 'https://lab.pktj.ac.id/public/',
                ],
                [
                    'judul_informasi' => 'Aplikasi Booking Bengkel PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Aplikasi Booking Bengkel PKTJ',
                    'file_informasi' => 'https://bengkel.pktj.ac.id/',
                ],
                [
                    'judul_informasi' => 'Opac (Pencarian Buku Koleksi)',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Opac pencarian buku koleksi',
                    'file_informasi' => 'https://opac.pktj.ac.id/',
                ],
                [
                    'judul_informasi' => 'Repository PKTJ (Pencarian Skripsi & Magang)',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Repository PKTJ untuk Skripsi dan Magang Taruna',
                    'file_informasi' => 'http://eprints.pktj.ac.id/',
                ],
                [
                    'judul_informasi' => 'Kegiatan Lab IT PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Berikut Dokumentasi Kegiatan Lab IT',
                    'file_informasi' => 'https://drive.google.com/drive/folders/1TvVQGW9sGmcVq1kufmL4TC6Q0E1CuE9K',
                ],
                [
                    'judul_informasi' => 'SPI Charter',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Piagam Satuan Pemeriksaan Intern (SPI-Charter) Politeknik Keselamatan Transportasi Jalan (PKTJ)',
                    'file_informasi' => 'https://drive.google.com/file/d/1hmHpZ2rY7Y8TU74s7gy5bVhxKmvfxbO8/view',
                ],
                [
                    'judul_informasi' => 'SOP Pelaporan Kegiatan PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'SOP Pelaporan Kegiatan PKTJ',
                    'file_informasi' => 'https://drive.google.com/file/d/1rjOLvAAZi4Df5JbYUI7ehqkIA0SxJmp7/view',
                ],
                [
                    'judul_informasi' => 'SOP Audit Kinerja',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'SOP Audit Kinerja',
                    'file_informasi' => 'https://drive.google.com/file/d/1MrFh943kq-nfi5KogndwEfsBw6ePkP74/view',
                ],
                [
                    'judul_informasi' => 'SOP Pengusulan Diklat',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'SOP Pengusulan Diklat',
                    'file_informasi' => 'https://drive.google.com/file/d/18MVB1TaWjESUO-ngOYIFUB6hqks5A6Ub/view',
                ],
                [
                    'judul_informasi' => 'Tes TOEFL PKTJ',
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiapsaat',
                    'isi_informasi' => 'Penawaran Tes TOEFL',
                    'file_informasi' => 'https://drive.google.com/file/d/1YfUhBjZLJRFg8jCB76nU8hG1JZ4uevsq/view',
                ],
                [
                    'judul_informasi' => 'Rencana Kerja Anggaran Tahun 2024',
                    'kategori' => 'informasi-berkala',
                    'tipe_informasi' => 'berkala',
                    'isi_informasi' => 'Rencana Kerja Anggaran Tahun 2024',
                    'file_informasi' => 'https://drive.google.com/file/d/1RVEQDDnIlkzTe3qPA_M7UqBxxN7VhVoM/view?usp=drive_link',
                ],
            ];

            foreach ($scrapedDocs as $doc) {
                // Upsert based on judul_informasi and file_informasi to prevent recreating duplicates
                $exists = DB::table('daftar_informasis')
                    ->where('judul_informasi', $doc['judul_informasi'])
                    ->exists();

                $data = array_merge($doc, [
                    'pejabat_penguasa' => 'PPID',
                    'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                    'bentuk_informasi' => 'softcopy',
                    'tempat_pembuatan' => 'Tegal',
                    'waktu_pembuatan' => '2025',
                    'jangka_waktu' => 'Selama masih berlaku',
                    'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                    'aktif' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if ($exists) {
                    DB::table('daftar_informasis')
                        ->where('judul_informasi', $doc['judul_informasi'])
                        ->update([
                            'kategori' => $doc['kategori'],
                            'tipe_informasi' => $doc['tipe_informasi'],
                            'isi_informasi' => $doc['isi_informasi'],
                            'file_informasi' => $doc['file_informasi'],
                            'updated_at' => now(),
                        ]);
                } else {
                    DB::table('daftar_informasis')->insert($data);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep to prevent accidental loss
    }
};
