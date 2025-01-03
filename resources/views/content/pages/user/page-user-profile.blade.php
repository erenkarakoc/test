@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'My Profile')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js', 'resources/assets/vendor/libs/toastr/toastr.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/libphonenumber-js/libphonenumber-js.min.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/user-profile.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/user/user-profile.js'])
@endsection

@section('content')
  <div class="page-user-profile">
    <h5 class="mb-3 lh-1">Profile</h5>
    <p class="lh-1 mb-7">View and manage your profile</p>

    <div class="row">
      <div class="col-12">
        <div class="nav-tabs-shadow nav-align-top">
          <ul class="nav nav-tabs" id="user-profile-nav-tabs" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                data-bs-target="#1">Profile</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                data-bs-target="#2">Security</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                data-bs-target="#3">Activity</button>
            </li>
          </ul>

          <div class="tab-content border">
            <div class="tab-pane fade show active" id="1">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Profile Information</h5>
                  <p class="card-subtitle">Update your account's profile information.</p>
                </div>
                <div class="card-body">
                  <form id="updateUserProfileForm">
                    @csrf

                    <div class="row row-gap-4">
                      <div class="col col-md-6 update-profile-info-row">
                        <label class="form-label required" for="username">
                          Username
                        </label>
                        <input class="form-control" id="username" type="text" value="{{ $user->username }}"
                          name="username" required>
                      </div>

                      <div class="col col-md-6 update-profile-info-row">
                        <label class="form-label required" for="email">
                          E-mail Address
                        </label>
                        <div class="input-group input-group-merge">
                          <input class="form-control bg-light" id="email" type="email" value="{{ $user->email }}"
                            disabled>
                          <span class="input-group-text bg-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M2 16c0-2.828 0-4.243.879-5.121C3.757 10 5.172 10 8 10h8c2.828 0 4.243 0 5.121.879C22 11.757 22 13.172 22 16s0 4.243-.879 5.121C20.243 22 18.828 22 16 22H8c-2.828 0-4.243 0-5.121-.879C2 20.243 2 18.828 2 16"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M12 18a2 2 0 1 0 0-4a2 2 0 0 0 0 4M6.75 8a5.25 5.25 0 0 1 10.5 0v2.004c.567.005 1.064.018 1.5.05V8a6.75 6.75 0 0 0-13.5 0v2.055a24 24 0 0 1 1.5-.051z" />
                            </svg>
                          </span>
                        </div>
                      </div>

                      <div class="col col-md-6 update-profile-info-row">
                        <label class="form-label" for="full_name">
                          Full Name
                        </label>
                        <input class="form-control" id="full_name" type="text" value="{{ $user->full_name }}"
                          name="full_name" placeholder="Your full name">
                      </div>

                      <div class="col col-md-6 update-profile-info-row">
                        <label class="form-label" for="country">
                          Country
                        </label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                              <circle cx="12" cy="12" r="10" fill="currentColor" opacity=".5" />
                              <path fill="currentColor"
                                d="M8.575 9.447C8.388 7.363 6.781 5.421 6 4.711l-.43-.37A9.96 9.96 0 0 1 12 2c2.214 0 4.26.72 5.916 1.936c.234.711-.212 2.196-.68 2.906c-.17.257-.554.577-.976.88c-.95.683-2.15 1.02-2.76 2.278a1.42 1.42 0 0 0-.083 1.016c.06.22.1.459.1.692c.002.755-.762 1.3-1.517 1.292c-1.964-.021-3.25-1.604-3.425-3.553m4.862 8.829c.988-1.862 4.281-1.862 4.281-1.862c3.432-.036 3.896-2.12 4.206-3.173a10.006 10.006 0 0 1-8.535 8.664c-.323-.68-.705-2.21.048-3.629" />
                            </svg>
                          </span>
                          <input class="form-control" id="country" type="text" value="{{ $user->country }}"
                            name="country" placeholder="Residential country">
                        </div>
                      </div>

                      <div class="col col-md-6 update-profile-info-row">
                        <label class="form-label" for="phone_number">
                          Phone Number
                        </label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="m10.038 5.316l.649 1.163c.585 1.05.35 2.426-.572 3.349c0 0-1.12 1.119.91 3.148c2.027 2.027 3.146.91 3.147.91c.923-.923 2.3-1.158 3.349-.573l1.163.65c1.585.884 1.772 3.106.379 4.5c-.837.836-1.863 1.488-2.996 1.53c-1.908.073-5.149-.41-8.4-3.66c-3.25-3.251-3.733-6.492-3.66-8.4c.043-1.133.694-2.159 1.53-2.996c1.394-1.393 3.616-1.206 4.5.38"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M13.26 1.88a.75.75 0 0 1 .861-.62c.025.005.107.02.15.03q.129.027.352.09c.297.087.712.23 1.21.458c.996.457 2.321 1.256 3.697 2.631c1.376 1.376 2.175 2.702 2.632 3.698c.228.498.37.912.457 1.21a6 6 0 0 1 .113.454l.005.031a.765.765 0 0 1-.617.878a.75.75 0 0 1-.86-.617a3 3 0 0 0-.081-.327a7.4 7.4 0 0 0-.38-1.004c-.39-.85-1.092-2.024-2.33-3.262s-2.411-1.939-3.262-2.329a7.4 7.4 0 0 0-1.003-.38a6 6 0 0 0-.318-.08a.76.76 0 0 1-.626-.861" />
                              <path fill="currentColor" fill-rule="evenodd"
                                d="M13.486 5.33a.75.75 0 0 1 .927-.516l-.206.721l.206-.72h.003l.003.001l.008.002l.02.006l.056.02q.067.023.177.07c.146.062.345.158.59.303c.489.29 1.157.77 1.942 1.556c.785.785 1.266 1.453 1.556 1.942c.145.245.241.444.303.59a3 3 0 0 1 .09.233l.005.02l.003.008v.003l.001.001s0 .002-.72.208l.72-.206a.75.75 0 0 1-1.439.422l-.003-.01l-.035-.088a4 4 0 0 0-.216-.417c-.223-.376-.626-.946-1.326-1.646s-1.269-1.102-1.646-1.325a4 4 0 0 0-.504-.25l-.01-.004a.75.75 0 0 1-.505-.925"
                                clip-rule="evenodd" />
                            </svg>
                          </span>
                          <input class="form-control" id="phone_number" name="phone_number" type="phone"
                            value="{{ $user->phone_number }}" placeholder="Your phone number">
                        </div>
                        <small>Please don't forget including country code (eg. "+1" for USA)</small>
                      </div>

                      <div class="col col-md-6 update-profile-info-row">
                        <label class="form-label" for="date_of_birth">
                          Date of Birth
                        </label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M6.96 2c.418 0 .756.31.756.692V4.09c.67-.012 1.422-.012 2.268-.012h4.032c.846 0 1.597 0 2.268.012V2.692c0-.382.338-.692.756-.692s.756.31.756.692V4.15c1.45.106 2.403.368 3.103 1.008c.7.641.985 1.513 1.101 2.842v1H2V8c.116-1.329.401-2.2 1.101-2.842c.7-.64 1.652-.902 3.103-1.008V2.692c0-.382.339-.692.756-.692" />
                              <path fill="currentColor"
                                d="M22 14v-2c0-.839-.013-2.335-.026-3H2.006c-.013.665 0 2.161 0 3v2c0 3.771 0 5.657 1.17 6.828C4.349 22 6.234 22 10.004 22h4c3.77 0 5.654 0 6.826-1.172S22 17.771 22 14"
                                opacity=".5" />
                              <path fill="currentColor" fill-rule="evenodd"
                                d="M14 12.25A1.75 1.75 0 0 0 12.25 14v2a1.75 1.75 0 1 0 3.5 0v-2A1.75 1.75 0 0 0 14 12.25m0 1.5a.25.25 0 0 0-.25.25v2a.25.25 0 1 0 .5 0v-2a.25.25 0 0 0-.25-.25"
                                clip-rule="evenodd" />
                              <path fill="currentColor"
                                d="M11.25 13a.75.75 0 0 0-1.28-.53l-1.5 1.5a.75.75 0 0 0 1.06 1.06l.22-.22V17a.75.75 0 0 0 1.5 0z" />
                            </svg>
                          </span>
                          <input class="form-control flatpickr" id="date_of_birth" type="date"
                            value={{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : '' }}
                            name="date_of_birth" pattern="\d{4}-\d{2}-\d{2}" placeholder="yyyy-mm-dd">
                        </div>
                        <small id="clearDateOfBirth">Clear</small>
                      </div>
                    </div>
                    <div class="d-flex justify-content-end">
                      <div class="d-flex align-items-baseline mt-6">
                        <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">
                          Save
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="2">
              <div class="row">
                <div class="col col-md-6 two-factor-authentication-form">
                  @livewire('profile.two-factor-authentication-form')
                </div>
                <div class="col col-md-6 update-password-form">
                  @livewire('profile.update-password-form')
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="3">
              @livewire('profile.logout-other-browser-sessions-form')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      flatpickr('#date_of_birth', {
        dateFormat: 'Y-m-d',
        defaultDate: "{{ $user->date_of_birth ? Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : '' }}",
        maxDate: new Date().setFullYear(new Date().getFullYear() - 18)
      });

      $("#phone_number").on('input', function() {
        var val_old = $(this).val();
        if (!val_old.startsWith('+')) {
          val_old = '+' + val_old;
        }
        var formattedNumber = new libphonenumber.AsYouType('US').input(val_old);
        $(this).focus().val('').val(formattedNumber);
      });
    });
  </script>
@endsection
