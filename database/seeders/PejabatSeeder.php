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
                'nama' => 'Edi Purwanto, A. TD., M. T',
                'nip' => '19700918 199803 1 001',
                'jabatan' => 'Wakil Direktur I',
                'tempat_tanggal_lahir' => 'Tegal, 7 Februari 1968',
                'foto' => 'images/pejabat/Edi Purwanto.png',
                'biografi' => "Lahir di Tegal, Jawa Tengah, pada tanggal 7 Februari 1968. Memulai perjalanan karier sebagai Fungsional Umum pada tahun 2016. Pada bulan Maret 2018 sampai dengan Agustus 2024 menjabat sebagai Wakil Direktur I. Pada tanggal 21 Agustus 2024 sampai dengan sekarang menjabat sebagai Wakil Direktur I berdasarkan Surat Keputusan yang diterbitkan oleh Kepala Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP).\n\nBeliau memiliki latar belakang pendidikan Sekolah Menengah Atas Negeri Gombong (1986). Pendidikan Diploma III Jurusan Teknik diselesaikan di Sekolah Tinggi Transportasi Darat Bekasi (1989). Pendidikan Sarjana Terapan (D-IV) Jurusan Teknik diselesaikan di Sekolah Tinggi Transportasi Darat Bekasi (1996). Pendidikan Magister (S-2) Jurusan Teknik Sipil diselesaikan di Universitas Islam Sultan Agung (2015). Penghargaan yang pernah diperoleh yaitu Satya Lencana Karya Satya 30 Tahun yang dianugerahkan oleh Presiden Republik Indonesia pada tahun 2021. Pelatihan yang pernah diikuti antara lain Road Safety Short Course (2012) di Leeds, United Kingdom, Diklat Asesor Audit dan Inspeksi Keselamatan Jalan (2017), serta Bimbingan Teknis di Bidang Laik Fungsi Jalan (2017).",
                'pendidikan' => [
                    'S2 - Magister Teknik Sipil, Universitas Islam Sultan Agung (2015)',
                    'D4 / S1 Terapan - Jurusan Teknik, STTD Bekasi (1996)',
                    'D3 - Jurusan Teknik, STTD Bekasi (1989)',
                    'SMA Negeri Gombong (1986)'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur I PKTJ (2024 - Sekarang)',
                    'Wakil Direktur I PKTJ (2018 - 2024)',
                    'Fungsional Umum (2016)'
                ],
                'penghargaan' => [
                    'Satya Lencana Karya Satya 30 Tahun Presiden RI (2021)'
                ],
                'lhkpn_link' => null,
                'lhkpn_file' => null,
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'nama' => 'Sugianto, A. TD, M. M',
                'nip' => '19660601 199103 1 004',
                'jabatan' => 'Wakil Direktur II',
                'tempat_tanggal_lahir' => 'Jakarta Timur, 1 Juni 1966',
                'foto' => 'images/pejabat/Sugianto.png',
                'biografi' => "Lahir di Jakarta Timur, pada tanggal 1 Juni 1966. Perjalanan karier dimulai pada tahun 2006 hingga 2010 dengan menjabat sebagai Kasubag Sistem Informasi dan Pelaporan. Pada tahun 2014 diangkat sebagai Kepala Kantor BLLAJSDP Denpasar. Selanjutnya pada tahun 2016 dipercaya menjabat sebagai Kasubdit Perlengkapan Jalan, Direktorat Lalu Lintas Hubungan Darat. Pada tahun 2017 menjabat sebagai Kepala Subdirektorat Evaluasi Program. Pada tahun 2018 dipercaya sebagai Kepala Bagian Rencana, kemudian pada Mei 2018 ditetapkan sebagai Kepala Balai Teknik Perkeretaapian Kelas II Wilayah Sumatera Bagian Selatan. Selanjutnya pada Juni 2019 hingga Agustus 2022 menjabat sebagai Kepala Bagian Administrasi Akademik dan Ketarunaan. Pada Agustus 2022 hingga Agustus 2024 dipercaya menjabat sebagai Wakil Direktur I, dan pada Agustus 2024 hingga sekarang secara resmi ditetapkan sebagai Wakil Direktur II.\n\nBeliau memiliki latar belakang pendidikan Sekolah Menengah Atas (SMA) Negeri 51 Jakarta yang diselesaikan pada tahun 1985. Pendidikan Diploma III (D-III) ditempuh di Sekolah Tinggi Transportasi Darat Bekasi dan diselesaikan pada tahun 1990. Selanjutnya menyelesaikan pendidikan Sarjana Terapan (D-IV) di Sekolah Tinggi Transportasi Darat Bekasi pada tahun 1994. Pendidikan Magister (S-2) Bidang Pendidikan diselesaikan pada tahun 2005. Penghargaan yang pernah diperoleh antara lain Satya Lancana Karya Satya 10 Tahun yang dianugerahkan oleh Presiden Republik Indonesia pada tahun 2003, Satya Lancana Karya Satya 20 Tahun pada tahun 2011, serta Satya Lancana Karya Satya 30 Tahun pada tahun 2021. Adapun pelatihan yang pernah diikuti meliputi Oxford Course Indonesia (1987), Pelatihan Sistem Informasi Geografi (1994), Integrated Policymaking Traffic and Transport (1994), General Presentation of A JISRAIL Equipment (1994), Telekomunikasi Railways (1998), Introduction to Splicing Testing (1998), Pencegahan dan Pemberantasan Tindak Pidana Pencucian Uang di Lingkungan Birokrasi (2011), Pelatihan Pembinaan Mental dan Fisik Kemenhub (2015), Diklat Pekerti (2019), Manajemen Angkutan Barang (2020), Audit (2021), Andalalin (2022), Freight Forwarder (2023), Management of Training (2024), Seminar Peningkatan Kemampuan SDM Dosen dan Instruktur (2024), Perencanaan Transportasi ASDP (2024), serta pelatihan Public Transport Fundamentals (2025).",
                'pendidikan' => [
                    'S2 - Bidang Pendidikan (2005)',
                    'D4 / S1 Terapan - STTD Bekasi (1994)',
                    'D3 - STTD Bekasi (1990)',
                    'SMA Negeri 51 Jakarta (1985)'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur II PKTJ (2024 - Sekarang)',
                    'Wakil Direktur I PKTJ (2022 - 2024)',
                    'Kepala Bagian Administrasi Akademik dan Ketarunaan (2019 - 2022)',
                    'Kepala Balai Teknik Perkeretaapian Kelas II Wil. Sumsel (2018)',
                    'Kepala Bagian Rencana (2018)',
                    'Kepala Subdirektorat Evaluasi Program (2017)',
                    'Kasubdit Perlengkapan Jalan Ditjen Hubdat (2016)',
                    'Kepala Kantor BLLAJSDP Denpasar (2014)',
                    'Kasubag Sistem Informasi dan Pelaporan (2006 - 2010)'
                ],
                'penghargaan' => [
                    'Satya Lancana Karya Satya 30 Tahun (2021)',
                    'Satya Lancana Karya Satya 20 Tahun (2011)',
                    'Satya Lancana Karya Satya 10 Tahun (2003)'
                ],
                'lhkpn_link' => null,
                'lhkpn_file' => null,
                'lhkpn_tahun' => '2025/2026',
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'nama' => 'Dr. Setya Wijayanta, S. Pd., M. T',
                'nip' => '19780824 200212 1 001',
                'jabatan' => 'Wakil Direktur III',
                'tempat_tanggal_lahir' => 'Kulon Progo, 22 Mei 1981',
                'foto' => 'images/pejabat/Setya Wijayanta.png',
                'biografi' => "Lahir di Kulon Progo, Daerah Istimewa Yogyakarta, pada tanggal 22 Mei 1981. Perjalanan karier dimulai pada tahun 2013 dengan menjabat sebagai Asisten Ahli. Pada tahun 2015 diangkat sebagai Lektor. Selanjutnya pada tahun 2019 dipercaya menjabat sebagai Wakil Direktur III. Pada tahun 2025 memperoleh jabatan fungsional sebagai Dosen Lektor Kepala, dan pada tanggal 16 Mei 2025 secara resmi ditetapkan kembali sebagai Wakil Direktur III. Beliau memiliki latar belakang pendidikan Sekolah Menengah Kejuruan (SMK) Negeri 2 Pengasih, Jurusan Teknik Mekanik Otomotif, yang diselesaikan pada tahun 1999. Pendidikan Sarjana (S-1) ditempuh di Universitas Negeri Yogyakarta pada Jurusan Pendidikan Teknik Mesin dengan Konsentrasi Otomotif dan diselesaikan pada tahun 2005. Selanjutnya menyelesaikan pendidikan Magister (S-2) di Universitas Indonesia pada tahun 2012. Pendidikan Doktor (S-3) diselesaikan di Universitas Gadjah Mada pada Jurusan Teknik Mesin pada tahun 2023.\n\nPenghargaan yang pernah diperoleh antara lain Piagam Penghargaan Pekan Ilmiah MAH pada tahun 2003 dan 2005, Piagam Penghargaan Peringkat Pertama pada tahun 2009, Piagam Penghargaan Lulusan dengan Predikat Cumlaude pada tahun 2012, serta Satya Lencana Karya Satya 10 Tahun yang dianugerahkan oleh Presiden Republik Indonesia pada tahun 2019. Adapun pelatihan yang pernah diikuti meliputi ESQ Leadership Training (2009), Pengenalan Dasar Scuba Diver (2010), Diklat Calon Widyaiswara (2010), Training Sistem ABS (2012), Pelatihan Pendamping Peningkatan Budaya Mutu Perguruan Tinggi (Auditor AMI-PT) (2013), Training Advance Chasis dan Engine (2013), Pelatihan Asesor Kompetensi Standar TAA (2013), Training Course ARRB Hawkeye 2000 Network Survey Vehicle for Road Safety Audit (2013), Road Safety Management (2014), Diklat AA (Applied Approach) (2015), Sertifikasi Dosen Profesional (2016), Road Safety Development Programme (2018), Basic Electric and Circuit Training (2019), Safeworking on E-Vehicles Basis (NEN 9140) (2019), Workshop Penulisan Jurnal Internasional (2020), Diklat Lalu Lintas Angkutan Jalan (2021), Scientific and Academic Writing (2023), Wuling AIR EV Product Knowledge (2024), System Dynamics Modelling di Lingkungan Kementerian Perhubungan (2024), Knowledge Sharing Dosen Subsektor Darat (2025), Big Data Analytics dalam Transportasi (2025), International Webinar (2025), Sustainable Entrepreneurial Leadership Program The Ministry of Transportation (Indonesia) (2025), Workshop Strategi Jitu Meraih Gelar Profesor bagi Dosen Vokasi di Lingkungan BPSDMP (2025), serta pelatihan Artificial Intelligence (2025).",
                'pendidikan' => [
                    'S3 - Doktor Teknik Mesin, Universitas Gadjah Mada (2023)',
                    'S2 - Magister, Universitas Indonesia (2012)',
                    'S1 - Pendidikan Teknik Mesin Konsentrasi Otomotif, UNY (2005)',
                    'SMK Negeri 2 Pengasih, Teknik Mekanik Otomotif (1999)'
                ],
                'riwayat_jabatan' => [
                    'Wakil Direktur III PKTJ (2019 - Sekarang)',
                    'Dosen Lektor Kepala (2025)',
                    'Lektor (2015)',
                    'Asisten Ahli (2013)'
                ],
                'penghargaan' => [
                    'Satya Lencana Karya Satya 10 Tahun Presiden RI (2019)',
                    'Piagam Penghargaan Lulusan Predikat Cumlaude (2012)',
                    'Piagam Penghargaan Peringkat Pertama (2009)',
                    'Piagam Penghargaan Pekan Ilmiah MAH (2003, 2005)'
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
