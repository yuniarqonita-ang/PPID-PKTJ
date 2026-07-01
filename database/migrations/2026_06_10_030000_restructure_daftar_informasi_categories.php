<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. [DISABLED] Ubah kategori semua data seed awal menjadi 'layanan-daftar'
        // Ini dinonaktifkan agar data asli yang diupload user tetap tampil di kategori/sub-menu yang tepat.
        /*
        DB::table('daftar_informasis')
            ->whereIn('kategori', ['informasi-berkala', 'informasi-serta-merta', 'informasi-setiap-saat'])
            ->update([
                'kategori' => 'layanan-daftar',
                'tipe_informasi' => 'layanan-daftar'
            ]);
        */

        // 2. Set/Seed HANYA item-item dokumen resmi yang ada di halaman Informasi Berkala pktj.ac.id
        $berkalaDocs = [
            [
                'judul_informasi' => 'Daftar Informasi Berkala',
                'kategori' => 'informasi-berkala',
                'tipe_informasi' => 'berkala',
                'isi_informasi' => 'Daftar dokumen Informasi Berkala yang dipublikasikan oleh PPID PKTJ.',
                'file_informasi' => 'https://drive.google.com/file/d/1MC9k99dV__GAKtB-6wa4hXvnw_dgJtCG/view?usp=sharing',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => 'Selama masih berlaku',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
                'bisa_download' => true,
            ],
            [
                'judul_informasi' => 'Laporan Tahunan Tahun 2024',
                'kategori' => 'informasi-berkala',
                'tipe_informasi' => 'berkala',
                'isi_informasi' => 'Laporan Tahunan Pelayanan Informasi Publik PPID PKTJ Tahun 2024.',
                'file_informasi' => 'https://drive.google.com/file/d/1kBr-D0Qsp1xu1fJeGohpJMwaVM9wCUHb/view',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2024',
                'jangka_waktu' => 'Selama masih berlaku',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
                'bisa_download' => true,
            ],
            [
                'judul_informasi' => 'Rencana Kerja Anggaran Tahun 2025',
                'kategori' => 'informasi-berkala',
                'tipe_informasi' => 'berkala',
                'isi_informasi' => 'Rencana Kerja Anggaran (RKA-KL) Politeknik Keselamatan Transportasi Jalan Tahun Anggaran 2025.',
                'file_informasi' => 'https://drive.google.com/file/d/1kvTsbixaGktfweb2tZX8fLLC2-eum1nR/view?usp=sharing',
                'pejabat_penguasa' => 'Ketua Tim Substansi Bidang Keuangan',
                'penerbit_informasi' => 'Bagian Perencanaan',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '1 (satu) tahun',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
                'bisa_download' => true,
            ],
            [
                'judul_informasi' => 'Laporan Keuangan Tahun 2025',
                'kategori' => 'informasi-berkala',
                'tipe_informasi' => 'berkala',
                'isi_informasi' => 'Laporan Keuangan Politeknik Keselamatan Transportasi Jalan Tahun 2025.',
                'file_informasi' => 'https://drive.google.com/file/d/14CjipeveVY9PW6m_MTnPe7teg2SBpZtH/view',
                'pejabat_penguasa' => 'Ketua Tim Substansi Bidang Keuangan',
                'penerbit_informasi' => 'Bagian Keuangan',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '1 (satu) tahun',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
                'bisa_download' => true,
            ],
        ];

        foreach ($berkalaDocs as $doc) {
            DB::table('daftar_informasis')->insert(array_merge($doc, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

        // 3. Set/Seed HANYA item-item dokumen resmi yang ada di halaman Informasi Serta Merta pktj.ac.id
        $sertamertaDocs = [
            [
                'judul_informasi' => 'Daftar Informasi Serta Merta',
                'kategori' => 'informasi-serta-merta',
                'tipe_informasi' => 'sertamerta',
                'isi_informasi' => 'Daftar dokumen Informasi Serta Merta yang dipublikasikan oleh PPID PKTJ.',
                'file_informasi' => 'https://drive.google.com/file/d/1DpLpKanHyGKysxxW2DIbUMiRVR74Cpws/view?usp=sharing',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => 'Selama masih berlaku',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
                'bisa_download' => true,
            ],
            [
                'judul_informasi' => 'Informasi Sipencatar',
                'kategori' => 'informasi-serta-merta',
                'tipe_informasi' => 'sertamerta',
                'isi_informasi' => 'Informasi terkait kriteria umum pendaftar, lokasi tes, jadwal seleksi, program studi, biaya seleksi, persyaratan ijazah dll.',
                'file_informasi' => 'https://www.instagram.com/p/DJqxqBLx-lC/?utm_source=ig_web_copy_link',
                'pejabat_penguasa' => 'Ketua Tim Substansi Bidang administrasi akademik',
                'penerbit_informasi' => 'Unit Kerja di lingkungan PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2024',
                'jangka_waktu' => '1 (satu) tahun',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
                'bisa_download' => true,
            ],
        ];

        foreach ($sertamertaDocs as $doc) {
            DB::table('daftar_informasis')->insert(array_merge($doc, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

        // 4. Set/Seed HANYA item-item dokumen resmi yang ada di halaman Informasi Setiap Saat pktj.ac.id
        $setiapsaatDocs = [
            [
                'judul_informasi' => 'Daftar Informasi Setiap Saat',
                'kategori' => 'informasi-setiap-saat',
                'tipe_informasi' => 'setiapsaat',
                'isi_informasi' => 'Daftar dokumen Informasi Setiap Saat yang dipublikasikan oleh PPID PKTJ.',
                'file_informasi' => 'https://drive.google.com/file/d/1EQEiWLqzJ7O6KTxw7bAlRdJQX3bsbNRR/view?usp=sharing',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => 'Selama masih berlaku',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
                'bisa_download' => true,
            ],
            [
                'judul_informasi' => 'Peraturan/kebijakan/SOP yang telah disahkan dalam memberikan layanan publik kepada masyarakat',
                'kategori' => 'informasi-setiap-saat',
                'tipe_informasi' => 'setiapsaat',
                'isi_informasi' => 'Peraturan, kebijakan, dan SOP pelayanan publik PPID PKTJ yang telah disahkan.',
                'file_informasi' => 'https://drive.google.com/file/d/1nAT3fmq9avoXpfgVxJfMLdozYHhh3M_g/view?usp=sharing',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'Unit Kerja di lingkungan PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => 'selama masih digunakan dan/ atau belum ada penggantinya',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
                'bisa_download' => true,
            ],
            [
                'judul_informasi' => 'Data Inventaris Barang Milik Negara Tahun 2024',
                'kategori' => 'informasi-setiap-saat',
                'tipe_informasi' => 'setiapsaat',
                'isi_informasi' => 'Data Inventaris Barang Milik Negara (BMN) Politeknik Keselamatan Transportasi Jalan Tahun 2024.',
                'file_informasi' => 'https://drive.google.com/drive/folders/1KCUh9IRc9WZ_dQw2FvoUfayDyZgapSqj?usp=sharing',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2024',
                'jangka_waktu' => 'Selama masih berlaku',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
                'bisa_download' => true,
            ],
        ];

        foreach ($setiapsaatDocs as $doc) {
            DB::table('daftar_informasis')->insert(array_merge($doc, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't delete to prevent data loss
    }
};
