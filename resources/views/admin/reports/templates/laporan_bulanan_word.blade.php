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
            <th style="width: 45pt;">Bulan</th>
            <th style="width: 60pt;">Tgl Minta</th>
            <th style="width: 60pt;">Tgl Jawab</th>
            <th style="width: 35pt;">Hari</th>
            <th style="width: 90pt;">Nama Pemohon</th>
            <th>Rincian Informasi</th>
            <th style="width: 20pt;">B</th>
            <th style="width: 20pt;">SM</th>
            <th style="width: 20pt;">SS</th>
            <th style="width: 20pt;">D</th>
            <th style="width: 50pt;">Ket</th>
        </tr>
    </thead>
    <tbody>
        @forelse($submissions as $index => $item)
        @php
            $tglMinta = $item->tanggal_permohonan ?? $item->created_at;
            $bulanMap = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agt','09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'];
            $bulanItem = $bulanMap[\Carbon\Carbon::parse($tglMinta)->format('m')] ?? '-';
        @endphp
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $bulanItem }}</td>
            <td>{{ \Carbon\Carbon::parse($tglMinta)->format('d/m/Y') }}</td>
            <td>{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') : '-' }}</td>
            <td>{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($tglMinta)->diffInDays(\Carbon\Carbon::parse($item->tanggal_selesai)) : '-' }}</td>
            <td style="text-align: left;"><strong>{{ $item->nama_pemohon }}</strong></td>
            <td style="text-align: left; font-size: 7pt;">{{ $item->deskripsi_permohonan }}</td>
            <td>{{ $item->kategori_laporan == 'berkala' ? 'V' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'sertamerta' ? 'V' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'setiapsaat' ? 'V' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'dikecualikan' ? 'V' : '' }}</td>
            <td style="text-transform: uppercase; font-size: 7pt;">{{ $item->status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="12">Tidak ada data permohonan dalam rentang tanggal ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- LEGENDA SINGKATAN --}}
<div style="font-size: 7pt; margin-top: 5px; font-style: italic; color: #444;">
    <strong>Keterangan Jenis Informasi:</strong> 
    B = Berkala | SM = Serta Merta | SS = Setiap Saat | D = Dikecualikan
</div>

<table class="signatures" style="width: 100%; border: none; margin-top: 15px;">
    <tr>
        <td style="width: 65%; border: none;"></td>
        <td style="width: 35%; border: none; text-align: center;">
            <div style="margin-bottom: 50px;">
                Tegal, {{ date('d F Y') }}<br>
                <strong>PPID PELAKSANA</strong>
            </div>
            <div class="sig-name">{{ $ppid_name }}</div>
            <div>NIP. {{ $ppid_nip }}</div>
        </td>
    </tr>
</table>
</div>
