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
    <p class="lh-1 mb-7">See our pre-defined strategy packs for optimized algo-trading.</p>

    <div class="row strategy-packs-table">
      <h5 class="mb-2 lh-1">Assets</h5>
      <small class="lh-1 mb-7">Available assets in your wallet</small>

      <div class="row">
        <div class="col-12">
          <div class="table-responsive border border-top-0 rounded">
            <table class="table table-striped text-center mb-0">
              <thead>
                <tr>
                  <th scope="col">
                    <p class="mb-0">Algorithms</p>
                    <small class="text-body fw-normal text-capitalize">Pre-defined</small>
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
                    <a href="payment-page.html" class="btn text-nowrap btn-label-primary waves-effect">Choose Plan</a>
                  </td>
                  <td>
                    <a href="payment-page.html" class="btn text-nowrap btn-primary waves-effect waves-light">Choose
                      Plan</a>
                  </td>
                  <td>
                    <a href="payment-page.html" class="btn text-nowrap btn-label-primary waves-effect">Choose Plan</a>
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
