<div class="modal modal-md fade" id="swapModal" aria-labelledby="swapModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex flex-column">
          <h5 class="mb-3 lh-1">Swap Tool</h5>
          <small class="mb-7">
            Convert an asset to USD or convert USD to any asset without incurring any fees
          </small>
        </div>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body pt-0">
        <form id="swapForm">
          @csrf
          <input type="hidden" name="swapFrom" id="swapFrom" value="TRX">
          <input type="hidden" name="swapTo" id="swapTo" value="USD">

          <div class="swap-wrapper">
            <div class="swap-row">
              <div class="swap-item">
                <div class="swap-select">
                  <span class="swap-label">From</span>

                  <div class="swap-selector" data-swap-selector="swapSelectorModal">
                    <span class="swap-selector-title">
                      <span class="swap-selector-icon">{!! $walletIcons['TRX'] !!}</span>
                      <span class="swap-asset text-dark">TRX</span>
                    </span>
                  </div>
                </div>

                <div class="swap-input">
                  <input type="text" id="swapFromAmount" name="swapFromAmount" value="0.00" placeholder="0.00"
                    data-max="{{ $userBalances->where('wallet', 'TRX')->value('balance') }}"
                    data-price="{{ $marketDataPrices['TRX'] }}">
                  <div class="swap-input-label-wrapper">
                    <small class="swap-input-label">Amount in TRX</small>
                    <small class="swap-price">≈<span>{{ number_format($marketDataPrices['TRX'], 2) }}</span>$</small>
                  </div>
                </div>

                <div class="swap-balance">
                  <small>Balance:</small>
                  <small>
                    <span
                      class="swap-asset-balance">{{ @formatBalance($userBalances->where('wallet', 'TRX')->value('balance')) }}</span>
                    <span class="swap-asset-symbol">TRX</span>
                  </small>
                </div>
              </div>
            </div>

            <div class="swap-invert-wrapper swap-inverted">
              <button type="button" class="swap-invert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M20 10.25a.75.75 0 0 0 .507-1.303l-6-5.5A.75.75 0 0 0 13.25 4v16a.75.75 0 0 0 1.5 0v-9.75z" />
                  <path fill="currentColor"
                    d="M4 13.75h5.25V4a.75.75 0 1 1 1.5 0v16a.75.75 0 0 1-1.257.553l-6-5.5A.75.75 0 0 1 4 13.75"
                    opacity=".5" />
                </svg>
              </button>
            </div>

            <div class="swap-row">
              <div class="swap-item">
                <div class="swap-select">
                  <span class="swap-label">To</span>

                  <div class="swap-selector disabled" data-swap-selector="swapSelectorModal">
                    <span class="swap-selector-title">
                      <span class="swap-selector-icon">{!! $walletIcons['USD'] !!}</span>
                      <span class="text-dark">USD</span>
                    </span>
                  </div>
                </div>

                <div class="swap-input">
                  <input type="text" id="swapToAmount" name="swapToAmount" value="0.00" placeholder="0.00"
                    data-max="{{ $userBalances->where('wallet', 'TRX')->value('balance') * $marketDataPrices['TRX'] }}"
                    data-price="{{ $marketDataPrices['TRX'] }}">
                  <div class="swap-input-label-wrapper">
                    <small class="swap-input-label">Amount in USD</small>
                  </div>
                </div>

                <div class="swap-balance">
                  <small>Balance:</small>
                  <small>
                    <span
                      class="swap-usd-balance">{{ @formatBalance($userBalances->where('wallet', 'USD')->value('balance')) }}</span>
                    <span class="swap-usd-symbol">USD</span>
                  </small>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="swap-error-message text-danger mt-2 text-center d-none">
          <small></small>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn rounded-pill btn-primary mt-4 w-100">
          Swap
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-sm fade" id="swapSelectorModal" aria-labelledby="swapSelectorModal" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex flex-column">
          <h6 class="mb-3 lh-1">Choose an Asset</h6>
          <small class="lh-1 mb-7">
            The asset you want to swap with USD
          </small>
        </div>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body pt-0">
        <ul class="swap-selector-content">
          @foreach ($assets as $asset)
            <li class="swap-selector-asset" data-symbol="{{ $asset->symbol }}">
              <div class="row">
                <div class="col col-6">
                  <div class="d-flex">
                    <span class="swap-selector-icon">{!! $walletIcons[$asset->symbol] ?? '' !!}</span>
                    <div class="d-flex flex-column">
                      <span class="text-dark lh-1 mb-1">
                        {{ $asset->symbol }}
                      </span>
                      <small class="text-light">{{ $asset->title }}</small>
                    </div>
                  </div>
                </div>
                <div class="col col-6">
                  <div class="d-flex justify-content-end align-items-start h-100 text-end">
                    <div class="d-flex flex-column">
                      <span
                        class="text-dark lh-1 mb-1">{{ number_format($userBalances->where('wallet', $asset->symbol)->value('balance') * $marketDataPrices[$asset->symbol], 2) }}$</span>
                      <small class="text-light">
                        {{ @formatBalance($userBalances->where('wallet', $asset->symbol)->value('balance')) }}
                        {{ $asset->symbol }}
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
