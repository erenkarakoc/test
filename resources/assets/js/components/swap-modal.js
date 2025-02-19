/**
 * Swap Modal
 */

('use strict');

(function () {
  const swapInvertWrapper = document.querySelector('.swap-invert-wrapper');
  const swapInvert = document.querySelector('.swap-invert');

  swapInvert.addEventListener('click', () => {
    swapInvertWrapper.classList.toggle('swap-inverted');
  });

  const swapSelectors = document.querySelectorAll('.swap-selector');
  document.addEventListener('click', e => {
    swapSelectors.forEach(selector => {
      const withinBoundaries = e.composedPath().includes(selector);
      if (withinBoundaries && !selector.classList.contains('disabled')) {
        selector.classList.add('active');
      } else {
        selector.classList.remove('active');
      }
    });
  });
})();
