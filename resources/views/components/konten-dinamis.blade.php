{{-- 
    PARTIAL: Konten Dinamis dari Admin Panel
    
    Penggunaan:
    @include('components.konten-dinamis', [
        'prefix'    => 'sop_permintaan',    // prefix key di tabel dashboards
        'judul'     => 'SOP Permintaan Informasi Publik',
        'icon'      => 'fa-clipboard-list'
    ])
--}}
@php
    $d = $settings ?? [];
    $pfx = $prefix ?? 'page';
    
    // Ambil konten dari settings (dashboards table)
    $isiMaklumat    = $d[$pfx . '_isi_maklumat'] ?? null;
    $judulMaklumat  = $d[$pfx . '_judul_maklumat'] ?? null;
    $isiStandar     = $d[$pfx . '_isi_standar'] ?? null;
    $judulStandar   = $d[$pfx . '_judul_standar'] ?? null;
    $isiKonten      = $d[$pfx . '_isi_konten'] ?? null;
    $judulKonten    = $d[$pfx . '_judul_konten'] ?? null;
    $gambarSop      = $d[$pfx . '_gambar_sop'] ?? null;
    $gambarProses   = $d[$pfx . '_gambar_proses'] ?? null;
    $gambarMaklumat = $d[$pfx . '_gambar_maklumat'] ?? null;
    $gambarStandar  = $d[$pfx . '_gambar_standar'] ?? null;
    $youtubeLink    = $d[$pfx . '_youtube_link'] ?? null;
    $customKonten   = $d[$pfx . '_konten'] ?? null;
    
    // Khusus Laporan
    $ringkasanEks   = $d[$pfx . '_ringkasan_eksekutif'] ?? null;
    $isiLaporan     = $d[$pfx . '_isi_laporan'] ?? null;
    $tahunLaporan   = $d[$pfx . '_tahun_laporan'] ?? null;
    $jenisLaporan   = $d[$pfx . '_jenis_laporan'] ?? null;
    $fileLaporan    = $d[$pfx . '_file_laporan'] ?? null;
    
    // Parse YouTube video ID
    $videoId = '';
    if ($youtubeLink) {
        if (strpos($youtubeLink, 'v=') !== false) {
            $parts = explode('v=', $youtubeLink);
            $videoId = explode('&', $parts[1])[0];
        } elseif (strpos($youtubeLink, 'youtu.be/') !== false) {
            $parts = explode('youtu.be/', $youtubeLink);
            $videoId = explode('?', $parts[1])[0];
        }
    }
    
    // Cek apakah ada konten dari dashboard yang perlu ditampilkan
    $adaKonten = $isiMaklumat || $judulMaklumat || $isiStandar || $judulStandar || 
                 $isiKonten || $judulKonten || $gambarSop || $gambarProses || 
                 $gambarMaklumat || $gambarStandar || $youtubeLink || $customKonten || $ringkasanEks || $isiLaporan;
@endphp

{{-- 
    Catatan: Blok rendering konten dari tabel profil_ppids dihapus dari sini 
    agar tidak menampilkan "teks hantu" atau data dummy lama pada halaman dinamis.
    Halaman profil utama (Visi Misi, Tugas, dll) mengelola datanya sendiri tanpa komponen ini.
--}}

{{-- Section Maklumat Utama --}}
@if($judulMaklumat || $isiMaklumat)
<div class="content-box mb-4" style="border-left: 5px solid #004a99;">
    @if($judulMaklumat)
        <h2 class="section-title">{{ $judulMaklumat }}</h2>
    @endif
    @if($isiMaklumat)
        <div class="profil-content">{!! $isiMaklumat !!}</div>
    @endif
</div>
@endif

{{-- Section Standar Biaya --}}
@if($judulStandar || $isiStandar)
<div class="content-box mb-4" style="border-left: 5px solid #d4af37;">
    @if($judulStandar)
        <h2 class="section-title">{{ $judulStandar }}</h2>
    @endif
    @if($isiStandar)
        <div class="profil-content">{!! $isiStandar !!}</div>
    @endif
</div>
@endif

{{-- Section Konten Umum --}}
@if($judulKonten || $isiKonten)
<div class="content-box mb-4" style="border-left: 5px solid #28a745;">
    @if($judulKonten)
        <h2 class="section-title">{{ $judulKonten }}</h2>
    @endif
    @if($isiKonten)
        <div class="profil-content">{!! $isiKonten !!}</div>
    @endif
