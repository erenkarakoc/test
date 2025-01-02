/**
 * Main
 */

'use strict';

window.isRtl = window.Helpers.isRtl();
window.isDarkStyle = window.Helpers.isDarkStyle();
let menu,
  animate,
  isHorizontalLayout = false;

if (document.getElementById('layout-menu')) {
  isHorizontalLayout = document.getElementById('layout-menu').classList.contains('menu-horizontal');
}

document.addEventListener('DOMContentLoaded', () => {
  setTimeout(() => {
    document.body.classList.remove('gdz-body-loading-content');
    document.querySelector('#gdzLoadingContent').style.display = 'none';
  }, 500);
});

(function () {
  setTimeout(function () {
    window.Helpers.initCustomOptionCheck();
  }, 1000);

  if (typeof Waves !== 'undefined') {
    Waves.init();
    Waves.attach(
      ".btn[class*='btn-']:not(.position-relative):not([class*='btn-outline-']):not([class*='btn-label-'])",
      ['waves-light']
    );
    Waves.attach("[class*='btn-outline-']:not(.position-relative)");
    Waves.attach("[class*='btn-label-']:not(.position-relative)");
    Waves.attach('.pagination .page-item .page-link');
    Waves.attach('.dropdown-menu .dropdown-item');
    Waves.attach('.light-style .list-group .list-group-item-action');
    Waves.attach('.dark-style .list-group .list-group-item-action', ['waves-light']);
    Waves.attach('.nav-tabs:not(.nav-tabs-widget) .nav-item .nav-link');
    Waves.attach('.nav-pills .nav-item .nav-link', ['waves-light']);
  }

  // Initialize menu
  //-----------------

  let layoutMenuEl = document.querySelectorAll('#layout-menu');
  layoutMenuEl.forEach(function (element) {
    menu = new Menu(element, {
      orientation: isHorizontalLayout ? 'horizontal' : 'vertical',
      closeChildren: isHorizontalLayout ? true : false,
      // ? This option only works with Horizontal menu
      showDropdownOnHover: localStorage.getItem('templateCustomizer-' + templateName + '--ShowDropdownOnHover') // If value(showDropdownOnHover) is set in local storage
        ? localStorage.getItem('templateCustomizer-' + templateName + '--ShowDropdownOnHover') === 'true' // Use the local storage value
        : window.templateCustomizer !== undefined // If value is set in config.js
          ? window.templateCustomizer.settings.defaultShowDropdownOnHover // Use the config.js value
          : true // Use this if you are not using the config.js and want to set value directly from here
    });
    // Change parameter to true if you want scroll animation
    window.Helpers.scrollToActive((animate = false));
    window.Helpers.mainMenu = menu;
  });

  // Initialize menu togglers and bind click on each
  let menuToggler = document.querySelectorAll('.layout-menu-toggle');
  menuToggler.forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();
      window.Helpers.toggleCollapsed();
      // Enable menu state with local storage support if enableMenuLocalStorage = true from config.js
      if (config.enableMenuLocalStorage && !window.Helpers.isSmallScreen()) {
        try {
          localStorage.setItem(
            'templateCustomizer-' + templateName + '--LayoutCollapsed',
            String(window.Helpers.isCollapsed())
          );
          // Update customizer checkbox state on click of menu toggler
          let layoutCollapsedCustomizerOptions = document.querySelector('.template-customizer-layouts-options');
          if (layoutCollapsedCustomizerOptions) {
            let layoutCollapsedVal = window.Helpers.isCollapsed() ? 'collapsed' : 'expanded';
            layoutCollapsedCustomizerOptions.querySelector(`input[value="${layoutCollapsedVal}"]`).click();
          }
        } catch (e) {}
      }
    });
  });

  // Menu swipe gesture

  // Detect swipe gesture on the target element and call swipe In
  window.Helpers.swipeIn('.drag-target', function (e) {
    window.Helpers.setCollapsed(false);
  });

  // Detect swipe gesture on the target element and call swipe Out
  window.Helpers.swipeOut('#layout-menu', function (e) {
    if (window.Helpers.isSmallScreen()) window.Helpers.setCollapsed(true);
  });

  // Display in main menu when menu scrolls
  let menuInnerContainer = document.getElementsByClassName('menu-inner'),
    menuInnerShadow = document.getElementsByClassName('menu-inner-shadow')[0];
  if (menuInnerContainer.length > 0 && menuInnerShadow) {
    menuInnerContainer[0].addEventListener('ps-scroll-y', function () {
      if (this.querySelector('.ps__thumb-y').offsetTop) {
        menuInnerShadow.style.display = 'block';
      } else {
        menuInnerShadow.style.display = 'none';
      }
    });
  }

  // Update light/dark image based on current style
  function switchImage(style) {
    if (style === 'system') {
      if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        style = 'dark';
      } else {
        style = 'light';
      }
    }
    const switchImagesList = [].slice.call(document.querySelectorAll('[data-app-' + style + '-img]'));
    switchImagesList.map(function (imageEl) {
      const setImage = imageEl.getAttribute('data-app-' + style + '-img');
      imageEl.src = assetsPath + 'img/' + setImage; // Using window.assetsPath to get the exact relative path
    });
  }

  //Style Switcher (Light/Dark/System Mode)
  let styleSwitcher = document.querySelector('.dropdown-style-switcher');

  // Active class on style switcher dropdown items
  const activeStyle = document.documentElement.getAttribute('data-style');

  // Get style from local storage or use 'system' as default
  let storedStyle =
    localStorage.getItem('templateCustomizer-' + templateName + '--Style') || //if no template style then use Customizer style
    (window.templateCustomizer?.settings?.defaultStyle ?? 'light'); //!if there is no Customizer then use default style as light

  // Set style on click of style switcher item if template customizer is enabled
  if (window.templateCustomizer && styleSwitcher) {
    let styleSwitcherItems = [].slice.call(styleSwitcher.children[1].querySelectorAll('.dropdown-item'));
    styleSwitcherItems.forEach(function (item) {
      item.classList.remove('active');
      item.addEventListener('click', function () {
        let currentStyle = this.getAttribute('data-theme');
        if (currentStyle === 'light') {
          window.templateCustomizer.setStyle('light');
        } else if (currentStyle === 'dark') {
          window.templateCustomizer.setStyle('dark');
        } else {
          window.templateCustomizer.setStyle('system');
        }
      });

      if (item.getAttribute('data-theme') === activeStyle) {
        // Add 'active' class to the item if it matches the activeStyle
        item.classList.add('active');
      }
    });

    // Update style switcher icon based on the stored style

    const styleSwitcherIcon = styleSwitcher.querySelector('i');

    if (storedStyle === 'light') {
      styleSwitcherIcon.classList.add('ti-sun');
      new bootstrap.Tooltip(styleSwitcherIcon, {
        title: 'Light Mode',
        fallbackPlacements: ['bottom']
      });
    } else if (storedStyle === 'dark') {
      styleSwitcherIcon.classList.add('ti-moon-stars');
      new bootstrap.Tooltip(styleSwitcherIcon, {
        title: 'Dark Mode',
        fallbackPlacements: ['bottom']
      });
    } else {
      styleSwitcherIcon.classList.add('ti-device-desktop-analytics');
      new bootstrap.Tooltip(styleSwitcherIcon, {
        title: 'System Mode',
        fallbackPlacements: ['bottom']
      });
    }
  }

  // Run switchImage function based on the stored style
  switchImage(storedStyle);

  let languageDropdown = document.getElementsByClassName('dropdown-language');

  if (languageDropdown.length) {
    let dropdownItems = languageDropdown[0].querySelectorAll('.dropdown-item');
    const dropdownActiveItem = languageDropdown[0].querySelector('.dropdown-item.active');

    directionChange(dropdownActiveItem.dataset.textDirection);

    for (let i = 0; i < dropdownItems.length; i++) {
      dropdownItems[i].addEventListener('click', function () {
        let textDirection = this.getAttribute('data-text-direction');
        window.templateCustomizer.setLang(this.getAttribute('data-language'));
        directionChange(textDirection);
      });
    }
    function directionChange(textDirection) {
      if (textDirection === 'rtl') {
        if (localStorage.getItem('templateCustomizer-' + templateName + '--Rtl') !== 'true')
          window.templateCustomizer ? window.templateCustomizer.setRtl(true) : '';
      } else {
        if (localStorage.getItem('templateCustomizer-' + templateName + '--Rtl') === 'true')
          window.templateCustomizer ? window.templateCustomizer.setRtl(false) : '';
      }
    }
  }

  // add on click javascript for template customizer reset button id template-customizer-reset-btn

  setTimeout(function () {
    let templateCustomizerResetBtn = document.querySelector('.template-customizer-reset-btn');
    if (templateCustomizerResetBtn) {
      templateCustomizerResetBtn.onclick = function () {
        window.location.href = baseUrl + 'lang/en';
      };
    }
  }, 1500);

  // Notification
  // ------------
  const notificationMarkAsReadAll = document.querySelector('.dropdown-notifications-all');
  const notificationMarkAsReadList = document.querySelectorAll('.dropdown-notifications-read');

  // Notification: Mark as all as read
  if (notificationMarkAsReadAll) {
    notificationMarkAsReadAll.addEventListener('click', event => {
      notificationMarkAsReadList.forEach(item => {
        item.closest('.dropdown-notifications-item').classList.add('marked-as-read');
      });
    });
  }
  // Notification: Mark as read/unread onclick of dot
  if (notificationMarkAsReadList) {
    notificationMarkAsReadList.forEach(item => {
      item.addEventListener('click', event => {
        item.closest('.dropdown-notifications-item').classList.toggle('marked-as-read');
      });
    });
  }

  // Notification: Mark as read/unread onclick of dot
  const notificationArchiveMessageList = document.querySelectorAll('.dropdown-notifications-archive');
  notificationArchiveMessageList.forEach(item => {
    item.addEventListener('click', event => {
      item.closest('.dropdown-notifications-item').remove();
    });
  });

  // Init helpers & misc
  // --------------------

  // Init BS Tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Accordion active class
  const accordionActiveFunction = function (e) {
    if (e.type == 'show.bs.collapse' || e.type == 'show.bs.collapse') {
      e.target.closest('.accordion-item').classList.add('active');
    } else {
      e.target.closest('.accordion-item').classList.remove('active');
    }
  };

  const accordionTriggerList = [].slice.call(document.querySelectorAll('.accordion'));
  const accordionList = accordionTriggerList.map(function (accordionTriggerEl) {
    accordionTriggerEl.addEventListener('show.bs.collapse', accordionActiveFunction);
    accordionTriggerEl.addEventListener('hide.bs.collapse', accordionActiveFunction);
  });

  // If layout is RTL add .dropdown-menu-end class to .dropdown-menu
  // if (isRtl) {
  //   Helpers._addClass('dropdown-menu-end', document.querySelectorAll('#layout-navbar .dropdown-menu'));
  // }

  // Auto update layout based on screen size
  window.Helpers.setAutoUpdate(true);

  // Toggle Password Visibility
  window.Helpers.initPasswordToggle();

  // Speech To Text
  window.Helpers.initSpeechToText();

  // Init PerfectScrollbar in Navbar Dropdown (i.e notification)
  window.Helpers.initNavbarDropdownScrollbar();

  let horizontalMenuTemplate = document.querySelector("[data-template^='horizontal-menu']");
  if (horizontalMenuTemplate) {
    // if screen size is small then set navbar fixed
    if (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) {
      window.Helpers.setNavbarFixed('fixed');
    } else {
      window.Helpers.setNavbarFixed('');
    }
  }

  // On window resize listener
  // -------------------------
  window.addEventListener(
    'resize',
    function (event) {
      // Hide open search input and set value blank
      if (window.innerWidth >= window.Helpers.LAYOUT_BREAKPOINT) {
        if (document.querySelector('.search-input-wrapper')) {
          document.querySelector('.search-input-wrapper').classList.add('d-none');
          document.querySelector('.search-input').value = '';
        }
      }
      // Horizontal Layout : Update menu based on window size
      if (horizontalMenuTemplate) {
        // if screen size is small then set navbar fixed
        if (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) {
          window.Helpers.setNavbarFixed('fixed');
        } else {
          window.Helpers.setNavbarFixed('');
        }
        setTimeout(function () {
          if (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) {
            if (document.getElementById('layout-menu')) {
              if (document.getElementById('layout-menu').classList.contains('menu-horizontal')) {
                menu.switchMenu('vertical');
              }
            }
          } else {
            if (document.getElementById('layout-menu')) {
              if (document.getElementById('layout-menu').classList.contains('menu-vertical')) {
                menu.switchMenu('horizontal');
              }
            }
          }
        }, 100);
      }
    },
    true
  );

  // Manage menu expanded/collapsed with templateCustomizer & local storage
  //------------------------------------------------------------------

  // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
  if (isHorizontalLayout || window.Helpers.isSmallScreen()) {
    return;
  }

  // If current layout is vertical and current window screen is > small

  // Auto update menu collapsed/expanded based on the themeConfig
  if (typeof TemplateCustomizer !== 'undefined') {
    if (window.templateCustomizer.settings.defaultMenuCollapsed) {
      window.Helpers.setCollapsed(true, false);
    } else {
      window.Helpers.setCollapsed(false, false);
    }
  }

  // Manage menu expanded/collapsed state with local storage support If enableMenuLocalStorage = true in config.js
  if (typeof config !== 'undefined') {
    if (config.enableMenuLocalStorage) {
      try {
        if (localStorage.getItem('templateCustomizer-' + templateName + '--LayoutCollapsed') !== null)
          window.Helpers.setCollapsed(
            localStorage.getItem('templateCustomizer-' + templateName + '--LayoutCollapsed') === 'true',
            false
          );
      } catch (e) {}
    }
  }

  const symbols = [
    { title: 'TRX', data: [] },
    { title: 'BTC', data: [] },
    { title: 'ETH', data: [] },
    { title: 'ETC', data: [] },
    { title: 'BNB', data: [] },
    { title: 'LTC', data: [] }
  ];

  async function getAssetChartData(symbol) {
    const endTime = Date.now(); // Current time in milliseconds
    const startTime = endTime - 20 * 24 * 60 * 60 * 1000; // 7 days ago

    const url = `https://api.binance.com/api/v3/klines?symbol=${symbol.toUpperCase()}USDT&interval=1d&startTime=${startTime}&endTime=${endTime}&limit=168`;

    try {
      const response = await fetch(url);

      if (response.ok) {
        const data = await response.json();

        return data.map(item => ({
          time: item[0],
          close: parseFloat(item[4]).toFixed(2)
        }));
      } else {
        console.error('Error fetching data:', response.statusText);
        return null;
      }
    } catch (error) {
      console.error('Error fetching data:', error);
      return null;
    }
  }

  const addAssetChartDataToSession = async () => {
    if (localStorage.getItem('asset-chart-data')) {
      const chartData = JSON.parse(localStorage.getItem('asset-chart-data'));
      const chartDataTime = chartData[chartData.length - 1].time;
      const yesterdayTimestamp = Date.now() - 24 * 60 * 60 * 1000;

      if (chartDataTime < yesterdayTimestamp) {
        for (const symbol of symbols) {
          const updatedChartData = await getAssetChartData(symbol.title);
          if (updatedChartData) {
            symbol.data = updatedChartData;
          }
        }

        localStorage.setItem('asset-chart-data', JSON.stringify(symbols));
      }
    } else {
      localStorage.setItem('asset-chart-data', 'loading');

      for (const symbol of symbols) {
        const updatedChartData = await getAssetChartData(symbol.title);
        if (updatedChartData) {
          symbol.data = updatedChartData;
        }
      }

      localStorage.setItem('asset-chart-data', JSON.stringify(symbols));
    }
  };

  addAssetChartDataToSession();

  const assetsData = {
    USDT: {
      placeholder: 'eg. TR7NHqj...',
      iconSm:
        '<svg width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M127.115 91.7605C127.115 95.0234 115.645 97.7537 100.27 98.4428L100.28 98.4481C97.7199 98.5906 95.156 98.6481 92.5923 98.6203C88.5998 98.6203 85.7758 98.5003 84.7816 98.4533C69.3754 97.7589 57.8746 95.0286 57.8746 91.7605C57.8746 88.4925 69.3754 85.7569 84.7816 85.0573V95.7281C85.7861 95.8065 88.6715 95.9787 92.6589 95.9787C97.4406 95.9787 99.8341 95.7699 100.27 95.7334V85.0678C115.645 85.7621 127.115 88.4977 127.115 91.7605ZM153.715 94.6109L93.1355 153.739C92.9638 153.906 92.7352 154 92.4974 154C92.2597 154 92.0311 153.906 91.8594 153.739L31.2854 94.6109C31.1447 94.474 31.05 94.2952 31.015 94.1002C30.98 93.9052 31.0065 93.7039 31.0907 93.5251L53.5182 45.5377C53.5931 45.3766 53.7114 45.2405 53.8593 45.1453C54.0072 45.0501 54.1787 44.9997 54.3536 45H130.657C130.829 45.0026 130.997 45.0544 131.142 45.1495C131.287 45.2445 131.403 45.379 131.477 45.5377L153.909 93.5251C153.993 93.7039 154.02 93.9052 153.985 94.1002C153.95 94.2952 153.855 94.474 153.715 94.6109ZM130.764 92.5018C130.764 88.2941 117.685 84.7754 100.285 83.9558V74.4126H121.739V59.8473H63.3278V74.4126H84.7764V83.961C67.3407 84.7754 54.2306 88.2941 54.2306 92.5071C54.2306 96.7253 67.3407 100.233 84.7764 101.058V131.661H100.28V101.048C117.675 100.228 130.764 96.7148 130.764 92.5018Z" fill="white" /></svg>',
      iconLg:
        '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.6" d="M25.8629 12.9314C25.8629 20.0733 20.0733 25.863 12.9315 25.863C5.78959 25.863 0 20.0733 0 12.9314C0 5.7896 5.78959 0 12.9315 0C20.0733 0 25.8629 5.7896 25.8629 12.9314" fill="#3EEF44"/><path d="M11.6055 12.7063V10.4439H8.53711V8.46094H17.1114V10.4719H14.043V12.7063H11.6055Z" fill="#F2FFF4"/><path fill-rule="evenodd" clip-rule="evenodd" d="M7.21777 12.9584C7.21777 12.2043 9.68395 11.5898 12.7523 11.5898C15.8207 11.5898 18.2869 12.2043 18.2869 12.9584C18.2869 13.7125 15.8207 14.327 12.7523 14.327C9.68395 14.327 7.21777 13.7125 7.21777 12.9584ZM17.8281 12.9584C17.6273 12.6791 15.9641 11.8133 12.7523 11.8133C9.54057 11.8133 7.87733 12.6512 7.6766 12.9584C7.87733 13.2377 9.54057 13.6566 12.7523 13.6566C15.9928 13.6566 17.6273 13.2377 17.8281 12.9584Z" fill="#F2FFF4"/><path d="M14.0426 13.4051V11.841C13.6411 11.8131 13.211 11.7852 12.7808 11.7852C12.3794 11.7852 12.0066 11.7852 11.6338 11.8131V13.3771C11.9779 13.3771 12.3794 13.4051 12.7808 13.4051C13.211 13.433 13.6411 13.433 14.0426 13.4051Z" fill="#F2FFF4"/><path d="M12.7525 14.3273C12.3511 14.3273 11.9783 14.3273 11.6055 14.2994V18.4609H14.0143V14.2715C13.6128 14.2994 13.1827 14.3273 12.7525 14.3273Z" fill="#F2FFF4"/></svg>'
    },
    TRX: {
      placeholder: 'eg. TR7NHqj...',
      iconSm:
        '<svg width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path fill-rule="evenodd" clip-rule="evenodd" d="M52.8713 42.1772C53.2828 41.7002 53.8087 41.3485 54.3938 41.1589C54.9789 40.9694 55.6018 40.949 56.1969 41.0999L127.84 59.5561C128.273 59.6701 128.67 59.8639 129.031 60.1375L143.607 71.3207C144.319 71.8682 144.801 72.6859 144.951 73.6008C145.1 74.5157 144.906 75.456 144.408 76.2226L94.2633 153.433C93.911 153.98 93.4212 154.414 92.8484 154.685C92.2757 154.957 91.6426 155.055 91.0197 154.97C90.3968 154.885 89.8086 154.62 89.3207 154.203C88.8328 153.787 88.4644 153.236 88.2566 152.612L52.1942 45.7681C51.9907 45.1607 51.9461 44.5068 52.0652 43.875C52.1844 43.2432 52.4628 42.6568 52.8713 42.1772ZM64.7007 61.4599L89.7352 135.632L93.8517 97.1925L64.7007 61.4599ZM100.557 98.4293L96.3703 137.536L131.783 83.0054L100.557 98.4293ZM134.978 73.5379L112.148 84.8123L127.455 67.7696L134.978 73.5379ZM120.56 65.0394L64.8632 50.6871L97.5186 90.7117L120.56 65.0394Z" fill="white" /></svg>',
      iconLg:
        '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.2" d="M25.9293 12.9998C25.9293 20.1417 20.1397 25.9314 12.9979 25.9314C5.856 25.9314 0.0664062 20.1417 0.0664062 12.9998C0.0664062 5.85795 5.856 0.0683594 12.9979 0.0683594C20.1397 0.0683594 25.9293 5.85795 25.9293 12.9998" fill="#D13437"/><path fill-rule="evenodd" clip-rule="evenodd" d="M8.09936 7.13424C8.14628 7.07984 8.20626 7.03974 8.27298 7.01812C8.3397 6.99651 8.41073 6.99418 8.4786 7.01139L16.6484 9.11605C16.6978 9.12905 16.7431 9.15115 16.7843 9.18235L18.4464 10.4576C18.5276 10.5201 18.5826 10.6133 18.5997 10.7176C18.6167 10.822 18.5945 10.9292 18.5378 11.0166L12.8195 19.8213C12.7793 19.8837 12.7235 19.9332 12.6582 19.9641C12.5928 19.9951 12.5206 20.0063 12.4496 19.9966C12.3786 19.9869 12.3115 19.9566 12.2559 19.9091C12.2002 19.8617 12.1582 19.7989 12.1345 19.7277L8.02215 7.54373C7.99894 7.47446 7.99386 7.3999 8.00744 7.32785C8.02102 7.25581 8.05277 7.18893 8.09936 7.13424ZM9.44832 9.33314L12.3031 17.7914L12.7726 13.4079L9.44832 9.33314ZM13.5372 13.549L13.0598 18.0085L17.098 11.7901L13.5372 13.549ZM17.4624 10.7105L14.859 11.9961L16.6045 10.0527L17.4624 10.7105ZM15.8182 9.74133L9.46685 8.10467L13.1907 12.6689L15.8182 9.74133Z" fill="#FD3D40"/></svg>'
    },
    BTC: {
      placeholder: 'eg. 1A1zP1e...',
      iconSm:
        '<svg width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M137.767 81.24C139.635 68.61 130.038 61.872 116.815 57.3L121.092 40.278L110.652 37.692L106.483 54.294L98.1519 52.308L102.375 35.586L91.9289 33L87.6396 50.082L81.0009 48.522V48.462L66.5668 44.85L63.7836 55.974C63.7836 55.974 71.5187 57.786 71.3922 57.84C75.6212 58.926 76.3502 61.692 76.2297 63.858L71.3922 83.346L72.4826 83.706L71.338 83.466L64.5125 110.712C64.0306 111.978 62.6992 113.904 59.7413 113.118C59.8618 113.298 52.1929 111.318 52.1929 111.318L47 123.162L60.5847 126.528L68.0126 128.46L63.6631 145.722L74.1152 148.302L78.3442 131.226L86.736 133.386L82.4527 150.414L92.8928 153L97.182 135.738C114.996 139.098 128.406 137.778 134.026 121.716C138.557 108.792 133.785 101.388 124.424 96.456C131.249 94.956 136.382 90.444 137.707 81.24H137.767ZM113.911 114.564C110.713 127.5 88.8505 120.456 81.784 118.77L87.5251 95.856C94.5856 97.662 117.297 101.088 113.911 114.504V114.564ZM117.116 81.06C114.213 92.79 95.9712 86.832 90.1156 85.392L95.3085 64.638C101.23 66.084 120.189 68.85 117.116 81.06Z" fill="white" /></svg>',
      iconLg:
        '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.2" d="M25.6104 16.145C23.874 23.1094 16.8199 27.3474 9.85476 25.6111C2.89286 23.8747 -1.34555 16.8206 0.391171 9.85668C2.12667 2.89152 9.18039 -1.34729 16.1435 0.389023C23.1083 2.12534 27.3463 9.18027 25.61 16.145H25.6104Z" fill="#F7931A"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.9727 11.2145C18.1922 9.74539 17.0736 8.95564 15.5441 8.42879L16.0403 6.43871L14.8285 6.13681L14.3455 8.07445C14.0274 7.9951 13.7003 7.92023 13.3753 7.84605L13.8618 5.89564L12.6511 5.59375L12.1546 7.58314C11.891 7.52311 11.6323 7.46376 11.3811 7.40132L11.3825 7.39511L9.71188 6.97798L9.38963 8.2718C9.38963 8.2718 10.2884 8.47778 10.2694 8.49055C10.7601 8.61303 10.8491 8.9377 10.8339 9.19508L10.2687 11.4622C10.3026 11.4708 10.3464 11.4833 10.3947 11.5026L10.267 11.4708L9.4745 14.6468C9.41447 14.7958 9.26232 15.0194 8.91937 14.9345C8.93144 14.9521 8.03887 14.7147 8.03887 14.7147L7.4375 16.1017L9.01425 16.4947C9.19224 16.5393 9.36807 16.5852 9.54198 16.6305L9.54222 16.6306C9.65476 16.66 9.7665 16.6891 9.87749 16.7176L9.37617 18.7308L10.5862 19.0327L11.083 17.0412C11.4132 17.1309 11.734 17.2137 12.048 17.2917L11.5533 19.2738L12.7646 19.5757L13.2659 17.5667C15.3316 17.9576 16.8852 17.7999 17.5383 15.932C18.0652 14.4277 17.5125 13.5599 16.4256 12.9938C17.2171 12.8106 17.8133 12.2899 17.9724 11.2145H17.9727ZM15.2043 15.0965C14.8604 16.4771 12.6989 15.9059 11.7108 15.6447C11.6223 15.6213 11.5432 15.6004 11.4757 15.5836L12.1409 12.917C12.2234 12.9376 12.3242 12.9602 12.4384 12.9858L12.4384 12.9858C13.4607 13.2152 15.5557 13.6853 15.2047 15.0965H15.2043ZM12.6442 11.7468C13.4687 11.9668 15.2659 12.4463 15.579 11.1921C15.8991 9.90894 14.1515 9.52221 13.298 9.33334C13.2021 9.31211 13.1174 9.29337 13.0483 9.27615L12.4452 11.6947C12.5022 11.709 12.5692 11.7268 12.6442 11.7468Z" fill="#F7931A"/></svg>'
    },
    ETH: {
      placeholder: 'eg. 0xde0B2...',
      iconSm:
        '<svg width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray"opacity="0.5" /><path d="M92.5 38L59 94.3415L92.5 114.463L126 94.3415L92.5 38ZM59 101.049L92.5 148L126 101.049L92.5 121.171L59 101.049Z" fill="white" /></svg>',
      iconLg:
        '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.2" d="M25.9293 12.9998C25.9293 20.1417 20.1397 25.9314 12.9979 25.9314C5.856 25.9314 0.0664062 20.1417 0.0664062 12.9998C0.0664062 5.85795 5.856 0.0683594 12.9979 0.0683594C20.1397 0.0683594 25.9293 5.85795 25.9293 12.9998" fill="#505050"/><g opacity="0.8"><path d="M12.9563 7L12.8765 7.27148V15.1493L12.9563 15.229L16.6131 13.0675L12.9563 7Z" fill="white"/><path d="M12.9566 7L9.2998 13.0675L12.9566 15.229V11.4054V7Z" fill="white"/><path d="M12.9566 16.4182L12.9116 16.4731V19.2794L12.9566 19.4108L16.6156 14.2578L12.9566 16.4182Z" fill="white"/><path d="M12.9566 19.4108V16.4182L9.2998 14.2578L12.9566 19.4108Z" fill="white"/><path d="M12.9565 15.2298L16.6133 13.0684L12.9565 11.4062V15.2298Z" fill="white"/><path d="M9.2998 13.0684L12.9565 15.2299V11.4062L9.2998 13.0684Z" fill="white"/></g></svg>'
    },
    ETC: {
      placeholder: 'eg. 0xde0B2...',
      iconSm:
        '<svg width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M92.5 73L59.2328 92.5L92.5 112L125.767 92.5L92.5 73Z" fill="white" /><path d="M59 101L92.5 148L126 101L92.5 121.143L59 101Z" fill="white" /><path d="M126 85L92.5 38L59 85L92.5 64.8571L126 85Z" fill="white" /></svg>',
      iconLg:
        '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.1" d="M13 26C20.1797 26 26 20.1797 26 13C26 5.8203 20.1797 0 13 0C5.8203 0 0 5.8203 0 13C0 20.1797 5.8203 26 13 26Z" fill="#3AB83A"/><mask id="mask0_0_1" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="26" height="26"><path d="M13 26C20.1797 26 26 20.1797 26 13C26 5.8203 20.1797 0 13 0C5.8203 0 0 5.8203 0 13C0 20.1797 5.8203 26 13 26Z" fill="white"/></mask><g mask="url(#mask0_0_1)"><path fill-rule="evenodd" clip-rule="evenodd" d="M10 12.326L13.5144 10.0416L17 12.3402L13.499 6L10 12.326ZM10.1341 12.9858L13.5182 10.7557L16.8583 12.9693L13.5201 15.2017L10.1341 12.9858ZM10 13.6243C11.2334 14.4331 12.5204 15.2797 13.5144 15.9348L17 13.6243C15.7379 15.9395 14.6865 17.8669 13.5144 20L12.7957 18.6974C11.8301 16.9471 10.8343 15.1422 10 13.6243Z" fill="#3AB83A"/><path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 6L13.5131 10.0416L17 12.3402L13.5 6ZM13.5164 10.7557L16.8786 12.9693L13.5181 15.2017L13.5164 10.7557ZM13.5131 15.9348L17 13.6243C15.9185 15.9395 13.5131 20 13.5131 20V15.9348Z" fill="#0B8311"/></g></svg>'
    },
    LTC: {
      placeholder: 'eg. LZJ3GLT...',
      iconSm:
        '<svg width="24" height="24"viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M61.1737 111.455L53 114.675L56.9406 98.75L65.1691 95.415L77.0549 47H106.371L97.6857 82.65L105.745 79.3702L101.859 95.1298L93.7406 98.4648L88.8857 119.284H133L128.026 139H54.4263L61.1737 111.455Z" fill="white" /></svg>',
      iconLg:
        '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.2" d="M25.9293 12.9998C25.9293 20.1417 20.1397 25.9314 12.9979 25.9314C5.856 25.9314 0.0664062 20.1417 0.0664062 12.9998C0.0664062 5.85795 5.856 0.0683594 12.9979 0.0683594C20.1397 0.0683594 25.9293 5.85795 25.9293 12.9998" fill="#4291DB"/><path d="M12.5459 15.1759L13.126 12.9914L14.4995 12.4896L14.8411 11.2059L14.8295 11.174L13.4775 11.6679L14.4516 8H11.689L10.4151 12.7867L9.35145 13.1753L9 14.4988L10.0628 14.1105L9.31201 16.9316H16.6644L17.1357 15.1759H12.5459Z" fill="#E4E4E4"/></svg>'
    },
    BNB: {
      placeholder: 'eg. 0xde0B2...',
      iconSm:
        '<svg width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5"/><path fill-rule="evenodd" clip-rule="evenodd" d="M72.0341 84.3801L93.01 63.4132L113.995 84.397L126.194 72.1907L93.01 39L59.8271 72.1822L72.0341 84.3801ZM39 93.0015L51.2025 80.7999L63.4051 93.0015L51.2025 105.204L39 93.0015ZM93.01 122.595L72.0341 101.62L59.81 113.809L59.8271 113.826L93.01 147L126.202 113.801L113.995 101.611L93.01 122.595ZM122.595 93.0046L134.798 80.8029L147 93.0046L134.798 105.207L122.595 93.0046ZM93.01 80.6101L105.388 92.9954H105.397L105.388 93.0046L93.01 105.39L80.6325 93.0216L80.6155 92.9954L82.7994 90.8122L83.857 89.7631L93.01 80.6101Z" fill="white"/></svg>',
      iconLg:
        '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_873_2)"><path opacity="0.2" d="M13 26C20.1797 26 26 20.1797 26 13C26 5.8203 20.1797 0 13 0C5.8203 0 0 5.8203 0 13C0 20.1797 5.8203 26 13 26Z" fill="#F3BA2F"/><path fill-rule="evenodd" clip-rule="evenodd" d="M10.2822 11.8826L13.0013 9.16468L15.7216 11.8848L17.3029 10.3025L13.0013 6L8.69981 10.3014L10.2822 11.8826ZM6 13.0002L7.58181 11.4185L9.16362 13.0002L7.58181 14.582L6 13.0002ZM13.0013 16.8364L10.2822 14.1174L8.69759 15.6975L8.69981 15.6997L13.0013 20L17.3029 15.6975L17.304 15.6964L15.7216 14.1163L13.0013 16.8364ZM16.8364 13.0006L18.4182 11.4189L20 13.0006L18.4182 14.5824L16.8364 13.0006ZM13.0013 11.3939L14.6058 12.9994H14.607L14.6058 13.0006L13.0013 14.6061L11.3968 13.0028L11.3946 12.9994L11.3968 12.9972L11.6777 12.7164L11.8148 12.5804L13.0013 11.3939Z" fill="#F3BA2F"/></g><defs><clipPath id="clip0_873_2"><rect width="26" height="26" fill="white"/></clipPath></defs></svg>'
    }
  };

  const addAssetDataToSession = () => {
    if (!sessionStorage.getItem('assets-data')) {
      sessionStorage.setItem('assets-data', JSON.stringify(assetsData));
    }
  };

  addAssetDataToSession();
})();

