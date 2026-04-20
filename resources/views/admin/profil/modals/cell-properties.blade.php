<!-- Cell Properties Modal -->
<div class="modal fade" id="cellPropertiesModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-border-all"></i> Cell Properties</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label class="form-label">Cell Type:</label>
                    <select class="form-select bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400">
                        <option value="td">Data Cell</option>
                        <option value="th">Header Cell</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Width:</label>
                    <input type="text" class="form-control bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" placeholder="e.g., 100px or 50%">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Height:</label>
                    <input type="text" class="form-control bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400" placeholder="e.g., 50px">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>
