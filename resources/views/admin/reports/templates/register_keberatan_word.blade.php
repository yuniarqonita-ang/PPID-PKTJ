<table>
  <tr>
    <td colspan="21" style="text-align:center; font-weight:bold; font-size:11pt;">FORM REGISTRASI KEBERATAN</td>
  </tr>
  <tr>
    <td colspan="21" style="text-align:center; font-weight:bold; font-size:10pt;">{{ strtoupper($namaLembaga) }}</td>
  </tr>
  <tr><td colspan="21"></td></tr>
  <!-- Header Row 1 -->
  <tr>
    <th rowspan="2">No</th>
    <th rowspan="2">Tanggal</th>
    <th rowspan="2">Nama</th>
    <th rowspan="2">Alamat</th>
    <th rowspan="2">Pekerjaan</th>
    <th rowspan="2">NPWP</th>
    <th rowspan="2">No Telpon</th>
    <th rowspan="2">E-mail</th>
    <th rowspan="2">Rincian Informasi yang dibutuhkan</th>
    <th rowspan="2">Tujuan Penggunaan Informasi</th>
    <th colspan="7">Alasan Pengajuan Keberatan (pasal 35 ayat (1) UU KIP)</th>
    <th rowspan="2">Keputusan Atasan PPID</th>
    <th rowspan="2">Hari dan Tanggal Pemberian Tanggapan atas Keberatan</th>
    <th rowspan="2">Nama dan Posisi Atasan PPID</th>
    <th rowspan="2">Tanggapan Pemohon Informasi</th>
  </tr>
  <!-- Header Row 2 (sub-headers for Alasan) -->
  <tr>
    <th>a</th>
    <th>b</th>
    <th>c</th>
    <th>d</th>
    <th>e</th>
    <th>f</th>
    <th>g</th>
  </tr>

  @foreach ($keberatans as $index => $item)
    @php
        $reasons = $item->alasan_keberatan_list ?? [];
        $namaAtasan = trim(($item->nama_atasan_ppid ?? '') . ($item->posisi_atasan_ppid ? ' (' . $item->posisi_atasan_ppid . ')' : ''));
    @endphp
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $item->tanggal_keberatan ? \Carbon\Carbon::parse($item->tanggal_keberatan)->format('d/m/Y') : '' }}</td>
      <td class="text-left">{{ $item->nama_pemohon }}</td>
      <td class="text-left">{{ $item->alamat }}</td>
      <td>{{ $item->pekerjaan }}</td>
      <td>{{ $item->npwp }}</td>
      <td>{{ $item->nomor_telepon }}</td>
      <td>{{ $item->email }}</td>
      <td class="text-left">{{ $item->rincian_informasi ?? ($item->permohonan ? $item->permohonan->deskripsi_permohonan : '') }}</td>
      <td class="text-left">{{ $item->tujuan_penggunaan }}</td>
      <td>{{ in_array('a', $reasons) ? '✓' : '' }}</td>
      <td>{{ in_array('b', $reasons) ? '✓' : '' }}</td>
      <td>{{ in_array('c', $reasons) ? '✓' : '' }}</td>
      <td>{{ in_array('d', $reasons) ? '✓' : '' }}</td>
      <td>{{ in_array('e', $reasons) ? '✓' : '' }}</td>
      <td>{{ in_array('f', $reasons) ? '✓' : '' }}</td>
      <td>{{ in_array('g', $reasons) ? '✓' : '' }}</td>
      <td>{{ $item->keputusan_atasan_ppid }}</td>
      <td>{{ $item->tanggal_tanggapan_keberatan ? \Carbon\Carbon::parse($item->tanggal_tanggapan_keberatan)->format('d/m/Y') : '' }}</td>
      <td class="text-left">{{ $namaAtasan }}</td>
      <td class="text-left">{{ $item->tanggapan_pemohon }}</td>
    </tr>
  @endforeach
</table>
