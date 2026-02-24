// Editor JavaScript Functions
(function() {
    'use strict';

    // Text Editor Functions
    const editorFunctions = {
        // Basic Text Formatting
        bold: () => document.execCommand('bold'),
        italic: () => document.execCommand('italic'),
        underline: () => document.execCommand('underline'),
        strikethrough: () => document.execCommand('strikethrough'),
        superscript: () => document.execCommand('superscript'),
        subscript: () => document.execCommand('subscript'),
        
        // Alignment
        'align-left': () => document.execCommand('justifyLeft'),
        'align-center': () => document.execCommand('justifyCenter'),
        'align-right': () => document.execCommand('justifyRight'),
        'align-justify': () => document.execCommand('justifyFull'),
        
        // Headings
        'heading-1': () => insertHeading(1),
        'heading-2': () => insertHeading(2),
        'heading-3': () => insertHeading(3),
        'heading-4': () => insertHeading(4),
        'heading-5': () => insertHeading(5),
        'heading-6': () => insertHeading(6),
        'paragraph': () => document.execCommand('formatBlock', false, 'p'),
        
        // Lists
        'bullet-list': () => document.execCommand('insertUnorderedList'),
        'numbered-list': () => document.execCommand('insertOrderedList'),
        
        // Other
        'undo': () => document.execCommand('undo'),
        'redo': () => document.execCommand('redo'),
        'clear-format': () => document.execCommand('removeFormat'),
        'insert-hr': () => insertHorizontalLine(),
        'insert-nbsp': () => insertNonBreakingSpace(),
        'insert-pagebreak': () => insertPageBreak(),
        'delete-table': () => deleteTable(),
        'insert-row-before': () => insertRowBefore(),
        'insert-row-after': () => insertRowAfter(),
        'delete-row': () => deleteRow(),
        'cut-row': () => cutRow(),
        'copy-row': () => copyRow(),
        'paste-row-before': () => pasteRowBefore(),
        'paste-row-after': () => pasteRowAfter(),
        'insert-col-before': () => insertColBefore(),
        'insert-col-after': () => insertColAfter(),
        'delete-col': () => deleteCol(),
        'merge-cells': () => mergeCells(),
        'split-cell': () => splitCell(),
        'remove-link': () => document.execCommand('unlink'),
        'cut': () => document.execCommand('cut'),
        'copy': () => document.execCommand('copy'),
        'paste': () => document.execCommand('paste'),
        'paste-text': () => pasteAsText(),
        'select-all': () => document.execCommand('selectAll'),
        'toggle-invisible': () => toggleInvisibleCharacters(),
        'toggle-blocks': () => toggleBlocks(),
        'toggle-aids': () => toggleVisualAids(),
        'preview': () => previewContent(),
        'fullscreen': () => toggleFullscreen(),
        'new-doc': () => newDocument(),
        'print-doc': () => window.print(),
    };

    // Register event listeners for action buttons
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-action]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const action = btn.dataset.action;
                if (editorFunctions[action]) {
                    editorFunctions[action]();
                }
            });
        });

        // Keyboard shortcuts
        registerKeyboardShortcuts();
    });

    function registerKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key.toLowerCase()) {
                    case 'b':
                        e.preventDefault();
                        editorFunctions.bold();
                        break;
                    case 'i':
                        e.preventDefault();
                        editorFunctions.italic();
                        break;
                    case 'u':
                        e.preventDefault();
                        editorFunctions.underline();
                        break;
                    case 'z':
                        if (!e.shiftKey) {
                            e.preventDefault();
                            editorFunctions.undo();
                        }
                        break;
                    case 'y':
                        e.preventDefault();
                        editorFunctions.redo();
                        break;
                    case 'h':
                        e.preventDefault();
                        if (document.getElementById('findReplaceModal')) {
                            bootstrap.Modal.getOrCreateInstance(document.getElementById('findReplaceModal')).show();
                        }
                        break;
                }
            } else if (e.key === 'F11') {
                e.preventDefault();
                toggleFullscreen();
            }
        });
    }

    // Helper Functions
    function insertHeading(level) {
        const textarea = document.getElementById('konten');
        const tag = `h${level}`;
        const selected = window.getSelection().toString() || 'Heading';
        textarea.value += `\n<${tag}>${selected}</${tag}>\n`;
    }

    function insertHorizontalLine() {
        const textarea = document.getElementById('konten');
        textarea.value += '\n<hr>\n';
    }

    function insertNonBreakingSpace() {
        const textarea = document.getElementById('konten');
        textarea.value += '&nbsp;';
    }

    function insertPageBreak() {
        const textarea = document.getElementById('konten');
        textarea.value += '\n<div style="page-break-after: always;"></div>\n';
    }

    function pasteAsText() {
        const textarea = document.getElementById('konten');
        const text = prompt('Paste your text:');
        if (text) {
            textarea.value += text;
        }
    }

    function toggleInvisibleCharacters() {
        const textarea = document.getElementById('konten');
        textarea.classList.toggle('show-invisible');
    }

    function toggleBlocks() {
        // Toggle block element visualization
        console.log('Toggle blocks');
    }

    function toggleVisualAids() {
        // Toggle visual aids
        console.log('Toggle visual aids');
    }

    function previewContent() {
        const title = document.getElementById('judul')?.value || 'Preview';
        const content = document.getElementById('konten')?.value || '';
        const preview = `
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>${title}</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body { padding: 40px 20px; background: #f8f9fa; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
                    .preview-container { max-width: 900px; margin: 0 auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
                    h1, h2, h3, h4, h5, h6 { color: #333; margin-top: 20px; margin-bottom: 15px; }
                    h1 { font-size: 2.5rem; border-bottom: 3px solid #667eea; padding-bottom: 10px; }
                    p { color: #555; line-height: 1.8; }
                    table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                    table th, table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
                    table th { background: #667eea; color: white; }
                    ul, ol { margin-left: 20px; }
                    li { margin-bottom: 8px; }
                </style>
            </head>
            <body>
                <div class="preview-container">
                    <h1>${escapeHtml(title)}</h1>
                    <div class="content">${content}</div>
                </div>
            </body>
            </html>
        `;
        const win = window.open('', '_blank', 'width=1000,height=800');
        win.document.write(preview);
        win.document.close();
    }

    function toggleFullscreen() {
        const container = document.querySelector('.profil-editor-container');
        container?.classList.toggle('fullscreen');
    }

    function newDocument() {
        if (confirm('Buat dokumen baru? Data saat ini akan hilang jika belum tersimpan.')) {
            document.getElementById('konten').value = '';
            document.getElementById('judul').value = '';
        }
    }

    // Table Functions
    function deleteTable() {
        console.log('Delete table');
    }

    function insertRowBefore() {
        console.log('Insert row before');
    }

    function insertRowAfter() {
        console.log('Insert row after');
    }

    function deleteRow() {
        console.log('Delete row');
    }

    function cutRow() {
        console.log('Cut row');
    }

    function copyRow() {
        console.log('Copy row');
    }

    function pasteRowBefore() {
        console.log('Paste row before');
    }

    function pasteRowAfter() {
        console.log('Paste row after');
    }

    function insertColBefore() {
        console.log('Insert column before');
    }

    function insertColAfter() {
        console.log('Insert column after');
    }

    function deleteCol() {
        console.log('Delete column');
    }

    function mergeCells() {
        console.log('Merge cells');
    }

    function splitCell() {
        console.log('Split cell');
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    // Export functions to global scope
    window.editorFunctions = editorFunctions;
    window.insertLink = insertLink;
    window.escapeHtml = escapeHtml;

})();

