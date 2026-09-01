<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk Akun - PPID PKTJ Tegal</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: #1d4ed8;
            --primary-hover: #1e40af;
            --deep-navy: #071e3d;
            --accent-gold: #ffc107;
            --bg-gradient: linear-gradient(135deg, #031b38 0%, #0a3871 50%, #1e40af 100%);
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: #031b38;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 15px;
        }

        .outfit { font-family: 'Outfit', sans-serif; }

        /* MAIN CONTAINER */
        .gateway-container {
            width: 100%;
            max-width: 1080px;
            min-height: 640px;
            background: var(--bg-gradient);
            border-radius: 28px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.45), 0 0 40px rgba(29, 78, 216, 0.25);
            display: flex;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }

        /* LEFT BRANDING PANEL */
        .left-panel {
            flex: 1.1;
            padding: 60px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(29, 78, 216, 0.35) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            border-radius: 50%;
        }

        .brand-logo-wrap {
            width: 110px;
            height: 110px;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(8px);
        }

        .brand-logo-wrap img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.3));
        }

        .brand-title {
            color: #ffffff;
            font-size: 32px;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }

        .brand-subtitle {
            color: #93c5fd;
            font-size: 14.5px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        .brand-divider {
            width: 50px;
            height: 3px;
            background: var(--accent-gold);
            border-radius: 2px;
            margin-bottom: 22px;
        }

        .brand-instansi {
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            line-height: 1.6;
        }

        .brand-instansi strong {
            color: #ffffff;
            font-weight: 700;
            display: block;
            font-size: 14px;
        }

        /* RIGHT FORM PANEL */
        .right-panel {
            flex: 1;
            background: #ffffff;
            padding: 45px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .form-icon-badge {
            width: 48px;
            height: 48px;
            background: #1d4ed8;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin: 0 auto 14px;
            box-shadow: 0 6px 16px rgba(29, 78, 216, 0.28);
        }

        .form-header-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            text-align: center;
            margin-bottom: 2px;
        }

        .form-header-desc {
            font-size: 12.5px;
            color: #64748b;
            text-align: center;
            margin-bottom: 22px;
        }

        .form-label-custom {
            font-size: 12.5px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-control-custom {
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13.5px;
            transition: all 0.2s ease;
            width: 100%;
            background: #ffffff;
        }

        .form-control-custom:focus {
            border-color: #1d4ed8;
            outline: none;
            box-shadow: 0 0 0 3.5px rgba(29, 78, 216, 0.12);
        }

        .btn-submit-login {
            background: #1d4ed8;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 11px 16px;
            font-size: 14px;
            font-weight: 700;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.25);
            cursor: pointer;
        }

        .btn-submit-login:hover {
            background: #1e40af;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(29, 78, 216, 0.35);
        }

        .or-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 18px 0;
            color: #94a3b8;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .or-divider::before, .or-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .or-divider:not(:empty)::before { margin-right: .75em; }
        .or-divider:not(:empty)::after { margin-left: .75em; }

        .btn-auth-secondary {
            background: #ffffff;
            color: #334155;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            padding: 9.5px 14px;
            font-size: 13px;
            font-weight: 600;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none !important;
            transition: all 0.2s ease;
            margin-bottom: 10px;
        }

        .btn-auth-secondary:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            color: #0f172a;
        }

        .btn-register-outline {
            background: #f1f5f9;
            color: #1e293b;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 9.5px 14px;
            font-size: 13px;
            font-weight: 700;
            width: 100%;
            display: block;
            text-align: center;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }

        .btn-register-outline:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-direct-form {
            background: #ecfdf5;
            color: #047857;
            border: 1.5px solid #a7f3d0;
            border-radius: 10px;
            padding: 9px 14px;
            font-size: 12.5px;
            font-weight: 700;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none !important;
            transition: all 0.2s ease;
            margin-top: 12px;
        }

        .btn-direct-form:hover {
            background: #d1fae5;
            color: #065f46;
        }

        .footer-copyright {
            font-size: 11px;
            color: #94a3b8;
            text-align: center;
            margin-top: 20px;
        }

        @media (max-width: 860px) {
            .gateway-container { flex-direction: column; border-radius: 20px; }
            .left-panel { padding: 40px 20px; }
            .right-panel { padding: 35px 20px; }
        }
    </style>
</head>
<body>

    <div class="gateway-container">
        
        <!-- LEFT BRANDING -->
        <div class="left-panel">
            <div class="brand-logo-wrap">
                <img src="{{ asset('images/logo-pktj.png') }}" alt="Logo PKTJ Tegal">
            </div>
            
            <h1 class="brand-title outfit">PPID</h1>
            <div class="brand-subtitle">Pejabat Pengelola Informasi dan Dokumentasi</div>
            
            <div class="brand-divider"></div>
            
            <div class="brand-instansi">
                Badan Pengembangan Sumber Daya Manusia Perhubungan<br>
                <strong>Politeknik Keselamatan Transportasi Jalan Tegal</strong>
                Kementerian Perhubungan Republik Indonesia
            </div>

            <div class="mt-4 pt-2">
                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1.5 opacity-80" style="font-size: 12px;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- RIGHT LOGIN FORM (EXACT ATM BPSDMP STYLE) -->
        <div class="right-panel">
            <div class="form-icon-badge">
                <i class="fas fa-file-lines"></i>
            </div>
            
            <h2 class="form-header-title outfit">Masuk ke Akun Anda</h2>
            <p class="form-header-desc">Layanan Portal Informasi Publik PPID PKTJ</p>

            @if(session('error'))
                <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info py-2 px-3 small rounded-3 mb-3">
                    <i class="fas fa-info-circle me-1"></i> {{ session('info') }}
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label-custom">Username / Email</label>
                    <input type="text" name="login" class="form-control-custom" placeholder="Username atau email" value="{{ old('login') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label-custom mb-0">Password</label>
                        <a href="javascript:void(0)" onclick="alert('Silakan hubungi admin PPID PKTJ di nomor (0283) 351061 atau email humas@pktj.ac.id untuk reset kata sandi Anda.')" class="text-decoration-none small text-muted" style="font-size: 11.5px;">Lupa password?</a>
                    </div>
                    <div class="position-relative">
                        <input type="password" name="password" id="inputPassword" class="form-control-custom pe-5" placeholder="Password" required>
                        <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-muted pe-3" onclick="togglePasswordVisibility()" style="background: transparent;">
                            <i class="fas fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                    <label class="form-check-label text-muted small" for="rememberMe" style="font-size: 12px;">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn-submit-login">
                    Masuk
                </button>
            </form>

            <div class="or-divider">ATAU</div>

            <a href="{{ route('auth.google') }}" class="btn-auth-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                Login dengan Google
            </a>

            <a href="https://hubnet.dephub.go.id/sso/" target="_blank" class="btn-auth-secondary">
                <i class="fas fa-key text-primary"></i>
                Masuk dengan SSO Kemenhub
            </a>

            <div class="or-divider">BELUM PUNYA AKUN?</div>

            <a href="{{ route('register') }}" class="btn-register-outline">
                Daftar Sekarang
            </a>

            <a href="{{ route('permohonan.create') }}" class="btn-direct-form">
                <i class="fas fa-pen-to-square"></i> Langsung Isi Formulir Tanpa Login
            </a>

            <div class="footer-copyright">
                &copy; {{ date('Y') }} PPID PKTJ Kemenhub. Hak Cipta Dilindungi.
            </div>
        </div>

    </div>

    <script>
        function togglePasswordVisibility() {
            const pwd = document.getElementById('inputPassword');
            const icon = document.getElementById('togglePasswordIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
