<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Dip2026SyncSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure columns exist on pejabats
        if (Schema::hasTable('pejabats')) {
            if (!Schema::hasColumn('pejabats', 'lhkpn_links')) {
                Schema::table('pejabats', function ($table) {
                    $table->json('lhkpn_links')->nullable();
                });
            }
            if (!Schema::hasColumn('pejabats', 'foto_width')) {
                Schema::table('pejabats', function ($table) {
                    $table->integer('foto_width')->nullable()->default(160);
                    $table->integer('foto_height')->nullable()->default(240);
                    $table->integer('foto_card_height')->nullable()->default(390);
                    $table->string('foto_position')->nullable()->default('top center');
                    $table->string('foto_radius')->nullable()->default('14px');
                });
            }
            DB::table('pejabats')->where('id', 6)->orWhere('nama', 'like', '%Agus Hariyanto%')
                ->update(['jabatan' => 'Kepala Bagian Keuangan dan Administrasi Umum']);
        }

        // 2. Clean dummy Laporan Layanan and any unverified dokumens in dokumens
        if (Schema::hasTable('dokumens')) {
            DB::table('dokumens')
                ->whereIn('kategori', ['Laporan Layanan', 'Laporan Akses', 'Laporan Tahunan'])
                ->delete();
            DB::table('dokumens')
                ->where('judul', 'like', '%Laporan Permohonan Informasi%')
                ->orWhere('judul', 'like', '%Laporan Tahunan%')
                ->delete();
        }

        // 3. Clean unverified rows from informasi_berkalas (keep only DIPA)
        if (Schema::hasTable('informasi_berkalas')) {
            DB::table('informasi_berkalas')->where('file_path', 'not like', '%DIPA%')->delete();
        }

        // 4. Clean unverified rows from informasi_sertamertas
        if (Schema::hasTable('informasi_sertamertas')) {
            DB::table('informasi_sertamertas')->delete();
        }

        // 5. Clean unverified rows from daftar_informasis (keep informasi-dikecualikan)
        if (Schema::hasTable('daftar_informasis')) {
            DB::table('daftar_informasis')->where('kategori', '!=', 'informasi-dikecualikan')->delete();
        }

        // 6. Load the 50 verified items from JSON
        $jsonBerkalaPath = base_path('scratch/extracted_excel_items.json');
        $jsonSertaMertaPath = base_path('scratch/sertamerta_items.json');

        if (file_exists($jsonBerkalaPath)) {
            $data = json_decode(file_get_contents($jsonBerkalaPath), true);
            
            // Insert Berkala (20 items)
            if (!empty($data['berkala'])) {
                foreach ($data['berkala'] as $item) {
                    $firstLabel = trim(explode("\n", $item['label'])[0]);
                    if (empty($firstLabel)) $firstLabel = $item['judul'];

                    $labelLines = array_filter(array_map('trim', explode("\n", $item['label'])));
                    $linksHtml = '';
                    if (count($labelLines) > 1) {
                        $linksHtml .= '<ul style="margin: 8px 0 0 0; padding-left: 20px; font-size: 13px; line-height: 1.8;">';
                        foreach (array_slice($labelLines, 0, 5) as $line) {
                            $linksHtml .= '<li><a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 600;">' . htmlspecialchars($line) . ' (Klik di Sini)</a></li>';
                        }
                        if (count($labelLines) > 5) {
                            $linksHtml .= '<li><em>... dan ' . (count($labelLines) - 5) . ' dokumen lainnya:</em></li>';
                            $linksHtml .= '<li><a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700;">Buka Seluruh Berkas Dokumen (Google Drive)</a></li>';
                        }
                        $linksHtml .= '</ul>';
                    } else {
                        $linksHtml = '<a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700; display: inline-block; margin-top: 6px;">' .
                            '<i class="fas fa-external-link-alt" style="margin-right: 6px;"></i> ' . htmlspecialchars($firstLabel) . ' (Klik di Sini)' .
                            '</a>';
                    }

                    $richContent = '<p>' . htmlspecialchars($item['ringkasan']) . '</p>' .
                        '<div style="margin-top: 14px; padding: 14px 18px; background-color: #f0f7ff; border-left: 4px solid #004a99; border-radius: 8px;">' .
                        '<p style="margin: 0; font-size: 14px; color: #1e293b;">' .
                        '<strong>Tautan Dokumen Resmi Google Drive:</strong><br>' .
                        $linksHtml .
                        '</p>' .
                        '</div>';

                    DB::table('daftar_informasis')->insert([
                        'judul_informasi'    => $item['judul'],
                        'kategori'           => 'informasi-berkala',
                        'tipe_informasi'     => 'dokumen',
                        'isi_informasi'      => $richContent,
                        'pejabat_penguasa'   => $item['pejabat'] ?: 'Direktur & Manajemen PKTJ',
                        'penerbit_informasi' => $item['penerbit'] ?: 'PKTJ Tegal',
                        'tempat_pembuatan'   => 'Tegal',
                        'penanggung_jawab'   => $item['pejabat'] ?: 'Ka Tim Substansi',
                        'waktu_pembuatan'    => $item['waktu'] ?: 'Tegal, 2025/2026',
                        'bentuk_informasi'   => $item['bentuk'] ?: 'Softcopy',
                        'jangka_waktu'       => $item['retensi'] ?: 'Selama berlaku',
                        'file_informasi'     => $item['link'],
                        'aktif'              => 1,
                        'is_blurred'         => 0,
                        'bisa_download'      => 1,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ]);
                }
            }

            // Insert Setiap Saat (19 items)
            if (!empty($data['setiapsaat'])) {
                foreach ($data['setiapsaat'] as $item) {
                    $firstLabel = trim(explode("\n", $item['label'])[0]);
                    if (empty($firstLabel)) $firstLabel = $item['judul'];

                    $labelLines = array_filter(array_map('trim', explode("\n", $item['label'])));
                    $linksHtml = '';
                    if (count($labelLines) > 1) {
                        $linksHtml .= '<ul style="margin: 8px 0 0 0; padding-left: 20px; font-size: 13px; line-height: 1.8;">';
                        foreach (array_slice($labelLines, 0, 5) as $line) {
                            $linksHtml .= '<li><a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 600;">' . htmlspecialchars($line) . ' (Klik di Sini)</a></li>';
                        }
                        if (count($labelLines) > 5) {
                            $linksHtml .= '<li><em>... dan ' . (count($labelLines) - 5) . ' dokumen lainnya:</em></li>';
                            $linksHtml .= '<li><a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700;">Buka Seluruh Berkas Dokumen (Google Drive)</a></li>';
                        }
                        $linksHtml .= '</ul>';
                    } else {
                        $linksHtml = '<a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700; display: inline-block; margin-top: 6px;">' .
                            '<i class="fas fa-external-link-alt" style="margin-right: 6px;"></i> ' . htmlspecialchars($firstLabel) . ' (Klik di Sini)' .
                            '</a>';
                    }

                    $richContent = '<p>' . htmlspecialchars($item['ringkasan']) . '</p>' .
                        '<div style="margin-top: 14px; padding: 14px 18px; background-color: #f0f7ff; border-left: 4px solid #004a99; border-radius: 8px;">' .
                        '<p style="margin: 0; font-size: 14px; color: #1e293b;">' .
                        '<strong>Tautan Dokumen Resmi Google Drive:</strong><br>' .
                        $linksHtml .
                        '</p>' .
                        '</div>';

                    $fullJudul = $item['judul'];
                    if (in_array(strtolower($item['judul']), ['dokumen kurikulum', 'kegiatan pembelajaran teaching factory (tefa)', 'kontrak', 'mou', 'perjanjian kerja sama', 'spk/spmk (surat perjanjian kerja)/(surat perintah mulai kerja)'])) {
                        $shortLabel = preg_replace('/(\.pdf|_tersensor|_fix|\(informasi publik\))/i', '', $firstLabel);
                        $fullJudul = $item['judul'] . ' - ' . trim($shortLabel);
                    }

                    DB::table('daftar_informasis')->insert([
                        'judul_informasi'    => $fullJudul,
                        'kategori'           => 'informasi-setiap-saat',
                        'tipe_informasi'     => 'dokumen',
                        'isi_informasi'      => $richContent,
                        'pejabat_penguasa'   => $item['pejabat'] ?: 'Direktur & Manajemen PKTJ',
                        'penerbit_informasi' => $item['penerbit'] ?: 'PKTJ Tegal',
                        'tempat_pembuatan'   => 'Tegal',
                        'penanggung_jawab'   => $item['pejabat'] ?: 'Ka Tim Substansi',
                        'waktu_pembuatan'    => $item['waktu'] ?: 'Tegal, 2025/2026',
                        'bentuk_informasi'   => $item['bentuk'] ?: 'Softcopy',
                        'jangka_waktu'       => $item['retensi'] ?: 'Selama berlaku',
                        'file_informasi'     => $item['link'],
                        'aktif'              => 1,
                        'is_blurred'         => 0,
                        'bisa_download'      => 1,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ]);
                }
            }
        }

        // Insert Serta Merta (11 items)
        if (file_exists($jsonSertaMertaPath)) {
            $sertaItems = json_decode(file_get_contents($jsonSertaMertaPath), true);
            if (!empty($sertaItems)) {
                foreach ($sertaItems as $item) {
                    $firstLabel = trim(explode("\n", $item['label'])[0]);
                    if (empty($firstLabel)) $firstLabel = $item['judul'];

                    $richContent = '<p>' . htmlspecialchars($item['ringkasan']) . '</p>' .
                        '<div style="margin-top: 14px; padding: 14px 18px; background-color: #f0f7ff; border-left: 4px solid #004a99; border-radius: 8px;">' .
                        '<p style="margin: 0; font-size: 14px; color: #1e293b;">' .
                        '<strong>Tautan Dokumen Resmi Google Drive:</strong><br>' .
                        '<a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700; display: inline-block; margin-top: 6px;">' .
                        '<i class="fas fa-external-link-alt" style="margin-right: 6px;"></i> ' . htmlspecialchars($firstLabel) . ' (Klik di Sini)' .
                        '</a>' .
                        '</p>' .
                        '</div>';

                    DB::table('daftar_informasis')->insert([
                        'judul_informasi'    => $item['judul'],
                        'kategori'           => 'informasi-serta-merta',
                        'tipe_informasi'     => 'dokumen',
                        'isi_informasi'      => $richContent,
                        'pejabat_penguasa'   => $item['pejabat'] ?: 'Direktur & Manajemen PKTJ',
                        'penerbit_informasi' => $item['penerbit'] ?: 'PKTJ Tegal',
                        'tempat_pembuatan'   => 'Tegal',
                        'penanggung_jawab'   => $item['pejabat'] ?: 'Ka Tim Substansi',
                        'waktu_pembuatan'    => $item['waktu'] ?: 'Tegal, 2025/2026',
                        'bentuk_informasi'   => $item['bentuk'] ?: 'Softcopy',
                        'jangka_waktu'       => $item['retensi'] ?: 'Selama berlaku',
                        'file_informasi'     => $item['link'],
                        'aktif'              => 1,
                        'is_blurred'         => 0,
                        'bisa_download'      => 1,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ]);
                }
            }
        }

        // 7. Insert the 23 newly published items verified with User Google Drive links
        $newVerified23 = [
            // INFORMASI BERKALA (3)
            [
                'judul' => 'DIPA Petikan PKTJ Tahun Anggaran 2025 (Revisi 08)',
                'kategori' => 'informasi-berkala',
                'link' => 'https://drive.google.com/file/d/1hLQ-26Oko2u1uve8jD9NMbNknRnyLD_W/view?usp=drive_link',
                'deskripsi' => 'Dokumen Isian Pelaksanaan Anggaran (DIPA) Petikan PKTJ Tahun Anggaran 2025 Revisi 08 memuat rincian alokasi belanja modal, pegawai, dan operasional.',
                'pejabat' => 'Bagian Keuangan dan Administrasi Umum'
            ],
            [
                'judul' => 'Surat Keputusan (SK) Penetapan PPID Pelaksana UPT PKTJ',
                'kategori' => 'informasi-berkala',
                'link' => 'https://drive.google.com/file/d/16_4Pmme_pWLgafTXlmBU0uuS82qs5RhP/view?usp=sharing',
                'deskripsi' => 'Surat Keputusan Direktur PKTJ tentang Pengangkatan dan Penetapan Struktur Organisasi Pengelola Layanan PPID Pelaksana UPT PKTJ Tegal.',
                'pejabat' => 'Subbagian Tata Usaha & Kepegawaian'
            ],
            [
                'judul' => 'Laporan Pelaksanaan Uji Kompetensi Pemeliharaan Jalan (PKS Kerjasama)',
                'kategori' => 'informasi-berkala',
                'link' => 'https://drive.google.com/file/d/1NhA8-ImFldPpGCTGJm0YzEnmSK4zgJnn/view?usp=sharing',
                'deskripsi' => 'Laporan pelaksanaan kegiatan uji kompetensi pemeliharaan jalan berkala hasil kerjasama program vokasi PKTJ.',
                'pejabat' => 'Program Studi RSTJ / UPU'
            ],

            // INFORMASI SETIAP SAAT (12)
            [
                'judul' => 'Daftar Informasi Dikecualikan (DIK) PKTJ & Berita Acara Uji Konsekuensi',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1ZfOIvQmVyoZElh8eTwEER71hSEJ7__Z7/view?usp=sharing',
                'deskripsi' => 'Dokumen penetapan Daftar Informasi yang Dikecualikan di lingkungan PKTJ Tegal beserta Berita Acara Uji Konsekuensi berdasarkan Pasal 17 UU No. 14 Tahun 2008.',
                'pejabat' => 'Tim Penguji Konsekuensi PPID PKTJ'
            ],
            [
                'judul' => 'Kontrak Pengujian Ketidakrataan dan Kekesatan Jalan Tol Ruas PT PPTR Tahun 2025',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1LUoIDHDwphNHlW6a0lx1v1waAobKJPxy/view?usp=sharing',
                'deskripsi' => 'Dokumen pokok perjanjian kontrak pengujian teknis kekesatan dan ketidakrataan jalan tol antara PKTJ dengan PT Pejagan Pemalang Toll Road.',
                'pejabat' => 'Pejabat Pembuat Komitmen (PPK) / UPU'
            ],
            [
                'judul' => 'Kontrak Swakelola Inspeksi Keselamatan Jalan Dishub Kab. Bandung (Hawkeye 2025)',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1NmYWYE96Zdx_sFvKxdKAoh0BsNqnywsa/view?usp=sharing',
                'deskripsi' => 'Surat perjanjian swakelola pengujian dan inspeksi keselamatan jalan menggunakan unit kendaraan penguji Hawkeye 2000.',
                'pejabat' => 'Unit Pengembangan Usaha (UPU)'
            ],
            [
                'judul' => 'Kontrak Swakelola Penyusunan Dokumen RAK Dishub Kabupaten Blitar 2025',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1ctmA-YvFXbYMcvUH13Th1Rha3mWcdWnK/view?usp=drive_link',
                'deskripsi' => 'Dokumen perjanjian kerjasama penyusunan dokumen Rencana Aksi Keselamatan Lalu Lintas dan Angkutan Jalan.',
                'pejabat' => 'Pejabat Pembuat Komitmen / Tim Ahli'
            ],
            [
                'judul' => 'Perjanjian Kerjasama Pengujian Kekesatan Jalan Tol HK Ruas Palindra 2025',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1ZzSvEFNKvH5OCqUIsMHqFqJxHbcuXKia/view?usp=drive_link',
                'deskripsi' => 'Perjanjian kerjasama teknis pengujian laik fungsi jalan dan kekesatan perkerasan jalan tol Palembang - Indralaya.',
                'pejabat' => 'Unit Pengembangan Usaha PKTJ'
            ],
            [
                'judul' => 'Pokok Perjanjian Kontrak Pengujian Dinas Perhubungan DKI Jakarta (SPAU 2025)',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1T2g-X6bGpIqr7A8aeFG0wBXNkm1J9TNX/view?usp=drive_link',
                'deskripsi' => 'Dokumen kontrak pengujian dan kalibrasi alat pengujian kendaraan bermotor Sistem Pengujian Otomatis (SPAU) DKI Jakarta.',
                'pejabat' => 'Unit Pengembangan Usaha'
            ],
            [
                'judul' => 'Surat Perintah Kerja (SPK) Jasa Uji Reflektifitas Rambu dan Marka Jalan Tahap I',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1jP_z3VAlXuB4Dti4_UPhEv_GAD-rJszw/view?usp=drive_link',
                'deskripsi' => 'SPK pelaksanaan pengujian tingkat retroreflektifitas perlengkapan jalan keselamatan transportasi.',
                'pejabat' => 'PPK Pengujian Laboratorium'
            ],
            [
                'judul' => 'Surat Perintah Kerja (SPK) Jasa Uji Reflektifitas Rambu dan Marka Jalan Tahap II',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1YVMvujvFk6xjWUpLfd5MRYZPtqu99FHT/view?usp=sharing',
                'deskripsi' => 'SPK kelanjutan uji pantul marka dan rambu keselamatan jalan triwulan III.',
                'pejabat' => 'PPK Pengujian Laboratorium'
            ],
            [
                'judul' => 'Standar Operasional Prosedur (SOP) Audit Kinerja Satuan Pengawas Internal (SPI)',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1wjnwG1Rc9WwXt41pzkHJ1nTY7P0ptGfR/view?usp=sharing',
                'deskripsi' => 'Prosedur operasional baku pengawasan dan audit kinerja pelaksanaan anggaran serta program kerja unit di lingkungan PKTJ.',
                'pejabat' => 'Satuan Pengawas Internal (SPI)'
            ],
            [
                'judul' => 'Standar Operasional Prosedur (SOP) Audit Dengan Tujuan Tertentu (ADTT)',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1hosNNy168-E8aUHdK-xSs4Kasb8GCNfc/view?usp=sharing',
                'deskripsi' => 'Prosedur investigasi dan pemeriksaan khusus satuan pengawas internal atas dugaan penyimpangan administrasi.',
                'pejabat' => 'Satuan Pengawas Internal (SPI)'
            ],
            [
                'judul' => 'SOP Pemeliharaan dan Kalibrasi Peralatan Simulator dan Laboratorium Pendidikan',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1OjmlHil-8HLWjWDuA-sJ1qPXlBd_Q7cs/view?usp=sharing',
                'deskripsi' => 'Pedoman operasional pemeliharaan preventif, kalibrasi berkala, dan perbaikan perangkat laboratorium keselamatan jalan.',
                'pejabat' => 'Kepala Unit Laboratorium'
            ],
            [
                'judul' => 'SOP Inventarisasi Peralatan Ruangan Laboratorium dan Simulator Pendidikan',
                'kategori' => 'informasi-setiap-saat',
                'link' => 'https://drive.google.com/file/d/1DUFV_F1NHCdS8rp7LhaDtBgKvF99irdJ/view?usp=sharing',
                'deskripsi' => 'Prosedur pencatatan, penomoran, dan inventarisasi aset alat uji praktik dan simulator mengemudi taruna.',
                'pejabat' => 'Kepala Unit Laboratorium'
            ],

            // INFORMASI SERTA MERTA (8)
            [
                'judul' => 'SK BPSDMP No. 17 Tahun 2025 tentang Pembentukan Tim Penghapusan BMN PKTJ',
                'kategori' => 'informasi-serta-merta',
                'link' => 'https://drive.google.com/file/d/15SHHrTblDsjl27FibdhzkteotNzsDNOU/view?usp=drive_link',
                'deskripsi' => 'Keputusan Kepala BPSDMP mengenai pembentukan tim penghapusan barang milik negara rusak berat yang berpotensi membahayakan keselamatan gedung kampus.',
                'pejabat' => 'Bagian Keuangan dan Umum'
            ],
            [
                'judul' => 'Surat Keterangan Penghentian Penggunaan Barang Milik Negara (BMN) Rusak Berat',
                'kategori' => 'informasi-serta-merta',
                'link' => 'https://drive.google.com/file/d/1XCiGZba6RnIdCUegfDuJ8J4YpQ8cgCe2/view?usp=drive_link',
                'deskripsi' => 'Pengumuman kedaruratan penghentian operasional fasilitas dan aset kampus yang telah aus dan membahayakan keselamatan taruna.',
                'pejabat' => 'Pengelola BMN PKTJ'
            ],
            [
                'judul' => 'Surat Rekomendasi Kedaruratan Penghapusan Bangunan Gedung Rusak ke KPKNL',
                'kategori' => 'informasi-serta-merta',
                'link' => 'https://drive.google.com/file/d/1aRbozmigMYPH-3LQwjApjdCT4iI1OuAG/view?usp=drive_link',
                'deskripsi' => 'Rekomendasi teknis pembongkaran dan penghapusan konstruksi bangunan gedung asrama/laboratorium yang mengalami kerusakan struktur.',
                'pejabat' => 'Tim Teknis Sarpras PKTJ'
            ],
            [
                'judul' => 'Berita Acara Pemeriksaan Kondisi Barang dan Fisik Gedung Rusak Berat Tahun 2025',
                'kategori' => 'informasi-serta-merta',
                'link' => 'https://drive.google.com/file/d/1MrlZOCs9EUBiEsq9BfGV3HD_f2bsfrrr/view?usp=drive_link',
                'deskripsi' => 'Berita acara resmi hasil inspeksi fisik kondisi material dan konstruksi gedung penunjang pendidikan.',
                'pejabat' => 'Tim Verifikasi BMN'
            ],
            [
                'judul' => 'Perjanjian Kerjasama Darurat Akses E-Journal dengan Konsorsium FPPTI',
                'kategori' => 'informasi-serta-merta',
                'link' => 'https://drive.google.com/file/d/1tMVLB1ZKFhMzp7Hxno60YOpO6lwAb90u/view?usp=drive_link',
                'deskripsi' => 'Perjanjian pembukaan akses jurnal digital internasional secara terbuka bagi seluruh sivitas akademika dalam situasi penyesuaian pembelajaran.',
                'pejabat' => 'Kepala Unit Perpustakaan'
            ],
            [
                'judul' => 'Perjanjian Kerjasama Pertukaran Informasi Pustaka dengan IAIN Kendari',
                'kategori' => 'informasi-serta-merta',
                'link' => 'https://drive.google.com/file/d/1o4-bFvEmkVq5_Nfj6XgoAWmneiRflwU4/view?usp=drive_link',
                'deskripsi' => 'PKS jejaring perpustakaan perguruan tinggi untuk akses sumber rujukan ilmiah mahasiswa secara daring.',
                'pejabat' => 'Kepala Unit Perpustakaan'
            ],
            [
                'judul' => 'Perjanjian Kerjasama Pertukaran Informasi Pustaka dengan Stikes Bhamada Slawi',
                'kategori' => 'informasi-serta-merta',
                'link' => 'https://drive.google.com/file/d/13XvfY2buFn4s8KxHkp4aZXgHRRhnE9J9/view?usp=drive_link',
                'deskripsi' => 'Kerjasama antar-kampus se-Karesidenan Pekalongan untuk mitigasi literasi kesehatan dan keselamatan lingkungan.',
                'pejabat' => 'Kepala Unit Perpustakaan'
            ],
            [
                'judul' => 'Perjanjian Kerjasama Pertukaran Informasi Pustaka dengan UIN Sunan Gunung Djati',
                'kategori' => 'informasi-serta-merta',
                'link' => 'https://drive.google.com/file/d/1QFKjtEXMzJWorHYDkw9zevxW8lKosqx9/view?usp=drive_link',
                'deskripsi' => 'Kerjasama pertukaran publikasi ilmiah dan repositori digital terbuka antar-perguruan tinggi.',
                'pejabat' => 'Kepala Unit Perpustakaan'
            ]
        ];

        foreach ($newVerified23 as $item) {
            $richContent = '<p>' . htmlspecialchars($item['deskripsi']) . '</p>' .
                '<div style="margin-top: 14px; padding: 14px 18px; background-color: #f0f7ff; border-left: 4px solid #004a99; border-radius: 8px;">' .
                '<p style="margin: 0; font-size: 14px; color: #1e293b;">' .
                '<strong>Tautan Dokumen Resmi Google Drive:</strong><br>' .
                '<a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700; display: inline-block; margin-top: 6px;">' .
                '<i class="fas fa-external-link-alt" style="margin-right: 6px;"></i> ' . htmlspecialchars($item['judul']) . ' (Klik di Sini)' .
                '</a>' .
                '</p>' .
                '</div>';

            DB::table('daftar_informasis')->insert([
                'judul_informasi'    => $item['judul'],
                'kategori'           => $item['kategori'],
                'tipe_informasi'     => 'dokumen',
                'isi_informasi'      => $richContent,
                'pejabat_penguasa'   => $item['pejabat'],
                'penerbit_informasi' => 'Politeknik Keselamatan Transportasi Jalan',
                'tempat_pembuatan'   => 'Tegal',
                'penanggung_jawab'   => $item['pejabat'],
                'waktu_pembuatan'    => '2025',
                'bentuk_informasi'   => 'Softcopy (PDF)',
                'jangka_waktu'       => 'Sesuai Retensi Arsip',
                'file_informasi'     => $item['link'],
                'aktif'              => 1,
                'is_blurred'         => 0,
                'bisa_download'      => 1,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }
    }
}
