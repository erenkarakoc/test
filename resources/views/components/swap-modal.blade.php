@section('page-style')
@vite(['resources/assets/vendor/scss/_components/_swap-modal.scss'])
@endsection

<div class="modal fade modal-md" id="swapModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex flex-column">
          <h5 class="mb-3 lh-1">Swap Tool</h5>
          <small class="lh-1 mb-7">
            Convert an asset to USD or convert USD to any asset
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

                  <div class="swap-selector disabled">
                    <span class="swap-selector-title">
                      <span class="swap-selector-icon">{!! $walletIcons['USD'] !!}</span>
                      <span class="text-dark">USD</span>
                    </span>
                  </div>
                </div>

                <div class="swap-input">
                  <input type="text" id="swapFromAmount" name="swapFromAmount" value="0.00" placeholder="0.00">
                  <span class="swap-price swap-price-from">≈1.00$</span>
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

                  <div class="swap-selector">
                    <span class="swap-selector-title">
                      <span class="swap-selector-icon">{!! $walletIcons['TRX'] !!}</span>
                      <span class="text-dark">TRX</span>
                    </span>
                    <ul class="swap-selector-dropdown">
                      @foreach ($assets as $asset)
                      <li>
                        <div class="d-flex align-items-center">
                          <span class="swap-selector-icon">{!! $walletIcons[$asset->symbol] ?? '' !!}</span>
                          <div class="d-flex flex-column">
                            <span class="text-dark mb-1">{{ $asset->symbol }}</span>
                            <small class="text-light">{{ $asset->title }}</small>
                          </div>
                        </div>
                        <small class="swap-selector-price text-light">
                          ≈{{ $marketDataPrices[$asset->title] ?? '0.00' }}$
                        </small>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>

                <div class="swap-input">
                  <input type="text" id="swapToAmount" name="swapToAmount" value="0.00" placeholder="0.00">
                  <span class="swap-price swap-price-to">≈1.00$</span>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button class="btn rounded-pill btn-primary mt-4 w-100">
          Swap
        </button>
      </div>
    </div>
  </div>
</div>