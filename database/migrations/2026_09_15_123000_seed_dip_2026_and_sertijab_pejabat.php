<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use App\Models\InformasiBerkala;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiSertaMerta;
use App\Models\DaftarInformasi;
use App\Models\Pejabat;
use App\Models\Dashboard;

return new class extends Migration
{
    /**
     * Run the migrations to synchronize DIP 2026 and Pejabat Sertijab automatically on deployment.
     */
    public function up(): void
    {
        // 1. SEED DIP 2026
        if (file_exists(database_path('seeders/DipPktj2026Seeder.php'))) {
            require_once database_path('seeders/DipPktj2026Seeder.php');
            $seeder = new \Database\Seeders\DipPktj2026Seeder();
            $seeder->run();
        }

        // 2. UPDATE PEJABAT SERTIJAB 14 SEPTEMBER 2026
        // Direktur
        $direktur = Pejabat::where('urutan', 1)->first() ?? Pejabat::find(1);
        if ($direktur) {
            $direktur->update([
                'nama' => 'Dr. Ir. Bambang Istiyanto, S.SiT., M.T., IPU',
                'jabatan' => 'Direktur',
                'urutan' => 1,
                'foto' => 'images/pejabat/Bambang Istiyanto.png',
                'aktif' => true,
            ]);
        }

        // Wadir I: Dr. Setya Wijayanta, S.Pd.T., M.T.
        $wadir1 = Pejabat::where('urutan', 2)->first() ?? Pejabat::find(2) ?? new Pejabat();
        $wadir1->nama = 'Dr. Setya Wijayanta, S.Pd.T., M.T.';
        $wadir1->nip = '19780512 200502 1 001';
        $wadir1->jabatan = 'Wakil Direktur I';
        $wadir1->tempat_tanggal_lahir = 'Klaten, 12 Mei 1978';
        $wadir1->foto = 'images/pejabat/Setya Wijayanta.png';
        $wadir1->foto_width = 160;
        $wadir1->foto_height = 240;
        $wadir1->foto_card_height = 240;
        $wadir1->foto_position = 'top center';
        $wadir1->foto_radius = 12;
        $wadir1->biografi = 'Dr. Setya Wijayanta, S.Pd.T., M.T. adalah akademisi dan praktisi pendidikan vokasi transportasi yang dipercaya mengemban amanah sebagai Wakil Direktur I Bidang Akademik di Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal setelah sebelumnya bertugas sebagai Wakil Direktur III. Beliau menempuh pendidikan doktoral serta magister dalam bidang teknik dan pendidikan kejuruan dengan kepakaran pada keselamatan teknik kendaraan, rekayasa otomotif, serta standardisasi kurikulum vokasi perhubungan. Dalam kepemimpinannya, beliau berfokus pada penguatan mutu tridharma perguruan tinggi, akreditasi program studi unggul, dan kesiapan kompetensi taruna-taruni keselamatan jalan di kancah nasional maupun internasional.';
        $wadir1->pendidikan = "• S-1 Pendidikan Teknik Otomotif\n• S-2 Magister Teknik Mesin\n• S-3 Doktor Ilmu Pendidikan";
        $wadir1->riwayat_jabatan = "• Dosen / Lektor PKTJ Tegal\n• Wakil Direktur III PKTJ Tegal\n• Wakil Direktur I PKTJ Tegal";
        $wadir1->lhkpn_link = 'https://elhkpn.kpk.go.id';
        $wadir1->lhkpn_tahun = '2025/2026';
        $wadir1->urutan = 2;
        $wadir1->aktif = true;
        $wadir1->save();

        // Wadir II: R. Arief Novianto, S.T., M.Sc.
        $wadir2 = Pejabat::where('urutan', 3)->first() ?? Pejabat::find(3) ?? new Pejabat();
        $wadir2->nama = 'R. Arief Novianto, S.T., M.Sc.';
        $wadir2->nip = '19741129 200604 1 001';
        $wadir2->jabatan = 'Wakil Direktur II';
        $wadir2->tempat_tanggal_lahir = 'Temanggung, 29 November 1974';
        $wadir2->foto = 'images/pejabat/Arief Novianto.png';
        $wadir2->foto_width = 160;
        $wadir2->foto_height = 240;
        $wadir2->foto_card_height = 240;
        $wadir2->foto_position = 'top center';
        $wadir2->foto_radius = 12;
        $wadir2->biografi = 'R. Arief Novianto, S.T., M.Sc. lahir di Temanggung pada 29 November 1974 dan saat ini mengemban amanah sebagai Wakil Direktur II Bidang Keuangan, Umum, dan Kerja Sama di Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal dengan pangkat Pembina (IV/a). Beliau menyelesaikan studi Sarjana Teknik Sipil di Universitas Diponegoro (Undip) pada tahun 2003 dan meraih gelar Magister Sistem dan Teknik Transportasi dari Universitas Gadjah Mada (UGM) pada tahun 2009. Berbekal pengalaman panjang di lingkungan Kementerian Perhubungan, beliau berdedikasi dalam mewujudkan tata kelola keuangan yang transparan dan akuntabel, modernisasi sarana prasarana kampus, serta perluasan kemitraan strategis dengan instansi pemerintah dan industri transportasi.';
        $wadir2->pendidikan = "• S-1 Teknik Sipil, Universitas Diponegoro (Undip), 2003\n• S-2 Magister Sistem dan Teknik Transportasi, Universitas Gadjah Mada (UGM), 2009";
        $wadir2->riwayat_jabatan = "• Kepala Seksi / Kasubbag di Lingkungan Kemenhub\n• Dosen / Lektor BPSDMP Kemenhub\n• Wakil Direktur II PKTJ Tegal";
        $wadir2->lhkpn_link = 'https://elhkpn.kpk.go.id';
        $wadir2->lhkpn_tahun = '2025/2026';
        $wadir2->urutan = 3;
        $wadir2->aktif = true;
        $wadir2->save();

        // Wadir III: Hendrik Prasetiyo, M.Sc.
        $wadir3 = Pejabat::where('urutan', 4)->first() ?? Pejabat::find(4) ?? new Pejabat();
        $wadir3->nama = 'Hendrik Prasetiyo, M.Sc.';
        $wadir3->nip = '19810815 200812 1 002';
        $wadir3->jabatan = 'Wakil Direktur III';
        $wadir3->tempat_tanggal_lahir = 'Klaten, Jawa Tengah';
        $wadir3->foto = 'images/pejabat/Hendrik Prasetiyo.png';
        $wadir3->foto_width = 160;
        $wadir3->foto_height = 240;
        $wadir3->foto_card_height = 240;
        $wadir3->foto_position = 'top center';
        $wadir3->foto_radius = 12;
        $wadir3->biografi = 'Hendrik Prasetiyo, M.Sc. adalah seorang akademisi dan pejabat di lingkungan perguruan tinggi kedinasan di bawah Kementerian Perhubungan Republik Indonesia yang dipercaya mengemban amanah sebagai Wakil Direktur III Bidang Ketarunaan di Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal. Sebelum bertugas di PKTJ Tegal, beliau memiliki rekam jejak kepemimpinan yang panjang di Politeknik Transportasi Darat Indonesia - STTD (PTDI-STTD) Bekasi sebagai Wakil Direktur II dan Kepala Bagian Administrasi Akademik dan Ketarunaan (BAAK), serta pernah mengabdi di Politeknik Transportasi Darat (Poltrada) Bali. Di lingkungan pendidikan vokasi Kemenhub, beliau dikenal aktif dalam pengembangan kurikulum transportasi, pembinaan karakter dan disiplin ketarunaan, serta riset dan pengabdian masyarakat di bidang manajemen transportasi darat dan keselamatan jalan raya.';
        $wadir3->pendidikan = "• D-IV / Sarjana Terapan Transportasi Darat\n• S-2 Master of Science (M.Sc.) Transportation System & Planning";
        $wadir3->riwayat_jabatan = "• Kepala BAAK PTDI-STTD Bekasi\n• Wakil Direktur II PTDI-STTD Bekasi\n• Dosen / Pejabat Akademik Poltrada Bali\n• Wakil Direktur III PKTJ Tegal";
        $wadir3->lhkpn_link = 'https://elhkpn.kpk.go.id';
        $wadir3->lhkpn_tahun = '2025/2026';
        $wadir3->urutan = 4;
        $wadir3->aktif = true;
        $wadir3->save();

        // 3. UPDATE STATISTIK PEGAWAI GOOGLE DRIVE SETTING
        Dashboard::updateOrCreate(
            ['key' => 'statistik_pegawai_gdrive_folder_url'],
            [
                'value' => 'https://drive.google.com/drive/folders/164eOazEqPabeX6h6atbn3KEs8FWHQVjJ?usp=drive_link',
                'type' => 'text',
                'description' => 'Link Folder Google Drive Kepegawaian',
                'aktif' => true
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};
