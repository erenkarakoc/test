@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Strategy Packs')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/strategy-packs.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/strategy-packs.js'])
@endsection

@section('content')
  <div class="page-strategy-packs">
    <h5 class="mb-3 lh-1">Strategy Packs</h5>
    <p class="lh-1 mb-7">See our pre-defined strategy packs for optimized algo-trading</p>

    <div class="row">
      <div class="col col-md-6">
        <div class="swiper-slide bg-primary rounded p-4 text-white">
          <div class="row">
            <div class="col-12">
              <div class="h5 d-flex align-items-center text-white mb-0">
                <span class="me-1">Momentum</span>
                <div class="popover-trigger text-white cursor-pointer" data-bs-toggle="popover" data-bs-trigger="hover"
                  data-bs-placement="top" data-bs-custom-class="popover-dark"
                  data-bs-content="Focused on strategies that capitalize on market momentum, offering moderate returns with higher risk exposure.">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                      opacity=".3" />
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
      </div>
    </div>

    <div class="strategy-packs-table row mt-7">
      <h6 class="mb-2 lh-1">Details</h6>
      <small class="lh-1 mb-7">Review the contents of each strategy pack and choose the one that best fits you</small>

      <div class="row">
        <div class="col-12">
          <div class="table-responsive border border-top-0 rounded">
            <table class="table table-striped text-center mb-0">
              <thead>
                <tr>
                  <th scope="col">
                    <p class="mb-0">Algorithms</p>
                    <small class="text-body fw-normal" style="text-transform: none">Pre-defined</small>
                  </th>
                  <th scope="col">
                    <p class="mb-0">Starter</p>
                    <small class="text-body fw-normal text-capitalize">Free</small>
                  </th>
                  <th scope="col">
                    <p class="mb-0 position-relative">Pro
                      <span class="badge badge-center rounded-pill bg-primary position-absolute mt-n2 ms-1"><i
                          class="ti ti-star mt-n1"></i></span>
                    </p>
                    <small class="text-body fw-normal text-capitalize">$7.5/month</small>
                  </th>
                  <th scope="col">
                    <p class="mb-0">Enterprise</p>
                    <small class="text-body fw-normal text-capitalize">$16/month</small>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-heading">14-days free trial</td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td class="text-heading">No user limit</td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td class="text-heading">Product Support</td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td class="text-heading">Email Support</td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td>
                    <span class="badge bg-label-primary badge-sm">Add-On-Available</span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td class="text-heading">Integrations</td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td class="text-heading">Removal of Front branding</td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td>
                    <span class="badge bg-label-primary badge-sm">Add-On-Available</span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td class="text-heading">Active maintenance &amp; support</td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td class="text-heading">Data storage for 365 days</td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                      <i class="ti ti-x"></i>
                    </span>
                  </td>
                  <td><span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                      <i class="ti ti-check"></i>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <a href="payment-page.html" class="btn text-nowrap btn-label-primary waves-effect">Choose</a>
                  </td>
                  <td>
                    <a href="payment-page.html" class="btn text-nowrap btn-primary waves-effect waves-light">Choose</a>
                  </td>
                  <td>
                    <a href="payment-page.html" class="btn text-nowrap btn-label-primary waves-effect">Choose</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
