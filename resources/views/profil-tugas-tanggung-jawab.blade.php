<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->judul ?? 'Tugas dan Tanggung Jawab PPID' }} - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; scroll-behavior: smooth; overflow-x: hidden; }
        .navbar { background-color: #004a99 !important; border-bottom: 3px solid #ffc107; }
        .navbar-brand img { height: 50px; margin-right: 12px; }
        @media (min-width: 992px) { .nav-item.dropdown:hover .dropdown-menu { display: block !important; margin-top: 0; } }
        .dropdown-menu { z-index: 1050 !important; }
        .hero-section { background: linear-gradient(135deg, #1a3a52 0%, #2d5f8d 50%, #d4af37 100%); color: white; padding: 100px 0; text-align: center; position: relative; overflow: hidden; }
        .hero-section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); opacity: 0.1; }
        .hero-content { position: relative; z-index: 1; }
        .page-title { color: #004a99; font-size: 32px; font-weight: bold; text-transform: uppercase; margin-bottom: 30px; border-bottom: 3px solid #004a99; display: inline-block; padding-bottom: 10px; }
        .content-box { background-color: white; padding: 30px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .section-title { color: #004a99; font-size: 28px; font-weight: bold; margin-bottom: 20px; }
        .profil-content { line-height: 1.8; color: #333; }
        .footer { background: #1a3a52; color: white; padding: 40px 0; margin-top: 60px; }
    </style>
</head>
<body>
    @include('navigation')

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="container">
                <h1 class="display-5 fw-bold mb-3">{{ $profil->judul ?? 'Tugas dan Tanggung Jawab PPID' }}</h1>
                <p class="lead">{{ $profil->tagline_hero ?? 'Pejabat Pengelola Informasi dan Dokumentasi' }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">{{ $profil->judul ?? 'Tugas dan Tanggung Jawab PPID' }}</h1>

        @if($profil && $profil->konten_pembuka)
            <div class="content-box">
                <div class="profil-content">{!! $profil->konten_pembuka !!}</div>
            </div>
        @endif

        @if($profil && $profil->judul_sub)
            <div class="content-box">
                <h2 class="section-title">{{ $profil->judul_sub }}</h2>
                @if($profil->konten_detail)
                    <div class="profil-content">{!! $profil->konten_detail !!}</div>
                @endif
            </div>
        @endif

        @if($profil && $profil->gambaran)
            <div class="content-box">
                <div class="profil-content">{!! $profil->gambaran !!}</div>
            </div>
        @endif

        @if($profil && $profil->additional_sections)
            @foreach($profil->additional_sections as $section)
                <div class="content-box">
                    @if($section['title'] ?? null)
                        <h2 class="section-title">{{ $section['title'] }}</h2>
                    @endif
                    @if($section['content'] ?? null)
                        <div class="profil-content">{!! $section['content'] !!}</div>
                    @endif
                </div>
            @endforeach
        @endif

        @if(!$profil || (!$profil->konten_pembuka && !$profil->gambaran && !$profil->konten_detail))
            <div class="content-box text-center py-4">
                <i class="fas fa-tasks" style="font-size:40px; color:#6c757d; margin-bottom:15px; display:block;"></i>
                <p class="text-muted">Konten halaman ini sedang disiapkan oleh admin. Silakan cek kembali nanti.</p>
            </div>
        @endif
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
