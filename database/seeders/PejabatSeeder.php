<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pejabat;

class PejabatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pejabats = [
            [
                'nama' => 'BAMBANG ISTIYANTO, S.Si.T., M.T.',
                'nip' => '19730514 199803 1 002',
                'jabatan' => 'Direktur Politeknik Keselamatan Transportasi Jalan',
                'tempat_tanggal_lahir' => 'Tegal, 14 Mei 1973',
                'foto' => 'images/pejabat/Bambang Istiyanto.png',
                'biografi' => 'Menjabat sebagai Direktur Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal. Berpengalaman luas dalam bidang manajemen transportasi darat, keselamatan jalan, dan kepemimpinan institusi pendidikan vokasi di lingkungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan.',
                'pendidikan' => [
                    'S2 - Magister Teknik Sipil / Transportasi, Institut Teknologi Bandung (ITB)',
                    'D4 / S1 Terapan - Sarjana Sains Terapan Transportasi, Sekolah Tinggi Transportasi Darat (STTD)',
                    'Pendidikan Penjenjangan PIM Tingkat III (Diklat Kepemimpinan Administrator)'
                ],
                'riwayat_jabatan' => [
                    'Direktur Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal (2024 - Sekarang)',
                    'Wakil Direktur I Politeknik Transportasi Darat Bali (POLTRADA Bali)',
                    'Kepala Bagian Administrasi Akademik dan Ketarunaan PKTJ',
                    'Kepala Subdirektorat Rekayasa dan Keselamatan Jalan Ditjen Hubdat',
                    'Dosen / Lektor Kepala Bidang Transportasi Jalan'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 20 Tahun dari Presiden Republik Indonesia',
                    'Satyalancana Karya Satya 10 Tahun dari Presiden Republik Indonesia',
                    'Penghargaan Pengelola PPID & Keterbukaan Informasi Publik Terbaik'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'nama' => 'AGUS HARIYANTO, S.Kom., M.Sc.',
                'nip' => '19790812 200502 1 001',
                'jabatan' => 'Wakil Direktur I (Bidang Akademik)',
                'tempat_tanggal_lahir' => 'Semarang, 12 Agustus 1979',
                'foto' => 'images/pejabat/Agus Hariyanto.png',
                'biografi' => 'Menjabat sebagai Wakil Direktur I Bidang Akademik PKTJ. Bertanggung jawab atas pengelolaan kurikulum, penjaminan mutu perkuliahan, inovasi pembelajaran vokasi, dan pengembangan teknologi rekayasa keselamatan transportasi.',
                'pendidikan' => [
                    'S2 - Master of Science (M.Sc) Transport & Information Technology',
                    'S1 - Sarjana Komputer (S.Kom), Universitas Diponegoro',
                    'Pelatihan Applied Approach (AA) & Pekerti Pendidik Perguruan Tinggi'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur I (Bidang Akademik) PKTJ Tegal (2024 - Sekarang)',
                    'Ketua Program Studi Teknologi Rekayasa Otomotif (TRO) PKTJ',
                    'Kepala Unit Teknologi Informasi & Komunikasi PKTJ',
                    'Dosen Lektor Bidang Sistem Informasi & Otomotif PKTJ'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 10 Tahun dari Presiden Republik Indonesia',
                    'Dosen Berprestasi Bidang Inovasi Teknologi Pembelajaran'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'nama' => 'SUGIANTO, ATD, MM',
                'nip' => '19660601 199103 1 004',
                'jabatan' => 'Wakil Direktur II (Bidang Umum dan Keuangan)',
                'tempat_tanggal_lahir' => 'Banyumas, 01 Juni 1966',
                'foto' => 'images/pejabat/Sugianto.png',
                'biografi' => 'Menjabat sebagai Wakil Direktur II Bidang Umum dan Keuangan PKTJ. Memiliki pengalaman lebih dari 30 tahun dalam birokrasi Kementerian Perhubungan, pengelolaan aset negara (BMN), penganggaran DIPA, serta perencanaan strategis.',
                'pendidikan' => [
                    'S2 - Magister Manajemen (MM), Universitas Jenderal Soedirman',
                    'Ahli Transportasi Darat (ATD), Sekolah Tinggi Transportasi Darat (STTD)',
                    'Pelatihan Kepemimpinan Administrator (PIM Tingkat III)'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur II (Bidang Umum dan Keuangan) PKTJ (2024 - Sekarang)',
                    'Wakil Direktur I PKTJ (2022 - 2024)',
                    'Kepala Balai Teknik Perkeretaapian Kelas II Sumatera Bagian Selatan',
                    'Kepala Bagian Rencana Ditjen Perhubungan Darat',
                    'Kepala Kantor BLLAJSDP Denpasar'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 30 Tahun dari Presiden Republik Indonesia',
                    'Satyalancana Karya Satya 20 Tahun dari Presiden Republik Indonesia',
                    'Satyalancana Karya Satya 10 Tahun dari Presiden Republik Indonesia'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'nama' => 'EDI PURWANTO, A.TD., M.T.',
                'nip' => '19760721 199803 1 001',
                'jabatan' => 'Wakil Direktur III (Bidang Ketarunaan dan Alumni)',
                'tempat_tanggal_lahir' => 'Klaten, 21 Juli 1976',
                'foto' => 'images/pejabat/Edi Purwanto.png',
                'biografi' => 'Menjabat sebagai Wakil Direktur III Bidang Ketarunaan dan Alumni PKTJ. Memimpin pembinaan karakter praja taruna/i, pengasuhan, kedisiplinan, hubungan alumni, dan kesiapan karir lulusan di sektor transportasi perhubungan.',
                'pendidikan' => [
                    'S2 - Magister Teknik (M.T.) Transportasi, Universitas Gadjah Mada',
                    'Ahli Transportasi Darat (A.TD.), Sekolah Tinggi Transportasi Darat (STTD)',
                    'Diklat Pembina Karakter dan Kesamaptaan Perhubungan'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur III (Bidang Ketarunaan & Alumni) PKTJ (2024 - Sekarang)',
                    'Kepala Pusat Pembangunan Karakter Taruna PKTJ',
                    'Ketua Program Studi Rekayasa Sistem Transportasi Jalan (RSTJ)',
                    'Dosen Lektor Bidang Manajemen Keselamatan Jalan'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 20 Tahun dari Presiden Republik Indonesia',
                    'Satyalancana Karya Satya 10 Tahun dari Presiden Republik Indonesia'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 4,
                'aktif' => true,
            ],
            [
                'nama' => 'Dr. SETYA WIJAYANTA, S.Pd.T., M.T.',
                'nip' => '19780415 200212 1 002',
                'jabatan' => 'Kepala Bagian Administrasi Akademik dan Ketarunaan',
                'tempat_tanggal_lahir' => 'Yogyakarta, 15 April 1978',
                'foto' => 'images/pejabat/Setya Wijayanta.png',
                'biografi' => 'Menjabat sebagai Kepala Bagian Administrasi Akademik dan Ketarunaan PKTJ. Mengkoordinasikan seluruh administrasi akademik, pendaftaran taruna baru (Sipencatar), akreditasi, dan layanan ketarunaan.',
                'pendidikan' => [
                    'S3 - Doktor (Dr.) Ilmu Pendidikan & Evaluasi Vokasi, Universitas Negeri Yogyakarta',
                    'S2 - Magister Teknik (M.T.), Universitas Gadjah Mada',
                    'S1 - Sarjana Pendidikan Teknik (S.Pd.T.)'
                ],
                'riwayat_jabatan' => [
                    'Kepala Bagian Administrasi Akademik dan Ketarunaan PKTJ (2024 - Sekarang)',
                    'Kepala Satuan Penjaminan Mutu (SPM) PKTJ',
                    'Dosen Lektor Kepala PKTJ Tegal'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 20 Tahun dari Presiden Republik Indonesia',
                    'Penghargaan Peneliti Terbaik Bidang Rekayasa Transportasi'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 5,
                'aktif' => true,
            ],
            [
                'nama' => 'PRIMA ANNA MARIA GORETY CORNELIS, S.Si.T., M.Sc.',
                'nip' => '19840325 200812 2 001',
                'jabatan' => 'Ketua Program Studi / Manajemen PKTJ',
                'tempat_tanggal_lahir' => 'Kupang, 25 Maret 1984',
                'foto' => 'images/pejabat/Prima Anna Maria.png',
                'biografi' => 'Menjabat sebagai Ketua Program Studi / Manajemen di lingkungan PKTJ Tegal. Berperan aktif dalam pengembangan kurikulum berbasis industri (Teaching Factory), akreditasi internasional, dan pembinaan riset vokasi transportasi darat.',
                'pendidikan' => [
                    'S2 - Master of Science (M.Sc) Transport Management, World Maritime University / ITB',
                    'D4 - Sarjana Sains Terapan Transportasi (S.Si.T.), STTD Bekasi',
                    'Pelatihan Manajemen Mutu Pendidikan Vokasi'
                ],
                'riwayat_jabatan' => [
                    'Ketua Program Studi PKTJ Tegal (2023 - Sekarang)',
                    'Sekretaris Satuan Penjaminan Mutu (SPM) PKTJ',
                    'Dosen Lektor Bidang Perencanaan Transportasi'
                ],
                'penghargaan' => [
                    'Satyalancana Karya Satya 10 Tahun dari Presiden Republik Indonesia',
                    'Penghargaan Dosen Berdedikasi Pengembangan Akreditasi Unggul'
                ],
                'lhkpn_link' => 'https://elhkpn.kpk.go.id/',
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 6,
                'aktif' => true,
            ],
        ];

        foreach ($pejabats as $data) {
            Pejabat::updateOrCreate(
                ['nama' => $data['nama']],
                $data
            );
        }
    }
}
