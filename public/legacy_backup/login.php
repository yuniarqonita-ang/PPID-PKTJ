<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin PPID PKTJ Tegal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a3a52 0%, #2d5f8d 50%, #d4af37 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
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
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(5px) rotate(-1deg); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow:
                0 20px 60px rgba(0,0,0,0.1),
                0 0 0 1px rgba(255,255,255,0.2);
            overflow: hidden;
            max-width: 420px;
            width: 100%;
            position: relative;
            z-index: 1;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #1a3a52 0%, #2d5f8d 100%);
            color: white;
            padding: 35px 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
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

        .login-header .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .login-header img {
            height: 65px;
            margin-right: 18px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            transition: transform 0.3s ease;
        }

        .login-header img:hover {
            transform: scale(1.05);
        }

        .login-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 30px;
            color: #d4af37;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            letter-spacing: 1px;
        }

        .login-header p {
            margin: 8px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
            font-weight: 300;
        }

        .login-body {
            padding: 45px 35px;
        }

        .form-floating {
            margin-bottom: 25px;
            position: relative;
        }

        .form-control {
            border: 2px solid rgba(26, 58, 82, 0.1);
            border-radius: 12px;
            padding: 16px 50px 16px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .form-control:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            background: white;
            transform: translateY(-2px);
        }

        .form-control:focus + .password-toggle,
        .password-toggle {
            color: #d4af37;
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #1a3a52;
            transform: translateY(-50%) scale(1.1);
        }

        .form-floating label {
            color: #1a3a52;
            font-weight: 500;
            padding-left: 5px;
        }

        .btn-login {
            background: linear-gradient(135deg, #1a3a52 0%, #2d5f8d 100%);
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-size: 18px;
            font-weight: 600;
            width: 100%;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(26, 58, 82, 0.3);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(26, 58, 82, 0.4);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 12px;
            border: none;
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            backdrop-filter: blur(10px);
        }

        .login-footer {
            text-align: center;
            padding: 25px 35px;
            background: rgba(248, 249, 250, 0.8);
            backdrop-filter: blur(10px);
            color: #6c757d;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .login-footer a {
            color: #1a3a52;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-footer a:hover {
            color: #d4af37;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                max-width: none;
            }

            .login-header {
                padding: 25px 20px;
            }

            .login-header h2 {
                font-size: 24px;
            }

            .login-body {
                padding: 35px 25px;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    <?php include 'admin_auth.php'; ?>

    <div class="login-container">
        <div class="login-header">
            <div class="logo-section">
                <img src="images/logo-pktj.png" alt="Logo PKTJ">
                <h2>Admin Panel</h2>
            </div>
            <p>Portal Pengelola Informasi dan Dokumentasi<br>Politeknik Keselamatan Transportasi Jalan Tegal</p>
        </div>

        <div class="login-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-floating">
                    <input type="text" class="form-control" id="username" name="username"
                           placeholder="Username" required autocomplete="username">
                    <label for="username">
                        <i class="fas fa-user me-2"></i>Username
                    </label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Password" required autocomplete="current-password">
                    <i class="fas fa-eye password-toggle" onclick="togglePassword()" style="cursor: pointer;"></i>
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                </div>

                <button type="submit" name="login" class="btn btn-login" id="loginBtn">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Dashboard
                </button>
            </form>
        </div>

        <div class="login-footer">
            <small>
                <i class="fas fa-info-circle me-1"></i>
                Gunakan akun admin yang telah diberikan untuk mengakses panel ini
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add enter key support for form submission
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const form = input.closest('form');
                        const submitBtn = form.querySelector('button[type="submit"]');
                        submitBtn.click();
                    }
                });
            });

            // Add focus effects
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => {
                control.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                control.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });
        });
    </script>
