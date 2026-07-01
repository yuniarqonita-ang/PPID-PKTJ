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
        // 1. Lists of titles from the original seeder (2026_06_05_160000_seed_daftar_informasi_data.php)
        $berkalaTitles = [
            'Daftar Pejabat wajib lapor LHKPN',
            'Rencana Strategis (Renstra) PKTJ',
            'Rencana Kerja Tahunan (RKT) PKTJ Tahun 2025',
            'RKA-KL PKTJ Tahun 2025',
            'Perjanjian Kinerja (PK) PKTJ tahun 2025',
            'DIPA INDUK PKTJ Tahun 2025',
            'Laporan Keuangan PKTJ',
            'Laporan Kinerja PKTJ',
            'Laporan Tahunan',
            'Buku Statistik',
            'Profil Unit Kerja di lingkungan PKTJ',
            'Profil Singkat Pejabat PKTJ',
            'Peta Jabatan di Unit kerja PKTJ',
            'Tarif Akademik dan Penunjang Akademik',
            'PMK PSAK PKTJ',
            'Penetapan Remunerasi Pejabat Pengelola, Dewas dan Pegawai di lingkungan PKTJ',
            'Informasi pendidikan dan pelatihan yang diselenggarakan',
            'Panduan pendaftaran pendidikan dan pelatihan yang diselenggarakan',
            'Informasi tentang biaya pendidikan dan pelatihan bidang transportasi darat',
            'Struktur PPID Pelaksana UPT PKTJ',
            'Kalender kegiatan akademik dalam satu tahun ajaran',
            'Berisi rekapitulasi PPID Pelaksana UPT beserta SK Pembentukannya',
            'Berisi tentang SK tentang Kurikulum Pendidikan Tinggi masing-masing Program Studi di PKTJ',
            'Berisi tentang Jadwal Rencana Diklat Teknis di PKTJ'
        ];

        $sertaMertaTitles = [
            'Pengumuman hasil seleksi TPA Sipencatar',
            'Pengumuman hasil seleksi akhir sipencatar',
            'Pengumuman hasil seleksi Kesehatan Sipencatar',
            'Panduan Pendaftaran Sipencatar',
            'Informasi Sipencatar',
            'Pengumuman hasil seleksi Psikologi Sipencatar',
            'Pengumuman hasil selekasi akhir sipencatar'
        ];

        $setiapSaatTitles = [
            'Buku pedoman pengasuhan taruna',
            'Ringkasan atau statistik peserta diklat',
            'Daftar nama Fungsional Instruktur',
            'Daftar nama Fungsional Dosen',
            'Kurikulum dan Silabus Pendidikan dan Pelatihan Perhubungan',
            'Daftar barang ruangan',
            'Daftar stok opname ATK',
            'Dokumentasi kegiatan Pimpinan unit kerja PKTJ',
            'Dokumentasi Sarana dan Prasarana Diklat PKTJ',
            'Ortaker Unit Kerja di lingkungan PKTJ',
            'Peraturan, keputusan, dan kebijakan Direktur PKTJ',
            'Keputusan Kepala Unit Kerja PKTJ',
            'Perjanjian dengan Pihak Ketiga',
            'Daftar rekapan PNS dan Pegawai non PNS di lingkungan PKTJ',
            'Daftar nominatif pegawai PKTJ',
            'Laporan data perbendaharaan dan inventaris unit kerja di PKTJ',
            'SOP tata naskah dan persuratan',
            'Daftar penomoran surat di PKTJ',
            'Daftar arsip unit kerja di lingkungan PKTJ',
            'Data Operasional Perkantoran unit kerja di lingkungan PKTJ',
            'Data inventaris kendaraan bermotor',
            'Data inventaris peralatan kantor',
            'Dokumen terkait bantuan tugas belajar',
            'Dokumen terkait Beasiswa',
            'Dokumen terkait Assesment Jabatan Struktural',
            'Dokumen terkait Assesment Dosen',
            'Dokumen terkait Ujian Dinas',
            'Surat Menyurat',
            'Daftar Absensi perpustakaan',
            'Daftar Inventarisasi Buku',
            'Daftar Judul Buku',
            'Daftar Inventarisasi Laboratorium CBT',
            'Daftar Absensi Laboratorium CBT',
            'Daftar Inventarisasi Laboratorium',
            'Daftar Absensi Laboratorium',
            'Daftar Inventarisasi Laboratorium Bahasa',
            'Daftar Absensi Laboratorium Bahasa',
            'Daftar Inventaris Asrama',
            'Daftar Asrama Dan Kapasitas',
            'Daftar obat-obatan Poliklinik',
            'Tarif BLU di lingkungan PKTJ',
            'Tarif PNBP Diklat dan Sarana Prasarana',
            'Dokumen hasil penelitian dosen, instruktur, dan/atau Taruna (peserta diklat)',
            'Pedoman Mutu',
            'Dokumen dewan pengawas',
            'Tata tertib asrama',
            'Daftar Informasi Publik',
            'Alur Prosedur Pelayanan Informasi',
            'Tata cara permohonan informasi publik dan pengajuan keberatan informasi publik'
        ];

        // 2. Restore categories based on original seeder titles
        DB::table('daftar_informasis')
            ->whereIn('judul_informasi', $berkalaTitles)
            ->update([
                'kategori' => 'informasi-berkala',
                'tipe_informasi' => 'berkala'
            ]);

        DB::table('daftar_informasis')
            ->whereIn('judul_informasi', $sertaMertaTitles)
            ->update([
                'kategori' => 'informasi-serta-merta',
                'tipe_informasi' => 'sertamerta'
            ]);

        DB::table('daftar_informasis')
            ->whereIn('judul_informasi', $setiapSaatTitles)
            ->update([
                'kategori' => 'informasi-setiap-saat',
                'tipe_informasi' => 'setiapsaat'
            ]);

        // 3. Restore category for any other user-migrated items from the old tables if they exist
        if (Schema::hasTable('informasi_berkalas')) {
            $berkalaJuduls = DB::table('informasi_berkalas')->pluck('judul')->toArray();
            if (!empty($berkalaJuduls)) {
                DB::table('daftar_informasis')
                    ->whereIn('judul_informasi', $berkalaJuduls)
                    ->update([
                        'kategori' => 'informasi-berkala',
                        'tipe_informasi' => 'berkala'
                    ]);
            }
        }

        if (Schema::hasTable('informasi_sertamertas')) {
            $sertamertaJuduls = DB::table('informasi_sertamertas')->pluck('judul')->toArray();
            if (!empty($sertamertaJuduls)) {
                DB::table('daftar_informasis')
                    ->whereIn('judul_informasi', $sertamertaJuduls)
                    ->update([
                        'kategori' => 'informasi-serta-merta',
                        'tipe_informasi' => 'sertamerta'
                    ]);
            }
        }

        if (Schema::hasTable('informasi_setiapsaats')) {
            $setiapsaatJuduls = DB::table('informasi_setiapsaats')->pluck('judul')->toArray();
            if (!empty($setiapsaatJuduls)) {
                DB::table('daftar_informasis')
                    ->whereIn('judul_informasi', $setiapsaatJuduls)
                    ->update([
                        'kategori' => 'informasi-setiap-saat',
                        'tipe_informasi' => 'setiapsaat'
                    ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keeping it empty to prevent accidental loss/reset of categories
    }
};
