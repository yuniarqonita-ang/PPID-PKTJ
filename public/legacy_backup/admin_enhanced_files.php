<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-folder-open me-3"></i>
        Kelola Files
    </h1>
    <p class="page-subtitle">
        Manage semua file yang sudah diupload dan kontrol visibilitas di halaman publik
    </p>
</div>

<!-- Files Overview -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="stats-number"><?php echo count($uploadedFiles); ?></div>
            <div class="stats-title">Total Files</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stats-number">
                <?php
                $publicFiles = array_filter($uploadedFiles, function($file) {
                    $ext = strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION));
                    return in_array($ext, ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']);
                });
                echo count($publicFiles);
                ?>
            </div>
            <div class="stats-title">Files Publik</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="fas fa-hdd"></i>
            </div>
            <div class="stats-number">
                <?php
                $totalSize = 0;
                foreach ($uploadedFiles as $file) {
                    $totalSize += $file['size'];
                }
                echo round($totalSize / 1024 / 1024, 1);
                ?>
            </div>
            <div class="stats-title">Total Size (MB)</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-danger">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-number">
                <?php
                $today = date('Y-m-d');
                $todayCount = 0;
                foreach ($uploadedFiles as $file) {
                    if (strpos($file['upload_date'], $today) === 0) {
                        $todayCount++;
                    }
                }
                echo $todayCount;
                ?>
            </div>
            <div class="stats-title">Upload Hari Ini</div>
        </div>
    </div>
</div>

