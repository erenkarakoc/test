@php
use Illuminate\Support\Facades\Auth;
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Swap')

@section('vendor-style')
@vite(['resources/assets/vendor/libs/bs-stepper/bs-stepper.scss', 'resources/assets/vendor/libs/select2/select2.scss',
'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
'resources/assets/vendor/libs/@form-validation/form-validation.scss',
'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

@section('vendor-script')
@vite(['resources/assets/vendor/libs/bs-stepper/bs-stepper.js', 'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/swap.scss'])
@endsection

@section('page-script')
@vite(['resources/assets/js/pages/swap.js', 'resources/assets/js/helpers/gdzhelpers.js',
'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
<div class="page-swap">
  <h5 class="mb-3 lh-1">Swap</h5>
  <small class="lh-1 mb-7">
    Convert an asset to USD, USDT or GDZ
  </small>

  <div class="card mt-7">
    <div class="card-body p-0">
      <div id="swap" class="bs-stepper bg-light mt-2">
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
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="m9 5l6 7l-6 7" />
            </svg>
          </div>
          <div class="step" data-target="#chooseReceivingAssetStep">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle">1</span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Receiving Asset</span>
                <span class="bs-stepper-subtitle">Choose the receiving asset</span>
              </span>
            </button>
          </div>
          <div class="line">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="m9 5l6 7l-6 7" />
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
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="m9 5l6 7l-6 7" />
            </svg>
          </div>
          <div class="step" data-target="#completedStep">
            <button type="button" class="step-trigger">
              <span class="bs-stepper-circle">5</span>
              <span class="bs-stepper-label">
                <span class="bs-stepper-title">Completed</span>
              </span>
            </button>
          </div>
        </div>

        <div class="bs-stepper-content">
          <form id="swapForm" onSubmit="return false" novalidate>
            @csrf

            <!-- Choose Asset Step -->
            <div id="chooseAssetStep" class="content">
              <div class="content-header mb-4 col-8 mx-auto">
                <h6 class="mb-0">Choose an asset</h6>
                <small>Choose the asset you want to swap</small>
              </div>

              <div class="row g-2 col-8 mt-5 mx-auto choose-asset-form-row">
                @foreach ($assets as $asset)
                <div class="col-6">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content d-flex align-items-center"
                      for="asset-{{ $asset['symbol'] }}">
                      <input name="asset" class="form-check-input chooseAssetRadio me-4" type="radio"
                        value="{{ $asset['symbol'] }}" id="asset-{{ $asset['symbol'] }}"
                        data-network="{{ $asset['network'] }}" />
                      <div class="d-flex">
                        {!! $walletIcons[$asset['symbol']] ?? '' !!}
                        <div class="d-flex flex-column ms-2">
                          <span class="fw-medium">{{ $asset['title'] }}</span>
                          <small>
                            {{ $asset['symbol'] }}
                            {{ $asset['network'] }}
                          </small>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                @endforeach
              </div>

              <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Continue</span>
                </button>
              </div>
            </div>

            <!-- Choose Receiving Asset Step -->
            <div id="chooseReceivingAssetStep" class="content">
              <div class="content-header mb-4 col-8 mx-auto">
                <h6 class="mb-0">Choose the receiving asset</h6>
                <small>Choose the asset you want to receive</small>
              </div>

              <div class="row g-2 col-8 mt-5 mx-auto choose-asset-form-row">
                <div class="col-6">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content d-flex align-items-center" for="asset-USD">
                      <input name="receivingAsset" class="form-check-input chooseReceivingAssetRadio me-4" type="radio"
                        value="USD" id="asset-USD" />
                      <div class="d-flex">
                        {!! $walletIcons['USD'] ?? '' !!}
                        <div class="d-flex flex-column ms-2">
                          <span class="fw-medium">US Dollar</span>
                          <small>USD</small>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content d-flex align-items-center" for="asset-USDT">
                      <input name="receivingAsset" class="form-check-input chooseReceivingAssetRadio me-4" type="radio"
                        value="USDT" id="asset-USDT" />
                      <div class="d-flex">
                        {!! $walletIcons['USDT'] ?? '' !!}
                        <div class="d-flex flex-column ms-2">
                          <span class="fw-medium">Tether</span>
                          <small>USDT</small>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-8 mt-2 mx-auto px-1 choose-asset-error-message"></div>

              <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                <button class="btn btn-primary btn-next">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Continue</span>
                </button>
                <button class="btn btn-transparent btn-prev">
                  <span class="align-middle d-sm-inline-block d-none fw-normal">Back to previous</span>
                </button>
              </div>
            </div>

            <!-- Enter Amount Step -->
            <div id="enterAmountStep" class="content">
              <div class="content-header mb-4 col-8 mx-auto">
                <h6 class="mb-0">Amount</h6>
                <small>Enter the amount you want to debit</small>
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

            <!-- Completed Step -->
            <div id="completedStep" class="content">
              <div class="row g-6 mt-0">
                <div class="col-6 mx-auto mt-0">
                  <div class="row g-2">
                    <div class="card bg-light border border-1 p-0" style="background-color: #0e0d0e !important;">
                      <div class="card-body">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center">
                          <span class="text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
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
                          <a href="javascript:;" class="btn btn-sm btn-label-dark tnxId mt-2" data-bs-toggle="popover"
                            data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                            data-bs-content="Transaction ID" target="_blank">#TNX00000000</a>
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
@endsection