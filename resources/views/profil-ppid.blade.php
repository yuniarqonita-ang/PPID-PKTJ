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
        <h1 class="page-title">{{ $profil->judul ?? 'Profil PPID' }}</h1>
        
        @if($profil && $profil->konten)
            <div class="content-box">
                {!! $profil->konten !!}
            </div>
        @else
            <!-- SECTION: PROFILE PPID -->
            <div class="content-box">
                <p style="margin-bottom: 15px;">
                    Sejak Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik (UU KIP) diberlakukan secara efektif pada tanggal 30 April 2010 telah mendorong bangsa Indonesia satu langkah maju ke depan, menjadi bangsa yang transparan dan akuntabel dalam mengelola sumber daya publik. UU KIP sebagai instrumen hukum yang mengikat merupakan tonggak atau dasar bagi seluruh rakyat Indonesia untuk bersama-sama mengawasi secara langsung pelayanan publik yang diselenggarakan oleh Badan Publik.
                </p>
                <p>
                    Keterbukaan informasi adalah salah satu pilar penting yang akan mendorong terciptanya iklim transparansi. Terlebih di era yang serba terbuka ini, keinginan masyarakat untuk memperoleh informasi semakin tinggi. Diberlakukannya UU KIP merupakan perubahan yang mendasar dalam kehidupan bermasyarakat, berbangsa dan bernegara, oleh sebab itu perlu adanya kesadaran dari seluruh elemen bangsa agar setiap lembaga dan badan pemerintah dalam pengelolaan informasi harus dengan prinsip good governance, tata kelola yang baik dan akuntabilitas.
                </p>
            </div>

            <!-- SECTION: GAMBARAN SINGKAT PPID -->
            <div class="content-box">
                <h2 class="section-title">GAMBARAN SINGKAT PEMBENTUKAN PPID KEMENHUB</h2>
                <p style="margin-bottom: 15px;">
                    Sejalan dengan amanah Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Kementerian Perhubungan telah membentuk Pejabat Pengelola Informasi dan Dokumentasi (PPID) dan Pedoman pelaksanaan layanan informasi publik yang ditetapkan melalui Peraturan Menteri Perhubungan Nomor PM. 46 Tahun 2018 Tentang Pedoman Pengelolaan Informasi dan Dokumentasi di lingkungan Kementerian Perhubungan serta dalam menjalankan layanan informasi yang sesuai standar, PPID Kementerian Perhubungan menerbitkan Keputusan Menteri Perhubungan Nomor KM 117 Tahun 2022 tentang Standar Operasional Prosedur Pejabat Pengelola Informasi dan Dokumentasi di lingkungan Kementerian Perhubungan.
                </p>
                <p style="margin-bottom: 15px;">
                    PPID Kementerian Perhubungan dibentuk berdasarkan amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik dan Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan UU KIP. PPID Kementerian Perhubungan bertanggung jawab atas pengelolaan dan pelayanan informasi di lingkungan Kementerian Perhubungan.
                </p>
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
