import '../../../scss/case/part-pilot/index.scss';
import { initCaseChrome } from '../../utils/case-chrome';
import AOS from 'aos';

function bootCase() {
  const root = document.querySelector<HTMLElement>('.case-part-pilot');
  if (!root) return;

  initImageFadeIn(root);
  initCaseChrome(root, '#bb1e10');

  AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true,
    offset: 80,
  });
}

function initImageFadeIn(root: HTMLElement) {
  const images = root.querySelectorAll<HTMLImageElement>('img');
  images.forEach((img) => {
    if (img.complete && img.naturalWidth > 0) {
      img.classList.add('is-loaded');
      return;
    }
    const done = () => img.classList.add('is-loaded');
    img.addEventListener('load', done, { once: true });
    img.addEventListener('error', done, { once: true });
  });
}

function initProgressBar(root: HTMLElement) {
  const images = root.querySelectorAll<HTMLImageElement>('img');
  const total = images.length;
  if (total === 0) return;

  const bar = document.createElement('div');
  bar.className = 'case-part-pilot__progress';
  bar.setAttribute('aria-hidden', 'true');
  const fill = document.createElement('div');
  fill.className = 'case-part-pilot__progress-fill';
  bar.appendChild(fill);
  document.body.appendChild(bar);

  let loaded = 0;
  const update = () => {
    fill.style.transform = `scaleX(${loaded / total})`;
    if (loaded >= total) {
      bar.classList.add('is-done');
      window.setTimeout(() => bar.remove(), 700);
    }
  };

  images.forEach((img) => {
    if (img.complete) {
      loaded += 1;
      return;
    }
    const done = () => {
      loaded += 1;
      update();
    };
    img.addEventListener('load', done, { once: true });
    img.addEventListener('error', done, { once: true });
  });
  update();
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', bootCase, { once: true });
} else {
  bootCase();
}
