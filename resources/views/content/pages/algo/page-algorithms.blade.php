@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Algorithms')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/algorithms.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/algorithms.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="page-algorithms">
    @csrf

    <div class="row">
      <div class="col col-8">
        <h5 class="mb-3 lh-1">Algorithms</h5>
        <p class="lh-1 mb-7">Explore a wide range of trading algorithms and build your own strategy</p>
      </div>
      <div class="col col-4">
        <h6 class="mb-2 lh-1">Strategy Packs</h6>
        <small class="lh-1 mb-7">Choose a pre-built strategy pack and start your journey</small>
      </div>
    </div>

    <div class="row">
      <div class="col col-4">
        <div
          class="card bg-light border bg-glow wallet-item wallet-item-{{ $userBalances->where('wallet', 'GDZ')->value('wallet') }}">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                {!! $walletIconSymbols['GDZ'] ?? '' !!}
                <h6 class="mb-0 text-white wallet-item-title">
                  {{ $userBalances->where('wallet', 'GDZ')->value('title') }}
                </h6>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  {{ number_format($userBalances->where('wallet', 'GDZ')->value('balance') * $marketDataPrices['GDZ'], 2) }}$
                </h5>
                <small class="text-dark">
                  {{ number_format($userBalances->where('wallet', 'GDZ')->value('balance'), 2) }}
                  {{ $userBalances->where('wallet', 'GDZ')->value('wallet') }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-4">
        <div class="card bg-light border bg-glow h-100 p-4">
          <div class="d-flex justify-content-between align-items-center h-100">
            <div class="d-flex align-items-center gap-2">
              <div class="d-flex justify-content-center align-items-center" style="height: 36px; width: 36px;">
                <svg class="flex-shrink-0 text-white" width="22" height="22" viewBox="0 0 250 227" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M112.548 6.91449L75.9055 59.6981C73.9676 62.4905 72.9986 65.7453 73 69L125.72 69V0C120.735 -4.35961e-07 115.749 2.3046 112.548 6.91449Z"
                    fill="currentColor" fill-opacity="0.8" />
                  <path
                    d="M112.548 131.086L75.9055 78.3016C73.9676 75.5093 72.9986 72.2545 73 69L125.72 69L125.72 138C120.735 138 115.749 135.695 112.548 131.086Z"
                    fill="currentColor" fill-opacity="0.65" />
                  <path
                    d="M138.781 131.086L175.118 78.3016C177.041 75.5093 178.001 72.2545 178 69H125.72L125.72 138C130.663 138 135.607 135.695 138.781 131.086Z"
                    fill="currentColor" fill-opacity="0.8" />
                  <path
                    d="M138.781 6.91449L175.118 59.6981C177.041 62.4905 178.001 65.7453 178 69H125.72V0C130.663 4.32352e-07 135.607 2.3046 138.781 6.91449Z"
                    fill="currentColor" fill-opacity="0.95" />
                  <path
                    d="M39.5485 95.9145L2.9055 148.698C0.967592 151.491 -0.00136684 154.745 1.44831e-06 158L52.7197 158V89C47.7346 89 42.7489 91.3046 39.5485 95.9145Z"
                    fill="currentColor" fill-opacity="0.8" />
                  <path
                    d="M39.5485 220.086L2.9055 167.302C0.967593 164.509 -0.00136741 161.255 1.44831e-06 158L52.7197 158L52.7197 227C47.7346 227 42.7489 224.695 39.5485 220.086Z"
                    fill="currentColor" fill-opacity="0.65" />
                  <path
                    d="M65.7807 220.086L102.118 167.302C104.041 164.509 105.001 161.255 105 158H52.7197L52.7197 227C57.6634 227 62.6072 224.695 65.7807 220.086Z"
                    fill="currentColor" fill-opacity="0.8" />
                  <path
                    d="M65.7807 95.9145L102.118 148.698C104.041 151.491 105.001 154.745 105 158H52.7197V89C57.6634 89 62.6072 91.3046 65.7807 95.9145Z"
                    fill="currentColor" fill-opacity="0.95" />
                  <path
                    d="M184.548 95.9145L147.906 148.698C145.968 151.491 144.999 154.745 145 158L197.72 158V89C192.735 89 187.749 91.3046 184.548 95.9145Z"
                    fill="currentColor" fill-opacity="0.8" />
                  <path
                    d="M184.548 220.086L147.906 167.302C145.968 164.509 144.999 161.255 145 158L197.72 158V227C192.735 227 187.749 224.695 184.548 220.086Z"
                    fill="currentColor" fill-opacity="0.65" />
                  <path
                    d="M210.781 220.086L247.118 167.302C249.041 164.509 250.001 161.255 250 158H197.72V227C202.663 227 207.607 224.695 210.781 220.086Z"
                    fill="currentColor" fill-opacity="0.8" />
                  <path
                    d="M210.781 95.9145L247.118 148.698C249.041 151.491 250.001 154.745 250 158H197.72V89C202.663 89 207.607 91.3046 210.781 95.9145Z"
                    fill="currentColor" fill-opacity="0.95" />
                </svg>
              </div>
              <h6 class="mb-0 text-white wallet-item-title">
                Gems
              </h6>
            </div>
            <div class="d-flex flex-column align-items-start text-right">
              <h5 class="mb-0 text-white">0</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-4">
        <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg" id="gdzStrategiesCard">
          <div class="swiper-wrapper">
            @foreach ($strategyPacks as $strategyPack)
              <div class="swiper-slide">
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex justify-content-between">
                      <div class="h6 d-flex align-items-center text-white mb-0">
                        <img src="{{ asset('assets/img/illustrations/' . strtolower($strategyPack->title) . '.png') }}"
                          alt="{{ $strategyPack->title }}" height="30" class="strategy-pack-img">
                        <span class="ms-3">
                          {{ $strategyPack->title }}
                        </span>
                        <small class="fw-medium ms-2 strategy-pack-text-bg" data-bs-toggle="popover"
                          data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                          data-bs-content="Total contribution rate of algorithms">
                          ≈{{ $strategyPack->total_contribution_rate }}%
                        </small>
                      </div>
                      <a href="{{ route('page-strategy-packs', ['strategy_pack' => $strategyPack->title]) }}"
                        class="strategy-pack-btn">
                        View
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>

    <div class="nav-tabs-shadow nav-align-left row mt-12" id="algorithms-nav">
      <div class="col col-md-3">
        <div id="left-sidebar">
          <ul class="nav nav-tabs bg-light flex-column" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link active" data-tab-title="Basic Algorithms"
                data-tab-subtitle="Basic algorithms that are essential for an efficient strategy" role="tab"
                data-bs-toggle="tab" data-bs-target="#basic" aria-controls="basic" aria-selected="true">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                    opacity=".5" />
                  <path fill="currentColor"
                    d="M6.424 9.52a.75.75 0 0 1 1.056-.096l.277.23c.605.504 1.12.933 1.476 1.328c.379.42.674.901.674 1.518s-.295 1.099-.674 1.518c-.356.395-.871.824-1.476 1.328l-.277.23a.75.75 0 1 1-.96-1.152l.234-.195c.659-.55 1.09-.91 1.366-1.216c.262-.29.287-.427.287-.513s-.025-.222-.287-.513c-.277-.306-.707-.667-1.366-1.216l-.234-.195a.75.75 0 0 1-.096-1.056M17.75 15a.75.75 0 0 1-.75.75h-5a.75.75 0 0 1 0-1.5h5a.75.75 0 0 1 .75.75" />
                </svg>
                Basic Algorithms
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" data-tab-title="Trend-Following Models"
                data-tab-subtitle="Designed to identify and capitalize on sustained market movements in a specific direction"
                role="tab" data-bs-toggle="tab" data-bs-target="#tf" aria-controls="tf" aria-selected="false">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                    opacity=".5" />
                  <path fill="currentColor"
                    d="M14.5 10.75a.75.75 0 0 1 0-1.5H17a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-1.5 0v-.69l-2.013 2.013a1.75 1.75 0 0 1-2.474 0l-1.586-1.586a.25.25 0 0 0-.354 0L7.53 14.53a.75.75 0 0 1-1.06-1.06l2.293-2.293a1.75 1.75 0 0 1 2.474 0l1.586 1.586a.25.25 0 0 0 .354 0l2.012-2.013z" />
                </svg>
                Trend-Following
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" data-tab-title="Mean Reversion"
                data-tab-subtitle="Algorithms that exploit deviations from historical averages." role="tab"
                data-bs-toggle="tab" data-bs-target="#mr" aria-controls="mr" aria-selected="false">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M12 22c-4.714 0-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22"
                    opacity=".5" />
                  <path fill="currentColor"
                    d="M12 5.25a.75.75 0 0 1 .75.75v12a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75m-5 3a.75.75 0 0 1 .75.75v9a.75.75 0 0 1-1.5 0V9A.75.75 0 0 1 7 8.25m10 4a.75.75 0 0 1 .75.75v5a.75.75 0 0 1-1.5 0v-5a.75.75 0 0 1 .75-.75" />
                </svg>
                Mean Reversion
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" data-tab-title="Market Structure & Execution"
                data-tab-subtitle="Algorithms that analyze market microstructure and optimize trade execution for better outcomes"
                role="tab" data-bs-toggle="tab" data-bs-target="#mse" aria-controls="mse" aria-selected="false">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                    opacity=".5" />
                  <path fill="currentColor"
                    d="M17.576 10.48a.75.75 0 0 0-1.152-.96l-1.797 2.156c-.37.445-.599.716-.786.885a.8.8 0 0 1-.163.122l-.011.005l-.008-.004l-.003-.001a.8.8 0 0 1-.164-.122c-.187-.17-.415-.44-.786-.885l-.292-.35c-.328-.395-.625-.75-.901-1c-.301-.272-.68-.514-1.18-.514s-.878.242-1.18.514c-.276.25-.572.605-.9 1l-1.83 2.194a.75.75 0 0 0 1.153.96l1.797-2.156c.37-.445.599-.716.786-.885a.8.8 0 0 1 .163-.122l.007-.003l.004-.001q.004 0 .011.004a.8.8 0 0 1 .164.122c.187.17.415.44.786.885l.292.35c.329.395.625.75.901 1c.301.272.68.514 1.18.514s.878-.242 1.18-.514c.276-.25.572-.605.9-1z" />
                </svg>
                MS & Execution
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" data-tab-title="Machine Learning & Predictive Models"
                data-tab-subtitle="Data-driven methodologies that leverage machine learning to forecast market behavior and inform trading decisions"
                role="tab" data-bs-toggle="tab" data-bs-target="#mlp" aria-controls="mlp" aria-selected="false">
                <svg class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                    d="M2.00007 11.5L2 12C2 12.3458 2 12.679 2.00058 13C2.00788 17.0552 2.1074 19.1793 3.464 20.535C4.929 22 7.286 22 12 22C16.714 22 19.072 22 20.535 20.535C21.8925 19.1784 21.9921 17.055 21.9994 13C22 12.679 22 12.3458 22 12L21.9999 11.5C21.9981 7.11753 21.9473 4.87723 20.535 3.464C19.071 2 16.714 2 12 2C7.286 2 4.93 2 3.464 3.464C2.0527 4.87626 2.0019 7.11746 2.00007 11.5ZM2.00007 11.5L2.00058 13H21.9994L21.9999 11.5H2.00007Z"
                    fill="currentColor" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M22 13H2V11.5H22V13Z" fill="currentColor" />
                  <path
                    d="M12.75 16.75C12.75 16.5511 12.829 16.3603 12.9697 16.2197C13.1103 16.079 13.3011 16 13.5 16H18C18.1989 16 18.3897 16.079 18.5303 16.2197C18.671 16.3603 18.75 16.5511 18.75 16.75C18.75 16.9489 18.671 17.1397 18.5303 17.2803C18.3897 17.421 18.1989 17.5 18 17.5H13.5C13.3011 17.5 13.1103 17.421 12.9697 17.2803C12.829 17.1397 12.75 16.9489 12.75 16.75ZM12.75 7.75C12.75 7.55109 12.829 7.36032 12.9697 7.21967C13.1103 7.07902 13.3011 7 13.5 7H18C18.1989 7 18.3897 7.07902 18.5303 7.21967C18.671 7.36032 18.75 7.55109 18.75 7.75C18.75 7.94891 18.671 8.13968 18.5303 8.28033C18.3897 8.42098 18.1989 8.5 18 8.5H13.5C13.3011 8.5 13.1103 8.42098 12.9697 8.28033C12.829 8.13968 12.75 7.94891 12.75 7.75ZM6 18.5C5.80109 18.5 5.61032 18.421 5.46967 18.2803C5.32902 18.1397 5.25 17.9489 5.25 17.75V15.75C5.25 15.5511 5.32902 15.3603 5.46967 15.2197C5.61032 15.079 5.80109 15 6 15C6.19891 15 6.38968 15.079 6.53033 15.2197C6.67098 15.3603 6.75 15.5511 6.75 15.75V17.75C6.75 17.9489 6.67098 18.1397 6.53033 18.2803C6.38968 18.421 6.19891 18.5 6 18.5ZM6 9.5C5.80109 9.5 5.61032 9.42098 5.46967 9.28033C5.32902 9.13968 5.25 8.94891 5.25 8.75V6.75C5.25 6.55109 5.32902 6.36032 5.46967 6.21967C5.61032 6.07902 5.80109 6 6 6C6.19891 6 6.38968 6.07902 6.53033 6.21967C6.67098 6.36032 6.75 6.55109 6.75 6.75V8.75C6.75 8.94891 6.67098 9.13968 6.53033 9.28033C6.38968 9.42098 6.19891 9.5 6 9.5ZM9 18.5C8.80109 18.5 8.61032 18.421 8.46967 18.2803C8.32902 18.1397 8.25 17.9489 8.25 17.75V15.75C8.25 15.5511 8.32902 15.3603 8.46967 15.2197C8.61032 15.079 8.80109 15 9 15C9.19891 15 9.38968 15.079 9.53033 15.2197C9.67098 15.3603 9.75 15.5511 9.75 15.75V17.75C9.75 17.9489 9.67098 18.1397 9.53033 18.2803C9.38968 18.421 9.19891 18.5 9 18.5ZM9 9.5C8.80109 9.5 8.61032 9.42098 8.46967 9.28033C8.32902 9.13968 8.25 8.94891 8.25 8.75V6.75C8.25 6.55109 8.32902 6.36032 8.46967 6.21967C8.61032 6.07902 8.80109 6 9 6C9.19891 6 9.38968 6.07902 9.53033 6.21967C9.67098 6.36032 9.75 6.55109 9.75 6.75V8.75C9.75 8.94891 9.67098 9.13968 9.53033 9.28033C9.38968 9.42098 9.19891 9.5 9 9.5Z"
                    fill="currentColor" />
                </svg>
                ML & Predictive
              </button>
            </li>
          </ul>

          <div class="d-flex flex-column row-gap-2 mt-4">
            <button type="button" class="btn btn-sm btn-label-primary rounded w-100 justify-content-start text-left"
              data-bs-toggle="modal" data-bs-target="#buildGuideModal">
              <svg class="me-2 ms-2" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M4.727 2.733c.306-.308.734-.508 1.544-.618C7.105 2.002 8.209 2 9.793 2h4.414c1.584 0 2.688.002 3.522.115c.81.11 1.238.31 1.544.618c.305.308.504.74.613 1.557c.112.84.114 1.955.114 3.552V18H7.426c-1.084 0-1.462.006-1.753.068c-.513.11-.96.347-1.285.667c-.11.108-.164.161-.291.505A1.3 1.3 0 0 0 4 19.7V7.842c0-1.597.002-2.711.114-3.552c.109-.816.308-1.249.613-1.557"
                  opacity=".5" />
                <path fill="currentColor"
                  d="M20 18H7.426c-1.084 0-1.462.006-1.753.068c-.513.11-.96.347-1.285.667c-.11.108-.164.161-.291.505s-.107.489-.066.78l.022.15c.11.653.31.998.616 1.244c.307.246.737.407 1.55.494c.837.09 1.946.092 3.536.092h4.43c1.59 0 2.7-.001 3.536-.092c.813-.087 1.243-.248 1.55-.494c.2-.16.354-.362.467-.664H8a.75.75 0 0 1 0-1.5h11.975c.018-.363.023-.776.025-1.25M7.25 7A.75.75 0 0 1 8 6.25h8a.75.75 0 0 1 0 1.5H8A.75.75 0 0 1 7.25 7M8 9.75a.75.75 0 0 0 0 1.5h5a.75.75 0 0 0 0-1.5z" />
              </svg>
              <span>
                Build Guide
              </span>
            </button>
            <button type="button" class="d-none btn btn-sm btn-label-primary rounded w-100 justify-content-start">
              <svg class="me-2 ms-2" width="22" height="22" viewBox="0 0 250 227" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M112.548 6.91449L75.9055 59.6981C73.9676 62.4905 72.9986 65.7453 73 69L125.72 69V0C120.735 -4.35961e-07 115.749 2.3046 112.548 6.91449Z"
                  fill="currentColor" fill-opacity="0.8" />
                <path
                  d="M112.548 131.086L75.9055 78.3016C73.9676 75.5093 72.9986 72.2545 73 69L125.72 69L125.72 138C120.735 138 115.749 135.695 112.548 131.086Z"
                  fill="currentColor" fill-opacity="0.65" />
                <path
                  d="M138.781 131.086L175.118 78.3016C177.041 75.5093 178.001 72.2545 178 69H125.72L125.72 138C130.663 138 135.607 135.695 138.781 131.086Z"
                  fill="currentColor" fill-opacity="0.8" />
                <path
                  d="M138.781 6.91449L175.118 59.6981C177.041 62.4905 178.001 65.7453 178 69H125.72V0C130.663 4.32352e-07 135.607 2.3046 138.781 6.91449Z"
                  fill="currentColor" fill-opacity="0.95" />
                <path
                  d="M39.5485 95.9145L2.9055 148.698C0.967592 151.491 -0.00136684 154.745 1.44831e-06 158L52.7197 158V89C47.7346 89 42.7489 91.3046 39.5485 95.9145Z"
                  fill="currentColor" fill-opacity="0.8" />
                <path
                  d="M39.5485 220.086L2.9055 167.302C0.967593 164.509 -0.00136741 161.255 1.44831e-06 158L52.7197 158L52.7197 227C47.7346 227 42.7489 224.695 39.5485 220.086Z"
                  fill="currentColor" fill-opacity="0.65" />
                <path
                  d="M65.7807 220.086L102.118 167.302C104.041 164.509 105.001 161.255 105 158H52.7197L52.7197 227C57.6634 227 62.6072 224.695 65.7807 220.086Z"
                  fill="currentColor" fill-opacity="0.8" />
                <path
                  d="M65.7807 95.9145L102.118 148.698C104.041 151.491 105.001 154.745 105 158H52.7197V89C57.6634 89 62.6072 91.3046 65.7807 95.9145Z"
                  fill="currentColor" fill-opacity="0.95" />
                <path
                  d="M184.548 95.9145L147.906 148.698C145.968 151.491 144.999 154.745 145 158L197.72 158V89C192.735 89 187.749 91.3046 184.548 95.9145Z"
                  fill="currentColor" fill-opacity="0.8" />
                <path
                  d="M184.548 220.086L147.906 167.302C145.968 164.509 144.999 161.255 145 158L197.72 158V227C192.735 227 187.749 224.695 184.548 220.086Z"
                  fill="currentColor" fill-opacity="0.65" />
                <path
                  d="M210.781 220.086L247.118 167.302C249.041 164.509 250.001 161.255 250 158H197.72V227C202.663 227 207.607 224.695 210.781 220.086Z"
                  fill="currentColor" fill-opacity="0.8" />
                <path
                  d="M210.781 95.9145L247.118 148.698C249.041 151.491 250.001 154.745 250 158H197.72V89C202.663 89 207.607 91.3046 210.781 95.9145Z"
                  fill="currentColor" fill-opacity="0.95" />
              </svg>
              What are Gems?
            </button>
          </div>
        </div>
      </div>

      <div class="col col-md-4">
        <div class="tab-content pt-0 ps-0">
          <h6 class="mb-2 lh-1" data-tab-element="title">Basic Algorithms</h6>
          <small class="lh-1 mb-7" data-tab-element="subtitle">
            Basic algorithms that are essential for an efficient strategy
          </small>

          <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic"
            tabindex="0">
            <div class="row row-gap-4 mt-7">
              @foreach ($algorithms->where('category', 'BASIC') as $algorithm)
                <div class="col col-12">
                  <div class="algorithm-item p-4 rounded" data-title="{{ $algorithm->title }}"
                    data-subtitle="{{ $algorithm->subtitle }}"
                    data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}"
                    data-category="{{ $algorithm->category }}">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="d-flex align-items-center w-100">
                        <img class="algorithm-item-icon algorithm-item-icon-{{ $algorithm->icon }}"
                          src="{{ asset('assets/img/illustrations/algorithms/algorithm-' . $algorithm->icon . '.svg') }}"
                          alt="{{ $algorithm->title }}" draggable="false">
                        <div class="d-flex flex-column w-100">
                          <h5 class="d-flex justify-content-between w-100 text-heading mb-1 fw-bold lh-1">
                            <span class="notranslate">{{ $algorithm->title }}</span>
                            <div class="d-flex align-items-center">
                              <div class="popover-trigger text-light cursor-pointer me-1" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                                data-bs-content="Contribution rate to your current strategy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                    opacity=".3" />
                                  <path fill="currentColor"
                                    d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                </svg>
                              </div>
                              <span
                                class="algorithm-contribution">≈<span>{{ number_format($algorithm->profit_contribution, 2) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}"
                      data-category="{{ $algorithm->category }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m9 5l6 7l-6 7" />
                      </svg>
                    </button>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="tab-pane fade" id="tf" role="tabpanel" aria-labelledby="tf" tabindex="0">
            <div class="row row-gap-4 mt-7">
              @foreach ($algorithms->where('category', 'TF') as $algorithm)
                <div class="col col-12">
                  <div class="algorithm-item p-4 rounded">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="d-flex align-items-center w-100">
                        <img class="algorithm-item-icon algorithm-item-icon-{{ $algorithm->icon }}"
                          src="{{ asset('assets/img/illustrations/algorithms/algorithm-' . $algorithm->icon . '.svg') }}"
                          alt="{{ $algorithm->title }}" draggable="false">
                        <div class="d-flex flex-column w-100">
                          <h5 class="d-flex justify-content-between w-100 text-heading mb-1 fw-bold lh-1">
                            <span class="notranslate">{{ $algorithm->title }}</span>
                            <div class="d-flex align-items-center">
                              <div class="popover-trigger text-light cursor-pointer me-1" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                                data-bs-content="Contribution rate to your current strategy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                    opacity=".3" />
                                  <path fill="currentColor"
                                    d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                </svg>
                              </div>
                              <span
                                class="algorithm-contribution">≈<span>{{ number_format($algorithm->profit_contribution, 2) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}"
                      data-category="{{ $algorithm->category }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m9 5l6 7l-6 7" />
                      </svg>
                    </button>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="tab-pane fade" id="mse" role="tabpanel" aria-labelledby="mse" tabindex="0">
            <div class="row row-gap-4 mt-7">
              @foreach ($algorithms->where('category', 'MSE') as $algorithm)
                <div class="col col-12">
                  <div class="algorithm-item p-4 rounded">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="d-flex align-items-center w-100">
                        <img class="algorithm-item-icon algorithm-item-icon-{{ $algorithm->icon }}"
                          src="{{ asset('assets/img/illustrations/algorithms/algorithm-' . $algorithm->icon . '.svg') }}"
                          alt="{{ $algorithm->title }}" draggable="false">
                        <div class="d-flex flex-column w-100">
                          <h5 class="d-flex justify-content-between w-100 text-heading mb-1 fw-bold lh-1">
                            <span class="notranslate">{{ $algorithm->title }}</span>
                            <div class="d-flex align-items-center">
                              <div class="popover-trigger text-light cursor-pointer me-1" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                                data-bs-content="Contribution rate to your current strategy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                    opacity=".3" />
                                  <path fill="currentColor"
                                    d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                </svg>
                              </div>
                              <span
                                class="algorithm-contribution">≈<span>{{ number_format($algorithm->profit_contribution, 2) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}"
                      data-category="{{ $algorithm->category }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m9 5l6 7l-6 7" />
                      </svg>
                    </button>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="tab-pane fade" id="mr" role="tabpanel" aria-labelledby="mr" tabindex="0">
            <div class="row row-gap-4 mt-7">
              @foreach ($algorithms->where('category', 'MR') as $algorithm)
                <div class="col col-12">
                  <div class="algorithm-item p-4 rounded">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="d-flex align-items-center w-100">
                        <img class="algorithm-item-icon algorithm-item-icon-{{ $algorithm->icon }}"
                          src="{{ asset('assets/img/illustrations/algorithms/algorithm-' . $algorithm->icon . '.svg') }}"
                          alt="{{ $algorithm->title }}" draggable="false">
                        <div class="d-flex flex-column w-100">
                          <h5 class="d-flex justify-content-between w-100 text-heading mb-1 fw-bold lh-1">
                            <span class="notranslate">{{ $algorithm->title }}</span>
                            <div class="d-flex align-items-center">
                              <div class="popover-trigger text-light cursor-pointer me-1" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                                data-bs-content="Contribution rate to your current strategy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                    opacity=".3" />
                                  <path fill="currentColor"
                                    d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                </svg>
                              </div>
                              <span
                                class="algorithm-contribution">≈<span>{{ number_format($algorithm->profit_contribution, 2) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}"
                      data-category="{{ $algorithm->category }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m9 5l6 7l-6 7" />
                      </svg>
                    </button>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="tab-pane fade" id="mse" role="tabpanel" aria-labelledby="mse" tabindex="0">
            <div class="row row-gap-4 mt-7">
              @foreach ($algorithms->where('category', 'MSE') as $algorithm)
                <div class="col col-12">
                  <div class="algorithm-item p-4 rounded">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="d-flex align-items-center w-100">
                        <img class="algorithm-item-icon algorithm-item-icon-{{ $algorithm->icon }}"
                          src="{{ asset('assets/img/illustrations/algorithms/algorithm-' . $algorithm->icon . '.svg') }}"
                          alt="{{ $algorithm->title }}" draggable="false">
                        <div class="d-flex flex-column w-100">
                          <h5 class="d-flex justify-content-between w-100 text-heading mb-1 fw-bold lh-1">
                            <span class="notranslate">{{ $algorithm->title }}</span>
                            <div class="d-flex align-items-center">
                              <div class="popover-trigger text-light cursor-pointer me-1" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                                data-bs-content="Contribution rate to your current strategy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                    opacity=".3" />
                                  <path fill="currentColor"
                                    d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                </svg>
                              </div>
                              <span
                                class="algorithm-contribution">≈<span>{{ number_format($algorithm->profit_contribution, 2) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}"
                      data-category="{{ $algorithm->category }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m9 5l6 7l-6 7" />
                      </svg>
                    </button>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="tab-pane fade" id="mlp" role="tabpanel" aria-labelledby="mlp" tabindex="0">
            <div class="row row-gap-4 mt-7">
              @foreach ($algorithms->where('category', 'MLP') as $algorithm)
                <div class="col col-12">
                  <div class="algorithm-item p-4 rounded">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="d-flex align-items-center w-100">
                        <img class="algorithm-item-icon algorithm-item-icon-{{ $algorithm->icon }}"
                          src="{{ asset('assets/img/illustrations/algorithms/algorithm-' . $algorithm->icon . '.svg') }}"
                          alt="{{ $algorithm->title }}" draggable="false">
                        <div class="d-flex flex-column w-100">
                          <h5 class="d-flex justify-content-between w-100 text-heading mb-1 fw-bold lh-1">
                            <span class="notranslate">{{ $algorithm->title }}</span>
                            <div class="d-flex align-items-center">
                              <div class="popover-trigger text-light cursor-pointer me-1" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                                data-bs-content="Contribution rate to your current strategy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                    opacity=".3" />
                                  <path fill="currentColor"
                                    d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                </svg>
                              </div>
                              <span
                                class="algorithm-contribution">≈<span>{{ number_format($algorithm->profit_contribution, 2) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}"
                      data-category="{{ $algorithm->category }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m9 5l6 7l-6 7" />
                      </svg>
                    </button>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="col col-md-5">
        <div class="d-flex flex-column" id="build-algorithm">
          <h6 class="mb-2 lh-1">Build Strategy</h6>
          <small class="mb-7">
            View costs and estimated income at the end of the strategy period
          </small>

          <div class="card bg-light border">
            <div class="card-body">
              @if ($userUsdBalance > 0)
                <div id="strategy-content">
                  <div class="bg-light border rounded p-5">
                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column w-100">
                        <label class="text-nowrap mb-2" for="lock_amount">Amount to Lock</label>
                        <div class="input-group flex-nowrap">
                          <small class="input-group-text text-white">$</small>
                          <input type="number" class="form-control w-100" placeholder="0.00" id="lock_amount"
                            min="1" data-max="{{ $userUsdBalance }}" pattern="^\d*(\.\d{0,2})?$">
                          <button type="button" class="input-group-text"
                            onclick="if ({{ $userUsdBalance }}) document.querySelector('#lock_amount').value = ({{ $userUsdBalance }}).toFixed(2)"
                            id="max_button">Max.</button>
                        </div>
                      </div>
                      <div id="algorithm-glow"></div>
                    </div>

                    <label class="d-flex flex-column mt-4" for="unlock_date">
                      <label class="d-flex align-items-center text-nowrap mb-2" for="unlock_date">
                        <span>Unlock Date</span>
                        <span class="popover-trigger text-light cursor-pointer ms-1" data-bs-html="true"
                          data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                          data-bs-custom-class="popover-dark"
                          data-bs-content="<span class='me-4'>You can lock balances for:</span><br />- min. 14 days<br />- max. 365 days">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="currentColor"
                              d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                              opacity=".3" />
                            <path fill="currentColor"
                              d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                          </svg>
                        </span>
                      </label>
                      <div class="input-group flex-nowrap">
                        <small class="input-group-text text-light">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="currentColor"
                              d="M6.96 2c.418 0 .756.31.756.692V4.09c.67-.012 1.422-.012 2.268-.012h4.032c.846 0 1.597 0 2.268.012V2.692c0-.382.338-.692.756-.692s.756.31.756.692V4.15c1.45.106 2.403.368 3.103 1.008c.7.641.985 1.513 1.101 2.842v1H2V8c.116-1.329.401-2.2 1.101-2.842c.7-.64 1.652-.902 3.103-1.008V2.692c0-.382.339-.692.756-.692" />
                            <path fill="currentColor"
                              d="M22 14v-2c0-.839-.013-2.335-.026-3H2.006c-.013.665 0 2.161 0 3v2c0 3.771 0 5.657 1.17 6.828C4.349 22 6.234 22 10.004 22h4c3.77 0 5.654 0 6.826-1.172S22 17.771 22 14"
                              opacity=".5" />
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M14 12.25A1.75 1.75 0 0 0 12.25 14v2a1.75 1.75 0 1 0 3.5 0v-2A1.75 1.75 0 0 0 14 12.25m0 1.5a.25.25 0 0 0-.25.25v2a.25.25 0 1 0 .5 0v-2a.25.25 0 0 0-.25-.25"
                              clip-rule="evenodd" />
                            <path fill="currentColor"
                              d="M11.25 13a.75.75 0 0 0-1.28-.53l-1.5 1.5a.75.75 0 0 0 1.06 1.06l.22-.22V17a.75.75 0 0 0 1.5 0z" />
                          </svg>
                        </small>
                        <input class="form-control flatpickr" id="unlock_date" type="date" name="unlock_date"
                          pattern="\d{2}.\d{2}.\d{4}" placeholder="mm.dd.yyyy">
                      </div>
                    </label>

                    <div class="d-flex flex-column row-gap-2 mt-8" id="algorithm-sm-items">
                      <small
                        class="d-flex justify-content-center align-items-center text-center border rounded p-2 w-100"
                        id="algorithms-empty-text">
                        Pick some algorithms to get started.
                      </small>
                    </div>

                    <div class="d-none mt-6" id="conflictWarningsWrap">
                      <small class="d-flex align-items-start text-primary gap-2">
                        <span>
                          Categories below conflict with each other. They will not be used simultaneously when executing
                          trades due to their incompatibility, but will result in unnecessary costs:
                        </span>
                      </small>
                      <div class="d-flex flex-column text-primary" id="conflictWarnings"></div>
                    </div>
                  </div>
                </div>

                <h6 class="lh-1 fw-normal mt-8 mb-4">Summary</h6>

                <div class="table-responsive border rounded overflow-hidden">
                  <table class="table">
                    <tbody class="table-border-bottom-0">
                      <tr class="d-none unlock_after_wrap">
                        <td><small class="text-light">Unlock After</small></td>
                        <td class="text-end"></td>
                        <td class="text-end"><span class="text-white" id="unlock_after">0 days</span></td>
                      </tr>
                      <tr>
                        <td><small class="text-light">Algorithm Cost</small></td>
                        <td class="text-end"></td>
                        <td class="text-end"><span class="text-white" id="algorithm_cost">0.00$</span></td>
                      </tr>
                      <tr>
                        <td><small class="text-light">Amount After Purchase</small></td>
                        <td class="text-end"></td>
                        <td class="text-end"><span class="text-white" id="amount_after_purchase">0.00$</span></td>
                      </tr>
                      <tr>
                        <td><small class="text-light">Income</small></td>
                        <td class="text-end"></td>
                        <td class="text-end"><span class="text-white" id="income">0.00$</span></td>
                      </tr>
                      <tr>
                        <td><small class="text-light">Amount After Unlock</small></td>
                        <td class="text-end"><span class="text-white"
                            id="total_amount_after_unlock_percentage">0.00%</span>
                        </td>
                        <td class="text-end"><span class="text-white" id="total_amount_after_unlock">0.00$</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <small class="d-flex align-items-start text-primary gap-2 mt-4">
                  <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                      opacity=".4" />
                    <path fill="currentColor"
                      d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                  </svg>
                  <span>
                    Above specified amounts are estimated values and may change up to 15% at the end of the lock period
                    depending on market fluctuation.
                  </span>
                </small>

                <div class="lock-error-message text-danger mt-2 text-center d-none">
                  <small></small>
                </div>

                <div class="lock-success-message text-success mt-2 text-center d-none">
                  <small></small>
                </div>

                <div class="d-flex justify-content-end mt-4">
                  <button type="button" class="btn btn-sm btn-primary" id="lock-amount-button" disabled>
                    <svg class="loading-hidden" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                      viewBox="0 0 24 24">
                      <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="4">
                        <path stroke-dasharray="16" stroke-dashoffset="16" d="M12 3c4.97 0 9 4.03 9 9">
                          <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="16;0" />
                          <animateTransform attributeName="transform" dur="1s" repeatCount="indefinite"
                            type="rotate" values="0 12 12;360 12 12" />
                        </path>
                        <path stroke-dasharray="64" stroke-dashoffset="64" stroke-opacity=".3"
                          d="M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z">
                          <animate fill="freeze" attributeName="stroke-dashoffset" dur="1.2s" values="64;0" />
                        </path>
                      </g>
                    </svg>
                    <span>Lock</span>
                  </button>
                </div>
              @else
                <div class="d-flex flex-column align-items-center text-center">
                  <span class="h6 mb-1">Insufficient USD balance</span>
                  <small>Swap balances to USD in order to start</small>
                  <button type="button" class="btn btn-sm btn-primary mt-4" data-bs-toggle="modal"
                    data-bs-target="#swapModal">
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                      viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M20.536 20.536C22 19.07 22 16.714 22 12s0-7.071-1.465-8.536C19.072 2 16.714 2 12 2S4.929 2 3.464 3.464C2 4.93 2 7.286 2 12s0 7.071 1.464 8.535C4.93 22 7.286 22 12 22s7.071 0 8.535-1.465"
                        opacity=".4" />
                      <path fill="currentColor"
                        d="M7 10.75a.75.75 0 0 1-.493-1.315l3.437-3a.75.75 0 0 1 .987 1.13L9 9.25h8a.75.75 0 0 1 0 1.5zm6.07 5.685a.75.75 0 0 0 .986 1.13l3.437-3A.75.75 0 0 0 17 13.25H7a.75.75 0 0 0 0 1.5h8z" />
                    </svg>
                    <span>Swap Tool</span>
                  </button>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade modal-lg" id="buildGuideModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="d-flex">
              <svg class="me-3 flex-shrink-0 text-primary" width="50" height="50" viewBox="0 0 32 32"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.6"
                  d="M16.0013 29.3346C9.71597 29.3346 6.5733 29.3346 4.61997 27.3813C2.66797 25.4306 2.66797 22.2866 2.66797 16.0013C2.66797 9.71597 2.66797 6.5733 4.61997 4.61997C6.57464 2.66797 9.71597 2.66797 16.0013 2.66797C22.2866 2.66797 25.4293 2.66797 27.3813 4.61997C29.3346 6.57464 29.3346 9.71597 29.3346 16.0013C29.3346 22.2866 29.3346 25.4293 27.3813 27.3813C25.4306 29.3346 22.2866 29.3346 16.0013 29.3346Z"
                  fill="currentColor" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M10.5697 8.55793C10.8095 8.32363 11.1449 8.17083 11.7796 8.08776C12.4331 8.00157 13.2982 8 14.5395 8H17.9983C19.2396 8 20.1047 8.00157 20.7582 8.08776C21.3929 8.17083 21.7283 8.32363 21.9681 8.55793C22.2071 8.79301 22.363 9.12213 22.4484 9.74353C22.5362 10.3837 22.5378 11.2316 22.5378 12.447V18.5897H12.622C11.9144 18.5897 11.4317 18.5889 11.0179 18.6979C10.648 18.795 10.3048 18.9533 10 19.1618V12.4478C10 11.2316 10.0016 10.3837 10.0893 9.74353C10.1747 9.12213 10.3307 8.79301 10.5697 8.55793ZM12.8108 10.9652C12.6407 10.9635 12.4768 11.0294 12.3552 11.1484C12.2335 11.2674 12.164 11.4298 12.162 11.5999C12.162 11.951 12.4519 12.2354 12.81 12.2354H19.7277C19.8978 12.2369 20.0614 12.1709 20.1829 12.0519C20.3044 11.933 20.3737 11.7707 20.3758 11.6007C20.3739 11.4305 20.3047 11.2681 20.1832 11.1489C20.0617 11.0298 19.8979 10.9637 19.7277 10.9652H12.8108ZM12.162 14.5651C12.162 14.2148 12.4519 13.9304 12.81 13.9304H17.1332C17.3034 13.9287 17.4672 13.9946 17.5889 14.1136C17.7105 14.2326 17.78 14.3949 17.782 14.5651C17.7802 14.7354 17.7108 14.898 17.5891 15.0171C17.4675 15.1363 17.3035 15.2023 17.1332 15.2006H12.81C12.64 15.2021 12.4763 15.1361 12.3549 15.0171C12.2334 14.8981 12.164 14.7351 12.162 14.5651Z"
                  fill="#fff" opacity=".9" />
                <path
                  d="M12.7292 19.8555C11.8837 19.8555 11.5883 19.861 11.361 19.9205C11.0583 19.9985 10.779 20.149 10.5473 20.3589C10.3157 20.5689 10.1386 20.832 10.0312 21.1257C10.0433 21.424 10.0652 21.6902 10.0971 21.9242C10.1825 22.5456 10.3384 22.8747 10.5774 23.1098C10.8172 23.3441 11.1526 23.4969 11.7873 23.58C12.4409 23.6662 13.306 23.6677 14.5472 23.6677H18.0061C19.2473 23.6677 20.1124 23.6662 20.7659 23.5808C21.4007 23.4969 21.736 23.3441 21.9758 23.1098C22.1451 22.9429 22.2736 22.729 22.3637 22.3967H12.8178C12.6478 22.3982 12.4841 22.3322 12.3626 22.2132C12.2412 22.0943 12.1718 21.932 12.1697 21.762C12.1697 21.4109 12.4597 21.1265 12.8178 21.1265H22.522C22.5377 20.7613 22.5432 20.3429 22.5455 19.8555H12.7292Z"
                  fill="#fff" opacity=".6" />
              </svg>
              <div class="d-flex flex-column">
                <h4 class="modal-title text-heading fw-bold">Build Guide</h4>
                <small class="mt-2">
                  This guide will walk you through the process of building your own algorithmic trading strategy. The
                  strategies are designed to adjust algorithm costs and contributions dynamically, based on your choices.
                  Follow the steps below to make better selections.
                </small>
              </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="divider my-6 border border-top-1 border-bottom-0"></div>

          <div class="modal-body pt-0">
            <div class="row">
              <div class="col col-12">
                <div class="card bg-light">
                  <div class="card-header">
                    <small class="fw-bold text-uppercase text-light">Step 1</small>
                    <h5 class="fw-bold text-heading mt-1 mb-0">Select Algorithms for Your Strategy</h5>
                    <small>Choose the algorithms that you believe will align best with your budget and time.</small>
                  </div>

                  <div class="card-body mt-2">
                    <h6 class="mb-1">1. Understand the Categories of Algorithms</h6>
                    <small>
                      Algorithms are grouped into categories based on their trading strategies. Each category has
                      different objectives and can impact your overall balance differently. Here are the categories to
                      choose from.
                    </small>

                    <div class="row row-gap-4 mt-5">
                      <div class="col">
                        <div class="d-flex flex-column border rounded p-4 h-100">
                          <span class="text-heading">Trend-Following</span>
                          <small class="mt-2">
                            These algorithms follow the market trend, capitalizing on upward or downward price movements.
                          </small>
                        </div>
                      </div>
                      <div class="col">
                        <div class="d-flex flex-column border rounded p-4 h-100">
                          <span class="text-heading">Mean Reversion</span>
                          <small class="mt-2">
                            These algorithms examine historical average over time and contributes the general strategy.
                          </small>
                        </div>
                      </div>
                      <div class="col">
                        <div class="d-flex flex-column border rounded p-4 h-100">
                          <span class="text-heading">Market Structure & Execution</span>
                          <small class="mt-2">
                            Focuses on improving the execution of trades within specific market conditions.
                          </small>
                        </div>
                      </div>
                      <div class="col">
                        <div class="d-flex flex-column border rounded p-4 h-100">
                          <span class="text-heading">Machine Learning & Predictive</span>
                          <small class="mt-2">
                            Algorithms based on predictive models that improve over time with more data.
                          </small>
                        </div>
                      </div>
                    </div>

                    <h6 class="mt-8 mb-1">2. Pick the Algorithms</h6>
                    <small>
                      Using all Basic Algorithms is recommended for a balanced strategy in any combination. Other than
                      Basic Algorithms, you can select algorithms from other categories that align with your budget, time
                      constraints, or the specific outcomes you aim to achieve.
                    </small>

                    <h6 class="mt-8 mb-1">3. Consider Conflicting Strategies</h6>
                    <small>
                      Carefully evaluate the compatibility of algorithms from different categories, as conflicts between
                      strategies can lead to inefficiencies, performance imbalances, or increased costs. Choose
                      complementary algorithms to maximize effectiveness and avoid potential issues.
                    </small>

                    <ul class="list-group mt-4">
                      <li class="list-group-item d-flex align-items-center">
                        <svg class="me-1 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M12 22c-4.714 0-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22"
                            opacity=".5"></path>
                          <path fill="currentColor"
                            d="M12 5.25a.75.75 0 0 1 .75.75v12a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75m-5 3a.75.75 0 0 1 .75.75v9a.75.75 0 0 1-1.5 0V9A.75.75 0 0 1 7 8.25m10 4a.75.75 0 0 1 .75.75v5a.75.75 0 0 1-1.5 0v-5a.75.75 0 0 1 .75-.75">
                          </path>
                        </svg>
                        <span class="me-1">&rarr;</span>
                        <svg class="me-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                            opacity=".5"></path>
                          <path fill="currentColor"
                            d="M14.5 10.75a.75.75 0 0 1 0-1.5H17a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-1.5 0v-.69l-2.013 2.013a1.75 1.75 0 0 1-2.474 0l-1.586-1.586a.25.25 0 0 0-.354 0L7.53 14.53a.75.75 0 0 1-1.06-1.06l2.293-2.293a1.75 1.75 0 0 1 2.474 0l1.586 1.586a.25.25 0 0 0 .354 0l2.012-2.013z">
                          </path>
                        </svg>
                        <div class="d-flex flex-column">
                          <b>Mean Reversion &rarr; Trend-Following</b>
                          <small>
                            These algorithms may not work well together as the migh depend on opposing market behaviors.
                          </small>
                        </div>
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <svg class="me-1 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24"
                          fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.00007 11.5L2 12C2 12.3458 2 12.679 2.00058 13C2.00788 17.0552 2.1074 19.1793 3.464 20.535C4.929 22 7.286 22 12 22C16.714 22 19.072 22 20.535 20.535C21.8925 19.1784 21.9921 17.055 21.9994 13C22 12.679 22 12.3458 22 12L21.9999 11.5C21.9981 7.11753 21.9473 4.87723 20.535 3.464C19.071 2 16.714 2 12 2C7.286 2 4.93 2 3.464 3.464C2.0527 4.87626 2.0019 7.11746 2.00007 11.5ZM2.00007 11.5L2.00058 13H21.9994L21.9999 11.5H2.00007Z"
                            fill="currentColor" />
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M22 13H2V11.5H22V13Z" fill="currentColor" />
                          <path
                            d="M12.75 16.75C12.75 16.5511 12.829 16.3603 12.9697 16.2197C13.1103 16.079 13.3011 16 13.5 16H18C18.1989 16 18.3897 16.079 18.5303 16.2197C18.671 16.3603 18.75 16.5511 18.75 16.75C18.75 16.9489 18.671 17.1397 18.5303 17.2803C18.3897 17.421 18.1989 17.5 18 17.5H13.5C13.3011 17.5 13.1103 17.421 12.9697 17.2803C12.829 17.1397 12.75 16.9489 12.75 16.75ZM12.75 7.75C12.75 7.55109 12.829 7.36032 12.9697 7.21967C13.1103 7.07902 13.3011 7 13.5 7H18C18.1989 7 18.3897 7.07902 18.5303 7.21967C18.671 7.36032 18.75 7.55109 18.75 7.75C18.75 7.94891 18.671 8.13968 18.5303 8.28033C18.3897 8.42098 18.1989 8.5 18 8.5H13.5C13.3011 8.5 13.1103 8.42098 12.9697 8.28033C12.829 8.13968 12.75 7.94891 12.75 7.75ZM6 18.5C5.80109 18.5 5.61032 18.421 5.46967 18.2803C5.32902 18.1397 5.25 17.9489 5.25 17.75V15.75C5.25 15.5511 5.32902 15.3603 5.46967 15.2197C5.61032 15.079 5.80109 15 6 15C6.19891 15 6.38968 15.079 6.53033 15.2197C6.67098 15.3603 6.75 15.5511 6.75 15.75V17.75C6.75 17.9489 6.67098 18.1397 6.53033 18.2803C6.38968 18.421 6.19891 18.5 6 18.5ZM6 9.5C5.80109 9.5 5.61032 9.42098 5.46967 9.28033C5.32902 9.13968 5.25 8.94891 5.25 8.75V6.75C5.25 6.55109 5.32902 6.36032 5.46967 6.21967C5.61032 6.07902 5.80109 6 6 6C6.19891 6 6.38968 6.07902 6.53033 6.21967C6.67098 6.36032 6.75 6.55109 6.75 6.75V8.75C6.75 8.94891 6.67098 9.13968 6.53033 9.28033C6.38968 9.42098 6.19891 9.5 6 9.5ZM9 18.5C8.80109 18.5 8.61032 18.421 8.46967 18.2803C8.32902 18.1397 8.25 17.9489 8.25 17.75V15.75C8.25 15.5511 8.32902 15.3603 8.46967 15.2197C8.61032 15.079 8.80109 15 9 15C9.19891 15 9.38968 15.079 9.53033 15.2197C9.67098 15.3603 9.75 15.5511 9.75 15.75V17.75C9.75 17.9489 9.67098 18.1397 9.53033 18.2803C9.38968 18.421 9.19891 18.5 9 18.5ZM9 9.5C8.80109 9.5 8.61032 9.42098 8.46967 9.28033C8.32902 9.13968 8.25 8.94891 8.25 8.75V6.75C8.25 6.55109 8.32902 6.36032 8.46967 6.21967C8.61032 6.07902 8.80109 6 9 6C9.19891 6 9.38968 6.07902 9.53033 6.21967C9.67098 6.36032 9.75 6.55109 9.75 6.75V8.75C9.75 8.94891 9.67098 9.13968 9.53033 9.28033C9.38968 9.42098 9.19891 9.5 9 9.5Z"
                            fill="currentColor" />
                        </svg>
                        <span class="me-1">&rarr;</span>
                        <svg class="me-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M12 22c-4.714 0-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22"
                            opacity=".5"></path>
                          <path fill="currentColor"
                            d="M12 5.25a.75.75 0 0 1 .75.75v12a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75m-5 3a.75.75 0 0 1 .75.75v9a.75.75 0 0 1-1.5 0V9A.75.75 0 0 1 7 8.25m10 4a.75.75 0 0 1 .75.75v5a.75.75 0 0 1-1.5 0v-5a.75.75 0 0 1 .75-.75">
                          </path>
                        </svg>
                        <div class="d-flex flex-column">
                          <b>Machine Learning & Predictive &rarr; Mean Reversion</b>
                          <small>
                            Machine learning algorithms might not align well with the assumptions behind mean reversion.
                          </small>
                        </div>
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <svg class="me-1 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                            opacity=".5"></path>
                          <path fill="currentColor"
                            d="M17.576 10.48a.75.75 0 0 0-1.152-.96l-1.797 2.156c-.37.445-.599.716-.786.885a.8.8 0 0 1-.163.122l-.011.005l-.008-.004l-.003-.001a.8.8 0 0 1-.164-.122c-.187-.17-.415-.44-.786-.885l-.292-.35c-.328-.395-.625-.75-.901-1c-.301-.272-.68-.514-1.18-.514s-.878.242-1.18.514c-.276.25-.572.605-.9 1l-1.83 2.194a.75.75 0 0 0 1.153.96l1.797-2.156c.37-.445.599-.716.786-.885a.8.8 0 0 1 .163-.122l.007-.003l.004-.001q.004 0 .011.004a.8.8 0 0 1 .164.122c.187.17.415.44.786.885l.292.35c.329.395.625.75.901 1c.301.272.68.514 1.18.514s.878-.242 1.18-.514c.276-.25.572-.605.9-1z">
                          </path>
                        </svg>
                        <span class="me-1">&rarr;</span>
                        <svg class="me-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                            opacity=".5"></path>
                          <path fill="currentColor"
                            d="M14.5 10.75a.75.75 0 0 1 0-1.5H17a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-1.5 0v-.69l-2.013 2.013a1.75 1.75 0 0 1-2.474 0l-1.586-1.586a.25.25 0 0 0-.354 0L7.53 14.53a.75.75 0 0 1-1.06-1.06l2.293-2.293a1.75 1.75 0 0 1 2.474 0l1.586 1.586a.25.25 0 0 0 .354 0l2.012-2.013z">
                          </path>
                        </svg>
                        <div class="d-flex flex-column">
                          <b>Market Structure & Execution &rarr; Trend-Following</b>
                          <small>
                            They might not work well together as while one focuses on efficient execution, the other
                            relies on sustained trends.
                          </small>
                        </div>
                      </li>
                    </ul>

                    <small class="d-flex align-items-start text-primary gap-2 mt-4">
                      <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                          opacity=".4"></path>
                        <path fill="currentColor"
                          d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2">
                        </path>
                      </svg>
                      <span>
                        Selected conflicting algorithms will not be used simultaneously when executing trades due to their
                        incompatibility, but will result in unnecessary costs.
                      </span>
                    </small>

                    <h6 class="mt-8 mb-1">4. Consider Period</h6>
                    <small>
                      Some algorithms in specific categories may perform better over longer periods.
                    </small>

                    <ul class="list-group mt-4">
                      <li class="list-group-item d-flex align-items-center">
                        <svg class="me-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                            opacity=".5"></path>
                          <path fill="currentColor"
                            d="M14.5 10.75a.75.75 0 0 1 0-1.5H17a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-1.5 0v-.69l-2.013 2.013a1.75 1.75 0 0 1-2.474 0l-1.586-1.586a.25.25 0 0 0-.354 0L7.53 14.53a.75.75 0 0 1-1.06-1.06l2.293-2.293a1.75 1.75 0 0 1 2.474 0l1.586 1.586a.25.25 0 0 0 .354 0l2.012-2.013z">
                          </path>
                        </svg>
                        <div class="d-flex flex-column">
                          <b>Trend-Following &rarr; Better on longer period</b>
                          <small>
                            Performs better over extended periods by capturing long-term trends and avoiding short-term
                            noise.
                          </small>
                        </div>
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <svg class="me-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M12 22c-4.714 0-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22"
                            opacity=".5"></path>
                          <path fill="currentColor"
                            d="M12 5.25a.75.75 0 0 1 .75.75v12a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75m-5 3a.75.75 0 0 1 .75.75v9a.75.75 0 0 1-1.5 0V9A.75.75 0 0 1 7 8.25m10 4a.75.75 0 0 1 .75.75v5a.75.75 0 0 1-1.5 0v-5a.75.75 0 0 1 .75-.75">
                          </path>
                        </svg>
                        <div class="d-flex flex-column">
                          <b>Mean Reversion &rarr; Better on longer period</b>
                          <small>
                            More effective in longer periods by exploiting price corrections and market inefficiencies.
                          </small>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="card bg-light mt-6">
                  <div class="card-header">
                    <small class="fw-bold text-uppercase text-light">Step 2</small>
                    <h5 class="fw-bold text-heading mt-1 mb-0">Lock Amount</h5>
                    <small>Specify the amount of capital you want to allocate for the built algorithm pack.</small>
                  </div>

                  <div class="card-body mt-2">
                    <h6 class="mb-1">1. Enter the Amount</h6>
                    <small>
                      In the provided input field (e.g., Amount to Lock), enter the amount of money you are willing to
                      allocate to be locked for the strategy. This amount will be the starting capital that your
                      algorithms will work with and will be locked until the date you've chosen (See also: Step 3). Larger
                      amounts of capital will result in higher potential incomes, but the algorithm costs may also
                      increase slightly.
                    </small>
                  </div>
                </div>

                <div class="card bg-light mt-6">
                  <div class="card-header">
                    <small class="fw-bold text-uppercase text-light">Step 3</small>
                    <h5 class="fw-bold text-heading mt-1 mb-0">Lock Period</h5>
                    <small>Select the unlock date to determine when your capital and incomes can be accessed.</small>
                  </div>

                  <div class="card-body mt-2">
                    <h6 class="mb-1">1. What is the Unlock Date?</h6>
                    <small>
                      The Unlock Date marks when your capital becomes accessible after the lock period begins. This period
                      starts immediately upon executing your newly created algorithm pack and can range from 14 to 365
                      days from today.
                    </small>

                    <h6 class="mt-8 mb-1">2. Set the Unlock Date</h6>
                    <small>
                      The period between the current date and the unlock date will influence how your incomes accumulate,
                      as the algorithms will generate returns based on the time period you select. You can execute the
                      algorithm pack at any time after you built it.
                    </small>

                    <h6 class="mt-8 mb-1">3. Consider the Lock Period</h6>
                    <div class="d-flex flex-column">
                      <small>
                        - Longer lock periods reduce the overall algorithm costs, offering cost efficiency over
                        extended durations.
                      </small>
                      <small class="mt-1">
                        - Shorter lock periods may result in higher algorithm costs due to the
                        limited time available for trade execution.
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        flatpickr('#unlock_date', {
          dateFormat: 'm.d.Y',
          minDate: new Date().fp_incr(14),
          maxDate: new Date().fp_incr(365),
          disable: [{
            from: '1970-01-01',
            to: new Date().setHours(0, 0, 0, 0)
          }]
        });
      });
    </script>
  @endsection
