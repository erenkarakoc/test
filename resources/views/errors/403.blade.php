@php
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('layouts/blankLayout')

@section('title', '404 Not Found')

@section('page-style')
  <!-- Page -->
  @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection


@section('content')
  <!-- Error -->
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-1 mt-4">Unauthorized</h2>
      <p class="mb-4 mx-2">Sorry, you don't have permission to access that page.</p>
      <a href="{{ url('/') }}" class="btn btn-primary mb-4">Back to home</a>
      <div class="mt-4">
        <img src="{{ asset('assets/img/illustrations/page-misc-you-are-not-authorized.png') }}" alt="Unauthorized"
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
