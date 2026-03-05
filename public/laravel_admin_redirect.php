<?php
// Redirect to Laravel admin dashboard
// This bridges the simple routing to the Laravel admin system

// Check if Laravel can handle the request
$laravelAdminUrl = '/admin'; // Laravel admin route

// For now, redirect to the Laravel admin dashboard
header('Location: ' . $laravelAdminUrl);
exit;
?>
