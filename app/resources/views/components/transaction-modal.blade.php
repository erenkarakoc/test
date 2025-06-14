<div class="modal fade modal-sm" id="transactionDetailModal" tabindex="-1" aria-hidden="true">
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
                <svg class="transaction-swap text-primary d-none" width="36" height="36" viewBox="0 0 28 28"
                  fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M8.75522 12.5353C8.60151 12.5353 8.45148 12.4883 8.32516 12.4006C8.19884 12.313 8.10225 12.1888 8.04829 12.0448C7.99434 11.9007 7.98558 11.7437 8.02319 11.5945C8.0608 11.4453 8.143 11.3112 8.25879 11.21L11.7197 8.18663C11.8706 8.05472 12.0677 7.98821 12.2675 8.00172C12.4674 8.01523 12.6538 8.10767 12.7856 8.25868C12.9174 8.4097 12.9838 8.60693 12.9703 8.80699C12.9568 9.00705 12.8645 9.19354 12.7136 9.32545L10.7691 11.0236H18.8248C19.0251 11.0236 19.2172 11.1032 19.3588 11.245C19.5004 11.3867 19.58 11.579 19.58 11.7795C19.58 11.9799 19.5004 12.1722 19.3588 12.3139C19.2172 12.4557 19.0251 12.5353 18.8248 12.5353H8.75522ZM14.8674 18.2647C14.7211 18.3977 14.6328 18.5829 14.6213 18.7804C14.6099 18.9779 14.6763 19.172 14.8062 19.3211C14.9362 19.4702 15.1194 19.5623 15.3165 19.5777C15.5135 19.5931 15.7088 19.5306 15.8603 19.4035L19.3212 16.3801C19.437 16.2789 19.5192 16.1448 19.5568 15.9956C19.5944 15.8465 19.5857 15.6894 19.5317 15.5453C19.4777 15.4013 19.3812 15.2772 19.2548 15.1895C19.1285 15.1019 18.9785 15.0549 18.8248 15.0548H8.75522C8.55492 15.0548 8.36283 15.1345 8.2212 15.2762C8.07957 15.418 8 15.6102 8 15.8107C8 16.0111 8.07957 16.2034 8.2212 16.3452C8.36283 16.4869 8.55492 16.5665 8.75522 16.5665H16.8109L14.8674 18.2647Z"
                    fill="currentColor"></path>
                  <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                    d="M1 13.5417C1 6.6151 6.6151 1 13.5417 1C20.4682 1 26.0834 6.6151 26.0834 13.5417C26.0834 20.4682 20.4682 26.0834 13.5417 26.0834C6.6151 26.0834 1 20.4682 1 13.5417ZM13.5417 2.75C7.5816 2.75 2.75 7.5816 2.75 13.5417C2.75 19.5017 7.5816 24.3334 13.5417 24.3334C19.5017 24.3334 24.3334 19.5017 24.3334 13.5417C24.3334 7.5816 19.5017 2.75 13.5417 2.75Z"
                    fill="currentColor"></path>
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
                <svg class="transaction-trade text-success d-none" xmlns="http://www.w3.org/2000/svg" width="36"
                  height="36" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10" opacity=".5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                  </g>
                </svg>
                <svg class="transaction-bonus text-primary d-none" xmlns="http://www.w3.org/2000/svg" width="36"
                  height="36" viewBox="0 0 24 24">
                  <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10" opacity=".5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                  </g>
                </svg>
              </div>

              <h5 class="mb-0">
                <span class="transaction-type-text" data-received-text="Received" data-sent-text="Sent"
                  data-swap-text="Swapped" data-locked-text="Locked" data-trade-text="Trade"
                  data-bonus-text="Bonus"></span>
                via
                <span class="transaction-asset"></span>
              </h5>
            </div>
          </div>
        </div>

        <div class="divider my-6 mx-n6 border border-dashed border-top-1 border-bottom-0"></div>

        <ul class="list-group">
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-light">Amount in <span class="transaction-asset"></span></span>
              <span class="transaction-amount-in-asset fw-medium"></span>
            </div>
          </li>
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-light">Amount in USD</span>
              <span class="transaction-amount-in-usd fw-medium" data-symbol="$"></span>
            </div>
          </li>
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-light"><span class="transaction-asset"></span> Price</span>
              <span class="transaction-asset-price fw-medium" data-symbol="$"></span>
            </div>
          </li>
        </ul>

        <ul class="list-group mt-4">
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <span><span class="transaction-asset"></span> Balance After</span>
              <span class="transaction-asset-balance-after fw-medium"></span>
            </div>
          </li>
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-light">Total Balance After</span>
              <span class="transaction-total-balance-after fw-medium" data-symbol="$"></span>
            </div>
          </li>
        </ul>

        <ul class="list-group mt-4">
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-light">Created at</span>
              <small class="transaction-created-date fw-medium"></small>
            </div>
          </li>
          <li class="list-group-item transaction-confirmed-at-date-wrapper">
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-light">Confirmed at</span>
              <small class="transaction-confirmed-date fw-medium">-</small>
            </div>
          </li>
        </ul>

        <div class="divider my-6 mx-n6 border border-dashed border-top-1 border-bottom-0"></div>

        <ul class="list-group d-none transaction-hash-id-wrapper">
          <li class="list-group-item">
            <div class="d-flex flex-column align-items-start">
              <div class="d-flex align-items-center mt-1 w-100">
                <span class="fw-light">Hash ID:</span>
                <span class="popover-trigger text-light cursor-pointer ms-auto" data-bs-toggle="popover"
                  data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                  data-bs-content="Hash ID can be used to verify a transaction through blockchain explorer platforms (eg. Tronscan, BscScan).">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                    <path fill="currentColor"
                      d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                  </svg>
                </span>
              </div>
              <a href="#" target="_blank" class="transaction-hash-id fw-medium mt-2"></a>
            </div>
          </li>
        </ul>

        <div class="d-flex flex-column mt-4 bg-light rounded p-4 transaction-notes-wrapper d-none">
          <span class="fw-bold">Notes</span>
          <div class="divider my-3 border border-dashed border-top-1 border-bottom-0 w-100"></div>
          <div class="transaction-notes"></div>
        </div>
      </div>
    </div>
  </div>
</div>
