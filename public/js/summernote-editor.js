// SUMMERNOTE EDITOR IMPLEMENTATION - 100% FREE & POWERFUL
class SummernoteEditor {
    constructor(elementId) {
        this.editor = document.getElementById(elementId);
        this.init();
    }

    init() {
        // Initialize Summernote with all features
        $(this.editor).summernote({
            height: 400,
            placeholder: 'Tulis konten berita di sini...',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
            ],
            buttons: {
                // Custom buttons if needed
            },
            callbacks: {
                onInit: function() {
                    console.log('Summernote initialized!');
                },
                onImageUpload: function(files) {
                    // Handle image upload
                    for (let i = 0; i < files.length; i++) {
                        SummernoteEditor.uploadImage(files[i], this);
                    }
                }
            },
            // Table configuration
            table: {
                borderSize: 1,
                borderColor: '#ddd',
                cellMinWidth: 100,
                cellPadding: 5,
                cellSpacing: 0
            },
            // Font sizes
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48'],
            // Air mode (optional - for distraction-free editing)
            airMode: false,
            // Focus
            focus: false,
            // Lang
            lang: 'id-ID',
            // Direction
            direction: null,
            // Style tags
            styleTags: [
                'p',
                { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
                'pre',
                { title: 'Code', tag: 'code', className: 'inline-code', value: 'code' },
                'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],
            // Default font name
            defaultFontName: 'Arial',
            // Font names
            fontNames: [
                'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New',
                'Helvetica Neue', 'Impact', 'Lucida Grande',
                'Tahoma', 'Times New Roman', 'Verdana'
            ],
            // Colors
            colors: [
                ['#000000', '#424242', '#636363', '#9C9C94', '#CEC6CE', '#EFEFEF', '#F7F7F7', '#FFFFFF'],
                ['#FF0000', '#FF9C00', '#FFFF00', '#00FF00', '#00FFFF', '#0000FF', '#9C00FF', '#FF00FF'],
                ['#F7C6CE', '#FFE7CE', '#FFF5CE', '#D6EAD6', '#D1EAED', '#CCE7F7', '#E7C6CE', '#F7D7CE'],
                ['#424242', '#CEC6CE', '#9C9C94', '#636363', '#424242', '#EFEFEF', '#F7F7F7', '#FFFFFF']
            ],
            // Line heights
            lineHeights: ['1.0', '1.2', '1.4', '1.5', '1.6', '1.8', '2.0', '3.0'],
            // Insert table max size
            insertTableMaxSize: {
                col: 10,
                row: 10
            },
            // Dialogs in body
            dialogsInBody: true,
            // Dialogs fade
            dialogsFade: true,
            // Maximum image size
            maximumImageFileSize: 10485760, // 10MB
            // Callbacks
            callbacks: {
                onInit: function() {
                    console.log('Summernote initialized!');
                },
                onFocus: function() {
                    console.log('Editor focused');
                },
                onBlur: function() {
                    console.log('Editor blurred');
                },
                onEnter: function() {
                    console.log('Enter/Return pressed');
                },
                onImageUpload: function(files) {
                    // Handle image upload
                    for (let i = 0; i < files.length; i++) {
                        SummernoteEditor.uploadImage(files[i], this);
                    }
                },
                onImageUploadError: function(data) {
                    console.error('Image upload error:', data);
                }
            }
        });
    }

    // Static method for image upload
    static uploadImage(file, editor) {
        const data = new FormData();
        data.append('image', file);
        
        // Create upload URL (adjust this to your actual upload endpoint)
        const uploadUrl = '/admin/upload-image';
        
        // Show loading
        const loadingImg = $('<img>').attr('src', '/images/loading.gif').css('width', '50px');
        $(editor).summernote('insertNode', loadingImg[0]);
        
        // Upload using fetch
        fetch(uploadUrl, {
            method: 'POST',
            body: data,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })
        .then(response => response.json())
        .then(data => {
            // Remove loading image
            $(editor).summernote('removeNode', loadingImg[0]);
            
            if (data.success && data.url) {
                // Insert uploaded image
                const img = $('<img>').attr('src', data.url).css('max-width', '100%');
                $(editor).summernote('insertNode', img[0]);
            } else {
                // Show error
                alert('Upload failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            // Remove loading image
            $(editor).summernote('removeNode', loadingImg[0]);
            console.error('Upload error:', error);
            alert('Upload failed. Please try again.');
        });
    }

    // Get content
    getContent() {
        return $(this.editor).summernote('code');
    }

    // Set content
    setContent(content) {
        $(this.editor).summernote('code', content);
    }

    // Insert text
    insertText(text) {
        $(this.editor).summernote('insertText', text);
    }

    // Insert HTML
    insertHTML(html) {
        $(this.editor).summernote('pasteHTML', html);
    }

    // Focus editor
    focus() {
        $(this.editor).summernote('focus');
    }

    // Blur editor
    blur() {
        $(this.editor).summernote('blur');
    }

    // Enable editor
    enable() {
        $(this.editor).summernote('enable');
    }

    // Disable editor
    disable() {
        $(this.editor).summernote('disable');
    }

    // Destroy editor
    destroy() {
        $(this.editor).summernote('destroy');
    }

    // Get selected text
    getSelectedText() {
        return $(this.editor).summernote('createRange').toString();
    }

    // Insert table
    insertTable(rows = 3, cols = 3) {
        $(this.editor).summernote('insertTable', { numRows: rows, numCols: cols });
    }

    // Insert image
    insertImage(url) {
        $(this.editor).summernote('insertImage', url, 'Image');
    }

    // Insert link
    insertLink(text, url) {
        $(this.editor).summernote('createLink', {
            text: text,
            url: url,
            isNewWindow: true
        });
    }

    // Format text
    formatText(command) {
        $(this.editor).summernote(command);
    }

    // Check if editor is empty
    isEmpty() {
        return $(this.editor).summernote('isEmpty');
    }

    // Reset editor
    reset() {
        $(this.editor).summernote('reset');
    }

    // Get word count
    getWordCount() {
        const text = $(this.editor).summernote('code');
        const plainText = $(text).text();
        return plainText.trim().split(/\s+/).filter(word => word.length > 0).length;
    }

    // Get character count
    getCharCount() {
        const text = $(this.editor).summernote('code');
        const plainText = $(text).text();
        return plainText.length;
    }
}

// Initialize Summernote when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Check if jQuery is loaded
    if (typeof $ === 'undefined') {
        console.error('jQuery is required for Summernote. Please load jQuery first.');
        return;
    }

    // Check if Summernote is loaded
    if (typeof $.summernote === 'undefined') {
        console.error('Summernote is not loaded. Please load Summernote library first.');
        return;
    }

    // Initialize all textareas with class 'summernote-editor'
    const textareas = document.querySelectorAll('textarea.summernote-editor');
    textareas.forEach((textarea) => {
        const editorId = textarea.id;
        if (editorId) {
            const editorInstance = new SummernoteEditor(editorId);
            window[`editor_${editorId}`] = editorInstance;
            
            // Store reference for backward compatibility
            if (!window.summernoteEditor) {
                window.summernoteEditor = editorInstance;
            }
        }
    });

    // Auto-save functionality (optional)
    let autoSaveTimer;
    document.addEventListener('keyup', function(e) {
        if (e.target.classList.contains('note-editable')) {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                // Trigger auto-save if needed
                console.log('Auto-save triggered');
            }, 30000); // 30 seconds
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey || e.metaKey) {
            switch(e.key) {
                case 's':
                    e.preventDefault();
                    // Save functionality
                    console.log('Save shortcut triggered');
                    break;
                case 'p':
                    e.preventDefault();
                    // Print functionality
                    window.print();
                    break;
            }
        }
    });

    console.log('Summernote Editor initialized successfully!');
});

// Export for global access
window.SummernoteEditor = SummernoteEditor;
