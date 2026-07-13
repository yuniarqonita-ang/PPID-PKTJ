<?php
$content = file_get_contents('routes/web.php');
if (strpos($content, "Route::get('/berita'") === false) {
    $content .= "\n// Public Berita Routes\n";
    $content .= "Route::get('/berita', [\\App\\Http\\Controllers\\BeritaController::class, 'publicIndex'])->name('berita.public');\n";
    $content .= "Route::get('/berita/{slug}', [\\App\\Http\\Controllers\\BeritaController::class, 'publicShow'])->name('berita.public.show');\n";
    file_put_contents('routes/web.php', $content);
    echo "Added public berita routes\n";
} else {
    echo "Routes already exist\n";
}
