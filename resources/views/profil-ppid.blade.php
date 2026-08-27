<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Profil PPID' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
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

        .text-justify { text-align: justify; }

        .image-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            margin: 30px 0;
        }

        .btn-download {
            background: var(--primary-blue);
            color: white;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 700;
            text-transform: uppercase;
            transition: all 0.3s;
            border: none;
        }

        .btn-download:hover {
            background: #003770;
            transform: translateY(-3px);
            color: white;
            box-shadow: 0 10px 20px rgba(0, 74, 153, 0.2);
        }

    </style>
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
        <div class="container hero-content">
            <h1 class="display-4 fw-bold outfit uppercase mb-3">{{ $profil->judul ?? 'Profil PPID' }}</h1>
            <p class="lead opacity-75">{{ $profil->tagline_hero ?? 'Mengenal Lebih Dekat Pejabat Pengelola Informasi dan Dokumentasi' }}</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="content-card" data-aos="fade-up" data-aos-delay="100">
            @if($profil)
                @php
                    $videoUrl = $settings['profil_youtube_link'] ?? null;
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

                <div class="rich-content">
                    @if(!empty($profil->konten_pembuka))
                        <div class="text-justify mb-4">
                            {!! $profil->konten_pembuka !!}
                        </div>
                    @else
                        <div class="text-justify mb-4" style="line-height: 1.8;">
                            <p>Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana Politeknik Keselamatan Transportasi Jalan (PKTJ) dibentuk sebagai wujud komitmen nyata institusi dalam mengimplementasikan keterbukaan informasi publik sesuai amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Peraturan Komisi Informasi (PerKI) Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik, serta Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan.</p>
                            <p>Sebagai Unit Pelaksana Teknis (UPT) Pendidikan Tinggi Vokasi di bawah naungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan, PKTJ menetapkan struktur PPID Pelaksana UPT melalui Surat Keputusan Direktur PKTJ. Pembentukan ini bertujuan memberikan kepastian hak bagi masyarakat, pemohon informasi, dan seluruh pemangku kepentingan untuk memperoleh informasi publik yang cepat, akurat, transparan, dan bebas biaya (Rp 0).</p>
                        </div>
                    @endif
                    
                    <h3 class="outfit fw-bold text-dark mb-3 mt-5" style="color: #004a99 !important;">
                        <i class="fas fa-bullseye me-2 text-primary"></i> {{ $profil->judul_sub ?? 'Peran & Komitmen Pelayanan PPID PKTJ' }}
                    </h3>
                    
                    @if(!empty($profil->konten_detail))
                        <div class="text-justify">
                            {!! $profil->konten_detail !!}
                        </div>
                    @else
                        <div class="text-justify" style="line-height: 1.8;">
                            <p>Dalam menjalankan perannya, PPID Pelaksana PKTJ berfungsi sebagai koordinator utama pengelolaan dan pelayanan dokumentasi informasi publik yang mendukung penyelenggaraan tridharma perguruan tinggi vokasi keselamatan transportasi jalan, pelaksanaan uji kompetensi teknis, penelitian keselamatan transportasi, serta pengelolaan tata kelola keuangan Badan Layanan Umum (BLU) yang bersih, transparan, dan akuntabel.</p>
                            <p>Pelayanan informasi publik di lingkungan PKTJ diselenggarakan secara terpadu melalui dua saluran: <strong>Layanan Daring (Online)</strong> melalui portal resmi mandiri yang ramah disabilitas (dilengkapi fitur audio Text-to-Speech, mode kontras, dan video bahasa isyarat), serta <strong>Layanan Luring (Offline)</strong> melalui Meja Layanan Terpadu PPID di Kampus I PKTJ Tegal, Jl. Perintis Kemerdekaan No. 17, Kota Tegal, Jawa Tengah.</p>
                        </div>
                    @endif
                    
                    @if(!empty($profil->gambar))
                        <div class="image-container my-4">
                            <img src="{{ asset('storage/' . $profil->gambar) }}" alt="{{ $profil->judul }}" class="w-100 h-auto rounded-4 shadow-sm">
                        </div>
                    @endif
                    
                    @if(!empty($profil->link_dokumen) && is_previewable($profil->link_dokumen))
                        <div class="mt-5 text-center">
                            <a href="{{ route('preview.dokumen', ['file' => $profil->link_dokumen, 'title' => 'Dokumen Profil Lengkap']) }}" class="btn-download btn-lg">
                                <i class="fas fa-file-pdf me-2"></i> Lihat Dokumen Profil Lengkap
                            </a>
                        </div>
                    @endif
                </div>

                <div class="mt-5 pt-4 border-top">
                    @if(!empty($profil->gambaran))
                        <div class="rich-content text-justify">
                            {!! $profil->gambaran !!}
                        </div>
                    @else
                        <div class="alert alert-primary d-flex align-items-center rounded-4 border-0 p-3.5 mb-0" style="background: #eef2ff; color: #002b5c;">
                            <i class="fas fa-shield-halved fa-2x me-3 text-primary"></i>
                            <div>
                                <strong>Standar Pelayanan PPID PKTJ:</strong> Berkomitmen memberikan pelayanan informasi publik yang cepat, tepat waktu, biaya ringan (Rp 0), serta mudah dijangkau oleh seluruh lapisan masyarakat termasuk penyandang disabilitas.
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="rich-content">
                    <div class="text-justify mb-4" style="line-height: 1.8;">
                        <p>Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana Politeknik Keselamatan Transportasi Jalan (PKTJ) dibentuk sebagai wujud komitmen nyata institusi dalam mengimplementasikan keterbukaan informasi publik sesuai amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Peraturan Komisi Informasi (PerKI) Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik, serta Peraturan Menteri Perhubungan Nomor PM 46 Tahun 2018 tentang Pedoman Pengelolaan Informasi dan Dokumentasi di Lingkungan Kementerian Perhubungan.</p>
                        <p>Sebagai Unit Pelaksana Teknis (UPT) Pendidikan Tinggi Vokasi di bawah naungan Badan Pengembangan Sumber Daya Manusia Perhubungan (BPSDMP) Kementerian Perhubungan, PKTJ menetapkan struktur PPID Pelaksana UPT melalui Surat Keputusan Direktur PKTJ. Pembentukan ini bertujuan memberikan kepastian hak bagi masyarakat, pemohon informasi, dan seluruh pemangku kepentingan untuk memperoleh informasi publik yang cepat, akurat, transparan, dan bebas biaya (Rp 0).</p>
                    </div>

                    <h3 class="outfit fw-bold text-dark mb-3 mt-5" style="color: #004a99 !important;">
                        <i class="fas fa-bullseye me-2 text-primary"></i> Peran & Komitmen Pelayanan PPID PKTJ
                    </h3>

                    <div class="text-justify" style="line-height: 1.8;">
                        <p>Dalam menjalankan perannya, PPID Pelaksana PKTJ berfungsi sebagai koordinator utama pengelolaan dan pelayanan dokumentasi informasi publik yang mendukung penyelenggaraan tridharma perguruan tinggi vokasi keselamatan transportasi jalan, pelaksanaan uji kompetensi teknis, penelitian keselamatan transportasi, serta pengelolaan tata kelola keuangan Badan Layanan Umum (BLU) yang bersih, transparan, dan akuntabel.</p>
                        <p>Pelayanan informasi publik di lingkungan PKTJ diselenggarakan secara terpadu melalui dua saluran: <strong>Layanan Daring (Online)</strong> melalui portal resmi mandiri yang ramah disabilitas (dilengkapi fitur audio Text-to-Speech, mode kontras, dan video bahasa isyarat), serta <strong>Layanan Luring (Offline)</strong> melalui Meja Layanan Terpadu PPID di Kampus I PKTJ Tegal, Jl. Perintis Kemerdekaan No. 17, Kota Tegal, Jawa Tengah.</p>
                    </div>

                    <div class="mt-5 pt-4 border-top">
                        <div class="alert alert-primary d-flex align-items-center rounded-4 border-0 p-3.5 mb-0" style="background: #eef2ff; color: #002b5c;">
                            <i class="fas fa-shield-halved fa-2x me-3 text-primary"></i>
                            <div>
                                <strong>Standar Pelayanan PPID PKTJ:</strong> Berkomitmen memberikan pelayanan informasi publik yang cepat, tepat waktu, biaya ringan (Rp 0), serta mudah dijangkau oleh seluruh lapisan masyarakat termasuk penyandang disabilitas.
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const dropdownItem = this.closest('.dropdown');
                    const dropdownMenu = dropdownItem.querySelector('.dropdown-menu');
                    
                    if (dropdownMenu.style.display === 'block') {
                        dropdownMenu.style.display = 'none';
                    } else {
                        document.querySelectorAll('.dropdown-menu').forEach(menu => {
                            menu.style.display = 'none';
                        });
                        dropdownMenu.style.display = 'block';
                    }
                });
            });
            
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.style.display = 'none';
                    });
                }
            });
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
