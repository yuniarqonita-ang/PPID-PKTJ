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

    <div class="container py-5">
        <section id="informasi-publik" class="mb-5">
            <h2 class="section-title">Informasi Publik</h2>
            <div class="row g-4">
                @forelse($dokumen as $doc)
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge me-2"><i class="fas fa-file-alt me-1"></i>Dokumen</span>
                                <small class="text-muted">{{ $doc->kategori }}</small>
                            </div>
                            <h6 class="fw-bold">{{ $doc->nama_dokumen }}</h6>
                            <a href="{{ asset('storage/'.$doc->file_path) }}" class="btn btn-outline-primary btn-sm mt-auto">
                                <i class="fas fa-eye me-1"></i>Lihat Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">Belum ada dokumen publik yang diunggah.</div>
                @endforelse
            </div>
        </section>

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
