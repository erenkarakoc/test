@php
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Route;
  use App\Models\UserBalances;
  use App\Models\MarketData;

  $containerNav = $configData['contentLayout'] === 'compact' ? 'container-xxl' : 'container-fluid';
  $navbarDetached = $navbarDetached ?? '';

  $user = Auth::user();
  $userId = $user->id;
  $userBalance = UserBalances::where('user_id', $userId)->get();

  $walletSmallIcons = [
      'USD' =>
          '<svg class="me-3" width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M89.5198 145V41H96.7074V145H89.5198ZM108.585 75.3281C108.234 72.051 106.729 69.5052 104.07 67.6906C101.412 65.876 97.8031 64.9688 93.2451 64.9688C90.1479 64.9688 87.5329 65.375 85.4 66.1875C83.2671 66.9729 81.6309 68.0698 80.4914 69.4781C79.3811 70.8865 78.8259 72.4844 78.8259 74.2719C78.7675 75.7615 79.1035 77.0615 79.834 78.1719C80.5936 79.2823 81.6309 80.2438 82.9457 81.0563C84.2605 81.8417 85.7798 82.5323 87.5037 83.1281C89.2276 83.6969 91.0683 84.1844 93.0259 84.5906L101.09 86.3781C105.005 87.1906 108.599 88.274 111.872 89.6281C115.144 90.9823 117.978 92.6479 120.374 94.625C122.77 96.6021 124.625 98.9313 125.94 101.613C127.284 104.294 127.971 107.368 128 110.834C127.971 115.926 126.568 120.341 123.793 124.078C121.046 127.789 117.072 130.673 111.872 132.731C106.7 134.762 100.462 135.778 93.1574 135.778C85.9113 135.778 79.6002 134.749 74.2241 132.691C68.8772 130.632 64.699 127.585 61.6895 123.55C58.7093 119.488 57.1461 114.464 57 108.478H75.3636C75.5681 111.268 76.43 113.597 77.9494 115.466C79.4979 117.307 81.5578 118.702 84.129 119.65C86.7294 120.571 89.6658 121.031 92.9383 121.031C96.1523 121.031 98.9426 120.598 101.309 119.731C103.705 118.865 105.56 117.659 106.875 116.116C108.19 114.572 108.848 112.798 108.848 110.794C108.848 108.925 108.249 107.354 107.051 106.081C105.882 104.808 104.158 103.725 101.879 102.831C99.6292 101.938 96.8681 101.125 93.5957 100.394L83.8222 98.1188C76.2547 96.4125 70.2796 93.7448 65.8969 90.1156C61.5142 86.4865 59.3375 81.5979 59.3667 75.45C59.3375 70.4125 60.7837 66.0115 63.7056 62.2469C66.6566 58.4823 70.7033 55.5438 75.8457 53.4313C80.9881 51.3188 86.8317 50.2625 93.3765 50.2625C100.038 50.2625 105.853 51.3188 110.82 53.4313C115.816 55.5438 119.702 58.4823 122.478 62.2469C125.254 66.0115 126.685 70.3719 126.773 75.3281H108.585Z" fill="white" /></svg>',
      'USDT' =>
          '<svg class="me-3" width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M127.115 91.7605C127.115 95.0234 115.645 97.7537 100.27 98.4428L100.28 98.4481C97.7199 98.5906 95.156 98.6481 92.5923 98.6203C88.5998 98.6203 85.7758 98.5003 84.7816 98.4533C69.3754 97.7589 57.8746 95.0286 57.8746 91.7605C57.8746 88.4925 69.3754 85.7569 84.7816 85.0573V95.7281C85.7861 95.8065 88.6715 95.9787 92.6589 95.9787C97.4406 95.9787 99.8341 95.7699 100.27 95.7334V85.0678C115.645 85.7621 127.115 88.4977 127.115 91.7605ZM153.715 94.6109L93.1355 153.739C92.9638 153.906 92.7352 154 92.4974 154C92.2597 154 92.0311 153.906 91.8594 153.739L31.2854 94.6109C31.1447 94.474 31.05 94.2952 31.015 94.1002C30.98 93.9052 31.0065 93.7039 31.0907 93.5251L53.5182 45.5377C53.5931 45.3766 53.7114 45.2405 53.8593 45.1453C54.0072 45.0501 54.1787 44.9997 54.3536 45H130.657C130.829 45.0026 130.997 45.0544 131.142 45.1495C131.287 45.2445 131.403 45.379 131.477 45.5377L153.909 93.5251C153.993 93.7039 154.02 93.9052 153.985 94.1002C153.95 94.2952 153.855 94.474 153.715 94.6109ZM130.764 92.5018C130.764 88.2941 117.685 84.7754 100.285 83.9558V74.4126H121.739V59.8473H63.3278V74.4126H84.7764V83.961C67.3407 84.7754 54.2306 88.2941 54.2306 92.5071C54.2306 96.7253 67.3407 100.233 84.7764 101.058V131.661H100.28V101.048C117.675 100.228 130.764 96.7148 130.764 92.5018Z" fill="white" /></svg>',
      'TRX' =>
          '<svg class="me-3" width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path fill-rule="evenodd" clip-rule="evenodd" d="M52.8713 42.1772C53.2828 41.7002 53.8087 41.3485 54.3938 41.1589C54.9789 40.9694 55.6018 40.949 56.1969 41.0999L127.84 59.5561C128.273 59.6701 128.67 59.8639 129.031 60.1375L143.607 71.3207C144.319 71.8682 144.801 72.6859 144.951 73.6008C145.1 74.5157 144.906 75.456 144.408 76.2226L94.2633 153.433C93.911 153.98 93.4212 154.414 92.8484 154.685C92.2757 154.957 91.6426 155.055 91.0197 154.97C90.3968 154.885 89.8086 154.62 89.3207 154.203C88.8328 153.787 88.4644 153.236 88.2566 152.612L52.1942 45.7681C51.9907 45.1607 51.9461 44.5068 52.0652 43.875C52.1844 43.2432 52.4628 42.6568 52.8713 42.1772ZM64.7007 61.4599L89.7352 135.632L93.8517 97.1925L64.7007 61.4599ZM100.557 98.4293L96.3703 137.536L131.783 83.0054L100.557 98.4293ZM134.978 73.5379L112.148 84.8123L127.455 67.7696L134.978 73.5379ZM120.56 65.0394L64.8632 50.6871L97.5186 90.7117L120.56 65.0394Z" fill="white" /></svg>',
      'BTC' =>
          '<svg class="me-3" width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M137.767 81.24C139.635 68.61 130.038 61.872 116.815 57.3L121.092 40.278L110.652 37.692L106.483 54.294L98.1519 52.308L102.375 35.586L91.9289 33L87.6396 50.082L81.0009 48.522V48.462L66.5668 44.85L63.7836 55.974C63.7836 55.974 71.5187 57.786 71.3922 57.84C75.6212 58.926 76.3502 61.692 76.2297 63.858L71.3922 83.346L72.4826 83.706L71.338 83.466L64.5125 110.712C64.0306 111.978 62.6992 113.904 59.7413 113.118C59.8618 113.298 52.1929 111.318 52.1929 111.318L47 123.162L60.5847 126.528L68.0126 128.46L63.6631 145.722L74.1152 148.302L78.3442 131.226L86.736 133.386L82.4527 150.414L92.8928 153L97.182 135.738C114.996 139.098 128.406 137.778 134.026 121.716C138.557 108.792 133.785 101.388 124.424 96.456C131.249 94.956 136.382 90.444 137.707 81.24H137.767ZM113.911 114.564C110.713 127.5 88.8505 120.456 81.784 118.77L87.5251 95.856C94.5856 97.662 117.297 101.088 113.911 114.504V114.564ZM117.116 81.06C114.213 92.79 95.9712 86.832 90.1156 85.392L95.3085 64.638C101.23 66.084 120.189 68.85 117.116 81.06Z" fill="white" /></svg>',
      'ETH' =>
          '<svg class="me-3" width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray"opacity="0.5" /><path d="M92.5 38L59 94.3415L92.5 114.463L126 94.3415L92.5 38ZM59 101.049L92.5 148L126 101.049L92.5 121.171L59 101.049Z" fill="white" /></svg>',
      'ETC' =>
          '<svg class="me-3" width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M92.5 73L59.2328 92.5L92.5 112L125.767 92.5L92.5 73Z" fill="white" /><path d="M59 101L92.5 148L126 101L92.5 121.143L59 101Z" fill="white" /><path d="M126 85L92.5 38L59 85L92.5 64.8571L126 85Z" fill="white" /></svg>',
      'BNB' =>
          '<svg class="me-3" width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5"/><path fill-rule="evenodd" clip-rule="evenodd" d="M72.0341 84.3801L93.01 63.4132L113.995 84.397L126.194 72.1907L93.01 39L59.8271 72.1822L72.0341 84.3801ZM39 93.0015L51.2025 80.7999L63.4051 93.0015L51.2025 105.204L39 93.0015ZM93.01 122.595L72.0341 101.62L59.81 113.809L59.8271 113.826L93.01 147L126.202 113.801L113.995 101.611L93.01 122.595ZM122.595 93.0046L134.798 80.8029L147 93.0046L134.798 105.207L122.595 93.0046ZM93.01 80.6101L105.388 92.9954H105.397L105.388 93.0046L93.01 105.39L80.6325 93.0216L80.6155 92.9954L82.7994 90.8122L83.857 89.7631L93.01 80.6101Z" fill="white"/></svg>',
      'LTC' =>
          '<svg class="me-3" width="24" height="24"viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M61.1737 111.455L53 114.675L56.9406 98.75L65.1691 95.415L77.0549 47H106.371L97.6857 82.65L105.745 79.3702L101.859 95.1298L93.7406 98.4648L88.8857 119.284H133L128.026 139H54.4263L61.1737 111.455Z" fill="white" /></svg>',
      'GDZ' =>
          '<svg class="me-3" width="24" height="24" viewBox="0 0 186 186" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M186 93C186 144.362 144.362 186 93 186C41.6375 186 0 144.362 0 93C0 41.6375 41.6375 0 93 0C144.362 0 186 41.6375 186 93Z" fill="gray" fill-opacity="0.5" /><path d="M45 81C54.5478 81 63.7045 77.2072 70.4558 70.4558C77.2071 63.7045 81 54.5478 81 45H105V81H141V105C131.452 105 122.295 108.793 115.544 115.544C108.793 122.295 105 131.452 105 141H81V105H45V81Z" fill="white" /></svg>',
  ];
