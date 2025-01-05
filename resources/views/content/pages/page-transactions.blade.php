@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Transactions')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/transactions.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/ui-popover.js', 'resources/assets/js/pages/transactions.js'])
@endsection

@section('content')
  <div class="page-transactions">
    <h5 class="mb-3 lh-1">Transactions</h5>
    <p class="lh-1 mb-7">See a history of your transactions</p>

    <div class="row row-gap-4 mb-7">
      <div class="col col-3">
        <div class="card bg-primary bg-glow total-transaction-item">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex flex-column align-items-start gap-2">
                <h6 class="mb-0 text-white total-transaction-item-title">
                  Total Received
                </h6>
                <span class="popover-trigger text-white cursor-pointer" data-bs-toggle="popover" data-bs-trigger="hover"
                  data-bs-placement="top" data-bs-custom-class="popover-dark"
                  data-bs-content="Total amount you've deposited in your account.">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                      opacity=".3" />
                    <path fill="currentColor"
                      d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                  </svg>
                </span>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  0.00$
                </h5>
                <small class="text-dark">
                  0.00€
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-3">
        <div class="card bg-primary bg-glow total-transaction-item">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex flex-column align-items-start gap-2">
                <h6 class="mb-0 text-white total-transaction-item-title">
                  Total Sent
                </h6>
                <span class="popover-trigger text-white cursor-pointer" data-bs-toggle="popover" data-bs-trigger="hover"
                  data-bs-placement="top" data-bs-custom-class="popover-dark"
                  data-bs-content="Total amount you've cashed-out from your account.">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                      opacity=".3" />
                    <path fill="currentColor"
                      d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                  </svg>
                </span>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  0.00$
                </h5>
                <small class="text-dark">
                  0.00€
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-3">
        <div class="card bg-primary bg-glow total-transaction-item">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex flex-column align-items-start gap-2">
                <h6 class="mb-0 text-white total-transaction-item-title">
                  Total Earned
                </h6>
                <span class="popover-trigger text-white cursor-pointer" data-bs-toggle="popover" data-bs-trigger="hover"
                  data-bs-placement="top" data-bs-custom-class="popover-dark"
                  data-bs-content="Total amount you've earned from strategies.">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                      opacity=".3" />
                    <path fill="currentColor"
                      d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                  </svg>
                </span>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  0.00$
                </h5>
                <small class="text-dark">
                  0.00€
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col col-3">
        <div class="card bg-primary bg-glow total-transaction-item">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex flex-column align-items-start gap-2">
                <h6 class="mb-0 text-white total-transaction-item-title">
                  Total Bonus
                </h6>
                <span class="popover-trigger text-white cursor-pointer" data-bs-toggle="popover" data-bs-trigger="hover"
                  data-bs-placement="top" data-bs-custom-class="popover-dark"
                  data-bs-content="Total bonus amount you've earned. (eg. Referral Bonus)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                      opacity=".3" />
                    <path fill="currentColor"
                      d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                  </svg>
                </span>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  0.00$
                </h5>
                <small class="text-dark">
                  0.00€
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="nav-tabs-shadow nav-align-right">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#all"
            aria-controls="all" aria-selected="false">
            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M3.464 20.536C4.93 22 7.286 22 12 22s7.071 0 8.535-1.465C22 19.072 22 16.714 22 12s0-7.071-1.465-8.536C19.072 2 16.714 2 12 2S4.929 2 3.464 3.464C2 4.93 2 7.286 2 12s0 7.071 1.464 8.535"
                opacity=".5" />
              <path fill="currentColor"
                d="M13.25 7a.75.75 0 0 1 1.315-.493l3 3.437a.75.75 0 0 1-1.13.987L14.75 9v8a.75.75 0 0 1-1.5 0zm-5.685 6.07a.75.75 0 1 0-1.13.986l3 3.437A.75.75 0 0 0 10.75 17V7a.75.75 0 0 0-1.5 0v8z" />
            </svg>
            All Transactions
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#received"
            aria-controls="received" aria-selected="false">

            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2"
                opacity=".5" />
              <path fill="currentColor"
                d="M13.5 15.75a.75.75 0 0 0 0-1.5h-2.69l4.72-4.72a.75.75 0 0 0-1.06-1.06l-4.72 4.72V10.5a.75.75 0 0 0-1.5 0V15c0 .414.336.75.75.75z" />
            </svg>
            Received
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#sent"
            aria-controls="sent" aria-selected="false">
            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10"
                opacity=".5" />
              <path fill="currentColor"
                d="M10.5 8.25a.75.75 0 0 0 0 1.5h2.69l-4.72 4.72a.75.75 0 1 0 1.06 1.06l4.72-4.72v2.69a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75z" />
            </svg>
            Sent
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#earned"
            aria-controls="earned" aria-selected="false">
            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M6.26 21.388H6c-.943 0-1.414 0-1.707-.293C4 20.804 4 20.332 4 19.389v-1.112c0-.518 0-.777.133-1.009s.334-.348.736-.582c2.646-1.539 6.403-2.405 8.91-.91q.253.151.45.368a1.49 1.49 0 0 1-.126 2.134a1 1 0 0 1-.427.24q.18-.021.345-.047c.911-.145 1.676-.633 2.376-1.162l1.808-1.365a1.89 1.89 0 0 1 2.22 0c.573.433.749 1.146.386 1.728c-.423.678-1.019 1.545-1.591 2.075s-1.426 1.004-2.122 1.34c-.772.373-1.624.587-2.491.728c-1.758.284-3.59.24-5.33-.118a15 15 0 0 0-3.017-.308"
                opacity=".5" />
              <path fill="currentColor"
                d="M6.586 2.586c-.367.367-.504.873-.555 1.664A2.25 2.25 0 0 0 8.25 2.03c-.79.052-1.297.189-1.664.556m10.828 0c-.367-.367-.873-.504-1.664-.555a2.25 2.25 0 0 0 2.22 2.219c-.052-.79-.189-1.297-.556-1.664m0 6.828c-.367.367-.873.504-1.664.555a2.25 2.25 0 0 1 2.22-2.219c-.052.79-.189 1.297-.556 1.664m-10.828 0c.367.367.873.504 1.664.555A2.25 2.25 0 0 0 6.03 7.75c.052.79.189 1.297.556 1.664" />
              <path fill="currentColor" fill-rule="evenodd"
                d="M6 5.75A3.75 3.75 0 0 0 9.75 2h4.5A3.75 3.75 0 0 0 18 5.75v.5A3.75 3.75 0 0 0 14.25 10h-4.5A3.75 3.75 0 0 0 6 6.25zM12 7a1 1 0 1 0 0-2a1 1 0 0 0 0 2"
                clip-rule="evenodd" />
            </svg>
            Earned
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#bonuses"
            aria-controls="bonuses" aria-selected="false">
            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor"
                d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                opacity=".5" />
              <path fill="currentColor" fill-rule="evenodd"
                d="M6.914 11.25H2v1.5h8.163A3.25 3.25 0 0 1 7 15.25a.75.75 0 0 0 0 1.5a4.75 4.75 0 0 0 4.25-2.626V22h1.5v-7.876A4.75 4.75 0 0 0 17 16.75a.75.75 0 0 0 0-1.5a3.25 3.25 0 0 1-3.163-2.5H22v-1.5h-4.913c.35-.438.613-.955.756-1.527c.538-2.153-1.413-4.103-3.565-3.565a4 4 0 0 0-1.528.756V2h-1.5v4.914a4 4 0 0 0-1.527-.756C7.57 5.62 5.62 7.57 6.158 9.723c.143.572.405 1.089.756 1.527m4.336 0H9.997a2.5 2.5 0 0 1-2.384-1.891A1.44 1.44 0 0 1 9.36 7.613a2.5 2.5 0 0 1 1.891 2.384zm2.753 0H12.75v-1.245a2.5 2.5 0 0 1 1.891-2.392a1.44 1.44 0 0 1 1.746 1.746a2.5 2.5 0 0 1-2.384 1.891"
                clip-rule="evenodd" />
            </svg>
            Bonuses
          </button>
        </li>
      </ul>

      <div class="tab-content pt-0 ps-0">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h5 class="mb-2 lh-1">All Transactions</h5>
          <small class="lh-1 mb-7">
            All transactions made throughout your journey
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @foreach ($transactions as $transaction)
                  <a href="transaction/{{ $transaction->tnx_id }}" class="transaction-item transaction-item-in">
                    <div class="d-flex align-items-start">
                      <div class="transaction-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                          <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10" opacity=".5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column">
                        <h6 class="mb-0">
                          @if ($transaction->type === 'deposit')
                            Received via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'withdraw')
                            Sent via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'invest')
                            Locked via {{ $transaction->asset }}
                          @else
                            Earned via {{ $transaction->asset }}
                          @endif
                          @if ($transaction->note)
                            <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                              data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                              data-bs-content="{{ $transaction->note }}" xmlns="http://www.w3.org/2000/svg"
                              width="18" height="18" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".3" />
                              <path fill="currentColor"
                                d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                            </svg>
                          @endif
                        </h6>
                        <div class="d-flex align-items-center">
                          <small
                            class="text-light">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M, Y') }}</small>
                          <small @class([
                              'transaction-status',
                              'text-success' => $transaction->status === 'completed',
                              'text-success' => $transaction->status === 'completed-with-case',
                              'text-danger' => $transaction->status === 'rejected',
                              'text-danger' => $transaction->status === 'cancelled',
                              'text-warning' => $transaction->status === 'pending',
                          ])>
                            @if ($transaction->status === 'completed' || $transaction->status === 'completed-with-case')
                              Completed
                            @elseif ($transaction->status === 'rejected')
                              Rejected
                            @elseif ($transaction->status === 'cancelled')
                              Cancelled
                            @else
                              Pending
                            @endif
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column align-items-end text-right">
                        <span class="transaction-usd-amount">+{{ $transaction->amount_in_usd }}$</span>
                        <span class="transaction-asset-amount text-light">{{ $transaction->amount_in_asset }}
                          {{ $transaction->asset }}</span>
                      </div>
                      <span class="transaction-item-view">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5" d="m9 5l6 7l-6 7" />
                        </svg>
                      </span>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade show" id="received" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h5 class="mb-2 lh-1">Received</h5>
          <small class="lh-1 mb-7">
            View all transactions related to the funds you've received in your account
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @foreach ($transactions as $transaction)
                  <a href="transaction/{{ $transaction->tnx_id }}" class="transaction-item transaction-item-in">
                    <div class="d-flex align-items-start">
                      <div class="transaction-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                          <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10" opacity=".5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column">
                        <h6 class="mb-0">
                          @if ($transaction->type === 'deposit')
                            Received via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'withdraw')
                            Sent via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'invest')
                            Locked via {{ $transaction->asset }}
                          @else
                            Earned via {{ $transaction->asset }}
                          @endif
                          @if ($transaction->note)
                            <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                              data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                              data-bs-content="{{ $transaction->note }}" xmlns="http://www.w3.org/2000/svg"
                              width="18" height="18" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".3" />
                              <path fill="currentColor"
                                d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                            </svg>
                          @endif
                        </h6>
                        <div class="d-flex align-items-center">
                          <small
                            class="text-light">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M, Y') }}</small>
                          <small @class([
                              'transaction-status',
                              'text-success' => $transaction->status === 'completed',
                              'text-success' => $transaction->status === 'completed-with-case',
                              'text-danger' => $transaction->status === 'rejected',
                              'text-danger' => $transaction->status === 'cancelled',
                              'text-warning' => $transaction->status === 'pending',
                          ])>
                            @if ($transaction->status === 'completed' || $transaction->status === 'completed-with-case')
                              Completed
                            @elseif ($transaction->status === 'rejected')
                              Rejected
                            @elseif ($transaction->status === 'cancelled')
                              Cancelled
                            @else
                              Pending
                            @endif
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column align-items-end text-right">
                        <span class="transaction-usd-amount">+{{ $transaction->amount_in_usd }}$</span>
                        <span class="transaction-asset-amount text-light">{{ $transaction->amount_in_asset }}
                          {{ $transaction->asset }}</span>
                      </div>
                      <span class="transaction-item-view">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5" d="m9 5l6 7l-6 7" />
                        </svg>
                      </span>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade show" id="sent" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h5 class="mb-2 lh-1">All Transactions</h5>
          <small class="lh-1 mb-7">
            All transactions made throughout your journey
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @foreach ($transactions as $transaction)
                  <a href="transaction/{{ $transaction->tnx_id }}" class="transaction-item transaction-item-in">
                    <div class="d-flex align-items-start">
                      <div class="transaction-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                          <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10" opacity=".5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column">
                        <h6 class="mb-0">
                          @if ($transaction->type === 'deposit')
                            Received via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'withdraw')
                            Sent via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'invest')
                            Locked via {{ $transaction->asset }}
                          @else
                            Earned via {{ $transaction->asset }}
                          @endif
                          @if ($transaction->note)
                            <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                              data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                              data-bs-content="{{ $transaction->note }}" xmlns="http://www.w3.org/2000/svg"
                              width="18" height="18" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".3" />
                              <path fill="currentColor"
                                d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                            </svg>
                          @endif
                        </h6>
                        <div class="d-flex align-items-center">
                          <small
                            class="text-light">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M, Y') }}</small>
                          <small @class([
                              'transaction-status',
                              'text-success' => $transaction->status === 'completed',
                              'text-success' => $transaction->status === 'completed-with-case',
                              'text-danger' => $transaction->status === 'rejected',
                              'text-danger' => $transaction->status === 'cancelled',
                              'text-warning' => $transaction->status === 'pending',
                          ])>
                            @if ($transaction->status === 'completed' || $transaction->status === 'completed-with-case')
                              Completed
                            @elseif ($transaction->status === 'rejected')
                              Rejected
                            @elseif ($transaction->status === 'cancelled')
                              Cancelled
                            @else
                              Pending
                            @endif
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column align-items-end text-right">
                        <span class="transaction-usd-amount">+{{ $transaction->amount_in_usd }}$</span>
                        <span class="transaction-asset-amount text-light">{{ $transaction->amount_in_asset }}
                          {{ $transaction->asset }}</span>
                      </div>
                      <span class="transaction-item-view">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5" d="m9 5l6 7l-6 7" />
                        </svg>
                      </span>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade show" id="earned" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h5 class="mb-2 lh-1">All Transactions</h5>
          <small class="lh-1 mb-7">
            All transactions made throughout your journey
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @foreach ($transactions as $transaction)
                  <a href="transaction/{{ $transaction->tnx_id }}" class="transaction-item transaction-item-in">
                    <div class="d-flex align-items-start">
                      <div class="transaction-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                          <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10" opacity=".5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column">
                        <h6 class="mb-0">
                          @if ($transaction->type === 'deposit')
                            Received via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'withdraw')
                            Sent via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'invest')
                            Locked via {{ $transaction->asset }}
                          @else
                            Earned via {{ $transaction->asset }}
                          @endif
                          @if ($transaction->note)
                            <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                              data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                              data-bs-content="{{ $transaction->note }}" xmlns="http://www.w3.org/2000/svg"
                              width="18" height="18" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".3" />
                              <path fill="currentColor"
                                d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                            </svg>
                          @endif
                        </h6>
                        <div class="d-flex align-items-center">
                          <small
                            class="text-light">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M, Y') }}</small>
                          <small @class([
                              'transaction-status',
                              'text-success' => $transaction->status === 'completed',
                              'text-success' => $transaction->status === 'completed-with-case',
                              'text-danger' => $transaction->status === 'rejected',
                              'text-danger' => $transaction->status === 'cancelled',
                              'text-warning' => $transaction->status === 'pending',
                          ])>
                            @if ($transaction->status === 'completed' || $transaction->status === 'completed-with-case')
                              Completed
                            @elseif ($transaction->status === 'rejected')
                              Rejected
                            @elseif ($transaction->status === 'cancelled')
                              Cancelled
                            @else
                              Pending
                            @endif
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column align-items-end text-right">
                        <span class="transaction-usd-amount">+{{ $transaction->amount_in_usd }}$</span>
                        <span class="transaction-asset-amount text-light">{{ $transaction->amount_in_asset }}
                          {{ $transaction->asset }}</span>
                      </div>
                      <span class="transaction-item-view">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5" d="m9 5l6 7l-6 7" />
                        </svg>
                      </span>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade show" id="bonuses" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h5 class="mb-2 lh-1">All Transactions</h5>
          <small class="lh-1 mb-7">
            All transactions made throughout your journey
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @foreach ($transactions as $transaction)
                  <a href="transaction/{{ $transaction->tnx_id }}" class="transaction-item transaction-item-in">
                    <div class="d-flex align-items-start">
                      <div class="transaction-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                          <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10" opacity=".5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column">
                        <h6 class="mb-0">
                          @if ($transaction->type === 'deposit')
                            Received via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'withdraw')
                            Sent via {{ $transaction->asset }}
                          @elseif ($transaction->status === 'invest')
                            Locked via {{ $transaction->asset }}
                          @else
                            Earned via {{ $transaction->asset }}
                          @endif
                          @if ($transaction->note)
                            <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                              data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                              data-bs-content="{{ $transaction->note }}" xmlns="http://www.w3.org/2000/svg"
                              width="18" height="18" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".3" />
                              <path fill="currentColor"
                                d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                            </svg>
                          @endif
                        </h6>
                        <div class="d-flex align-items-center">
                          <small
                            class="text-light">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M, Y') }}</small>
                          <small @class([
                              'transaction-status',
                              'text-success' => $transaction->status === 'completed',
                              'text-success' => $transaction->status === 'completed-with-case',
                              'text-danger' => $transaction->status === 'rejected',
                              'text-danger' => $transaction->status === 'cancelled',
                              'text-warning' => $transaction->status === 'pending',
                          ])>
                            @if ($transaction->status === 'completed' || $transaction->status === 'completed-with-case')
                              Completed
                            @elseif ($transaction->status === 'rejected')
                              Rejected
                            @elseif ($transaction->status === 'cancelled')
                              Cancelled
                            @else
                              Pending
                            @endif
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column align-items-end text-right">
                        <span class="transaction-usd-amount">+{{ $transaction->amount_in_usd }}$</span>
                        <span class="transaction-asset-amount text-light">{{ $transaction->amount_in_asset }}
                          {{ $transaction->asset }}</span>
                      </div>
                      <span class="transaction-item-view">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5" d="m9 5l6 7l-6 7" />
                        </svg>
                      </span>
                    </div>
                  </a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
