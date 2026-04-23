<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error - PPID PKTJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            backdrop-filter: blur(10px);
        }
        .error-code {
            font-size: 120px;
            font-weight: 800;
            color: #e74c3c;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            line-height: 1;
        }
        .error-title {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 18px;
            color: #7f8c8d;
            margin-bottom: 40px;
            line-height: 1.6;
        }
        .btn-home {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
            color: white;
            text-decoration: none;
        }
        .error-icon {
            font-size: 80px;
            color: #e74c3c;
            margin-bottom: 30px;
            opacity: 0.8;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #7f8c8d;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #2c3e50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        
        <div class="error-code">500</div>
        
        <h1 class="error-title">Oops! Server Error</h1>
        
        <p class="error-message">
            Maaf, terjadi kesalahan pada server kami. Kami sedang bekerja untuk memperbaiki masalah ini. 
            Silakan coba kembali dalam beberapa saat.
        </p>
        
        <a href="{{ url('/') }}" class="btn-home">
            <i class="fas fa-home me-2"></i> Kembali ke Beranda
        </a>
        
        <br>
        
        <a href="{{ url('/admin') }}" class="back-link">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Panel Admin
        </a>
    </div>
    
    <script>
        // Auto refresh after 10 seconds
        setTimeout(function() {
            window.location.reload();
        }, 10000);
    </script>
</body>
</html>
