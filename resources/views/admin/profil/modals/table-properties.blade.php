<!-- Table Properties Modal -->
<div class="modal fade" id="tablePropertiesModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-sliders-h"></i> Properti Tabel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="tableBorder" class="form-label">Border:</label>
                    <input type="number" class="form-control bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" id="tableBorder" min="0" value="1">
                </div>
                <div class="form-group mb-3">
                    <label for="tableCellpadding" class="form-label">Cell Padding:</label>
                    <input type="number" class="form-control bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" id="tableCellpadding" min="0" value="0">
                </div>
                <div class="form-group mb-3">
                    <label for="tableCellspacing" class="form-label">Cell Spacing:</label>
                    <input type="number" class="form-control bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" id="tableCellspacing" min="0" value="0">
                </div>
                <div class="form-group mb-3">
                    <label for="tableWidth" class="form-label">Width (%):</label>
                    <input type="number" class="form-control bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" id="tableWidth" min="0" max="100" value="100">
                </div>
                <div class="form-group mb-3">
                    <label for="tableAlign" class="form-label">Alignment:</label>
                    <select class="form-select bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" id="tableAlign">
                        <option value="left">Left</option>
                        <option value="center">Center</option>
                        <option value="right">Right</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>
