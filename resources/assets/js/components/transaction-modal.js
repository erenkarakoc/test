/**
 * Transaction Modal
 */

('use strict');

(function () {
  const transactionDetailModal = new bootstrap.Modal(document.querySelector('#transactionDetailModal'));
  const transactionItems = document.querySelectorAll('.transaction-item');

  const postRequest = async (url, data) => {
    const getCsrfToken = () => document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken()
      },
      body: JSON.stringify(data)
    });

    return response.json();
  };

  const setTransactionModalContent = transaction => {
    const transactionDetailIcon = document.querySelector('.transaction-detail-icon');
    const transactionDetailStatus = document.querySelector('.transaction-detail-status');
    const transactionTnxText = document.querySelector('.transaction-tnx-text');
    const transactionTypeText = document.querySelector('.transaction-type-text');
    const transactionAssetText = document.querySelector('.transaction-asset-text');

    transactionDetailIcon.querySelectorAll('svg').forEach(svg => svg.classList.add('d-none'));
    transactionDetailIcon.querySelector('.transaction-' + transaction.type).classList.remove('d-none');

    transactionDetailStatus.querySelectorAll('.badge').forEach(badge => badge.classList.add('d-none'));
    transactionDetailStatus.querySelector('.transaction-' + transaction.status).classList.remove('d-none');

    transactionTnxText.innerHTML = transaction.tnx_id;
    transactionAssetText.innerHTML = transaction.asset;
    transactionTypeText.innerHTML = transactionTypeText.getAttribute('data-' + transaction.type + '-text');
  };

  transactionItems.forEach(item => {
    item.addEventListener('click', async () => {
      const tnx_id = item.getAttribute('data-tnx-id');
      const transaction = await postRequest('/get-transaction-by-id', { tnx_id });

      setTransactionModalContent(transaction);

      transactionDetailModal.show();
    });
  });
})();
