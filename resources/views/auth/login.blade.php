<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-pktj.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ $settings['ppid_nama'] ?? 'PPID PKTJ' }}</title>
    
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
            display: flex;
            align-items: stretch;
            color: #1e293b;
        }

        .auth-container {
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: row;
        }

        /* Left Branding Panel (Navy Blue) */
        .brand-panel {
            flex: 1.1;
            background: linear-gradient(145deg, #092c55 0%, #0d3d75 50%, #004a99 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            color: white;
            text-align: center;
            position: relative;
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

        .brand-panel::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(29, 114, 184, 0.25) 0%, transparent 70%);
            bottom: -100px;
            right: -100px;
            border-radius: 50%;
        }

        .brand-content {
            position: relative;
            z-index: 10;
            max-width: 480px;
        }

        .brand-emblem {
            width: 110px;
            height: 110px;
            object-fit: contain;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
            margin-bottom: 25px;
            transition: transform 0.5s ease;
        }
        .brand-emblem:hover {
            transform: scale(1.06);
        }

        .brand-title {
            font-family: 'Outfit', sans-serif;
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            text-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .brand-subtitle {
            font-size: 1.15rem;
            font-weight: 600;
            opacity: 0.95;
            letter-spacing: 0.2px;
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
            font-weight: 400;
        }

        /* Right Form Panel */
        .form-panel {
            flex: 0.9;
            background-color: #f8faff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 30px;
            position: relative;
        }

        .form-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 45px rgba(0, 74, 153, 0.08);
            border: 1px solid #e2e8f0;
            padding: 42px 38px;
            width: 100%;
            max-width: 440px;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            font-size: 13.5px;
            color: #334155;
            margin-bottom: 7px;
        }

        .form-control {
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.25s ease;
            background-color: #ffffff;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.12);
            background-color: #ffffff;
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

        .btn-login {
            background: #1d72b8;
            background: linear-gradient(135deg, #1d72b8 0%, #004a99 100%);
            color: white;
            font-weight: 700;
            font-size: 15px;
            padding: 13px 20px;
            border-radius: 12px;
            border: none;
            width: 100%;
            box-shadow: 0 8px 20px rgba(0, 74, 153, 0.25);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #004a99 0%, #082d5a 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 74, 153, 0.35);
            color: white;
        }

        .divider-box {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 22px 0 18px;
            color: #94a3b8;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .divider-box::before, .divider-box::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .divider-box span {
            padding: 0 12px;
            text-transform: uppercase;
        }

        .btn-social {
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 11px 16px;
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .btn-social:hover {
            border-color: #cbd5e1;
            background-color: #f8fafc;
            color: #0f172a;
            transform: translateY(-1px);
        }

        .btn-register {
            background: #f1f5f9;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            width: 100%;
            display: block;
            text-align: center;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-register:hover {
            background: #e2e8f0;
            color: #004a99;
            border-color: #94a3b8;
        }

        .footer-text {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 24px;
            text-align: center;
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
        .back-to-home:hover {
            background: rgba(255,255,255,0.25);
            color: white;
        }

        @media (max-width: 991px) {
            .auth-container { flex-direction: column; }
            .brand-panel { padding: 50px 20px; flex: none; }
            .brand-emblem { width: 80px; height: 80px; margin-bottom: 15px; }
            .brand-title { font-size: 2.2rem; }
            .brand-subtitle { font-size: 1rem; }
            .form-panel { padding: 30px 15px; flex: 1; }
            .form-card { padding: 30px 22px; }
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

        <!-- Left Brand Banner (BPSDM / PKTJ Design) -->
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

        <!-- Right Login Card -->
        <div class="form-panel">
            <div class="form-card">

                @if(session('info'))
                <div class="alert alert-info py-2 px-3 rounded-3 text-xs mb-3 font-semibold" style="font-size: 13px;">
                    <i class="fas fa-info-circle me-1"></i> {{ session('info') }}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success py-2 px-3 rounded-3 text-xs mb-3 font-semibold" style="font-size: 13px;">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger py-2 px-3 rounded-3 mb-4" style="font-size: 13px;">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="login" class="form-label">Username / Email</label>
                        <input type="text" class="form-control @error('login') is-invalid @enderror" 
                            id="login" name="login" value="{{ old('login') }}" 
                            placeholder="Username atau email" required autofocus>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label mb-0">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none text-xs fw-semibold" style="color: #1d72b8; font-size: 12.5px;">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <div class="password-container">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" placeholder="Password" required>
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                                <i class="fas fa-eye" id="password-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted" for="remember" style="font-size: 13px;">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-login">
                        Masuk
                    </button>
                </form>

                <!-- Separator ATAU -->
                <div class="divider-box">
                    <span>ATAU</span>
                </div>

                <!-- Google Login Button -->
                <a href="{{ route('auth.google') }}" class="btn-social">
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span>Login dengan Google</span>
                </a>

                <!-- SSO Kemenhub Button -->
                <a href="{{ route('auth.sso-kemenhub') }}" class="btn-social">
                    <img src="{{ asset('images/logo-pktj.png') }}" width="18" height="18" alt="SSO">
                    <span>Masuk dengan SSO Kemenhub</span>
                </a>

                <!-- Separator BELUM PUNYA AKUN -->
                <div class="divider-box">
                    <span>BELUM PUNYA AKUN?</span>
                </div>

                <!-- Register Button -->
                <a href="{{ route('register') }}" class="btn-register">
                    Daftar Sekarang
                </a>

            </div>

            <!-- Footer text -->
            <div class="footer-text">
                &copy; {{ date('Y') }} {{ $settings['auth_footer_copyright'] ?? 'PPID PKTJ Kementerian Perhubungan' }}
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
    </script>
</body>
</html>
