<!-- Find & Replace Modal -->
<div class="modal fade" id="findReplaceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-search"></i> Cari & Ganti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Cari:</label>
                    <input type="text" class="form-control" id="findText" placeholder="Masukkan teks yang ingin dicari">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti dengan:</label>
                    <input type="text" class="form-control" id="replaceText" placeholder="Masukkan teks pengganti">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="matchCase">
                    <label class="form-check-label" for="matchCase">Cocokkan huruf besar/kecil</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-warning">Ganti Satu</button>
                <button type="button" class="btn btn-info">Ganti Semua</button>
            </div>
        </div>
    </div>
</div>