<!-- Files Table -->
<div class="card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-list me-2"></i>
            Daftar File Terupload
        </h5>
        <div>
            <a href="admin_enhanced.php?page=upload" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>Upload Baru
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if (empty($uploadedFiles)): ?>
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada file yang diupload</h5>
                <p class="text-muted">Upload file pertama Anda untuk memulai</p>
                <a href="admin_enhanced.php?page=upload" class="btn btn-primary">
                    <i class="fas fa-upload me-1"></i>Upload File Pertama
                </a>
            </div>
        <?php else: ?>
            <!-- Search and Filter -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari file...">
                </div>
                <div class="col-md-3">
                    <select id="categoryFilter" class="form-control">
                        <option value="">Semua Kategori</option>
                        <option value="document">Dokumen</option>
                        <option value="image">Gambar</option>
                        <option value="spreadsheet">Spreadsheet</option>
                        <option value="presentation">Presentasi</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="sortSelect" class="form-control">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="name">Nama A-Z</option>
                        <option value="size">Ukuran</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-custom" id="filesTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-file me-1"></i>File</th>
                            <th><i class="fas fa-tags me-1"></i>Kategori</th>
                            <th><i class="fas fa-weight me-1"></i>Ukuran</th>
                            <th><i class="fas fa-calendar me-1"></i>Upload</th>
                            <th><i class="fas fa-eye me-1"></i>Status</th>
                            <th><i class="fas fa-cogs me-1"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($uploadedFiles as $file): ?>
                        <tr data-category="<?php echo $file['category']; ?>">
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php
                                    $ext = strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION));
                                    $icon = 'fa-file';
                                    $color = 'text-secondary';

                                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                        $icon = 'fa-image';
                                        $color = 'text-success';
                                    } elseif (in_array($ext, ['pdf'])) {
                                        $icon = 'fa-file-pdf';
                                        $color = 'text-danger';
                                    } elseif (in_array($ext, ['doc', 'docx'])) {
                                        $icon = 'fa-file-word';
                                        $color = 'text-primary';
                                    } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                        $icon = 'fa-file-excel';
                                        $color = 'text-success';
                                    } elseif (in_array($ext, ['ppt', 'pptx'])) {
                                        $icon = 'fa-presentation';
                                        $color = 'text-warning';
                                    }
                                    ?>

                                    <div class="me-3">
                                        <?php if (in_array($ext, ['jpg', 'jpeg', 'png']) && file_exists(__DIR__ . '/' . $file['file_path'])): ?>
                                            <img src="<?php echo htmlspecialchars($file['file_path']); ?>"
                                                 alt="Preview" class="preview-img rounded">
                                        <?php else: ?>
                                            <i class="fas <?php echo $icon; ?> fa-2x <?php echo $color; ?>"></i>
                                        <?php endif; ?>
                                    </div>

                                    <div>
                                        <div class="fw-bold"><?php echo htmlspecialchars($file['original_name']); ?></div>
                                        <small class="text-muted"><?php echo htmlspecialchars($file['description'] ?: 'Tidak ada deskripsi'); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary"><?php echo htmlspecialchars($file['category']); ?></span>
                            </td>
                            <td><?php echo round($file['size'] / 1024, 1); ?> KB</td>
                            <td>
                                <div><?php echo date('d/m/Y', strtotime($file['upload_date'])); ?></div>
                                <small class="text-muted"><?php echo date('H:i', strtotime($file['upload_date'])); ?></small>
                            </td>
                            <td>
                                <?php
                                $isPublic = in_array(strtolower(pathinfo($file['original_name'], PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'pdf']);
                                ?>
                                <span class="badge <?php echo $isPublic ? 'bg-success' : 'bg-warning'; ?>">
                                    <i class="fas <?php echo $isPublic ? 'fa-eye' : 'fa-eye-slash'; ?> me-1"></i>
                                    <?php echo $isPublic ? 'Publik' : 'Private'; ?>
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="<?php echo htmlspecialchars($file['file_path']); ?>"
                                       target="_blank" class="btn btn-sm btn-outline-primary btn-action"
                                       title="Lihat/Download">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button onclick="confirmDelete('<?php echo htmlspecialchars($file['original_name']); ?>', '<?php echo $file['id']; ?>')"
                                            class="btn btn-sm btn-outline-danger btn-action" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Menampilkan <?php echo count($uploadedFiles); ?> file dari total <?php echo count($uploadedFiles); ?> file
                </small>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Search and filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const sortSelect = document.getElementById('sortSelect');
    const tableBody = document.querySelector('#filesTable tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    function filterAndSort() {
        const searchTerm = searchInput.value.toLowerCase();
        const categoryValue = categoryFilter.value;
        const sortValue = sortSelect.value;

        let filteredRows = rows.filter(row => {
            const fileName = row.querySelector('td:first-child .fw-bold').textContent.toLowerCase();
            const category = row.dataset.category;
            const matchesSearch = fileName.includes(searchTerm);
            const matchesCategory = !categoryValue || category === categoryValue;

            return matchesSearch && matchesCategory;
        });

        // Sort rows
        filteredRows.sort((a, b) => {
            switch (sortValue) {
                case 'oldest':
                    return new Date(a.querySelector('td:nth-child(4) div').textContent.split('/').reverse().join('-')) -
                           new Date(b.querySelector('td:nth-child(4) div').textContent.split('/').reverse().join('-'));
                case 'name':
                    return a.querySelector('td:first-child .fw-bold').textContent.localeCompare(
                        b.querySelector('td:first-child .fw-bold').textContent);
                case 'size':
                    return parseFloat(a.querySelector('td:nth-child(3)').textContent) -
                           parseFloat(b.querySelector('td:nth-child(3)').textContent);
                case 'newest':
                default:
                    return new Date(b.querySelector('td:nth-child(4) div').textContent.split('/').reverse().join('-')) -
                           new Date(a.querySelector('td:nth-child(4) div').textContent.split('/').reverse().join('-'));
            }
        });

        // Clear and repopulate table
        tableBody.innerHTML = '';
        filteredRows.forEach(row => tableBody.appendChild(row));
    }

    searchInput.addEventListener('input', filterAndSort);
    categoryFilter.addEventListener('change', filterAndSort);
    sortSelect.addEventListener('change', filterAndSort);
});
</script>
