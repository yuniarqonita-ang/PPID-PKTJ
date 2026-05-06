<style>
    body { font-family: 'Arial', sans-serif; font-size: 11pt; line-height: 1.5; color: #000; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #000; padding: 8px; text-align: left; vertical-align: top; }
    
    .header-table { width: 100%; border: none; margin-bottom: 15px; border-bottom: 2px solid #000; padding-bottom: 10px; }
    .header-left { text-align: left; width: 60px; border: none !important; }
    .header-center { text-align: center; border: none !important; }
    .header-center h1 { font-size: 14pt; margin: 0 0 2px 0; font-weight: bold; }
    .header-center h2 { font-size: 11pt; margin: 0 0 3px 0; font-weight: bold; }
    .header-center p { font-size: 8pt; margin: 0; }
    
    .header-text { text-align: center; font-weight: bold; font-size: 14pt; margin-bottom: 20px; text-transform: uppercase; }
    .label { width: 30%; font-weight: bold; }
    .signature-table { border: none !important; margin-top: 50px; }
    .signature-table td { border: none !important; }
</style>

<table class="header-table">
    <tr>
        <td class="header-left">
            @php 
                $logoPath = public_path('images/logo-pktj.png');
                $logoData = '';
                if(file_exists($logoPath)) {
                    $logoData = base64_encode(file_get_contents($logoPath));
                }
            @endphp
            @if($logoData)
                <img src="data:image/png;base64,{{ $logoData }}" width="60" alt="Logo">
            @endif
        </td>
        <td class="header-center">
            <h1>POLITEKNIK KESELAMATAN TRANSPORTASI JALAN</h1>
            <h2>Sekretariat Pelayanan Informasi Publik</h2>
            <p>Jl. Perintis Kemerdekaan No.17, Kel. Slerok, Kec. Tegal Timur, Kota Tegal, Jawa Tengah, 52125, (0283) 351061</p>
        </td>
    </tr>
</table>

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
