<style>
    body { font-family: 'Arial', sans-serif; font-size: 11pt; line-height: 1.5; color: #000; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; vertical-align: top; }
    .header-text { text-align: center; font-weight: bold; font-size: 14pt; margin-bottom: 20px; }
    .label { width: 35%; font-weight: bold; }
    .checkbox { width: 20px; text-align: center; font-family: 'DejaVu Sans', sans-serif; }
    .signature-table { border: none !important; margin-top: 30px; }
    .signature-table td { border: none !important; }
    .section-title { font-weight: bold; margin-top: 10px; margin-bottom: 5px; }
</style>

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
