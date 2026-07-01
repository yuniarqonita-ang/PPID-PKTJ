<?php
$lines = file('c:/laragon/www/PPID-PKTJ/scratch/B1_B4_extracted.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$parsed = [];

// Join wrapped lines first
$joinedLines = [];
$tempLine = '';

foreach ($lines as $line) {
    $line = trim($line);
    if (preg_match('/^\d{2}\/\d{2}\/2024/', $line)) {
        if ($tempLine !== '') {
            $joinedLines[] = $tempLine;
        }
        $tempLine = $line;
    } else {
        if ($tempLine !== '') {
            $tempLine .= ' ' . $line;
        } else {
            $joinedLines[] = $line;
        }
    }
}
if ($tempLine !== '') {
    $joinedLines[] = $tempLine;
}

foreach ($joinedLines as $line) {
    $line = trim($line);
    // Find date: DD/MM/YYYY
    if (preg_match('/(\d{2})\/(\d{2})\/(2024)/', $line, $dateMatches, PREG_OFFSET_CAPTURE)) {
        $dateStr = $dateMatches[0][0];
        $datePos = $dateMatches[0][1];
        
        // Convert to YYYY-MM-DD
        $parts = explode('/', $dateStr);
        $dbDate = "2024-" . $parts[1] . "-" . $parts[0];
        
        // Text after the date
        $afterDate = trim(substr($line, $datePos + strlen($dateStr)));
        
        // Find status: Dipenuhi or Ditolak or Proses
        $status = 'selesai';
        $statusPos = false;
        if (preg_match('/(Dipenuhi|Ditolak|Proses)/', $afterDate, $statusMatches, PREG_OFFSET_CAPTURE)) {
            $statusRaw = $statusMatches[0][0];
            $statusPos = $statusMatches[0][1];
            $status = ($statusRaw === 'Dipenuhi') ? 'selesai' : (($statusRaw === 'Ditolak') ? 'ditolak' : 'diproses');
        }
        
        if ($statusPos !== false) {
            // Text between date and status
            $between = trim(substr($afterDate, 0, $statusPos));
            
            // Text after status
            $afterStatus = trim(substr($afterDate, $statusPos + strlen($statusRaw)));
            
            // Channel and days
            $channel = 'Media Sosial';
            $days = 1;
            if (preg_match('/(Media Sosial|E-PPID\/Website|Medsos|Website)/i', $afterStatus, $channelMatches, PREG_OFFSET_CAPTURE)) {
                $channel = $channelMatches[0][0];
                $afterChannel = trim(substr($afterStatus, $channelMatches[0][1] + strlen($channel)));
                if (preg_match('/(\d+([.,]\d+)?)/', $afterChannel, $dayMatches)) {
                    $days = floatval(str_replace(',', '.', $dayMatches[1]));
                }
            } else {
                if (preg_match('/(\d+([.,]\d+)?)/', $afterStatus, $dayMatches)) {
                    $days = floatval(str_replace(',', '.', $dayMatches[1]));
                }
            }
            
            // Normalise channel name
            if (stripos($channel, 'Medsos') !== false || stripos($channel, 'Media Sosial') !== false) {
                $channel = 'Media Sosial';
            } elseif (stripos($channel, 'Website') !== false || stripos($channel, 'E-PPID') !== false) {
                $channel = 'E-PPID/Website';
            }
            
            // Now parse $between into Name, Alamat, and Rincian
            // Format: "Name Origin Rincian..."
            // Let's split by spaces. Typically: name is first word, origin is second word, the rest is description
            $words = preg_split('/\s+/', $between);
            $name = isset($words[0]) ? $words[0] : 'Visitor';
            $alamat = isset($words[1]) ? $words[1] : 'Tegal';
            $rincian = implode(' ', array_slice($words, 2));
            
            if (empty($rincian)) {
                $rincian = $between;
            }
            
            $parsed[] = [
                'tanggal' => $dbDate,
                'nama' => $name,
                'alamat' => $alamat,
                'rincian' => $rincian,
                'status' => $status,
                'channel' => $channel,
                'days' => $days
            ];
        }
    }
}

echo "Total parsed: " . count($parsed) . "\n";
echo "First 5 parsed:\n";
print_r(array_slice($parsed, 0, 5));
?>
