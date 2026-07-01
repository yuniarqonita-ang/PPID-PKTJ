<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['sop_penetapan_judul_hero'] ?? 'SOP Penetapan & Pemutakhiran DIP' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="{{ $settings['sop_penetapan_tagline_hero'] ?? 'Standar Operasional Prosedur Penetapan dan Pengelolaan Daftar Informasi PPID PKTJ' }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('components.public-page-style')
</head>
<body>
    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content text-center">
            <div class="hero-badge">
                <i class="fas fa-sync-alt me-2"></i> Prosedur Pemutakhiran
            </div>
            <h1 class="hero-title outfit">{{ $settings['sop_penetapan_judul_hero'] ?? 'SOP Penetapan & Pemutakhiran DIP' }}</h1>
            <p class="hero-tagline">{{ $settings['sop_penetapan_tagline_hero'] ?? 'Standar Operasional Prosedur Penetapan dan Pengelolaan Daftar Informasi' }}</p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card">
            @php
                $d = $settings ?? [];
                $hasContent = ($d['sop_penetapan_isi_konten'] ?? null) ||
                              ($d['sop_penetapan_gambar_sop'] ?? null) ||
                              ($d['sop_penetapan_gambar_proses'] ?? null) ||
                              ($d['sop_penetapan_youtube_link'] ?? null) ||
                              ($d['sop_penetapan_isi_maklumat'] ?? null) ||
                              ($d['sop_penetapan_konten'] ?? null) ||
                              (isset($laporan) && $laporan->count() > 0);
            @endphp

            @if($hasContent)
                @include('components.konten-dinamis', ['prefix' => 'sop_penetapan'])
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h3>Konten Sedang Disiapkan</h3>
                    <p>Informasi mengenai SOP Pemutakhiran Daftar Informasi sedang dalam proses penyusunan oleh tim PPID PKTJ.</p>
                    <a href="{{ route('layanan.daftar-informasi') }}" class="btn-action">
                        <i class="fas fa-list me-2"></i> Lihat Daftar Informasi
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
