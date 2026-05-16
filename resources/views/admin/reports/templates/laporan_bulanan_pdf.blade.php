@php
    $logoPath = public_path('images/logo-pktj.png');
    $logoData = '';
    if(file_exists($logoPath)) {
        $logoData = base64_encode(file_get_contents($logoPath));
    }
    $namaLembaga = $settings['ppid_nama'] ?? 'POLITEKNIK KESELAMATAN TRANSPORTASI JALAN';
    $ppid_name   = $settings['report_ppid_name'] ?? '..........................';
    $ppid_nip    = $settings['report_ppid_nip']  ?? '..........................';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pelayanan PPID - {{ $periodeLabel }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 1cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 8pt;
            color: #000;
            line-height: 1.2;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .header-table td { border: none; vertical-align: middle; }
        .logo-col { width: 70px; text-align: left; }
        .text-col { text-align: center; padding-right: 70px; }
        .text-col h1 { font-size: 16pt; font-weight: bold; margin: 0; }
        .text-col h2 { font-size: 11pt; margin: 2px 0; }
        .text-col p { font-size: 8pt; margin: 0; }
        
        .line { border-top: 2pt solid #000; border-bottom: 0.5pt solid #000; height: 2px; margin: 5px 0 10px 0; }
        
        .title-block { text-align: center; margin-bottom: 10px; }
        .title-block h3 { font-size: 12pt; text-transform: uppercase; margin: 0; }
        .title-block p { font-size: 10pt; font-weight: bold; margin: 2px 0; }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            table-layout: fixed;
        }
        .report-table th, .report-table td {
            border: 0.5pt solid #000;
            padding: 3px 2px;
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
        }
        .report-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 7pt;
        }
        .text-left { text-align: left !important; padding-left: 4px !important; }
        
        .legend {
            font-size: 7pt;
            font-style: italic;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .footer-table td { border: none; vertical-align: top; text-align: center; }
        .sig-space { height: 50px; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td class="logo-col">
                @if($logoData)
                    <img src="data:image/png;base64,{{ $logoData }}" width="60">
                @endif
            </td>
            <td class="text-col">
                <h1>POLITEKNIK KESELAMATAN TRANSPORTASI JALAN</h1>
                <h2>Sekretariat Pelayanan Informasi Publik</h2>
                <p>Jl. Perintis Kemerdekaan No.17, Kel. Slerok, Kec. Tegal Timur, Kota Tegal, Jawa Tengah 52125</p>
                <p>Telp. (0283) 351061 | Email: ppid@pktj.ac.id | Website: ppid.pktj.ac.id</p>
            </td>
        </tr>
    </table>
    
    <div class="line"></div>

    <div class="title-block">
        <h3>LAPORAN PELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK</h3>
        <p>PPID PELAKSANA UPT {{ strtoupper($namaLembaga) }}</p>
        <p>Periode: {{ $periodeLabel }}</p>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 5%;">Bulan</th>
                <th style="width: 8%;">Tgl Minta</th>
                <th style="width: 8%;">Tgl Selesai</th>
                <th style="width: 5%;">Hari</th>
                <th style="width: 13%;">Nama Pemohon</th>
                <th style="width: 25%;">Rincian Informasi</th>
                <th style="width: 4%;">B</th>
                <th style="width: 4%;">SM</th>
                <th style="width: 4%;">SS</th>
                <th style="width: 4%;">D</th>
                <th style="width: 8%;">Ket</th>
                <th style="width: 9%;">Metode</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $index => $item)
            @php
                $tglMinta   = $item->tanggal_permohonan ?? $item->created_at;
                $tglSelesai = $item->tanggal_selesai;
                $hariKerja  = $tglSelesai ? \Carbon\Carbon::parse($tglMinta)->diffInDays(\Carbon\Carbon::parse($tglSelesai)) : '-';
                $bulanMap   = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agt','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
                $bulanItem  = $bulanMap[\Carbon\Carbon::parse($tglMinta)->format('m')] ?? '-';
                $statusLabel = match($item->status) {
                    'selesai','completed' => 'Dipenuhi',
                    'ditolak','rejected'  => 'Ditolak',
                    'diproses','approved' => 'Diproses',
                    default => 'Pending'
                };
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $bulanItem }}</td>
                <td>{{ \Carbon\Carbon::parse($tglMinta)->format('d/m/Y') }}</td>
                <td>{{ $tglSelesai ? \Carbon\Carbon::parse($tglSelesai)->format('d/m/Y') : '-' }}</td>
                <td>{{ $hariKerja }}</td>
                <td class="text-left"><strong>{{ $item->nama_pemohon }}</strong></td>
                <td class="text-left" style="font-size: 7pt;">{{ $item->deskripsi_permohonan }}</td>
                <td>{{ $item->kategori_laporan == 'berkala'      ? 'v' : '' }}</td>
                <td>{{ $item->kategori_laporan == 'sertamerta'   ? 'v' : '' }}</td>
                <td>{{ $item->kategori_laporan == 'setiapsaat'   ? 'v' : '' }}</td>
                <td>{{ $item->kategori_laporan == 'dikecualikan' ? 'v' : '' }}</td>
                <td style="font-size: 7pt;">{{ $statusLabel }}</td>
                <td style="font-size: 7pt;">{{ $item->jenis_permohonan_salinan ?? $item->bentuk_informasi_salinan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="13">Tidak ada data permohonan dalam periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="legend">
        <strong>Keterangan Jenis Informasi:</strong> B = Berkala | SM = Serta Merta | SS = Setiap Saat | D = Dikecualikan
    </div>

    <table class="footer-table">
        <tr>
            <td style="width: 70%;"></td>
            <td style="width: 30%;">
                Tegal, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                <strong>PPID PELAKSANA</strong>
                <div class="sig-space"></div>
                <strong><u>{{ $ppid_name }}</u></strong><br>
                NIP. {{ $ppid_nip }}
            </td>
        </tr>
    </table>
</body>
</html>
