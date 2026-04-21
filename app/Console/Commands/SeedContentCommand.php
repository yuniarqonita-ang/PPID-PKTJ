<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProfilPpid;
use Illuminate\Support\Facades\DB;

class SeedContentCommand extends Command
{
    protected $signature = 'db:seed-content';
    protected $description = 'Seed all public pages with realistic dummy content';

    public function handle()
    {
        $this->info('Starting content seeding...');

        // 1. Profil PPID Content
        $profil_types = [
            'profil' => [
                'judul' => 'Profil PPID PKTJ',
                'konten_pembuka' => '<p>Pejabat Pengelola Informasi dan Dokumentasi (PPID) Politeknik Keselamatan Transportasi Jalan (PKTJ) dibentuk sebagai perwujudan komitmen kami terhadap transparansi dan akuntabilitas publik. Melalui PPID, kami memastikan bahwa masyarakat memiliki akses yang mudah, cepat, dan transparan terhadap informasi publik terkait kegiatan, layanan, dan kebijakan di lingkungan PKTJ.</p>',
                'gambaran' => '<p>Pelayanan informasi publik PPID PKTJ mengacu pada Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik (KIP). Kami telah mengintegrasikan berbagai platform digital untuk memberikan respon tercepat bagi masyarakat yang membutuhkan data maupun dokumen dari kampus kami.</p>',
            ],
            'tugas' => [
                'judul' => 'Tugas & Tanggung Jawab',
                'konten_pembuka' => '<p>Sesuai dengan amanat Undang-Undang Keterbukaan Informasi Publik, PPID memiliki berbagai tugas strategis dalam pengelolaan informasi di tingkat instansi.</p>',
                'gambaran' => '<ul><li>Mengkoordinasikan penyimpanan dan pendokumentasian seluruh informasi publik di PKTJ.</li><li>Menyediakan dan melayani permintaan informasi sesuai prosedur.</li><li>Melakukan uji konsekuensi sebelum informasi tertentu ditetapkan sebagai informasi yang dikecualikan.</li></ul>',
            ],
            'visi' => [
                'judul' => 'Visi & Misi',
                'konten_pembuka' => '<p><strong>Visi Kami:</strong> Menjadi Layanan Informasi Publik Terdepan, Transparan, dan Responsif secara Nasional.</p>',
                'gambaran' => '<p><strong>Misi Kami:</strong></p><ol><li>Meningkatkan standar kualitas pelayanan informasi publik.</li><li>Memperkuat infrastruktur pengelola informasi.</li><li>Menjamin akses cepat bagi setiap lapisan masyarakat.</li></ol>',
            ],
            'struktur' => [
                'judul' => 'Struktur Organisasi PPID',
                'konten_pembuka' => '<p>Struktur Organisasi PPID PKTJ dibentuk untuk memastikan jalur koordinasi pelayanan informasi berjalan secara efektif.</p>',
                'gambaran' => '<p>PPID PKTJ diketuai oleh Direktur Politeknik Keselamatan Transportasi Jalan selaku Atasan PPID, dibantu oleh unit-unit pendukung yang kompeten di bidang data dan kehumasan, mencakup Bagian Akademik, Pengembangan Teknologi, dan Pengawasan.</p>',
            ],
            'regulasi' => [
                'judul' => 'Regulasi Acuan PPID',
                'konten_pembuka' => '<p>Layanan Informasi Publik PPID PKTJ dijalankan sesuai dengan dasar-dasar hukum yang berlaku di Negara Kesatuan Republik Indonesia.</p>',
                'gambaran' => '<ul><li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</li><li>Peraturan Pemerintah Nomor 61 Tahun 2010.</li><li>Peraturan Komisi Informasi (Perki) Nomor 1 Tahun 2021.</li></ul>',
            ],
            'kontak' => [
                'judul' => 'Hubungi Kami',
                'konten_pembuka' => '<p>Kami siap membantu Anda terkait permintaan informasi publik, pengajuan keberatan, dan panduan regulasi. Jangan ragu menghubungi PPID PKTJ.</p>',
                'gambaran' => '<p><strong>Alamat:</strong> Jl. Perintis Kemerdekaan No. 17, Tegal, Jawa Tengah.<br><strong>Email:</strong> info@pktj.ac.id<br><strong>Telepon:</strong> (0283) 351061</p>',
            ],
        ];

        foreach ($profil_types as $type => $data) {
            ProfilPpid::updateOrCreate(
                ['type' => $type],
                [
                    'judul' => $data['judul'],
                    'konten_pembuka' => $data['konten_pembuka'],
                    'gambaran' => $data['gambaran'],
                ]
            );
        }

        $this->info('   - Profil PPID (6 modules) seeded.');

        // 2. Dashboards Content (Prefixed variables for SOP & Laporan)
        $dashboard_prefixes = [
            'sop_permintaan' => 'SOP Permintaan Informasi',
            'sop_keberatan' => 'SOP Penanganan Keberatan',
            'sop_sengketa' => 'SOP Pengajuan Sengketa',
            'sop_pemutakhiran' => 'SOP Penetapan dan Pemutakhiran Daftar Informasi',
            'sop_pengujian' => 'SOP Pengujian Konsekuensi',
            'sop_pendokumentasian' => 'SOP Pendokumentasian Informasi',
            'daftar_informasi' => 'Daftar Informasi Publik',
            'maklumat' => 'Maklumat Pelayanan',
            'laporan_layanan' => 'Laporan Layanan Informasi Publik',
            'laporan_akses' => 'Laporan Akses Informasi Publik',
            'laporan_survey' => 'Laporan Survey Kepuasan Masyarakat',
        ];

        foreach ($dashboard_prefixes as $pfx => $title) {
            $keys = [
                $pfx . '_judul_maklumat' => $title,
                $pfx . '_isi_maklumat' => '<p>Halaman ini menampilkan regulasi dan dokumen tata laksana mengenai <strong>' . $title . '</strong> pada lingkungan PKTJ. Kami memastikan proses dilaksanakan dengan cermat dan transparan mengikuti pedoman Keterbukaan Informasi.</p>',
                $pfx . '_judul_standar' => 'Ketentuan Waktu & Biaya',
                $pfx . '_isi_standar' => '<p>Berdasarkan Standar Operasional Prosedur, proses ini dapat memakan waktu antara 1 hingga 10 hari kerja. Segala layanan terkait ini di PKTJ <strong>Tidak Dipungut Biaya (Rp 0,-)</strong>.</p>',
                $pfx . '_judul_konten' => 'Dokumentasi & Regulasi Tambahan',
                $pfx . '_isi_konten' => '<p>Masyarakat dapat mengunduh panduan regulasi resmi terkait proses ini melalui aplikasi E-PPID atau mengajukan permohonan pendampingan langsung pada bagian kehumasan.</p>',
                $pfx . '_youtube_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
            ];

            foreach ($keys as $key => $val) {
                DB::table('dashboards')->updateOrInsert(
                    ['key' => $key],
                    [
                        'value' => $val,
                        'type' => 'text',
                        'aktif' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }
        }
        $this->info('   - SOP & Laporan (11 modules) seeded.');
        $this->info('Database perfectly updated with dummy real-like structure!');
    }
}
