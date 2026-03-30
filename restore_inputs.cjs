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
    
    let content = fs.readFileSync(filePath, 'utf8');
    let originalContent = content;

    // We want to match `input ` that is not immediately preceded by `<`.
    // The previous script stripped the `<` character from `<input type=...`.
    // It replaced `<input...` with `input...`.
    // So looking for `input type=` or `input name=` or `input class=` or `input id=`
    // that starts after whitespace or at the beginning of a line.

    content = content.replace(/(^|\n|\s)(input\s+(?:type|name|id|class)=)/g, '$1<$2');

    if (content !== originalContent) {
        fs.writeFileSync(filePath, content, 'utf8');
        console.log('Restored inputs in:', filePath);
    }
});
