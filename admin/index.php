<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - PPID PKTJ Tegal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #004a99;
            color: white;
        }
        .sidebar .nav-link {
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 0.25rem 0;
        }
        .sidebar .nav-link:hover {
            background-color: #2d5f8d;
            color: white;
        }
        .sidebar .nav-link.active {
            background-color: #d4af37;
            color: #1a3a52;
        }
        .main-content {
            min-height: 100vh;
            padding: 2rem;
        }
        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 15px;
        }
        .btn-primary {
            background-color: #004a99;
            border-color: #004a99;
        }
        .btn-primary:hover {
            background-color: #2d5f8d;
            border-color: #2d5f8d;
        }
        .btn-warning {
            background-color: #d4af37;
            border-color: #d4af37;
            color: #1a3a52;
        }
        .btn-warning:hover {
            background-color: #c9a227;
            border-color: #c9a227;
        }
        .table th {
            background-color: #004a99;
            color: white;
        }
        .form-control:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
        }
    </style>
</head>
<body>
    <?php require_once '../includes/database.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <h5 class="text-center mb-4">Admin Panel</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#pages" data-bs-toggle="pill">
                                <i class="fas fa-file-alt me-2"></i>Halaman
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#informasi" data-bs-toggle="pill">
                                <i class="fas fa-info-circle me-2"></i>Informasi Publik
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#regulasi" data-bs-toggle="pill">
                                <i class="fas fa-gavel me-2"></i>Regulasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#berita" data-bs-toggle="pill">
                                <i class="fas fa-newspaper me-2"></i>Berita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#faq" data-bs-toggle="pill">
                                <i class="fas fa-question-circle me-2"></i>FAQ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#kontak" data-bs-toggle="pill">
                                <i class="fas fa-address-book me-2"></i>Kontak
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="tab-content">
                    <!-- Pages Tab -->
                    <div class="tab-pane fade show active" id="pages">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Manajemen Halaman</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Slug</th>
                                                <th>Judul</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $pages = getPages();
                                            foreach ($pages as $page) {
                                                echo '<tr>';
                                                echo '<td>' . $page['slug'] . '</td>';
                                                echo '<td>' . $page['title'] . '</td>';
                                                echo '<td><span class="badge bg-' . ($page['status'] == 'active' ? 'success' : 'danger') . '">' . $page['status'] . '</span></td>';
                                                echo '<td>';
                                                echo '<button class="btn btn-sm btn-warning me-1" onclick="editPage(' . $page['id'] . ')"><i class="fas fa-edit"></i></button>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Page Form -->
                        <div class="card" id="editPageForm" style="display: none;">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Halaman</h5>
                            </div>
                            <div class="card-body">
                                <form id="pageEditForm">
                                    <input type="hidden" id="pageId">
                                    <div class="mb-3">
                                        <label for="pageSlug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="pageSlug" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pageTitle" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="pageTitle" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pageContent" class="form-label">Konten</label>
                                        <textarea class="form-control" id="pageContent" rows="10" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pageMetaDescription" class="form-label">Meta Description</label>
                                        <input type="text" class="form-control" id="pageMetaDescription">
                                    </div>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="cancelEditPage()">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Publik Tab -->
                    <div class="tab-pane fade" id="informasi">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Manajemen Informasi Publik</h5>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-warning mb-3" onclick="showAddInformasiForm()">
                                    <i class="fas fa-plus me-2"></i>Tambah Informasi
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kategori</th>
                                                <th>Judul</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $informasi = getInformasiPublik();
                                            foreach ($informasi as $item) {
                                                echo '<tr>';
                                                echo '<td>' . ucfirst(str_replace('_', ' ', $item['kategori'])) . '</td>';
                                                echo '<td>' . $item['judul'] . '</td>';
                                                echo '<td><span class="badge bg-' . ($item['status'] == 'active' ? 'success' : 'danger') . '">' . $item['status'] . '</span></td>';
                                                echo '<td>';
                                                echo '<button class="btn btn-sm btn-warning me-1" onclick="editInformasi(' . $item['id'] . ')"><i class="fas fa-edit"></i></button>';
                                                echo '<button class="btn btn-sm btn-danger" onclick="deleteInformasi(' . $item['id'] . ')"><i class="fas fa-trash"></i></button>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Regulasi Tab -->
                    <div class="tab-pane fade" id="regulasi">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-gavel me-2"></i>Manajemen Regulasi</h5>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-warning mb-3" onclick="showAddRegulasiForm()">
                                    <i class="fas fa-plus me-2"></i>Tambah Regulasi
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Jenis</th>
                                                <th>Judul</th>
                                                <th>Tahun</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $regulasi = getRegulasi();
                                            foreach ($regulasi as $item) {
                                                echo '<tr>';
                                                echo '<td>' . ucfirst(str_replace('_', ' ', $item['jenis'])) . '</td>';
                                                echo '<td>' . $item['judul'] . '</td>';
                                                echo '<td>' . $item['tahun'] . '</td>';
                                                echo '<td><span class="badge bg-' . ($item['status'] == 'active' ? 'success' : 'danger') . '">' . $item['status'] . '</span></td>';
                                                echo '<td>';
                                                echo '<button class="btn btn-sm btn-warning me-1" onclick="editRegulasi(' . $item['id'] . ')"><i class="fas fa-edit"></i></button>';
                                                echo '<button class="btn btn-sm btn-danger" onclick="deleteRegulasi(' . $item['id'] . ')"><i class="fas fa-trash"></i></button>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Tab -->
                    <div class="tab-pane fade" id="faq">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>Manajemen FAQ</h5>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-warning mb-3" onclick="showAddFAQForm()">
                                    <i class="fas fa-plus me-2"></i>Tambah FAQ
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Pertanyaan</th>
                                                <th>Kategori</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $faqs = getFAQ();
                                            foreach ($faqs as $item) {
                                                echo '<tr>';
                                                echo '<td>' . $item['pertanyaan'] . '</td>';
                                                echo '<td>' . $item['kategori'] . '</td>';
                                                echo '<td><span class="badge bg-' . ($item['status'] == 'active' ? 'success' : 'danger') . '">' . $item['status'] . '</span></td>';
                                                echo '<td>';
                                                echo '<button class="btn btn-sm btn-warning me-1" onclick="editFAQ(' . $item['id'] . ')"><i class="fas fa-edit"></i></button>';
                                                echo '<button class="btn btn-sm btn-danger" onclick="deleteFAQ(' . $item['id'] . ')"><i class="fas fa-trash"></i></button>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editPage(id) {
            // Load page data and show edit form
            fetch('get_page.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('pageId').value = data.id;
                    document.getElementById('pageSlug').value = data.slug;
                    document.getElementById('pageTitle').value = data.title;
                    document.getElementById('pageContent').value = data.content;
                    document.getElementById('pageMetaDescription').value = data.meta_description;
                    document.getElementById('editPageForm').style.display = 'block';
                });
        }

        function cancelEditPage() {
            document.getElementById('editPageForm').style.display = 'none';
            document.getElementById('pageEditForm').reset();
        }

        function editInformasi(id) {
            // Load informasi data and show edit form
            console.log('Edit informasi:', id);
        }

        function deleteInformasi(id) {
            if (confirm('Apakah Anda yakin ingin menghapus informasi ini?')) {
                fetch('delete_informasi.php?id=' + id)
                    .then(() => location.reload());
            }
        }

        function editRegulasi(id) {
            // Load regulasi data and show edit form
            console.log('Edit regulasi:', id);
        }

        function deleteRegulasi(id) {
            if (confirm('Apakah Anda yakin ingin menghapus regulasi ini?')) {
                fetch('delete_regulasi.php?id=' + id)
                    .then(() => location.reload());
            }
        }

        function editFAQ(id) {
            // Load FAQ data and show edit form
            console.log('Edit FAQ:', id);
        }

        function deleteFAQ(id) {
            if (confirm('Apakah Anda yakin ingin menghapus FAQ ini?')) {
                fetch('delete_faq.php?id=' + id)
                    .then(() => location.reload());
            }
        }

        // Form submission
        document.getElementById('pageEditForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('update_page.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Halaman berhasil diperbarui!');
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            });
        });
    </script>
</body>
</html>
