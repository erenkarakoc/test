/**
 * Add Funds
 */

('use strict');

(function () {
  toastr.options = {
    positionClass: 'toast-top-center',
    timeOut: '1000',
    showDuration: '30',
    hideDuration: '30'
  };

  const addFunds = document.querySelector('#addFunds');

  if (typeof addFunds !== undefined && addFunds !== null) {
    const usdAmountInput = document.querySelector('#usdAmountInput');
    const assetAmountInput = document.querySelector('#assetAmountInput');
    const chooseAssetRadios = document.querySelectorAll('input[name="asset"]');
    const chosenAssetTextEl = document.querySelectorAll('.chosen-asset-text');
    const chosenAssetNetworkEl = document.querySelectorAll('.chosen-asset-network');
    const chosenAssetPriceEl = document.querySelector('.chosen-asset-price');
    const chosenAssetPriceInUsdEl = document.querySelectorAll('.chosen-asset-price-in-usd');
    const chosenAssetAmountEl = document.querySelectorAll('.chosen-asset-amount');
    const chosenAssetIconEl = document.querySelectorAll('.chosen-asset-icon');
    const chosenAssetIconSmEl = document.querySelectorAll('.chosen-asset-icon-sm');

    let chosenAsset = '';
    let chosenAssetNetwork = '(TRC-20)';
    let chosenAssetPrice = 1;
    let amountInChosenAsset = 1;
    let amountInUsd = null;
    let tnxId = '';

    chooseAssetRadios.forEach(radio => {
      radio.addEventListener('change', async e => {
        if (e.target.checked) {
          chosenAsset = e.target.value;
          chosenAssetNetwork =
            chosenAsset === 'USDT'
              ? '(TRC-20)'
              : chosenAsset === 'TRX'
                ? '(TRC-20)'
                : chosenAsset === 'ETH'
                  ? '(ERC-20)'
                  : chosenAsset === 'ETC'
                    ? '(ERC-20)'
                    : chosenAsset === 'BNB'
                      ? '(BSC-20)'
                      : '';

          chosenAssetPrice = chosenAsset === 'USDT' ? 1 : (await window.getAssetPrice(chosenAsset)) || 1;

          usdAmountInput.value = '';
          assetAmountInput.value = '';
          updateChosenAssetInfo();
        }
      });
    });

    assetAmountInput.addEventListener('keyup', e => {
      const amount = parseFloat(e.target.value) || 0;

      amountInChosenAsset = amount;
      amountInUsd = chosenAsset === 'USDT' ? amountInChosenAsset : amountInChosenAsset * chosenAssetPrice;
      usdAmountInput.value = Number(amountInUsd > 0 ? amountInUsd : '').toFixed(2);
      updateChosenAssetInfo();
    });

    usdAmountInput.addEventListener('keyup', e => {
      const amount = parseFloat(e.target.value) || 0;

      amountInUsd = amount;
      amountInChosenAsset = chosenAsset === 'USDT' ? amountInUsd : amountInUsd / chosenAssetPrice;
      assetAmountInput.value = Number(amountInChosenAsset > 0 ? amountInChosenAsset : '').toFixed(2);
      updateChosenAssetInfo();
    });

    const updateChosenAssetInfo = () => {
      const assetsData = JSON.parse(sessionStorage.getItem('assets-data')) || {};
      const assetData = assetsData[chosenAsset] || {};

      chosenAssetTextEl.forEach(text => (text.textContent = chosenAsset));
      chosenAssetNetworkEl.forEach(network => (network.textContent = chosenAssetNetwork));
      chosenAssetPriceEl.textContent = chosenAssetPrice;
      chosenAssetAmountEl.forEach(amount => (amount.textContent = Number(amountInChosenAsset).toFixed(2)));
      chosenAssetIconEl.forEach(icon => (icon.innerHTML = assetData.iconLg));
      chosenAssetIconSmEl.forEach(icon => (icon.innerHTML = assetData.iconSm));

      if (amountInUsd) {
        chosenAssetPriceInUsdEl.forEach(price => (price.textContent = Number(amountInUsd).toFixed(2)));
      }
    };

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

    // Start Progress
    const startTronProgress = addressHex => {
      const progressTimer = document.querySelector('#payment-progress-timer');

      const totalDuration = 30 * 60;
      let elapsedTime = 0;

      const runProgressBarInterval = setInterval(async () => {
        elapsedTime++;
        const minutes = Math.floor((totalDuration - elapsedTime) / 60);
        const seconds = (totalDuration - elapsedTime) % 60;
        progressTimer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        // check wallet
        const checkedWallet = await postRequest('check-tron-wallet-balance', { address_hex: addressHex });

        if (Number(checkedWallet.usdt_balance_received) || Number(checkedWallet.trx_balance_received)) {
          clearInterval(runProgressBarInterval);
          validationStepper.next();
        }

        if (elapsedTime >= totalDuration) {
          clearInterval(runProgressBarInterval);
          progressTimer.textContent = '0:00';
        }
      }, 1000);
    };

    // Generate Tron Wallet
    const generateTronWallet = async (asset, amountInAsset, amountInUsd) => {
      const transaction = await postRequest('/create-transaction-for-tron', {
        asset: asset,
        asset_price: Number(chosenAssetPrice),
        amount_in_asset: amountInAsset,
        amount_in_usd: amountInUsd
      });
      const tronWallet = await postRequest('/generate-tron-wallet', {
        tnx_id: transaction.data.tnx_id,
        asset_price: Number(chosenAssetPrice)
      });

      const qrCode = document.querySelector('.qr-code-wrapper img');
      const tnxIdEls = document.querySelectorAll('.tnxId');
      const walletAddress = document.querySelector('#walletAddress');
      tnxId = transaction.data.tnx_id;

      tnxIdEls.forEach(tnxIdEl => {
        tnxIdEl.innerHTML = `#TNX${tnxId}`;
        tnxIdEl.setAttribute('href', `/transactions/${tnxId}`);
      });
      qrCode.setAttribute('src', `data:image/png;base64,${tronWallet.qr_code}`);
      walletAddress.value = tronWallet.wallet_address;

      startTronProgress(tronWallet.wallet_address);
    };

    const cancelPayment = async () => {
      const cancelledTransaction = await postRequest('/cancel-transaction', {
        tnx_id: tnxId.toString()
      });

      window.location.reload();
    };
    const cancelPaymentButton = document.querySelector('#cancelPaymentButton');
    cancelPaymentButton.addEventListener('click', () => {
      toastr.error(
        `<div class="d-flex flex-column" id="cancelTransactionToast">
              <span>Are you sure you want to cancel this transaction?</span>
              <div class="d-flex justify-content-end mt-4">
              <button type="button" class="btn btn-label-success btn-sm" id="cancelTransactionButtonToastContinue">Continue</button>
              <button type="button" class="btn btn-danger btn-sm ms-2" id="cancelTransactionButtonToastCancel">Cancel</button>
              </div>
          </div>`,
        'Cancel Transaction',
        {
          timeOut: 0,
          extendedTimeOut: 0,
          onShown: function () {
            const cancelTransactionToast = document.querySelector('#cancelTransactionToast');
            const cancelTransactionButtonToastContinue = cancelTransactionToast.querySelector(
              '#cancelTransactionButtonToastContinue'
            );
            const cancelTransactionButtonToastCancel = cancelTransactionToast.querySelector(
              '#cancelTransactionButtonToastCancel'
            );

            cancelTransactionButtonToastCancel.addEventListener('click', () => {
              cancelPayment();
            });
            cancelTransactionButtonToastContinue.addEventListener('click', () => {
              toastr.clear();
            });
          }
        }
      );
    });

    const addFundsForm = addFunds.querySelector('#addFundsForm');
    const chooseAssetStep = addFundsForm.querySelector('#chooseAssetStep');
    const enterAmountStep = addFundsForm.querySelector('#enterAmountStep');
    const summaryStep = addFundsForm.querySelector('#summaryStep');
    const proceedStep = addFundsForm.querySelector('#proceedStep');

    const addFundsNext = [].slice.call(addFundsForm.querySelectorAll('.btn-next'));
    const addFundsPrev = [].slice.call(addFundsForm.querySelectorAll('.btn-prev'));

    let validationStepper = new Stepper(addFunds, {
      linear: true
    });

    // Form Validation
    const addFundsStep1 = FormValidation.formValidation(chooseAssetStep, {
      fields: {
        asset: {
          validators: {
            notEmpty: {
              message: 'Please choose an asset to proceed'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: ''
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          document.querySelector('.choose-asset-error-message').appendChild(e.messageElement);
        });
      }
    }).on('core.form.valid', function () {
      validationStepper.next();
    });
    const addFundsStep2 = FormValidation.formValidation(enterAmountStep, {
      fields: {
        asset_amount: {
          validators: {
            notEmpty: {
              message: 'Please type an amount'
            }
          }
        },
        usd_amount: {
          validators: {
            notEmpty: {
              message: 'Please type an amount'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: ''
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          if (e.element.parentElement.classList.contains('enter-amount-col')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    }).on('core.form.valid', function () {
      validationStepper.next();
    });
    const addFundsStep3 = FormValidation.formValidation(summaryStep, {
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: ''
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          document.querySelector('.choose-asset-error-message').appendChild(e.messageElement);
        });
      }
    }).on('core.form.valid', function () {
      validationStepper.next();
    });
    const addFundsStep4 = FormValidation.formValidation(proceedStep, {
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: ''
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          document.querySelector('.choose-asset-error-message').appendChild(e.messageElement);
        });
      }
    }).on('core.form.valid', function () {
      validationStepper.next();
    });

    addFundsNext.forEach(item => {
      item.addEventListener('click', async event => {
        switch (validationStepper._currentIndex) {
          case 0:
            addFundsStep1.validate();
            break;
          case 1:
            addFundsStep2.validate();
            break;
          case 2:
            const payNowButton = document.querySelector('#payNowButton');
            payNowButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke-dasharray="16" stroke-dashoffset="16" d="M12 3c4.97 0 9 4.03 9 9"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="16;0"/><animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path><path stroke-dasharray="64" stroke-dashoffset="64" stroke-opacity=".3" d="M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z"><animate fill="freeze" attributeName="stroke-dashoffset" dur="1.2s" values="64;0"/></path></g></svg>`;

            const form = new FormData(addFundsForm);
            const asset = form.get('asset');
            const amountInAsset = form.get('asset_amount');
            const amountInUsd = form.get('usd_amount');

            if (asset === 'USDT' || asset === 'TRX') {
              await generateTronWallet(asset, amountInAsset, amountInUsd);
              addFundsStep3.validate();
            } else {
              alert('not tron');
            }

            break;
          case 3:
            addFundsStep4.validate();
            break;

          default:
            break;
        }
      });
    });
    addFundsPrev.forEach(item => {
      item.addEventListener('click', event => {
        switch (validationStepper._currentIndex) {
          case 3:
            validationStepper.previous();
            break;
          case 2:
            validationStepper.previous();
            break;
          case 1:
            validationStepper.previous();
            break;
          case 0:
          default:
            break;
        }
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
  }
})();
