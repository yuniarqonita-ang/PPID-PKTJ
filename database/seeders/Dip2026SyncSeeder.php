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
    }
}
