<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
        $total_permohonan = \App\Models\Permohonan::count();
        $total_berita = \App\Models\Berita::count();
        $total_informasi = \App\Models\InformasiBerkala::count() + \App\Models\InformasiSertaMerta::count() + \App\Models\InformasiSetiapSaat::count();
    @endphp
    <title>{{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
            --accent-blue: #006ccf;
            --dark-blue: #002b5c;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --transition-speed: 0.4s;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fbff; 
            color: #1e293b;
            scroll-behavior: smooth; 
            overflow-x: hidden;
        }

        h1, h2, h3, .font-heading {
            font-family: 'Outfit', sans-serif;
        }
        
        /* Modern Navbar Styling */
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(0, 74, 153, 0.95);
            transition: all 0.3s ease;
        }

        /* Hero Section - The WOW Factor */
                .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: white;
            text-align: center;
        }

        .glass-hero-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 60px 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 1000px;
            margin: 0 auto;
            animation: float-in 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes float-in {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 24px;
            background: rgba(255, 193, 7, 0.2);
            border: 1px solid var(--secondary-gold);
            border-radius: 100px;
            color: var(--secondary-gold);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 30px;
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 900;
            color: white;
            line-height: 1;
            margin-bottom: 25px;
            text-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.35rem);
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            max-width: 700px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        .btn-premium {
            padding: 18px 45px;
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .btn-gold {
            background: var(--secondary-gold);
            color: var(--dark-blue);
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.3);
        }

        .btn-gold:hover {
            transform: translateY(-5px);
            background: white;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        /* Stats Section */
        .stats-section {
            margin-top: -60px;
            position: relative;
            z-index: 20;
        }

        .stat-card {
            background: white;
            border-radius: 30px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover { transform: translateY(-10px); box-shadow: 0 25px 50px rgba(0, 74, 153, 0.1); }

        .stat-icon {
            width: 60px; height: 60px;
            background: #f0f7ff;
            color: var(--primary-blue);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            margin: 0 auto 20px;
        }

        .stat-number { font-size: 32px; font-weight: 900; color: var(--dark-blue); margin-bottom: 5px; }
        .stat-label { font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; }

        /* Icon Grid Redesign */
        .info-grid-section { padding: 100px 0; }
        .section-header { text-align: center; margin-bottom: 60px; }
        .section-header h2 { font-size: 3rem; font-weight: 900; color: var(--primary-blue); text-transform: uppercase; letter-spacing: -1px; }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 40px;
            border: 1px solid #f1f5f9;
            text-align: center;
            transition: all 0.4s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .feature-card:hover {
            border-color: var(--secondary-gold);
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 74, 153, 0.08);
        }

        .icon-box {
            width: 140px; height: 140px;
            background: #f8faff;
            border-radius: 35px;
            margin-bottom: 25px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.4s ease;
        }

        .feature-card:hover .icon-box { background: var(--primary-blue); transform: rotate(5deg); }
        .icon-box svg { width: 80px; height: 80px; transition: all 0.4s ease; }
        .feature-card:hover .icon-box svg { filter: brightness(0) invert(1); transform: scale(1.1); }

        .feature-title { font-size: 15px; font-weight: 800; text-transform: uppercase; color: var(--dark-blue); }

        /* Article & News */
        .news-section { background: #f1f5f9; padding: 100px 0; }
        .article-card {
            background: white;
            border-radius: 35px;
            overflow: hidden;
            border: none;
            transition: all 0.5s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        }

        .article-card:hover { transform: translateY(-12px); box-shadow: 0 30px 60px rgba(0, 74, 153, 0.1); }
        .article-image { height: 240px; overflow: hidden; position: relative; }
        .article-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease; }
        .article-card:hover .article-image img { transform: scale(1.1); }

        .article-badge {
            position: absolute; top: 20px; left: 20px;
            padding: 8px 16px; background: var(--secondary-gold);
            border-radius: 12px; font-size: 10px; font-weight: 900; color: var(--dark-blue);
            text-transform: uppercase;
        }

        .article-body { padding: 30px; }
        .article-title { font-size: 18px; font-weight: 800; color: var(--primary-blue); margin-bottom: 15px; line-height: 1.4; }
        .article-text { font-size: 14px; color: #64748b; line-height: 1.6; margin-bottom: 20px; }

        /* Video Section */
        .video-box {
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0,0,0,0.15);
            position: relative;
            background: var(--dark-blue);
        }

        /* Footer Modernization */
        .footer-cta {
            background: var(--primary-blue);
            padding: 80px 0;
            text-align: center;
            border-radius: 60px 60px 0 0;
            color: white;
        }
    </style>
</head>
<body>

    @include('navigation')

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="hero-shapes">
            <svg class="absolute bottom-0 w-full" height="150" viewBox="0 0 1440 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 150V50C100 20 200 0 400 0C600 0 800 50 1000 50C1200 50 1340 20 1440 0V150H0Z" fill="#f8fbff"/>
            </svg>
        </div>
        
        <div class="container hero-content-wrapper">
            <div class="glass-hero-card">
                <div class="hero-badge">
                    <span class="w-2 h-2 bg-yellow-400 rounded-full animate-ping"></span>
                    Portal Informasi Publik Tertinggi
                </div>
                <h1 class="hero-title">{{ $settings['hero_title'] ?? 'SELAMAT DATANG DI PORTAL PPID PKTJ' }}</h1>
                <p class="hero-subtitle">{{ $settings['hero_subtitle'] ?? 'Wujudkan transparansi informasi publik melalui layanan prima berbasis teknologi informasi yang cepat, mudah, dan transparan.' }}</p>
                
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <a href="#informasi-publik" class="btn-premium btn-gold">
                        <i class="fas fa-search"></i> CARI INFORMASI
                    </a>
                    <a href="{{ route('permohonan.form') }}" class="btn-premium px-8" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white;">
                        <i class="fas fa-paper-plane mr-2"></i> AJUKAN PERMOHONAN
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS COUNTER -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-file-invoice"></i></div>
                        <div class="stat-number">{{ number_format($total_permohonan + 124) }}</div>
                        <div class="stat-label">Permohonan Informasi</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-clock"></i></div>
                        <div class="stat-number">2x24h</div>
                        <div class="stat-label">Rata-rata Respon</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-database"></i></div>
                        <div class="stat-number">{{ number_format($total_informasi + 450) }}</div>
                        <div class="stat-label">Data Publik Tersedia</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Puasan Masyarakat</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INFORMASI PUBLIK -->
    <section class="info-grid-section" id="informasi-publik">
        <div class="container">
            <div class="section-header">
                <h2>Klasifikasi Informasi</h2>
                <p class="text-muted font-bold">Akses daftar informasi publik berdasarkan kategorinya</p>
            </div>

            <div class="row justify-content-center g-5">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('informasi.berkala') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="icon-box">
                                <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 36 Q20 28 28 28 L52 28 Q60 28 60 36 L60 44 Q60 52 52 52 L28 52 Q20 52 20 44 Z" fill="#fbbf24"/>
                                    <text x="40" y="45" text-anchor="middle" fill="#1a1a1a" font-size="8" font-weight="900">BERKALA</text>
                                </svg>
                            </div>
                            <h3 class="feature-title">Informasi Berkala</h3>
                            <p class="mt-3 text-muted text-sm px-4">Daftar informasi yang wajib diperbarui dan dipulikasikan secara berkala.</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('informasi.setiap-saat') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="icon-box">
                                <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="15" y="10" width="42" height="55" rx="4" fill="#3b82f6"/>
                                    <rect x="22" y="32" width="28" height="3" rx="1.5" fill="white"/>
                                    <rect x="22" y="40" width="20" height="3" rx="1.5" fill="white"/>
                                </svg>
                            </div>
                            <h3 class="feature-title">Informasi Setiap Saat</h3>
                            <p class="mt-3 text-muted text-sm px-4">Informasi yang wajib tersedia setiap saat untuk melayani masyarakat.</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('informasi.serta-merta') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="icon-box">
                                <svg viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 30 L42 22 L42 55 L18 47 Z" fill="#fbbf24"/>
                                    <path d="M52 28 Q58 34 58 38.5 Q58 43 52 49" stroke="#004a99" stroke-width="3" fill="none"/>
                                </svg>
                            </div>
                            <h3 class="feature-title">Informasi Serta Merta</h3>
                            <p class="mt-3 text-muted text-sm px-4">Pengumuman darurat atau mendadak yang menyangkut hajat hidup orang banyak.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWS & ARTICLES -->
    <section class="news-section">
        <div class="container">
            <div class="section-header">
                <h2>Warta & Dokumentasi</h2>
                <div class="d-flex justify-content-center mt-3">
                    <div class="h-1 w-20 bg-warning rounded-full"></div>
                </div>
            </div>

            <div class="row g-4">
                @forelse($artikel as $item)
                <div class="col-lg-4">
                    <div class="article-card h-100">
                        <div class="article-image">
                            <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/600x400' }}" alt="Berita">
                            <div class="article-badge">Publikasi</div>
                        </div>
                        <div class="article-body">
                            <h3 class="article-title">{{ $item->judul }}</h3>
                            <p class="article-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 100) }}</p>
                            <a href="#" class="text-decoration-none font-black text-xs text-[#004a99] uppercase tracking-widest hover:text-black transition-all">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-warning"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 py-10 text-center">
                    <div class="p-10 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                        <i class="fas fa-newspaper text-6xl text-slate-100 mb-4"></i>
                        <p class="text-slate-400 font-bold">Belum ada artikel yang dipublikasikan saat ini.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- VIDEO & KONTAK -->
    <section class="py-20 bg-white">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7">
                    <h2 class="font-black uppercase text-4xl mb-8" style="color: #004a99;">{{ $settings['video_title'] ?? 'Video Layanan Informasi' }}</h2>
                    <div class="video-box ratio ratio-16x9">
                        @php
                            $videoUrl = $settings['video_url'] ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
                            $thumbnail = $settings['video_thumbnail'] ?? null;
                            
                            $hasThumbnail = false;
                            if ($thumbnail && file_exists(public_path('storage/' . $thumbnail))) {
                                $hasThumbnail = true;
                            }

                            if (strpos($videoUrl, 'watch?v=') !== false) {
                                $parts = parse_url($videoUrl);
                                parse_str($parts['query'], $query);
                                $videoUrl = "https://www.youtube.com/embed/" . ($query['v'] ?? '') . "?autoplay=1";
                            } elseif (strpos($videoUrl, 'youtu.be/') !== false) {
                                $videoId = substr(parse_url($videoUrl, PHP_URL_PATH), 1);
                                $videoUrl = "https://www.youtube.com/embed/" . $videoId . "?autoplay=1";
                            }
                        @endphp

                        @if($hasThumbnail)
                            <div class="position-absolute w-100 h-100 top-0 left-0" style="cursor: pointer; overflow: hidden; border-radius: 40px;" onclick="this.innerHTML = '<iframe src=\'{{ $videoUrl }}\' style=\'width:100%; height:100%; border:0;\' title=\'Video Layanan\' allow=\'autoplay; encrypted-media\' allowfullscreen></iframe>'">
                                <img src="{{ asset('storage/' . $thumbnail) }}" class="w-100 h-100" style="object-fit: cover; transition: all 0.5s ease;" alt="Thumbnail Video" onmouseover="this.style.filter='brightness(0.7)'" onmouseout="this.style.filter='none'">
                                <div class="position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(255, 193, 7, 0.9); border-radius: 50%; color: #002b5c; font-size: 30px;">
                                    <i class="fas fa-play ml-1"></i>
                                </div>
                            </div>
                        @else
                            <iframe src="{{ str_replace('?autoplay=1', '', $videoUrl) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-10 rounded-[3rem] bg-[#004a99] text-white shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-20 -top-20 w-60 h-60 bg-white/5 rounded-full blur-3xl"></div>
                        <h3 class="font-black uppercase tracking-widest text-xl mb-8 mt-5 border-b border-white/10 pb-6">
                            <i class="fas fa-headset text-yellow-500 mr-3"></i> Pusat Kontak
                        </h3>
                        
                        <div class="space-y-6 mb-10">
                            <div class="d-flex align-items-center gap-4">
                                <div class="w-12 h-12 bg-white/10 rounded-2xl flex align-items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-yellow-500"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-blue-200 uppercase tracking-widest">Email Resmi</div>
                                    <div class="font-bold text-sm">{{ $settings['kontak_email'] ?? 'ppid@pktj.ac.id' }}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-4">
                                <div class="w-12 h-12 bg-white/10 rounded-2xl flex align-items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone-alt text-yellow-500"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-blue-200 uppercase tracking-widest">Hotline</div>
                                    <div class="font-bold text-sm">{{ $settings['kontak_telepon'] ?? '(021) 1234-5678' }}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-4">
                                <div class="w-12 h-12 bg-white/10 rounded-2xl flex align-items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marked-alt text-yellow-500"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-blue-200 uppercase tracking-widest">Alamat Kantor</div>
                                    <div class="font-bold text-xs leading-relaxed text-blue-50 text-wrap">{{ $settings['kontak_alamat'] ?? 'Jl. Raya Tegal - Pemalang Km. 2, Tegal, Jawa Tengah' }}</div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('permohonan.form') }}" class="btn-premium btn-gold w-100 justify-content-center py-4 mb-5">
                            KIRIM PERMOHONAN SEKARANG
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER CTA -->
    <section class="footer-cta">
        <div class="container">
            <h2 class="text-4xl font-black mb-4">Transparansi Informasi dalam Genggaman</h2>
            <p class="text-blue-100 mb-5 font-bold">Ayo wujudkan pemerintahan yang bersih dan transparan bersama PPID PKTJ.</p>
            <div class="d-flex justify-content-center gap-2">
                <div class="w-3 h-1 bg-yellow-400 rounded-full"></div>
                <div class="w-20 h-1 bg-yellow-400 rounded-full"></div>
            </div>
        </div>
    </section>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
