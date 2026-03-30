const fs = require('fs');
const path = require('path');

const files = [
    'visi.blade.php',
    'tugas.blade.php',
    'struktur.blade.php',
    'regulasi.blade.php',
    'kontak.blade.php'
];

const dir = path.join(__dirname, 'resources', 'views', 'admin', 'profil');

files.forEach(file => {
    let filePath = path.join(dir, file);
    if (!fs.existsSync(filePath)) return;
    
    let content = fs.readFileSync(filePath, 'utf8');

    // 1. Add glowing container behind the main card if not already added
    if (!content.includes('card-glow') && content.includes('<div class="bg-slate-800/80 backdrop-blur-xl roun')) {
        content = content.replace(
            /<div class="bg-slate-800\/80 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white\/10 relative overflow-hidden">/g,
            `<div class="relative group">\n                <div class="absolute -inset-1 bg-gradient-to-r from-pink-600 to-purple-600 rounded-[22px] blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>\n                <div class="bg-slate-800/90 backdrop-blur-xl rounded-2xl shadow-2xl ring-1 ring-white/10 relative overflow-hidden transition-all duration-300">`
        );
        // And remember to close the relative group div at the end
        let parts = content.split('</form>');
        if (parts.length > 1) {
            parts[1] = parts[1].replace(/<\/div>\s*<\/div>\s*<\/div>\s*<\/div>/, '</div></div></div></div></div>');
            content = parts.join('</form>');
        }
    }

    // 2. Upgrade standard flat inputs to glowing inputs
    content = content.replace(/class="w-full px-4 py-2 border-2 border-slate-600 bg-slate-900\/50 text-white placeholder-slate-500 rounded-lg focus:border-cyan-500 focus:ring-cyan-500 focus:outline-none"/g, 
        'class="w-full px-4 py-3 border-2 border-slate-600/50 bg-slate-900/60 text-white placeholder-slate-500 rounded-xl focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/50 focus:outline-none transition-all duration-300 shadow-inner"');

    // 3. Upgrade basic buttons to animated glowing buttons
    content = content.replace(/class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition"/g, 
        'class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold hover:from-emerald-400 hover:to-teal-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(16,185,129,0.4)] border border-emerald-400/30"');
    
    content = content.replace(/class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-bold shadow-lg transition"/g, 
        'class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-slate-600 to-slate-700 text-white font-bold hover:from-slate-500 hover:to-slate-600 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(71,85,105,0.4)] border border-slate-500/30"');

    fs.writeFileSync(filePath, content, 'utf8');
    console.log('Upgraded to glowing dark mode:', file);
});
