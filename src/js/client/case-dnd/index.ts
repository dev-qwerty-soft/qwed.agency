import '../../../scss/case/dnd/index.scss';
import { initCaseChrome } from '../../utils/case-chrome';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const PREFERS_REDUCED_MOTION = window.matchMedia(
  '(prefers-reduced-motion: reduce)'
).matches;

function bootCase() {
  const root = document.querySelector<HTMLElement>('.case-dnd');
  if (!root) return;

  initImageFadeIn(root);
  initCaseChrome(root, '#8eaaf0');

  if (!PREFERS_REDUCED_MOTION) {
    initSectionReveal(root);
  } else {
    root
      .querySelectorAll<HTMLElement>(
        '.case-dnd__image-section, .case-dnd__s04-section, .case-dnd__card-pair, .case-dnd__typo-section'
      )
      .forEach((el) => el.classList.add('is-revealed'));
  }
}

function initSectionReveal(root: HTMLElement) {
  const items = root.querySelectorAll<HTMLElement>(
    '.case-dnd__image-section, .case-dnd__s04-section, .case-dnd__card-pair, .case-dnd__typo-section'
  );

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

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', bootCase, { once: true });
} else {
  bootCase();
}
