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
            'total_sdm' => '174',
            'total_sdm_label' => 'Total SDM Pegawai',
            'total_sdm_sub' => 'SIMPEG Kemenhub',
            'pns_count' => '115',
            'pns_label' => 'Pegawai Negeri Sipil',
            'pns_sub' => '66.1% Dari Total SDM',
            'pppk_count' => '41',
            'pppk_label' => 'Pegawai PPPK',
            'pppk_sub' => '23.6% Dari Total SDM',
            'nonasn_count' => '18',
            'nonasn_label' => 'Non-ASN & CPNS',
            'nonasn_sub' => '17 Non-ASN, 1 CPNS',

            // Status Kepegawaian Breakdown (Doughnut Chart & Table)
            'status_pns' => '115',
            'status_pppk' => '41',
            'status_nonasn' => '17',
            'status_cpns' => '1',

            // Pendidikan Breakdown (JSON)
            'pendidikan_list' => json_encode([
                ['jenjang' => 'Magister / S-2', 'jumlah' => 68, 'keterangan' => 'Dosen & Fungsional'],
                ['jenjang' => 'Diploma III (D-III)', 'jumlah' => 31, 'keterangan' => 'Teknis & Instruktur'],
                ['jenjang' => 'Diploma IV / Sarjana Terapan (D-IV)', 'jumlah' => 24, 'keterangan' => 'Fungsional Teknis'],
                ['jenjang' => 'Sarjana (S-1)', 'jumlah' => 23, 'keterangan' => 'Administrasi & Dosen'],
                ['jenjang' => 'SLTA / SMK Sederajat', 'jumlah' => 23, 'keterangan' => 'Pelaksana & Teknis'],
                ['jenjang' => 'Profesi / S-3 / D-II', 'jumlah' => 10, 'keterangan' => 'Doktor & Profesi'],
            ]),

            // Golongan Breakdown (JSON)
            'golongan_list' => json_encode([
                ['golongan' => 'Penata (III/c)', 'jumlah' => 30],
                ['golongan' => 'Penata Muda Tk I (III/b)', 'jumlah' => 21],
                ['golongan' => 'Penata Tk I (III/d)', 'jumlah' => 20],
                ['golongan' => 'Gol. VII (PPPK)', 'jumlah' => 17],
                ['golongan' => 'Gol. IX (PPPK)', 'jumlah' => 14],
                ['golongan' => 'Pembina (IV/a)', 'jumlah' => 14],
                ['golongan' => 'Penata Muda (III/a)', 'jumlah' => 13],
                ['golongan' => 'Pengatur (II/c)', 'jumlah' => 9],
                ['golongan' => 'Gol. X (PPPK)', 'jumlah' => 5],
                ['golongan' => 'Gol. V (PPPK)', 'jumlah' => 5],
                ['golongan' => 'Pengatur Tk I (II/d)', 'jumlah' => 5],
                ['golongan' => 'Pembina Tk I (IV/b)', 'jumlah' => 4],
            ]),

            // Proof Images (SIMPEG Screens)
            'bukti_1_gambar' => 'images/kepegawaian/E6a.jpg',
            'bukti_1_indikator' => '',
            'bukti_1_judul' => 'Data Pegawai Berdasarkan Jenis',
            'bukti_1_deskripsi' => 'Tangkapan layar otentik data PNS, PPPK, dan Non-ASN SIMPEG.',

            'bukti_2_gambar' => 'images/kepegawaian/E6b.jpg',
            'bukti_2_indikator' => '',
            'bukti_2_judul' => 'Data Tingkat Pendidikan Pegawai',
            'bukti_2_deskripsi' => 'Komposisi jenjang pendidikan S-2, D-III, D-IV, dan S-1.',

            'bukti_3_gambar' => 'images/kepegawaian/E6c.jpg',
            'bukti_3_indikator' => '',
            'bukti_3_judul' => 'Data Golongan / Ruang Pegawai',
            'bukti_3_deskripsi' => 'Komposisi pegawai dari Golongan II/c hingga IV/b dan PPPK.',

            // Callout
            'callout_judul' => 'Data Kepegawaian & Profil Pimpinan PPID PKTJ',
            'callout_deskripsi' => 'Informasi resmi komposisi ketenagaan serta kepatuhan Laporan Harta Kekayaan Penyelenggara Negara (LHKPN) pimpinan PKTJ Tegal.',
            'callout_btn_text' => 'Profil Pejabat & LHKPN',
            'callout_btn_url' => '/profil/pejabat',
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
            'callout_judul', 'callout_deskripsi', 'callout_btn_text', 'callout_btn_url',
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
