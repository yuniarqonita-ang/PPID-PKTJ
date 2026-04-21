<?php
require_once '../includes/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    try {
        $stmt = $pdo->prepare("UPDATE pages SET title = ?, content = ?, meta_description = ?, meta_keywords = ? WHERE id = ?");
        $stmt->execute([$_POST['title'], $_POST['content'], $_POST['meta_description'] ?? null, $_POST['meta_keywords'] ?? null, $id]);
        
        echo json_encode(['success' => true, 'message' => 'Halaman berhasil diperbarui']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
