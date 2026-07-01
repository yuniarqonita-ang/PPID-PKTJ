<?php
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('resources/views'));
foreach($it as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, '<head>') !== false && strpos($content, '<link rel="icon"') === false) {
            $content = str_replace('<head>', "<head>\n    <link rel=\"icon\" type=\"image/png\" href=\"{{ asset('images/logo-pktj.png') }}\">", $content);
            file_put_contents($file->getPathname(), $content);
        }
    }
}
echo "Done.";
