<?php
function getYoutubeEmbedUrl($url) {
    if (!$url) return null;
    $url = trim($url);
    $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([^"&?\/ ]{11})/i';
    if (preg_match($pattern, $url, $matches)) {
        return "https://www.youtube.com/embed/" . $matches[1];
    }
    if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
        return "https://www.youtube.com/embed/" . $url;
    }
    return null;
}

$urls = [
    'https://www.youtube.com/watch?v=e-zh2icc4EQ',
    'https://youtu.be/e-zh2icc4EQ?si=abc',
    'https://www.youtube.com/embed/e-zh2icc4EQ',
    'https://youtube.com/shorts/e-zh2icc4EQ',
    'https://m.youtube.com/watch?v=e-zh2icc4EQ&feature=shared',
    'e-zh2icc4EQ',
    'invalid_url'
];

foreach ($urls as $u) {
    echo "$u => " . (getYoutubeEmbedUrl($u) ?? 'NULL') . "\n";
}