// Modal Event Handlers
document.addEventListener('DOMContentLoaded', function() {
    // File Manager - Insert image from file manager
    const fileInsertBtns = document.querySelectorAll('[data-action="insert-file"]');
    fileInsertBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filePath = this.getAttribute('data-file-path');
            const konten = document.getElementById('konten');
            konten.value += `\n<img src="${filePath}" alt="Image" style="max-width: 100%;">\n`;
            bootstrap.Modal.getInstance(document.getElementById('fileManagerModal'))?.hide();
        });
    });

    // Insert Character
    const charInsertBtns = document.querySelectorAll('[data-action="insert-character"]');
    charInsertBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const char = this.getAttribute('data-char');
            const konten = document.getElementById('konten');
            konten.selectionStart = konten.value.length;
            konten.selectionEnd = konten.value.length;
            document.execCommand('insertText', false, char);
            bootstrap.Modal.getInstance(document.getElementById('insertCharacterModal'))?.hide();
        });
    });

    // Insert Media
    const insertMediaBtn = document.getElementById('insertMediaBtn');
    if (insertMediaBtn) {
        insertMediaBtn.addEventListener('click', function() {
            const source = document.getElementById('mediaSource')?.value;
            const width = document.getElementById('mediaWidth')?.value || '100%';
            const height = document.getElementById('mediaHeight')?.value || 'auto';
            const konten = document.getElementById('konten');
            
            if (!source) {
                alert('Silakan masukkan sumber media');
                return;
            }
            
            const mediaHtml = `\n<figure class="media-figure"><video controls style="max-width: 100%; height: ${height};"><source src="${source}"></video></figure>\n`;
            konten.value += mediaHtml;
            bootstrap.Modal.getInstance(document.getElementById('insertMediaModal'))?.hide();
        });
    }

    // Insert Image
    const insertImageBtn = document.getElementById('insertImageBtn');
    if (insertImageBtn) {
        insertImageBtn.addEventListener('click', function() {
            const source = document.getElementById('imageSource')?.value;
            const alt = document.getElementById('imageAlt')?.value || 'Image';
            const width = document.getElementById('imageWidth')?.value || '100%';
            const height = document.getElementById('imageHeight')?.value || 'auto';
            const konten = document.getElementById('konten');
            
            if (!source) {
                alert('Silakan masukkan sumber gambar');
                return;
            }
            
            const imgHtml = `\n<img src="${source}" alt="${alt}" style="max-width: ${width}; height: ${height};" />\n`;
            konten.value += imgHtml;
            bootstrap.Modal.getInstance(document.getElementById('insertImageModal'))?.hide();
        });
    }

    // Insert Anchor
    const insertAnchorBtn = document.getElementById('insertAnchorBtn');
    if (insertAnchorBtn) {
        insertAnchorBtn.addEventListener('click', function() {
            const anchorName = document.getElementById('anchorName')?.value;
            const konten = document.getElementById('konten');
            
            if (!anchorName) {
                alert('Silakan masukkan nama anchor');
                return;
            }
            
            const anchorHtml = `\n<a id="${anchorName.replace(/\s+/g, '-').toLowerCase()}"></a>\n`;
            konten.value += anchorHtml;
            bootstrap.Modal.getInstance(document.getElementById('insertAnchorModal'))?.hide();
        });
    }

    // Find & Replace
    const findReplaceBtn = document.getElementById('findReplaceBtn');
    if (findReplaceBtn) {
        findReplaceBtn.addEventListener('click', function() {
            const findText = document.getElementById('findText')?.value;
            const replaceText = document.getElementById('replaceText')?.value || '';
            const konten = document.getElementById('konten');
            const caseSensitive = document.getElementById('caseSensitive')?.checked;
            
            if (!findText) {
                alert('Silakan masukkan teks untuk dicari');
                return;
            }
            
            const flags = caseSensitive ? 'g' : 'gi';
            const regex = new RegExp(findText, flags);
            konten.value = konten.value.replace(regex, replaceText);
            
            bootstrap.Modal.getInstance(document.getElementById('findReplaceModal'))?.hide();
        });
    }

    // List Style Selection
    const bulletListBtns = document.querySelectorAll('[data-action="set-bullet-style"]');
    bulletListBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const style = this.getAttribute('data-style');
            const styleMap = {
                'default': 'disc',
                'circle': 'circle',
                'disc': 'disc',
                'square': 'square'
            };
            document.execCommand('insertUnorderedList');
            bootstrap.Modal.getInstance(document.getElementById('bulletListModal'))?.hide();
        });
    });

    const numberedListBtns = document.querySelectorAll('[data-action="set-numbered-style"]');
    numberedListBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const style = this.getAttribute('data-style');
            document.execCommand('insertOrderedList');
            bootstrap.Modal.getInstance(document.getElementById('numberedListModal'))?.hide();
        });
    });
});

// Link insertion function
function insertLink() {
    const url = document.getElementById('linkUrl')?.value;
    const text = document.getElementById('linkText')?.value || 'Link';
    const title = document.getElementById('linkTitle')?.value;
    const target = document.getElementById('linkTarget')?.value;

    if (!url) {
        alert('Please enter URL');
        return;
    }

    const targetAttr = target === '_blank' ? ' target="_blank"' : '';
    const titleAttr = title ? ` title="${title}"` : '';
    const link = `<a href="${url}"${targetAttr}${titleAttr}>${text}</a>`;

    const textarea = document.getElementById('konten');
    textarea.value += '\n' + link + '\n';

    bootstrap.Modal.getInstance(document.getElementById('insertLinkModal'))?.hide();
}
