<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil PPID - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; }
        .page-title { color: #004a99; font-size: 32px; font-weight: bold; text-transform: uppercase; margin-bottom: 30px; }
        .content-box { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); line-height: 1.8; }
        .content-box img { max-width: 100%; height: auto; margin-top: 20px; border-radius: 8px; }
    </style>
</head>
<body>
    @include('navigation')
    <div class="container py-5">
        <h1 class="page-title">{{ $profil->judul ?? 'Profil PPID' }}</h1>
        <div class="content-box">
            @if($profil)
                @if($profil->konten_pembuka)
                    <div class="mb-4">{!! $profil->konten_pembuka !!}</div>
                @endif
                
                @if($profil->gambar)
                    <img src="{{ asset('storage/' . $profil->gambar) }}" alt="{{ $profil->judul }}">
                @endif
                
                @if($profil->judul_sub)
                    <h3 class="mt-4 mb-3">{{ $profil->judul_sub }}</h3>
                @endif
                
                @if($profil->konten_detail)
                    <div>{!! $profil->konten_detail !!}</div>
                @endif
            @else
                <p class="text-muted">Konten profil PPID belum tersedia.</p>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
