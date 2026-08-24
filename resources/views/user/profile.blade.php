<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - {{ $settings['ppid_nama'] ?? 'Portal PPID PKTJ' }}</title>
    
    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-blue: #004a99;
            --bg-canvas: #f8faff;
        }

        body { font-family: 'Inter', sans-serif; background-color: var(--bg-canvas); color: #1e293b; }
        .outfit { font-family: 'Outfit', sans-serif; }

        .top-navbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #092c55 0%, #004a99 100%);
            position: fixed;
            top: 70px; bottom: 0; left: 0;
            z-index: 1020;
            padding: 24px 16px;
            overflow-y: auto;
            color: white;
        }

        .sidebar-heading {
            font-size: 11px; font-weight: 800; letter-spacing: 1.5px;
            text-transform: uppercase; color: rgba(255, 255, 255, 0.45);
            padding: 0 12px; margin-bottom: 12px;
        }

        .sidebar-menu { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 6px; }

        .sidebar-link {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 16px; color: rgba(255, 255, 255, 0.8);
            text-decoration: none; font-size: 14px; font-weight: 600;
            border-radius: 12px; transition: all 0.2s ease;
        }

        .sidebar-link:hover { color: white; background: rgba(255, 255, 255, 0.1); }
        .sidebar-link.active { color: white; background: rgba(255, 255, 255, 0.18); font-weight: 700; }

        .main-wrapper {
            margin-left: var(--sidebar-width);
            margin-top: 70px;
            padding: 35px;
            min-height: calc(100vh - 70px);
        }

        .content-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            padding: 35px;
            box-shadow: 0 4px 20px rgba(0,74,153,0.03);
            max-width: 800px;
        }

        .form-label { font-weight: 700; font-size: 13.5px; color: #1e293b; margin-bottom: 6px; }
        .form-control { border-radius: 12px; padding: 11px 16px; font-size: 14px; }

        @media (max-width: 991px) {
            .sidebar { display: none; }
            .main-wrapper { margin-left: 0; padding: 20px 15px; }
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <header class="top-navbar">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo-pktj.png') }}" width="36" height="36" alt="Logo PKTJ">
                <span class="fw-bold outfit text-dark fs-5">PPID PKTJ</span>
            </a>
            <div class="text-muted small d-none d-md-block">
                <i class="fas fa-chevron-right mx-2 text-muted" style="font-size: 10px;"></i>
                <span>Profil &amp; Data Diri</span>
            </div>
        </div>

        <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </header>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-heading">PLATFORM</div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('user.dashboard') }}" class="sidebar-link">
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
                <a href="{{ route('user.profile') }}" class="sidebar-link active">
                    <i class="fas fa-user-circle"></i>
                    <span>Profil &amp; Identitas</span>
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
        <div class="mb-4">
            <h1 class="outfit fw-bold text-dark fs-3 mb-1">Profil &amp; Data Identitas</h1>
            <p class="text-muted small">Data identitas Anda digunakan untuk verifikasi dan otomatisasi formulir permohonan informasi publik.</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success rounded-4 border-0 shadow-sm py-3 px-4 mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
        @endif

        <div class="content-card">
            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control bg-light" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control bg-light" value="{{ $user->username ?? '-' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Telp/HP</label>
                        <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $user->no_telp) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Identitas</label>
                        <input type="text" class="form-control bg-light" value="{{ strtoupper($user->jenis_identitas ?? 'KTP') }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor Identitas</label>
                        <input type="text" class="form-control bg-light" value="{{ $user->nomor_identitas ?? '-' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $user->alamat) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $user->pekerjaan) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Instansi (Opsional)</label>
                        <input type="text" name="instansi" class="form-control" value="{{ old('instansi', $user->instansi) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Perbarui Berkas File Identitas (KTP / SIM / Paspor)</label>
                        @if($user->file_identitas)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $user->file_identitas) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-file-pdf me-1"></i> Lihat Berkas Identitas Saat Ini
                                </a>
                            </div>
                        @endif
                        <input type="file" name="file_identitas" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        <div class="text-muted small mt-1">Kosongkan jika tidak ingin mengubah file identitas. Maks 2MB.</div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold" style="background-color: #004a99; border-color: #004a99;">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
