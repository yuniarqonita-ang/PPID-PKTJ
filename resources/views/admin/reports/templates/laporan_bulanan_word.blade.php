<style>
    @page {
        size: A4 landscape;
        margin: 1cm;
        mso-page-orientation: landscape;
    }
    @page Section1 {
        size: 841.9pt 595.3pt;
        mso-page-orientation: landscape;
        margin: 0.5cm 0.5cm 0.5cm 0.5cm;
    }
    div.Section1 {
        page: Section1;
    }
    body { 
        font-family: "Arial", sans-serif; 
        font-size: 7pt; 
        line-height: 1.1; 
        color: #000; 
    }
    .header-table { width: 100%; border: none; margin-bottom: 10px; border-bottom: 1.5pt solid #004a99; padding-bottom: 5px; }
    .header-left { text-align: left; width: 8%; }
    .header-center { text-align: center; width: 92%; }
    .header-center h1 { font-size: 10pt; margin: 0; color: #004a99; text-transform: uppercase; font-weight: bold; }
    .header-center h2 { font-size: 9pt; margin: 1px 0; color: #000; font-weight: bold; }
    .header-center p { font-size: 6pt; margin: 0; color: #333; }
    
    h1.report-title { text-align: center; font-size: 14pt; font-weight: bold; text-transform: uppercase; margin-top: 10px; margin-bottom: 5px; color: #000; }
    .subtitle { text-align: center; font-size: 11pt; margin-bottom: 20px; font-weight: bold; color: #333; }
    
    table.report-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; border: 0.5pt solid #000; }
    table.report-table th { border: 0.5pt solid #000; padding: 4px 2px; text-align: center; vertical-align: middle; background-color: #f1f5f9; font-size: 8pt; font-weight: bold; }
    table.report-table td { border: 0.5pt solid #000; padding: 4px; text-align: center; vertical-align: middle; font-size: 8pt; }
    
    table.signatures { width: 100%; border: none; margin-top: 20px; }
    table.signatures td { border: none; text-align: center; vertical-align: top; padding-top: 5px; font-size: 10pt; }
    .sig-label { margin-bottom: 60px; font-weight: bold; }
    .sig-name { font-weight: bold; text-decoration: underline; font-size: 10pt; }
</style>

@php
    $logoPath = public_path('images/logo-pktj.png');
    $logoData = '';
    if(file_exists($logoPath)) {
        $logoData = base64_encode(file_get_contents($logoPath));
    }
@endphp
<div class="Section1">
<table class="header-table" style="border-bottom: 2pt solid #004a99;">
    <tr>
        <td class="header-left" style="width: 100px;">
            @if($logoData)
                <img src="data:image/png;base64,{{ $logoData }}" style="width: 80px; height: auto;" width="80" height="80">
            @else
                <div style="width:80px; height:80px; border:1px solid #ccc; text-align:center; padding-top:20px;">Logo</div>
            @endif
        </td>
        <td class="header-center">
            <h1 style="font-size: 18pt; margin-bottom: 2px;">POLITEKNIK KESELAMATAN TRANSPORTASI JALAN</h1>
            <h2 style="font-size: 14pt; margin-top: 0; margin-bottom: 3px;">Sekretariat Pelayanan Informasi Publik</h2>
            <p style="font-size: 9pt;">Jl. Perintis Kemerdekaan No.17, Kel. Slerok, Kec. Tegal Timur, Kota Tegal, Jawa Tengah, 52125, (0283) 351061</p>
        </td>
    </tr>
</table>

<h1 class="report-title">LAPORAN PELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK</h1>
<div class="subtitle">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</div>

<table class="report-table">
    <thead>
        <tr>
            <th style="width: 25pt;">No</th>
            <th style="width: 50pt;">Tgl Minta</th>
            <th style="width: 50pt;">Tgl Jawab</th>
            <th style="width: 35pt;">Waktu (Hari)</th>
            <th style="width: 100pt;">Nama & Alamat</th>
            <th>Permohonan Informasi</th>
            <th style="width: 45pt;">Berkala</th>
            <th style="width: 45pt;">Serta Merta</th>
            <th style="width: 45pt;">Setiap Saat</th>
            <th style="width: 45pt;">Dikecualikan</th>
            <th style="width: 50pt;">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($submissions as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->created_at->format('d/m/Y') }}</td>
            <td>{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') : '-' }}</td>
            <td>{{ $item->tanggal_selesai ? $item->created_at->diffInDays(\Carbon\Carbon::parse($item->tanggal_selesai)) : '-' }}</td>
            <td style="text-align: left;">{{ $item->nama_pemohon }}<br><span style="font-size: 6pt; color: #666;">{{ $item->alamat }}</span></td>
            <td style="text-align: left;">{{ $item->deskripsi_permohonan }}</td>
            <td>{{ $item->kategori_laporan == 'berkala' ? 'V' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'sertamerta' ? 'V' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'setiapsaat' ? 'V' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'dikecualikan' ? 'V' : '' }}</td>
            <td style="text-transform: uppercase;">{{ $item->status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="11">Tidak ada data permohonan dalam rentang tanggal ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<table class="signatures" style="width: 100%; border: none;">
    <tr>
        <td style="width: 60%; border: none;"></td>
        <td style="width: 40%; border: none; text-align: center;">
            <div style="margin-bottom: 50px;">
                Tegal, {{ date('d F Y') }}<br>
                <strong>PPID PELAKSANA</strong>
            </div>
            <div class="sig-name">{{ $ppid_name }}</div>
            <div>NIP. {{ $ppid_nip }}</div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-top: 30px; text-align: center; border: none;">
            <div style="margin-bottom: 50px;">
                MENGETAHUI,<br>
                <strong>MENTERI PERHUBUNGAN REPUBLIK INDONESIA</strong>
            </div>
            <div class="sig-name">{{ $menteri_name }}</div>
        </td>
    </tr>
</table>
</div>
