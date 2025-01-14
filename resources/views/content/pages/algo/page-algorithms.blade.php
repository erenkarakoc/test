@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Algorithms')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/flatpickr/flatpickr.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/algorithms.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/algorithms.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="page-algorithms">
    <h5 class="mb-3 lh-1">Algorithms</h5>
    <p class="lh-1 mb-7">Explore a wide range of trading algorithms and build your own strategy</p>

    <div class="row">
      <div class="col col-6">
        <div
          class="card bg-light border bg-glow wallet-item wallet-item-{{ $userBalances->where('wallet', 'GDZ')->value('wallet') }}">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                {!! $walletIconSymbols[$userBalances->where('wallet', 'GDZ')->value('wallet')] ?? '' !!}
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
      <div class="col col-6">
        <div class="card bg-light border bg-glow h-100 p-4">
          <div class="d-flex justify-content-between align-items-center h-100">
            <div class="d-flex align-items-center gap-2">
              <div class="d-flex justify-content-center align-items-center" style="height: 36px; width: 36px;">
                <svg class="flex-shrink-0 text-white" width="18" height="18" viewBox="0 0 20 20" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <path opacity="0.7"
                    d="M11.9248 18.9979L17.2797 11.3481C17.5629 10.9434 17.7045 10.4717 17.7043 10H10V20C10.7285 20 11.4571 19.666 11.9248 18.9979Z"
                    fill="currentColor"></path>
                  <path opacity="0.5"
                    d="M11.9248 1.00208L17.2797 8.65194C17.5629 9.05663 17.7045 9.52833 17.7043 10H10V0C10.7285 -3.33786e-05 11.4571 0.333993 11.9248 1.00208Z"
                    fill="currentColor"></path>
                  <path opacity="0.7"
                    d="M8.07646 1.00208L2.72156 8.65194C2.43827 9.05663 2.29671 9.52833 2.29688 10L10.0012 10L10.0012 2.5109e-09C9.27267 -3.34398e-05 8.54412 0.333993 8.07646 1.00208Z"
                    fill="currentColor"></path>
                  <path
                    d="M8.07646 18.9979L2.72156 11.3481C2.43827 10.9434 2.29671 10.4717 2.29688 10L10.0012 10L10.0012 20C9.27267 20 8.54412 19.666 8.07646 18.9979Z"
                    fill="currentColor"></path>
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
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
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
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
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
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M14 21h-4c-3.771 0-5.657 0-6.828-1.172S2 16.771 2 13v-.25h20V13c0 3.771 0 5.657-1.172 6.828S17.771 21 14 21M10 3h4c3.771 0 5.657 0 6.828 1.172S22 7.229 22 11v.25H2V11c0-3.771 0-5.657 1.172-6.828S6.229 3 10 3"
                    opacity=".5" />
                  <path fill="currentColor" fill-rule="evenodd" d="M22 12.75H2v-1.5h20z" clip-rule="evenodd" />
                  <path fill="currentColor"
                    d="M12.75 16.5a.75.75 0 0 1 .75-.75H18a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75m0-9a.75.75 0 0 1 .75-.75H18a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75M6 18.25a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 1 1.5 0v2a.75.75 0 0 1-.75.75m0-9a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 1 1.5 0v2a.75.75 0 0 1-.75.75m3 9a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 1 1.5 0v2a.75.75 0 0 1-.75.75m0-9a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 1 1.5 0v2a.75.75 0 0 1-.75.75" />
                </svg>
                ML & Predictive
              </button>
            </li>
          </ul>

          <div class="d-flex flex-column row-gap-2 mt-4">
            <button type="button"
              class="btn btn-sm btn-label-primary rounded w-100 justify-content-start text-left"data-bs-toggle="modal"
              data-bs-target="#buildGuideModal">
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
            <button type="button" class="btn btn-sm btn-label-primary rounded w-100 justify-content-start">
              <svg class="me-2 ms-2" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                viewBox="0 0 24 24">
                <path opacity="0.7"
                  d="M13.0119 20.0474L18.0223 12.7806C18.2873 12.3962 18.4198 11.9481 18.4196 11.5H11.2109V20.9994C11.8926 20.9994 12.5743 20.6821 13.0119 20.0474Z"
                  fill="currentColor" />
                <path opacity="0.5"
                  d="M13.0119 2.95191L18.0223 10.2188C18.2873 10.6032 18.4198 11.0513 18.4196 11.4994H11.2109V2C11.8926 1.99997 12.5743 2.31727 13.0119 2.95191Z"
                  fill="currentColor" />
                <path opacity="0.7"
                  d="M9.40777 2.95191L4.39736 10.2188C4.13229 10.6032 3.99984 11.0513 4 11.4994H11.2087V2C10.527 1.99997 9.84534 2.31727 9.40777 2.95191Z"
                  fill="currentColor" />
                <path
                  d="M9.40777 20.0474L4.39736 12.7806C4.13229 12.3962 3.99984 11.9481 4 11.5H11.2087V20.9994C10.527 20.9994 9.84534 20.6821 9.40777 20.0474Z"
                  fill="currentColor" />
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
                    data-subtitle="{{ $algorithm->subtitle }}" data-contribution="{{ $algorithm->profit_contribution }}"
                    data-icon="{{ $algorithm->icon }}" data-category="{{ $algorithm->category }}">
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
              <div id="strategy-content">
                <div class="bg-light border rounded p-5">
                  <div class="d-flex align-items-center">
                    <div class="d-flex flex-column w-100">
                      <label class="text-nowrap mb-2" for="lock_amount">Amount to Lock</label>
                      <div class="input-group flex-nowrap">
                        <small class="input-group-text text-white">$</small>
                        <input type="number" class="form-control w-100" placeholder="0.00" id="lock_amount"
                          min="1" data-max="{{ $userTotalBalance }}" pattern="^\d*(\.\d{0,2})?$">
                        <button type="button" class="input-group-text"
                          onclick="if ({{ $userTotalBalance }}) document.querySelector('#lock_amount').value = ({{ $userTotalBalance }}).toFixed(2)"
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
                            d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
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
                    <small class="d-flex justify-content-center align-items-center text-center border rounded p-2 w-100"
                      id="algorithms-empty-text">
                      Pick some algorithms to get started.
                    </small>
                  </div>
                </div>
              </div>

              <h6 class="mb-0 lh-1 fw-normal mt-8 mb-4">Summary</h6>

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

              <small class="d-flex align-items-start text-primary gap-2 mt-8">
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

              <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-sm btn-primary">Proceed</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade modal-lg" id="buildGuideModal" tabindex="-1" aria-labelledby="buildGuideModal"
      aria-hidden="true">
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

                    <div class="row flex-row row-gap-4 mt-5">
                      <div class="col col-6">
                        <div class="d-flex flex-column border rounded p-4 h-100">
                          <span class="text-heading">Trend-Following</span>
                          <small class="mt-2">
                            These algorithms follow the market trend, capitalizing on upward or downward price movements.
                          </small>
                        </div>
                      </div>
                      <div class="col col-6">
                        <div class="d-flex flex-column border rounded p-4 h-100">
                          <span class="text-heading">Mean Reversion</span>
                          <small class="mt-2">
                            These algorithms examine historical average over time and contributes the general strategy.
                          </small>
                        </div>
                      </div>
                      <div class="col col-6">
                        <div class="d-flex flex-column border rounded p-4 h-100">
                          <span class="text-heading">Market Structure & Execution</span>
                          <small class="mt-2">
                            Focuses on improving the execution of trades within specific market conditions.
                          </small>
                        </div>
                      </div>
                      <div class="col col-6">
                        <div class="d-flex flex-column border rounded p-4 h-100">
                          <span class="text-heading">Machine Learning</span>
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
                            These strategies may not work well together as the migh depend on opposing market behaviors.
                          </small>
                        </div>
                      </li>
                      <li class="list-group-item d-flex align-items-center">
                        <svg class="me-1 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M14 21h-4c-3.771 0-5.657 0-6.828-1.172S2 16.771 2 13v-.25h20V13c0 3.771 0 5.657-1.172 6.828S17.771 21 14 21M10 3h4c3.771 0 5.657 0 6.828 1.172S22 7.229 22 11v.25H2V11c0-3.771 0-5.657 1.172-6.828S6.229 3 10 3"
                            opacity=".5"></path>
                          <path fill="currentColor" fill-rule="evenodd" d="M22 12.75H2v-1.5h20z" clip-rule="evenodd">
                          </path>
                          <path fill="currentColor"
                            d="M12.75 16.5a.75.75 0 0 1 .75-.75H18a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75m0-9a.75.75 0 0 1 .75-.75H18a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75M6 18.25a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 1 1.5 0v2a.75.75 0 0 1-.75.75m0-9a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 1 1.5 0v2a.75.75 0 0 1-.75.75m3 9a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 1 1.5 0v2a.75.75 0 0 1-.75.75m0-9a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 1 1.5 0v2a.75.75 0 0 1-.75.75">
                          </path>
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
                          <b>Machine Learning &rarr; Mean Reversion</b>
                          <small>
                            Machine learning algorithms might not align wel with th assumptions behind mean reversion.
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
                      Some algorithms in specific categories may perform better over longer periods, while others may be
                      more effective in shorter periods.
                    </small>

                    <ul class="list-group mt-4">
                      <li class="list-group-item d-flex align-items-center">
                        <svg class="me-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                          viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                            opacity=".5"></path>
                          <path fill="currentColor"
                            d="M14.5 10.75a.75.75 0 0 1 0-1.5H17a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-1.5 0v-.69l-2.013 2.013a1.75 1.75 0 0 1-2.474 0l-1.586-1.586a.25.25 0 0 0-.354 0L7.53 14.53a.75.75 0 0 1-1.06-1.06l2.293-2.293a1.75 1.75 0 0 1 2.474 0l1.586 1.586a.25.25 0 0 0 .354 0l2.012-2.013z">
                          </path>
                        </svg>
                        <div class="d-flex flex-column">
                          <b>Trend Following &rarr; Better on longer period</b>
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
                      <li class="list-group-item d-flex align-items-center">
                        <svg class="me-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                          height="24" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                            opacity=".5"></path>
                          <path fill="currentColor"
                            d="M17.576 10.48a.75.75 0 0 0-1.152-.96l-1.797 2.156c-.37.445-.599.716-.786.885a.8.8 0 0 1-.163.122l-.011.005l-.008-.004l-.003-.001a.8.8 0 0 1-.164-.122c-.187-.17-.415-.44-.786-.885l-.292-.35c-.328-.395-.625-.75-.901-1c-.301-.272-.68-.514-1.18-.514s-.878.242-1.18.514c-.276.25-.572.605-.9 1l-1.83 2.194a.75.75 0 0 0 1.153.96l1.797-2.156c.37-.445.599-.716.786-.885a.8.8 0 0 1 .163-.122l.007-.003l.004-.001q.004 0 .011.004a.8.8 0 0 1 .164.122c.187.17.415.44.786.885l.292.35c.329.395.625.75.901 1c.301.272.68.514 1.18.514s.878-.242 1.18-.514c.276-.25.572-.605.9-1z">
                          </path>
                        </svg>
                        <div class="d-flex flex-column">
                          <b>Market Structure & Execution &rarr; Better on shorter period</b>
                          <small>
                            Suited for short periods, focusing on rapid trades and precise execution strategies.
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
