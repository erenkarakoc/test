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
  @vite(['resources/assets/vendor/scss/pages/running-packs.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/strategy-packs.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="page-running-packs">
    <h5 class="mb-3 lh-1">Running Packs</h5>
    <p class="mb-12 lh-1">Monitor the packs you’ve activated and their real-time activity</p>

    <div class="row">
      <div class="col col-12">
        <h6 class="mb-2 lh-1">Active Packs</h6>
        <small class="lh-1 mb-7">
          Packs that are currently being executed
        </small>

        <div class="d-flex flex-column mt-7 row-gap-4">
          @foreach ($runningLockedPacks as $pack)
            <div class="card bg-light border bg-glow">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div style="width: 33%;" class="d-flex align-items-center">
                    <div style="background-color: #202020;" class="border border-light rounded p-1">
                      <div class="position-relative">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M13.3337 4H18.667C23.695 4 26.2097 4 27.771 5.56267C29.3323 7.12533 29.3337 9.63867 29.3337 14.6667V15H2.66699V14.6667C2.66699 9.63867 2.66699 7.124 4.22966 5.56267C5.79233 4.00133 8.30566 4 13.3337 4Z"
                            fill="currentColor" opacity="0.5" />
                          <path
                            d="M13.3337 28H18.667H18.755C17.657 26.6304 17.0003 24.8919 17.0003 23C17.0003 20.6106 18.0478 18.4659 19.7087 17H2.66699V17.3333C2.66699 22.3613 2.66833 24.8747 4.22966 26.4373C5.79099 28 8.30566 28 13.3337 28Z"
                            fill="currentColor" opacity="0.5" />
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M25.0003 15C22.9714 15 21.1189 15.7553 19.7087 17H2.66699V15H25.0003Z"
                            fill="currentColor" />
                          <path
                            d="M17 9.99935C17 9.73413 17.1054 9.47978 17.2929 9.29224C17.4804 9.10471 17.7348 8.99935 18 8.99935H24C24.2652 8.99935 24.5196 9.10471 24.7071 9.29224C24.8946 9.47978 25 9.73413 25 9.99935C25 10.2646 24.8946 10.5189 24.7071 10.7065C24.5196 10.894 24.2652 10.9993 24 10.9993H18C17.7348 10.9993 17.4804 10.894 17.2929 10.7065C17.1054 10.5189 17 10.2646 17 9.99935ZM8 24.3327C7.73478 24.3327 7.48043 24.2273 7.29289 24.0398C7.10536 23.8523 7 23.5979 7 23.3327V20.666C7 20.4008 7.10536 20.1464 7.29289 19.9589C7.48043 19.7714 7.73478 19.666 8 19.666C8.26522 19.666 8.51957 19.7714 8.70711 19.9589C8.89464 20.1464 9 20.4008 9 20.666V23.3327C9 23.5979 8.89464 23.8523 8.70711 24.0398C8.51957 24.2273 8.26522 24.3327 8 24.3327ZM8 12.3327C7.73478 12.3327 7.48043 12.2273 7.29289 12.0398C7.10536 11.8523 7 11.5979 7 11.3327V8.66602C7 8.4008 7.10536 8.14645 7.29289 7.95891C7.48043 7.77137 7.73478 7.66602 8 7.66602C8.26522 7.66602 8.51957 7.77137 8.70711 7.95891C8.89464 8.14645 9 8.4008 9 8.66602V11.3327C9 11.5979 8.89464 11.8523 8.70711 12.0398C8.51957 12.2273 8.26522 12.3327 8 12.3327ZM12 24.3327C11.7348 24.3327 11.4804 24.2273 11.2929 24.0398C11.1054 23.8523 11 23.5979 11 23.3327V20.666C11 20.4008 11.1054 20.1464 11.2929 19.9589C11.4804 19.7714 11.7348 19.666 12 19.666C12.2652 19.666 12.5196 19.7714 12.7071 19.9589C12.8946 20.1464 13 20.4008 13 20.666V23.3327C13 23.5979 12.8946 23.8523 12.7071 24.0398C12.5196 24.2273 12.2652 24.3327 12 24.3327ZM12 12.3327C11.7348 12.3327 11.4804 12.2273 11.2929 12.0398C11.1054 11.8523 11 11.5979 11 11.3327V8.66602C11 8.4008 11.1054 8.14645 11.2929 7.95891C11.4804 7.77137 11.7348 7.66602 12 7.66602C12.2652 7.66602 12.5196 7.77137 12.7071 7.95891C12.8946 8.14645 13 8.4008 13 8.66602V11.3327C13 11.5979 12.8946 11.8523 12.7071 12.0398C12.5196 12.2273 12.2652 12.3327 12 12.3327Z"
                            fill="currentColor" />
                        </svg>

                        <svg class="running-pack-spin" width="11" height="11" viewBox="0 0 11 11" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M0.90652 3.33733C1.42519 1.34133 3.47185 0 5.67452 0C7.37719 0 8.92785 0.773334 9.81585 2.02C9.89202 2.12698 9.94637 2.24792 9.9758 2.37591C10.0052 2.5039 10.0092 2.63643 9.98737 2.76594C9.96557 2.89544 9.91849 3.01939 9.8488 3.1307C9.77911 3.24201 9.68817 3.3385 9.58119 3.41467C9.4742 3.49083 9.35327 3.54518 9.22528 3.57461C9.09729 3.60404 8.96476 3.60797 8.83525 3.58618C8.70575 3.56439 8.5818 3.5173 8.47049 3.44761C8.35918 3.37792 8.26269 3.28698 8.18652 3.18C7.70652 2.50667 6.78919 2 5.67452 2C4.38519 2 3.42519 2.64267 3.00785 3.44C3.15507 3.51413 3.28168 3.62349 3.37642 3.75837C3.47116 3.89324 3.5311 4.04944 3.55089 4.21307C3.57068 4.37671 3.54972 4.54269 3.48987 4.69627C3.43003 4.84984 3.33315 4.98624 3.20785 5.09333L2.43052 5.76C2.2493 5.91528 2.01851 6.00064 1.77985 6.00064C1.5412 6.00064 1.31041 5.91528 1.12919 5.76L0.35052 5.09333C0.20111 4.96571 0.0926086 4.79691 0.0385657 4.60799C-0.0154772 4.41908 -0.0126656 4.21842 0.0466478 4.03109C0.105961 3.84377 0.219147 3.67807 0.372073 3.55468C0.524999 3.4313 0.710886 3.3557 0.90652 3.33733Z"
                            fill="currentColor" />
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.57071 5.24064C8.75193 5.08535 8.98272 5 9.22137 5C9.46003 5 9.69081 5.08535 9.87204 5.24064L10.6507 5.9073C10.8001 6.03492 10.9086 6.20373 10.9627 6.39264C11.0167 6.58156 11.0139 6.78221 10.9546 6.96954C10.8953 7.15687 10.7821 7.32257 10.6292 7.44595C10.4762 7.56934 10.2903 7.64493 10.0947 7.6633C9.57604 9.6593 7.52938 11.0006 5.32671 11.0006C3.62404 11.0006 2.07337 10.2273 1.18537 8.98064C1.10921 8.87365 1.05486 8.75271 1.02543 8.62473C0.996002 8.49674 0.992072 8.36421 1.01386 8.2347C1.03565 8.10519 1.08274 7.98125 1.15243 7.86994C1.22212 7.75863 1.31306 7.66213 1.42004 7.58597C1.52702 7.5098 1.64796 7.45545 1.77595 7.42603C1.90394 7.3966 2.03647 7.39267 2.16598 7.41446C2.29548 7.43625 2.41943 7.48333 2.53074 7.55303C2.64205 7.62272 2.73854 7.71365 2.81471 7.82064C3.29471 8.49397 4.21204 9.00064 5.32671 9.00064C6.61604 9.00064 7.57604 8.35797 7.99338 7.56064C7.84616 7.48651 7.71955 7.37714 7.62481 7.24227C7.53007 7.10739 7.47013 6.95119 7.45034 6.78756C7.43054 6.62393 7.4515 6.45794 7.51135 6.30437C7.5712 6.15079 7.66808 6.01439 7.79337 5.9073L8.57071 5.24064Z"
                            fill="currentColor" />
                        </svg>
                      </div>
                    </div>
                    <div class="d-flex flex-column ms-4">
                      <h5 class="mb-0">Bundle {{ $pack->id }}</h5>
                      <span class="text-success">
                        <small style="font-size: 11px; font-weight: 600;">Running</small>
                      </span>
                    </div>
                  </div>

                  <div style="width: 33%;" class="d-flex flex-column">
                    <span class="fw-medium mb-1 text-muted">Algorithms</span>
                    <div class="d-flex align-items-center column-gap-2">
                      @foreach (array_slice(json_decode($pack->chosen_algorithms, true), 0, 3) as $algorithm)
                        <span>{{ $algorithm['title'] }}</span>
                      @endforeach
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M5 6.25a.75.75 0 0 0-.488 1.32l7 6c.28.24.695.24.976 0l7-6A.75.75 0 0 0 19 6.25z"
                          opacity=".5" />
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M4.43 10.512a.75.75 0 0 1 1.058-.081L12 16.012l6.512-5.581a.75.75 0 1 1 .976 1.139l-7 6a.75.75 0 0 1-.976 0l-7-6a.75.75 0 0 1-.081-1.058"
                          clip-rule="evenodd" />
                      </svg>
                    </div>
                  </div>

                  <div style="width: 33%;" class="d-flex align-items-center justify-content-end">
                    <button type="button" class="btn btn-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M7 12a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
