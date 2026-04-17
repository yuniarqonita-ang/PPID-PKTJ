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
    
    // Ambil konten dari settings
    $isiMaklumat    = $d[$pfx . '_isi_maklumat'] ?? null;
    $judulMaklumat  = $d[$pfx . '_judul_maklumat'] ?? null;
    $isiStandar     = $d[$pfx . '_isi_standar'] ?? null;
    $judulStandar   = $d[$pfx . '_judul_standar'] ?? null;
    $isiKonten      = $d[$pfx . '_isi_konten'] ?? null;
    $judulKonten    = $d[$pfx . '_judul_konten'] ?? null;
    $gambarSop      = $d[$pfx . '_gambar_sop'] ?? null;
    $gambarProses   = $d[$pfx . '_gambar_proses'] ?? null;
    $gambarMaklumat = $d[$pfx . '_gambar_maklumat'] ?? null;
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
    
    // Cek apakah ada konten apapun yang perlu ditampilkan
    $adaKonten = $isiMaklumat || $judulMaklumat || $isiStandar || $judulStandar || 
                 $isiKonten || $judulKonten || $gambarSop || $gambarProses || 
                 $gambarMaklumat || $youtubeLink || $customKonten || $ringkasanEks || $isiLaporan ||
                 (isset($profil) && $profil && ($profil->konten_pembuka || $profil->gambaran || $profil->judul));
@endphp

{{-- ===== KONTEN DARI PROFIL_PPIDS (untuk teks utama) ===== --}}
@if(isset($profil) && $profil && ($profil->judul || $profil->konten_pembuka || $profil->gambaran || $profil->konten_detail))
<div class="content-box mb-4" style="border-left: 5px solid #d4af37;">
    @if($profil->judul)
        <h2 class="section-title">{{ $profil->judul }}</h2>
    @endif
    @if($profil->konten_pembuka)
        <div class="profil-content">{!! $profil->konten_pembuka !!}</div>
    @endif
    @if($profil->judul_sub)
        <h3 class="mt-4" style="color:#004a99; font-size:22px;">{{ $profil->judul_sub }}</h3>
    @endif
    @if($profil->konten_detail)
        <div class="profil-content mt-2">{!! $profil->konten_detail !!}</div>
    @endif
    @if($profil->gambaran)
        <div class="profil-content mt-3">{!! $profil->gambaran !!}</div>
    @endif
    @if($profil->additional_sections)
        @foreach($profil->additional_sections as $section)
            @if($section['title'] ?? null)
                <h3 class="mt-4" style="color:#004a99; font-size:20px;">{{ $section['title'] }}</h3>
            @endif
            @if($section['content'] ?? null)
                <div class="profil-content mt-2">{!! $section['content'] !!}</div>
            @endif
        @endforeach
    @endif
</div>
@endif

{{-- ===== KONTEN DARI DASHBOARDS (Maklumat, SOP, Laporan) ===== --}}

{{-- Section Maklumat Utama --}}
@if($judulMaklumat || $isiMaklumat)
<div class="content-box mb-4" style="border-left: 5px solid #004a99;">
    @if($judulMaklumat)
        <h2 class="section-title">{{ $judulMaklumat }}</h2>
    @endif
    @if($isiMaklumat)
        <div class="profil-content">{!! $isiMaklumat !!}</div>
    @endif
    @if($gambarMaklumat)
        <div class="mt-4 text-center">
            <img src="{{ asset('storage/halaman/' . $gambarMaklumat) }}" alt="Maklumat Pelayanan" class="img-fluid rounded shadow" style="max-height: 600px;">
        </div>
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

{{-- Gambar SOP & Alur --}}
@if($gambarSop || $gambarProses)
<div class="row mb-4">
    @if($gambarSop)
    <div class="{{ $gambarProses ? 'col-md-6' : 'col-12' }}">
        <div class="content-box text-center">
            <h3 style="color:#004a99; font-size:20px; margin-bottom:15px;"><i class="fas fa-file-image me-2"></i>Diagram SOP</h3>
            <img src="{{ asset('storage/halaman/' . $gambarSop) }}" alt="Gambar SOP" class="img-fluid rounded shadow" style="max-height: 700px;">
        </div>
    </div>
    @endif
    @if($gambarProses)
    <div class="{{ $gambarSop ? 'col-md-6' : 'col-12' }}">
        <div class="content-box text-center">
            <h3 style="color:#004a99; font-size:20px; margin-bottom:15px;"><i class="fas fa-project-diagram me-2"></i>Alur Proses</h3>
            <img src="{{ asset('storage/halaman/' . $gambarProses) }}" alt="Alur Proses" class="img-fluid rounded shadow" style="max-height: 700px;">
        </div>
    </div>
    @endif
</div>
@endif

{{-- Section Laporan --}}
@if($ringkasanEks || $isiLaporan)
<div class="content-box mb-4" style="border-left: 5px solid #ffc107;">
    @if($jenisLaporan || $tahunLaporan)
        <h2 class="section-title">Laporan {{ ucfirst($jenisLaporan) }} Tahun {{ $tahunLaporan }}</h2>
    @endif
    @if($ringkasanEks)
        <h3 style="color:#004a99; font-size:20px; margin-bottom:15px;">Ringkasan Eksekutif</h3>
        <div class="profil-content">{!! $ringkasanEks !!}</div>
    @endif
    @if($isiLaporan)
        <h3 style="color:#004a99; font-size:20px; margin-bottom:15px; margin-top:30px;">Detail Laporan</h3>
        <div class="profil-content">{!! $isiLaporan !!}</div>
    @endif
    @if($fileLaporan)
        <div class="mt-4">
            <a href="{{ asset('storage/halaman/' . $fileLaporan) }}" target="_blank" class="btn btn-warning text-dark fw-bold">
                <i class="fas fa-file-pdf me-2"></i> Download Dokumen Laporan
            </a>
        </div>
    @endif
</div>
@endif

{{-- Video YouTube --}}
@if($videoId)
<div class="content-box mb-4">
    <h3 style="color:#004a99; font-size:20px; margin-bottom:15px;"><i class="fab fa-youtube me-2" style="color:#ff0000;"></i>Video Tutorial</h3>
    <div class="ratio ratio-16x9" style="max-height:480px; border-radius:8px; overflow:hidden;">
        <iframe src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen loading="lazy" style="border:0;"></iframe>
    </div>
</div>
@endif

{{-- Custom Konten Generik --}}
@if($customKonten)
<div class="content-box mb-4">
    <div class="profil-content">{!! $customKonten !!}</div>
</div>
@endif

{{-- Pesan jika tidak ada konten sama sekali --}}
@if(!$adaKonten)
<div class="content-box text-center py-4" style="border-left: 5px solid #6c757d;">
    <i class="fas fa-info-circle" style="font-size:40px; color:#6c757d; margin-bottom:15px; display:block;"></i>
    <p class="text-muted mb-0">Konten halaman ini sedang dalam penyiapan. Silakan hubungi PPID PKTJ untuk informasi lebih lanjut.</p>
</div>
@endif
