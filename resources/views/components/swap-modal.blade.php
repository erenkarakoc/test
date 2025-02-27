<div class="modal modal-md fade" id="swapModal" aria-labelledby="swapModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form class="modal-content" id="swapForm">
      @csrf
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
        <div>
          <input type="hidden" name="swapAmount" id="swapAmount">
          <input type="hidden" name="swapAsset" id="swapAsset" value="TRX">
          <input type="hidden" name="isSwapToAsset" id="isSwapToAsset" value="false">

          <div class="swap-wrapper">
            <div class="swap-row swap-row-asset">
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
                    <small class="swap-input-label">Amount in <span class="swap-asset">TRX</span></small>
                    <small class="swap-price">≈<span>{{ number_format($marketDataPrices['TRX'], 2) }}</span>$</small>
                  </div>
                </div>

                <div class="swap-balance">
                  <small>Balance:</small>
                  <small>
                    <span class="swap-asset-balance"
                      data-price="{{ $marketDataPrices['TRX'] }}">{{ @formatBalance($userBalances->where('wallet', 'TRX')->value('balance')) }}</span>
                    <span class="swap-asset">TRX</span>
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
                    data-max="{{ $userBalances->where('wallet', 'USD')->value('balance') }}"
                    data-price="{{ $marketDataPrices['TRX'] }}">
                  <div class="swap-input-label-wrapper">
                    <small class="swap-input-label">Amount in USD</small>
                  </div>
                </div>

                <div class="swap-balance">
                  <small>Balance:</small>
                  <small>
                    <span class="swap-usd-balance"
                      data-price="{{ $marketDataPrices['TRX'] }}">{{ bcdiv($userBalances->where('wallet', 'USD')->value('balance'), 1, 2) }}</span>
                    <span class="swap-usd-symbol">USD</span>
                  </small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="swap-error-message text-danger mt-2 text-center d-none">
          <small></small>
        </div>

        <div class="swap-success-message text-success mt-2 text-center d-none">
          <small></small>
        </div>

        <small class="d-flex align-items-center text-primary gap-2 mt-4">
          <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
              opacity=".4"></path>
            <path fill="currentColor"
              d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2">
            </path>
          </svg>
          <span>
            Received amount after swap might change slightly due to market fluctuations and blockchain fees.
          </span>
        </small>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn rounded-pill btn-primary mt-4 w-100" disabled id="swapButton">
          <svg class="loading-hidden" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
            viewBox="0 0 24 24">
            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="4">
              <path stroke-dasharray="16" stroke-dashoffset="16" d="M12 3c4.97 0 9 4.03 9 9">
                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="16;0" />
                <animateTransform attributeName="transform" dur="1s" repeatCount="indefinite" type="rotate"
                  values="0 12 12;360 12 12" />
              </path>
              <path stroke-dasharray="64" stroke-dashoffset="64" stroke-opacity=".3"
                d="M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z">
                <animate fill="freeze" attributeName="stroke-dashoffset" dur="1.2s" values="64;0" />
              </path>
            </g>
          </svg>
          Swap
        </button>
      </div>
    </form>
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
        <div class="row mb-2 px-3">
          <div class="col col-6">
            <span class="text-light">
              <small>Asset</small>
            </span>
          </div>
          <div class="col col-6">
            <span class="text-light d-flex justify-content-end">
              <small>Balance</small>
            </span>
          </div>
        </div>

        <ul class="swap-selector-content">
          @foreach ($assets as $asset)
            <li class="swap-selector-asset" data-symbol="{{ $asset->symbol }}"
              data-balance="{{ @formatBalance($userBalances->where('wallet', $asset->symbol)->value('balance')) }}"
              data-price="{{ $marketDataPrices[$asset->symbol] }}">
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
                        class="text-dark lh-1 mb-1">{{ bcdiv($userBalances->where('wallet', $asset->symbol)->value('balance') * $marketDataPrices[$asset->symbol], 1, 2) }}$</span>
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
