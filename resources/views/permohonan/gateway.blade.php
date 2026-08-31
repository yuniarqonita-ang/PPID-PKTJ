<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Masuk Permohonan Informasi Publik - PPID PKTJ Tegal</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: {{ !empty($settings['primary_color']) ? $settings['primary_color'] : '#004a99' }};
            --deep-navy: #002b5c;
            --maritime-blue: #004a99;
            --secondary-gold: {{ !empty($settings['secondary_color']) ? $settings['secondary_color'] : '#ffc107' }};
            --neon-cyan: #00f2fe;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #001738; 
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* HERO GATEWAY CONTAINER */
        .gateway-wrapper {
            background: radial-gradient(circle at 50% 20%, rgba(0, 74, 153, 0.4) 0%, transparent 60%),
                        radial-gradient(circle at 85% 85%, rgba(0, 242, 254, 0.15) 0%, transparent 50%),
                        #001738;
            padding: 60px 15px 90px;
            flex: 1;
            display: flex;
            align-items: center;
        }

        .gateway-card {
            background: rgba(255, 255, 255, 0.96);
            border-radius: 32px;
            padding: 45px 50px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4), 0 0 40px rgba(0, 242, 254, 0.2);
            border: 1.5px solid rgba(0, 242, 254, 0.3);
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .gateway-card { padding: 30px 20px; border-radius: 24px; }
            .gateway-wrapper { padding: 40px 10px 60px; }
        }

        .gateway-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #002b5c 0%, #004a99 50%, #ffc107 100%);
        }

        /* SSO BUTTON */
        .btn-sso-kemenhub {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            color: #ffffff !important;
            border: 2px solid #00f2fe;
            border-radius: 18px;
            padding: 16px 24px;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            text-decoration: none !important;
            box-shadow: 0 10px 25px rgba(0, 74, 153, 0.35), 0 0 20px rgba(0, 242, 254, 0.25);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            width: 100%;
        }

        .btn-sso-kemenhub:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 74, 153, 0.5), 0 0 30px rgba(0, 242, 254, 0.5);
            border-color: #ffd166;
            background: linear-gradient(135deg, #001f42 0%, #005bb5 100%);
        }

        /* TAB SELECTOR */
        .gateway-tab-nav {
            background: #f1f5f9;
            padding: 6px;
            border-radius: 16px;
            display: flex;
            gap: 6px;
            margin-bottom: 28px;
        }

        .gateway-tab-btn {
            flex: 1;
            border: none;
            background: transparent;
            color: #64748b;
            font-weight: 700;
            font-size: 13.5px;
            padding: 12px 18px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .gateway-tab-btn.active {
            background: white;
            color: #002b5c;
            box-shadow: 0 4px 15px rgba(0, 43, 92, 0.1);
        }

        /* FORM INPUTS */
        .form-floating-custom {
            margin-bottom: 18px;
        }

        .form-floating-custom label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
            margin-bottom: 6px;
            display: block;
        }

        .form-control-gateway {
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 13px 18px;
            font-size: 14px;
            font-weight: 500;
            width: 100%;
            background: #f8fafc;
            transition: all 0.25s ease;
        }

        .form-control-gateway:focus {
            outline: none;
            border-color: var(--maritime-blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.1);
        }

        .btn-submit-gateway {
            background: linear-gradient(135deg, #002b5c 0%, #004a99 100%);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 15px;
            letter-spacing: 0.5px;
            padding: 16px 30px;
            border-radius: 16px;
            border: none;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(0, 74, 153, 0.25);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-submit-gateway:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(0, 74, 153, 0.35);
            background: linear-gradient(135deg, #001f42 0%, #003a78 100%);
        }

        .divider-or {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 28px 0;
            color: #94a3b8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .divider-or::before, .divider-or::after {
            content: '';
            flex: 1;
            border-bottom: 1.5px solid #e2e8f0;
        }

        .divider-or:not(:empty)::before { margin-right: 18px; }
        .divider-or:not(:empty)::after { margin-left: 18px; }
    </style>
</head>
<body>

    @include('navigation')

    <div class="gateway-wrapper">
        <div class="container">
            <div class="gateway-card">
                
                <!-- HEADER BRANDING -->
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center p-2 rounded-4 mb-3" style="background: rgba(0, 74, 153, 0.06);">
                        <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PKTJ" style="height: 60px; margin-right: 12px;">
                        <img src="https://hubnet.kemenhub.go.id/sso/assets/img/logo-kemenhub.png" alt="Logo Kemenhub" style="height: 50px;" onerror="this.style.display='none'">
                    </div>
                    <div class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1.5 rounded-pill font-monospace mb-2 text-xs">
                        PORTAL LAYANAN INFORMASI PUBLIK RESMI
                    </div>
                    <h2 class="outfit fw-bold text-dark mb-1" style="font-size: 26px; color: #002b5c !important;">
                        Permohonan Informasi Publik PKTJ
                    </h2>
                    <p class="text-muted small mb-0" style="max-width: 600px; margin: 0 auto;">
                        Silakan pilih metode masuk melalui akun resmi SSO Kemenhub atau lengkapi data identitas pemohon di bawah ini untuk melanjutkan pengisian permohonan informasi.
                    </p>
                </div>

                <!-- OPTION 1: SSO KEMENHUB (HUBNET) BUTTON -->
                <div class="mb-4">
                    <a href="https://hubnet.kemenhub.go.id/sso/" target="_blank" class="btn-sso-kemenhub" id="btnSsoKemenhub">
                        <i class="fas fa-key fs-4 text-warning"></i>
                        <div class="text-start">
                            <span class="d-block" style="font-size: 15px;">Masuk via SSO Kemenhub (Hubnet)</span>
                            <span class="d-block text-white-50" style="font-size: 11px; font-weight: 500;">Single Sign-On Terintegrasi Kementerian Perhubungan</span>
                        </div>
                        <i class="fas fa-arrow-up-right-from-square ms-auto text-cyan"></i>
                    </a>
                </div>

                <div class="divider-or">ATAU ISI DATA PEMOHON LANGSUNG</div>

                <!-- TABS: FORM IDENTITAS PEMOHON LANGSUNG -->
                <div class="gateway-tab-nav">
                    <button type="button" class="gateway-tab-btn active" id="tabBtnGuest" onclick="switchGatewayTab('guest')">
                        <i class="fas fa-id-card"></i> Isi Data Pemohon (Cepat)
                    </button>
                    <button type="button" class="gateway-tab-btn" id="tabBtnLogin" onclick="switchGatewayTab('login')">
                        <i class="fas fa-user-lock"></i> Masuk Akun Terdaftar
                    </button>
                </div>

                <!-- TAB 1: GUEST / IDENTITAS CEPAT FORM -->
                <div id="paneGuest" class="tab-pane-content">
                    <form action="{{ route('permohonan.auth-session') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6 form-floating-custom">
                                <label><i class="fas fa-user text-primary me-1"></i> Nama Lengkap (Sesuai KTP/Identitas) <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pemohon" required class="form-control-gateway" placeholder="Contoh: Budi Santoso" value="{{ old('nama_pemohon') }}">
                            </div>

                            <div class="col-md-6 form-floating-custom">
                                <label><i class="fas fa-id-card text-primary me-1"></i> Nomor Identitas (NIK KTP / SIM / Paspor) <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_identitas" required class="form-control-gateway" placeholder="Contoh: 3328xxxxxxxxxxxx" value="{{ old('nomor_identitas') }}">
                            </div>

                            <div class="col-md-6 form-floating-custom">
                                <label><i class="fas fa-envelope text-primary me-1"></i> Alamat Email Aktif <span class="text-danger">*</span></label>
                                <input type="email" name="email" required class="form-control-gateway" placeholder="nama@email.com" value="{{ old('email') }}">
                            </div>

                            <div class="col-md-6 form-floating-custom">
                                <label><i class="fab fa-whatsapp text-success me-1"></i> Nomor HP / WhatsApp Aktif <span class="text-danger">*</span></label>
                                <input type="tel" name="no_telp" required class="form-control-gateway" placeholder="Contoh: 081234567890" value="{{ old('no_telp') }}">
                            </div>

                            <div class="col-md-6 form-floating-custom">
                                <label><i class="fas fa-briefcase text-primary me-1"></i> Pekerjaan / Profesi</label>
                                <input type="text" name="pekerjaan" class="form-control-gateway" placeholder="Mahasiswa / Karyawan / Peneliti / Umum" value="{{ old('pekerjaan') }}">
                            </div>

                            <div class="col-md-6 form-floating-custom">
                                <label><i class="fas fa-map-marker-alt text-primary me-1"></i> Alamat Domisili Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="alamat" required class="form-control-gateway" placeholder="Jalan, RT/RW, Kelurahan, Kota/Kabupaten" value="{{ old('alamat') }}">
                            </div>
                        </div>

                        <div class="alert alert-light border d-flex align-items-center gap-3 rounded-3 p-3 my-3">
                            <i class="fas fa-shield-alt text-success fs-4"></i>
                            <div class="small text-muted">
                                Data identitas ini digunakan untuk verifikasi pencatatan resmi buku register permohonan informasi PPID PKTJ sesuai Undang-Undang No. 14 Tahun 2008.
                            </div>
                        </div>

                        <button type="submit" class="btn-submit-gateway">
                            <span>Lanjutkan ke Formulir Permohonan Informasi</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>

                <!-- TAB 2: LOGIN AKUN TERDAFTAR -->
                <div id="paneLogin" class="tab-pane-content d-none">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <div class="form-floating-custom">
                            <label><i class="fas fa-envelope text-primary me-1"></i> Email Terdaftar <span class="text-danger">*</span></label>
                            <input type="email" name="email" required class="form-control-gateway" placeholder="nama@email.com">
                        </div>

                        <div class="form-floating-custom">
                            <label><i class="fas fa-lock text-primary me-1"></i> Kata Sandi <span class="text-danger">*</span></label>
                            <input type="password" name="password" required class="form-control-gateway" placeholder="Masukkan kata sandi">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                <label class="form-check-label small text-muted" for="rememberMe">Ingat Saya</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="small text-primary fw-bold text-decoration-none">Lupa Password?</a>
                        </div>

                        <button type="submit" class="btn-submit-gateway">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Masuk & Buka Formulir</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchGatewayTab(tab) {
            const btnGuest = document.getElementById('tabBtnGuest');
            const btnLogin = document.getElementById('tabBtnLogin');
            const paneGuest = document.getElementById('paneGuest');
            const paneLogin = document.getElementById('paneLogin');

            if (tab === 'guest') {
                btnGuest.classList.add('active');
                btnLogin.classList.remove('active');
                paneGuest.classList.remove('d-none');
                paneLogin.classList.add('d-none');
            } else {
                btnGuest.classList.remove('active');
                btnLogin.classList.add('active');
                paneGuest.classList.add('d-none');
                paneLogin.classList.remove('d-none');
            }
        }
    </script>
</body>
</html>
