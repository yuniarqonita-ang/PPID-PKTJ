<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}</title>
    <meta name="description" content="{{ Str::limit(strip_tags($berita->konten), 160) }}">
    @if($berita->gambar)
        <meta property="og:image" content="{{ asset('storage/' . $berita->gambar) }}">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
        }
        body { font-family: 'Inter', sans-serif; background: #f8faff; color: #1e293b; }
        .outfit { font-family: 'Outfit', sans-serif; }

        /* Hero */
        .hero-section {
            background: linear-gradient(rgba(0,74,153,0.93), rgba(0,40,100,0.9)),
                        {{ $berita->gambar ? "url('".asset('storage/'.$berita->gambar)."')" : "url('https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070')" }};
            background-size: cover;
            background-position: center;
            padding: 140px 0 180px;
            color: white;
        }
        .hero-badge {
            display: inline-block;
            background: var(--secondary-gold);
            color: var(--primary-blue);
            font-size: 10px;
            font-weight: 900;
            padding: 6px 18px;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        /* Article card */
        .article-wrap {
            background: white;
            border-radius: 40px;
            box-shadow: 0 30px 80px rgba(0,74,153,0.1);
            padding: 60px;
            margin-top: -100px;
            position: relative;
            z-index: 20;
            margin-bottom: 80px;
        }

        /* Content typography */
        .article-content {
            font-size: 1.08rem;
            line-height: 1.9;
            color: #334155;
        }
        .article-content h2, .article-content h3 { font-family: 'Outfit', sans-serif; font-weight: 800; color: var(--primary-blue); margin: 32px 0 16px; }
        .article-content img { max-width: 100%; border-radius: 16px; margin: 24px 0; }
        .article-content a { color: var(--primary-blue); font-weight: 600; }
        .article-content blockquote {
            border-left: 5px solid var(--secondary-gold);
            padding: 16px 24px;
            background: #f8faff;
            border-radius: 0 16px 16px 0;
            margin: 24px 0;
            color: #475569;
            font-style: italic;
        }
        .article-content ul li, .article-content ol li { margin-bottom: 8px; }

        /* Cover image */
        .cover-image {
            width: 100%;
            max-height: 520px;
            object-fit: cover;
            border-radius: 24px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0,74,153,0.12);
        }

        /* Meta bar */
        .meta-bar {
            background: #f8faff;
            border-radius: 20px;
            padding: 20px 28px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .meta-item { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .meta-item .icon { color: var(--secondary-gold); font-size: 15px; }

        /* Related articles */
        .related-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            transition: all 0.35s;
            text-decoration: none;
            display: block;
            color: inherit;
        }
        .related-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(0,74,153,0.1); border-color: var(--primary-blue); }
        .related-card img { height: 160px; width: 100%; object-fit: cover; }
        .related-card-body { padding: 20px; }
        .related-card-title { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 0.95rem; color: #1e293b; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

        /* Share buttons */
        .share-btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 14px; font-weight: 700; font-size: 12px; text-decoration: none; transition: all 0.3s; text-transform: uppercase; }
        .share-wa { background: #25D366; color: white; }
        .share-wa:hover { background: #128C7E; color: white; transform: scale(1.04); }
        .share-copy { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .share-copy:hover { background: #e2e8f0; color: #1e293b; transform: scale(1.04); }
        .share-back { background: var(--primary-blue); color: white; }
        .share-back:hover { background: #002b5c; color: white; transform: scale(1.04); }

        @media(max-width: 768px) {
            .article-wrap { padding: 30px 20px; }
            .hero-section { padding: 100px 0 140px; }
        }
    </style>
</head>
<body>
    @include('navigation')

    <!-- HERO -->
    <div class="hero-section">
        <div class="container text-center">
            <span class="hero-badge">{{ $berita->kategori ?? 'Berita Utama' }}</span>
            <h1 class="display-5 fw-black outfit" style="max-width: 800px; margin: 0 auto; line-height: 1.2;">
                {{ $berita->judul }}
            </h1>
        </div>
    </div>

    <!-- ARTICLE BODY -->
    <div class="container">
        <div class="article-wrap">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb" style="font-size: 12px; font-weight: 700;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--primary-blue);">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/berita') }}" class="text-decoration-none" style="color: var(--primary-blue);">Berita</a></li>
                    <li class="breadcrumb-item active text-muted">{{ Str::limit($berita->judul, 40) }}</li>
                </ol>
            </nav>

            <!-- Meta Bar -->
            <div class="meta-bar">
                <div class="meta-item">
                    <i class="fas fa-calendar-alt icon"></i>
                    {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
                </div>
                <div class="meta-item">
                    <i class="fas fa-user-tie icon"></i>
                    Admin PPID PKTJ
                </div>
                <div class="meta-item">
                    <i class="fas fa-eye icon"></i>
                    {{ number_format($berita->views ?? 0) }} tayangan
                </div>
                <div class="meta-item ms-auto">
                    <i class="fas fa-tag icon"></i>
                    {{ $berita->kategori ?? 'Berita Utama' }}
                </div>
            </div>

            <!-- Cover Image -->
            @if($berita->gambar)
                <img src="{{ asset('storage/' . $berita->gambar) }}" class="cover-image" alt="{{ $berita->judul }}">
            @endif

            <!-- Article Content -->
            <div class="article-content">
                {!! $berita->konten !!}
            </div>

            <!-- Divider -->
            <hr class="my-5" style="border-color: #e2e8f0;">

            <!-- Share & Navigation -->
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex gap-3 flex-wrap">
                    <span class="meta-item"><i class="fas fa-share-alt icon"></i> Bagikan:</span>
                    <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . url('/berita/'.$berita->slug)) }}" 
                       target="_blank" class="share-btn share-wa">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <button onclick="navigator.clipboard.writeText('{{ url('/berita/'.$berita->slug) }}'); this.innerHTML='<i class=\'fas fa-check\'></i> Tersalin!'" 
                            class="share-btn share-copy" style="border: none; cursor: pointer;">
                        <i class="fas fa-link"></i> Salin Link
                    </button>
                </div>
                <a href="{{ url('/berita') }}" class="share-btn share-back">
                    <i class="fas fa-arrow-left"></i> Semua Berita
                </a>
            </div>
        </div>

        <!-- Related Articles -->
        @if($related->isNotEmpty())
        <div class="mb-5">
            <h2 class="outfit fw-black mb-4" style="color: var(--primary-blue); font-size: 1.8rem; border-left: 6px solid var(--secondary-gold); padding-left: 18px;">
                Berita Lainnya
            </h2>
            <div class="row g-4">
                @foreach($related as $rel)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ url('/berita/' . $rel->slug) }}" class="related-card">
                        @if($rel->gambar)
                            <img src="{{ asset('storage/' . $rel->gambar) }}" alt="{{ $rel->judul }}">
                        @else
                            <div style="height: 160px; background: linear-gradient(135deg, #e8f0fe, #c7d9ff); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-newspaper fa-2x text-primary opacity-25"></i>
                            </div>
                        @endif
                        <div class="related-card-body">
                            <div class="related-card-title">{{ $rel->judul }}</div>
                            <div class="mt-2" style="font-size: 11px; color: #94a3b8; font-weight: 700;">
                                <i class="fas fa-calendar-alt me-1" style="color: var(--secondary-gold);"></i>
                                {{ $rel->tanggal ? \Carbon\Carbon::parse($rel->tanggal)->translatedFormat('d M Y') : $rel->created_at->translatedFormat('d M Y') }}
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
