<div class="modal fade modal-lg" id="transactionDetailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
          <h5 class="modal-title text-heading fw-bold me-2 lh-1">#TNX<span class="transaction-tnx-text"></span></h5>
          <div class="transaction-detail-status mb-1">
            <span class="badge rounded-pill bg-label-success bg-glow transaction-completed d-none">
              Completed
            </span>
            <span class="badge rounded-pill bg-label-warning bg-glow transaction-pending d-none">
              Pending
            </span>
            <span class="badge rounded-pill bg-label-danger bg-glow transaction-cancelled d-none">
              Cancelled
            </span>
            <span class="badge rounded-pill bg-label-danger bg-glow transaction-rejected d-none">
              Rejected
            </span>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="divider my-6 border border-dashed border-top-1 border-bottom-0"></div>

      <div class="modal-body pt-0">
        <div class="row">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <div class="transaction-detail-icon">
                <svg class="transaction-received text-success d-none" xmlns="http://www.w3.org/2000/svg" width="36"
                  height="36" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10" opacity=".5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                  </g>
                </svg>
                <svg class="transaction-sent text-danger d-none" width="36" height="36" viewBox="0 0 28 28"
                  xmlns="http://www.w3.org/2000/svg" fill="none">
                  <path opacity="0.5"
                    d="M14 25.6667C20.4433 25.6667 25.6667 20.4433 25.6667 14C25.6667 7.55668 20.4433 2.33333 14 2.33333C7.55668 2.33333 2.33333 7.55668 2.33333 14C2.33333 20.4433 7.55668 25.6667 14 25.6667Z"
                    stroke="currentColor" stroke-width="1.75" />
                  <path d="M10.5 17.5L17.5 10.5M17.5 10.5L17.5 15.75M17.5 10.5L12.25 10.5" stroke="currentColor"
                    stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg class="transaction-locked text-light d-none" width="36" height="36" viewBox="0 0 80 80"
                  fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                    d="M40 9.16667C22.9712 9.16667 9.16667 22.9712 9.16667 40C9.16667 57.0288 22.9712 70.8333 40 70.8333C57.0288 70.8333 70.8333 57.0288 70.8333 40C70.8333 22.9712 57.0288 9.16667 40 9.16667ZM4.16667 40C4.16667 20.2098 20.2098 4.16667 40 4.16667C59.7902 4.16667 75.8333 20.2098 75.8333 40C75.8333 59.7902 59.7902 75.8333 40 75.8333C20.2098 75.8333 4.16667 59.7902 4.16667 40Z"
                    fill="currentColor" />
                  <path opacity="0.5"
                    d="M22 46.9389C22 41.9549 22 39.4612 23.5491 37.9139C25.0965 36.3647 27.5902 36.3647 32.5741 36.3647H46.673C51.6569 36.3647 54.1506 36.3647 55.698 37.9139C57.2471 39.4612 57.2471 41.9549 57.2471 46.9389C57.2471 51.9228 57.2471 54.4165 55.698 55.9639C54.1506 57.513 51.6569 57.513 46.673 57.513H32.5741C27.5902 57.513 25.0965 57.513 23.5491 55.9639C22 54.4165 22 51.9228 22 46.9389Z"
                    fill="currentColor" />
                  <path
                    d="M30.9786 33.8959C30.9786 31.442 31.9534 29.0886 33.6886 27.3535C35.4237 25.6183 37.7771 24.6435 40.231 24.6435C42.6849 24.6435 45.0382 25.6183 46.7734 27.3535C48.5085 29.0886 49.4833 31.442 49.4833 33.8959V36.5694C50.4826 36.5782 51.3585 36.6012 52.1269 36.6576V33.8959C52.1269 30.7409 50.8735 27.7151 48.6426 25.4842C46.4117 23.2533 43.386 22 40.231 22C37.076 22 34.0502 23.2533 31.8193 25.4842C29.5884 27.7151 28.3351 30.7409 28.3351 33.8959V36.6593C29.2151 36.6018 30.0967 36.5718 30.9786 36.5694V33.8959Z"
                    fill="currentColor" />
                  <path
                    d="M42.7233 50.4871C42.0623 51.1481 41.1658 51.5194 40.231 51.5194C39.2962 51.5194 38.3996 51.1481 37.7386 50.4871C37.0776 49.8261 36.7063 48.9295 36.7063 47.9947C36.7063 47.0599 37.0776 46.1634 37.7386 45.5024C38.3996 44.8414 39.2962 44.47 40.231 44.47C41.1658 44.47 42.0623 44.8414 42.7233 45.5024C43.3843 46.1634 43.7557 47.0599 43.7557 47.9947C43.7557 48.9295 43.3843 49.8261 42.7233 50.4871Z"
                    fill="currentColor" />
                </svg>
                <svg class="transaction-earned text-success d-none" xmlns="http://www.w3.org/2000/svg" width="36"
                  height="36" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10" opacity=".5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                  </g>
                </svg>
                <svg class="transaction-bonus text-success d-none" xmlns="http://www.w3.org/2000/svg" width="36"
                  height="36" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10" opacity=".5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                  </g>
                </svg>
              </div>

              <h5 class="mb-0">
                <span class="transaction-type-text" data-received-text="Received" data-sent-text="Sent"
                  data-locked-text="Locked" data-earned-text="Earned" data-bonus-text="Bonus"></span>
                via
                <span class="transaction-asset"></span>
              </h5>
            </div>

            <span class="h4 fw-medium transaction-amount-in-usd" data-symbol="$">
              <span class="text-success"></span>
            </span>
          </div>
        </div>

        <div class="divider my-6 mx-n6 border border-dashed border-top-1 border-bottom-0"></div>

        <div class="row">
          <h6 class="mb-2">Summary</h6>
          <ul class="list-group">
            <li class="list-group-item">
              <div class="d-flex justify-content-between align-items-center">
                <span>Amount in USD</span>
                <span class="d-flex align-items-center gap-2">
                  <span class="chosen-asset-icon">
                    <svg height="18" width="18"></svg>
                  </span>
                  <span class="transaction-amount-in-usd" data-symbol="$"></span>
                </span>
              </div>
            </li>
            <li class="list-group-item">
              <div class="d-flex justify-content-between align-items-center">
                <span>Amount in <span class="transaction-asset"></span></span>
                <span class="d-flex align-items-center gap-2">
                  <span class="chosen-asset-icon">
                    <svg height="18" width="18"></svg>
                  </span>
                  <span class="transaction-amount-in-asset"></span>
                </span>
              </div>
            </li>
            <li class="list-group-item">
              <div class="d-flex justify-content-between align-items-center">
                <span><span class="transaction-asset"></span> Price</span>
                <span class="d-flex align-items-center gap-2">
                  <span class="chosen-asset-icon">
                    <svg height="18" width="18"></svg>
                  </span>
                  <span class="transaction-asset-price" data-symbol="$"></span>
                </span>
              </div>
            </li>
          </ul>
        </div>

        {{-- Received & Pending --}}
        <div class="row mt-4" id="received-pending">
          <ul class="list-group transaction-received-pending d-none">
            <li class="list-group-item bg-light">
              <div class="d-flex justify-content-between align-items-center">
                <span>You will send</span>
                <span>
                  <span class="transaction-amount-in-asset"></span>
                </span>
              </div>
            </li>
          </ul>

          <div class="card border border-1 border-light p-0 mt-4">
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
                          from="360 12 12" to="0 12 12" dur="4s" additive="sum" repeatCount="indefinite">
                        </animateTransform>
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
              </div>
            </div>

            <div class="card-body mt-8">
              <div class="transaction-qr-code mt-4 d-none">
                <img src="data:image/png;base64," alt="QR Code">
              </div>

              <div class="d-flex flex-column mt-7">
                <div
                  class="h5 mb-0 mx-auto d-flex justify-content-center align-items-center gap-2 chosen-asset-amount-wrapper"
                  data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                  data-bs-custom-class="popover-dark chosen-asset-amount-popover" data-bs-content="Click to copy">
                  <span class="transaction-amount-in-asset" id="chosenAssetAmount"></span>
                  <span class="transaction-asset"></span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847s-.843-2.21-.843-4.936z" />
                    <path fill="currentColor"
                      d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2S5.343 2 4.172 3.172"
                      opacity=".5" />
                  </svg>
                </div>
                <small><span class="transaction-amount-in-usd-plain"></span> USD</small>
              </div>

              <label for="walletAddress" class="wallet-address-label mt-8 mb-2">
                <span class="transaction-asset"></span>
                <span class="transaction-network"></span>
                <span> address</span>
              </label>

              <div class="wallet-address-wrapper" data-bs-toggle="popover" data-bs-trigger="hover"
                data-bs-placement="top" data-bs-custom-class="popover-dark wallet-address-popover"
                data-bs-content="Click to copy">
                <span class="wallet-address-icon">
                  <span class="chosen-asset-icon-sm"></span>
                </span>
                <input type="text" class="transaction-wallet-address" id="walletAddress" value=""
                  readonly />
                <span class="wallet-address-copy">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
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

          <div class="d-flex flex-column row-gap-2 mt-4">
            <small class="d-flex align-items-center text-primary gap-2">
              <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                  opacity=".4" />
                <path fill="currentColor"
                  d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
              </svg>
              <span>Make sure you are sending the correct amount of <span class="transaction-asset"></span>.</span>
            </small>
            <small class="d-flex align-items-start text-danger gap-2">
              <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 24 24">
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

          <div class="col-4 d-flex flex-column mx-auto gap-4 mt-12">
            <button class="btn btn-label-danger" id="cancelPaymentButton">
              <span class="align-middle d-sm-inline-block d-none fw-normal">Cancel Payment</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
