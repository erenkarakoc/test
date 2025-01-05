@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();

  $walletIcons = [
      'USD' =>
          '<svg width="36" height="36" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.45" fill-rule="evenodd" clip-rule="evenodd" d="M30 60C46.5685 60 60 46.5685 60 30C60 13.4315 46.5685 0 30 0C13.4315 0 0 13.4315 0 30C0 46.5685 13.4315 60 30 60Z" fill="#00FF2F"/><path d="M29.1429 46V43.3986C23.4664 43.0714 20.0179 40.1471 20 35.7143H25.1429C25.2693 37.5957 26.8471 39.0321 29.1429 39.2857V32.2857L27.2307 31.7857C22.8736 30.7729 20.5421 28.2579 20.5421 24.4943C20.5421 20.0579 23.72 17.1486 29.1429 16.7143V14H31.4286V16.7143C36.9564 17.1643 39.9286 20.1243 40 24.2857H34.8571C34.8029 22.5671 33.7264 21.1864 31.4286 21V27.5714L33.63 28.0914C38.2579 29.1043 40.5714 31.5 40.5714 35.4286C40.5714 40.0243 37.4471 42.9914 31.4286 43.38V46H29.1429ZM29.1429 27.1429V21C27.1721 21.1086 25.7664 22.3193 25.7664 24.0379C25.7664 25.6307 26.9371 26.6721 29.1429 27.1429ZM31.4286 32.7143V39.2857C34.1536 39.1757 35.4557 37.9343 35.4557 36.0164C35.4557 34.2607 34.1536 33.0786 31.4286 32.7143Z" fill="#E3FFEE"/></svg>',
      'USDT' =>
          '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.6" d="M25.8629 12.9314C25.8629 20.0733 20.0733 25.863 12.9315 25.863C5.78959 25.863 0 20.0733 0 12.9314C0 5.7896 5.78959 0 12.9315 0C20.0733 0 25.8629 5.7896 25.8629 12.9314" fill="#3EEF44"/><path d="M11.6055 12.7063V10.4439H8.53711V8.46094H17.1114V10.4719H14.043V12.7063H11.6055Z" fill="#F2FFF4"/><path fill-rule="evenodd" clip-rule="evenodd" d="M7.21777 12.9584C7.21777 12.2043 9.68395 11.5898 12.7523 11.5898C15.8207 11.5898 18.2869 12.2043 18.2869 12.9584C18.2869 13.7125 15.8207 14.327 12.7523 14.327C9.68395 14.327 7.21777 13.7125 7.21777 12.9584ZM17.8281 12.9584C17.6273 12.6791 15.9641 11.8133 12.7523 11.8133C9.54057 11.8133 7.87733 12.6512 7.6766 12.9584C7.87733 13.2377 9.54057 13.6566 12.7523 13.6566C15.9928 13.6566 17.6273 13.2377 17.8281 12.9584Z" fill="#F2FFF4"/><path d="M14.0426 13.4051V11.841C13.6411 11.8131 13.211 11.7852 12.7808 11.7852C12.3794 11.7852 12.0066 11.7852 11.6338 11.8131V13.3771C11.9779 13.3771 12.3794 13.4051 12.7808 13.4051C13.211 13.433 13.6411 13.433 14.0426 13.4051Z" fill="#F2FFF4"/><path d="M12.7525 14.3273C12.3511 14.3273 11.9783 14.3273 11.6055 14.2994V18.4609H14.0143V14.2715C13.6128 14.2994 13.1827 14.3273 12.7525 14.3273Z" fill="#F2FFF4"/></svg>',
      'TRX' =>
          '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.2" d="M25.9293 12.9998C25.9293 20.1417 20.1397 25.9314 12.9979 25.9314C5.856 25.9314 0.0664062 20.1417 0.0664062 12.9998C0.0664062 5.85795 5.856 0.0683594 12.9979 0.0683594C20.1397 0.0683594 25.9293 5.85795 25.9293 12.9998" fill="#D13437"/><path fill-rule="evenodd" clip-rule="evenodd" d="M8.09936 7.13424C8.14628 7.07984 8.20626 7.03974 8.27298 7.01812C8.3397 6.99651 8.41073 6.99418 8.4786 7.01139L16.6484 9.11605C16.6978 9.12905 16.7431 9.15115 16.7843 9.18235L18.4464 10.4576C18.5276 10.5201 18.5826 10.6133 18.5997 10.7176C18.6167 10.822 18.5945 10.9292 18.5378 11.0166L12.8195 19.8213C12.7793 19.8837 12.7235 19.9332 12.6582 19.9641C12.5928 19.9951 12.5206 20.0063 12.4496 19.9966C12.3786 19.9869 12.3115 19.9566 12.2559 19.9091C12.2002 19.8617 12.1582 19.7989 12.1345 19.7277L8.02215 7.54373C7.99894 7.47446 7.99386 7.3999 8.00744 7.32785C8.02102 7.25581 8.05277 7.18893 8.09936 7.13424ZM9.44832 9.33314L12.3031 17.7914L12.7726 13.4079L9.44832 9.33314ZM13.5372 13.549L13.0598 18.0085L17.098 11.7901L13.5372 13.549ZM17.4624 10.7105L14.859 11.9961L16.6045 10.0527L17.4624 10.7105ZM15.8182 9.74133L9.46685 8.10467L13.1907 12.6689L15.8182 9.74133Z" fill="#FD3D40"/></svg>',
      'BTC' =>
          '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.2" d="M25.6104 16.145C23.874 23.1094 16.8199 27.3474 9.85476 25.6111C2.89286 23.8747 -1.34555 16.8206 0.391171 9.85668C2.12667 2.89152 9.18039 -1.34729 16.1435 0.389023C23.1083 2.12534 27.3463 9.18027 25.61 16.145H25.6104Z" fill="#F7931A"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17.9727 11.2145C18.1922 9.74539 17.0736 8.95564 15.5441 8.42879L16.0403 6.43871L14.8285 6.13681L14.3455 8.07445C14.0274 7.9951 13.7003 7.92023 13.3753 7.84605L13.8618 5.89564L12.6511 5.59375L12.1546 7.58314C11.891 7.52311 11.6323 7.46376 11.3811 7.40132L11.3825 7.39511L9.71188 6.97798L9.38963 8.2718C9.38963 8.2718 10.2884 8.47778 10.2694 8.49055C10.7601 8.61303 10.8491 8.9377 10.8339 9.19508L10.2687 11.4622C10.3026 11.4708 10.3464 11.4833 10.3947 11.5026L10.267 11.4708L9.4745 14.6468C9.41447 14.7958 9.26232 15.0194 8.91937 14.9345C8.93144 14.9521 8.03887 14.7147 8.03887 14.7147L7.4375 16.1017L9.01425 16.4947C9.19224 16.5393 9.36807 16.5852 9.54198 16.6305L9.54222 16.6306C9.65476 16.66 9.7665 16.6891 9.87749 16.7176L9.37617 18.7308L10.5862 19.0327L11.083 17.0412C11.4132 17.1309 11.734 17.2137 12.048 17.2917L11.5533 19.2738L12.7646 19.5757L13.2659 17.5667C15.3316 17.9576 16.8852 17.7999 17.5383 15.932C18.0652 14.4277 17.5125 13.5599 16.4256 12.9938C17.2171 12.8106 17.8133 12.2899 17.9724 11.2145H17.9727ZM15.2043 15.0965C14.8604 16.4771 12.6989 15.9059 11.7108 15.6447C11.6223 15.6213 11.5432 15.6004 11.4757 15.5836L12.1409 12.917C12.2234 12.9376 12.3242 12.9602 12.4384 12.9858L12.4384 12.9858C13.4607 13.2152 15.5557 13.6853 15.2047 15.0965H15.2043ZM12.6442 11.7468C13.4687 11.9668 15.2659 12.4463 15.579 11.1921C15.8991 9.90894 14.1515 9.52221 13.298 9.33334C13.2021 9.31211 13.1174 9.29337 13.0483 9.27615L12.4452 11.6947C12.5022 11.709 12.5692 11.7268 12.6442 11.7468Z" fill="#F7931A"/></svg>',
      'ETH' =>
          '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.2" d="M25.9293 12.9998C25.9293 20.1417 20.1397 25.9314 12.9979 25.9314C5.856 25.9314 0.0664062 20.1417 0.0664062 12.9998C0.0664062 5.85795 5.856 0.0683594 12.9979 0.0683594C20.1397 0.0683594 25.9293 5.85795 25.9293 12.9998" fill="#505050"/><g opacity="0.8"><path d="M12.9563 7L12.8765 7.27148V15.1493L12.9563 15.229L16.6131 13.0675L12.9563 7Z" fill="white"/><path d="M12.9566 7L9.2998 13.0675L12.9566 15.229V11.4054V7Z" fill="white"/><path d="M12.9566 16.4182L12.9116 16.4731V19.2794L12.9566 19.4108L16.6156 14.2578L12.9566 16.4182Z" fill="white"/><path d="M12.9566 19.4108V16.4182L9.2998 14.2578L12.9566 19.4108Z" fill="white"/><path d="M12.9565 15.2298L16.6133 13.0684L12.9565 11.4062V15.2298Z" fill="white"/><path d="M9.2998 13.0684L12.9565 15.2299V11.4062L9.2998 13.0684Z" fill="white"/></g></svg>',
      'ETC' =>
          '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.1" d="M13 26C20.1797 26 26 20.1797 26 13C26 5.8203 20.1797 0 13 0C5.8203 0 0 5.8203 0 13C0 20.1797 5.8203 26 13 26Z" fill="#3AB83A"/><mask id="mask0_0_1" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="26" height="26"><path d="M13 26C20.1797 26 26 20.1797 26 13C26 5.8203 20.1797 0 13 0C5.8203 0 0 5.8203 0 13C0 20.1797 5.8203 26 13 26Z" fill="white"/></mask><g mask="url(#mask0_0_1)"><path fill-rule="evenodd" clip-rule="evenodd" d="M10 12.326L13.5144 10.0416L17 12.3402L13.499 6L10 12.326ZM10.1341 12.9858L13.5182 10.7557L16.8583 12.9693L13.5201 15.2017L10.1341 12.9858ZM10 13.6243C11.2334 14.4331 12.5204 15.2797 13.5144 15.9348L17 13.6243C15.7379 15.9395 14.6865 17.8669 13.5144 20L12.7957 18.6974C11.8301 16.9471 10.8343 15.1422 10 13.6243Z" fill="#3AB83A"/><path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 6L13.5131 10.0416L17 12.3402L13.5 6ZM13.5164 10.7557L16.8786 12.9693L13.5181 15.2017L13.5164 10.7557ZM13.5131 15.9348L17 13.6243C15.9185 15.9395 13.5131 20 13.5131 20V15.9348Z" fill="#0B8311"/></g></svg>',
      'BNB' =>
          '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_873_2)"><path opacity="0.2" d="M13 26C20.1797 26 26 20.1797 26 13C26 5.8203 20.1797 0 13 0C5.8203 0 0 5.8203 0 13C0 20.1797 5.8203 26 13 26Z" fill="#F3BA2F"/><path fill-rule="evenodd" clip-rule="evenodd" d="M10.2822 11.8826L13.0013 9.16468L15.7216 11.8848L17.3029 10.3025L13.0013 6L8.69981 10.3014L10.2822 11.8826ZM6 13.0002L7.58181 11.4185L9.16362 13.0002L7.58181 14.582L6 13.0002ZM13.0013 16.8364L10.2822 14.1174L8.69759 15.6975L8.69981 15.6997L13.0013 20L17.3029 15.6975L17.304 15.6964L15.7216 14.1163L13.0013 16.8364ZM16.8364 13.0006L18.4182 11.4189L20 13.0006L18.4182 14.5824L16.8364 13.0006ZM13.0013 11.3939L14.6058 12.9994H14.607L14.6058 13.0006L13.0013 14.6061L11.3968 13.0028L11.3946 12.9994L11.3968 12.9972L11.6777 12.7164L11.8148 12.5804L13.0013 11.3939Z" fill="#F3BA2F"/></g><defs><clipPath id="clip0_873_2"><rect width="26" height="26" fill="white"/></clipPath></defs></svg>',
      'LTC' =>
          '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.2" d="M25.9293 12.9998C25.9293 20.1417 20.1397 25.9314 12.9979 25.9314C5.856 25.9314 0.0664062 20.1417 0.0664062 12.9998C0.0664062 5.85795 5.856 0.0683594 12.9979 0.0683594C20.1397 0.0683594 25.9293 5.85795 25.9293 12.9998" fill="#4291DB"/><path d="M12.5459 15.1759L13.126 12.9914L14.4995 12.4896L14.8411 11.2059L14.8295 11.174L13.4775 11.6679L14.4516 8H11.689L10.4151 12.7867L9.35145 13.1753L9 14.4988L10.0628 14.1105L9.31201 16.9316H16.6644L17.1357 15.1759H12.5459Z" fill="#E4E4E4"/></svg>',
      'GDZ' =>
          '<svg width="36" height="36" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.25" d="M13 26C20.1797 26 26 20.1797 26 13C26 5.8203 20.1797 0 13 0C5.8203 0 0 5.8203 0 13C0 20.1797 5.8203 26 13 26Z" fill="#FFFFFF"/><mask id="mask0_0_1" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="26" height="26"><path d="M13 26C20.1797 26 26 20.1797 26 13C26 5.8203 20.1797 0 13 0C5.8203 0 0 5.8203 0 13C0 20.1797 5.8203 26 13 26Z" fill="white"/></mask><g mask="url(#mask0_0_1)"><path d="M7 11.5C8.19347 11.5 9.33807 11.0259 10.182 10.182C11.0259 9.33807 11.5 8.19347 11.5 7L14.5 7V11.5H19V14.5C17.8065 14.5 16.6619 14.9741 15.818 15.818C14.9741 16.6619 14.5 17.8065 14.5 19L11.5 19V14.5H7L7 11.5Z" fill="white"/></g></svg>',
  ];

