<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use App\Models\InformasiBerkala;
use App\Models\InformasiSetiapSaat;
use App\Models\DaftarInformasi;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. DATA BMN (INFORMASI SETIAP SAAT)
        $bmnFolder = 'https://drive.google.com/drive/folders/1t4KTWXJGCgNfF1Co-1yh6cnUKgwfClii?usp=drive_link';
        $bmnTautan = [
            ['nama' => 'Folder Google Drive: Laporan Data Barang Milik Negara (BMN) 2020-2025', 'url' => 'https://drive.google.com/drive/folders/1t4KTWXJGCgNfF1Co-1yh6cnUKgwfClii?usp=drive_link'],
            ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2025', 'url' => 'https://drive.google.com/file/d/18xnwHrVu13TN1IWd_a2172osc6vaJIl_/view?usp=sharing'],
            ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2024', 'url' => 'https://drive.google.com/file/d/1ktav_JxuX311w0YOsh7EG1B3RswhKtqT/view?usp=sharing'],
            ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2023', 'url' => 'https://drive.google.com/file/d/11pcsgNxnJZIcGW8-9YSOLOYFxGlf-R1s/view?usp=sharing'],
            ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2022', 'url' => 'https://drive.google.com/file/d/1wgltn9co46Y8bmAfevFRqSxcIxYdJo5P/view?usp=sharing'],
            ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2021', 'url' => 'https://drive.google.com/file/d/1yOu1eiR0D_gAKi4vrGl2iSDNA3ITmO0q/view?usp=sharing'],
            ['nama' => 'Informasi Data Perbendaharaan atau Inventaris Barang Milik Negara Tahun 2020', 'url' => 'https://drive.google.com/file/d/1BT6qXihTuk1qk8UmaoIR4IcEdh4SciEa/view?usp=sharing'],
        ];
        $bmnDesc = 'Berisi informasi mengenai mutase tambah kurang, Penyusutan, penetapan status penggunaan, penghapusan barang milik negara unit kerja di lingkungan PKTJ Tegal yang telah di audit oleh BPK-RI.';

        // Update di InformasiSetiapSaat
        if (class_exists(InformasiSetiapSaat::class) && Schema::hasTable('informasi_setiapsaats')) {
            $setiapBmn = InformasiSetiapSaat::where('judul', 'like', '%Barang Milik Negara%')->get();
            if ($setiapBmn->isEmpty()) {
                InformasiSetiapSaat::create([
                    'judul' => 'Laporan Data Barang Milik Negara',
                    'deskripsi' => $bmnDesc,
                    'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                    'penerbit_informasi' => 'Bagian Keuangan Sekretariat PKTJ Tegal',
                    'penanggung_jawab' => 'Bagian Keuangan Sekretariat PKTJ Tegal',
                    'bentuk_informasi' => 'Hardcopy dan Softcopy',
                    'tempat_pembuatan' => 'Tegal',
                    'waktu_pembuatan' => '2026',
                    'jangka_waktu' => '1 Tahun',
                    'file_path' => $bmnFolder,
                    'tautan_links' => $bmnTautan,
                    'aktif' => true,
                ]);
            } else {
                foreach ($setiapBmn as $row) {
                    $row->update([
                        'judul' => 'Laporan Data Barang Milik Negara',
                        'deskripsi' => $bmnDesc,
                        'file_path' => $bmnFolder,
                        'tautan_links' => $bmnTautan,
                        'aktif' => true,
                    ]);
                }
            }
        }

        // Update di DaftarInformasi (Setiap Saat)
        if (class_exists(DaftarInformasi::class) && Schema::hasTable('daftar_informasis')) {
            $daftarBmn = DaftarInformasi::whereIn('kategori', ['informasi-setiap-saat', 'informasi-setiapsaat'])
                ->where(function($q) {
                    $q->where('judul_informasi', 'like', '%Barang Milik Negara%')
                      ->orWhere('judul_informasi', 'like', '%BMN%');
                })->get();

            if ($daftarBmn->isEmpty()) {
                DaftarInformasi::create([
                    'judul_informasi' => 'Laporan Data Barang Milik Negara',
                    'isi_informasi' => $bmnDesc,
                    'kategori' => 'informasi-setiap-saat',
                    'tipe_informasi' => 'setiap-saat',
                    'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                    'penerbit_informasi' => 'Bagian Keuangan Sekretariat PKTJ Tegal',
                    'penanggung_jawab' => 'Bagian Keuangan Sekretariat PKTJ Tegal',
                    'bentuk_informasi' => 'Hardcopy dan Softcopy',
                    'tempat_pembuatan' => 'Tegal',
                    'waktu_pembuatan' => '2026',
                    'jangka_waktu' => '1 Tahun',
                    'file_informasi' => $bmnFolder,
                    'tautan_links' => $bmnTautan,
                    'aktif' => true,
                ]);
            } else {
                foreach ($daftarBmn as $row) {
                    $row->update([
                        'judul_informasi' => 'Laporan Data Barang Milik Negara',
                        'isi_informasi' => $bmnDesc,
                        'file_informasi' => $bmnFolder,
                        'tautan_links' => $bmnTautan,
                        'aktif' => true,
                    ]);
                }
            }
        }


        // 2. DATA BARJAS (INFORMASI BERKALA - ITEM NO 25)
        $barjasFolder = 'https://drive.google.com/drive/folders/1JBjaCxiQUD8DwxzIwpQtd7pTulydHz0N?usp=drive_link';
        $barjasTautan = [
            ['nama' => 'Folder Google Drive: Pengadaan Barang dan Jasa PKTJ', 'url' => 'https://drive.google.com/drive/folders/1JBjaCxiQUD8DwxzIwpQtd7pTulydHz0N?usp=drive_link'],
            ['nama' => '1. Dokumen Rencana Umum Pengadaan (RUP)', 'url' => 'https://drive.google.com/file/d/1StO5AOV6Xt4FFWY3LcOOTii0jS2wR5sU/view?usp=sharing'],
            ['nama' => '3. Dokumen Harga Perkiraan Sendiri (HPS) serta Riwayat HPS', 'url' => 'https://drive.google.com/file/d/1_lNGaDoySZPqLhU3azxn9lrlUwe6tQGw/view?usp=sharing'],
            ['nama' => '4. Dokumen Spesifikasi Teknis', 'url' => 'https://drive.google.com/file/d/1F_cds12A50j7vJJ_IbZYWYf8Q86mgTwQ/view?usp=sharing'],
            ['nama' => '5. Dokumen Rancangan Kontrak', 'url' => 'https://drive.google.com/file/d/1TnMFLc674pgRxDL-GecajQvPNZwHKpQv/view?usp=sharing'],
            ['nama' => '6. Dokumen Persyaratan Penyedia atau Lembar Data kualifikasi', 'url' => 'https://drive.google.com/file/d/1aJpW_hogUqtqiIjvxNCL65PPPxPuRkWt/view?usp=sharing'],
            ['nama' => '7. Dokumen Persyaratan Proses Pemilihan atau Lembar Data Pemilihan', 'url' => 'https://drive.google.com/file/d/1SE4qWg00pplfJ3MMuPe9U7R-k0Hn8MKu/view?usp=sharing'],
            ['nama' => '8. Dokumen Daftar Kuantitas dan Harga', 'url' => 'https://drive.google.com/file/d/11ZYHhF0EyYpeCsMK6oTKSLN4_9OoOC4V/view?usp=sharing'],
            ['nama' => '9. Dokumen Jadwal Pelaksanaan dan Data Lokasi Pekerjaan', 'url' => 'https://drive.google.com/file/d/1VMZMjYZc9LZtTuLSL3srZ_NJbVfK4jyz/view?usp=sharing'],
            ['nama' => '10. Dokumen Gambar Rancangan Pekerjaan', 'url' => 'https://drive.google.com/file/d/1sq8PTV3h--bU3LztVcmk81rAHl4NlQhb/view?usp=sharing'],
            ['nama' => '12. Dokumen Penawaran Administratif', 'url' => 'https://drive.google.com/file/d/1h3_mBtYmj27G7kh3I5Qe_N-zzcfDHmf_/view?usp=sharing'],
            ['nama' => '13. Dokumen Surat Penawaran Penyedia', 'url' => 'https://drive.google.com/file/d/1w1AGtIyFOEBRImqIyGJa4cNxtWsQzD0f/view?usp=sharing'],
            ['nama' => '18. Dokumen Berita Acara Penetapan atau Pengumuman Penyedia', 'url' => 'https://drive.google.com/file/d/1bKKdaLA95j1r2pHqu_nySjeiZWJ3sdtt/view?usp=sharing'],
            ['nama' => '19. Dokumen Laporan Hasil Pemilihan Penyedia', 'url' => 'https://drive.google.com/file/d/1FTzYU3o02FNO5ViWh9PrRA0tucZjgqDv/view?usp=sharing'],
            ['nama' => '20. Dokumen Surat Penunjukan Penyedia Barang/Jasa (SPPBJ)', 'url' => 'https://drive.google.com/file/d/1B6pItBIYTTnv9G0-WZY3p5YxZDYgBRH-/view?usp=sharing'],
            ['nama' => '21. Dokumen Kontrak yang telah ditandatangani beserta Perubahan Kontrak', 'url' => 'https://drive.google.com/file/d/1dzFnN98DAZTWyQCpqNKZLnE94UttNWUq/view?usp=sharing'],
            ['nama' => '22. Dokumen Ringkasan Kontrak', 'url' => 'https://drive.google.com/file/d/1ZcmrV_gAkkfi4Zm3TYiwde-i8evlixtd/view?usp=sharing'],
            ['nama' => '23. Dokumen Surat Perintah Mulai Kerja', 'url' => 'https://drive.google.com/file/d/1FdGK8LjSjpCWAkUbnD0n2Zgk3WT5KGRg/view?usp=sharing'],
            ['nama' => '25. Dokumen Surat Jaminan Uang Muka', 'url' => 'https://drive.google.com/file/d/10Z-9uh8t46cvNgIivT04z6tuDgs5cknl/view?usp=sharing'],
            ['nama' => '26. Dokumen Surat Jaminan Pemeliharaan', 'url' => 'https://drive.google.com/file/d/1dpGnnPcvZ4IfH4B_durmQyjMeXOf7wmf/view?usp=sharing'],
            ['nama' => '27. Dokumen Surat Tagihan', 'url' => 'https://drive.google.com/file/d/1jjQB8OQsmAbrzUpBX6_9g49mqNoYzMiB/view?usp=sharing'],
            ['nama' => '28. Dokumen Surat Pesanan E-purchasing', 'url' => 'https://drive.google.com/file/d/10QAqH5umdPkYFVaeP-fl6s8BYHXzPFE-/view?usp=sharing'],
            ['nama' => '29. Dokumen Surat Perintah Membayar', 'url' => 'https://drive.google.com/file/d/14ll5EhG4PCa_hpzg-whp8x7UIEyfmiSI/view?usp=sharing'],
            ['nama' => '30. Dokumen Surat Perintah Pencairan Dana', 'url' => 'https://drive.google.com/file/d/1p-qP2HrcZXni59HjCbedNzvp3utTeH4b/view?usp=sharing'],
            ['nama' => '31. Dokumen Laporan Pelaksanaan Pekerjaan', 'url' => 'https://drive.google.com/file/d/1MOQPPW6Lby9KlplsTReLrCzFv1MectnI/view?usp=sharing'],
            ['nama' => '32. Dokumen Laporan Penyelesaian Pekerjaan', 'url' => 'https://drive.google.com/file/d/1MSE1Vmdd5lLZSSlqdf_Njd4SM9FhI-YQ/view?usp=sharing'],
            ['nama' => '33. Dokumen Berita Acara Pemeriksaan Hasil Pekerjaan', 'url' => 'https://drive.google.com/file/d/1FvD7eqJm1gEKMeWNJ6iJYYiE-XbXTGB1/view?usp=sharing'],
            ['nama' => '34. Dokumen Berita Acara Serah Terima Sementara (PHO)', 'url' => 'https://drive.google.com/file/d/1-d5_KHHS3LWrU7TZd1Yp3J5GarLU7X2Z/view?usp=sharing']
        ];
        $barjasDesc = 'Berisi informasi tentang pengadaan barang dan jasa sesuai Peraturan Komisi Informasi Republik Indonesia Nomor 1 Tahun 2021 pasal 14 yang berisikan Tahap Perencanaan (dokumen, RUP), Tahap Pemilihan (23 dokumentasi) dan Tahap pelaksanaan (15 dokumen).';

        // Update di InformasiBerkala
        if (class_exists(InformasiBerkala::class) && Schema::hasTable('informasi_berkalas')) {
            $berkalaBarjas = InformasiBerkala::where('judul', 'like', '%pengadaan barang%')->get();
            if ($berkalaBarjas->isEmpty()) {
                InformasiBerkala::create([
                    'judul' => 'Informasi tentang pengadaan barang dan jasa di PKTJ Tegal',
                    'deskripsi' => $barjasDesc,
                    'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                    'penerbit_informasi' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                    'penanggung_jawab' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                    'bentuk_informasi' => 'hardcopy dan softcopy',
                    'tempat_pembuatan' => 'Tegal',
                    'waktu_pembuatan' => '2026',
                    'jangka_waktu' => '1 Tahun',
                    'file_path' => $barjasFolder,
                    'tautan_links' => $barjasTautan,
                    'aktif' => true,
                ]);
            } else {
                foreach ($berkalaBarjas as $row) {
                    $row->update([
                        'judul' => 'Informasi tentang pengadaan barang dan jasa di PKTJ Tegal',
                        'deskripsi' => $barjasDesc,
                        'file_path' => $barjasFolder,
                        'tautan_links' => $barjasTautan,
                        'aktif' => true,
                    ]);
                }
            }
        }

        // Update di DaftarInformasi (Berkala)
        if (class_exists(DaftarInformasi::class) && Schema::hasTable('daftar_informasis')) {
            $daftarBarjas = DaftarInformasi::where('kategori', 'informasi-berkala')
                ->where(function($q) {
                    $q->where('judul_informasi', 'like', '%pengadaan barang%')
                      ->orWhere('judul_informasi', 'like', '%barjas%');
                })->get();

            if ($daftarBarjas->isEmpty()) {
                DaftarInformasi::create([
                    'judul_informasi' => 'Informasi tentang pengadaan barang dan jasa di PKTJ Tegal',
                    'isi_informasi' => $barjasDesc,
                    'kategori' => 'informasi-berkala',
                    'tipe_informasi' => 'berkala',
                    'pejabat_penguasa' => 'PPID Pelaksana UPT PKTJ Tegal',
                    'penerbit_informasi' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                    'penanggung_jawab' => 'Unit Kerja di Lingkungan PKTJ Tegal',
                    'bentuk_informasi' => 'hardcopy dan softcopy',
                    'tempat_pembuatan' => 'Tegal',
                    'waktu_pembuatan' => '2026',
                    'jangka_waktu' => '1 Tahun',
                    'file_informasi' => $barjasFolder,
                    'tautan_links' => $barjasTautan,
                    'aktif' => true,
                ]);
            } else {
                foreach ($daftarBarjas as $row) {
                    $row->update([
                        'judul_informasi' => 'Informasi tentang pengadaan barang dan jasa di PKTJ Tegal',
                        'isi_informasi' => $barjasDesc,
                        'file_informasi' => $barjasFolder,
                        'tautan_links' => $barjasTautan,
                        'aktif' => true,
                    ]);
                }
            }
        }

        // 3. DATA STATISTIK PKTJ (HANYA SATU LINK WEBSITE RESMI)
        $statUrl = 'https://ppid.pktj.ac.id/profil/statistik-pegawai';
        $statTautan = [
            ['nama' => 'Halaman Data & Statistik Kepegawaian PKTJ', 'url' => $statUrl]
        ];

        if (class_exists(InformasiBerkala::class) && Schema::hasTable('informasi_berkalas')) {
            InformasiBerkala::where('judul', 'like', '%Statistik PKTJ%')->update([
                'file_path' => $statUrl,
                'tautan_links' => $statTautan,
                'aktif' => true,
            ]);
        }

        if (class_exists(DaftarInformasi::class) && Schema::hasTable('daftar_informasis')) {
            DaftarInformasi::where('judul_informasi', 'like', '%Statistik PKTJ%')->update([
                'file_informasi' => $statUrl,
                'tautan_links' => $statTautan,
                'aktif' => true,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No action needed
    }
};
