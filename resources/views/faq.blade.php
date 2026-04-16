<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        .navbar {
            background-color: #004a99 !important;
            border-bottom: 3px solid #ffc107;
        }

        .navbar-brand img {
            height: 50px;
            margin-right: 12px;
        }

        @media (min-width: 992px) {
            .nav-item.dropdown:hover .dropdown-menu {
                display: block !important;
                margin-top: 0;
            }
        }

        .dropdown-menu {
            z-index: 1050 !important;
        }

        .hero-section {
            background: linear-gradient(135deg, #1a3a52 0%, #2d5f8d 50%, #d4af37 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .hero-content { position: relative; z-index: 1; }

        .page-title {
            color: #004a99;
            font-size: 32px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
            border-bottom: 3px solid #004a99;
            display: inline-block;
            padding-bottom: 10px;
        }

        .content-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .section-title {
            color: #004a99;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .accordion-button {
            background-color: #f8f9fa !important;
            color: #004a99 !important;
            font-weight: 600;
            border: 2px solid #d4af37;
        }

        .accordion-button:not(.collapsed) {
            background-color: #d4af37 !important;
            color: #1a3a52 !important;
        }

        .accordion-button:focus { box-shadow: none; }

        .accordion-body {
            background-color: #f8f9fa;
            border: 1px solid #d4af37;
        }

        .faq-category {
            background: linear-gradient(135deg, #004a99 0%, #0066cc 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .faq-category i {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .contact-info {
            background: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #d4af37;
        }

        .footer {
            background: #1a3a52;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }

        .btn-warning {
            background-color: #d4af37;
            border-color: #d4af37;
            color: #1a3a52;
            font-weight: 600;
        }

        .btn-warning:hover {
            background-color: #c9a227;
            border-color: #c9a227;
            color: #1a3a52;
        }

        .faq-empty {
            text-align: center;
            padding: 50px 20px;
        }

        .faq-empty i {
            font-size: 60px;
            color: #d4af37;
            margin-bottom: 20px;
            display: block;
        }
    </style>
</head>
<body>
    @include('navigation')

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="container">
                <h1 class="display-5 fw-bold mb-3">Frequently Asked Questions</h1>
                <p class="lead">Pertanyaan yang Sering Diajukan tentang PPID PKTJ</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">FAQ PPID PKTJ</h1>

        <div class="faq-category">
            <i class="fas fa-question-circle"></i>
            <h4>Pertanyaan Umum tentang PPID</h4>
        </div>

        @if($faqs->count() > 0)
        <div class="accordion" id="faqAccordion">
            @foreach($faqs as $index => $faq)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#faqItem{{ $faq->id }}">
                        <i class="fas fa-question me-2"></i>{{ $faq->pertanyaan }}
                    </button>
                </h2>
                <div id="faqItem{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                     data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        {!! $faq->jawaban !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="content-box faq-empty">
            <i class="fas fa-question-circle"></i>
            <h3 style="color: #004a99;">Belum Ada FAQ</h3>
            <p class="text-muted">FAQ akan segera diperbarui oleh tim PPID PKTJ.</p>
            <a href="/permohonan-informasi" class="btn btn-warning mt-3">
                <i class="fas fa-file-alt me-2"></i>Ajukan Pertanyaan Langsung
            </a>
        </div>
        @endif

        <div class="content-box mt-4">
            <h2 class="section-title">Tidak Menemukan Jawaban?</h2>
            <div class="contact-info">
                <h5><i class="fas fa-headset text-primary me-2"></i>Hubungi Kami</h5>
                <p>Jika pertanyaan Anda tidak terjawab dalam FAQ ini, silakan hubungi PPID PKTJ melalui:</p>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p><i class="fas fa-phone text-success me-2"></i><strong>Hotline:</strong>
                            @php $kontak = \App\Models\ProfilPpid::where('type','kontak')->first(); @endphp
                            {{ $kontak && $kontak->konten_pembuka ? strip_tags($kontak->konten_pembuka, '<br>') : '(Info kontak tersedia di halaman Kontak)' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-building text-warning me-2"></i><strong>Kantor:</strong> PPID PKTJ</p>
                        <p><i class="fas fa-clock text-danger me-2"></i><strong>Jam Kerja:</strong> 08:00 - 16:00 WIB</p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="/permohonan-informasi" class="btn btn-warning me-2">
                        <i class="fas fa-file-alt me-2"></i>Ajukan Permintaan Informasi
                    </a>
                    <a href="/profil/kontak" class="btn btn-outline-primary">
                        <i class="fas fa-map-marker-alt me-2"></i>Lihat Lokasi Kantor
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
