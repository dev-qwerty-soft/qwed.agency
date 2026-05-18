import '@client/animation/gsap';
import '@client/elements/swiper';
import '../../scss/style.scss';
import { g, toggle } from '@utils/function';

const burger = g('#mobile-toggle');
const menu = g('#mobile-menu');

if (burger && menu) {
  burger.addEventListener('click', () => {
    const isOpen = menu.classList.contains('active');

    toggle(burger, 'active');
    toggle(menu, 'active');
    toggle(document.body, 'overflow');

    burger.setAttribute('aria-expanded', String(!isOpen));
    burger.setAttribute('aria-label', isOpen ? 'Open menu' : 'Close menu');
    menu.setAttribute('aria-hidden', String(isOpen));
  });
}
