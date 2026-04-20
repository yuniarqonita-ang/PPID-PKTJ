<!-- Numbered List Modal -->
<div class="modal fade" id="numberedListModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-list-ol"></i> Numbered List Style</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="list-style-options">
                    <button class="style-option" onclick="insertNumbered('decimal')">1. 2. 3.</button>
                    <button class="style-option" onclick="insertNumbered('lower-alpha')">a. b. c.</button>
                    <button class="style-option" onclick="insertNumbered('lower-roman')">i. ii. iii.</button>
                    <button class="style-option" onclick="insertNumbered('upper-alpha')">A. B. C.</button>
                    <button class="style-option" onclick="insertNumbered('upper-roman')">I. II. III.</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
function insertNumbered(type) {
    const typeMap = {
        'decimal': '1',
        'lower-alpha': 'a',
        'lower-roman': 'i',
        'upper-alpha': 'A',
        'upper-roman': 'I'
    };
    const textarea = document.getElementById('konten');
    textarea.value += '\n<ol style="list-style-type: ' + type + '">\n  <li>Item 1</li>\n  <li>Item 2</li>\n  <li>Item 3</li>\n</ol>\n';
    bootstrap.Modal.getInstance(document.getElementById('numberedListModal')).hide();
}
</script>
