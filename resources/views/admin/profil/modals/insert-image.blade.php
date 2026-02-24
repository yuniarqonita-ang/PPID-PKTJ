<!-- Insert Image Modal -->
<div class="modal fade" id="insertImageModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-image"></i> Sisipkan / Edit Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="media-tabs">
                    <button class="tab-btn active" data-tab="general">General</button>
                    <button class="tab-btn" data-tab="advanced">Advanced</button>
                </div>

                <div class="tab-content active" id="general">
                    <div class="form-group">
                        <label>Source:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="imageSource" placeholder="URL gambar">
                            <button class="btn btn-outline-primary"><i class="fas fa-folder-open"></i></button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Image Description:</label>
                            <input type="text" class="form-control" placeholder="Deskripsi gambar (untuk aksesibilitas)">
                        </div>
                        <div class="form-group">
                            <label>Dimensions:</label>
                            <div class="input-row">
                                <input type="text" class="form-control" placeholder="Width">
                                <span>x</span>
                                <input type="text" class="form-control" placeholder="Height">
                                <input type="checkbox" checked> <label>Constrain proportions</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="advanced">
                    <div class="form-group">
                        <label>Style:</label>
                        <input type="text" class="form-control" placeholder="CSS style">
                    </div>
                    <div class="form-group">
                        <label>Vertical Space:</label>
                        <input type="number" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label>Border:</label>
                        <input type="number" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label>Horizontal Space:</label>
                        <input type="number" class="form-control" placeholder="0">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>
