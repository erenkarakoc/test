@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Running Packs')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/strategy-packs.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/strategy-packs.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="page-running-packs">
    <div class="row">

    </div>
  </div>
@endsection
