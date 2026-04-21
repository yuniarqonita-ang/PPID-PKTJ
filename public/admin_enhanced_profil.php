<?php
$page = isset($_GET['subpage']) ? $_GET['subpage'] : 'main';

// Handle different profil subpages
if ($page == 'ppid') {
    // Show editor for Profil PPID content
    ?>
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-building me-3"></i>
            Profil PPID
        </h1>
        <p class="page-subtitle">
            Kelola konten halaman Profil PPID
        </p>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Editor Konten Profil PPID
                    </h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Konten Profil PPID</label>
                            <textarea class="form-control" rows="15" id="profilContent" name="profil_content">Sejak Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik (UU KIP) diberlakukan secara efektif pada tanggal 30 April 2010 telah mendorong bangsa Indonesia satu langkah maju ke depan, menjadi bangsa yang transparan dan akuntabel dalam mengelola sumber daya publik. UU KIP sebagai instrumen hukum yang mengikat merupakan tonggak atau dasar bagi seluruh rakyat Indonesia untuk bersama-sama mengawasi secara langsung pelayanan publik yang diselenggarakan oleh Badan Publik.

Keterbukaan informasi adalah salah satu pilar penting yang akan mendorong terciptanya iklim transparansi. Terlebih di era yang serba terbuka ini, keinginan masyarakat untuk memperoleh informasi semakin tinggi. Diberlakukannya UU KIP merupakan perubahan yang mendasar dalam kehidupan bermasyarakat, berbangsa dan bernegara, oleh sebab itu perlu adanya kesadaran dari seluruh elemen bangsa agar setiap lembaga dan badan pemerintah dalam pengelolaan informasi harus dengan prinsip good governance, tata kelola yang baik dan akuntabilitas.</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card-custom">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-eye me-2"></i>
                        Preview Konten
                    </h5>
                </div>
                <div class="card-body">
                    <div class="border rounded p-4 bg-light">
                        <h4 class="fw-bold text-primary mb-3">PROFILE PPID</h4>
                        <p class="mb-3">Sejak Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik (UU KIP) diberlakukan secara efektif pada tanggal 30 April 2010 telah mendorong bangsa Indonesia satu langkah maju ke depan, menjadi bangsa yang transparan dan akuntabel dalam mengelola sumber daya publik. UU KIP sebagai instrumen hukum yang mengikat merupakan tonggak atau dasar bagi seluruh rakyat Indonesia untuk bersama-sama mengawasi secara langsung pelayanan publik yang diselenggarakan oleh Badan Publik.</p>

                        <p>Keterbukaan informasi adalah salah satu pilar penting yang akan mendorong terciptanya iklim transparansi. Terlebih di era yang serba terbuka ini, keinginan masyarakat untuk memperoleh informasi semakin tinggi. Diberlakukannya UU KIP merupakan perubahan yang mendasar dalam kehidupan bermasyarakat, berbangsa dan bernegara, oleh sebab itu perlu adanya kesadaran dari seluruh elemen bangsa agar setiap lembaga dan badan pemerintah dalam pengelolaan informasi harus dengan prinsip good governance, tata kelola yang baik dan akuntabilitas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    // Show main profil dashboard
    ?>
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-user-circle me-3"></i>
            Kelola Profil PPID
        </h1>
        <p class="page-subtitle">
            Kelola konten halaman profil PPID dan sub-halaman terkait
        </p>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-custom">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Daftar Halaman Profil
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-building fa-2x text-primary mb-3"></i>
                                    <h6>Profil PPID</h6>
                                    <p class="text-muted small">Informasi umum tentang PPID</p>
                                    <a href="admin_enhanced.php?page=profil-ppid&subpage=ppid" class="btn btn-primary btn-sm">Kelola</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-tasks fa-2x text-success mb-3"></i>
                                    <h6>Tugas & Tanggung Jawab</h6>
                                    <p class="text-muted small">Tugas pokok dan fungsi PPID</p>
                                    <a href="admin_enhanced.php?page=profil-tugas" class="btn btn-success btn-sm">Kelola</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-eye fa-2x text-info mb-3"></i>
                                    <h6>Visi & Misi</h6>
                                    <p class="text-muted small">Visi dan misi PPID</p>
                                    <a href="admin_enhanced.php?page=profil-visi" class="btn btn-info btn-sm">Kelola</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-sitemap fa-2x text-warning mb-3"></i>
                                    <h6>Struktur Organisasi</h6>
                                    <p class="text-muted small">Struktur organisasi PPID</p>
                                    <a href="admin_enhanced.php?page=profil-struktur" class="btn btn-warning btn-sm">Kelola</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-gavel fa-2x text-danger mb-3"></i>
                                    <h6>Regulasi</h6>
                                    <p class="text-muted small">Dasar hukum dan regulasi</p>
                                    <a href="admin_enhanced.php?page=profil-regulasi" class="btn btn-danger btn-sm">Kelola</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-address-book fa-2x text-secondary mb-3"></i>
                                    <h6>Kontak</h6>
                                    <p class="text-muted small">Informasi kontak PPID</p>
                                    <a href="admin_enhanced.php?page=profil-kontak" class="btn btn-secondary btn-sm">Kelola</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card-custom">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Editor Konten
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Pilih halaman profil di atas</strong> untuk mengedit konten masing-masing halaman.
                    </div>

                    <div class="text-center py-4">
                        <i class="fas fa-arrow-up fa-2x text-muted mb-3"></i>
                        <p class="text-muted">Klik tombol "Kelola" pada salah satu kartu di atas untuk mengedit konten</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
