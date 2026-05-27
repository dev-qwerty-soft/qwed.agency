// Entry for the Cobble case bundle.

import '../../../scss/case/cobble/index.scss';
import { initCaseChrome } from '../../utils/case-chrome';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const PREFERS_REDUCED_MOTION = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

function bootCase() {
  const root = document.querySelector<HTMLElement>('.case-cobble');
  if (!root) return;

  initImageFadeIn(root);
  initCaseChrome(root, '#F20505');

  if (!PREFERS_REDUCED_MOTION) {
    initSectionReveal(root);
  } else {
    root
      .querySelectorAll<HTMLElement>('.case-cobble__image-section')
      .forEach((el) => el.classList.add('is-revealed'));
  }
}

function initSectionReveal(root: HTMLElement) {
  const items = root.querySelectorAll<HTMLElement>('.case-cobble__image-section');

  items.forEach((el) => {
    gsap.set(el, { opacity: 0, y: 40 });
    ScrollTrigger.create({
      trigger: el,
      start: 'top 88%',
      once: true,
      onEnter: () => {
        gsap.to(el, {
          opacity: 1,
          y: 0,
          duration: 1.1,
          ease: 'power3.out',
          onComplete: () => el.classList.add('is-revealed'),
        });
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
    const markLoaded = () => img.classList.add('is-loaded');
    img.addEventListener('load', markLoaded, { once: true });
    img.addEventListener('error', markLoaded, { once: true });
  });
}

function initProgressBar(root: HTMLElement) {
  const images = root.querySelectorAll<HTMLImageElement>('img');
  const total = images.length;
  if (total === 0) return;

  const bar = document.createElement('div');
  bar.className = 'case-cobble__progress';
  bar.setAttribute('aria-hidden', 'true');
  const fill = document.createElement('div');
  fill.className = 'case-cobble__progress-fill';
  bar.appendChild(fill);
  document.body.appendChild(bar);

  let loaded = 0;
  const update = () => {
    const pct = (loaded / total) * 100;
    fill.style.transform = `scaleX(${pct / 100})`;
    if (loaded >= total) {
      bar.classList.add('is-done');
      window.setTimeout(() => bar.remove(), 700);
    }
  };

  images.forEach((img) => {
    if (img.complete) {
      loaded += 1;
    } else {
      const onDone = () => {
        loaded += 1;
        update();
      };
      img.addEventListener('load', onDone, { once: true });
      img.addEventListener('error', onDone, { once: true });
    }
  });
  update();
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', bootCase, { once: true });
} else {
  bootCase();
}
