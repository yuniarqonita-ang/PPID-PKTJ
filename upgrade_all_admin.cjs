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
    
    // Skip profil and dashboard since they are already explicitly styled
    if (filePath.includes(path.sep + 'profil' + path.sep) || filePath.endsWith('dashboard.blade.php')) return;
    
    let content = fs.readFileSync(filePath, 'utf8');
    let originalContent = content;

    // 1. Text contrast upgrades (Make dark gray text lighter for readability on dark backgrounds)
    content = content.replace(/text-slate-800/g, 'text-white font-medium');
    content = content.replace(/text-gray-800/g, 'text-white font-medium');
    content = content.replace(/text-slate-700/g, 'text-slate-200');
    content = content.replace(/text-gray-700/g, 'text-gray-200');
    content = content.replace(/text-slate-600/g, 'text-slate-300');
    content = content.replace(/text-gray-600/g, 'text-gray-300');
    content = content.replace(/text-slate-500/g, 'text-slate-400');
    content = content.replace(/text-gray-500/g, 'text-gray-400');
    content = content.replace(/text-gray-900/g, 'text-white drop-shadow-sm');
    content = content.replace(/text-slate-900/g, 'text-white drop-shadow-sm');
    content = content.replace(/text-black/g, 'text-white font-bold');

    // 2. Button premium glowing upgrades
    // Blue Buttons -> Cyan/Blue Gradient
    content = content.replace(/bg-blue-600(\s+)hover:bg-blue-700/g, 'bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 border border-cyan-500/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(56,189,248,0.4)] transition-all duration-300');
    content = content.replace(/bg-blue-500(\s+)hover:bg-blue-600/g, 'bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-400 hover:to-cyan-400 border border-cyan-400/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(56,189,248,0.4)] transition-all duration-300');
    
    // Indigo Buttons -> Purple/Indigo Gradient
    content = content.replace(/bg-indigo-600(\s+)hover:bg-indigo-700/g, 'bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 border border-purple-500/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(139,92,246,0.4)] transition-all duration-300');
    content = content.replace(/bg-indigo-500(\s+)hover:bg-indigo-600/g, 'bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-400 hover:to-purple-400 border border-purple-400/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(139,92,246,0.4)] transition-all duration-300');
    
    // Green Buttons -> Emerald/Teal Gradient
    content = content.replace(/bg-green-600(\s+)hover:bg-green-700/g, 'bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 border border-emerald-500/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(16,185,129,0.4)] transition-all duration-300');
    content = content.replace(/bg-green-500(\s+)hover:bg-green-600/g, 'bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 border border-emerald-400/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(16,185,129,0.4)] transition-all duration-300');
    
    // Yellow/Amber Buttons -> Yellow/Orange Gradient
    content = content.replace(/bg-yellow-500(\s+)hover:bg-yellow-600/g, 'bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-400 hover:to-orange-400 border border-yellow-400/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(245,158,11,0.4)] transition-all duration-300 text-white font-bold');
    
    // Red Buttons -> Red/Rose Gradient
    content = content.replace(/bg-red-600(\s+)hover:bg-red-700/g, 'bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 border border-red-500/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(225,29,72,0.4)] transition-all duration-300');
    content = content.replace(/bg-red-500(\s+)hover:bg-red-600/g, 'bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-400 hover:to-rose-400 border border-red-400/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(225,29,72,0.4)] transition-all duration-300');
    
    // Gray/Cancel Buttons -> Slate/Gray Gradient
    content = content.replace(/bg-gray-500(\s+)hover:bg-gray-600/g, 'bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-500 hover:to-slate-600 border border-slate-500/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(71,85,105,0.4)] transition-all duration-300');
    content = content.replace(/bg-slate-500(\s+)hover:bg-slate-600/g, 'bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-500 hover:to-slate-600 border border-slate-500/30 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(71,85,105,0.4)] transition-all duration-300');
    
    // Update border colors globally
    content = content.replace(/border-gray-200/g, 'border-slate-600/30');
    content = content.replace(/border-gray-300/g, 'border-slate-500/50');
    content = content.replace(/border-slate-200/g, 'border-slate-600/30');
    content = content.replace(/border-slate-300/g, 'border-slate-500/50');
    
    // 3. Container Card Upgrades (Make primary containers glow)
    // Replace previous flat dark mode replacements with glassy glow replacements
    content = content.replace(/bg-slate-800\/50 backdrop-blur-sm/g, 'bg-slate-800/80 backdrop-blur-xl ring-1 ring-white/10 shadow-[0_4px_25px_rgba(0,0,0,0.5)]');
    content = content.replace(/bg-slate-800\/50 rounded-xl/g, 'bg-slate-800/80 backdrop-blur-xl rounded-2xl ring-1 ring-white/10 shadow-[0_4px_25px_rgba(0,0,0,0.5)] transition-all duration-300 hover:bg-slate-800/90 hover:shadow-[0_8px_30px_rgba(56,189,248,0.15)]');

    // Make inputs premium glow
    content = content.replace(/class="([^"]*)border-slate-600([^"]*)bg-slate-800\/50([^"]*)"/g, 'class="$1border-slate-600/50$2bg-slate-900/60$3 shadow-inner focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-400 transition-all"');
    
    // 4. White background text adjustments (if any leftover text-black on backgrounds)
    content = content.replace(/text-black/g, 'text-slate-100 font-medium');
    
    if (content !== originalContent) {
        fs.writeFileSync(filePath, content, 'utf8');
        console.log('Upgraded globally:', filePath);
    }
});
