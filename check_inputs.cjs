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
let badFiles = [];

walkDir(viewsDir, function(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    
    let content = fs.readFileSync(filePath, 'utf8');
    // search for `input type=` where it is not immediately preceded by `<`
    if (/(^|[^<])input\s+(type|name|id|class)=/g.test(content)) {
        badFiles.push(filePath);
        // auto-fix while we are here to be absolutely safe
        let fixedContent = content.replace(/(^|[^<])(input\s+(?:type|name|id|class)=)/g, '$1<$2');
        fs.writeFileSync(filePath, fixedContent, 'utf8');
    }
});

console.log('Bad files found and fixed:', badFiles);
