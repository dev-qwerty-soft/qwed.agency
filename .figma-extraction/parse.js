// Parse the Figma node dump and produce three summary files:
//   tree.txt         - indented hierarchy (id, type, size, name)
//   texts.json       - every TEXT node with characters + style
//   assets.json      - every node that has an IMAGE fill or is VECTOR/RECTANGLE-with-image
// Run: node parse.js
const fs = require('fs');
const path = require('path');

const SRC = path.join(__dirname, 'node-425-58403.json');
const raw = fs.readFileSync(SRC, 'utf8');
const data = JSON.parse(raw);
const root = data.nodes['425:58403'].document;

const treeLines = [];
const texts = [];
const assets = [];
const colors = new Set();
const fontStyles = new Map(); // key -> {family, size, weight, lineHeight, letterSpacing, count}

function rgb(c) {
  if (!c) return null;
  const r = Math.round(c.r * 255);
  const g = Math.round(c.g * 255);
  const b = Math.round(c.b * 255);
  const a = c.a == null ? 1 : c.a;
  return a < 1 ? `rgba(${r}, ${g}, ${b}, ${+a.toFixed(3)})` : `#${[r, g, b].map(v => v.toString(16).padStart(2, '0')).join('')}`;
}

function size(n) {
  const b = n.absoluteBoundingBox;
  return b ? `${Math.round(b.width)}x${Math.round(b.height)}` : '-';
}

function pos(n) {
  const b = n.absoluteBoundingBox;
  return b ? `(${Math.round(b.x)},${Math.round(b.y)})` : '';
}

function walk(node, depth) {
  const pad = '  '.repeat(depth);
  const childCount = node.children ? node.children.length : 0;
  const visible = node.visible === false ? ' HIDDEN' : '';
  treeLines.push(`${pad}${node.id} [${node.type}] ${size(node)} ${pos(node)} children=${childCount}${visible} :: ${node.name}`);

  // Collect fills (colors + image refs)
  if (node.fills && Array.isArray(node.fills)) {
    for (const f of node.fills) {
      if (f.visible === false) continue;
      if (f.type === 'SOLID' && f.color) colors.add(rgb({ ...f.color, a: f.opacity == null ? f.color.a : f.opacity }));
      if (f.type === 'IMAGE') {
        assets.push({ id: node.id, name: node.name, type: node.type, size: size(node), pos: pos(node), imageRef: f.imageRef, scaleMode: f.scaleMode });
      }
      if (f.type === 'GRADIENT_LINEAR' || f.type === 'GRADIENT_RADIAL') {
        const stops = (f.gradientStops || []).map(s => `${rgb(s.color)} ${(s.position * 100).toFixed(0)}%`).join(', ');
        colors.add(`${f.type}: ${stops}`);
      }
    }
  }
  if (node.strokes && Array.isArray(node.strokes)) {
    for (const s of node.strokes) {
      if (s.visible === false) continue;
      if (s.type === 'SOLID' && s.color) colors.add(rgb({ ...s.color, a: s.opacity == null ? s.color.a : s.opacity }));
    }
  }

  // TEXT nodes
  if (node.type === 'TEXT') {
    const style = node.style || {};
    texts.push({
      id: node.id,
      name: node.name,
      pos: pos(node),
      size: size(node),
      characters: node.characters || '',
      family: style.fontFamily,
      weight: style.fontWeight,
      fontSize: style.fontSize,
      lineHeight: style.lineHeightPx ? `${Math.round(style.lineHeightPx)}px` : (style.lineHeightPercent ? `${style.lineHeightPercent}%` : null),
      letterSpacing: style.letterSpacing,
      align: style.textAlignHorizontal,
      case: style.textCase,
    });
    const key = `${style.fontFamily}|${style.fontWeight}|${style.fontSize}|${style.lineHeightPx || style.lineHeightPercent}`;
    if (!fontStyles.has(key)) fontStyles.set(key, { family: style.fontFamily, weight: style.fontWeight, size: style.fontSize, lineHeight: style.lineHeightPx ? `${Math.round(style.lineHeightPx)}px` : `${style.lineHeightPercent}%`, count: 0, samples: [] });
    const s = fontStyles.get(key);
    s.count++;
    if (s.samples.length < 3) s.samples.push((node.characters || '').slice(0, 50));
  }

  if (node.children) {
    for (const c of node.children) walk(c, depth + 1);
  }
}

walk(root, 0);

fs.writeFileSync(path.join(__dirname, 'tree.txt'), treeLines.join('\n'), 'utf8');
fs.writeFileSync(path.join(__dirname, 'texts.json'), JSON.stringify(texts, null, 2), 'utf8');
fs.writeFileSync(path.join(__dirname, 'assets.json'), JSON.stringify(assets, null, 2), 'utf8');
fs.writeFileSync(path.join(__dirname, 'colors.json'), JSON.stringify([...colors].sort(), null, 2), 'utf8');
fs.writeFileSync(path.join(__dirname, 'fonts.json'), JSON.stringify([...fontStyles.values()].sort((a, b) => b.count - a.count), null, 2), 'utf8');

console.log(`tree lines: ${treeLines.length}`);
console.log(`texts: ${texts.length}`);
console.log(`image assets: ${assets.length}`);
console.log(`distinct colors: ${colors.size}`);
console.log(`distinct font styles: ${fontStyles.size}`);
console.log(`top-level children: ${root.children.length}`);
