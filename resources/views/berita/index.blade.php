<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Artikel - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <meta name="description" content="Informasi terkini dan pengumuman resmi dari PPID PKTJ.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8faff;
            color: #1e293b;
        }
        .outfit { font-family: 'Outfit', sans-serif; }

        /* Hero */
        .hero-section {
            background: linear-gradient(rgba(0,74,153,0.92), rgba(0,74,153,0.85)),
                        url('https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 120px 0 160px;
            color: white;
        }

        /* Content card overlap */
        .content-wrap {
            margin-top: -80px;
            position: relative;
            z-index: 20;
            margin-bottom: 80px;
        }

        /* Search bar */
        .search-glass {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 30px;
            padding: 10px;
            display: flex;
            gap: 10px;
            max-width: 600px;
            margin: 40px auto 0;
        }
        .search-glass input {
            background: transparent;
            border: none;
            color: white;
            padding: 10px 20px;
            width: 100%;
            font-weight: 600;
        }
        .search-glass input::placeholder { color: rgba(255,255,255,0.7); }
        .search-glass input:focus { outline: none; }
        .search-glass button {
            background: var(--secondary-gold);
            color: var(--primary-blue);
            border: none;
            padding: 10px 28px;
            border-radius: 22px;
            font-weight: 900;
            transition: all 0.3s;
        }
        .search-glass button:hover { transform: scale(1.04); background: white; }

        /* Cards */
        .news-card {
            background: white;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,74,153,0.07);
            border: 1px solid #e2e8f0;
            transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
            height: 100%;
        }
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,74,153,0.13);
            border-color: var(--primary-blue);
        }
        .news-card-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.5s ease;
        }
        .news-card:hover .news-card-img { transform: scale(1.06); }
        .news-card-img-wrap { overflow: hidden; position: relative; }
        .news-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: var(--secondary-gold);
            color: var(--primary-blue);
            font-size: 10px;
            font-weight: 900;
            padding: 4px 14px;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .no-image-placeholder {
            height: 220px;
            background: linear-gradient(135deg, #e8f0fe, #c7d9ff);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .news-card-body { padding: 28px; }
        .news-card-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.05rem;
            color: #1e293b;
            line-height: 1.4;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .news-card-excerpt {
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .news-meta {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-read-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-blue);
            color: white;
            padding: 10px 22px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 12px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            margin-top: 16px;
        }
        .btn-read-more:hover {
            background: var(--secondary-gold);
            color: var(--primary-blue);
            transform: scale(1.04);
        }

        /* Pagination */
        .pagination .page-link {
            border-radius: 10px;
            margin: 0 3px;
            color: var(--primary-blue);
            font-weight: 700;
            border: 1px solid #e2e8f0;
        }
        .pagination .page-item.active .page-link {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        /* Section title */
        .section-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            color: var(--primary-blue);
            font-size: 2.2rem;
            border-left: 8px solid var(--secondary-gold);
            padding-left: 20px;
            margin-bottom: 40px;
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

    <!-- HERO -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-black outfit" style="letter-spacing: -2px;">Berita & Artikel</h1>
            <p class="lead opacity-75 mb-0">Informasi terkini, pengumuman, dan dokumentasi resmi PPID PKTJ.</p>

            <!-- Search -->
            <form action="{{ url('/berita') }}" method="GET" class="search-glass mx-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita atau artikel...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container content-wrap">
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg mb-5" style="border-radius: 36px !important; border: 1px solid rgba(0,74,153,0.06);">
            
            <!-- Category Navigation Pills -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 pb-3 border-bottom">
                <div class="d-flex flex-wrap gap-2">
                    @foreach($kategoriList as $kat)
                        @php
                            $isActive = ($kategoriAktif == $kat) || (empty($kategoriAktif) && $kat == 'Semua');
                            $catUrl = url('/berita') . ($kat == 'Semua' ? '' : '?kategori=' . urlencode($kat));
                            if (request('search')) {
                                $catUrl .= ($kat == 'Semua' ? '?' : '&') . 'search=' . urlencode(request('search'));
                            }
                        @endphp
                        <a href="{{ $catUrl }}" class="btn btn-sm rounded-pill px-3 py-2 fw-bold text-decoration-none transition-all {{ $isActive ? 'btn-primary' : 'btn-outline-secondary' }}" style="{{ $isActive ? 'background-color: #004a99; border-color: #004a99;' : 'border-color: #cbd5e1; color: #475569;' }}">
                            {{ $kat }}
                        </a>
                    @endforeach
                </div>
                <div class="d-flex align-items-center gap-2 text-muted small">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                        <i class="fas fa-satellite-dish me-1"></i> Realtime PKTJ.ac.id
                    </span>
                    <span class="badge text-bg-light border px-3 py-2 rounded-pill fw-bold">
                        {{ $paginatedNews->total() }} Berita
                    </span>
                </div>
            </div>

            <div class="row g-4">
                @forelse($paginatedNews as $item)
                    @php
                        $isArr = is_array($item);
                        $judul = $isArr ? ($item['judul'] ?? '') : $item->judul;
                        $ringkasan = $isArr ? ($item['ringkasan'] ?? \Illuminate\Support\Str::limit(strip_tags($item['konten'] ?? ''), 120)) : \Illuminate\Support\Str::limit(strip_tags($item->konten ?? ''), 120);
                        $kategori = $isArr ? ($item['kategori'] ?? 'Liputan/Berita') : ($item->kategori ?? 'Liputan/Berita');
                        $gambar = $isArr ? ($item['gambar'] ?? 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png') : ($item->gambar_url ?? 'https://pktj.ac.id/assets/frontoffice/images/pktj_hero.png');
                        $link = $isArr ? ($item['link'] ?? url('/berita/' . ($item['slug'] ?? ''))) : ($item->url_berita ?? url('/berita/' . $item->slug));
                        $tanggal = $isArr ? ($item['tanggal_f'] ?? date('d M Y')) : ($item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : $item->created_at->translatedFormat('d F Y'));
                        $isExternal = $isArr ? ($item['is_external'] ?? true) : ($item->is_external ?? false);
                    @endphp
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->iteration % 3) * 100 }}">
                        <div class="news-card d-flex flex-column h-100 shadow-sm hover-lift" style="border-radius: 22px; overflow: hidden; border: 1px solid #e2e8f0;">
                            <div class="news-card-img-wrap position-relative" style="height: 220px; overflow: hidden; background: #0f172a;">
                                <img src="{{ $gambar }}" class="news-card-img w-100 h-100" alt="{{ $judul }}" style="object-fit: cover; transition: transform 0.5s ease;" onerror="this.src='https://images.unsplash.com/photo-1585829365295-ab7cd400c167?q=80&w=800'">
                                <span class="news-badge position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill text-xs fw-bold shadow-sm" style="background: var(--secondary-gold); color: #004a99; font-size: 11px;">
                                    <i class="fas fa-tag me-1"></i> {{ $kategori }}
                                </span>
                            </div>
                            <div class="news-card-body p-4 d-flex flex-column flex-grow-1">
                                <h3 class="news-card-title fw-bold mb-2" style="font-family: 'Outfit', sans-serif; font-size: 1.1rem; line-height: 1.4; color: #1e293b;">
                                    <a href="{{ $link }}" {{ $isExternal ? 'target=_blank rel=noopener' : '' }} class="text-decoration-none text-dark hover-primary transition-all">
                                        {{ $judul }}
                                    </a>
                                </h3>
                                <p class="news-card-excerpt text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
                                    {{ $ringkasan }}
                                </p>
                                <div class="news-meta d-flex align-items-center justify-content-between pt-3 border-top mt-auto text-xs text-muted" style="font-size: 11px;">
                                    <span><i class="far fa-calendar-alt text-warning me-1"></i> {{ $tanggal }}</span>
                                    <span class="badge bg-light text-muted border">pktj.ac.id</span>
                                </div>
                                <a href="{{ $link }}" {{ $isExternal ? 'target=_blank rel=noopener' : '' }} class="btn-read-more justify-content-center mt-3 shadow-sm">
                                    Baca Selengkapnya <i class="fas fa-external-link-alt ms-1 text-warning" style="font-size: 11px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-newspaper fa-5x text-muted mb-4 opacity-25"></i>
                        <h4 class="text-muted fw-bold">
                            @if(request('search'))
                                Tidak ditemukan berita dengan kata kunci "{{ request('search') }}"
                            @else
                                Tidak ada berita untuk kategori "{{ $kategoriAktif }}"
                            @endif
                        </h4>
                        <p class="text-muted">Coba pilih kategori lain atau kembali ke kategori <a href="{{ url('/berita') }}" class="text-primary fw-bold">Semua</a>.</p>
                    </div>
                @endforelse
            </div>

            @if($paginatedNews->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $paginatedNews->links('pagination::bootstrap-4') }}
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
