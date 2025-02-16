/**
 * Swap
 */

('use strict');

(function () {
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

  chooseAssetRadios.forEach(radio => {
    radio.addEventListener('change', async e => {
      if (e.target.checked) {
        chosenAsset = e.target.value;
        chosenAssetNetwork = e.target.getAttribute('data-network');

        chosenAssetPrice = chosenAsset === 'USDT' ? 1 : (await window.getAssetPrice(chosenAsset)) || 1;

        usdAmountInput.value = '';
        assetAmountInput.value = '';
        updateChosenAssetInfo();
      }
    });
  });

  const swapForm = swap.querySelector('#swapForm');
  const chooseAssetStep = swapForm.querySelector('#chooseAssetStep');
  const chooseReceivingAssetStep = swapForm.querySelector('#chooseReceivingAssetStep');
  const enterAmountStep = swapForm.querySelector('#enterAmountStep');
  const completedStep = swapForm.querySelector('#completedStep');

  const swapNext = [].slice.call(swapForm.querySelectorAll('.btn-next'));
  const swapPrev = [].slice.call(swapForm.querySelectorAll('.btn-prev'));

  let validationStepper = new Stepper(swap, {
    linear: true
  });

  // Form Validation
  const swapStep1 = FormValidation.formValidation(chooseAssetStep, {
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

  const swapStep2 = FormValidation.formValidation(chooseReceivingAssetStep, {
    fields: {
      receivingAsset: {
        validators: {
          notEmpty: {
            message: 'Please choose a receiving asset to proceed'
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

  const swapStep3 = FormValidation.formValidation(enterAmountStep, {
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

  const swapStep4 = FormValidation.formValidation(completedStep, {
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

  swapNext.forEach(item => {
    item.addEventListener('click', async () => {
      switch (validationStepper._currentIndex) {
        case 0:
          swapStep1.validate();
          break;
        case 1:
          swapStep2.validate();
          break;
        case 2:
          swapStep3.validate();
          break;
        case 3:
          swapStep4.validate();
          break;

        default:
          break;
      }
    });
  });
  swapPrev.forEach(item => {
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
})();
