/**
 * Transaction Modal
 */

('use strict');

(function () {
  const transactionDetailModalEl = document.querySelector('#transactionDetailModal');
  const transactionDetailModal = new bootstrap.Modal(transactionDetailModalEl);
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

  const setTransactionModalContent = async transaction => {
    const transactionDetailIcon = document.querySelector('.transaction-detail-icon');
    const transactionDetailStatus = document.querySelector('.transaction-detail-status');
    const transactionTnxText = document.querySelectorAll('.transaction-tnx-text');
    const transactionTypeText = document.querySelector('.transaction-type-text');
    const transactionAsset = document.querySelectorAll('.transaction-asset');
    const transactionAssetPrice = document.querySelectorAll('.transaction-asset-price');
    const transactionAmountInUsd = document.querySelectorAll('.transaction-amount-in-usd');
    const transactionAmountInUsdPlain = document.querySelectorAll('.transaction-amount-in-usd-plain');
    const transactionAmountInAsset = document.querySelectorAll('.transaction-amount-in-asset');
    const transactionAssetBalanceAfter = document.querySelector('.transaction-asset-balance-after');
    const transactionTotalBalanceAfter = document.querySelector('.transaction-total-balance-after');
    const transactionHashIdWrapper = document.querySelector('.transaction-hash-id-wrapper');
    const transactionHashId = transactionHashIdWrapper.querySelector('.transaction-hash-id');
    const transactionCreatedDate = document.querySelector('.transaction-created-date');
    const transactionConfirmedDate = document.querySelector('.transaction-confirmed-date');
    const transactionNotesWrapper = document.querySelector('.transaction-notes-wrapper');
    const transactionNotes = document.querySelector('.transaction-notes');

    transactionDetailIcon.querySelectorAll('svg').forEach(svg => svg.classList.add('d-none'));
    transactionDetailIcon.querySelector('.transaction-' + transaction.type).classList.remove('d-none');

    transactionDetailStatus.querySelectorAll('.badge').forEach(badge => badge.classList.add('d-none'));
    transactionDetailStatus.querySelector('.transaction-' + transaction.status).classList.remove('d-none');

    transactionTypeText.innerHTML = transactionTypeText.getAttribute('data-' + transaction.type + '-text');

    transactionAssetPrice.forEach(
      el => (el.innerHTML = Number(transaction.asset_price).toFixed(2) + el.getAttribute('data-symbol'))
    );
    transactionTnxText.forEach(el => (el.innerHTML = transaction.tnx_id));
    transactionAsset.forEach(el => (el.innerHTML = transaction.asset));

    transactionAmountInUsd.forEach(el => {
      if (transaction.type === 'sent') {
        el.innerHTML = `<span class="text-danger">-${Number(transaction.amount_in_usd).toFixed(2) + el.getAttribute('data-symbol')}</span>`;
      } else if (transaction.type === 'swap') {
        if (transaction.swap_to_asset) {
          el.innerHTML = `<span class="text-danger">-${Number(transaction.amount_in_usd).toFixed(2) + el.getAttribute('data-symbol')}</span>`;
        } else {
          el.innerHTML = `<span class="text-success">+${Number(transaction.amount_in_usd).toFixed(2) + el.getAttribute('data-symbol')}</span>`;
        }
      } else if (transaction.type === 'locked') {
        el.innerHTML = `<span class="text-light">${Number(transaction.amount_in_usd).toFixed(2) + el.getAttribute('data-symbol')}</span>`;
      } else {
        el.innerHTML = `<span class="text-success">+${Number(transaction.amount_in_usd).toFixed(2) + el.getAttribute('data-symbol')}</span>`;
      }
    });
    transactionAmountInUsdPlain.forEach(el => (el.innerHTML = Number(transaction.amount_in_usd).toFixed(2)));

    transactionAmountInAsset.forEach(el => {
      if (transaction.type === 'sent') {
        el.innerHTML = `<span class="text-danger">-${transaction.amount_in_asset} ${transaction.asset}</span>`;
      } else if (transaction.type === 'swap') {
        if (transaction.swap_to_asset) {
          el.innerHTML = `<span class="text-success">+${transaction.amount_in_asset} ${transaction.asset}</span>`;
        } else {
          el.innerHTML = `<span class="text-danger">-${transaction.amount_in_asset} ${transaction.asset}</span>`;
        }
      } else if (transaction.type === 'locked') {
        el.innerHTML = `<span class="text-light">-${transaction.amount_in_asset} ${transaction.asset}</span>`;
      } else {
        el.innerHTML = `<span class="text-success">+${transaction.amount_in_asset} ${transaction.asset}</span>`;
      }
    });

    transactionAssetBalanceAfter.innerHTML = transaction.asset_balance_after + ' ' + transaction.asset;
    transactionTotalBalanceAfter.innerHTML =
      Number(transaction.total_balance_after).toFixed(2) + transactionTotalBalanceAfter.getAttribute('data-symbol');

    transactionHashIdWrapper.classList.add('d-none');
    if (transaction.hash_id) {
      let explorerLink = '';

      if (transaction.asset === 'TRX' || transaction.asset === 'USDT') {
        explorerLink = 'https://tronscan.org/#/transaction/';
      } else if (transaction.asset === 'BNB') {
        explorerLink = 'https://bscscan.com/tx/';
      }

      transactionHashIdWrapper.classList.remove('d-none');
      transactionHashId.setAttribute('href', explorerLink + transaction.hash_id);
      transactionHashId.innerHTML = transaction.hash_id;
    }

    const createdDate = new Date(transaction.created_at);
    transactionCreatedDate.innerHTML = createdDate.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric',
      hour: 'numeric',
      minute: 'numeric'
    });

    const confirmedDate = new Date(transaction.updated_at);
    if (createdDate.getTime() !== confirmedDate.getTime()) {
      transactionConfirmedDate.innerHTML = confirmedDate.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric'
      });
    }

    transactionNotesWrapper.classList.add('d-none');
    const notesPopover = document
      .querySelector('[data-tnx-id="' + transaction.tnx_id + '"]')
      .querySelector('.popover-trigger');

    if (notesPopover) {
      transactionNotesWrapper.classList.remove('d-none');
      transactionNotes.innerHTML = notesPopover.getAttribute('data-bs-content');
    }

    transactionDetailModalEl.addEventListener('hide.bs.modal', () => {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.delete('tnx_id');

      const newUrl = window.location.pathname + '?' + urlParams.toString();
      window.history.replaceState({}, '', newUrl);
    });

    transactionDetailModalEl.addEventListener('show.bs.modal', () => {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set('tnx_id', transaction.tnx_id);

      const newUrl = window.location.pathname + '?' + urlParams.toString();
      window.history.replaceState({}, '', newUrl);
    });
  };

  transactionItems.forEach(item => {
    item.addEventListener('click', async () => {
      const tnx_id = item.getAttribute('data-tnx-id');
      const transaction = await postRequest('/get-transaction-by-id', { tnx_id });

      setTransactionModalContent(transaction);

      transactionDetailModal.show();
    });
  });

  document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get('tnx_id')) {
      const transaction = await postRequest('/get-transaction-by-id', { tnx_id: urlParams.get('tnx_id') });

      setTransactionModalContent(transaction);
      transactionDetailModal.show();
    }
  });
})();
