import '../../../scss/case/voipx3/index.scss';
import { initCaseChrome } from '../../utils/case-chrome';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const PREFERS_REDUCED_MOTION = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

function bootCase() {
  const root = document.querySelector<HTMLElement>('.case-voipx3');
  if (!root) return;

  initImageFadeIn(root);
  initCaseChrome(root, '#1439CC');

  if (!PREFERS_REDUCED_MOTION) {
    initSectionReveal(root);
  }
}

function initSectionReveal(root: HTMLElement) {
  const items = root.querySelectorAll<HTMLElement>('.case-voipx3__section, .case-voipx3__hero');
  items.forEach((el) => {
    gsap.set(el, { opacity: 0, y: 40 });
    ScrollTrigger.create({
      trigger: el,
      start: 'top 88%',
      once: true,
      onEnter: () => {
        gsap.to(el, { opacity: 1, y: 0, duration: 1.1, ease: 'power3.out' });
      },
    });
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
  bar.className = 'case-voipx3__progress';
  const fill = document.createElement('div');
  fill.className = 'case-voipx3__progress-fill';
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
