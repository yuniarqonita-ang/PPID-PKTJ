<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Survey Kepuasan - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Hasil indeks kepuasan masyarakat terhadap pelayanan informasi publik PPID PKTJ">
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
                <i class="fas fa-poll me-2"></i> Survey Kepuasan
            </div>
            <h1 class="hero-title outfit">{{ $settings['laporan_survey_judul_hero'] ?? 'Laporan Survey Kepuasan' }}</h1>
            <p class="hero-tagline">Hasil Indeks Kepuasan Masyarakat terhadap Pelayanan Informasi Publik</p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card">
            @php
                $d = $settings ?? [];
                $fileLaporan = $d['laporan_survey_file_laporan'] ?? null;
            @endphp

            @if($fileLaporan)
                <div class="text-center py-5">
                    <div class="empty-icon mx-auto mb-4">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h3 style="font-family:'Outfit',sans-serif;font-weight:800;color:#004a99;margin-bottom:12px;">
                        {{ $settings['laporan_survey_judul_hero'] ?? 'Laporan Survey Kepuasan' }}
                    </h3>
                    <p style="color:#64748b;max-width:500px;margin:0 auto 32px;line-height:1.7;">
                        Dokumen laporan survey kepuasan masyarakat PPID {{ $settings['ppid_nama'] ?? 'PKTJ' }} tersedia untuk diunduh.
                    </p>
                    <a href="{{ asset('storage/halaman/' . $fileLaporan) }}"
                       target="_blank" class="btn-action btn-action-gold">
                        <i class="fas fa-download"></i> Unduh Laporan Survey (PDF)
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-poll"></i>
                    </div>
                    <h3>Laporan Belum Tersedia</h3>
                    <p>Laporan Survey Kepuasan {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }} sedang dalam proses pengumpulan data dan penyusunan.</p>
                    <a href="{{ route('profil.kontak') }}" class="btn-action">
                        <i class="fas fa-envelope me-2"></i> Hubungi Kami
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
