<!-- Insert Character Modal -->
<div class="modal fade" id="insertCharacterModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-icons"></i> Karakter Spesial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="special-chars-grid">
                    <button class="char-btn" data-char="©">©</button>
                    <button class="char-btn" data-char="®">®</button>
                    <button class="char-btn" data-char="™">™</button>
                    <button class="char-btn" data-char="€">€</button>
                    <button class="char-btn" data-char="¥">¥</button>
                    <button class="char-btn" data-char="£">£</button>
                    <button class="char-btn" data-char="¢">¢</button>
                    <button class="char-btn" data-char="§">§</button>
                    <button class="char-btn" data-char="¶">¶</button>
                    <button class="char-btn" data-char="†">†</button>
                    <button class="char-btn" data-char="‡">‡</button>
                    <button class="char-btn" data-char="•">•</button>
                    <button class="char-btn" data-char="…">…</button>
                    <button class="char-btn" data-char="‰">‰</button>
                    <button class="char-btn" data-char="′">′</button>
                    <button class="char-btn" data-char="″">″</button>
                    <button class="char-btn" data-char="‴">‴</button>
                    <button class="char-btn" data-char="°">°</button>
                    <button class="char-btn" data-char="∞">∞</button>
                    <button class="char-btn" data-char="√">√</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
.special-chars-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
}

.char-btn {
    padding: 15px;
    border: 1px solid #e0e0e0;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.char-btn:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
}
</style>

<script>
document.querySelectorAll('.char-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const char = this.dataset.char;
        const textarea = document.getElementById('konten');
        textarea.value += char;
        textarea.focus();
        bootstrap.Modal.getInstance(document.getElementById('insertCharacterModal')).hide();
    });
});
</script>
