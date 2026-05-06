<style>
    @page {
        size: landscape;
        margin: 1cm;
    }
    body { font-family: 'Arial', sans-serif; font-size: 10pt; line-height: 1.3; color: #000; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 10px; table-layout: fixed; }
    th, td { border: 1px solid #000; padding: 4px 6px; text-align: left; vertical-align: top; word-wrap: break-word; }
    
    .header-table { width: 100%; border: none; margin-bottom: 15px; border-bottom: 2px solid #000; padding-bottom: 10px; }
    .header-left { text-align: left; width: 60px; border: none !important; }
    .header-center { text-align: center; border: none !important; }
    .header-center h1 { font-size: 14pt; margin: 0 0 2px 0; font-weight: bold; }
    .header-center h2 { font-size: 11pt; margin: 0 0 3px 0; font-weight: bold; }
    .header-center p { font-size: 8pt; margin: 0; }
    
    .header-text { text-align: center; font-weight: bold; font-size: 12pt; margin-bottom: 15px; text-transform: uppercase; }
    .label { width: 30%; font-weight: bold; background-color: #f8fafc; }
    .checkbox { width: 30px; text-align: center; font-family: 'DejaVu Sans', sans-serif; font-weight: bold; }
    .signature-table { border: none !important; margin-top: 20px; }
    .signature-table td { border: none !important; }
    .section-title { font-weight: bold; margin-top: 8px; margin-bottom: 4px; background-color: #e2e8f0; padding: 2px 5px; font-size: 9pt; }
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

<div class="header-text">FORMULIR KEBERATAN ATAS PERMOHONAN INFORMASI</div>

<div class="section-title">A. INFORMASI REGISTRASI</div>
<table>
    <tr>
        <td class="label">Nomor Registrasi Keberatan</td>
        <td>{{ $keberatan->nomor_registrasi_keberatan }}</td>
    </tr>
    <tr>
        <td class="label">Nomor Registrasi Permohonan</td>
        <td>#{{ $keberatan->permohonan_id }}</td>
    </tr>
</table>

<div class="section-title">B. IDENTITAS PEMOHON / PENGJU</div>
<table>
    <tr>
        <td class="label">Nama Lengkap</td>
        <td>{{ $keberatan->nama_pemohon }}</td>
    </tr>
    <tr>
        <td class="label">Alamat</td>
        <td>{{ $keberatan->alamat }}</td>
    </tr>
    <tr>
        <td class="label">Pekerjaan</td>
        <td>{{ $keberatan->pekerjaan }}</td>
    </tr>
    <tr>
        <td class="label">No. Telepon / Email</td>
        <td>{{ $keberatan->nomor_telepon }} / {{ $keberatan->email }}</td>
    </tr>
</table>

<div class="section-title">C. ALASAN KEBERATAN (Beri tanda V pada alasan yang sesuai)</div>
<table>
    @php
        $reasons = [
            'a' => 'Penolakan atas permintaan informasi',
            'b' => 'Tidak disediakannya informasi berkala',
            'c' => 'Tidak ditanggapinya permintaan informasi',
            'd' => 'Permintaan informasi ditanggapi tidak sebagaimana yang diminta',
            'e' => 'Tidak dipenuhinya permintaan informasi',
            'f' => 'Pengenaan biaya yang tidak wajar',
            'g' => 'Penyampaian informasi yang melebihi waktu yang ditentukan'
        ];
        $selected = is_array($keberatan->alasan_keberatan_list) ? $keberatan->alasan_keberatan_list : [];
    @endphp
    @foreach($reasons as $key => $label)
    <tr>
        <td class="checkbox">{{ in_array($key, $selected) ? 'V' : '' }}</td>
        <td>{{ $key }}. {{ $label }}</td>
    </tr>
    @endforeach
</table>

<div class="section-title">D. KASUS POSISI (Kronologi Singkat)</div>
<table>
    <tr>
        <td style="min-height: 80px;">{{ $keberatan->kasus_posisi }}</td>
    </tr>
</table>

<div class="section-title">E. RINCIAN INFORMASI / TUJUAN PENGGUNAAN</div>
<table>
    <tr>
        <td class="label">Rincian Informasi</td>
        <td>{{ $keberatan->rincian_informasi }}</td>
    </tr>
    <tr>
        <td class="label">Tujuan Penggunaan</td>
        <td>{{ $keberatan->tujuan_penggunaan }}</td>
    </tr>
</table>

<table class="signature-table">
    <tr>
        <td style="width: 50%; text-align: center;">
            <p>Penerima Keberatan,</p>
            <br><br><br>
            <p>( ........................................ )</p>
        </td>
        <td style="width: 50%; text-align: center;">
            <p>Tegal, {{ date('d F Y') }}</p>
            <p>Pemohon Informasi,</p>
            <br><br><br>
            <p><strong>( {{ $keberatan->nama_pemohon }} )</strong></p>
        </td>
    </tr>
</table>
