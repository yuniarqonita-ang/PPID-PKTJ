<style>
    body { font-family: 'Arial', sans-serif; font-size: 11pt; line-height: 1.5; color: #000; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #000; padding: 8px; text-align: left; vertical-align: top; }
    .header-text { text-align: center; font-weight: bold; font-size: 14pt; margin-bottom: 10px; }
    .label { width: 30%; font-weight: bold; }
    .signature-table { border: none !important; margin-top: 50px; }
    .signature-table td { border: none !important; }
</style>

<div class="header-text">PEMBERITAHUAN TERTULIS PENOLAKAN PERMOHONAN INFORMASI</div>

<p>Berdasarkan permohonan informasi yang diajukan pada:</p>

<table>
    <tr>
        <td class="label">Nomor Registrasi</td>
        <td>#{{ $permohonan->id }}</td>
    </tr>
    <tr>
        <td class="label">Tanggal Permohonan</td>
        <td>{{ $permohonan->created_at->format('d F Y') }}</td>
    </tr>
    <tr>
        <td class="label">Nama Pemohon</td>
        <td>{{ $permohonan->nama_pemohon }}</td>
    </tr>
    <tr>
        <td class="label">Alamat</td>
        <td>{{ $permohonan->alamat }}</td>
    </tr>
    <tr>
        <td class="label">Informasi yang Diminta</td>
        <td>{{ $permohonan->deskripsi_permohonan }}</td>
    </tr>
</table>

<p>Dengan ini PPID Politeknik Keselamatan Transportasi Jalan (PKTJ) menyatakan bahwa permohonan tersebut <strong>DITOLAK</strong> dikarenakan:</p>

<table>
    <tr>
        <td class="label">Alasan Penolakan</td>
        <td>{{ $permohonan->alasan_penolakan_text ?: 'Informasi yang diminta termasuk dalam kategori informasi yang dikecualikan.' }}</td>
    </tr>
    <tr>
        <td class="label">Dasar Hukum (Pasal UU)</td>
        <td>{{ $permohonan->penolakan_pasal_uu ?: 'Pasal 17 Undang-Undang Nomor 14 Tahun 2008' }}</td>
    </tr>
</table>

<p>Demikian pemberitahuan ini disampaikan. Apabila Saudara/i keberatan atas penolakan ini, Saudara/i dapat mengajukan Keberatan kepada Atasan PPID dalam jangka waktu 30 hari kerja sejak pemberitahuan ini diterima.</p>

<table class="signature-table">
    <tr>
        <td style="width: 60%"></td>
        <td style="text-align: center;">
            <p>Tegal, {{ date('d F Y') }}</p>
            <p><strong>PPID PKTJ</strong></p>
            <br><br><br><br>
            <p>( ........................................ )</p>
            <p>NIP. ....................................</p>
        </td>
    </tr>
</table>
