<style>
    body { font-family: "Times New Roman", serif; font-size: 12pt; }
    h1 { text-align: center; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
    .subtitle { text-align: center; font-size: 12pt; margin-bottom: 20px; }
    table.report-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
    table.report-table th, table.report-table td { border: 1px solid black; padding: 5px; text-align: center; vertical-align: middle; }
    table.report-table th { font-weight: bold; background-color: #f2f2f2; }
    table.signatures { width: 100%; border: none; margin-top: 50px; }
    table.signatures td { border: none; text-align: center; vertical-align: bottom; height: 100px; width: 50%; }
</style>

<h1>FORMAT LAPORAN PELAKSANAAN TUGAS PELAYANAN INFORMASI PUBLIK</h1>
<div class="subtitle">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</div>

<table class="report-table">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Tanggal Minta</th>
            <th rowspan="2">Tanggal Jawab</th>
            <th rowspan="2">Waktu (Hari)</th>
            <th rowspan="2">Nama & Alamat</th>
            <th rowspan="2">Permohonan Informasi</th>
            <th colspan="4">Jenis Informasi</th>
            <th rowspan="2">Keterangan / Status</th>
        </tr>
        <tr>
            <th>Berkala</th>
            <th>Serta Merta</th>
            <th>Setiap Saat</th>
            <th>Dikecualikan</th>
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
            PPID<br><br><br><br><br>
            <b>{{ $ppid_name }}</b><br>
            NIP. {{ $ppid_nip }}
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="padding-top: 50px;">
            MENTERI PERHUBUNGAN REPUBLIK INDONESIA<br><br><br><br><br>
            <b>{{ $menteri_name }}</b>
        </td>
    </tr>
</table>
