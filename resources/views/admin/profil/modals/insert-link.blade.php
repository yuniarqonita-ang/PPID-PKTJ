<!-- Insert Link Modal -->
<div class="modal fade" id="insertLinkModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-link"></i> Sisipkan Tautan / Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="linkUrl"><i class="fas fa-globe"></i> URL</label>
                    <div class="input-group">
                        <input type="url" class="form-control" id="linkUrl" placeholder="https://example.com" value="https://">
                        <button class="btn-file-manager" type="button">
                            <i class="fas fa-folder-open"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="linkText"><i class="fas fa-heading"></i> Teks yang Ditampilkan</label>
                    <input type="text" class="form-control" id="linkText" placeholder="Teks yang akan ditampilkan di halaman">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="linkTitle"><i class="fas fa-info-circle"></i> Judul (Optional)</label>
                    <input type="text" class="form-control" id="linkTitle" placeholder="Judul yang muncul saat hover">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="linkTarget"><i class="fas fa-crosshairs"></i> Target</label>
                    <select class="form-select" id="linkTarget">
                        <option value="">- Pilih -</option>
                        <option value="none">None</option>
                        <option value="_blank">New Window</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="insertLink()">OK</button>
            </div>
        </div>
    </div>
</div>
