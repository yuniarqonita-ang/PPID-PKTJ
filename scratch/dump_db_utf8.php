<?php
// Dump database db_ppid_final to database.sql in UTF-8
$dbHost = '127.0.0.1';
$dbName = 'db_ppid_final';
$dbUser = 'root';
$dbPass = '';

try {
    $output = [];
    $return_var = 0;
    exec("mysqldump -u root --default-character-set=utf8mb4 db_ppid_final", $output, $return_var);
    
    if ($return_var === 0) {
        $sql = implode("\n", $output);
        // Save as standard UTF-8
        file_put_contents('database.sql', $sql);
        echo "DATABASE_DUMP_SUCCESS";
    } else {
        echo "Error running mysqldump: " . implode("\n", $output);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
