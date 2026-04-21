<?php
// Note: session_start() is now handled in admin.php before any HTML output
// session_start(); // Removed to prevent "headers already sent" error

// Simple admin authentication
$ADMIN_USERNAME = 'admin@pktj.ac.id';
$ADMIN_PASSWORD = 'admin123';

// Check if logged in
function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Login check
if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Debug output
    error_log("Login attempt - Username: '$username', Password: '$password'");
    error_log("Expected - Username: '$ADMIN_USERNAME', Password: '$ADMIN_PASSWORD'");

    if ($username === $ADMIN_USERNAME && $password === $ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        error_log("Login successful, redirecting to admin.php");
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
        error_log("Login failed - credentials don't match");
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// If not logged in and not on login page, redirect to login
if (!isLoggedIn() && basename($_SERVER['PHP_SELF']) !== 'login.php') {
    header('Location: login.php');
    exit;
}
?>
