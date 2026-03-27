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

    // 1. Min-h-screen container
    newContent = newContent.replace(/<div class="min-h-screen bg-slate-50 p-6 lg:p-8">/g, '<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">');
    newContent = newContent.replace(/<div class="min-h-screen bg-slate-50 p-6 sm:p-8">/g, '<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">');
    newContent = newContent.replace(/<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-purple-100 p-6">/g, '<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">');
    newContent = newContent.replace(/<div class="min-h-screen bg-slate-50 p-6">/g, '<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">');

    // 2. White cards -> Dark glass cards
    newContent = newContent.replace(/class="([^"]*)bg-white rounded-2xl([^"]*)"/g, 'class="$1bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden$2"');
    newContent = newContent.replace(/class="([^"]*)bg-white rounded-[^"]* shadow-[^"]*"/g, 'class="$1bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden"');
    newContent = newContent.replace(/class="([^"]*)bg-white([^"]*)"/g, (match, p1, p2) => {
         // only replace if it's a structural div like an aside/card, avoid tiny things if possible. But safe enough.
         if (p1.includes('p-') || p1.includes('shadow') || p2.includes('p-') || p2.includes('shadow')) {
             return `class="${p1}bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden${p2}"`;
         }
         return match;
    });

    // 3. Typography
    newContent = newContent.replace(/text-gray-900/g, 'text-white');
    newContent = newContent.replace(/text-gray-800/g, 'text-slate-200');
    newContent = newContent.replace(/text-gray-700/g, 'text-slate-300');
    // careful not to overwrite things we already changed, but grey-600 mostly safe
    newContent = newContent.replace(/text-gray-600/g, 'text-slate-300');
    newContent = newContent.replace(/text-gray-500/g, 'text-slate-400');
    
    // Convert Headers specially
    newContent = newContent.replace(/class="text-3xl font-bold text-white"/g, 'class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg"');
    newContent = newContent.replace(/class="text-2xl font-bold text-white"/g, 'class="text-2xl font-black text-white drop-shadow-lg"');
    newContent = newContent.replace(/class="([^"]*)text-4xl font-black text-transparent([^"]*)"/g, 'class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg"');

    // 4. Tables
    newContent = newContent.replace(/bg-gray-50 border-b border-gray-200/g, 'bg-slate-900/80 border-b border-slate-700');
    newContent = newContent.replace(/divide-gray-200/g, 'divide-slate-700/50');
    newContent = newContent.replace(/hover:bg-gray-50/g, 'hover:bg-slate-700/50 transition-colors group');
    // Table Headers
    newContent = newContent.replace(/text-slate-400 uppercase tracking-wider/g, 'text-cyan-400 uppercase tracking-wider'); // Because gray-500 became slate-400 earlier

    // 5. Inputs and Selects
    newContent = newContent.replace(/border-gray-300/g, 'border-slate-600 bg-slate-900/50 text-white placeholder-slate-500');
    newContent = newContent.replace(/focus:border-blue-500/g, 'focus:border-cyan-500 focus:ring-cyan-500');
    newContent = newContent.replace(/focus:ring-blue-500\/20/g, '');
    newContent = newContent.replace(/border-slate-300(.*)bg-white/g, 'border-slate-600 bg-slate-900/50 text-white');

    // 6. Buttons
    // Blue buttons
    newContent = newContent.replace(/bg-blue-600 hover:bg-blue-700 text-white/g, 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white hover:from-blue-400 hover:to-indigo-500 shadow-lg ring-1 ring-blue-400/30');
    newContent = newContent.replace(/bg-gradient-to-r from-blue-600 to-purple-600/g, 'bg-gradient-to-r from-cyan-500 to-blue-600 shadow-lg shadow-cyan-500/25 ring-1 ring-cyan-400/30');
    
    // Green buttons
    newContent = newContent.replace(/bg-green-600 hover:bg-green-700 text-white/g, 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white hover:from-emerald-400 hover:to-teal-500 shadow-lg ring-1 ring-emerald-400/30');
    
    // Back/Cancel buttons
    newContent = newContent.replace(/bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700/g, 'bg-slate-700/50 text-white ring-1 ring-white/10 hover:bg-slate-600');
    newContent = newContent.replace(/bg-gray-200 hover:bg-gray-300 text-slate-200/g, 'bg-slate-700/50 text-white hover:bg-slate-600 ring-1 ring-white/10');

    // 7. Labels
    newContent = newContent.replace(/text-slate-700/g, 'text-slate-200');

    if (content !== newContent) {
        fs.writeFileSync(filePath, newContent, 'utf8');
        console.log('Updated dark mode:', filePath.replace(__dirname, ''));
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
console.log('✅ Dark Mode applied selectively!');
