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

        // 3. Clean unverified rows from informasi_berkalas (keep only DIPA)
        if (Schema::hasTable('informasi_berkalas')) {
            DB::table('informasi_berkalas')->where('file_path', 'not like', '%DIPA%')->delete();
        }

        // 4. Clean unverified rows from informasi_sertamertas
        if (Schema::hasTable('informasi_sertamertas')) {
            DB::table('informasi_sertamertas')->delete();
        }

        // 5. Clean daftar_informasis (keep informasi-dikecualikan)
        if (Schema::hasTable('daftar_informasis')) {
            DB::table('daftar_informasis')->where('kategori', '!=', 'informasi-dikecualikan')->delete();
        }

        // 6. ALL BERKALA ITEMS (20 from Excel)
        $berkalaItems = json_decode(<<<'JSON'
[
  {
    "row": 7,
    "no": 1.0,
    "kategori": "informasi-berkala",
    "judul": "Akreditasi Prodi",
    "ringkasan": "Dokumen Laporan Evaluasi Diri Program Studi (LED), dan Laporan Kinerja Program Studi (LKPS) Prodi RSTJ, TRO, TO yang di Upload pada sistem SAKTI Lam Teknik untuk Akreditasi Prodi",
    "pejabat": "Ka SPM",
    "penerbit": "Tim SPM dan masing-masing Prodi",
    "bentuk": "Soft Copy",
    "waktu": "Tegal, 2025",
    "retensi": "5 tahun",
    "col_used": 13,
    "label": "Salinan led_211432025 (Informasi Publik) RSTJ_TERSENSOR.pdf\n\nSalinan led_211332025 TO_TERSENSOR.pdf\n\nSalinan led_2112325_TRO TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1rvltyYA70k88Icn1dUpuyD9jpSlhhdDY/view?usp=drive_link"
  },
  {
    "row": 8,
    "no": 2.0,
    "kategori": "informasi-berkala",
    "judul": "Audit Mutu Internal",
    "ringkasan": "Audit Mutu Internal Tahun 2025 yang dilakukan oleh Auditor internal kepada masing-masing bagian atau Auditee",
    "pejabat": "Ka SPM",
    "penerbit": "Tim SPM dan Auditor",
    "bentuk": "Soft Copy",
    "waktu": "Tegal, 2025",
    "retensi": "2 tahun",
    "col_used": 13,
    "label": "LAPORAN AMI 2025_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1k9sOdvKbToFwcTiE2McZ2B73KO0_4fkY/view?usp=drive_link"
  },
  {
    "row": 9,
    "no": 3.0,
    "kategori": "informasi-berkala",
    "judul": "Jadwal Kegiatan Softskill Taruna Tahun 2025",
    "ringkasan": "Jadwal kegiatan softskill taruna tentang literasi kesehatan menta; tahun 2025",
    "pejabat": "Pengasuh Praja",
    "penerbit": "Pusat Pembangunan Karakter",
    "bentuk": "Softfile",
    "waktu": "Tegal, 2025",
    "retensi": "5 Tahun",
    "col_used": 13,
    "label": "JADWAL KEGIATAN SOFTSKILL LITERASI KESEHATAN MENTAL_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1xPtTCgRHcI_uA9vlTRv2QvYPm42DINeH/view?usp=drive_link"
  },
  {
    "row": 11,
    "no": 5.0,
    "kategori": "informasi-berkala",
    "judul": "Jadwal Perkuliahan",
    "ringkasan": "Membahas ploting dosen terlebih dahulu untuk penyusunan Jadwal Perkuliahan/ semester",
    "pejabat": "Kepala Progam Studi Diploma III Teknologi Otomotif (TO)",
    "penerbit": "Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 Bulan",
    "col_used": 13,
    "label": "Jadwal TO Semester Ganjil TA 2025-2026_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1tY4S4T279H3GIRLw1Pkd96TBUZdNQrJS/view?usp=drive_link"
  },
  {
    "row": 13,
    "no": 7.0,
    "kategori": "informasi-berkala",
    "judul": "Laporan Kegiatan Pengawasan Mutu dan Manajemen Sistem Penyelenggaraan Makanan",
    "ringkasan": "Laporan kegiatan pengawasan mutu dan manajemen sistem penyelenggawaan makanan, yang berisi evaluasi penyelenggaraan permakanan taruna selama tahun 2025",
    "pejabat": "Nutrisionis Terampil",
    "penerbit": "Pusat Pembangunan Karakter",
    "bentuk": "Softfile",
    "waktu": "Tegal, 2025",
    "retensi": "5 Tahun",
    "col_used": 13,
    "label": "Salinan 1. LAPORAN MSPM JANUARI_TERSENSOR.pdf\n\nSalinan 2. LAPORAN MSPM FEBRUARI_TERSENSOR.pdf\n\nSalinan 3. LAPORAN MSPM MARET_TERSENSOR.pdf\n\nSalinan 4. LAPORAN MSPM APRIL_TERSENSOR.pdf\n\nSalinan 5. LAPORAN MSPM MEI_TERSENSOR.pdf\n\nSalinan 6. LAPORAN MSPM JUNI_TERSENSOR.pdf\n\nSalinan 7. LAPORAN MSPM JULI_TERSENSOR.pdf\n\nSalinan 8. LAPORAN MSPM AGUSTUS_TERSENSOR.pdf\n\nSalinan 9. LAPORAN MSPM SEPTEMBER_TERSENSOR.pdf\n\nSalinan 10. LAPORAN MSPM OKTOBER_TERSENSOR.pdf\n\nSalinan 11. LAPORAN MSPM NOVEMBER_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1lbc6mAZtkDVIkVrpsQg8uuYBn_FL33zn/view?usp=drive_link"
  },
  {
    "row": 14,
    "no": 8.0,
    "kategori": "informasi-berkala",
    "judul": "Laporan Kegiatan Pengukuran Indeks Massa Tubuh (IMT) Taruna Tahun 2025",
    "ringkasan": "Laporan kegiatan pengukuran Indeks Massa Tubuh (IMT) yang berisi hasil pengukuran Indeks Massa Tubuh (IMT) Taruna pada Semester 1 dan Semester 2 Tahun 2025",
    "pejabat": "Nutrisionis Terampil",
    "penerbit": "Pusat Pembangunan Karakter",
    "bentuk": "Softfile",
    "waktu": "Tegal, 2025",
    "retensi": "5 Tahun",
    "col_used": 13,
    "label": "Salinan 1. Laporan Kegiatan IMT Maret 2025_TERSENSOR.pdf\n\nSalinan 2. Laporan Kegiatan IMT Agustus 2025_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1AzLms44HlcLDJncxnUcDV_wFZZOgxdch/view?usp=drive_link"
  },
  {
    "row": 15,
    "no": 9.0,
    "kategori": "informasi-berkala",
    "judul": "Laporan Kegiatan Softkill Taruna Tahun 2025",
    "ringkasan": "Laporan kegiatan softkill taruna tentang literasi kesehatan mental tahun 2025",
    "pejabat": "Pengasuh Praja",
    "penerbit": "Pusat Pembangunan Karakter",
    "bentuk": "Softfile",
    "waktu": "Tegal, 2025",
    "retensi": "5 Tahun",
    "col_used": 12,
    "label": "JADWAL KEGIATAN SOFTSKILL LITERASI KESEHATAN MENTAL (Informasi Publik) (2).pdf",
    "link": "https://drive.google.com/file/d/1IfqfbuDqsbUskq1H_tFHUwRJcxuoynga/view?usp=drive_link"
  },
  {
    "row": 17,
    "no": 11.0,
    "kategori": "informasi-berkala",
    "judul": "Laporan Penilian Samapta Periodik Taruna Tahun 2025",
    "ringkasan": "Laporan penilaian samapta periodik berisi hasil penilaian samapta atau kebugaran jasmani taruna yang dilakukan pada semester ganjil dan semester genap tahun 2025",
    "pejabat": "Pengasuh Praja",
    "penerbit": "Pusat Pembangunan Karakter",
    "bentuk": "Softfile",
    "waktu": "Tegal, 2025",
    "retensi": "5 Tahun",
    "col_used": 13,
    "label": "Salinan 1. LAPORAN HASIL TES KESAMAPTAAN TARUNA SEMESTER GANJIL_TERSENSOR.pdf \n\nSalinan 2. LAPORAN HASIL TES KESAMAPTAAN TARUNA SEMESTER GENAP_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1dklOY3q0RlCz6m-NTLlgjwG1mG1anUrk/view?usp=drive_link"
  },
  {
    "row": 19,
    "no": 13.0,
    "kategori": "informasi-berkala",
    "judul": "Laporan Perkuliahan Semester Genap",
    "ringkasan": "Laporan Perkuliahan Semester Genap",
    "pejabat": "Kepala Program Studi RSTJ",
    "penerbit": "Program Studi RSTJ",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "selama masih berlaku",
    "col_used": 13,
    "label": "Laporan Perkuliahan Semester Genap 2024_2025 (Informasi Publik) TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1whVnOxu2OAIrLjGQOi4UVnSODDvWSFtN/view?usp=drive_link"
  },
  {
    "row": 21,
    "no": 15.0,
    "kategori": "informasi-berkala",
    "judul": "Laporan Tracer Study 2025",
    "ringkasan": "Laporan ini merupakan hasil dari kegiatan tracer study yang dilaksanakan\nterhadap lulusan tahun 2024 dan 2023 dari tiga program studi, yaitu Sarjana Terapan\nRekayasa Sistem Transportasi Jalan (RSTJ), Sarjana Terapan Teknologi Rekayasa\nOtomotif (TRO), dan Diploma III Teknologi Otomotif (TO).",
    "pejabat": "Katim Substansi Bidang Administrasi Ketarunaan dan Alumni",
    "penerbit": "Tim Administrasi Ketarunaan dan Alumni",
    "bentuk": "softcopy dan hardcopy",
    "waktu": "Tegal, 2025",
    "retensi": "5 (lima) tahun",
    "col_used": 13,
    "label": "Laporan Tracer Study 2025 (fix) (InformasI Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1Z03rj5TTeSRbyoJbvoI1OVNeHDeJnmr2/view?usp=drive_link"
  },
  {
    "row": 25,
    "no": 19.0,
    "kategori": "informasi-berkala",
    "judul": "Pelaksanaan Ujikom Andalalin",
    "ringkasan": "Diawali dengan kegiatan Pra Ujikom Penilai Andalalin pd tgl 14 s.d 15 Agustus 2025dan di lanjutkan dengan Ujikom Penilai Andalalin pd tgl 19 s.d 21 Agustus 2025",
    "pejabat": "Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)",
    "penerbit": "Prodi RSTJ Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "12 bulan",
    "col_used": 13,
    "label": "laporan ujikom andalalin 2025 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1hgqfwqJATIAUnQMK89_WqFOsXvgNyxLq/view?usp=drive_link"
  },
  {
    "row": 26,
    "no": 20.0,
    "kategori": "informasi-berkala",
    "judul": "Pelaksanaan Ujikom Pembantu PKB",
    "ringkasan": "Diawali dengan kegiatan Pra Ujikom Pembantu PKB pd tgl 13 s.d 15 dan di lanjutkan dengan Ujikom Pembantu PKB pd tgl 19 s.d 21 Agustus 2025 yang diikuti oleh 31 Mahasiswa/i Mandiri",
    "pejabat": "Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)",
    "penerbit": "Prodi TRO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "1 Tahun",
    "col_used": 13,
    "label": "Laporan Ujikom Pembantu PKB Tahun 2025 (Informasi Publik) TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1bkVuYjckwiflyopuFsEhQn75Jr3KUAmn/view?usp=drive_link"
  },
  {
    "row": 27,
    "no": 21.0,
    "kategori": "informasi-berkala",
    "judul": "Pelaksanaan Ujikom Pemeliharaan Jalan",
    "ringkasan": "Diawali dengan kegiatan Pelatihan Pemeliharaan Jalan pd tgl 15 Agustus 2025 dan di lanjutkan dengan Ujikom/Assesment Pemeliharaan Jalan pd tgl 28 Agustus 2025",
    "pejabat": "Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)",
    "penerbit": "Prodi RSTJ Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "12 bulan",
    "col_used": 13,
    "label": "Salinan LaporanPKS_Laporan_uji Kompetensi Peneliharaan Jalan (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1NhA8-ImFldPpGCTGJm0YzEnmSK4zgJnn/view?usp=drive_link"
  },
  {
    "row": 29,
    "no": 23.0,
    "kategori": "informasi-berkala",
    "judul": "Pelaksanaan Ujikom Sistem Manajemen Keselamatan",
    "ringkasan": "Diawali dengan kegiatan Pra Ujikom SMK pd tgl 13 s.d 14 dan di lanjutkan dengan Ujikom SMK pd tgl 18 s.d 19 Agustus 2025 yang diikuti oleh 57 Mahasiswa/i Pola Pembibitan (Polbit)",
    "pejabat": "Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)",
    "penerbit": "Prodi TRO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "1 Tahun",
    "col_used": 13,
    "label": "Laporan Ujikom SMK PAU 2025_fix (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/13R7DxU7BzK53vXcvyDPZaGFA2HQvucVz/view?usp=drive_link"
  },
  {
    "row": 30,
    "no": 24.0,
    "kategori": "informasi-berkala",
    "judul": "Pelaksanaan UTS dan UAS",
    "ringkasan": "Pelaksanaan mengikuti Kalender Akademik di dukung dengan 7x pertemuan pembelajaran, minimal 6x pertemuan untuk pelaksanaan kegiata UTS dan UAS 14x pertemuan",
    "pejabat": "Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)",
    "penerbit": "Prodi RSTJ Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 bulan",
    "col_used": 13,
    "label": "Salinan NOTA DINAS 86 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1skDjqrJrioh7lhKpvN1fAWYkSsqPKFj-/view?usp=drive_link"
  },
  {
    "row": 31,
    "no": 25.0,
    "kategori": "informasi-berkala",
    "judul": "Pelaksanaan UTS dan UAS",
    "ringkasan": "Pelaksanaan mengikuti Kalender Akademik di dukung dengan 7x pertemuan pembelajaran, minimal 6x pertemuan untuk pelaksanaan kegiata UTS dan UAS 14x pertemuan",
    "pejabat": "Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)",
    "penerbit": "Prodi TRO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 Bulan",
    "col_used": 13,
    "label": "Nodin Pelaksanaan UAS Ganjil 25-26 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1ez4_J3ZyLFN41OY-tBchy3W0k8AeOAAx/view?usp=drive_link"
  },
  {
    "row": 32,
    "no": 26.0,
    "kategori": "informasi-berkala",
    "judul": "Pelaksanaan UTS dan UAS",
    "ringkasan": "Pelaksanaan mengikuti Kalender Akademik di dukung dengan 7x pertemuan pembelajaran, minimal 6x pertemuan untuk pelaksanaan kegiata UTS dan UAS 14x pertemuan",
    "pejabat": "Kepala Progam Studi Diploma III Teknologi Otomotif (TO)",
    "penerbit": "Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 Bulan",
    "col_used": 13,
    "label": "Pengumuman UTS GANJIL 20252026 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1hlV5Ac65SPio7VLsn9E8Zvx5Deecatxe/view?usp=drive_link"
  },
  {
    "row": 39,
    "no": 33.0,
    "kategori": "informasi-berkala",
    "judul": "Screening gigi kepada taruna/i PKTJ",
    "ringkasan": "Kegiatan rutin screening TBC yang merupakan program dari Dinas Kesehatan Kota Tegal",
    "pejabat": "Kanit Kesehatan",
    "penerbit": "Nakes Unit Kesehatan",
    "bentuk": "Softfile",
    "waktu": "PKTJ tegal",
    "retensi": "5 tahun",
    "col_used": 13,
    "label": "Laporan Kegiatan Skringing TB (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1cs5uk0mhMAnJA50LLm7MTgTkC9a7fULp/view?usp=drive_link"
  },
  {
    "row": 40,
    "no": 34.0,
    "kategori": "informasi-berkala",
    "judul": "Surveillance ISO 21001 : 2018",
    "ringkasan": "Audit Surveillance dari SGS Indonesia, Penerapan ISO 21001 : 2018.\n Standar ini menekankan pentingnya kepuasan peserta didik, proses pembelajaran yang efektif, pemenuhan kebutuhan seluruh pemangku kepentingan pendidikan, serta perbaikan berkelanjutan dalam layanan pendidikan",
    "pejabat": "Ka SPM",
    "penerbit": "Tim SPM",
    "bentuk": "Soft Copy",
    "waktu": "Tegal, 2025",
    "retensi": "2 tahun",
    "col_used": 13,
    "label": "FULL LAPORAN HASIL KEGIATAN SURVEILLANCE ISO 21001;2018 C2V3 (Informasi Publik) TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1RP4Mq6eUcA24hvZMDNmL7XxPp27A_Vhz/view?usp=drive_link"
  },
  {
    "row": 41,
    "no": 35.0,
    "kategori": "informasi-berkala",
    "judul": "Survey Kepuasan Masyarakat Semester I",
    "ringkasan": "Laporan berisi nilai Indeks kepuasan masyarakat dan nilai indeks presepsi korupsi",
    "pejabat": "Ka SPM",
    "penerbit": "Tim SPM",
    "bentuk": "Soft Copy dan Hard Copy",
    "waktu": "Tegal, 2025",
    "retensi": "1 tahun",
    "col_used": 13,
    "label": "LAPORAN IPK PKTJ SEMESTER 1 2025.pdf\n\nLAPORAN IKM PKTJ SEMESTER 1 2025.pdf",
    "link": "https://drive.google.com/file/d/1gYZNEK_IFgG0hlYSmbHXG9R1Q688Z68_/view?usp=drive_link"
  }
]
JSON
        , true);

        if (!empty($berkalaItems)) {
            foreach ($berkalaItems as $item) {
                $richContent = '<p>' . htmlspecialchars($item['ringkasan']) . '</p>' .
                    '<div style="margin-top: 14px; padding: 14px 18px; background-color: #f0f7ff; border-left: 4px solid #004a99; border-radius: 8px;">' .
                    '<p style="margin: 0; font-size: 14px; color: #1e293b;">' .
                    '<strong>Tautan Dokumen Resmi Google Drive:</strong><br>' .
                    '<a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700; display: inline-block; margin-top: 6px;">' .
                    '<i class="fas fa-external-link-alt" style="margin-right: 6px;"></i> Buka Dokumen (Google Drive)' .
                    '</a>' .
                    '</p>' .
                    '</div>';

                $judul = $item['judul'];
                if (isset($item['label']) && str_contains($item['label'], 'TRO')) {
                    $judul .= ' - Prodi TRO';
                } elseif (isset($item['label']) && str_contains($item['label'], 'TO')) {
                    $judul .= ' - Prodi TO';
                } elseif (isset($item['label']) && str_contains($item['label'], 'RSTJ')) {
                    $judul .= ' - Prodi RSTJ';
                }

                DB::table('daftar_informasis')->insert([
                    'judul_informasi'    => $judul,
                    'kategori'           => 'informasi-berkala',
                    'tipe_informasi'     => 'dokumen',
                    'isi_informasi'      => $richContent,
                    'pejabat_penguasa'   => $item['pejabat'] ?: 'Direktur & Manajemen PKTJ',
                    'penerbit_informasi' => $item['penerbit'] ?: 'PKTJ Tegal',
                    'tempat_pembuatan'   => 'Tegal',
                    'penanggung_jawab'   => $item['pejabat'] ?: 'Ka Tim Substansi',
                    'waktu_pembuatan'    => $item['waktu'] ?: 'Tegal, 2025',
                    'bentuk_informasi'   => $item['bentuk'] ?: 'Softcopy',
                    'jangka_waktu'       => $item['retensi'] ?: '1 Tahun',
                    'file_informasi'     => $item['link'],
                    'aktif'              => 1,
                    'is_blurred'         => 0,
                    'bisa_download'      => 1,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);
            }
        }

        // 7. ALL SETIAP SAAT ITEMS (19 from Excel)
        $setiapSaatItems = json_decode(<<<'JSON'
[
  {
    "row": 8,
    "no": 1.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Dokumen Kurikulum",
    "ringkasan": "Hasil review kurikulum Prodi RSTJ. Kurikulum lama (tahun 2020) diganti dengan kurikulum baru (2025)",
    "pejabat": "Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)",
    "penerbit": "Prodi RSTJ Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "Selama masih berlaku",
    "col_used": 12,
    "label": "KP-BPSDMP 173 Tahun 2025_RSTJ-1_SK Kurikulum 2025_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1Yq1cQU5fVWRM0ogGBIlONl-p6AtbHcOT/view?usp=drive_link"
  },
  {
    "row": 9,
    "no": 2.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Dokumen Kurikulum",
    "ringkasan": "Hasil review kurikulum Prodi TRO. Kurikulum lama (tahun 2020) diganti dengan kurikulum baru (2025)",
    "pejabat": "Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)",
    "penerbit": "Prodi TRO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2026",
    "retensi": "Selama masih berlaku",
    "col_used": 12,
    "label": "Kurikulum TRO 2025 KP-BPSDMP 181 Tahun 2025_TRO_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/14Z2niInObd5DyMfw1LL_9QYdX3jGbPS6/view?usp=drive_link"
  },
  {
    "row": 10,
    "no": 3.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Dokumen Kurikulum",
    "ringkasan": "Kurikulum Prodi TO. Kurikulum lama (tahun 2020) diganti dengan kurikulum baru (2025)",
    "pejabat": "Kepala Progam Studi Diploma III Teknologi Otomotif (TO)",
    "penerbit": "Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "Selama masih berlaku",
    "col_used": 12,
    "label": "KURIKULUM D3 TO 2020 PKTJ_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1GRN5PAXrJwYUc01QqVskbyHpF-Uo-WKi/view?usp=drive_link"
  },
  {
    "row": 11,
    "no": 4.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Dokumen Kurikulum",
    "ringkasan": "Hasil review kurikulum Prodi TO. Kurikulum lama (tahun 2020) diganti dengan kurikulum baru (2025)",
    "pejabat": "Kepala Progam Studi Diploma III Teknologi Otomotif (TO)",
    "penerbit": "Prodi Diploma III TO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "Selama masih berlaku",
    "col_used": 12,
    "label": "KURIKULUM HASIL REVIEW D3 TO 2025 SAH_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1JzIqbOa5BZy49tJYKfdICmkh1Ysi0yNQ/view?usp=drive_link"
  },
  {
    "row": 12,
    "no": 5.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Kegiatan Pembelajaran Teaching Factory (TeFa)",
    "ringkasan": "Pedoman TeFa RSTJ",
    "pejabat": "Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)",
    "penerbit": "Prodi RSTJ Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 bulan",
    "col_used": 12,
    "label": "PedomanTefa RSTJ.pdf",
    "link": "https://drive.google.com/file/d/1Q4KCRsbVOCqY2VTlOhwZ8OOnBRmnkN54/view?usp=drive_link"
  },
  {
    "row": 13,
    "no": 6.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Kegiatan Pembelajaran Teaching Factory (TeFa)",
    "ringkasan": "Progres TeFa RSTJ",
    "pejabat": "Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)",
    "penerbit": "Prodi RSTJ Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 bulan",
    "col_used": 12,
    "label": "Progres TEFA RSTJ Ganjil 2025-2026.pdf",
    "link": "https://drive.google.com/file/d/1xYhKYTH3JSQyrZsnV09DR28GIpPgRq9l/view?usp=drive_link"
  },
  {
    "row": 14,
    "no": 7.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Kegiatan Pembelajaran Teaching Factory (TeFa)",
    "ringkasan": "Produk TeFa RSTJ Kelas A",
    "pejabat": "Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)",
    "penerbit": "Prodi RSTJ Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 bulan",
    "col_used": 12,
    "label": "Preview Produk TeFa RSTJ Kelas A Kelompok 1_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas A Kelompok 2_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas A Kelompok 3_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas A Kelompok 4_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas A Kelompok 5_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas A Kelompok 6_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1a-yG1DvOuosOMRKt5-77hUGzlL5N3_vo/view?usp=drive_link"
  },
  {
    "row": 15,
    "no": 8.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Kegiatan Pembelajaran Teaching Factory (TeFa)",
    "ringkasan": "Produk TeFa RSTJ Kelas B",
    "pejabat": "Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)",
    "penerbit": "Prodi RSTJ Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 bulan",
    "col_used": 12,
    "label": "Preview Produk TeFa RSTJ Kelas B Kelompok 1_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas B Kelompok 2_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas B Kelompok 3_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas B Kelompok 4_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas B Kelompok 5_TERSENSOR.pdf\n\nPreview Produk TeFa RSTJ Kelas B Kelompok 6_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1z5qQ6l5LGVjSaClxwCaSDIYDwm3ds66-/view?usp=drive_link"
  },
  {
    "row": 16,
    "no": 9.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Kegiatan Pembelajaran Teaching Factory (TeFa)",
    "ringkasan": "SK PENUNJUKAN TIM TeFa 2025",
    "pejabat": "Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)",
    "penerbit": "Prodi TRO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 Bulan",
    "col_used": 12,
    "label": "SK PENUNJUKAN TIM TeFa 2025 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1QFpmVataYKiB9UNgr_l9-p0Z7m4dchhG/view?usp=drive_link"
  },
  {
    "row": 17,
    "no": 10.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Kegiatan Pembelajaran Teaching Factory (TeFa)",
    "ringkasan": "Produk TeFa TRO",
    "pejabat": "Kepala Progam Studi Teknologi Rekayasa Otomotif (TRO)",
    "penerbit": "Prodi TRO Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "6 Bulan",
    "col_used": 12,
    "label": "TeFa TRO",
    "link": "https://drive.google.com/drive/folders/1-KoetVPqIyiJ3VXd3EaVwpZkaC2bzRcB?usp=drive_link"
  },
  {
    "row": 19,
    "no": 12.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Kontrak",
    "ringkasan": "Kontrak adalah kesepakatan atau perjanjian mengikat secara hukum antara dua pihak atau lebih yang menciptakan kewajiban tertentu bagi masing-masing pihak, mengatur hak dan tanggung jawab mereka, serta dapat ditegakkan secara hukum jika terjadi wanprestasi, bisa dalam bentuk lisan atau tulisan, dan seringkali merupakan bagian dari perjanjian yang lebih luas (perikatan).",
    "pejabat": "Katim Kerjasama",
    "penerbit": "Tim Kerjasama",
    "bentuk": "softcopy dan hardcopy",
    "waktu": "Tegal, 2025",
    "retensi": "1 tahun",
    "col_used": 12,
    "label": "10.1-Kontrak Pengujian Ketidakrataan dan Kekesatan Jalan di Ruas Jalan Tol PT PPTR Tahun 2025-PKTJ Tegal (Informasi Publik)_TERSENSOR.pdf\n\nKontrak Swakelola Dishub Kab. Bandung Inspeksi Keselamatan Jalan dgn Hawkeye 2025 (Informasi Publik)_TERSENSOR.pdf\n\nKontrak Swakelola Penyusunan Dokumen RAK Kab. Blitar 2025 (Informasi Publik)_TERSENSOR.pdf\n\nPokok Perjanjian - Kontrak DKI SPAU 2025_0001 (Informasi Publik)_TERSENSOR.pdf\n\nPOKOK PERJANJIAN KONTRAK penyusunan naskah akademik Ranperda Dishub Kab Blitar 2025 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1LUoIDHDwphNHlW6a0lx1v1waAobKJPxy/view?usp=drive_link"
  },
  {
    "row": 22,
    "no": 15.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Laporan kebersihan asrama",
    "ringkasan": "pengecekan kebersihan asrama",
    "pejabat": "kanit asrama",
    "penerbit": "unit asrama",
    "bentuk": "softfile",
    "waktu": "PKTJ Tegal di tiap akhir bulan",
    "retensi": "2 tahun",
    "col_used": 11,
    "label": "Informasi Publik Laporan Kebersihan Asrama",
    "link": "https://drive.google.com/drive/folders/1qU81c6u8w7zy6oCCF2mLxN_FxIouESxW?usp=drive_link"
  },
  {
    "row": 23,
    "no": 16.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Laporan penanganan keluhan asrama",
    "ringkasan": "tindak lanjut penanganan kekuhan oenghuni asrama",
    "pejabat": "kanit asrama",
    "penerbit": "unit asrama",
    "bentuk": "softfile",
    "waktu": "PKTJ Tegal di tiap akhir bulan",
    "retensi": "2 tahun",
    "col_used": 11,
    "label": "Informasi Publik Laporan Penanganan Keluhan Asrama",
    "link": "https://drive.google.com/drive/folders/1v8dWY5Rpkn0raSdHKxtx21oGclXt0-W_?usp=drive_link"
  },
  {
    "row": 25,
    "no": 18.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Laporan perbaikan fasilitas asrama",
    "ringkasan": "perbaikan yang dilakukan oleh tim unit asrama",
    "pejabat": "kanit asrama",
    "penerbit": "unit asrama",
    "bentuk": "softfile",
    "waktu": "PKTJ Tegal di tiap akhir bulan",
    "retensi": "2 tahun",
    "col_used": 11,
    "label": "Informasi Publik Laporan Perbaikan Fasilitas Asrama",
    "link": "https://drive.google.com/drive/folders/1dZYayP713qQ2FLxguvs5wGmFc1vv9Sel?usp=drive_link"
  },
  {
    "row": 26,
    "no": 21.0,
    "kategori": "informasi-setiap-saat",
    "judul": "MoU",
    "ringkasan": "MoU (Memorandum of Understanding) adalah nota kesepahaman atau perjanjian pendahuluan yang berisi pernyataan niat dan kesepakatan awal antara dua pihak atau lebih sebelum membuat kontrak formal yang lebih mengikat secara hukum. MoU berfungsi sebagai landasan awal untuk menjajaki kerja sama, menguraikan tujuan, dan ruang lingkup, namun biasanya tidak mengikat secara hukum seperti kontrak, kecuali ada klausul khusus yang ditambahkan",
    "pejabat": "Katim Kerjasama",
    "penerbit": "Tim Kerjasama",
    "bentuk": "softcopy dan hardcopy",
    "waktu": "Tegal, 2025",
    "retensi": "5 tahun",
    "col_used": 12,
    "label": "Kesepakatan Bersama PJ 15 Tahun 2025 PKTJ x SUZUKI (Informasi Publik)_TERSENSOR.pdf\n\nBA Serah Terima Unit Kendaraan Suzuki Ertiga (Informasi Publik)_TERSENSOR.pdf\n\nKesepakatan Bersama PJ-PKTJ 38 2025 PKTJ x Universitas Harkat Negeri Tegal (Informasi Publik)_TERSENSOR.pdf\n\nKesepakatan Bersama PJ-PKTJ 68 2025 PKTJ x PENS Tridharma PT (Informasi Publik)_TERSENSOR.pdf\n\nLoI PT. Hino Motor Sales Indonesia 2025 (Informasi Publik)_TERSENSOR.pdf\n\nMoU PJ-PKTJ 24 2025PKTJ x Duta Cemerlang Motors Duta Hino (Informasi Publik)_TERSENSOR.pdf\n\nMoU PJ-PKTJ 30 2025PKTJ x Poltek Harber (Informasi Publik)_TERSENSOR.pdf\n\nMoU PJ-PKTJ 32 2025 PKTJ x PT. Yanbu Al Bahar (Informasi Publik)_TERSENSOR.pdf\n\nMoU PJ-PKTJ 40 2025 PKTJ x Universitas Muhadi (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1lm5RH7NM7YTS5OETZyY1nJ2iLMxgRWtD/view?usp=drive_link"
  },
  {
    "row": 29,
    "no": 24.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Perjanjian Kerja Sama",
    "ringkasan": "Perjanjian Kerja Sama (PKS) adalah kesepakatan formal dan mengikat secara hukum antara dua pihak atau lebih untuk bekerja sama mencapai tujuan bersama, yang merinci hak, kewajiban, tanggung jawab, dan pembagian sumber daya untuk suatu proyek atau usaha tertentu, seringkali lebih mengikat daripada MoU (Memorandum of Understanding) yang bersifat pra-kontrak.",
    "pejabat": "Katim Kerjasama",
    "penerbit": "Tim Kerjasama",
    "bentuk": "softcopy dan hardcopy",
    "waktu": "Tegal, 2025",
    "retensi": "5 tahun",
    "col_used": 12,
    "label": "IA PJ-PKTJ 21 2025 PKTJ x Psikologi Undip (Informasi Publik)_TERSENSOR.pdf\n\nIA PJ-PKTJ 28 2025 PKTJ x Psikologi Undip Gel II (Informasi Publik)_TERSENSOR.pdf\n\nIA PJ-PKTJ 44 2025 PKTJ x Psikologi Undip Gel III (Informasi Publik)_TERSENSOR.pdf\n\nKKS PJ-PKTJ 31 2025 PKTJ x Dishub Kab Bandung IKJ-Hawkeye (Informasi Publik)_TERSENSOR.pdf\n\nKKS PJ-PKTJ 48 2025 PKTJ x Dishub Kab Blitar Penyusunan dokumen RAK (Informasi Publik)_TERSENSOR.pdf\n\nKKS PJ-PKTJ 78 2025 PKTJ x Dishub Kab Blitar Penyusunan Naskah Kademik Ranperda (Informasi Publik)_TERSENSOR.pdf\n\nPerjanjian Sewa Kantin PJ-PKTJ 62 2025 Sri Hartati (Informasi Publik)_TERSENSOR.pdf\n\nPKS kontrak kekesatan HK Palindra 2025 (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ 1 2025 PKTJ x KODIM 0712 TEGAL (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ 10 2025 PKTJ  x Dinas Pendidikan Wilayah XI (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ 13 2025 PKTJ x  PertaminaPatraNiaga Maos (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ 16 Tahun 2025 PKTJ x SUZUKI (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ 17 tahun 2025 PKTJ x BP2TD Mempawah (diklat) (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ 18 tahun 2025 PKTJ x PT Arah Environmental Indonesia (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ 27 2025 PKTJ x PTDI sewa Hawkeye (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ PKTJ 77 2025 PKTJ x BP3KSDMT Ciwidey ttg madatukar 2025 (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ PKTJ 80 2025 PKTJ x FPPTI Jawa Tengah ttg Konsorsium e jurnal cengage learning (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 11 2025 PKTJ x DKI JAKARTA (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 20 2025 PKTJ x Psikologi Undip (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 23 2025 PKTJ x LSP P1 PKTJ (Informasi Publik)_TERSENSOR.pdf\n\nPKS Pj-PKTJ 25 2025 PKTJ x IBL (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 26 2025 PKTJ x CV. RAN Babel 2025 (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 29 2025 PKTJ x IBL tes kesehatan sipencatar mandiri (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 33 2025 PKTJ x Intakindo (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 34 2025 PKTJ x PBTR uji IRI Pemalang Batang (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 39 2025 PKTJ x BPPTD mempawah diklat MRLL (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 41 2025 PKTJ x Direktorat Prasarana Ditjenhubdat (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 42 PKTJ x PIP Universitas Padjadjaran (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 43 2025 PKTJ x RS Ciremai tes kesehatan sipencatar (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 46 Tahun 2025 PKTJ x PTDI STTD alat kebugaran jasmani (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 47 2025 PKTJ x Universitas Harkat Negeri Tes Potensi Akademik (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 49 2025 PKTJ x PPTR IRI dan Skid 2025 (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 51 2025 PKTJ x HIMPSI (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 54 2025 PKTJ x BPPTD Mempawah ttg DPM (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 56 2025 Setditjen ITM x UPT BPSDMP (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 58 2025 PKTJ x PT Bank Tabungan Negara BTN ttg Deposito (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 59 2025 PKTJ x PT. SMR Uji IRI Tol Kanci Pejagan (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 60 2025 PKTJ x Dishub Kab. Blitar DPM 2025 (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 63 2025 PKTJ x Setditjen Hubdat Diklat, Pemanfaatan aset, penelitian bid transdar (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 64 2025 PKTJ x Dishub Kab. Boyolali Studi kelayakan shelter halte (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 65 2025 PKTJ x Dishub Kab Bandung DPM (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 71 2025 PKTJ x Poltrans SDP Palembang ttg DPM (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 72 2025PKTJ x Poltekbang Medan ttg DPM (Informasi Publik)_TERSENSOR.pdf\n\n\nPKS PJ-PKTJ 75 2025 PKTJ x Dishub Kab Boyolali Diklat BLU Keselamatan Dasar (Informasi Publik)_TERSENSOR.pdf\n\n\nPKS PJ-PKTJ 76 2025 PKTJ x PT Jingga Raia Berjaya ttg sewa lahan (Informasi Publik)_TERSENSOR.pdf\n\nPKS PJ-PKTJ 79 2025 PKTJ x CV Ramier Jaya Arkananta uji skid tol Betung Tempino Jambi (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1opXQdCZ9G3kKIqTcmgEcEbU-Bxjc0mUz/view?usp=drive_link"
  },
  {
    "row": 34,
    "no": 29.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Program Kerja SPI",
    "ringkasan": "Program Kerja SPI merupakan dokumen yang berisi tentang rencana tahunan kegiatan pengawasan (audit, reviu, evaluasi) untuk memastikan tujuan organisasi tercapai, pengelolaan keuangan dan aset aman, serta kepatuhan terhadap aturan, mencakup aspek kelembagaan, sistem pengendalian, SDM, dan tindak lanjut temuan audit di PKTJ.",
    "pejabat": "Kepala SPI",
    "penerbit": "SPI Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy dan Hardcopy",
    "waktu": "Tegal, 2025",
    "retensi": "1 (satu) tahun",
    "col_used": 12,
    "label": "Program Kerja SPI 2025 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/11SVPDZoPM8apJYh8KDgFGrip_92Kz9zm/view?usp=drive_link"
  },
  {
    "row": 38,
    "no": 33.0,
    "kategori": "informasi-setiap-saat",
    "judul": "Roadmap Penelitian Dan Pengabdian Kepada Masyarakat",
    "ringkasan": "Roadmap Penelitian Dan Pengabdian Kepada Masyarakat Berisi Tema-Tema Penelitian dan PKM selama 5 tahun",
    "pejabat": "Kepala P3M",
    "penerbit": "P3M Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2024",
    "retensi": "5 (lima) tahun",
    "col_used": 11,
    "label": "Road Map 2024.pdf",
    "link": "https://drive.google.com/file/d/1kg1sCnGls8xv_ZQB2gVQK_Os2kLtu12a/view?usp=drive_link"
  },
  {
    "row": 46,
    "no": 41.0,
    "kategori": "informasi-setiap-saat",
    "judul": "SPK/SPMK (Surat Perjanjian Kerja)/(Surat Perintah Mulai Kerja)",
    "ringkasan": "Surat Perjanjian Kerja/Surat Perintah Kerja /Surat Perintah Mulai Kerja adalah dokumen legal yang mengikat secara hukum, berisi perintah resmi dari pemberi kerja (perusahaan/instansi) kepada pekerja/penyedia jasa untuk memulai suatu pekerjaan, serta merinci syarat-syarat kerja, hak, kewajiban, ruang lingkup pekerjaan, batas waktu (durasi), hingga biaya atau nilai kontrak, menjadikannya landasan hukum pelaksanaan proyek atau tugas",
    "pejabat": "Katim Kerjasama",
    "penerbit": "Tim Kerjasama",
    "bentuk": "softcopy dan hardcopy",
    "waktu": "Tegal, 2025",
    "retensi": "1 tahun",
    "col_used": 12,
    "label": "28-SPK Pekerjaan Jasa Uji Reflektifitas Tahap I pada Ruas Jalan Tol Pejagan Pemalang Tahun 2025-PKTJ Tegal (Informasi Publik)_TERSENSOR.pdf\n\n29.2-SPK Pekerjaan Jasa Uji Reflektifitas TW II III IV pada Ruas Jalan Tol Pejagan Pemalang Tahun 2025-PKTJ Tegal (Informasi Publik)_TERSENSOR.pdf\n\nSPK 054 pengujian IRI HAKAASTON Bakauheuni-Terbanggi Besar 2025 (Informasi Publik)_TERSENSOR.pdf\n\nSPK 055 pengujian IRI HAKAASTON Bakauheuni-Terbanggi Besar R2 R32025 (Informasi Publik)_TERSENSOR.pdf\n\nSPK Dishub Kab. Bandung Inspeksi Keselamatan Jalan dgn Hawkeye 2025 (Informasi Publik)_TERSENSOR.pdf\n\nSPK PKTJ x HK Pekanbaru Bangkinang Uji IRI 2025 (Informasi Publik)_TERSENSOR.pdf\n\nSPK PKTJ x HK Pekanbaru Bangkinang uji kekesatan 2025 (Informasi Publik)_TERSENSOR.pdf\n\nSPK PKTJ x HK Pekanbaru Dumai uji IRI 2025 (Informasi Publik)_TERSENSOR.pdf\n\nSPK PKTJ x xHK Pekanbaru Dumai Uji Kekesatan 2025 (Informasi Publik)_TERSENSOR.pdf\n\nSPK PT. PBTR Uji Reflektifitas Rambu dan Marka TW III 2025 (Informasi Publik)_TERSENSOR.pdf\n\nSPMK Dishub Kab. Bandung Inspeksi Keselamatan Jalan dgn Hawkeye 2025 (Informasi Publik)_TERSENSOR.pdf\n\nSPMK DPM Poltekbang Medan ttg DPM 2025 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1jP_z3VAlXuB4Dti4_UPhEv_GAD-rJszw/view?usp=drive_link"
  }
]
JSON
        , true);

        if (!empty($setiapSaatItems)) {
            foreach ($setiapSaatItems as $item) {
                $firstLabel = trim(explode("\n", $item['label'])[0]);
                if (empty($firstLabel)) $firstLabel = $item['judul'];

                $richContent = '<p>' . htmlspecialchars($item['ringkasan']) . '</p>' .
                    '<div style="margin-top: 14px; padding: 14px 18px; background-color: #f0f7ff; border-left: 4px solid #004a99; border-radius: 8px;">' .
                    '<p style="margin: 0; font-size: 14px; color: #1e293b;">' .
                    '<strong>Tautan Dokumen Resmi Google Drive:</strong><br>' .
                    '<a href="' . htmlspecialchars($item['link']) . '" target="_blank" rel="noopener noreferrer" style="color: #004a99; text-decoration: underline; font-weight: 700; display: inline-block; margin-top: 6px;">' .
                    '<i class="fas fa-external-link-alt" style="margin-right: 6px;"></i> ' . htmlspecialchars($firstLabel) .
                    '</a>' .
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
                    'waktu_pembuatan'    => $item['waktu'] ?: 'Tegal, 2025',
                    'bentuk_informasi'   => $item['bentuk'] ?: 'Softcopy',
                    'jangka_waktu'       => $item['retensi'] ?: '1 Tahun',
                    'file_informasi'     => $item['link'],
                    'aktif'              => 1,
                    'is_blurred'         => 0,
                    'bisa_download'      => 1,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);
            }
        }

        // 8. ALL SERTA MERTA ITEMS (11 from Excel)
        $sertaMertaItems = json_decode(<<<'JSON'
[
  {
    "row": 8,
    "no": "2.0",
    "judul": "Daftar MoU / Kerjasama",
    "ringkasan": "Dokumen kerjasama perpustakaan PKTJ dengan perpustakaan perguruan tinggi lain atau instansi.",
    "pejabat": "Kepala Unit Perpustakaan",
    "penerbit": "Unit Kerjasama / Perpustakaan PKTJ",
    "bentuk": "Hardcopy & Sofcopy",
    "waktu": "Tegal. Sesuai Tanggal MoU",
    "retensi": "Sesuai masa berlaku MoU (biasanya 3-5 tahun)",
    "col_used": 12,
    "label": "Road Map 2024.pdf\n\nProgram Kerja SPI 2025 (Informasi Publik)_TERSENSOR.pdf\n\n(NA) KERJASAMA DENGAN PERPUSTAKAAN STIKES BHAMADA SLAWI (Informasi Publik)_TERSENSOR.pdf\n\n(NA) KERJASAMA DENGAN PERPUSTAKAAN PPI CURUG (Informasi Publik)_TERSENSOR.pdf\n\n(NA) KERJASAMA DENGAN PERPUSTAKAAN POLTEKNIK HARAPAN BERSAMA TEGAL (Informasi Publik)_TERSENSOR.pdf\n\n(NA) KERJASAMA DENGAN FPPTI JAWA TENGAH (Informasi Publik)_TERSENSOR.pdf\n\n(NA) KERJASAMA DENGAN DINAS KEARSIPAN DAN PERPUSTAKAAN KOTA TEGAL (Informasi Publik)_TERSENSOR.pdf\n\n(NA) KERJASAMA DENGAN DINAS KEARSIPAN DAN PERPUSTAKAAN KABUPATEN TEGAL (Informasi Publik)_TERSENSOR.pdf\n\n(A) KERJASAMA DENGAN PERPUSTAKAAN UNIVERSITAS NEGERI YOGYAKARTA (Informasi Publik)_TERSENSOR.pdf\n\n(A) KERJASAMA DENGAN PERPUSTAKAAN UNIVERSITAS HALU OLEO KENDARI (Informasi Publik)_TERSENSOR.pdf\n\n(A) KERJASAMA DENGAN PERPUSTAKAAN UIN SUNAN GUNUNG DJATI BANDUNG (Informasi Publik)_TERSENSOR.pdf\n\n(A) KERJASAMA DENGAN PERPUSTAKAAN STIKES BHAMADA SLAWI (Informasi Publik)_TERSENSOR.pdf\n\n(A) KERJASAMA DENGAN PERPUSTAKAAN IAIN KENDARI (Informasi Publik)_TERSENSOR.pdf\n\n(A) KERJASAMA DENGAN KONSORSIUM EJOURNAL GALE FPPTI (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1EEa1yo0dCuDWgWMbFp6aUVQZiHzBlFvG/view?usp=drive_link"
  },
  {
    "row": 10,
    "no": "4.0",
    "judul": "Jumlah kunjungan pasien klinik pratama PKTJ tahun 2025",
    "ringkasan": "Kunjungan Pasien tahun 2025 meliputi taruna, pegawai, dan masyarakat umum",
    "pejabat": "Kanit Kesehatan",
    "penerbit": "Nakes Unit Kesehatan",
    "bentuk": "Softfile",
    "waktu": "PKTJ Tegal di tiap akhir bulan",
    "retensi": "5 tahun",
    "col_used": 12,
    "label": "KUNJUNGAN PASIEN JAN-NOV 2025.pdf",
    "link": "https://drive.google.com/file/d/1jY-CngE5yJKKUDvqpVAKa_SC5Ab2cFME/view?usp=sharing"
  },
  {
    "row": 12,
    "no": "6.0",
    "judul": "Laporan kebersihan asrama",
    "ringkasan": "pengecekan kebersihan asrama",
    "pejabat": "kanit asrama",
    "penerbit": "unit asrama",
    "bentuk": "softfile",
    "waktu": "PKTJ Tegal di tiap akhir bulan",
    "retensi": "2 tahun",
    "col_used": 12,
    "label": "1. LAPORAN BULAN JANUARI ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n2. LAPORAN BULAN FEBRUARI ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n3. LAPORAN BULAN MARET ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n4. LAPORAN BULAN APRIL ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n5. LAPORAN BULAN MEI ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n6. LAPORAN BULAN JUNI ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n7. LAPORAN BULAN JULI ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n8. LAPORAN BULAN AGUSTUS ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n9. LAPORAN BULAN SEPTEMBER ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n10. LAPORAN BULAN OKTOBER ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n11. LAPORAN BULAN NOVEMBER ASRAMA 2025 (Informasi Publik)_TERSENSOR.pdf\n\n12. LAPORAN  BULAN DESEMBER ASRAMA (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1kzb8Zi0KK4lMijVu55AinwblduZvE5WG/view?usp=drive_link"
  },
  {
    "row": 14,
    "no": "8.0",
    "judul": "Pemeriksaan Kesehatan Gratis Pengemudi Ojek Online Dalam Rangka Hari Perhubungan Nasional Tahun 2025",
    "ringkasan": "Kegiatan pemeriksaan kesehatan gratis meliputi pemeriksaan tekanan darah, gula darah sewaktu, kolesterol, dan asam urat bagi  pengemudi Ojek online",
    "pejabat": "Kanit Kesehatan",
    "penerbit": "Nakes Unit Kesehatan",
    "bentuk": "Softfile",
    "waktu": "PKTJ Tegal",
    "retensi": "5 tahun",
    "col_used": 12,
    "label": "Laporan Kegiatan Pemeriksaan Gratis Pengemudi Ojek Online Harbunas 2025 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1PCJ7TjFLh--7npmi85dXwP8Yi6cO6wlF/view?usp=drive_link"
  },
  {
    "row": 15,
    "no": "9.0",
    "judul": "Pemeriksaan Kesehatan Gratis Pengemudi Ojek Online Dalam Rangka HUT RI ke 80",
    "ringkasan": "Kegiatan pemeriksaan kesehatan gratis meliputi pemeriksaan tekanan darah, gula darah sewaktu, kolesterol, dan asam urat bagi  pengemudi Ojek online",
    "pejabat": "Kanit Kesehatan",
    "penerbit": "Nakes Unit Kesehatan",
    "bentuk": "Softfile",
    "waktu": "PKTJ Tegal",
    "retensi": "5 tahun",
    "col_used": 12,
    "label": "Laporan Kegiatan Pemeriksaan Gratis Pengemudi Ojek Online HUT RI (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1k1lxiDvvRFcCvI5OIfXOZbfo00Bw0sZI/view?usp=drive_link"
  },
  {
    "row": 17,
    "no": "11.0",
    "judul": "Penghapusan BMN Tahun 2025",
    "ringkasan": "Kegiatan penghapusan Barang Milik Negarai di lingkungan Politeknik Keselamatan Transportasi Jalan Tahun 2025",
    "pejabat": "Ketua Tim Bidang Umum",
    "penerbit": "Bagiaun Keuangan Umum dan Kerjasama",
    "bentuk": "Soft file",
    "waktu": "Tegal bulan Juli 2025",
    "retensi": "7 tahun",
    "col_used": 12,
    "label": "Salinan 202507231513390_Surat Rekomendasi Penghapusan BMN ke KPKNL Bangunan Gedung_TERSENSOR.pdf\n\nSalinan 202507221658157_SKET-PKTJ 76 Tahun 2025 Penghentian BMN_TERSENSOR.pdf\n\nSalinan 202507221658156_AstLaporanKondisiBarangUAKPB.pdf_TERSENSOR.pdf\n\nSalinan 202507221658153_BA-PKTJ 6 Tahun 2025_TERSENSOR.pdf\n\nSalinan 202507221658152_SK_BPSDMP 17 TAHUN 2025_TIM PENGHAPUSAN BMN PADA PKTJ TEGAL_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1aRbozmigMYPH-3LQwjApjdCT4iI1OuAG/view?usp=drive_link"
  },
  {
    "row": 18,
    "no": "12.0",
    "judul": "Penyuluhan Kesehatan Umum dan Gigi Mulut kepada taruna",
    "ringkasan": "Kegiatan penyuluhan kesehatan kepada taruna/ni PKTJ baik kesehatan umum maupun kesehatan gigi dan mulut secara offline",
    "pejabat": "Kanit Kesehatan",
    "penerbit": "Dokter Umum / Dokter Gigi / Nakes Unit Kesehatan",
    "bentuk": "Softfile",
    "waktu": "PKTJ Tegal",
    "retensi": "5 Tahun",
    "col_used": 10,
    "label": "Preview.screening gigi kepada taruna/taruni PKTJ",
    "link": "https://drive.google.com/drive/folders/1Twh5M06qeoYqGSJQ2wdZ6Uvl4rpyDTtn?usp=drive_link"
  },
  {
    "row": 19,
    "no": "13.0",
    "judul": "Profil Progam Studi RSTJ",
    "ringkasan": "Memuat Visi Misi, Lulusan, Dosen, Prestasi Taruna/i Prodi RSTJ dan kegiatan Pembelajaran Prodi RSTJ",
    "pejabat": "Kepala Progam Studi Rekayasa Sistem Transportasi Jalan (RSTJ)",
    "penerbit": "Prodi RSTJ Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy",
    "waktu": "Tegal, 2025",
    "retensi": "Selama masih berlaku /  Diperbarui jika ada perubahan",
    "col_used": 12,
    "label": "[update 1 Juli 2025] Dokumen Reviu Kurikulum Prodi RSTJ 2025.pdf",
    "link": "https://drive.google.com/file/d/1qOzwfGGg3V2edOgdxBD4Fjj1DncRU30X/view?usp=drive_link"
  },
  {
    "row": 22,
    "no": "16.0",
    "judul": "Profil Unit Perpustakaan PKTJ",
    "ringkasan": "Memuat sejarah, visi misi, struktur organisasi, jam layanan, dan fasilitas perpustakaan.",
    "pejabat": "Kepala Unit Perpustakaan",
    "penerbit": "Unit Perpustakaan PKTJ",
    "bentuk": "Hardcopy & Sofcopy",
    "waktu": "Tegal, 2023",
    "retensi": "Selama berlaku / Diperbarui jika ada perubahan",
    "col_used": 12,
    "label": "PROFIL PERPUSTAKAAN PKTJ (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1hcC1XY8hd7XWF-AHqW1fdDoUzyyED934/view?usp=drive_link"
  },
  {
    "row": 23,
    "no": "17.0",
    "judul": "Sosialisasi P4GN (Pencegahan, Pemberantasan, Penyalahgunaan dan Peredaran Gelap Narkotika) kepada Taruna PKTJ",
    "ringkasan": "Kegiatan Sosialisasi P4GN dilakukan secara online",
    "pejabat": "Kanit Kesehatan",
    "penerbit": "Dokter Unit Kesehatan PKTJ",
    "bentuk": "Softfile",
    "waktu": "PKTJ Tegal",
    "retensi": "5 tahun",
    "col_used": 12,
    "label": "Laporan Kegiatan P4GN 2025 (Informasi Publik).docx_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1CZsernmJspWDeXuq0c-1V0LE0ufnsMZK/view?usp=drive_link"
  },
  {
    "row": 24,
    "no": "18.0",
    "judul": "SPI CHARTER (Piagam SPI)",
    "ringkasan": "Piagam Satuan Pengawas Internal (Audit Charter SPI) adalah dokumen formal yang berisi tentang komitmen pimpinan berupa pengakuan keberadaan dan berfungsinya Satuan Pengawas Internal di sebuah organisasi. Piagam Satuan Pengawas Internal PKTJ mencakup visi, misi, kedudukan, tugas, fungsi, dan ruang lingkup serta persetujuan dan pengesahan dari Pimpinan Organisasi.",
    "pejabat": "Kepala SPI",
    "penerbit": "SPI Politeknik Keselamatan Transportasi Jalan",
    "bentuk": "Softcopy dan Hardcopy",
    "waktu": "Tegal, 2025",
    "retensi": "1 (satu) tahun",
    "col_used": 12,
    "label": "Piagam SPI 2025 (Informasi Publik)_TERSENSOR.pdf",
    "link": "https://drive.google.com/file/d/1XY_1ktDrqGwQJ2nuK_sslnYrP0Ddv4nx/view?usp=drive_link"
  }
]
JSON
        , true);

        if (!empty($sertaMertaItems)) {
            foreach ($sertaMertaItems as $item) {
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
                    'kategori'           => 'informasi-serta-merta',
                    'tipe_informasi'     => 'dokumen',
                    'isi_informasi'      => $richContent,
                    'pejabat_penguasa'   => $item['pejabat'] ?: 'Direktur & Manajemen PKTJ',
                    'penerbit_informasi' => $item['penerbit'] ?: 'PKTJ Tegal',
                    'tempat_pembuatan'   => 'Tegal',
                    'penanggung_jawab'   => $item['pejabat'] ?: 'Ka Tim Substansi',
                    'waktu_pembuatan'    => $item['waktu'] ?: 'Tegal, 2025',
                    'bentuk_informasi'   => $item['bentuk'] ?: 'Softcopy',
                    'jangka_waktu'       => $item['retensi'] ?: '1 Tahun',
                    'file_informasi'     => $item['link'],
                    'aktif'              => 1,
                    'is_blurred'         => 0,
                    'bisa_download'      => 1,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);
            }
        }

        // 9. THE 23 USER VERIFIED ITEMS
        $userVerified = [
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

        foreach ($userVerified as $item) {
            $richContent = '<p>' . htmlspecialchars($item['deskripsi']) . '</p>' .
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
                'kategori'           => $item['kategori'],
                'tipe_informasi'     => 'dokumen',
                'isi_informasi'      => $richContent,
                'pejabat_penguasa'   => $item['pejabat'],
                'penerbit_informasi' => 'Politeknik Keselamatan Transportasi Jalan',
                'tempat_pembuatan'   => 'Tegal',
                'penanggung_jawab'   => $item['pejabat'],
                'waktu_pembuatan'    => '2025',
                'bentuk_informasi'   => 'Softcopy (PDF)',
                'jangka_waktu'       => '1 Tahun',
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
