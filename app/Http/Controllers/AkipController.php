<?php

namespace App\Http\Controllers;

use App\Models\DaftarInformasi;
use App\Models\InformasiBerkala;
use App\Models\InformasiSetiapSaat;
use App\Models\InformasiSertaMerta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AkipController extends Controller
{
    public static $akipMap = [
        'A8' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Dokumentasi Foto dan Notulensi Rapat Koordinasi Internal Layanan PPID PKTJ',
            'deskripsi' => 'Bukti penyelenggaraan rapat koordinasi, forum pembahasan layanan informasi, evaluasi berkala pemutakhiran data informasi publik, dan konsolidasi internal pengelola PPID di lingkungan PKTJ.',
            'file_path' => 'storage/dokumen/A8.JPG',
            'waktu' => '2026',
        ],
        'A9' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Dokumentasi Keikutsertaan Bimbingan Teknis & Evaluasi Monev KIP Kementerian Perhubungan',
            'deskripsi' => 'Bukti partisipasi aktif pengelola PPID PKTJ dalam bimbingan teknis dan evaluasi keterbukaan informasi publik yang diselenggarakan oleh PPID Utama Kemenhub.',
            'file_path' => 'storage/dokumen/A9.jpg',
            'waktu' => '2025/2026',
        ],
        'B1' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Petunjuk Operasional Kegiatan (POK) Alokasi Anggaran Khusus PPID PKTJ Tahun 2025/2026',
            'deskripsi' => 'Rincian lembar alokasi dana khusus kegiatan operasional, pemeliharaan website, dan sosialisasi keterbukaan informasi publik PPID PKTJ Tegal.',
            'file_path' => 'storage/dokumen/B1-B4.pdf',
            'waktu' => '2025/2026',
        ],
        'B4' => [
            'kategori' => 'informasi-setiap-saat',
            'view' => 'admin.informasi.setiapsaat.edit',
            'judul' => 'Surat Rekapitulasi dan Berita Acara Konsolidasi Usulan DIP & DIK PKTJ Tahun 2026',
            'deskripsi' => 'Dokumen rekapitulasi usulan klasifikasi informasi terbuka dan dikecualikan dari seluruh unit kerja internal PKTJ.',
            'file_path' => 'storage/dokumen/B1-B4.pdf',
            'waktu' => '2026',
        ],
        'B5' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Bukti Kehadiran dan Komitmen Pimpinan PKTJ pada Penganugerahan & Monev KIP',
            'deskripsi' => 'Foto dokumentasi, absensi, dan bukti kehadiran Direktur PKTJ pada kegiatan penganugerahan AKIP dan evaluasi KIP Kementerian Perhubungan.',
            'file_path' => 'storage/dokumen/B5.pdf',
            'waktu' => '2025/2026',
        ],
        'F1' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Profil Kelembagaan Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal',
            'deskripsi' => 'Informasi kedudukan, domisili kampus, kontak resmi, sejarah, dan profil komprehensif PKTJ Tegal.',
            'file_path' => 'storage/dokumen/F1.pdf',
            'waktu' => '2025/2026',
        ],
        'F2' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Profil Pimpinan, Biodata Pejabat Struktural & Lembar LHKPN KPK Direktur PKTJ',
            'deskripsi' => 'Biodata pimpinan, riwayat jabatan, riwayat pendidikan, dan bukti tanda terima penyampaian LHKPN Direktur PKTJ ke KPK.',
            'file_path' => 'storage/dokumen/F2.pdf',
            'waktu' => '2025/2026',
        ],
        'F4' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Rencana Strategis (Renstra) Politeknik Keselamatan Transportasi Jalan 2020-2024 / 2025-2029',
            'deskripsi' => 'Dokumen perencanaan jangka menengah arah kebijakan dan target strategis pendidikan vokasi keselamatan transportasi jalan.',
            'file_path' => 'storage/dokumen/F4.pdf',
            'waktu' => '2025',
        ],
        'F5' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Rencana Kerja Tahunan (RKT) PKTJ Tegal Tahun 2025/2026',
            'deskripsi' => 'Rencana operasional kerja tahunan dan target kinerja unit kerja di lingkungan PKTJ Tegal.',
            'file_path' => 'storage/dokumen/RKT_PKTJ.pdf',
            'waktu' => '2025/2026',
        ],
        'F6' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah (LAKIP) PKTJ Tegal',
            'deskripsi' => 'Laporan pertanggungjawaban capaian target indikator kinerja utama (IKU) dan realisasi kinerja tahunan PKTJ.',
            'file_path' => 'storage/dokumen/F6.pdf',
            'waktu' => '2024/2025',
        ],
        'F7' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Laporan Keuangan Audited dan Laporan Auditor Independen (LAI) PKTJ Tegal',
            'deskripsi' => 'Laporan keuangan terverifikasi (Neraca, LO, LPE, LRA, dan CaLK) beserta opini hasil audit auditor independen/BPK.',
            'file_path' => 'storage/dokumen/F7.pdf',
            'waktu' => '2024/2025',
        ],
        'F8' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'DIPA Petikan dan Laporan Realisasi Anggaran PKTJ Tegal',
            'deskripsi' => 'Dokumen otorisasi anggaran DIPA dan laporan realisasi penyerapan anggaran belanja PKTJ Tegal.',
            'file_path' => 'storage/dokumen/F8.xlsx',
            'waktu' => '2025/2026',
        ],
        'F9' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Rencana Umum Pengadaan (SiRUP) Barang dan Jasa PKTJ Tegal',
            'deskripsi' => 'Daftar paket pengadaan barang dan jasa penyedia dan swakelola yang diumumkan pada portal SiRUP LKPP.',
            'file_path' => 'storage/dokumen/F9.xlsx',
            'waktu' => '2025/2026',
        ],
        'F10' => [
            'kategori' => 'informasi-berkala',
            'view' => 'admin.informasi.berkala.edit',
            'judul' => 'Pengumuman Lelang LPSE dan Dokumen Kontrak Pengadaan PKTJ',
            'deskripsi' => 'Informasi tender/lelang LPSE dan ringkasan dokumen kontrak pengadaan barang dan jasa PKTJ Tegal.',
            'file_path' => 'storage/dokumen/F10.pdf',
            'waktu' => '2025/2026',
        ],
        'G1' => [
            'kategori' => 'informasi-setiap-saat',
            'view' => 'admin.informasi.setiapsaat.edit',
            'judul' => 'Keputusan Penetapan Daftar Informasi Publik (DIP) dan Daftar Informasi Dikecualikan (DIK) PKTJ Tegal Tahun 2026',
            'deskripsi' => 'Surat Keputusan Direktur PKTJ mengenai penetapan klasifikasi dokumen publik berkala, setiap saat, serta merta, dan informasi yang dikecualikan tahun 2026.',
            'file_path' => 'storage/dokumen/G1.pdf',
            'waktu' => '2026',
        ],
        'G2' => [
            'kategori' => 'informasi-setiap-saat',
            'view' => 'admin.informasi.setiapsaat.edit',
            'judul' => 'Laporan Posisi dan Inventaris Barang Milik Negara (BMN) PKTJ Tegal',
            'deskripsi' => 'Rekapitulasi dan inventarisasi aset tanah, gedung, laboratorium, armada kendaraan pengujian, dan peralatan BMN PKTJ Tegal.',
            'file_path' => 'storage/dokumen/G2.pdf',
            'waktu' => '2025/2026',
        ],
        'G3' => [
            'kategori' => 'informasi-setiap-saat',
            'view' => 'admin.informasi.setiapsaat.edit',
            'judul' => 'Buku Register Surat Masuk dan Surat Keluar Kedinasan PKTJ Tegal (Tahun 2023 - 2026)',
            'deskripsi' => 'Buku pencatatan register surat masuk dan surat keluar kedinasan melalui aplikasi persuratan Srikandi Kemenhub.',
            'file_path' => 'storage/dokumen/G3.pdf',
            'waktu' => '2023-2026',
        ],
        'H1' => [
            'kategori' => 'informasi-serta-merta',
            'view' => 'admin.informasi.sertamerta.edit',
            'judul' => 'Pemberitahuan Peringatan Dini Cuaca Ekstrem dan Jalur Evakuasi Kampus PKTJ Tegal',
            'deskripsi' => 'Informasi kesiapsiagaan darurat bencana alam, peringatan dini BMKG, dan peta jalur evakuasi di lingkungan kampus PKTJ.',
            'file_path' => 'storage/dokumen/H1.pdf',
            'waktu' => '2025/2026',
        ],
        'H2' => [
            'kategori' => 'informasi-serta-merta',
            'view' => 'admin.informasi.sertamerta.edit',
            'judul' => 'Protokol Kesiapsiagaan Kesehatan dan Laporan Kegiatan P4GN PKTJ Tegal',
            'deskripsi' => 'Informasi pencegahan narkoba (P4GN), SOP layanan klinik kesehatan, dan protokol kesiapsiagaan darurat kesehatan.',
            'file_path' => 'storage/dokumen/H2.pdf',
            'waktu' => '2025/2026',
        ],
        'H3' => [
            'kategori' => 'informasi-serta-merta',
            'view' => 'admin.informasi.sertamerta.edit',
            'judul' => 'Pengumuman Darurat Penyesuaian Jadwal & Gangguan Server Sipencatar Kemenhub',
            'deskripsi' => 'Pemberitahuan resmi keadaan mendesak terkait penyesuaian jadwal atau kendala teknis sistem seleksi penerimaan calon taruna transportasi darat.',
            'file_path' => 'storage/dokumen/H3.pdf',
            'waktu' => '2025/2026',
        ],
    ];

    /**
     * Edit form for dedicated AKIP item by indicator code (A8, A9, B1, B4, F1, etc.)
     */
    public function edit(string $code): View
    {
        $codeUpper = strtoupper(str_replace(['-', '_', '.'], '', $code));
        $tpl = static::$akipMap[$codeUpper] ?? null;

        if (!$tpl) {
            abort(404, 'Kode indikator AKIP tidak ditemukan.');
        }

        // Cari atau buat data baru secara aman tanpa mengubah data lama yang sudah ada
        try {
            $daftar = DaftarInformasi::firstOrCreate(
                ['judul_informasi' => $tpl['judul']],
                [
                    'kategori' => $tpl['kategori'],
                    'tipe_informasi' => str_replace('informasi-', '', $tpl['kategori']),
                    'isi_informasi' => $tpl['deskripsi'],
                    'file_informasi' => $tpl['file_path'],
                    'waktu_pembuatan' => $tpl['waktu'] ?? '2025/2026',
                    'aktif' => true,
                    'is_blurred' => false,
                    'bisa_download' => true,
                ]
            );

            $item = $daftar;
            $item->judul = $daftar->judul_informasi;
            $item->deskripsi = $daftar->isi_informasi;
            $item->file_path = $daftar->file_informasi;
            $item->tanggal = $daftar->created_at ?? now();
        } catch (\Throwable $e) {
            // Fallback instance
            $item = new DaftarInformasi([
                'judul_informasi' => $tpl['judul'],
                'isi_informasi' => $tpl['deskripsi'],
                'kategori' => $tpl['kategori'],
                'tipe_informasi' => str_replace('informasi-', '', $tpl['kategori']),
                'aktif' => true,
            ]);
            $item->id = 999;
            $item->judul = $tpl['judul'];
            $item->deskripsi = $tpl['deskripsi'];
            $item->file_path = $tpl['file_path'];
            $item->tanggal = now();
        }

        return view($tpl['view'], compact('item'));
    }
}
