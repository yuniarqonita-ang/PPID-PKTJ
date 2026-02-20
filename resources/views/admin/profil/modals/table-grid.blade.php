<!-- Table Grid Modal -->
<div class="modal fade" id="tableGridModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-th"></i> Sisipkan Tabel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label>Pilih ukuran tabel:</label>
                <div class="table-grid-selector">
                    <div id="gridPreview"></div>
                </div>
                <p class="grid-info text-center mt-3">
                    <span id="selectedGrid">0 × 0</span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="insertTable()">OK</button>
            </div>
        </div>
    </div>
</div>

<style>
.table-grid-selector {
    display: inline-block;
}

.grid-cell {
    display: inline-block;
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    margin: 2px;
    cursor: pointer;
    background: white;
    transition: background 0.2s ease;
}

.grid-cell:hover,
.grid-cell.selected {
    background: #667eea;
    border-color: #667eea;
}

.grid-info {
    font-weight: 600;
    color: #333;
    font-size: 1.1rem;
    min-height: 30px;
}
</style>

<script>
let selectedRows = 0, selectedCols = 0;

function initTableGrid() {
    const preview = document.getElementById('gridPreview');
    preview.innerHTML = '';
    
    for (let i = 0; i < 10; i++) {
        for (let j = 0; j < 10; j++) {
            const cell = document.createElement('div');
            cell.className = 'grid-cell';
            cell.dataset.row = i;
            cell.dataset.col = j;
            cell.addEventListener('click', function() {
                selectTableGrid(parseInt(this.dataset.row) + 1, parseInt(this.dataset.col) + 1);
            });
            cell.addEventListener('mouseenter', function() {
                highlightGridCells(parseInt(this.dataset.row) + 1, parseInt(this.dataset.col) + 1);
            });
            preview.appendChild(cell);
        }
    }
}

function highlightGridCells(rows, cols) {
    document.querySelectorAll('.grid-cell').forEach(cell => {
        if (parseInt(cell.dataset.row) < rows && parseInt(cell.dataset.col) < cols) {
            cell.style.opacity = '0.7';
        } else {
            cell.style.opacity = '1';
        }
    });
}

function selectTableGrid(rows, cols) {
    selectedRows = rows;
    selectedCols = cols;
    document.getElementById('selectedGrid').textContent = `${cols} × ${rows}`;
    highlightGridCells(rows, cols);
}

function insertTable() {
    if (selectedRows === 0 || selectedCols === 0) {
        alert('Pilih ukuran tabel terlebih dahulu');
        return;
    }
    
    let html = '<table border="1"><tbody>';
    for (let i = 0; i < selectedRows; i++) {
        html += '<tr>';
        for (let j = 0; j < selectedCols; j++) {
            html += '<td></td>';
        }
        html += '</tr>';
    }
    html += '</tbody></table>';
    
    const textarea = document.getElementById('konten');
    textarea.value += html;
    bootstrap.Modal.getInstance(document.getElementById('tableGridModal')).hide();
}

document.addEventListener('DOMContentLoaded', initTableGrid);
</script>
