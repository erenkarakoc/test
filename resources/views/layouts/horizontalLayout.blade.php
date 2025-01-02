@isset($pageConfigs)
  {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Route;
  use App\Models\UserBalances;

  $configData = Helper::appClasses();

  $user = Auth::user();
  $userBalance = UserBalances::where('user_id', $user->id)->get();
@endphp

@extends('layouts/commonMaster')
@php

  $menuHorizontal = true;
  $navbarFull = true;

  /* Display elements */
  $isNavbar = $isNavbar ?? true;
  $isMenu = $isMenu ?? true;
  $isFlex = $isFlex ?? false;
  $isFooter = $isFooter ?? true;
  $customizerHidden = $customizerHidden ?? '';

  /* HTML Classes */
  $menuFixed = isset($configData['menuFixed']) ? $configData['menuFixed'] : '';
  $navbarType = isset($configData['navbarType']) ? $configData['navbarType'] : '';
  $footerFixed = isset($configData['footerFixed']) ? $configData['footerFixed'] : '';
  $menuCollapsed = isset($configData['menuCollapsed']) ? $configData['menuCollapsed'] : '';

  /* Content classes */
  $container = $configData['contentLayout'] === 'compact' ? 'container-xxl' : 'container-fluid';
  $containerNav = $configData['contentLayout'] === 'compact' ? 'container-xxl' : 'container-fluid';

@endphp

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/helpers/gdzhelpers.js'])
@endsection

@section('layoutContent')
  <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">

      <!-- BEGIN: Navbar-->
      @if ($isNavbar)
        @include('layouts/sections/navbar/navbar')
      @endif
      <!-- END: Navbar-->

      <!-- Layout page -->
      <div class="layout-page">

        {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}
        <x-banner />

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <div class="{{ $container }} flex-grow-1 container-p-y">
            <div class="gdz-sidebar-layout nav-tabs-shadow nav-align-left">
              <!-- Sidebar -->
              <ul class="gdz-sidebar nav nav-tabs" role="tablist">
                <div class="gdz-sidebar-content">
                  <div class="px-5 mt-10">
                    <span class="gdz-sidebar-title text-primary-subtle">Main Balance</span>
                    <div class="gdz-main-balance">
                      <h3 class="text-primary fw-bold mb-0">
                        {{ number_format($userTotalBalance, 2) }}$
                      </h3>
                      <h5 class="text-primary-subtle mb-0 lh-1">
                        {{ number_format(convertUsdToEur($userTotalBalance), 2) }}€
                      </h5>
                    </div>
                  </div>

                  <div class="px-5 mt-5">
                    <div class="gdz-main-balance-change">
                      <span class="text-primary-subtle">Last 7 days</span>
                      <div class="gdz-main-balance-change-amount">
                        <span class="text-white">1.45$</span>
                        <span class="text-success">7.64%</span>
                      </div>
                    </div>
                    <div id="gdzMainBalanceChangeChart"></div>
                  </div>

                  <div class="px-5 mt-10 d-flex gap-2">
                    <a href="{{ route('page-add-funds') }}" class="btn btn-primary btn-sm w-50">Add Funds</a>
                    <a href="/send" class="btn btn-outline-primary btn-sm w-50">Send</a>
                  </div>

                  <li class="nav-item mt-10">
                    <a href="{{ route('page-dashboard') }}" @class([
                        'nav-link',
                        'active' => Route::currentRouteName() === 'page-dashboard',
                    ])>
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M2 17.5C2 15.379 2 14.318 2.659 13.659C3.318 13 4.379 13 6.5 13C8.621 13 9.682 13 10.341 13.659C11 14.318 11 15.379 11 17.5C11 19.621 11 20.682 10.341 21.341C9.682 22 8.621 22 6.5 22C4.379 22 3.318 22 2.659 21.341C2 20.682 2 19.621 2 17.5Z"
                          fill="currentColor" />
                        <path
                          d="M2 6.5C2 4.379 2 3.318 2.659 2.659C3.318 2 4.379 2 6.5 2C8.621 2 9.682 2 10.341 2.659C11 3.318 11 4.379 11 6.5C11 8.621 11 9.682 10.341 10.341C9.682 11 8.621 11 6.5 11C4.379 11 3.318 11 2.659 10.341C2 9.682 2 8.621 2 6.5Z"
                          fill="currentColor" />
                        <path opacity="0.5"
                          d="M13 6.5C13 4.379 13 3.318 13.659 2.659C14.318 2 15.379 2 17.5 2C19.621 2 20.682 2 21.341 2.659C22 3.318 22 4.379 22 6.5C22 8.621 22 9.682 21.341 10.341C20.682 11 19.621 11 17.5 11C15.379 11 14.318 11 13.659 10.341C13 9.682 13 8.621 13 6.5Z"
                          fill="currentColor" />
                        <path opacity="0.5"
                          d="M13 17.5C13 15.379 13 14.318 13.659 13.659C14.318 13 15.379 13 17.5 13C19.621 13 20.682 13 21.341 13.659C22 14.318 22 15.379 22 17.5C22 19.621 22 20.682 21.341 21.341C20.682 22 19.621 22 17.5 22C15.379 22 14.318 22 13.659 21.341C13 20.682 13 19.621 13 17.5Z"
                          fill="currentColor" />
                      </svg>
                      <span class="ms-2">Dashboard</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M8.422 20.618C10.178 21.54 11.056 22 12 22V12L2.638 7.073l-.04.067C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709z" />
                        <path fill="currentColor"
                          d="m17.577 4.432l-2-1.05C13.822 2.461 12.944 2 12 2c-.945 0-1.822.46-3.578 1.382l-2 1.05C4.318 5.536 3.242 6.1 2.638 7.072L12 12l9.362-4.927c-.606-.973-1.68-1.537-3.785-2.641"
                          opacity=".7" />
                        <path fill="currentColor"
                          d="m21.403 7.14l-.041-.067L12 12v10c.944 0 1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.597-1.014.597-2.277.597-4.8v-.117c0-2.525 0-3.788-.597-4.802"
                          opacity=".5" />
                      </svg>
                      <span class="ms-2">Strategy Packs</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5">
                          <path d="M2 12h7.5M22 12h-7.5" opacity=".5" />
                          <path
                            d="M20 15.684C20 19 17.735 22 16 22c-2.268 0-3.928-3.158-3.928-10S10.412 2 8.144 2c-1.734 0-4 3-4 6.316" />
                        </g>
                      </svg>
                      <span class="ms-2">Algorithms</span>
                    </button>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('page-team') }}" @class([
                        'nav-link',
                        'active' => Route::currentRouteName() === 'page-team',
                    ])>
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <circle cx="15" cy="6" r="3" fill="currentColor" opacity=".4" />
                        <ellipse cx="16" cy="17" fill="currentColor" opacity=".4" rx="5"
                          ry="3" />
                        <circle cx="9.001" cy="6" r="4" fill="currentColor" />
                        <ellipse cx="9.001" cy="17.001" fill="currentColor" rx="7" ry="4" />
                      </svg>
                      <span class="ms-2">Team</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('page-transactions') }}" @class([
                        'nav-link',
                        'active' => Route::currentRouteName() === 'page-transactions',
                    ])>
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M3.464 20.536C4.93 22 7.286 22 12 22s7.071 0 8.535-1.465C22 19.072 22 16.714 22 12s0-7.071-1.465-8.536C19.072 2 16.714 2 12 2S4.929 2 3.464 3.464C2 4.93 2 7.286 2 12s0 7.071 1.464 8.535"
                          opacity=".5" />
                        <path fill="currentColor"
                          d="M13.25 7a.75.75 0 0 1 1.315-.493l3 3.437a.75.75 0 0 1-1.13.987L14.75 9v8a.75.75 0 0 1-1.5 0zm-5.685 6.07a.75.75 0 1 0-1.13.986l3 3.437A.75.75 0 0 0 10.75 17V7a.75.75 0 0 0-1.5 0v8z" />
                      </svg>
                      <span class="ms-2">Transactions</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M12.428 2c-1.114 0-2.129.6-4.157 1.802l-.686.406C5.555 5.41 4.542 6.011 3.985 7c-.557.99-.557 2.19-.557 4.594v.812c0 2.403 0 3.605.557 4.594s1.57 1.59 3.6 2.791l.686.407C10.299 21.399 11.314 22 12.428 22s2.128-.6 4.157-1.802l.686-.407c2.028-1.2 3.043-1.802 3.6-2.791c.557-.99.557-2.19.557-4.594v-.812c0-2.403 0-3.605-.557-4.594s-1.572-1.59-3.6-2.792l-.686-.406C14.555 2.601 13.542 2 12.428 2"
                          clip-rule="evenodd" opacity=".5" />
                        <path fill="currentColor" d="M12.428 8.25a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5" />
                      </svg>
                      <span class="ms-2">Settings</span>
                    </button>
                  </li>
                  <li class="nav-item mt-10">
                    <button type="button" class="nav-link">
                      <svg width="22" height="22" viewBox="0 0 500 500" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M0 114.679C0 51.3434 51.3435 0 114.679 0H385.494C448.829 0 500.172 51.3435 500.172 114.679V385.321C500.172 448.657 448.829 500 385.494 500H114.679C51.3434 500 0 448.657 0 385.321V114.679Z"
                          fill="#7E3EFF" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M377.239 30H122.761C71.5354 30 30 71.5422 30 122.798V377.202C30 428.458 71.5354 470 122.761 470H377.239C428.465 470 470 428.458 470 377.202V122.798C470 71.5423 428.465 30 377.239 30ZM122.761 15C63.2463 15 15 63.2628 15 122.798V377.202C15 436.737 63.2462 485 122.761 485H377.239C436.754 485 485 436.737 485 377.202V122.798C485 63.2629 436.754 15 377.239 15H122.761Z"
                          fill="url(#paint0_linear_777_85)" />
                        <path
                          d="M214.578 103.211C214.578 132.737 202.844 161.054 181.959 181.932C161.074 202.81 132.747 214.539 103.211 214.539V288.758H214.578V400.086H288.822C288.822 370.56 300.555 342.243 321.44 321.365C342.326 300.487 370.652 288.758 400.188 288.758V214.539H288.822V103.211H214.578Z"
                          fill="url(#paint1_linear_777_85)" />
                        <defs>
                          <linearGradient id="paint0_linear_777_85" x1="250.086" y1="0" x2="250.086"
                            y2="500" gradientUnits="userSpaceOnUse">
                            <stop stop-color="white" stop-opacity="0.3" />
                            <stop offset="1" stop-color="white" stop-opacity="0" />
                          </linearGradient>
                          <linearGradient id="paint1_linear_777_85" x1="251.7" y1="103.211" x2="251.7"
                            y2="400.086" gradientUnits="userSpaceOnUse">
                            <stop stop-color="white" stop-opacity="0.9" />
                            <stop offset="1" stop-color="white" stop-opacity="0.7" />
                          </linearGradient>
                        </defs>
                      </svg>
                      <span class="lh-1 ms-2">Swap GDZ</span>
                      <span class="badge rounded-pill bg-primary ms-2 lh-1"
                        style="font-size: 8px; letter-spacing: 1px;">NEW</span>
                    </button>
                  </li>
                  <li class="nav-item my-10">
                    <a href="/" class="nav-link" role="tab" data-bs-toggle="tab"
                      data-bs-target="#navs-left-align-messages">
                      <span class="lh-1">Go to Home</span>
                    </a>
                  </li>
                </div>
              </ul>
              <!-- Sidebar -->

              <!-- Content -->
              <div class="tab-content">
                <div class="tab-pane fade show active">
                  @yield('content')
                </div>
              </div>
              <!-- / Content -->
            </div>
          </div>

          <!-- Footer -->
          @if ($isFooter)
            @include('layouts/sections/footer/footer')
          @endif
          <!-- / Footer -->
          <div class="content-backdrop fade"></div>
        </div>
        <!--/ Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <!-- / Layout Container -->

    @if ($isMenu)
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    @endif
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->
@endsection
