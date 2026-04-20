<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil PPID - Portal PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f8f9fa; 
            scroll-behavior: smooth; 
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
        p {
            text-align: justify;
            line-height: 1.8;
            color: #333;
        }
    </style>
</head>
<body>

    @include('navigation')

    <div class="container py-5">
        <h1 class="page-title">Profil PPID</h1>

        <!-- SECTION: PROFILE PPID -->
        <div class="content-box">
            @if($profil)
                <h2 class="section-title">{{ $profil->judul }}</h2>
                <div class="content">
                    <div class="content">
                    @if($profil->konten_pembuka)
                        <h4>Konten Pembuka:</h4>
                        <div style="background: white; padding: 15px; border: 1px solid #ddd; margin: 10px 0; border-radius: 5px; line-height: 1.6;">
                            {!! $profil->konten_pembuka !!}
                        </div>
                    @endif
                    
                    @if($profil->judul_sub)
                        <h3 style="color: #004a99; margin: 20px 0 10px 0;">{{ $profil->judul_sub }}</h3>
                    @endif
                    
                    @if($profil->konten_detail)
                        <h4>Konten Detail:</h4>
                        <div style="background: white; padding: 15px; border: 1px solid #ddd; margin: 10px 0; border-radius: 5px; line-height: 1.6;">
                            {!! $profil->konten_detail !!}
                        </div>
                    @endif
                    
                    @if($profil->gambar)
                        <img src="{{ asset('storage/' . $profil->gambar) }}" alt="{{ $profil->judul }}" class="img-fluid mt-3">
                    @endif
                    
                    @if($profil->link_dokumen)
                        <a href="{{ $profil->link_dokumen }}" target="_blank" class="btn btn-primary mt-3">
                            <i class="fas fa-download"></i> Download Dokumen
                        </a>
                    @endif
                </div>
            @else
                <h2 class="section-title">Profil PPID</h2>
                <p style="margin-bottom: 15px;">
                    Sejak Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik (UU KIP) diberlakukan secara efektif pada tanggal 30 April 2010 telah mendorong bangsa Indonesia satu langkah maju ke depan, menjadi bangsa yang transparan dan akuntabel dalam mengelola sumber daya publik. UU KIP sebagai instrumen hukum yang mengikat merupakan tonggak atau dasar bagi seluruh rakyat Indonesia untuk bersama-sama mengawasi secara langsung pelayanan publik yang diselenggarakan oleh Badan Publik.
                </p>
                <p>
                    Keterbukaan informasi adalah salah satu pilar penting yang akan mendorong terciptanya iklim transparansi. Terlebih di era yang serba terbuka ini, keinginan masyarakat untuk memperoleh informasi semakin tinggi. Diberlakukannya UU KIP merupakan perubahan yang mendasar dalam kehidupan bermasyarakat, berbangsa dan bernegara, oleh sebab itu perlu adanya kesadaran dari seluruh elemen bangsa agar setiap lembaga dan badan pemerintah dalam pengelolaan informasi harus dengan prinsip good governance, tata kelola yang baik dan akuntabilitas.
                </p>
            @endif
        </div>

        <!-- SECTION: GAMBARAN SINGKAT PPID -->
        @if($profil && $profil->gambaran)
        <div class="content-box">
            <h2 class="section-title">GAMBARAN SINGKAT PEMBENTUKAN PPID KEMENHUB</h2>
            <div class="content">
                {!! $profil->gambaran !!}
            </div>
        </div>
        @endif
    </div>

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
</body>
</html>
