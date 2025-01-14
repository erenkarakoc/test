/**
 * Strategy Packs
 */

('use strict');

(function () {
  const strategyPackAlgoBtns = document.querySelectorAll('.strategy-pack-algo-btn');

  strategyPackAlgoBtns.forEach(button => {
    button.addEventListener('click', () => {
      const strategyPackAlgorithms = button.parentElement.querySelector('.strategy-pack-algorithms');

      if (strategyPackAlgorithms.classList.contains('d-none')) {
        strategyPackAlgorithms.classList.remove('d-none');
        button.textContent = button.getAttribute('data-expanded-text');
      } else {
        strategyPackAlgorithms.classList.add('d-none');
        button.textContent = button.getAttribute('data-collapsed-text');
      }
    });
  });
})();
