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
    const transactionQrCode = document.querySelector('.transaction-qr-code');
    const transactionReceivedPending = document.querySelector('#received-pending');
    const transactionNetwork = document.querySelector('.transaction-network');
    const transactionWalletAddress = document.querySelector('.transaction-wallet-address');

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
    transactionNetwork.innerHTML = '(TRC-20)';

    transactionAmountInUsd.forEach(el => {
      if (transaction.type === 'sent') {
        el.innerHTML = `<span class="text-danger">-${Number(transaction.amount_in_usd).toFixed(2) + el.getAttribute('data-symbol')}</span>`;
      } else if (transaction.type === 'locked') {
        el.innerHTML = `<span class="text-light">${Number(transaction.amount_in_usd).toFixed(2) + el.getAttribute('data-symbol')}</span>`;
      } else {
        el.innerHTML = `<span class="text-success">+${Number(transaction.amount_in_usd).toFixed(2) + el.getAttribute('data-symbol')}</span>`;
      }
    });
    transactionAmountInUsdPlain.forEach(el => (el.innerHTML = Number(transaction.amount_in_usd).toFixed(2)));
    transactionAmountInAsset.forEach(el => (el.innerHTML = Number(transaction.amount_in_asset).toFixed(2)));

    transactionReceivedPending.classList.add('d-none');
    transactionQrCode.classList.add('d-none');
    if (
      transaction.type === 'received' &&
      transaction.status === 'pending' &&
      (transaction.asset === 'USDT' || transaction.asset === 'TRX')
    ) {
      transactionReceivedPending.classList.remove('d-none');

      const tronWallet = await postRequest('/get-generated-tron-wallet-by-transaction', { tnx_id: transaction.tnx_id });
      transactionQrCode.classList.remove('d-none');
      transactionQrCode.querySelector('img').setAttribute('src', `data:image/png;base64,${tronWallet.qr_code}`);

      transactionWalletAddress.value = tronWallet.address_hex;
    }
  };

  transactionItems.forEach(item => {
    item.addEventListener('click', async () => {
      const tnx_id = item.getAttribute('data-tnx-id');
      const transaction = await postRequest('/get-transaction-by-id', { tnx_id });

      setTransactionModalContent(transaction);

      transactionDetailModal.show();
    });
  });

  const walletAddressWrapper = document.querySelector('.wallet-address-wrapper');
  const walletAddress = walletAddressWrapper.querySelector('#walletAddress');
  walletAddressWrapper.addEventListener('click', () => {
    const walletAddressPopover = document.querySelector('.wallet-address-popover');
    navigator.clipboard.writeText(walletAddress.value.trim());

    walletAddressPopover.style.left = '12px';
    walletAddressPopover.querySelector('.popover-body').textContent = 'Copied';
    walletAddressPopover.querySelector('.popover-arrow').style.transform = 'translate(23px, 0px)';

    walletAddress.select();
  });

  const chosenAssetAmountWrapper = document.querySelector('.chosen-asset-amount-wrapper');
  const chosenAssetAmount = document.querySelector('#chosenAssetAmount');
  chosenAssetAmountWrapper.addEventListener('click', () => {
    const chosenAssetAmountPopover = document.querySelector('.chosen-asset-amount-popover');

    navigator.clipboard.writeText(chosenAssetAmount.textContent);
    chosenAssetAmountPopover.style.left = '12px';
    chosenAssetAmountPopover.querySelector('.popover-body').textContent = 'Copied';
    chosenAssetAmountPopover.querySelector('.popover-arrow').style.transform = 'translate(23px, 0px)';
  });
})();
