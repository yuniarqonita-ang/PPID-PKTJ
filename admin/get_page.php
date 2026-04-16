<?php
require_once '../includes/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;
    
    if ($id) {
        // Get single page
        $stmt = $pdo->prepare("SELECT * FROM pages WHERE id = ?");
        $stmt->execute([$id]);
        $page = $stmt->fetch();
        
        if ($page) {
            echo json_encode(['success' => true, 'data' => $page]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Halaman tidak ditemukan']);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $slug = $_POST['slug'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $meta_description = $_POST['meta_description'] ?? null;
    $meta_keywords = $_POST['meta_keywords'] ?? null;
    
    try {
        $stmt = $pdo->prepare("UPDATE pages SET title = ?, content = ?, meta_description = ?, meta_keywords = ? WHERE id = ?");
        $stmt->execute([$title, $content, $meta_description, $meta_keywords, $id]);
        
        echo json_encode(['success' => true, 'message' => 'Halaman berhasil diperbarui']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
