<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-file-signature me-3"></i>
        Kelola Permohonan Informasi
    </h1>
    <p class="page-subtitle">
        Kelola permohonan informasi yang masuk dari masyarakat
    </p>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-primary">
                <i class="fas fa-inbox"></i>
            </div>
            <div class="stats-number">24</div>
            <div class="stats-title">Total Permohonan</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-number">8</div>
            <div class="stats-title">Menunggu Proses</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stats-number">12</div>
            <div class="stats-title">Sudah Dipenuhi</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-danger">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stats-number">4</div>
            <div class="stats-title">Ditolak</div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Daftar Permohonan Informasi
                </h5>
            </div>
            <div class="card-body">
                <!-- Filter Buttons -->
                <div class="mb-3">
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-primary btn-sm active">Semua</button>
                        <button class="btn btn-outline-warning btn-sm">Menunggu</button>
                        <button class="btn btn-outline-success btn-sm">Dipenuhi</button>
                        <button class="btn btn-outline-danger btn-sm">Ditolak</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th><i class="fas fa-calendar me-1"></i>Tanggal</th>
                                <th><i class="fas fa-user me-1"></i>Pemohon</th>
                                <th><i class="fas fa-file-alt me-1"></i>Informasi Diminta</th>
                                <th><i class="fas fa-clock me-1"></i>Status</th>
                                <th><i class="fas fa-cogs me-1"></i>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/12/2024</td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Ahmad Santoso</div>
                                        <small class="text-muted">ahmad@email.com</small>
                                    </div>
                                </td>
                                <td>Data mahasiswa aktif 2024</td>
                                <td>
                                    <span class="badge bg-success">Dipenuhi</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary btn-action">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success btn-action">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>14/12/2024</td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Siti Nurhaliza</div>
                                        <small class="text-muted">siti@email.com</small>
                                    </div>
                                </td>
                                <td>Laporan keuangan 2023</td>
                                <td>
                                    <span class="badge bg-warning">Menunggu</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary btn-action">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success btn-action">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-action">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>13/12/2024</td>
                                <td>
                                    <div>
                                        <div class="fw-bold">Budi Rahman</div>
                                        <small class="text-muted">budi@email.com</small>
                                    </div>
                                </td>
                                <td>Dokumen akreditasi program studi</td>
                                <td>
                                    <span class="badge bg-success">Dipenuhi</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary btn-action">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success btn-action">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Permohonan
                </h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Simulasi penambahan permohonan baru untuk testing</p>

                <button class="btn btn-success w-100 mb-2" onclick="addSampleRequest()">
                    <i class="fas fa-plus me-1"></i>Tambah Sample Request
                </button>

                <button class="btn btn-outline-primary w-100" onclick="clearAllRequests()">
                    <i class="fas fa-trash me-1"></i>Clear All Requests
                </button>
            </div>
        </div>

        <div class="card-custom mt-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie me-2"></i>
                    Ringkasan Bulan Ini
                </h5>
            </div>
            <div class="card-body">
                <div class="small">
                    <div class="mb-2">
                        <i class="fas fa-inbox text-primary me-1"></i>
                        Total masuk: 24 permohonan
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-check-circle text-success me-1"></i>
                        Disetujui: 12 permohonan (50%)
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-times-circle text-danger me-1"></i>
                        Ditolak: 4 permohonan (17%)
                    </div>
                    <div class="mb-0">
                        <i class="fas fa-clock text-warning me-1"></i>
                        Dalam proses: 8 permohonan (33%)
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom mt-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>
                    Preview Public
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-3">
                    <small>
                        <i class="fas fa-info-circle me-1"></i>
                        Formulir permohonan tersedia di halaman publik
                    </small>
                </div>

                <a href="/permohonan-informasi" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                    <i class="fas fa-external-link-alt me-1"></i>Lihat Formulir
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function addSampleRequest() {
    alert('Sample request berhasil ditambahkan! (Simulasi)');
    location.reload();
}

function clearAllRequests() {
    if (confirm('Yakin ingin menghapus semua permohonan?')) {
        alert('Semua permohonan berhasil dihapus! (Simulasi)');
        location.reload();
    }
}
</script>
