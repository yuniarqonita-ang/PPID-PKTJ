<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Pejabat extends Model
{
    protected $table = 'pejabats';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'tempat_tanggal_lahir',
        'foto',
        'foto_width',
        'foto_height',
        'foto_card_height',
        'foto_position',
        'foto_radius',
        'biografi',
        'pendidikan',
        'riwayat_jabatan',
        'penghargaan',
        'lhkpn_link',
        'lhkpn_file',
        'lhkpn_tahun',
        'urutan',
        'aktif'
    ];

    protected $casts = [
        'foto_width' => 'integer',
        'foto_height' => 'integer',
        'foto_card_height' => 'integer',
        'pendidikan' => 'array',
        'riwayat_jabatan' => 'array',
        'penghargaan' => 'array',
        'aktif' => 'boolean',
        'urutan' => 'integer'
    ];

    public static function getActivePejabats()
    {
        try {
            if (Schema::hasTable('pejabats')) {
                $items = static::where('aktif', true)->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
                if ($items->isNotEmpty()) {
                    return $items;
                }
            }
        } catch (\Throwable $e) {}

        // Fallback default dataset if table not yet seeded or migrated
        return collect(static::getDefaultPejabatData())->map(function($data, $index) {
            $model = new static($data);
            $model->id = $index + 1;
            return $model;
        });
    }

    public static function getDefaultPejabatData()
    {
        return [
            [
                'nama' => 'Dr. Ir. Bambang Istiyanto, S.SiT., M.T., IPU',
                'nip' => '19730514 199803 1 002',
                'jabatan' => 'Direktur Politeknik Keselamatan Transportasi Jalan',
                'tempat_tanggal_lahir' => null,
                'foto' => 'images/pejabat/Bambang Istiyanto.png',
                'biografi' => 'Menjabat sebagai Direktur Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal. Meraih gelar Doktor Teknik Sipil di Universitas Islam Sultan Agung (UNISSULA) Semarang dengan disertasi Model Evaluasi Keberhasilan Program Keselamatan Jalan Perkotaan Berbasis Safety Performance Function (SPF) dan Crash Modification Factor (CMF) dengan Pendekatan System Dynamics. Memimpin penyelenggaraan pendidikan vokasi keselamatan transportasi darat, tata kelola BLU, dan penguatan keterbukaan informasi publik di lingkungan BPSDMP Kementerian Perhubungan.',
                'pendidikan' => [
                    'S3 - Doktor (Dr.) Teknik Sipil, Universitas Islam Sultan Agung (UNISSULA) Semarang',
                    'Profesi Insinyur - Insinyur Profesional Utama (IPU), Persatuan Insinyur Indonesia (PII)',
                    'S2 - Magister Teknik (M.T.) Sipil / Transportasi, Institut Teknologi Bandung (ITB)',
                    'D4 / S1 Terapan - Sarjana Sains Terapan Transportasi (S.SiT), Sekolah Tinggi Transportasi Darat (STTD)',
                    'Pendidikan dan Pelatihan Penjenjangan Kepemimpinan Administrator (PIM Tingkat III)'
                ],
                'riwayat_jabatan' => [
                    'Direktur Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal (2024 - Sekarang)',
                    'Wakil Direktur I Politeknik Transportasi Darat Bali (POLTRADA Bali)',
                    'Kepala Bagian Administrasi Akademik dan Ketarunaan PKTJ Tegal',
                    'Kepala Subdirektorat Rekayasa dan Keselamatan Jalan Ditjen Hubdat'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 20 Tahun Presiden RI',
                    'Satyalancana Karya Satya 10 Tahun Presiden RI'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'nama' => 'Edi Purwanto, A.TD, M.T.',
                'nip' => '19700918 199803 1 001',
                'jabatan' => 'Wakil Direktur I (Bidang Akademik)',
                'tempat_tanggal_lahir' => null,
                'foto' => 'images/pejabat/Edi Purwanto.png',
                'biografi' => 'Menjabat sebagai Wakil Direktur I Bidang Akademik Politeknik Keselamatan Transportasi Jalan. Bertanggung jawab atas pengelolaan pendidikan vokasi, penyusunan kurikulum berbasis keselamatan jalan, penjaminan mutu akademik, serta pelaksanaan Tri Dharma Perguruan Tinggi.',
                'pendidikan' => [
                    'S2 - Magister Teknik Sipil / Sistem Rekayasa Transportasi, Universitas Diponegoro (UNDIP)',
                    'D3 - Ahli Transportasi Darat (A.TD), Sekolah Tinggi Transportasi Darat (STTD)',
                    'Pelatihan Pendidik Perguruan Tinggi & Auditor Mutu Internal'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur I (Bidang Akademik) PKTJ Tegal (2024 - Sekarang)',
                    'Ketua Program Studi Diploma IV Rekayasa Sistem Transportasi Jalan (RSTJ) PKTJ',
                    'Dosen Lektor Bidang Manajemen & Rekayasa Keselamatan Transportasi Jalan'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 20 Tahun Presiden RI',
                    'Satyalancana Karya Satya 10 Tahun Presiden RI'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'nama' => 'Sugianto, ATD, MM.',
                'nip' => '19660601 199103 1 004',
                'jabatan' => 'Wakil Direktur II (Bidang Keuangan, Umum dan Kerja Sama)',
                'tempat_tanggal_lahir' => null,
                'foto' => 'images/pejabat/Sugianto.png',
                'biografi' => 'Menjabat sebagai Wakil Direktur II Bidang Keuangan, Umum dan Kerja Sama PKTJ. Memiliki pengalaman lebih dari 30 tahun dalam tata kelola birokrasi, pengelolaan Barang Milik Negara (BMN), penganggaran DIPA BLU, sarana prasarana, serta kerja sama kelembagaan.',
                'pendidikan' => [
                    'S2 - Magister Manajemen (MM), Universitas Jenderal Soedirman',
                    'D3 - Ahli Transportasi Darat (ATD), Sekolah Tinggi Transportasi Darat (STTD)',
                    'Pelatihan Kepemimpinan Administrator (PIM Tingkat III)'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur II (Bidang Keuangan, Umum dan Kerja Sama) PKTJ (2024 - Sekarang)',
                    'Wakil Direktur I Bidang Akademik PKTJ (2022 - 2024)',
                    'Kepala Balai Teknik Perkeretaapian Kelas II Sumatera Bagian Selatan',
                    'Kepala Bagian Rencana Ditjen Perhubungan Darat'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 30 Tahun Presiden RI',
                    'Satyalancana Karya Satya 20 Tahun Presiden RI'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'nama' => 'Dr. Setya Wijayanta, S.Pd.T, M.T.',
                'nip' => '19780824 200212 1 001',
                'jabatan' => 'Wakil Direktur III (Bidang Ketarunaan, Alumni dan Kerja Sama)',
                'tempat_tanggal_lahir' => null,
                'foto' => 'images/pejabat/Setya Wijayanta.png',
                'biografi' => 'Menjabat sebagai Wakil Direktur III Bidang Ketarunaan, Alumni dan Kerja Sama PKTJ. Bertanggung jawab atas pembinaan karakter, kedisiplinan dan pengasuhan taruna/i transportasi darat, hubungan alumni, serta kerja sama ketarunaan nasional dan internasional.',
                'pendidikan' => [
                    'S3 - Doktor (Dr.) Ilmu Pendidikan / Manajemen Pendidikan',
                    'S2 - Magister Teknik (M.T.) Sistem Transportasi',
                    'S1 - Sarjana Pendidikan Teknik (S.Pd.T), Universitas Negeri Yogyakarta'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur III (Bidang Ketarunaan, Alumni dan Kerja Sama) PKTJ (2024 - Sekarang)',
                    'Ketua Program Studi Teknologi Otomotif / TRO PKTJ',
                    'Kepala Pusat Penelitian dan Pengabdian kepada Masyarakat (P3M) PKTJ'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 20 Tahun Presiden RI',
                    'Satyalancana Karya Satya 10 Tahun Presiden RI'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 4,
                'aktif' => true,
            ],
            [
                'nama' => 'Prima Anna Maria Gorety Cornelis, S.SiT.',
                'nip' => '19780415 200212 2 001',
                'jabatan' => 'Kepala Bagian Administrasi Akademik dan Ketarunaan (BAAK)',
                'tempat_tanggal_lahir' => null,
                'foto' => 'images/pejabat/Prima Anna Maria.png',
                'biografi' => 'Menjabat sebagai Kepala Bagian Administrasi Akademik dan Ketarunaan (BAAK) PKTJ Tegal. Bertanggung jawab atas pelayanan administrasi pendidikan vokasi, registrasi taruna/i, seleksi penerimaan (Sipencatar), dan ketatausahaan perkuliahan.',
                'pendidikan' => [
                    'D4 / S1 Terapan - Sarjana Sains Terapan Transportasi (S.SiT), STTD Bekasi',
                    'Diklat Kepemimpinan Pengawas (PIM Tingkat IV)',
                    'Bimbingan Teknis Pelayanan Prima Keterbukaan Informasi Publik'
                ],
                'riwayat_jabatan' => [
                    'Kepala Bagian Administrasi Akademik dan Ketarunaan (BAAK) PKTJ (2024 - Sekarang)',
                    'Kepala Subbagian Administrasi Akademik PKTJ',
                    'Pengelola Administrasi Ketarunaan dan Pengasuhan BPSDMP'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 20 Tahun Presiden RI',
                    'Satyalancana Karya Satya 10 Tahun Presiden RI'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 5,
                'aktif' => true,
            ],
            [
                'nama' => 'Agus Hariyanto, S.Kom, M.Sc.',
                'nip' => '19790812 200502 1 001',
                'jabatan' => 'Kepala Subbagian Keuangan dan Administrasi Umum',
                'tempat_tanggal_lahir' => null,
                'foto' => 'images/pejabat/Agus Hariyanto.png',
                'biografi' => 'Menjabat sebagai Kepala Subbagian Keuangan dan Administrasi Umum PKTJ Tegal. Mengelola perbendaharaan, tata kelola keuangan BLU, pengadaan barang/jasa, ketatausahaan, kerumahtanggaan, serta infrastruktur teknologi informasi.',
                'pendidikan' => [
                    'S2 - Master of Science (M.Sc) Transport & Information Technology',
                    'S1 - Sarjana Komputer (S.Kom), Universitas Diponegoro',
                    'Diklat Pengelolaan Keuangan BLU dan Pejabat Perbendaharaan Negara'
                ],
                'riwayat_jabatan' => [
                    'Kepala Subbagian Keuangan dan Administrasi Umum PKTJ (2024 - Sekarang)',
                    'Kepala Unit Teknologi Informasi & Komunikasi (TIK) PKTJ',
                    'Ketua Program Studi Teknologi Rekayasa Otomotif (TRO) PKTJ'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 10 Tahun Presiden RI',
                    'Penghargaan Inovasi Sistem Pelayanan Informasi Digital'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 6,
                'aktif' => true,
            ],
        ];
    }
}
