<?php
// Enhanced Admin Panel with Upload Functionality
session_start();

// Check authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Handle file uploads
$uploadMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_file'])) {
    $uploadDir = __DIR__ . '/uploads/';
    $allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'xls', 'xlsx'];
    $maxSize = 10 * 1024 * 1024; // 10MB

    $file = $_FILES['upload_file'];
    $fileName = basename($file['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $category = $_POST['file_category'] ?? 'document';
    $description = trim($_POST['file_description'] ?? '');

    if ($file['error'] === UPLOAD_ERR_OK) {
        if (in_array($fileExt, $allowedTypes) && $file['size'] <= $maxSize) {
            $newFileName = uniqid() . '_' . $fileName;
            $targetPath = $uploadDir . $newFileName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // Save file metadata
                $metadataFile = $uploadDir . 'files_metadata.json';
                $metadata = file_exists($metadataFile) ? json_decode(file_get_contents($metadataFile), true) : [];

                $fileData = [
                    'id' => uniqid(),
                    'original_name' => $fileName,
                    'stored_name' => $newFileName,
                    'category' => $category,
                    'description' => $description,
                    'size' => $file['size'],
                    'upload_date' => date('Y-m-d H:i:s'),
                    'file_path' => 'uploads/' . $newFileName
                ];

                $metadata[] = $fileData;
                file_put_contents($metadataFile, json_encode($metadata, JSON_PRETTY_PRINT));

                $uploadMessage = '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>File berhasil diupload dan akan muncul di halaman publik!</div>';
            } else {
                $uploadMessage = '<div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i>Gagal menyimpan file</div>';
            }
        } else {
            $uploadMessage = '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle me-2"></i>Tipe file tidak diizinkan atau ukuran terlalu besar</div>';
        }
    } else {
        $uploadMessage = '<div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i>Error upload file</div>';
    }
}

// Load uploaded files
$uploadedFiles = [];
$metadataFile = __DIR__ . '/uploads/files_metadata.json';
if (file_exists($metadataFile)) {
    $uploadedFiles = json_decode(file_get_contents($metadataFile), true) ?: [];
}
$uploadedFiles = array_reverse($uploadedFiles); // Show newest first

