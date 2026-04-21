<!DOCTYPE html>
<html>
<head>
    <title>Simple Login Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .debug { background: yellow; padding: 10px; margin: 10px 0; border: 1px solid orange; }
        .success { background: lightgreen; padding: 10px; margin: 10px 0; border: 1px solid green; }
        .error { background: lightcoral; padding: 10px; margin: 10px 0; border: 1px solid red; }
    </style>
</head>
<body>
    <h1>Simple Login Test</h1>
    <p>This is a basic form without any JavaScript to test if form submission works.</p>

    <?php
    session_start();

    if (isset($_POST['submit_login'])) {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        echo "<div class='debug'>";
        echo "<strong>DEBUG INFO:</strong><br>";
        echo "Form submitted: YES<br>";
        echo "Username received: '$username'<br>";
        echo "Password received: '$password'<br>";
        echo "Expected: 'admin@pktj.ac.id' / 'admin123'<br>";

        if ($username === 'admin@pktj.ac.id' && $password === 'admin123') {
            echo "<span style='color: green;'>✓ CREDENTIALS MATCH!</span><br>";
            $_SESSION['admin_logged_in'] = true;
            echo "<span style='color: blue;'>→ Redirecting to admin dashboard...</span>";
            header('Location: admin.php');
            exit;
        } else {
            echo "<span style='color: red;'>✗ CREDENTIALS DON'T MATCH</span><br>";
        }
        echo "</div>";
    }
    ?>

    <form method="POST" action="">
        <div style="margin: 10px 0;">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required
                   value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
        </div>

        <div style="margin: 10px 0;">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" name="submit_login" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Login to Dashboard
        </button>
    </form>

    <hr>
    <p><strong>Test Credentials:</strong></p>
    <ul>
        <li>Username: <code>admin@pktj.ac.id</code></li>
        <li>Password: <code>admin123</code></li>
    </ul>
</body>
</html>
