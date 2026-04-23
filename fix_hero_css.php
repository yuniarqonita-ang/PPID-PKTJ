<?php
$dir = __DIR__ . '/resources/views';
$files = glob($dir . '/*.blade.php');

$newHeroCss = "        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            text-align: center;
            position: relative;
        }

        .hero-content { position: relative; z-index: 10; }";

$regex1 = '/\/\* Hero Section \*\/\s*\.hero-section \{[\s\S]*?\.hero-content \{[^\}]+\}/m';
$regex2 = '/\.hero-section \{[\s\S]*?\.hero-content \{[^\}]+\}/m';

foreach ($files as $file) {
    if (strpos($file, 'admin') !== false) continue;
    
    $content = file_get_contents($file);
    $original = $content;
    
    if (preg_match($regex1, $content)) {
        $content = preg_replace($regex1, $newHeroCss, $content);
    } else if (preg_match('/\.hero-section\s*\{[\s\S]*?text-align:\s*center;\s*\}/m', $content, $matches)) {
        // Fallback for informasi-berkala, informasi-serta-merta, etc.
        $basicCss = "        .hero-section {
            background: linear-gradient(rgba(0, 74, 153, 0.8), rgba(0, 74, 153, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: white;
            text-align: center;
        }";
        $content = preg_replace('/\.hero-section\s*\{[\s\S]*?text-align:\s*center;\s*\}/m', $basicCss, $content);
    }
    
    if ($content !== $original) {
        file_put_contents($file, $content);
        echo "Updated: " . basename($file) . "\n";
    }
}
echo "Done.\n";
