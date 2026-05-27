import '../../../scss/case/imagine/index.scss';
import { initCaseChrome } from '../../utils/case-chrome';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const PREFERS_REDUCED_MOTION = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

function bootCase() {
  const root = document.querySelector<HTMLElement>('.case-imagine');
  if (!root) return;

  initImageFadeIn(root);
  initCaseChrome(root, '#D2232A');
  initSliders(root);

  if (!PREFERS_REDUCED_MOTION) {
    initSectionReveal(root);
  } else {
    root
      .querySelectorAll<HTMLElement>('.case-imagine__section, .case-imagine__image-section')
      .forEach((el) => el.classList.add('is-revealed'));
  }
}

function initSliders(root: HTMLElement) {
  root.querySelectorAll<HTMLElement>('[data-im-slider]').forEach((slider) => {
    const track = slider.querySelector<HTMLElement>('.im-slider__track');
    const originals = Array.from(slider.querySelectorAll<HTMLElement>('.im-slider__slide'));
    const dots = Array.from(slider.querySelectorAll<HTMLButtonElement>('[data-im-slider-dot]'));
    if (!track || originals.length === 0) return;
    const n = originals.length;
    if (n < 2) return;

    const firstClone = originals[0].cloneNode(true) as HTMLElement;
    const lastClone = originals[n - 1].cloneNode(true) as HTMLElement;
    firstClone.classList.remove('is-active');
    lastClone.classList.remove('is-active');
    firstClone.setAttribute('aria-hidden', 'true');
    lastClone.setAttribute('aria-hidden', 'true');
    track.appendChild(firstClone);
    track.insertBefore(lastClone, originals[0]);

    const slides = Array.from(slider.querySelectorAll<HTMLElement>('.im-slider__slide'));

    const interval = Number(slider.dataset.imSliderInterval || 5000);
    let realIdx = 0;
    let trackIdx = 1;
    let isAnimating = false;
    let timer = 0;

    const slideWidth = () => slides[0].getBoundingClientRect().width || 315;
    const gap = 10;

    const applyTransform = (idx: number, animate: boolean) => {
      track.style.transition = animate ? 'transform 0.5s ease' : 'none';
      track.style.transform = `translate3d(${-idx * (slideWidth() + gap)}px, 0, 0)`;
      if (!animate) {
        void track.offsetWidth;
      }
    };

    const updateActive = () => {
      slides.forEach((s, idx) => s.classList.toggle('is-active', idx === trackIdx));
      dots.forEach((d, idx) => d.classList.toggle('is-active', idx === realIdx));
    };

    const settle = () => {
      if (trackIdx === 0) {
        trackIdx = n;
        applyTransform(trackIdx, false);
      } else if (trackIdx === n + 1) {
        trackIdx = 1;
        applyTransform(trackIdx, false);
      }
      isAnimating = false;
    };

    const next = () => {
      if (isAnimating) return;
      isAnimating = true;
      trackIdx += 1;
      realIdx = (realIdx + 1) % n;
      applyTransform(trackIdx, true);
      updateActive();
      window.setTimeout(settle, 520);
    };

    const goTo = (target: number) => {
      if (isAnimating) return;
      const norm = ((target % n) + n) % n;
      if (norm === realIdx) return;
      isAnimating = true;
      realIdx = norm;
      trackIdx = norm + 1;
      applyTransform(trackIdx, true);
      updateActive();
      window.setTimeout(() => {
        isAnimating = false;
      }, 520);
    };

    const start = () => {
      stop();
      timer = window.setInterval(next, interval);
    };

    const stop = () => {
      if (timer) {
        window.clearInterval(timer);
        timer = 0;
      }
    };

    dots.forEach((d) => {
      d.addEventListener('click', () => {
        const idx = Number(d.dataset.imSliderDot || 0);
        goTo(idx);
        start();
      });
    });

    applyTransform(trackIdx, false);
    updateActive();
    start();
    window.addEventListener('resize', () => applyTransform(trackIdx, false));
  });
}

function initSectionReveal(root: HTMLElement) {
  const items = root.querySelectorAll<HTMLElement>(
    '.case-imagine__section, .case-imagine__image-section',
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

function initProgressBar(root: HTMLElement) {
  const images = root.querySelectorAll<HTMLImageElement>('img');
  const total = images.length;
  if (total === 0) return;

  const bar = document.createElement('div');
  bar.className = 'case-imagine__progress';
  bar.setAttribute('aria-hidden', 'true');
  const fill = document.createElement('div');
  fill.className = 'case-imagine__progress-fill';
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
