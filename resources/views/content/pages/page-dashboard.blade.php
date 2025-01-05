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
  @vite(['resources/assets/vendor/scss/pages/dashboard.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/dashboard.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <h5 class="mb-3 lh-1">Welcome back, {{ Auth::user()->username }}! 👋🏻</h5>
      <p class="mb-7 lh-1">Here's a summary of your account</p>

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

          <div class="popover-trigger text-light cursor-pointer d-flex align-items-start" data-bs-toggle="popover"
            data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
            data-bs-content="Total profit you've earned throughout your Gedzen journey.">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
              <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                opacity=".3" />
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
          <a href="{{ route('page-add-funds') }}"
            class="d-flex align-items-start gap-2 btn btn-primary border border-light">
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
          <a href="javascript:;" class="d-flex align-items-start gap-2 btn btn-primary border border-light"
            id="inviteFriendsButton">
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
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
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

    <div class="col col-12 mt-7 gdz-refer-friends">
      <div class="card text-white bg-light">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-4">
              <div class="d-flex align-items-center">
                <span class="text-primary">
                  <svg width="28" height="28" viewBox="0 0 100 100" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M14.4335 85.5673C20.5418 91.6673 30.3585 91.6673 50.0002 91.6673C69.6418 91.6673 79.4627 91.6673 85.5627 85.5631C91.6668 79.4673 91.6668 69.6423 91.6668 50.0006C91.6668 30.359 91.6668 20.5382 85.5627 14.434C79.4668 8.33398 69.6418 8.33398 50.0002 8.33398C30.3585 8.33398 20.5377 8.33398 14.4335 14.434C8.3335 20.5423 8.3335 30.359 8.3335 50.0006C8.3335 69.6423 8.3335 79.4673 14.4335 85.5673Z"
                      fill="currentColor" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M53.6211 34.0721C53.6211 29.6159 57.2057 26 61.6219 26C62.6704 25.9972 63.7093 26.2037 64.6791 26.6079C65.6488 27.0121 66.5305 27.6059 67.2737 28.3555C68.0169 29.1052 68.6071 29.9959 69.0106 30.9767C69.414 31.9576 69.6228 33.0095 69.625 34.0721C69.625 38.5308 66.0404 42.1467 61.6219 42.1467C60.5623 42.1474 59.5132 41.9351 58.5352 41.5218C57.5573 41.1086 56.67 40.5027 55.9248 39.7393L44.8485 47.3827C45.1564 48.94 45.0052 50.5547 44.4136 52.0255L56.5581 60.1145C57.9889 58.9329 59.7786 58.2887 61.6243 58.2909C62.6728 58.2883 63.7116 58.4952 64.6813 58.8996C65.6509 59.3041 66.5324 59.8982 67.2754 60.6481C68.0184 61.3979 68.6083 62.2888 69.0115 63.2698C69.4146 64.2508 69.6231 65.3027 69.625 66.3654C69.625 70.8216 66.0404 74.4375 61.6219 74.4375C60.5735 74.44 59.5349 74.2332 58.5654 73.8289C57.5959 73.4246 56.7145 72.8307 55.9716 72.0811C55.2286 71.3315 54.6386 70.4409 54.2353 69.4602C53.832 68.4795 53.6233 67.4278 53.6211 66.3654C53.6193 65.2335 53.8547 64.1141 54.3118 63.0813L42.2629 55.0625C40.8033 56.3475 38.9341 57.0538 37.0007 57.0509C35.9522 57.0534 34.9134 56.8465 33.9437 56.4421C32.9741 56.0376 32.0926 55.4435 31.3496 54.6936C30.6066 53.9438 30.0167 53.0529 29.6135 52.0719C29.2104 51.0909 29.0019 50.039 29 48.9763C29.0022 47.9139 29.2109 46.8622 29.6142 45.8815C30.0175 44.9008 30.6075 44.0102 31.3504 43.2606C32.0934 42.511 32.9748 41.9171 33.9443 41.5128C34.9138 41.1085 35.9524 40.9017 37.0007 40.9042C39.5434 40.9042 41.804 42.0982 43.2689 43.9582L54.0059 36.5497C53.7498 35.7495 53.6199 34.9134 53.6211 34.0721Z"
                      fill="#fff"opacity=".7" />
                  </svg>
                </span>
                <h5 class="d-flex align-items-center ms-2 mb-0">
                  Invite your friends & earn
                  <div class="popover-trigger text-light cursor-pointer ms-2" data-bs-toggle="popover"
                    data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                    data-bs-content="Share your invitation link with your friends and bring them to Gedzen. You will be able to earn bonuses from your friends' investments when they sign-up with your invitation code.">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                      <path fill="currentColor"
                        d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                  </div>
                </h5>
              </div>
            </div>
            <div class="col-8">
              <div class="refer-wrapper">
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                      <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2.5">
                        <path d="M14 12a6 6 0 1 1-6-6" />
                        <path d="M10 12a6 6 0 1 1 6 6" opacity=".5" />
                      </g>
                    </svg>
                  </span>
                  <input type="text" class="form-control"
                    value="{{ route('register') }}?invite={{ Auth::user()->ref_code }}" readonly disabled
                    id='ref-copy-input' />
                  <span class="input-group-text cursor-pointer"
                    onclick="navigator.clipboard.writeText('{{ route('register') }}?invite={{ Auth::user()->ref_code }}');document.querySelector('#ref-copy-link-text').textContent = 'Copied';">
                    <div class="d-flex align-items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847s-.843-2.21-.843-4.936z" />
                        <path fill="currentColor"
                          d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2S5.343 2 4.172 3.172"
                          opacity=".5" />
                      </svg>
                      <small class="ms-1 text-heading" id="ref-copy-link-text">Copy</small>
                    </div>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
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
                  Current Price: <span
                    class="text-dark fw-semibold">{{ number_format($marketDataPrices['GDZ'], 2) }}$</span>
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
                          {{ number_format($userBalances->where('wallet', 'GDZ')->value('balance'), 2) }}
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
                          {{ number_format($userBalances->where('wallet', 'GDZ')->value('locked_balance'), 2) }}
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
                      Use Gedzen Token to invest in strategy packs with higher profits. Benefit from promising price
                      growth and more.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col col-7 mt-7">
      <div class="card text-white bg-light">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <span class="text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M3.464 20.536C4.93 22 7.286 22 12 22s7.071 0 8.535-1.465C22 19.072 22 16.714 22 12s0-7.071-1.465-8.536C19.072 2 16.714 2 12 2S4.929 2 3.464 3.464C2 4.93 2 7.286 2 12s0 7.071 1.464 8.535" />
                  <path fill="#fff"
                    d="M13.25 7a.75.75 0 0 1 1.315-.493l3 3.437a.75.75 0 0 1-1.13.987L14.75 9v8a.75.75 0 0 1-1.5 0zm-5.685 6.07a.75.75 0 1 0-1.13.986l3 3.437A.75.75 0 0 0 10.75 17V7a.75.75 0 0 0-1.5 0v8z"
                    opacity=".7" />
                </svg>
              </span>
              <h5 class="d-flex align-items-center ms-2 mb-0">
                Transactions
              </h5>
            </div>
            <a href="{{ route('page-transactions') }}" class="btn btn-sm btn-primary">View All</a>
          </div>
        </div>
        <div class="card-body">
          <div class="transaction-items">
            <a href="#" class="transaction-item transaction-item-in">
              <div class="d-flex align-items-start">
                <div class="transaction-item-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                      <circle cx="12" cy="12" r="10" opacity=".5" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                    </g>
                  </svg>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-0">Received via USDT</h6>
                  <div class="d-flex align-items-center">
                    <small class="text-light">24 Dec, 2024</small>
                    <small class="transaction-status transaction-status-completed">Completed</small>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="d-flex flex-column align-items-end text-right">
                  <span class="transaction-usd-amount">+10$</span>
                  <span class="transaction-asset-amount text-light">10 BTC</span>
                </div>
                <span class="transaction-item-view">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2.5" d="m9 5l6 7l-6 7" />
                  </svg>
                </span>
              </div>
            </a>
            <a href="#" class="transaction-item transaction-item-out">
              <div class="d-flex align-items-start">
                <div class="transaction-item-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                      <circle cx="12" cy="12" r="10" opacity=".5" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                    </g>
                  </svg>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-0">Sending via USDT</h6>
                  <div class="d-flex align-items-center">
                    <small class="text-light">24 Dec, 2024</small>
                    <small class="transaction-status transaction-status-pending">Pending</small>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="d-flex flex-column align-items-end text-right">
                  <span class="transaction-usd-amount">-10$</span>
                  <span class="transaction-asset-amount text-light">10 BTC</span>
                </div>
                <span class="transaction-item-view">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2.5" d="m9 5l6 7l-6 7" />
                  </svg>
                </span>
              </div>
            </a>
            <a href="#" class="transaction-item transaction-item-bonus">
              <div class="d-flex align-items-start">
                <div class="transaction-item-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                      <circle cx="12" cy="12" r="10" opacity=".5" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                    </g>
                  </svg>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-0">Earned via USDT</h6>
                  <div class="d-flex align-items-center">
                    <small class="text-light">24 Dec, 2024</small>
                    <small class="transaction-status transaction-status-rejected">Rejected</small>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="d-flex flex-column align-items-end text-right">
                  <span class="transaction-usd-amount">+10$</span>
                  <span class="transaction-asset-amount text-light">10 BTC</span>
                </div>
                <span class="transaction-item-view">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2.5" d="m9 5l6 7l-6 7" />
                  </svg>
                </span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col col-5 mt-7">
      <div class="card text-white bg-light">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <span class="text-primary">

                <svg width="28" height="28" viewBox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M4.0415 23.9593C5.75183 25.6673 8.5005 25.6673 14.0002 25.6673C19.4998 25.6673 22.2497 25.6673 23.9577 23.9582C25.6668 22.2513 25.6668 19.5003 25.6668 14.0007C25.6668 8.50098 25.6668 5.75115 23.9577 4.04198C22.2508 2.33398 19.4998 2.33398 14.0002 2.33398C8.5005 2.33398 5.75066 2.33398 4.0415 4.04198C2.3335 5.75232 2.3335 8.50098 2.3335 14.0007C2.3335 19.5003 2.3335 22.2513 4.0415 23.9593Z"
                    fill="currentColor" />
                  <path opacity="0.7" fill-rule="evenodd" clip-rule="evenodd"
                    d="M14 6.125C14.2321 6.125 14.4546 6.21719 14.6187 6.38128C14.7828 6.54538 14.875 6.76794 14.875 7V7.36983C16.7767 7.7105 18.375 9.13967 18.375 11.0833C18.375 11.3154 18.2828 11.538 18.1187 11.7021C17.9546 11.8661 17.7321 11.9583 17.5 11.9583C17.2679 11.9583 17.0454 11.8661 16.8813 11.7021C16.7172 11.538 16.625 11.3154 16.625 11.0833C16.625 10.2923 15.967 9.4535 14.875 9.15483V13.2032C16.7767 13.5438 18.375 14.973 18.375 16.9167C18.375 18.8603 16.7767 20.2895 14.875 20.6302V21C14.875 21.2321 14.7828 21.4546 14.6187 21.6187C14.4546 21.7828 14.2321 21.875 14 21.875C13.7679 21.875 13.5454 21.7828 13.3813 21.6187C13.2172 21.4546 13.125 21.2321 13.125 21V20.6302C11.2233 20.2895 9.625 18.8603 9.625 16.9167C9.625 16.6846 9.71719 16.462 9.88128 16.2979C10.0454 16.1339 10.2679 16.0417 10.5 16.0417C10.7321 16.0417 10.9546 16.1339 11.1187 16.2979C11.2828 16.462 11.375 16.6846 11.375 16.9167C11.375 17.7077 12.033 18.5465 13.125 18.844V14.7968C11.2233 14.4562 9.625 13.027 9.625 11.0833C9.625 9.13967 11.2233 7.7105 13.125 7.36983V7C13.125 6.76794 13.2172 6.54538 13.3813 6.38128C13.5454 6.21719 13.7679 6.125 14 6.125ZM13.125 9.15483C12.033 9.4535 11.375 10.2923 11.375 11.0833C11.375 11.8743 12.033 12.7132 13.125 13.0107V9.15483ZM16.625 16.9167C16.625 16.1257 15.967 15.2868 14.875 14.9893V18.844C15.967 18.5465 16.625 17.7077 16.625 16.9167Z"
                    fill="#fff" />
                </svg>
              </span>
              <h5 class="d-flex align-items-center ms-2 mb-0">
                Profits
              </h5>
            </div>
            <a href="#" class="btn btn-sm btn-primary">View All</a>
          </div>
        </div>
        <div class="card-body">
          <div class="transaction-items">
            <a href="#" class="transaction-item transaction-item-in">
              <div class="d-flex align-items-start">
                <div class="transaction-item-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                      <circle cx="12" cy="12" r="10" opacity=".5" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                    </g>
                  </svg>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-0">Received via USDT</h6>
                  <div class="d-flex align-items-center">
                    <small class="text-light">24 Dec, 2024</small>
                    <small class="transaction-status transaction-status-completed">Completed</small>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="d-flex flex-column align-items-end text-right">
                  <span class="transaction-usd-amount">+10$</span>
                  <span class="transaction-asset-amount text-light">10 BTC</span>
                </div>
                <span class="transaction-item-view">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2.5" d="m9 5l6 7l-6 7" />
                  </svg>
                </span>
              </div>
            </a>
            <a href="#" class="transaction-item transaction-item-out">
              <div class="d-flex align-items-start">
                <div class="transaction-item-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                      <circle cx="12" cy="12" r="10" opacity=".5" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                    </g>
                  </svg>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-0">Sending via USDT</h6>
                  <div class="d-flex align-items-center">
                    <small class="text-light">24 Dec, 2024</small>
                    <small class="transaction-status transaction-status-pending">Pending</small>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="d-flex flex-column align-items-end text-right">
                  <span class="transaction-usd-amount">-10$</span>
                  <span class="transaction-asset-amount text-light">10 BTC</span>
                </div>
                <span class="transaction-item-view">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2.5" d="m9 5l6 7l-6 7" />
                  </svg>
                </span>
              </div>
            </a>
            <a href="#" class="transaction-item transaction-item-bonus">
              <div class="d-flex align-items-start">
                <div class="transaction-item-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                      <circle cx="12" cy="12" r="10" opacity=".5" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                    </g>
                  </svg>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-0">Earned via USDT</h6>
                  <div class="d-flex align-items-center">
                    <small class="text-light">24 Dec, 2024</small>
                    <small class="transaction-status transaction-status-rejected">Rejected</small>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="d-flex flex-column align-items-end text-right">
                  <span class="transaction-usd-amount">+10$</span>
                  <span class="transaction-asset-amount text-light">10 BTC</span>
                </div>
                <span class="transaction-item-view">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2.5" d="m9 5l6 7l-6 7" />
                  </svg>
                </span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
