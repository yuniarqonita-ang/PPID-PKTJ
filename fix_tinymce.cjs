const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        let isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
    });
}

function updateTinyMCE(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    
    let content = fs.readFileSync(filePath, 'utf8');
    let originalContent = content;

    // Change skin and content_css to dark
    content = content.replace(/skin:\s*'oxide'/g, "skin: 'oxide-dark'");
    content = content.replace(/content_css:\s*'default'/g, "content_css: 'dark'");
    content = content.replace(/content_css:\s*'document'/g, "content_css: 'dark'");

    // Make text within TinyMCE dark-mode friendly
    content = content.replace(/color:\s*#1e293b;/g, "color: #f8fafc; background: transparent; padding: 12px;");
    content = content.replace(/color:\s*#333;/g, "color: #f8fafc; background: transparent;");

    // Replace lingering summernote initializations with tinymce style
    // Wait, the blade files themselves might have summernote UI which is very bright.
    // If standard summernote initialization exists, we can't just change skin. But the user already 
    // had us replace summernote with tinymce in the script blocks in most files.
    // However, if we see $(...).summernote({ we should ideally convert it to tinymce or 
    // leave it if we can't safely convert. The layout script already polyfills summernote().

    if (content !== originalContent) {
        fs.writeFileSync(filePath, content, 'utf8');
        console.log('Fixed TinyMCE theme in:', filePath);
    }
}

// Update all admin views
walkDir(path.join(__dirname, 'resources', 'views', 'admin'), updateTinyMCE);

// Also update layouts/app.blade.php which holds the global config
updateTinyMCE(path.join(__dirname, 'resources', 'views', 'layouts', 'app.blade.php'));
