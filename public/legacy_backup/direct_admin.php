<!DOCTYPE html>
<html>
<head>
    <title>Direct Admin Access Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .test-box { background: white; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .info { color: blue; }
    </style>
</head>
<body>
    <h1>🔐 Direct Admin Access Test</h1>
    <p>This page tests if the admin dashboard exists and can be accessed directly.</p>

    <div class="test-box">
        <h3>Admin Files Check:</h3>
        <?php
        $adminFiles = [
            'admin.php',
            'admin_auth.php',
            'admin_dashboard.php',
            'admin_profil.php',
            'admin_informasi.php',
            'admin_layanan.php',
            'admin_faq.php'
        ];

        foreach ($adminFiles as $file) {
            $exists = file_exists(__DIR__ . '/' . $file);
            $size = $exists ? filesize(__DIR__ . '/' . $file) : 0;
            echo "<p>";
            echo $exists ?
                "<span class='success'>✅ $file ($size bytes)</span>" :
                "<span class='error'>❌ $file - MISSING</span>";
            echo "</p>";
        }
        ?>
    </div>

    <div class="test-box">
        <h3>Session Test:</h3>
        <?php
        session_start();
        echo "<p>Session ID: " . session_id() . "</p>";
        echo "<p>Session Started: <span class='success'>YES</span></p>";

        // Force set admin session for testing
        $_SESSION['admin_logged_in'] = true;
        echo "<p>Admin Session Set: <span class='success'>YES</span></p>";
        ?>
    </div>

    <div class="test-box">
        <h3>Direct Links to Admin Pages:</h3>
        <ul>
            <li><a href="admin.php" target="_blank">📊 Open Admin Dashboard</a></li>
            <li><a href="admin.php?page=dashboard" target="_blank">📈 Admin Dashboard (with page param)</a></li>
            <li><a href="admin.php?page=profil" target="_blank">👤 Admin Profil</a></li>
            <li><a href="admin.php?page=informasi" target="_blank">ℹ️ Admin Informasi</a></li>
            <li><a href="admin.php?page=layanan" target="_blank">🛠️ Admin Layanan</a></li>
            <li><a href="admin.php?page=faq" target="_blank">❓ Admin FAQ</a></li>
        </ul>
    </div>

    <div class="test-box">
        <h3>Quick Login Test:</h3>
        <form method="POST" action="admin_auth_test.php">
            <label>Username:</label>
            <input type="text" name="test_username" value="admin@pktj.ac.id" required><br><br>

            <label>Password:</label>
            <input type="password" name="test_password" value="admin123" required><br><br>

            <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Test Login & Redirect
            </button>
        </form>
    </div>

    <div style="margin: 20px 0;">
        <a href="login.php" style="color: #007bff;">← Back to Login Page</a> |
        <a href="debug_login.php" style="color: #007bff;">🔍 Go to Debug Page</a>
    </div>
</body>
</html>
