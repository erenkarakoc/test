@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js', 'resources/assets/vendor/libs/swiper/swiper.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/_dashboard.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/dashboard.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <h5 class="mb-3 lh-1">Welcome back, {{ Auth::user()->username }}! 👋🏻</h5>
      <p class="mb-7 lh-1">Here's a summary of your account.</p>

      <div class="gdz-dasboard-total-profit card bg-light text-white mb-7">
        <div class="card-body d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-start gap-2">
            <div class="text-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                  opacity=".5" />
                <path fill="currentColor"
                  d="M14.5 10.75a.75.75 0 0 1 0-1.5H17a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-1.5 0v-.69l-2.013 2.013a1.75 1.75 0 0 1-2.474 0l-1.586-1.586a.25.25 0 0 0-.354 0L7.53 14.53a.75.75 0 0 1-1.06-1.06l2.293-2.293a1.75 1.75 0 0 1 2.474 0l1.586 1.586a.25.25 0 0 0 .354 0l2.012-2.013z" />
              </svg>
            </div>
            <div class="content-right">
              <span class="text-heading fw-medium mb-0">Total Profit</span>
              <h6 class="text-primary mb-0">1.45$<small class="text-success fw-light ms-1">7.64%</small></h6>
            </div>
          </div>

          <div class="popover-trigger text-light cursor-pointer" data-bs-toggle="popover" data-bs-trigger="hover"
            data-bs-placement="top" data-bs-custom-class="popover-dark"
            data-bs-content="Total profit you've earned throughout your Gedzen journey.">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
              <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                opacity=".5" />
              <path fill="currentColor"
                d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
            </svg>
          </div>
        </div>
        <div class="p-0">
          <div id="totalProfitsChart" class="mt-n10"></div>
        </div>
      </div>

      <div class="gdz-dashboard-transactions card shadow-none bg-primary">
        <div class="card-body d-flex justify-content-between gap-3 p-3">
          <a href="{{ route('add-funds') }}" class="d-flex align-items-start gap-2 btn btn-primary border border-light">
            <div class="text-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M10 20h4c.66 0 1.261 0 1.812-.006l-.403-.403a2.25 2.25 0 0 1 1.341-3.827V14a2.25 2.25 0 0 1 4.5 0v1.764c.224.025.445.083.654.175C22 14.917 22 13.636 22 12c0-.442 0-1.608-.002-2H2.002C2 10.392 2 11.558 2 12c0 3.771 0 5.657 1.172 6.828S6.229 20 10 20"
                  opacity=".5" />
                <path fill="currentColor" fill-rule="evenodd"
                  d="M18.47 20.53a.75.75 0 0 0 1.06 0l2-2a.75.75 0 1 0-1.06-1.06l-.72.72V14a.75.75 0 0 0-1.5 0v4.19l-.72-.72a.75.75 0 1 0-1.06 1.06z"
                  clip-rule="evenodd" />
                <path fill="currentColor"
                  d="M12.5 15.25a.75.75 0 0 0 0 1.5H14a.75.75 0 0 0 0-1.5zm-6.5 0a.75.75 0 0 0 0 1.5h4a.75.75 0 0 0 0-1.5zM9.995 4h4.01c3.781 0 5.672 0 6.846 1.116c.846.803 1.083 1.96 1.149 3.884v1H2V9c.066-1.925.303-3.08 1.149-3.884C4.323 4 6.214 4 9.995 4" />
              </svg>
            </div>
            <div class="content-right">
              <span class="mb-0 fw-medium text-white whitespace-nowrap">Total Received</span>
              <h6 class="text-white mb-0">19.00$</h6>
            </div>
            <div class="content-hover">
              Add Funds
            </div>
          </a>
          <a href="#" class="d-flex align-items-start gap-2 btn btn-primary border border-light">
            <div class="text-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M14 20h-4c-3.771 0-5.657 0-6.828-1.172S2 15.771 2 12c0-.442.002-1.608.004-2H22c.002.392 0 1.558 0 2c0 .66 0 1.261-.006 1.812l-1.403-1.403a2.25 2.25 0 0 0-3.182 0l-2 2a2.25 2.25 0 0 0 1.341 3.827v1.738C15.964 20 15.056 20 14 20"
                  opacity=".5" />
                <path fill="currentColor" fill-rule="evenodd"
                  d="M18.47 13.47a.75.75 0 0 1 1.06 0l2 2a.75.75 0 1 1-1.06 1.06l-.72-.72V20a.75.75 0 0 1-1.5 0v-4.19l-.72.72a.75.75 0 1 1-1.06-1.06z"
                  clip-rule="evenodd" />
                <path fill="currentColor"
                  d="M12.5 15.25a.75.75 0 0 0 0 1.5H14a.75.75 0 0 0 0-1.5zm-6.5 0a.75.75 0 0 0 0 1.5h4a.75.75 0 0 0 0-1.5zM9.995 4h4.01c3.781 0 5.672 0 6.846 1.116c.846.803 1.083 1.96 1.149 3.884v1H2V9c.066-1.925.303-3.08 1.149-3.884C4.323 4 6.214 4 9.995 4" />
              </svg>
            </div>
            <div class="content-right">
              <span class="mb-0 fw-medium text-white whitespace-nowrap">Total Sent</span>
              <h6 class="text-white mb-0">0.00$</h6>
            </div>
            <div class="content-hover">
              Send
            </div>
          </a>
          <a href="#" class="d-flex align-items-start gap-2 btn btn-primary border border-light">
            <div class="text-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                  opacity=".5" />
                <path fill="currentColor" fill-rule="evenodd"
                  d="M6.914 11.25H2v1.5h8.163A3.25 3.25 0 0 1 7 15.25a.75.75 0 0 0 0 1.5a4.75 4.75 0 0 0 4.25-2.626V22h1.5v-7.876A4.75 4.75 0 0 0 17 16.75a.75.75 0 0 0 0-1.5a3.25 3.25 0 0 1-3.163-2.5H22v-1.5h-4.913c.35-.438.613-.955.756-1.527c.538-2.153-1.413-4.103-3.565-3.565a4 4 0 0 0-1.528.756V2h-1.5v4.914a4 4 0 0 0-1.527-.756C7.57 5.62 5.62 7.57 6.158 9.723c.143.572.405 1.089.756 1.527m4.336 0H9.997a2.5 2.5 0 0 1-2.384-1.891A1.44 1.44 0 0 1 9.36 7.613a2.5 2.5 0 0 1 1.891 2.384zm2.753 0H12.75v-1.245a2.5 2.5 0 0 1 1.891-2.392a1.44 1.44 0 0 1 1.746 1.746a2.5 2.5 0 0 1-2.384 1.891"
                  clip-rule="evenodd" />
              </svg>
            </div>
            <div class="content-right">
              <span class="mb-0 fw-medium text-white">Total Bonus</span>
              <h6 class="text-white mb-0">0.00$</h6>
            </div>
            <div class="content-hover">
              Invite Friends
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="row">
        <div class="col-8">
          <h5 class="mb-3 lh-1">Strategy Packs</h5>
          <p class="mb-7 lh-1">Choose a strategy pack and start your journey.</p>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-start">
          <a href="#" class="btn btn-label-primary">Get Started</a>
        </div>
      </div>

      <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg" id="gdzStrategiesCard">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="row">
              <div class="col-12">
                <div class="h5 d-flex align-items-center text-white mb-0">
                  <span class="me-1">Momentum</span>
                  <div class="popover-trigger text-white cursor-pointer" data-bs-toggle="popover"
                    data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                    data-bs-content="Focused on strategies that capitalize on market momentum, offering moderate returns with higher risk exposure.">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".5" />
                      <path fill="currentColor"
                        d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 mt-auto">
                <div class="row">
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-2 align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">60%</p>
                        <p class="mb-0">Risk Management</p>
                      </li>
                      <li class="d-flex mb-2 align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">65%</p>
                        <p class="mb-0">Pattern Recognition</p>
                      </li>
                      <li class="d-flex mb-2 align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">70%</p>
                        <p class="mb-0">Real-Time Data Feed</p>
                      </li>
                      <li class="d-flex align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">55%</p>
                        <p class="mb-0">Volatility Strategy</p>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
              <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                <img src="{{ asset('assets/img/illustrations/momentum.png') }}" alt="Momentum" height="148"
                  class="strategy-pack-img">
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="row">
              <div class="col-12">
                <div class="h5 d-flex align-items-center text-white mb-0">
                  <span class="me-1">Scalper</span>
                  <div class="popover-trigger text-white cursor-pointer" data-bs-toggle="popover"
                    data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                    data-bs-content="Tailored for high-frequency trades, utilizing precise entry and exit points to ensure consistent, solid returns.">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".5" />
                      <path fill="currentColor"
                        d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 mt-auto">
                <div class="row">
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-2 align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">60%</p>
                        <p class="mb-0">Risk Management</p>
                      </li>
                      <li class="d-flex mb-2 align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">65%</p>
                        <p class="mb-0">Pattern Recognition</p>
                      </li>
                      <li class="d-flex mb-2 align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">70%</p>
                        <p class="mb-0">Real-Time Data Feed</p>
                      </li>
                      <li class="d-flex align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">55%</p>
                        <p class="mb-0">Volatility Strategy</p>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
              <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                <img src="{{ asset('assets/img/illustrations/scalper.png') }}" alt="Scalper" height="148"
                  class="strategy-pack-img">
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="row">
              <div class="col-12">
                <div class="h5 d-flex align-items-center text-white mb-0">
                  <span class="me-1">Swift</span>
                  <div class="popover-trigger text-white cursor-pointer" data-bs-toggle="popover"
                    data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                    data-bs-content="Diversified strategies designed to maximize growth potential in volatile markets, providing the highest success rate and stability.">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".5" />
                      <path fill="currentColor"
                        d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 mt-auto">
                <div class="row">
                  <div class="col-6">
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex mb-2 align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">60%</p>
                        <p class="mb-0">Risk Management</p>
                      </li>
                      <li class="d-flex mb-2 align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">65%</p>
                        <p class="mb-0">Pattern Recognition</p>
                      </li>
                      <li class="d-flex mb-2 align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">70%</p>
                        <p class="mb-0">Real-Time Data Feed</p>
                      </li>
                      <li class="d-flex align-items-center">
                        <p class="mb-0 fw-medium me-2 strategy-pack-text-bg">55%</p>
                        <p class="mb-0">Volatility Strategy</p>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
              <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                <img src="{{ asset('assets/img/illustrations/swift.png') }}" alt="Swift" height="148"
                  class="strategy-pack-img">
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <div class="col col-12 mt-7">
      <div class="gdz-token-chart card text-white bg-light">
        <div class="row">
          <div class="col-lg-6">
            <div class="card-header pe-0">
              <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center mb-0">
                  <svg width="34" height="34" viewBox="0 0 500 500" fill="none"
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
                  <h5 class="text-heading ms-3 mb-0">Gedzen Token</h5>
                </div>
                <span class="badge rounded-pill bg-label-primary bg-glow">
                  Current Price:<span class="text-dark fw-semibold">22.25$</span>
                </span>
              </div>
            </div>

            <div class="card-body pe-0">
              <div class="gdz-token-chart-content d-flex flex-column bg-light border border-light rounded p-0">
                <div id="gdzTokenChart"></div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card-body ps-0 h-100">
              <div class="row h-100">
                <div class="col-lg-4">
                  <div class="d-flex flex-column justify-content-between h-100">
                    <div class="d-flex flex-column justify-content-center align-items-start bg-primary p-4 rounded">

                      <div class="d-flex">
                        <div class="h4 fw-semibold text-white lh-1 mb-3">
                          {{ $userBalances->where('wallet', 'GDZ')->value('balance') }}
                        </div>
                        <div class="h5 ms-1 text-white">GDZ</div>
                      </div>
                      <span class="text-white d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M6.26 21.388H6c-.943 0-1.414 0-1.707-.293C4 20.804 4 20.332 4 19.389v-1.112c0-.518 0-.777.133-1.009s.334-.348.736-.582c2.646-1.539 6.403-2.405 8.91-.91q.253.151.45.368a1.49 1.49 0 0 1-.126 2.134a1 1 0 0 1-.427.24q.18-.021.345-.047c.911-.145 1.676-.633 2.376-1.162l1.808-1.365a1.89 1.89 0 0 1 2.22 0c.573.433.749 1.146.386 1.728c-.423.678-1.019 1.545-1.591 2.075s-1.426 1.004-2.122 1.34c-.772.373-1.624.587-2.491.728c-1.758.284-3.59.24-5.33-.118a15 15 0 0 0-3.017-.308m.326-18.803c-.367.367-.504.873-.555 1.664A2.25 2.25 0 0 0 8.25 2.03c-.79.052-1.297.189-1.664.556m10.828 0c-.367-.367-.873-.504-1.664-.555a2.25 2.25 0 0 0 2.22 2.219c-.052-.79-.189-1.297-.556-1.664m0 6.828c-.367.367-.873.504-1.664.555a2.25 2.25 0 0 1 2.22-2.219c-.052.79-.189 1.297-.556 1.664m-10.828 0c.367.367.873.504 1.664.555A2.25 2.25 0 0 0 6.03 7.75c.052.79.189 1.297.556 1.664" />
                          <path fill="currentColor" fill-rule="evenodd"
                            d="M6 5.75A3.75 3.75 0 0 0 9.75 2h4.5A3.75 3.75 0 0 0 18 5.75v.5A3.75 3.75 0 0 0 14.25 10h-4.5A3.75 3.75 0 0 0 6 6.25zM12 7a1 1 0 1 0 0-2a1 1 0 0 0 0 2"
                            clip-rule="evenodd" />
                        </svg>
                        <small class="ms-2">Available</small>
                      </span>
                    </div>
                    <div
                      class="d-flex flex-column justify-content-center align-items-start bg-label-primary p-4 rounded">
                      <div class="d-flex">
                        <div class="h4 fw-semibold text-dark lh-1 mb-3">
                          {{ $userBalances->where('wallet', 'GDZ')->value('locked_balance') }}
                        </div>
                        <div class="h5 ms-1 text-dark">GDZ</div>
                      </div>
                      <span class="text-dark d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M6.26 21.388H6c-.943 0-1.414 0-1.707-.293C4 20.804 4 20.332 4 19.389v-1.112c0-.518 0-.777.133-1.009s.334-.348.736-.582c2.646-1.539 6.403-2.405 8.91-.91q.253.151.45.368a1.49 1.49 0 0 1-.126 2.134a1 1 0 0 1-.427.24q.18-.021.345-.047c.911-.145 1.676-.633 2.376-1.162l1.808-1.365a1.89 1.89 0 0 1 2.22 0c.573.433.749 1.146.386 1.728c-.423.678-1.019 1.545-1.591 2.075s-1.426 1.004-2.122 1.34c-.772.373-1.624.587-2.491.728c-1.758.284-3.59.24-5.33-.118a15 15 0 0 0-3.017-.308" />
                          <path fill="currentColor"
                            d="M6.586 2.586c-.367.367-.504.873-.555 1.664A2.25 2.25 0 0 0 8.25 2.03c-.79.052-1.297.189-1.664.556m10.828 0c-.367-.367-.873-.504-1.664-.555a2.25 2.25 0 0 0 2.22 2.219c-.052-.79-.189-1.297-.556-1.664m0 6.828c-.367.367-.873.504-1.664.555a2.25 2.25 0 0 1 2.22-2.219c-.052.79-.189 1.297-.556 1.664m-10.828 0c.367.367.873.504 1.664.555A2.25 2.25 0 0 0 6.03 7.75c.052.79.189 1.297.556 1.664" />
                          <path fill="currentColor" fill-rule="evenodd"
                            d="M6 5.75A3.75 3.75 0 0 0 9.75 2h4.5A3.75 3.75 0 0 0 18 5.75v.5A3.75 3.75 0 0 0 14.25 10h-4.5A3.75 3.75 0 0 0 6 6.25zM12 7a1 1 0 1 0 0-2a1 1 0 0 0 0 2"
                            clip-rule="evenodd" />
                        </svg>
                        <small class="ms-2 text-dark">Locked</small>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-8">
                  <div class="gdz-token-introduction">
                    <div class="gdz-token-3d-bg"
                      style="background-image: url('{{ asset('assets/img/illustrations/gdz_3d.png') }}')">
                    </div>
                    <p class="text-light">
                      Use Gedzen Token to invest in strategy packs for higher profits. Benefit from promising price growth
                      and more.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col col-12 mt-7">
      <div class="card text-white bg-light">
        <div class="card-body py-10">
          <div class="card-header">
            <h5 class="text-white d-flex align-items-center mb-0"></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
