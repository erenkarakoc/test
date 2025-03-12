/**
 * Dashboard
 */

('use strict');

(function () {
  ///////////////
  /// Swipers ///
  ///////////////

  // Strategies Card
  // --------------------------------------------------------------------
  let cardColor, headingColor, labelColor, shadeColor, grayColor;
  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    labelColor = config.colors_dark.textMuted;
    headingColor = config.colors_dark.headingColor;
    shadeColor = 'dark';
    grayColor = '#5E6692';
  } else {
    cardColor = config.colors.cardColor;
    labelColor = config.colors.textMuted;
    headingColor = config.colors.headingColor;
    shadeColor = '';
    grayColor = '#817D8D';
  }

  const swiperWithPagination = document.querySelector('#gdzStrategiesCard');
  if (swiperWithPagination) {
    new Swiper(swiperWithPagination, {
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
      },
      pagination: {
        clickable: true,
        el: '.swiper-pagination'
      }
    });
  }

  //////////////
  /// Charts ///
  //////////////

  // Total Profit Chart
  // --------------------------------------------------------------------
  const totalProfitsChartEl = document.querySelector('#totalProfitsChart'),
    totalProfitsChartConfig = {
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
        show: false
      },
      colors: ['#ffffff70'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: '#ffffff',
          shadeIntensity: 1,
          opacityFrom: 0.3,
          opacityTo: 0.1
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 1,
        curve: 'smooth'
      },
      series: [
        {
          name: 'Profit',
          data: [
            { x: '12 Dec.', y: 14.05 },
            { x: '13 Dec.', y: 12.28 },
            { x: '14 Dec.', y: 14.41 },
            { x: '15 Dec.', y: 17.54 },
            { x: '16 Dec.', y: 13.12 },
            { x: '17 Dec.', y: 16.97 },
            { x: '18 Dec.', y: 14.45 }
          ]
        }
      ],
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
        enabled: true,
        y: {
          formatter: v => `${v}$`
        }
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
  if (totalProfitsChartEl) {
    const totalProfitsChart = new ApexCharts(totalProfitsChartEl, totalProfitsChartConfig);
    totalProfitsChart.render();
  }

  // GDZ Token Chart
  // --------------------------------------------------------------------

  // Candlestick Chart
  // --------------------------------------------------------------------
  const gdzTokenChartEl = document.querySelector('#gdzTokenChart'),
    gdzTokenChartConfig = {
      moda: 'dark',
      chart: {
        height: 150,
        type: 'area',
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      scrollable: {
        enabled: true,
        xaxis: {
          scrollPosition: 'bottom'
        }
      },
      markers: {
        colors: 'transparent',
        strokeColors: 'transparent'
      },
      grid: {
        show: false
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: config.colors.primary,
          shadeIntensity: 0.4,
          opacityFrom: 0.4,
          opacityTo: 0.2
        }
      },
      dataLabels: {
        enabled: false
      },
      grid: {
        show: true,
        xaxis: {
          lines: {
            show: true
          }
        },
        yaxis: {
          lines: {
            show: true
          }
        },
        borderColor: '#ffffff05'
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      series: [
        {
          name: 'Price',
          data: [
            { x: '01/29/2025', y: 0 },
            { x: '01/30/2025', y: 0 },
            { x: '01/31/2025', y: 0 },
            { x: '02/01/2025', y: 0 },
            { x: '02/02/2025', y: 0 },
            { x: '02/03/2025', y: 0 },
            { x: '02/04/2025', y: 0 },
            { x: '02/05/2025', y: 0 },
            { x: '02/06/2025', y: 0 },
            { x: '02/07/2025', y: 0 },
            { x: '02/08/2025', y: 0 },
            { x: '02/09/2025', y: 0 },
            { x: '02/10/2025', y: 0 },
            { x: '02/11/2025', y: 0 }
          ]
        }
      ],
      xaxis: {
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: true,
          style: {
            colors: labelColor,
            fontSize: '10px'
          }
        }
      },
      yaxis: {
        labels: {
          show: false
        }
      },
      tooltip: {
        enabled: true,
        y: {
          formatter: v => `${v}$`
        }
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
  if (gdzTokenChartEl) {
    const gdzTokenChart = new ApexCharts(gdzTokenChartEl, gdzTokenChartConfig);
    gdzTokenChart.render();
  }

  const inviteFriendsButton = document.querySelector('#inviteFriendsButton');
  const gdzReferFriends = document.querySelector('.gdz-refer-friends');
  let inviteFriendsButtonLocked = false;
  inviteFriendsButton.addEventListener('click', () => {
    inviteFriendsButtonLocked = true;
    gdzReferFriends.classList.add('animate');

    gdzReferFriends.scrollIntoView({ behaviour: 'smooth', block: 'center', inline: 'nearest' });
    setTimeout(() => {
      gdzReferFriends.classList.remove('animate');
      inviteFriendsButtonLocked = false;
    }, 3000);
  });
})();
