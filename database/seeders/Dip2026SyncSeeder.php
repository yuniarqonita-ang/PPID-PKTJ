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

class Dip2026SyncSeeder extends Seeder
{
    /**
     * Sinkronisasi Resmi Terpadu DIP & DIK PKTJ Tegal Tahun 2026 Sesuai SK Sekjen Kemenhub:
     * - SK Sekjen Kemenhub No. KP-SKJ 9 Tahun 2026 (DIP: 25 Berkala, 10 Setiap Saat, 3 Serta Merta = 38 Master DIP)
     * - SK Sekjen Kemenhub No. KP-SKJ 8 Tahun 2026 (DIK: 3 Informasi Dikecualikan)
     * - Visi Misi Prinsip TOP (Transparan, Objektif, Prima, Akuntabel, Terintegrasi)
     * - Profil PPID Sejarah PKTJ (BPLTD 1971, Pusdiklat 1975, BPPTD 2002, PKTJ 2012/2021)
     * - Regulasi SK DIP 2026 dan SK DIK 2026
     * - Menu Dikecualikan Aktif
     */
    public function run(): void
    {
        // 1. DATA ARRAY RESMI DIP & DIK
        $berkalaData = [
    [
        'no' => 1,
        'judul' => 'Profil Unit Kerja Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal',
        'deskripsi' => 'Informasi komprehensif mengenai profil kelembagaan, sejarah transformasi dari BPLTD 1971 hingga PKTJ, tugas pokok dan fungsi spesifik pendidikan tinggi vokasi keselamatan jalan, struktur organisasi, alamat Kampus 1 & Kampus 2, kontak layanan, sarana laboratorium, dan pemanfaatan aset PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Website, hardcopy, dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/profil/profil-ppid',
        'tautan' => [
            ['nama' => 'Halaman Profil PPID PKTJ', 'url' => 'https://ppid.pktj.ac.id/profil/profil-ppid'],
            ['nama' => 'Profil Sejarah Institusi PKTJ', 'url' => 'https://pktj.ac.id/tentang#']
        ]
    ],
    [
        'no' => 2,
        'judul' => 'Profil Pejabat Publik di Lingkungan PKTJ Tegal',
        'deskripsi' => 'Informasi mengenai profil singkat, rekam jejak kepemimpinan, riwayat pendidikan formal, dan jabatan struktural Direktur, para Wakil Direktur, Kepala Bagian, Kepala Unit, serta Ketua Program Studi di lingkungan PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/profil/profil-pejabat',
        'tautan' => [
            ['nama' => 'Halaman Profil Pejabat Struktural', 'url' => 'https://ppid.pktj.ac.id/profil/profil-pejabat'],
            ['nama' => 'Portal LHKPN KPK', 'url' => 'https://elhkpn.kpk.go.id']
        ]
    ],
    [
        'no' => 3,
        'judul' => 'Rencana Kerja Tahunan (RKT) PKTJ Tegal Tahun 2026',
        'deskripsi' => 'Penjabaran dari sasaran strategis dan program kerja tridharma perguruan tinggi vokasi keselamatan transportasi jalan yang telah ditetapkan dalam Renstra PKTJ dan akan dilaksanakan pada tahun anggaran 2026.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Dokumen RKT PKTJ 2026', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link']
        ]
    ],
    [
        'no' => 4,
        'judul' => 'Perjanjian Kinerja (PK) PKTJ Tegal Tahun 2026',
        'deskripsi' => 'Perjanjian Kinerja tahunan antara Direktur Politeknik Keselamatan Transportasi Jalan dengan Kepala Badan Pengembangan SDM Perhubungan sebagai penjabaran Renstra.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Dokumen Perjanjian Kinerja (PK) 2026', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link']
        ]
    ],
    [
        'no' => 5,
        'judul' => 'RKA-KL PKTJ Tegal Tahun Anggaran 2026',
        'deskripsi' => 'Ringkasan Rencana Kerja Anggaran Kementerian/Lembaga (RKA-KL) Satker PKTJ Tegal yang berisi alokasi program kerja, operasional pendidikan vokasi, dan pagu belanja tahun anggaran 2026.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Dokumen RKA-KL PKTJ 2026', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link']
        ]
    ],
    [
        'no' => 6,
        'judul' => 'DIPA Induk dan Petikan PKTJ Tegal Tahun 2026',
        'deskripsi' => 'Berisi informasi tentang program dan kegiatan beserta anggaran resmi Satker Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal di Lingkungan BPSDM Perhubungan Tahun Anggaran 2026.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/1hLQ-26Oko2u1uve8jD9NMbNknRnyLD_W/view',
        'tautan' => [
            ['nama' => 'DIPA PKTJ 2026 (Google Drive)', 'url' => 'https://drive.google.com/file/d/1hLQ-26Oko2u1uve8jD9NMbNknRnyLD_W/view']
        ]
    ],
    [
        'no' => 7,
        'judul' => 'Laporan Kinerja (LAKIP / LKjIP) PKTJ Tegal Tahun 2025',
        'deskripsi' => 'Berisi informasi Pelaporan Kinerja dan Reviu atas Laporan Kinerja Instansi Pemerintah sebagai pertanggungjawaban atas pelaksanaan semua program kerja yang telah dilaksanakan Satker PKTJ Tegal dalam rangka mewujudkan penyelenggaraan negara yang bebas dari KKN dan tercapainya Good Governance.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Dokumen LAKIP PKTJ 2025', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link']
        ]
    ],
    [
        'no' => 8,
        'judul' => 'Laporan Tahunan PKTJ Tegal Tahun 2025',
        'deskripsi' => 'Informasi pertanggungjawaban atas pelaksanaan kegiatan tridharma perguruan tinggi, pembinaan ketarunaan, dan manajerial yang telah dilaksanakan PKTJ Tegal selama Tahun Anggaran 2025.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Dokumen Laporan Tahunan 2025', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link']
        ]
    ],
    [
        'no' => 9,
        'judul' => 'Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) Pejabat PKTJ Tegal',
        'deskripsi' => 'Informasi mengenai Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) pejabat PKTJ Tegal yang telah diverifikasi dan diumumkan oleh Komisi Pemberantasan Korupsi (KPK RI).',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://elhkpn.kpk.go.id',
        'tautan' => [
            ['nama' => 'Pengumuman e-LHKPN KPK', 'url' => 'https://elhkpn.kpk.go.id'],
            ['nama' => 'Halaman Profil Pejabat & LHKPN', 'url' => 'https://ppid.pktj.ac.id/profil/profil-pejabat']
        ]
    ],
    [
        'no' => 10,
        'judul' => 'Informasi Pendidikan dan Pelatihan (Diklat) yang Diselenggarakan PKTJ',
        'deskripsi' => 'Informasi terkait program beasiswa, kriteria umum program diklat teknis transportasi jalan, waktu pelaksanaan, lama diklat, persyaratan pendaftaran diklat, dan rincian biaya diklat di PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Unit Pelaksana Teknis PKTJ Tegal',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => 'Selama masih berlaku',
        'file' => 'https://pktj.ac.id',
        'tautan' => [
            ['nama' => 'Portal Informasi Diklat PKTJ', 'url' => 'https://pktj.ac.id']
        ]
    ],
    [
        'no' => 11,
        'judul' => 'Informasi Sipencatar PKTJ Tegal',
        'deskripsi' => 'Informasi terkait kriteria umum pendaftar calon taruna/taruni, lokasi tes, jadwal seleksi penerimaan, pilihan program studi vokasi, biaya seleksi, dan persyaratan ijazah jalur Polbit maupun Mandiri.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Administrasi Akademik dan Ketarunaan',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://pktj.ac.id/pages/informasi-sipencatar',
        'tautan' => [
            ['nama' => 'Portal Resmi Sipencatar PKTJ', 'url' => 'https://pktj.ac.id/pages/informasi-sipencatar']
        ]
    ],
    [
        'no' => 12,
        'judul' => 'Kalender Akademik PKTJ Tegal',
        'deskripsi' => 'Kalender kegiatan akademik, jadwal perkuliahan, praktikum, ujian semester, masa basis, dan wisuda perwira transportasi jalan dalam satu tahun ajaran.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Administrasi Akademik dan Ketarunaan',
        'bentuk' => 'Softcopy dan hardcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://pktj.ac.id',
        'tautan' => [
            ['nama' => 'Kalender Akademik PKTJ', 'url' => 'https://pktj.ac.id']
        ]
    ],
    [
        'no' => 13,
        'judul' => 'Statistik Data Pendidikan dan Kepegawaian PKTJ Tegal Tahun 2025',
        'deskripsi' => 'Berisi informasi Data Peserta dan Lulusan Pendidikan Vokasi Transportasi Jalan, Data Tenaga Pendidik (Dosen & Instruktur), Pegawai, serta Data Kapasitas Prasarana Laboratorium Uji PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum & BAAK',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/informasi-publik/statistik-pegawai',
        'tautan' => [
            ['nama' => 'Halaman Statistik Pegawai & Taruna', 'url' => 'https://ppid.pktj.ac.id/informasi-publik/statistik-pegawai']
        ]
    ],
    [
        'no' => 14,
        'judul' => 'Rencana Strategis (Renstra) PKTJ Tegal',
        'deskripsi' => 'Dokumen Rencana Strategis (Renstra) lima tahunan PKTJ Tegal yang memuat arah kebijakan, target mutu pendidikan vokasi, dan sasaran pembangunan sarana prasarana kampus.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '5 Tahun',
        'file' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Dokumen Renstra PKTJ', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link']
        ]
    ],
    [
        'no' => 15,
        'judul' => 'Peraturan Menteri tentang Ortaker PKTJ Tegal (PM 15/2012 & PM 61/2021)',
        'deskripsi' => 'Susunan Organisasi dan Tata Kerja (Ortaker) Unit Kerja Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal yang telah disahkan melalui Peraturan Menteri Perhubungan.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://jdih.dephub.go.id',
        'tautan' => [
            ['nama' => 'JDIH Kemenhub Ortaker', 'url' => 'https://jdih.dephub.go.id']
        ]
    ],
    [
        'no' => 16,
        'judul' => 'Laporan Keuangan PKTJ Tegal Tahun 2025 (Audited BPK-RI)',
        'deskripsi' => 'Berisi Laporan Realisasi Anggaran (LRA), Neraca, Laporan Operasional, Laporan Perubahan Ekuitas, dan Catatan atas Laporan Keuangan (CaLK) PKTJ Tegal yang telah diaudit oleh BPK-RI.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Dokumen Laporan Keuangan (Audited)', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link']
        ]
    ],
    [
        'no' => 17,
        'judul' => 'Struktur PPID PKTJ Tegal',
        'deskripsi' => 'Bagan Struktur Organisasi Tim PPID Pelaksana UPT Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal beserta Keputusan Penetapan Pembentukannya.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/profil/struktur-organisasi',
        'tautan' => [
            ['nama' => 'Halaman Struktur PPID PKTJ', 'url' => 'https://ppid.pktj.ac.id/profil/struktur-organisasi']
        ]
    ],
    [
        'no' => 18,
        'judul' => 'Daftar Informasi Publik (DIP) PKTJ Tegal Tahun 2026',
        'deskripsi' => 'Daftar Informasi Publik (DIP) resmi Unit Pelaksana Teknis PKTJ Tegal Tahun 2026 berdasarkan Keputusan Penetapan Sekretaris Jenderal Kemenhub.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Softcopy dan hardcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/14OP9rXn0Ff9-WWbuNhB49QYoSK7bm503/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Keputusan SK DIP 2026 (Drive)', 'url' => 'https://drive.google.com/file/d/14OP9rXn0Ff9-WWbuNhB49QYoSK7bm503/view?usp=drive_link']
        ]
    ],
    [
        'no' => 19,
        'judul' => 'Tata Cara Permohonan Informasi Publik PPID PKTJ',
        'deskripsi' => 'Mekanisme Permohonan Informasi dan Pengajuan Formulir Layanan Informasi Publik di lingkungan PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/prosedur/permintaan-informasi',
        'tautan' => [
            ['nama' => 'SOP Permohonan Informasi', 'url' => 'https://ppid.pktj.ac.id/prosedur/permintaan-informasi']
        ]
    ],
    [
        'no' => 20,
        'judul' => 'Tata Cara Penyelesaian Sengketa Informasi Publik PPID PKTJ',
        'deskripsi' => 'Mekanisme dan tahapan penyelesaian sengketa informasi publik melalui mediasi dan ajudikasi non-litigasi di Komisi Informasi.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Softcopy dan hardcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/prosedur/sengketa-informasi',
        'tautan' => [
            ['nama' => 'SOP Sengketa Informasi', 'url' => 'https://ppid.pktj.ac.id/prosedur/sengketa-informasi']
        ]
    ],
    [
        'no' => 21,
        'judul' => 'Tata Cara Mengajukan Keberatan Informasi Publik PPID PKTJ',
        'deskripsi' => 'Mekanisme dan prosedur mengajukan keberatan layanan informasi publik kepada Atasan PPID PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Softcopy dan hardcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/prosedur/penanganan-keberatan',
        'tautan' => [
            ['nama' => 'SOP Pengajuan Keberatan', 'url' => 'https://ppid.pktj.ac.id/prosedur/penanganan-keberatan']
        ]
    ],
    [
        'no' => 22,
        'judul' => 'Informasi Mengenai Kanal Informasi dan Pengaduan di PKTJ Tegal',
        'deskripsi' => 'Berisi informasi mengenai kanal resmi aspirasi, pengaduan masyarakat, serta saluran siaga PKTJ Tegal melalui SP4N-LAPOR!, Contact Center 151, SIMADU Kemenhub, dan WBS.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Softcopy dan hardcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/profil/kontak',
        'tautan' => [
            ['nama' => 'Halaman Kontak & Aduan Terpadu', 'url' => 'https://ppid.pktj.ac.id/profil/kontak']
        ]
    ],
    [
        'no' => 23,
        'judul' => 'Laporan Tahunan Layanan Informasi Publik (Laporan PPID) PKTJ',
        'deskripsi' => 'Rekapitulasi permohonan informasi publik, tujuan informasi, jumlah pemohon, status penerimaan permohonan, dan waktu respon layanan PPID PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Softcopy dan hardcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/layanan-informasi/laporan',
        'tautan' => [
            ['nama' => 'Halaman Laporan Layanan PPID', 'url' => 'https://ppid.pktj.ac.id/layanan-informasi/laporan']
        ]
    ],
    [
        'no' => 24,
        'judul' => 'Jurnal Ilmiah Keselamatan Transportasi Jalan PKTJ Tegal',
        'deskripsi' => 'Daftar jurnal ilmiah terakreditasi dan publikasi penelitian berkala bidang keselamatan jalan, otomotif, dan rekayasa sistem transportasi jalan karya civitas akademika PKTJ.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Unit Penelitian dan Pengabdian kepada Masyarakat (UPPM)',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://jurnal.pktj.ac.id/',
        'tautan' => [
            ['nama' => 'Portal Jurnal Ilmiah PKTJ', 'url' => 'https://jurnal.pktj.ac.id/']
        ]
    ],
    [
        'no' => 25,
        'judul' => 'Informasi Pengadaan Barang dan Jasa di Lingkungan PKTJ Tegal',
        'deskripsi' => 'Berisi informasi tentang pengadaan barang dan jasa sesuai Peraturan Komisi Informasi Nomor 1 Tahun 2021 pasal 14 yang berisikan Tahap Perencanaan (dokumen RUP), Tahap Pemilihan, dan Tahap Pelaksanaan kontrak di PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum / Pokja PBJ',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://sirup.lkpp.go.id/',
        'tautan' => [
            ['nama' => 'Portal SiRUP LKPP', 'url' => 'https://sirup.lkpp.go.id/']
        ]
    ]
];

        $setiapData = [
    [
        'no' => 1,
        'judul' => 'Dokumentasi Kegiatan Pimpinan PKTJ Tegal',
        'deskripsi' => 'Foto dan berita dokumentasi kegiatan resmi Direktur dan pimpinan unit kerja di lingkungan PKTJ Tegal dalam pelaksanaan tugas kedinasan dan keprotokolan.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum / Humas',
        'bentuk' => 'Hardcopy dan Softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://pktj.ac.id/berita',
        'tautan' => [
            ['nama' => 'Warta Kegiatan Pimpinan PKTJ', 'url' => 'https://pktj.ac.id/berita']
        ]
    ],
    [
        'no' => 2,
        'judul' => 'Peraturan, Keputusan, dan Kebijakan Direktur PKTJ Tegal',
        'deskripsi' => 'Informasi mengenai peraturan, keputusan, instruksi, dan surat edaran Direktur PKTJ Tegal yang berlaku secara operasional di lingkungan kampus.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan Softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/1UqUH_JDSE84qvKkT-KrdFjCb53XJTX0i/view',
        'tautan' => [
            ['nama' => 'SK Direktur PKTJ (Drive)', 'url' => 'https://drive.google.com/file/d/1UqUH_JDSE84qvKkT-KrdFjCb53XJTX0i/view'],
            ['nama' => 'Portal JDIH BPSDMP', 'url' => 'https://bpsdm.kemenhub.go.id/jdih/']
        ]
    ],
    [
        'no' => 3,
        'judul' => 'Laporan Data Barang Milik Negara (BMN) PKTJ Tegal',
        'deskripsi' => 'Berisi informasi mengenai mutasi tambah kurang, penyusutan, penetapan status penggunaan, dan penghapusan Barang Milik Negara unit kerja PKTJ Tegal yang telah diaudit oleh BPK-RI.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan Softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Laporan BMN PKTJ Tegal', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link']
        ]
    ],
    [
        'no' => 4,
        'judul' => 'Informasi Pengelolaan Arsip Unit Kerja PKTJ Tegal',
        'deskripsi' => 'Informasi mengenai penataan dokumen yang tersimpan menurut bagian di dalam ruang arsip yang tersedia, jadwal retensi arsip, dan pedoman kearsipan PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan Softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://pktj.ac.id',
        'tautan' => [
            ['nama' => 'Pedoman Kearsipan PKTJ', 'url' => 'https://pktj.ac.id']
        ]
    ],
    [
        'no' => 5,
        'judul' => 'Kurikulum dan Silabus Program Studi PKTJ Tegal',
        'deskripsi' => 'Berisi Keputusan penetapan kurikulum dan silabus pendidikan vokasi Diploma dan Sarjana Terapan (D-IV RSTJ, D-IV TRO, D-III TO) di PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Administrasi Akademik dan Ketarunaan',
        'bentuk' => 'Hardcopy dan Softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://pktj.ac.id/program-studi',
        'tautan' => [
            ['nama' => 'Kurikulum Program Studi PKTJ', 'url' => 'https://pktj.ac.id/program-studi']
        ]
    ],
    [
        'no' => 6,
        'judul' => 'Standar Operational Prosedur (SOP) Layanan PKTJ Tegal',
        'deskripsi' => 'Berisi tentang informasi berupa SOP-SOP penyelenggaraan tridharma perguruan tinggi, pembinaan ketarunaan, dan administrasi umum PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum & BAAK',
        'bentuk' => 'Softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://pktj.ac.id',
        'tautan' => [
            ['nama' => 'Daftar SOP PKTJ Tegal', 'url' => 'https://pktj.ac.id']
        ]
    ],
    [
        'no' => 7,
        'judul' => 'Dokumen Terkait Bantuan Tugas Belajar Pegawai PKTJ Tegal',
        'deskripsi' => 'Berisi informasi tentang pelaksanaan kegiatan dan seleksi bantuan tugas belajar maupun izin belajar bagi dosen dan staf di PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Softcopy dan hardcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://bpsdm.kemenhub.go.id',
        'tautan' => [
            ['nama' => 'Pedoman Tugas Belajar BPSDMP', 'url' => 'https://bpsdm.kemenhub.go.id']
        ]
    ],
    [
        'no' => 8,
        'judul' => 'Dokumen Assessment Pegawai di PKTJ Tegal',
        'deskripsi' => 'Informasi mengenai pelaksanaan kegiatan assessment, uji potensi, dan pemetaan kompetensi pegawai di lingkungan PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan Softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://bpsdm.kemenhub.go.id',
        'tautan' => [
            ['nama' => 'Assessment Center BPSDMP', 'url' => 'https://bpsdm.kemenhub.go.id']
        ]
    ],
    [
        'no' => 9,
        'judul' => 'Dokumen Terkait Ujian Dinas Pegawai PKTJ Tegal',
        'deskripsi' => 'Berisi informasi tentang pelaksanaan kegiatan Ujian Dinas dan Ujian Penyesuaian Kenaikan Pangkat (UPKP) bagi pegawai PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Softcopy dan hardcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://bpsdm.kemenhub.go.id',
        'tautan' => [
            ['nama' => 'Panduan Ujian Dinas BPSDMP', 'url' => 'https://bpsdm.kemenhub.go.id']
        ]
    ],
    [
        'no' => 10,
        'judul' => 'Laporan Sistem Pengendalian Intern Pemerintah (SPIP) PKTJ Tegal',
        'deskripsi' => 'Berisi gambaran efektivitas, struktur, kebijakan, dan prosedur organisasi dalam mengendalikan risiko kecurangan dan operasional di PKTJ Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum / SPI',
        'bentuk' => 'Softcopy dan hardcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
        'tautan' => [
            ['nama' => 'Laporan SPIP PKTJ Tegal', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link']
        ]
    ]
];

        $sertaData = [
    [
        'no' => 1,
        'judul' => 'Perubahan Jadwal Layanan Publik di Lingkungan PKTJ Tegal',
        'deskripsi' => 'Informasi mengenai perubahan jadwal layanan serta sarana dan prasarana publik di lingkungan PKTJ Tegal karena faktor internal dan eksternal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://ppid.pktj.ac.id/profil/kontak',
        'tautan' => [
            ['nama' => 'Pengumuman Layanan Meja PPID', 'url' => 'https://ppid.pktj.ac.id/profil/kontak']
        ]
    ],
    [
        'no' => 2,
        'judul' => 'Pengumuman Gangguan Publik Karena Aktivitas Taruna PKTJ Tegal',
        'deskripsi' => 'Informasi dan pengumuman kepada masyarakat mengenai aktivitas luar kampus taruna/taruni PKTJ Tegal (seperti latihan baris-berbaris jalan raya, konvoi pengawalan, apel akbar) yang berpotensi memengaruhi kelancaran lalu lintas sekitar Kota Tegal.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Administrasi Akademik dan Ketarunaan',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://pktj.ac.id',
        'tautan' => [
            ['nama' => 'Warta Ketarunaan PKTJ', 'url' => 'https://pktj.ac.id']
        ]
    ],
    [
        'no' => 3,
        'judul' => 'Perubahan Alur Masuk Kendaraan Kampus PKTJ (Kampus 1 & 2 Tegal)',
        'deskripsi' => 'Perubahan alur masuk kendaraan di Gerbang Kampus 1 (Jl. Perintis Kemerdekaan) dan Gerbang Kampus 2 (Jl. KH. Abdul Syukur Margadana). Ketentuan perubahan pengaturan dan penataan alur keluar masuk kendaraan roda empat dan roda dua.',
        'pejabat' => 'PPID Pelaksana UPT PKTJ Tegal',
        'penerbit' => 'Bagian Keuangan dan Umum',
        'bentuk' => 'Hardcopy dan softcopy',
        'tempat' => 'Tegal',
        'waktu' => '2026',
        'jangka' => '1 Tahun',
        'file' => 'https://pktj.ac.id/tentang#',
        'tautan' => [
            ['nama' => 'Denah & Alur Gerbang Kampus PKTJ', 'url' => 'https://pktj.ac.id/tentang#']
        ]
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
                'aktif' => true,
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
                'aktif' => true,
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
                'aktif' => true,
                'bisa_download' => true,
                'tanggal' => date('Y-m-d')
            ]);
        }

        // 5. SINKRONISASI DAFTAR INFORMASI (MASTER DIP: 38 Items)
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
                'aktif' => true,
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
                'aktif' => true,
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
                'aktif' => true,
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

        // 7. AKTIFKAN MENU DIKECUALIKAN & DASHBOARD SETTING
        CustomMenu::where('id', 12)->orWhere('slug', 'informasi-dikecualikan-sub')->update(['aktif' => 1]);
        Dashboard::updateOrCreate(['key' => 'menu_dikecualikan_aktif'], ['value' => '1', 'type' => 'boolean']);

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
        $pProfil = array (
  'id' => 2,
  'type' => 'profil',
  'judul' => 'Profil PPID PKTJ Tegal',
  'tagline_hero' => 'Mewujudkan Keterbukaan Informasi Menuju Tata Kelola Pendidikan Vokasi yang Transparan dan Berkelanjutan',
  'image_hero' => NULL,
  'konten_pembuka' => '<div class="mb-4">
    <p class="lead fw-semibold text-dark" style="font-size: 1.15rem; line-height: 1.8;">
        Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana Unit Pelaksana Teknis (UPT) Politeknik Keselamatan Transportasi Jalan (PKTJ) dibentuk sebagai garda terdepan keterbukaan informasi publik di lingkungan pendidikan tinggi vokasi Kementerian Perhubungan.
    </p>
    <p>
        Keberadaan PPID Pelaksana PKTJ berakar kuat dari sejarah panjang pengabdian institusi yang didirikan pada tanggal <strong>14 Mei 1971</strong> dengan nama awal <em>Balai Pendidikan dan Latihan Transportasi Jalan Raya (Balai Diklat Trans Jaya) Tegal</em>. Melalui perjalanan transformasi berkelanjutan, institusi ini berkembang menjadi Pusat Pendidikan dan Latihan Perhubungan Darat (Pusdiklat Perhubdat), kemudian bertransformasi menjadi Balai Pendidikan dan Pelatihan Transportasi Darat (BPPTD) Tegal berdasarkan Keputusan Menteri Perhubungan Nomor KM 73 Tahun 2002.
    </p>
    <p>
        Puncaknya, pada tahun 2012 melalui Peraturan Menteri Perhubungan Republik Indonesia Nomor <strong>PM 15 Tahun 2012</strong>, institusi ini resmi ditingkatkan status kelembagaannya menjadi <strong>Politeknik Keselamatan Transportasi Jalan (PKTJ)</strong>, sebuah perguruan tinggi kedinasan vokasi pertama dan terdepan di Indonesia yang berfokus penuh pada keselamatan transportasi jalan.
    </p>
    <p>
        Saat ini, PKTJ beroperasi dengan 2 (dua) kampus utama di Kota Tegal, yaitu:
    </p>
    <ul>
        <li><strong>Kampus 1 (Kampus Perintis)</strong>: Berlokasi di Jl. Perintis Kemerdekaan No. 17, Kelurahan Slerok, Kecamatan Tegal Timur, Kota Tegal.</li>
        <li><strong>Kampus 2 (Kampus Margadana)</strong>: Berlokasi di Jl. KH. Abdul Syukur No. 17, Margadana, Kota Tegal — yang juga menjadi lokasi utama <em>Desk Meja Layanan Terpadu PPID PKTJ</em>.</li>
    </ul>
</div>',
  'judul_sub' => 'Mandat Kelembagaan & Transformasi Pendidikan Vokasi Keselamatan Jalan',
  'konten_detail' => '<div class="mb-4">
    <p>
        Sebagai Unit Pelaksana Teknis (UPT) di bawah naungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan, PKTJ memiliki mandat mulia mencetak perwira transportasi jalan yang profesional, berkarakter, dan berdaya saing global melalui 3 (tiga) program studi unggulan:
    </p>
    <ol>
        <li><strong>Sarjana Terapan (D-IV) Rekayasa Sistem Transportasi Jalan (RSTJ)</strong></li>
        <li><strong>Sarjana Terapan (D-IV) Teknologi Rekayasa Otomotif (TRO)</strong></li>
        <li><strong>Diploma III (D-III) Teknologi Otomotif (TO)</strong></li>
    </ol>
    <p>
        Dalam mendukung terwujudnya tata kelola pendidikan kedinasan yang bersih, transparan, dan bebas dari korupsi (Good Governance & Clean Government), PPID Pelaksana UPT PKTJ Tegal berkomitmen penuh memberikan pelayanan informasi yang cepat, akurat, tidak memungut biaya apapun (Rp 0), serta menjamin hak setiap pemohon informasi publik sesuai amanat Undang-Undang Nomor 14 Tahun 2008 dan Peraturan Menhub Nomor PM 46 Tahun 2018.
    </p>
</div>',
  'gambaran' => '<div class="alert alert-primary d-flex align-items-center rounded-4 border-0 p-3.5 mb-0" style="background: #eef2ff; color: #002b5c;"><i class="fas fa-shield-halved fa-2x me-3 text-primary"></i><div><strong>Standar Pelayanan PPID PKTJ:</strong> Berkomitmen memberikan pelayanan informasi publik yang cepat, tepat waktu, biaya ringan (Rp 0), serta mudah dijangkau oleh seluruh lapisan masyarakat termasuk penyandang disabilitas.</div></div>',
  'is_blurred' => 0,
  'gambar' => NULL,
  'link_dokumen' => NULL,
  'additional_sections' => 
  array (
  ),
  'created_at' => '2026-03-09T10:45:23.000000Z',
  'updated_at' => '2026-09-11T06:21:08.000000Z',
);
        unset($pProfil['id'], $pProfil['created_at'], $pProfil['updated_at']);
        ProfilPpid::updateOrCreate(['type' => 'profil'], $pProfil);

        $pVisi = array (
  'id' => 15,
  'type' => 'visi',
  'judul' => 'Visi & Misi PPID PKTJ Tegal',
  'tagline_hero' => 'Landasan Komitmen Keterbukaan Informasi Publik yang Transparan, Objektif, dan Prima',
  'image_hero' => NULL,
  'konten_pembuka' => '<div class="vision-banner p-4 p-md-5 rounded-4 text-center mb-5" style="background: linear-gradient(135deg, #002b5c 0%, #004a99 100%); color: white; border: 2px solid rgba(255, 193, 7, 0.3);">
    <div class="badge bg-warning text-dark px-3.5 py-2 rounded-pill fw-bold text-uppercase mb-3" style="font-size: 12px; letter-spacing: 1px;">
        <i class="fas fa-compass me-1.5"></i> Visi PPID PKTJ Tegal
    </div>
    <h3 class="outfit fw-black text-white mb-3" style="font-size: 1.85rem; line-height: 1.4;">
        "Terwujudnya Pelayanan Informasi Publik Politeknik Keselamatan Transportasi Jalan yang Transparan, Objektif, dan Prima Guna Mendukung Tata Kelola Pendidikan Tinggi Vokasi yang Berintegritas dan Berkelanjutan"
    </h3>
    <p class="text-white text-opacity-85 mb-0 mx-auto" style="max-width: 850px; font-size: 14.5px;">
        Berlandaskan semangat keterbukaan informasi dan pelayanan prima di bawah naungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan Republik Indonesia.
    </p>
</div>

<div class="misi-section mb-5">
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #e0e7ff; color: #002b5c; font-size: 20px;">
            <i class="fas fa-bullseye"></i>
        </div>
        <div>
            <h4 class="outfit fw-bold text-dark mb-0" style="font-size: 1.45rem;">Misi Pelayanan Informasi Publik</h4>
            <span class="text-muted small">Empat pilar pelaksanaan mandat keterbukaan informasi di lingkungan PKTJ Tegal</span>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">1</span>
                <div>
                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Pelayanan Cepat, Tepat Waktu & Bebas Biaya (Rp 0)</strong>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Menyelenggarakan pelayanan informasi publik yang profesional, cepat, proporsional, dan tanpa pungutan biaya sesuai standar perundang-undangan KIP.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">2</span>
                <div>
                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Modernisasi Sistem Digital & Aksesibilitas Disabilitas</strong>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Membangun dan mengembangkan infrastruktur portal informasi publik mandiri yang mudah diakses 24/7 serta dilengkapi fasilitas inklusif bagi penyandang disabilitas.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">3</span>
                <div>
                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Peningkatan Kompetensi & Integritas Pengelola</strong>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Meningkatkan kualitas sumber daya manusia pengelola PPID PKTJ melalui bimbingan teknis, pelatihan kearsipan, dan penguatan integritas anti-korupsi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3.5 rounded-4 border bg-white shadow-sm h-100 d-flex gap-3">
                <span class="badge bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; font-size: 14px; font-weight: 800;">4</span>
                <div>
                    <strong class="d-block text-dark mb-1" style="font-size: 14px;">Sinergi Tata Kelola Kemenhub Terintegrasi</strong>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">Memperkuat koordinasi dan harmonisasi pengelolaan data satu pintu antara PPID UPT PKTJ Tegal, PPID BPSDM Perhubungan, dan PPID Utama Kementerian Perhubungan.</p>
                </div>
            </div>
        </div>
    </div>
</div>',
  'judul_sub' => 'Prinsip Penyelenggaraan Layanan Informasi Publik',
  'konten_detail' => '<div class="principles-section mt-5 pt-4 border-top">
    <div class="text-center mb-4">
        <span class="badge bg-light text-primary border px-3 py-1.5 rounded-pill fw-bold text-uppercase" style="font-size: 11.5px; letter-spacing: 1px;">
            <i class="fas fa-gem text-warning me-1"></i> Nilai-Nilai Dasar Pelayanan
        </span>
        <h3 class="outfit fw-black text-dark mt-2 mb-1" style="font-size: 1.75rem;">Prinsip Utama: Transparan, Objektif, dan Prima</h3>
        <p class="text-muted small mx-auto mb-0" style="max-width: 700px;">Komitmen penyelenggaraan keterbukaan informasi publik di Politeknik Keselamatan Transportasi Jalan Tegal</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); border-top: 5px solid #0284c7 !important;">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: rgba(2, 132, 199, 0.12); color: #0284c7; font-size: 26px;">
                    <i class="fas fa-door-open"></i>
                </div>
                <h4 class="outfit fw-bold text-dark mb-2" style="font-size: 1.3rem;">TRANSPARAN</h4>
                <div class="badge bg-info bg-opacity-25 text-info px-3 py-1 rounded-pill fw-bold mb-3" style="font-size: 11px;">Keterbukaan Berintegritas</div>
                <p class="text-secondary small mb-0 text-start" style="line-height: 1.7;">
                    Memberikan akses terbuka, mudah, dan seluas-luasnya kepada masyarakat dan pemohon informasi publik mengenai penyelenggaraan pendidikan vokasi, realisasi anggaran DIPA, pengadaan barang dan jasa, serta akuntabilitas kinerja PKTJ Tegal tanpa birokrasi yang berbelit.
                </p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); border-top: 5px solid #16a34a !important;">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: rgba(22, 163, 74, 0.12); color: #16a34a; font-size: 26px;">
                    <i class="fas fa-scale-balanced"></i>
                </div>
                <h4 class="outfit fw-bold text-dark mb-2" style="font-size: 1.3rem;">OBJEKTIF</h4>
                <div class="badge bg-success bg-opacity-25 text-success px-3 py-1 rounded-pill fw-bold mb-3" style="font-size: 11px;">Akurat & Bebas Bias</div>
                <p class="text-secondary small mb-0 text-start" style="line-height: 1.7;">
                    Menyajikan informasi dan dokumentasi publik berbasis data faktual yang valid, teruji kebenarannya, bebas dari manipulasi, serta tidak memihak demi menjaga netralitas aparatur dan mengutamakan kepentingan keselamatan transportasi jalan nasional.
                </p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); border-top: 5px solid #d97706 !important;">
                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: rgba(217, 119, 6, 0.12); color: #d97706; font-size: 26px;">
                    <i class="fas fa-award"></i>
                </div>
                <h4 class="outfit fw-bold text-dark mb-2" style="font-size: 1.3rem;">PRIMA</h4>
                <div class="badge bg-warning bg-opacity-25 text-amber-700 px-3 py-1 rounded-pill fw-bold mb-3" style="font-size: 11px;">Responsif & Inklusif</div>
                <p class="text-secondary small mb-0 text-start" style="line-height: 1.7;">
                    Mengedepankan keramahan layanan (Hospitality), pemenuhan respon cepat maksimal 10 hari kerja (+7 hari perpanjangan), pemanfaatan portal teknologi digital mandiri, serta penyediaan fasilitas fisik yang ramah disabilitas (Text-to-Speech, Bisindo, Braille).
                </p>
            </div>
        </div>
    </div>
