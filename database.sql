-- Database: ppid_pktj
-- Struktur database untuk manajemen konten website PPID PKTJ

-- Tabel untuk halaman statis
CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(255) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    meta_description TEXT,
    meta_keywords TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Tabel untuk informasi publik
CREATE TABLE informasi_publik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategori ENUM('berkala', 'setiap_saat', 'serta_merta') NOT NULL,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Tabel untuk regulasi
CREATE TABLE regulasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis ENUM('undang_undang', 'peraturan_komisi', 'peraturan_menteri', 'keputusan_presiden') NOT NULL,
    nomor VARCHAR(100),
    tahun INT,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    file_path VARCHAR(255),
    download_link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Tabel untuk berita/pengumuman
CREATE TABLE berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    konten TEXT,
    gambar VARCHAR(255),
    kategori ENUM('berita', 'pengumuman') DEFAULT 'berita',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Tabel untuk SOP
CREATE TABLE sop (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    konten TEXT,
    prosedur JSON, -- untuk menyimpan langkah-langkah prosedur
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Tabel untuk FAQ
CREATE TABLE faq (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pertanyaan VARCHAR(255) NOT NULL,
    jawaban TEXT,
    kategori VARCHAR(100),
    urutan INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Tabel untuk kontak
CREATE TABLE kontak (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis ENUM('alamat', 'telepon', 'email', 'fax', 'website') NOT NULL,
    nilai VARCHAR(255) NOT NULL,
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Tabel untuk statistik
CREATE TABLE statistik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis VARCHAR(100) NOT NULL,
    nilai VARCHAR(255) NOT NULL,
    satuan VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Tabel untuk user admin
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') DEFAULT 'editor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Insert data awal
INSERT INTO pages (slug, title, content, meta_description) VALUES
('index', 'Beranda - PPID PKTJ Tegal', '<h1>Selamat datang di Portal PPID PKTJ</h1><p>Layanan Informasi Publik yang terintegrasi dan transparan</p>', 'Portal PPID PKTJ Tegal - Layanan Informasi Publik yang terintegrasi dan transparan'),
('profil-ppid', 'Profil PPID', '<h1>Profil PPID PKTJ Tegal</h1><p>Informasi mengenai profil PPID PKTJ Tegal</p>', 'Profil PPID PKTJ Tegal - Pejabat Pengelola Informasi dan Dokumentasi'),
('kontak', 'Kontak Kami', '<h1>Kontak PPID PKTJ Tegal</h1><p>Informasi kontak PPID PKTJ Tegal</p>', 'Kontak PPID PKTJ Tegal - Hubungi kami untuk informasi lebih lanjut');

INSERT INTO informasi_publik (kategori, judul, deskripsi) VALUES
('berkala', 'Profil Kementerian Perhubungan', 'Informasi mengenai profil Kementerian Perhubungan'),
('berkala', 'Profile Pejabat Kementerian Perhubungan', 'Informasi mengenai profil pejabat Kementerian Perhubungan'),
('berkala', 'Kegiatan, Program dan Rencana', 'Informasi mengenai kegiatan, program dan rencana Kementerian Perhubungan'),
('setiap_saat', 'Informasi Darurat', 'Informasi yang dapat diakses kapan saja untuk keadaan darurat'),
('serta_merta', 'Informasi Penting', 'Informasi yang harus segera disampaikan kepada publik');

INSERT INTO regulasi (jenis, nomor, tahun, judul, download_link) VALUES
('undang_undang', '25', 2009, 'Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik', 'https://ppid.dephub.go.id/fileupload/informasi-berkala/20200728111618.UU_25_Tahun_2009dsd.pdf'),
('undang_undang', '43', 2009, 'Undang-Undang Nomor 43 Tahun 2009 tentang Kearsipan', 'https://ppid.dephub.go.id/fileupload/informasi-berkala/20200728111804.UU_43_Tahun_2009cxzaaa.pdf'),
('undang_undang', '14', 2008, 'Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik', 'https://ppid.dephub.go.id/fileupload/informasi-berkala/20200728111256.uu14-2008_keterbukaan_informasi_publikascas.pdf'),
('undang_undang', '40', 1999, 'Undang-Undang Nomor 40 Tahun 1999 tentang Pers', 'https://ppid.dephub.go.id/fileupload/informasi-berkala/20200728111403.UU_No._40_Tahun_1999_Tentang_Pers_sdcds.pdf'),
('peraturan_komisi', '1', 2021, 'Peraturan Komisi Informasi Pusat Nomor 1 Tahun 2021 Tentang Standar Layanan Informasi Publik', ''),
('peraturan_komisi', '1', 2013, 'Peraturan Komisi Informasi Pusat Nomor 1 Tahun 2013 Tentang Prosedur Penyelesaian Sengketa Informasi Publik', '');

INSERT INTO faq (pertanyaan, jawaban, kategori, urutan) VALUES
('Apa itu PPID?', 'PPID adalah Pejabat Pengelola Informasi dan Dokumentasi yang bertugas menyediakan layanan informasi publik.', 'Umum', 1),
('Bagaimana cara mengajukan permohonan informasi?', 'Permohonan informasi dapat diajukan secara online melalui website atau datang langsung ke kantor PPID.', 'Prosedur', 2),
('Berapa lama waktu penyelesaian permohonan?', 'Permohonan informasi akan diproses paling lambat 10 hari kerja sejak diterima.', 'Prosedur', 3);

INSERT INTO kontak (jenis, nilai, keterangan) VALUES
('alamat', 'Jl. [Alamat Lengkap], Tegal', 'Alamat kantor PPID PKTJ Tegal'),
('telepon', '(0283) XXXXXX', 'Nomor telepon kantor'),
('email', 'info@pktj.ac.id', 'Email resmi PPID PKTJ Tegal'),
('website', 'www.ppktj.ac.id', 'Website resmi PPID PKTJ Tegal');

INSERT INTO statistik (jenis, nilai, satuan) VALUES
('informasi_publik', '1000+', 'items'),
('permohonan_per_bulan', '500+', 'permohonan'),
('tingkat_kepuasan', '98', '%'),
('layanan_online', '24/7', 'jam');

-- User admin default (password: admin123)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@ppidpktj.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
