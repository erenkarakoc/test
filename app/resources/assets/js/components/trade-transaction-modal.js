/**
 * Trade Transaction Modal
 */

('use strict');

(function () {
  const tradeTransaction = document.querySelectorAll('.trade-transaction-item');

  const tradeItemChartConfig = {
    chart: {
      height: 60,
      type: 'area',
      toolbar: {
        show: false
      },
      sparkline: {
        enabled: true
      },
      animations: {
        enabled: false
      }
    },
    grid: {
      show: false
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

  // Function to initialize chart for a trade item
  function initializeTradeChart(item) {
    if (!item.classList.contains('trade-item-has-detail') || item.hasAttribute('data-chart-initialized')) {
      return;
    }

    const tradeItemChartEl = item.querySelector('.trade-transaction-item-chart');
    if (!tradeItemChartEl) return;

    const priceMovement = JSON.parse(item.getAttribute('data-trade-info')).price_movement;
    const entryIndex = priceMovement.findIndex(move => move.is_entry);
    const exitIndex = priceMovement.findIndex(move => move.is_exit);

    const processedData = priceMovement.map(move => ({
      x: new Date(move.timestamp).getTime(),
      y: move.average
    }));

    const chartConfig = {
      ...tradeItemChartConfig, // Spread the base config
      series: [{ data: processedData }],
      annotations: {
        xaxis: [
          {
            x: processedData[entryIndex].x,
            borderColor: '#28c76f',
            strokeDashArray: 0
          },
          {
            x: processedData[exitIndex].x,
            borderColor: '#ff4c51',
            strokeDashArray: 0
          }
        ]
      }
    };

    const tradeItemChart = new ApexCharts(tradeItemChartEl, chartConfig);
    tradeItemChart.render();

    // Mark this item as initialized
    item.setAttribute('data-chart-initialized', 'true');
  }

  // Initialize charts for existing items
  tradeTransaction.forEach(item => {
    initializeTradeChart(item);
  });

  // Function to update pack PnL values
  function updatePackPnL(packId, tradeAmount, tradePercentage) {
    const packEl = document.querySelector(`[data-pack-id='${packId}']`);
    if (!packEl) return;

    const packPnlAmount = packEl.querySelector('.pack-pnl-amount');
    const packPnlPercentage = packEl.querySelector('.pack-pnl-percentage');

    // Get current values without symbols and convert to numbers
    const currentAmount = parseFloat(packPnlAmount.innerHTML.replace('$', '')) || 0;
    const currentPercentage = parseFloat(packPnlPercentage.innerHTML.replace('%', '')) || 0;

    // Add new values
    const newAmount = currentAmount + tradeAmount;
    const newPercentage = currentPercentage + tradePercentage;

    // Format and update the display
    packPnlAmount.innerHTML = `${window.formatUsdBalance(newAmount)}$`;
    packPnlPercentage.innerHTML = `${newAmount > 0 ? '+' : ''}${window.formatUsdBalance(newPercentage)}%`;

    // Toggle only text-success/text-danger classes
    if (newAmount > 0) {
      packPnlAmount.classList.remove('text-danger');
      packPnlAmount.classList.add('text-success');
      packPnlPercentage.classList.remove('text-danger');
      packPnlPercentage.classList.add('text-success');
    } else if (newAmount < 0) {
      packPnlAmount.classList.remove('text-success');
      packPnlAmount.classList.add('text-danger');
      packPnlPercentage.classList.remove('text-success');
      packPnlPercentage.classList.add('text-danger');
    }
  }

  setInterval(async () => {
    const transactionItems = document.querySelector('.transaction-items');
    const trades = await fetch('get-new-trades').then(res => res.json());

    if (trades.length && !transactionItems.querySelector('.transaction-item')) {
      transactionItems.innerHTML = '';
    }

    trades.forEach(trade => {
      const existingItem = transactionItems.querySelector(`[data-tnx-id='${trade.tnx_id}']`);
      const tradeInfo = JSON.parse(trade.trade_info || '{}');
      const isCompleted = trade.status === 'completed';
      const direction = tradeInfo.direction;
      const isProfit = trade.amount_in_usd > 0;

      if (existingItem) {
        // Update existing trade if status changed
        if (existingItem.getAttribute('data-status') !== trade.status) {
          existingItem.setAttribute('data-status', trade.status);
          existingItem.setAttribute('data-trade-info', trade.trade_info);

          if (isCompleted) {
            existingItem.classList.add('trade-item-has-detail');

            updatePackPnL(trade.locked_pack_id, trade.amount_in_usd, JSON.parse(trade.trade_info).actual_percentage);

            // Update title and status
            const titleSpan = existingItem.querySelector('h6 span:first-child');
            titleSpan.textContent = isCompleted
              ? `${direction === 1 ? 'Long ' : 'Short '} ${trade.asset}`
              : `Trading ${trade.asset}`;

            const statusSpan = existingItem.querySelector('.transaction-status');
            statusSpan.className = `transaction-status ${isCompleted ? (isProfit ? 'text-success' : 'text-danger') : 'text-primary'}`;
            statusSpan.textContent = isCompleted ? (isProfit ? 'Profit' : 'Loss') : 'Trading';

            // Update amounts
            const usdAmount = existingItem.querySelector('.transaction-usd-amount');
            const assetAmount = existingItem.querySelector('.transaction-asset-amount');

            usdAmount.className = `transaction-usd-amount ${trade.status === 'pending' || trade.amount_in_usd == 0 ? 'text-light' : isProfit ? 'text-success' : 'text-danger'}`;
            assetAmount.className = `transaction-asset-amount ${trade.status === 'pending' || trade.amount_in_usd == 0 ? 'text-light' : isProfit ? 'text-success' : 'text-danger'}`;

            usdAmount.textContent =
              trade.status === 'pending'
                ? '0.00$'
                : `${isProfit ? '+' : ''}${window.formatUsdBalance(trade.amount_in_usd)}$`;
            assetAmount.textContent = `${trade.status === 'pending' ? '0.00' : `${isProfit ? '+' : ''}${window.formatBalance(trade.amount_in_asset)}`} ${trade.asset}`;

            // Update timestamp
            const timestamp = existingItem.querySelector('.text-light');
            timestamp.textContent = new Date(isCompleted ? trade.updated_at : trade.created_at).toLocaleDateString(
              'en-GB',
              {
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
              }
            );

            // Update icon
            const iconContainer = existingItem.querySelector('.transaction-item-icon');
            if (isCompleted) {
              iconContainer.innerHTML =
                direction === 1
                  ? `<svg class="text-success" width="28" height="28" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M50.0016 88.5384C71.2876 88.5384 88.5433 71.2827 88.5433 49.9967C88.5433 28.7108 71.2876 11.4551 50.0016 11.4551C28.7157 11.4551 11.46 28.7108 11.46 49.9967C11.46 71.2827 28.7156 88.5384 50.0016 88.5384ZM94.7933 49.9967C94.7933 74.7345 74.7394 94.7884 50.0016 94.7884C25.2639 94.7884 5.20996 74.7345 5.20996 49.9967C5.20996 25.259 25.2639 5.20508 50.0016 5.20508C74.7394 5.20508 94.7933 25.259 94.7933 49.9967Z" fill="currentColor"/>
                      <path d="M60.5459 45.7449C59.7836 45.7449 59.0526 45.4421 58.5135 44.9033C57.9745 44.3644 57.6717 43.6335 57.6717 42.8715C57.6717 42.1094 57.9745 41.3785 58.5135 40.8396C59.0526 40.3008 59.7836 39.998 60.5459 39.998H70.1267C70.889 39.998 71.6201 40.3008 72.1591 40.8397C72.6982 41.3785 73.001 42.1094 73.001 42.8715V52.4495C73.001 53.2116 72.6982 53.9424 72.1591 54.4813C71.6201 55.0202 70.889 55.3229 70.1267 55.3229C69.3644 55.3229 68.6334 55.0202 68.0943 54.4813C67.5553 53.9424 67.2525 53.2116 67.2525 52.4495V49.806L59.538 57.5182C58.2804 58.7745 56.5753 59.4803 54.7974 59.4803C53.0196 59.4803 51.3145 58.7745 50.0569 57.5182L43.9788 51.4419C43.8898 51.3527 43.7841 51.2819 43.6677 51.2336C43.5513 51.1853 43.4265 51.1605 43.3005 51.1605C43.1745 51.1605 43.0497 51.1853 42.9333 51.2336C42.8169 51.2819 42.7112 51.3527 42.6222 51.4419L33.8347 60.2268C33.2898 60.7344 32.5691 61.0107 31.8245 60.9976C31.0799 60.9845 30.3694 60.6829 29.8428 60.1564C29.3162 59.63 29.0146 58.9197 29.0014 58.1753C28.9883 57.4309 29.2647 56.7105 29.7724 56.1658L38.5599 47.3808C39.8175 46.1245 41.5226 45.4187 43.3005 45.4187C45.0784 45.4187 46.7835 46.1245 48.0411 47.3808L54.1191 53.4571C54.2081 53.5463 54.3139 53.6171 54.4303 53.6653C54.5466 53.7136 54.6714 53.7385 54.7975 53.7385C54.9235 53.7385 55.0483 53.7136 55.1647 53.6653C55.281 53.6171 55.3868 53.5463 55.4758 53.4571L63.1864 45.7449H60.5459Z" fill="currentColor"/>
                    </svg>`
                  : `<svg class="text-danger" width="28" height="28" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M50.0016 88.5384C71.2876 88.5384 88.5433 71.2827 88.5433 49.9967C88.5433 28.7108 71.2876 11.4551 50.0016 11.4551C28.7157 11.4551 11.46 28.7108 11.46 49.9967C11.46 71.2827 28.7156 88.5384 50.0016 88.5384ZM94.7933 49.9967C94.7933 74.7345 74.7394 94.7884 50.0016 94.7884C25.2639 94.7884 5.20996 74.7345 5.20996 49.9967C5.20996 25.259 25.2639 5.20508 50.0016 5.20508C74.7394 5.20508 94.7933 25.259 94.7933 49.9967Z" fill="currentColor"/>
                      <path d="M60.545 55.2512C59.7827 55.2512 59.0516 55.554 58.5126 56.0928C57.9735 56.6317 57.6707 57.3626 57.6707 58.1246C57.6707 58.8867 57.9735 59.6176 58.5126 60.1564C59.0516 60.6953 59.7827 60.998 60.545 60.998H70.1258C70.8881 60.998 71.6191 60.6953 72.1582 60.1564C72.6972 59.6176 73 58.8867 73 58.1246V48.5466C73 47.7845 72.6972 47.0537 72.1582 46.5148C71.6191 45.9759 70.8881 45.6732 70.1258 45.6732C69.3635 45.6732 68.6324 45.9759 68.0934 46.5148C67.5543 47.0537 67.2515 47.7845 67.2515 48.5466V51.1901L59.5371 43.4779C58.2795 42.2216 56.5743 41.5158 54.7965 41.5158C53.0186 41.5158 51.3135 42.2216 50.0559 43.4779L43.9778 49.5542C43.8888 49.6434 43.7831 49.7142 43.6667 49.7625C43.5503 49.8107 43.4255 49.8356 43.2995 49.8356C43.1735 49.8356 43.0487 49.8107 42.9323 49.7625C42.8159 49.7142 42.7102 49.6434 42.6212 49.5542L33.8337 40.7692C33.2888 40.2617 32.5682 39.9854 31.8235 39.9985C31.0789 40.0116 30.3685 40.3132 29.8418 40.8397C29.3152 41.3661 29.0136 42.0764 29.0004 42.8208C28.9873 43.5652 29.2637 44.2856 29.7714 44.8303L38.5589 53.6153C39.8165 54.8716 41.5216 55.5774 43.2995 55.5774C45.0774 55.5774 46.7825 54.8716 48.0401 53.6153L54.1182 47.539C54.2071 47.4498 54.3129 47.379 54.4293 47.3307C54.5457 47.2825 54.6705 47.2576 54.7965 47.2576C54.9225 47.2576 55.0473 47.2825 55.1637 47.3307C55.2801 47.379 55.3858 47.4498 55.4748 47.539L63.1854 55.2512H60.545Z" fill="currentColor"/>
                    </svg>`;
            } else {
              iconContainer.innerHTML = `<div class="d-flex align-items-center justify-content-center" style="height: 28px; width: 28px;">
                  <div class="d-flex align-items-center justify-content-center" style="height: 25px; width: 25px; border-radius: 50%; border: 2px solid rgba(var(--bs-primary-rgb), 0.4);">
                    <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24">
                      <circle cx="4" cy="12" r="0" fill="currentColor">
                        <animate fill="freeze" attributeName="r" begin="0;${trade.tnx_id}svgSpinners3DotsMove1.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="0;3"/>
                        <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove7.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="4;12"/>
                        <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove5.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="12;20"/>
                        <animate id="${trade.tnx_id}svgSpinners3DotsMove0" fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove3.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0"/>
                        <animate id="${trade.tnx_id}svgSpinners3DotsMove1" fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove0.end" dur="0.001s" values="20;4"/>
                      </circle>
                      <circle cx="4" cy="12" r="3" fill="currentColor">
                        <animate fill="freeze" attributeName="cx" begin="0;${trade.tnx_id}svgSpinners3DotsMove1.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="4;12"/>
                        <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove7.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="12;20"/>
                        <animate id="${trade.tnx_id}svgSpinners3DotsMove2" fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove5.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0"/>
                        <animate id="${trade.tnx_id}svgSpinners3DotsMove3" fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove2.end" dur="0.001s" values="20;4"/>
                        <animate fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove3.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="0;3"/>
                      </circle>
                      <circle cx="12" cy="12" r="3" fill="currentColor">
                        <animate fill="freeze" attributeName="cx" begin="0;${trade.tnx_id}svgSpinners3DotsMove1.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="12;20"/>
                        <animate id="${trade.tnx_id}svgSpinners3DotsMove4" fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove7.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0"/>
                        <animate id="${trade.tnx_id}svgSpinners3DotsMove5" fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove4.end" dur="0.001s" values="20;4"/>
                        <animate fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove5.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="0;3"/>
                        <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove3.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="4;12"/>
                      </circle>
                      <circle cx="20" cy="12" r="3" fill="currentColor">
                        <animate id="${trade.tnx_id}svgSpinners3DotsMove6" fill="freeze" attributeName="r" begin="0;${trade.tnx_id}svgSpinners3DotsMove1.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0"/>
                        <animate id="${trade.tnx_id}svgSpinners3DotsMove7" fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove6.end" dur="0.001s" values="20;4"/>
                        <animate fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove7.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="0;3"/>
                        <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove5.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="4;12"/>
                        <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove3.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="12;20"/>
                      </circle>
                    </svg>
                  </div>
                </div>`;
            }

            // Add trade details if completed
            if (isCompleted && !existingItem.querySelector('.trade-transaction-item-detail')) {
              const detailsHtml = `
                  <div class="trade-transaction-item-detail">
                    <div class="trade-transaction-item-chart"></div>
                    <div class="d-flex justify-content-between align-items-center column-gap-2 w-100 mt-4">
                      <div class="d-flex flex-column">
                        <small class="text-muted">Entry Price</small>
                        <span class="text-heading">${window.formatBalance(tradeInfo.entry_price)}$</span>
                        <small class="text-muted" style="font-size: 11px;">
                          ${new Date(tradeInfo.entry_time).toLocaleDateString('en-GB', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                          })}
                        </small>
                      </div>
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                          <path d="m11 19l6-7l-6-7" opacity=".5"/>
                          <path d="m7 19l6-7l-6-7" opacity=".5"/>
                        </g>
                      </svg>
                      <div class="d-flex flex-column">
                        <small class="text-muted">Exit Price</small>
                        <span class="text-heading">${window.formatBalance(tradeInfo.exit_price)}$</span>
                        <small class="text-muted" style="font-size: 11px;">
                          ${new Date(tradeInfo.exit_time).toLocaleDateString('en-GB', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                          })}
                        </small>
                      </div>
                    </div>
                    <div class="d-flex justify-content-start w-100 text-start mt-3">
                      <small class="text-muted">
                        Realized P&L: ${isProfit ? '+' : '-'}${tradeInfo.profit_rate}%
                      </small>
                    </div>
                  </div>`;
              existingItem.insertAdjacentHTML('beforeend', detailsHtml);
            }

            // Initialize chart if trade is completed
            if (isCompleted) {
              // Wait for the detail section to be added to DOM
              setTimeout(() => initializeTradeChart(existingItem), 0);
            }
          }
        }
      } else {
        const formattedDate = new Date(isCompleted ? trade.updated_at : trade.created_at).toLocaleDateString('en-GB', {
          day: 'numeric',
          month: 'short',
          year: 'numeric',
          hour: '2-digit',
          minute: '2-digit'
        });

        const tradeItemHtml = `
            <div class="transaction-item trade-transaction-item${isCompleted ? ' trade-item-has-detail' : ''}"
                 data-tnx-id="${trade.tnx_id}" 
                 data-trade-info='${trade.trade_info}' data-pack-id='${trade.locked_pack_id}'>
              <div class="d-flex align-items-start">
                <div class="transaction-item-icon">
                  ${
                    isCompleted
                      ? direction === 1
                        ? `<svg class="text-success" width="28" height="28" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M50.0016 88.5384C71.2876 88.5384 88.5433 71.2827 88.5433 49.9967C88.5433 28.7108 71.2876 11.4551 50.0016 11.4551C28.7157 11.4551 11.46 28.7108 11.46 49.9967C11.46 71.2827 28.7156 88.5384 50.0016 88.5384ZM94.7933 49.9967C94.7933 74.7345 74.7394 94.7884 50.0016 94.7884C25.2639 94.7884 5.20996 74.7345 5.20996 49.9967C5.20996 25.259 25.2639 5.20508 50.0016 5.20508C74.7394 5.20508 94.7933 25.259 94.7933 49.9967Z" fill="currentColor"/>
                              <path d="M60.5459 45.7449C59.7836 45.7449 59.0526 45.4421 58.5135 44.9033C57.9745 44.3644 57.6717 43.6335 57.6717 42.8715C57.6717 42.1094 57.9745 41.3785 58.5135 40.8396C59.0526 40.3008 59.7836 39.998 60.5459 39.998H70.1267C70.889 39.998 71.6201 40.3008 72.1591 40.8397C72.6982 41.3785 73.001 42.1094 73.001 42.8715V52.4495C73.001 53.2116 72.6982 53.9424 72.1591 54.4813C71.6201 55.0202 70.889 55.3229 70.1267 55.3229C69.3644 55.3229 68.6334 55.0202 68.0943 54.4813C67.5553 53.9424 67.2525 53.2116 67.2525 52.4495V49.806L59.538 57.5182C58.2804 58.7745 56.5753 59.4803 54.7974 59.4803C53.0196 59.4803 51.3145 58.7745 50.0569 57.5182L43.9788 51.4419C43.8898 51.3527 43.7841 51.2819 43.6677 51.2336C43.5513 51.1853 43.4265 51.1605 43.3005 51.1605C43.1745 51.1605 43.0497 51.1853 42.9333 51.2336C42.8169 51.2819 42.7112 51.3527 42.6222 51.4419L33.8347 60.2268C33.2898 60.7344 32.5691 61.0107 31.8245 60.9976C31.0799 60.9845 30.3694 60.6829 29.8428 60.1564C29.3162 59.63 29.0146 58.9197 29.0014 58.1753C28.9883 57.4309 29.2647 56.7105 29.7724 56.1658L38.5599 47.3808C39.8175 46.1245 41.5226 45.4187 43.3005 45.4187C45.0784 45.4187 46.7835 46.1245 48.0411 47.3808L54.1191 53.4571C54.2081 53.5463 54.3139 53.6171 54.4303 53.6653C54.5466 53.7136 54.6714 53.7385 54.7975 53.7385C54.9235 53.7385 55.0483 53.7136 55.1647 53.6653C55.281 53.6171 55.3868 53.5463 55.4758 53.4571L63.1864 45.7449H60.5459Z" fill="currentColor"/>
                            </svg>`
                        : `<svg class="text-danger" width="28" height="28" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M50.0016 88.5384C71.2876 88.5384 88.5433 71.2827 88.5433 49.9967C88.5433 28.7108 71.2876 11.4551 50.0016 11.4551C28.7157 11.4551 11.46 28.7108 11.46 49.9967C11.46 71.2827 28.7156 88.5384 50.0016 88.5384ZM94.7933 49.9967C94.7933 74.7345 74.7394 94.7884 50.0016 94.7884C25.2639 94.7884 5.20996 74.7345 5.20996 49.9967C5.20996 25.259 25.2639 5.20508 50.0016 5.20508C74.7394 5.20508 94.7933 25.259 94.7933 49.9967Z" fill="currentColor"/>
                              <path d="M60.545 55.2512C59.7827 55.2512 59.0516 55.554 58.5126 56.0928C57.9735 56.6317 57.6707 57.3626 57.6707 58.1246C57.6707 58.8867 57.9735 59.6176 58.5126 60.1564C59.0516 60.6953 59.7827 60.998 60.545 60.998H70.1258C70.8881 60.998 71.6191 60.6953 72.1582 60.1564C72.6972 59.6176 73 58.8867 73 58.1246V48.5466C73 47.7845 72.6972 47.0537 72.1582 46.5148C71.6191 45.9759 70.8881 45.6732 70.1258 45.6732C69.3635 45.6732 68.6324 45.9759 68.0934 46.5148C67.5543 47.0537 67.2515 47.7845 67.2515 48.5466V51.1901L59.5371 43.4779C58.2795 42.2216 56.5743 41.5158 54.7965 41.5158C53.0186 41.5158 51.3135 42.2216 50.0559 43.4779L43.9778 49.5542C43.8888 49.6434 43.7831 49.7142 43.6667 49.7625C43.5503 49.8107 43.4255 49.8356 43.2995 49.8356C43.1735 49.8356 43.0487 49.8107 42.9323 49.7625C42.8159 49.7142 42.7102 49.6434 42.6212 49.5542L33.8337 40.7692C33.2888 40.2617 32.5682 39.9854 31.8235 39.9985C31.0789 40.0116 30.3685 40.3132 29.8418 40.8397C29.3152 41.3661 29.0136 42.0764 29.0004 42.8208C28.9873 43.5652 29.2637 44.2856 29.7714 44.8303L38.5589 53.6153C39.8165 54.8716 41.5216 55.5774 43.2995 55.5774C45.0774 55.5774 46.7825 54.8716 48.0401 53.6153L54.1182 47.539C54.2071 47.4498 54.3129 47.379 54.4293 47.3307C54.5457 47.2825 54.6705 47.2576 54.7965 47.2576C54.9225 47.2576 55.0473 47.2825 55.1637 47.3307C55.2801 47.379 55.3858 47.4498 55.4748 47.539L63.1854 55.2512H60.545Z" fill="currentColor"/>
                            </svg>`
                      : `<div class="d-flex align-items-center justify-content-center" style="height: 28px; width: 28px;">
                          <div class="d-flex align-items-center justify-content-center" style="height: 25px; width: 25px; border-radius: 50%; border: 2px solid rgba(var(--bs-primary-rgb), 0.4);">
                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24">
                              <circle cx="4" cy="12" r="0" fill="currentColor">
                                <animate fill="freeze" attributeName="r" begin="0;${trade.tnx_id}svgSpinners3DotsMove1.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="0;3"/>
                                <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove7.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="4;12"/>
                                <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove5.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="12;20"/>
                                <animate id="${trade.tnx_id}svgSpinners3DotsMove0" fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove3.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0"/>
                                <animate id="${trade.tnx_id}svgSpinners3DotsMove1" fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove0.end" dur="0.001s" values="20;4"/>
                              </circle>
                              <circle cx="4" cy="12" r="3" fill="currentColor">
                                <animate fill="freeze" attributeName="cx" begin="0;${trade.tnx_id}svgSpinners3DotsMove1.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="4;12"/>
                                <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove7.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="12;20"/>
                                <animate id="${trade.tnx_id}svgSpinners3DotsMove2" fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove5.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0"/>
                                <animate id="${trade.tnx_id}svgSpinners3DotsMove3" fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove2.end" dur="0.001s" values="20;4"/>
                                <animate fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove3.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="0;3"/>
                              </circle>
                              <circle cx="12" cy="12" r="3" fill="currentColor">
                                <animate fill="freeze" attributeName="cx" begin="0;${trade.tnx_id}svgSpinners3DotsMove1.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="12;20"/>
                                <animate id="${trade.tnx_id}svgSpinners3DotsMove4" fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove7.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0"/>
                                <animate id="${trade.tnx_id}svgSpinners3DotsMove5" fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove4.end" dur="0.001s" values="20;4"/>
                                <animate fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove5.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="0;3"/>
                                <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove3.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="4;12"/>
                              </circle>
                              <circle cx="20" cy="12" r="3" fill="currentColor">
                                <animate id="${trade.tnx_id}svgSpinners3DotsMove6" fill="freeze" attributeName="r" begin="0;${trade.tnx_id}svgSpinners3DotsMove1.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0"/>
                                <animate id="${trade.tnx_id}svgSpinners3DotsMove7" fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove6.end" dur="0.001s" values="20;4"/>
                                <animate fill="freeze" attributeName="r" begin="${trade.tnx_id}svgSpinners3DotsMove7.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="0;3"/>
                                <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove5.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="4;12"/>
                                <animate fill="freeze" attributeName="cx" begin="${trade.tnx_id}svgSpinners3DotsMove3.end" calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="12;20"/>
                              </circle>
                            </svg>
                          </div>
                        </div>`
                  }
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-0">
                    ${
                      isCompleted
                        ? `<span>${direction === 1 ? 'Long ' : 'Short '} ${trade.asset}</span>`
                        : `<span>Trading ${trade.asset}</span>`
                    }
                    <span class="text-muted ms-1">→</span>
                    <span class="text-muted ms-1">Pack ${trade.locked_pack_id}</span>
                  </h6>
                  <div class="d-flex align-items-center">
                    <small class="text-light">${formattedDate}</small>
                    <small class="transaction-status ${
                      trade.status === 'pending' ? 'text-primary' : isProfit ? 'text-success' : 'text-danger'
                    }">
                      ${trade.status === 'pending' ? 'Trading' : isProfit ? 'Profit' : 'Loss'}
                    </small>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="d-flex flex-column align-items-end text-right">
                  <span class="transaction-usd-amount ${
                    trade.status === 'pending' ? 'text-light' : isProfit ? 'text-success' : 'text-danger'
                  }">
                    ${
                      trade.status === 'pending'
                        ? '0.00$'
                        : `${isProfit ? '+' : ''}${window.formatUsdBalance(trade.amount_in_usd)}$`
                    }
                  </span>
                  <span style="font-size: 12px" class="transaction-asset-amount ${
                    trade.status === 'pending' ? 'text-light' : isProfit ? 'text-success' : 'text-danger'
                  }">
                    ${
                      trade.status === 'pending'
                        ? '0.00'
                        : `${isProfit ? '+' : ''}${window.formatBalance(trade.amount_in_asset)}`
                    }
                    ${trade.asset}
                  </span>
                </div>
                <span class="transaction-item-view">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m9 5l6 7l-6 7"/>
                  </svg>
                </span>
              </div>
              ${
                isCompleted
                  ? `
                <div class="trade-transaction-item-detail">
                  <div class="trade-transaction-item-chart"></div>
                  <div class="d-flex justify-content-between align-items-center column-gap-2 w-100 mt-4">
                    <div class="d-flex flex-column">
                      <small class="text-muted">Entry Price</small>
                      <span class="text-heading">${tradeInfo.entry_price.toFixed(4)}$</span>
                      <small class="text-muted" style="font-size: 11px;">
                        ${new Date(tradeInfo.entry_time).toLocaleDateString('en-GB', {
                          day: 'numeric',
                          month: 'short',
                          year: 'numeric',
                          hour: '2-digit',
                          minute: '2-digit'
                        })}
                      </small>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                        <path d="m11 19l6-7l-6-7" opacity=".5"/>
                        <path d="m7 19l6-7l-6-7" opacity=".5"/>
                      </g>
                    </svg>
                    <div class="d-flex flex-column">
                      <small class="text-muted">Exit Price</small>
                      <span class="text-heading">${tradeInfo.exit_price.toFixed(6)}$</span>
                      <small class="text-muted" style="font-size: 11px;">
                        ${new Date(tradeInfo.exit_time).toLocaleDateString('en-GB', {
                          day: 'numeric',
                          month: 'short',
                          year: 'numeric',
                          hour: '2-digit',
                          minute: '2-digit'
                        })}
                      </small>
                    </div>
                  </div>
                  <div class="d-flex justify-content-start w-100 text-start mt-3">
                    <small class="text-muted">
                      Realized P&L: ${isProfit ? '+' : '-'}${tradeInfo.profit_rate}%
                    </small>
                  </div>
                </div>
              `
                  : ''
              }
            </div>`;

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = tradeItemHtml;
        const newTradeItem = tempDiv.firstElementChild;
        transactionItems.insertBefore(newTradeItem, transactionItems.firstChild);

        // Initialize chart for new completed trades
        if (isCompleted) {
          // Wait for the new item to be added to DOM
          setTimeout(() => initializeTradeChart(newTradeItem), 0);
        }
      }
    });
  }, 5000);

  document.addEventListener('click', e => {
    const item = e.target.closest('.trade-transaction-item');

    if (!item || !item.classList.contains('trade-item-has-detail')) return;

    const itemDetail = item.querySelector('.trade-transaction-item-detail');
    if (!itemDetail) return;

    if (!item.classList.contains('active')) {
      const originalHeight = item.offsetHeight;
      item.style.height = originalHeight + 'px';

      requestAnimationFrame(() => {
        const expandedHeight = itemDetail.scrollHeight + 80;
        item.style.height = expandedHeight + 'px';
        item.classList.add('active');
      });
    } else {
      const originalHeight = item.offsetHeight - itemDetail.scrollHeight - 80;
      item.style.height = originalHeight + 'px';
      item.classList.remove('active');
    }
  });

  console.log(window);
})();
