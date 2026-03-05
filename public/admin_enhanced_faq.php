<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-question-circle me-3"></i>
        Kelola FAQ
    </h1>
    <p class="page-subtitle">
        Kelola Frequently Asked Questions (FAQ) website PPID
    </p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>
                    Daftar FAQ
                </h5>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                    <i class="fas fa-plus me-1"></i>Tambah FAQ
                </button>
            </div>
            <div class="card-body">
                <div class="accordion" id="faqAccordion">
                    <!-- FAQ items will be loaded here -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                <strong>Apa itu PPID?</strong>
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                PPID adalah Pejabat Pengelola Informasi dan Dokumentasi yang bertugas mengelola informasi publik di Politeknik Keselamatan Transportasi Jalan Tegal.
                                <div class="mt-2">
                                    <button class="btn btn-outline-primary btn-sm me-1">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                <strong>Bagaimana cara mengajukan permintaan informasi?</strong>
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Anda dapat mengajukan permintaan informasi melalui formulir online di halaman "Permohonan Informasi" atau datang langsung ke kantor PPID.
                                <div class="mt-2">
                                    <button class="btn btn-outline-primary btn-sm me-1">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                <strong>Berapa lama waktu pemenuhan permintaan informasi?</strong>
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Waktu pemenuhan permintaan informasi adalah maksimal 10 hari kerja untuk informasi biasa dan 7 hari kerja untuk informasi penting sesuai UU KIP.
                                <div class="mt-2">
                                    <button class="btn btn-outline-primary btn-sm me-1">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>
                    Statistik FAQ
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="h4 mb-0 text-primary">12</div>
                        <small class="text-muted">Total FAQ</small>
                    </div>
                    <div class="col-6">
                        <div class="h4 mb-0 text-success">8</div>
                        <small class="text-muted">Aktif</small>
                    </div>
                </div>

                <hr class="my-3">

                <div class="small">
                    <div class="mb-2">
                        <i class="fas fa-eye text-info me-1"></i>
                        Dilihat: 1,247 kali bulan ini
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-search text-success me-1"></i>
                        Pencarian: 89 pertanyaan bulan ini
                    </div>
                    <div class="mb-0">
                        <i class="fas fa-star text-warning me-1"></i>
                        Rating: 4.6/5 (89 ulasan)
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
                        FAQ akan muncul di halaman publik
                    </small>
                </div>

                <a href="/faq" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                    <i class="fas fa-external-link-alt me-1"></i>Lihat Halaman FAQ
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Add FAQ Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah FAQ Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" placeholder="Masukkan pertanyaan...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jawaban</label>
                        <textarea class="form-control" rows="4" placeholder="Masukkan jawaban..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-control">
                            <option value="umum">Umum</option>
                            <option value="permohonan">Permohonan Informasi</option>
                            <option value="keberatan">Keberatan</option>
                            <option value="prosedur">Prosedur</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success">Simpan FAQ</button>
            </div>
        </div>
    </div>
</div>
