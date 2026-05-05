<!DOCTYPE html>
<html>
<head>
    <title>Login Debug Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: 0 auto; }
        .debug { background: #f0f0f0; padding: 15px; border: 1px solid #ccc; margin: 10px 0; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        .info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; }
        pre { background: #f8f8f8; padding: 10px; border: 1px solid #ddd; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>🔍 Login Debug Test</h1>
    <p>This page helps debug why login isn't working.</p>

    <div class="debug info">
        <h3>Session Status:</h3>
        <?php
        session_start();
        echo "<p>Session ID: " . session_id() . "</p>";
        echo "<p>Session Started: " . (isset($_SESSION) ? "YES" : "NO") . "</p>";
        echo "<p>Admin Logged In: " . (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] ? "YES" : "NO") . "</p>";
        ?>
    </div>

    <div class="debug">
        <h3>POST Data Check:</h3>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "<p>✓ Form submitted via POST</p>";
            echo "<p>Login button clicked: " . (isset($_POST['debug_login']) ? "YES" : "NO") . "</p>";
            echo "<p>Username: '" . (trim($_POST['debug_username'] ?? '')) . "'</p>";
            echo "<p>Password: '" . (trim($_POST['debug_password'] ?? '')) . "'</p>";
        } else {
            echo "<p>❌ No POST data received</p>";
        }
        ?>
    </div>

    <div class="debug">
        <h3>Authentication Test:</h3>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['debug_login'])) {
            $username = trim($_POST['debug_username'] ?? '');
            $password = trim($_POST['debug_password'] ?? '');
            $expected_user = 'admin@pktj.ac.id';
            $expected_pass = 'admin123';

            echo "<p>Expected Username: '$expected_user'</p>";
            echo "<p>Expected Password: '$expected_pass'</p>";
            echo "<p>Username Match: " . ($username === $expected_user ? "YES" : "NO") . "</p>";
            echo "<p>Password Match: " . ($password === $expected_pass ? "YES" : "NO") . "</p>";

            if ($username === $expected_user && $password === $expected_pass) {
                echo "<p class='success'>✅ AUTHENTICATION SUCCESSFUL!</p>";
                $_SESSION['admin_logged_in'] = true;
                echo "<p>Session set. Redirecting in 3 seconds...</p>";
                echo "<script>setTimeout(function(){ window.location.href = 'admin.php'; }, 3000);</script>";
            } else {
                echo "<p class='error'>❌ AUTHENTICATION FAILED</p>";
            }
        } else {
            echo "<p>Submit the form below to test authentication</p>";
        }
        ?>
    </div>

    <form method="POST" style="margin: 20px 0; padding: 20px; border: 1px solid #ccc;">
        <h3>Test Login Form:</h3>
        <div style="margin: 10px 0;">
            <label>Username:</label><br>
            <input type="text" name="debug_username" required style="width: 100%; padding: 8px;">
        </div>
        <div style="margin: 10px 0;">
            <label>Password:</label><br>
            <input type="password" name="debug_password" required style="width: 100%; padding: 8px;">
        </div>
        <button type="submit" name="debug_login" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">
            Test Login
        </button>
    </form>

    <div class="debug">
        <h3>Server Info:</h3>
        <p>PHP Version: <?php echo phpversion(); ?></p>
        <p>Request Method: <?php echo $_SERVER['REQUEST_METHOD']; ?></p>
        <p>Script Name: <?php echo basename($_SERVER['PHP_SELF']); ?></p>
    </div>

    <div style="margin: 20px 0;">
        <a href="login.php" style="color: #007bff;">← Back to Login Page</a> |
        <a href="admin.php" style="color: #007bff;">Go to Admin Dashboard →</a>
    </div>
</body>
</html>
