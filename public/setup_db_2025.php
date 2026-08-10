<?php
// Standalone Database Setup and Cache Clear Script for PPID PKTJ
define('LARAVEL_START', microtime(true));

header('Content-Type: text/html; charset=utf-8');

// Load Composer Autoloader and Bootstrap Laravel Application
if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
} else {
    // cPanel Method B path where core is inside Laravel-Core directory
    require __DIR__.'/../Laravel-Core/vendor/autoload.php';
    $app = require_once __DIR__.'/../Laravel-Core/bootstrap/app.php';
}

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap(); // Boot strap the application to load facades and providers!

echo "<html><head><title>PPID PKTJ Database Setup</title>";
echo "<style>body { font-family: sans-serif; line-height: 1.5; padding: 20px; max-width: 800px; margin: 0 auto; background: #f8fafc; color: #1e293b; }";
echo "h2 { color: #004a99; border-bottom: 2px solid #ffc107; padding-bottom: 10px; }";
echo ".success { color: #15803d; background: #dcfce7; padding: 10px; border-left: 4px solid #16a34a; margin: 10px 0; border-radius: 4px; }";
echo ".error { color: #b91c1c; background: #fee2e2; padding: 10px; border-left: 4px solid #dc2626; margin: 10px 0; border-radius: 4px; }";
echo ".info { color: #1e3a8a; background: #dbeafe; padding: 10px; border-left: 4px solid #2563eb; margin: 10px 0; border-radius: 4px; }";
echo "</style></head><body>";

echo "<h2>Starting PPID PKTJ Database Setup and Cache Clearing...</h2>";

// 1. Clear Route Cache manually first (bypassing route cache)
$cacheDir = $app->bootstrapPath().'/cache';
$routeCacheFile = $cacheDir.'/routes-v7.php';
$routeCacheFileOld = $cacheDir.'/routes.php';
$deletedCache = false;

if (file_exists($routeCacheFile)) {
    if (@unlink($routeCacheFile)) {
        echo "<div class='success'>✓ Deleted route cache file: <code>routes-v7.php</code></div>";
        $deletedCache = true;
    } else {
        echo "<div class='error'>✗ Found but failed to delete route cache file: <code>routes-v7.php</code></div>";
    }
}
if (file_exists($routeCacheFileOld)) {
    if (@unlink($routeCacheFileOld)) {
        echo "<div class='success'>✓ Deleted route cache file: <code>routes.php</code></div>";
        $deletedCache = true;
    }
}

if (!$deletedCache && !file_exists($routeCacheFile) && !file_exists($routeCacheFileOld)) {
    echo "<div class='info'>i No route cache files found to delete (routing is dynamic).</div>";
}

// 2. Run Migrations
try {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    echo "<div class='success'>✓ Migrations completed successfully!</div>";
} catch (\Exception $e) {
    echo "<div class='error'>✗ Migration Error: " . $e->getMessage() . "</div>";
}

// 3. Run DipSeeder (Excel data)
try {
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'DipSeeder', '--force' => true]);
    echo "<div class='success'>✓ DipSeeder (103 data rows from Excel) completed successfully!</div>";
} catch (\Exception $e) {
    echo "<div class='error'>✗ DipSeeder Error: " . $e->getMessage() . "</div>";
}

// 4. Run UpdateProfilSeeder
try {
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'UpdateProfilSeeder', '--force' => true]);
    echo "<div class='success'>✓ UpdateProfilSeeder completed successfully!</div>";
} catch (\Exception $e) {
    echo "<div class='error'>✗ UpdateProfilSeeder Error: " . $e->getMessage() . "</div>";
}

// Run DefaultMenuSeeder
try {
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'DefaultMenuSeeder', '--force' => true]);
    echo "<div class='success'>✓ DefaultMenuSeeder (Navbar) completed successfully!</div>";
} catch (\Exception $e) {
    echo "<div class='error'>✗ DefaultMenuSeeder Error: " . $e->getMessage() . "</div>";
}

// 5. Force update the video file in DB to the actual cPanel filename
try {
    \Illuminate\Support\Facades\DB::table('dashboards')->updateOrInsert(
        ['key' => 'hero_video_file'],
        [
            'value' => 'dashboard/hero_vid_1780650873.mp4',
            'type'  => 'text',
            'aktif' => true,
            'updated_at' => date('Y-m-d H:i:s')
        ]
    );
    \Illuminate\Support\Facades\DB::table('dashboards')->updateOrInsert(
        ['key' => 'hero_video_link'],
        [
            'value' => '',
            'type'  => 'text',
            'aktif' => true,
            'updated_at' => date('Y-m-d H:i:s')
        ]
    );
    echo "<div class='success'>✓ Hero video path forced in database to: <code>dashboard/hero_vid_1780650873.mp4</code></div>";
} catch (\Exception $e) {
    echo "<div class='error'>✗ Video DB update error: " . $e->getMessage() . "</div>";
}

// 6. Clear caches
try {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    echo "<div class='success'>✓ Laravel application cache, views, config, and routes cleared successfully!</div>";
} catch (\Exception $e) {
    echo "<div class='error'>✗ Cache Clear Error: " . $e->getMessage() . "</div>";
}

// 7. Reset OPcache if available
if (function_exists('opcache_reset')) {
    if (@\opcache_reset()) {
        echo "<div class='success'>✓ PHP OPcache reset successfully!</div>";
    } else {
        echo "<div class='info'>i OPcache reset returned false (may be disabled or empty).</div>";
    }
} else {
    echo "<div class='info'>i OPcache extension is not loaded/enabled in PHP config.</div>";
}

echo "<div class='info' style='background: #eff6ff; border-left-color: #3b82f6;'>";
echo "<h3 style='margin-top:0; color:#1d4ed8;'>🎉 PPID PKTJ is fully configured!</h3>";
echo "<p>Please login to your admin panel using:</p>";
echo "<ul>";
echo "<li><strong>Email:</strong> admin@pktj.ac.id</li>";
echo "<li><strong>Password:</strong> admin123</li>";
echo "</ul>";
echo "</div>";

echo "</body></html>";
