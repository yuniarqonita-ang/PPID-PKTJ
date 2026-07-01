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
        $updates = [
            // LHKPN & DIP
            'Daftar Pejabat wajib lapor LHKPN' => 'https://drive.google.com/file/d/1PhdbeBEQomur7WNVbBi9lQjWsiE9YZkw/view?usp=sharing',
            'Daftar Informasi Publik' => 'https://drive.google.com/file/d/12shaENmT8JCNwJh6cEYkTWPtDsslIddw/view?usp=sharing',
            
            // Informasi Berkala
            'Laporan Tahunan' => 'https://drive.google.com/file/d/1qucNCvXKKfXm8XjP14hRYRE0buqa2vKD/preview',
            'Laporan Keuangan PKTJ' => 'https://drive.google.com/file/d/14CjipeveVY9PW6m_MTnPe7teg2SBpZtH/view',
            'RKA-KL PKTJ Tahun 2025' => 'https://drive.google.com/file/d/1kvTsbixaGktfweb2tZX8fLLC2-eum1nR/view?usp=sharing',
            'Rencana Kerja Anggaran Tahun 2024' => 'https://drive.google.com/file/d/1RVEQDDnIlkzTe3qPA_M7UqBxxN7VhVoM/view?usp=drive_link',
            
            // Informasi Serta Merta
            'Informasi Sipencatar' => 'https://www.instagram.com/p/DJqxqBLx-lC/?utm_source=ig_web_copy_link',
            
            // Tata Cara dan Alur (Setiap Saat)
            'Alur Prosedur Pelayanan Informasi' => 'https://drive.google.com/file/d/1G71ZDO6RrKKEIr9aQVfqH4630ea1LCh3/preview',
            'Tata cara permohonan informasi publik dan pengajuan keberatan informasi publik' => 'https://drive.google.com/file/d/1sjF0QKjH-widyTW-yETYEdxa_NosU20s/preview',
            
            // Kerjasama & Unit Kerja
            'Leaflet Diklat PKTJ' => 'https://drive.google.com/file/d/1dJCR5jags9W8LJCpkq2x5Uj20j-DAkq6/view?usp=sharing',
            'Proposal Penjajakan Kerjasama' => 'https://drive.google.com/file/d/1vlSRZIPLlKuopUbcY_f6ydTzWSZYABAY/view?usp=sharing',
            'SPI Charter' => 'https://drive.google.com/file/d/1hmHpZ2rY7Y8TU74s7gy5bVhxKmvfxbO8/view',
            'SOP Pelaporan Kegiatan' => 'https://drive.google.com/file/d/1rjOLvAAZi4Df5JbYUI7ehqkIA0SxJmp7/view',
            'SOP Audit Kinerja' => 'https://drive.google.com/file/d/1MrFh943kq-nfi5KogndwEfsBw6ePkP74/view',
            'SOP Pengusulan Diklat' => 'https://drive.google.com/file/d/18MVB1TaWjESUO-ngOYIFUB6hqks5A6Ub/view',
            'Tes TOEFL PKTJ' => 'https://drive.google.com/file/d/1YfUhBjZLJRFg8jCB76nU8hG1JZ4uevsq/view',
        ];

        foreach ($updates as $judul => $url) {
            DB::table('daftar_informasis')
                ->where('judul_informasi', $judul)
                ->update(['file_informasi' => $url]);
        }

        // Add additional list documents if not exists
        $additionalDocs = [
            [
                'judul_informasi' => 'Daftar Informasi Berkala',
                'kategori' => 'informasi-berkala',
                'tipe_informasi' => 'berkala',
                'isi_informasi' => 'Daftar dokumen Informasi Berkala PKTJ',
                'file_informasi' => 'https://drive.google.com/file/d/1MC9k99dV__GAKtB-6wa4hXvnw_dgJtCG/view?usp=sharing',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => 'Selama masih berlaku',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
            ],
            [
                'judul_informasi' => 'Daftar Informasi Serta Merta',
                'kategori' => 'informasi-serta-merta',
                'tipe_informasi' => 'sertamerta',
                'isi_informasi' => 'Daftar dokumen Informasi Serta Merta PKTJ',
                'file_informasi' => 'https://drive.google.com/file/d/1DpLpKanHyGKysxxW2DIbUMiRVR74Cpws/view?usp=sharing',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => 'Selama masih berlaku',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
            ],
            [
                'judul_informasi' => 'Daftar Informasi Setiap Saat',
                'kategori' => 'informasi-setiap-saat',
                'tipe_informasi' => 'setiapsaat',
                'isi_informasi' => 'Daftar dokumen Informasi Setiap Saat PKTJ',
                'file_informasi' => 'https://drive.google.com/file/d/1EQEiWLqzJ7O6KTxw7bAlRdJQX3bsbNRR/view?usp=sharing',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => 'Selama masih berlaku',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
            ],
            [
                'judul_informasi' => 'Daftar Informasi Dikecualikan',
                'kategori' => 'informasi-setiap-saat', // Or dikecualikan
                'tipe_informasi' => 'setiapsaat',
                'isi_informasi' => 'Daftar dokumen Informasi Dikecualikan PKTJ',
                'file_informasi' => 'https://drive.google.com/file/d/1OsgYkgEeCjHrSRn5lU5wMdz-h0YrA3mR/view?usp=sharing',
                'pejabat_penguasa' => 'PPID',
                'penerbit_informasi' => 'PPID Pelaksana UPT PKTJ',
                'bentuk_informasi' => 'softcopy',
                'tempat_pembuatan' => 'Tegal',
                'waktu_pembuatan' => '2025',
                'jangka_waktu' => 'Selama masih berlaku',
                'penanggung_jawab' => 'PPID Pelaksana UPT PKTJ',
                'aktif' => true,
            ]
        ];

        foreach ($additionalDocs as $doc) {
            $exists = DB::table('daftar_informasis')
                ->where('judul_informasi', $doc['judul_informasi'])
                ->where('kategori', $doc['kategori'])
                ->exists();
            if (!$exists) {
                DB::table('daftar_informasis')->insert($doc);
            } else {
                DB::table('daftar_informasis')
                    ->where('judul_informasi', $doc['judul_informasi'])
                    ->where('kategori', $doc['kategori'])
                    ->update(['file_informasi' => $doc['file_informasi']]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't delete on down to prevent data loss
    }
};
