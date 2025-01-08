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
  @vite(['resources/assets/js/pages/algorithms.js'])
@endsection

@section('content')
  <div class="page-algorithms">
    <h5 class="mb-3 lh-1">Algorithms</h5>
    <p class="lh-1 mb-7">Explore a wide range of trading algorithms</p>

    <div class="row row-gap-4">
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/02.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/00.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/01.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>

      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/1.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/2.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/3.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/4.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/5.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/6.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/7.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/8.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/9.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/10.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
      <div class="col col-md-4">
        <div class="algorithm-item p-4 rounded">
          <div class="algorithm-item-col">
            <img src="{{ asset('assets/img/illustrations/algorithms/11.png') }}" alt="MR">
          </div>
          <div class="algorithm-item-col ms-4">
            <div class="d-flex justify-content-between align-items-center mb-auto">
              <h6 class="text-white mb-0">Mean Reversion</h6>
              <span class="algo-contribution ms-2">
                <small class="fw-medium">%8</small>
              </span>
            </div>
            <p class="mt-3 mb-1">
              Identifies when an asset's price deviates significantly from its historical average, assuming it will
              revert to the mean over time.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
