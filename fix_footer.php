<?php
$dir = __DIR__ . '/resources/views';
$files = glob($dir . '/*.blade.php');
foreach($files as $file) {
    if(basename($file) == 'footer.blade.php') continue;
    $content = file_get_contents($file);
    if(preg_match('/<footer class="footer">.*?<\/footer>/s', $content)) {
        $newContent = preg_replace('/<footer class="footer">.*?<\/footer>/s', "@include('footer')", $content);
        file_put_contents($file, $newContent);
        echo 'Updated: ' . basename($file) . PHP_EOL;
    }
}
echo "Done replacing footers.\n";
