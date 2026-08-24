<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemohon - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-blue: #004a99;
            --navy-dark: #0b2a59;
            --secondary-gold: #ffc107;
            --bg-canvas: #f8faff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-canvas);
            color: #1e293b;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* Top Header Bar */
        .top-navbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }

        .navbar-brand-area {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            width: var(--sidebar-width);
        }

        .navbar-brand-area img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .navbar-brand-text h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-weight: 800;
            color: var(--primary-blue);
            margin: 0;
            line-height: 1.1;
        }
        .navbar-brand-text span {
            font-size: 11px;
            color: #64748b;
            font-weight: 500;
        }

        .breadcrumb-box {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 12px;
            transition: background 0.2s;
        }
        .user-dropdown-btn:hover { background: #f1f5f9; }

        .avatar-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #004a99, #0066cc);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(0,74,153,0.2);
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: #092c55;
            background: linear-gradient(180deg, #092c55 0%, #004a99 100%);
            position: fixed;
            top: 70px;
            bottom: 0;
            left: 0;
            z-index: 1020;
            padding: 24px 16px;
            overflow-y: auto;
            color: white;
        }

        .sidebar-heading {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.45);
            padding: 0 12px;
            margin-bottom: 12px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.18);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            font-weight: 700;
        }

        .sidebar-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            margin-top: 70px;
            padding: 35px;
            min-height: calc(100vh - 70px);
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 2rem;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        /* Verification Status Cards */
        .status-banner {
            border-radius: 18px;
            padding: 24px 28px;
            margin-bottom: 30px;
            display: flex;
            align-items: flex-start;
            gap: 18px;
        }

        .status-banner.pending {
            background: #fffbeb;
            border: 1.5px solid #fef3c7;
            color: #92400e;
        }

        .status-banner.pending .status-icon {
            color: #f59e0b;
            font-size: 32px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .status-banner.verified {
            background: #f0fdf4;
            border: 1.5px solid #dcfce7;
            color: #166534;
        }

        .status-banner.verified .status-icon {
            color: #22c55e;
            font-size: 32px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .status-title {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .status-desc {
            font-size: 13.5px;
            line-height: 1.5;
            margin: 0;
            opacity: 0.9;
        }

        /* Quick Stat Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0,74,153,0.04);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(0,74,153,0.08); }

        .stat-val {
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: #0f172a;
            line-height: 1;
        }
        .stat-lbl {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            margin-top: 6px;
        }
        .stat-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .content-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,74,153,0.03);
            margin-bottom: 30px;
        }

        .card-header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: gap;
        }

        .card-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.25rem;
            color: #0f172a;
            margin: 0;
        }

        .btn-action-primary {
            background: linear-gradient(135deg, var(--primary-blue), #0066cc);
            color: white;
            font-weight: 700;
            font-size: 13.5px;
            padding: 11px 22px;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 6px 16px rgba(0,74,153,0.2);
            transition: all 0.25s;
        }
        .btn-action-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(0,74,153,0.3);
            color: white;
        }

        .table-custom th {
            font-size: 11.5px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            background: #f8fafc;
            padding: 14px 18px;
            border-bottom: 1px solid #e2e8f0;
        }
        .table-custom td {
            font-size: 13.5px;
            padding: 16px 18px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .badge-status {
            font-size: 11.5px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 30px;
            display: inline-block;
        }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-diproses { background: #e0f2fe; color: #0369a1; }
        .badge-selesai { background: #dcfce7; color: #15803d; }
        .badge-ditolak { background: #fee2e2; color: #b91c1c; }

        @media (max-width: 991px) {
            .sidebar { display: none; }
            .main-wrapper { margin-left: 0; padding: 20px 15px; }
            .top-navbar { padding: 0 15px; }
            .navbar-brand-area { width: auto; }
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <header class="top-navbar">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ url('/') }}" class="navbar-brand-area">
                <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PKTJ">
                <div class="navbar-brand-text">
                    <h1>PPID</h1>
                    <span>Informasi Publik</span>
                </div>
            </a>

            <div class="breadcrumb-box d-none d-md-flex">
                <i class="fas fa-home text-muted"></i>
                <i class="fas fa-chevron-right text-muted" style="font-size: 10px;"></i>
                <span>Dashboard</span>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        <div class="dropdown">
            <button class="user-dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar-circle">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>
                <div class="text-start d-none d-sm-block">
                    <div class="fw-bold text-xs" style="font-size: 13.5px; color: #0f172a;">{{ $user->name }}</div>
                    <div class="text-muted" style="font-size: 11px;">{{ $user->email }}</div>
                </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 py-2 mt-2" style="min-width: 200px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold text-dark text-xs">{{ $user->name }}</div>
                    <div class="text-muted text-xs font-mono" style="font-size: 11px;">{{ $user->email }}</div>
                </li>
                <li>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('user.profile') }}">
                        <i class="fas fa-cog text-muted"></i> Settings / Profil
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ url('/') }}">
                        <i class="fas fa-globe text-muted"></i> Halaman Publik
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 text-danger d-flex align-items-center gap-2">
                            <i class="fas fa-sign-out-alt"></i> Log out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-heading">PLATFORM</div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('user.dashboard') }}" class="sidebar-link active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('permohonan.form') }}" class="sidebar-link">
                    <i class="fas fa-file-signature"></i>
                    <span>Ajukan Permohonan</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}" class="sidebar-link" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Halaman Publik</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content Area -->
    <main class="main-wrapper">
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">{{ $settings['ppid_nama'] ?? 'PPID Politeknik Keselamatan Transportasi Jalan' }}</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm py-3 px-4 mb-4 d-flex align-items-center gap-3">
            <i class="fas fa-check-circle text-success fs-4"></i>
            <div>
                <div class="fw-bold">{{ session('success') }}</div>
            </div>
        </div>
        @endif

        <!-- Status Verification Banner (Matching Screenshot 5) -->
        @if($user->status_verifikasi === 'pending' || empty($user->status_verifikasi))
        <div class="status-banner pending">
            <div class="status-icon">
                <i class="far fa-clock"></i>
            </div>
            <div>
                <h3 class="status-title">Menunggu Verifikasi</h3>
                <p class="status-desc">Data Anda sedang ditinjau oleh admin. Silakan tunggu proses verifikasi.</p>
            </div>
        </div>
        @elseif($user->status_verifikasi === 'verified')
        <div class="status-banner verified">
            <div class="status-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <h3 class="status-title">Akun Terverifikasi</h3>
                <p class="status-desc">Identitas Anda telah diverifikasi oleh tim PPID. Anda dapat mengajukan permohonan informasi publik kapan saja.</p>
            </div>
        </div>
        @else
        <div class="status-banner" style="background: #fee2e2; border: 1.5px solid #fecaca; color: #991b1b;">
            <div class="status-icon text-danger">
                <i class="fas fa-times-circle"></i>
            </div>
            <div>
                <h3 class="status-title">Verifikasi Ditolak</h3>
                <p class="status-desc">{{ $user->catatan_verifikasi ?? 'Data identitas belum sesuai ketentuan. Silakan perbarui file identitas pada menu Settings.' }}</p>
            </div>
        </div>
        @endif

        <!-- Quick Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div>
                        <div class="stat-val">{{ $stats['total'] }}</div>
                        <div class="stat-lbl">Total Permohonan</div>
                    </div>
                    <div class="stat-icon-wrap" style="background: #eff6ff; color: #2563eb;">
                        <i class="fas fa-folder"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div>
                        <div class="stat-val text-warning">{{ $stats['pending'] }}</div>
                        <div class="stat-lbl">Menunggu Proses</div>
                    </div>
                    <div class="stat-icon-wrap" style="background: #fefce8; color: #ca8a04;">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div>
                        <div class="stat-val text-primary">{{ $stats['diproses'] }}</div>
                        <div class="stat-lbl">Sedang Diproses</div>
                    </div>
                    <div class="stat-icon-wrap" style="background: #f0fdf4; color: #16a34a;">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div>
                        <div class="stat-val text-success">{{ $stats['selesai'] }}</div>
                        <div class="stat-lbl">Permohonan Selesai</div>
                    </div>
                    <div class="stat-icon-wrap" style="background: #ecfdf5; color: #059669;">
                        <i class="fas fa-check-double"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Submissions Card -->
        <div class="content-card">
            <div class="card-header-flex">
                <div>
                    <h2 class="card-title">Daftar Permohonan Informasi Saya</h2>
                    <p class="text-muted small mb-0">Pantau progres dan status jawaban atas permohonan informasi publik Anda.</p>
                </div>
                <a href="{{ route('permohonan.form') }}" class="btn-action-primary">
                    <i class="fas fa-plus"></i> Ajukan Permohonan Baru
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Rincian Informasi</th>
                            <th>Tujuan Penggunaan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myPermohonans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold">{{ $item->tanggal_permohonan ? \Carbon\Carbon::parse($item->tanggal_permohonan)->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y') }}</div>
                                <div class="text-muted" style="font-size: 11px;">ID: #REQ-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ \Illuminate\Support\Str::limit($item->deskripsi_permohonan ?? $item->rincian_informasi, 70) }}</div>
                            </td>
                            <td>
                                <div class="text-muted small">{{ \Illuminate\Support\Str::limit($item->jenis_informasi ?? $item->tujuan_penggunaan, 50) }}</div>
                            </td>
                            <td>
                                @php
                                    $st = strtolower($item->status);
                                    $badgeClass = match($st) {
                                        'selesai', 'completed' => 'badge-selesai',
                                        'diproses', 'approved' => 'badge-diproses',
                                        'ditolak', 'rejected' => 'badge-ditolak',
                                        default => 'badge-pending'
                                    };
                                    $label = match($st) {
                                        'selesai', 'completed' => 'Selesai / Dipenuhi',
                                        'diproses', 'approved' => 'Sedang Diproses',
                                        'ditolak', 'rejected' => 'Ditolak',
                                        default => 'Menunggu Verifikasi'
                                    };
                                @endphp
                                <span class="badge-status {{ $badgeClass }}">
                                    {{ $label }}
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold text-xs" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>

                                <!-- Detail Modal -->
                                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content rounded-4 border-0 shadow-lg">
                                            <div class="modal-header border-bottom p-4">
                                                <h5 class="modal-title fw-bold outfit">
                                                    <i class="fas fa-file-alt text-primary me-2"></i> Rincian Permohonan #REQ-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="text-muted text-xs fw-bold text-uppercase">Nama Pemohon</label>
                                                        <div class="fw-bold">{{ $item->nama_pemohon ?? $user->name }}</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="text-muted text-xs fw-bold text-uppercase">Tanggal Pengajuan</label>
                                                        <div class="fw-bold">{{ $item->tanggal_permohonan ? \Carbon\Carbon::parse($item->tanggal_permohonan)->translatedFormat('d F Y') : $item->created_at->translatedFormat('d F Y') }}</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="text-muted text-xs fw-bold text-uppercase">Rincian Informasi</label>
                                                        <div class="p-3 bg-light rounded-3 text-dark">{{ $item->deskripsi_permohonan ?? $item->rincian_informasi }}</div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="text-muted text-xs fw-bold text-uppercase">Tujuan Penggunaan</label>
                                                        <div class="p-3 bg-light rounded-3 text-dark">{{ $item->jenis_informasi ?? $item->tujuan_penggunaan }}</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="text-muted text-xs fw-bold text-uppercase">Cara Memperoleh</label>
                                                        <div class="fw-semibold">{{ $item->jenis_permohonan_salinan ?? 'Melihat/Membaca' }}</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="text-muted text-xs fw-bold text-uppercase">Cara Mendapatkan Salinan</label>
                                                        <div class="fw-semibold">{{ $item->cara_mendapatkan ?? ($item->custom_fields_data['cara_mendapatkan'] ?? 'Langsung') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top p-3">
                                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-folder-open text-muted fa-4x mb-3 opacity-25"></i>
                                <h5 class="text-muted fw-bold">Belum Ada Permohonan Informasi</h5>
                                <p class="text-muted small">Anda belum pernah mengajukan permohonan informasi publik. Silakan klik tombol di bawah untuk membuat permohonan baru.</p>
                                <a href="{{ route('permohonan.form') }}" class="btn-action-primary mt-2">
                                    <i class="fas fa-plus"></i> Ajukan Permohonan Sekarang
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