</div>
@endif



{{-- Section Laporan --}}
@if($ringkasanEks || $isiLaporan)
<div class="content-box mb-4" style="border-left: 5px solid #ffc107;">
    @if($jenisLaporan || $tahunLaporan)
        <h2 class="section-title">Laporan {{ ucfirst($jenisLaporan) }} Tahun {{ $tahunLaporan }}</h2>
    @elseif($ringkasanEks && !$isiMaklumat)
        <h2 class="section-title">Ringkasan Eksekutif Laporan</h2>
    @endif
    
    @if($ringkasanEks)
        <div class="profil-content">{!! $ringkasanEks !!}</div>
    @endif
    @if($isiLaporan)
        <h3 style="color:#004a99; font-size:20px; margin-bottom:15px; margin-top:30px;">Detail Laporan</h3>
        <div class="profil-content">{!! $isiLaporan !!}</div>
    @endif
</div>
@endif



{{-- Custom Konten Generik --}}
@if($customKonten)
<div class="content-box mb-4">
    <div class="profil-content">{!! $customKonten !!}</div>
</div>
@endif

{{-- Dynamic Documents List (SOP / Laporan / etc. fetched from database) --}}
@if(isset($laporan) && $laporan->count() > 0)
<div class="content-box mb-4 mt-5" style="border-top: 3px solid #ffc107; padding-top: 30px;">
    <h3 class="fw-bold outfit text-dark mb-4" style="font-size: 1.35rem; display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-folder-open text-warning"></i> Dokumen & Lampiran Prosedur
    </h3>
    <div class="row g-3">
        @foreach($laporan as $item)
        @php
            $isGDrive = $item->file_path && (\Illuminate\Support\Str::startsWith($item->file_path, ['http://', 'https://']));
            $previewUrl = $item->file_path ? ($isGDrive ? $item->file_path : 'storage/' . $item->file_path) : null;
        @endphp
        <div class="col-12">
            <div class="p-4 rounded-4" style="background: #f8fafc; border: 1px solid #e2e8f0; transition: all 0.3s; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <div class="d-flex align-items-start flex-column flex-md-row gap-3">
                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; font-size: 1.5rem; background-color: rgba(0, 74, 153, 0.1); color: #004a99;">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div class="flex-grow-1 w-100">
                        <h5 class="fw-bold outfit text-dark mb-2" style="font-size: 1.1rem;">{{ $item->judul }}</h5>
                        
                        @if($item->deskripsi)
                        <div class="rich-content mb-3 text-secondary" style="font-size: 0.9rem;">
                            {!! $item->deskripsi !!}
                        </div>
                        @endif
                        
                        <div class="d-flex align-items-center justify-content-between pt-3 border-top flex-wrap gap-3">
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge bg-light text-primary border px-3 py-2 rounded-pill" style="font-size: 11px;">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : ($item->created_at ? $item->created_at->translatedFormat('d F Y') : '-') }}
                                </span>
                                @if($item->file_size && $item->file_size !== '-')
                                <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill" style="font-size: 11px;">
                                    <i class="fas fa-hdd me-1"></i> {{ $item->file_size }}
                                </span>
                                @endif
                            </div>
                            
                            <div class="d-flex gap-2">
                                @if($previewUrl && is_previewable($previewUrl))
                                <a href="#" class="btn-download-premium py-2 px-3 text-xs" style="font-size: 12px; border-radius: 10px; display: inline-flex; align-items: center; gap: 6px; font-weight: 700; text-decoration: none;" 
                                    data-bs-toggle="modal" data-bs-target="#previewModal" 
                                    data-url="{{ route('preview.dokumen', ['file' => $previewUrl, 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? '1' : '0']) }}">
                                    <i class="fas fa-eye"></i> Lihat Dokumen
                                </a>
                                @endif
                                
                                @if($item->file_path && $item->bisa_download)
                                <a href="{{ route('dokumen.download', $item->id) }}" class="btn-download-premium py-2 px-3 text-xs" style="background: #10b981; color: white; font-size: 12px; border-radius: 10px; display: inline-flex; align-items: center; gap: 6px; font-weight: 700; text-decoration: none;">
                                    <i class="fas fa-download"></i> Unduh
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- Pesan jika tidak ada konten sama sekali --}}
@if(!$adaKonten && !(isset($laporan) && $laporan->count() > 0))
    <!-- Menunggu input konten dari Admin Panel untuk prefix: {{ $pfx }} -->
@endif