// Handle file deletion
if (isset($_GET['delete']) && isset($_GET['file'])) {
    $fileId = $_GET['delete'];
    $fileToDelete = null;

    foreach ($uploadedFiles as $key => $file) {
        if ($file['id'] === $fileId) {
            $fileToDelete = $file;
            unset($uploadedFiles[$key]);
            break;
        }
    }

    if ($fileToDelete) {
        $filePath = __DIR__ . '/' . $fileToDelete['file_path'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        file_put_contents($metadataFile, json_encode(array_values($uploadedFiles), JSON_PRETTY_PRINT));
        $uploadMessage = '<div class="alert alert-success"><i class="fas fa-trash me-2"></i>File berhasil dihapus</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Enhanced - PPID PKTJ Tegal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1a3a52;
            --secondary-color: #2d5f8d;
            --accent-color: #d4af37;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--accent-color) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(212, 175, 55, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(26, 58, 82, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(45, 95, 141, 0.1) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(5px) rotate(-1deg); }
        }

        .sidebar {
            background: linear-gradient(180deg, rgba(26, 58, 82, 0.95) 0%, rgba(45, 95, 141, 0.95) 100%);
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--glass-border);
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
            padding: 30px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--accent-color);
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .sidebar-header p {
            margin: 8px 0 0 0;
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
            text-decoration: none;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: rgba(212, 175, 55, 0.2);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transform: translateX(5px);
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
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--glass-border);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-area {
            padding: 30px;
        }

        .page-header {
            background: linear-gradient(135deg, rgba(26, 58, 82, 0.9) 0%, rgba(45, 95, 141, 0.9) 100%);
            backdrop-filter: blur(20px);
            color: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(212, 175, 55, 0.1) 50%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(180deg); }
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .page-subtitle {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 0;
            position: relative;
            z-index: 2;
        }

        .card-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid var(--glass-border);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 45px rgba(0,0,0,0.15);
        }

        .stats-card {
            background: linear-gradient(135deg, rgba(26, 58, 82, 0.9) 0%, rgba(45, 95, 141, 0.9) 100%);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: none;
            color: white;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
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
            background: rgba(212, 175, 55, 0.2);
        }

        .stats-number {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-title {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .upload-section {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.9) 0%, rgba(34, 197, 94, 0.9) 100%);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            color: white;
        }

        .upload-form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(26, 58, 82, 0.1);
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            background: white;
        }

        .btn-upload {
            background: linear-gradient(135deg, var(--accent-color) 0%, #f39c12 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            color: var(--primary-color);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .btn-upload:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        .table-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .table-custom thead th {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
        }

        .table-custom tbody td {
            padding: 15px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .btn-action {
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 14px;
            margin: 0 2px;
        }

        .alert {
            border-radius: 12px;
            border: none;
            backdrop-filter: blur(10px);
        }

        .preview-img {
            max-width: 50px;
            max-height: 50px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .preview-img:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .page-header {
                padding: 25px;
            }

            .page-title {
                font-size: 24px;
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-shield-alt me-2"></i>PPID PKTJ Tegal</h3>
            <p>Admin Panel Enhanced</p>
        </div>

        <ul class="sidebar-nav nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="admin_enhanced.php">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>KELOLA KONTEN</span>
                </h6>
            </li>

            <!-- BERANDA -->
            <li class="nav-item">
                <a class="nav-link" href="admin_enhanced.php?page=beranda">
                    <i class="fas fa-home"></i>
                    Beranda
                </a>
            </li>

            <!-- PROFIL PPID -->
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#profilMenu">
                    <i class="fas fa-user-circle"></i>
                    Profil PPID
                </a>
                <div class="collapse" id="profilMenu">
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=profil-ppid">
                        <i class="fas fa-building"></i>Profil PPID
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=profil-tugas">
                        <i class="fas fa-tasks"></i>Tugas & Tanggung Jawab
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=profil-visi">
                        <i class="fas fa-eye"></i>Visi & Misi
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=profil-struktur">
                        <i class="fas fa-sitemap"></i>Struktur Organisasi
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=profil-regulasi">
                        <i class="fas fa-gavel"></i>Regulasi
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=profil-kontak">
                        <i class="fas fa-address-book"></i>Kontak
                    </a>
                </div>
            </li>

            <!-- INFORMASI PUBLIK -->
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#informasiMenu">
                    <i class="fas fa-info-circle"></i>
                    Informasi Publik
                </a>
                <div class="collapse" id="informasiMenu">
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=informasi-berkala">
                        <i class="fas fa-calendar-alt"></i>Informasi Berkala
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=informasi-serta-merta">
                        <i class="fas fa-bolt"></i>Informasi Serta Merta
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=informasi-setiap-saat">
                        <i class="fas fa-clock"></i>Informasi Setiap Saat
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=informasi-dikecualikan">
                        <i class="fas fa-shield-alt"></i>Informasi Dikecualikan
                    </a>
                </div>
            </li>

            <!-- LAYANAN INFORMASI -->
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#layananMenu">
                    <i class="fas fa-concierge-bell"></i>
                    Layanan Informasi
                </a>
                <div class="collapse" id="layananMenu">
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=layanan-daftar">
                        <i class="fas fa-list"></i>Daftar Informasi Publik
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=layanan-maklumat">
                        <i class="fas fa-file-contract"></i>Maklumat Pelayanan
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=layanan-laporan">
                        <i class="fas fa-chart-bar"></i>Laporan Layanan
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=layanan-akses">
                        <i class="fas fa-globe"></i>Laporan Akses
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=layanan-survey">
                        <i class="fas fa-poll"></i>Laporan Survey
                    </a>
                </div>
            </li>

            <!-- PROSEDUR -->
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#prosedurMenu">
                    <i class="fas fa-file-contract"></i>
                    Prosedur
                </a>
                <div class="collapse" id="prosedurMenu">
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=prosedur-permintaan">
                        <i class="fas fa-file-signature"></i>SOP Permintaan Informasi
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=prosedur-keberatan">
                        <i class="fas fa-exclamation-triangle"></i>SOP Penanganan Keberatan
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=prosedur-sengketa">
                        <i class="fas fa-balance-scale"></i>SOP Pengajuan Sengketa
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=prosedur-penetapan">
                        <i class="fas fa-edit"></i>SOP Penetapan & Pemutakhiran
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=prosedur-pengujian">
                        <i class="fas fa-search"></i>SOP Pengujian Konsekuensi
                    </a>
                    <a class="nav-link ms-3" href="admin_enhanced.php?page=prosedur-pendokumentasian">
                        <i class="fas fa-archive"></i>SOP Pendokumentasian
                    </a>
                </div>
            </li>

            <!-- FAQ -->
            <li class="nav-item">
                <a class="nav-link" href="admin_enhanced.php?page=faq">
                    <i class="fas fa-question-circle"></i>
                    FAQ
                </a>
            </li>

            <!-- PERMOHONAN INFORMASI -->
            <li class="nav-item">
                <a class="nav-link" href="admin_enhanced.php?page=permohonan">
                    <i class="fas fa-file-signature"></i>
                    Permohonan Informasi
                </a>
            </li>

            <li class="nav-item">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>TOOLS</span>
                </h6>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin_enhanced.php?page=upload">
                    <i class="fas fa-upload"></i>
                    Upload Files
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin_enhanced.php?page=files">
                    <i class="fas fa-folder-open"></i>
                    Kelola Files
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin_enhanced.php?page=preview">
                    <i class="fas fa-eye"></i>
                    Preview Public
                </a>
            </li>

            <li class="nav-item">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>PENGATURAN</span>
                </h6>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin_enhanced.php?page=settings">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin_enhanced.php?logout=1">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div>
                <h5 class="mb-0">
                    <i class="fas fa-user-shield me-2"></i>
                    Admin Panel Enhanced - PPID PKTJ Tegal
                </h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3">
                    <i class="fas fa-user-circle me-2"></i>
                    Admin PPID
                </span>
                <a href="admin_enhanced.php?logout=1" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>
                    Logout
                </a>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="content-area">
            <?php echo $uploadMessage; ?>

            <?php
            $page = $_GET['page'] ?? 'dashboard';

            switch ($page) {
                case 'dashboard':
                    include 'admin_enhanced_dashboard.php';
                    break;

                // BERANDA
                case 'beranda':
                    include 'admin_enhanced_beranda.php';
                    break;

                // PROFIL PPID
                case 'profil-ppid':
                case 'profil-tugas':
                case 'profil-visi':
                case 'profil-struktur':
                case 'profil-regulasi':
                case 'profil-kontak':
                    include 'admin_enhanced_profil.php';
                    break;

                // INFORMASI PUBLIK
                case 'informasi-berkala':
                case 'informasi-serta-merta':
                case 'informasi-setiap-saat':
                case 'informasi-dikecualikan':
                    include 'admin_enhanced_informasi.php';
                    break;

                // LAYANAN INFORMASI
                case 'layanan-daftar':
                case 'layanan-maklumat':
                case 'layanan-laporan':
                case 'layanan-akses':
                case 'layanan-survey':
                    include 'admin_enhanced_layanan.php';
                    break;

                // PROSEDUR
                case 'prosedur-permintaan':
                case 'prosedur-keberatan':
                case 'prosedur-sengketa':
                case 'prosedur-penetapan':
                case 'prosedur-pengujian':
                case 'prosedur-pendokumentasian':
                    include 'admin_enhanced_prosedur.php';
                    break;

                // FAQ
                case 'faq':
                    include 'admin_enhanced_faq.php';
                    break;

                // PERMOHONAN INFORMASI
                case 'permohonan':
                    include 'admin_enhanced_permohonan.php';
                    break;

                // TOOLS
                case 'upload':
                    include 'admin_enhanced_upload.php';
                    break;
                case 'files':
                    include 'admin_enhanced_files.php';
                    break;
                case 'preview':
                    include 'admin_enhanced_preview.php';
                    break;

                // SETTINGS
                case 'settings':
                    include 'admin_enhanced_settings.php';
                    break;

                default:
                    include 'admin_enhanced_dashboard.php';
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
                document.querySelector('.sidebar-nav .nav-link[href*="admin_enhanced.php"]').classList.add('active');
            }

            // Add fade-in animation
            document.querySelectorAll('.card-custom, .stats-card, .upload-section').forEach(el => {
                el.classList.add('fade-in');
            });
        });

        // Confirm delete
        function confirmDelete(fileName, fileId) {
            if (confirm('Yakin ingin menghapus file "' + fileName + '"?')) {
                window.location.href = 'admin_enhanced.php?page=files&delete=' + fileId;
            }
        }
    </script>
</body>
</html>
