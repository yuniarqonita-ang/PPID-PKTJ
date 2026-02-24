// Custom Editor Implementation
class CustomEditor {
    constructor(elementId) {
        this.editor = document.getElementById(elementId);
        this.content = '';
        this.wordCount = 0;
        this.init();
    }

    init() {
        this.createEditorHTML();
        this.attachEventListeners();
        this.updateWordCount();
    }

    createEditorHTML() {
        const container = document.createElement('div');
        container.className = 'custom-editor-wrapper';
        container.innerHTML = `
            <!-- INTEGRATED EDITOR WITH MENU BAR -->
            <div class="editor-integrated">
                <!-- MENU BAR - INTEGRATED WITH EDITOR -->
                <div class="editor-menu-integrated">
                    <div class="menu-group">
                        <div class="menu-item-integrated" onclick="window.editor_${this.editor.id}.newDocument()">
                            <i class="fas fa-file-circle-plus"></i>
                            <span>File</span>
                            <div class="menu-dropdown-integrated">
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.newDocument()">
                                    <i class="fas fa-file-circle-plus"></i> New Document
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.printDocument()">
                                    <i class="fas fa-print"></i> Print
                                    <span class="shortcut">Ctrl+P</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="menu-item-integrated">
                            <i class="fas fa-pen"></i>
                            <span>Edit</span>
                            <div class="menu-dropdown-integrated">
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('undo')">
                                    <i class="fas fa-undo"></i> Undo
                                    <span class="shortcut">Ctrl+Z</span>
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('redo')">
                                    <i class="fas fa-redo"></i> Redo
                                    <span class="shortcut">Ctrl+Y</span>
                                </div>
                                <div class="dropdown-separator"></div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('cut')">
                                    <i class="fas fa-cut"></i> Cut
                                    <span class="shortcut">Ctrl+X</span>
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('copy')">
                                    <i class="fas fa-copy"></i> Copy
                                    <span class="shortcut">Ctrl+C</span>
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('paste')">
                                    <i class="fas fa-paste"></i> Paste
                                    <span class="shortcut">Ctrl+V</span>
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.pasteAsText()">
                                    <i class="fas fa-file-lines"></i> Paste as Text
                                </div>
                                <div class="dropdown-separator"></div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('selectAll')">
                                    <i class="fas fa-object-group"></i> Select All
                                    <span class="shortcut">Ctrl+A</span>
                                </div>
                                <div class="dropdown-separator"></div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showFindReplace()">
                                    <i class="fas fa-magnifying-glass"></i> Find & Replace
                                    <span class="shortcut">Ctrl+H</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="menu-item-integrated">
                            <i class="fas fa-plus"></i>
                            <span>Insert</span>
                            <div class="menu-dropdown-integrated">
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showMediaModal()">
                                    <i class="fas fa-video"></i> Media
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showImageModal()">
                                    <i class="fas fa-image"></i> Image
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showLinkModal()">
                                    <i class="fas fa-link"></i> Link
                                </div>
                                <div class="dropdown-separator"></div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showSpecialCharModal()">
                                    <i class="fas fa-star"></i> Special Character
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('insertHorizontalRule')">
                                    <i class="fas fa-minus"></i> Horizontal Line
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showAnchorModal()">
                                    <i class="fas fa-anchor"></i> Anchor
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('insertPageBreak')">
                                    <i class="fas fa-copy"></i> Page Break
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('insertNonBreakingSpace')">
                                    <i class="fas fa-space-shuttle"></i> Nonbreaking Space
                                    <span class="shortcut">Ctrl+Shift+Space</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="menu-item-integrated">
                            <i class="fas fa-eye"></i>
                            <span>View</span>
                            <div class="menu-dropdown-integrated">
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.toggleInvisibleChars()">
                                    <i class="fas fa-ghost"></i> Show Invisible Characters
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.toggleBlocks()">
                                    <i class="fas fa-cube"></i> Show Blocks
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.toggleVisualAids()">
                                    <i class="fas fa-ruler"></i> Visual Aids
                                </div>
                                <div class="dropdown-separator"></div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.preview()">
                                    <i class="fas fa-search"></i> Preview
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.toggleFullscreen()">
                                    <i class="fas fa-expand"></i> Fullscreen
                                    <span class="shortcut">F11</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="menu-item-integrated">
                            <i class="fas fa-palette"></i>
                            <span>Format</span>
                            <div class="menu-dropdown-integrated">
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('bold')">
                                    <i class="fas fa-bold"></i> Bold
                                    <span class="shortcut">Ctrl+B</span>
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('italic')">
                                    <i class="fas fa-italic"></i> Italic
                                    <span class="shortcut">Ctrl+I</span>
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('underline')">
                                    <i class="fas fa-underline"></i> Underline
                                    <span class="shortcut">Ctrl+U</span>
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('strikethrough')">
                                    <i class="fas fa-strikethrough"></i> Strikethrough
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('superscript')">
                                    <i class="fas fa-superscript"></i> Superscript
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('subscript')">
                                    <i class="fas fa-subscript"></i> Subscript
                                </div>
                                <div class="dropdown-separator"></div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showHeadingMenu()">
                                    <i class="fas fa-heading"></i> Headings
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showInlineMenu()">
                                    <i class="fas fa-text"></i> Inline
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showBlocksMenu()">
                                    <i class="fas fa-square"></i> Blocks
                                </div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showAlignmentMenu()">
                                    <i class="fas fa-align-left"></i> Alignment
                                </div>
                                <div class="dropdown-separator"></div>
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.execCommand('removeFormat')">
                                    <i class="fas fa-eraser"></i> Clear Formatting
                                </div>
                            </div>
                        </div>
                        
                        <div class="menu-item-integrated" onclick="window.editor_${this.editor.id}.showTableGrid()">
                            <i class="fas fa-table"></i>
                            <span>Table</span>
                        </div>
                        
                        <div class="menu-item-integrated">
                            <i class="fas fa-tools"></i>
                            <span>Tools</span>
                            <div class="menu-dropdown-integrated">
                                <div class="dropdown-item-integrated" onclick="window.editor_${this.editor.id}.showSourceCode()">
                                    <i class="fas fa-code"></i> Source Code
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- QUICK TOOLBAR -->
                    <div class="quick-toolbar">
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('undo')" title="Undo">
                            <i class="fas fa-undo"></i>
                        </button>
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('redo')" title="Redo">
                            <i class="fas fa-redo"></i>
                        </button>
                        
                        <div class="toolbar-separator-integrated"></div>
                        
                        <select class="format-select" onchange="window.editor_${this.editor.id}.formatBlock(this.value)">
                            <option value="p">Normal</option>
                            <option value="h1">Heading 1</option>
                            <option value="h2">Heading 2</option>
                            <option value="h3">Heading 3</option>
                            <option value="h4">Heading 4</option>
                            <option value="h5">Heading 5</option>
                            <option value="h6">Heading 6</option>
                        </select>
                        
                        <div class="toolbar-separator-integrated"></div>
                        
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('bold')" title="Bold">
                            <i class="fas fa-bold"></i>
                        </button>
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('italic')" title="Italic">
                            <i class="fas fa-italic"></i>
                        </button>
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('underline')" title="Underline">
                            <i class="fas fa-underline"></i>
                        </button>
                        
                        <div class="toolbar-separator-integrated"></div>
                        
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('justifyLeft')" title="Align Left">
                            <i class="fas fa-align-left"></i>
                        </button>
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('justifyCenter')" title="Align Center">
                            <i class="fas fa-align-center"></i>
                        </button>
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('justifyRight')" title="Align Right">
                            <i class="fas fa-align-right"></i>
                        </button>
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('justifyFull')" title="Justify">
                            <i class="fas fa-align-justify"></i>
                        </button>
                        
                        <div class="toolbar-separator-integrated"></div>
                        
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('insertUnorderedList')" title="Bullet List">
                            <i class="fas fa-list-ul"></i>
                        </button>
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.execCommand('insertOrderedList')" title="Numbered List">
                            <i class="fas fa-list-ol"></i>
                        </button>
                        
                        <div class="toolbar-separator-integrated"></div>
                        
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.showLinkModal()" title="Insert Link">
                            <i class="fas fa-link"></i>
                        </button>
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.removeLink()" title="Remove Link">
                            <i class="fas fa-unlink"></i>
                        </button>
                        
                        <div class="toolbar-separator-integrated"></div>
                        
                        <button class="toolbar-btn-integrated" onclick="window.editor_${this.editor.id}.showImageModal()" title="Insert Image">
                            <i class="fas fa-image"></i>
                        </button>
                        
                        <div class="word-count-integrated" id="wordCount_${this.editor.id}">0 words</div>
                    </div>
                </div>
                
                <!-- EDITOR CONTENT AREA -->
                <div class="editor-content-integrated" contenteditable="true" id="editorContent_${this.editor.id}"></div>
            </div>
        `;

        // Replace original textarea with new editor
        this.editor.parentNode.replaceChild(container, this.editor);
        this.editorContent = document.getElementById(`editorContent_${this.editor.id}`);
        
        // Copy existing content if any
        if (this.editor.value) {
            this.editorContent.innerHTML = this.editor.value;
        }
        
        // Create hidden input to store content
        this.hiddenInput = document.createElement('input');
        this.hiddenInput.type = 'hidden';
        this.hiddenInput.name = this.editor.name;
        this.hiddenInput.id = this.editor.id;
        container.appendChild(this.hiddenInput);
    }

