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

        // 2. Clean dummy Laporan Layanan
        if (Schema::hasTable('dokumens')) {
            DB::table('dokumens')
                ->whereIn('kategori', ['Laporan Layanan', 'Laporan Akses', 'Laporan Tahunan'])
                ->delete();
            DB::table('dokumens')
                ->where('judul', 'like', '%Laporan Permohonan Informasi%')
                ->orWhere('judul', 'like', '%Laporan Tahunan%')
                ->delete();
        }

        // 3. Clean unverified rows from legacy tables
        if (Schema::hasTable('informasi_berkalas')) {
            DB::table('informasi_berkalas')->delete();
        }
        if (Schema::hasTable('informasi_sertamertas')) {
            DB::table('informasi_sertamertas')->delete();
        }

        // 4. Clean daftar_informasis (keep informasi-dikecualikan)
        if (Schema::hasTable('daftar_informasis')) {
            DB::table('daftar_informasis')->where('kategori', '!=', 'informasi-dikecualikan')->delete();
        }

        // Helper to insert item
        $insertItem = function (string $kategori, array $item) {
            $richContent = '<p>' . htmlspecialchars($item['ringkasan']) . '</p>' .
                '<div style="margin-top: 14px; padding: 14px 18px; background-color: #f0f7ff; border-left: 4px solid #004a99; border-radius: 8px;">' .
                '<p style="margin: 0; font-size: 14px; color: #1e293b;">' .
                '<strong>Tautan Dokumen Resmi Google Drive:</strong><br>' .
                '<a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700; display: inline-block; margin-top: 6px;">' .
                '<i class="fas fa-external-link-alt" style="margin-right: 6px;"></i> Buka Dokumen (Google Drive)' .
                '</a>' .
                '</p>' .
                '</div>';

            DB::table('daftar_informasis')->insert([
                'judul_informasi'    => $item['judul'],
                'kategori'           => $kategori,
                'tipe_informasi'     => 'dokumen',
                'isi_informasi'      => $richContent,
                'pejabat_penguasa'   => $item['pejabat'] ?? 'PPID Pelaksana UPT PKTJ Tegal',
                'penerbit_informasi' => $item['penerbit'] ?? 'Politeknik Keselamatan Transportasi Jalan',
                'tempat_pembuatan'   => $item['tempat'] ?? 'Tegal',
                'penanggung_jawab'   => $item['penerbit'] ?? 'PKTJ Tegal',
                'waktu_pembuatan'    => $item['waktu'] ?? '2025',
                'bentuk_informasi'   => $item['bentuk'] ?? 'Softcopy',
                'jangka_waktu'       => $item['retensi'] ?? '1 Tahun',
                'file_informasi'     => $item['link'],
                'aktif'              => 1,
                'is_blurred'         => 0,
                'bisa_download'      => 1,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        };

        // 5. INFORMASI BERKALA (26 Verified Items)
        $berkalaData = [
            [
                'judul' => 'Akreditasi Program Studi (LED & LKPS Prodi RSTJ, TRO, TO)',
                'ringkasan' => 'Dokumen Laporan Evaluasi Diri Program Studi (LED) dan Laporan Kinerja Program Studi (LKPS) Prodi RSTJ, TRO, dan TO yang diunggah pada sistem LAM Teknik untuk akreditasi program studi.',
                'pejabat' => 'Kepala SPM',
                'penerbit' => 'Tim SPM dan masing-masing Prodi',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1rvltyYA70k88Icn1dUpuyD9jpSlhhdDY/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Audit Mutu Internal (AMI) PKTJ Tahun 2025',
                'ringkasan' => 'Laporan pelaksanaan Audit Mutu Internal Tahun 2025 oleh Auditor Internal kepada masing-masing unit kerja dan auditee di lingkungan PKTJ.',
                'pejabat' => 'Kepala SPM',
                'penerbit' => 'Tim SPM dan Auditor',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '2 Tahun',
                'link' => 'https://drive.google.com/file/d/1k9sOdvKbToFwcTiE2McZ2B73KO0_4fkY/view?usp=drive_link',
            ],
            [
                'judul' => 'Jadwal Kegiatan Softskill Taruna Tahun 2025',
                'ringkasan' => 'Jadwal dan susunan kegiatan pembentukan karakter dan softskill taruna mengenai literasi kesehatan mental tahun 2025.',
                'pejabat' => 'Pengasuh Praja',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1xPtTCgRHcI_uA9vlTRv2QvYPm42DINeH/view?usp=drive_link',
            ],
            [
                'judul' => 'Jadwal Perkuliahan Program Studi D3 Teknologi Otomotif (TO) TA 2025/2026',
                'ringkasan' => 'Jadwal perkuliahan dan plotting dosen pengampu semester ganjil Program Studi Diploma III Teknologi Otomotif (TO) TA 2025/2026.',
                'pejabat' => 'Kepala Program Studi D3 Teknologi Otomotif (TO)',
                'penerbit' => 'Prodi D3 TO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1tY4S4T279H3GIRLw1Pkd96TBUZdNQrJS/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Pengawasan Mutu & Manajemen Sistem Penyelenggaraan Makanan (MSPM) Taruna 2025',
                'ringkasan' => 'Laporan kegiatan pengawasan mutu dan manajemen sistem penyelenggaraan makanan (MSPM) serta evaluasi permakanan taruna periode Januari hingga November 2025.',
                'pejabat' => 'Nutrisionis Terampil',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1lbc6mAZtkDVIkVrpsQg8uuYBn_FL33zn/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Kegiatan Pengukuran Indeks Massa Tubuh (IMT) Taruna Tahun 2025',
                'ringkasan' => 'Laporan hasil pengukuran Indeks Massa Tubuh (IMT) taruna/i PKTJ pada Semester 1 (Maret) dan Semester 2 (Agustus) Tahun 2025.',
                'pejabat' => 'Nutrisionis Terampil',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1AzLms44HlcLDJncxnUcDV_wFZZOgxdch/view?usp=drive_link',
            ],
            [
                // Row 11: Fixed typo Softkill -> Softskill & clear title
                'judul' => 'Jadwal Kegiatan Softskill Literasi Kesehatan Mental Taruna Tahun 2025',
                'ringkasan' => 'Jadwal dan susunan kegiatan pembentukan karakter softskill taruna mengenai literasi kesehatan mental tahun 2025.',
                'pejabat' => 'Pengasuh Praja',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1IfqfbuDqsbUskq1H_tFHUwRJcxuoynga/view?usp=drive_link',
            ],
            [
                // Row 12: Fixed typo Penilian -> Penilaian
                'judul' => 'Laporan Penilaian Samapta Periodik Taruna Tahun 2025',
                'ringkasan' => 'Laporan penilaian tes kesamaptaan jasmani periodik taruna/i PKTJ yang dilaksanakan pada Semester Ganjil dan Semester Genap Tahun 2025.',
                'pejabat' => 'Pengasuh Praja',
                'penerbit' => 'Pusat Pembangunan Karakter',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1dklOY3q0RlCz6m-NTLlgjwG1mG1anUrk/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Perkuliahan Semester Genap Prodi RSTJ TA 2024/2025',
                'ringkasan' => 'Laporan pelaksanaan perkuliahan Semester Genap Tahun Akademik 2024/2025 Program Studi Sarjana Terapan Rekayasa Sistem Transportasi Jalan (RSTJ).',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Program Studi RSTJ',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Masih Berlaku',
                'link' => 'https://drive.google.com/file/d/1whVnOxu2OAIrLjGQOi4UVnSODDvWSFtN/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Tracer Study Lulusan PKTJ Tahun 2025',
                'ringkasan' => 'Laporan hasil kegiatan penelusuran lulusan (tracer study) terhadap alumni tahun 2023 dan 2024 dari program studi RSTJ, TRO, dan D3 TO.',
                'pejabat' => 'Katim Substansi Administrasi Ketarunaan dan Alumni',
                'penerbit' => 'Tim Administrasi Ketarunaan dan Alumni',
                'bentuk' => 'Softcopy & Hardcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1Z03rj5TTeSRbyoJbvoI1OVNeHDeJnmr2/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Pelaksanaan Uji Kompetensi Penilai Analisis Dampak Lalu Lintas (Andalalin) 2025',
                'ringkasan' => 'Diawali dengan kegiatan pra-ujikom penilai Andalalin dan dilanjutkan pelaksanaan asesmen uji kompetensi penilai Andalalin Prodi RSTJ Tahun 2025.',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1hgqfwqJATIAUnQMK89_WqFOsXvgNyxLq/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Pelaksanaan Uji Kompetensi Pembantu Penguji Kendaraan Bermotor (PKB) 2025',
                'ringkasan' => 'Diawali kegiatan pra-ujikom dan dilanjutkan uji kompetensi pembantu penguji kendaraan bermotor (PKB) bagi 31 mahasiswa Program Studi TRO Tahun 2025.',
                'pejabat' => 'Kepala Program Studi TRO',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1bkVuYjckwiflyopuFsEhQn75Jr3KUAmn/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Pelaksanaan Uji Kompetensi Pemeliharaan Jalan (PKS Kerjasama) 2025',
                'ringkasan' => 'Laporan kegiatan pelatihan pemeliharaan jalan dan asesmen/uji kompetensi pemeliharaan jalan hasil kerja sama Program Studi RSTJ Tahun 2025.',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1NhA8-ImFldPpGCTGJm0YzEnmSK4zgJnn/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Pelaksanaan Uji Kompetensi Sistem Manajemen Keselamatan (SMK) 2025',
                'ringkasan' => 'Diawali kegiatan pra-ujikom dan dilanjutkan uji kompetensi Sistem Manajemen Keselamatan (SMK) bagi 57 mahasiswa Polbit Program Studi TRO Tahun 2025.',
                'pejabat' => 'Kepala Program Studi TRO',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/13R7DxU7BzK53vXcvyDPZaGFA2HQvucVz/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan UTS dan UAS Program Studi RSTJ TA 2025/2026',
                'ringkasan' => 'Nota dinas pelaksanaan ujian tengah semester (UTS) dan ujian akhir semester (UAS) mengikuti kalender akademik Program Studi RSTJ TA 2025/2026.',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1skDjqrJrioh7lhKpvN1fAWYkSsqPKFj-/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan UTS dan UAS Program Studi TRO TA 2025/2026',
                'ringkasan' => 'Nota dinas pelaksanaan ujian tengah semester dan ujian akhir semester ganjil Program Studi Teknologi Rekayasa Otomotif (TRO) TA 2025/2026.',
                'pejabat' => 'Kepala Program Studi TRO',
                'penerbit' => 'Prodi TRO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1ez4_J3ZyLFN41OY-tBchy3W0k8AeOAAx/view?usp=drive_link',
            ],
            [
                'judul' => 'Pelaksanaan UTS dan UAS Program Studi D3 TO TA 2025/2026',
                'ringkasan' => 'Pengumuman dan ketentuan pelaksanaan ujian tengah semester dan ujian akhir semester ganjil Program Studi Diploma III TO TA 2025/2026.',
                'pejabat' => 'Kepala Program Studi D3 TO',
                'penerbit' => 'Prodi D3 TO Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1hlV5Ac65SPio7VLsn9E8Zvx5Deecatxe/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Pelaksanaan Screening Kesehatan Gigi dan Skrining TB Taruna PKTJ 2025',
                'ringkasan' => 'Kegiatan rutin screening pemeriksaan kesehatan gigi dan skrining tuberkulosis (TB) bagi taruna/i PKTJ bekerja sama dengan Dinas Kesehatan Kota Tegal.',
                'pejabat' => 'Kepala Unit Kesehatan',
                'penerbit' => 'Tenaga Kesehatan Unit Kesehatan PKTJ',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1cs5uk0mhMAnJA50LLm7MTgTkC9a7fULp/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Audit Surveillance ISO 21001:2018 Sistem Manajemen Organisasi Pendidikan 2025',
                'ringkasan' => 'Laporan hasil audit surveillance ISO 21001:2018 oleh SGS Indonesia mengenai penjaminan mutu proses pembelajaran dan kepuasan peserta didik di PKTJ Tegal.',
                'pejabat' => 'Kepala SPM',
                'penerbit' => 'Tim SPM PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '2 Tahun',
                'link' => 'https://drive.google.com/file/d/1RP4Mq6eUcA24hvZMDNmL7XxPp27A_Vhz/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Survei Kepuasan Masyarakat (IKM) & Indeks Persepsi Korupsi (IPK) Semester I 2025',
                'ringkasan' => 'Laporan berkala hasil survei Indeks Kepuasan Masyarakat (IKM) dan Indeks Persepsi Korupsi (IPK) Semester I Tahun 2025 di lingkungan PKTJ Tegal.',
                'pejabat' => 'Kepala SPM',
                'penerbit' => 'Tim SPM PKTJ',
                'bentuk' => 'Softcopy & Hardcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1gYZNEK_IFgG0hlYSmbHXG9R1Q688Z68_/view?usp=drive_link',
            ],
            [
                // Row 25
                'judul' => 'DIPA Petikan PKTJ Tahun Anggaran 2025 (Revisi 08)',
                'ringkasan' => 'Dokumen otorisasi pelaksanaan anggaran Daftar Isian Pelaksanaan Anggaran (DIPA) Petikan PKTJ Tegal Tahun Anggaran 2025 revisi ke-8.',
                'pejabat' => 'Ketua Tim Substansi Bidang Keuangan',
                'penerbit' => 'Bagian Keuangan dan Administrasi Umum',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1hLQ-26Oko2u1uve8jD9NMbNknRnyLD_W/view?usp=drive_link',
            ],
            [
                // Row 26: Year 2024
                'judul' => 'Surat Keputusan (SK) Penetapan PPID Pelaksana UPT PKTJ Tahun 2024',
                'ringkasan' => 'Surat Keputusan Direktur PKTJ Nomor SK-PKTJ 12 Tahun 2024 tentang Penetapan Pengelola Informasi dan Dokumentasi (PPID) Pelaksana di lingkungan UPT PKTJ Tegal.',
                'pejabat' => 'Direktur PKTJ',
                'penerbit' => 'Subbagian Tata Usaha & Kepegawaian',
                'bentuk' => 'Softcopy',
                'waktu' => '2024',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Berlaku',
                'link' => 'https://drive.google.com/file/d/16_4Pmme_pWLgafTXlmBU0uuS82qs5RhP/view?usp=sharing',
            ],
            [
                // AKIP 1
                'judul' => 'Penyampaian Laporan Tahunan Pelayanan Informasi Publik PKTJ Tahun 2025 ke PPID Utama Kemenhub',
                'ringkasan' => 'Surat penyampaian resmi Laporan Tahunan Layanan Informasi Publik UPT PKTJ Tegal Tahun 2025 kepada PPID Utama Kementerian Perhubungan.',
                'pejabat' => 'Direktur PKTJ',
                'penerbit' => 'PPID Pelaksana PKTJ',
                'bentuk' => 'Softcopy / PDF',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1NabSL0TAkoFyp7aEEiyeXbWrkBDbMGyx/view?usp=drive_link',
            ],
            [
                // AKIP 2
                'judul' => 'Laporan Tahunan Pelaksanaan Program Kerja dan Pengelolaan Keuangan PKTJ Tahun 2025',
                'ringkasan' => 'Laporan tahunan komprehensif pertanggungjawaban pelaksanaan seluruh program kerja, kegiatan akademis, dan realisasi anggaran PKTJ Tegal Tahun 2025.',
                'pejabat' => 'Direktur PKTJ',
                'penerbit' => 'Bagian Keuangan dan Administrasi Umum',
                'bentuk' => 'Softcopy / PDF',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1pe1vqLCRemRpA6G5q2VpC0L6KhTGriEo/view?usp=sharing',
            ],
            [
                // AKIP 3
                'judul' => 'Ringkasan Eksekutif Laporan Kinerja Instansi Pemerintah (LKjIP / LAKIP) PKTJ Tahun 2025',
                'ringkasan' => 'Ringkasan eksekutif akuntabilitas kinerja instansi pemerintah (LKjIP / LAKIP) mengenai pencapaian target sasaran strategis PKTJ Tegal Tahun 2025.',
                'pejabat' => 'Direktur PKTJ',
                'penerbit' => 'Subbagian Tata Usaha & Tim AKIP',
                'bentuk' => 'Softcopy / PDF',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/18azvUjvumzPkAN-hTmSWhkWaJrXZFle3/view?usp=drive_link',
            ],
            [
                // AKIP 4
                'judul' => 'Laporan Penanganan Pengaduan Masyarakat, WBS, dan SP4N-LAPOR PKTJ Tahun 2025/2026',
                'ringkasan' => 'Rekapitulasi penanganan aspirasi masyarakat, Whistleblowing System (WBS), dan tindak lanjut laporan pengaduan melalui portal SP4N-LAPOR PKTJ.',
                'pejabat' => 'Satuan Pengawas Internal (SPI)',
                'penerbit' => 'Tim Penanganan Pengaduan Masyarakat & SPI PKTJ',
                'bentuk' => 'Softcopy / PDF',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1GWWRCz0vru-ZWGbiWkiGhohBo1cCxmxw/view?usp=drive_link',
            ],
        ];

        foreach ($berkalaData as $item) {
            $insertItem('informasi-berkala', $item);
        }

        // 6. INFORMASI SERTA MERTA (18 Verified Items - No 404, No Dummy Duplicates)
        $sertaMertaData = [
            [
                // Row 1: Fixed Roadmap P3M 2024
                'judul' => 'Roadmap Penelitian dan Pengabdian Kepada Masyarakat (P3M) PKTJ Tahun 2024',
                'ringkasan' => 'Dokumen Roadmap Penelitian dan Pengabdian Kepada Masyarakat (P3M) Politeknik Keselamatan Transportasi Jalan Tahun 2024 yang memuat peta jalan dan tema strategis riset institusi.',
                'pejabat' => 'Kepala Pusat Penelitian dan Pengabdian Masyarakat (P3M)',
                'penerbit' => 'Pusat Penelitian dan Pengabdian Masyarakat (P3M)',
                'bentuk' => 'Softcopy',
                'waktu' => '2024',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1EEa1yo0dCuDWgWMbFp6aUVQZiHzBlFvG/view?usp=drive_link',
            ],
            [
                'judul' => 'Jumlah Kunjungan Pasien Klinik Pratama PKTJ Tahun 2025',
                'ringkasan' => 'Data statistik dan rekapitulasi kunjungan pasien rawat jalan pada Klinik Pratama PKTJ meliputi taruna, pegawai, dan masyarakat umum periode Januari-November 2025.',
                'pejabat' => 'Kepala Unit Kesehatan',
                'penerbit' => 'Tenaga Kesehatan Unit Kesehatan PKTJ',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1jY-CngE5yJKKUDvqpVAKa_SC5Ab2cFME/view?usp=sharing',
            ],
            [
                // Row 3: FULL FOLDER JAN-DES 2025
                'judul' => 'Laporan Kebersihan Asrama PKTJ Tahun 2025 (Bulan Januari s/d Desember Lengkap)',
                'ringkasan' => 'Rekapitulasi berkala laporan pengecekan dan monitoring kebersihan asrama taruna/i PKTJ Kampus I dan II dari Bulan Januari hingga Desember 2025 secara lengkap.',
                'pejabat' => 'Kepala Unit Asrama PKTJ',
                'penerbit' => 'Unit Pengelolaan Asrama Taruna',
                'bentuk' => 'Google Drive Folder',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/drive/folders/1qU81c6u8w7zy6oCCF2mLxN_FxIouESxW?usp=drive_link',
            ],
            [
                'judul' => 'Pemeriksaan Kesehatan Gratis Pengemudi Ojek Online Dalam Rangka Hari Perhubungan Nasional Tahun 2025',
                'ringkasan' => 'Kegiatan bakti sosial pemeriksaan kesehatan gratis (tekanan darah, gula darah sewaktu, kolesterol, dan asam urat) bagi pengemudi ojek online dalam rangka Hari Perhubungan Nasional 2025.',
                'pejabat' => 'Kepala Unit Kesehatan',
                'penerbit' => 'Tenaga Kesehatan Unit Kesehatan PKTJ',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1PCJ7TjFLh--7npmi85dXwP8Yi6cO6wlF/view?usp=drive_link',
            ],
            [
                'judul' => 'Pemeriksaan Kesehatan Gratis Pengemudi Ojek Online Dalam Rangka Peringatan HUT RI',
                'ringkasan' => 'Kegiatan bakti sosial pemeriksaan kesehatan umum secara cuma-cuma bagi mitra transportasi online pengemudi ojek online dalam rangka memeriahkan HUT Kemerdekaan RI.',
                'pejabat' => 'Kepala Unit Kesehatan',
                'penerbit' => 'Tenaga Kesehatan Unit Kesehatan PKTJ',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1k1lxiDvvRFcCvI5OIfXOZbfo00Bw0sZI/view?usp=drive_link',
            ],
            [
                'judul' => 'Penghapusan Barang Milik Negara (BMN) PKTJ Tahun 2025',
                'ringkasan' => 'Dokumen administrasi rekomendasi dan penetapan penghapusan Barang Milik Negara (BMN) kondisi rusak berat di lingkungan Politeknik Keselamatan Transportasi Jalan Tahun 2025.',
                'pejabat' => 'Ketua Tim Bidang Umum',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '7 Tahun',
                'link' => 'https://drive.google.com/file/d/1aRbozmigMYPH-3LQwjApjdCT4iI1OuAG/view?usp=drive_link',
            ],
            [
                'judul' => 'Profil Program Studi Sarjana Terapan Rekayasa Sistem Transportasi Jalan (RSTJ)',
                'ringkasan' => 'Dokumen profil komprehensif memuat visi misi, kurikulum, profil lulusan, capaian pembelajaran, dosen, dan prestasi taruna Program Studi RSTJ PKTJ Tegal.',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Prodi RSTJ Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Berlaku',
                'link' => 'https://drive.google.com/file/d/1qOzwfGGg3V2edOgdxBD4Fjj1DncRU30X/view?usp=drive_link',
            ],
            [
                'judul' => 'Profil Unit Perpustakaan PKTJ Tegal',
                'ringkasan' => 'Dokumen profil unit perpustakaan memuat sejarah pendirian, visi misi, struktur organisasi, tata tertib, jam layanan, serta fasilitas koleksi literatur keselamatan transportasi.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Hardcopy & Softcopy',
                'waktu' => '2023',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Berlaku',
                'link' => 'https://drive.google.com/file/d/1hcC1XY8hd7XWF-AHqW1fdDoUzyyED934/view?usp=drive_link',
            ],
            [
                'judul' => 'Sosialisasi Pencegahan, Pemberantasan, Penyalahgunaan dan Peredaran Gelap Narkotika (P4GN) 2025',
                'ringkasan' => 'Laporan kegiatan penyuluhan dan sosialisasi bahaya narkoba (P4GN) secara daring kepada seluruh taruna/i Politeknik Keselamatan Transportasi Jalan.',
                'pejabat' => 'Kepala Unit Kesehatan',
                'penerbit' => 'Dokter Unit Kesehatan PKTJ',
                'bentuk' => 'Softfile',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1CZsernmJspWDeXuq0c-1V0LE0ufnsMZK/view?usp=drive_link',
            ],
            [
                'judul' => 'Piagam Satuan Pengawas Internal (SPI Charter) PKTJ Tegal',
                'ringkasan' => 'Piagam pengawasan internal formal yang menetapkan komitmen pimpinan institusi atas mandat, wewenang, ruang lingkup tugas, dan independensi Satuan Pengawas Internal PKTJ.',
                'pejabat' => 'Kepala SPI',
                'penerbit' => 'SPI Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy & Hardcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1XY_1ktDrqGwQJ2nuK_sslnYrP0Ddv4nx/view?usp=drive_link',
            ],
            [
                'judul' => 'SK BPSDMP No. 17 Tahun 2025 tentang Pembentukan Tim Penghapusan BMN PKTJ',
                'ringkasan' => 'Keputusan Kepala BPSDMP mengenai pembentukan tim penghapusan barang milik negara rusak berat yang berpotensi membahayakan keselamatan gedung kampus.',
                'pejabat' => 'Bagian Keuangan dan Umum',
                'penerbit' => 'BPSDMP Kemenhub / PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '7 Tahun',
                'link' => 'https://drive.google.com/file/d/15SHHrTblDsjl27FibdhzkteotNzsDNOU/view?usp=drive_link',
            ],
            [
                'judul' => 'Surat Keterangan Penghentian Penggunaan Barang Milik Negara (BMN) Rusak Berat',
                'ringkasan' => 'Pengumuman kedaruratan penghentian operasional fasilitas dan aset kampus yang telah aus dan membahayakan keselamatan taruna.',
                'pejabat' => 'Pengelola BMN PKTJ',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '7 Tahun',
                'link' => 'https://drive.google.com/file/d/1XCiGZba6RnIdCUegfDuJ8J4YpQ8cgCe2/view?usp=drive_link',
            ],
            [
                'judul' => 'Surat Rekomendasi Kedaruratan Penghapusan Bangunan Gedung Rusak ke KPKNL',
                'ringkasan' => 'Rekomendasi teknis pembongkaran dan penghapusan konstruksi bangunan gedung asrama/laboratorium yang mengalami kerusakan struktur.',
                'pejabat' => 'Tim Teknis Sarpras PKTJ',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '7 Tahun',
                'link' => 'https://drive.google.com/file/d/1aRbozmigMYPH-3LQwjApjdCT4iI1OuAG/view?usp=drive_link',
            ],
            [
                'judul' => 'Berita Acara Pemeriksaan Kondisi Barang dan Fisik Gedung Rusak Berat Tahun 2025',
                'ringkasan' => 'Berita acara resmi hasil inspeksi fisik kondisi material dan konstruksi gedung penunjang pendidikan.',
                'pejabat' => 'Tim Verifikasi BMN',
                'penerbit' => 'Bagian Keuangan dan Umum',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '7 Tahun',
                'link' => 'https://drive.google.com/file/d/1MrlZOCs9EUBiEsq9BfGV3HD_f2bsfrrr/view?usp=drive_link',
            ],
            [
                'judul' => 'Perjanjian Kerjasama Darurat Akses E-Journal dengan Konsorsium FPPTI',
                'ringkasan' => 'Perjanjian pembukaan akses jurnal digital internasional secara terbuka bagi seluruh sivitas akademika dalam situasi penyesuaian pembelajaran.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '3 Tahun',
                'link' => 'https://drive.google.com/file/d/1tMVLB1ZKFhMzp7Hxno60YOpO6lwAb90u/view?usp=drive_link',
            ],
            [
                'judul' => 'Perjanjian Kerjasama Pertukaran Informasi Pustaka dengan IAIN Kendari',
                'ringkasan' => 'PKS jejaring perpustakaan perguruan tinggi untuk akses sumber rujukan ilmiah mahasiswa secara daring.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '3 Tahun',
                'link' => 'https://drive.google.com/file/d/1o4-bFvEmkVq5_Nfj6XgoAWmneiRflwU4/view?usp=drive_link',
            ],
            [
                'judul' => 'Perjanjian Kerjasama Pertukaran Informasi Pustaka dengan Stikes Bhamada Slawi',
                'ringkasan' => 'Kerjasama antar-kampus se-Karesidenan Pekalongan untuk mitigasi literasi kesehatan dan keselamatan lingkungan.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '3 Tahun',
                'link' => 'https://drive.google.com/file/d/13XvfY2buFn4s8KxHkp4aZXgHRRhnE9J9/view?usp=drive_link',
            ],
            [
                'judul' => 'Perjanjian Kerjasama Pertukaran Informasi Pustaka dengan UIN Sunan Gunung Djati',
                'ringkasan' => 'Kerjasama pertukaran publikasi ilmiah dan repositori digital terbuka antar-perguruan tinggi.',
                'pejabat' => 'Kepala Unit Perpustakaan',
                'penerbit' => 'Unit Perpustakaan PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '3 Tahun',
                'link' => 'https://drive.google.com/file/d/1QFKjtEXMzJWorHYDkw9zevxW8lKosqx9/view?usp=drive_link',
            ],
        ];

        foreach ($sertaMertaData as $item) {
            $insertItem('informasi-serta-merta', $item);
        }

        // 7. INFORMASI SETIAP SAAT (22 Verified Items - No Asrama, Deduplicated MoU/PKS/SPK, SOP 2023, Sosmed 2026)
        $setiapSaatData = [
            [
                'judul' => 'Dokumen Kurikulum Program Studi Sarjana Terapan RSTJ (KP-BPSDMP 173 Tahun 2025)',
                'ringkasan' => 'Hasil review kurikulum Prodi Sarjana Terapan RSTJ. Menggantikan kurikulum lama 2020 dengan kurikulum baru 2025 berbasis Outcome-Based Education (OBE).',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Prodi RSTJ PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Masih Berlaku',
                'link' => 'https://drive.google.com/file/d/1Yq1cQU5fVWRM0ogGBIlONl-p6AtbHcOT/view?usp=drive_link',
            ],
            [
                'judul' => 'Dokumen Kurikulum Program Studi Sarjana Terapan TRO (KP-BPSDMP 181 Tahun 2025)',
                'ringkasan' => 'Hasil review kurikulum Prodi Sarjana Terapan TRO. Kurikulum operasional 2025 untuk peningkatan kompetensi teknologi rekayasa otomotif.',
                'pejabat' => 'Kepala Program Studi TRO',
                'penerbit' => 'Prodi TRO PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Masih Berlaku',
                'link' => 'https://drive.google.com/file/d/14Z2niInObd5DyMfw1LL_9QYdX3jGbPS6/view?usp=drive_link',
            ],
            [
                'judul' => 'Dokumen Kurikulum Program Studi D3 Teknologi Otomotif (Kurikulum 2020)',
                'ringkasan' => 'Buku pedoman kurikulum Program Studi Diploma III Teknologi Otomotif (TO) PKTJ Tegal Tahun 2020.',
                'pejabat' => 'Kepala Program Studi D3 TO',
                'penerbit' => 'Prodi D3 TO PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Masih Berlaku',
                'link' => 'https://drive.google.com/file/d/1GRN5PAXrJwYUc01QqVskbyHpF-Uo-WKi/view?usp=drive_link',
            ],
            [
                'judul' => 'Dokumen Kurikulum Hasil Review Program Studi D3 Teknologi Otomotif Tahun 2025',
                'ringkasan' => 'Hasil review dan pengesahan pembaruan kurikulum Program Studi Diploma III Teknologi Otomotif (TO) PKTJ Tegal Tahun 2025.',
                'pejabat' => 'Kepala Program Studi D3 TO',
                'penerbit' => 'Prodi D3 TO PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Masih Berlaku',
                'link' => 'https://drive.google.com/file/d/1JzIqbOa5BZy49tJYKfdICmkh1Ysi0yNQ/view?usp=drive_link',
            ],
            [
                'judul' => 'Pedoman Pembelajaran Teaching Factory (TeFa) Prodi RSTJ',
                'ringkasan' => 'Pedoman pelaksanaan pembelajaran Teaching Factory (TeFa) Program Studi Sarjana Terapan RSTJ.',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Prodi RSTJ PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1Q4KCRsbVOCqY2VTlOhwZ8OOnBRmnkN54/view?usp=drive_link',
            ],
            [
                'judul' => 'Laporan Progres Pembelajaran Teaching Factory (TeFa) Prodi RSTJ Semester Ganjil',
                'ringkasan' => 'Laporan perkembangan capaian pelaksanaan Teaching Factory (TeFa) mahasiswa Prodi RSTJ Semester Ganjil TA 2025/2026.',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Prodi RSTJ PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1xYhKYTH3JSQyrZsnV09DR28GIpPgRq9l/view?usp=drive_link',
            ],
            [
                'judul' => 'Portofolio dan Laporan Produk TeFa Prodi RSTJ Kelas A (Kelompok 1 - 6)',
                'ringkasan' => 'Dokumen portofolio hasil karya dan produk rekayasa keselamatan jalan mahasiswa TeFa Prodi RSTJ Kelas A.',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Prodi RSTJ PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1a-yG1DvOuosOMRKt5-77hUGzlL5N3_vo/view?usp=drive_link',
            ],
            [
                'judul' => 'Portofolio dan Laporan Produk TeFa Prodi RSTJ Kelas B (Kelompok 1 - 6)',
                'ringkasan' => 'Dokumen portofolio hasil karya dan produk rekayasa keselamatan jalan mahasiswa TeFa Prodi RSTJ Kelas B.',
                'pejabat' => 'Kepala Program Studi RSTJ',
                'penerbit' => 'Prodi RSTJ PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '6 Bulan',
                'link' => 'https://drive.google.com/file/d/1z5qQ6l5LGVjSaClxwCaSDIYDwm3ds66-/view?usp=drive_link',
            ],
            [
                'judul' => 'Surat Keputusan (SK) Penunjukan Tim Teaching Factory (TeFa) Prodi TRO 2025',
                'ringkasan' => 'Surat keputusan penetapan susunan tim pengajar dan pembimbing kegiatan Teaching Factory (TeFa) Prodi TRO Tahun 2025.',
                'pejabat' => 'Kepala Program Studi TRO',
                'penerbit' => 'Prodi TRO PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/1QFpmVataYKiB9UNgr_l9-p0Z7m4dchhG/view?usp=drive_link',
            ],
            [
                // Row 10: TeFa TRO Folder
                'judul' => 'Kegiatan Pembelajaran Teaching Factory (TeFa) - Produk TeFa Prodi TRO PKTJ',
                'ringkasan' => 'Dokumen portofolio dan laporan produk kegiatan pembelajaran Teaching Factory (TeFa) Program Studi Teknologi Rekayasa Otomotif (TRO) PKTJ Tegal Tahun 2025.',
                'pejabat' => 'Kepala Program Studi TRO',
                'penerbit' => 'Prodi TRO PKTJ Tegal',
                'bentuk' => 'Google Drive Folder',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Berlaku',
                'link' => 'https://drive.google.com/drive/folders/1-KoetVPqIyiJ3VXd3EaVwpZkaC2bzRcB?usp=drive_link',
            ],
            [
                // Kontrak (Right Column Link)
                'judul' => 'Kontrak Pengujian dan Perjanjian Kerja Kemitraan PKTJ',
                'ringkasan' => 'Dokumen kontrak kesepakatan pelaksanaan pekerjaan pengujian ketidakrataan dan kekesatan jalan tol antara PKTJ dengan mitra penyedia jasa.',
                'pejabat' => 'Katim Kerjasama / PPK PKTJ',
                'penerbit' => 'Unit Pengembangan Usaha (UPU)',
                'bentuk' => 'Softcopy & Hardcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Sesuai Masa Kontrak',
                'link' => 'https://drive.google.com/file/d/1LUoIDHDwphNHlW6a0lx1v1waAobKJPxy/view?usp=drive_link',
            ],
            [
                // MoU (Right Column Link)
                'judul' => 'Memorandum of Understanding (MoU) / Nota Kesepahaman Kemitraan PKTJ',
                'ringkasan' => 'Dokumen Nota Kesepahaman (Memorandum of Understanding / MoU) kemitraan dan kerja sama kelembagaan Politeknik Keselamatan Transportasi Jalan.',
                'pejabat' => 'Katim Kerjasama PKTJ',
                'penerbit' => 'Unit Kerjasama PKTJ',
                'bentuk' => 'Softcopy & Hardcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Sesuai Masa Berlaku MoU (3-5 Tahun)',
                'link' => 'https://drive.google.com/file/d/1lm5RH7NM7YTS5OETZyY1nJ2iLMxgRWtD/view?usp=drive_link',
            ],
            [
                // PKS (Right Column Link)
                'judul' => 'Perjanjian Kerja Sama (PKS) Kemitraan Strategis PKTJ',
                'ringkasan' => 'Dokumen kesepakatan formal dan legalitas Perjanjian Kerja Sama (PKS) antara Politeknik Keselamatan Transportasi Jalan dengan instansi/mitra strategis.',
                'pejabat' => 'Katim Kerjasama PKTJ',
                'penerbit' => 'Unit Kerjasama PKTJ',
                'bentuk' => 'Softcopy & Hardcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Sesuai Masa Berlaku Kerjasama',
                'link' => 'https://drive.google.com/file/d/1opXQdCZ9G3kKIqTcmgEcEbU-Bxjc0mUz/view?usp=drive_link',
            ],
            [
                // SPK/SPMK (Right Column Link)
                'judul' => 'Surat Perjanjian Kerja / Surat Perintah Mulai Kerja (SPK/SPMK)',
                'ringkasan' => 'Dokumen legal Surat Perjanjian Kerja (SPK) dan Surat Perintah Mulai Kerja (SPMK) pengadaan jasa uji reflektifitas dan pengujian laboratorium PKTJ.',
                'pejabat' => 'PPK & Katim Kerjasama',
                'penerbit' => 'Unit Layanan Pengadaan / PPK Laboratorium',
                'bentuk' => 'Softcopy & Hardcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => 'Sesuai Masa Pelaksanaan Kontrak',
                'link' => 'https://drive.google.com/file/d/1jP_z3VAlXuB4Dti4_UPhEv_GAD-rJszw/view?usp=drive_link',
            ],
            [
                'judul' => 'Program Kerja Pengawasan Tahunan Satuan Pengawas Internal (SPI) PKTJ 2025',
                'ringkasan' => 'Dokumen rencana tahunan kegiatan audit, reviu, pemantauan, dan evaluasi kepatuhan internal di lingkungan PKTJ Tahun 2025.',
                'pejabat' => 'Kepala SPI',
                'penerbit' => 'SPI Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy & Hardcopy',
                'waktu' => '2025',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://drive.google.com/file/d/11SVPDZoPM8apJYh8KDgFGrip_92Kz9zm/view?usp=drive_link',
            ],
            [
                'judul' => 'Roadmap Penelitian dan Pengabdian Kepada Masyarakat (P3M) PKTJ 5 Tahunan',
                'ringkasan' => 'Peta jalan riset dan rencana induk pengabdian kepada masyarakat yang memuat fokus tema dan luaran selama 5 tahun.',
                'pejabat' => 'Kepala Pusat P3M',
                'penerbit' => 'P3M Politeknik Keselamatan Transportasi Jalan',
                'bentuk' => 'Softcopy',
                'waktu' => '2024',
                'tempat' => 'Tegal',
                'retensi' => '5 Tahun',
                'link' => 'https://drive.google.com/file/d/1kg1sCnGls8xv_ZQB2gVQK_Os2kLtu12a/view?usp=drive_link',
            ],
            [
                'judul' => 'Daftar Informasi Dikecualikan (DIK) PKTJ & Berita Acara Uji Konsekuensi',
                'ringkasan' => 'Dokumen penetapan Daftar Informasi yang Dikecualikan di lingkungan PKTJ Tegal beserta Berita Acara Uji Konsekuensi berdasarkan Pasal 17 UU No. 14 Tahun 2008.',
                'pejabat' => 'Tim Penguji Konsekuensi PPID PKTJ',
                'penerbit' => 'PPID Pelaksana UPT PKTJ Tegal',
                'bentuk' => 'Softcopy',
                'waktu' => '2026',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Berlaku',
                'link' => 'https://drive.google.com/file/d/1ZfOIvQmVyoZElh8eTwEER71hSEJ7__Z7/view?usp=sharing',
            ],
            [
                'judul' => 'Standar Operasional Prosedur (SOP) Audit Kinerja Satuan Pengawas Internal (SPI)',
                'ringkasan' => 'Prosedur operasional baku pengawasan dan audit kinerja pelaksanaan anggaran serta program kerja unit di lingkungan PKTJ.',
                'pejabat' => 'Kepala SPI',
                'penerbit' => 'Satuan Pengawas Internal (SPI)',
                'bentuk' => 'Softcopy',
                'waktu' => '2024',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Berlaku',
                'link' => 'https://drive.google.com/file/d/1wjnwG1Rc9WwXt41pzkHJ1nTY7P0ptGfR/view?usp=sharing',
            ],
            [
                'judul' => 'Standar Operasional Prosedur (SOP) Audit Dengan Tujuan Tertentu (ADTT)',
                'ringkasan' => 'Prosedur investigasi dan pemeriksaan khusus satuan pengawas internal atas dugaan penyimpangan administrasi.',
                'pejabat' => 'Kepala SPI',
                'penerbit' => 'Satuan Pengawas Internal (SPI)',
                'bentuk' => 'Softcopy',
                'waktu' => '2024',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Berlaku',
                'link' => 'https://drive.google.com/file/d/1hosNNy168-E8aUHdK-xSs4Kasb8GCNfc/view?usp=sharing',
            ],
            [
                'judul' => 'SOP Pemeliharaan dan Kalibrasi Peralatan Simulator dan Laboratorium Pendidikan',
                'ringkasan' => 'Pedoman operasional pemeliharaan preventif, kalibrasi berkala, dan perbaikan perangkat laboratorium keselamatan jalan.',
                'pejabat' => 'Kepala Unit Laboratorium',
                'penerbit' => 'Unit Laboratorium dan Simulator PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => '2024',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Berlaku',
                'link' => 'https://drive.google.com/file/d/1OjmlHil-8HLWjWDuA-sJ1qPXlBd_Q7cs/view?usp=sharing',
            ],
            [
                // Row 31: Fixed Year to 2023 (Nomor: 04/SOP/O-02/PKTJ/2023 disahkan 05 Desember 2023)
                'judul' => 'SOP Inventarisasi Peralatan Ruangan Laboratorium dan Simulator Pendidikan',
                'ringkasan' => 'Standar Operasional Prosedur inventarisasi peralatan, perlengkapan ruangan laboratorium, dan simulator pendidikan di lingkungan Politeknik Keselamatan Transportasi Jalan.',
                'pejabat' => 'Kepala Unit Laboratorium Pendidikan',
                'penerbit' => 'Unit Laboratorium dan Simulator PKTJ',
                'bentuk' => 'Softcopy',
                'waktu' => '2023',
                'tempat' => 'Tegal',
                'retensi' => 'Selama Berlaku (Direvisi Berkala)',
                'link' => 'https://drive.google.com/file/d/1DUFV_F1NHCdS8rp7LhaDtBgKvF99irdJ/view?usp=sharing',
            ],
            [
                // Row 32: Realtime Social Media Consultation Sheet (Year 2026)
                'judul' => 'Laporan Rekapitulasi Pertanyaan Masuk dan Konsultasi Layanan Informasi Publik di Media Sosial PKTJ Tahun 2026',
                'ringkasan' => 'Lembar rekapitulasi interaktif monitoring pertanyaan publik, permohonan informasi, dan konsultasi masyarakat melalui kanal media sosial resmi PKTJ Tegal Tahun 2026.',
                'pejabat' => 'Tim Pokja Humas dan PPID PKTJ',
                'penerbit' => 'Tim Pengelola Media Sosial & Layanan Informasi Publik',
                'bentuk' => 'Google Spreadsheet (Realtime Online)',
                'waktu' => '2026',
                'tempat' => 'Tegal',
                'retensi' => '1 Tahun',
                'link' => 'https://docs.google.com/spreadsheets/d/1q8R8llMqjE8wNysRQ39q8vafcsXcvKxNRSEkIe-JR_c/edit?usp=sharing',
            ],
        ];

        foreach ($setiapSaatData as $item) {
            $insertItem('informasi-setiap-saat', $item);
        }
    }
}