// ! Removed following code if you do't wish to use jQuery. Remember that navbar search functionality will stop working on removal.
if (typeof $ !== 'undefined') {
  $(function () {
    // ! TODO: Required to load after DOM is ready, did this now with jQuery ready.
    window.Helpers.initSidebarToggle();
    // Toggle Universal Sidebar

    // Navbar Search with autosuggest (typeahead)
    // ? You can remove the following JS if you don't want to use search functionality.
    //----------------------------------------------------------------------------------

    var searchToggler = $('.search-toggler'),
      searchInputWrapper = $('.search-input-wrapper'),
      searchInput = $('.search-input'),
      contentBackdrop = $('.content-backdrop');

    // Open search input on click of search icon
    if (searchToggler.length) {
      searchToggler.on('click', function () {
        if (searchInputWrapper.length) {
          searchInputWrapper.toggleClass('d-none');
          searchInput.focus();
        }
      });
    }
    // Open search on 'CTRL+/'
    $(document).on('keydown', function (event) {
      let ctrlKey = event.ctrlKey,
        slashKey = event.which === 191;

      if (ctrlKey && slashKey) {
        if (searchInputWrapper.length) {
          searchInputWrapper.toggleClass('d-none');
          searchInput.focus();
        }
      }
    });
    // Note: Following code is required to update container class of typeahead dropdown width on focus of search input. setTimeout is required to allow time to initiate Typeahead UI.
    setTimeout(function () {
      var twitterTypeahead = $('.twitter-typeahead');
      searchInput.on('focus', function () {
        if (searchInputWrapper.hasClass('container-xxl')) {
          searchInputWrapper.find(twitterTypeahead).addClass('container-xxl');
          twitterTypeahead.removeClass('container-fluid');
        } else if (searchInputWrapper.hasClass('container-fluid')) {
          searchInputWrapper.find(twitterTypeahead).addClass('container-fluid');
          twitterTypeahead.removeClass('container-xxl');
        }
      });
    }, 10);

    if (searchInput.length) {
      // Filter config
      var filterConfig = function (data) {
        return function findMatches(q, cb) {
          let matches;
          matches = [];
          data.filter(function (i) {
            if (i.name.toLowerCase().startsWith(q.toLowerCase())) {
              matches.push(i);
            } else if (
              !i.name.toLowerCase().startsWith(q.toLowerCase()) &&
              i.name.toLowerCase().includes(q.toLowerCase())
            ) {
              matches.push(i);
              matches.sort(function (a, b) {
                return b.name < a.name ? 1 : -1;
              });
            } else {
              return [];
            }
          });
          cb(matches);
        };
      };

      // Search JSON
      var searchJson = 'search-vertical.json'; // For vertical layout
      if ($('#layout-menu').hasClass('menu-horizontal')) {
        var searchJson = 'search-horizontal.json'; // For vertical layout
      }
      // Search API AJAX call
      var searchData = $.ajax({
        url: assetsPath + 'json/' + searchJson, //? Use your own search api instead
        dataType: 'json',
        async: false
      }).responseJSON;
      // Init typeahead on searchInput
      searchInput.each(function () {
        var $this = $(this);
        searchInput
          .typeahead(
            {
              hint: false,
              classNames: {
                menu: 'tt-menu navbar-search-suggestion',
                cursor: 'active',
                suggestion: 'suggestion d-flex justify-content-between px-4 py-2 w-100'
              }
            },
            // ? Add/Update blocks as per need
            // Pages
            {
              name: 'pages',
              display: 'name',
              limit: 5,
              source: filterConfig(searchData.pages),
              templates: {
                header: '<h6 class="suggestions-header text-primary mb-0 mx-4 mt-3 pb-2">Pages</h6>',
                suggestion: function ({ url, icon, name }) {
                  return (
                    '<a href="' +
                    baseUrl +
                    url +
                    '">' +
                    '<div>' +
                    '<i class="ti ' +
                    icon +
                    ' me-2"></i>' +
                    '<span class="align-middle">' +
                    name +
                    '</span>' +
                    '</div>' +
                    '</a>'
                  );
                },
                notFound:
                  '<div class="not-found px-4 py-2">' +
                  '<h6 class="suggestions-header text-primary mb-2">Pages</h6>' +
                  '<p class="py-2 mb-0"><i class="ti ti-alert-circle ti-xs me-2"></i> No Results Found</p>' +
                  '</div>'
              }
            },
            // Files
            {
              name: 'files',
              display: 'name',
              limit: 4,
              source: filterConfig(searchData.files),
              templates: {
                header: '<h6 class="suggestions-header text-primary mb-0 mx-4 mt-3 pb-2">Files</h6>',
                suggestion: function ({ src, name, subtitle, meta }) {
                  return (
                    '<a href="javascript:;">' +
                    '<div class="d-flex w-50">' +
                    '<img class="me-3" src="' +
                    assetsPath +
                    src +
                    '" alt="' +
                    name +
                    '" height="32">' +
                    '<div class="w-75">' +
                    '<h6 class="mb-0">' +
                    name +
                    '</h6>' +
                    '<small class="text-muted">' +
                    subtitle +
                    '</small>' +
                    '</div>' +
                    '</div>' +
                    '<small class="text-muted">' +
                    meta +
                    '</small>' +
                    '</a>'
                  );
                },
                notFound:
                  '<div class="not-found px-4 py-2">' +
                  '<h6 class="suggestions-header text-primary mb-2">Files</h6>' +
                  '<p class="py-2 mb-0"><i class="ti ti-alert-circle ti-xs me-2"></i> No Results Found</p>' +
                  '</div>'
              }
            },
            // Members
            {
              name: 'members',
              display: 'name',
              limit: 4,
              source: filterConfig(searchData.members),
              templates: {
                header: '<h6 class="suggestions-header text-primary mb-0 mx-4 mt-3 pb-2">Members</h6>',
                suggestion: function ({ name, src, subtitle }) {
                  return (
                    '<a href="' +
                    baseUrl +
                    'app/user/view/account">' +
                    '<div class="d-flex align-items-center">' +
                    '<img class="rounded-circle me-3" src="' +
                    assetsPath +
                    src +
                    '" alt="' +
                    name +
                    '" height="32">' +
                    '<div class="user-info">' +
                    '<h6 class="mb-0">' +
                    name +
                    '</h6>' +
                    '<small class="text-muted">' +
                    subtitle +
                    '</small>' +
                    '</div>' +
                    '</div>' +
                    '</a>'
                  );
                },
                notFound:
                  '<div class="not-found px-4 py-2">' +
                  '<h6 class="suggestions-header text-primary mb-2">Members</h6>' +
                  '<p class="py-2 mb-0"><i class="ti ti-alert-circle ti-xs me-2"></i> No Results Found</p>' +
                  '</div>'
              }
            }
          )
          //On typeahead result render.
          .bind('typeahead:render', function () {
            // Show content backdrop,
            contentBackdrop.addClass('show').removeClass('fade');
          })
          // On typeahead select
          .bind('typeahead:select', function (ev, suggestion) {
            // Open selected page
            if (suggestion.url !== 'javascript:;') {
              window.location = baseUrl + suggestion.url;
            }
          })
          // On typeahead close
          .bind('typeahead:close', function () {
            // Clear search
            searchInput.val('');
            $this.typeahead('val', '');
            // Hide search input wrapper
            searchInputWrapper.addClass('d-none');
            // Fade content backdrop
            contentBackdrop.addClass('fade').removeClass('show');
          });

        // On searchInput keyup, Fade content backdrop if search input is blank
        searchInput.on('keyup', function () {
          if (searchInput.val() == '') {
            contentBackdrop.addClass('fade').removeClass('show');
          }
        });
      });

      // Init PerfectScrollbar in search result
      var psSearch;
      $('.navbar-search-suggestion').each(function () {
        psSearch = new PerfectScrollbar($(this)[0], {
          wheelPropagation: false,
          suppressScrollX: true
        });
      });

      searchInput.on('keyup', function () {
        psSearch.update();
      });
    }
  });
}
