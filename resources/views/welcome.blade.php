<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
    @endphp
    <title>{{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: {{ $settings['bg_color'] ?? '#f8f9fa' }}; 
            scroll-behavior: smooth; 
        }
        
        /* Dropdown styles untuk desktop */
        @media (min-width: 992px) { 
            .nav-item.dropdown:hover .dropdown-menu { 
                display: block !important; 
                margin-top: 0; 
            } 
        }
        
        /* Dropdown z-index fix */
        .dropdown-menu {
            z-index: 1050 !important;
        }
        
        .dropdown-toggle::after {
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #ffc107 !important;
            transform: translateY(-1px);
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-top: 10px;
        }
        
        .dropdown-item {
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, #004a99 0%, #0066cc 100%);
            color: white !important;
            transform: translateX(5px);
        }
        
        .hero-section {
            background: linear-gradient(135deg, {{ $settings['primary_color'] ?? '#004A99' }} 0%, {{ $settings['secondary_color'] ?? '#0066CC' }} 100%);
            color: white;
            padding: 100px 0; 
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-section h1 {
            font-size: 56px;
            font-weight: 900;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-section .lead {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            border: none;
            font-weight: 700;
            padding: 15px 40px;
            font-size: 1.1rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(255,193,7,0.3);
            transition: all 0.3s ease;
        }
        
        .btn-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255,193,7,0.4);
            background: linear-gradient(135deg, #ffb300 0%, #ff9800 100%);
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #004a99;
            margin-bottom: 50px;
            text-align: center;
            position: relative;
            padding-bottom: 20px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            border-radius: 2px;
        }

        /* ===== Informasi Publik Icon Section ===== */
        .info-publik-section {
            background: #f5f6fa;
            padding: 70px 0 60px;
        }

        .info-publik-section .section-title {
            font-size: 2rem;
            font-weight: 800;
            color: #1a1a2e;
            margin-bottom: 55px;
        }

        .info-icon-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .info-icon-wrapper:hover {
            transform: translateY(-8px);
        }

        .info-icon-circle {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: linear-gradient(145deg, #2c3e60 0%, #3d5280 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2), inset 0 2px 4px rgba(255,255,255,0.08);
            transition: box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-icon-circle::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 50%;
            background: rgba(255,255,255,0.05);
            border-radius: 50% 50% 0 0;
        }

        .info-icon-wrapper:hover .info-icon-circle {
            box-shadow: 0 18px 40px rgba(0,0,0,0.28), inset 0 2px 4px rgba(255,255,255,0.1);
        }

        .info-icon-circle img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            position: relative;
            z-index: 1;
        }

        .info-icon-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: #3a3a5c;
            text-transform: uppercase;
            text-align: center;
        }

        .divider-line {
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #6b48c8, #9b6ee8);
            border-radius: 2px;
            margin: 30px auto 50px;
        }

        /* ===== Ada Pertanyaan Section ===== */
        .ada-pertanyaan-section {
            background: #f5f6fa;
            padding: 0 0 70px;
            text-align: center;
        }

        .ada-pertanyaan-section h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #1a1a2e;
            margin-bottom: 22px;
        }

        .btn-permohonan {
            background: linear-gradient(135deg, #f5c518 0%, #e6b800 100%);
            border: none;
            color: #1a1a2e;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.5px;
            padding: 14px 40px;
            border-radius: 50px;
            box-shadow: 0 6px 24px rgba(230,184,0,0.35);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-permohonan:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(230,184,0,0.45);
            background: linear-gradient(135deg, #ffd23a 0%, #f5c518 100%);
            color: #1a1a2e;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #004a99;
            margin-bottom: 15px;
        }
        
        .btn-link {
            color: #d4af37;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-link:hover {
            color: #ffc107;
            transform: translateX(5px);
        }
        
        .footer {
            background: linear-gradient(135deg, {{ $settings['primary_color'] ?? '#1A3A52' }} 0%, {{ $settings['secondary_color'] ?? '#004A99' }} 100%);
            color: white;
            padding: 50px 0 30px;
            margin-top: 80px;
        }
        
        .footer h5 {
            font-weight: 700;
            margin-bottom: 20px;
            color: #ffc107;
        }
        
        .footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer a:hover {
            color: #ffc107;
        }
        
        .bg-primary {
            background-color: #1a3a52 !important;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-5 fw-bold mb-3">{{ $settings['hero_title'] ?? 'Selamat Datang di Portal PPID PKTJ' }}</h1>
                <p class="lead">{{ $settings['hero_subtitle'] ?? 'Layanan Informasi Publik Terintegrasi dan Transparan' }}</p>
                <div class="mt-4">
                    <a href="#informasi-publik" class="btn btn-warning btn-lg fw-bold px-4">
                        <i class="fas fa-search me-2"></i>CARI INFORMASI
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== INFORMASI PUBLIK ICON SECTION ===== -->
    <section class="info-publik-section" id="informasi-publik">
        <div class="container">
            <h2 class="section-title">Informasi Publik</h2>

            <div class="row justify-content-center g-5">
                <!-- Informasi Berkala -->
                <div class="col-auto">
                    <a href="{{ route('informasi.berkala') }}" class="info-icon-wrapper">
                        <div class="info-icon-circle">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Badge BERKALA -->
                                <ellipse cx="40" cy="40" rx="30" ry="30" fill="#4a5a8a" opacity="0.5"/>
                                <!-- Puzzle/circular badge icon -->
                                <circle cx="40" cy="40" r="26" fill="#3b82f6" opacity="0.15"/>
                                <!-- Yellow badge shape -->
                                <path d="M20 36 Q20 28 28 28 L52 28 Q60 28 60 36 L60 44 Q60 52 52 52 L28 52 Q20 52 20 44 Z" fill="#fbbf24"/>
                                <text x="40" y="45" text-anchor="middle" fill="#1a1a1a" font-size="10" font-weight="900" font-family="Arial" letter-spacing="0.5">BERKALA</text>
                                <!-- Puzzle piece top -->
                                <path d="M34 28 Q34 22 40 22 Q46 22 46 28" fill="#3b82f6" opacity="0.7"/>
                                <!-- Puzzle piece bottom -->
                                <path d="M34 52 Q34 58 40 58 Q46 58 46 52" fill="#3b82f6" opacity="0.7"/>
                                <!-- Puzzle piece left -->
                                <path d="M20 34 Q14 34 14 40 Q14 46 20 46" fill="#3b82f6" opacity="0.7"/>
                                <!-- Puzzle piece right -->
                                <path d="M60 34 Q66 34 66 40 Q66 46 60 46" fill="#3b82f6" opacity="0.7"/>
                            </svg>
                        </div>
                        <span class="info-icon-label">Informasi Berkala</span>
                    </a>
                </div>

                <!-- Informasi Setiap Saat -->
                <div class="col-auto">
                    <a href="{{ route('informasi.setiap-saat') }}" class="info-icon-wrapper">
                        <div class="info-icon-circle">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Document background -->
                                <rect x="15" y="10" width="42" height="55" rx="4" fill="#e2e8f0"/>
                                <rect x="15" y="10" width="42" height="55" rx="4" fill="white" opacity="0.9"/>
                                <!-- Blue header bar -->
                                <rect x="15" y="10" width="42" height="14" rx="4" fill="#3b82f6"/>
                                <rect x="15" y="20" width="42" height="4" fill="#3b82f6"/>
                                <!-- Lines -->
                                <rect x="22" y="32" width="28" height="3" rx="1.5" fill="#94a3b8"/>
                                <rect x="22" y="40" width="20" height="3" rx="1.5" fill="#94a3b8"/>
                                <rect x="22" y="48" width="24" height="3" rx="1.5" fill="#94a3b8"/>
                                <!-- Orange accent box -->
                                <rect x="42" y="36" width="14" height="16" rx="2" fill="#f97316"/>
                                <rect x="45" y="39" width="8" height="2" rx="1" fill="white" opacity="0.8"/>
                                <rect x="45" y="43" width="8" height="2" rx="1" fill="white" opacity="0.8"/>
                                <rect x="45" y="47" width="5" height="2" rx="1" fill="white" opacity="0.8"/>
                            </svg>
                        </div>
                        <span class="info-icon-label">Informasi Setiap Saat</span>
                    </a>
                </div>

                <!-- Informasi Serta Merta -->
                <div class="col-auto">
                    <a href="{{ route('informasi.serta-merta') }}" class="info-icon-wrapper">
                        <div class="info-icon-circle">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Megaphone body -->
                                <path d="M18 30 L42 22 L42 55 L18 47 Z" fill="#e2e8f0"/>
                                <path d="M18 30 L42 22 L42 55 L18 47 Z" fill="#d1d5db"/>
                                <!-- Megaphone body highlight -->
                                <path d="M20 30 L40 23 L40 53 L20 46 Z" fill="#e5e7eb"/>
                                <!-- Handle/mouth piece -->
                                <rect x="12" y="31" width="8" height="15" rx="3" fill="#9ca3af"/>
                                <!-- Bell end -->
                                <ellipse cx="45" cy="38.5" rx="4" ry="16.5" fill="#d1d5db"/>
                                <ellipse cx="45" cy="38.5" rx="3" ry="14" fill="#e5e7eb"/>
                                <!-- String/cord -->
                                <path d="M20 47 L22 60 L28 60 L26 47" fill="#9ca3af"/>
                                <!-- Sound waves -->
                                <path d="M52 28 Q58 34 58 38.5 Q58 43 52 49" stroke="#fbbf24" stroke-width="3" fill="none" stroke-linecap="round"/>
                                <path d="M55 23 Q64 31 64 38.5 Q64 46 55 54" stroke="#fbbf24" stroke-width="2.5" fill="none" stroke-linecap="round" opacity="0.6"/>
                            </svg>
                        </div>
                        <span class="info-icon-label">Informasi Serta Merta</span>
                    </a>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider-line"></div>
        </div>
    </section>

    <!-- ===== ADA PERTANYAAN SECTION ===== -->
    <section class="ada-pertanyaan-section">
        <div class="container">
            <h2>Ada Pertanyaan?</h2>
            <a href="{{ route('permohonan.form') }}" class="btn-permohonan">
                Ajukan Permohonan Informasi Publik
            </a>
        </div>
    </section>

    <div class="container py-5">
        <section class="mb-5">
            <h2 class="section-title">Artikel & Dokumentasi Kegiatan</h2>
            <div class="row g-4">
                @forelse($artikel as $item)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="Berita">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                            <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 120) }}</p>
                            <a href="#" class="btn btn-link p-0 text-decoration-none fw-bold" style="color: #d4af37;">
                                Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">Belum ada artikel yang dipublikasikan.</div>
                @endforelse
            </div>
        </section>

        <div class="row pt-4">
            <div class="col-md-8 mb-5">
                <h2 class="section-title">{{ $settings['video_title'] ?? 'Video Layanan Informasi' }}</h2>
                <div class="ratio ratio-16x9 card">
                    <iframe src="{{ $settings['video_url'] ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ' }}" title="Video Layanan" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <h2 class="section-title">Kontak PPID</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-envelope me-2"></i>Email</h5>
                        <p class="card-text">ppid@pktj.ac.id</p>
                        
                        <h5 class="card-title"><i class="fas fa-phone me-2"></i>Telepon</h5>
                        <p class="card-text">(021) 1234-5678</p>
                        
                        <h5 class="card-title"><i class="fas fa-map-marker-alt me-2"></i>Alamat</h5>
                        <p class="card-text">Jl. Pendidikan No. 123, Jakarta</p>
                        
                        <div class="mt-3">
                            <a href="{{ route('permohonan.form') }}" class="btn btn-warning btn-lg w-100">
                                <i class="fas fa-file-alt me-2"></i>Ajukan Permohonan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Tentang {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}</h5>
                    <p>{{ $settings['ppid_deskripsi'] ?? 'Pejabat Pengelola Informasi dan Dokumentasi Politeknik Penerbangan Indonesia Jakarta' }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('profil.ppid.html') }}">Profil PPID</a></li>
                        <li><a href="{{ route('informasi.berkala') }}">Informasi Publik</a></li>
                        <li><a href="{{ route('faq.public') }}">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <p><i class="fas fa-envelope me-2"></i> ppid@pktj.ac.id</p>
                    <p><i class="fas fa-phone me-2"></i> (021) 1234-5678</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Pendidikan No. 123, Jakarta</p>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdownMenu = this.nextElementSibling;
                    
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== dropdownMenu) {
                            menu.style.display = 'none';
                        }
                    });
                    
                    // Toggle current dropdown
                    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.matches('.dropdown-toggle') && !e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.display = 'none';
                    });
                }
            });
        });
    </script>
</body>
</html>
