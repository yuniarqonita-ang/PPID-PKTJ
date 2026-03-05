<?php

// Simple URL router to redirect Laravel routes to static HTML files
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

// Remove leading slash
$path = ltrim($path, '/');

// Route mapping
$routes = [
    // Home page
    '' => 'index.html',
    '/' => 'index.html',

    // Admin routes - redirect to Laravel admin
    'admin' => 'laravel_admin_redirect.php',
    'login' => 'laravel_login_redirect.php',

    // Profil PPID
    'profil/ppid' => 'profil-ppid.html',
    'profil/tugas-tanggung-jawab' => 'profil-tugas-tanggung-jawab.html',
    'profil/visi-misi' => 'profil-visi-misi.html',
    'profil/struktur-organisasi' => 'profil-struktur-organisasi.html',
    'profil/regulasi' => 'profil-regulasi.html',
    'profil/kontak' => 'profil-kontak.html',

    // Informasi Publik
    'informasi-publik/berkala' => 'informasi-berkala.html',
    'informasi-publik/serta-merta' => 'informasi-serta-merta.html',
    'informasi-publik/setiap-saat' => 'informasi-setiap-saat.html',
    'informasi-publik/dikecualikan' => 'informasi-dikecualikan.html',

    // Layanan Informasi
    'layanan-informasi/daftar' => 'daftar-informasi-publik.html',
    'layanan-informasi/maklumat' => 'maklumat-pelayanan.html',
    'layanan-informasi/laporan' => 'laporan-layanan-informasi.html',
    'layanan-informasi/laporan-akses' => 'laporan-akses-informasi-publik.html',
    'layanan-informasi/laporan-survey' => 'laporan-survey-kepuasan.html',

    // Prosedur
    'prosedur/sop-permintaan-informasi' => 'sop-permintaan-informasi.html',
    'prosedur/sop-penanganan-keberatan' => 'sop-penanganan-keberatan.html',
    'prosedur/sop-pengajuan-sengketa' => 'sop-pengajuan-sengketa.html',
    'prosedur/sop-penetapan-pemutakhiran' => 'sop-penetapan-pemutakhiran.html',
    'prosedur/sop-pengujian-konsekuensi' => 'sop-pengujian-konsekuensi.html',
    'prosedur/sop-pendokumentasian' => 'sop-pendokumentasian.html',

    // Other pages
    'faq' => 'faq.html',
    'permohonan-informasi' => 'permohonan-informasi.html',
    'signup' => 'signup.html',
];

// Check if the path matches a route
if (array_key_exists($path, $routes)) {
    $htmlFile = $routes[$path];
    $filePath = __DIR__ . '/' . $htmlFile;

    // Check if the HTML file exists
    if (file_exists($filePath)) {
        // Serve the HTML file
        header('Content-Type: text/html; charset=UTF-8');
        readfile($filePath);
        exit;
    }
}

// If no route matches or file doesn't exist, serve the default index.html
if ($path === '' || $path === '/' || !file_exists(__DIR__ . '/' . $path)) {
    header('Content-Type: text/html; charset=UTF-8');
    readfile(__DIR__ . '/index.html');
    exit;
}

// For any other files (CSS, JS, images), serve them normally
if (file_exists(__DIR__ . '/' . $path)) {
    // Get the file extension
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    // Set appropriate content type
    $contentTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'ico' => 'image/x-icon',
        'svg' => 'image/svg+xml',
        'pdf' => 'application/pdf',
    ];

    if (isset($contentTypes[$extension])) {
        header('Content-Type: ' . $contentTypes[$extension]);
    }

    readfile(__DIR__ . '/' . $path);
    exit;
}

// If nothing matches, return 404
http_response_code(404);
echo "Page not found";
