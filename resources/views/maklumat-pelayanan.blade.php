<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maklumat Pelayanan - Portal PPID PKTJ</title>
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
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 1;
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

        .service-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #d4af37;
            border-radius: 10px;
            padding: 25px;
            margin: 15px 0;
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.2);
        }

        .service-card i {
            font-size: 36px;
            color: #d4af37;
            margin-bottom: 15px;
        }

        .service-card h5 {
            color: #004a99;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #d4af37;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding-left: 40px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -23px;
            top: 8px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #d4af37;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #d4af37;
        }

        .timeline-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #d4af37;
        }

        .price-table {
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
            margin: 20px 0;
        }

        .price-table table {
            width: 100%;
            margin: 0;
        }

        .price-table th {
            background: #d4af37;
            color: #1a3a52;
            padding: 15px;
            font-weight: bold;
            text-align: center;
        }

        .price-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
        }

        .price-table tbody tr:hover {
            background: #fff3e0;
        }

        .contact-box {
            background: linear-gradient(135deg, #004a99 0%, #0066cc 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }

        .contact-box i {
            font-size: 48px;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <!-- Navigation -->
    
    @include('navigation')


    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="container">
                <h1 class="display-5 fw-bold mb-3">{{ $settings['maklumat_judul_hero'] ?? 'Maklumat Pelayanan' }}</h1>
                <p class="lead">{{ $settings['maklumat_tagline_hero'] ?? 'Standar Pelayanan Informasi Publik PPID PKTJ' }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="page-title">{{ $settings['maklumat_judul_maklumat'] ?? 'Maklumat Pelayanan PPID PKTJ' }}</h1>
        @include('components.konten-dinamis', ['prefix' => 'maklumat'])
    </div>

    <!-- Footer -->
    @include('footer')

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
