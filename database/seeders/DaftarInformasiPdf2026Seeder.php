<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\InformasiBerkala;
use App\Models\InformasiSertaMerta;
use App\Models\InformasiSetiapSaat;
use App\Models\DaftarInformasi;
use App\Models\InformasiDikecualikan;

class DaftarInformasiPdf2026Seeder extends Seeder
{
    /**
     * Seeder DIP & DIK 2026 berdasarkan SK Sekjen Kemenhub No. KP-SKJ 9 Tahun 2026 & KP-SKJ 8 Tahun 2026
     * Diparafrase dan disesuaikan 100% secara spesifik untuk Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.
     * 
     * PERINGATAN KERAS:
     * - Tabel DOKUMENS (Laporan Layanan) dan PEJABATS TIDAK DISENTUH SAMA SEKALI!
     */
    public function run(): void
    {
        InformasiBerkala::truncate();
        InformasiSertaMerta::truncate();
        InformasiSetiapSaat::truncate();
        DaftarInformasi::truncate();
        InformasiDikecualikan::truncate();

        // =========================================================================
        // 1. INFORMASI BERKALA (25 Items)
        // =========================================================================
        $berkalaList = [
            // 1. Profil Unit
            [
                'judul' => 'Profil Unit Kerja Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal',
                'deskripsi' => 'Informasi komprehensif mengenai kedudukan kelembagaan, sejarah transformasi sejak 1971, tugas dan fungsi pendidikan vokasi keselamatan transportasi darat, struktur pimpinan, alamat Kampus 1 & 2 di Tegal, kontak resmi, serta fasilitas sarana dan prasarana laboratorium pengujian.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Website, Hardcopy, dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://ppid.pktj.ac.id/profil/profil-ppid',
                'file_name' => 'Profil PKTJ Tegal',
                'tipe_informasi' => 'PROFIL',
                'tautan_links' => [
                    ['nama' => 'Profil Lengkap PPID PKTJ', 'url' => 'https://ppid.pktj.ac.id/profil/profil-ppid'],
                    ['nama' => 'Tentang Kampus PKTJ', 'url' => 'https://pktj.ac.id/tentang#'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 2. Profil Pejabat
            [
                'judul' => 'Profil Pejabat Publik di Lingkungan PKTJ Tegal',
                'deskripsi' => 'Informasi mengenai profil singkat, rekam jejak kepemimpinan, riwayat pendidikan formal, dan penugasan jabatan Direktur, para Wakil Direktur, Kepala Bagian, Kepala Unit, serta Ketua Program Studi di lingkungan PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://ppid.pktj.ac.id/profil/profil-pejabat',
                'file_name' => 'Profil Pejabat PKTJ',
                'tipe_informasi' => 'PROFIL',
                'tautan_links' => [
                    ['nama' => 'Profil Pejabat Struktural PKTJ', 'url' => 'https://ppid.pktj.ac.id/profil/profil-pejabat'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 3. RKT
            [
                'judul' => 'Rencana Kerja Tahunan (RKT) PKTJ Tegal Tahun 2026',
                'deskripsi' => 'Penjabaran terukur dari target sasaran strategis dan program kerja tahunan tridharma perguruan tinggi vokasi yang telah ditetapkan dalam Rencana Strategis (Renstra) PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum (Subbag Perencanaan)',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                'file_name' => 'RKT_PKTJ_2026.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Dokumen RKT PKTJ 2026', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 4. PK
            [
                'judul' => 'Perjanjian Kinerja (PK) PKTJ Tegal Tahun 2026',
                'deskripsi' => 'Dokumen Perjanjian Kinerja tahunan antara Direktur PKTJ Tegal dengan Kepala Badan Pengembangan SDM Perhubungan yang memuat target indikator kinerja utama (IKU) dan alokasi anggaran tahun 2026.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                'file_name' => 'Perjanjian_Kinerja_PKTJ_2026.pdf',
                'tipe_informasi' => 'KINERJA DAN KEUANGAN',
                'tautan_links' => [
                    ['nama' => 'Perjanjian Kinerja PKTJ 2026', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 5. RKA-KL
            [
                'judul' => 'Rencana Kerja dan Anggaran (RKA-KL) PKTJ Tegal Tahun Anggaran 2026',
                'deskripsi' => 'Ringkasan dokumen Rencana Kerja dan Anggaran Kementerian/Lembaga (RKA-KL) Satuan Kerja PKTJ Tegal yang memuat rincian output kegiatan, target capaian vokasi, dan alokasi pagu anggaran belanja.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                'file_name' => 'RKA_KL_PKTJ_TA_2026.pdf',
                'tipe_informasi' => 'KINERJA DAN KEUANGAN',
                'tautan_links' => [
                    ['nama' => 'RKA-KL Satker PKTJ TA 2026', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 6. DIPA Induk
            [
                'judul' => 'DIPA Induk dan Petikan PKTJ Tegal Tahun Anggaran 2026',
                'deskripsi' => 'Informasi resmi alokasi anggaran, program kegiatan vokasi, dan rincian Daftar Isian Pelaksanaan Anggaran (DIPA) Satuan Kerja Politeknik Keselamatan Transportasi Jalan Tahun Anggaran 2026.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/1hLQ-26Oko2u1uve8jD9NMbNknRnyLD_W/view',
                'file_name' => 'DIPA_Induk_BPSDM_dan_PKTJ_2026.pdf',
                'tipe_informasi' => 'KINERJA DAN KEUANGAN',
                'tautan_links' => [
                    ['nama' => 'Salinan Dokumen DIPA 2026', 'url' => 'https://drive.google.com/file/d/1hLQ-26Oko2u1uve8jD9NMbNknRnyLD_W/view'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 7. LAKIP 2025
            [
                'judul' => 'Laporan Kinerja Instansi Pemerintah (LAKIP / LKjIP) PKTJ Tegal Tahun 2025',
                'deskripsi' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah (LKjIP) PKTJ Tegal Tahun 2025 yang merangkum pencapaian Indikator Kinerja Utama (IKU), evaluasi efisiensi anggaran, dan pertanggungjawaban program kerja menuju Good Governance.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                'file_name' => 'LAKIP_LKjIP_PKTJ_Tahun_2025.pdf',
                'tipe_informasi' => 'KINERJA DAN KEUANGAN',
                'tautan_links' => [
                    ['nama' => 'Ringkasan Eksekutif LKjIP 2025', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 8. Laporan Tahunan
            [
                'judul' => 'Laporan Tahunan Pelaksanaan Kegiatan PKTJ Tegal Tahun 2025',
                'deskripsi' => 'Informasi komprehensif pertanggungjawaban atas pelaksanaan seluruh kegiatan tridharma perguruan tinggi, pembangunan karakter taruna, akreditasi prodi, dan operasional kelembagaan PKTJ Tegal sepanjang tahun 2025.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                'file_name' => 'Laporan_Tahunan_PKTJ_2025.pdf',
                'tipe_informasi' => 'KINERJA DAN KEUANGAN',
                'tautan_links' => [
                    ['nama' => 'Laporan Tahunan PKTJ 2025', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link'],
                    ['nama' => 'Layanan Laporan PKTJ', 'url' => 'https://ppid.pktj.ac.id/layanan-informasi/laporan'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 9. LHKPN
            [
                'judul' => 'Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) Pejabat PKTJ Tegal',
                'deskripsi' => 'Rekapitulasi tanda terima kepatuhan dan pengumuman pelaporan e-LHKPN bagi seluruh pejabat wajib lapor di lingkungan PKTJ Tegal yang telah diverifikasi secara resmi oleh Komisi Pemberantasan Korupsi (KPK).',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://elhkpn.kpk.go.id',
                'file_name' => 'LHKPN_Pejabat_PKTJ.pdf',
                'tipe_informasi' => 'PROFIL',
                'tautan_links' => [
                    ['nama' => 'Portal Resmi e-LHKPN KPK', 'url' => 'https://elhkpn.kpk.go.id'],
                    ['nama' => 'Profil & LHKPN Pejabat PKTJ', 'url' => 'https://ppid.pktj.ac.id/profil/profil-pejabat'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 10. Diklat Teknis
            [
                'judul' => 'Informasi Program Pendidikan dan Pelatihan (Diklat) Teknis Transportasi Jalan',
                'deskripsi' => 'Informasi komprehensif mengenai penawaran diklat teknis keselamatan jalan, diklat penguji kendaraan bermotor (PKB), diklat manajemen keselamatan, kriteria umum, waktu pelaksanaan, persyaratan berkas, dan biaya diklat.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Pusat Pengembangan Karakter / Bagian Akademik',
                'penerbit_informasi' => 'Bagian Akademik',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Masih Berlaku',
                'file_path' => 'https://pktj.ac.id',
                'file_name' => 'Informasi_Diklat_PKTJ.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Program Diklat Teknis PKTJ', 'url' => 'https://pktj.ac.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 11. Sipencatar
            [
                'judul' => 'Informasi Seleksi Penerimaan Calon Taruna (SIPENCATAR) PKTJ Tegal',
                'deskripsi' => 'Panduan lengkap penerimaan calon taruna/taruni Kemenhub di PKTJ Tegal meliputi jalur Pola Pembibitan (Polbit) dan Mandiri, persyaratan pendaftaran, jadwal tes CAT, lokasi seleksi, prodi pilihan (RSTJ, TRO, TO), dan tahapan uji kesamaptaan/kesehatan.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Administrasi Akademik dan Ketarunaan (BAAK)',
                'penerbit_informasi' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://pktj.ac.id/pages/informasi-sipencatar',
                'file_name' => 'Brosur_SIPENCATAR_PKTJ_2026.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Portal Informasi SIPENCATAR PKTJ', 'url' => 'https://pktj.ac.id/pages/informasi-sipencatar'],
                    ['nama' => 'Portal SIPENCATAR Kemenhub', 'url' => 'https://sipencatar.dephub.go.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 12. Kalender Akademik
            [
                'judul' => 'Kalender Akademik PKTJ Tegal Tahun Akademik 2025/2026',
                'deskripsi' => 'Jadwal operasional kalender kegiatan akademik perkuliahan, praktikum laboratorium, masa UTS/UAS, magang kerja/PKL, dan jadwal wisuda perwira transportasi jalan dalam satu tahun ajaran.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'penerbit_informasi' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://pktj.ac.id',
                'file_name' => 'Kalender_Akademik_PKTJ_2025_2026.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Kalender Akademik PKTJ', 'url' => 'https://pktj.ac.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 13. Statistik PKTJ 2025
            [
                'judul' => 'Statistik Data Pendidikan dan Kepegawaian PKTJ Tegal Tahun 2025',
                'deskripsi' => 'Data statistik resmi peserta didik taruna aktif, data lulusan alumni vokasi, rekapitulasi jumlah dosen tetap, instruktur bengkel, pranata laboratorium pendidikan, serta kapasitas sarana fasilitas diklat keselamatan jalan PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum / BAAK',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://ppid.pktj.ac.id/informasi-publik/statistik-pegawai',
                'file_name' => 'Statistik_PKTJ_2025.pdf',
                'tipe_informasi' => 'PROFIL',
                'tautan_links' => [
                    ['nama' => 'Statistik Kepegawaian & Taruna', 'url' => 'https://ppid.pktj.ac.id/informasi-publik/statistik-pegawai'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 14. Renstra
            [
                'judul' => 'Rencana Strategis (Renstra) PKTJ Tegal Periode 2025 - 2029',
                'deskripsi' => 'Dokumen perencanaan jangka menengah kelembagaan yang memuat visi, misi, arah kebijakan pembangunan sarana prasarana, penguatan riset keselamatan jalan, dan peta jalan pendidikan vokasi transportasi darat.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '5 Tahun',
                'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                'file_name' => 'Renstra_PKTJ_2025_2029.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Dokumen Renstra PKTJ', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 15. Ortaker PM 15/2012
            [
                'judul' => 'Peraturan Menteri Perhubungan tentang Ortaker PKTJ Tegal (PM 15 Tahun 2012)',
                'deskripsi' => 'Peraturan Menteri Perhubungan Nomor PM 15 Tahun 2012 tentang Organisasi dan Tata Kerja Politeknik Keselamatan Transportasi Jalan yang menjadi landasan hukum pendirian dan penyelenggaraan kelembagaan PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Masih Berlaku',
                'file_path' => 'https://jdih.dephub.go.id',
                'file_name' => 'PM_15_Tahun_2012_Ortaker_PKTJ.pdf',
                'tipe_informasi' => 'PROFIL',
                'tautan_links' => [
                    ['nama' => 'JDIH Kemenhub - PM 15/2012', 'url' => 'https://jdih.dephub.go.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 16. Laporan Keuangan 2025 Audited BPK
            [
                'judul' => 'Laporan Keuangan PKTJ Tegal Tahun 2025 (Audited BPK-RI)',
                'deskripsi' => 'Laporan Realisasi Anggaran (LRA), Neraca Satker, Laporan Operasional (LO), Laporan Perubahan Ekuitas (LPE), dan Catatan atas Laporan Keuangan (CaLK) PKTJ Tegal Tahun 2025 yang telah diaudit oleh Badan Pemeriksa Keuangan (BPK-RI).',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                'file_name' => 'Laporan_Keuangan_PKTJ_2025_Audited.pdf',
                'tipe_informasi' => 'KINERJA DAN KEUANGAN',
                'tautan_links' => [
                    ['nama' => 'Ringkasan LK Audited BPK 2025', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 17. Struktur PPID
            [
                'judul' => 'Struktur Organisasi PPID Pelaksana UPT PKTJ Tegal',
                'deskripsi' => 'Bagan susunan tim pengelola Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana UPT Politeknik Keselamatan Transportasi Jalan beserta Surat Keputusan (SK) penetapan tim pelaksana.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://ppid.pktj.ac.id/profil/struktur-organisasi',
                'file_name' => 'Struktur_PPID_PKTJ.pdf',
                'tipe_informasi' => 'PROFIL',
                'tautan_links' => [
                    ['nama' => 'Struktur Tim PPID PKTJ', 'url' => 'https://ppid.pktj.ac.id/profil/struktur-organisasi'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 18. DIP PKTJ
            [
                'judul' => 'Daftar Informasi Publik (DIP) PKTJ Tegal Tahun 2026',
                'deskripsi' => 'Dokumen penetapan Daftar Informasi Publik (DIP) yang dikuasai dan dikelola oleh PPID Pelaksana UPT Politeknik Keselamatan Transportasi Jalan Tegal Tahun 2026 berdasarkan Keputusan Sekjen Kemenhub No. KP-SKJ 9 Tahun 2026.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Tim PPID PKTJ Tegal',
                'penerbit_informasi' => 'Tim PPID PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/14OP9rXn0Ff9-WWbuNhB49QYoSK7bm503/view?usp=drive_link',
                'file_name' => 'DIP_Kemenhub_dan_PKTJ_2026.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'SK DIP 2026 (KP-SKJ 9)', 'url' => 'https://drive.google.com/file/d/14OP9rXn0Ff9-WWbuNhB49QYoSK7bm503/view?usp=drive_link'],
                    ['nama' => 'Tabel Matriks DIP PKTJ', 'url' => 'https://ppid.pktj.ac.id/layanan-informasi/daftar'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 19. SOP Permohonan
            [
                'judul' => 'Tata Cara Permohonan Informasi Publik PPID PKTJ Tegal',
                'deskripsi' => 'Mekanisme dan prosedur resmi permohonan informasi publik ke meja layanan PPID PKTJ, baik secara tatap muka di Meja Layanan Kampus Margadana maupun melalui formulir permohonan daring.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Tim PPID PKTJ Tegal',
                'penerbit_informasi' => 'Tim PPID PKTJ Tegal',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Masih Berlaku',
                'file_path' => 'https://ppid.pktj.ac.id/prosedur/permintaan-informasi',
                'file_name' => 'SOP_Permohonan_Informasi_PKTJ.pdf',
                'tipe_informasi' => 'TATA CARA / PROSEDUR',
                'tautan_links' => [
                    ['nama' => 'SOP Permohonan Informasi', 'url' => 'https://ppid.pktj.ac.id/prosedur/permintaan-informasi'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 20. SOP Sengketa
            [
                'judul' => 'Tata Cara Penyelesaian Sengketa Informasi Publik PPID PKTJ',
                'deskripsi' => 'Mekanisme dan tata cara penyelesaian sengketa informasi publik melalui ajudikasi atau mediasi non-litigasi di Komisi Informasi Pusat (KIP) apabila pemohon tidak puas atas tanggapan Atasan PPID.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Tim PPID PKTJ Tegal',
                'penerbit_informasi' => 'Tim PPID PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Masih Berlaku',
                'file_path' => 'https://ppid.pktj.ac.id/prosedur/sengketa-informasi',
                'file_name' => 'SOP_Sengketa_Informasi_PKTJ.pdf',
                'tipe_informasi' => 'TATA CARA / PROSEDUR',
                'tautan_links' => [
                    ['nama' => 'SOP Sengketa Informasi', 'url' => 'https://ppid.pktj.ac.id/prosedur/sengketa-informasi'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 21. SOP Keberatan
            [
                'judul' => 'Tata Cara Mengajukan Keberatan Informasi Publik PPID PKTJ',
                'deskripsi' => 'Alur dan tata cara pengajuan surat keberatan administratif kepada Atasan PPID PKTJ Tegal atas penolakan informasi, ketidaksesuaian waktu pelayanan, atau penetapan biaya yang tidak wajar.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Tim PPID PKTJ Tegal',
                'penerbit_informasi' => 'Tim PPID PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Masih Berlaku',
                'file_path' => 'https://ppid.pktj.ac.id/prosedur/penanganan-keberatan',
                'file_name' => 'SOP_Keberatan_Informasi_PKTJ.pdf',
                'tipe_informasi' => 'TATA CARA / PROSEDUR',
                'tautan_links' => [
                    ['nama' => 'SOP Keberatan Informasi', 'url' => 'https://ppid.pktj.ac.id/prosedur/penanganan-keberatan'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 22. Kanal Informasi & Pengaduan
            [
                'judul' => 'Kanal Informasi Publik dan Layanan Pengaduan Masyarakat PKTJ Tegal',
                'deskripsi' => 'Informasi menyeluruh kanal resmi komunikasi PPID PKTJ, Contact Center 151 Kementerian Perhubungan, portal Sistem Informasi Pengaduan Masyarakat (SIMADU), dan Whistleblowing System (WBS).',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Satuan Pengawas Internal (SPI) & Humas',
                'penerbit_informasi' => 'Satuan Pengawas Internal (SPI) & Humas',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://ppid.pktj.ac.id/profil/kontak',
                'file_name' => 'Kanal_Pengaduan_PKTJ.pdf',
                'tipe_informasi' => 'PROFIL',
                'tautan_links' => [
                    ['nama' => 'Halaman Kontak & Kanal Layanan', 'url' => 'https://ppid.pktj.ac.id/profil/kontak'],
                    ['nama' => 'SIMADU Kemenhub', 'url' => 'https://simadu.dephub.go.id'],
                    ['nama' => 'WBS Kemenhub', 'url' => 'https://wbs.dephub.go.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 23. Laporan PPID
            [
                'judul' => 'Laporan Tahunan Layanan Informasi Publik (Laporan PPID) PKTJ',
                'deskripsi' => 'Rekapitulasi tahunan jumlah permohonan informasi publik yang diterima, waktu rata-rata pemenuhan permohonan, status penerimaan informasi, rincian alasan keberatan, dan pengelolaan PPID PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Tim PPID PKTJ Tegal',
                'penerbit_informasi' => 'Tim PPID PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://ppid.pktj.ac.id/layanan-informasi/laporan',
                'file_name' => 'Laporan_Tahunan_PPID_PKTJ.pdf',
                'tipe_informasi' => 'KINERJA DAN KEUANGAN',
                'tautan_links' => [
                    ['nama' => 'Laporan Layanan Informasi Publik', 'url' => 'https://ppid.pktj.ac.id/layanan-informasi/laporan'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 24. Jurnal Ilmiah
            [
                'judul' => 'Publikasi Jurnal Ilmiah Keselamatan Transportasi Jalan PKTJ Tegal',
                'deskripsi' => 'Daftar jurnal riset dan publikasi ilmiah berkala yang diterbitkan oleh Pusat Penelitian dan Pengabdian kepada Masyarakat (P3M) PKTJ Tegal di bidang rekayasa sistem transportasi jalan dan otomotif.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Pusat Penelitian dan Pengabdian Masyarakat (P3M)',
                'penerbit_informasi' => 'Pusat Penelitian dan Pengabdian Masyarakat (P3M)',
                'bentuk_informasi' => 'Hardcopy dan Softcopy (Open Access OJS)',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://jurnal.pktj.ac.id/',
                'file_name' => 'Jurnal_Ilmiah_Transportasi_PKTJ.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Portal E-Jurnal PKTJ', 'url' => 'https://jurnal.pktj.ac.id/'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 25. Pengadaan Barang & Jasa
            [
                'judul' => 'Informasi Pengadaan Barang dan Jasa (SiRUP & LPSE) PKTJ Tegal',
                'deskripsi' => 'Informasi pengadaan barang dan jasa satuan kerja PKTJ Tegal sesuai Peraturan Komisi Informasi Nomor 1 Tahun 2021 Pasal 14, memuat Tahap Perencanaan (RUP SiRUP LKPP), Tahap Pemilihan, dan Tahap Pelaksanaan Kontrak (LPSE Kemenhub).',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum / Pokja Pemilihan',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy (Portal Daring)',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://sirup.lkpp.go.id/',
                'file_name' => 'Pengadaan_Barang_Jasa_PKTJ.pdf',
                'tipe_informasi' => 'PENGADAAN BARANG DAN JASA',
                'tautan_links' => [
                    ['nama' => 'SiRUP LKPP PKTJ Tegal', 'url' => 'https://sirup.lkpp.go.id/'],
                    ['nama' => 'LPSE Kementerian Perhubungan', 'url' => 'https://lpse.dephub.go.id/'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
        ];

        foreach ($berkalaList as $item) {
            InformasiBerkala::create([
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'pejabat_penguasa' => $item['pejabat_penguasa'],
                'penanggung_jawab' => $item['penanggung_jawab'],
                'penerbit_informasi' => $item['penerbit_informasi'],
                'bentuk_informasi' => $item['bentuk_informasi'],
                'tempat_pembuatan' => $item['tempat_pembuatan'],
                'waktu_pembuatan' => $item['waktu_pembuatan'],
                'jangka_waktu' => $item['jangka_waktu'],
                'file_path' => $item['file_path'],
                'file_name' => $item['file_name'],
                'tautan_links' => $item['tautan_links'],
                'tanggal' => '2026-01-01',
                'aktif' => true,
                'bisa_download' => true,
            ]);

            DaftarInformasi::create([
                'kategori' => 'informasi-berkala',
                'judul_informasi' => $item['judul'],
                'isi_informasi' => $item['deskripsi'],
                'pejabat_penguasa' => $item['pejabat_penguasa'],
                'penanggung_jawab' => $item['penanggung_jawab'],
                'penerbit_informasi' => $item['penerbit_informasi'],
                'tempat_pembuatan' => $item['tempat_pembuatan'],
                'waktu_pembuatan' => $item['waktu_pembuatan'],
                'bentuk_informasi' => $item['bentuk_informasi'],
                'jangka_waktu' => $item['jangka_waktu'],
                'file_informasi' => $item['file_path'],
                'tipe_informasi' => $item['tipe_informasi'],
                'tautan_links' => $item['tautan_links'],
                'aktif' => true,
                'bisa_download' => true,
            ]);
        }

        // =========================================================================
        // 2. INFORMASI SETIAP SAAT (10 Items)
        // =========================================================================
        $setiapSaatList = [
            // 1. Dokumentasi Kegiatan Pimpinan
            [
                'judul' => 'Dokumentasi Kegiatan dan Agenda Resmi Pimpinan PKTJ Tegal',
                'deskripsi' => 'Dokumentasi foto, siaran pers, dan liputan berita kegiatan kedinasan Direktur beserta jajaran manajemen pimpinan PKTJ Tegal dalam rangka memajukan pendidikan vokasi keselamatan transportasi.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Subbagian Umum dan Kehumasan',
                'penerbit_informasi' => 'Subbagian Umum dan Kehumasan',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://pktj.ac.id/berita',
                'file_name' => 'Dokumentasi_Kegiatan_Pimpinan.pdf',
                'tipe_informasi' => 'PROFIL',
                'tautan_links' => [
                    ['nama' => 'Berita & Agenda Pimpinan PKTJ', 'url' => 'https://pktj.ac.id/berita'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 2. Peraturan/SK Direktur PKTJ
            [
                'judul' => 'Peraturan, Keputusan, dan Surat Edaran Direktur PKTJ Tegal',
                'deskripsi' => 'Informasi komprehensif mengenai Surat Keputusan (SK), Instruksi, Peraturan Direktur, dan Surat Edaran operasional akademik, tata tertib kehidupan taruna, dan manajemen satker PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/1UqUH_JDSE84qvKkT-KrdFjCb53XJTX0i/view',
                'file_name' => 'SK_Direktur_dan_Kebijakan_PKTJ.pdf',
                'tipe_informasi' => 'TATA CARA / PROSEDUR',
                'tautan_links' => [
                    ['nama' => 'Salinan SK Direktur & Kebijakan PKTJ', 'url' => 'https://drive.google.com/file/d/1UqUH_JDSE84qvKkT-KrdFjCb53XJTX0i/view'],
                    ['nama' => 'JDIH Kementerian Perhubungan', 'url' => 'https://jdih.dephub.go.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 3. Laporan BMN
            [
                'judul' => 'Laporan Data Barang Milik Negara (BMN) PKTJ Tegal',
                'deskripsi' => 'Data penatausahaan mutasi tambah kurang, penyusutan, penetapan status penggunaan (PSP), pemeliharaan, serta inventarisasi Barang Milik Negara di lingkungan PKTJ Tegal yang telah diaudit oleh BPK-RI.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum (Pengelola BMN)',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                'file_name' => 'Laporan_BMN_PKTJ_Audited.pdf',
                'tipe_informasi' => 'KINERJA DAN KEUANGAN',
                'tautan_links' => [
                    ['nama' => 'Laporan Penatausahaan BMN PKTJ', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 4. Pengelolaan Arsip
            [
                'judul' => 'Informasi Pengelolaan Tata Kearsipan Unit Kerja PKTJ Tegal',
                'deskripsi' => 'Penataan daftar berkas, skema klasifikasi arsip, dan jadwal retensi arsip inaktif yang tersimpan di Record Center PKTJ Tegal sesuai standar Undang-Undang Nomor 43 Tahun 2009 tentang Kearsipan.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Subbagian Umum (Unit Kearsipan)',
                'penerbit_informasi' => 'Subbagian Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://pktj.ac.id',
                'file_name' => 'Pedoman_Tata_Kelola_Kearsipan_PKTJ.pdf',
                'tipe_informasi' => 'TATA CARA / PROSEDUR',
                'tautan_links' => [
                    ['nama' => 'Pedoman Tata Kelola Kearsipan PKTJ', 'url' => 'https://pktj.ac.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 5. Kurikulum & Silabus
            [
                'judul' => 'Kurikulum dan Silabus Program Studi Diploma & Sarjana Terapan PKTJ Tegal',
                'deskripsi' => 'Keputusan penetapan kurikulum, profil lulusan, capaian pembelajaran, dan silabus mata kuliah Program Studi D-IV Rekayasa Sistem Transportasi Jalan (RSTJ), D-IV Teknologi Rekayasa Otomotif (TRO), dan D-III Teknologi Otomotif (TO).',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'penerbit_informasi' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://pktj.ac.id/program-studi',
                'file_name' => 'Kurikulum_Silabus_Prodi_PKTJ.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Kurikulum dan Program Studi PKTJ', 'url' => 'https://pktj.ac.id/program-studi'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 6. SOP Layanan
            [
                'judul' => 'Standar Operasional Prosedur (SOP) Layanan Akademik dan Administrasi PKTJ',
                'deskripsi' => 'Kumpulan SOP operasional pendidikan tinggi vokasi, tata kelola laboratorium keselamatan jalan, ujian kompetensi, serta prosedur administrasi umum di lingkungan Politeknik Keselamatan Transportasi Jalan.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Satuan Penjaminan Mutu (SPM) / Subbag Umum',
                'penerbit_informasi' => 'Satuan Penjaminan Mutu (SPM)',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://pktj.ac.id',
                'file_name' => 'Kumpulan_SOP_Layanan_PKTJ.pdf',
                'tipe_informasi' => 'TATA CARA / PROSEDUR',
                'tautan_links' => [
                    ['nama' => 'Kumpulan SOP Layanan PKTJ', 'url' => 'https://pktj.ac.id'],
                    ['nama' => 'SOP Layanan Informasi PPID', 'url' => 'https://ppid.pktj.ac.id/prosedur/permintaan-informasi'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 7. Bantuan Tugas Belajar
            [
                'judul' => 'Dokumen Pedoman Bantuan Tugas Belajar dan Izin Belajar Pegawai PKTJ',
                'deskripsi' => 'Ketentuan, mekanisme seleksi administrasi, hak dan kewajiban pegawai negeri sipil PKTJ Tegal yang melaksanakan tugas belajar maupun izin belajar di jenjang perguruan tinggi lanjutan.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum (Kepegawaian)',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://bpsdm.kemenhub.go.id',
                'file_name' => 'Pedoman_Tugas_Belajar_SDM.pdf',
                'tipe_informasi' => 'TATA CARA / PROSEDUR',
                'tautan_links' => [
                    ['nama' => 'Pedoman Tugas Belajar SDM Kemenhub', 'url' => 'https://bpsdm.kemenhub.go.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 8. Assessment SDM
            [
                'judul' => 'Dokumen Pelaksanaan Assessment dan Uji Kompetensi Pegawai PKTJ Tegal',
                'deskripsi' => 'Prosedur pemetaan kompetensi, profil asesmen jabatan fungsional dan struktural pegawai di lingkungan PKTJ Tegal dalam rangka penerapan sistem merit manajemen ASN.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum (Kepegawaian)',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://bpsdm.kemenhub.go.id',
                'file_name' => 'Pelaksanaan_Assessment_Pegawai.pdf',
                'tipe_informasi' => 'TATA CARA / PROSEDUR',
                'tautan_links' => [
                    ['nama' => 'Informasi Assessment SDM Kemenhub', 'url' => 'https://bpsdm.kemenhub.go.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 9. Ujian Dinas
            [
                'judul' => 'Dokumen dan Panduan Pelaksanaan Ujian Dinas Pegawai PKTJ Tegal',
                'deskripsi' => 'Persyaratan kelengkapan berkas, jadwal pendaftaran, dan panduan teknis pelaksanaan Ujian Dinas Tingkat I, Tingkat II, serta Ujian Penyesuaian Kenaikan Pangkat (UPKP) ASN PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum (Kepegawaian)',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://bpsdm.kemenhub.go.id',
                'file_name' => 'Panduan_Ujian_Dinas_ASN.pdf',
                'tipe_informasi' => 'TATA CARA / PROSEDUR',
                'tautan_links' => [
                    ['nama' => 'Portal Ujian Dinas SDM Perhubungan', 'url' => 'https://bpsdm.kemenhub.go.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 10. Laporan SPIP
            [
                'judul' => 'Laporan Sistem Pengendalian Intern Pemerintah (SPIP) PKTJ Tegal',
                'deskripsi' => 'Laporan maturitas penyelenggaraan SPIP, peta risiko kelembagaan, efektivitas pengendalian operasional, dan kepatuhan perundang-undangan di lingkungan PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Satuan Pengawas Internal (SPI)',
                'penerbit_informasi' => 'Satuan Pengawas Internal (SPI)',
                'bentuk_informasi' => 'Softcopy dan Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
                'file_name' => 'Laporan_SPIP_PKTJ_2026.pdf',
                'tipe_informasi' => 'KINERJA DAN KEUANGAN',
                'tautan_links' => [
                    ['nama' => 'Ringkasan Laporan SPIP PKTJ', 'url' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
        ];

        foreach ($setiapSaatList as $item) {
            InformasiSetiapSaat::create([
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'pejabat_penguasa' => $item['pejabat_penguasa'],
                'penanggung_jawab' => $item['penanggung_jawab'],
                'penerbit_informasi' => $item['penerbit_informasi'],
                'bentuk_informasi' => $item['bentuk_informasi'],
                'tempat_pembuatan' => $item['tempat_pembuatan'],
                'waktu_pembuatan' => $item['waktu_pembuatan'],
                'jangka_waktu' => $item['jangka_waktu'],
                'file_path' => $item['file_path'],
                'file_name' => $item['file_name'],
                'tautan_links' => $item['tautan_links'],
                'tanggal' => '2026-01-01',
                'aktif' => true,
                'bisa_download' => true,
            ]);

            DaftarInformasi::create([
                'kategori' => 'informasi-setiap-saat',
                'judul_informasi' => $item['judul'],
                'isi_informasi' => $item['deskripsi'],
                'pejabat_penguasa' => $item['pejabat_penguasa'],
                'penanggung_jawab' => $item['penanggung_jawab'],
                'penerbit_informasi' => $item['penerbit_informasi'],
                'tempat_pembuatan' => $item['tempat_pembuatan'],
                'waktu_pembuatan' => $item['waktu_pembuatan'],
                'bentuk_informasi' => $item['bentuk_informasi'],
                'jangka_waktu' => $item['jangka_waktu'],
                'file_informasi' => $item['file_path'],
                'tipe_informasi' => $item['tipe_informasi'],
                'tautan_links' => $item['tautan_links'],
                'aktif' => true,
                'bisa_download' => true,
            ]);
        }

        // =========================================================================
        // 3. INFORMASI SERTA MERTA (3 Items)
        // =========================================================================
        $sertaMertaList = [
            // 1. Perubahan Jadwal Layanan Publik
            [
                'judul' => 'Perubahan Jadwal Layanan Publik & Pemeliharaan Fasilitas PKTJ Tegal',
                'deskripsi' => 'Pengumuman mendesak terkait penyesuaian jadwal pelayanan administrasi umum, layanan perpustakaan, atau penutupan sementara fasilitas pengujian laboratorium akibat faktor cuaca ekstrem, perbaikan darurat sarana, atau pemeliharaan sistem digital kampus.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy (Media Pengumuman Digital)',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://ppid.pktj.ac.id/profil/kontak',
                'file_name' => 'Pengumuman_Perubahan_Jadwal_Layanan.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Pemberitahuan Layanan Kampus', 'url' => 'https://pktj.ac.id'],
                    ['nama' => 'Layanan Kontak Respons Cepat', 'url' => 'https://ppid.pktj.ac.id/profil/kontak'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 2. Aktivitas Lapangan Taruna
            [
                'judul' => 'Pemberitahuan Aktivitas Lapangan dan Kegiatan Taruna yang Berdampak Publik',
                'deskripsi' => 'Informasi serta merta kepada masyarakat sekitar mengenai pelaksanaan latihan baris-berbaris di luar kampus, konvoi pembelajaran keselamatan berkendara, parade wisuda perwira transportasi, atau simulasi evakuasi darurat yang berpotensi menimbulkan kepadatan lalu lintas di sekitar kampus PKTJ.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Pusat Pembangunan Karakter / Ketarunaan',
                'penerbit_informasi' => 'Pusat Pembangunan Karakter',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://pktj.ac.id',
                'file_name' => 'Pemberitahuan_Kegiatan_Taruna_PKTJ.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Kanal Pengumuman Publik PKTJ', 'url' => 'https://pktj.ac.id'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
            // 3. Perubahan Alur Kendaraan Kampus 1 & 2
            [
                'judul' => 'Perubahan Alur Masuk & Manajemen Lalu Lintas Gerbang Kampus PKTJ (Kampus 1 & 2 Tegal)',
                'deskripsi' => 'Pengaturan darurat rekayasa lalu lintas dan sirkulasi kendaraan roda dua maupun roda empat di Gerbang Kampus 1 (Jl. Perintis Kemerdekaan) dan Kampus 2 (Margadana, Jl. Abdul Syukur) Kota Tegal selama proses perbaikan gerbang, kegiatan upacara resmi, atau penerimaan taruna baru.',
                'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'Subbagian Umum (Unit Keamanan Kampus)',
                'penerbit_informasi' => 'Subbagian Umum',
                'bentuk_informasi' => 'Hardcopy dan Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'file_path' => 'https://pktj.ac.id/tentang#',
                'file_name' => 'Rekayasa_Lalu_Lintas_Gerbang_Kampus_PKTJ.pdf',
                'tipe_informasi' => 'PROGRAM DAN KEGIATAN',
                'tautan_links' => [
                    ['nama' => 'Informasi Akses Kampus 1 & 2', 'url' => 'https://pktj.ac.id/tentang#'],
                ],
                'aktif' => true,
                'bisa_download' => true,
            ],
        ];

        foreach ($sertaMertaList as $item) {
            InformasiSertaMerta::create([
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'pejabat_penguasa' => $item['pejabat_penguasa'],
                'penanggung_jawab' => $item['penanggung_jawab'],
                'penerbit_informasi' => $item['penerbit_informasi'],
                'bentuk_informasi' => $item['bentuk_informasi'],
                'tempat_pembuatan' => $item['tempat_pembuatan'],
                'waktu_pembuatan' => $item['waktu_pembuatan'],
                'jangka_waktu' => $item['jangka_waktu'],
                'file_path' => $item['file_path'],
                'file_name' => $item['file_name'],
                'tautan_links' => $item['tautan_links'],
                'tanggal' => '2026-01-01',
                'aktif' => true,
                'bisa_download' => true,
            ]);

            DaftarInformasi::create([
                'kategori' => 'informasi-serta-merta',
                'judul_informasi' => $item['judul'],
                'isi_informasi' => $item['deskripsi'],
                'pejabat_penguasa' => $item['pejabat_penguasa'],
                'penanggung_jawab' => $item['penanggung_jawab'],
                'penerbit_informasi' => $item['penerbit_informasi'],
                'tempat_pembuatan' => $item['tempat_pembuatan'],
                'waktu_pembuatan' => $item['waktu_pembuatan'],
                'bentuk_informasi' => $item['bentuk_informasi'],
                'jangka_waktu' => $item['jangka_waktu'],
                'file_informasi' => $item['file_path'],
                'tipe_informasi' => $item['tipe_informasi'],
                'tautan_links' => $item['tautan_links'],
                'aktif' => true,
                'bisa_download' => true,
            ]);
        }

        // =========================================================================
        // 4. INFORMASI DIKECUALIKAN (DIK 3 Items dari KP-SKJ 8 Tahun 2026)
        // =========================================================================
        $dikList = [
            // 1. Hak Akses CCTV
            [
                'judul' => 'Hak Akses Pemantauan Kamera Pengawas (CCTV) di Lingkungan Kampus PKTJ Tegal',
                'deskripsi' => 'Rekaman video dan hak akses langsung pengawasan closed-circuit television (CCTV) pada gerbang kampus, ruang asrama taruna/i, ruang kelas teori, laboratorium pengujian, ruang tenaga pengajar, perpustakaan, dan ruang pembina ketarunaan di Kampus 1 dan Kampus 2 PKTJ Tegal.',
                'dasar_hukum' => 'Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Pasal 17 huruf j.',
                'konsekuensi_dibuka' => 'Apabila dibuka dapat melanggar privasi civitas akademika/taruna, menimbulkan kerentanan arsitektur keamanan instalasi vital pemerintah, serta memudahkan potensi tindak kriminal atau sabotase keamanan fisik kampus.',
                'konsekuensi_ditutup' => 'Apabila ditutup dapat menjaga integritas sistem pengawasan elektronik internal pemerintah, melindungi privasi serta keselamatan fisik seluruh taruna, pegawai, dan aset fasilitas negara.',
                'jangka_waktu' => '5 Tahun',
                'penanggung_jawab' => 'Unit TIK & Subbag Umum (Keamanan Kampus)',
                'file_path' => 'https://drive.google.com/file/d/1d-80lK55eSXGG0ZogSoUUPv7cJKZvie0/view?usp=drive_link',
                'file_name' => 'KP-SKJ-8-TAHUN-2026-DIK.pdf',
                'tanggal' => '2026-01-01',
                'aktif' => true,
                'is_blurred' => false,
                'bisa_download' => true,
            ],
            // 2. Penilaian SIPENCATAR
            [
                'judul' => 'Rincian Penilaian Individual Proses Seleksi Penerimaan Calon Taruna (SIPENCATAR) PKTJ Tegal',
                'deskripsi' => 'Data lembar kerja nilai perorangan, hasil uji kesehatan rekam medis, psikotes, wawancara, dan rekam jejak penilaian psikologis individual peserta seleksi calon taruna/taruni Kemenhub di lingkungan PKTJ Tegal.',
                'dasar_hukum' => 'Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Pasal 17 huruf h angka 4.',
                'konsekuensi_dibuka' => 'Apabila dibuka dapat mengungkap rahasia pribadi peserta, membocorkan riwayat kesehatan fisik/psikologis serta kapabilitas intelektual perorangan kepada publik tanpa izin tertulis yang bersangkutan.',
                'konsekuensi_ditutup' => 'Apabila ditutup dapat melindungi hak privasi, martabat perorangan, dan kerahasiaan data medis/psikologis individu calon taruna sesuai ketentuan peraturan perundang-undangan.',
                'jangka_waktu' => '5 Tahun',
                'penanggung_jawab' => 'Bagian Administrasi Akademik dan Ketarunaan (BAAK)',
                'file_path' => 'https://drive.google.com/file/d/1d-80lK55eSXGG0ZogSoUUPv7cJKZvie0/view?usp=drive_link',
                'file_name' => 'KP-SKJ-8-TAHUN-2026-DIK.pdf',
                'tanggal' => '2026-01-01',
                'aktif' => true,
                'is_blurred' => false,
                'bisa_download' => true,
            ],
            // 3. Topologi Server & Jaringan
            [
                'judul' => 'Topologi Infrastruktur Jaringan Server dan Sistem Keamanan Siber PKTJ Tegal',
                'deskripsi' => 'Diagram konfigurasi arsitektur jaringan internal kampus, pemetaan IP address publik/private, akun akses firewall, topologi server database akademik/keuangan, dan kredensial sistem keamanan siber informasi PKTJ Tegal.',
                'dasar_hukum' => 'Undang-Undang Nomor 11 Tahun 2008 jo. UU Nomor 1 Tahun 2024 tentang ITE, serta UU No. 14 Tahun 2008 Pasal 17 huruf j.',
                'konsekuensi_dibuka' => 'Jika dibuka dapat menimbulkan kerentanan arsitektur IT dan berpotensi dieksploitasi untuk serangan siber (cyber attack), kebocoran database akademik, peretasan server, atau sabotase operasional kelembagaan.',
                'konsekuensi_ditutup' => 'Jika ditutup maka infrastruktur digital, integritas data seluruh taruna/pegawai, server website, dan operasional teknologi informasi PKTJ aman dari segala potensi gangguan atau serangan peretas (hacker).',
                'jangka_waktu' => '5 Tahun',
                'penanggung_jawab' => 'Unit Teknologi Informasi dan Komunikasi (TIK) PKTJ Tegal',
                'file_path' => 'https://drive.google.com/file/d/1d-80lK55eSXGG0ZogSoUUPv7cJKZvie0/view?usp=drive_link',
                'file_name' => 'KP-SKJ-8-TAHUN-2026-DIK.pdf',
                'tanggal' => '2026-01-01',
                'aktif' => true,
                'is_blurred' => false,
                'bisa_download' => true,
            ],
        ];

        foreach ($dikList as $item) {
            InformasiDikecualikan::create($item);
        }
    }
}
