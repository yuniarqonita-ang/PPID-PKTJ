const fs = require('fs');
const path = require('path');

function walk(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(function(file) {
        file = path.join(dir, file);
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory()) {
            results = results.concat(walk(file));
        } else {
            if (file.endsWith('.blade.php')) {
                results.push(file);
            }
        }
    });
    return results;
}

const viewsDir = path.join(__dirname, 'resources', 'views', 'admin');
const files = walk(viewsDir);

let changedCount = 0;

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    
    const regex1 = /class="min-h-screen\s+bg-gradient-[^"]+"/g;
    const regex2 = /class="min-h-screen\s+bg-[a-z0-9\-]+\s+(p-\d+|py-\d+|p-6|p-8|py-12)[^"]*"/g;
    
    let newContent = content.replace(regex1, 'class="min-h-screen bg-slate-50 p-6 lg:p-8"');
    newContent = newContent.replace(regex2, 'class="min-h-screen bg-slate-50 p-6 lg:p-8"');
    
    newContent = newContent.replace(/class="bg-white rounded-lg shadow-sm border border-[a-z0-9\-]+ overflow-hidden"/g, 'class="bg-white rounded-2xl shadow-md shadow-slate-200\/50 border border-slate-100 overflow-hidden"');
    newContent = newContent.replace(/class="bg-white rounded-lg shadow-sm border border-[a-z0-9\-]+ p-6 mb-6"/g, 'class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-6"');
    
    // For specific form backgrounds
    newContent = newContent.replace(/class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl shadow-xl p-8 border border-slate-200"/g, 'class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8"');
    
    if (content !== newContent) {
        fs.writeFileSync(file, newContent);
        console.log(`Updated: ${file}`);
        changedCount++;
    }
});

console.log(`Total files updated: ${changedCount}`);
