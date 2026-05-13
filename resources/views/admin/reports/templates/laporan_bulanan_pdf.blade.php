@php
    $logoPath = public_path('images/logo-pktj.png');
    $logoData = '';
    if(file_exists($logoPath)) {
        $logoData = base64_encode(file_get_contents($logoPath));
    }
    $bulanNamaMap = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
                     '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
    $periodeLabel = $periodeType === 'tahunan'
        ? "Tahun {$tahun}"
        : ($bulanNamaMap[str_pad($bulan, 2, '0', STR_PAD_LEFT)] ?? $bulan) . " {$tahun}";
    $namaLembaga = $settings['ppid_nama'] ?? 'POLITEKNIK KESELAMATAN TRANSPORTASI JALAN';
    $ppid_name   = $settings['report_ppid_name'] ?? '..........................';
    $ppid_nip    = $settings['report_ppid_nip']  ?? '..........................';
    $pimpinan    = $settings['report_menteri_name'] ?? 'BUDI KARYA SUMADI';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Pelayanan PPID - {{ $periodeLabel }}</title>
<style>
    @page {
        size: A4 landscape;
        margin: 1cm 1.5cm;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        font-family: 'Arial', sans-serif;
        font-size: 8pt;
        color: #000;
        background: #fff;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    /* ====== HEADER KOP SURAT ====== */
    .kop-surat {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }
    .kop-logo td {
        border: none;
        padding: 4px;
        vertical-align: middle;
    }
    .kop-logo .logo-cell {
        width: 90px;
        text-align: center;
    }
    .kop-logo .logo-cell img {
        width: 80px;
        height: 80px;
        object-fit: contain;
    }
    .kop-logo .text-cell {
        text-align: center;
        padding-right: 90px; /* balance with logo */
    }
    .kop-logo .text-cell h1 {
        font-size: 16pt;
        font-weight: 900;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 2px;
        color: #000;
    }
    .kop-logo .text-cell h2 {
        font-size: 12pt;
        font-weight: bold;
        margin-bottom: 3px;
        color: #000;
    }
    .kop-logo .text-cell p {
        font-size: 8.5pt;
        color: #000;
        line-height: 1.3;
    }
    .kop-garis {
        border-top: 2.5pt solid #000;
        border-bottom: 0.5pt solid #000;
        height: 3px;
        margin: 8px 0 15px 0;
    }

    /* ====== JUDUL LAPORAN ====== */
    .report-title-block {
        text-align: center;
        margin-bottom: 12px;
    }
    .report-title-block h2 {
        font-size: 13pt;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 3px;
    }
    .report-title-block .subtitle {
        font-size: 10pt;
        font-weight: bold;
        margin-bottom: 2px;
    }
    .report-title-block .periode {
        font-size: 9pt;
    }

    /* ====== TABLE ====== */
    .report-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 7.5pt;
        margin-bottom: 20px;
    }
    .report-table th {
        background-color: #004a99;
        color: #fff;
        border: 0.5pt solid #000;
        padding: 5px 3px;
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
        font-size: 7pt;
        line-height: 1.2;
    }
    .report-table th.sub {
        background-color: #003577;
    }
    .report-table td {
        border: 0.5pt solid #000;
        padding: 4px 3px;
        vertical-align: middle;
        text-align: center;
        line-height: 1.2;
    }
    .report-table td.text-left {
        text-align: left;
    }
    .report-table tbody tr:nth-child(even) {
        background-color: #f5f9ff;
    }
    .report-table tfoot td {
        background-color: #e8f0fd;
        font-weight: bold;
        font-size: 7.5pt;
    }

    /* ====== TANDA TANGAN ====== */
    .ttd-section {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .ttd-section td {
        border: none;
        padding: 4px 8px;
        vertical-align: top;
    }
    .ttd-block {
        text-align: center;
        display: inline-block;
    }
    .ttd-block .ttd-label {
        font-size: 9pt;
        font-weight: bold;
        margin-bottom: 2px;
    }
    .ttd-block .ttd-space {
        height: 55px;
    }
    .ttd-block .ttd-name {
        font-size: 9pt;
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 2px;
    }
    .ttd-block .ttd-nip {
        font-size: 8pt;
    }

    /* ====== FOOTER HALAMAN ====== */
    .page-footer {
        text-align: center;
        font-size: 7pt;
        color: #666;
        margin-top: 8px;
        border-top: 0.5pt solid #ccc;
        padding-top: 4px;
    }

    /* ====== PRINT MEDIA ====== */
    @media print {
        body { margin: 0 !important; }
        .no-print { display: none !important; }
        .report-table th { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }
</style>
</head>
<body>

{{-- NO-PRINT: Tombol Download PDF --}}
<div class="no-print" style="position: fixed; top: 16px; right: 16px; z-index: 9999; display: flex; gap: 8px;">
    <button onclick="window.print()" style="padding: 12px 24px; background: #004a99; color: #fff; border: none; border-radius: 10px; font-weight: bold; font-size: 13px; cursor: pointer; box-shadow: 0 4px 12px rgba(0,74,153,0.3);">
        🖨️ Cetak / Simpan PDF
    </button>
    <button onclick="window.close()" style="padding: 12px 24px; background: #6b7280; color: #fff; border: none; border-radius: 10px; font-weight: bold; font-size: 13px; cursor: pointer;">
        ✕ Tutup
    </button>
</div>
<div class="no-print" style="height: 60px;"></div>

{{-- KOP SURAT --}}
<table class="kop-surat kop-logo">
    <tr>
        <td class="logo-cell">
            @if($logoData)
                <img src="data:image/png;base64,{{ $logoData }}" alt="Logo PKTJ">
            @else
                <div style="width:80px;height:80px;border:1px solid #ccc;display:flex;align-items:center;justify-content:center;font-size:8pt;">LOGO</div>
            @endif
        </td>
        <td class="text-cell">
            <h1>POLITEKNIK KESELAMATAN TRANSPORTASI JALAN</h1>
            <h2>Sekretariat Pelayanan Informasi Publik</h2>
            <p>Jl. Perintis Kemerdekaan No.17, Kel. Slerok, Kec. Tegal Timur, Kota Tegal, Jawa Tengah 52125</p>
            <p>Telp. (0283) 351061 | Email: ppid@pktj.ac.id | Website: ppid.pktj.ac.id</p>
        </td>
    </tr>
</table>
<div class="kop-garis"></div>

{{-- JUDUL LAPORAN --}}
<div class="report-title-block">
    <h2>LAPORAN PELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK</h2>
    <div class="subtitle">PPID PELAKSANA UPT {{ strtoupper($namaLembaga) }}</div>
    <div class="periode">Periode: {{ $periodeLabel }}</div>
</div>

{{-- TABEL DATA --}}
<table class="report-table">
    <thead>
        <tr>
            <th rowspan="2" style="width:3%">No</th>
            <th rowspan="2" style="width:5%">Bulan</th>
            <th rowspan="2" style="width:8%">Tgl Minta</th>
            <th rowspan="2" style="width:8%">Tgl Selesai</th>
            <th rowspan="2" style="width:4%">Hari</th>
            <th rowspan="2" style="width:14%; text-align:left; padding-left:4px;">Nama Pemohon</th>
            <th rowspan="2" style="width:24%; text-align:left; padding-left:4px;">Rincian Informasi</th>
            <th colspan="4" style="width:14%;">Jenis Informasi</th>
            <th rowspan="2" style="width:8%">Keterangan</th>
            <th rowspan="2" style="width:8%">Metode</th>
            <th rowspan="2" style="width:10%; text-align:left; padding-left:4px;">Alasan Penolakan</th>
        </tr>
        <tr>
            <th class="sub" style="width:3.5%; font-size:6pt;" title="Berkala">B</th>
            <th class="sub" style="width:3.5%; font-size:6pt;" title="Serta Merta">SM</th>
            <th class="sub" style="width:3.5%; font-size:6pt;" title="Setiap Saat">SS</th>
            <th class="sub" style="width:3.5%; font-size:6pt;" title="Dikecualikan">D</th>
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
            <td>{{ $tglSelesai ? \Carbon\Carbon::parse($tglSelesai)->format('d/m/Y') : '—' }}</td>
            <td>{{ $hariKerja }}</td>
            <td class="text-left" style="font-weight:bold; font-size:7.5pt;">{{ $item->nama_pemohon }}</td>
            <td class="text-left" style="font-size:7pt; line-height:1.1;">{{ $item->deskripsi_permohonan }}</td>
            <td>{{ $item->kategori_laporan == 'berkala'      ? '✓' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'sertamerta'   ? '✓' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'setiapsaat'   ? '✓' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'dikecualikan' ? '✓' : '' }}</td>
            <td style="font-size:7.5pt;">{{ $statusLabel }}</td>
            <td style="font-size:7pt;">{{ $item->jenis_permohonan_salinan ?? $item->bentuk_informasi_salinan ?? '—' }}</td>
            <td class="text-left" style="font-size:7pt;">{{ $item->alasan_penolakan_text ?? ($item->status == 'ditolak' ? 'Sesuai pasal ' . ($item->penolakan_pasal_uu ?? '—') : '') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="14" style="text-align:center; padding:20px; color:#666;">
                Tidak ada data permohonan dalam periode {{ $periodeLabel }}
            </td>
        </tr>
        @endforelse
    </tbody>
    @if($submissions->count() > 0)
    <tfoot>
        <tr>
            <td colspan="14" style="text-align:right; font-size:7.5pt; padding:5px 8px;">
                Total: <strong>{{ $submissions->count() }}</strong> Permohonan |
                Dipenuhi: <strong>{{ $submissions->whereIn('status', ['selesai','completed'])->count() }}</strong> |
                Ditolak: <strong>{{ $submissions->whereIn('status', ['ditolak','rejected'])->count() }}</strong> |
                Diproses: <strong>{{ $submissions->whereIn('status', ['pending','diproses','approved'])->count() }}</strong>
            </td>
        </tr>
    </tfoot>
    @endif
</table>

{{-- TANDA TANGAN --}}
<table class="ttd-section">
    <tr>
        <td style="width:60%;"></td>
        <td style="width:40%; text-align:center; vertical-align:top;">
            <div style="font-size:10pt; margin-bottom:4px;">Tegal, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
            <div style="font-size:10pt; font-weight:bold; margin-bottom:60px;">PPID PELAKSANA</div>
            <div style="font-size:10.5pt; font-weight:bold; text-decoration:underline;">{{ $ppid_name }}</div>
            <div style="font-size:9.5pt;">NIP. {{ $ppid_nip }}</div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center; padding-top:40px; vertical-align:top;">
            <div style="font-size:10pt; margin-bottom:6px; letter-spacing:1px; font-weight:bold;">MENGETAHUI,</div>
            <div style="font-size:10pt; font-weight:bold; margin-bottom:65px; line-height:1.4;">MENTERI PERHUBUNGAN<br>REPUBLIK INDONESIA</div>
            <div style="font-size:10.5pt; font-weight:bold; text-decoration:underline;">{{ $pimpinan }}</div>
        </td>
    </tr>
</table>

<div class="page-footer">
    Dicetak: {{ date('d F Y H:i') }} WIB | PPID PKTJ - Sistem Informasi Publik
</div>

</body>
</html>
