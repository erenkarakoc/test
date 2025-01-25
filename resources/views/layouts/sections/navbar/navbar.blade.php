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

    <li class="nav-item position-relative">
      <button type="button" class="btn btn-sm text-gray dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
          <path fill="currentColor"
            d="M18.75 9v.704c0 .845.24 1.671.692 2.374l1.108 1.723c1.011 1.574.239 3.713-1.52 4.21a25.8 25.8 0 0 1-14.06 0c-1.759-.497-2.531-2.636-1.52-4.21l1.108-1.723a4.4 4.4 0 0 0 .693-2.374V9c0-3.866 3.022-7 6.749-7s6.75 3.134 6.75 7"
            opacity=".5" />
          <path fill="currentColor"
            d="M12.75 6a.75.75 0 0 0-1.5 0v4a.75.75 0 0 0 1.5 0zM7.243 18.545a5.002 5.002 0 0 0 9.513 0c-3.145.59-6.367.59-9.513 0" />
        </svg>
      </button>
      <span
        class="badge rounded-pill badge-center h-px-18 w-px-18 bg-label-primary pt-50 position-absolute user-select-none"
        style="pointer-events: none; top: -2px; right: 4px;">
        3
      </span>
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
            <a href="{{ route('page-wallet') }}?tab=add-funds" class="btn btn-primary btn-sm w-50">Add Funds</a>
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
                          <span class="me-2">
                            {!! $walletSmallIcons[$wallet['wallet']] !!}
                          </span>
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
