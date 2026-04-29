<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=db_ppid_final", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM dashboards WHERE 
            `key` LIKE 'sop_%' OR 
            `key` LIKE 'sop-%' OR 
            `key` LIKE 'daftar_informasi_%' OR 
            `key` LIKE 'maklumat_%' OR 
            `key` LIKE 'laporan_%'";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "Successfully deleted " . $stmt->rowCount() . " records.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
