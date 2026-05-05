<style>
    @page {
        size: landscape;
        margin: 1cm;
    }
    body { 
        font-family: "Times New Roman", serif; 
        font-size: 10pt; 
        line-height: 1.2; 
        color: #333; 
    }
    .header-table { width: 100%; border: none; margin-bottom: 20px; border-bottom: 2px solid #004a99; padding-bottom: 10px; }
    .header-left { text-align: left; width: 10%; }
    .header-center { text-align: center; width: 90%; }
    .header-center h1 { font-size: 14pt; margin: 0; color: #004a99; text-transform: uppercase; }
    .header-center h2 { font-size: 12pt; margin: 3px 0; color: #1e293b; }
    .header-center p { font-size: 8pt; margin: 0; color: #64748b; font-style: italic; }
    
    h1.report-title { text-align: center; font-size: 12pt; font-weight: bold; text-transform: uppercase; margin-top: 15px; margin-bottom: 3px; color: #1e293b; }
    .subtitle { text-align: center; font-size: 10pt; margin-bottom: 20px; font-weight: bold; color: #475569; }
    
    table.report-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; table-layout: fixed; }
    table.report-table th { border: 1px solid #000; padding: 5px; text-align: center; vertical-align: middle; background-color: #f1f5f9; font-size: 8pt; font-weight: bold; overflow: hidden; }
    table.report-table td { border: 1px solid #000; padding: 4px; text-align: center; vertical-align: top; font-size: 8pt; word-wrap: break-word; overflow: hidden; }
    
    table.signatures { width: 100%; border: none; margin-top: 30px; }
    table.signatures td { border: none; text-align: center; vertical-align: top; width: 50%; padding-top: 10px; }
    .sig-label { margin-bottom: 60px; font-weight: bold; font-size: 9pt; }
    .sig-name { font-weight: bold; text-decoration: underline; font-size: 9pt; }
</style>

<table class="header-table">
    <tr>
        <td class="header-left">
            <img src="{{ public_path('images/logo-pktj.png') }}" width="80" alt="Logo">
        </td>
        <td class="header-center">
            <h1>KEMENTERIAN PERHUBUNGAN</h1>
            <h2>POLITEKNIK KESELAMATAN TRANSPORTASI JALAN</h2>
            <p>Jalan Raya Tegal-Pemalang Km. 6 Tegal 52191 Telp. (0283) 351061 Fax. (0283) 351061</p>
        </td>
    </tr>
</table>

<h1 class="report-title">LAPORAN PELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK</h1>
<div class="subtitle">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</div>


<table class="report-table">
    <thead>
        <tr>
            <th style="width: 30px;">No</th>
            <th style="width: 70px;">Tgl Minta</th>
            <th style="width: 70px;">Tgl Jawab</th>
            <th style="width: 40px;">Waktu</th>
            <th style="width: 120px;">Nama & Alamat</th>
            <th>Permohonan Informasi</th>
            <th style="width: 40px;">Bkl</th>
            <th style="width: 40px;">SM</th>
            <th style="width: 40px;">SS</th>
            <th style="width: 40px;">Dkc</th>
            <th style="width: 80px;">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($submissions as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->created_at->format('d/m/Y') }}</td>
            <td>{{ $item->tanggal_selesai ? $item->tanggal_selesai->format('d/m/Y') : '-' }}</td>
            <td>{{ $item->tanggal_selesai ? $item->created_at->diffInDays($item->tanggal_selesai) : '-' }}</td>
            <td>{{ $item->nama_pemohon }}<br>({{ $item->alamat }})</td>
            <td>{{ $item->deskripsi_permohonan }}</td>
            <td>{{ $item->kategori_laporan == 'berkala' ? 'V' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'sertamerta' ? 'V' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'setiapsaat' ? 'V' : '' }}</td>
            <td>{{ $item->kategori_laporan == 'dikecualikan' ? 'V' : '' }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="11">Tidak ada data permohonan dalam rentang tanggal ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<table class="signatures">
    <tr>
        <td></td>
        <td>
            <div class="sig-label">
                PPID PELAKSANA
            </div>
            <div class="sig-name">{{ $ppid_name }}</div>
            <div>NIP. {{ $ppid_nip }}</div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding-top: 50px;">
            <div class="sig-label">
                MENGETAHUI,<br>
                MENTERI PERHUBUNGAN REPUBLIK INDONESIA
            </div>
            <div class="sig-name">{{ $menteri_name }}</div>
        </td>
    </tr>
</table>
