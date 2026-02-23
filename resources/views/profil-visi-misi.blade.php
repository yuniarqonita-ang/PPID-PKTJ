<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi dan Misi PPID - Portal PPID PKTJ</title>
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
            color: #333;
            font-size: 18px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
        }
        .intro-text {
            color: #666;
            text-align: justify;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .point-list {
            list-style: none;
            padding-left: 0;
        }
        .point-list li {
            margin-bottom: 15px;
            text-align: justify;
            line-height: 1.6;
            color: #333;
        }
        .point-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    @include('navigation')
    <div class="container py-5">
        <h1 class="page-title">Visi dan Misi PPID</h1>
        <div class="content-box">
            <!-- VISI SECTION -->
            <h2 class="section-title">Visi</h2>
            <p class="intro-text">
                Terwujudnya layanan informasi publik yang Transparan, Objektif dan Prima untuk meningkatkan peran serta aktif masyarakat dalam penyelenggaraan pembangunan sektor transportasi.
            </p>

            <ul class="point-list">
                <li>
                    <div class="point-title">1. Layanan Informasi Publik</div>
                    <div>Suatu usaha untuk memberikan informasi publik sesuai Undang- Undang No. 14 tahun 2008 tentang Keterbukaan Informasi Publik di lingkungan Kementerian Perhubungan;</div>
                </li>
                <li>
                    <div class="point-title">2. Transparan</div>
                    <div>Memberikan akses seluar-luasnya kepada masyarakat dalam memperoleh informasi publik dengan cepat dan tepat waktu, biaya ringan, dan cara yang sederhana;</div>
                </li>
                <li>
                    <div class="point-title">3. Objektif</div>
                    <div>Memberikan akses informasi kepada setiap kalangan, baik Perorangan, Kelompok, maupun Badan Hukum;</div>
                </li>
                <li>
                    <div class="point-title">4. Prima</div>
                    <div>Terus Berupaya penuh dalam peningkatan Pelayanan, Pengelolaan dan Pendokumentasian Informasi Publik secara Akuntabel, Efisien dan Mudah Diakses.</div>
                </li>
            </ul>

            <!-- MISI SECTION -->
            <h2 class="section-title">Misi</h2>
            <ul class="point-list">
                <li>
                    <div>1. Menjamin akses informasi publik sesuai Undang-Undang No. 14 tahun 2008 tentang Keterbukaan Informasi Publik;</div>
                </li>
                <li>
                    <div>2. Meningkatkan kualitas layanan informasi publik;</div>
                </li>
                <li>
                    <div>3. Meningkatkan profesionalisme SDM layanan informasi publik;</div>
                </li>
                <li>
                    <div>4. Meningkatkan sarana-prasarana dalam rangka efisiensi dan efektivitas layanan informasi publik;</div>
                </li>
                <li>
                    <div>5. Meningkatkan pengelolaan informasi dan dokumentasi secara baik, efisien, mudah diakses dan bersifat desentralisasi.</div>
                </li>
            </ul>
        </div>
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