    attachEventListeners() {
        // Update content and word count
        this.editorContent.addEventListener('input', () => {
            this.updateContent();
            this.updateWordCount();
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.target === this.editorContent) {
                if (e.ctrlKey || e.metaKey) {
                    switch(e.key) {
                        case 'z':
                            e.preventDefault();
                            this.execCommand('undo');
                            break;
                        case 'y':
                            e.preventDefault();
                            this.execCommand('redo');
                            break;
                        case 'b':
                            e.preventDefault();
                            this.execCommand('bold');
                            break;
                        case 'i':
                            e.preventDefault();
                            this.execCommand('italic');
                            break;
                        case 'u':
                            e.preventDefault();
                            this.execCommand('underline');
                            break;
                        case 'x':
                            e.preventDefault();
                            this.execCommand('cut');
                            break;
                        case 'c':
                            e.preventDefault();
                            this.execCommand('copy');
                            break;
                        case 'v':
                            e.preventDefault();
                            this.execCommand('paste');
                            break;
                        case 'a':
                            e.preventDefault();
                            this.execCommand('selectAll');
                            break;
                        case 'p':
                            e.preventDefault();
                            this.printDocument();
                            break;
                        case 'h':
                            e.preventDefault();
                            this.showFindReplace();
                            break;
                    }
                }
                
                if (e.key === 'F11') {
                    e.preventDefault();
                    this.toggleFullscreen();
                }
            }
        });
    }

    updateContent() {
        this.content = this.editorContent.innerHTML;
        this.hiddenInput.value = this.content;
    }

    updateWordCount() {
        const text = this.editorContent.innerText || '';
        const words = text.trim().split(/\s+/).filter(word => word.length > 0);
        this.wordCount = words.length;
        const wordCountEl = document.getElementById(`wordCount_${this.editor.id}`);
        if (wordCountEl) {
            wordCountEl.textContent = `${this.wordCount} words`;
        }
    }

    // TABLE GRID POPUP FUNCTION
    showTableGrid() {
        // Remove existing popup if any
        const existingPopup = document.querySelector('.table-grid-popup');
        if (existingPopup) {
            existingPopup.remove();
        }

        // Create backdrop
        const backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop';
        backdrop.onclick = () => this.closeTableGrid();

        // Create popup
        const popup = document.createElement('div');
        popup.className = 'table-grid-popup';
        popup.innerHTML = `
            <div class="table-grid-popup-header">
                <div class="table-grid-popup-title">
                    <i class="fas fa-table"></i> Insert Table
                </div>
                <button class="table-grid-popup-close" onclick="window.editor_${this.editor.id}.closeTableGrid()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="table-grid-container" id="tableGrid"></div>
            <div class="table-grid-footer">
                <span>Grid size: <span class="table-grid-size" id="gridSize">1×1</span></span>
                <button class="modal-btn modal-btn-ok" onclick="window.editor_${this.editor.id}.insertTableFromGrid()">Insert Table</button>
            </div>
        `;

        // Create grid cells
        const gridContainer = popup.querySelector('#tableGrid');
        for (let i = 0; i < 100; i++) {
            const cell = document.createElement('div');
            cell.className = 'table-grid-cell';
            cell.dataset.row = Math.floor(i / 10) + 1;
            cell.dataset.col = (i % 10) + 1;
            
            cell.addEventListener('mouseenter', (e) => {
                this.highlightGridCells(e.target);
            });
            
            cell.addEventListener('click', () => {
                this.selectGridSize(cell.dataset.row, cell.dataset.col);
            });
            
            gridContainer.appendChild(cell);
        }

        // Add to document
        document.body.appendChild(backdrop);
        document.body.appendChild(popup);

        // Show with animation
        setTimeout(() => {
            backdrop.classList.add('show');
            popup.classList.add('show');
        }, 10);
    }

    highlightGridCells(targetCell) {
        const allCells = document.querySelectorAll('.table-grid-cell');
        const targetRow = parseInt(targetCell.dataset.row);
        const targetCol = parseInt(targetCell.dataset.col);

        allCells.forEach(cell => {
            const row = parseInt(cell.dataset.row);
            const col = parseInt(cell.dataset.col);
            
            if (row <= targetRow && col <= targetCol) {
                cell.classList.add('selected');
            } else {
                cell.classList.remove('selected');
            }
        });

        // Update size display
        const sizeDisplay = document.getElementById('gridSize');
        if (sizeDisplay) {
            sizeDisplay.textContent = `${targetRow}×${targetCol}`;
        }
    }

    selectGridSize(rows, cols) {
        this.selectedRows = rows;
        this.selectedCols = cols;
    }

    closeTableGrid() {
        const backdrop = document.querySelector('.modal-backdrop');
        const popup = document.querySelector('.table-grid-popup');
        
        if (backdrop) backdrop.remove();
        if (popup) popup.remove();
    }

    insertTableFromGrid() {
        if (this.selectedRows && this.selectedCols) {
            let tableHTML = '<table border="1" style="border-collapse: collapse; width: 100%;">';
            
            for (let i = 0; i < this.selectedRows; i++) {
                tableHTML += '<tr>';
                for (let j = 0; j < this.selectedCols; j++) {
                    tableHTML += '<td style="border: 1px solid #ddd; padding: 8px;">Cell</td>';
                }
                tableHTML += '</tr>';
            }
            
            tableHTML += '</table><p>&nbsp;</p>';
            
            this.execCommand('insertHTML', tableHTML);
            this.closeTableGrid();
        }
    }

    execCommand(command, value = null) {
        document.execCommand(command, false, value);
        this.updateContent();
    }

    formatBlock(tag) {
        this.execCommand('formatBlock', tag);
    }

    newDocument() {
        if (confirm('Are you sure you want to create a new document? All unsaved changes will be lost.')) {
            this.editorContent.innerHTML = '';
            this.updateContent();
            this.updateWordCount();
        }
    }

    printDocument() {
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Print Document</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        @media print { body { padding: 0; } }
                    </style>
                </head>
                <body>
                    ${this.editorContent.innerHTML}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }

    pasteAsText() {
        navigator.clipboard.readText().then(text => {
            this.execCommand('insertText', text);
        }).catch(() => {
            // Fallback for browsers that don't support clipboard API
            this.execCommand('paste');
        });
    }

    showFindReplace() {
        // Implementation for find and replace modal
        alert('Find and Replace functionality would be implemented here');
    }

    showMediaModal() {
        // Implementation for media modal
        alert('Media insertion functionality would be implemented here');
    }

    showImageModal() {
        // Implementation for image modal
        alert('Image insertion functionality would be implemented here');
    }

    showLinkModal() {
        // Implementation for link modal
        alert('Link insertion functionality would be implemented here');
    }

    showSpecialCharModal() {
        // Implementation for special character modal
        alert('Special character insertion would be implemented here');
    }

    showAnchorModal() {
        // Implementation for anchor modal
        alert('Anchor insertion would be implemented here');
    }

    toggleInvisibleChars() {
        // Toggle invisible characters visibility
        alert('Toggle invisible characters');
    }

    toggleBlocks() {
        // Toggle block visibility
        alert('Toggle blocks');
    }

    toggleVisualAids() {
        // Toggle visual aids
        alert('Toggle visual aids');
    }

    preview() {
        // Open preview in new window
        const previewWindow = window.open('', '_blank');
        previewWindow.document.write(`
            <html>
                <head>
                    <title>Preview</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: 0 auto; }
                    </style>
                </head>
                <body>
                    ${this.editorContent.innerHTML}
                </body>
            </html>
        `);
        previewWindow.document.close();
    }

    toggleFullscreen() {
        const container = document.querySelector('.editor-container');
        if (!document.fullscreenElement) {
            container.requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    }

    showHeadingMenu() {
        // Show heading options
        alert('Heading menu');
    }

    showInlineMenu() {
        // Show inline formatting options
        alert('Inline menu');
    }

    showBlocksMenu() {
        // Show block options
        alert('Blocks menu');
    }

    showAlignmentMenu() {
        // Show alignment options
        alert('Alignment menu');
    }

    showTableGrid() {
        // Show table grid for selection
        alert('Table grid selection');
    }

    showTableProperties() {
        // Show table properties modal
        alert('Table properties');
    }

    deleteTable() {
        // Delete current table
        this.execCommand('deleteTable');
    }

    showCellMenu() {
        // Show cell operations menu
        alert('Cell menu');
    }

    showRowMenu() {
        // Show row operations menu
        alert('Row menu');
    }

    showColumnMenu() {
        // Show column operations menu
        alert('Column menu');
    }

    showSourceCode() {
        // Show source code modal
        const sourceCode = this.editorContent.innerHTML;
        const modal = document.createElement('div');
        modal.className = 'editor-modal show';
        modal.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-header">
                    <h3 class="modal-title">
                        <i class="fas fa-code"></i> Source Code
                    </h3>
                    <button class="modal-close-btn" onclick="this.closest('.editor-modal').remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea style="width: 100%; height: 300px; font-family: monospace;">${sourceCode}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="modal-btn modal-btn-cancel" onclick="this.closest('.editor-modal').remove()">Cancel</button>
                    <button class="modal-btn modal-btn-ok" onclick="editor.updateFromSourceCode(this)">OK</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }

    updateFromSourceCode(button) {
        const modal = button.closest('.editor-modal');
        const textarea = modal.querySelector('textarea');
        this.editorContent.innerHTML = textarea.value;
        this.updateContent();
        modal.remove();
    }

    removeLink() {
        this.execCommand('unlink');
    }
}

// Initialize editor when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Find and replace all textareas with class 'custom-editor'
    const textareas = document.querySelectorAll('textarea.custom-editor');
    textareas.forEach((textarea, index) => {
        // Create unique editor instance for each textarea
        const editorId = textarea.id;
        if (editorId) {
            const editorInstance = new CustomEditor(editorId);
            window[`editor_${editorId}`] = editorInstance;
            
            // Store reference for backward compatibility
            if (index === 0) {
                window.editor = editorInstance;
            }
        }
    });
});
