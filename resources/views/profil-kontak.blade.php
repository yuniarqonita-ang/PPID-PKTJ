<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak PPID - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; scroll-behavior: smooth; }
        @media (min-width: 992px) { .nav-item.dropdown:hover .dropdown-menu { display: block !important; margin-top: 0; } }
        .dropdown-menu { z-index: 1050 !important; }
        .page-title { color: #004a99; font-size: 32px; font-weight: bold; text-transform: uppercase; margin-bottom: 30px; }
        .content-box { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); line-height: 1.8; }
        .contact-links { margin-top: 20px; }
        .contact-link { display: inline-block; margin-right: 20px; margin-bottom: 15px; padding: 12px 20px; background-color: #004a99; color: white; text-decoration: none; border-radius: 6px; transition: 0.3s; }
        .contact-link:hover { background-color: #003266; transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
    </style>
</head>
<body>
    @include('navigation')
    <div class="container py-5">
        <h1 class="page-title">{{ $profil->judul ?? 'Kontak PPID' }}</h1>
        <div class="content-box">
            @if($profil)
                @if($profil->konten_pembuka)
                    <div class="mb-4">{!! $profil->konten_pembuka !!}</div>
                @endif
                
                @if($profil->konten_detail)
                    <div>{!! $profil->konten_detail !!}</div>
                @endif
            @else
                <p class="text-muted">Informasi kontak PPID belum tersedia.</p>
            @endif        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
</body>
</html>