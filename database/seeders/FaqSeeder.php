<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'pertanyaan' => 'Apa itu PPID?',
                'jawaban' => 'PPID adalah singkatan dari Pejabat Pengelola Informasi dan Dokumentasi. PPID adalah pejabat yang bertanggung jawab di bidang penyimpanan, pendokumentasian, penyediaan, dan/atau pelayanan informasi di badan publik sesuai dengan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.',
                'aktif' => true,
            ],
            [
                'pertanyaan' => 'Apa tugas PPID?',
                'jawaban' => 'PPID bertugas untuk menyimpan, mendokumentasikan, menyediakan, dan/atau melayani permintaan informasi publik; membuat dan mengembangkan sistem informasi dan dokumentasi; mengkoordinasikan pengumpulan bahan informasi dan dokumentasi; serta menyediakan informasi dan dokumentasi yang diperlukan oleh masyarakat.',
                'aktif' => true,
            ],
            [
                'pertanyaan' => 'Bagaimana cara mengajukan permintaan informasi?',
                'jawaban' => '<p>Permintaan informasi dapat diajukan melalui beberapa cara:</p><ul><li>Mengisi formulir permohonan informasi online di website PPID</li><li>Datang langsung ke kantor PPID dengan membawa identitas diri</li><li>Mengirim surat permohonan ke alamat PPID</li><li>Menghubungi hotline PPID untuk informasi awal</li></ul>',
                'aktif' => true,
            ],
            [
                'pertanyaan' => 'Berapa lama waktu penyelesaian permintaan informasi?',
                'jawaban' => '<p>Berdasarkan Undang-Undang KIP, waktu penyelesaian permintaan informasi adalah:</p><ul><li>Maksimal 10 hari kerja untuk informasi yang tersedia dan dapat langsung diberikan</li><li>Maksimal 30 hari kerja untuk informasi yang perlu pencarian dan/atau penyiapan</li><li>Dapat diperpanjang maksimal 30 hari kerja dengan pemberitahuan tertulis</li></ul>',
                'aktif' => true,
            ],
            [
                'pertanyaan' => 'Apakah ada biaya untuk mendapatkan informasi?',
                'jawaban' => '<p>Untuk permintaan informasi yang berkaitan dengan kepentingan umum, PPID memberikan informasi tanpa biaya. Namun, untuk permintaan informasi yang memerlukan penggandaan atau pengiriman dokumen, pemohon informasi dapat dikenakan biaya sesuai dengan Standar Biaya Pelayanan Informasi Publik yang telah ditetapkan.</p><p>Biaya yang mungkin dikenakan meliputi:</p><ul><li>Biaya penggandaan dokumen</li><li>Biaya pengiriman dokumen</li><li>Biaya penyediaan media penyimpanan</li></ul>',
                'aktif' => true,
            ],
            [
                'pertanyaan' => 'Informasi apa saja yang tidak dapat diakses?',
                'jawaban' => '<p>Informasi yang dikecualikan dari keterbukaan informasi publik meliputi:</p><ul><li>Informasi yang dapat membahayakan negara</li><li>Informasi yang berkaitan dengan rahasia dagang</li><li>Informasi yang berkaitan dengan hak kekayaan intelektual</li><li>Informasi yang berkaitan dengan data pribadi</li><li>Informasi yang masih dalam proses pengolahan</li></ul><p>Pengecualian informasi harus berdasarkan alasan yang sah dan tidak bersifat mutlak.</p>',
                'aktif' => true,
            ],
            [
                'pertanyaan' => 'Apa yang harus dilakukan jika permintaan informasi ditolak?',
                'jawaban' => '<p>Jika permintaan informasi ditolak, pemohon informasi dapat:</p><ul><li>Mengajukan keberatan kepada PPID dalam waktu 30 hari kerja</li><li>Mengajukan sengketa informasi ke Komisi Informasi</li><li>Mengajukan gugatan ke Pengadilan Tata Usaha Negara</li></ul><p>Proses keberatan dan sengketa informasi diatur dalam Undang-Undang KIP dan peraturan pelaksanaannya.</p>',
                'aktif' => true,
            ],
            [
                'pertanyaan' => 'Kapan jam kerja PPID?',
                'jawaban' => '<p>PPID PKTJ melayani permintaan informasi pada hari dan jam kerja sebagai berikut:</p><ul><li><strong>Hari kerja:</strong> Senin - Jumat</li><li><strong>Jam kerja:</strong> 08:00 - 16:00 WIB</li><li><strong>Istirahat:</strong> 12:00 - 13:00 WIB</li><li><strong>Hari libur:</strong> Sabtu, Minggu, dan hari libur nasional</li></ul><p>Untuk keadaan darurat, dapat menghubungi hotline PPID 24 jam.</p>',
                'aktif' => true,
            ],
            [
                'pertanyaan' => 'Bagaimana cara menghubungi PPID?',
                'jawaban' => '<p>PPID PKTJ dapat dihubungi melalui berbagai kanal:</p><p><strong>Alamat Kantor:</strong> Jl. Medan Merdeka Barat No. 8, Jakarta Pusat 10110, Indonesia</p><p><strong>Kontak:</strong></p><ul><li>Telp: (021) 3847790</li><li>Fax: (021) 3847791</li><li>Email: ppid@pktj.dephub.go.id</li></ul>',
                'aktif' => true,
            ],
            [
                'pertanyaan' => 'Apa saja jenis informasi publik yang tersedia?',
                'jawaban' => '<p>Jenis informasi publik yang tersedia di PPID PKTJ meliputi:</p><ul><li><strong>Informasi Berkala:</strong> Laporan tahunan, laporan keuangan, profil organisasi</li><li><strong>Informasi Serta Merta:</strong> Informasi yang berkaitan dengan hajat hidup orang banyak</li><li><strong>Informasi Setiap Saat:</strong> Daftar informasi publik, maklumat pelayanan</li><li><strong>Informasi Dikecualikan:</strong> Informasi yang dikecualikan berdasarkan alasan yang sah</li></ul>',
                'aktif' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['pertanyaan' => $faq['pertanyaan']],
                $faq
            );
        }
    }
}
