const sharp = require('sharp');
const path = require('path');
const fs = require('fs');

const CONFIG = {
  inputDir: 'assets',
  recursive: true,
};

function getImageFiles(dir, fileList = []) {
  if (!fs.existsSync(dir)) {
    console.error(`Folder ${dir} does not exist!`);
    return fileList;
  }
  const files = fs.readdirSync(dir);
  files.forEach((file) => {
    const filePath = path.join(dir, file);
    const stat = fs.statSync(filePath);
    if (stat.isDirectory() && CONFIG.recursive) {
      getImageFiles(filePath, fileList);
    } else if (stat.isFile() && /\.(jpe?g|png|webp)$/i.test(file)) {
      fileList.push(filePath);
    }
  });
  return fileList;
}

function formatBytes(bytes) {
  if (bytes === 0) return '0 Bytes';
  const k = 1024;
  const sizes = ['Bytes', 'KB', 'MB'];
  const i = Math.floor(Math.log(bytes) / Math.log(k));
  return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
}

async function optimizeImage(filePath) {
  const originalSize = fs.statSync(filePath).size;
  const fileName = path.basename(filePath);
  const ext = path.extname(filePath).toLowerCase();
  const tempPath = filePath + '.tmp';

  try {
    let sharpInstance = sharp(filePath);
    if (ext === '.jpg' || ext === '.jpeg') {
      await sharpInstance
        .jpeg({
          quality: 100,
          mozjpeg: true,
          progressive: true,
        })
        .toFile(tempPath);
    } else if (ext === '.png') {
      await sharpInstance
        .png({
          quality: 100,
          compressionLevel: 9,
          palette: true,
        })
        .toFile(tempPath);
    } else if (ext === '.webp') {
      await sharpInstance
        .webp({
          quality: 100,
          lossless: true,
        })
        .toFile(tempPath);
    }

    const optimizedSize = fs.statSync(tempPath).size;

    if (optimizedSize < originalSize) {
      fs.unlinkSync(filePath);
      fs.renameSync(tempPath, filePath);

      const saved = originalSize - optimizedSize;
      const savedPercent = ((saved / originalSize) * 100).toFixed(2);

      return {
        fileName,
        originalSize,
        optimizedSize,
        saved,
        savedPercent,
        success: true,
      };
    } else {
      fs.unlinkSync(tempPath);
      return { fileName, success: false, noImprovement: true };
    }
  } catch (error) {
    if (fs.existsSync(tempPath)) {
      fs.unlinkSync(tempPath);
    }
    return { fileName, success: false, error: error.message };
  }
}

async function optimizeImages() {
  console.log('Starting image optimization...\n');
  const startTime = Date.now();
  let totalOriginalSize = 0;
  let totalOptimizedSize = 0;
  let processedCount = 0;
  let skippedCount = 0;

  try {
    const imageFiles = getImageFiles(CONFIG.inputDir);

    if (imageFiles.length === 0) {
      console.log('No images found for optimization');
      return;
    }

    console.log(`Found ${imageFiles.length} images\n`);

    for (const filePath of imageFiles) {
      const result = await optimizeImage(filePath);
      if (result.success) {
        totalOriginalSize += result.originalSize;
        totalOptimizedSize += result.optimizedSize;

        console.log(
          `✓ ${result.fileName}\n` +
            `  Before: ${formatBytes(result.originalSize)}\n` +
            `  After: ${formatBytes(result.optimizedSize)}\n` +
            `  Saved: ${formatBytes(result.saved)} (${result.savedPercent}%)\n`,
        );

        processedCount++;
      } else if (result.noImprovement) {
        skippedCount++;
        console.log(`→ ${result.fileName} - already optimized\n`);
      } else if (result.error) {
        console.error(`✗ ${result.fileName} - error: ${result.error}\n`);
      }
    }

    const totalSaved = totalOriginalSize - totalOptimizedSize;
    const totalSavedPercent = totalOriginalSize > 0 ? ((totalSaved / totalOriginalSize) * 100).toFixed(2) : 0;
    const duration = ((Date.now() - startTime) / 1000).toFixed(2);
    console.log('=======================================');
    console.log('SUMMARY:');
    console.log('=======================================');
    console.log(`Processed: ${processedCount} files`);
    console.log(`Skipped: ${skippedCount} files`);
    console.log(`Original size: ${formatBytes(totalOriginalSize)}`);
    console.log(`Optimized size: ${formatBytes(totalOptimizedSize)}`);
    console.log(`Total saved: ${formatBytes(totalSaved)} (${totalSavedPercent}%)`);
    console.log(`Execution time: ${duration}s`);
    console.log('=======================================');
    console.log('Optimization completed!');
  } catch (error) {
    console.error('Critical error:', error);
    process.exit(1);
  }
}

optimizeImages();
