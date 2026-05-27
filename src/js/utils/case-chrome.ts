/**
 * Shared case "chrome":
 *  - a slim scroll-progress bar pinned to the top that fills with the accent;
 *  - a neutral circular scroll-to-top button bottom-right whose ring fills with
 *    the accent colour as the page is scrolled.
 * Each case calls initCaseChrome(root, accent) with its own accent hex.
 */
export function initCaseChrome(root: HTMLElement, accent: string): void {
  if (!root) return;

  const bar = document.createElement('div');
  bar.className = 'case-chrome__progress';
  bar.setAttribute('aria-hidden', 'true');

  const fill = document.createElement('div');
  fill.className = 'case-chrome__progress-fill';
  fill.style.background = accent;
  bar.appendChild(fill);

  const R = 24;
  const CIRC = 2 * Math.PI * R;

  const top = document.createElement('button');
  top.className = 'case-chrome__top';
  top.type = 'button';
  top.setAttribute('aria-label', 'Scroll to top');
  top.innerHTML =
    `<svg class="case-chrome__ring" viewBox="0 0 52 52" aria-hidden="true">` +
    `<circle class="case-chrome__ring-track" cx="26" cy="26" r="${R}"></circle>` +
    `<circle class="case-chrome__ring-fill" cx="26" cy="26" r="${R}"></circle>` +
    `</svg>` +
    `<svg class="case-chrome__arrow" viewBox="0 0 24 24" fill="none" aria-hidden="true">` +
    `<path d="M12 18V6M12 6L6.5 11.5M12 6L17.5 11.5" stroke="currentColor" stroke-width="2" ` +
    `stroke-linecap="round" stroke-linejoin="round"/></svg>`;

  document.body.appendChild(bar);
  document.body.appendChild(top);

  const ringFill = top.querySelector<SVGCircleElement>('.case-chrome__ring-fill');
  if (ringFill) {
    ringFill.style.stroke = accent;
    ringFill.style.strokeDasharray = `${CIRC}`;
    ringFill.style.strokeDashoffset = `${CIRC}`;
  }

  top.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  let current = 0;

  const tick = () => {
    const doc = document.documentElement;
    const max = doc.scrollHeight - window.innerHeight;
    const target = max > 0 ? Math.min(1, Math.max(0, window.scrollY / max)) : 0;
    current += (target - current) * 0.18;
    if (Math.abs(target - current) < 0.0003) current = target;
    fill.style.transform = `scaleX(${current})`;
    if (ringFill) {
      ringFill.style.strokeDashoffset = `${CIRC * (1 - current)}`;
    }
    top.classList.toggle('is-visible', window.scrollY > window.innerHeight * 0.6);
    window.requestAnimationFrame(tick);
  };

  window.requestAnimationFrame(tick);
}
