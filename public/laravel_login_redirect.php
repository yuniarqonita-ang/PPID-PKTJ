<?php
// Redirect to Laravel login page
// This bridges the simple routing to the Laravel auth system

// Check if Laravel can handle the request
$laravelLoginUrl = '/login'; // Laravel login route

// For now, redirect to the Laravel login page
header('Location: ' . $laravelLoginUrl);
exit;
?>
