@php
  use Illuminate\Support\Facades\Auth;
  use App\Models\UserBalances;
  use App\Models\MarketData;

  $configData = Helper::appClasses();

  // Determine active/inactive wallets
  $activeWallets = collect($wallet)->where('active', true);
  $inactiveWallets = collect($wallet)->where('active', false);

  // Determine existing wallet labels
  $existingLabels = [];
  if ($activeWallets->isNotEmpty()) {
      $existingLabels = $activeWallets->pluck('label')->filter()->values()->toArray();
  }

  // Determine missing assets in wallet
  $missingAssetsInWallet = [];
  foreach ($assets as $asset) {
      $found = false;

      foreach ($wallet as $walletItem) {
          if ($walletItem['symbol'] === $asset['symbol']) {
              $found = true;
              break;
          }
      }
      if (!$found) {
          $missingAssetsInWallet[] = $asset;
      }
  }

  // Get user balances
  $user = Auth::user();
  $userId = $user->id;
  $userBalances = UserBalances::where('user_id', $userId)->get();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Wallet')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js', 'resources/assets/vendor/libs/toastr/toastr.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/wallet.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/wallet.js', 'resources/assets/js/helpers/gdzhelpers.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="page-wallet">
    <h5 class="mb-3 lh-1">Wallet</h5>
    <p class="mb-7 lh-1">Track your balances and manage your wallet addresses</p>

    <div class="row row-gap-4 mb-7">
      <div class="col col-3">
        <div class="card bg-primary bg-glow wallet-item wallet-item-Total">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <h6 class="mb-0 text-white wallet-item-title">Total<br />Balance</h6>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  {{ number_format($userTotalBalance, 2) }}$
                </h5>
                <small class="text-dark">
                  {{ number_format($userTotalBalance * MarketData::where('asset', 'EUR')->value('price'), 2) }}$
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-3">
        <div
          class="card bg-primary bg-glow wallet-item wallet-item-{{ $userBalances->where('wallet', 'GDZ')->value('wallet') }}">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                {!! $walletIconSymbols[$userBalances->where('wallet', 'GDZ')->value('wallet')] ?? '' !!}
                <h6 class="mb-0 text-white wallet-item-title">{{ $userBalances->where('wallet', 'GDZ')->value('title') }}
                </h6>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  {{ number_format($userBalances->where('wallet', 'GDZ')->value('balance') * $marketDataPrices['GDZ'], 2) }}$
                </h5>
                <small class="text-dark">
                  {{ number_format($userBalances->where('wallet', 'GDZ')->value('balance'), 2) }}
                  {{ $userBalances->where('wallet', 'GDZ')->value('wallet') }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-3">
        <div
          class="card bg-primary bg-glow wallet-item wallet-item-{{ $userBalances->where('wallet', 'USD')->value('wallet') }}">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                {!! $walletIconSymbols[$userBalances->where('wallet', 'USD')->value('wallet')] ?? '' !!}
                <h6 class="mb-0 text-white wallet-item-title">
                  {{ $userBalances->where('wallet', 'USD')->value('title') }}
                </h6>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">{{ $userBalances->where('wallet', 'USD')->value('balance') }}$</h5>
                <small class="text-dark">
                  {{ number_format($userBalances->where('wallet', 'USD')->value('balance'), 2) }}
                  {{ $userBalances->where('wallet', 'USD')->value('wallet') }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-3">
        <div
          class="card bg-primary bg-glow wallet-item wallet-item-{{ $userBalances->where('wallet', 'USDT')->value('wallet') }}">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                {!! $walletIconSymbols[$userBalances->where('wallet', 'USDT')->value('wallet')] ?? '' !!}
                <h6 class="mb-0 text-white wallet-item-title">
                  {{ $userBalances->where('wallet', 'USDT')->value('title') }}</h6>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  {{ number_format($userBalances->where('wallet', 'USDT')->value('balance') * $marketDataPrices['USDT'], 2) }}$
                </h5>
                <small class="text-dark">
                  {{ number_format($userBalances->where('wallet', 'USDT')->value('balance'), 2) }}
                  {{ $userBalances->where('wallet', 'USDT')->value('wallet') }}
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="nav-tabs-shadow nav-align-right">
      <ul class="nav nav-tabs bg-light" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#assets"
            aria-controls="assets" aria-selected="false">
            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M14.25 19h1.5c2.317-.005 3.558-.062 4.472-.674a4 4 0 0 0 1.104-1.103C22 16.213 22 14.809 22 12s0-4.213-.674-5.222a4 4 0 0 0-1.104-1.103c-.915-.612-2.155-.669-4.472-.674h-1.5V9H15a3 3 0 1 1 0 6h-.75zm-4.5 0v-4H9a3 3 0 1 1 0-6h.75V5.001h-1.5c-2.317.005-3.557.062-4.472.674a4 4 0 0 0-1.104 1.103C2 7.787 2 9.192 2 12c0 2.81 0 4.214.674 5.223a4 4 0 0 0 1.104 1.103c.915.612 2.155.669 4.472.674z" />
              <path fill="currentColor" d="M9.75 19h4.5V5h-4.5z" opacity=".5" />
            </svg>
            Assets
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#manage"
            aria-controls="manage" aria-selected="false">
            <svg class="me-2" width="24" height="24" viewBox="0 0 112 112" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M98.877 37.3515C98.5846 37.3359 98.2735 37.3297 97.9437 37.3328H85.003C74.405 37.3328 65.333 45.4341 65.333 55.9995C65.333 66.5648 74.405 74.6661 85.003 74.6661H97.9437C98.2735 74.6693 98.5846 74.663 98.877 74.6475C103.184 74.3861 106.992 71.1148 107.314 66.5415C107.333 66.2428 107.333 65.9208 107.333 65.6221V46.3768C107.333 46.0781 107.333 45.7561 107.314 45.4575C106.992 40.8841 103.184 37.6175 98.877 37.3515ZM83.8643 60.9788C86.5897 60.9788 88.8017 58.7481 88.8017 55.9995C88.8017 53.2461 86.5897 51.0201 83.8643 51.0201C81.139 51.0201 78.9177 53.2508 78.9177 55.9995C78.9177 58.7528 81.1343 60.9788 83.8643 60.9788Z"
                fill="currentColor" />
              <path opacity="0.5"
                d="M98.653 37.3427C98.653 31.8313 98.4477 25.9187 94.929 21.686C94.584 21.2723 94.2212 20.8737 93.8417 20.4913C90.3463 17.0007 85.9177 15.4513 80.4483 14.714C75.1283 14 68.3383 14 59.761 14H49.905C41.3277 14 34.533 14 29.213 14.714C23.7437 15.4513 19.315 17.0007 15.8197 20.4913C12.329 23.9867 10.7797 28.4153 10.0423 33.8847C9.33301 39.2047 9.33301 45.9947 9.33301 54.572V55.0947C9.33301 56.3839 9.33301 57.6328 9.33543 58.8424C10.5409 58.1549 11.7297 57.5127 12.8585 56.9885C15.1378 55.9299 17.8742 55 21.1497 55C24.4289 55 27.1659 55.9328 29.4418 56.9907C31.4139 57.9073 33.5745 59.1862 35.6837 60.4347L36.0105 60.6281L37.6294 61.5863L37.9395 61.77C40.0559 63.0238 42.2195 64.3055 43.9805 65.6003C46.0117 67.0936 48.1161 69.0236 49.7039 71.8428C51.2851 74.6503 51.8501 77.4468 52.0902 79.9453C52.3006 82.1348 52.3002 84.677 52.2997 87.1976L52.2997 87.5459V89.4541L52.2997 89.8027C52.3001 91.8069 52.3004 93.824 52.1949 95.6667H59.761C68.3383 95.6667 75.133 95.6667 80.4483 94.9527C85.9177 94.2153 90.3463 92.666 93.8417 89.1753C94.7906 88.2171 95.6088 87.1904 96.2963 86.0953C98.3963 82.7353 98.6483 78.6193 98.6483 74.662L97.9483 74.6667H85.003C74.405 74.6667 65.333 66.5653 65.333 56C65.333 45.4347 74.405 37.3333 85.003 37.3333H97.9437C98.1895 37.3333 98.429 37.3364 98.653 37.3427Z"
                fill="currentColor" />
              <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                d="M21.15 65C18.5321 65 16.1468 66.41 11.381 69.2347L9.76895 70.1888C4.99845 73.0135 2.6179 74.4258 1.30895 76.75C-1.40071e-07 79.0765 0 81.8965 0 87.5459V89.4541C0 95.1011 -1.40071e-07 97.9258 1.30895 100.25C2.6179 102.574 4.99845 103.986 9.76895 106.809L11.381 107.765C16.1468 110.588 18.5321 112 21.15 112C23.7679 112 26.1508 110.59 30.9189 107.765L32.531 106.809C37.2968 103.989 39.6821 102.574 40.9911 100.25C42.3 97.9235 42.3 95.1035 42.3 89.4541V87.5459C42.3 81.8988 42.3 79.0741 40.9911 76.75C39.6821 74.4258 37.2968 73.0135 32.531 70.1888L30.9189 69.2347C26.1484 66.4124 23.7679 65 21.15 65Z"
                fill="currentColor" />
              <path
                d="M21.1504 79.6895C18.8132 79.6895 16.5717 80.6179 14.919 82.2706C13.2663 83.9232 12.3379 86.1647 12.3379 88.502C12.3379 90.8392 13.2663 93.0807 14.919 94.7333C16.5717 96.386 18.8132 97.3145 21.1504 97.3145C23.4876 97.3145 25.7291 96.386 27.3818 94.7333C29.0344 93.0807 29.9629 90.8392 29.9629 88.502C29.9629 86.1647 29.0344 83.9232 27.3818 82.2706C25.7291 80.6179 23.4876 79.6895 21.1504 79.6895Z"
                fill="currentColor" />
            </svg>
            Manage Wallet
          </button>
        </li>
        <li class="nav-item px-4 mt-6">
          <div class="d-flex gap-2">
            <a href="{{ route('page-add-funds') }}" class="btn btn-sm btn-primary bg-glow mx-auto w-50">
              Add Funds
            </a>
            <a href="/send" class="btn btn-sm mx-auto w-50 btn-outline-primary">
              Send
            </a>
          </div>
        </li>
      </ul>

      <div class="tab-content pt-0 ps-0">
        <div class="tab-pane fade show active" id="assets" role="tabpanel" aria-labelledby="assets" tabindex="0">
          <h6 class="mb-2 lh-1">Assets</h6>
          <small class="lh-1 mb-7">
            Available assets in your wallet
          </small>

          <div class="row row-gap-4 mt-7">
            @foreach ($userBalances as $wallet)
              @if ($wallet['wallet'] === 'GDZ' || $wallet['wallet'] === 'USD' || $wallet['wallet'] === 'USDT')
                <div class="col col-4">
                  <div class="card bg-light wallet-item wallet-item-{{ $wallet['wallet'] }}">
                    <div class="p-4 pb-0">
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                          <span class="wallet-item-icon">{!! $walletIcons[$wallet['wallet']] ?? '' !!}</span>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 lh-1 wallet-item-title">{{ $wallet['title'] }}</h6>
                            <small class="text-light">{{ $wallet['wallet'] }}</small>
                          </div>
                        </div>
                        <div class="d-flex flex-column align-items-end text-right">
                          <h5 class="mb-1 lh-1 text-white">
                            {{ number_format($wallet['balance'] * $marketDataPrices[$wallet['wallet']], 2) }}$
                          </h5>
                          <small class="text-light">
                            {{ number_format($wallet['balance'], 2) }}
                            {{ $wallet['wallet'] }}
                          </small>
                        </div>
                      </div>
                    </div>
                    @if ($wallet['wallet'] === 'GDZ')
                      <div class="d-flex justify-content-start p-4">
                        <a href="javascript:;" class="btn btn-icon btn-transparent ms-n2 mb-n2"
                          data-bs-toggle="popover" data-bs-trigger="hover" data-bs-custom-class="popover-dark"
                          data-bs-placement="right" data-bs-content="Swap {{ $wallet['wallet'] }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path fill="currentColor"
                              d="M20.536 20.536C22 19.07 22 16.714 22 12s0-7.071-1.465-8.536C19.072 2 16.714 2 12 2S4.929 2 3.464 3.464C2 4.93 2 7.286 2 12s0 7.071 1.464 8.535C4.93 22 7.286 22 12 22s7.071 0 8.535-1.465"
                              opacity=".4" />
                            <path fill="currentColor"
                              d="M7 10.75a.75.75 0 0 1-.493-1.315l3.437-3a.75.75 0 0 1 .987 1.13L9 9.25h8a.75.75 0 0 1 0 1.5zm6.07 5.685a.75.75 0 0 0 .986 1.13l3.437-3A.75.75 0 0 0 17 13.25H7a.75.75 0 0 0 0 1.5h8z" />
                          </svg>
                        </a>
                      </div>
                      <div class="wallet-item-current-price">
                        <div class="d-flex flex-column align-items-end text-right">
                          <span class="d-flex flex-column align-items-end text-heading">
                            <small class="text-light">Price</small>
                            {{ number_format($marketDataPrices['GDZ'], 2) }}$
                          </span>
                        </div>
                      </div>
                    @else
                      <div class="d-flex justify-content-end p-4">
                        <a href="javascript:;" class="btn btn-icon btn-transparent me-n2 mb-n2"data-bs-toggle="popover"
                          data-bs-trigger="hover" data-bs-custom-class="popover-dark" data-bs-placement="left"
                          data-bs-content="Swap {{ $wallet['wallet'] }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path fill="currentColor"
                              d="M20.536 20.536C22 19.07 22 16.714 22 12s0-7.071-1.465-8.536C19.072 2 16.714 2 12 2S4.929 2 3.464 3.464C2 4.93 2 7.286 2 12s0 7.071 1.464 8.535C4.93 22 7.286 22 12 22s7.071 0 8.535-1.465"
                              opacity=".4" />
                            <path fill="currentColor"
                              d="M7 10.75a.75.75 0 0 1-.493-1.315l3.437-3a.75.75 0 0 1 .987 1.13L9 9.25h8a.75.75 0 0 1 0 1.5zm6.07 5.685a.75.75 0 0 0 .986 1.13l3.437-3A.75.75 0 0 0 17 13.25H7a.75.75 0 0 0 0 1.5h8z" />
                          </svg>
                        </a>
                      </div>
                    @endif
                  </div>
                </div>
              @endif
            @endforeach

            @foreach ($userBalances as $wallet)
              @if (
                  $wallet['wallet'] !== 'Total' &&
                      $wallet['wallet'] !== 'GDZ' &&
                      $wallet['wallet'] !== 'USD' &&
                      $wallet['wallet'] !== 'USDT')
                <div class="col col-4">
                  <div class="card bg-light wallet-item wallet-item-{{ $wallet['wallet'] }}">
                    <div class="p-4 pb-0">
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                          <span class="wallet-item-icon">{!! $walletIcons[$wallet['wallet']] ?? '' !!}</span>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 lh-1 wallet-item-title">{{ $wallet['title'] }}</h6>
                            <small class="text-light">{{ $wallet['wallet'] }}</small>
                          </div>
                        </div>
                        <div class="d-flex flex-column align-items-end text-right">
                          <h5 class="mb-1 lh-1" data-asset="{{ $wallet['wallet'] }}"
                            data-asset-balance={{ $wallet['balance'] }}>
                            {{ number_format($wallet['balance'] * $marketDataPrices[$wallet['wallet']], 2) }}$
                          </h5>
                          <small class="text-light">
                            {{ number_format($wallet['balance'], 2) }}
                            {{ $wallet['wallet'] }}
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="wallet-asset-chart wallet-asset-chart-{{ $wallet['wallet'] }}"></div>
                    <div class="wallet-item-current-price price-hidden">
                      <div class="d-flex flex-column align-items-end text-right">
                        <span class="d-flex flex-column align-items-end text-heading">
                          <small class="text-light">Price</small>
                          {{ number_format($marketDataPrices[$wallet['wallet']], 2) }}$
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach
          </div>

          <div class="col-12 mt-7">
            <div class="d-flex justify-content-between align-items-center bg-light p-4 rounded">
              <div class="d-flex align-items-center">
                <svg class="text-primary me-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" viewBox="0 0 24 24">
                  <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                    opacity=".3" />
                  <path fill="currentColor"
                    d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                </svg>
                <p class="mb-0">
                  You can send funds to different asset types by adding them on <a
                    href="{{ route('page-wallet') }}?tab=manage">Manage Wallet</a> section.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="manage" role="tabpanel" aria-labelledby="manage" tabindex="0">
          <h6 class="mb-2 lh-1">Manage Wallet</h6>
          <small class="lh-1">
            Add, remove, edit your wallet addresses
          </small>

          <div class="row row-gap-4 mt-7">
            <h6 class="mb-0 lh-1">Active Wallets</h6>
            @foreach ($activeWallets as $walletItem)
              @if ($walletItem['symbol'] !== 'USD' && $walletItem['symbol'] !== 'GDZ' && $walletItem['symbol'] !== 'Total')
                <div class="col-6">
                  <div class="card bg-light wallet-address-item">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label d-flex align-items-center mb-0"
                          for="{{ $walletItem['symbol'] }}-wallet-address">
                          <span class="d-flex align-items-center me-2">
                            {!! $walletIcons[$walletItem['symbol']] !!}
                          </span>
                          <div class="d-flex flex-column">
                            <div class="h6 mb-0">
                              {{ $walletItem['label'] ?? $walletItem['title'] }}
                            </div>
                            <small class="text-light">
                              {{ $walletItem['symbol'] }}
                            </small>
                          </div>
                        </label>
                        <button type="button" class="btn btn-sm btn-icon btn-transparent toggle-manage-modal-button"
                          data-bs-toggle="modal" data-bs-target="#manageWalletModal"
                          data-bs-target="#manageWalletModal" data-id="{{ $walletItem['id'] }}"
                          data-symbol="{{ $walletItem['symbol'] }}" data-title="{{ $walletItem['title'] }}"
                          data-active="{{ $walletItem['active'] ? 'true' : 'false' }}"
                          data-address="{{ $walletItem['wallet_address'] ?? '' }}"
                          data-label="{{ $walletItem['label'] ?? '' }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M14.279 2.152C13.909 2 13.439 2 12.5 2s-1.408 0-1.779.152a2 2 0 0 0-1.09 1.083c-.094.223-.13.484-.145.863a1.62 1.62 0 0 1-.796 1.353a1.64 1.64 0 0 1-1.579.008c-.338-.178-.583-.276-.825-.308a2.03 2.03 0 0 0-1.49.396c-.318.242-.553.646-1.022 1.453c-.47.807-.704 1.21-.757 1.605c-.07.526.074 1.058.4 1.479c.148.192.357.353.68.555c.477.297.783.803.783 1.361s-.306 1.064-.782 1.36c-.324.203-.533.364-.682.556a2 2 0 0 0-.399 1.479c.053.394.287.798.757 1.605s.704 1.21 1.022 1.453c.424.323.96.465 1.49.396c.242-.032.487-.13.825-.308a1.64 1.64 0 0 1 1.58.008c.486.28.774.795.795 1.353c.015.38.051.64.145.863c.204.49.596.88 1.09 1.083c.37.152.84.152 1.779.152s1.409 0 1.779-.152a2 2 0 0 0 1.09-1.083c.094-.223.13-.483.145-.863c.02-.558.309-1.074.796-1.353a1.64 1.64 0 0 1 1.579-.008c.338.178.583.276.825.308c.53.07 1.066-.073 1.49-.396c.318-.242.553-.646 1.022-1.453c.47-.807.704-1.21.757-1.605a2 2 0 0 0-.4-1.479c-.148-.192-.357-.353-.68-.555c-.477-.297-.783-.803-.783-1.361s.306-1.064.782-1.36c.324-.203.533-.364.682-.556a2 2 0 0 0 .399-1.479c-.053-.394-.287-.798-.757-1.605s-.704-1.21-1.022-1.453a2.03 2.03 0 0 0-1.49-.396c-.242.032-.487.13-.825.308a1.64 1.64 0 0 1-1.58-.008a1.62 1.62 0 0 1-.795-1.353c-.015-.38-.051-.64-.145-.863a2 2 0 0 0-1.09-1.083"
                              clip-rule="evenodd" opacity=".5" />
                            <path fill="currentColor"
                              d="M15.523 12c0 1.657-1.354 3-3.023 3s-3.023-1.343-3.023-3S10.83 9 12.5 9s3.023 1.343 3.023 3" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach

            @if (!$activeWallets->count())
              <div class="col">
                <div class="card bg-light py-6">
                  <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                      <h6 class="mb-1">You don't have any{{ $inactiveWallets->count() ? ' activated' : '' }}
                        wallet.
                      </h6>
                      <p>Please {{ $inactiveWallets->count() ? 'activate' : 'add' }} a wallet in order to
                        cash-out.</p>
                      <button type="button" class="addWalletModalToggle btn btn-sm btn-primary mt-3"
                        data-bs-toggle="modal" data-bs-target="#addWalletModal">
                        <svg class="me-2" width="24" height="24" viewBox="0 0 112 112" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M98.877 37.3515C98.5846 37.3359 98.2735 37.3297 97.9437 37.3328H85.003C74.405 37.3328 65.333 45.4341 65.333 55.9995C65.333 66.5648 74.405 74.6661 85.003 74.6661H97.9437C98.2735 74.6693 98.5846 74.663 98.877 74.6475C103.184 74.3861 106.992 71.1148 107.314 66.5415C107.333 66.2428 107.333 65.9208 107.333 65.6221V46.3768C107.333 46.0781 107.333 45.7561 107.314 45.4575C106.992 40.8841 103.184 37.6175 98.877 37.3515ZM83.8643 60.9788C86.5897 60.9788 88.8017 58.7481 88.8017 55.9995C88.8017 53.2461 86.5897 51.0201 83.8643 51.0201C81.139 51.0201 78.9177 53.2508 78.9177 55.9995C78.9177 58.7528 81.1343 60.9788 83.8643 60.9788Z"
                            fill="currentColor" />
                          <path opacity="0.5"
                            d="M98.653 37.3427C98.653 31.8313 98.4477 25.9187 94.929 21.686C94.584 21.2723 94.2212 20.8737 93.8417 20.4913C90.3463 17.0007 85.9177 15.4513 80.4483 14.714C75.1283 14 68.3383 14 59.761 14H49.905C41.3277 14 34.533 14 29.213 14.714C23.7437 15.4513 19.315 17.0007 15.8197 20.4913C12.329 23.9867 10.7797 28.4153 10.0423 33.8847C9.33301 39.2047 9.33301 45.9947 9.33301 54.572V55.0947C9.33301 56.1335 9.33301 57.1462 9.33428 58.1333C13.6367 56.1229 18.437 55 23.4997 55C42.0016 55 56.9997 69.9981 56.9997 88.5C56.9997 90.9598 56.7346 93.3577 56.2314 95.6667H59.761C68.3383 95.6667 75.133 95.6667 80.4483 94.9527C85.9177 94.2153 90.3463 92.666 93.8417 89.1753C94.7906 88.2171 95.6088 87.1904 96.2964 86.0953C98.3964 82.7353 98.6483 78.6193 98.6483 74.662L97.9483 74.6667H85.003C74.405 74.6667 65.333 66.5653 65.333 56C65.333 45.4347 74.405 37.3333 85.003 37.3333H97.9437C98.1895 37.3333 98.429 37.3364 98.653 37.3427Z"
                            fill="currentColor" />
                          <path opacity="0.5"
                            d="M47 88.5C47 101.479 36.479 112 23.5 112C10.521 112 0 101.479 0 88.5C0 75.521 10.521 65 23.5 65C36.479 65 47 75.521 47 88.5Z"
                            fill="currentColor" />
                          <path
                            d="M26.2 77.7C26.2 76.9839 25.9155 76.2972 25.4092 75.7908C24.9028 75.2845 24.2161 75 23.5 75C22.7839 75 22.0972 75.2845 21.5908 75.7908C21.0845 76.2972 20.8 76.9839 20.8 77.7V85.8H12.7C11.9839 85.8 11.2972 86.0845 10.7908 86.5908C10.2845 87.0972 10 87.7839 10 88.5C10 89.2161 10.2845 89.9028 10.7908 90.4092C11.2972 90.9155 11.9839 91.2 12.7 91.2H20.8V99.3C20.8 100.016 21.0845 100.703 21.5908 101.209C22.0972 101.716 22.7839 102 23.5 102C24.2161 102 24.9028 101.716 25.4092 101.209C25.9155 100.703 26.2 100.016 26.2 99.3V91.2H34.3C35.0161 91.2 35.7028 90.9155 36.2092 90.4092C36.7155 89.9028 37 89.2161 37 88.5C37 87.7839 36.7155 87.0972 36.2092 86.5908C35.7028 86.0845 35.0161 85.8 34.3 85.8H26.2V77.7Z"
                            fill="currentColor" />
                        </svg>
                        <span class="text-nowrap">
                          Add Wallet
                        </span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            @endif

            @if ($inactiveWallets->count())
              <h6 class="mt-7 mb-0 lh-1">Inactive Wallets</h6>
              @foreach ($inactiveWallets as $walletItem)
                <div class="col-6">
                  <div class="card bg-light wallet-address-item wallet-address-item-disabled">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label d-flex align-items-center mb-0"
                          for="{{ $walletItem['symbol'] }}-wallet-address">
                          <span class="d-flex align-items-center me-2">
                            {!! $walletIcons[$walletItem['symbol']] !!}
                          </span>
                          <div class="d-flex flex-column">
                            <div class="h6 mb-0">
                              <span>{{ $walletItem['label'] ?? $walletItem['title'] }}</span>
                            </div>
                            <small class="text-light">
                              {{ $walletItem['symbol'] }}&nbsp;{{ $walletItem['symbol'] === 'ETH' || $walletItem['symbol'] === 'ETC' ? '(ERC-20)' : '' }}{{ $walletItem['symbol'] === 'USDT' || $walletItem['symbol'] === 'TRX' ? '(TRC-20)' : '' }}
                            </small>
                          </div>
                        </label>
                        <button type="button" class="btn btn-sm btn-icon btn-transparent toggle-manage-modal-button"
                          data-bs-toggle="modal" data-bs-target="#manageWalletModal"
                          data-bs-target="#manageWalletModal" data-id="{{ $walletItem['id'] }}"
                          data-symbol="{{ $walletItem['symbol'] }}" data-title="{{ $walletItem['title'] }}"
                          data-active="{{ $walletItem['active'] ? 'true' : 'false' }}"
                          data-address="{{ $walletItem['wallet_address'] ?? '' }}"
                          data-label="{{ $walletItem['label'] ?? '' }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M14.279 2.152C13.909 2 13.439 2 12.5 2s-1.408 0-1.779.152a2 2 0 0 0-1.09 1.083c-.094.223-.13.484-.145.863a1.62 1.62 0 0 1-.796 1.353a1.64 1.64 0 0 1-1.579.008c-.338-.178-.583-.276-.825-.308a2.03 2.03 0 0 0-1.49.396c-.318.242-.553.646-1.022 1.453c-.47.807-.704 1.21-.757 1.605c-.07.526.074 1.058.4 1.479c.148.192.357.353.68.555c.477.297.783.803.783 1.361s-.306 1.064-.782 1.36c-.324.203-.533.364-.682.556a2 2 0 0 0-.399 1.479c.053.394.287.798.757 1.605s.704 1.21 1.022 1.453c.424.323.96.465 1.49.396c.242-.032.487-.13.825-.308a1.64 1.64 0 0 1 1.58.008c.486.28.774.795.795 1.353c.015.38.051.64.145.863c.204.49.596.88 1.09 1.083c.37.152.84.152 1.779.152s1.409 0 1.779-.152a2 2 0 0 0 1.09-1.083c.094-.223.13-.483.145-.863c.02-.558.309-1.074.796-1.353a1.64 1.64 0 0 1 1.579-.008c.338.178.583.276.825.308c.53.07 1.066-.073 1.49-.396c.318-.242.553-.646 1.022-1.453c.47-.807.704-1.21.757-1.605a2 2 0 0 0-.4-1.479c-.148-.192-.357-.353-.68-.555c-.477-.297-.783-.803-.783-1.361s.306-1.064.782-1.36c.324-.203.533-.364.682-.556a2 2 0 0 0 .399-1.479c-.053-.394-.287-.798-.757-1.605s-.704-1.21-1.022-1.453a2.03 2.03 0 0 0-1.49-.396c-.242.032-.487.13-.825.308a1.64 1.64 0 0 1-1.58-.008a1.62 1.62 0 0 1-.795-1.353c-.015-.38-.051-.64-.145-.863a2 2 0 0 0-1.09-1.083"
                              clip-rule="evenodd" opacity=".5" />
                            <path fill="currentColor"
                              d="M15.523 12c0 1.657-1.354 3-3.023 3s-3.023-1.343-3.023-3S10.83 9 12.5 9s3.023 1.343 3.023 3" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

            @if ($missingAssetsInWallet)
              <div class="col-12 mt-7">
                <div class="d-flex justify-content-between align-items-center bg-light p-4 rounded">
                  <div class="d-flex flex-column">
                    <p class="mb-0">
                      Add a cryptocurrency address to your wallet in order to receive balances to external wallets
                    </p>
                  </div>
                  <button type="button" class="addWalletModalToggle btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addWalletModal">
                    <svg class="me-2" width="24" height="24" viewBox="0 0 112 112" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M98.877 37.3515C98.5846 37.3359 98.2735 37.3297 97.9437 37.3328H85.003C74.405 37.3328 65.333 45.4341 65.333 55.9995C65.333 66.5648 74.405 74.6661 85.003 74.6661H97.9437C98.2735 74.6693 98.5846 74.663 98.877 74.6475C103.184 74.3861 106.992 71.1148 107.314 66.5415C107.333 66.2428 107.333 65.9208 107.333 65.6221V46.3768C107.333 46.0781 107.333 45.7561 107.314 45.4575C106.992 40.8841 103.184 37.6175 98.877 37.3515ZM83.8643 60.9788C86.5897 60.9788 88.8017 58.7481 88.8017 55.9995C88.8017 53.2461 86.5897 51.0201 83.8643 51.0201C81.139 51.0201 78.9177 53.2508 78.9177 55.9995C78.9177 58.7528 81.1343 60.9788 83.8643 60.9788Z"
                        fill="currentColor" />
                      <path opacity="0.5"
                        d="M98.653 37.3427C98.653 31.8313 98.4477 25.9187 94.929 21.686C94.584 21.2723 94.2212 20.8737 93.8417 20.4913C90.3463 17.0007 85.9177 15.4513 80.4483 14.714C75.1283 14 68.3383 14 59.761 14H49.905C41.3277 14 34.533 14 29.213 14.714C23.7437 15.4513 19.315 17.0007 15.8197 20.4913C12.329 23.9867 10.7797 28.4153 10.0423 33.8847C9.33301 39.2047 9.33301 45.9947 9.33301 54.572V55.0947C9.33301 56.1335 9.33301 57.1462 9.33428 58.1333C13.6367 56.1229 18.437 55 23.4997 55C42.0016 55 56.9997 69.9981 56.9997 88.5C56.9997 90.9598 56.7346 93.3577 56.2314 95.6667H59.761C68.3383 95.6667 75.133 95.6667 80.4483 94.9527C85.9177 94.2153 90.3463 92.666 93.8417 89.1753C94.7906 88.2171 95.6088 87.1904 96.2964 86.0953C98.3964 82.7353 98.6483 78.6193 98.6483 74.662L97.9483 74.6667H85.003C74.405 74.6667 65.333 66.5653 65.333 56C65.333 45.4347 74.405 37.3333 85.003 37.3333H97.9437C98.1895 37.3333 98.429 37.3364 98.653 37.3427Z"
                        fill="currentColor" />
                      <path opacity="0.5"
                        d="M47 88.5C47 101.479 36.479 112 23.5 112C10.521 112 0 101.479 0 88.5C0 75.521 10.521 65 23.5 65C36.479 65 47 75.521 47 88.5Z"
                        fill="currentColor" />
                      <path
                        d="M26.2 77.7C26.2 76.9839 25.9155 76.2972 25.4092 75.7908C24.9028 75.2845 24.2161 75 23.5 75C22.7839 75 22.0972 75.2845 21.5908 75.7908C21.0845 76.2972 20.8 76.9839 20.8 77.7V85.8H12.7C11.9839 85.8 11.2972 86.0845 10.7908 86.5908C10.2845 87.0972 10 87.7839 10 88.5C10 89.2161 10.2845 89.9028 10.7908 90.4092C11.2972 90.9155 11.9839 91.2 12.7 91.2H20.8V99.3C20.8 100.016 21.0845 100.703 21.5908 101.209C22.0972 101.716 22.7839 102 23.5 102C24.2161 102 24.9028 101.716 25.4092 101.209C25.9155 100.703 26.2 100.016 26.2 99.3V91.2H34.3C35.0161 91.2 35.7028 90.9155 36.2092 90.4092C36.7155 89.9028 37 89.2161 37 88.5C37 87.7839 36.7155 87.0972 36.2092 86.5908C35.7028 86.0845 35.0161 85.8 34.3 85.8H26.2V77.7Z"
                        fill="currentColor" />
                    </svg>
                    <span class="text-nowrap">
                      Add Wallet
                    </span>
                  </button>
                </div>
              </div>
            @endif
          </div>

          <div class="row mt-12">
            <div class="d-flex flex-column row-gap-2">
              <small class="d-flex align-items-center text-primary gap-2">
                <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                    opacity=".4" />
                  <path fill="currentColor"
                    d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                </svg>
                The updated wallet address will only apply to future transactions. Previous transactions remain
                unaffected.
              </small>
              <small class="d-flex text-danger gap-2">
                <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                    opacity=".4" />
                  <path fill="currentColor"
                    d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                </svg>
                Please ensure you provide a correct wallet address, especially with correct blockchain network (eg.
                TRC-20). Incorrect addresses may result in lost funds on the blockchain.
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade modal-lg" id="addWalletModal" tabindex="-1" aria-labelledby="addWalletModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" action="{{ route('add-wallet') }}" id="addWalletModalForm">
          <div class="modal-header">
            <div class="d-flex flex-column">
              <h5 class="modal-title" id="addWalletLabel">Add Wallet</h5>
              <p>Add a cryptocurrency address to your wallet in order to receive balances to external wallets</p>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-4 add-wallet-form-row">
                <label for="addWalletAssetSelect" class="form-label required">Available Assets</label>
                <select id="addWalletAssetSelect" class="selectpicker w-100" data-style="btn-default" name="symbol">
                  @foreach ($assets as $asset)
                    @if (!collect($wallet)->pluck('symbol')->contains($asset['symbol']))
                      <option value="{{ $asset['symbol'] }}" data-show-subtext='true'
                        data-subtext='{{ $asset['symbol'] }}' data-title={{ $asset['title'] }}>
                        {{ $asset['title'] }}
                      </option>
                    @endif
                  @endforeach
                </select>
              </div>

              <div class="col-8 add-wallet-form-row">
                <label for="addWalletAddressInput" class="form-label required">Wallet Address</label>
                <div class="input-group required">
                  <span class="input-group-text" id="addWalletAssetIcon">
                    <svg height="24" width="24"></svg>
                  </span>
                  <input type="text" class="form-control" placeholder="eg. TR7NHqj..." aria-label="eg. TR7NHqj..."
                    id="addWalletAddressInput" name="wallet_address" />
                  <button class="btn btn-label-primary border border-primary px-3" type="button"
                    id="addWalletPasteButton" style="border-right-color: var(--bs-primary) !important;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M21 15.998v-6c0-2.828 0-4.242-.879-5.121C19.353 4.109 18.175 4.012 16 4H8c-2.175.012-3.353.109-4.121.877C3 5.756 3 7.17 3 9.998v6c0 2.829 0 4.243.879 5.122c.878.878 2.293.878 5.121.878h6c2.828 0 4.243 0 5.121-.878c.879-.88.879-2.293.879-5.122"
                        opacity=".5" />
                      <path fill="currentColor"
                        d="M8 3.5A1.5 1.5 0 0 1 9.5 2h5A1.5 1.5 0 0 1 16 3.5v1A1.5 1.5 0 0 1 14.5 6h-5A1.5 1.5 0 0 1 8 4.5z" />
                      <path fill="currentColor" fill-rule="evenodd"
                        d="M6.25 10.5A.75.75 0 0 1 7 9.75h10a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75m1 3.5a.75.75 0 0 1 .75-.75h8a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75m1 3.5a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75"
                        clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </div>

              <div class="col-12">
                <div class="form-text mt-2">
                  You will receive outgoing transactions to this external wallet address.
                </div>
              </div>

              <div class="col-12 mt-6 add-wallet-form-row">
                <label for="addModalAssetLabel" class="form-label">
                  Label
                  <span class="text-light">(Optional)</span>
                </label>
                <div class="input-group">
                  <input type="text" class="form-control rounded" placeholder="eg. Personal"
                    aria-label="eg. Personal" id="addModalAssetLabel"
                    name="label"data-existing-labels="{{ implode(', ', $existingLabels) }}" />
                </div>
              </div>

              <div class="col-12">
                <div class="form-text mt-2">
                  You can easily identify this wallet using a custom label for it.
                </div>
              </div>

              <div class="row mt-12">
                <div class="d-flex flex-column row-gap-2">
                  <small class="d-flex text-danger gap-2">
                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                      viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                        opacity=".4" />
                      <path fill="currentColor"
                        d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                    </svg>
                    Please ensure you provide a correct wallet address, especially with correct blockchain network (eg.
                    TRC-20 for Tron network). Incorrect addresses may result in lost funds on the blockchain.
                  </small>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer mt-6">
            <button type="button" class="btn btn-sm btn-label-primary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-sm btn-primary px-6">Add</button>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade modal-lg" id="manageWalletModal" tabindex="-1" aria-labelledby="manageWalletModalTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" method="POST" action="{{ route('update-wallet') }}" id="manageWalletForm">
          @csrf
          <div class="manage-wallet-form-row">
            <input name="symbol" type="hidden" value="" id="manageWalletModalSymbol" data-wallet-id="">
          </div>
          <div class="modal-header">
            <div class="d-flex align-items-center">
              <span class="me-3" id="manageWalletModalIcon"></span>
              <div class="d-flex flex-column">
                <h5 class="modal-title" id="manageWalletModalTitle"></h5>
                <span id="manageWalletModalSymbolLabel"></span>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12 manage-wallet-form-row">
                <label for="manageWalletAddressInput" class="form-label required">Wallet Address</label>
                <div class="input-group required">
                  <span class="input-group-text" id="manageWalletAssetIcon">
                    <svg height="24" width="24"></svg>
                  </span>
                  <input type="text" class="form-control" placeholder="eg. TR7NHqj..." aria-label="eg. TR7NHqj..."
                    id="manageWalletAddressInput" required name="wallet_address" />
                  <button class="btn btn-label-primary border border-primary px-3" type="button"
                    id="manageWalletPasteButton" style="border-right-color: var(--bs-primary) !important;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M21 15.998v-6c0-2.828 0-4.242-.879-5.121C19.353 4.109 18.175 4.012 16 4H8c-2.175.012-3.353.109-4.121.877C3 5.756 3 7.17 3 9.998v6c0 2.829 0 4.243.879 5.122c.878.878 2.293.878 5.121.878h6c2.828 0 4.243 0 5.121-.878c.879-.88.879-2.293.879-5.122"
                        opacity=".5" />
                      <path fill="currentColor"
                        d="M8 3.5A1.5 1.5 0 0 1 9.5 2h5A1.5 1.5 0 0 1 16 3.5v1A1.5 1.5 0 0 1 14.5 6h-5A1.5 1.5 0 0 1 8 4.5z" />
                      <path fill="currentColor" fill-rule="evenodd"
                        d="M6.25 10.5A.75.75 0 0 1 7 9.75h10a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75m1 3.5a.75.75 0 0 1 .75-.75h8a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75m1 3.5a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75"
                        clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </div>

              <div class="col-12">
                <div class="form-text mt-2">
                  You will receive outgoing transactions to this external wallet address.
                </div>
              </div>

              <div class="col-12 manage-wallet-form-row mt-6">
                <label for="manageModalAssetLabel" class="form-label">
                  Label
                  <span class="text-light">(Optional)</span>
                </label>
                <div class="input-group">
                  <input type="text" class="form-control rounded" placeholder="eg. Personal"
                    aria-label="eg. Personal" id="manageModalAssetLabel" name="label"
                    data-existing-labels="{{ implode(', ', $existingLabels) }}" />
                </div>
              </div>

              <div class="col-12">
                <div class="form-text mt-2">
                  You can easily identify this wallet using a custom label for it.
                </div>
              </div>

              <div class="col-12 manage-wallet-form-row mt-6">
                <label class="switch switch-outline">
                  <input type="checkbox" class="switch-input" id="manageWalletActiveSwitch" name="active" />
                  <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                  </span>
                  <small class="switch-label" id="manageWalletActiveLabel">Active/Inactive</small>
                </label>
              </div>

              <div class="col-12">
                <div class="form-text mt-2">
                  Set this wallet address active/inactive for receiving balances
                </div>
              </div>

              <div class="row mt-12">
                <div class="d-flex flex-column row-gap-2">
                  <small class="d-flex align-items-center text-primary gap-2">
                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                      viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                        opacity=".4" />
                      <path fill="currentColor"
                        d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                    </svg>
                    The updated wallet address will only apply to future transactions. Previous transactions remain
                    unaffected.
                  </small>
                  <small class="d-flex text-danger gap-2">
                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                      viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                        opacity=".4" />
                      <path fill="currentColor"
                        d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                    </svg>
                    Please ensure you provide a correct wallet address, especially with correct blockchain network (eg.
                    TRC-20). Incorrect addresses may result in lost funds on the blockchain.
                  </small>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer mt-6">
            <button type="button" class="btn btn-sm btn-label-danger me-auto" id="manageWalletRemoveButton">
              <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M3 6.386c0-.484.345-.877.771-.877h2.665c.529-.016.996-.399 1.176-.965l.03-.1l.115-.391c.07-.24.131-.45.217-.637c.338-.739.964-1.252 1.687-1.383c.184-.033.378-.033.6-.033h3.478c.223 0 .417 0 .6.033c.723.131 1.35.644 1.687 1.383c.086.187.147.396.218.637l.114.391l.03.1c.18.566.74.95 1.27.965h2.57c.427 0 .772.393.772.877s-.345.877-.771.877H3.77c-.425 0-.77-.393-.77-.877" />
                <path fill="currentColor" fill-rule="evenodd"
                  d="M9.425 11.482c.413-.044.78.273.821.707l.5 5.263c.041.433-.26.82-.671.864c-.412.043-.78-.273-.821-.707l-.5-5.263c-.041-.434.26-.821.671-.864m5.15 0c.412.043.713.43.671.864l-.5 5.263c-.04.434-.408.75-.82.707c-.413-.044-.713-.43-.672-.864l.5-5.264c.041-.433.409-.75.82-.707"
                  clip-rule="evenodd" />
                <path fill="currentColor"
                  d="M11.596 22h.808c2.783 0 4.174 0 5.08-.886c.904-.886.996-2.339 1.181-5.245l.267-4.188c.1-1.577.15-2.366-.303-2.865c-.454-.5-1.22-.5-2.753-.5H8.124c-1.533 0-2.3 0-2.753.5s-.404 1.288-.303 2.865l.267 4.188c.185 2.906.277 4.36 1.182 5.245c.905.886 2.296.886 5.079.886"
                  opacity=".5" />
              </svg>
              Remove Wallet
            </button>
            <button type="button" class="btn btn-sm btn-label-primary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-sm btn-primary px-6" id="manageWalletSubmitButton">Save</button>
          </div>
        </form>
      </div>
    </div>
  @endsection
