<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST Login - Admin PPID PKTJ Tegal</title>
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
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 420px;
            width: 100%;
        }

        .login-header {
            background: linear-gradient(135deg, #1a3a52 0%, #2d5f8d 100%);
            color: white;
            padding: 35px 25px;
            text-align: center;
        }

        .login-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 30px;
            color: #d4af37;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .login-body {
            padding: 45px 35px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(26, 58, 82, 0.1);
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            background: white;
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
            box-shadow: 0 4px 15px rgba(26, 58, 82, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(26, 58, 82, 0.4);
        }

        .alert {
            border-radius: 12px;
            border: none;
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-shield-alt me-2"></i>TEST LOGIN</h2>
            <p>Portal Pengelola Informasi dan Dokumentasi<br>Politeknik Keselamatan Transportasi Jalan Tegal</p>
        </div>

        <div class="login-body">
            <?php
            // Simple test authentication without includes
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
                $username = trim($_POST['username'] ?? '');
                $password = trim($_POST['password'] ?? '');

                if ($username === 'admin@pktj.ac.id' && $password === 'admin123') {
                    session_start();
                    $_SESSION['admin_logged_in'] = true;
                    header('Location: admin_enhanced.php');
                    exit;
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Username atau password salah!
                          </div>';
                }
            }
            ?>

            <form method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username"
                           placeholder="Username" required autocomplete="username">
                    <label for="username">
                        <i class="fas fa-user me-2"></i>Username
                    </label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Password" required autocomplete="current-password">
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                </div>

                <button type="submit" name="login" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Dashboard
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">
                    <strong>Test Login:</strong> admin@pktj.ac.id / admin123
                </small>
            </div>

            <div class="text-center mt-3">
                <a href="admin_enhanced.php" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-right me-1"></i>Skip to Dashboard (Test)
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
