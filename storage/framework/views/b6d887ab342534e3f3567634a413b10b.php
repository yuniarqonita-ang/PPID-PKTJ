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

    <?php echo $__env->make('navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container py-5">
        <h1 class="page-title">Profil PPID</h1>

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
                Sejalan dengan amanah Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, Kementerian Perhubungan telah membentukan Pejabat Pengelola Informasi dan Dokumentasi (PPID) dan Pedoman pelaksanaan layanan informasi publik yang ditetapkan melalui Peraturan Menteri Perhubungan Nomor PM. 46 Tahun 2018 Tentang Pedoman Pengelolaan Informasi dan Dokumentasi di lingkungan Kementerian Perhubungan serta dalam menjalankan layanan informasi yang sesuai standar, PPID Kementerian Perhubungan menerbitkan Keputusan Menteri Perhubungan Nomor KM 117 Tahun 2022 tentang Standar Operasional Prosedur Pejabat Pengelola Informasi dan Dokumentasi di lingkungan Kementerian Perhubungan.
            </p>
            <p style="margin-bottom: 15px;">
                Dengan terbentuknya pelaksanaan PPID Kementerian Perhubungan dapat mewujudkan penyelenggaraan pemerintahan yang baik, yaitu yang transparan, efektif dan efisien, akuntabel serta dapat dipertanggungjawabkan dan meningkatkan pengelolaan dan pelayanan informasi dan dokumentasi di Kementerian Perhubungan untuk menghasilkan layanan Informasi dan dokumentasi yang berkualitas.
            </p>
            <p>
                Dengan lebih dari 500 Unit Pelaksana Teknis (UPT) Kementerian Perhubungan di seluruh Indonesia, dalam sistem pelaksanaannya, PPID Kementerian Perhubungan mengambil konsep desentralisasi, dimana UPT Kementerian Perhubungan di seluruh Indonesia dapat melakukan pelayanan informasi secara mandiri. Hal ini bertujuan untuk mendekatkan masyarakat dalam melakukan permohonan informasi dimanapun mereka berada.
            </p>
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
<?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/profil-ppid.blade.php ENDPATH**/ ?>