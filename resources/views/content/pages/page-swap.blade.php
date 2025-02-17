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
  <div class="row mt-7">
    <div class="col col-lg-6 mx-auto">
      <h5 class="mb-3 lh-1">Swap</h5>
      <small class="lh-1 mb-7">
        Convert an asset between USD-asset pair
      </small>
    </div>

    <div class="col col-lg-6 mx-auto">
      <div class="card mx-auto">
        <div class="card-body">
          <form id="swapForm">
            @csrf

            <div class="swap-wrapper">
              <div class="swap-row">
                <div class="swap-item">
                  <div class="swap-select">
                    <span class="swap-label">From</span>
                    <select id="swapFrom" name="swapFrom">
                      <option value="USD">
                        USD
                      </option>
                    </select>
                  </div>

                  <div class="swap-input">
                    <input type="text" id="swapFromAmount" name="swapFromAmount" value="0.00">
                    <span class="swap-price swap-price-from">≈1.00$</span>
                  </div>
                </div>
              </div>

              <div class="swap-invert-wrapper swap-inverted">
                <button type="button" class="swap-invert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M20 10.25a.75.75 0 0 0 .507-1.303l-6-5.5A.75.75 0 0 0 13.25 4v16a.75.75 0 0 0 1.5 0v-9.75z" />
                    <path fill="currentColor"
                      d="M4 13.75h5.25V4a.75.75 0 1 1 1.5 0v16a.75.75 0 0 1-1.257.553l-6-5.5A.75.75 0 0 1 4 13.75"
                      opacity=".5" />
                  </svg>
                </button>
              </div>

              <div class="swap-row">
                <div class="swap-item">
                  <div class="swap-select">
                    <span class="swap-label">To</span>
                    <select id="swapToAsset" name="swapToAsset">
                      <option value="USD">
                        USD
                      </option>
                    </select>
                  </div>

                  <div class="swap-input">
                    <input type="text" id="swapToAmount" name="swapToAmount" value="0.00">
                    <span class="swap-price swap-price-to">≈1.00$</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex">
              <button class="btn btn-primary mt-4 w-100" style="border-radius: 16px">
                Swap
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection