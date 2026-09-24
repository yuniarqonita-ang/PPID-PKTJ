<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InformasiBerkala;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiSertaMerta;
use App\Models\DaftarInformasi;
use Illuminate\Support\Facades\DB;

class DipPktj2026Seeder extends Seeder
{
    public function run(): void
    {
        // =========================================================================
        // 1. INFORMASI BERKALA (25 ITEM SESUAI HALAMAN 1 PDF KP-SKJ 9 TAHUN 2026)
        // =========================================================================
        $berkalaItems = [
            [
                'judul' => 'Profil Unit Kerja di PKTJ Tegal',
                'deskripsi' => 'Informasi tentang profil unit kerja di Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal, meliputi sejarah, visi dan misi, tugas pokok dan fungsi, struktur organisasi, kedudukan, serta alamat dan kontak resmi satuan kerja.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbagian Tata Usaha dan Rumah Tangga / Tim Humas',
                'penanggung_jawab' => 'Subbagian Tata Usaha dan Rumah Tangga / Tim Humas',
                'bentuk_informasi' => 'Softcopy & Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'Portal Profil PKTJ Tegal', 'url' => 'https://pktj.ac.id/tentang#']
                ],
                'file_path' => 'https://pktj.ac.id/tentang#',
                'aktif' => true,
            ],
            [
                'judul' => 'Profil Pejabat PKTJ Tegal',
                'deskripsi' => 'Informasi profil pimpinan dan pejabat struktural di lingkungan PKTJ Tegal, meliputi Direktur, para Wakil Direktur, Kepala Bagian, dan jajaran kepala unit kerja lengkap dengan riwayat pendidikan, riwayat jabatan, dan biografi pimpinan.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Softcopy & Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Menjabat',
                'tautan_links' => [
                    ['nama' => 'Halaman Profil Pejabat PPID', 'url' => 'https://ppid.pktj.ac.id/profil/profil-pejabat']
                ],
                'file_path' => 'https://ppid.pktj.ac.id/profil/profil-pejabat',
                'aktif' => true,
            ],
            [
                'judul' => 'RKT PKTJ Tegal',
                'deskripsi' => 'Rencana Kinerja Tahunan (RKT) Politeknik Keselamatan Transportasi Jalan Tegal yang memuat sasaran strategis, indikator kinerja utama (IKU), dan target capaian kinerja unit kerja tahun berjalan.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbagian Perencanaan dan Keuangan',
                'penanggung_jawab' => 'Subbagian Perencanaan dan Keuangan',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Perjanjian Kinerja (PK) PKTJ Tegal',
                'deskripsi' => 'Dokumen Perjanjian Kinerja (PK) antara Direktur PKTJ Tegal dengan Kepala Badan Pengembangan SDM Perhubungan Kementerian Perhubungan RI mengenai komitmen pencapaian target kinerja institusi.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbagian Perencanaan dan Keuangan',
                'penanggung_jawab' => 'Subbagian Perencanaan dan Keuangan',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'RKA-KL PKTJ Tegal',
                'deskripsi' => 'Rencana Kerja dan Anggaran Kementerian Negara/Lembaga (RKA-KL) Politeknik Keselamatan Transportasi Jalan Tegal yang memuat rincian alokasi anggaran belanja pegawai, operasional pendidikan, dan pengembangan fasilitas kampus.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbagian Perencanaan dan Keuangan',
                'penanggung_jawab' => 'Subbagian Perencanaan dan Keuangan',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'DIPA Induk PKTJ Tegal Tahun 2026',
                'deskripsi' => 'Dokumen Isian Pelaksanaan Anggaran (DIPA) Petikan / Induk Politeknik Keselamatan Transportasi Jalan Tegal Tahun Anggaran 2026 sebagai otorisasi belanja APBN Kementerian Perhubungan.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Softcopy (PDF)',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '10 Tahun',
                'tautan_links' => [
                    ['nama' => 'Dokumen DIPA Induk 2026', 'url' => 'https://drive.google.com/file/d/1hLQ-26Oko2u1uve8jD9NMbNknRnyLD_W/view']
                ],
                'file_path' => 'https://drive.google.com/file/d/1hLQ-26Oko2u1uve8jD9NMbNknRnyLD_W/view',
                'aktif' => true,
            ],
            [
                'judul' => 'LAKIP PKTJ Tegal Tahun 2025',
                'deskripsi' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah (LAKIP) PKTJ Tegal Tahun 2025 yang menyajikan pertanggungjawaban pencapaian sasaran kinerja program pendidikan dan pelatihan keselamatan transportasi.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbag Perencanaan dan Keuangan',
                'penanggung_jawab' => 'Subbag Perencanaan dan Keuangan',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Laporan Tahunan PKTJ Tegal',
                'deskripsi' => 'Laporan Tahunan komprehensif mengenai penyelenggaraan tridharma perguruan tinggi, pembinaan ketarunaan, keuangan, sarana prasarana, serta inovasi keselamatan jalan di PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'penanggung_jawab' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'LHKPN Pejabat Negara',
                'deskripsi' => 'Rekapitulasi bukti tanda terima dan kepatuhan penyampaian Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) para pejabat pimpinan di lingkungan Politeknik Keselamatan Transportasi Jalan.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbagian Kepegawaian dan Umum',
                'penanggung_jawab' => 'Subbagian Kepegawaian dan Umum',
                'bentuk_informasi' => 'Softcopy & Online',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025/2026',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [
                    ['nama' => 'LHKPN Pejabat PKTJ 2025', 'url' => 'https://drive.google.com/file/d/1RhCMtybOF3-wz3IRdnYgg8ET_6FjI8Ln/view?usp=sharing']
                ],
                'file_path' => 'https://drive.google.com/file/d/1RhCMtybOF3-wz3IRdnYgg8ET_6FjI8Ln/view?usp=sharing',
                'aktif' => true,
            ],
            [
                'judul' => 'Informasi Diklat yang diselenggarakan',
                'deskripsi' => 'Informasi jadwal, kuota, persyaratan, dan kurikulum pendidikan dan pelatihan (Diklat) teknis transportasi jalan, diklat kompetensi pengujian kendaraan bermotor, dan diklat keselamatan lalulintas.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Pusat Pengembangan SDM Perhubungan Darat / PKTJ',
                'penanggung_jawab' => 'Pusat Pengembangan SDM Perhubungan Darat / PKTJ',
                'bentuk_informasi' => 'Softcopy & Brosur',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '3 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Informasi Sipencatar',
                'deskripsi' => 'Pengumuman resmi seleksi Penerimaan Calon Taruna/Taruni (Sipencatar) Pola Pembibitan dan Mandiri Kementerian Perhubungan, alur pendaftaran, tes CAT SKD, tes kesehatan, dan tahapan seleksi lainnya.',
                'pejabat_penguasa' => 'Tim SIPENCATAR / PPID PKTJ',
                'penerbit_informasi' => 'BPSDMP Kemenhub / PKTJ',
                'penanggung_jawab' => 'BPSDMP Kemenhub / PKTJ',
                'bentuk_informasi' => 'Softcopy & Online Portal',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'tautan_links' => [
                    ['nama' => 'Portal SIPENCATAR Kemenhub', 'url' => 'https://sipencatar.dephub.go.id']
                ],
                'file_path' => 'https://sipencatar.dephub.go.id',
                'aktif' => true,
            ],
            [
                'judul' => 'Kalender Akademik',
                'deskripsi' => 'Jadwal kalender operasional perkuliahan semester ganjil dan genap, praktikum laboratorium keselamatan jalan, ujian tengah semester, ujian akhir semester, serta agenda ketarunaan PKTJ.',
                'pejabat_penguasa' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'penerbit_informasi' => 'PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'bentuk_informasi' => 'Softcopy (PDF)',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025/2026',
                'jangka_waktu' => '1 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Statistik PKTJ Tegal Tahun 2025',
                'deskripsi' => 'Data dan statistik kepegawaian resmi PKTJ Tegal (PNS, PPPK, Non-ASN), rasio dosen dan taruna, sarana prasarana, serta statistik lulusan. Data telah diverifikasi sesuai DRH dan data resmi kepegawaian PKTJ.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbagian Tata Usaha dan Kepegawaian',
                'penanggung_jawab' => 'Subbagian Tata Usaha dan Kepegawaian',
                'bentuk_informasi' => 'Softcopy & Dashboard Web',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [
                    ['nama' => 'Statistik Kepegawaian PKTJ', 'url' => 'https://ppid.pktj.ac.id/profil/statistik-pegawai']
                ],
                'file_path' => 'https://ppid.pktj.ac.id/profil/statistik-pegawai',
                'aktif' => true,
            ],
            [
                'judul' => 'Renstra PKTJ Tegal',
                'deskripsi' => 'Rencana Strategis (Renstra) Politeknik Keselamatan Transportasi Jalan Tegal yang memuat arah kebijakan, sasaran program, dan strategi pengembangan institusi jangka menengah (5 tahunan).',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Bagian Perencanaan dan Keuangan',
                'penanggung_jawab' => 'Bagian Perencanaan dan Keuangan',
                'bentuk_informasi' => 'Softcopy (PDF)',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [
                    ['nama' => 'Dokumen Renstra PKTJ', 'url' => 'https://drive.google.com/file/d/1h2WscEMk0Y8eYysVYW7rAV_mRqELe0Pu/view?usp=drive_link']
                ],
                'file_path' => 'https://drive.google.com/file/d/1h2WscEMk0Y8eYysVYW7rAV_mRqELe0Pu/view?usp=drive_link',
                'aktif' => true,
            ],
            [
                'judul' => 'Peraturan Menteri tentang Ortaker Unit Kerja PKTJ',
                'deskripsi' => 'Peraturan Menteri Perhubungan Republik Indonesia yang mengatur mengenai Organisasi dan Tata Kerja (Ortaker) Politeknik Keselamatan Transportasi Jalan Tegal beserta struktur eselon dan uraian fungsi.',
                'pejabat_penguasa' => 'Subbag Hukum dan KSL / PPID',
                'penerbit_informasi' => 'Kementerian Perhubungan RI',
                'penanggung_jawab' => 'Subbag Hukum dan KSL / PPID',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal / Jakarta',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Laporan Keuangan PKTJ Tegal Tahun 2025',
                'deskripsi' => 'Laporan Keuangan PKTJ Tegal Tahun Anggaran 2025 yang terdiri atas Neraca, Laporan Realisasi Anggaran (LRA), Laporan Operasional (LO), Laporan Perubahan Ekuitas (LPE), dan Catatan atas Laporan Keuangan (CaLK).',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbagian Keuangan',
                'penanggung_jawab' => 'Subbagian Keuangan',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '10 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Struktur PPID PKTJ Tegal',
                'deskripsi' => 'Bagan susunan struktur organisasi Pengelola Informasi dan Dokumentasi (PPID) Pelaksana PKTJ Tegal, meliputi Atasan PPID, PPID Pelaksana, Petugas Informasi, dan Petugas Dokumentasi beserta tupoksi masing-masing.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'PPID Pelaksana PKTJ',
                'penanggung_jawab' => 'PPID Pelaksana PKTJ',
                'bentuk_informasi' => 'Softcopy & Infografis',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'Struktur Organisasi PPID', 'url' => 'https://ppid.pktj.ac.id/profil/struktur-organisasi']
                ],
                'file_path' => 'https://ppid.pktj.ac.id/profil/struktur-organisasi',
                'aktif' => true,
            ],
            [
                'judul' => 'Daftar Informasi Publik',
                'deskripsi' => 'Dokumen resmi Daftar Informasi Publik (DIP) PKTJ Tegal yang memuat rincian klasifikasi informasi berkala, informasi setiap saat, informasi serta merta, dan informasi yang dikecualikan.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'PPID Pelaksana PKTJ',
                'penanggung_jawab' => 'PPID Pelaksana PKTJ',
                'bentuk_informasi' => 'Softcopy & Online Portal',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '1 Tahun',
                'tautan_links' => [
                    ['nama' => 'Portal Daftar Informasi Publik', 'url' => 'https://ppid.pktj.ac.id/layanan-informasi/daftar']
                ],
                'file_path' => 'https://ppid.pktj.ac.id/layanan-informasi/daftar',
                'aktif' => true,
            ],
            [
                'judul' => 'Tata Cara Permohonan Informasi Publik',
                'deskripsi' => 'Standar Operasional Prosedur serta petunjuk teknis tahapan permohonan informasi publik bagi masyarakat, badan hukum, maupun akademisi sesuai amanat UU No. 14 Tahun 2008.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'PPID Pelaksana PKTJ',
                'penanggung_jawab' => 'PPID Pelaksana PKTJ',
                'bentuk_informasi' => 'Softcopy & Infografis',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'Prosedur Permintaan Informasi', 'url' => 'https://ppid.pktj.ac.id/prosedur/permintaan-informasi']
                ],
                'file_path' => 'https://ppid.pktj.ac.id/prosedur/permintaan-informasi',
                'aktif' => true,
            ],
            [
                'judul' => 'Tata Cara Penyelesaian Sengketa Informasi Publik',
                'deskripsi' => 'Mekanisme dan tata cara pengajuan serta penyelesaian sengketa informasi publik melalui Komisi Informasi Pusat (KIP) atau Komisi Informasi Provinsi apabila permohonan informasi tidak terpenuhi.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbag Hukum dan KSL / PPID',
                'penanggung_jawab' => 'Subbag Hukum dan KSL / PPID',
                'bentuk_informasi' => 'Softcopy & Infografis',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'Prosedur Sengketa Informasi', 'url' => 'https://ppid.pktj.ac.id/prosedur/sengketa-informasi']
                ],
                'file_path' => 'https://ppid.pktj.ac.id/prosedur/sengketa-informasi',
                'aktif' => true,
            ],
            [
                'judul' => 'Tata Cara Mengajukan Keberatan Informasi Publik',
                'deskripsi' => 'Prosedur dan alur pengajuan keberatan tertulis kepada Atasan PPID PKTJ Tegal atas penolakan permohonan informasi, ketidaksesuaian waktu tanggapan, atau biaya yang tidak wajar.',
                'pejabat_penguasa' => 'Atasan PPID / PPID PKTJ',
                'penerbit_informasi' => 'PPID Pelaksana PKTJ',
                'penanggung_jawab' => 'PPID Pelaksana PKTJ',
                'bentuk_informasi' => 'Softcopy & Infografis',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'Prosedur Penanganan Keberatan', 'url' => 'https://ppid.pktj.ac.id/prosedur/penanganan-keberatan']
                ],
                'file_path' => 'https://ppid.pktj.ac.id/prosedur/penanganan-keberatan',
                'aktif' => true,
            ],
            [
                'judul' => 'Informasi Kanal Informasi dan Pengaduan PKTJ Tegal',
                'deskripsi' => 'Daftar saluran komunikasi publik resmi, helpdesk, kanal media sosial, WhatsApp dinas, email, dan integrasi Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional (SP4N-LAPOR!).',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'Subbagian Humas dan Protokol',
                'penanggung_jawab' => 'Subbagian Humas dan Protokol',
                'bentuk_informasi' => 'Softcopy & Media Sosial',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'Kanal SP4N LAPOR!', 'url' => 'https://lapor.go.id']
                ],
                'file_path' => 'https://lapor.go.id',
                'aktif' => true,
            ],
            [
                'judul' => 'Laporan PPID',
                'deskripsi' => 'Laporan tahunan layanan informasi publik PPID PKTJ Tegal yang menyajikan statistik jumlah permohonan informasi, jangka waktu penyelesaian, permohonan keberatan, dan dokumentasi layanan.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal',
                'penerbit_informasi' => 'PPID Pelaksana PKTJ',
                'penanggung_jawab' => 'PPID Pelaksana PKTJ',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [
                    ['nama' => 'Laporan Tahunan Layanan PPID', 'url' => 'https://ppid.pktj.ac.id/layanan-informasi/laporan']
                ],
                'file_path' => 'https://ppid.pktj.ac.id/layanan-informasi/laporan',
                'aktif' => true,
            ],
            [
                'judul' => 'Jurnal Ilmiah',
                'deskripsi' => 'Publikasi hasil penelitian ilmiah, riset keselamatan jalan, dan inovasi rekayasa transportasi dari sivitas akademika PKTJ Tegal yang terakreditasi pada sistem Open Journal System (OJS) PKTJ.',
                'pejabat_penguasa' => 'Unit Penelitian dan Pengabdian kepada Masyarakat (UPPM)',
                'penerbit_informasi' => 'UPPM PKTJ Tegal',
                'penanggung_jawab' => 'UPPM PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy & Online OJS',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'Portal E-Journal PKTJ', 'url' => 'https://journal.pktj.ac.id']
                ],
                'file_path' => 'https://journal.pktj.ac.id',
                'aktif' => true,
            ],
            [
                'judul' => 'Informasi Pengadaan Barang dan Jasa PKTJ Tegal',
                'deskripsi' => 'Pengumuman Rencana Umum Pengadaan (RUP), tender seleksi pengadaan barang dan jasa, serta pengadaan langsung di PKTJ Tegal yang terintegrasi pada portal Layanan Pengadaan Secara Elektronik (LPSE) Kementerian Perhubungan.',
                'pejabat_penguasa' => 'Unit Kerja Pengadaan Barang/Jasa (UKPBJ) / PPID',
                'penerbit_informasi' => 'Pokja Pemilihan / PPK PKTJ',
                'penanggung_jawab' => 'Pokja Pemilihan / PPK PKTJ',
                'bentuk_informasi' => 'Softcopy & Portal LPSE',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [
                    ['nama' => 'Portal LPSE Kementerian Perhubungan', 'url' => 'https://lpse.dephub.go.id']
                ],
                'file_path' => 'https://lpse.dephub.go.id',
                'aktif' => true,
            ],
        ];

        // =========================================================================
        // 2. INFORMASI SETIAP SAAT (10 ITEM SESUAI HALAMAN 2 PDF KP-SKJ 9 TAHUN 2026)
        // =========================================================================
        $setiapSaatItems = [
            [
                'judul' => 'Dokumentasi Kegiatan Pimpinan',
                'deskripsi' => 'Liputan foto, video, berita acara, dan dokumentasi siaran pers kegiatan resmi Direktur, para Wakil Direktur, serta jajaran pimpinan PKTJ Tegal dalam acara dinas, rapat koordinasi, serah terima jabatan, dan kunjungan kerja.',
                'pejabat_penguasa' => 'Subbag Humas dan Protokol',
                'penerbit_informasi' => 'Tim Dokumentasi dan Publikasi PKTJ',
                'penanggung_jawab' => 'Tim Dokumentasi dan Publikasi PKTJ',
                'bentuk_informasi' => 'Softcopy & Multimedia',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '3 Tahun',
                'tautan_links' => [
                    ['nama' => 'Dokumentasi & Berita Kegiatan Pimpinan', 'url' => 'https://pktj.ac.id/berita']
                ],
                'file_path' => 'https://pktj.ac.id/berita',
                'aktif' => true,
            ],
            [
                'judul' => 'Peraturan, Keputusan, dan Kebijakan Direktur / Kepala Unit Kerja',
                'deskripsi' => 'Himpunan Keputusan Direktur Politeknik Keselamatan Transportasi Jalan, Peraturan Direktur, Surat Edaran Pimpinan, serta Petunjuk Teknis internal unit kerja PKTJ Tegal.',
                'pejabat_penguasa' => 'Direktur PKTJ / Subbag Tata Usaha',
                'penerbit_informasi' => 'PKTJ Tegal',
                'penanggung_jawab' => 'PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy (PDF)',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'Keputusan & Kebijakan Direktur PKTJ', 'url' => 'https://drive.google.com/file/d/1UqUH_JDSE84qvKkT-KrdFjCb53XJTX0i/view']
                ],
                'file_path' => 'https://drive.google.com/file/d/1UqUH_JDSE84qvKkT-KrdFjCb53XJTX0i/view',
                'aktif' => true,
            ],
            [
                'judul' => 'Laporan Data Barang Milik Negara',
                'deskripsi' => 'Laporan inventarisasi, mutasi, dan rekapitulasi penatausahaan Barang Milik Negara (BMN) berupa tanah, gedung perkantoran, asrama taruna, laboratorium keselamatan jalan, dan aset kendaraan bermotor PKTJ Tegal.',
                'pejabat_penguasa' => 'Subbagian Rumah Tangga dan BMN',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Softcopy & Hardcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [
                    ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2025', 'url' => 'https://drive.google.com/file/d/18xnwHrVu13TN1IWd_a2172osc6vaJIl_/view?usp=sharing'],
                    ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2024', 'url' => 'https://drive.google.com/file/d/1ktav_JxuX311w0YOsh7EG1B3RswhKtqT/view?usp=sharing'],
                    ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2023', 'url' => 'https://drive.google.com/file/d/11pcsgNxnJZIcGW8-9YSOLOYFxGlf-R1s/view?usp=sharing'],
                    ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2022', 'url' => 'https://drive.google.com/file/d/1wgltn9co46Y8bmAfevFRqSxcIxYdJo5P/view?usp=sharing'],
                    ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2021', 'url' => 'https://drive.google.com/file/d/1yOu1eiR0D_gAKi4vrGl2iSDNA3ITmO0q/view?usp=sharing'],
                    ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2020', 'url' => 'https://drive.google.com/file/d/1BT6qXihTuk1qk8UmaoIR4IcEdh4SciEa/view?usp=sharing'],
                    ['nama' => 'Folder Google Drive: Informasi Data Perbendaharaan atau Inventaris BMN Tahun 2020-2025', 'url' => 'https://drive.google.com/drive/folders/1t4KTWXJGCgNfF1Co-1yh6cnUKgwfClii?usp=sharing']
                ],
                'file_path' => 'https://drive.google.com/drive/folders/1t4KTWXJGCgNfF1Co-1yh6cnUKgwfClii?usp=sharing',
                'aktif' => true,
            ],
            [
                'judul' => 'Informasi Pengelolaan Arsip Unit Kerja',
                'deskripsi' => 'Daftar berkas arsip aktif, arsip inaktif, jadwal retensi arsip (JRA), dan tata pedoman kearsipan di lingkungan Politeknik Keselamatan Transportasi Jalan Tegal sesuai standar Arsip Nasional Republik Indonesia (ANRI).',
                'pejabat_penguasa' => 'Subbagian Tata Usaha dan Kearsipan',
                'penerbit_informasi' => 'PKTJ Tegal',
                'penanggung_jawab' => 'PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Kurikulum dan Silabus Diklat',
                'deskripsi' => 'Struktur kurikulum berbasis kompetensi keselamatan transportasi, silabus mata kuliah program studi Diploma IV dan Diploma III, modul ajar, dan program diklat teknis fungsional perhubungan.',
                'pejabat_penguasa' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'penerbit_informasi' => 'PKTJ Tegal',
                'penanggung_jawab' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'Kurikulum & Program Studi PKTJ', 'url' => 'https://pktj.ac.id/program-studi']
                ],
                'file_path' => 'https://pktj.ac.id/program-studi',
                'aktif' => true,
            ],
            [
                'judul' => 'Standar Operational Prosedur (SOP)',
                'deskripsi' => 'Kompilasi Standar Operasional Prosedur (SOP) layanan informasi publik, akademik ketarunaan, pengadaan barang jasa, penatausahaan BMN, dan tata laksana administrasi perkantoran PKTJ Tegal.',
                'pejabat_penguasa' => 'PPID / Tim Tata Laksana PKTJ',
                'penerbit_informasi' => 'PKTJ Tegal',
                'penanggung_jawab' => 'PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Berlaku',
                'tautan_links' => [
                    ['nama' => 'SOP Layanan PPID PKTJ', 'url' => 'https://ppid.pktj.ac.id/prosedur/sop-permintaan-informasi']
                ],
                'file_path' => 'https://ppid.pktj.ac.id/prosedur/sop-permintaan-informasi',
                'aktif' => true,
            ],
            [
                'judul' => 'Dokumen Terkait Bantuan Tugas Belajar',
                'deskripsi' => 'Regulasi, kuota rekomendasi, syarat pengajuan izin belajar dan tugas belajar bagi aparatur sipil negara dan dosen di lingkungan Politeknik Keselamatan Transportasi Jalan.',
                'pejabat_penguasa' => 'Subbagian Kepegawaian',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Dokumen Assesment di PKTJ Tegal',
                'deskripsi' => 'Pedoman, instrumen, dan rekapitulasi penilaian assessment center serta pemetaan kompetensi pegawai (talent pool) untuk pengisian jabatan pelaksana dan fungsional di PKTJ Tegal.',
                'pejabat_penguasa' => 'Subbag Kepegawaian / Tim Asesor',
                'penerbit_informasi' => 'PKTJ Tegal',
                'penanggung_jawab' => 'PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025/2026',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Dokumen Terkait Ujian Dinas',
                'deskripsi' => 'Surat edaran pemanggilan peserta, persyaratan administrasi, dan pengumuman hasil Ujian Dinas Tingkat I dan Tingkat II serta Ujian Penyesuaian Kenaikan Pangkat (UPKP) ASN.',
                'pejabat_penguasa' => 'Subbagian Kepegawaian',
                'penerbit_informasi' => 'BPSDMP / PKTJ Tegal',
                'penanggung_jawab' => 'BPSDMP / PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => '3 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Laporan Sistem Pengendalian Intern Pemerintah (SPIP)',
                'deskripsi' => 'Laporan penilaian tingkat maturitas penyelenggaraan SPIP, peta risiko unit kerja (risk register), pemantauan rencana aksi pengendalian, dan pencegahan fraud di PKTJ Tegal.',
                'pejabat_penguasa' => 'Satuan Pengawas Internal (SPI) / PPID',
                'penerbit_informasi' => 'Tim Satuan Pengawas Internal PKTJ',
                'penanggung_jawab' => 'Tim Satuan Pengawas Internal PKTJ',
                'bentuk_informasi' => 'Softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => '5 Tahun',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
        ];

        // =========================================================================
        // 3. INFORMASI SERTA MERTA (3 ITEM SESUAI HALAMAN 2 PDF KP-SKJ 9 TAHUN 2026)
        // =========================================================================
        $sertaMertaItems = [
            [
                'judul' => 'Perubahan Jadwal Layanan Publik di Lingkungan BPSDMP',
                'deskripsi' => 'Pemberitahuan darurat dan mendesak terkait penyesuaian atau perubahan jam operasional loket layanan publik, layanan permohonan informasi PPID, dan administrasi akademik di lingkungan BPSDMP / PKTJ Tegal pada kondisi kahar atau kebijakan khusus.',
                'pejabat_penguasa' => 'PPID PKTJ Tegal / Subbag Tata Usaha',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ Tegal',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy, Website & Media Sosial',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Relevan',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Pengumuman Gangguan Publik karena Aktivitas Sekolah di Lingkungan BPSDMP',
                'deskripsi' => 'Pemberitahuan segera kepada masyarakat dan lingkungan sekitar kampus PKTJ Tegal mengenai kegiatan taruna berskala besar (seperti parade, upacara pelantikan, atau latihan gabungan) yang berpotensi memengaruhi kelancaran lalulintas dan kenyamanan publik.',
                'pejabat_penguasa' => 'Bagian Administrasi Akademik dan Ketarunaan',
                'penerbit_informasi' => 'Humas PKTJ Tegal',
                'penanggung_jawab' => 'Humas PKTJ Tegal',
                'bentuk_informasi' => 'Softcopy, Website & Pengumuman Resmi',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Relevan',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
            [
                'judul' => 'Perubahan Alur Masuk Kendaraan Kantor Kementerian Perhubungan',
                'deskripsi' => 'Informasi seketika mengenai rekayasa sirkulasi kendaraan, penutupan gerbang sementara, pengalihan alur masuk/keluar tamu maupun aparatur di lingkungan kantor Kementerian Perhubungan / gerbang kampus PKTJ Tegal.',
                'pejabat_penguasa' => 'Subbagian Rumah Tangga dan BMN',
                'penerbit_informasi' => 'Bagian Keuangan dan Umum',
                'penanggung_jawab' => 'Bagian Keuangan dan Umum',
                'bentuk_informasi' => 'Softcopy, Infografis & Papan Pengumuman',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2026',
                'jangka_waktu' => 'Selama Relevan',
                'tautan_links' => [],
                'file_path' => null,
                'aktif' => true,
            ],
        ];

        // -------------------------------------------------------------------------
        // SEEDING DATABASE: BERKALA
        // -------------------------------------------------------------------------
        echo "Menyimpan data Informasi Berkala (25 items)...\n";
        // Bersihkan data lama di informasi_berkalas dan daftar_informasis kategori berkala
        InformasiBerkala::query()->delete();
        DaftarInformasi::where('kategori', 'informasi-berkala')->delete();

        foreach ($berkalaItems as $data) {
            InformasiBerkala::create($data);

            DaftarInformasi::create([
                'judul_informasi' => $data['judul'],
                'kategori' => 'informasi-berkala',
                'tipe_informasi' => 'berkala',
                'isi_informasi' => $data['deskripsi'],
                'pejabat_penguasa' => $data['pejabat_penguasa'],
                'penanggung_jawab' => $data['penanggung_jawab'],
                'penerbit_informasi' => $data['penerbit_informasi'],
                'bentuk_informasi' => $data['bentuk_informasi'],
                'tempat_pembuatan' => $data['tempat_pembuatan'],
                'waktu_pembuatan' => $data['waktu_pembuatan'],
                'jangka_waktu' => $data['jangka_waktu'],
                'file_informasi' => $data['file_path'],
                'tautan_links' => $data['tautan_links'],
                'aktif' => $data['aktif'],
                'bisa_download' => true,
            ]);
        }

        // -------------------------------------------------------------------------
        // SEEDING DATABASE: SETIAP SAAT
        // -------------------------------------------------------------------------
        echo "Menyimpan data Informasi Setiap Saat (10 items)...\n";
        InformasiSetiapSaat::query()->delete();
        DaftarInformasi::whereIn('kategori', ['informasi-setiap-saat', 'informasi-setiapsaat'])->delete();

        foreach ($setiapSaatItems as $data) {
            InformasiSetiapSaat::create($data);

            DaftarInformasi::create([
                'judul_informasi' => $data['judul'],
                'kategori' => 'informasi-setiap-saat',
                'tipe_informasi' => 'setiap-saat',
                'isi_informasi' => $data['deskripsi'],
                'pejabat_penguasa' => $data['pejabat_penguasa'],
                'penanggung_jawab' => $data['penanggung_jawab'],
                'penerbit_informasi' => $data['penerbit_informasi'],
                'bentuk_informasi' => $data['bentuk_informasi'],
                'tempat_pembuatan' => $data['tempat_pembuatan'],
                'waktu_pembuatan' => $data['waktu_pembuatan'],
                'jangka_waktu' => $data['jangka_waktu'],
                'file_informasi' => $data['file_path'],
                'tautan_links' => $data['tautan_links'],
                'aktif' => $data['aktif'],
                'bisa_download' => true,
            ]);
        }

        // -------------------------------------------------------------------------
        // SEEDING DATABASE: SERTA MERTA
        // -------------------------------------------------------------------------
        echo "Menyimpan data Informasi Serta Merta (3 items)...\n";
        InformasiSertaMerta::query()->delete();
        DaftarInformasi::whereIn('kategori', ['informasi-serta-merta', 'informasi-sertamerta'])->delete();

        foreach ($sertaMertaItems as $data) {
            InformasiSertaMerta::create($data);

            DaftarInformasi::create([
                'judul_informasi' => $data['judul'],
                'kategori' => 'informasi-serta-merta',
                'tipe_informasi' => 'serta-merta',
                'isi_informasi' => $data['deskripsi'],
                'pejabat_penguasa' => $data['pejabat_penguasa'],
                'penanggung_jawab' => $data['penanggung_jawab'],
                'penerbit_informasi' => $data['penerbit_informasi'],
                'bentuk_informasi' => $data['bentuk_informasi'],
                'tempat_pembuatan' => $data['tempat_pembuatan'],
                'waktu_pembuatan' => $data['waktu_pembuatan'],
                'jangka_waktu' => $data['jangka_waktu'],
                'file_informasi' => $data['file_path'],
                'tautan_links' => $data['tautan_links'],
                'aktif' => $data['aktif'],
                'bisa_download' => true,
            ]);
        }

        echo "Berhasil seeding DIP 2026: 25 Berkala, 10 Setiap Saat, 3 Serta Merta!\n";
    }
}
