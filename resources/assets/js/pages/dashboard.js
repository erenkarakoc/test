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
            { x: '12 Dec.', y: 14.0 },
            { x: '13 Dec.', y: 12.0 },
            { x: '14 Dec.', y: 14.0 },
            { x: '15 Dec.', y: 17.0 },
            { x: '16 Dec.', y: 13.0 },
            { x: '17 Dec.', y: 16.0 },
            { x: '18 Dec.', y: 14.0 }
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
            { x: '12/11/2024', y: 22.66 },
            { x: '12/13/2024', y: 22.39 },
            { x: '12/12/2024', y: 22.64 },
            { x: '12/14/2024', y: 22.49 },
            { x: '12/15/2024', y: 22.79 },
            { x: '12/16/2024', y: 22.58 },
            { x: '12/17/2024', y: 22.66 },
            { x: '12/18/2024', y: 22.37 },
            { x: '12/19/2024', y: 22.55 },
            { x: '12/20/2024', y: 22.32 },
            { x: '12/21/2024', y: 22.35 },
            { x: '12/22/2024', y: 22.27 },
            { x: '12/23/2024', y: 22.42 },
            { x: '12/24/2024', y: 22.25 }
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
  const dashboardReferFriends = document.querySelector('.gdz-dashboard-refer-friends');
  let inviteFriendsButtonLocked = false;
  inviteFriendsButton.addEventListener('click', () => {
    inviteFriendsButtonLocked = true;
    dashboardReferFriends.classList.add('animate');

    dashboardReferFriends.scrollIntoView({ behaviour: 'smooth', block: 'center', inline: 'nearest' });
    setTimeout(() => {
      dashboardReferFriends.classList.remove('animate');
      inviteFriendsButtonLocked = false;
    }, 3000);
  });
})();
