const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        let isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
    });
}

const viewsDir = path.join(__dirname, 'resources', 'views', 'admin');

walkDir(viewsDir, function(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    
    // Skip profil mostly since we explicitly rewrote them, but let's just apply broadly to ensure no input is left behind.
    // If it already has bg-slate-900/60 it's fine.
    
    let content = fs.readFileSync(filePath, 'utf8');
    let originalContent = content;

    // A generic regex to catch inputs, selects, textareas and add the dark input classes if they exist
    // This looks for class="..." inside input/select/textarea tags
    
    const inputClassRegex = /<(input[^>]+type="(?:text|email|password|number|date|url|tel)"[^>]+class=")([^"]*)(")/gi;
    content = content.replace(inputClassRegex, (match, prefix, classes, suffix) => {
        // Clean up old bad classes
        let newClasses = classes.replace(/bg-white/g, '')
                                .replace(/text-slate-\d00/g, '')
                                .replace(/text-gray-\d00/g, '')
                                .replace(/bg-slate-\d00\/\d0/g, '')
                                .replace(/bg-gray-\d00/g, '');
        // Add the premium input classes
        newClasses += ' bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400 ';
        // Dedup spaces
        newClasses = newClasses.replace(/\s+/g, ' ').trim();
        return prefix + newClasses + suffix;
    });

    const selectTextareaRegex = /<(select|textarea)([^>]+class=")([^"]*)(")/gi;
    content = content.replace(selectTextareaRegex, (match, tag, prefix, classes, suffix) => {
        let newClasses = classes.replace(/bg-white/g, '')
                                .replace(/text-slate-\d00/g, '')
                                .replace(/text-gray-\d00/g, '')
                                .replace(/bg-slate-\d00\/\d0/g, '')
                                .replace(/bg-gray-\d00/g, '');
        newClasses += ' bg-slate-900/60 border-slate-600/50 text-white placeholder-slate-400 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400 ';
        newClasses = newClasses.replace(/\s+/g, ' ').trim();
        return `<${tag}${prefix}${newClasses}${suffix}`;
    });

    if (content !== originalContent) {
        fs.writeFileSync(filePath, content, 'utf8');
        console.log('Fixed inputs in:', filePath);
    }
});
