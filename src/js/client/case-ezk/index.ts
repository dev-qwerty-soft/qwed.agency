// Entry for the EZK case bundle. Imports the SCSS so MiniCssExtract emits
// dist/css/case-ezk.min.css alongside dist/js/case-ezk.min.js, and wires up
// scroll-driven GSAP animations, per-image fade-in, and a top progress bar.

import '../../../scss/case/ezk/index.scss';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const PREFERS_REDUCED_MOTION = window.matchMedia(
  '(prefers-reduced-motion: reduce)'
).matches;

function bootCase() {
  const root = document.querySelector<HTMLElement>('.case-ezk');
  if (!root) return;

  initImageFadeIn(root);
  initProgressBar(root);

  if (!PREFERS_REDUCED_MOTION) {
    initSectionReveal(root);
    initHeroParallax(root);
  } else {
    root
      .querySelectorAll<HTMLElement>(
        '.case-ezk__section, .case-ezk__image-section, .case-ezk__deco'
      )
      .forEach((el) => el.classList.add('is-revealed'));
  }
}

function initSectionReveal(root: HTMLElement) {
  const items = root.querySelectorAll<HTMLElement>(
    '.case-ezk__section, .case-ezk__image-section, .case-ezk__deco'
  );

  items.forEach((el) => {
    gsap.set(el, { y: 40 });
    el.classList.add('is-revealed');
    ScrollTrigger.create({
      trigger: el,
      start: 'top 88%',
      once: true,
      onEnter: () => {
        gsap.to(el, {
          y: 0,
          duration: 1.1,
          ease: 'power3.out',
        });
      },
    });
  });
}

function initHeroParallax(root: HTMLElement) {
  const hero = root.querySelector<HTMLElement>('.case-ezk-hero');
  if (!hero) return;

  const layers: Array<{ el: HTMLElement | null; depth: number }> = [
    { el: root.querySelector<HTMLElement>('.case-ezk-hero__leaves--top-right'), depth: -120 },
    { el: root.querySelector<HTMLElement>('.case-ezk-hero__leaves--bottom-left'), depth: 80 },
    { el: root.querySelector<HTMLElement>('.case-ezk-hero__device'), depth: -40 },
  ];

  layers.forEach(({ el, depth }) => {
    if (!el) return;
    gsap.to(el, {
      y: depth,
      ease: 'none',
      scrollTrigger: {
        trigger: hero,
        start: 'top top',
        end: 'bottom top',
        scrub: true,
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
  bar.className = 'case-ezk__progress';
  bar.setAttribute('aria-hidden', 'true');
  const fill = document.createElement('div');
  fill.className = 'case-ezk__progress-fill';
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
