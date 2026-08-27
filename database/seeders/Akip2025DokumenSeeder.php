<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InformasiBerkala;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiSertaMerta;
use App\Models\DaftarInformasi;
use App\Models\Peraturan;
use Illuminate\Support\Facades\Schema;

class Akip2025DokumenSeeder extends Seeder
{
    public function run()
    {
        // 1. INFORMASI BERKALA (PBJ & Institusi)
        $berkalaItems = [
            [
                'judul' => 'Profil Unit Kerja Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal',
                'deskripsi' => '<p>Informasi kedudukan, domisili kantor, kontak resmi, tugas pokok dan fungsi, struktur organisasi, dan sejarah kampus PKTJ Tegal.</p>',
                'kategori' => 'Profil',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F1.pdf',
                'file_size' => '305 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Profil Pimpinan & Lembar Berita Negara Pengumuman LHKPN KPK Direktur PKTJ',
                'deskripsi' => '<p>Profil pimpinan dan pengumuman resmi LHKPN yang telah diverifikasi oleh Komisi Pemberantasan Korupsi (KPK).</p>',
                'kategori' => 'LHKPN',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F2.pdf',
                'file_size' => '400 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Laporan Tahunan Akuntabilitas Kinerja Instansi Pemerintah (LAKIP) PKTJ Tahun 2024-2025',
                'deskripsi' => '<p>Laporan pertanggungjawaban capaian target kinerja institusi dan realisasi program tahunan PKTJ.</p>',
                'kategori' => 'Laporan Kinerja',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F3.xlsx',
                'file_size' => '964 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Rencana Kerja dan Anggaran Kementerian/Lembaga (RKA-KL) PKTJ Tahun Anggaran 2025/2026',
                'deskripsi' => '<p>Dokumen perencanaan program dan alokasi pagu anggaran belanja tahunan PKTJ Tegal.</p>',
                'kategori' => 'Keuangan',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F4.pdf',
                'file_size' => '115 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Laporan Keuangan PKTJ Tegal Tahun 2024/2025 (Audited BPK RI)',
                'deskripsi' => '<p>Laporan pertanggungjawaban keuangan audited: Neraca, LRA, LO, LPE, dan Catatan atas Laporan Keuangan (CaLK).</p>',
                'kategori' => 'Keuangan',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F6.pdf',
                'file_size' => '1.4 MB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Daftar Isian Pelaksanaan Anggaran (DIPA) Induk PKTJ Tahun Anggaran 2025',
                'deskripsi' => '<p>Dokumen otorisasi pelaksanaan anggaran belanja pemerintah resmi di lingkungan PKTJ Tegal.</p>',
                'kategori' => 'Keuangan',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F7.pdf',
                'file_size' => '198 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Dokumen Rencana Umum Pengadaan (RUP) Barang dan Jasa PKTJ',
                'deskripsi' => '<p>Pengumuman rencana paket pengadaan barang/jasa melalui sistem Informasi Rencana Umum Pengadaan (SiRUP LKPP).</p>',
                'kategori' => 'Pengadaan Barang & Jasa',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F12.pdf',
                'file_size' => '780 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Kerangka Acuan Kerja (KAK) & Spesifikasi Teknis Pengadaan',
                'deskripsi' => '<p>Uraian ruang lingkup, spesifikasi mutu barang/jasa, dan keluaran yang dipersyaratkan.</p>',
                'kategori' => 'Pengadaan Barang & Jasa',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F12.pdf',
                'file_size' => '780 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Harga Perkiraan Sendiri (HPS) dan Riwayat Perhitungan HPS',
                'deskripsi' => '<p>Kalkulasi estimasi batas atas harga pengadaan yang telah diaudit dan disahkan PPK.</p>',
                'kategori' => 'Pengadaan Barang & Jasa',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F12.pdf',
                'file_size' => '780 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Dokumen Kontrak Pengadaan yang Telah Ditandatangani (Tersensor Sesuai UU KIP)',
                'deskripsi' => '<p>Salinan dokumen kontrak kerja resmi dengan pemburaman/penghitaman pada data rahasia/dikecualikan.</p>',
                'kategori' => 'Pengadaan Barang & Jasa',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F24.pdf',
                'file_size' => '1.2 MB',
                'bisa_download' => true,
                'is_blurred' => true,
                'aktif' => true,
            ],
            [
                'judul' => 'Ringkasan Kontrak Pengadaan Barang dan Jasa PKTJ',
                'deskripsi' => '<p>Resume para pihak bertandatangan, nilai kontrak, rincian pekerjaan, lokasi, dan jangka waktu.</p>',
                'kategori' => 'Pengadaan Barang & Jasa',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F25.pdf',
                'file_size' => '323 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Surat Perintah Mulai Kerja (SPMK) dari PPK PKTJ',
                'deskripsi' => '<p>Surat perintah resmi kepada penyedia terpilih untuk memulai pelaksanaan pekerjaan.</p>',
                'kategori' => 'Pengadaan Barang & Jasa',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F26.pdf',
                'file_size' => '387 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Surat Pernyataan Direktur PKTJ: Paket Pekerjaan Bebas Jaminan & Non-PHO',
                'deskripsi' => '<p>Surat pernyataan resmi Direktur PKTJ sesuai panduan AKIP Kemenhub Slide 63 untuk paket pengadaan yang tidak mensyaratkan jaminan atau PHO.</p>',
                'kategori' => 'Pengadaan Barang & Jasa',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/Pernyataan_Direktur_untuk_AKIP.pdf',
                'file_size' => '355 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
            [
                'judul' => 'Berita Acara Pemeriksaan Hasil Pekerjaan (BAPHP) dan BAST / FHO 100%',
                'deskripsi' => '<p>Dokumen serah terima hasil pekerjaan 100% dari penyedia kepada Pejabat Pembuat Komitmen PKTJ.</p>',
                'kategori' => 'Pengadaan Barang & Jasa',
                'tahun' => '2025',
                'file_path' => 'storage/dokumen/F38.pdf',
                'file_size' => '458 KB',
                'bisa_download' => true,
                'is_blurred' => false,
                'aktif' => true,
            ],
        ];

        if (Schema::hasTable('informasi_berkalas')) {
            foreach ($berkalaItems as $item) {
                InformasiBerkala::updateOrCreate(
                    ['judul' => $item['judul']],
                    $item
                );
            }
        }

        // 2. INFORMASI SETIAP SAAT
        $setiapSaatItems = [
            [
                'judul' => 'Daftar Informasi Publik (DIP) & Daftar Informasi Dikecualikan (DIK) PKTJ Tahun 2025/2026',
                'ringkasan' => 'Daftar klasifikasi informasi terbuka dan informasi yang dikecualikan di lingkungan PKTJ Tegal.',
                'pejabat_pengendali' => 'PPID Pelaksana PKTJ',
                'penanggung_jawab' => 'Bagian Keuangan & Umum PKTJ',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'bentuk_informasi' => 'Softcopy PDF',
                'jangka_waktu_penyimpanan' => '5 Tahun',
                'file_path' => 'storage/dokumen/G1.pdf',
                'file_size' => '211 KB',
                'bisa_download' => true,
                'aktif' => true,
            ],
            [
                'judul' => 'Buku Pedoman Standar Operasional Prosedur (SOP) Pelayanan Publik PKTJ Tegal',
                'ringkasan' => 'Kumpulan SOP layanan akademik, laboratorium, asrama, klinik, perpustakaan, dan BLU PKTJ.',
                'pejabat_pengendali' => 'PPID Pelaksana PKTJ',
                'penanggung_jawab' => 'Subbagian Tata Usaha & Kerjasama',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'bentuk_informasi' => 'Softcopy PDF',
                'jangka_waktu_penyimpanan' => '10 Tahun',
                'file_path' => 'storage/dokumen/G2.pdf',
                'file_size' => '8.6 MB',
                'bisa_download' => true,
                'aktif' => true,
            ],
            [
                'judul' => 'Buku Register Agenda Surat Masuk dan Surat Keluar Pimpinan PKTJ Tahun 2023-2025',
                'ringkasan' => 'Dokumen rekapitulasi surat menyurat dinas masuk dan keluar pimpinan PKTJ.',
                'pejabat_pengendali' => 'PPID Pelaksana PKTJ',
                'penanggung_jawab' => 'Unit Tata Persuratan & Kearsipan',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'bentuk_informasi' => 'Softcopy PDF',
                'jangka_waktu_penyimpanan' => '5 Tahun',
                'file_path' => 'storage/dokumen/Surat_Masuk_Keluar.pdf',
                'file_size' => '7.9 MB',
                'bisa_download' => true,
                'aktif' => true,
            ],
            [
                'judul' => 'Laporan Barang Milik Negara (BMN) PKTJ Tegal Tahun 2024-2025 (Audited)',
                'ringkasan' => 'Laporan inventarisasi aset dan perbendaharaan barang milik negara terdaftar di SIMAN Kemenkeu.',
                'pejabat_pengendali' => 'PPID Pelaksana PKTJ',
                'penanggung_jawab' => 'Unit Pengelolaan BMN',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'bentuk_informasi' => 'Softcopy PDF',
                'jangka_waktu_penyimpanan' => '5 Tahun',
                'file_path' => 'storage/dokumen/Laporan_BMN.pdf',
                'file_size' => '4.8 MB',
                'bisa_download' => true,
                'aktif' => true,
            ],
        ];

        if (Schema::hasTable('informasi_setiap_saats')) {
            foreach ($setiapSaatItems as $item) {
                InformasiSetiapSaat::updateOrCreate(
                    ['judul' => $item['judul']],
                    $item
                );
            }
        }

        // 3. INFORMASI SERTA MERTA
        if (Schema::hasTable('informasi_serta_mertas')) {
            InformasiSertaMerta::updateOrCreate(
                ['judul' => 'Pengumuman Kesiapsiagaan Kedaruratan & Informasi Resmi Sipencatar PKTJ'],
                [
                    'judul' => 'Pengumuman Kesiapsiagaan Kedaruratan & Informasi Resmi Sipencatar PKTJ',
                    'deskripsi' => '<p>Pengumuman kedaruratan cuaca ekstrem dan jalur resmi pendaftaran Seleksi Penerimaan Calon Taruna (Sipencatar) Kemenhub di kampus PKTJ Tegal.</p>',
                    'kategori' => 'Kedaruratan & Pelayanan',
                    'tahun' => '2025',
                    'file_path' => 'https://www.instagram.com/p/DJqxqBLx-lC/',
                    'file_size' => '850 KB',
                    'bisa_download' => true,
                    'is_blurred' => false,
                    'aktif' => true,
                ]
            );
        }
    }
}