@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
  <nav
    class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
    id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{ $containerNav }}">
@endif

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))
  <div class="navbar-brand app-brand d-none d-xl-flex py-0 me-4">
    <a href="{{ url('/') }}" class="app-brand-link">
      <span class="app-brand-logo">@include('_partials.macros', ['width' => 150])</span>
    </a>
  </div>
@endif

<!-- ! Not required for layout-without-menu -->
@if (!isset($navbarHideToggle))
  <div
    class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="ti ti-menu-2 ti-md"></i>
    </a>
  </div>
@endif

<div class="gdz-navbar navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <ul class="navbar-nav nav-pills flex-row align-items-center ms-auto gap-2">
    <li class="nav-item">
      <button type="button" class="btn btn-sm text-gray popover-trigger" data-bs-toggle="popover"
        data-bs-trigger="focus" data-bs-placement="bottom" data-bs-custom-class="popover-dark"
        data-bs-content="Other languages will be added very soon!">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
          <g fill="currentColor">
            <path d="M224 56v120c-64 55.43-112-55.43-176 0V56c64-55.43 112 55.43 176 0" opacity=".4" />
            <path
              d="M42.76 50A8 8 0 0 0 40 56v168a8 8 0 0 0 16 0v-44.23c26.79-21.16 49.87-9.75 76.45 3.41c16.4 8.11 34.06 16.85 53 16.85c13.93 0 28.54-4.75 43.82-18a8 8 0 0 0 2.76-6V56a8 8 0 0 0-13.27-6c-28 24.23-51.72 12.49-79.21-1.12C111.07 34.76 78.78 18.79 42.76 50M216 172.25c-26.79 21.16-49.87 9.74-76.45-3.41c-25-12.35-52.81-26.13-83.55-8.4V59.79c26.79-21.16 49.87-9.75 76.45 3.4c25 12.35 52.82 26.13 83.55 8.4Z" />
          </g>
        </svg>
        <span class="ms-2 lh-1">EN</span>
      </button>
    </li>

    <li class="nav-item">
      <button type="button" class="btn btn-sm text-gray dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
          <path fill="currentColor"
            d="M18.75 9v.704c0 .845.24 1.671.692 2.374l1.108 1.723c1.011 1.574.239 3.713-1.52 4.21a25.8 25.8 0 0 1-14.06 0c-1.759-.497-2.531-2.636-1.52-4.21l1.108-1.723a4.4 4.4 0 0 0 .693-2.374V9c0-3.866 3.022-7 6.749-7s6.75 3.134 6.75 7"
            opacity=".5" />
          <path fill="currentColor"
            d="M12.75 6a.75.75 0 0 0-1.5 0v4a.75.75 0 0 0 1.5 0zM7.243 18.545a5.002 5.002 0 0 0 9.513 0c-3.145.59-6.367.59-9.513 0" />
        </svg>
        <span class="badge rounded-pill badge-center h-px-18 w-px-18 bg-label-primary ms-6 pt-50 position-absolute">
          3
        </span>
      </button>
    </li>

    <li class="nav-item navbar-dropdown dropdown">
      <button type="button" class="btn btn-sm text-gray dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        @if ($userTotalBalance)
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M4.892 9.614c0-.402.323-.728.722-.728H9.47c.4 0 .723.326.723.728a.726.726 0 0 1-.723.729H5.614a.726.726 0 0 1-.722-.729" />
            <path fill="currentColor" fill-rule="evenodd"
              d="M21.188 10.004q-.094-.005-.2-.004h-2.773C15.944 10 14 11.736 14 14s1.944 4 4.215 4h2.773q.106.001.2-.004c.923-.056 1.739-.757 1.808-1.737c.004-.064.004-.133.004-.197v-4.124c0-.064 0-.133-.004-.197c-.069-.98-.885-1.68-1.808-1.737m-3.217 5.063c.584 0 1.058-.478 1.058-1.067c0-.59-.474-1.067-1.058-1.067s-1.06.478-1.06 1.067c0 .59.475 1.067 1.06 1.067"
              clip-rule="evenodd" />
            <path fill="currentColor"
              d="M21.14 10.002c0-1.181-.044-2.448-.798-3.355a4 4 0 0 0-.233-.256c-.749-.748-1.698-1.08-2.87-1.238C16.099 5 14.644 5 12.806 5h-2.112C8.856 5 7.4 5 6.26 5.153c-1.172.158-2.121.49-2.87 1.238c-.748.749-1.08 1.698-1.238 2.87C2 10.401 2 11.856 2 13.694v.112c0 1.838 0 3.294.153 4.433c.158 1.172.49 2.121 1.238 2.87c.749.748 1.698 1.08 2.87 1.238c1.14.153 2.595.153 4.433.153h2.112c1.838 0 3.294 0 4.433-.153c1.172-.158 2.121-.49 2.87-1.238q.305-.308.526-.66c.45-.72.504-1.602.504-2.45l-.15.001h-2.774C15.944 18 14 16.264 14 14s1.944-4 4.215-4h2.773q.079 0 .151.002"
              opacity=".5" />
            <path fill="currentColor"
              d="M10.101 2.572L8 3.992l-1.733 1.16C7.405 5 8.859 5 10.694 5h2.112c1.838 0 3.294 0 4.433.153q.344.045.662.114L16 4l-2.113-1.428a3.42 3.42 0 0 0-3.786 0" />
          </svg>
        @else
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
            <path fill="currentColor" d="M5.75 7a.75.75 0 0 0 0 1.5h4a.75.75 0 0 0 0-1.5z" />
            <path fill="currentColor" fill-rule="evenodd"
              d="M21.188 8.004q-.094-.005-.2-.004h-2.773C15.944 8 14 9.736 14 12s1.944 4 4.215 4h2.773q.106.001.2-.004c.923-.056 1.739-.757 1.808-1.737c.004-.064.004-.133.004-.197V9.938c0-.064 0-.133-.004-.197c-.069-.98-.885-1.68-1.808-1.737m-3.217 5.063c.584 0 1.058-.478 1.058-1.067c0-.59-.474-1.067-1.058-1.067s-1.06.478-1.06 1.067c0 .59.475 1.067 1.06 1.067"
              clip-rule="evenodd" />
            <path fill="currentColor"
              d="M21.14 8.002c0-1.181-.044-2.448-.798-3.355a4 4 0 0 0-.233-.256c-.749-.748-1.698-1.08-2.87-1.238C16.099 3 14.644 3 12.806 3h-2.112C8.856 3 7.4 3 6.26 3.153c-1.172.158-2.121.49-2.87 1.238c-.748.749-1.08 1.698-1.238 2.87C2 8.401 2 9.856 2 11.694v.112c0 1.838 0 3.294.153 4.433c.158 1.172.49 2.121 1.238 2.87c.749.748 1.698 1.08 2.87 1.238c1.14.153 2.595.153 4.433.153h2.112c1.838 0 3.294 0 4.433-.153c1.172-.158 2.121-.49 2.87-1.238q.305-.308.526-.66c.45-.72.504-1.602.504-2.45l-.15.001h-2.774C15.944 16 14 14.264 14 12s1.944-4 4.215-4h2.773q.079 0 .151.002"
              opacity=".5" />
          </svg>
        @endif
        <span class="ms-2 lh-1">
          {{ number_format($userTotalBalance, 2) }}$
        </span>
      </button>

      <ul class="dropdown-menu dropdown-menu-end dropdown-wallet">
        <li>
          <div class="d-flex gap-2">
            <a href="{{ route('page-add-funds') }}" class="btn btn-primary btn-sm w-50">Add Funds</a>
            <a href="/send" class="btn btn-outline-primary btn-sm w-50">Send</a>
          </div>
        </li>
        <li>
          <div class="dropdown-divider my-4 mx-n2"></div>
        </li>
        <li>
          <div class="card">
            <div class="table-responsive">
              <table class="table card-table">
                <thead class="bg-light">
                  <tr>
                    <th>Asset</th>
                    <th>Locked</th>
                    <th>Available</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($userBalance as $wallet)
                    <tr>
                      <td>
                        <span class="d-flex align-items-center">
                          {!! $walletSmallIcons[$wallet['wallet']] ?? '' !!}
                          {{ $wallet['title'] }}
                        </span>
                      </td>
                      <td>
                        <span class="text-light">{{ $wallet['locked_balance'] }}$</span>
                      </td>
                      <td>
                        <span>{{ number_format($wallet['balance'] * $marketDataPrices[$wallet['wallet']], 2) }}$</span>
                      </td>
                    </tr>
                  @endforeach
                  <tr>
                    <td>
                      <span class="d-flex align-items-center">
                        Total Balance
                      </span>
                    </td>
                    <td>
                      <span class="text-light">{{ number_format($userTotalLockedBalance, 2) }}$</span>
                    </td>
                    <td>
                      <span>{{ number_format($userTotalBalance, 2) }}$</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </li>
        <li>
          <div class="dropdown-divider my-4 mx-n2"></div>
        </li>
        <li class="mt-4">
          <a class="btn btn-primary btn-sm" href="{{ route('page-wallet') }}">
            <svg class="me-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M4.892 9.614c0-.402.323-.728.722-.728H9.47c.4 0 .723.326.723.728a.726.726 0 0 1-.723.729H5.614a.726.726 0 0 1-.722-.729" />
              <path fill="currentColor" fill-rule="evenodd"
                d="M21.188 10.004q-.094-.005-.2-.004h-2.773C15.944 10 14 11.736 14 14s1.944 4 4.215 4h2.773q.106.001.2-.004c.923-.056 1.739-.757 1.808-1.737c.004-.064.004-.133.004-.197v-4.124c0-.064 0-.133-.004-.197c-.069-.98-.885-1.68-1.808-1.737m-3.217 5.063c.584 0 1.058-.478 1.058-1.067c0-.59-.474-1.067-1.058-1.067s-1.06.478-1.06 1.067c0 .59.475 1.067 1.06 1.067"
                clip-rule="evenodd" />
              <path fill="currentColor"
                d="M21.14 10.002c0-1.181-.044-2.448-.798-3.355a4 4 0 0 0-.233-.256c-.749-.748-1.698-1.08-2.87-1.238C16.099 5 14.644 5 12.806 5h-2.112C8.856 5 7.4 5 6.26 5.153c-1.172.158-2.121.49-2.87 1.238c-.748.749-1.08 1.698-1.238 2.87C2 10.401 2 11.856 2 13.694v.112c0 1.838 0 3.294.153 4.433c.158 1.172.49 2.121 1.238 2.87c.749.748 1.698 1.08 2.87 1.238c1.14.153 2.595.153 4.433.153h2.112c1.838 0 3.294 0 4.433-.153c1.172-.158 2.121-.49 2.87-1.238q.305-.308.526-.66c.45-.72.504-1.602.504-2.45l-.15.001h-2.774C15.944 18 14 16.264 14 14s1.944-4 4.215-4h2.773q.079 0 .151.002"
                opacity=".5" />
              <path fill="currentColor"
                d="M10.101 2.572L8 3.992l-1.733 1.16C7.405 5 8.859 5 10.694 5h2.112c1.838 0 3.294 0 4.433.153q.344.045.662.114L16 4l-2.113-1.428a3.42 3.42 0 0 0-3.786 0" />
            </svg>
            View Wallet
          </a>
        </li>
      </ul>
    </li>

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown ms-3">
      <button type="button" class="btn btn-label-secondary rounded-pill dropdown-toggle hide-arrow p-0"
        data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
          <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
            opacity=".5" />
          <path fill="white"
            d="M16.807 19.011A8.46 8.46 0 0 1 12 20.5a8.46 8.46 0 0 1-4.807-1.489c-.604-.415-.862-1.205-.51-1.848C7.41 15.83 8.91 15 12 15s4.59.83 5.318 2.163c.35.643.093 1.433-.511 1.848M12 12a3 3 0 1 0 0-6a3 3 0 0 0 0 6"
            opacity=".6" />
        </svg>
      </button>

      <ul class="dropdown-menu dropdown-menu-end dropdown-user">
        <li class="py-4">
          <span class="px-4">
            {{ Auth::user()->username }}
          </span>
        </li>
        <li>
          <div class="dropdown-divider mt-0 mb-4 mx-n2"></div>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('page-user-profile') }}">
            <svg class="me-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
              viewBox="0 0 24 24">
              <circle cx="12" cy="6" r="4" fill="currentColor" />
              <path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"
                opacity=".5" />
            </svg>
            <span class="align-middle">Profile</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('page-user-profile') }}">
            <svg class="me-3" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
              viewBox="0 0 24 24">
              <path fill="currentColor" d="M9.25 14a3 3 0 1 1 0 6a3 3 0 0 1 0-6m5-10a3 3 0 1 0 0 6a3 3 0 0 0 0-6" />
              <path fill="currentColor"
                d="M17.166 7.709a3 3 0 0 0-.021-1.5h4.605a.75.75 0 0 1 0 1.5zm-5.81-1.5a3 3 0 0 0-.022 1.5H1.75a.75.75 0 0 1 0-1.5zm-5 10H1.75a.75.75 0 0 0 0 1.5h4.584a3 3 0 0 1 .022-1.5m5.81 1.5h9.584a.75.75 0 0 0 0-1.5h-9.605a3 3 0 0 1 .02 1.5"
                opacity=".5" />
            </svg>
            <span class="align-middle">Manage Profile</span>
          </a>
        </li>
        <li>
          <div class="dropdown-divider my-4 mx-n2"></div>
        </li>
        @if (Auth::check())
          <li>
            <div class="d-grid px-2 pt-2 pb-1">
              <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <small class="align-middle">Logout</small>
                <i class="ti ti-logout ms-2 ti-14px"></i>
              </a>
            </div>
          </li>
          <form method="POST" id="logout-form" action="{{ route('logout') }}">
            @csrf
          </form>
        @else
          <li>
            <div class="d-grid px-2 pt-2 pb-1">
              <a class="btn btn-sm btn-danger d-flex"
                href="{{ Route::has('login') ? route('login') : url('auth/login') }}">
                <small class="align-middle">Login</small>
                <i class="ti ti-login ms-2 ti-14px"></i>
              </a>
            </div>
          </li>
        @endif
      </ul>
    </li>
    <!--/ User -->
  </ul>
</div>

@if (!isset($navbarDetached))
  </div>
@endif
</nav>
<!-- / Navbar -->
