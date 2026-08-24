<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Akun Pemohon - {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}</title>
    
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-navy: #0b3260;
            --primary-blue: #004a99;
            --accent-blue: #1d72b8;
            --secondary-gold: #ffc107;
            --light-bg: #f8faff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: #1e293b;
        }

        .auth-container {
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: row;
        }

        /* Left Branding Panel */
        .brand-panel {
            flex: 0.9;
            background: linear-gradient(145deg, #092c55 0%, #0d3d75 50%, #004a99 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            color: white;
            text-align: center;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            top: -150px;
            left: -150px;
            border-radius: 50%;
        }

        .brand-content {
            position: relative;
            z-index: 10;
            max-width: 440px;
        }

        .brand-emblem {
            width: 110px;
            height: 110px;
            object-fit: contain;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
            margin-bottom: 25px;
        }

        .brand-title {
            font-family: 'Outfit', sans-serif;
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .brand-subtitle {
            font-size: 1.15rem;
            font-weight: 600;
            opacity: 0.95;
            margin-bottom: 24px;
            line-height: 1.4;
        }

        .brand-divider {
            width: 60px;
            height: 3px;
            background: #38bdf8;
            margin: 0 auto 24px;
            border-radius: 4px;
        }

        .brand-agency {
            font-size: 0.92rem;
            opacity: 0.85;
            line-height: 1.6;
        }

        /* Right Form Panel */
        .form-panel {
            flex: 1.1;
            background-color: #f8faff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 50px 30px;
            overflow-y: auto;
        }

        .form-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 45px rgba(0, 74, 153, 0.08);
            border: 1px solid #e2e8f0;
            padding: 45px 40px;
            width: 100%;
            max-width: 600px;
            position: relative;
        }

        .icon-badge {
            width: 56px;
            height: 56px;
            background: #2563eb;
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 20px;
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.25);
        }

        .form-header-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: #0f172a;
            text-align: center;
            margin-bottom: 6px;
        }

        .form-header-subtitle {
            color: #64748b;
            font-size: 13.5px;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 700;
            font-size: 13.5px;
            color: #1e293b;
            margin-bottom: 7px;
            display: block;
        }

        .req {
            color: #ef4444;
            margin-left: 2px;
        }

        .form-control, .form-select {
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.25s ease;
            background-color: #ffffff;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.12);
            background-color: #ffffff;
        }

        .form-control[readonly] {
            background-color: #f1f5f9;
            color: #64748b;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            font-size: 14px;
        }
        .password-toggle:hover { color: var(--primary-blue); }

        .helper-text {
            font-size: 12px;
            color: #64748b;
            margin-top: 5px;
        }

        .agreement-box {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px 20px;
            margin: 28px 0 24px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .agreement-box input[type="checkbox"] {
            margin-top: 4px;
            width: 18px;
            height: 18px;
            accent-color: var(--primary-blue);
            flex-shrink: 0;
        }

        .agreement-box label {
            font-size: 13px;
            line-height: 1.6;
            color: #334155;
            margin: 0;
            cursor: pointer;
        }

        .btn-submit {
            background: #2563eb;
            background: linear-gradient(135deg, #2563eb 0%, #004a99 100%);
            color: white;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 20px;
            border-radius: 12px;
            border: none;
            width: 100%;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #082d5a 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.35);
            color: white;
        }

        .back-to-home {
            position: absolute;
            top: 25px;
            left: 25px;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            z-index: 20;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.15);
            padding: 8px 16px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            transition: all 0.2s ease;
        }
        .back-to-home:hover { background: rgba(255,255,255,0.25); color: white; }

        @media (max-width: 991px) {
            .auth-container { flex-direction: column; }
            .brand-panel { position: static; height: auto; padding: 50px 20px; flex: none; }
            .brand-emblem { width: 80px; height: 80px; margin-bottom: 15px; }
            .brand-title { font-size: 2.2rem; }
            .brand-subtitle { font-size: 1rem; }
            .form-panel { padding: 30px 15px; }
            .form-card { padding: 30px 20px; }
            .back-to-home { top: 15px; left: 15px; }
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <!-- Back Button -->
        <a href="{{ url('/') }}" class="back-to-home">
            <i class="fas fa-arrow-left"></i> Beranda PPID
        </a>

        <!-- Left Brand Banner -->
        <div class="brand-panel">
            <div class="brand-content">
                <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PPID PKTJ" class="brand-emblem">
                <h1 class="brand-title">PPID</h1>
                <p class="brand-subtitle">Pejabat Pengelola Informasi dan Dokumentasi</p>
                <div class="brand-divider"></div>
                <p class="brand-agency">
                    {{ $settings['auth_login_agency'] ?? 'Politeknik Keselamatan Transportasi Jalan' }}<br>
                    {{ $settings['auth_login_subagency'] ?? 'Kementerian Perhubungan Republik Indonesia' }}
                </p>
            </div>
        </div>

        <!-- Right Registration Form Card (BPSDM Style) -->
        <div class="form-panel">
            <div class="form-card">
                
                <!-- Icon Header -->
                <div class="icon-badge">
                    <i class="fas fa-file-signature"></i>
                </div>
                <h2 class="form-header-title">Lengkapi Data Pendaftaran</h2>
                <p class="form-header-subtitle">Lengkapi data diri Anda untuk mendaftar di {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}</p>

                @if($errors->any())
                <div class="alert alert-danger py-3 px-3 rounded-3 mb-4 text-xs" style="font-size: 13px;">
                    <div class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-1"></i> Mohon perbaiki data berikut:</div>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                    @csrf

                    <!-- 1. Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name') }}" 
                            placeholder="Nama lengkap sesuai KTP" required autofocus>
                    </div>

                    <!-- 2. Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="req">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            id="email" name="email" value="{{ old('email') }}" 
                            placeholder="contoh@domain.com" required>
                    </div>

                    <!-- 3. Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="req">*</span></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                            id="username" name="username" value="{{ old('username') }}" 
                            placeholder="Username untuk login" required>
                    </div>

                    <!-- 4. Password (opsional) -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (opsional)</label>
                        <div class="password-container">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" placeholder="Buat password jika ingin login tanpa Google">
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                                <i class="fas fa-eye" id="password-eye"></i>
                            </button>
                        </div>
                        <div class="helper-text">Kosongkan jika ingin password dibuatkan otomatis.</div>
                    </div>

                    <!-- 5. Jenis Identitas -->
                    <div class="mb-3">
                        <label for="jenis_identitas" class="form-label">Jenis Identitas <span class="req">*</span></label>
                        <select class="form-select @error('jenis_identitas') is-invalid @enderror" 
                            id="jenis_identitas" name="jenis_identitas" required>
                            <option value="" disabled {{ old('jenis_identitas') ? '' : 'selected' }}>Pilih jenis identitas</option>
                            <option value="KTP" {{ old('jenis_identitas') == 'KTP' ? 'selected' : '' }}>KTP (Kartu Tanda Penduduk)</option>
                            <option value="SIM" {{ old('jenis_identitas') == 'SIM' ? 'selected' : '' }}>SIM (Surat Izin Mengemudi)</option>
                            <option value="Paspor" {{ old('jenis_identitas') == 'Paspor' ? 'selected' : '' }}>Paspor</option>
                            <option value="Kartu Mahasiswa" {{ old('jenis_identitas') == 'Kartu Mahasiswa' ? 'selected' : '' }}>Kartu Mahasiswa / Pelajar</option>
                            <option value="KTA/Lainnya" {{ old('jenis_identitas') == 'KTA/Lainnya' ? 'selected' : '' }}>KTA / Kartu Identitas Lainnya</option>
                        </select>
                    </div>

                    <!-- 6. Nomor Identitas -->
                    <div class="mb-3">
                        <label for="nomor_identitas" class="form-label">Nomor Identitas <span class="req">*</span></label>
                        <input type="text" class="form-control @error('nomor_identitas') is-invalid @enderror" 
                            id="nomor_identitas" name="nomor_identitas" value="{{ old('nomor_identitas') }}" 
                            placeholder="Nomor identitas (NIK / No. KTP / No. SIM / No. Paspor)" required>
                    </div>

                    <!-- 7. Upload File Identitas -->
                    <div class="mb-3">
                        <label for="file_identitas" class="form-label">Upload File Identitas <span class="req">*</span></label>
                        <input type="file" class="form-control @error('file_identitas') is-invalid @enderror" 
                            id="file_identitas" name="file_identitas" accept=".jpg,.jpeg,.png,.pdf" required>
                        <div class="helper-text">Format: JPG, PNG, PDF. Maks 2MB.</div>
                    </div>

                    <!-- 8. Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="req">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                            id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap domisili" required>{{ old('alamat') }}</textarea>
                    </div>

                    <!-- 9. No. Telp/HP -->
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telp/HP <span class="req">*</span></label>
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" 
                            id="no_telp" name="no_telp" value="{{ old('no_telp') }}" 
                            placeholder="08xxxxxxxxxx" required>
                    </div>

                    <!-- 10. Pekerjaan -->
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan <span class="req">*</span></label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                            id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" 
                            placeholder="Pekerjaan" required>
                    </div>

                    <!-- 11. Instansi (opsional) -->
                    <div class="mb-3">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" class="form-control @error('instansi') is-invalid @enderror" 
                            id="instansi" name="instansi" value="{{ old('instansi') }}" 
                            placeholder="Nama instansi (opsional)">
                    </div>

                    <!-- 12. Checkbox Persetujuan Kebijakan -->
                    <div class="agreement-box">
                        <input type="checkbox" id="persetujuan" name="persetujuan" value="1" {{ old('persetujuan') ? 'checked' : '' }} required>
                        <label for="persetujuan">
                            Saya menyatakan bahwa data yang saya masukkan adalah <strong>benar dan dapat dipertanggungjawabkan</strong>, serta saya menyetujui bahwa data pribadi saya akan digunakan untuk keperluan layanan <strong>Pejabat Pengelola Informasi dan Dokumentasi (PPID)</strong> sesuai ketentuan yang berlaku.
                        </label>
                    </div>

                    <!-- 13. Tombol Simpan & Kirim -->
                    <button type="submit" class="btn btn-submit mb-4" id="submitBtn">
                        <i class="fas fa-paper-plane me-2"></i> Simpan &amp; Kirim
                    </button>

                    <div class="text-center text-muted text-xs">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #004a99;">Masuk di sini</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById('password-eye');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.getElementById('registerForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan Data...';
            btn.disabled = true;
        });
    </script>
</body>
</html>
