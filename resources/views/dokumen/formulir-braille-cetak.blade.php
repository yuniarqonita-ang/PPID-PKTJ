<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permohonan Informasi Publik Huruf Braille - PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            background-color: #fff;
            padding: 20px;
            font-size: 14px;
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
        .form-title {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16px;
            margin-bottom: 5px;
            text-decoration: underline;
        }
        .braille-sub {
            text-align: center;
            font-size: 11px;
            color: #333;
            margin-bottom: 25px;
            font-family: monospace;
            letter-spacing: 2px;
        }
        .meta-table td {
            padding: 8px;
            vertical-align: top;
        }
        .border-box {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 15px;
        }
        .signature-section {
            margin-top: 50px;
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
        .disability-badge {
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 12px;
            line-height: 1.5;
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

    <div class="no-print" style="position: fixed; bottom: 30px; right: 30px; z-index: 9999; display: flex; gap: 12px;">
        <a href="{{ route('dokumen.formulir-braille-word') }}" class="btn btn-success" style="padding: 14px 28px; border-radius: 50px; font-weight: 800; box-shadow: 0 10px 25px rgba(25, 135, 84, 0.4); text-transform: uppercase; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; background-color: #198754; border-color: #198754; color: white;">
            <i class="fas fa-file-word fa-lg"></i> Download Word (Edit)
        </a>
        <button onclick="window.print();" class="btn btn-primary" style="padding: 14px 28px; border-radius: 50px; font-weight: 800; box-shadow: 0 10px 25px rgba(13, 110, 253, 0.4); text-transform: uppercase; font-size: 13px; display: inline-flex; align-items: center; gap: 8px; background-color: #0d6efd; border-color: #0d6efd; color: white;">
            <i class="fas fa-print fa-lg"></i> Cetak Formulir
        </button>
    </div>

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

        <!-- Judul Formulir -->
        <p class="form-title">Formulir Permohonan Informasi Publik (Format Huruf Braille)</p>
        <p class="braille-sub">⠋⠕⠗⠍⠥⠇⠊⠗ ⠏⠑⠗⠍⠕a⠕⠝ ⠊⠝⠋⠕⠗⠍apackages</p>
        <p class="text-end mb-3">No. Registrasi (diisi petugas): .............................................</p>

        <!-- Informasi Aksesibilitas -->
        <div class="disability-badge">
            <strong><i class="fas fa-universal-access me-1"></i> PEMBERITAHUAN LAYANAN INKLUSIF:</strong><br>
            Formulir ini dirancang sebagai panduan cetak (dual-media) untuk permohonan dokumen dalam format huruf Braille. Bagi pemohon tunanetra, petugas layanan PPID PKTJ siap mendampingi pengisian formulir secara lisan, membacakan dokumen informasi, maupun melakukan pencetakan dokumen hasil permohonan menggunakan mesin pencetak Braille (Braille Embosser) secara gratis tanpa dipungut biaya.
        </div>

        <!-- Tabel Identitas -->
        <table class="meta-table w-100 mb-4">
            <tr>
                <td style="width: 5%;">1.</td>
                <td style="width: 40%;">Nama Lengkap Pemohon <br><span class="text-muted small" style="font-family: monospace;">(⠝a⠍a ⠇⠑⠝⠛⠅a⠏)</span></td>
                <td style="width: 3%;">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Alamat Lengkap <br><span class="text-muted small" style="font-family: monospace;">(a⠇a⠍a⠝)</span></td>
                <td>:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Nomor Identitas (NIK/KTP) <br><span class="text-muted small" style="font-family: monospace;">(⠝⠊⠅/⠅⠞⠏)</span></td>
                <td>:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Nomor Telepon / WhatsApp <br><span class="text-muted small" style="font-family: monospace;">(⠞⠑⠇⠏/⠺a)</span></td>
                <td>:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Rincian Informasi yang Dibutuhkan <br><span class="text-muted small" style="font-family: monospace;">(⠗⠊⠝⠉⠊a⠝ ⠊⠝⠋⠕⠗⠍a⠞⠊)</span></td>
                <td>:</td>
                <td>
                    <div class="border-box" style="height: 100px;"></div>
                </td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Tujuan Penggunaan Informasi <br><span class="text-muted small" style="font-family: monospace;">(⠞⠥⠚⠥a⠝ ⠊⠝⠋⠕⠗⠍a⠞⠊)</span></td>
                <td>:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>7.</td>
                <td>Bentuk Salinan Hasil Yang Diinginkan <br><span class="text-muted small" style="font-family: monospace;">(⠃⠑⠝⠞⠥⠅ ⠎a⠇⠊⠝a⠝)</span></td>
                <td>:</td>
                <td>
                    <div>[ &nbsp; ] Cetak Kertas Braille (Braille Hardcopy)</div>
                    <div>[ &nbsp; ] File Digital Kompatibel Screen-Reader (Braille Softcopy)</div>
                    <div>[ &nbsp; ] Dokumen Cetak Huruf Besar (Large Print)</div>
                </td>
            </tr>
            <tr>
                <td>8.</td>
                <td>Metode Penyerahan Salinan <br><span class="text-muted small" style="font-family: monospace;">(⠍⠑⠞⠕⠙⠑ ⠏⠑⠝⠽⠑⠗aa⠝)</span></td>
                <td>:</td>
                <td>
                    <div class="d-flex flex-wrap gap-3">
                        <div>[ &nbsp; ] Diambil Langsung di Meja PPID</div>
                        <div>[ &nbsp; ] Dikirim Via Kurir (Kertas Braille)</div>
                        <div>[ &nbsp; ] Via Email / Media Digital</div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Bagian Tanda Tangan -->
        <div class="row signature-section">
            <div class="col-6 text-center">
                <p class="mb-5">Petugas PPID PKTJ,</p>
                <br>
                <p class="mt-4"><b>( ..................................................... )</b></p>
            </div>
            <div class="col-6 text-center">
                <p>Tegal, ............................................ 20...</p>
                <p class="mb-5">Pemohon Informasi,</p>
                <br>
                <p class="mt-4"><b>( ..................................................... )</b></p>
            </div>
        </div>

        <!-- Footer Legal Kemenhub -->
        <div class="mt-5 pt-3 border-top text-muted text-center no-print" style="font-size: 11px;">
            Formulir resmi Layanan Inklusif (Braille) dicetak melalui Portal PPID Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.
        </div>
    </div>

</body>
</html>
