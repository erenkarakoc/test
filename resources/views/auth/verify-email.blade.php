@php
  use Illuminate\Support\Facades\Route;
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
  $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Verify your e-mail address')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/_auth.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/auth.js'])
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-6">
        <!--  Verify email -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-6">
              <a href="{{ url('/') }}" class="app-brand-link">
                <span class="app-brand-logo">@include('_partials.macros', ['width' => 150, 'withbg' => 'fill: #fff;'])</span>
              </a>
            </div>
            <!-- /Logo -->

            <h4 class="mb-1">Verify your e-mail address ✉️</h4>

            @if (session('status') == 'verification-link-sent')
              <div class="alert alert-success" role="alert">
                <div class="alert-body">
                  A new verification link has been sent to you.
                </div>
              </div>
            @endif

            <p class="text-start mb-0">
              We've sent a verification link to your e-mail address: <span
                class="h6">{{ Auth::user()->email }}</span>. Please don't forget to check your spam folder in case.
            </p>
            <div class="mt-6 d-flex flex-column gap-2">
              <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-100 btn btn-label-secondary">Click here to request another</button>
              </form>

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-100 btn btn-danger">Log Out</button>
              </form>
            </div>
          </div>
        </div>
        <!-- / Verify email -->
      </div>
    </div>
  </div>
@endsection
