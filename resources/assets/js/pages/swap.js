/**
 * Swap
 */

('use strict');

(function () {
  const swapInvertWrapper = document.querySelector('.swap-invert-wrapper');
  const swapInvert = document.querySelector('.swap-invert');

  swapInvert.addEventListener('click', () => {
    swapInvertWrapper.classList.toggle('swap-inverted');
  });
})();
