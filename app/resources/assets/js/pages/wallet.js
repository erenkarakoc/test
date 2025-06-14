/**
 * Wallet
 */

('use strict');

(function () {
  const assetsData = JSON.parse(sessionStorage.getItem('assets-data'));

  ////////////////////////
  /// Form Validations ///
  ////////////////////////
  const manageWalletForm = document.querySelector('#manageWalletForm');
  const addWalletModalForm = document.querySelector('#addWalletModalForm');

  let mfv,
    afv = null;

  const initializeAfv = () => {
    const symbol = document.querySelector('#addWalletAssetSelect').value;
    const regex =
      symbol === 'BTC'
        ? /^(bc1|[13])[a-zA-HJ-NP-Z0-9]{25,39}$/
        : symbol === 'ETC'
          ? /0x[a-fA-F0-9]{40}$/
          : symbol === 'ETH'
            ? /0x[a-fA-F0-9]{40}$/
            : symbol === 'BNB'
              ? /0x[a-fA-F0-9]{40}$/
              : symbol === 'USDT'
                ? /^T[A-Za-z0-9]{33}$/
                : symbol === 'TRX'
                  ? /^T[A-Za-z0-9]{33}$/
                  : symbol === 'LTC'
                    ? /^[LM3][a-km-zA-HJ-NP-Z1-9]{26,33}$/
                    : /.*$/;
    const existingLabels = document
      .querySelector('#addModalAssetLabel')
      .getAttribute('data-existing-labels')
      .split(', ')
      .map(item => {
        return item.trim();
      })
      .filter(item => item !== undefined);

    return FormValidation.formValidation(addWalletModalForm, {
      fields: {
        wallet_address: {
          validators: {
            notEmpty: {
              message: 'Please enter a wallet address'
            },
            regexp: {
              regexp: regex,
              message: `Please enter a valid ${symbol} address`
            }
          }
        },
        label: {
          validators: {
            stringLength: {
              max: 30,
              message: 'Label cannot exceed 30 characters'
            },
            callback: {
              message: 'A wallet with this label already exists',
              callback: input => {
                return !existingLabels.includes(input.value.trim());
              }
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
          rowSelector: '.add-wallet-form-row'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    });
  };
  const reinitializeAfv = () => {
    if (afv) {
      afv.destroy();
    }
    afv = initializeAfv();
  };

  const initializeMfv = () => {
    const symbol = sessionStorage.getItem('current-symbol');
    const regex =
      symbol === 'BTC'
        ? /^(bc1|[13])[a-zA-HJ-NP-Z0-9]{25,39}$/
        : symbol === 'ETC'
          ? /0x[a-fA-F0-9]{40}$/
          : symbol === 'ETH'
            ? /0x[a-fA-F0-9]{40}$/
            : symbol === 'USDT'
              ? /^T[A-Za-z0-9]{33}$/
              : symbol === 'TRX'
                ? /^T[A-Za-z0-9]{33}$/
                : symbol === 'LTC'
                  ? /^[LM3][a-km-zA-HJ-NP-Z1-9]{26,33}$/
                  : /.*$/;

    const currentLabel = document.querySelector('#manageModalAssetLabel').value;
    const existingLabels = document
      .querySelector('#manageModalAssetLabel')
      .getAttribute('data-existing-labels')
      .split(', ')
      .map(item => item.trim())
      .filter(item => item !== currentLabel);

    return FormValidation.formValidation(manageWalletForm, {
      fields: {
        wallet_address: {
          validators: {
            notEmpty: {
              message: 'Please enter a wallet address'
            },
            regexp: {
              regexp: regex,
              message: `Please enter a valid ${symbol} address`
            }
          }
        },
        label: {
          validators: {
            stringLength: {
              max: 30,
              message: 'Label cannot exceed 30 characters'
            },
            callback: {
              message: 'A wallet with this label already exists',
              callback: input => {
                return !existingLabels.includes(input.value.trim());
              }
            }
          }
        },
        active: {},
        symbol: {}
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
          rowSelector: '.manage-wallet-form-row'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    });
  };
  const reinitializeMfv = () => {
    if (mfv) {
      mfv.destroy();
    }
    mfv = initializeMfv();
  };

  // Add Wallet Modal
  const addWalletAssetSelect = document.querySelector('#addWalletAssetSelect');
  const addWalletAddressInput = document.querySelector('#addWalletAddressInput');
  const addWalletAssetIcon = document.querySelector('#addWalletAssetIcon');

  const setAssetData = e => {
    const selectedAsset = e ? e.target.value : null;
    const asset = selectedAsset ? assetsData[selectedAsset] : assetsData[addWalletAssetSelect.value];

    addWalletAssetIcon.innerHTML = asset.iconSm;
    addWalletAddressInput.setAttribute('placeholder', asset.placeholder);
    addWalletAddressInput.setAttribute('aria-label', asset.placeholder);
  };
  setAssetData();
  reinitializeAfv();

  const addWalletModalToggle = document.querySelector('.addWalletModalToggle');
  if (addWalletModalToggle) {
    addWalletModalToggle.addEventListener('click', () => {
      setAssetData();
      reinitializeAfv();
    });
  }

  addWalletAssetSelect.addEventListener('change', e => {
    setAssetData(e);
    reinitializeAfv();
  });

  const addWalletPasteButton = document.querySelector('#addWalletPasteButton');

  addWalletPasteButton.addEventListener('click', async () => {
    const clipboardText = await navigator.clipboard.readText();
    if (clipboardText) {
      addWalletAddressInput.value = clipboardText;
    }
  });

  // Manage Wallet Modal
  const manageWalletAddressInput = document.querySelector('#manageWalletAddressInput');
  const manageWalletAssetIcon = document.querySelector('#manageWalletAssetIcon');
  const manageWalletModalIcon = document.querySelector('#manageWalletModalIcon');

  const setManageWalletData = selectedAsset => {
    const asset = selectedAsset ? assetsData[selectedAsset] : assetsData['USDT'];

    manageWalletAssetIcon.innerHTML = asset.iconSm;
    manageWalletModalIcon.innerHTML = asset.iconLg;
    manageWalletAddressInput.setAttribute('placeholder', asset.placeholder);
    manageWalletAddressInput.setAttribute('aria-label', asset.placeholder);
  };

  // Paste Button
  const manageWalletPasteButton = document.querySelector('#manageWalletPasteButton');

  manageWalletPasteButton.addEventListener('click', async () => {
    const clipboardText = await navigator.clipboard.readText();
    if (clipboardText) {
      manageWalletAddressInput.value = clipboardText;
    }
  });

  // Display Modal
  const toggleManageModalButton = document.querySelectorAll('.toggle-manage-modal-button');
  const manageModal = document.querySelector('#manageWalletModal');
  const manageWalletModalSymbol = document.querySelector('#manageWalletModalSymbol');
  const manageModalTitle = manageModal.querySelector('#manageWalletModalTitle');
  const manageWalletModalSymbolLabel = manageModal.querySelector('#manageWalletModalSymbolLabel');
  const manageModalAddressInput = manageModal.querySelector('#manageWalletAddressInput');
  const manageModalAssetLabel = manageModal.querySelector('#manageModalAssetLabel');
  const manageWalletActiveSwitch = manageModal.querySelector('#manageWalletActiveSwitch');
  const manageWalletActiveLabel = manageModal.querySelector('#manageWalletActiveLabel');

  toggleManageModalButton.forEach(button =>
    button.addEventListener('click', () => {
      const id = button.getAttribute('data-id');
      const symbol = button.getAttribute('data-symbol');
      const title = button.getAttribute('data-title');
      const address = button.getAttribute('data-address');
      const label = button.getAttribute('data-label');
      const active = button.getAttribute('data-active');

      manageWalletModalSymbol.value = symbol;
      manageWalletModalSymbol.setAttribute('data-wallet-id', id);
      manageModalTitle.innerHTML = `${title} Wallet`;
      manageWalletModalSymbolLabel.innerHTML = `${symbol} ${symbol === 'USDT' || symbol === 'TRX' ? '<span class="text-light">(TRC-20)</span>' : symbol === 'ETH' || symbol === 'ETC' ? '<span class="text-light">(ERC-20)</span>' : ''}`;
      manageModalAddressInput.value = address || '';
      manageModalAssetLabel.value = label || '';
      manageWalletActiveSwitch.checked = active === 'true' ? true : false;
      manageWalletActiveLabel.innerHTML = active === 'true' ? 'Active' : 'Inactive';

      sessionStorage.setItem('current-symbol', symbol);
      reinitializeMfv();
      setManageWalletData(symbol);
    })
  );

  manageWalletActiveSwitch.addEventListener('change', e => {
    manageWalletActiveLabel.innerHTML = e.target.checked ? 'Active' : 'Inactive';
  });

  //////////////
  /// Charts ///
  //////////////

  // Wallet Asset Chart
  // --------------------------------------------------------------------
  const walletAssetChartConfig = {
    chart: {
      height: 60,
      type: 'area',
      toolbar: {
        show: false
      },
      sparkline: {
        enabled: true
      }
    },
    markers: {
      colors: 'transparent',
      strokeColors: 'transparent'
    },
    grid: {
      show: false,
      padding: {
        top: 5
      }
    },
    colors: [config.colors.primary],
    fill: {
      type: 'gradient',
      gradient: {
        shade: config.colors.primary,
        shadeIntensity: 0.5,
        opacityFrom: 0.3,
        opacityTo: 0.1
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      width: 2,
      curve: 'smooth'
    },
    xaxis: {
      show: true,
      lines: {
        show: false
      },
      labels: {
        show: false
      },
      stroke: {
        width: 0
      },
      axisBorder: {
        show: false
      }
    },
    yaxis: {
      stroke: {
        width: 0
      },
      show: false
    },
    tooltip: {
      enabled: false
    },
    responsive: [
      {
        breakpoint: 1387,
        options: {
          chart: {
            height: 80
          }
        }
      },
      {
        breakpoint: 1200,
        options: {
          chart: {
            height: 123
          }
        }
      }
    ]
  };

  const getAssetChartDataTimeout = setInterval(() => {
    const assetChartData = localStorage.getItem('asset-chart-data');

    if (assetChartData && assetChartData !== 'loading') {
      const data = JSON.parse(assetChartData);

      data.forEach(asset => {
        const assetEl = document.querySelector('.wallet-asset-chart-' + asset.title);

        const processedData = asset.data.map(day => ({
          x: new Date(day.time).toLocaleDateString('en-US', { month: '2-digit', day: '2-digit' }),
          y: day.close
        }));

        walletAssetChartConfig.series = [
          {
            name: asset.title,
            data: processedData
          }
        ];

        if (assetEl) {
          const wrapperEl = document.querySelector('.wallet-item-' + asset.title);
          wrapperEl.querySelector('.price-hidden').classList.remove('price-hidden');

          const walletAssetChart = new ApexCharts(assetEl, walletAssetChartConfig);
          walletAssetChart.render();
        }
      });

      clearInterval(getAssetChartDataTimeout);
    }
  }, 200);

  toastr.options = {
    positionClass: 'toast-top-center',
    timeOut: '1000',
    showDuration: '30',
    hideDuration: '30'
  };

  manageWalletForm.addEventListener('submit', e => {
    e.preventDefault();

    mfv.validate().then(status => {
      if (status === 'Valid') {
        const submitButton = e.target.querySelector('button[type="submit"]');
        submitButton.disabled = true;

        const form = e.target;
        const formData = new FormData(form);

        formData.set('id', form.querySelector('[data-wallet-id]').getAttribute('data-wallet-id'));
        formData.set('active', form.elements['active'].checked);

        fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
          }
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              const newData = data.data;
              toastr.success(`<div class="d-flex align-items-center">${newData.title} wallet updated.</div>`);
              window.location.href = window.location.pathname + '?tab=manage';
            } else {
              toastr.error(
                `<div class="d-flex align-items-center">Something went wrong while updating ${formData.get('title')} wallet. Please try again.</div>`
              );
            }
          })
          .catch(() => {
            toastr.error(
              `<div class="d-flex align-items-center">Something went wrong while updating ${formData.get('title')} wallet. Please try again.</div>`
            );
          });
      }
    });
  });

  addWalletModalForm.addEventListener('submit', e => {
    e.preventDefault();

    afv.validate().then(status => {
      if (status === 'Valid') {
        const submitButton = e.target.querySelector('button[type="submit"]');
        submitButton.disabled = true;

        const form = e.target;
        const formData = new FormData(form);
        const title = form.elements['symbol']
          .querySelector('[value=' + formData.get('symbol') + ']')
          .getAttribute('data-title');
        formData.set('title', title);

        fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
          }
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              toastr.success(`<div class="d-flex align-items-center">${formData.get('symbol')} wallet added.</div>`);
              window.location.href = window.location.pathname + '?tab=manage';
            } else {
              toastr.error(
                `<div class="d-flex align-items-center">Something went wrong while adding ${formData.get('symbol')} wallet. Please try again.</div>`
              );
            }
          })
          .catch(() => {
            toastr.error(
              `<div class="d-flex align-items-center">Something went wrong while adding ${formData.get('symbol')} wallet. Please try again.</div>`
            );
          });
      }
    });
  });

  const manageWalletRemoveButton = document.querySelector('#manageWalletRemoveButton');
  manageWalletRemoveButton.addEventListener('click', e => {
    e.preventDefault();

    const symbol = manageWalletModalSymbol.value;
    const id = document.querySelector('[data-wallet-id]').getAttribute('data-wallet-id');
    const data = { id: id };

    toastr.error(
      `<div class="d-flex flex-column" id="removeWalletToast">
            <span>Are you sure you want to remove the <span class="fw-bold text-white">${symbol}</span> wallet?</span>
            <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-label-danger btn-sm" id="removeWalletButtonToastCancel">Cancel</button>
            <button type="button" class="btn btn-danger btn-sm ms-2" id="removeWalletButtonToastDelete">Delete</button>
            </div>
        </div>`,
      'Confirm Removal',
      {
        timeOut: 0,
        extendedTimeOut: 0,
        onShown: function () {
          const removeWalletToast = document.querySelector('#removeWalletToast');
          const removeWalletButtonToastCancel = removeWalletToast.querySelector('#removeWalletButtonToastCancel');
          const removeWalletButtonToastDelete = removeWalletToast.querySelector('#removeWalletButtonToastDelete');

          removeWalletButtonToastDelete.addEventListener('click', () => {
            fetch('/remove-wallet', {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(data)
            })
              .then(response => response.json())
              .then(responseData => {
                if (responseData.success) {
                  toastr.success(`<div class="d-flex align-items-center">${symbol} wallet removed.</div>`);
                } else {
                  toastr.error(
                    `<div class="d-flex align-items-center">Something went wrong while removing ${symbol} wallet. Please try again.</div>`
                  );
                }
                window.location.href = window.location.pathname + '?tab=manage';
              })
              .catch(() => {
                toastr.error(
                  `<div class="d-flex align-items-center">Something went wrong while removing ${symbol} wallet. Please try again.</div>`
                );
              });
          });

          removeWalletButtonToastCancel.addEventListener('click', () => {
            toastr.clear();
          });
        }
      }
    );
  });

  const walletAddressWrapper = document.querySelectorAll('.wallet-address-wrapper');
  walletAddressWrapper.forEach(wrapper => {
    wrapper.addEventListener('click', () => {
      const isSendFundsModal = wrapper.querySelector('#sendFundsModalAddressInput');
      if (!isSendFundsModal) {
        const walletAddressPopover = document.querySelector('.wallet-address-popover');
        const walletAddress = wrapper.querySelector('.wallet-address');
        navigator.clipboard.writeText(walletAddress.value.trim());

        walletAddressPopover.style.left = '12px';
        walletAddressPopover.querySelector('.popover-body').textContent = 'Copied';
        walletAddressPopover.querySelector('.popover-arrow').style.transform = 'translate(23px, 0px)';

        walletAddress.select();
      }
    });
  });

  const walletAccountModalAddress = document.querySelector('#walletAccountModalAddress');
  walletAccountModalAddress.addEventListener('click', () => {
    if (wrapper) {
      const walletAddressPopover = walletAccountModalAddress.querySelector('.wallet-address-popover');
      const walletAddress = wrapper.querySelector('.wallet-address');
      navigator.clipboard.writeText(walletAddress.value.trim());

      walletAddressPopover.style.left = '12px';
      walletAddressPopover.querySelector('.popover-body').textContent = 'Copied';
      walletAddressPopover.querySelector('.popover-arrow').style.transform = 'translate(23px, 0px)';

      walletAddress.select();
    }
  });

  const walletAddressToggleBtn = document.querySelectorAll('.wallet-address-toggle-btn');
  const walletDetailModalIcon = document.querySelector('#walletDetailModalIcon');
  const walletDetailModalTitle = document.querySelector('#walletDetailModalTitle');
  const walletDetailModalSymbol = document.querySelectorAll('.walletDetailModalSymbol');
  const walletDetailModalAmountInUsd = document.querySelector('#walletDetailModalAmountInUsd');
  const walletDetailModalAmountInAsset = document.querySelector('#walletDetailModalAmountInAsset');
  const walletDetailModalQRCode = document.querySelector('#walletDetailModalQRCode');
  const walletDetailModalNetwork = document.querySelectorAll('.walletDetailModalNetwork');
  walletAddressToggleBtn.forEach(button => {
    button.addEventListener('click', () => {
      const data = JSON.parse(button.getAttribute('data-account-data'));

      walletDetailModalIcon.innerHTML = data.icon;
      walletDetailModalTitle.innerHTML = data.title;
      walletDetailModalSymbol.forEach(symbol => (symbol.innerHTML = data.symbol));
      walletDetailModalAmountInUsd.innerHTML = Number(data.amount_in_usd).toFixed(2);
      walletDetailModalAmountInAsset.innerHTML = data.amount_in_asset;
      walletDetailModalNetwork.forEach(network => (network.innerHTML = data.network));
      walletDetailModalQRCode.src = 'data:image/png;base64,' + data.qr_code;
      walletAccountModalAddress.value = data.address;
    });
  });

  //////////////////
  /// Send Funds ///
  //////////////////

  const walletItemSendButton = document.querySelectorAll('.wallet-item-send-button');

  const sendFundsModalIcon = document.querySelector('#sendFundsModalIcon');
  const sendFundsModal = document.querySelector('#sendFundsModal');
  const sendFundsModalTitle = sendFundsModal.querySelector('#sendFundsModalTitle');
  const sendFundsModalAmountInAsset = sendFundsModal.querySelector('#sendFundsModalAmountInAsset');
  const sendFundsModalSymbol = document.querySelector('#sendFundsModalSymbol');
  const sendFundsModalSymbolLabel = sendFundsModal.querySelector('#sendFundsModalSymbolLabel');
  const sendFundsModalAddressInput = sendFundsModal.querySelector('#sendFundsModalAddressInput');
  const sendFundsModalNetwork = sendFundsModal.querySelector('#sendFundsModalNetwork');
  const sendFundsAmountInput = sendFundsModal.querySelector('#sendFundsAmountInput');
  const sendFundsWallet = document.querySelector('#sendFundsWallet');

  walletItemSendButton.forEach(button =>
    button.addEventListener('click', () => {
      const symbol = button.getAttribute('data-symbol');
      const title = button.getAttribute('data-title');
      const address = button.getAttribute('data-address');
      const balance = button.getAttribute('data-balance');
      const network = button.getAttribute('data-network');

      const asset = symbol ? assetsData[symbol] : assetsData['USDT'];

      sendFundsModalIcon.innerHTML = asset.iconLg;

      sendFundsModalTitle.innerHTML = `${title} Wallet`;
      sendFundsModalSymbolLabel.innerHTML = `${symbol} ${symbol === 'USDT' || symbol === 'TRX' ? '<span class="text-light">(TRC-20)</span>' : symbol === 'ETH' || symbol === 'ETC' ? '<span class="text-light">(ERC-20)</span>' : ''}`;
      sendFundsModalAddressInput.value = address || '';
      sendFundsModalNetwork.innerHTML = network;
      sendFundsModalAmountInAsset.innerHTML = balance;
      sendFundsModalSymbol.innerHTML = symbol;

      sendFundsAmountInput.value = Number(0).toFixed(2);
      sendFundsAmountInput.style.width = sendFundsAmountInput.value.length + 2 + 'ch';
      sendFundsSubmitButton.setAttribute('disabled', true);
      sendFundsWallet.value = symbol;
    })
  );

  sendFundsAmountInput.addEventListener('input', e => {
    let value = e.target.value;

    // Remove all non-numeric characters except the dot
    value = value.replace(/[^0-9.]/g, '');

    // Ensure only one decimal point
    const parts = value.split('.');
    if (parts.length > 2) {
      value = parts[0] + '.' + parts.slice(1).join('');
    }

    // Limit to 8 digits before the decimal point
    if (parts[0].length > 8) {
      value = parts[0].slice(0, 8);
      if (parts[1]) {
        value += '.' + parts[1]; // Keep the decimal part if it exists
      }
    }

    // Limit to 8 digits after the decimal point
    if (parts[1] && parts[1].length > 8) {
      value = parts[0] + '.' + parts[1].slice(0, 8);
    }

    // Convert empty or invalid input to '0.00'
    if (!value || isNaN(Number(value))) {
      value = '0.00';
      sendFundsSubmitButton.setAttribute('disabled', true);
    } else {
      sendFundsSubmitButton.removeAttribute('disabled');
    }

    // Update input value
    e.target.value = value;

    // Disable send button if amount is 0 or greater than balance
    const balance = Number(sendFundsModalAmountInAsset.innerHTML);
    const submitButton = document.querySelector('#sendFundsSubmitButton');
    submitButton.disabled = Number(value) <= 0 || Number(value) > balance;

    // Adjust input field width based on value length
    sendFundsAmountInput.style.width = `${value.length + 1}ch`;
  });

  const sendFundsModalMaxButton = document.querySelector('#sendFundsModalMaxButton');
  sendFundsModalMaxButton.addEventListener('click', () => {
    const balance = sendFundsModalAmountInAsset.innerText;

    if (Number(balance)) {
      sendFundsAmountInput.value = balance;
      sendFundsSubmitButton.removeAttribute('disabled');
      sendFundsAmountInput.style.width = sendFundsAmountInput.value.length + 1 + 'ch';
    }
  });

  const sendFundsForm = document.querySelector('#sendFundsForm');
  const sendFundsSummaryModalEl = document.querySelector('#sendFundsSummaryModal');
  const sendFundsSummaryModal = new bootstrap.Modal(sendFundsSummaryModalEl);
  const sendFundsSummaryForm = document.querySelector('#sendFundsSummaryForm');
  const sendFundsSummaryTx = document.querySelector('#sendFundsSummaryTx');
  const sendFundsSummaryAsset = document.querySelectorAll('.send-funds-summary-asset');
  const sendFundsSummaryAmountInAsset = document.querySelector('.send-funds-summary-amount-in-asset');
  const sendFundsSummaryAmountInUsd = document.querySelector('.send-funds-summary-amount-in-usd');
  const sendFundsSummaryFee = document.querySelector('.send-funds-summary-fee');
  const sendFundsSummaryTotal = document.querySelector('.send-funds-summary-total');
  const sendFundsSummaryModalSubmit = document.querySelector('#sendFundsSummaryModalSubmit');

  sendFundsForm.addEventListener('submit', async e => {
    e.preventDefault();
    sendFundsSubmitButton.setAttribute('disabled', true);
    sendFundsSubmitButton.querySelector('svg').classList.remove('loading-hidden');

    const res = await fetch('/send-funds-request', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ wallet: sendFundsWallet.value, amount: sendFundsAmountInput.value })
    });
    const response = await res.json();

    sendFundsSummaryTx.value = JSON.stringify(response.transaction);
    sendFundsSummaryAsset.forEach(asset => (asset.innerHTML = response.asset));
    sendFundsSummaryAmountInAsset.innerHTML = window.formatBalance(response.amount_in_asset);
    sendFundsSummaryAmountInUsd.innerHTML =
      Number(response.amount_in_usd).toFixed(2) + sendFundsSummaryAmountInUsd.getAttribute('data-symbol');
    sendFundsSummaryFee.innerHTML = window.formatBalance(response.fee);
    sendFundsSummaryTotal.innerHTML = window.formatBalance(response.total);

    sendFundsSummaryModal.show();
    sendFundsSummaryModal._backdrop._element.style.zIndex = '1090';
  });

  sendFundsSummaryModalEl.addEventListener('hidden.bs.modal', () => {
    sendFundsSubmitButton.removeAttribute('disabled');
    sendFundsSubmitButton.querySelector('svg').classList.add('loading-hidden');
  });

  sendFundsSummaryForm.addEventListener('submit', async e => {
    e.preventDefault();
    sendFundsSummaryModalSubmit.setAttribute('disabled', true);

    const res = await fetch('/complete-send-funds', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
        asset: sendFundsWallet.value,
        transaction: JSON.parse(sendFundsSummaryTx.value),
        amount: Number(sendFundsSummaryTotal.innerHTML)
      })
    });
    const response = await res.json();

    window.location.href = '/transactions?tnx_id=' + response.tnx_id;
  });

  document.querySelectorAll('[data-bs-toggle="tab"]').forEach(navLink => {
    const target = navLink.getAttribute('data-bs-target');

    navLink.addEventListener('click', () => {
      const url = new URL(window.location);
      url.searchParams.set('tab', target.replace('#', ''));
      window.history.pushState({}, '', url);
    });
  });

  document.addEventListener('DOMContentLoaded', () => {
    sendFundsAmountInput.style.width = sendFundsAmountInput.value.length + 1 + 'ch';

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab')) {
      const tab = new bootstrap.Tab(document.querySelector(`[data-bs-target="#${urlParams.get('tab')}"]`));
      tab.show();
    }
  });

  window.addEventListener('popstate', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const tab = new bootstrap.Tab(document.querySelector(`[data-bs-target="#${urlParams.get('tab')}"]`));
    tab.show();
  });
})();
