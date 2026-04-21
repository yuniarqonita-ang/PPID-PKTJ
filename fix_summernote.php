<?php
$dir = new RecursiveDirectoryIterator('c:/laragon/www/PPID-PKTJ/resources/views/admin');
$ite = new RecursiveIteratorIterator($dir);

$count = 0;
foreach($ite as $file) {
    if(pathinfo($file, PATHINFO_EXTENSION) == 'php') {
        $c = file_get_contents($file);
        $original = $c;
        
        // Remove Summernote comments
        $c = preg_replace('/<!-- Summernote (JS & CSS|Editor Scripts) -->\s*/i', '', $c);
        
        // Remove Summernote CSS link
        $c = preg_replace('/<link href="[^"]*summernote[^"]*" rel="stylesheet">\s*/i', '', $c);
        
        // Remove Summernote JS script
        $c = preg_replace('/<script src="[^"]*summernote[^\"]*"><\/script>\s*/i', '', $c);
        
        // Expand deskripsi rows
        $c = preg_replace('/name="deskripsi" id="deskripsi" rows="3"/i', 'name="deskripsi" id="deskripsi" rows="6"', $c);

        if($c !== $original) {
            file_put_contents($file, $c);
            echo "Cleaned: " . $file->getPathname() . "\n";
            $count++;
        }
    }
}
echo "Total processed: $count\n";
