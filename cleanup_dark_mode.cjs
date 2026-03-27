const fs = require('fs');
const path = require('path');

const adminDir = path.join(__dirname, 'resources', 'views', 'admin');

function processFile(filePath) {
    if (filePath.includes('dashboard.blade.php') || 
        filePath.includes('berita\\index.blade.php') || filePath.includes('berita/index.blade.php') ||
        filePath.includes('berita\\create.blade.php') || filePath.includes('berita/create.blade.php')) {
        return;
    }

    let content = fs.readFileSync(filePath, 'utf8');
    let newContent = content;

    // Remove rogue bg-white and bg-gray-50 from table elements
    newContent = newContent.replace(/<tbody class="bg-white/g, '<tbody class="');
    newContent = newContent.replace(/<thead class="bg-gray-50">/g, '<thead class="bg-slate-900/80">');
    newContent = newContent.replace(/<thead class="bg-gray-50 border-b/g, '<thead class="bg-slate-900/80 border-slate-700 border-b');
    
    // Fix rogue bg-white on modal bodies or generic containers that now have white text
    newContent = newContent.replace(/class="([^"]*)bg-white([^"]*)"/g, (match, p1, p2) => {
        // If it's a structural container and has white text nearby, remove bg-white.
        // E.g modals, cards
        if (p1.includes('p-') || p1.includes('shadow') || p1.includes('rounded') || p2.includes('p-') || p2.includes('shadow')) {
             return `class="${p1}bg-slate-800/50 border border-slate-600${p2}"`;
        }
        return match;
    });

    // Fix rogue text-slate-800 on dark backgrounds (like SOP headings)
    newContent = newContent.replace(/text-slate-800/g, 'text-slate-200');
    newContent = newContent.replace(/text-slate-900/g, 'text-white');
    
    // Fix custom alert boxes
    newContent = newContent.replace(/from-white to-gray-100/g, 'from-slate-800/80 to-slate-900/80');

    if (content !== newContent) {
        fs.writeFileSync(filePath, newContent, 'utf8');
        console.log('Cleaned up dark mode artifacts:', filePath.replace(__dirname, ''));
    }
}

function walkDir(dir) {
    if (!fs.existsSync(dir)) return;
    const files = fs.readdirSync(dir);
    
    files.forEach(file => {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            walkDir(fullPath);
        } else if (file.endsWith('.blade.php')) {
            processFile(fullPath);
        }
    });
}

walkDir(adminDir);
console.log('✅ Dark Mode cleanup complete!');
