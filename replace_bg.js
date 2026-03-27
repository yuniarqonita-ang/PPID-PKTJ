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
    
    // Replace all variations of min-h-screen bg-...
    const regex = /class="min-h-screen\s+bg-gradient-to[a-z\-]+\s+from-[a-z0-9\-]+\s+(via-[a-z0-9\-]+\s+)?to-[a-z0-9\-]+\s+(p-\d+|py-\d+)[^"]*"/g;
    const regex2 = /class="min-h-screen\s+bg-[a-z0-9\-]+\s+(p-\d+|py-\d+)[^"]*"/g;
    
    let newContent = content.replace(regex, 'class="min-h-screen bg-slate-50 p-6 lg:p-8"');
    newContent = newContent.replace(regex2, 'class="min-h-screen bg-slate-50 p-6 lg:p-8"');
    
    // Also upgrade inner rounded-lg shadow-sm border to premium card
    newContent = newContent.replace(/class="bg-white rounded-lg shadow-sm border border-gray-200/g, 'class="bg-white rounded-2xl shadow-sm border border-slate-200');
    // For create/edit cards that have long explicit gradients
    newContent = newContent.replace(/class="(group relative overflow-hidden )?rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100/g, 'class="$1rounded-2xl bg-white');

    if (content !== newContent) {
        fs.writeFileSync(file, newContent);
        console.log(`Updated: ${file}`);
        changedCount++;
    }
});

console.log(`Total files updated: ${changedCount}`);
