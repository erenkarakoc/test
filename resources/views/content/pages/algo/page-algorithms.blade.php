@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Algorithms')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/algorithms.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/algorithms.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="page-algorithms">
    <h5 class="mb-3 lh-1">Algorithms</h5>
    <p class="lh-1 mb-7">Explore a wide range of trading algorithms</p>

    <div class="row row-gap-4current-algorithm-items">
      <div class="col col-3">
        <div class="card bg-primary bg-glow current-algorithm-item">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="d-flex flex-column">
                <h5 class="text-white mb-1 fw-bold lh-1">MR</h5>
                <small class="text-white mb-0 lh-1">Mean Reversion</small>
              </div>
              <small class="text-white fw-bold">+4.00$</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="nav-tabs-shadow nav-align-left row mt-12" id="algorithms-nav">
      <div class="col col-md-3">
        <ul class="nav nav-tabs bg-light" role="tablist">
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
            <button type="button" class="nav-link" data-tab-title="Mean Reversion & Statistical Arbitrage"
              data-tab-subtitle="Algorithms that exploit deviations from historical averages and identify opportunities for arbitrage"
              role="tab" data-bs-toggle="tab" data-bs-target="#mrsa" aria-controls="mrsa" aria-selected="false">
              <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M12 22c-4.714 0-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22"
                  opacity=".5" />
                <path fill="currentColor"
                  d="M12 5.25a.75.75 0 0 1 .75.75v12a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75m-5 3a.75.75 0 0 1 .75.75v9a.75.75 0 0 1-1.5 0V9A.75.75 0 0 1 7 8.25m10 4a.75.75 0 0 1 .75.75v5a.75.75 0 0 1-1.5 0v-5a.75.75 0 0 1 .75-.75" />
              </svg>
              MR & Arbitrage
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" data-tab-title="Market Structure & Execution"
              data-tab-subtitle="Algorithms that analyze market microstructure and optimize trade execution for better outcomes"
              role="tab" data-bs-toggle="tab" data-bs-target="#mse" aria-controls="mse" aria-selected="false">
              <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
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
      </div>

      <div class="col col-md-4">
        <div class="tab-content pt-0 ps-0">
          <h6 class="mb-2 lh-1" data-tab-element="title">Basic Algoritmhs</h6>
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
                    data-icon="{{ $algorithm->icon }}">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="d-flex align-items-center w-100">
                        <img class="algorithm-item-icon algorithm-item-icon-{{ $algorithm->icon }}"
                          src="{{ asset('assets/img/illustrations/algorithms/algorithm-' . $algorithm->icon . '.svg') }}"
                          alt="{{ $algorithm->title }}" draggable="false">
                        <div class="d-flex flex-column w-100">
                          <h5 class="d-flex justify-content-between w-100 text-heading mb-1 fw-bold lh-1">
                            <span>{{ $algorithm->title }}</span>
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
                                class="algorithm-contribution">~<span>{{ number_format($algorithm->profit_contribution) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}">
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
                            <span>{{ $algorithm->title }}</span>
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
                                class="algorithm-contribution">~<span>{{ number_format($algorithm->profit_contribution) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}">
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
                            <span>{{ $algorithm->title }}</span>
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
                                class="algorithm-contribution">~<span>{{ number_format($algorithm->profit_contribution) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}">
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

          <div class="tab-pane fade" id="mrsa" role="tabpanel" aria-labelledby="mrsa" tabindex="0">
            <div class="row row-gap-4 mt-7">
              @foreach ($algorithms->where('category', 'MRSA') as $algorithm)
                <div class="col col-12">
                  <div class="algorithm-item p-4 rounded">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="d-flex align-items-center w-100">
                        <img class="algorithm-item-icon algorithm-item-icon-{{ $algorithm->icon }}"
                          src="{{ asset('assets/img/illustrations/algorithms/algorithm-' . $algorithm->icon . '.svg') }}"
                          alt="{{ $algorithm->title }}" draggable="false">
                        <div class="d-flex flex-column w-100">
                          <h5 class="d-flex justify-content-between w-100 text-heading mb-1 fw-bold lh-1">
                            <span>{{ $algorithm->title }}</span>
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
                                class="algorithm-contribution">~<span>{{ number_format($algorithm->profit_contribution) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}">
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
                            <span>{{ $algorithm->title }}</span>
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
                                class="algorithm-contribution">~<span>{{ number_format($algorithm->profit_contribution) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}">
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
                            <span>{{ $algorithm->title }}</span>
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
                                class="algorithm-contribution">~<span>{{ number_format($algorithm->profit_contribution) }}</span>%</span>
                            </div>
                          </h5>
                          <small class="mb-0">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </div>
                    <p class="algorithm-description text-light mt-3">{{ $algorithm->description }}</p>
                    <button class="algorithm-add-button" data-title="{{ $algorithm->title }}"
                      data-subtitle="{{ $algorithm->subtitle }}"
                      data-contribution="{{ $algorithm->profit_contribution }}" data-icon="{{ $algorithm->icon }}">
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
            View costs and estimated incomes at the end of the strategy period
          </small>

          <div class="card bg-light border">
            <div class="card-header">
              <h6 class="mb-0 lh-1 fw-normal">Strategy Summary</h6>
            </div>

            <div class="card-body">
              <div id="strategy-content">
                <div class="bg-light border rounded p-5">
                  <div class="d-flex align-items-center">
                    <div class="d-flex flex-column">
                      <label class="text-nowrap mb-2" for="lock_amount">Amount to Lock</label>
                      <div class="input-group flex-nowrap">
                        <small class="input-group-text text-white">$</small>
                        <input type="number" class="form-control w-100" placeholder="0.00" id="lock_amount">
                        <button class="input-group-text">Max.</button>
                      </div>
                    </div>
                    <div class="algorithm-glow"></div>
                  </div>

                  <div class="d-flex flex-column row-gap-2 mt-4" id="algorithm-sm-items">
                    <small class="algorithm-sm-item w-100 justify-content-center mt-1" id="algorithms-empty-text">
                      Pick some algorithms to get started!
                    </small>
                  </div>
                </div>
              </div>

              <div class="table-responsive mt-4 border rounded overflow-hidden">
                <table class="table">
                  <tbody class="table-border-bottom-0">
                    <tr>
                      <td><small class="text-light">Algorithm Cost</small></td>
                      <td class="text-end"></td>
                      <td class="text-end"><span class="text-white">~0.00$</span></td>
                    </tr>
                    <tr>
                      <td><small class="text-light">Income</small></td>
                      <td class="text-end"><span class="text-white">~4%</span></td>
                      <td class="text-end"><span class="text-white">~0.00$</span></td>
                    </tr>
                    <tr>
                      <td><small class="text-light">Total Balance After</small></td>
                      <td class="text-end"><span class="text-white">~4%</span></td>
                      <td class="text-end"><span class="text-white">~23.120.00$</span></td>
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
                  Amounts specified above are estimated and minor changes can happen when executing trades.
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
  @endsection
