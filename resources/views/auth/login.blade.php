@php
  use Illuminate\Support\Facades\Route;
  $configData = Helper::appClasses();
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('layouts/blankLayout')

@section('title', 'Login')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/auth.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/auth.js'])
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-6">
        <!-- Login -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-6">
              <a href="{{ url('/') }}" class="app-brand-link">
                <span class="app-brand-logo">@include('_partials.macros', ['width' => 150, 'withbg' => 'fill: #fff;'])</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-6">Welcome back! 👋</h4>

            <form id="formAuthentication" class="mb-4" action="{{ route('login') }}" method="POST">
              @csrf
              <div class="mb-6">
                <label for="login-email" class="form-label">Email Address</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="login-email"
                  name="email" placeholder="Enter your email address" autofocus value="{{ old('email') }}">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                  </span>
                @enderror
              </div>

              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="login-password">Password</label>
                <div class="input-group input-group-merge @error('password') is-invalid @enderror">
                  <input type="password" id="login-password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                  </span>
                @enderror
              </div>

              <div class="my-8">
                <div class="d-flex justify-content-between">
                  <div class="form-check mb-0 ms-2">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember"
                      {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember-me">
                      Remember Me
                    </label>
                  </div>
                  @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                      <p class="mb-0">Forgot Password?</p>
                    </a>
                  @endif
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </form>

            <p class="text-center">
              <span>New to our platform?</span>
              <a href="{{ route('register') }}">
                <span>Create an account</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>
  </div>
@endsection
