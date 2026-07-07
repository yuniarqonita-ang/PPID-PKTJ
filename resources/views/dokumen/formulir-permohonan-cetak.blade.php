<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permohonan Informasi Publik - PPID PKTJ</title>
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
            margin-bottom: 25px;
            text-decoration: underline;
        }
        .meta-table td {
            padding: 6px;
            vertical-align: top;
        }
        .border-box {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 15px;
        }
        .text-justify {
            text-align: justify;
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
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <button onclick="window.print();" class="btn btn-primary no-print no-print-btn">
        <i class="fas fa-print me-2"></i> Cetak Formulir
    </button>

    <div class="container" style="max-width: 800px;">
        <!-- Kop Surat -->
        <div class="kop-surat d-flex align-items-center justify-content-center">
            <div class="text-center w-100">
                <p class="kop-title-dept">Kementerian Perhubungan</p>
                <p class="kop-title-sub">Badan Pengembangan Sumber Daya Manusia Perhubungan</p>
                <p class="kop-title-inst">Politeknik Keselamatan Transportasi Jalan</p>
                <p class="kop-details">Jl. Perintis Kemerdekaan No. 17, Kota Tegal | Telp: (0283) 351061 | Email: pktj@pktj.ac.id</p>
            </div>
        </div>

        <!-- Judul Formulir -->
        <p class="form-title">Formulir Permohonan Informasi Publik</p>
        <p class="text-end mb-4">No. Pendaftaran (diisi petugas): .............................................</p>

        <!-- Tabel Identitas -->
        <table class="meta-table w-100 mb-4">
            <tr>
                <td style="width: 5%;">1.</td>
                <td style="width: 35%;">Nama Lengkap Pemohon</td>
                <td style="width: 3%;">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Alamat Lengkap</td>
                <td>:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Nomor Identitas (NIK/KTP)</td>
                <td>:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Nomor Telepon / WhatsApp</td>
                <td>:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Alamat Email</td>
                <td>:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Rincian Informasi Yang Dibutuhkan</td>
                <td>:</td>
                <td>
                    <div class="border-box" style="height: 120px;"></div>
                </td>
            </tr>
            <tr>
                <td>7.</td>
                <td>Tujuan Penggunaan Informasi</td>
                <td>:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td>8.</td>
                <td>Cara Memperoleh Informasi</td>
                <td>:</td>
                <td>
                    <div class="d-flex gap-4">
                        <div>[ &nbsp; ] Melihat/Membaca</div>
                        <div>[ &nbsp; ] Mendapatkan Salinan (Softcopy)</div>
                        <div>[ &nbsp; ] Mendapatkan Salinan (Hardcopy)</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>9.</td>
                <td>Cara Mendapatkan Salinan</td>
                <td>:</td>
                <td>
                    <div class="d-flex flex-wrap gap-3">
                        <div>[ &nbsp; ] Mengambil Langsung</div>
                        <div>[ &nbsp; ] Melalui Email</div>
                        <div>[ &nbsp; ] Jasa Kurir/Pos</div>
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
            Formulir resmi ini dicetak melalui Portal PPID Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal.
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
