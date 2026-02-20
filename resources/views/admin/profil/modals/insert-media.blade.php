<!-- Insert Media Modal -->
<div class="modal fade" id="insertMediaModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-film"></i> Sisipkan / Edit Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="media-tabs">
                    <button class="tab-btn active" data-tab="general">General</button>
                    <button class="tab-btn" data-tab="embed">Embed</button>
                    <button class="tab-btn" data-tab="advanced">Advanced</button>
                </div>

                <div class="tab-content active" id="general">
                    <div class="form-group">
                        <label>Source:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="mediaSource" placeholder="URL media">
                            <button class="btn btn-outline-primary"><i class="fas fa-folder-open"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dimensions:</label>
                        <div class="input-row">
                            <input type="text" class="form-control" placeholder="Width" id="mediaWidth">
                            <span>x</span>
                            <input type="text" class="form-control" placeholder="Height" id="mediaHeight">
                            <input type="checkbox" id="constrainProportions"> 
                            <label for="constrainProportions">Constrain proportions</label>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="embed">
                    <label>Paste your embed code below:</label>
                    <textarea class="form-control" id="embedCode" rows="6" placeholder="Paste embed code here..."></textarea>
                </div>

                <div class="tab-content" id="advanced">
                    <div class="form-group">
                        <label>Alternative Source:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Alternative URL">
                            <button class="btn btn-outline-primary"><i class="fas fa-folder-open"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Poster:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Poster URL">
                            <button class="btn btn-outline-primary"><i class="fas fa-folder-open"></i></button>
                        </div>
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
