// Walk top-level children of 425:58403 sorted by Y, extract their text content
const fs = require('fs');
const path = require('path');

const data = JSON.parse(fs.readFileSync(path.join(__dirname, 'node-425-58403.json'), 'utf8'));
const root = data.nodes['425:58403'].document;
const frame = root.absoluteBoundingBox; // -3663,-5098 .. width 1440 height 23995
const frameRight = frame.x + frame.width;
const frameBottom = frame.y + frame.height;

function collectTexts(node, out) {
  if (node.type === 'TEXT' && node.characters) {
    out.push({
      chars: node.characters,
      size: node.style && node.style.fontSize,
      weight: node.style && node.style.fontWeight,
      family: node.style && node.style.fontFamily,
      y: node.absoluteBoundingBox ? node.absoluteBoundingBox.y : 0,
    });
  }
  if (node.children) for (const c of node.children) collectTexts(c, out);
}

function collectImageNodes(node, out) {
  if (node.fills && node.fills.some(f => f.type === 'IMAGE' && f.visible !== false)) {
    out.push({ id: node.id, name: node.name, type: node.type, w: node.absoluteBoundingBox.width, h: node.absoluteBoundingBox.height });
  }
  if (node.children) for (const c of node.children) collectImageNodes(c, out);
}

// Map: which children are within frame's content area vs decorative overflow
const children = root.children.map(c => {
  const b = c.absoluteBoundingBox || {};
  const insideX = b.x >= frame.x - 50 && (b.x + b.width) <= frameRight + 50;
  const insideY = b.y >= frame.y - 50 && (b.y + b.height) <= frameBottom + 50;
  const texts = [];
  collectTexts(c, texts);
  const images = [];
  collectImageNodes(c, images);
  // Find biggest text (likely heading)
  texts.sort((a, b) => (b.size || 0) - (a.size || 0));
  const heading = texts[0];
  return {
    id: c.id,
    type: c.type,
    name: c.name,
    x: Math.round(b.x),
    y: Math.round(b.y),
    w: Math.round(b.width),
    h: Math.round(b.height),
    inside: insideX && insideY,
    textCount: texts.length,
    imageCount: images.length,
    biggestText: heading ? { chars: heading.chars.slice(0, 80), size: heading.size } : null,
    sampleTexts: texts.slice(0, 5).map(t => `[${t.size}px] ${t.chars.slice(0, 80)}`),
  };
}).sort((a, b) => a.y - b.y);

console.log(`Frame: ${frame.x},${frame.y} ${frame.width}x${frame.height}`);
console.log('');
console.log('TOP-LEVEL CHILDREN (sorted by Y):');
console.log('');
for (const c of children) {
  const tag = c.inside ? '   ' : 'OVR';
  console.log(`${tag} ${c.id.padEnd(13)} y=${String(c.y).padStart(6)} ${String(c.w).padStart(4)}x${String(c.h).padStart(5)} texts=${String(c.textCount).padStart(3)} imgs=${String(c.imageCount).padStart(2)} :: ${c.name}`);
  if (c.biggestText) console.log(`              biggest text [${c.biggestText.size}px]: ${c.biggestText.chars}`);
}

fs.writeFileSync(path.join(__dirname, 'sections.json'), JSON.stringify(children, null, 2), 'utf8');
