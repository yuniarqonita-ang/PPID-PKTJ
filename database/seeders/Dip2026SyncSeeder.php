<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DaftarInformasi;
use App\Models\InformasiBerkala;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiSertaMerta;
use App\Models\InformasiDikecualikan;
use App\Models\ProfilPpid;
use App\Models\Peraturan;
use App\Models\CustomMenu;
use App\Models\Dashboard;
use App\Models\Dokumen;

class Dip2026SyncSeeder extends Seeder
{
    /**
     * Sinkronisasi Resmi Terpadu DIP & DIK PKTJ Tegal Tahun 2026 Sesuai SK Sekjen Kemenhub:
     * - SK Sekjen Kemenhub No. KP-SKJ 9 Tahun 2026 (DIP: 25 Berkala, 10 Setiap Saat, 3 Serta Merta = 38 Master DIP)
     * - SK Sekjen Kemenhub No. KP-SKJ 8 Tahun 2026 (DIK: 3 Informasi Dikecualikan)
     * - Tautan langsung per-file Google Drive (Bukan folder)
     * - Pelabelan 'Hubungi PPID PKTJ' untuk portal BPSDMP Kemenhub
     * - Penonaktifan dokumen rekapitulasi/laporan PPID yang masih proses
     * - Visi Misi Prinsip TOP (Transparan, Objektif, Prima)
     * - Profil PPID Sejarah PKTJ (BPLTD 1971, Pusdiklat 1975, BPPTD 2002, PKTJ 2012/2021)
     * - Regulasi SK DIP 2026 dan SK DIK 2026
     */
    public function run(): void
    {
        // 1. DATA ARRAY RESMI DIP & DIK
        $berkalaData = [
            [
                'no' => 1,
                'judul' => 'Profil Unit Kerja di PKTJ Tegal',
                'deskripsi' => 'Informasi komprehensif mengenai profil kelembagaan, sejarah transformasi dari BPLTD 1971 hingga PKTJ, tugas pokok dan fungsi spesifik pendidikan tinggi vokasi keselamatan jalan, struktur organisasi, alamat Kampus 1 & Kampus 2, kontak layanan, sarana laboratorium, dan pemanfaatan aset PKTJ Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Website, hardcopy, dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://pktj.ac.id/tentang#',
                'tautan' => [
                    ['nama' => 'Profil PKTJ Tegal', 'url' => 'https://pktj.ac.id/tentang#'],
                    ['nama' => 'Tugas dan Fungsi PKTJ', 'url' => 'https://pktj.ac.id/tentang/93-tugas-dan-fungsi'],
                    ['nama' => 'Struktur Organisasi PKTJ', 'url' => 'https://pktj.ac.id/tentang/18-struktur-organisasi'],
                    ['nama' => 'Visi dan Misi PKTJ', 'url' => 'https://pktj.ac.id/tentang/14-visi-dan-misi'],
                    ['nama' => 'Halaman Profil PPID PKTJ', 'url' => '/profil/profil-ppid']
                ],
                'aktif' => true
            ],
            [
                'no' => 2,
                'judul' => 'Profil Pejabat PKTJ Tegal',
                'deskripsi' => 'Informasi mengenai profil singkat pejabat struktural, rekam jejak, dan jabatan di lingkungan Politeknik Keselamatan Transportasi Jalan Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://ppid.pktj.ac.id/profil/profil-pejabat',
                'tautan' => [
                    ['nama' => 'Profil Pejabat PKTJ Tegal', 'url' => 'https://ppid.pktj.ac.id/profil/profil-pejabat'],
                    ['nama' => 'Portal e-LHKPN KPK', 'url' => 'https://elhkpn.kpk.go.id']
                ],
                'aktif' => true
            ],
            [
                'no' => 3,
                'judul' => 'Rencana Kerja Tahunan (RKT) PKTJ Tegal',
                'deskripsi' => 'Penjabaran dari sasaran dan program yang telah ditetapkan dalam RENSTRA dan akan dilaksanakan pada tahun anggaran berjalan.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1LU_v3ftXpcNjl1ZP4Wr7EniGDYDGM9Jm/view?usp=drive_link',
                'tautan' => [
                    ['nama' => 'Rencana Kerja Tahunan (RKT) PKTJ 2025', 'url' => 'https://drive.google.com/file/d/1LU_v3ftXpcNjl1ZP4Wr7EniGDYDGM9Jm/view?usp=drive_link']
                ],
                'aktif' => true
            ],
            [
                'no' => 4,
                'judul' => 'Perjanjian Kinerja (PK) PKTJ Tegal',
                'deskripsi' => 'Perjanjian Kinerja merupakan rencana kinerja tahunan yang merupakan penjabaran dari RENSTRA Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1NUGomOwF2hPxPCp0FL89aftls7b4TShV/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'Perjanjian Kinerja PKTJ Tegal Tahun 2026', 'url' => 'https://drive.google.com/file/d/1NUGomOwF2hPxPCp0FL89aftls7b4TShV/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja Revisi PKTJ Tegal Tahun 2025', 'url' => 'https://drive.google.com/file/d/12et5pNhulk8XOeiO09ZNq-FZsfdwf8qh/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja PKTJ Tegal Tahun 2025', 'url' => 'https://drive.google.com/file/d/1zwH3DzsDZcstfwMiPK-of1Rot3lGqDFE/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja Revisi PKTJ Tegal Tahun 2024', 'url' => 'https://drive.google.com/file/d/1Hq-AtCxfdC1wS9MYMa-dBzCvtXOprX1h/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja PKTJ Tahun 2024', 'url' => 'https://drive.google.com/file/d/1K-ajBYxRTX_lVUjCmtzLedjsAaPt0v0g/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja Revisi PKTJ Tahun 2023', 'url' => 'https://drive.google.com/file/d/1nG7qK9yPSMnf6qvG7HeFvi2DwWKWf1aZ/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja PKTJ Tahun 2023', 'url' => 'https://drive.google.com/file/d/1FFdD4GfBpFtWdA08rJ36r5zhnVilStDp/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja Revisi PKTJ Tahun 2022', 'url' => 'https://drive.google.com/file/d/1H_dWJ5ql8v1L1Ng2hJpWHkHy2HEQx52d/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja PKTJ Tahun 2022', 'url' => 'https://drive.google.com/file/d/1rSydp7yOTqspxw9XAjZFRjKnBpk4gD6o/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja Revisi PKTJ Tahun 2021', 'url' => 'https://drive.google.com/file/d/10lCzJyHbxwnsx5Nzn5XBOPi6s9kMI2Db/view?usp=sharing'],
                    ['nama' => 'Perjanjian Kinerja PKTJ Tahun 2021', 'url' => 'https://drive.google.com/file/d/1hSabOE1nYPK121W_AGZXVgBYwIQBKIrv/view?usp=sharing'],
                ],
                'aktif' => true
            ],
            [
                'no' => 5,
                'judul' => 'RKA-KL PKTJ Tegal',
                'deskripsi' => 'Ringkasan Rencana Kerja Anggaran Kementerian/Lembaga yang berisi program dan kegiatan seluruh Satuan Kerja PKTJ Tegal (2020-2026).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1o5Kev4qnRM6MmLz9vJwOaCUykLR2bw-k/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'RKA-KL TA 2026', 'url' => 'https://drive.google.com/file/d/1o5Kev4qnRM6MmLz9vJwOaCUykLR2bw-k/view?usp=sharing'],
                    ['nama' => 'RKA-KL TA 2025', 'url' => 'https://drive.google.com/file/d/1NIsJLSo6T0xAhPGAbI_7YYIPSG6fdxrK/view?usp=sharing'],
                    ['nama' => 'RKA-KL TA 2024', 'url' => 'https://drive.google.com/file/d/1LLCo6lY0DHhWKsitGcUWCKj_aAaMEj21/view?usp=sharing'],
                    ['nama' => 'RKA-KL TA 2023', 'url' => 'https://drive.google.com/file/d/1SZLCHiWrCHIqSPp1pDQ8U2pHWHoFri3k/view?usp=sharing'],
                    ['nama' => 'RKA-KL TA 2022', 'url' => 'https://drive.google.com/file/d/1NyPSRUrKD9PL_Vfi52w_5gZoP675CDuI/view?usp=sharing'],
                    ['nama' => 'RKA-KL TA 2021', 'url' => 'https://drive.google.com/file/d/1k4yxot2mK-O32MpyyjbbaiuNRfTLlF6y/view?usp=sharing'],
                    ['nama' => 'RKA-KL TA 2020', 'url' => 'https://drive.google.com/file/d/1yMUmwtQ-W8-RZxRzGphTzSSwoZ_AHybd/view?usp=sharing']
                ],
                'aktif' => true
            ],
            [
                'no' => 6,
                'judul' => 'DIPA Induk PKTJ Tegal Tahun 2026',
                'deskripsi' => 'Berisi informasi tentang program dan kegiatan beserta anggaran seluruh Satker di Lingkungan PKTJ Tegal (2020-2026).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1EsnQSLq7b43vjdq2KOfmL-84fAWxvT_z/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'DIPA Pagu Awal TA 2026', 'url' => 'https://drive.google.com/file/d/1EsnQSLq7b43vjdq2KOfmL-84fAWxvT_z/view?usp=sharing'],
                    ['nama' => 'DIPA Pagu Awal TA 2025', 'url' => 'https://drive.google.com/file/d/1SfIry5JjGLWZ7i0D10tQVHqspga5rbFY/view?usp=sharing'],
                    ['nama' => 'DIPA Pagu Awal TA 2024', 'url' => 'https://drive.google.com/file/d/1vyOQ0VWJmJ_P2RFWNchf41KuvoedBFTn/view?usp=sharing'],
                    ['nama' => 'DIPA Pagu Awal TA 2023', 'url' => 'https://drive.google.com/file/d/1i12VRCx56Rtkr8Ii_vfIjkT6cmKi5lEZ/view?usp=sharing'],
                    ['nama' => 'DIPA Pagu Awal TA 2022', 'url' => 'https://drive.google.com/file/d/1A3kNNe0kK3uWtG4Hrrmlg8KSt2AcMuLM/view?usp=sharing'],
                    ['nama' => 'DIPA Pagu Awal TA 2021', 'url' => 'https://drive.google.com/file/d/1_TbkBJeV0JqLXQfEMu4qTQ878E8I_pcs/view?usp=sharing'],
                    ['nama' => 'DIPA Pagu Awal TA 2020', 'url' => 'https://drive.google.com/file/d/1XL9Z5FJM8QfvRdiu26EZ7PvGMzICMqXu/view?usp=sharing']
                ],
                'aktif' => true
            ],
            [
                'no' => 7,
                'judul' => 'Laporan Kinerja (LAKIP) PKTJ Tegal Tahun 2025',
                'deskripsi' => 'Berisi informasi Pelaporan Kinerja dan Tata Cara Reviu atas Laporan Kinerja Instansi Pemerintah sebagai pertanggung jawaban atas pelaksanaan semua program kerja yang telah dilaksanakan Unit Kerja dalam rangka mewujudkan penyelenggaraan negara yang bebas dari KKN dan tercapainya pemerintahan yang baik (Good Governance ) 2020-2025.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1E2Fx7edSCxWjueyXbeL2mJE0wiKqQbiq/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'LAKIP PKTJ TA 2025', 'url' => 'https://drive.google.com/file/d/1E2Fx7edSCxWjueyXbeL2mJE0wiKqQbiq/view?usp=sharing'],
                    ['nama' => 'LKIP PKTJ TA 2024', 'url' => 'https://drive.google.com/file/d/16csyS0TDykmrcsXFpc5csDP_yHh7_3V4/view?usp=sharing'],
                    ['nama' => 'LKIP PKTJ TA 2023', 'url' => 'https://drive.google.com/file/d/1oZfbiyr2zG5wX-aqaHAoQKqpuLTW1Qm5/view?usp=sharing'],
                    ['nama' => 'LAKIP PKTJ TA 2022', 'url' => 'https://drive.google.com/file/d/1hXcPH3_FLRCcBFNw_hnMOSkIO4kN4JP3/view?usp=sharing'],
                    ['nama' => 'LAKIP PKTJ TA 2021', 'url' => 'https://drive.google.com/file/d/1iOPhJ_x_C0iEyOngAiTbtHsT25SOcFV8/view?usp=sharing'],
                    ['nama' => 'LAKIP PKTJ TA 2020', 'url' => 'https://drive.google.com/file/d/1frRH8fVM-ttfRCmN3PT6zj52HxcFpsKT/view?usp=sharing']
                ],
                'aktif' => true
            ],
            [
                'no' => 8,
                'judul' => 'Laporan Tahunan PKTJ Tegal',
                'deskripsi' => 'Informasi pertanggungjawaban atas pelaksanaan kegiatan yang telah dilaksanakan Unit Kerja di lingkungan PKTJ Tegal (2020-2025).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                'bentuk' => 'hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1m1YOiiiDftQlnEkGPOuCu_neoN03YiFV/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'Laporan Tahunan PKTJ TA 2025', 'url' => 'https://drive.google.com/file/d/1m1YOiiiDftQlnEkGPOuCu_neoN03YiFV/view?usp=sharing'],
                    ['nama' => 'Laporan Tahunan PKTJ TA 2024', 'url' => 'https://drive.google.com/file/d/1gpZpRgGckUIaIIYF6AtAVAW54iTnpMnB/view?usp=sharing'],
                    ['nama' => 'Laporan Tahunan PKTJ TA 2023', 'url' => 'https://drive.google.com/file/d/1NTubEAWdoeUND9haBHZiaCEZOo35buGa/view?usp=sharing'],
                    ['nama' => 'Laporan Tahunan PKTJ TA 2022', 'url' => 'https://drive.google.com/file/d/1SjPLrEiG27u3fq7w2FhdgT9UMo4H25hx/view?usp=sharing'],
                    ['nama' => 'Laporan Tahunan PKTJ TA 2021', 'url' => 'https://drive.google.com/file/d/1oLNC1LNxZLJD8LadF4y6wpDXGu3jQLl-/view?usp=sharing'],
                    ['nama' => 'Laporan Tahunan PKTJ TA 2020', 'url' => 'https://drive.google.com/file/d/1aWJPDBMGPHIepNOjn8_tTkvIxXBZDOu2/view?usp=sharing']
                ],
                'aktif' => true
            ],
            [
                'no' => 9,
                'judul' => 'Laporan Harta Kekayaan Pejabat Negara (LHKPN)',
                'deskripsi' => 'Informasi mengenai bukti tanda terima dan pengumuman kepatuhan Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) para pejabat pimpinan PKTJ Tegal yang telah diverifikasi dan dipublikasikan resmi oleh Komisi Pemberantasan Korupsi (KPK RI).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1RhCMtybOF3-wz3IRdnYgg8ET_6FjI8Ln/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'LHKPN Pejabat PKTJ 2025', 'url' => 'https://drive.google.com/file/d/1RhCMtybOF3-wz3IRdnYgg8ET_6FjI8Ln/view?usp=sharing'],
                    ['nama' => 'Portal e-LHKPN KPK', 'url' => 'https://elhkpn.kpk.go.id']
                ],
                'aktif' => true
            ],
            [
                'no' => 10,
                'judul' => 'Informasi Pendidikan dan Pelatihan yang diselenggarakan',
                'deskripsi' => 'Informasi program beasiswa, kriteria umum program diklat teknis transportasi jalan, waktu pelaksanaan, lama diklat, persyaratan pendaftaran, dan biaya diklat di Politeknik Keselamatan Transportasi Jalan Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Unit Pelaksana Teknis PKTJ Tegal',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => 'Selama masih berlaku',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login']
                ],
                'aktif' => true
            ],
            [
                'no' => 11,
                'judul' => 'Informasi Sipencatar',
                'deskripsi' => 'Informasi lengkap terkait kriteria umum pendaftar calon taruna/taruni, alur pendaftaran, lokasi tes, jadwal seleksi penerimaan terpadu, program studi vokasi, biaya seleksi, dan persyaratan ijazah jalur Polbit maupun Jalur Mandiri.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://pktj.ac.id/pages/informasi-sipencatar',
                'tautan' => [
                    ['nama' => 'Informasi Sipencatar PKTJ', 'url' => 'https://pktj.ac.id/pages/informasi-sipencatar']
                ],
                'aktif' => true
            ],
            [
                'no' => 12,
                'judul' => 'Kalender akademik',
                'deskripsi' => 'Kalender kegiatan akademik resmi, jadwal perkuliahan semester ganjil dan genap, praktikum laboratorium keselamatan jalan, ujian semester, masa basis madatukar, dan upacara wisuda perwira transportasi jalan PKTJ Tegal (2024-2025).',
                'pejabat' => 'PPID Pelaksana',
                'penerbit' => 'Bagian Akademik',
                'bentuk' => 'softcopy dan hardcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1_7i4BBiD3w9an0JqXx3ujiLOcvfCUQhG/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'SK Penetapan Kalender Akademik TA 2024-2025 (Signed)', 'url' => 'https://drive.google.com/file/d/1_7i4BBiD3w9an0JqXx3ujiLOcvfCUQhG/view?usp=sharing'],
                    ['nama' => 'Bagan Presentasi Kalender Akademik 2024-2025', 'url' => 'https://drive.google.com/file/d/1rGHNkjQdqveSymPlD1Qf8Bu64avXFgz6/view?usp=sharing']
                ],
                'aktif' => true
            ],
            [
                'no' => 13,
                'judul' => 'Statistik PKTJ Tegal Tahun 2025',
                'deskripsi' => 'Berisi informasi Data Peserta dan Lulusan Pendidikan dan Pelatihan Perhubungan berdasarkan Jenis Pendidikan dan Pelatihan, Data Tenaga Pendidik dan Data Kapasitas Prasarana Diklat di Unit Pelaksanaan Teknis (UPT) di Lingkungan PKTJ Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Kepala Bagian Perencanaan',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1WA7CSaxqt0j8e0fHnjqnl8K8TCRdUAAV/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'DRH Seluruh Pegawai PKTJ (.xlsx)', 'url' => 'https://drive.google.com/file/d/1WA7CSaxqt0j8e0fHnjqnl8K8TCRdUAAV/view?usp=sharing'],
                    ['nama' => 'SK Penetapan PPID PKTJ 2026 (.pdf)', 'url' => 'https://drive.google.com/file/d/1tAtixggFCU10eazzSDrAuv4O0zoeOfJS/view?usp=sharing'],
                    ['nama' => 'Grafik Jenis Pegawai (.jpg)', 'url' => 'https://drive.google.com/file/d/1waPJx0eSSfwhA3N9ggLE7qJHxOxOPblg/view?usp=sharing'],
                    ['nama' => 'Grafik Pendidikan Pegawai (.png)', 'url' => 'https://drive.google.com/file/d/1tPH7bcOA16ZJrcdG03JEj2EklKVeUW7W/view?usp=sharing'],
                    ['nama' => 'Grafik Golongan Pegawai (.png)', 'url' => 'https://drive.google.com/file/d/12ugth3EsodPjIZK4U7dOz4EAD0oObowf/view?usp=sharing'],
                    ['nama' => 'Halaman Data & Statistik Kepegawaian PKTJ', 'url' => '/profil/statistik-pegawai']
                ],
                'aktif' => true
            ],
            [
                'no' => 14,
                'judul' => 'Rencana Strategis (Renstra) PKTJ Tegal',
                'deskripsi' => 'Rencana Strategis (Renstra) PKTJ Tegal (2020-2024, Masih kurang yang tahun 2025-2029).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '5 Tahun',
                'file' => 'https://drive.google.com/file/d/1Y-OeqeZYBuX9TsHdzVI0xJe0AMsupr7J/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'Rencana Strategis (Renstra) PKTJ 2020-2024', 'url' => 'https://drive.google.com/file/d/1Y-OeqeZYBuX9TsHdzVI0xJe0AMsupr7J/view?usp=sharing']
                ],
                'aktif' => true
            ],
            [
                'no' => 15,
                'judul' => 'Peraturan Menteri tentang Ortaker Unit Kerja di Lingkungan PKTJ Tegal',
                'deskripsi' => 'Susunan Organisasi dan Tata Kerja Unit Kerja yang telah disahkan melalui Peraturan Menteri Perhubungan (PM 104 Tahun 2021).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Kepala Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/20241104110200.6._PKTJ_Tegal_-_PM_104_Tahun_2021.pdf',
                'tautan' => [
                    ['nama' => 'PM 104 Tahun 2021 (Ortaker PKTJ Tegal)', 'url' => 'https://ppid.kemenhub.go.id/fileupload/informasi-berkala/20241104110200.6._PKTJ_Tegal_-_PM_104_Tahun_2021.pdf']
                ],
                'aktif' => true
            ],
            [
                'no' => 16,
                'judul' => 'Laporan Keuangan PKTJ Tegal Tahun 2025',
                'deskripsi' => 'Berisi Laporan Realisasi Anggaran (LRA), Neraca, Laporan Operasional, Laporan Perubahan Ekuitas dan Catatan atas Laporan Keuangan yang telah di audit oleh BPK-RI (2020-2025).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1h_at5nDbhL85ID5xFZKDIIPnUac5J1VC/view?usp=sharing',
                'tautan' => [
                    ['nama' => 'Laporan Keuangan TA 2025 (Audited)', 'url' => 'https://drive.google.com/file/d/1h_at5nDbhL85ID5xFZKDIIPnUac5J1VC/view?usp=sharing'],
                    ['nama' => 'Laporan Keuangan TA 2024 (Audited)', 'url' => 'https://drive.google.com/file/d/1SiWL0SN2Fd/view?usp=sharing'],
                    ['nama' => 'Laporan Keuangan TA 2023 (Audited)', 'url' => 'https://drive.google.com/file/d/1rg2FKvss8nSs2SoMRoeRyDwzdRf469Nt/view?usp=sharing'],
                    ['nama' => 'Laporan Keuangan TA 2022 (Audited)', 'url' => 'https://drive.google.com/file/d/1pTi35DtqVhJPsRPi76dDtAoMjfUeP3_o/view?usp=sharing'],
                    ['nama' => 'Laporan Keuangan TA 2021 (Audited)', 'url' => 'https://drive.google.com/file/d/1Fga_/view?usp=sharing'],
                    ['nama' => 'Laporan Keuangan TA 2020 (Audited)', 'url' => 'https://drive.google.com/file/d/13TRRsPSCAnsKVVPpws2Vah5VxCml6VPb/view?usp=sharing']
                ],
                'aktif' => true
            ],
            [
                'no' => 17,
                'judul' => 'Struktur PPID PKTJ Tegal',
                'deskripsi' => 'Struktur PPID Pelaksana dan PPID Pelaksana UPT beserta SK Pembentukannya.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Kepala Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://ppid.pktj.ac.id/profil/struktur-organisasi',
                'tautan' => [
                    ['nama' => 'Struktur Organisasi PPID PKTJ', 'url' => 'https://ppid.pktj.ac.id/profil/struktur-organisasi'],
                    ['nama' => 'SK PPID PKTJ 2026 Terbaru', 'url' => 'https://drive.google.com/file/d/18UCD9lMWZNp7IfIxpx8WC1V99hQGIwxX/view?usp=drive_link']
                ],
                'aktif' => true
            ],
            [
                'no' => 18,
                'judul' => 'Daftar Informasi Publik',
                'deskripsi' => 'Daftar Informasi Publik PPID Pelaksana dan PPID Pelaksana UPT di lingkungan PKTJ Tegal Tahun 2026.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                'bentuk' => 'softcopy dan hardcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/14OP9rXn0Ff9-WWbuNhB49QYoSK7bm503/view',
                'tautan' => [
                    ['nama' => 'Daftar Informasi Publik (DIP) PKTJ 2026', 'url' => 'https://drive.google.com/file/d/14OP9rXn0Ff9-WWbuNhB49QYoSK7bm503/view']
                ],
                'aktif' => true
            ],
            [
                'no' => 19,
                'judul' => 'Tata cara Permohonan Informasi Publik',
                'deskripsi' => 'Mekanisme Permohonan Informasi dan Pengajuan Keberatan Informasi Publik.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Kasubbag Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2018',
                'jangka' => '1 Tahun',
                'file' => 'https://ppid.pktj.ac.id/prosedur/permintaan-informasi',
                'tautan' => [
                    ['nama' => 'Tata Cara Permohonan Informasi Publik', 'url' => 'https://ppid.pktj.ac.id/prosedur/permintaan-informasi']
                ],
                'aktif' => true
            ],
            [
                'no' => 20,
                'judul' => 'Tata cara penyelesaian sengketa informasi publik',
                'deskripsi' => 'Mekanisme penyelesaian sengketa informasi publik.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                'bentuk' => 'softcopy dan hardcopy',
                'tempat' => 'Tegal',
                'waktu' => '2018',
                'jangka' => '1 Tahun',
                'file' => 'https://ppid.pktj.ac.id/prosedur/sengketa-informasi',
                'tautan' => [
                    ['nama' => 'Tata Cara Penyelesaian Sengketa Informasi Publik', 'url' => 'https://ppid.pktj.ac.id/prosedur/sengketa-informasi']
                ],
                'aktif' => true
            ],
            [
                'no' => 21,
                'judul' => 'Tata Cara Mengajukan Keberatan Informasi Publik',
                'deskripsi' => 'Mekanisme mengajukan keberatan informasi publik.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                'bentuk' => 'softcopy dan hardcopy',
                'tempat' => 'Tegal',
                'waktu' => '2018',
                'jangka' => '1 Tahun',
                'file' => 'https://ppid.pktj.ac.id/prosedur/penanganan-keberatan',
                'tautan' => [
                    ['nama' => 'Tata Cara Mengajukan Keberatan Informasi Publik', 'url' => 'https://ppid.pktj.ac.id/prosedur/penanganan-keberatan']
                ],
                'aktif' => true
            ],
            [
                'no' => 22,
                'judul' => 'Informasi mengenai kanal informasi dan pengaduan di Unit Kerja PKTJ Tegal',
                'deskripsi' => 'Berisi informasi mengenai kanal informasi dan pengaduan unit kerja PKTJ Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                'bentuk' => 'softcopy dan hardcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login'],
                    ['nama' => 'Whistleblowing System (WBS) BPSDMP', 'url' => 'https://bit.ly/ethicslineBPSDMP'],
                    ['nama' => 'Kanal Permasalahan Pembayaran PKTJ', 'url' => 'https://sites.google.com/pktj.ac.id/permasalahan-pembayaran/beranda?authuser=0']
                ],
                'aktif' => true
            ],
            [
                'no' => 23,
                'judul' => 'Laporan PPID',
                'deskripsi' => 'Laporan tahunan pelaksanaan pelayanan informasi publik dan pengelolaan dokumentasi PPID Pelaksana UPT PKTJ Tegal Tahun 2025 (Versi Canva / Paparan Laporan).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Unit Pelaksana Teknis PKTJ Tegal',
                'bentuk' => 'hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'storage/dokumen/Laporan_Tahunan_PPID_PKTJ_2025.pdf',
                'tautan' => [
                    ['nama' => 'Laporan PPID PKTJ 2025 (PDF)', 'url' => 'storage/dokumen/Laporan_Tahunan_PPID_PKTJ_2025.pdf']
                ],
                'aktif' => true
            ],
            [
                'no' => 24,
                'judul' => 'Jurnal Ilmiah',
                'deskripsi' => 'Daftar jurnal ilmiah transportasi Politeknik Keselamatan Transportasi Jalan.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                'bentuk' => 'hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://ktj.pktj.ac.id/ktj',
                'tautan' => [
                    ['nama' => 'Jurnal Ilmiah KTJ PKTJ', 'url' => 'https://ktj.pktj.ac.id/ktj']
                ],
                'aktif' => true
            ],
            [
                'no' => 25,
                'judul' => 'Informasi tentang pengadaan barang dan jasa di PKTJ Tegal',
                'deskripsi' => 'Berisi informasi tentang pengadaan barnag dan jasa sesuai Peraturan Komisi Informasi Republik Indonesia Nomor 1 Tahun 2021 pasal 14 yang berisikan Tahap Perencanaan (dokumen, RUP), Tahap Pemilihan (23 dokumentasi) dan Tahap pelaksanaan (15 dokumen) (Belum ada di drive humas).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                'bentuk' => 'hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login']
                ],
                'aktif' => true
            ]
        ];

        $setiapData = [
            [
                'no' => 1,
                'judul' => 'Dokumentasi Kegiatan Pimpinan',
                'deskripsi' => 'Foto dan berita dokumentasi kegiatan resmi Direktur dan pimpinan unit kerja di lingkungan PKTJ Tegal dalam pelaksanaan tugas kedinasan dan tridharma perguruan tinggi.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum / Humas',
                'bentuk' => 'Hardcopy dan Softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://pktj.ac.id/berita',
                'tautan' => [
                    ['nama' => 'Portal Berita & Dokumentasi Kegiatan PKTJ', 'url' => 'https://pktj.ac.id/berita']
                ],
                'aktif' => true
            ],
            [
                'no' => 2,
                'judul' => 'Peraturan, Keputusan, dan Kebijakan Direktur / Kepala Unit Kerja',
                'deskripsi' => 'Informasi mengenai peraturan, keputusan, instruksi, dan surat edaran Direktur PKTJ Tegal yang berlaku secara operasional di lingkungan kampus.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Hardcopy dan Softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/jdih/',
                'tautan' => [
                    ['nama' => 'JDIH BPSDMP Kemenhub', 'url' => 'https://bpsdm.kemenhub.go.id/jdih/']
                ],
                'aktif' => true
            ],
            [
                'no' => 3,
                'judul' => 'Laporan Data Barang Milik Negara',
                'deskripsi' => 'Berisi informasi mengenai mutase tambah kurang, Penyusutan, penetapan status penggunaan, penghapusan barang milik negara unit kerja di lingkungan PKTJ Tegal yang telah di audit oleh BPK-RI (Belum ada di drive humas).',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Keuangan Sekretariat PKTJ Tegal',
                'bentuk' => 'Hardcopy dan Softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login']
                ],
                'aktif' => true
            ],
            [
                'no' => 4,
                'judul' => 'Informasi pengelolaan arsip unit kerja di lingkungan Unit Kerja',
                'deskripsi' => 'Informasi mengenai penataan dokumen yang tersimpan menurut bagian di dalam ruang arsip yang tersedia di lingkungan PKTJ Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Hukum, Humas, dan Umum',
                'bentuk' => 'Hardcopy dan Softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login']
                ],
                'aktif' => true
            ],
            [
                'no' => 5,
                'judul' => 'Kurikulum dan Silabus Pendidikan dan Pelatihan',
                'deskripsi' => 'Berisi Keputusan Kepala PKTJ terkait penetapan kurikulum dan silabus pendidikan dan pelatihan.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Hukum, Humas, dan Umum',
                'bentuk' => 'Hardcopy dan Softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://pktj.ac.id/program-studi',
                'tautan' => [
                    ['nama' => 'Program Studi & Kurikulum PKTJ', 'url' => 'https://pktj.ac.id/program-studi'],
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login']
                ],
                'aktif' => true
            ],
            [
                'no' => 6,
                'judul' => 'Standar Operational Prosedur (SOP)',
                'deskripsi' => 'Berisi tentang informasi berupa SOP-SOP yang dibuat oleh PKTJ Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian SDMO',
                'bentuk' => 'softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://drive.google.com/file/d/1snKcqdyvlv4F4PWsg9AhbcU55KxlKXWr/view?usp=sharing',
                'tautan' => [
                    ['nama' => '01. SOP Pelayanan Praktik Bahasa', 'url' => 'https://drive.google.com/file/d/1rWe1ppcd1n_LyR_uiREYXethRilMfCrh/view?usp=sharing'],
                    ['nama' => '02. SOP Penyusunan & Penetapan SPMI', 'url' => 'https://drive.google.com/file/d/1nb7bCXaeZWsYhqoeQ4_fvfTf57s1ZRaq/view?usp=sharing'],
                    ['nama' => '03. SOP Pengelolaan IT', 'url' => 'https://drive.google.com/file/d/14Z0PBFGWQ64vXwOdXw9hTgMfXog4Vl_c/view?usp=sharing'],
                    ['nama' => '04. SOP Pelaksanaan Apel Pegawai', 'url' => 'https://drive.google.com/file/d/1Ss67Nd46HVHKHg-5gpC3CDw_QAN5C5DV/view?usp=sharing'],
                    ['nama' => '05. SOP Audit Kinerja', 'url' => 'https://drive.google.com/file/d/1MZrNZgiyYpPv9wmrc9hidMmXdS-17bSP/view?usp=sharing'],
                    ['nama' => '06. SOP Penyelenggaraan Diklat Teknis', 'url' => 'https://drive.google.com/file/d/1tUfgaJrXVKRhfHEsHct0_fFRmzKi2Yzd/view?usp=sharing'],
                    ['nama' => '08. SOP Kelompok Dosen & Mata Kuliah', 'url' => 'https://drive.google.com/file/d/1B90BKD97zmDxH8RcwMcMwXq5UIEtru1U/view?usp=sharing'],
                    ['nama' => '09. SOP Pengelolaan Perpustakaan', 'url' => 'https://drive.google.com/file/d/1fmGVq4jAjePUtdnNdIpj_LghyqRTtocO/view?usp=sharing'],
                    ['nama' => '10. SOP Standar Pedoman Penelitian', 'url' => 'https://drive.google.com/file/d/14k4t_jQnthBjouHX2A5KVRP5mbClFVhk/view?usp=sharing'],
                    ['nama' => '11. SOP Praktik Laboratorium & Simulator', 'url' => 'https://drive.google.com/file/d/1UImxrWPLLP3OQoH_qNc0zSRLUsAx6j27/view?usp=sharing'],
                    ['nama' => '12. SOP Pengusulan Tarif Diklat', 'url' => 'https://drive.google.com/file/d/1SeV6C6pRMRf__3sRzIdBMOsgI5TdyJaP/view?usp=sharing'],
                    ['nama' => '14. SOP Pengabdian Masyarakat', 'url' => 'https://drive.google.com/file/d/1Fl8iIqF3bDR3mI_DgRzMXI7gcwdAdydF/view?usp=sharing'],
                    ['nama' => '15. SOP Layanan Perpustakaan & Belajar', 'url' => 'https://drive.google.com/file/d/18mBGiZ-7bOIc1f7dgTVj010GmdQXjTS3/view?usp=sharing'],
                    ['nama' => '16. SOP Pengelolaan Informasi Publik', 'url' => 'https://drive.google.com/file/d/1snKcqdyvlv4F4PWsg9AhbcU55KxlKXWr/view?usp=sharing'],
                    ['nama' => '17. SOP Pengelolaan Pengaduan Masyarakat', 'url' => 'https://drive.google.com/file/d/1Sh2z3gv93ZJHnCnfq1_46K1nBJl-NiYp/view?usp=sharing']
                ],
                'aktif' => true
            ],
            [
                'no' => 7,
                'judul' => 'Dokumen terkait bantuan tugas belajar',
                'deskripsi' => 'Berisi informasi tentang pelaksanaan kegiatan bantuan tugas belajar.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian SDMO',
                'bentuk' => 'softcopy dan hardcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login']
                ],
                'aktif' => true
            ],
            [
                'no' => 8,
                'judul' => 'Dokumen assesment di PKTJ Tegal',
                'deskripsi' => 'Informasi mengenai pelaksanaan kegiatan assesmen di PKTJ Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian SDMO',
                'bentuk' => 'Hardcopy dan Softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login']
                ],
                'aktif' => true
            ],
            [
                'no' => 9,
                'judul' => 'Dokumen terkait Ujian Dinas',
                'deskripsi' => 'Berisi Informasi tentang pelaksanaan kegiatan Ujian Dinas.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian SDMO',
                'bentuk' => 'softcopy dan hardcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login']
                ],
                'aktif' => true
            ],
            [
                'no' => 10,
                'judul' => 'Laporan Sistem Pengendalian Intern Pemerintah',
                'deskripsi' => 'Berisi gambaran efektifitas, struktur, kebijakan dan prosedur organisasi dalam mengendalikan resiko di PKTJ Tegal.',
                'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit' => 'Bagian Perencanaan',
                'bentuk' => 'softcopy dan hardcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login']
                ],
                'aktif' => true
            ]
        ];

        $sertaData = [
            [
                'no' => 1,
                'judul' => 'Perubahan jadwal layanan Publik di PKTJ Tegal',
                'deskripsi' => 'Informasi mengenai perubahan jadwal layanan serta sarana dan prasarana publik di PKTJ Tegal karena Faktor internal dan eksternal.',
                'pejabat' => 'PPID Pelaksana Unit Kerja di PKTJ Tegal',
                'penerbit' => 'Unit Kerja di PKTJ Tegal',
                'bentuk' => 'hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login'],
                    ['nama' => 'Halaman Kontak & Jam Layanan', 'url' => '/profil/kontak']
                ],
                'aktif' => true
            ],
            [
                'no' => 2,
                'judul' => 'Pengumuman gangguan publik karena aktivitas sekolah di PKTJ Tegal',
                'deskripsi' => 'Informasi mengenai pengumuman gangguan publik karena aktivitas sekolah di lingkungan sekitar PKTJ Tegal.',
                'pejabat' => 'PPID Pelaksana Unit Kerja di PKTJ Tegal',
                'penerbit' => 'Unit Kerja di PKTJ Tegal',
                'bentuk' => 'hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://www.instagram.com/p/DYrb10MlHfY/?igsi=MWkzNTR3aXd0dm55YQ==',
                'tautan' => [
                    ['nama' => 'Pengumuman Resmi Media Sosial PKTJ', 'url' => 'https://www.instagram.com/p/DYrb10MlHfY/?igsi=MWkzNTR3aXd0dm55YQ==']
                ],
                'aktif' => true
            ],
            [
                'no' => 3,
                'judul' => 'Perubahan Alur Masuk Kendaraan Kantor Kementerian Perhubungan',
                'deskripsi' => 'Perubahan Alur Masuk Kendaraan Kantor PKTJ Tegal jalan Perintis Kemerdekaan nomor 17 kelurahan Slerok kecamatan Tegal Timur dan jalan Abdul Syukur nomor 17 kelurahan Margadana kecamatan Margadana Kota Tegal.',
                'pejabat' => 'PPID Pelaksana di PKTJ Tegal',
                'penerbit' => 'Unit Kerja di PKTJ Tegal',
                'bentuk' => 'hardcopy dan softcopy',
                'tempat' => 'Tegal',
                'waktu' => '2026',
                'jangka' => '1 Tahun',
                'file' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login',
                'tautan' => [
                    ['nama' => 'Hubungi PPID PKTJ', 'url' => 'https://bpsdm.kemenhub.go.id/ppid/pktj/login'],
                    ['nama' => 'Denah Alur Masuk Kampus PKTJ', 'url' => 'https://pktj.ac.id/tentang#']
                ],
                'aktif' => true
            ]
        ];

        $dikData = [
            [
                'no' => 1,
                'judul' => 'Hak Akses CCTV di Lingkungan Kampus PKTJ Tegal: Gerbang Kampus, Ruang Kelas, Ruang Tenaga Pengajar, Laboratorium, Asrama, dan Ruang Pembina',
                'dasar_hukum' => 'Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Pasal 17 huruf j jo. Keputusan Sekjen Nomor KP-SKJ 8 Tahun 2026',
                'konsekuensi_dibuka' => 'Apabila dibuka dapat melanggar ketentuan pada undang-undang dan membocorkan titik buta sistem keamanan kampus serta asrama taruna/taruni.',
                'konsekuensi_ditutup' => 'Apabila ditutup dapat melindungi sistem elektronik milik pemerintah dan menjaga privasi asrama serta obyek vital pendidikan sesuai ketentuan undang-undang.',
                'jangka_waktu' => '5 Tahun',
                'file_path' => 'https://drive.google.com/file/d/1d-80lK55eSXGG0ZogSoUUPv7cJKZvie0/view?usp=drive_link',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ Tegal',
                'deskripsi' => 'Rekaman pemantauan kamera pengawas (CCTV) pada fasilitas vital kampus dan asrama taruna/taruni.'
            ],
            [
                'no' => 2,
                'judul' => 'Informasi Terkait Data Rincian Penilaian Proses Penetapan Seleksi Penerimaan Calon Taruna (SIPENCATAR) PKTJ Tegal',
                'dasar_hukum' => 'Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Pasal 17 huruf h angka 4 jo. Keputusan Sekjen Nomor KP-SKJ 8 Tahun 2026',
                'konsekuensi_dibuka' => 'Apabila dibuka dapat mengungkap rahasia pribadi, yaitu hasil evaluasi sehubungan dengan rekam medis kesehatan, psikotes kepribadian, intelektualitas, dan rekomendasi kemampuan seseorang.',
                'konsekuensi_ditutup' => 'Apabila ditutup dapat melindungi rahasia pribadi peserta seleksi penerimaan calon taruna/taruni sesuai dengan undang-undang perlindungan data pribadi.',
                'jangka_waktu' => '5 Tahun',
                'file_path' => 'https://drive.google.com/file/d/1d-80lK55eSXGG0ZogSoUUPv7cJKZvie0/view?usp=drive_link',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ Tegal / Panitia Sipencatar',
                'deskripsi' => 'Rincian nilai psikotes, rekam medis kesehatan, dan hasil uji kesamaptaan individual peserta seleksi.'
            ],
            [
                'no' => 3,
                'judul' => 'Topologi Infrastruktur Jaringan Server dan Sistem Keamanan Siber PKTJ Tegal',
                'dasar_hukum' => 'Undang-Undang Nomor 11 Tahun 2008 jo. UU Nomor 1 Tahun 2024 tentang ITE, serta UU No. 14 Tahun 2008 Pasal 17 huruf j jo. Keputusan Sekjen Nomor KP-SKJ 8 Tahun 2026',
                'konsekuensi_dibuka' => 'Jika dibuka dapat berpotensi terkena serangan siber dan ancaman exploit pada arsitektur data center.',
                'konsekuensi_ditutup' => 'Jika ditutup/tidak diperlihatkan maka server dan sistem informasi akademik aman dari segala potensi gangguan/serangan hacker.',
                'jangka_waktu' => '5 Tahun',
                'file_path' => 'https://drive.google.com/file/d/1d-80lK55eSXGG0ZogSoUUPv7cJKZvie0/view?usp=drive_link',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ Tegal / Unit TI',
                'deskripsi' => 'Diagram arsitektur jaringan, konfigurasi firewall, IP internal, dan topologi server PKTJ Tegal.'
            ]
        ];

        // 2. SINKRONISASI INFORMASI BERKALA (25 Items)
        InformasiBerkala::query()->delete();
        foreach ($berkalaData as $b) {
            InformasiBerkala::create([
                'judul' => $b['judul'],
                'deskripsi' => $b['deskripsi'],
                'pejabat_penguasa' => $b['pejabat'],
                'penerbit_informasi' => $b['penerbit'],
                'penanggung_jawab' => $b['penerbit'],
                'bentuk_informasi' => $b['bentuk'],
                'tempat_pembuatan' => $b['tempat'],
                'waktu_pembuatan' => $b['waktu'],
                'jangka_waktu' => $b['jangka'],
                'file_path' => $b['file'],
                'tautan_links' => $b['tautan'],
                'aktif' => $b['aktif'] ?? true,
                'bisa_download' => true,
                'tanggal' => date('Y-m-d')
            ]);
        }

        // 3. SINKRONISASI INFORMASI SETIAP SAAT (10 Items)
        InformasiSetiapSaat::query()->delete();
        foreach ($setiapData as $s) {
            InformasiSetiapSaat::create([
                'judul' => $s['judul'],
                'deskripsi' => $s['deskripsi'],
                'pejabat_penguasa' => $s['pejabat'],
                'penerbit_informasi' => $s['penerbit'],
                'penanggung_jawab' => $s['penerbit'],
                'bentuk_informasi' => $s['bentuk'],
                'tempat_pembuatan' => $s['tempat'],
                'waktu_pembuatan' => $s['waktu'],
                'jangka_waktu' => $s['jangka'],
                'file_path' => $s['file'],
                'tautan_links' => $s['tautan'],
                'aktif' => $s['aktif'] ?? true,
                'bisa_download' => true,
                'tanggal' => date('Y-m-d')
            ]);
        }

        // 4. SINKRONISASI INFORMASI SERTA MERTA (3 Items)
        InformasiSertaMerta::query()->delete();
        foreach ($sertaData as $sm) {
            InformasiSertaMerta::create([
                'judul' => $sm['judul'],
                'deskripsi' => $sm['deskripsi'],
                'pejabat_penguasa' => $sm['pejabat'],
                'penerbit_informasi' => $sm['penerbit'],
                'penanggung_jawab' => $sm['penerbit'],
                'bentuk_informasi' => $sm['bentuk'],
                'tempat_pembuatan' => $sm['tempat'],
                'waktu_pembuatan' => $sm['waktu'],
                'jangka_waktu' => $sm['jangka'],
                'file_path' => $sm['file'],
                'tautan_links' => $sm['tautan'],
                'aktif' => $sm['aktif'] ?? true,
                'bisa_download' => true,
                'tanggal' => date('Y-m-d')
            ]);
        }

        // 5. SINKRONISASI DAFTAR INFORMASI (MASTER DIP)
        DaftarInformasi::query()->delete();
        foreach ($berkalaData as $b) {
            DaftarInformasi::create([
                'judul_informasi' => $b['judul'],
                'isi_informasi' => $b['deskripsi'],
                'kategori' => 'informasi-berkala',
                'tipe_informasi' => 'Berkala',
                'pejabat_penguasa' => $b['pejabat'],
                'penerbit_informasi' => $b['penerbit'],
                'penanggung_jawab' => $b['penerbit'],
                'bentuk_informasi' => $b['bentuk'],
                'tempat_pembuatan' => $b['tempat'],
                'waktu_pembuatan' => $b['waktu'],
                'jangka_waktu' => $b['jangka'],
                'file_informasi' => $b['file'],
                'tautan_links' => $b['tautan'],
                'aktif' => $b['aktif'] ?? true,
                'bisa_download' => true
            ]);
        }
        foreach ($setiapData as $s) {
            DaftarInformasi::create([
                'judul_informasi' => $s['judul'],
                'isi_informasi' => $s['deskripsi'],
                'kategori' => 'informasi-setiap-saat',
                'tipe_informasi' => 'Setiap Saat',
                'pejabat_penguasa' => $s['pejabat'],
                'penerbit_informasi' => $s['penerbit'],
                'penanggung_jawab' => $s['penerbit'],
                'bentuk_informasi' => $s['bentuk'],
                'tempat_pembuatan' => $s['tempat'],
                'waktu_pembuatan' => $s['waktu'],
                'jangka_waktu' => $s['jangka'],
                'file_informasi' => $s['file'],
                'tautan_links' => $s['tautan'],
                'aktif' => $s['aktif'] ?? true,
                'bisa_download' => true
            ]);
        }
        foreach ($sertaData as $sm) {
            DaftarInformasi::create([
                'judul_informasi' => $sm['judul'],
                'isi_informasi' => $sm['deskripsi'],
                'kategori' => 'informasi-serta-merta',
                'tipe_informasi' => 'Serta Merta',
                'pejabat_penguasa' => $sm['pejabat'],
                'penerbit_informasi' => $sm['penerbit'],
                'penanggung_jawab' => $sm['penerbit'],
                'bentuk_informasi' => $sm['bentuk'],
                'tempat_pembuatan' => $sm['tempat'],
                'waktu_pembuatan' => $sm['waktu'],
                'jangka_waktu' => $sm['jangka'],
                'file_informasi' => $sm['file'],
                'tautan_links' => $sm['tautan'],
                'aktif' => $sm['aktif'] ?? true,
                'bisa_download' => true
            ]);
        }

        // 6. SINKRONISASI INFORMASI DIKECUALIKAN (3 Items)
        InformasiDikecualikan::query()->delete();
        foreach ($dikData as $d) {
            InformasiDikecualikan::create([
                'judul' => $d['judul'],
                'deskripsi' => $d['deskripsi'],
                'dasar_hukum' => $d['dasar_hukum'],
                'konsekuensi_dibuka' => $d['konsekuensi_dibuka'],
                'konsekuensi_ditutup' => $d['konsekuensi_ditutup'],
                'jangka_waktu' => $d['jangka_waktu'],
                'penanggung_jawab' => $d['penanggung_jawab'],
                'file_path' => $d['file_path'],
                'aktif' => true,
                'bisa_download' => true,
                'tanggal' => date('Y-m-d')
            ]);
        }

        // 7. NONAKTIFKAN MENU DIKECUALIKAN & DASHBOARD SETTING (SEMBUNYIKAN TOTAL)
        CustomMenu::where('id', 12)->orWhere('slug', 'informasi-dikecualikan-sub')->update(['aktif' => 0]);
        Dashboard::updateOrCreate(['key' => 'menu_dikecualikan_aktif'], ['value' => '0', 'type' => 'boolean']);

        // 8. REGULASI SK DIP & SK DIK 2026
        Peraturan::updateOrCreate(
            ['id' => 19],
            [
                'judul' => 'Keputusan Sekretaris Jenderal Kemenhub Nomor KP-SKJ 9 Tahun 2026',
                'nomor' => 'KP-SKJ 9 Tahun 2026',
                'tahun' => '2026',
                'deskripsi' => 'tentang Penetapan Daftar Informasi Publik (DIP) Kementerian Perhubungan Tahun 2026',
                'link_download' => 'https://drive.google.com/file/d/14OP9rXn0Ff9-WWbuNhB49QYoSK7bm503/view?usp=drive_link',
                'kategori' => 'Kementerian Perhubungan',
                'urutan' => 9,
                'is_active' => 1,
            ]
        );

        Peraturan::updateOrCreate(
            ['id' => 20],
            [
                'judul' => 'Keputusan Sekretaris Jenderal Kemenhub Nomor KP-SKJ 8 Tahun 2026',
                'nomor' => 'KP-SKJ 8 Tahun 2026',
                'tahun' => '2026',
                'deskripsi' => 'tentang Perubahan Ketiga Atas Keputusan Sekretaris Jenderal Nomor KP 591 Tahun 2023 tentang Informasi yang Dikecualikan',
                'link_download' => 'https://drive.google.com/file/d/1d-80lK55eSXGG0ZogSoUUPv7cJKZvie0/view?usp=drive_link',
                'kategori' => 'Kementerian Perhubungan',
                'urutan' => 10,
                'is_active' => 1,
            ]
        );

        // 9. PROFIL PPID & VISI MISI PKTJ
        $pProfil = [
            'type' => 'profil',
            'judul' => 'Profil PPID PKTJ Tegal',
            'tagline_hero' => 'Mewujudkan Keterbukaan Informasi Menuju Tata Kelola Pendidikan Vokasi yang Transparan, Akuntabel, dan Berkelanjutan',
            'image_hero' => null,
            'konten_pembuka' => '<div class="mb-4">
    <p class="lead fw-semibold text-dark" style="font-size: 1.15rem; line-height: 1.8; text-align: justify; margin-bottom: 20px;">
        Dalam mewujudkan tata kelola kepemerintahan yang baik, transparan, dan akuntabel di lingkungan Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal melalui transparansi informasi publik guna memenuhi hak setiap pemohon informasi sesuai dengan ketentuan peraturan perundang-undangan.
    </p>
    <p style="text-align: justify; line-height: 1.8; margin-bottom: 20px;">
        Sejak Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik (UU KIP) diberlakukan secara efektif pada tanggal 30 April 2010 telah mendorong bangsa Indonesia satu langkah maju ke depan, menjadi bangsa yang transparan dan akuntabel dalam mengelola sumber daya publik. UU KIP sebagai instrumen hukum yang mengikat merupakan sarana dalam mengoptimalkan pengawasan publik terhadap penyelenggaraan negara dan Badan Publik lainnya serta segala sesuatu yang berakibat pada kepentingan publik, sekaligus menjadi upaya strategis dalam mengembangkan masyarakat informasi guna meningkatkan peran serta aktif masyarakat dalam pengambilan kebijakan publik.
    </p>
    <p style="text-align: justify; line-height: 1.8; margin-bottom: 20px;">
        Sejalan dengan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik (UU KIP), Kementerian Perhubungan telah menetapkan Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan. Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal sebagai salah satu Unit Pelaksana Teknis (UPT) di lingkungan Kementerian Perhubungan telah membentuk Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana melalui Surat Keputusan Direktur Nomor KP-PKTJ 384 Tahun 2026 guna menjamin kepastian layanan informasi yang profesional, cepat, dan berintegritas.
    </p>
    <p style="text-align: justify; line-height: 1.8; margin-bottom: 20px;">
        Sebagai perguruan tinggi kedinasan vokasi di bawah naungan Kementerian Perhubungan yang berdiri sejak 14 Mei 1971—berawal dari Balai Diklat Trans Jaya, bertransformasi menjadi Balai Pendidikan dan Pelatihan Transportasi Darat (BPPTD), hingga ditetapkan menjadi Politeknik Keselamatan Transportasi Jalan berdasarkan Peraturan Menteri Perhubungan Nomor PM 15 Tahun 2012—PKTJ kini beroperasi di dua kampus di Kota Tegal, yaitu Kampus I di Jl. Perintis Kemerdekaan dan Kampus II di Jl. KH. Abdul Syukur Margadana. Melalui semangat keterbukaan informasi publik, PPID Pelaksana PKTJ Tegal berkomitmen terus mendukung terwujudnya tata kelola pendidikan vokasi transportasi jalan yang unggul, berintegritas, serta berdaya saing nasional dan global.
    </p>
</div>',
            'judul_sub' => null,
            'konten_detail' => null,
            'gambaran' => null,
            'is_blurred' => 0,
            'gambar' => null,
            'link_dokumen' => null,
            'additional_sections' => []
        ];
        ProfilPpid::updateOrCreate(['type' => 'profil'], $pProfil);

        // Update profil_singkat juga
        ProfilPpid::updateOrCreate(
            ['type' => 'profil_singkat'],
            [
                'judul' => 'Profil Singkat PPID PKTJ Tegal',
                'konten_pembuka' => $pProfil['konten_pembuka'],
                'konten_detail' => null,
                'tagline_hero' => $pProfil['tagline_hero'],
                'is_blurred' => 0
            ]
        );

        $pVisi = [
            'type' => 'visi',
            'judul' => 'Visi & Misi PPID PKTJ',
            'tagline_hero' => 'Landasan Komitmen Keterbukaan Informasi Publik yang Transparan, Objektif, dan Prima',
            'image_hero' => null,
            'konten_pembuka' => '<div class="visi-misi-wrapper mb-5">
    <!-- VISI HERO CARD -->
    <div class="card border-0 rounded-4 shadow-sm p-4 p-md-5 text-center mb-5 position-relative overflow-hidden" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%); border: 2px solid #bfdbfe !important; border-top: 6px solid #004a99 !important;">
        <div class="d-inline-flex align-items-center gap-2 px-3.5 py-1.5 rounded-pill fw-bold text-uppercase mb-3 mx-auto" style="background: #002b5c; color: #ffc107 !important; font-size: 12px; letter-spacing: 1.5px;">
            <i class="fas fa-eye text-warning"></i> VISI PPID PKTJ
        </div>
        <h3 class="outfit fw-black text-center mb-0 px-2" style="color: #002b5c !important; font-size: 1.65rem; line-height: 1.6; max-width: 950px; margin: 15px auto;">
            “Terwujudnya layanan informasi publik yang Transparan, Objektif dan Prima untuk meningkatkan peran serta aktif masyarakat dalam penyelenggaraan pembangunan sektor transportasi.”
        </h3>
        <p class="text-muted small text-center mb-0 mt-3" style="color: #64748b !important;">
            <i class="fas fa-quote-left text-warning opacity-50 me-2"></i>Komitmen Utama Keterbukaan Informasi Publik di Lingkungan Politeknik Keselamatan Transportasi Jalan<i class="fas fa-quote-right text-warning opacity-50 ms-2"></i>
        </p>
    </div>

    <!-- PENJELASAN MAKNA DARI VISI -->
    <div class="mb-5">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: #e0f2fe; color: #0284c7; font-size: 22px;">
                <i class="fas fa-shapes"></i>
            </div>
            <div>
                <h4 class="outfit fw-bold text-dark mb-0" style="color: #002b5c !important; font-size: 1.35rem;">Makna dari Visi</h4>
                <span class="text-muted small">Penjabaran prinsip utama penyelenggaraan informasi publik</span>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white shadow-sm h-100 position-relative overflow-hidden" style="border: 1px solid #e2e8f0 !important; border-top: 5px solid #0284c7 !important;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 13px; font-weight: bold; background: #e0f2fe; color: #0284c7 !important;">1</span>
                        <h5 class="outfit fw-bold mb-0" style="color: #002b5c !important; font-size: 16px;">Layanan Informasi Publik</h5>
                    </div>
                    <p class="mb-0" style="color: #334155 !important; line-height: 1.7; font-size: 14.5px;">
                        Suatu usaha untuk memberikan informasi publik sesuai Undang- Undang No. 14 tahun 2008 tentang Keterbukaan Informasi Publik di lingkungan Kementerian Perhubungan;
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white shadow-sm h-100 position-relative overflow-hidden" style="border: 1px solid #e2e8f0 !important; border-top: 5px solid #10b981 !important;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 13px; font-weight: bold; background: #d1fae5; color: #059669 !important;">2</span>
                        <h5 class="outfit fw-bold mb-0" style="color: #002b5c !important; font-size: 16px;">Transparan</h5>
                    </div>
                    <p class="mb-0" style="color: #334155 !important; line-height: 1.7; font-size: 14.5px;">
                        Memberikan akses seluar-luasnya kepada masyarakat dalam memperoleh informasi publik dengan cepat dan tepat waktu, biaya ringan, dan cara yang sederhana;
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white shadow-sm h-100 position-relative overflow-hidden" style="border: 1px solid #e2e8f0 !important; border-top: 5px solid #6366f1 !important;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 13px; font-weight: bold; background: #ede9fe; color: #6366f1 !important;">3</span>
                        <h5 class="outfit fw-bold mb-0" style="color: #002b5c !important; font-size: 16px;">Objektif</h5>
                    </div>
                    <p class="mb-0" style="color: #334155 !important; line-height: 1.7; font-size: 14.5px;">
                        Memberikan akses informasi kepada setiap kalangan, baik Perorangan, Kelompok, maupun Badan Hukum;
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white shadow-sm h-100 position-relative overflow-hidden" style="border: 1px solid #e2e8f0 !important; border-top: 5px solid #f59e0b !important;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 13px; font-weight: bold; background: #fef3c7; color: #d97706 !important;">4</span>
                        <h5 class="outfit fw-bold mb-0" style="color: #002b5c !important; font-size: 16px;">Prima</h5>
                    </div>
                    <p class="mb-0" style="color: #334155 !important; line-height: 1.7; font-size: 14.5px;">
                        Terus Berupaya penuh dalam peningkatan Pelayanan, Pengelolaan dan Pendokumentasian Informasi Publik secara Akuntabel, Efisien dan Mudah Diakses.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MISI SECTION -->
    <div class="misi-section mb-4">
        <div class="d-flex align-items-center gap-3 mb-4 mt-5">
            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: #e0e7ff; color: #002b5c; font-size: 22px;">
                <i class="fas fa-bullseye"></i>
            </div>
            <div>
                <h4 class="outfit fw-bold text-dark mb-0" style="color: #002b5c !important; font-size: 1.45rem;">Misi</h4>
                <span class="text-muted small">Lima komitmen penyelenggaraan pelayanan informasi publik PPID PKTJ</span>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">1</span>
                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                        Menjamin akses informasi publik sesuai Undang-Undang No. 14 tahun 2008 tentang Keterbukaan Informasi Publik;
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">2</span>
                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                        Meningkatkan kualitas layanan informasi publik;
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">3</span>
                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                        Meningkatkan profesionalisme SDM layanan informasi publik;
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">4</span>
                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                        Meningkatkan sarana-prasarana dalam rangka efisiensi dan efektivitas layanan informasi publik;
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="p-3.5 p-md-4 rounded-4 border bg-white shadow-sm d-flex gap-3 align-items-center hover-lift" style="border: 1px solid #e2e8f0 !important; border-left: 5px solid #004a99 !important;">
                    <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 15px; font-weight: 800; background: #002b5c; color: #ffffff !important;">5</span>
                    <div class="fw-semibold" style="color: #1e293b !important; font-size: 15px; line-height: 1.6;">
                        Meningkatkan pengelolaan informasi dan dokumentasi secara baik, efisien, mudah diakses dan bersifat desentralisasi.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>',
            'judul_sub' => null,
            'konten_detail' => null,
            'gambaran' => null,
            'is_blurred' => 0,
            'gambar' => null,
            'link_dokumen' => null,
            'additional_sections' => []
        ];
        ProfilPpid::updateOrCreate(['type' => 'visi'], $pVisi);

        // 10. PASTIKAN URUTAN SUBMENU INFORMASI PUBLIK: BERKALA (1), SETIAP SAAT (2), SERTA MERTA (3) & HAPUS/SEMBUNYIKAN DIKECUALIKAN
        CustomMenu::where('slug', 'informasi-berkala-sub')->orWhere('url', 'like', '%/informasi-publik/berkala%')->update(['urutan' => 1, 'aktif' => 1]);
        CustomMenu::where('slug', 'informasi-setiap-saat-sub')->orWhere('url', 'like', '%/informasi-publik/setiap-saat%')->update(['urutan' => 2, 'aktif' => 1]);
        CustomMenu::where('slug', 'informasi-serta-merta-sub')->orWhere('url', 'like', '%/informasi-publik/serta-merta%')->update(['urutan' => 3, 'aktif' => 1]);
        CustomMenu::where('slug', 'informasi-dikecualikan-sub')->orWhere('url', 'like', '%/informasi-publik/dikecualikan%')->update(['aktif' => 0]);
        Dashboard::updateOrCreate(['key' => 'menu_dikecualikan_aktif'], ['value' => '0', 'type' => 'boolean']);
        Dashboard::updateOrCreate(['key' => 'video_url'], ['value' => 'https://youtu.be/e-zh2icc4EQ?si=H1w-zNXl56bVJiB3', 'type' => 'text', 'aktif' => 1]);
        Dashboard::updateOrCreate(['key' => 'profil_youtube_link'], ['value' => 'https://youtu.be/e-zh2icc4EQ?si=H1w-zNXl56bVJiB3', 'type' => 'text', 'aktif' => 1]);

        // 11. SINKRONISASI DATA RESMI STATISTIK KEPEGAWAIAN (155 PEGAWAI DARI EXCEL DRH SIMPEG)
        if (class_exists(\App\Http\Controllers\StatistikPegawaiController::class)) {
            $statDefaults = \App\Http\Controllers\StatistikPegawaiController::getDefaults();
            foreach ($statDefaults as $sKey => $sVal) {
                Dashboard::updateOrCreate(
                    ['key' => 'statistik_pegawai_' . $sKey],
                    [
                        'value' => $sVal,
                        'type' => (is_array(json_decode($sVal, true)) ? 'json' : 'text'),
                        'description' => 'Statistik Pegawai ' . $sKey,
                        'aktif' => true
                    ]
                );
            }
        }

        // 12. SINKRONISASI DOKUMEN RESMI LAPORAN LAYANAN 2025 (VERSI PAPARAN LAPORAN / PPT PDF)
        if (class_exists(Dokumen::class)) {
            Dokumen::where('kategori', 'Laporan Layanan')
                ->where(function($q) {
                    $q->where('judul', 'like', '%Penyampaian Laporan%')
                      ->orWhere('deskripsi', 'like', '%UM.006/2/16/PKTJ/2025%');
                })->delete();

            Dokumen::updateOrCreate(
                [
                    'kategori' => 'Laporan Layanan',
                    'judul' => 'Laporan Tahunan PPID Pelaksana UPT PKTJ Tegal Tahun 2025'
                ],
                [
                    'file_path' => 'dokumen/Laporan_Tahunan_PPID_PKTJ_2025.pdf',
                    'file_name' => 'Laporan_Tahunan_PPID_PKTJ_2025.pdf',
                    'file_size' => '965 KB',
                    'file_type' => 'pdf',
                    'tanggal' => '2025-12-31',
                    'deskripsi' => 'Laporan Tahunan PPID Pelaksana UPT Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal Tahun 2025 (Versi Paparan Laporan Komprehensif).',
                    'aktif' => true,
                    'bisa_download' => true,
                    'is_blurred' => false,
                ]
            );
        }
    }
}