/**
 * Algorithms
 */

('use strict');

(function () {
  const tabToggles = document.querySelectorAll('[data-bs-toggle="tab"]');
  tabToggles.forEach(toggle => {
    toggle.addEventListener('click', () => {
      document.querySelector('[data-tab-element="title"]').textContent = toggle.getAttribute('data-tab-title');
      document.querySelector('[data-tab-element="subtitle"]').textContent = toggle.getAttribute('data-tab-subtitle');
    });
  });
})();
