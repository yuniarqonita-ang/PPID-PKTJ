<!DOCTYPE html>
<html>
<head>
    <title>Test Login</title>
</head>
<body>
    <h1>Test Login Form</h1>

    <?php
    session_start();

    if (isset($_POST['test_login'])) {
        $username = trim($_POST['test_username'] ?? '');
        $password = trim($_POST['test_password'] ?? '');

        echo "<h2>DEBUG INFO:</h2>";
        echo "<p>Username received: '$username'</p>";
        echo "<p>Password received: '$password'</p>";
        echo "<p>Expected: 'admin@pktj.ac.id' / 'admin123'</p>";

        if ($username === 'admin@pktj.ac.id' && $password === 'admin123') {
            echo "<p style='color: green;'>LOGIN SUCCESSFUL!</p>";
            $_SESSION['admin_logged_in'] = true;
            header('Location: admin.php');
            exit;
        } else {
            echo "<p style='color: red;'>LOGIN FAILED</p>";
        }
    }
    ?>

    <form method="POST">
        <label>Username:</label>
        <input type="text" name="test_username" required><br><br>

        <label>Password:</label>
        <input type="password" name="test_password" required><br><br>

        <button type="submit" name="test_login">Test Login</button>
    </form>
</body>
</html>
