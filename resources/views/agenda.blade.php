@php
    if (!isset($settings)) {
        $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray();
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Kegiatan - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
            --dark-blue: #003366;
            --glass-white: rgba(255, 255, 255, 0.9);
            --glass-blue: rgba(0, 74, 153, 0.05);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
            color: #1e293b;
            overflow-x: hidden;
        }

        h1, h2, h3, .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        /* Hero Section Premium */
        .hero-premium {
            background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
            padding: 100px 0 160px;
            position: relative;
            overflow: hidden;
            color: white;
            clip-path: ellipse(150% 100% at 50% 0%);
        }

        .hero-premium::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255, 193, 7, 0.1);
            border-radius: 50%;
            filter: blur(80px);
        }

        .hero-premium::after {
            content: '';
            position: absolute;
            bottom: 10%;
            right: 10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            filter: blur(60px);
        }

        /* Glassmorphism Card */
        .agenda-container {
            margin-top: -100px;
            position: relative;
            z-index: 10;
        }

        .glass-card {
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 74, 153, 0.15);
            padding: 40px;
        }

        /* Agenda Timeline / Cards */
        .agenda-card {
            background: white;
            border-radius: 24px;
            padding: 25px;
            margin-bottom: 25px;
            border-left: 6px solid var(--primary-blue);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            display: flex;
            gap: 25px;
            align-items: flex-start;
        }

        .agenda-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 74, 153, 0.1);
            border-left-color: var(--secondary-gold);
        }

        .agenda-date {
            min-width: 100px;
            text-align: center;
            background: #f8fafc;
            border-radius: 18px;
            padding: 15px 10px;
            border: 1px solid #e2e8f0;
        }

        .agenda-date .day {
            font-size: 32px;
            font-weight: 900;
            color: var(--primary-blue);
            line-height: 1;
            display: block;
        }

        .agenda-date .month {
            font-size: 14px;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .agenda-content h3 {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .agenda-content .details {
            color: #475569;
            font-size: 15px;
            line-height: 1.6;
        }

        .agenda-meta {
            display: flex;
            gap: 20px;
            margin-top: 15px;
            font-size: 13px;
            font-weight: 600;
            color: #94a3b8;
        }

        .agenda-meta span i {
            color: var(--secondary-gold);
            margin-right: 5px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 0;
        }

        .empty-icon {
            font-size: 80px;
            color: #e2e8f0;
            margin-bottom: 25px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @media (max-width: 768px) {
            .agenda-card {
                flex-direction: column;
                gap: 15px;
            }
            .agenda-date {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 10px;
            }
            .agenda-date .day { font-size: 24px; }
            .hero-premium { padding: 80px 0 140px; }
        }
    </style>
</head>
<body>
    @include('navigation')

    <!-- Hero Section -->
    <section class="hero-premium">
        <div class="container text-center animate-up">
            <div class="d-inline-flex align-items-center gap-2 px-4 py-2 bg-white/10 rounded-full mb-4 border border-white/20 backdrop-blur-md">
                <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
                <span class="text-xs font-black uppercase tracking-[3px]">Informasi Publik</span>
            </div>
            <h1 class="display-3 fw-black mb-3 text-white">AGENDA <span style="color: var(--secondary-gold)">KEGIATAN</span></h1>
            <p class="lead fw-medium opacity-90 max-w-2xl mx-auto text-white">
                Jadwal resmi dan rangkaian kegiatan PPID PKTJ dalam mewujudkan transparansi informasi publik.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container agenda-container">
        <div class="glass-card animate-up" style="animation-delay: 0.2s;">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <div>
                            <h2 class="h4 fw-black text-primary mb-1 uppercase tracking-tight">Daftar Agenda</h2>
                            <p class="text-muted small fw-bold">Menampilkan agenda terbaru dan yang akan datang</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-50 text-primary rounded-2xl d-flex align-items-center justify-content-center">
                            <i class="fas fa-calendar-alt fa-lg text-[#004a99]"></i>
                        </div>
                    </div>

                    @if($items->count() > 0)
                        <div class="agenda-list">
                            @foreach($items as $agenda)
                                <div class="agenda-card">
                                    <div class="agenda-date">
                                        <span class="day text-[#004a99]">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d') }}</span>
                                        <span class="month">{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('M') }}</span>
                                    </div>
                                    <div class="agenda-content flex-grow-1">
                                        <h3 class="text-[#004a99]">{{ $agenda->judul }}</h3>
                                        <div class="details prose max-w-none text-slate-600">
                                            {!! $agenda->konten !!}
                                        </div>
                                        <div class="agenda-meta">
                                            <span><i class="fas fa-clock text-[#ffc107]"></i> {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('Y') }}</span>
                                            @if(!empty($agenda->waktu))
                                                <span><i class="fas fa-clock text-[#ffc107]"></i> {{ $agenda->waktu }}</span>
                                            @endif
                                            <span><i class="fas fa-map-marker-alt text-[#ffc107]"></i> {{ $agenda->lokasi ?? $settings['ppid_nama'] ?? 'PPID PKTJ' }}</span>
                                        </div>
                                    </div>
                                    @if($agenda->gambar)
                                    <div class="agenda-image d-none d-md-block" style="width: 150px;">
                                        <img src="{{ asset('storage/' . $agenda->gambar) }}" alt="{{ $agenda->judul }}" class="img-fluid rounded-3 shadow-sm border border-2 border-white">
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <h3 class="h4 fw-black text-muted mb-2">Belum Ada Agenda</h3>
                            <p class="text-secondary opacity-75">Saat ini belum ada jadwal kegiatan resmi yang dipublikasikan.</p>
                            <a href="/" class="btn btn-primary px-5 py-3 rounded-xl fw-bold mt-4 shadow-lg border-0" style="background-color: var(--primary-blue)">
                                Kembali ke Beranda
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Footer Info Box -->
        <div class="row mt-5">
            <div class="col-lg-10 mx-auto">
                <div class="p-5 rounded-[2.5rem] bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-2xl relative overflow-hidden mb-5" style="background: linear-gradient(to right, #004a99, #006ccf);">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="h2 fw-black mb-3">Butuh Informasi Lebih Lanjut?</h3>
                            <p class="opacity-90 fw-medium">Anda dapat mengajukan permohonan informasi terkait kegiatan melalui formulir resmi kami.</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="/permohonan-informasi" class="btn btn-warning px-5 py-3 rounded-xl fw-black shadow-xl shadow-amber-500/20" style="background-color: #ffc107; border: none; color: #004a99;">
                                AJUKAN PERMOHONAN
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
