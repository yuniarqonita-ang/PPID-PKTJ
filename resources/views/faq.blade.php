@php $settings = \App\Models\Dashboard::pluck('value', 'key')->toArray(); @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ — Pertanyaan yang Sering Diajukan - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #004a99;
            --secondary-gold: #ffc107;
            --dark-blue: #003366;
            --glass-white: rgba(255, 255, 255, 0.9);
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
            top: -20%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 193, 7, 0.1);
            border-radius: 50%;
            filter: blur(100px);
        }

        /* Glassmorphism Card */
        .faq-container {
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
            padding: 50px;
        }

        /* Accordion Custom Styling */
        .accordion-item {
            border: none;
            background: transparent;
            margin-bottom: 15px;
        }

        .accordion-button {
            background: white;
            border-radius: 20px !important;
            padding: 20px 25px;
            font-weight: 700;
            color: var(--primary-blue);
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .accordion-button:not(.collapsed) {
            background: var(--primary-blue);
            color: white;
            box-shadow: 0 10px 25px rgba(0, 74, 153, 0.2);
            transform: scale(1.01);
        }

        .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23004a99'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .accordion-body {
            background: white;
            border-radius: 0 0 20px 20px;
            padding: 25px;
            margin-top: -10px;
            border: 1px solid #e2e8f0;
            border-top: none;
            color: #475569;
            line-height: 1.8;
            font-size: 15px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* Contact Section Premium */
        .contact-premium {
            background: #f8fafc;
            border-radius: 24px;
            padding: 40px;
            border: 1px solid #e2e8f0;
            margin-top: 40px;
        }

        .contact-icon-box {
            width: 50px;
            height: 50px;
            background: var(--primary-blue);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .glass-card { padding: 30px 20px; }
            .hero-premium { padding: 80px 0 140px; }
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

    <!-- Hero Section -->
    <section class="hero-premium">
        <div class="container text-center animate-up">
            <div class="d-inline-flex align-items-center gap-2 px-4 py-2 bg-white/10 rounded-full mb-4 border border-white/20 backdrop-blur-md">
                <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
                <span class="text-xs font-black uppercase tracking-[3px]">Help Center</span>
            </div>
            <h1 class="display-3 fw-black mb-3 text-white">FREQUENTLY ASKED <span style="color: var(--secondary-gold)">QUESTIONS</span></h1>
            <p class="lead fw-medium opacity-90 max-w-2xl mx-auto text-white">
                Temukan jawaban cepat atas pertanyaan Anda mengenai layanan informasi publik di PPID PKTJ.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container faq-container">
        <div class="glass-card animate-up" style="animation-delay: 0.2s;">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    
                    <div class="text-center mb-5">
                        <h2 class="h4 fw-black text-primary uppercase tracking-tight mb-2">Pusat Bantuan PPID</h2>
                        <div class="w-20 h-1 bg-warning mx-auto rounded-full"></div>
                    </div>

                    @if($faqs->count() > 0)
                        <div class="accordion" id="faqAccordion">
                            @foreach($faqs as $index => $faq)
                                <div class="accordion-item animate-up" style="animation-delay: {{ 0.1 * ($index + 1) }}s;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" 
                                                data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                                            <i class="fas fa-question-circle me-3 opacity-50"></i>
                                            {{ $faq->pertanyaan }}
                                        </button>
                                    </h2>
                                    <div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                                         data-bs-parent="#faqAccordion">
                                        <div class="accordion-body prose max-w-none">
                                            {!! $faq->jawaban !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-question-circle fa-5x text-slate-200 mb-4"></i>
                            <h3 class="h4 fw-black text-muted">Belum ada FAQ tersedia.</h3>
                            <p class="text-secondary">Tim kami sedang menyiapkan daftar pertanyaan populer untuk Anda.</p>
                        </div>
                    @endif

                    <!-- Contact Box -->
                    <div class="contact-premium animate-up" style="animation-delay: 0.5s;">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h3 class="h4 fw-black text-primary mb-3">Tidak Menemukan Jawaban?</h3>
                                <p class="text-secondary mb-4 font-medium">Jika pertanyaan Anda tidak terdaftar di sini, silakan hubungi layanan bantuan kami.</p>
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="/profil/kontak" class="btn btn-primary px-4 py-3 rounded-xl fw-bold border-0 shadow-lg" style="background-color: var(--primary-blue)">
                                        <i class="fas fa-envelope me-2"></i> Hubungi Kami
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-5 mt-4 mt-md-0">
                                <div class="p-4 bg-white rounded-3xl border border-blue-50 shadow-sm">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-amber-50 text-warning rounded-xl d-flex align-items-center justify-center">
                                            <i class="fas fa-headset"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Hotline PPID</p>
                                            <p class="text-sm font-bold text-primary">Tersedia di Jam Kerja</p>
                                        </div>
                                    </div>
                                    <p class="text-xs text-secondary leading-relaxed italic">
                                        "Melayani dengan transparansi dan akuntabilitas untuk keterbukaan informasi publik."
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
