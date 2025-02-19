/**
 * Swap
 */

('use strict');

(function () {
  const swapInvertWrapper = document.querySelector('.swap-invert-wrapper');
  const swapInvert = document.querySelector('.swap-invert');

  swapInvert.addEventListener('click', () => {
    swapInvertWrapper.classList.toggle('swap-inverted');
  });

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
})();
