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

  <div class="row">
    <div class="col col-lg-6 mx-auto">
      <div class="card mt-7 mx-auto bg-light">
        <div class="card-body">
          <div class="swap-wrapper">
            <div class="swap-item">
              <label for="addWalletAssetSelect" class="form-label required">From</label>
              <select id="addWalletAssetSelect" class="selectpicker w-100" data-style="btn-default" name="symbol">
                @foreach ($assets as $asset)
                <option value="{{ $asset->symbol }}" data-show-subtext='true' data-subtext='{{ $asset->symbol }}'
                  data-title={{ $asset->title }}>
                  {{ $asset->title }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="swap-item">
              <label for="addWalletAssetSelect" class="form-label required">To</label>
              <select id="addWalletAssetSelect" class="selectpicker w-100" data-style="btn-default" name="symbol">
                @foreach ($swappables as $swappable)
                <option value="{{ $swappable->symbol }}" data-show-subtext='true'
                  data-subtext='{{ $swappable->symbol }}' data-title={{ $swappable->title }}>
                  {{ $swappable->title }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection