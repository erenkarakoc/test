@isset($pageConfigs)
  {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Route;
  use App\Models\UserBalances;
  use App\Models\MarketData;
  use App\Models\Transaction;

  $configData = Helper::appClasses();

  $user = Auth::user();
  $userBalance = UserBalances::where('user_id', $user->id)->get();

  $last7DaysTrades = Transaction::where('user_id', $user->id)
      ->where('type', 'trade')
      ->where('status', 'completed')
      ->where('created_at', '>=', now()->subDays(7))
      ->get();
  $last7DaysPnl = $last7DaysTrades->sum('amount_in_usd');

  $totalReceived = Transaction::where('user_id', $user->id)
      ->where('type', 'received')
      ->where('status', 'completed')
      ->sum('amount_in_usd');

  $last7DaysPnlPercentage = $totalReceived != 0 ? ($last7DaysPnl / $totalReceived) * 100 : 0;
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

        {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use
      jetstream. --}}
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
                        {{ formatUsdBalance($userTotalBalance) }}$
                      </h3>
                      <h5 class="text-primary-subtle mb-0 lh-1">
                        {{ formatUsdBalance($userTotalBalance * MarketData::where('asset', 'EUR')->value('price')) }}€
                      </h5>
                    </div>
                  </div>

                  <div class="px-5 mt-5">
                    <div class="gdz-main-balance-change">
                      <span class="text-primary-subtle">Last 7 days</span>
                      <div class="gdz-main-balance-change-amount">

                        <span
                          @class([
                              'text-success' => $last7DaysPnlPercentage > 0,
                              'text-danger' => $last7DaysPnlPercentage < 0,
                              'text-white' => $last7DaysPnlPercentage == 0,
                          ])>{{ $last7DaysPnlPercentage > 0 ? '+' : '' }}{{ formatUsdBalance($last7DaysPnl) }}$</span>
                        <span @class([
                            'text-success' => $last7DaysPnlPercentage > 0,
                            'text-danger' => $last7DaysPnlPercentage < 0,
                            'text-white' => $last7DaysPnlPercentage == 0,
                        ])>
                          {{ formatUsdBalance($last7DaysPnlPercentage) }}%
                        </span>

                      </div>
                    </div>
                    <div id="gdzMainBalanceChangeChart"></div>
                  </div>

                  <div class="px-5 mt-10 d-flex gap-2">
                    <a href="{{ route('page-wallet') }}?tab=add-funds" class="btn btn-primary btn-sm w-50">Add Funds</a>
                    <a href="{{ route('page-wallet') }}?tab=send" class="btn btn-outline-primary btn-sm w-50">Send</a>
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
                    <a href="{{ route('page-algorithms') }}" @class([
                        'nav-link',
                        'active' => Route::currentRouteName() === 'page-algorithms',
                    ])>
                      <svg width="20" height="20" viewBox="0 0 314 314" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M131.72 33.7288L58.7833 138.531C54.926 144.075 52.9973 150.538 53 157L157.937 157V20C148.015 20 138.091 24.5758 131.72 33.7288Z"
                          fill="currentColor" fill-opacity="0.8" />
                        <path
                          d="M131.72 280.272L58.7833 175.468C54.926 169.924 52.9973 163.462 53 157L157.937 157L157.937 294C148.015 294 138.091 289.424 131.72 280.272Z"
                          fill="currentColor" fill-opacity="0.65" />
                        <path
                          d="M183.935 280.272L256.264 175.468C260.09 169.924 262.002 163.462 262 157H157.937L157.937 294C167.778 294 177.618 289.424 183.935 280.272Z"
                          fill="currentColor" fill-opacity="0.8" />
                        <path
                          d="M183.935 33.7288L256.264 138.531C260.09 144.075 262.002 150.538 262 157H157.937V20C167.778 20 177.618 24.5758 183.935 33.7288Z"
                          fill="currentColor" fill-opacity="0.95" />
                      </svg>
                      <span class="ms-2">Algorithms</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('page-strategy-packs') }}" @class([
                        'nav-link',
                        'active' => Route::currentRouteName() === 'page-strategy-packs',
                    ])>
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
                    <a href="{{ route('page-bundled-packs') }}" @class([
                        'nav-link',
                        'active' => Route::currentRouteName() === 'page-bundled-packs',
                    ])>
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M8.422 20.6173C10.178 21.5393 11.056 21.9993 12 21.9993V11.9993L2.638 7.07227L2.598 7.13927C2 8.15327 2 9.41627 2 11.9413V12.0583C2 14.5823 2 15.8453 2.597 16.8593C3.195 17.8743 4.271 18.4393 6.422 19.5683L8.422 20.6173Z"
                          fill="currentColor" />
                        <path opacity="0.7"
                          d="M17.5767 4.432L15.5767 3.382C13.8217 2.461 12.9437 2 11.9997 2C11.0547 2 10.1777 2.46 8.4217 3.382L6.4217 4.432C4.3177 5.536 3.2417 6.1 2.6377 7.072L11.9997 12L21.3617 7.073C20.7557 6.1 19.6817 5.536 17.5767 4.432Z"
                          fill="currentColor" />
                        <path opacity="0.5"
                          d="M21.403 7.13927L21.362 7.07227L12 11.9993V21.9993C12.944 21.9993 13.822 21.5393 15.578 20.6173L17.578 19.5673C19.729 18.4383 20.805 17.8743 21.403 16.8593C22 15.8453 22 14.5823 22 12.0593V11.9423C22 9.41727 22 8.15327 21.403 7.13927Z"
                          fill="currentColor" />
                        <path
                          d="M6.42324 4.43244L6.32324 4.48444L15.3872 9.46944C15.3872 9.46944 15.7581 9.63415 16.014 9.89009C16.3037 10.1798 16.2502 10.7144 16.2502 10.7144V13.0004C16.2502 13.1994 16.3293 13.3901 16.4699 13.5308C16.6106 13.6714 16.8013 13.7504 17.0002 13.7504C17.1992 13.7504 17.3899 13.6714 17.5306 13.5308C17.6712 13.3901 17.7502 13.1994 17.7502 13.0004V9.96444C17.7502 9.96444 17.7275 9.35797 17.5306 9.10388C17.3381 8.8556 17.0162 8.65344 17.0162 8.65344L7.91624 3.64844L6.42324 4.43244Z"
                          fill="currentColor" />
                      </svg>
                      <span class="ms-2">Bundled Packs</span>
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
                  <li class="nav-item mt-10 d-none">
                    <button type="button" class="nav-link">
                      <svg width="24" height="24" viewBox="0 0 500 500" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M500 385.321C500 448.657 448.674 500 385.361 500L114.639 500C51.3257 500 -5.53696e-06 448.656 0 385.321L2.36603e-05 114.679C2.91973e-05 51.3434 51.3258 -5.53505e-06 114.639 0L385.361 2.36672e-05C448.674 2.92023e-05 500 51.3435 500 114.679L500 385.321Z"
                          fill="#7E3EFF" />
                        <path
                          d="M221.02 108.733L137.613 228.835C133.202 235.189 130.997 242.594 131 250L251 250L251 93C239.653 93 228.305 98.2438 221.02 108.733Z"
                          fill="white" fill-opacity="0.8" />
                        <path
                          d="M221.02 391.267L137.613 271.165C133.202 264.811 130.997 257.405 131 250L251 250L251 407C239.653 407.001 228.305 401.756 221.02 391.267Z"
                          fill="white" fill-opacity="0.65" />
                        <path
                          d="M280.729 391.267L363.44 271.165C367.816 264.811 370.003 257.405 370 250H251L251 407C262.253 407.001 273.506 401.756 280.729 391.267Z"
                          fill="white" fill-opacity="0.8" />
                        <path
                          d="M280.729 108.733L363.44 228.835C367.816 235.189 370.003 242.594 370 250H251L251 93C262.253 93 273.506 98.2438 280.729 108.733Z"
                          fill="white" fill-opacity="0.95" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M377.239 30H122.761C71.5354 30 30 71.5422 30 122.798V377.202C30 428.458 71.5354 470 122.761 470H377.239C428.465 470 470 428.458 470 377.202V122.798C470 71.5423 428.465 30 377.239 30ZM122.761 15C63.2463 15 15 63.2628 15 122.798V377.202C15 436.737 63.2462 485 122.761 485H377.239C436.754 485 485 436.737 485 377.202V122.798C485 63.2629 436.754 15 377.239 15H122.761Z"
                          fill="url(#paint0_linear_1015_79)" />
                        <defs>
                          <linearGradient id="paint0_linear_1015_79" x1="250" y1="0" x2="250"
                            y2="500" gradientUnits="userSpaceOnUse">
                            <stop stop-color="white" stop-opacity="0.4" />
                            <stop offset="1" stop-color="white" stop-opacity="0" />
                          </linearGradient>
                        </defs>
                      </svg>
                      <span class="lh-1 ms-2">Swap GDZ</span>
                      <span class="badge rounded-pill bg-primary ms-2 lh-1"
                        style="font-size: 8px; letter-spacing: 1px;">SOON</span>
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


    <div class="gdz-sidebar-trade-wrapper">
    </div>

    @if ($isMenu)
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    @endif
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->

  <x-swap-modal />
@endsection
