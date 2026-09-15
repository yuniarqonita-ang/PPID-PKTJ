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
                'nama' => 'Dr. Ir. Bambang Istiyanto, S.SiT., M.T., IPU',
                'nip' => '197307011996021002',
                'jabatan' => 'Direktur',
                'tempat_tanggal_lahir' => 'Grobogan, 1 Juli 1973',
                'foto' => 'images/pejabat/Bambang Istiyanto.png',
                'biografi' => "Lahir di Grobogan, Jawa Tengah, pada tanggal 1 Juli 1973. Memulai perjalanan karier pada tahun 2012 sampai dengan 2013 sebagai Kepala Pusat Pembinaan Mental. Pada tahun 2013 sampai dengan 2014 menjabat sebagai Kepala Subbagian Keuangan dan Administrasi Umum. Pada tahun 2014 sampai dengan 2016 menjabat sebagai Kepala Subbagian Administrasi Akademik dan Ketarunaan. Tahun 2017 sampai dengan 2019 menjabat sebagai Kepala Pusat Penelitian dan Pengabdian kepada Masyarakat. Pada bulan September 2019 sampai dengan Mei 2025 menjabat sebagai Wakil Direktur III. Pada tanggal 9 Mei 2025 sampai dengan sekarang menjabat sebagai Direktur Politeknik Keselamatan Transportasi Jalan.\n\nBeliau memiliki latar belakang pendidikan Sekolah Menengah Atas Negeri 1 Purwodadi (1992). Pendidikan Diploma III diselesaikan di Balai Pendidikan dan Latihan Ahli Lalu Lintas dan Angkutan Jalan Raya (1995). Pendidikan Sarjana Terapan (D-IV) diselesaikan di Sekolah Tinggi Transportasi Darat (2000). Pendidikan Magister (S-2) Jurusan Teknik diselesaikan di Universitas Gadjah Mada (2003). Penghargaan yang pernah diperoleh oleh beliau antara lain Satya Lencana Karya Satya 10 Tahun (2010) dan Satya Lencana Karya Satya 20 Tahun (2016). Pelatihan yang pernah diikuti meliputi Maintenance Road and Technology for Asia (2013), Implementing OHSAS 18001 Occupational Health & Safety (2016), The 20th FSTPT Symposium & The 1st International Symposium on Transportation Studies for Developing Countries (ISTSDC) (2018), Reform Leadership Training (2020), serta Bimbingan Teknis Penyusunan Sasaran Kinerja Pegawai (SKP) (2023).",
                'pendidikan' => [
                    'S2 - Magister Teknik, Universitas Gadjah Mada (2003)',
                    'D4 / S1 Terapan - Sarjana Terapan, STTD (2000)',
                    'D3 - Balai Diklat Ahli Lalu Lintas dan Angkutan Jalan Raya (1995)',
                    'SMA Negeri 1 Purwodadi (1992)'
                ],
                'riwayat_jabatan' => [
                    'Direktur Politeknik Keselamatan Transportasi Jalan (2025 - Sekarang)',
                    'Wakil Direktur III PKTJ (2019 - 2025)',
                    'Kepala Pusat Penelitian dan Pengabdian kepada Masyarakat (2017 - 2019)',
                    'Kepala Subbagian Administrasi Akademik dan Ketarunaan (2014 - 2016)',
                    'Kepala Subbagian Keuangan dan Administrasi Umum (2013 - 2014)',
                    'Kepala Pusat Pembinaan Mental (2012 - 2013)'
                ],
                'penghargaan' => [
                    'Satya Lencana Karya Satya 20 Tahun (2016)',
                    'Satya Lencana Karya Satya 10 Tahun (2010)'
                ],
                'lhkpn_link' => null,
                'lhkpn_file' => null,
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'nama' => 'Dr. Setya Wijayanta, S.Pd.T., M.T.',
                'nip' => '19780512 200502 1 001',
                'jabatan' => 'Wakil Direktur I',
                'tempat_tanggal_lahir' => 'Klaten, 12 Mei 1978',
                'foto' => 'images/pejabat/Setya Wijayanta.png',
                'biografi' => "Dr. Setya Wijayanta, S.Pd.T., M.T. adalah akademisi dan praktisi pendidikan vokasi transportasi yang dipercaya mengemban amanah sebagai Wakil Direktur I Bidang Akademik di Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal setelah sebelumnya bertugas sebagai Wakil Direktur III. Beliau menempuh pendidikan doktoral serta magister dalam bidang teknik dan pendidikan kejuruan dengan kepakaran pada keselamatan teknik kendaraan, rekayasa otomotif, serta standardisasi kurikulum vokasi perhubungan. Dalam kepemimpinannya, beliau berfokus pada penguatan mutu tridharma perguruan tinggi, akreditasi program studi unggul, dan kesiapan kompetensi taruna-taruni keselamatan jalan di kancah nasional maupun internasional.",
                'pendidikan' => [
                    'S3 - Doktor Ilmu Pendidikan, Universitas Negeri Yogyakarta',
                    'S2 - Magister Teknik Mesin, Universitas Indonesia',
                    'S1 - Sarjana Pendidikan Teknik Otomotif, Universitas Negeri Yogyakarta'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur I PKTJ Tegal (14 September 2026 - Sekarang)',
                    'Wakil Direktur III PKTJ Tegal (2019 - 2026)',
                    'Dosen / Lektor Kepala PKTJ Tegal'
                ],
                'penghargaan' => [
                    'Satya Lencana Karya Satya 10 Tahun Presiden RI (2019)',
                    'Piagam Penghargaan Lulusan Predikat Cumlaude (2012)'
                ],
                'lhkpn_link' => null,
                'lhkpn_file' => null,
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'nama' => 'R. Arief Novianto, S.T., M.Sc.',
                'nip' => '19741129 200604 1 001',
                'jabatan' => 'Wakil Direktur II',
                'tempat_tanggal_lahir' => 'Temanggung, 29 November 1974',
                'foto' => 'images/pejabat/Arief Novianto.png',
                'biografi' => "R. Arief Novianto, S.T., M.Sc. lahir di Temanggung pada 29 November 1974 dan saat ini mengemban amanah sebagai Wakil Direktur II Bidang Keuangan, Umum, dan Kerja Sama di Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal dengan pangkat Pembina (IV/a). Beliau menyelesaikan studi Sarjana Teknik Sipil di Universitas Diponegoro (Undip) pada tahun 2003 dan meraih gelar Magister Sistem dan Teknik Transportasi dari Universitas Gadjah Mada (UGM) pada tahun 2009. Berbekal pengalaman panjang di lingkungan Kementerian Perhubungan, beliau berdedikasi dalam mewujudkan tata kelola keuangan yang transparan dan akuntabel, modernisasi sarana prasarana kampus, serta perluasan kemitraan strategis dengan instansi pemerintah dan industri transportasi.",
                'pendidikan' => [
                    'S2 - Magister Sistem dan Teknik Transportasi, Universitas Gadjah Mada (2009)',
                    'S1 - Sarjana Teknik Sipil, Universitas Diponegoro (2003)'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur II PKTJ Tegal (14 September 2026 - Sekarang)',
                    'Dosen / Lektor BPSDMP Kemenhub',
                    'Pejabat Struktural di Lingkungan Kementerian Perhubungan'
                ],
                'penghargaan' => [
                    'Satya Lancana Karya Satya 10 Tahun Presiden RI'
                ],
                'lhkpn_link' => null,
                'lhkpn_file' => null,
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'nama' => 'Hendrik Prasetiyo, M.Sc.',
                'nip' => '19810815 200812 1 002',
                'jabatan' => 'Wakil Direktur III',
                'tempat_tanggal_lahir' => 'Klaten, Jawa Tengah',
                'foto' => 'images/pejabat/Hendrik Prasetiyo.png',
                'biografi' => "Hendrik Prasetiyo, M.Sc. adalah seorang akademisi dan pejabat di lingkungan perguruan tinggi kedinasan di bawah Kementerian Perhubungan Republik Indonesia yang dipercaya mengemban amanah sebagai Wakil Direktur III Bidang Ketarunaan di Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal. Sebelum bertugas di PKTJ Tegal, beliau memiliki rekam jejak kepemimpinan yang panjang di Politeknik Transportasi Darat Indonesia - STTD (PTDI-STTD) Bekasi sebagai Wakil Direktur II dan Kepala Bagian Administrasi Akademik dan Ketarunaan (BAAK), serta pernah mengabdi di Politeknik Transportasi Darat (Poltrada) Bali. Di lingkungan pendidikan vokasi Kemenhub, beliau dikenal aktif dalam pengembangan kurikulum transportasi, pembinaan karakter dan disiplin ketarunaan, serta riset dan pengabdian masyarakat di bidang manajemen transportasi darat dan keselamatan jalan raya.",
                'pendidikan' => [
                    'S2 - Master of Science (M.Sc.) Transportation System & Planning',
                    'D4 / S1 Terapan - Transportasi Darat, STTD Bekasi'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur III PKTJ Tegal (14 September 2026 - Sekarang)',
                    'Wakil Direktur II PTDI-STTD Bekasi',
                    'Kepala BAAK PTDI-STTD Bekasi',
                    'Dosen / Pejabat Akademik Poltrada Bali'
                ],
                'penghargaan' => [
                    'Satya Lencana Karya Satya 10 Tahun Presiden RI'
                ],
                'lhkpn_link' => null,
                'lhkpn_file' => null,
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 4,
                'aktif' => true,
            ],
            [
                'nama' => 'Prima Anna Maria Gorety Cornelis, S. SiT',
                'nip' => '19740204 199602 2 001',
                'jabatan' => 'Kepala Bagian Administrasi Akademik dan Ketarunaan',
                'tempat_tanggal_lahir' => 'Kupang, 04 Februari 1974',
                'foto' => 'images/pejabat/Prima Anna Maria.png',
                'biografi' => "Lahir di Kupang, Nusa Tenggara Timur, pada tanggal 04 Februari 1974. Memulai perjalanan karier pada tahun 2009 sebagai Kepala Sub Seksi Kerja Sama. Pada tahun 2012 menjabat sebagai Kepala Urusan Rumah Tangga. Selanjutnya pada tahun 2015 sampai dengan 2016 menjabat sebagai Kepala Urusan Administrasi Ketarunaan di Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal. Pada tahun 2017 dipercaya menjabat sebagai Kepala Subbagian Rumah Tangga dan Hubungan Masyarakat di Sekolah Tinggi Transportasi Darat (STTD) Bekasi. Pada tahun 2018 sampai dengan 2020 menjabat sebagai Kepala Subbagian Administrasi Akademik. Pada bulan November 2020 sampai dengan April 2021 menjabat sebagai Kepala Subbagian Pengembangan Usaha dan Hubungan Masyarakat. Selanjutnya pada bulan April 2021 sampai dengan Desember 2021 menjabat sebagai Kepala Subbagian Administrasi Ketarunaan dan Alumni. Pada bulan Juni 2023 sampai dengan Februari 2024 menjabat sebagai Kepala Bagian Administrasi Akademik dan Ketarunaan. Kemudian pada bulan Februari 2024 sampai dengan Mei 2024 menjabat sebagai Kepala Bagian Keuangan, Umum, dan Kerja Sama. Sejak bulan Mei 2024 hingga saat ini, beliau menjabat sebagai Kepala Bagian Administrasi Akademik dan Ketarunaan.\n\nBeliau memiliki latar belakang pendidikan Sekolah Menengah Atas (SMA) Ki Hajar Dewantara Kupang yang diselesaikan pada tahun 1993. Pendidikan Diploma III (D-III) diselesaikan di Sekolah Tinggi Transportasi Darat (STTD) Bekasi pada tahun 1996. Selanjutnya menempuh pendidikan Sarjana Terapan (D-IV) di Sekolah Tinggi Transportasi Darat (STTD) Bekasi Jurusan Transportasi Darat dan diselesaikan pada tahun 2000. Penghargaan yang pernah diperoleh antara lain Satya Lencana Karya Satya 10 Tahun pada tahun 2009 dan Satya Lencana Karya Satya 20 Tahun pada tahun 2017. Adapun pelatihan yang pernah diikuti meliputi ESQ Basic Training (2009), Webinar Peran Soft Skill Komunikasi dalam Menghadapi Dunia Kerja (2023), serta Bimbingan Teknis Penyusunan Sasaran Kinerja Pegawai (SKP) (2023).",
                'pendidikan' => [
                    'D4 / S1 Terapan - Jurusan Transportasi Darat, STTD Bekasi (2000)',
                    'D3 - STTD Bekasi (1996)',
                    'SMA Ki Hajar Dewantara Kupang (1993)'
                ],
                'riwayat_jabatan' => [
                    'Kepala Bagian Administrasi Akademik dan Ketarunaan (Mei 2024 - Sekarang)',
                    'Kepala Bagian Keuangan, Umum, dan Kerja Sama (Feb 2024 - Mei 2024)',
                    'Kepala Bagian Administrasi Akademik dan Ketarunaan (Jun 2023 - Feb 2024)',
                    'Kepala Subbagian Administrasi Ketarunaan dan Alumni (Apr 2021 - Des 2021)',
                    'Kepala Subbagian Pengembangan Usaha dan Humas (Nov 2020 - Apr 2021)',
                    'Kepala Subbagian Administrasi Akademik STTD Bekasi (2018 - 2020)',
                    'Kepala Subbagian Rumah Tangga dan Humas STTD Bekasi (2017)',
                    'Kepala Urusan Administrasi Ketarunaan PKTJ Tegal (2015 - 2016)',
                    'Kepala Urusan Rumah Tangga (2012)',
                    'Kepala Sub Seksi Kerja Sama (2009)'
                ],
                'penghargaan' => [
                    'Satya Lencana Karya Satya 20 Tahun (2017)',
                    'Satya Lencana Karya Satya 10 Tahun (2009)'
                ],
                'lhkpn_link' => null,
                'lhkpn_file' => null,
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 5,
                'aktif' => true,
            ],
            [
                'nama' => 'Agus Hariyanto, S. Kom., M. Sc',
                'nip' => '19800801 200912 1 001',
                'jabatan' => 'Kepala Bagian Keuangan, Umum, dan Kerja Sama',
                'tempat_tanggal_lahir' => 'Rembang, 1 Agustus 1980',
                'foto' => 'images/pejabat/Agus Hariyanto.png',
                'biografi' => "Lahir di Rembang, Jawa Tengah, pada tanggal 1 Agustus 1980. Memulai perjalanan karier sebagai Pejabat Pembuat Komitmen pada tahun 2009. Pada tahun 2013 sampai dengan 2016 menjabat sebagai Pejabat Penyusun Bahan Tanggapan Jawaban Sanggahan Banding. Pada tahun 2017 sampai dengan 2018 menjabat sebagai Kepala Subbagian Keuangan dan Umum, BPPTD Palembang. Pada tahun 2019 menjabat sebagai Kepala Subbagian Tata Usaha, Keuangan, dan Kerumahtanggaan. Pada tahun 2019 sampai dengan 2020 menjabat sebagai Kepala Subbagian Keuangan dan Kerumahtanggaan. Pada bulan Agustus 2020 sampai dengan Desember 2021 menjabat sebagai Kepala Subbagian Administrasi Akademik. Pada bulan Agustus 2022 sampai dengan Mei 2024 menjabat sebagai Kepala Bagian Administrasi Akademik dan Ketarunaan. Pada tanggal 30 Mei 2024 ditetapkan sebagai Kepala Bagian Keuangan, Umum, dan Kerja Sama.\n\nBeliau memiliki latar belakang pendidikan Sekolah Menengah Umum Negeri 2 Jurusan IPA di Semarang (1999). Sarjana (S-1) Jurusan Teknik Informatika di Universitas Stikubank Semarang (2004). Magister (S-2) Jurusan Sistem dan Teknik Transportasi diselesaikan di Universitas Gadjah Mada (2015). Pendidikan Magister (S-2) Jurusan Business and Service diselesaikan di Karlstad University (2015). Penghargaan yang pernah diperoleh yaitu Satya Lencana Karya Satya 10 Tahun yang dianugerahkan oleh Presiden Republik Indonesia pada tahun 2019. Pelatihan yang pernah diikuti antara lain Linux (Administration & Networking) (2009), Land Transport Planning di Asian Institute of Technology (AIT) Thailand (2010), Cisco Networking Device (2010), Administrasi Keuangan oleh Kementerian Keuangan (2020), Maritime Labour Convention (2021), Training Sertifikat Insinyur (2023), Artificial Intelligence (2025), Railways Training Development (2025), serta Pelatihan Jarak Jauh Pejabat Penandatanganan Surat Perintah Membayar (PPSPM) (2025).",
                'pendidikan' => [
                    'S2 - Magister Business and Service, Karlstad University (2015)',
                    'S2 - Magister Sistem dan Teknik Transportasi, UGM (2015)',
                    'S1 - Sarjana Teknik Informatika, Universitas Stikubank Semarang (2004)',
                    'SMU Negeri 2 Jurusan IPA Semarang (1999)'
                ],
                'riwayat_jabatan' => [
                    'Kepala Bagian Keuangan, Umum, dan Kerja Sama (Mei 2024 - Sekarang)',
                    'Kepala Bagian Administrasi Akademik dan Ketarunaan (2022 - 2024)',
                    'Kepala Subbagian Administrasi Akademik (2020 - 2021)',
                    'Kepala Subbagian Keuangan dan Kerumahtanggaan (2019 - 2020)',
                    'Kepala Subbagian Tata Usaha, Keuangan, dan Kerumahtanggaan (2019)',
                    'Kepala Subbagian Keuangan dan Umum, BPPTD Palembang (2017 - 2018)',
                    'Pejabat Penyusun Tanggapan Sanggahan Banding (2013 - 2016)',
                    'Pejabat Pembuat Komitmen (2009)'
                ],
                'penghargaan' => [
                    'Satya Lencana Karya Satya 10 Tahun Presiden RI (2019)'
                ],
                'lhkpn_link' => null,
                'lhkpn_file' => null,
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 6,
                'aktif' => true,
            ],
        ];

        foreach ($pejabats as $data) {
            Pejabat::updateOrCreate(
                ['urutan' => $data['urutan']],
                $data
            );
        }
    }
}
