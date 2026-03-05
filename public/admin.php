<?php
// Start session at the very beginning before any HTML output
session_start();

// Include authentication
include 'admin_auth.php';
?>
<!DOCTYPE html>
        :root {
            --primary-color: #1a3a52;
            --secondary-color: #2d5f8d;
            --accent-color: #d4af37;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--accent-color);
        }

        .sidebar-header p {
            margin: 5px 0 0 0;
            opacity: 0.8;
            font-size: 14px;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .sidebar-nav .nav-item {
            margin: 5px 0;
        }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 25px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-radius: 0;
            margin: 0 10px;
            font-weight: 500;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
            border-radius: 10px;
        }

        .sidebar-nav .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }

        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-area {
            padding: 30px;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: none;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stats-number {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-title {
            font-size: 14px;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 0;
        }

        .btn-custom {
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 58, 82, 0.3);
        }

        .card-custom {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: none;
            margin-bottom: 20px;
        }

        .table-custom {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .table-custom thead th {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
        }

        .table-custom tbody td {
            padding: 15px;
            border-bottom: 1px solid #f1f3f4;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <?php include 'admin_auth.php'; ?>

    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-shield-alt me-2"></i>PPID PKTJ Tegal</h3>
            <p>Admin Panel</p>
        </div>

        <ul class="sidebar-nav nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="admin.php">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>KELOLA KONTEN</span>
                </h6>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=profil">
                    <i class="fas fa-user-circle"></i>
                    Profil PPID
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=informasi">
                    <i class="fas fa-info-circle"></i>
                    Informasi Publik
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=layanan">
                    <i class="fas fa-concierge-bell"></i>
                    Layanan Informasi
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=prosedur">
                    <i class="fas fa-file-contract"></i>
                    Prosedur
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=faq">
                    <i class="fas fa-question-circle"></i>
                    FAQ
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=permohonan">
                    <i class="fas fa-file-signature"></i>
                    Permohonan
                </a>
            </li>

            <li class="nav-item">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>PENGATURAN</span>
                </h6>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=settings">
                    <i class="fas fa-cog"></i>
                    Pengaturan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin.php?page=users">
                    <i class="fas fa-users"></i>
                    Manajemen User
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div>
                <h5 class="mb-0">Dashboard Admin</h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3">
                    <i class="fas fa-user-circle me-2"></i>
                    Admin PPID
                </span>
                <a href="admin.php?logout=1" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>
                    Logout
                </a>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="content-area">
            <?php
            $page = $_GET['page'] ?? 'dashboard';

            switch ($page) {
                case 'dashboard':
                    include 'admin_dashboard.php';
                    break;
                case 'profil':
                    include 'admin_profil.php';
                    break;
                case 'informasi':
                    include 'admin_informasi.php';
                    break;
                case 'layanan':
                    include 'admin_layanan.php';
                    break;
                case 'prosedur':
                    include 'admin_prosedur.php';
                    break;
                case 'faq':
                    include 'admin_faq.php';
                    break;
                case 'permohonan':
                    include 'admin_permohonan.php';
                    break;
                case 'settings':
                    include 'admin_settings.php';
                    break;
                case 'users':
                    include 'admin_users.php';
                    break;
                default:
                    include 'admin_dashboard.php';
                    break;
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add active class to current nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = '<?php echo $page; ?>';
            const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes('page=' + currentPage)) {
                    link.classList.add('active');
                }
            });

            // Dashboard active
            if (currentPage === 'dashboard') {
                document.querySelector('.sidebar-nav .nav-link[href="admin.php"]').classList.add('active');
            }
        });
    </script>
</body>
</html>
