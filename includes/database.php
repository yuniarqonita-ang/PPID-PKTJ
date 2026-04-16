<?php
// Database configuration for PPID PKTJ
define('DB_HOST', 'localhost');
define('DB_NAME', 'ppid_pktj');
define('DB_USER', 'root');
define('DB_PASS', '');

// Create database connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Helper functions
function getPages() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM pages WHERE status = 'active' ORDER BY slug");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPageBySlug($slug) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM pages WHERE slug = ? AND status = 'active'");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function getInformasiPublik($kategori = null) {
    global $pdo;
    if ($kategori) {
        $stmt = $pdo->prepare("SELECT * FROM informasi_publik WHERE kategori = ? AND status = 'active' ORDER BY created_at DESC");
        $stmt->execute([$kategori]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM informasi_publik WHERE status = 'active' ORDER BY kategori, created_at DESC");
        $stmt->execute();
    }
    return $stmt->fetchAll();
}

function getRegulasi($jenis = null) {
    global $pdo;
    if ($jenis) {
        $stmt = $pdo->prepare("SELECT * FROM regulasi WHERE jenis = ? AND status = 'active' ORDER BY tahun DESC, nomor");
        $stmt->execute([$jenis]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM regulasi WHERE status = 'active' ORDER BY jenis, tahun DESC, nomor");
        $stmt->execute();
    }
    return $stmt->fetchAll();
}

function getBerita($kategori = null, $limit = null) {
    global $pdo;
    $sql = "SELECT * FROM berita WHERE status = 'active'";
    $params = [];
    
    if ($kategori) {
        $sql .= " AND kategori = ?";
        $params[] = $kategori;
    }
    
    $sql .= " ORDER BY created_at DESC";
    
    if ($limit) {
        $sql .= " LIMIT ?";
        $params[] = $limit;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getFAQ($kategori = null) {
    global $pdo;
    if ($kategori) {
        $stmt = $pdo->prepare("SELECT * FROM faq WHERE kategori = ? AND status = 'active' ORDER BY urutan ASC");
        $stmt->execute([$kategori]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM faq WHERE status = 'active' ORDER BY kategori, urutan ASC");
        $stmt->execute();
    }
    return $stmt->fetchAll();
}

function getKontak() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM kontak WHERE status = 'active' ORDER BY jenis");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getStatistik() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM statistik WHERE status = 'active' ORDER BY jenis");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getSOP() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM sop WHERE status = 'active' ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll();
}

// Update functions
function updatePage($slug, $title, $content, $meta_description = null, $meta_keywords = null) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE pages SET title = ?, content = ?, meta_description = ?, meta_keywords = ? WHERE slug = ?");
    return $stmt->execute([$title, $content, $meta_description, $meta_keywords, $slug]);
}

function updateInformasiPublik($id, $kategori, $judul, $deskripsi, $file_path = null) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE informasi_publik SET kategori = ?, judul = ?, deskripsi = ?, file_path = ? WHERE id = ?");
    return $stmt->execute([$kategori, $judul, $deskripsi, $file_path, $id]);
}

function updateRegulasi($id, $jenis, $nomor, $tahun, $judul, $deskripsi, $download_link = null) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE regulasi SET jenis = ?, nomor = ?, tahun = ?, judul = ?, deskripsi = ?, download_link = ? WHERE id = ?");
    return $stmt->execute([$jenis, $nomor, $tahun, $judul, $deskripsi, $download_link, $id]);
}

// Insert functions
function insertInformasiPublik($kategori, $judul, $deskripsi, $file_path = null) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO informasi_publik (kategori, judul, deskripsi, file_path) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$kategori, $judul, $deskripsi, $file_path]);
}

function insertRegulasi($jenis, $nomor, $tahun, $judul, $deskripsi, $download_link = null) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO regulasi (jenis, nomor, tahun, judul, deskripsi, download_link) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$jenis, $nomor, $tahun, $judul, $deskripsi, $download_link]);
}

function insertBerita($judul, $konten, $gambar = null, $kategori = 'berita') {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO berita (judul, konten, gambar, kategori) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$judul, $konten, $gambar, $kategori]);
}

function insertFAQ($pertanyaan, $jawaban, $kategori = null, $urutan = 0) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO faq (pertanyaan, jawaban, kategori, urutan) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$pertanyaan, $jawaban, $kategori, $urutan]);
}

// Delete functions
function deleteInformasiPublik($id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE informasi_publik SET status = 'inactive' WHERE id = ?");
    return $stmt->execute([$id]);
}

function deleteRegulasi($id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE regulasi SET status = 'inactive' WHERE id = ?");
    return $stmt->execute([$id]);
}

function deleteBerita($id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE berita SET status = 'inactive' WHERE id = ?");
    return $stmt->execute([$id]);
}

function deleteFAQ($id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE faq SET status = 'inactive' WHERE id = ?");
    return $stmt->execute([$id]);
}
?>
