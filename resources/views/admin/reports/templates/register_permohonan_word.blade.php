<table>
  <tr>
    <td colspan="23" style="text-align:center; font-weight:bold; font-size:11pt;">REGISTER PERMOHONAN INFORMASI PUBLIK</td>
  </tr>
  <tr>
    <td colspan="23" style="text-align:center; font-weight:bold; font-size:10pt;">{{ strtoupper($namaLembaga) }}</td>
  </tr>
  <tr><td colspan="23"></td></tr>
  <!-- Header Row 1 -->
  <tr>
    <th rowspan="3">No</th>
    <th rowspan="3">Tanggal</th>
    <th rowspan="3">Nama</th>
    <th rowspan="3">Alamat</th>
    <th rowspan="3">Pekerjaan</th>
    <th rowspan="3">NPWP</th>
    <th rowspan="3">No Telpon</th>
    <th rowspan="3">E-mail</th>
    <th rowspan="3">Rincian Informasi yang dibutuhkan</th>
    <th rowspan="3">Tujuan Penggunaan Informasi</th>
    <th colspan="3">Status Informasi</th>
    <th colspan="2">Bentuk Informasi yang dikuasai</th>
    <th colspan="2">Jenis Permohonan</th>
    <th rowspan="3">Keputusan</th>
    <th rowspan="3">Alasan Penolakan</th>
    <th colspan="2">Hari dan Tanggal</th>
    <th colspan="2">Biaya &amp; Cara Pembayaran</th>
  </tr>
  <!-- Header Row 2 -->
  <tr>
    <th colspan="2">Dibawah penguasaan</th>
    <th rowspan="2">Belum didokumentasikan</th>
    <th rowspan="2">Softcopy</th>
    <th rowspan="2">Hardcopy</th>
    <th rowspan="2">Melihat/ Mendengar</th>
    <th rowspan="2">Meminta salinan</th>
    <th rowspan="2">Pemberitahuan tertulis</th>
    <th rowspan="2">Pemberian Informasi</th>
    <th rowspan="2">Biaya</th>
    <th rowspan="2">Cara</th>
  </tr>
  <!-- Header Row 3 -->
  <tr>
    <th>Ya</th>
    <th>Tidak</th>
  </tr>

  @foreach ($permohonan as $index => $item)
    @php
        $statusLabel = match($item->status) {
            'selesai', 'completed'  => 'Dipenuhi',
            'ditolak', 'rejected'  => 'Ditolak',
            'diproses', 'approved' => 'Diproses',
            default    => 'Pending'
        };
    @endphp
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $item->tanggal_permohonan ? \Carbon\Carbon::parse($item->tanggal_permohonan)->format('d/m/Y') : $item->created_at->format('d/m/Y') }}</td>
      <td class="text-left">{{ $item->nama_pemohon }}</td>
      <td class="text-left">{{ $item->alamat }}</td>
      <td>{{ $item->pekerjaan }}</td>
      <td>{{ $item->npwp }}</td>
      <td>{{ $item->nomor_telepon }}</td>
      <td>{{ $item->email }}</td>
      <td class="text-left">{{ $item->deskripsi_permohonan }}</td>
      <td class="text-left">{{ $item->jenis_informasi }}</td>
      <td>{{ $item->status_informasi_dikuasai ? '✓' : '' }}</td>
      <td>{{ !$item->status_informasi_dikuasai ? '✓' : '' }}</td>
      <td>{{ $item->status_informasi_belum_didokumentasikan ? '✓' : '' }}</td>
      <td>{{ $item->bentuk_informasi_salinan == 'Softcopy' ? '✓' : '' }}</td>
      <td>{{ $item->bentuk_informasi_salinan == 'Hardcopy' ? '✓' : '' }}</td>
      <td>{{ $item->jenis_permohonan_salinan == 'Melihat' ? '✓' : '' }}</td>
      <td>{{ ($item->jenis_permohonan_salinan == 'Meminta Salinan' || $item->jenis_permohonan_salinan == 'Mendapatkan salinan') ? '✓' : '' }}</td>
      <td>{{ $statusLabel }}</td>
      <td class="text-left">{!! $item->alasan_penolakan_text !!}</td>
      <td>{{ $item->tanggal_pemberitahuan_tertulis ? \Carbon\Carbon::parse($item->tanggal_pemberitahuan_tertulis)->format('d/m/Y') : '' }}</td>
      <td>{{ $item->tanggal_pemberian_informasi ? \Carbon\Carbon::parse($item->tanggal_pemberian_informasi)->format('d/m/Y') : '' }}</td>
      <td>{{ $item->biaya_salinan }}</td>
      <td>{{ $item->cara_pembayaran }}</td>
    </tr>
  @endforeach
</table>
