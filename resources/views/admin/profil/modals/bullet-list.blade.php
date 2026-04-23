<!-- Bullet List Modal -->
<div class="modal fade" id="bulletListModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-list-ul"></i> Bullet List Style</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="list-style-options">
                    <button class="style-option" onclick="insertBullet('default')">
                        <i class="fas fa-circle"></i> Default
                    </button>
                    <button class="style-option" onclick="insertBullet('circle')">
                        <i class="far fa-circle"></i> Circle
                    </button>
                    <button class="style-option" onclick="insertBullet('disc')">
                        <i class="fas fa-circle-notch"></i> Disc
                    </button>
                    <button class="style-option" onclick="insertBullet('square')">
                        <i class="fas fa-square"></i> Square
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<style>
.list-style-options { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
.style-option { padding: 15px; border: 1px solid #e0e0e0; border-radius: 6px; cursor: pointer; transition: all 0.3s; text-align: center; background: white; }
.style-option:hover { border-color: #667eea; background: #f0f4ff; }
</style>

<script>
function insertBullet(type) {
    const textarea = document.getElementById('konten');
    textarea.value += '\n<ul style="list-style-type: ' + (type === 'default' ? 'disc' : type) + '">\n  <li>Item 1</li>\n  <li>Item 2</li>\n  <li>Item 3</li>\n</ul>\n';
    bootstrap.Modal.getInstance(document.getElementById('bulletListModal')).hide();
}
</script>
