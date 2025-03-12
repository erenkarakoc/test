@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Add Funds')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/bs-stepper/bs-stepper.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/bs-stepper/bs-stepper.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/add-funds.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/add-funds.js', 'resources/assets/js/helpers/gdzhelpers.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="row page-add-funds">
    <div class="col col-12">
      <h5 class="mb-3 lh-1">Add Funds</h5>
      <small class="lh-1 mb-7">
        Fund your account with to start the adventure
      </small>

      <div class="card mt-7">
        <div class="card-body">
          <div id="addFunds" class="bs-stepper bg-light mt-2">
            <div class="bs-stepper-header justify-content-center">
              <div class="step" data-target="#chooseAssetStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Asset</span>
                    <span class="bs-stepper-subtitle">Choose the asset</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5" d="m9 5l6 7l-6 7" />
                </svg>
              </div>
              <div class="step" data-target="#enterAmountStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Amount</span>
                    <span class="bs-stepper-subtitle">Enter the amount</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5" d="m9 5l6 7l-6 7" />
                </svg>
              </div>
              <div class="step" data-target="#summaryStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Summary</span>
                    <span class="bs-stepper-subtitle">View the summary</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5" d="m9 5l6 7l-6 7" />
                </svg>
              </div>
              <div class="step" data-target="#proceedStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">4</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Proceed</span>
                    <span class="bs-stepper-subtitle">Make the payment</span>
                  </span>
                </button>
              </div>
              <div class="step d-none" data-target="#completedStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">5</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Completed!</span>
                    <span class="bs-stepper-subtitle">Funds added</span>
                  </span>
                </button>
              </div>
            </div>

            <div class="bs-stepper-content">
              <form id="addFundsForm" onSubmit="return false" novalidate>
                @csrf

                <!-- Choose Asset Step -->
                <div id="chooseAssetStep" class="content">
                  <div class="content-header mb-4 col-8 mx-auto">
                    <h6 class="mb-0">Choose an asset</h6>
                    <small>Choose the asset you want to debit</small>
                  </div>

                  <div class="col-8 mt-6 mx-auto">
                    <small class="d-flex align-items-center text-primary gap-2">
                      <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                          opacity=".4" />
                        <path fill="currentColor"
                          d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                      </svg>
                      Currency rate will be kept fixed for 30 minutes after you proceed.
                    </small>
                  </div>

                  <div class="row g-2 col-8 mt-5 mx-auto choose-asset-form-row">
                    @foreach ($assets as $asset)
                      @if ($asset['symbol'] !== 'GDZ' && $asset['symbol'] !== 'USD')
                        <div class="col-6">
                          <div class="form-check custom-option custom-option-basic">
                            <label class="form-check-label custom-option-content d-flex align-items-center"
                              for="asset{{ $asset['symbol'] }}">
                              <input name="asset" class="form-check-input chooseAssetRadio me-4" type="radio"
                                value="{{ $asset['symbol'] }}" id="asset{{ $asset['symbol'] }}" />
                              <div class="d-flex">
                                {!! $walletIcons[$asset['symbol']] ?? '' !!}
                                <div class="d-flex flex-column ms-2">
                                  <span class="fw-medium">{{ $asset['title'] }}</span>
                                  <small>
                                    {{ $asset['symbol'] }}
                                    {{ $asset['symbol'] === 'USDT'
                                        ? '(TRC-20)'
                                        : ($asset['symbol'] === 'TRX'
                                            ? '(TRC-20)'
                                            : ($asset['symbol'] === 'ETH'
                                                ? '(ERC-20)'
                                                : ($asset['symbol'] === 'ETC'
                                                    ? '(ERC-20)'
                                                    : ($asset['symbol'] === 'BNB'
                                                        ? '(BSC-20)'
                                                        : '')))) }}
                                  </small>
                                </div>
                              </div>
                            </label>
                          </div>
                        </div>
                      @endif
                    @endforeach
                  </div>

                  <div class="col-8 mt-2 mx-auto px-1 choose-asset-error-message"></div>

                  <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                    <button class="btn btn-primary btn-next">
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Continue</span>
                    </button>
                  </div>
                  <!-- Personal Info -->
                </div>

                <!-- Enter Amount Step -->
                <div id="enterAmountStep" class="content">
                  <div class="content-header mb-4 col-8 mx-auto">
                    <h6 class="mb-0">Amount</h6>
                    <small>Enter the amount you want to debit</small>
                  </div>

                  <div class="col-8 mt-6 mx-auto">
                    <small class="d-flex align-items-center text-primary gap-2">
                      <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                          opacity=".4" />
                        <path fill="currentColor"
                          d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                      </svg>
                      Currency rate will be kept fixed for 30 minutes after you proceed.
                    </small>
                  </div>

                  <div class="row g-6 mt-6">
                    <div class="col-8 mx-auto mt-0">
                      <div class="row g-2">
                        <div class="col-5 enter-amount-col">
                          <label class="text-heading mb-2" for="assetAmountInput">Amount in <span
                              class="chosen-asset-text"></span></label>
                          <div class="form-floating">
                            <input name="asset_amount" type="number" class="form-control" id="assetAmountInput"
                              placeholder="0.00" aria-describedby="assetAmountInputHelp"
                              onKeyPress="if(this.value.length==9) return false;" />
                            <label for="assetAmountInput" class="chosen-asset-text"></label>
                            <span class="amount-error-message"></span>
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="d-flex justify-content-center align-items-center h-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5">
                                <path d="m11 19l6-7l-6-7" opacity=".8" />
                                <path d="m7 19l6-7l-6-7" opacity=".4" />
                              </g>
                            </svg>
                          </div>
                        </div>
                        <div class="col-5 enter-amount-col">
                          <label class="text-heading mb-2" for="usdAmountInput">Amount in USD</label>
                          <div class="form-floating">
                            <input name="usd_amount" type="number" class="form-control" id="usdAmountInput"
                              placeholder="0.00" aria-describedby="floatingInputHelp"
                              onKeyPress="if(this.value.length==9) return false;" />
                            <label for="usdAmountInput">USD</label>
                            <div id="usdAmountInputHelp" class="form-text text-light">
                              1 <span class="chosen-asset-text"></span> = <span class="chosen-asset-price">1.00</span>
                              USD
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                    <button class="btn btn-primary btn-next">
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Continue</span>
                    </button>
                    <button class="btn btn-transparent btn-prev">
                      <span class="align-middle d-sm-inline-block d-none fw-normal">Back to previous</span>
                    </button>
                  </div>
                </div>

                <!-- Summary Step -->
                <div id="summaryStep" class="content">
                  <div class="content-header mb-4 col-8 mx-auto">
                    <h6 class="mb-0">Summary</h6>
                    <small>View the summary of your payment before proceeding</small>
                  </div>

                  <div class="col-8 mt-6 mx-auto">
                    <small class="d-flex align-items-center text-primary gap-2">
                      <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                          opacity=".4" />
                        <path fill="currentColor"
                          d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                      </svg>
                      Currency rate will be kept fixed for 30 minutes after you proceed.
                    </small>
                  </div>

                  <div class="row g-6 mt-7">
                    <div class="col-8 mx-auto mt-0">
                      <div class="row g-2">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>Asset</span>
                              <span class="d-flex align-items-center gap-2">
                                <span class="chosen-asset-icon">
                                  <svg height="18" width="18"></svg>
                                </span>
                                <span class="chosen-asset-text">USDT</span>
                              </span>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>Amount in <span class="chosen-asset-text">USDT</span></span>
                              <span>
                                <span class="chosen-asset-amount">1.00</span>
                                <span class="chosen-asset-text">USDT</span>
                              </span>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>Amount in USD</span>
                              <span>
                                <span class="chosen-asset-price-in-usd">1.00</span> USD
                              </span>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>Fees</span>
                              <span>
                                0.00 USD
                              </span>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span class="d-flex align-items-center">Debit amount <span
                                  class="popover-trigger d-flex justify-content-center align-items-center"
                                  data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                                  data-bs-custom-class="popover-dark"
                                  data-bs-content="Amount that will be credited to your account after successful payment.">
                                  <svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                      d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                      opacity=".3" />
                                    <path fill="currentColor"
                                      d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                  </svg>
                                </span>
                              </span>
                              <span>
                                <span class="chosen-asset-amount">1.00</span>
                                <span class="chosen-asset-text">USDT</span>
                              </span>
                            </div>
                          </li>
                        </ul>

                        <ul class="list-group mt-4">
                          <li class="list-group-item bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>You will send</span>
                              <span>
                                <span class="chosen-asset-amount">1.00</span>
                                <span class="chosen-asset-text">USDT</span>
                              </span>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                    <button class="btn btn-primary btn-next" id="payNowButton">
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Pay Now</span>
                    </button>
                    <button class="btn btn-transparent btn-prev">
                      <span class="align-middle d-sm-inline-block d-none fw-normal">Back to previous</span>
                    </button>
                  </div>
                </div>

                <!-- Proceed Step -->
                <div id="proceedStep" class="content">
                  <div class="content-header mb-4 col-8 mx-auto">
                    <h6 class="mb-0">Proceed</h6>
                    <small>Send the funds to the provided address below in order to complete</small>
                  </div>

                  <div class="row g-6 mt-8">
                    <div class="col-8 mx-auto mt-0">
                      <div class="row g-2">
                        <div class="card border border-1 border-light p-0">
                          <div class="card-header border-1 border-bottom-1 border-light">
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="d-flex">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                  viewBox="0 0 24 24">
                                  <g fill="none" fill-rule="evenodd">
                                    <path fill="currentColor"
                                      d="M12 4.5a7.5 7.5 0 1 0 0 15a7.5 7.5 0 0 0 0-15M1.5 12C1.5 6.201 6.201 1.5 12 1.5S22.5 6.201 22.5 12S17.799 22.5 12 22.5S1.5 17.799 1.5 12"
                                      opacity=".1" />
                                    <path fill="currentColor"
                                      d="M12 4.5a7.46 7.46 0 0 0-5.187 2.083a1.5 1.5 0 0 1-2.075-2.166A10.46 10.46 0 0 1 12 1.5a1.5 1.5 0 0 1 0 3"
                                      opacity=".7">
                                      <animateTransform attributeType="xml" attributeName="transform" type="rotate"
                                        from="360 12 12" to="0 12 12" dur="4s" additive="sum"
                                        repeatCount="indefinite"></animateTransform>
                                    </path>
                                  </g>
                                </svg>
                                <div class="d-flex flex-column">
                                  <h6 class="mb-0">
                                    Waiting for <span class="chosen-asset-text"></span> funds to arrive.
                                    <br>
                                  </h6>
                                  <span class="fw-light text-light" id="payment-progress-timer">30:00</span>
                                </div>
                              </div>
                              <a href="javascript:;" class="btn btn-sm btn-label-dark tnxId" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                                data-bs-content="Transaction ID" target="_blank">#TNX</a>
                            </div>
                          </div>

                          <div class="card-body mt-8">
                            <div class="qr-code-wrapper">
                              <img src="data:image/png;base64," alt="QR Code">
                            </div>

                            <div class="d-flex flex-column mt-7">
                              <div
                                class="h5 mb-0 mx-auto d-flex justify-content-center align-items-center gap-2 chosen-asset-amount-wrapper"
                                data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark chosen-asset-amount-popover"
                                data-bs-content="Click to copy">
                                <span class="chosen-asset-amount" id="chosenAssetAmount"></span>
                                <span class="chosen-asset-text"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847s-.843-2.21-.843-4.936z" />
                                  <path fill="currentColor"
                                    d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2S5.343 2 4.172 3.172"
                                    opacity=".5" />
                                </svg>
                              </div>
                              <small><span class="chosen-asset-price-in-usd">1.00</span> USD</small>
                            </div>

                            <label for="walletAddress" class="wallet-address-label mt-8 mb-2">
                              <span class="chosen-asset-text"></span>
                              <span class="chosen-asset-network"></span>
                              <span> address</span>
                            </label>

                            <div class="wallet-address-wrapper" data-bs-toggle="popover" data-bs-trigger="hover"
                              data-bs-placement="top" data-bs-custom-class="popover-dark wallet-address-popover"
                              data-bs-content="Click to copy">
                              <span class="wallet-address-icon">
                                <span class="chosen-asset-icon-sm"></span>
                              </span>
                              <input type="text" class="wallet-address" id="walletAddress"
                                value="TYKTXAo249P8j2Z69is5iZhZpmFTpsWifG" readonly />
                              <span class="wallet-address-copy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847s-.843-2.21-.843-4.936z" />
                                  <path fill="currentColor"
                                    d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2S5.343 2 4.172 3.172"
                                    opacity=".5" />
                                </svg>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mt-12">
                        <div class="d-flex flex-column row-gap-2">
                          <small class="d-flex align-items-center text-primary gap-2">
                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20"
                              height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                                opacity=".4" />
                              <path fill="currentColor"
                                d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                            </svg>
                            <span>Make sure you are sending the correct amount of <span
                                class="chosen-asset-text"></span>.</span>
                          </small>
                          <small class="d-flex align-items-start text-danger gap-2">
                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20"
                              height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                                opacity=".4" />
                              <path fill="currentColor"
                                d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                            </svg>
                            Be cautious about sending the funds to the correct address provided above or your transaction
                            might not complete.
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                    <button class="btn btn-label-danger" id="cancelPaymentButton">
                      <span class="align-middle d-sm-inline-block d-none fw-normal">Cancel Payment</span>
                    </button>
                  </div>
                </div>

                <!-- Completed Step -->
                <div id="completedStep" class="content">
                  <div class="row g-6 mt-0">
                    <div class="col-6 mx-auto mt-0">
                      <div class="row g-2">
                        <div class="card bg-light border border-1 p-0" style="background-color: #0e0d0e !important;">
                          <div class="card-body">
                            <div class="d-flex flex-column justify-content-center align-items-center text-center">
                              <span class="text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M7.245 2h9.51c1.159 0 1.738 0 2.206.163a3.05 3.05 0 0 1 1.881 1.936C21 4.581 21 5.177 21 6.37v14.004c0 .858-.985 1.314-1.608.744a.946.946 0 0 0-1.284 0l-.483.442a1.657 1.657 0 0 1-2.25 0a1.657 1.657 0 0 0-2.25 0a1.657 1.657 0 0 1-2.25 0a1.657 1.657 0 0 0-2.25 0a1.657 1.657 0 0 1-2.25 0l-.483-.442a.946.946 0 0 0-1.284 0c-.623.57-1.608.114-1.608-.744V6.37c0-1.193 0-1.79.158-2.27c.3-.913.995-1.629 1.881-1.937C5.507 2 6.086 2 7.245 2"
                                    opacity=".5" />
                                  <path fill="currentColor"
                                    d="M15.06 8.5a.75.75 0 0 0-1.12-1l-3.011 3.374l-.87-.974a.75.75 0 0 0-1.118 1l1.428 1.6a.75.75 0 0 0 1.119 0zM7.5 14.75a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5z" />
                                </svg>
                              </span>
                              <h5 class="mt-4 mb-0">Transaction Completed</h5>
                              <p class="mt-4 mb-0" style="max-width: 300px;">
                                We've received the funds and you will be able to see them in your wallet shortly. Please
                                wait a few minutes.
                              </p>

                              <div class="border border-bottom-0 border-light my-6 w-100"></div>

                              <small class="mb-0">View transaction details</small>
                              <a href="javascript:;" class="btn btn-sm btn-label-dark tnxId mt-2"
                                data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark" data-bs-content="Transaction ID"
                                target="_blank">#TNX00000000</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
