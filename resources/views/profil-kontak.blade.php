<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Hubungi Kami' }} - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004A99' }};
            --primary-dark: #002b5c;
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#FFC107' }};
            --bg-light: #f3f7fa;
            --card-shadow: 0 20px 40px rgba(0, 43, 92, 0.06);
            --transition-speed: 0.3s;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-light); 
            color: #334155;
            line-height: 1.6;
        }

        .outfit { font-family: 'Outfit', sans-serif; }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 43, 92, 0.85), rgba(0, 74, 153, 0.85)), 
                        url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            color: white;
            text-align: center;
            position: relative;
        }

        /* Glassmorphism Hero Title Box */
        .hero-card-outline {
            display: inline-block;
            border: 2.5px solid rgba(255, 255, 255, 0.9);
            padding: 2.5rem 4rem;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            max-width: 90%;
        }

        .hero-card-outline h1 {
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        /* Content Card */
        .main-container {
            margin-top: -50px;
            position: relative;
            z-index: 30;
        }

        .premium-card {
            background: white;
            border-radius: 32px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0, 74, 153, 0.05);
            overflow: hidden;
        }

        .section-header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 74, 153, 0.08);
            color: var(--primary-blue);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .section-title {
            color: var(--primary-dark);
            font-weight: 900;
            font-size: 2.5rem;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }

        /* Social Media Section */
        .social-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
            margin-top: 35px;
        }

        .social-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 15px;
            border-radius: 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #475569;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .social-item i {
            font-size: 28px;
            margin-bottom: 12px;
            transition: transform var(--transition-speed) ease;
        }

        /* Social Brand Colors on Hover */
        .social-item.instagram:hover {
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90%);
            border-color: transparent;
            color: white;
        }
        .social-item.facebook:hover {
            background: #1877F2;
            border-color: transparent;
            color: white;
        }
        .social-item.twitter:hover {
            background: #000000;
            border-color: transparent;
            color: white;
        }
        .social-item.youtube:hover {
            background: #FF0000;
            border-color: transparent;
            color: white;
        }
        .social-item.linktree:hover {
            background: #39E09B;
            border-color: transparent;
            color: white;
        }
        .social-item.whatsapp:hover {
            background: #25D366;
            border-color: transparent;
            color: white;
        }
        .social-item.tiktok:hover {
            background: #010101;
            border-color: transparent;
            color: white;
        }
        .social-item.website:hover {
            background: var(--primary-blue);
            border-color: transparent;
            color: white;
        }

        .social-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .social-item:hover i {
            transform: scale(1.18);
        }

        /* Form Styling */
        .form-card {
            background: #f8fafc;
            border-radius: 24px;
            padding: 40px;
            border: 1px solid #e2e8f0;
            height: 100%;
        }

        .form-floating > .form-control:focus, 
        .form-floating > .form-control:not(:placeholder-shown) {
            padding-top: 1.625rem;
            padding-bottom: .625rem;
        }

        .form-control, .form-select {
            border-radius: 16px;
            border: 1.5px solid #e2e8f0;
            padding: 14px 20px;
            font-size: 14px;
            font-weight: 500;
            background-color: white;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.1);
            background-color: white;
        }

        /* Campus Map Cards */
        .campus-section-title {
            color: var(--primary-dark);
            font-weight: 900;
            font-size: 2rem;
            text-align: center;
            margin: 60px 0 30px;
            position: relative;
        }
        
        .campus-section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--secondary-gold);
            margin: 12px auto 0;
            border-radius: 10px;
        }

        .campus-card {
            background: white;
            border-radius: 28px;
            border: 1px solid rgba(0, 43, 92, 0.05);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .campus-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 43, 92, 0.09);
        }

        .campus-badge {
            background: var(--primary-blue);
            color: white;
            padding: 6px 14px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            border-radius: 50px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 15px;
        }

        .campus-info-list {
            list-style: none;
            padding: 0;
            margin: 25px 0 0;
        }

        .campus-info-list li {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .campus-info-list li i {
            color: var(--primary-blue);
            font-size: 18px;
            width: 24px;
            text-align: center;
            margin-top: 3px;
        }

        .campus-info-list li a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .campus-info-list li a:hover {
            color: var(--primary-blue);
        }

        .map-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            min-height: 280px;
        }

        .map-wrapper iframe {
            width: 100%;
            height: 100%;
            min-height: 280px;
            border: 0;
            display: block;
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--primary-blue), #003770);
            color: white;
            font-weight: 800;
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 16px 30px;
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 20px rgba(0, 74, 153, 0.2);
            transition: all var(--transition-speed) ease;
        }

        .btn-premium:hover {
            background: linear-gradient(135deg, #0056b3, var(--primary-blue));
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(0, 74, 153, 0.3);
            color: white;
        }

        .btn-premium:active {
            transform: translateY(0);
        }

        .captcha-box {
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .captcha-label {
            font-weight: 700;
            font-size: 14px;
            color: var(--primary-dark);
            margin: 0;
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

    <!-- Hero Banner -->
    <div class="hero-section">
        <div class="container hero-content">
            <div class="hero-card-outline animate__animated animate__fadeInDown">
                <h1 class="display-5 fw-bold outfit uppercase mb-2 text-white">{{ $profil->judul ?? 'Hubungi Kami' }}</h1>
                <p class="lead opacity-90 mb-0 font-medium">{{ $profil->tagline_hero ?? 'Kami Siap Melayani Kebutuhan Informasi Anda' }}</p>
            </div>
        </div>
    </div>

    <div class="container main-container mb-5">
        <div class="premium-card p-4 p-md-5 animate__animated animate__fadeInUp">
            
            <!-- Success Alert -->
            @if(session('success_message'))
                <div class="alert alert-success border-0 rounded-4 p-4 mb-5 shadow-sm d-flex align-items-center gap-3 animate__animated animate__bounceIn" style="background-color: #ecfdf5; color: #065f46;">
                    <i class="fa-solid fa-circle-check fs-2 text-emerald-500" style="color: #10b981;"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Berhasil Terkirim</h5>
                        <p class="mb-0 text-sm opacity-90">{{ session('success_message') }}</p>
                    </div>
                </div>
            @endif

            <div class="row g-5">
                <!-- Left Column: Media & Channels -->
                <div class="col-lg-5">
                    <div class="pe-xl-4">
                        <span class="section-header-badge">
                            <i class="fa-solid fa-paper-plane"></i> PPID PKTJ Tegal
                        </span>
                        <h2 class="section-title outfit">Informasi, Saran & Pengaduan</h2>
                        
                        <div class="text-slate-500 mb-4 font-medium">
                            {!! $profil->konten_pembuka ?? '<p>Silakan kirimkan pertanyaan, permohonan informasi, saran, atau pengaduan Anda melalui form pesan atau hubungi kami lewat jejaring sosial resmi kami di bawah ini.</p>' !!}
                        </div>

                        <!-- Social Media Icons Grid -->
                        @php
                            $instagram = !empty($settings['kontak_instagram_link']) && $settings['kontak_instagram_link'] !== '#' ? $settings['kontak_instagram_link'] : (!empty($settings['instagram_link']) && $settings['instagram_link'] !== '#' ? $settings['instagram_link'] : 'https://www.instagram.com/pktj_tegal/');
                            
                            $facebook = !empty($settings['kontak_facebook_link']) && $settings['kontak_facebook_link'] !== '#' ? $settings['kontak_facebook_link'] : (!empty($settings['facebook_link']) && $settings['facebook_link'] !== '#' ? $settings['facebook_link'] : 'https://www.facebook.com/PKTJTegal/');
                            
                            $twitter = !empty($settings['kontak_twitter_link']) && $settings['kontak_twitter_link'] !== '#' ? $settings['kontak_twitter_link'] : (!empty($settings['twitter_link']) && $settings['twitter_link'] !== '#' ? $settings['twitter_link'] : 'https://x.com/pktjtegal');
                            
                            $youtube = !empty($settings['kontak_youtube_link']) && $settings['kontak_youtube_link'] !== '#' ? $settings['kontak_youtube_link'] : (!empty($settings['youtube_link']) && $settings['youtube_link'] !== '#' ? $settings['youtube_link'] : 'https://www.youtube.com/channel/UC9BbdnU-cczfaZ5FHulYPZA');
                            
                            $linktree = !empty($settings['kontak_linktree_link']) && $settings['kontak_linktree_link'] !== '#' ? $settings['kontak_linktree_link'] : (!empty($settings['linktree_link']) && $settings['linktree_link'] !== '#' ? $settings['linktree_link'] : 'https://linktr.ee/pktj_tegal');
                            
                            $whatsapp = !empty($settings['kontak_whatsapp_link']) && $settings['kontak_whatsapp_link'] !== '#' ? $settings['kontak_whatsapp_link'] : (!empty($settings['whatsapp_link']) && $settings['whatsapp_link'] !== '#' ? $settings['whatsapp_link'] : 'https://api.whatsapp.com/send/?phone=6281234700230&text&type=phone_number&app_absent=0');
                            
                            $tiktok = !empty($settings['kontak_tiktok_link']) && $settings['kontak_tiktok_link'] !== '#' ? $settings['kontak_tiktok_link'] : (!empty($settings['tiktok_link']) && $settings['tiktok_link'] !== '#' ? $settings['tiktok_link'] : 'https://www.tiktok.com/@pktj_tegal');
                            
                            $website = !empty($settings['kontak_website_link']) && $settings['kontak_website_link'] !== '#' ? $settings['kontak_website_link'] : (!empty($settings['website_link']) && $settings['website_link'] !== '#' ? $settings['website_link'] : 'https://pktj.ac.id');
                        @endphp
                        
                        <h5 class="outfit fw-extrabold text-slate-800 uppercase tracking-wider mb-3 mt-5" style="font-size: 11px;">Ikuti Saluran Resmi Kami</h5>
                        <div class="social-grid">
                            <!-- Instagram -->
                            <a href="{{ $instagram }}" target="_blank" class="social-item instagram">
                                <i class="fa-brands fa-instagram text-pink-600"></i>
                                <span>Instagram</span>
                            </a>
                            <!-- Facebook -->
                            <a href="{{ $facebook }}" target="_blank" class="social-item facebook">
                                <i class="fa-brands fa-facebook-f text-blue-600"></i>
                                <span>Facebook</span>
                            </a>
                            <!-- Twitter/X -->
                            <a href="{{ $twitter }}" target="_blank" class="social-item twitter">
                                <i class="fa-brands fa-x-twitter text-slate-900"></i>
                                <span>Twitter / X</span>
                            </a>
                            <!-- YouTube -->
                            <a href="{{ $youtube }}" target="_blank" class="social-item youtube">
                                <i class="fa-brands fa-youtube text-red-600"></i>
                                <span>YouTube</span>
                            </a>
                            <!-- Linktree -->
                            <a href="{{ $linktree }}" target="_blank" class="social-item linktree">
                                <i class="fa-solid fa-tree text-green-500"></i>
                                <span>Linktree</span>
                            </a>
                            <!-- WhatsApp -->
                            <a href="{{ $whatsapp }}" target="_blank" class="social-item whatsapp">
                                <i class="fa-brands fa-whatsapp text-emerald-500"></i>
                                <span>WhatsApp</span>
                            </a>
                            <!-- TikTok -->
                            <a href="{{ $tiktok }}" target="_blank" class="social-item tiktok">
                                <i class="fa-brands fa-tiktok text-slate-950"></i>
                                <span>TikTok</span>
                            </a>
                            <!-- Website -->
                            <a href="{{ $website }}" target="_blank" class="social-item website">
                                <i class="fa-solid fa-globe text-blue-500"></i>
                                <span>Website</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Form -->
                <div class="col-lg-7">
                    <div class="form-card">
                        <h4 class="outfit fw-black text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-pen-to-square text-[#ffc107]"></i> Formulir Pesan
                        </h4>
                        
                        <form action="{{ route('profil.kontak.submit') }}" method="POST">
                            @csrf
                            
                            @php
                                $num1 = rand(2, 9);
                                $num2 = rand(2, 9);
                                $answer = $num1 + $num2;
                            @endphp
                            <input type="hidden" name="captcha_answer" value="{{ $answer }}">

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label text-xs font-bold text-slate-500 uppercase">Nama Lengkap</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" required class="form-control" placeholder="Contoh: Budi Santoso">
                                    @error('nama') <p class="text-danger text-xs font-bold mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-xs font-bold text-slate-500 uppercase">Alamat Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="nama@email.com">
                                    @error('email') <p class="text-danger text-xs font-bold mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-xs font-bold text-slate-500 uppercase">Nomor Telepon</label>
                                    <input type="text" name="telepon" value="{{ old('telepon') }}" required class="form-control" placeholder="081234567xxx">
                                    @error('telepon') <p class="text-danger text-xs font-bold mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-xs font-bold text-slate-500 uppercase">Judul Pesan / Subjek</label>
                                    <input type="text" name="judul" value="{{ old('judul') }}" required class="form-control" placeholder="Informasi / Saran / Pengaduan">
                                    @error('judul') <p class="text-danger text-xs font-bold mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-xs font-bold text-slate-500 uppercase">Isi Pesan Lengkap</label>
                                    <textarea name="pesan" rows="5" required class="form-control" placeholder="Tuliskan detail pesan Anda di sini..."></textarea>
                                    @error('pesan') <p class="text-danger text-xs font-bold mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label text-xs font-bold text-slate-500 uppercase">Verifikasi Keamanan (Captcha)</label>
                                    <div class="captcha-box">
                                        <p class="captcha-label">Berapakah hasil dari <strong>{{ $num1 }} + {{ $num2 }}</strong> ?</p>
                                        <input type="number" name="captcha" required class="form-control" style="max-width: 150px;" placeholder="Jawaban...">
                                    </div>
                                    @error('captcha') <p class="text-danger text-xs font-bold mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="col-12 pt-2">
                                    <button type="submit" class="btn btn-premium w-100 py-3 shadow">
                                        <i class="fa-solid fa-paper-plane mr-2 text-[#ffc107]"></i> Kirim Pesan Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Campus Contact Cards (Kampus I & II) -->
        <h3 class="campus-section-title outfit">Lokasi Kampus Politeknik Keselamatan Transportasi Jalan</h3>
        
        <div class="row g-4 mt-2">
            <!-- Kampus I Card -->
            <div class="col-lg-6">
                <div class="campus-card">
                    <div class="row g-0 h-100">
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <span class="campus-badge">{{ $settings['kontak_kampus_1_nama'] ?? 'Kampus Perintis' }}</span>
                                <h4 class="outfit fw-black text-slate-800 mb-3" style="font-size: 18px; line-height: 1.3;">
                                    {{ $settings['kontak_kampus_1_nama'] ?? 'Politeknik Keselamatan Transportasi Jalan (Kampus Perintis)' }}
                                </h4>
                                <ul class="campus-info-list">
                                    <li>
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>{{ $settings['kontak_kampus_1_alamat'] ?? 'Jl. Perintis Kemerdekaan No. 17, Slerok, Tegal Timur, Tegal' }}</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-envelope"></i>
                                        <a href="mailto:{{ $settings['kontak_kampus_1_email'] ?? 'pktj@pktj.ac.id' }}">{{ $settings['kontak_kampus_1_email'] ?? 'pktj@pktj.ac.id' }}</a>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-phone"></i>
                                        <a href="tel:{{ $settings['kontak_kampus_1_telepon'] ?? '(0283) 351061' }}">{{ $settings['kontak_kampus_1_telepon'] ?? '(0283) 351061' }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="map-wrapper">
                                @if(isset($settings['kontak_kampus_1_map']) && !empty($settings['kontak_kampus_1_map']))
                                    {!! $settings['kontak_kampus_1_map'] !!}
                                @else
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.23846665793!2d109.1396263!3d-6.8687256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb797c0000001%3A0xbd8ffc1a1154737d!2sPoliteknik%20Keselamatan%20Transportasi%20Jalan!5e0!3m2!1sid!2sid!4v1717575000000!5m2!1sid!2sid" loading="lazy"></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kampus II Card -->
            <div class="col-lg-6">
                <div class="campus-card">
                    <div class="row g-0 h-100">
                        <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                            <div>
                                <span class="campus-badge" style="background-color: var(--secondary-gold); color: var(--primary-dark);">{{ $settings['kontak_kampus_2_nama'] ?? 'Kampus Margadana' }}</span>
                                <h4 class="outfit fw-black text-slate-800 mb-3" style="font-size: 18px; line-height: 1.3;">
                                    {{ $settings['kontak_kampus_2_nama'] ?? 'Politeknik Keselamatan Transportasi Jalan (Kampus Margadana)' }}
                                </h4>
                                <ul class="campus-info-list">
                                    <li>
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>{{ $settings['kontak_kampus_2_alamat'] ?? 'Jl. KH. Abdul Syukur No. 17, Margadana, Tegal' }}</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-envelope"></i>
                                        <a href="mailto:{{ $settings['kontak_kampus_2_email'] ?? 'pktj@pktj.ac.id' }}">{{ $settings['kontak_kampus_2_email'] ?? 'pktj@pktj.ac.id' }}</a>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-phone"></i>
                                        <a href="tel:{{ $settings['kontak_kampus_2_telepon'] ?? '(0283) 351061' }}">{{ $settings['kontak_kampus_2_telepon'] ?? '(0283) 351061' }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="map-wrapper">
                                @if(isset($settings['kontak_kampus_2_map']) && !empty($settings['kontak_kampus_2_map']))
                                    {!! $settings['kontak_kampus_2_map'] !!}
                                @else
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.077224213794!2d109.09886317578768!3d-6.882898767355088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb86a87799d19%3A0x644265697669d255!2sPKTJ%20Kampus%20I!5e0!3m2!1sid!2sid!4v1717575000000!5m2!1sid!2sid" loading="lazy"></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
