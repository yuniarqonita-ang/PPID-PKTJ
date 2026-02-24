<!-- Source Code Modal -->
<div class="modal fade" id="sourceCodeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-code"></i> Source Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <textarea id="sourceCode" class="form-control" rows="15" style="font-family: monospace; font-size: 0.9rem;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="copySourceCode()"><i class="fas fa-copy"></i> Copy</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function copySourceCode() {
    const sourceCode = document.getElementById('sourceCode');
    sourceCode.select();
    document.execCommand('copy');
    alert('Code copied to clipboard!');
}
</script>
