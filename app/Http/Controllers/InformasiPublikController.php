<?php

namespace App\Http\Controllers;

use App\Models\InformasiBerkala;
use App\Models\InformasiSertaMerta;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiDikecualikan;
use App\Models\Prosedur;
use App\Models\Dashboard;
use App\Models\DaftarInformasi;
use App\Models\Pejabat;
use Illuminate\Support\Facades\Storage;

class InformasiPublikController extends Controller
{
    private function getSettings()
    {
        try {
            return Dashboard::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }

    private function processContent(?string $content, bool $isBlurred): ?string
    {
        if (!$content) return null;
        if (!$isBlurred) return $content;
        return preg_replace_callback('/(\/preview-dokumen\?[^"\']+)/', function($matches) {
            $url = $matches[1];
            if (strpos($url, 'is_blurred=') === false) {
                $separator = (strpos($url, '?') !== false) ? '&' : '?';
                return $url . $separator . 'is_blurred=1';
            }
            return $url;
        }, $content);
    }

    private function ensureDataSeeded(): void
    {
        // PERMANEN DINONAKTIFKAN: Jangan jalankan seeder apapun saat request halaman publik
        // agar perubahan data, upload file, atau link baru dari admin panel tidak pernah tertimpa.
        return;
    }

    private function getHiddenTitles(): array
    {
        try {
            $hiddenDaftar = DaftarInformasi::where('aktif', false)
                ->pluck('judul_informasi')
                ->map(fn($t) => strtolower(trim($t)))
                ->all();

            $hiddenBerkala = class_exists(InformasiBerkala::class) 
                ? InformasiBerkala::where('aktif', false)->pluck('judul')->map(fn($t) => strtolower(trim($t)))->all() 
                : [];

            $hiddenSetiapSaat = class_exists(InformasiSetiapSaat::class) 
                ? InformasiSetiapSaat::where('aktif', false)->pluck('judul')->map(fn($t) => strtolower(trim($t)))->all() 
                : [];

            $hiddenSertaMerta = class_exists(InformasiSertaMerta::class) 
                ? InformasiSertaMerta::where('aktif', false)->pluck('judul')->map(fn($t) => strtolower(trim($t)))->all() 
                : [];

            $manualHidden = [];

            return array_unique(array_filter(array_merge($hiddenDaftar, $hiddenBerkala, $hiddenSetiapSaat, $hiddenSertaMerta, $manualHidden)));
        } catch (\Throwable $e) {
            return [];
        }
    }

    private function mapDaftarInformasi($item)
    {
        $item->judul = $item->judul_informasi;
        $item->deskripsi = $this->processContent($item->isi_informasi, $item->is_blurred ?? false);
        
        $rawFile = $item->file_informasi;
        $item->file_path = $rawFile;
        $item->bisa_download = (bool) ($item->bisa_download ?? true);
        $item->file_size = $item->file_size ?? '-';

        $item->pejabat_penguasa = $item->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal';
        $item->penerbit_informasi = $item->penerbit_informasi ?? 'Bagian Keuangan dan Umum';
        $item->penanggung_jawab = $item->penanggung_jawab ?? $item->penerbit_informasi;
        $item->tempat_pembuatan = $item->tempat_pembuatan ?? 'Tegal';
        $item->waktu_pembuatan = $item->waktu_pembuatan ?? ($item->created_at ? date('Y', strtotime($item->created_at)) : '2025');
        $item->bentuk_informasi = $item->bentuk_informasi ?? 'hardcopy dan softcopy';
        $item->jangka_waktu = $item->jangka_waktu ?? '1 Tahun';
        $item->tipe_informasi = $item->tipe_informasi ?? null;

        $tautanLinks = $item->tautan_links;
        if (is_string($tautanLinks)) {
            $tautanLinks = json_decode($tautanLinks, true);
        }
        $item->tautan_links = is_array($tautanLinks) ? $tautanLinks : [];

        $item->tanggal = $item->created_at;
        return $item;
    }

    private function mapModelItem($s)
    {
        $item = new \stdClass();
        $item->id = $s->id;
        $item->judul = $s->judul;
        $item->deskripsi = $this->processContent($s->deskripsi, $s->is_blurred ?? false);
        
        $rawFile = $s->file_path;
        $item->file_path = $rawFile;
        $item->bisa_download = (bool) ($s->bisa_download ?? true);
        $item->file_size = $s->file_size ?? '-';

        $item->pejabat_penguasa = $s->pejabat_penguasa ?? 'PPID Pelaksana UPT PKTJ Tegal';
        $item->penerbit_informasi = $s->penerbit_informasi ?? 'Bagian Keuangan dan Umum';
        $item->penanggung_jawab = $s->penanggung_jawab ?? $item->penerbit_informasi;
        $item->tempat_pembuatan = $s->tempat_pembuatan ?? 'Tegal';
        $item->waktu_pembuatan = $s->waktu_pembuatan ?? ($s->tanggal ? date('Y', strtotime($s->tanggal)) : '2025');
        $item->bentuk_informasi = $s->bentuk_informasi ?? 'Softcopy & Hardcopy';
        $item->jangka_waktu = $s->jangka_waktu ?? '1 Tahun';
        $item->tipe_informasi = $s->tipe_informasi ?? null;

        $tautanLinks = $s->tautan_links;
        if (is_string($tautanLinks)) {
            $tautanLinks = json_decode($tautanLinks, true);
        }
        $item->tautan_links = is_array($tautanLinks) ? $tautanLinks : [];

        $item->tanggal = $s->tanggal ?? $s->created_at;
        $item->created_at = $s->created_at ?? now();
        $item->is_blurred = (bool) ($s->is_blurred ?? false);
        return $item;
    }

    private function itemHasValidContent($item): bool
    {
        if (!empty($item->tautan_links) && is_array($item->tautan_links)) {
            foreach ($item->tautan_links as $lnk) {
                $u = trim($lnk['url'] ?? '');
                if ($u !== '' && !in_array(strtolower($u), ['#', '-', 'null', 'none', 'javascript:void(0)'])) {
                    return true;
                }
            }
        }

        if (empty($item->file_path)) {
            return false;
        }

        $path = trim($item->file_path);
        if ($path === '' || in_array(strtolower($path), ['#', '-', 'null', 'none', 'tanpa preview', 'tidak ada', 'undefined', 'javascript:void(0)', '#!', '/layanan-informasi/daftar'])) {
            return false;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return true;
        }

        if (str_starts_with($path, '/')) {
            return !in_array($path, ['/', '/#', '/layanan-informasi/daftar']);
        }

        if (function_exists('has_valid_document') && has_valid_document($path)) {
            return true;
        }

        return false;
    }

    /**
     * Self-healing data sync for BMN (Informasi Setiap Saat)
     */
    public static function syncBmnData(): void
    {
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

        if (class_exists(InformasiSetiapSaat::class) && \Illuminate\Support\Facades\Schema::hasTable('informasi_setiapsaats')) {
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

        if (class_exists(DaftarInformasi::class) && \Illuminate\Support\Facades\Schema::hasTable('daftar_informasis')) {
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
    }

    /**
     * Self-healing data sync for Barjas (Informasi Berkala - Item 25)
     */
    public static function syncBarjasData(): void
    {
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

        if (class_exists(InformasiBerkala::class) && \Illuminate\Support\Facades\Schema::hasTable('informasi_berkalas')) {
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

        if (class_exists(DaftarInformasi::class) && \Illuminate\Support\Facades\Schema::hasTable('daftar_informasis')) {
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
    }

    /**
     * Self-healing data sync for Statistik PKTJ (Informasi Berkala - Item 13)
     */
    public static function syncStatistikData(): void
    {
        $statUrl = 'https://ppid.pktj.ac.id/profil/statistik-pegawai';
        $statTautan = [
            ['nama' => 'Halaman Data & Statistik Kepegawaian PKTJ', 'url' => $statUrl]
        ];

        if (class_exists(InformasiBerkala::class) && \Illuminate\Support\Facades\Schema::hasTable('informasi_berkalas')) {
            InformasiBerkala::where('judul', 'like', '%Statistik PKTJ%')->update([
                'file_path' => $statUrl,
                'tautan_links' => $statTautan,
                'aktif' => true,
            ]);
        }

        if (class_exists(DaftarInformasi::class) && \Illuminate\Support\Facades\Schema::hasTable('daftar_informasis')) {
            DaftarInformasi::where('judul_informasi', 'like', '%Statistik PKTJ%')->update([
                'file_informasi' => $statUrl,
                'tautan_links' => $statTautan,
                'aktif' => true,
            ]);
        }
    }

    // Informasi Berkala
    public function informasiBerkala()
    {
        $this->ensureDataSeeded();
        try {
            // Auto self-healing jika Barjas belum terisi Google Drive folder atau masih link bpsdm
            $barjasItem = class_exists(InformasiBerkala::class) ? InformasiBerkala::where('judul', 'like', '%pengadaan barang%')->first() : null;
            if (!$barjasItem || !str_contains($barjasItem->file_path ?? '', '1JBjaCxiQUD8DwxzIwpQtd7pTulydHz0N') || str_contains($barjasItem->file_path ?? '', 'bpsdm.kemenhub.go.id')) {
                self::syncBarjasData();
            }

            // Auto self-healing memastikan Statistik PKTJ hanya memiliki tautan website resmi
            $statItem = class_exists(InformasiBerkala::class) ? InformasiBerkala::where('judul', 'like', '%Statistik PKTJ%')->first() : null;
            if ($statItem) {
                $links = $statItem->tautan_links;
                if (is_string($links)) $links = json_decode($links, true);
                if (is_array($links) && (count($links) > 1 || !empty(array_filter($links, fn($l) => str_contains($l['url'] ?? '', 'drive.google.com'))))) {
                    self::syncStatistikData();
                }
            }
        } catch (\Throwable $e) {}

        try {
            $hiddenTitles = $this->getHiddenTitles();

            // 1. Ambil data utama resmi dari model InformasiBerkala (DIP 2026)
            $modelItems = collect();
            if (class_exists(InformasiBerkala::class)) {
                $modelItems = InformasiBerkala::where('aktif', true)
                    ->orderBy('id', 'asc')
                    ->get()
                    ->map(fn($item) => $this->mapModelItem($item));
            }

            $modelTitles = $modelItems->pluck('judul')->map(fn($t) => strtolower(trim($t)))->all();

            // 2. Ambil data tambahan dari DaftarInformasi yang belum ada di InformasiBerkala
            $daftarItems = DaftarInformasi::where('aktif', true)
                ->where('kategori', 'informasi-berkala')
                ->get()
                ->filter(fn($d) => !in_array(strtolower(trim($d->judul_informasi)), $modelTitles))
                ->map(fn($item) => $this->mapDaftarInformasi($item));

            $items = $modelItems->concat($daftarItems)
                ->filter(fn($it) => !in_array(strtolower(trim($it->judul)), $hiddenTitles))
                ->values();

        } catch (\Throwable $e) {
            $items = collect([]);
        }


        try {
            $pejabats = Pejabat::getActivePejabats();
        } catch (\Throwable $e) {
            $pejabats = collect([]);
        }

        $settings = $this->getSettings();
        return view('informasi-berkala', compact('items', 'settings', 'pejabats'));
    }

    // Profil Pejabat Publik & LHKPN (Dedicated Page)
    public function profilPejabat()
    {
        $this->ensureDataSeeded();
        try {
            $pejabats = Pejabat::getActivePejabats();
        } catch (\Throwable $e) {
            $pejabats = collect([]);
        }

        $settings = $this->getSettings();
        $data = \App\Http\Controllers\StatistikPegawaiController::getMergedSettings();
        return view('profil-pejabat', compact('pejabats', 'settings', 'data'));
    }

    // Data & Statistik Kepegawaian PKTJ (Dedicated Page)
    public function statistikPegawai()
    {
        $this->ensureDataSeeded();
        $settings = $this->getSettings();
        $data = \App\Http\Controllers\StatistikPegawaiController::getMergedSettings();
        return view('statistik-pegawai', compact('settings', 'data'));
    }

    // Informasi Serta Merta
    public function informasiSertamerta()
    {
        $this->ensureDataSeeded();
        try {
            $hiddenTitles = $this->getHiddenTitles();

            // 1. Ambil data utama resmi dari model InformasiSertaMerta (DIP 2026)
            $modelItems = collect();
            if (class_exists(InformasiSertaMerta::class)) {
                $modelItems = InformasiSertaMerta::where('aktif', true)
                    ->orderBy('id', 'asc')
                    ->get()
                    ->map(fn($item) => $this->mapModelItem($item));
            }

            $modelTitles = $modelItems->pluck('judul')->map(fn($t) => strtolower(trim($t)))->all();

            // 2. Ambil data tambahan dari DaftarInformasi yang belum ada di InformasiSertaMerta
            $daftarItems = DaftarInformasi::where('aktif', true)
                ->whereIn('kategori', ['informasi-serta-merta', 'informasi-sertamerta'])
                ->get()
                ->filter(fn($d) => !in_array(strtolower(trim($d->judul_informasi)), $modelTitles))
                ->map(fn($item) => $this->mapDaftarInformasi($item));

            $items = $modelItems->concat($daftarItems)
                ->filter(fn($it) => !in_array(strtolower(trim($it->judul)), $hiddenTitles))
                ->values();

        } catch (\Throwable $e) {
            $items = collect([]);
        }

        $settings = $this->getSettings();
        return view('informasi-serta-merta', compact('items', 'settings'));
    }

    // Informasi Setiap Saat
    public function informasiSetiapsaat()
    {
        $this->ensureDataSeeded();
        try {
            // Auto self-healing jika BMN belum terisi Google Drive folder atau masih link bpsdm
            $bmnItem = class_exists(InformasiSetiapSaat::class) ? InformasiSetiapSaat::where('judul', 'like', '%Barang Milik Negara%')->first() : null;
            if (!$bmnItem || !str_contains($bmnItem->file_path ?? '', '1t4KTWXJGCgNfF1Co-1yh6cnUKgwfClii') || str_contains($bmnItem->file_path ?? '', 'bpsdm.kemenhub.go.id')) {
                self::syncBmnData();
            }
        } catch (\Throwable $e) {}

        try {
            $hiddenTitles = $this->getHiddenTitles();

            // 1. Ambil data utama resmi dari model InformasiSetiapSaat (DIP 2026)
            $modelItems = collect();
            if (class_exists(InformasiSetiapSaat::class)) {
                $modelItems = InformasiSetiapSaat::where('aktif', true)
                    ->orderBy('id', 'asc')
                    ->get()
                    ->map(fn($item) => $this->mapModelItem($item));
            }

            $modelTitles = $modelItems->pluck('judul')->map(fn($t) => strtolower(trim($t)))->all();

            // 2. Ambil data tambahan dari DaftarInformasi yang belum ada di InformasiSetiapSaat
            $daftarItems = DaftarInformasi::where('aktif', true)
                ->whereIn('kategori', ['informasi-setiap-saat', 'informasi-setiapsaat'])
                ->get()
                ->filter(fn($d) => !in_array(strtolower(trim($d->judul_informasi)), $modelTitles))
                ->map(fn($item) => $this->mapDaftarInformasi($item));

            $items = $modelItems->concat($daftarItems)
                ->filter(fn($it) => !in_array(strtolower(trim($it->judul)), $hiddenTitles))
                ->values();
        } catch (\Throwable $e) {
            $items = collect([]);
        }

        $settings = $this->getSettings();
        return view('informasi-setiap-saat', compact('items', 'settings'));
    }


    // Informasi Dikecualikan
    public function informasiDikecualikan(\Illuminate\Http\Request $request)
    {
        $dikecualikanAktif = \App\Models\Dashboard::getValue('menu_dikecualikan_aktif');
        $isTayang = ($dikecualikanAktif === '1' || $dikecualikanAktif === 1 || $dikecualikanAktif === true);

        // Jika dinonaktifkan / disembunyikan dan pengunjung bukan admin yang sedang login
        if (!$isTayang && !auth()->check()) {
            return redirect()->route('informasi.berkala')->with('info', 'Halaman Informasi Dikecualikan saat ini sedang ditutup/tidak ditayangkan untuk publik.');
        }

        try {
            $query = InformasiDikecualikan::where('aktif', true);

            if ($request->filled('informasi')) {
                $query->where('judul', 'like', '%' . $request->informasi . '%');
            }
            if ($request->filled('dasar_hukum')) {
                $query->where('dasar_hukum', 'like', '%' . $request->dasar_hukum . '%');
            }
            if ($request->filled('penanggung_jawab')) {
                $query->where('penanggung_jawab', 'like', '%' . $request->penanggung_jawab . '%');
            }

            $items = $query->orderBy('tanggal', 'desc')->orderBy('id', 'asc')->paginate(20)->withQueryString();
            
            foreach ($items as $item) {
                $item->deskripsi = $this->processContent($item->deskripsi, $item->is_blurred ?? false);
            }
        } catch (\Throwable $e) {
            $items = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
        }
        
        $settings = $this->getSettings();
        return view('informasi-dikecualikan', compact('items', 'settings'));
    }

    // Prosedur
    public function prosedur($kategori = null)
    {
        if (!$kategori) {
            $routeName = request()->route()->getName();
            $kategori = str_replace('prosedur.', '', $routeName);
        }

        $settings = $this->getSettings();
        return view('prosedur.' . $kategori, compact('settings'));
    }

    // Download file
    public function downloadFile($model, $id)
    {
        try {
            switch($model) {
                case 'berkala':
                    $data = DaftarInformasi::find($id);
                    if ($data) {
                        $data->file_path = $data->file_informasi;
                    } else {
                        $data = InformasiBerkala::findOrFail($id);
                    }
                    break;
                case 'sertamerta':
                    $data = DaftarInformasi::find($id);
                    if ($data) {
                        $data->file_path = $data->file_informasi;
                    } else {
                        $data = InformasiSertaMerta::findOrFail($id);
                    }
                    break;
                case 'setiapsaat':
                    $data = DaftarInformasi::find($id);
                    if ($data) {
                        $data->file_path = $data->file_informasi;
                    } else {
                        $data = InformasiSetiapSaat::findOrFail($id);
                    }
                    break;
                case 'dikecualikan':
                    $data = InformasiDikecualikan::findOrFail($id);
                    break;
                case 'dip':
                    $data = DaftarInformasi::findOrFail($id);
                    $data->file_path = $data->file_informasi;
                    break;
                default:
                    abort(404);
            }

            if (!$data->file_path || !has_valid_document($data->file_path)) {
                abort(404, 'File dokumen tidak tersedia untuk diunduh.');
            }

            if (strpos($data->file_path, 'http') === 0) {
                return redirect()->away($data->file_path);
            }

            if (Storage::disk('public')->exists($data->file_path)) {
                return Storage::disk('public')->download($data->file_path);
            }

            if (file_exists(public_path($data->file_path))) {
                return response()->download(public_path($data->file_path));
            }

            return redirect()->away($data->file_path);
        } catch (\Throwable $e) {
            abort(404, 'File tidak dapat diakses.');
        }
    }

    /**
     * Quick toggle status (aktif/tidak aktif) for Admin Panel
     */
    public function toggleStatus(\Illuminate\Http\Request $request, $type, $id)
    {
        $newStatus = null;
        $title = null;

        if ($type === 'berkala') {
            $item = \App\Models\InformasiBerkala::find($id) ?? \App\Models\DaftarInformasi::find($id);
            if ($item) {
                $newStatus = !(bool)$item->aktif;
                $title = $item->judul ?? $item->judul_informasi;
                if (class_exists(\App\Models\InformasiBerkala::class)) {
                    \App\Models\InformasiBerkala::where('id', $id)->orWhere('judul', $title)->update(['aktif' => $newStatus]);
                }
                \App\Models\DaftarInformasi::where('id', $id)->orWhere('judul_informasi', $title)->update(['aktif' => $newStatus]);
            }
        } elseif ($type === 'sertamerta') {
            $item = \App\Models\InformasiSertaMerta::find($id) ?? \App\Models\DaftarInformasi::find($id);
            if ($item) {
                $newStatus = !(bool)$item->aktif;
                $title = $item->judul ?? $item->judul_informasi;
                if (class_exists(\App\Models\InformasiSertaMerta::class)) {
                    \App\Models\InformasiSertaMerta::where('id', $id)->orWhere('judul', $title)->update(['aktif' => $newStatus]);
                }
                \App\Models\DaftarInformasi::where('id', $id)->orWhere('judul_informasi', $title)->update(['aktif' => $newStatus]);
            }
        } elseif ($type === 'setiapsaat') {
            $item = \App\Models\InformasiSetiapSaat::find($id) ?? \App\Models\DaftarInformasi::find($id);
            if ($item) {
                $newStatus = !(bool)$item->aktif;
                $title = $item->judul ?? $item->judul_informasi;
                if (class_exists(\App\Models\InformasiSetiapSaat::class)) {
                    \App\Models\InformasiSetiapSaat::where('id', $id)->orWhere('judul', $title)->update(['aktif' => $newStatus]);
                }
                \App\Models\DaftarInformasi::where('id', $id)->orWhere('judul_informasi', $title)->update(['aktif' => $newStatus]);
            }
        } elseif ($type === 'dikecualikan') {
            $item = \App\Models\InformasiDikecualikan::find($id) ?? \App\Models\DaftarInformasi::find($id);
            if ($item) {
                $newStatus = !(bool)$item->aktif;
                $title = $item->judul ?? $item->judul_informasi;
                if (class_exists(\App\Models\InformasiDikecualikan::class)) {
                    \App\Models\InformasiDikecualikan::where('id', $id)->orWhere('judul', $title)->update(['aktif' => $newStatus]);
                }
                \App\Models\DaftarInformasi::where('id', $id)->orWhere('judul_informasi', $title)->update(['aktif' => $newStatus]);
            }
        } elseif ($type === 'daftar') {
            $item = \App\Models\DaftarInformasi::find($id);
            if ($item) {
                $newStatus = !(bool)$item->aktif;
                $item->aktif = $newStatus;
                $item->save();
            }
        } elseif ($type === 'dokumen') {
            $item = \App\Models\Dokumen::find($id);
            if ($item) {
                $newStatus = !(bool)$item->aktif;
                $item->aktif = $newStatus;
                $item->save();
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'aktif' => (bool)$newStatus,
                'status_label' => $newStatus ? 'AKTIF' : 'TIDAK AKTIF',
                'message' => 'Status berhasil diubah menjadi ' . ($newStatus ? 'AKTIF' : 'TIDAK AKTIF')
            ]);
        }

        return back()->with('success', 'Status publikasi berhasil diubah menjadi ' . ($newStatus ? 'AKTIF' : 'TIDAK AKTIF') . '!');
    }

    /**
     * Quick toggle status for Dokumen
     */
    public function toggleDokumenStatus(\Illuminate\Http\Request $request, $id)
    {
        return $this->toggleStatus($request, 'dokumen', $id);
    }
}