</div>',
  'gambaran' => NULL,
  'is_blurred' => 0,
  'gambar' => NULL,
  'link_dokumen' => NULL,
  'additional_sections' => 
  array (
  ),
  'created_at' => '2026-03-26T03:27:57.000000Z',
  'updated_at' => '2026-09-11T06:21:08.000000Z',
);
        unset($pVisi['id'], $pVisi['created_at'], $pVisi['updated_at']);
        ProfilPpid::updateOrCreate(['type' => 'visi'], $pVisi);

        // 10. PASTIKAN URUTAN SUBMENU INFORMASI PUBLIK: BERKALA (1), SETIAP SAAT (2), SERTA MERTA (3), DIKECUALIKAN (4)
        CustomMenu::where('slug', 'informasi-berkala-sub')->orWhere('url', 'like', '%/informasi-publik/berkala%')->update(['urutan' => 1]);
        CustomMenu::where('slug', 'informasi-setiap-saat-sub')->orWhere('url', 'like', '%/informasi-publik/setiap-saat%')->update(['urutan' => 2]);
        CustomMenu::where('slug', 'informasi-serta-merta-sub')->orWhere('url', 'like', '%/informasi-publik/serta-merta%')->update(['urutan' => 3]);
        CustomMenu::where('slug', 'informasi-dikecualikan-sub')->orWhere('url', 'like', '%/informasi-publik/dikecualikan%')->update(['urutan' => 4]);
    }
}