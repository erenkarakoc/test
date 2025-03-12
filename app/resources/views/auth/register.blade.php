@php
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Route;

  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
  $inviteCode = $request->query('invite');
@endphp

@extends('layouts/blankLayout')

@section('title', 'Register')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/auth.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/auth.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-6">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-6">
              <a href="{{ url('/') }}" class="app-brand-link">
                <span class="app-brand-logo">@include('_partials.macros', ['width' => 150, 'withbg' => 'fill: #fff;'])</span>
              </a>
            </div>
            <!-- /Logo -->

            <h4 class="mb-1">Adventure starts here! 🚀</h4>
            <p class="mb-6">Get started to your investment journey by signing up.</p>

            <form id="formAuthentication" class="mb-6" action="{{ route('register') }}" method="POST">
              @csrf
              @if ($inviteCode)
                <input type="hidden" value="{{ $inviteCode }}" name="invite_code">
              @endif

              <div class="mb-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                  name="username" placeholder="Enter your username" autofocus>
                @error('username')
                  <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                  </span>
                @enderror
              </div>

              <div class="mb-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                  name="email" placeholder="Enter your email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                  </span>
                @enderror
              </div>

              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge @error('password') is-invalid @enderror">
                  <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
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

              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password-confirm">Confirm Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
                @error('password-confirm')
                  <span class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                  </span>
                @enderror
              </div>

              @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-6 mt-8">
                  <div class="form-check mb-8 ms-2 @error('terms') is-invalid @enderror">
                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms"
                      name="terms" />
                    <label class="form-check-label" for="terms">
                      I agree to the
                      <a href="{{ route('policy.show') }}" target="_blank">privacy policy</a> &
                      <a href="{{ route('terms.show') }}" target="_blank">terms</a>
                    </label>
                  </div>
                  @error('terms')
                    <div class="invalid-feedback" role="alert">
                      <span class="fw-medium">{{ $message }}</span>
                    </div>
                  @enderror
                </div>
              @endif
              <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
            </form>

            <p class="text-center {{ $inviteCode ? 'mb-12' : 'mb-0' }}">
              <span>Already have an account?</span>
              <a href="{{ route('login') }}">
                <span>Sign in instead</span>
              </a>
            </p>

            @if ($inviteCode)
              <div class="card bg-light">
                <div class="card-body p-3">
                  <div class="d-flex align-items-center">
                    <span>Invite code: <span class="h6 mb-0 fw-medium">{{ $inviteCode }}</span></span>
                    <span class="popover-trigger text-light cursor-pointer ms-1 lh-1" data-bs-toggle="popover"
                      data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                      data-bs-content="The invitation code you've obtained from your friend.">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                        <path fill="currentColor"
                          d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                      </svg>
                    </span>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
@endsection
