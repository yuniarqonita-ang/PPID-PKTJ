<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Regulasi PPID' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004A99' }};
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#FFC107' }};
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8faff; 
            color: #1e293b;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

                /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-content { position: relative; z-index: 10; }

        .content-card {
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 74, 153, 0.05);
            margin-top: -60px;
            border: 1px solid rgba(0, 74, 153, 0.05);
            position: relative;
            z-index: 20;
            margin-bottom: 50px;
        }

        .section-title {
            color: var(--primary-blue);
            font-weight: 900;
            margin-bottom: 30px;
            border-left: 6px solid var(--secondary-gold);
            padding-left: 20px;
            text-transform: uppercase;
            letter-spacing: -1px;
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
        }

        .regulasi-item {
            background: #f8fafc;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
            border-left: 5px solid var(--primary-blue);
            transition: all 0.3s ease;
        }

        .regulasi-item:hover {
            transform: translateX(10px);
            background: white;
            box-shadow: 0 10px 30px rgba(0, 74, 153, 0.08);
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-3">{{ $profil->judul ?? 'Regulasi' }}</h1>
            <p class="lead opacity-75">{{ $profil->tagline_hero ?? 'Kumpulan Dasar Hukum dan Peraturan Terkait Keterbukaan Informasi Publik' }}</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            @if($profil)
                @php
                    $videoUrl = $settings['regulasi_youtube_link'] ?? null;
                    $embedUrl = null;
                    if ($videoUrl) {
                        $videoUrl = trim($videoUrl);
                        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/i';
                        if (preg_match($pattern, $videoUrl, $matches)) {
                            $embedUrl = "https://www.youtube.com/embed/" . $matches[1];
                        } elseif (preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoUrl)) {
                            $embedUrl = "https://www.youtube.com/embed/" . $videoUrl;
                        }
                    }
                @endphp

                @if($embedUrl)
                    <div class="video-container mb-5 rounded-4 overflow-hidden shadow-sm border border-slate-100">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $embedUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                @if($profil->konten_pembuka)
                    <div class="mb-5 rich-content">
                        <div class="text-justify">
                            {!! $profil->konten_pembuka !!}
                        </div>
                    </div>
                @endif

                @if($profil->judul_sub)
                    <h2 class="section-title">{{ $profil->judul_sub }}</h2>
                    @if($profil->konten_detail)
                        <div class="rich-content mb-5">
                            {!! $profil->konten_detail !!}
                        </div>
                    @endif
                @endif

                @if($profil->additional_sections)
                    <div class="mt-4">
                        @foreach($profil->additional_sections as $section)
                            <div class="regulasi-item">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="bg-blue-100 p-3 rounded-circle text-primary">
                                        <i class="fas fa-file-contract fa-lg"></i>
                                    </div>
                                    <h4 class="outfit fw-extrabold m-0 text-blue-900">{{ $section['title'] }}</h4>
                                </div>
                                <div class="rich-content ps-2">
                                    {!! $section['content'] !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- DAFTAR PERATURAN DARI DATABASE --}}
                @if(isset($peraturan) && count($peraturan) > 0)
                    <div class="mt-5 pt-4 border-top">
                        <h2 class="section-title">Dokumen Peraturan</h2>
                        @foreach($peraturan as $kategori => $items)
                            <div class="mb-5">
                                <h3 class="outfit fw-bold text-blue-800 mb-4 bg-blue-50 p-3 rounded-xl border-start border-4 border-blue-600">
                                    <i class="fas fa-bookmark me-2"></i> {{ $kategori }}
                                </h3>
                                <div class="row g-4">
                                    @foreach($items as $p)
                                        <div class="col-md-6">
                                            <div class="p-4 bg-white border rounded-2xl shadow-sm hover:shadow-md transition-all border-slate-200">
                                                <div class="d-flex justify-content-between align-items-start gap-3">
                                                    <div>
                                                        <h5 class="fw-bold text-dark mb-2">{{ $p->judul }}</h5>
                                                        <p class="small text-slate-500 mb-3">{{ Str::limit(strip_tags($p->deskripsi), 100) }}</p>
                                                    </div>
                                                    <div class="bg-amber-100 text-amber-600 p-2 rounded-lg">
                                                        <i class="fas fa-file-pdf fa-lg"></i>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <span class="badge bg-light text-slate-600 border px-3 py-2 rounded-pill small">
                                                        <i class="fas fa-calendar-alt me-1"></i> {{ $p->created_at->format('d M Y') }}
                                                    </span>
                                                    @if(is_previewable('storage/' . $p->file_path))
                                                    <button type="button" 
                                                            class="btn btn-sm btn-primary px-4 py-2 rounded-pill fw-bold" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#previewModal" 
                                                            data-url="{{ route('preview.dokumen', ['file' => 'storage/' . $p->file_path, 'title' => $p->judul]) }}">
                                                        <i class="fas fa-eye me-1"></i> Lihat
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-balance-scale fa-4x text-muted mb-4"></i>
                    <h3 class="text-muted">Regulasi Belum Tersedia</h3>
                    <p class="text-muted">Administrator sedang mengunggah dokumen regulasi terbaru.</p>
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
