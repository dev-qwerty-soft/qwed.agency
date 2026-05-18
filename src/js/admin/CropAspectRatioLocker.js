import './CropAspectRatioLocker.scss';

export class CropAspectRatioLocker {
  constructor() {
    this.ratios = window.cropAspectRatios || {};
    this.field = null;
    this.attempts = 0;
    this.locked = false;
    this.clickedElement = null;

    document.addEventListener('click', (e) => {
      const t = e.target;
      if (t.closest('.acf-image-uploader')) {
        this.clickedElement = t.closest('.acf-image-uploader');
        this.field = this.clickedElement.closest('.acf-field')?.getAttribute('data-name');
        this.attempts = 0;
        this.locked = false;
        setTimeout(() => this.lock(), 500);
      }
      if (t.classList.contains('edit-attachment')) {
        this.locked = false;
        setTimeout(() => this.lock(), 800);
      }
      if (t.classList.contains('imgedit-crop')) {
        this.locked = false;
        setTimeout(() => this.lock(), 300);
      }
    });

    new MutationObserver(() => {
      const crop = document.querySelector('#imgedit-crop');
      if (crop?.offsetWidth > 0 && !this.locked) this.lock();
    }).observe(document.body, { childList: true, subtree: true });
  }

  gcd(a, b) {
    return b ? this.gcd(b, a % b) : a;
  }

  lockHandles() {
    document.querySelectorAll('.imgareaselect-handle').forEach((h) => {
      h.style.display = 'none';
      h.style.pointerEvents = 'none';
    });

    const sel = document.querySelector('.imgareaselect-selection');
    if (sel) sel.style.cursor = 'move';

    document
      .querySelectorAll(
        '.imgareaselect-border1, .imgareaselect-border2, .imgareaselect-border3, .imgareaselect-border4',
      )
      .forEach((b) => {
        b.style.pointerEvents = 'none';
      });
  }

  lock() {
    const inputs = document.querySelectorAll('.imgedit-crop-ratio input[type="number"]');
    const selInputs = document.querySelectorAll('.imgedit-crop-sel input[type="number"]');

    if (inputs.length >= 2 && !this.locked) {
      if (this.clickedElement) {
        this.field = this.clickedElement.closest('.acf-field')?.getAttribute('data-name');
      }

      const r = this.ratios[this.field] || this.ratios.default || { width: 940, height: 300 };
      const d = this.gcd(r.width, r.height);
      const w = r.width / d;
      const h = r.height / d;

      const imgId = document.querySelector('[id^="imgedit-x-"]')?.id.match(/\d+/)?.[0] || '0';
      const imgW = parseInt(document.getElementById(`imgedit-x-${imgId}`)?.value) || 1000;
      const imgH = parseInt(document.getElementById(`imgedit-y-${imgId}`)?.value) || 1000;

      const ratio = w / h;
      let selW = imgW;
      let selH = Math.round(imgW / ratio);

      if (selH > imgH) {
        selH = imgH;
        selW = Math.round(imgH * ratio);
      }

      inputs[0].value = w;
      inputs[1].value = h;
      inputs.forEach((i) => {
        i.disabled = true;
        Object.assign(i.style, {
          opacity: '0.6',
          cursor: 'not-allowed',
          backgroundColor: '#f0f0f0',
        });
      });

      selInputs[0].value = selW;
      selInputs[1].value = selH;
      selInputs.forEach((i) => {
        i.disabled = true;
        i.setAttribute('max', i.value);
        Object.assign(i.style, {
          opacity: '0.6',
          cursor: 'not-allowed',
          backgroundColor: '#f0f0f0',
        });
      });

      setTimeout(() => {
        selInputs.forEach((i) => i.dispatchEvent(new Event('keyup', { bubbles: true })));
        setTimeout(() => this.lockHandles(), 100);
      }, 100);

      this.locked = true;
      console.log(`🔒 ${w}:${h} → ${selW}×${selH}`);
    } else if (this.attempts++ < 20 && !this.locked) {
      setTimeout(() => this.lock(), 200);
    }
  }
}
