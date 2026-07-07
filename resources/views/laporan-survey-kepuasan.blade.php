<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['laporan_survey_judul_hero'] ?? 'Laporan Survey Kepuasan' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Hasil indeks kepuasan masyarakat terhadap pelayanan informasi publik PPID PKTJ">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('components.public-page-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content text-center">
            <div class="hero-badge">
                <i class="fas fa-poll me-2"></i> Survey Kepuasan
            </div>
            <h1 class="hero-title outfit">{{ $settings['laporan_survey_judul_hero'] ?? 'Laporan Survey Kepuasan' }}</h1>
            <p class="hero-tagline">{{ $settings['laporan_survey_tagline_hero'] ?? 'Hasil Indeks Kepuasan Masyarakat terhadap Pelayanan Informasi Publik' }}</p>
        </div>
    </div>

    <div class="container page-container">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            @php
                $hasLaporanList = isset($laporan) && $laporan->count() > 0;
            @endphp

            @if($hasLaporanList)
                <div class="row">
                    @foreach($laporan as $item)
                    @php
                        $isGDrive = $item->file_path && (\Illuminate\Support\Str::startsWith($item->file_path, ['http://', 'https://']));
                        $previewUrl = $item->file_path ? ($isGDrive ? $item->file_path : 'storage/' . $item->file_path) : null;
                    @endphp
                    <div class="col-12">
                        <div class="info-item hover-lift" data-aos="fade-up">
                            <div class="d-flex align-items-start flex-column flex-md-row">
                                <div class="info-icon">
                                    <i class="fas fa-poll"></i>
                                </div>
                                <div class="flex-grow-1 w-100">
                                    <h4 class="fw-bold outfit text-dark mb-3">{{ $item->judul }}</h4>
                                    
                                    <div class="rich-content mb-4">
                                        {!! $item->deskripsi ?? 'Tidak ada deskripsi terperinci untuk laporan ini.' !!}
                                    </div>
                                    
                                    <div class="d-flex align-items-center justify-content-between pt-3 border-top flex-wrap gap-3">
                                        <div class="d-flex gap-3">
                                            <span class="badge bg-light text-primary border px-3 py-2 rounded-pill">
                                                <i class="fas fa-calendar-alt me-1"></i> {{ $item->tanggal ? $item->tanggal->translatedFormat('d F Y') : ($item->created_at ? $item->created_at->translatedFormat('d F Y') : '-') }}
                                            </span>
                                            @if($item->file_size && $item->file_size !== '-')
                                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                                                <i class="fas fa-hdd me-1"></i> {{ $item->file_size }}
                                            </span>
                                            @endif
                                        </div>
                                        
                                        <div class="d-flex gap-2">
                                            @if($previewUrl && is_previewable($previewUrl))
                                            <a href="#" class="btn-download-premium" 
                                                data-bs-toggle="modal" data-bs-target="#previewModal" 
                                                data-url="{{ route('preview.dokumen', ['file' => $previewUrl, 'title' => $item->judul, 'is_blurred' => $item->is_blurred ? '1' : '0']) }}">
                                                <i class="fas fa-eye"></i> Lihat Laporan
                                            </a>
                                            @endif
                                            
                                            @if($item->file_path && $item->bisa_download)
                                            <a href="{{ route('dokumen.download', $item->id) }}" class="btn-download-premium" style="background: #10b981; color: white;">
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