@endphp

@extends('layouts/layoutMaster')

@section('title', 'Add Funds')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/bs-stepper/bs-stepper.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/bs-stepper/bs-stepper.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/add-funds.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/add-funds.js', 'resources/assets/js/helpers/gdzhelpers.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="row page-add-funds">
    <div class="col col-12">
      <h5 class="mb-3 lh-1">Add Funds</h5>
      <small class="lh-1 mb-7">
        Fund your account with to start the adventure
      </small>

      <div class="card mt-7">
        <div class="card-body">
          <div id="addFunds" class="bs-stepper bg-light mt-2">
            <div class="bs-stepper-header justify-content-center">
              <div class="step" data-target="#chooseAssetStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Asset</span>
                    <span class="bs-stepper-subtitle">Choose the asset</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5" d="m9 5l6 7l-6 7" />
                </svg>
              </div>
              <div class="step" data-target="#enterAmountStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Amount</span>
                    <span class="bs-stepper-subtitle">Enter the amount</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5" d="m9 5l6 7l-6 7" />
                </svg>
              </div>
              <div class="step" data-target="#summaryStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Summary</span>
                    <span class="bs-stepper-subtitle">View the summary</span>
                  </span>
                </button>
              </div>
              <div class="line">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="1.5" d="m9 5l6 7l-6 7" />
                </svg>
              </div>
              <div class="step" data-target="#proceedStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">4</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Proceed</span>
                    <span class="bs-stepper-subtitle">Make the payment</span>
                  </span>
                </button>
              </div>
              <div class="step d-none" data-target="#completedStep">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle">5</span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title">Completed!</span>
                    <span class="bs-stepper-subtitle">Funds added</span>
                  </span>
                </button>
              </div>
            </div>

            <div class="bs-stepper-content">
              <form id="addFundsForm" onSubmit="return false" novalidate>
                @csrf

                <!-- Choose Asset Step -->
                <div id="chooseAssetStep" class="content">
                  <div class="content-header mb-4 col-8 mx-auto">
                    <h6 class="mb-0">Choose an asset</h6>
                    <small>Choose the asset you want to debit</small>
                  </div>

                  <div class="col-8 mt-6 mx-auto">
                    <small class="d-flex align-items-center text-primary gap-2">
                      <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                          opacity=".4" />
                        <path fill="currentColor"
                          d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                      </svg>
                      Currency rate will be kept fixed for 30 minutes after you proceed.
                    </small>
                  </div>

                  <div class="row g-2 col-8 mt-5 mx-auto choose-asset-form-row">
                    @foreach ($assets as $asset)
                      @if ($asset['symbol'] !== 'GDZ' && $asset['symbol'] !== 'USD')
                        <div class="col-6">
                          <div class="form-check custom-option custom-option-basic">
                            <label class="form-check-label custom-option-content d-flex align-items-center"
                              for="asset{{ $asset['symbol'] }}">
                              <input name="asset" class="form-check-input chooseAssetRadio me-4" type="radio"
                                value="{{ $asset['symbol'] }}" id="asset{{ $asset['symbol'] }}" />
                              <div class="d-flex">
                                {!! $walletIcons[$asset['symbol']] ?? '' !!}
                                <div class="d-flex flex-column ms-2">
                                  <span class="fw-medium">{{ $asset['title'] }}</span>
                                  <small>
                                    {{ $asset['symbol'] }}
                                    {{ $asset['symbol'] === 'USDT'
                                        ? '(TRC-20)'
                                        : ($asset['symbol'] === 'TRX'
                                            ? '(TRC-20)'
                                            : ($asset['symbol'] === 'ETH'
                                                ? '(ERC-20)'
                                                : ($asset['symbol'] === 'ETC'
                                                    ? '(ERC-20)'
                                                    : ($asset['symbol'] === 'BNB'
                                                        ? '(BSC-20)'
                                                        : '')))) }}
                                  </small>
                                </div>
                              </div>
                            </label>
                          </div>
                        </div>
                      @endif
                    @endforeach
                  </div>

                  <div class="col-8 mt-2 mx-auto px-1 choose-asset-error-message"></div>

                  <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                    <button class="btn btn-primary btn-next">
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Continue</span>
                    </button>
                  </div>
                  <!-- Personal Info -->
                </div>

                <!-- Enter Amount Step -->
                <div id="enterAmountStep" class="content">
                  <div class="content-header mb-4 col-8 mx-auto">
                    <h6 class="mb-0">Amount</h6>
                    <small>Enter the amount you want to debit</small>
                  </div>

                  <div class="col-8 mt-6 mx-auto">
                    <small class="d-flex align-items-center text-primary gap-2">
                      <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                          opacity=".4" />
                        <path fill="currentColor"
                          d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                      </svg>
                      Currency rate will be kept fixed for 30 minutes after you proceed.
                    </small>
                  </div>

                  <div class="row g-6 mt-6">
                    <div class="col-8 mx-auto mt-0">
                      <div class="row g-2">
                        <div class="col-5 enter-amount-col">
                          <label class="text-heading mb-2" for="assetAmountInput">Amount in <span
                              class="chosen-asset-text"></span></label>
                          <div class="form-floating">
                            <input name="asset_amount" type="number" class="form-control" id="assetAmountInput"
                              placeholder="0.00" aria-describedby="assetAmountInputHelp"
                              onKeyPress="if(this.value.length==9) return false;" />
                            <label for="assetAmountInput" class="chosen-asset-text"></label>
                            <span class="amount-error-message"></span>
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="d-flex justify-content-center align-items-center h-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5">
                                <path d="m11 19l6-7l-6-7" opacity=".8" />
                                <path d="m7 19l6-7l-6-7" opacity=".4" />
                              </g>
                            </svg>
                          </div>
                        </div>
                        <div class="col-5 enter-amount-col">
                          <label class="text-heading mb-2" for="usdAmountInput">Amount in USD</label>
                          <div class="form-floating">
                            <input name="usd_amount" type="number" class="form-control" id="usdAmountInput"
                              placeholder="0.00" aria-describedby="floatingInputHelp"
                              onKeyPress="if(this.value.length==9) return false;" />
                            <label for="usdAmountInput">USD</label>
                            <div id="usdAmountInputHelp" class="form-text text-light">
                              1 <span class="chosen-asset-text"></span> = <span class="chosen-asset-price">1.00</span>
                              USD
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                    <button class="btn btn-primary btn-next">
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Continue</span>
                    </button>
                    <button class="btn btn-transparent btn-prev">
                      <span class="align-middle d-sm-inline-block d-none fw-normal">Back to previous</span>
                    </button>
                  </div>
                </div>

                <!-- Summary Step -->
                <div id="summaryStep" class="content">
                  <div class="content-header mb-4 col-8 mx-auto">
                    <h6 class="mb-0">Summary</h6>
                    <small>View the summary of your payment before proceeding</small>
                  </div>

                  <div class="col-8 mt-6 mx-auto">
                    <small class="d-flex align-items-center text-primary gap-2">
                      <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                          opacity=".4" />
                        <path fill="currentColor"
                          d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                      </svg>
                      Currency rate will be kept fixed for 30 minutes after you proceed.
                    </small>
                  </div>

                  <div class="row g-6 mt-7">
                    <div class="col-8 mx-auto mt-0">
                      <div class="row g-2">
                        <ol class="list-group">
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>Asset</span>
                              <span class="d-flex align-items-center gap-2">
                                <span class="chosen-asset-icon">
                                  <svg height="18" width="18"></svg>
                                </span>
                                <span class="chosen-asset-text">USDT</span>
                              </span>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>Amount in <span class="chosen-asset-text">USDT</span></span>
                              <span>
                                <span class="chosen-asset-amount">1.00</span>
                                <span class="chosen-asset-text">USDT</span>
                              </span>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>Amount in USD</span>
                              <span>
                                <span class="chosen-asset-price-in-usd">1.00</span> USD
                              </span>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>Fees</span>
                              <span>
                                0.00 USD
                              </span>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                              <span class="d-flex align-items-center">Debit amount <span
                                  class="popover-trigger d-flex justify-content-center align-items-center"
                                  data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                                  data-bs-custom-class="popover-dark"
                                  data-bs-content="Amount that will be credited to your account after successful payment.">
                                  <svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                      d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                      opacity=".3" />
                                    <path fill="currentColor"
                                      d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                  </svg>
                                </span>
                              </span>
                              <span>
                                <span class="chosen-asset-amount">1.00</span>
                                <span class="chosen-asset-text">USDT</span>
                              </span>
                            </div>
                          </li>
                        </ol>

                        <ol class="list-group mt-4">
                          <li class="list-group-item bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                              <span>You will send</span>
                              <span>
                                <span class="chosen-asset-amount">1.00</span>
                                <span class="chosen-asset-text">USDT</span>
                              </span>
                            </div>
                          </li>
                        </ol>
                      </div>
                    </div>
                  </div>

                  <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                    <button class="btn btn-primary btn-next" id="payNowButton">
                      <span class="align-middle d-sm-inline-block d-none me-sm-1">Pay Now</span>
                    </button>
                    <button class="btn btn-transparent btn-prev">
                      <span class="align-middle d-sm-inline-block d-none fw-normal">Back to previous</span>
                    </button>
                  </div>
                </div>

                <!-- Proceed Step -->
                <div id="proceedStep" class="content">
                  <div class="content-header mb-4 col-8 mx-auto">
                    <h6 class="mb-0">Proceed</h6>
                    <small>Send the funds to the provided address below in order to complete</small>
                  </div>

                  <div class="row g-6 mt-8">
                    <div class="col-8 mx-auto mt-0">
                      <div class="row g-2">
                        <div class="card border border-1 border-light p-0">
                          <div class="card-header border-1 border-bottom-1 border-light">
                            <div class="d-flex justify-content-between align-items-center">

                              <div class="d-flex">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                  viewBox="0 0 24 24">
                                  <g fill="none" fill-rule="evenodd">
                                    <path fill="currentColor"
                                      d="M12 4.5a7.5 7.5 0 1 0 0 15a7.5 7.5 0 0 0 0-15M1.5 12C1.5 6.201 6.201 1.5 12 1.5S22.5 6.201 22.5 12S17.799 22.5 12 22.5S1.5 17.799 1.5 12"
                                      opacity=".1" />
                                    <path fill="currentColor"
                                      d="M12 4.5a7.46 7.46 0 0 0-5.187 2.083a1.5 1.5 0 0 1-2.075-2.166A10.46 10.46 0 0 1 12 1.5a1.5 1.5 0 0 1 0 3"
                                      opacity=".7">
                                      <animateTransform attributeType="xml" attributeName="transform" type="rotate"
                                        from="360 12 12" to="0 12 12" dur="4s" additive="sum"
                                        repeatCount="indefinite"></animateTransform>
                                    </path>
                                  </g>
                                </svg>
                                <div class="d-flex flex-column">
                                  <h6 class="mb-0">
                                    Waiting for <span class="chosen-asset-text"></span> funds to arrive.
                                    <br>
                                  </h6>
                                  <span class="fw-light text-light" id="payment-progress-timer">30:00</span>
                                </div>
                              </div>
                              <a href="javascript:;" class="btn btn-sm btn-label-dark tnxId" data-bs-toggle="popover"
                                data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                                data-bs-content="Transaction ID" target="_blank">#TNX</a>
                            </div>
                          </div>

                          <div class="card-body mt-8">
                            <div class="qr-code-wrapper">
                              <img src="data:image/png;base64," alt="QR Code">
                            </div>

                            <div class="d-flex flex-column mt-7">
                              <div
                                class="h5 mb-0 mx-auto d-flex justify-content-center align-items-center gap-2 chosen-asset-amount-wrapper"
                                data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark chosen-asset-amount-popover"
                                data-bs-content="Click to copy">
                                <span class="chosen-asset-amount" id="chosenAssetAmount"></span>
                                <span class="chosen-asset-text"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847s-.843-2.21-.843-4.936z" />
                                  <path fill="currentColor"
                                    d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2S5.343 2 4.172 3.172"
                                    opacity=".5" />
                                </svg>
                              </div>
                              <small><span class="chosen-asset-price-in-usd"></span> USD</small>
                            </div>

                            <label for="walletAddress" class="wallet-address-label mt-8 mb-2">
                              <span class="chosen-asset-text"></span>
                              <span class="chosen-asset-network"></span>
                              <span> address</span>
                            </label>

                            <div class="wallet-address-wrapper" data-bs-toggle="popover" data-bs-trigger="hover"
                              data-bs-placement="top" data-bs-custom-class="popover-dark wallet-address-popover"
                              data-bs-content="Click to copy">
                              <span class="wallet-address-icon">
                                <span class="chosen-asset-icon-sm"></span>
                              </span>
                              <input type="text" class="wallet-address" id="walletAddress"
                                value="TYKTXAo249P8j2Z69is5iZhZpmFTpsWifG" readonly />
                              <span class="wallet-address-copy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847s-.843-2.21-.843-4.936z" />
                                  <path fill="currentColor"
                                    d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2S5.343 2 4.172 3.172"
                                    opacity=".5" />
                                </svg>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mt-12">
                        <div class="d-flex flex-column row-gap-2">
                          <small class="d-flex align-items-center text-primary gap-2">
                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20"
                              height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                                opacity=".4" />
                              <path fill="currentColor"
                                d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                            </svg>
                            <span>Make sure you are sending the correct amount of <span
                                class="chosen-asset-text"></span>.</span>
                          </small>
                          <small class="d-flex align-items-start text-danger gap-2">
                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20"
                              height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                                opacity=".4" />
                              <path fill="currentColor"
                                d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                            </svg>
                            Be cautious about sending the funds to the correct address provided above or your transaction
                            might not complete.
                          </small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
                    <button class="btn btn-label-danger" id="cancelPaymentButton">
                      <span class="align-middle d-sm-inline-block d-none fw-normal">Cancel Payment</span>
                    </button>
                  </div>
                </div>

                <!-- Completed Step -->
                <div id="completedStep" class="content">
                  <div class="row g-6 mt-0">
                    <div class="col-6 mx-auto mt-0">
                      <div class="row g-2">
                        <div class="card bg-light border border-1 p-0" style="background-color: #0e0d0e !important;">
                          <div class="card-body">
                            <div class="d-flex flex-column justify-content-center align-items-center text-center">
                              <span class="text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                  viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M7.245 2h9.51c1.159 0 1.738 0 2.206.163a3.05 3.05 0 0 1 1.881 1.936C21 4.581 21 5.177 21 6.37v14.004c0 .858-.985 1.314-1.608.744a.946.946 0 0 0-1.284 0l-.483.442a1.657 1.657 0 0 1-2.25 0a1.657 1.657 0 0 0-2.25 0a1.657 1.657 0 0 1-2.25 0a1.657 1.657 0 0 0-2.25 0a1.657 1.657 0 0 1-2.25 0l-.483-.442a.946.946 0 0 0-1.284 0c-.623.57-1.608.114-1.608-.744V6.37c0-1.193 0-1.79.158-2.27c.3-.913.995-1.629 1.881-1.937C5.507 2 6.086 2 7.245 2"
                                    opacity=".5" />
                                  <path fill="currentColor"
                                    d="M15.06 8.5a.75.75 0 0 0-1.12-1l-3.011 3.374l-.87-.974a.75.75 0 0 0-1.118 1l1.428 1.6a.75.75 0 0 0 1.119 0zM7.5 14.75a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5z" />
                                </svg>
                              </span>
                              <h5 class="mt-4 mb-0">Transaction Completed</h5>
                              <p class="mt-4 mb-0" style="max-width: 300px;">
                                We've received the funds and you will be able to see them in your wallet shortly. Please
                                wait a few minutes.
                              </p>

                              <div class="border border-bottom-0 border-light my-6 w-100"></div>

                              <small class="mb-0">View transaction details</small>
                              <a href="javascript:;" class="btn btn-sm btn-label-dark tnxId mt-2"
                                data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark" data-bs-content="Transaction ID"
                                target="_blank">#TNX00000000</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
