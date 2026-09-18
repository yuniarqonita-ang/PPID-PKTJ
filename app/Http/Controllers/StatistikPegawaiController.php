<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class StatistikPegawaiController extends Controller
{
    /**
     * Default settings for Statistik Pegawai
     */
    public static function getDefaults(): array
    {
        return [
            'hero_badge' => 'Data & Informasi Kepegawaian Resmi',
            'hero_judul' => 'Data & Statistik Kepegawaian PKTJ',
            'hero_subjudul' => 'Informasi publik berkala mengenai profil ketenagaan, klasifikasi status ASN/PPPK, tingkat pendidikan akhir, dan kepangkatan/golongan pegawai Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.',
            'tahun_anggaran' => 'TA 2025 / 2026',
            'sumber_data' => 'Sistem Informasi Kepegawaian (SIMPEG) Kementerian Perhubungan Republik Indonesia',

            // 4 KPI Summary Cards
            'total_sdm' => '155',
            'total_sdm_label' => 'Total Pegawai PKTJ',
            'total_sdm_sub' => 'SIMPEG Kemenhub & DRH Resmi',
            'pns_count' => '114',
            'pns_label' => 'Pegawai Negeri Sipil (PNS)',
            'pns_sub' => '73.5% Dari Total SDM',
            'pppk_count' => '41',
            'pppk_label' => 'Pegawai PPPK',
            'pppk_sub' => '26.5% Dari Total SDM',
            'nonasn_count' => '0',
            'nonasn_label' => 'Non-ASN & CPNS',
            'nonasn_sub' => '0 Non-ASN, 0 CPNS',

            // Status Kepegawaian Breakdown (Doughnut Chart & Table)
            'status_pns' => '114',
            'status_pppk' => '41',
            'status_nonasn' => '0',
            'status_cpns' => '0',

            // Pendidikan Breakdown (JSON)
            'pendidikan_list' => json_encode([
                ['jenjang' => 'Magister / S-2', 'jumlah' => 68, 'keterangan' => 'Dosen & Pejabat Struktural (43.9%)'],
                ['jenjang' => 'Sarjana (S-1)', 'jumlah' => 27, 'keterangan' => 'Administrasi & Pengelola (17.4%)'],
                ['jenjang' => 'Diploma III (D-III)', 'jumlah' => 24, 'keterangan' => 'Instruktur & Laboran (15.5%)'],
                ['jenjang' => 'Diploma IV / Terapan (D-IV)', 'jumlah' => 19, 'keterangan' => 'Fungsional Teknis (12.3%)'],
                ['jenjang' => 'SLTA / SMK Sederajat', 'jumlah' => 9, 'keterangan' => 'Pelaksana Teknis (5.8%)'],
                ['jenjang' => 'Profesi', 'jumlah' => 6, 'keterangan' => 'Tenaga Fungsional (3.9%)'],
                ['jenjang' => 'Doktoral / S-3', 'jumlah' => 2, 'keterangan' => 'Dosen Senior (1.3%)'],
            ]),

            // Golongan Breakdown (JSON)
            'golongan_list' => json_encode([
                ['golongan' => 'Penata Tk. I (III/d)', 'jumlah' => 33],
                ['golongan' => 'Penata Muda Tk. I (III/b)', 'jumlah' => 25],
                ['golongan' => 'Penata (III/c)', 'jumlah' => 17],
                ['golongan' => 'Golongan IX (PPPK)', 'jumlah' => 16],
                ['golongan' => 'Pembina (IV/a)', 'jumlah' => 15],
                ['golongan' => 'Golongan VII (PPPK)', 'jumlah' => 15],
                ['golongan' => 'Penata Muda (III/a)', 'jumlah' => 8],
                ['golongan' => 'Pengatur Tk. I (II/d)', 'jumlah' => 8],
                ['golongan' => 'Golongan X (PPPK)', 'jumlah' => 5],
                ['golongan' => 'Golongan V (PPPK)', 'jumlah' => 5],
                ['golongan' => 'Pengatur (II/c)', 'jumlah' => 4],
                ['golongan' => 'Pembina Tk. I (IV/b)', 'jumlah' => 4],
            ]),

            // Proof Images (SIMPEG Screens)
            'bukti_1_gambar' => 'images/kepegawaian/E6a.jpg',
            'bukti_1_indikator' => '',
            'bukti_1_judul' => 'Data Pegawai Berdasarkan Jenis',
            'bukti_1_deskripsi' => 'Visualisasi data komposisi 114 PNS dan 41 PPPK (Total 155 Pegawai).',

            'bukti_2_gambar' => 'images/kepegawaian/E6b.jpg',
            'bukti_2_indikator' => '',
            'bukti_2_judul' => 'Data Tingkat Pendidikan Pegawai',
            'bukti_2_deskripsi' => 'Komposisi jenjang pendidikan S-2 (68), S-1 (27), D-III (24), D-IV (19), SLTA (9), Profesi (6), S-3 (2).',

            'bukti_3_gambar' => 'images/kepegawaian/E6c.jpg',
            'bukti_3_indikator' => '',
            'bukti_3_judul' => 'Data Golongan / Ruang Pegawai',
            'bukti_3_deskripsi' => 'Komposisi pangkat dan golongan pegawai III/d (33), III/b (25), III/c (17), Gol. IX (16), IV/a (15), Gol. VII (15), dst.',

            // Tautan Berkas Langsung Google Drive (Bukan Folder)
            'link_excel_drh' => 'https://drive.google.com/file/d/1WA7CSaxqt0j8e0fHnjqnl8K8TCRdUAAV/view?usp=drive_link',
            'link_sk_ppid_2026' => 'https://drive.google.com/file/d/1tAtixggFCU10eazzSDrAuv4O0zoeOfJS/view?usp=drive_link',
            'link_grafik_jenis' => 'https://drive.google.com/file/d/1waPJx0eSSfwhA3N9ggLE7qJHxOxOPblg/view?usp=drive_link',
            'link_grafik_pendidikan' => 'https://drive.google.com/file/d/1tPH7bcOA16ZJrcdG03JEj2EklKVeUW7W/view?usp=drive_link',
            'link_grafik_golongan' => 'https://drive.google.com/file/d/12ugth3EsodPjIZK4U7dOz4EAD0oObowf/view?usp=drive_link',

            // Callout
            'callout_judul' => 'Data Kepegawaian & Profil Pimpinan PPID PKTJ',
            'callout_deskripsi' => 'Informasi resmi komposisi ketenagaan serta kepatuhan Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) pimpinan PKTJ Tegal.',
            'callout_btn_text' => 'Profil Pejabat & LHKPN',
            'callout_btn_url' => '/profil/pejabat',
            'gdrive_folder_url' => 'https://drive.google.com/drive/folders/164eOazEqPabeX6h6atbn3KEs8FWHQVjJ?usp=drive_link',
        ];
    }

    /**
     * Get merged settings (DB values or defaults)
     */
    public static function getMergedSettings(): array
    {
        $defaults = self::getDefaults();
        try {
            $dbRows = Dashboard::where('key', 'like', 'statistik_pegawai_%')
                ->pluck('value', 'key')
                ->toArray();
        } catch (\Throwable $e) {
            $dbRows = [];
        }

        // Auto-sync if total_sdm in DB is not 155, or if status_nonasn > 0, or if counts or lists are outdated
        $needSync = !isset($dbRows['statistik_pegawai_total_sdm']) 
            || $dbRows['statistik_pegawai_total_sdm'] !== '155'
            || !isset($dbRows['statistik_pegawai_pns_count'])
            || $dbRows['statistik_pegawai_pns_count'] !== '114'
            || !isset($dbRows['statistik_pegawai_pppk_count'])
            || $dbRows['statistik_pegawai_pppk_count'] !== '41'
            || (isset($dbRows['statistik_pegawai_status_nonasn']) && (int)$dbRows['statistik_pegawai_status_nonasn'] > 0)
            || !isset($dbRows['statistik_pegawai_pendidikan_list'])
            || !str_contains($dbRows['statistik_pegawai_pendidikan_list'], '68')
            || !isset($dbRows['statistik_pegawai_golongan_list'])
            || !str_contains($dbRows['statistik_pegawai_golongan_list'], '33');

        if ($needSync) {
            try {
                foreach ($defaults as $field => $val) {
                    $key = 'statistik_pegawai_' . $field;
                    // Don't overwrite custom uploaded proof image if exists
                    if (str_contains($field, 'gambar') && !empty($dbRows[$key])) {
                        continue;
                    }
                    Dashboard::updateOrCreate(
                        ['key' => $key],
                        ['value' => $val, 'type' => (is_array(json_decode($val, true)) ? 'json' : 'text'), 'description' => 'Statistik Pegawai ' . $field, 'aktif' => true]
                    );
                    $dbRows[$key] = $val;
                }
            } catch (\Throwable $e) {}
        }

        $merged = [];
        foreach ($defaults as $field => $defaultVal) {
            $key = 'statistik_pegawai_' . $field;
            $merged[$field] = array_key_exists($key, $dbRows) && $dbRows[$key] !== null && $dbRows[$key] !== ''
                ? $dbRows[$key]
                : $defaultVal;
        }

        return $merged;
    }

    /**
     * Display Admin Form (/admin/statistik-pegawai)
     */
    public function index()
    {
        $data = self::getMergedSettings();
        return view('admin.profil.statistik-pegawai', compact('data'));
    }

    /**
     * Update settings in real-time
     */
    public function update(Request $request)
    {
        $defaults = self::getDefaults();

        // 1. Simple text & number fields
        $fields = [
            'hero_badge', 'hero_judul', 'hero_subjudul', 'tahun_anggaran', 'sumber_data',
            'total_sdm', 'total_sdm_label', 'total_sdm_sub',
            'pns_count', 'pns_label', 'pns_sub',
            'pppk_count', 'pppk_label', 'pppk_sub',
            'nonasn_count', 'nonasn_label', 'nonasn_sub',
            'status_pns', 'status_pppk', 'status_nonasn', 'status_cpns',
            'bukti_1_indikator', 'bukti_1_judul', 'bukti_1_deskripsi',
            'bukti_2_indikator', 'bukti_2_judul', 'bukti_2_deskripsi',
            'bukti_3_indikator', 'bukti_3_judul', 'bukti_3_deskripsi',
            'link_excel_drh', 'link_sk_ppid_2026', 'link_grafik_jenis', 'link_grafik_pendidikan', 'link_grafik_golongan',
            'callout_judul', 'callout_deskripsi', 'callout_btn_text', 'callout_btn_url',
            'gdrive_folder_url',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $val = trim($request->input($field));
                Dashboard::updateOrCreate(
                    ['key' => 'statistik_pegawai_' . $field],
                    ['value' => $val, 'type' => 'text', 'description' => 'Statistik Pegawai ' . $field, 'aktif' => true]
                );
            }
        }

        // 2. Handle Pendidikan List (Dynamic Rows)
        if ($request->has('pendidikan_jenjang') && is_array($request->pendidikan_jenjang)) {
            $pendList = [];
            $jenjangs = $request->pendidikan_jenjang;
            $jumlahs = $request->pendidikan_jumlah ?? [];
            $keterangans = $request->pendidikan_keterangan ?? [];

            foreach ($jenjangs as $idx => $jenjang) {
                $jText = trim($jenjang);
                if ($jText === '') continue;
                $pendList[] = [
                    'jenjang' => $jText,
                    'jumlah' => (int) ($jumlahs[$idx] ?? 0),
                    'keterangan' => trim($keterangans[$idx] ?? ''),
                ];
            }

            Dashboard::updateOrCreate(
                ['key' => 'statistik_pegawai_pendidikan_list'],
                ['value' => json_encode($pendList), 'type' => 'json', 'description' => 'Daftar Jenjang Pendidikan Pegawai', 'aktif' => true]
            );
        }

        // 3. Handle Golongan List (Dynamic Rows)
        if ($request->has('golongan_nama') && is_array($request->golongan_nama)) {
            $golList = [];
            $namas = $request->golongan_nama;
            $jumlahsG = $request->golongan_jumlah ?? [];

            foreach ($namas as $idx => $gNama) {
                $gText = trim($gNama);
                if ($gText === '') continue;
                $golList[] = [
                    'golongan' => $gText,
                    'jumlah' => (int) ($jumlahsG[$idx] ?? 0),
                ];
            }

            Dashboard::updateOrCreate(
                ['key' => 'statistik_pegawai_golongan_list'],
                ['value' => json_encode($golList), 'type' => 'json', 'description' => 'Daftar Golongan Pegawai', 'aktif' => true]
            );
        }

        // 4. Handle Proof Images Uploads
        $destDir = public_path('images/kepegawaian');
        if (!File::isDirectory($destDir)) {
            File::makeDirectory($destDir, 0755, true, true);
        }

        for ($i = 1; $i <= 3; $i++) {
            $fileInputName = "bukti_{$i}_file";
            if ($request->hasFile($fileInputName) && $request->file($fileInputName)->isValid()) {
                $file = $request->file($fileInputName);
                $filename = "simpeg_bukti_{$i}_" . time() . '.' . $file->getClientOriginalExtension();
                $file->move($destDir, $filename);
                $relPath = 'images/kepegawaian/' . $filename;

                Dashboard::updateOrCreate(
                    ['key' => "statistik_pegawai_bukti_{$i}_gambar"],
                    ['value' => $relPath, 'type' => 'image', 'description' => "Gambar Bukti SIMPEG {$i}", 'aktif' => true]
                );
            }
        }

        // Clear views and caches
        try {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
        } catch (\Throwable $e) {}

        return redirect()->route('admin.statistik-pegawai.index')->with('success', 'Data & Statistik Kepegawaian berhasil diperbarui secara realtime!');
    }
}
