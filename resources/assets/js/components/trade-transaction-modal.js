/**
 * Trade Transaction Modal
 */

('use strict');

(function () {
  const tradeTransaction = document.querySelectorAll('.trade-transaction-item');

  tradeTransaction.forEach(item => {
    item.addEventListener('click', () => {
      item.classList.toggle('active');
    });
  });
})();
