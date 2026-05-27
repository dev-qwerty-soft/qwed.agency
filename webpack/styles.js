const path = require('path');
const fs = require('fs');

const styles = () => {
  const scssDirectory = 'src/scss/';
  const outputFile = 'src/scss/style.scss';

  // Subdirectories under src/scss that ship as their own webpack entries and
  // therefore MUST NOT be bundled into the main style.scss auto-import.
  const excludedDirs = ['case'];

  function getScssFiles(dir, fileList = []) {
    const files = fs.readdirSync(dir);
    files.forEach((file) => {
      const filePath = path.join(dir, file);
      const stat = fs.statSync(filePath);
      if (stat.isDirectory()) {
        if (excludedDirs.includes(file)) return;
        getScssFiles(filePath, fileList);
      } else if (file.endsWith('.scss') && file !== 'style.scss' && file !== 'fonts.scss') {
        fileList.push(filePath.replace(/\\/g, '/'));
      }
    });
    return fileList;
  }

  const scssFiles = getScssFiles(scssDirectory);
  const mixinsFileIndex = scssFiles.findIndex((file) => file.includes('mixins'));
  if (mixinsFileIndex !== -1) {
    const [mixinsFile] = scssFiles.splice(mixinsFileIndex, 1);
    scssFiles.unshift(mixinsFile);
  }
  const importStatements = scssFiles
    .map((file) => `@import "${file.replace(scssDirectory, '')}";`)
    .join('\n');
  fs.writeFileSync(outputFile, importStatements);
};

module.exports = styles;
