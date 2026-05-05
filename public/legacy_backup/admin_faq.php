<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-question-circle me-3"></i>
        Kelola FAQ
    </h1>
    <p class="page-subtitle">
        Edit pertanyaan dan jawaban yang sering ditanyakan pada halaman FAQ
    </p>
</div>

<!-- FAQ Overview -->
<div class="row">
    <div class="col-12">
        <div class="card-custom">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-question-circle me-2"></i>
                    Frequently Asked Questions
                </h5>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                    <i class="fas fa-plus me-1"></i>Tambah FAQ
                </button>
            </div>
            <div class="card-body">
                <!-- FAQ Categories -->
                <div class="mb-4">
                    <h6 class="mb-3">Kategori FAQ:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-primary px-3 py-2">Permohonan Informasi</span>
                        <span class="badge bg-success px-3 py-2">Prosedur Layanan</span>
                        <span class="badge bg-warning px-3 py-2">Biaya & Tarif</span>
                        <span class="badge bg-danger px-3 py-2">Keberatan & Sengketa</span>
                        <span class="badge bg-secondary px-3 py-2">Umum</span>
                    </div>
                </div>

                <!-- FAQ List -->
                <div class="accordion" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                    <span>Bagaimana cara mengajukan permohonan informasi publik?</span>
                                    <div>
                                        <span class="badge bg-primary me-2">Permohonan</span>
                                        <span class="text-muted small">Aktif</span>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Untuk mengajukan permohonan informasi publik, Anda dapat:</p>
                                <ol>
                                    <li>Mengisi formulir permohonan secara online</li>
                                    <li>Mengirim surat resmi ke alamat PPID PKTJ</li>
                                    <li>Melakukan permohonan langsung ke kantor PPID</li>
                                </ol>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                    <span>Berapa lama waktu yang dibutuhkan untuk mendapatkan informasi?</span>
                                    <div>
                                        <span class="badge bg-success me-2">Prosedur</span>
                                        <span class="text-muted small">Aktif</span>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Waktu penyediaan informasi publik adalah maksimal 10 hari kerja, kecuali:</p>
                                <ul>
                                    <li>Informasi yang dapat diberikan secara serta merta: maksimal 1 hari</li>
                                    <li>Informasi yang memerlukan pengujian konsekuensi: maksimal 30 hari</li>
                                    <li>Informasi yang dikecualikan: dapat ditolak</li>
                                </ul>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                    <span>Apakah ada biaya untuk mendapatkan informasi publik?</span>
                                    <div>
                                        <span class="badge bg-warning me-2">Biaya</span>
                                        <span class="text-muted small">Aktif</span>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Biaya penggandaan informasi publik ditetapkan berdasarkan:</p>
                                <ul>
                                    <li>Fotokopi: Rp 500,- per lembar</li>
                                    <li>Print berwarna: Rp 1.000,- per lembar</li>
                                    <li>CD/DVD: Rp 10.000,- per keping</li>
                                    <li>Flashdisk: Rp 25.000,- per buah</li>
                                </ul>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary btn-sm me-2">
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
</div>

<!-- Statistics -->
<div class="row">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-info text-white">
                <i class="fas fa-question-circle"></i>
            </div>
            <div class="stats-number">15</div>
            <div class="stats-title">Total FAQ</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-success text-white">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stats-number">15</div>
            <div class="stats-title">FAQ Aktif</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-warning text-white">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stats-number">2,340</div>
            <div class="stats-title">Dilihat Bulan Ini</div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stats-card">
            <div class="stats-icon bg-primary text-white">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stats-number">5</div>
            <div class="stats-title">Kategori</div>
        </div>
    </div>
</div>

<!-- Add FAQ Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>Tambah FAQ Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="faq_question" class="form-label fw-bold">Pertanyaan</label>
                        <input type="text" class="form-control" id="faq_question" name="faq_question"
                               placeholder="Masukkan pertanyaan..." required>
                    </div>

                    <div class="mb-3">
                        <label for="faq_answer" class="form-label fw-bold">Jawaban</label>
                        <textarea class="form-control" id="faq_answer" name="faq_answer"
                                  rows="6" placeholder="Masukkan jawaban lengkap..." required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="faq_category" class="form-label fw-bold">Kategori</label>
                                <select class="form-control" id="faq_category" name="faq_category" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="permohonan">Permohonan Informasi</option>
                                    <option value="prosedur">Prosedur Layanan</option>
                                    <option value="biaya">Biaya & Tarif</option>
                                    <option value="keberatan">Keberatan & Sengketa</option>
                                    <option value="umum">Umum</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="faq_status" class="form-label fw-bold">Status</label>
                                <select class="form-control" id="faq_status" name="faq_status" required>
                                    <option value="active">Aktif</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="faq_order" class="form-label fw-bold">Urutan</label>
                        <input type="number" class="form-control" id="faq_order" name="faq_order"
                               placeholder="1" min="1">
                        <div class="form-text">Urutan tampilan FAQ (angka kecil akan tampil lebih atas)</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save me-1"></i>Simpan FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .accordion-button:not(.collapsed) {
        background-color: var(--primary-color);
        color: white;
    }

    .accordion-button:focus {
        box-shadow: none;
    }

    .badge {
        font-size: 11px;
    }

    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .modal-header {
        border-radius: 15px 15px 0 0;
    }
</style>
