<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Layanan Aksesibilitas & Informasi Huruf Braille - PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            background-color: #fff;
            padding: 20px;
            font-size: 14px;
            line-height: 1.6;
        }
        .kop-surat {
            border-bottom: 5px double #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
            text-align: center;
        }
        .kop-title-dept {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
            letter-spacing: 1px;
        }
        .kop-title-sub {
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
        }
        .kop-title-inst {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
            letter-spacing: 0.5px;
        }
        .kop-details {
            font-size: 11px;
            margin: 5px 0 0 0;
            font-style: italic;
        }
        .report-title {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16px;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .section-header {
            font-size: 14px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
        }
        .text-justify {
            text-align: justify;
        }
        .stat-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .stat-table th, .stat-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        .stat-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .no-print-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <button onclick="window.print();" class="btn btn-primary no-print no-print-btn">
        <i class="fas fa-print me-2"></i> Cetak Laporan
    </button>

    <div class="container" style="max-width: 800px;">
        <!-- Kop Surat -->
        <div class="kop-surat d-flex align-items-center justify-content-center">
            <div class="text-center w-100">
                <p class="kop-title-dept">Kementerian Perhubungan</p>
                <p class="kop-title-sub">Badan Pengembangan Sumber Daya Manusia Perhubungan</p>
                <p class="kop-title-inst">Politeknik Keselamatan Transportasi Jalan</p>
                <p class="kop-details">Jl. Perintis Kemerdekaan No. 17, Kota Tegal | Telp: (0283) 351061 | Email: ppid@pktj.ac.id</p>
            </div>
        </div>

        <!-- Judul Laporan -->
        <p class="report-title">Laporan Tahunan Kepatuhan & Realisasi Layanan Informasi Publik Huruf Braille & Inklusif<br>Tahun Anggaran 2025/2026</p>

        <!-- Pendahuluan -->
        <div class="section-header">I. Pendahuluan</div>
        <p class="text-justify">
            Berdasarkan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Undang-Undang Nomor 8 Tahun 2016 tentang Penyandang Disabilitas, serta Peraturan Komisi Informasi (Perki) Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik, Badan Publik berkewajiban untuk menyediakan aksesibilitas informasi bagi penyandang disabilitas. PPID Pelaksana Politeknik Keselamatan Transportasi Jalan (PKTJ) berkomitmen mewujudkan keadilan akses informasi publik tanpa diskriminasi melalui optimalisasi penyediaan dokumen dalam huruf Braille, format cetak besar (large print), pendampingan lisan oleh petugas khusus, serta pembacaan suara berbasis digital.
        </p>

        <!-- Ketersediaan Dokumen -->
        <div class="section-header">II. Ketersediaan Sarana & Prasarana Informasi Inklusif</div>
        <p class="text-justify">
            Hingga tahun 2026, PPID PKTJ telah melengkapi sarana aksesibilitas informasi yang meliputi:
        </p>
        <ul>
            <li><strong>Dokumen Huruf Braille (Hardcopy):</strong> Formulir permohonan informasi publik, Formulir pengajuan keberatan, Ringkasan Struktur PPID PKTJ, dan Maklumat Pelayanan dalam Huruf Braille yang dicetak menggunakan mesin Braille Embosser khusus.</li>
            <li><strong>Aksesibilitas Digital (Softcopy):</strong> Seluruh dokumen PDF informasi publik di situs web PPID PKTJ telah distrukturkan ulang agar kompatibel secara penuh dengan perangkat lunak pembaca layar (screen reader) seperti JAWS, NVDA, dan fitur Talkback pada smartphone.</li>
            <li><strong>Layanan Video Bahasa Isyarat:</strong> Video profil PPID PKTJ, SOP pengajuan informasi, dan Maklumat Pelayanan telah dilengkapi dengan penerjemah bahasa isyarat (sign language interpreter) visual.</li>
            <li><strong>Widget Aksesibilitas Web:</strong> Penambahan sistem kontrol mandiri bagi pembaca di situs web (Kontras Tinggi, Grayscale, Pembaca Suara otomatis / Text-to-Speech).</li>
        </ul>

        <!-- Statistik Realisasi -->
        <div class="section-header">III. Statistik Pelayanan Informasi Inklusif (Braille & Disabilitas)</div>
        <p class="text-justify">
            Berikut adalah rekapitulasi data pelayanan informasi inklusif PPID PKTJ selama tahun berjalan:
        </p>
        <table class="stat-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Jenis Layanan Informasi</th>
                    <th>Jumlah Pengajuan</th>
                    <th>Realisasi Layanan</th>
                    <th>Tingkat Penyelesaian (%)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Permohonan Dokumen Format Huruf Braille</td>
                    <td>2</td>
                    <td>2 (Cetak Braille)</td>
                    <td>100%</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Pendampingan Pengisian Formulir / Lisan</td>
                    <td>5</td>
                    <td>5 (Bantuan Petugas)</td>
                    <td>100%</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Permohonan Salinan Format Cetak Besar (Large Print)</td>
                    <td>1</td>
                    <td>1 (Cetak Kertas A3)</td>
                    <td>100%</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Aksesibilitas Video Bahasa Isyarat</td>
                    <td>-</td>
                    <td>Tersedia (Publik)</td>
                    <td>100%</td>
                </tr>
            </tbody>
        </table>

        <!-- Kesimpulan -->
        <div class="section-header">IV. Tindak Lanjut dan Kesimpulan</div>
        <p class="text-justify">
            Penyediaan layanan informasi dalam huruf Braille dan inklusif di PPID PKTJ telah berjalan dengan baik dengan tingkat kepatuhan 100% terhadap regulasi keterbukaan informasi. PPID PKTJ akan terus melakukan pembaharuan sarana embosser secara berkala untuk memastikan penyediaan cetakan dokumen Braille yang tajam dan mudah dibaca oleh pemohon informasi tunanetra.
        </p>

        <!-- Tanda Tangan -->
        <div class="row signature-section">
            <div class="col-6"></div>
            <div class="col-6 text-center">
                <p>Tegal, 11 Juni 2026</p>
                <p class="mb-5">Atasan PPID Pelaksana PKTJ,</p>
                <br><br>
                <p class="mt-4"><b>( ___________________________ )</b><br>NIP. .....................................................</p>
            </div>
        </div>
    </div>

</body>
</html>
