@php
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('layouts/blankLayout')

@section('title', 'Something went wrong.')

@section('page-style')
  <!-- Page -->
  @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection


@section('content')
  <!-- Error -->
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-1 mt-4">Something went wrong</h2>
      <p class="mb-4 mx-2">
        We've faced a problem on our side, our crew has been<br />notified about it and the problem will be fixed
        shortly.
      </p>
      <a href="{{ url('/') }}" class="btn btn-primary mb-4">Back to home</a>
      <div class="mt-4">
        <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" alt="Something went wrong"
          width="225" class="img-fluid">
      </div>
    </div>
  </div>
  <div class="container-fluid misc-bg-wrapper">
    <img src="{{ asset('assets/img/illustrations/bg-shape-image-' . $configData['style'] . '.png') }}"
      alt="page-misc-error" data-app-light-img="illustrations/bg-shape-image-light.png"
      data-app-dark-img="illustrations/bg-shape-image-dark.png">
  </div>
  <!-- /Error -->
@endsection
