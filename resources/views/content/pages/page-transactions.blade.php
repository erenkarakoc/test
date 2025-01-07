@php
  use Illuminate\Support\Facades\Auth;
  use app\Models\MarketData;

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
              <div class="d-flex flex-column align-items-start gap-2 text-white">
                <h6 class="d-flex align-items-center mb-0 text-white total-transaction-item-title">
                  Total Received
                  <span class="popover-trigger cursor-pointer ms-1" data-bs-toggle="popover" data-bs-trigger="hover"
                    data-bs-placement="top" data-bs-custom-class="popover-dark"
                    data-bs-content="Total amount you've deposited in your account.">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                      <path fill="currentColor"
                        d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                  </span>
                </h6>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2"
                    opacity=".5"></path>
                  <path fill="currentColor"
                    d="M13.5 15.75a.75.75 0 0 0 0-1.5h-2.69l4.72-4.72a.75.75 0 0 0-1.06-1.06l-4.72 4.72V10.5a.75.75 0 0 0-1.5 0V15c0 .414.336.75.75.75z">
                  </path>
                </svg>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  {{ number_format($totalReceived, 2) }}$
                </h5>
                <small class="text-dark">
                  {{ number_format($totalReceived * MarketData::where('asset', 'EUR')->value('price'), 2) }}€
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
              <div class="d-flex flex-column align-items-start gap-2 text-white">
                <h6 class="d-flex align-items-center mb-0 text-white total-transaction-item-title">
                  Total Sent
                  <span class="popover-trigger cursor-pointer ms-1" data-bs-toggle="popover" data-bs-trigger="hover"
                    data-bs-placement="top" data-bs-custom-class="popover-dark"
                    data-bs-content="Total amount you've cashed-out from your account.">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                      <path fill="currentColor"
                        d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                  </span>
                </h6>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10"
                    opacity=".5"></path>
                  <path fill="currentColor"
                    d="M10.5 8.25a.75.75 0 0 0 0 1.5h2.69l-4.72 4.72a.75.75 0 1 0 1.06 1.06l4.72-4.72v2.69a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75z">
                  </path>
                </svg>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  {{ number_format($totalSent, 2) }}$
                </h5>
                <small class="text-dark">
                  {{ number_format($totalSent * MarketData::where('asset', 'EUR')->value('price'), 2) }}€
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
              <div class="d-flex flex-column align-items-start gap-2 text-white">
                <h6 class="d-flex align-items-center mb-0 text-white total-transaction-item-title">
                  Total Earned
                  <span class="popover-trigger cursor-pointer ms-1" data-bs-toggle="popover" data-bs-trigger="hover"
                    data-bs-placement="top" data-bs-custom-class="popover-dark"
                    data-bs-content="Total amount you've earned from strategies.">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                      <path fill="currentColor"
                        d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                  </span>
                </h6>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M14.25 19h1.5c2.317-.005 3.558-.062 4.472-.674a4 4 0 0 0 1.104-1.103C22 16.213 22 14.809 22 12s0-4.213-.674-5.222a4 4 0 0 0-1.104-1.103c-.915-.612-2.155-.669-4.472-.674h-1.5V9H15a3 3 0 1 1 0 6h-.75zm-4.5 0v-4H9a3 3 0 1 1 0-6h.75V5.001h-1.5c-2.317.005-3.557.062-4.472.674a4 4 0 0 0-1.104 1.103C2 7.787 2 9.192 2 12c0 2.81 0 4.214.674 5.223a4 4 0 0 0 1.104 1.103c.915.612 2.155.669 4.472.674z"
                    opacity=".5" />
                  <path fill="currentColor" d="M9.75 19h4.5V5h-4.5z" opacity=".8" />
                </svg>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  {{ number_format($totalEarned) }}$
                </h5>
                <small class="text-dark">
                  {{ number_format($totalEarned * MarketData::where('asset', 'EUR')->value('price'), 2) }}€
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
              <div class="d-flex flex-column align-items-start gap-2 text-white">
                <h6 class="d-flex align-items-center text-white mb-0 total-transaction-item-title">
                  Total Bonus
                  <span class="popover-trigger cursor-pointer ms-1" data-bs-toggle="popover" data-bs-trigger="hover"
                    data-bs-placement="top" data-bs-custom-class="popover-dark"
                    data-bs-content="Total bonus amount you've earned. (eg. Referral Bonus)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                      <path fill="currentColor"
                        d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                  </span>
                </h6>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                    opacity=".5"></path>
                  <path fill="currentColor" fill-rule="evenodd"
                    d="M6.914 11.25H2v1.5h8.163A3.25 3.25 0 0 1 7 15.25a.75.75 0 0 0 0 1.5a4.75 4.75 0 0 0 4.25-2.626V22h1.5v-7.876A4.75 4.75 0 0 0 17 16.75a.75.75 0 0 0 0-1.5a3.25 3.25 0 0 1-3.163-2.5H22v-1.5h-4.913c.35-.438.613-.955.756-1.527c.538-2.153-1.413-4.103-3.565-3.565a4 4 0 0 0-1.528.756V2h-1.5v4.914a4 4 0 0 0-1.527-.756C7.57 5.62 5.62 7.57 6.158 9.723c.143.572.405 1.089.756 1.527m4.336 0H9.997a2.5 2.5 0 0 1-2.384-1.891A1.44 1.44 0 0 1 9.36 7.613a2.5 2.5 0 0 1 1.891 2.384zm2.753 0H12.75v-1.245a2.5 2.5 0 0 1 1.891-2.392a1.44 1.44 0 0 1 1.746 1.746a2.5 2.5 0 0 1-2.384 1.891"
                    clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="d-flex flex-column align-items-end text-right">
                <h5 class="mb-0 text-white">
                  {{ number_format($totalBonus) }}$
                </h5>
                <small class="text-dark">
                  {{ number_format($totalBonus * MarketData::where('asset', 'EUR')->value('price'), 2) }}€
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
                d="M14.25 19h1.5c2.317-.005 3.558-.062 4.472-.674a4 4 0 0 0 1.104-1.103C22 16.213 22 14.809 22 12s0-4.213-.674-5.222a4 4 0 0 0-1.104-1.103c-.915-.612-2.155-.669-4.472-.674h-1.5V9H15a3 3 0 1 1 0 6h-.75zm-4.5 0v-4H9a3 3 0 1 1 0-6h.75V5.001h-1.5c-2.317.005-3.557.062-4.472.674a4 4 0 0 0-1.104 1.103C2 7.787 2 9.192 2 12c0 2.81 0 4.214.674 5.223a4 4 0 0 0 1.104 1.103c.915.612 2.155.669 4.472.674z"
                opacity=".5" />
              <path fill="currentColor" d="M9.75 19h4.5V5h-4.5z" opacity=".8" />
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
                @if (!$transactions->isEmpty())
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
                            @if (!empty(json_decode($transaction->notes, true)))
                              @php
                                $notesArray = json_decode($transaction->notes, true);
                              @endphp
                              <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                                data-bs-html='true' data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark"
                                data-bs-content="<div class='d-flex flex-column row-gap-2'>
@foreach ($notesArray as $index => $note)
<span>{{ count($notesArray) > 1 ? $index + 1 . '. ' : '' }}{{ $note }}</span>
@endforeach
</div>"
                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
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
                                'text-danger' => $transaction->status === 'rejected',
                                'text-danger' => $transaction->status === 'cancelled',
                                'text-warning' => $transaction->status === 'pending',
                            ])>
                              @if ($transaction->status === 'completed')
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
                          <span
                            class="transaction-usd-amount">+{{ number_format($transaction->amount_in_usd, 2) }}$</span>
                          <span
                            class="transaction-asset-amount text-light">{{ number_format($transaction->amount_in_asset, 2) }}
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
                @else
                  <div class="d-flex flex-column justify-content-center align-items-center text-center pb-4">
                    <svg class="mt-4 mb-8" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                      viewBox="0 0 48 48">
                      <defs>
                        <mask id="ipTForbid0">
                          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="4">
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20"
                              clip-rule="evenodd" opacity="0.5" />
                            <path d="m15 15l18 18" />
                          </g>
                        </mask>
                      </defs>
                      <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTForbid0)" />
                    </svg>
                    <h6 class="mb-2 pb-0 px-0 fw-bolder">
                      You don't have any transactions yet.
                    </h6>
                    <small class="pt-0 px-0">All transactions made in your account will be listed here.</small>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="received" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h5 class="mb-2 lh-1">Received</h5>
          <small class="lh-1 mb-7">
            View all transactions related to the funds you've received in your account
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$transactions->where('type', 'deposit')->isEmpty())
                  @foreach ($transactions->where('type', 'deposit') as $transaction)
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
                            Received via {{ $transaction->asset }}
                            @if (!empty(json_decode($transaction->notes, true)))
                              @php
                                $notesArray = json_decode($transaction->notes, true);
                              @endphp
                              <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                                data-bs-html='true' data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark"
                                data-bs-content="<div class='d-flex flex-column row-gap-2'>
@foreach ($notesArray as $index => $note)
<span>{{ count($notesArray) > 1 ? $index + 1 . '. ' : '' }}{{ $note }}</span>
@endforeach
</div>"
                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
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
                                'text-danger' => $transaction->status === 'rejected',
                                'text-danger' => $transaction->status === 'cancelled',
                                'text-warning' => $transaction->status === 'pending',
                            ])>
                              @if ($transaction->status === 'completed')
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
                          <span
                            class="transaction-usd-amount text-warning-emphasis">+{{ number_format($transaction->amount_in_usd, 2) }}$</span>
                          <span
                            class="transaction-asset-amount text-light">{{ number_format($transaction->amount_in_asset, 2) }}
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
                @else
                  <div class="d-flex flex-column justify-content-center align-items-center text-center pb-4">
                    <svg class="mt-4 mb-8" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                      viewBox="0 0 48 48">
                      <defs>
                        <mask id="ipTForbid1">
                          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="4">
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20"
                              clip-rule="evenodd" opacity="0.5" />
                            <path d="m15 15l18 18" />
                          </g>
                        </mask>
                      </defs>
                      <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTForbid1)" />
                    </svg>
                    <h6 class="mb-2 pb-0 px-0 fw-bolder">
                      You haven't received any funds yet.
                    </h6>
                    <small class="pt-0 px-0">Transactions related received funds will be listed here.</small>
                    <a href="{{ route('page-add-funds') }}"
                      class="btn btn-sm btn-primary bg-primary text-white py-2 px-3 mt-6 mb-2">
                      <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2" opacity=".5">
                        </path>
                        <path fill="currentColor"
                          d="M13.5 15.75a.75.75 0 0 0 0-1.5h-2.69l4.72-4.72a.75.75 0 0 0-1.06-1.06l-4.72 4.72V10.5a.75.75 0 0 0-1.5 0V15c0 .414.336.75.75.75z">
                        </path>
                      </svg>
                      <span>Add Funds</span>
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h5 class="mb-2 lh-1">Sent</h5>
          <small class="lh-1 mb-7">
            View all transactions related to the funds you've sent from your account
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$transactions->where('type', 'sent')->isEmpty())
                  @foreach ($transactions->where('type', 'sent') as $transaction)
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
                            Sent via {{ $transaction->asset }}
                            @if (!empty(json_decode($transaction->notes, true)))
                              @php
                                $notesArray = json_decode($transaction->notes, true);
                              @endphp
                              <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                                data-bs-html='true' data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark"
                                data-bs-content="<div class='d-flex flex-column row-gap-2'>
@foreach ($notesArray as $index => $note)
<span>{{ count($notesArray) > 1 ? $index + 1 . '. ' : '' }}{{ $note }}</span>
@endforeach
</div>"
                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
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
                                'text-danger' => $transaction->status === 'rejected',
                                'text-danger' => $transaction->status === 'cancelled',
                                'text-warning' => $transaction->status === 'pending',
                            ])>
                              @if ($transaction->status === 'completed')
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
                          <span
                            class="transaction-usd-amount">+{{ number_format($transaction->amount_in_usd, 2) }}$</span>
                          <span
                            class="transaction-asset-amount text-light">{{ number_format($transaction->amount_in_asset, 2) }}
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
                @else
                  <div class="d-flex flex-column justify-content-center align-items-center text-center pb-4">
                    <svg class="mt-4 mb-8" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                      viewBox="0 0 48 48">
                      <defs>
                        <mask id="ipTForbid2">
                          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="4">
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20"
                              clip-rule="evenodd" opacity="0.5" />
                            <path d="m15 15l18 18" />
                          </g>
                        </mask>
                      </defs>
                      <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTForbid2)" />
                    </svg>
                    <h6 class="mb-2 pb-0 px-0 fw-bolder">
                      You haven't sent any funds yet.
                    </h6>
                    <small class="pt-0 px-0">The transactions related sent funds will be listed here.</small>
                    <a href="{{ route('page-add-funds') }}"
                      class="btn btn-sm btn-primary bg-primary text-white py-2 px-3 mt-6 mb-2">
                      <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10" opacity=".5">
                        </path>
                        <path fill="currentColor"
                          d="M10.5 8.25a.75.75 0 0 0 0 1.5h2.69l-4.72 4.72a.75.75 0 1 0 1.06 1.06l4.72-4.72v2.69a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75z">
                        </path>
                      </svg>
                      <span>Send</span>
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="earned" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h5 class="mb-2 lh-1">Earned</h5>
          <small class="lh-1 mb-7">
            View all transactions related to your incomes from strategies
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$transactions->where('type', 'earned')->isEmpty())
                  @foreach ($transactions->where('type', 'earned') as $transaction)
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
                            Earned via {{ $transaction->asset }}
                            @if (!empty(json_decode($transaction->notes, true)))
                              @php
                                $notesArray = json_decode($transaction->notes, true);
                              @endphp
                              <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                                data-bs-html='true' data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark"
                                data-bs-content="<div class='d-flex flex-column row-gap-2'>
@foreach ($notesArray as $index => $note)
<span>{{ count($notesArray) > 1 ? $index + 1 . '. ' : '' }}{{ $note }}</span>
@endforeach
</div>"
                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
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
                                'text-danger' => $transaction->status === 'rejected',
                                'text-danger' => $transaction->status === 'cancelled',
                                'text-warning' => $transaction->status === 'pending',
                            ])>
                              @if ($transaction->status === 'completed')
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
                          <span
                            class="transaction-usd-amount">+{{ number_format($transaction->amount_in_usd, 2) }}$</span>
                          <span
                            class="transaction-asset-amount text-light">{{ number_format($transaction->amount_in_asset, 2) }}
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
                @else
                  <div class="d-flex flex-column justify-content-center align-items-center text-center pb-4">
                    <svg class="mt-4 mb-8" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                      viewBox="0 0 48 48">
                      <defs>
                        <mask id="ipTForbid3">
                          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="4">
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20"
                              clip-rule="evenodd" opacity="0.5" />
                            <path d="m15 15l18 18" />
                          </g>
                        </mask>
                      </defs>
                      <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTForbid3)" />
                    </svg>
                    <h6 class="mb-2 pb-0 px-0 fw-bolder">
                      You haven't earned any profits yet.
                    </h6>
                    <small class="pt-0 px-0">
                      The transactions related to your incomes from strategies will be listed here.
                    </small>
                    <a href="{{ route('page-add-funds') }}"
                      class="btn btn-sm btn-primary bg-primary text-white py-2 px-3 mt-6 mb-2">
                      <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M8.422 20.618C10.178 21.54 11.056 22 12 22V12L2.638 7.073l-.04.067C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709z">
                        </path>
                        <path fill="currentColor"
                          d="m17.577 4.432l-2-1.05C13.822 2.461 12.944 2 12 2c-.945 0-1.822.46-3.578 1.382l-2 1.05C4.318 5.536 3.242 6.1 2.638 7.072L12 12l9.362-4.927c-.606-.973-1.68-1.537-3.785-2.641"
                          opacity=".7"></path>
                        <path fill="currentColor"
                          d="m21.403 7.14l-.041-.067L12 12v10c.944 0 1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.597-1.014.597-2.277.597-4.8v-.117c0-2.525 0-3.788-.597-4.802"
                          opacity=".5"></path>
                      </svg>
                      <span>View Strategies</span>
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="bonuses" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h5 class="mb-2 lh-1">Bonuses</h5>
          <small class="lh-1 mb-7">
            View all transactions related to the bonuses you've earned from your invitations
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$transactions->where('type', 'referral-bonus')->isEmpty())
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
                            Bonus via {{ $transaction->asset }}
                            @if (!empty(json_decode($transaction->notes, true)))
                              @php
                                $notesArray = json_decode($transaction->notes, true);
                              @endphp
                              <svg class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-toggle="popover"
                                data-bs-html='true' data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark"
                                data-bs-content="<div class='d-flex flex-column row-gap-2'>
@foreach ($notesArray as $index => $note)
<span>{{ count($notesArray) > 1 ? $index + 1 . '. ' : '' }}{{ $note }}</span>
@endforeach
</div>"
                                xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
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
                                'text-success' => $transaction->status === '',
                                'text-danger' => $transaction->status === 'rejected',
                                'text-danger' => $transaction->status === 'cancelled',
                                'text-warning' => $transaction->status === 'pending',
                            ])>
                              @if ($transaction->status === 'completed')
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
                          <span
                            class="transaction-usd-amount">+{{ number_format($transaction->amount_in_usd, 2) }}$</span>
                          <span
                            class="transaction-asset-amount text-light">{{ number_format($transaction->amount_in_asset, 2) }}
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
                @else
                  <div class="d-flex flex-column justify-content-center align-items-center text-center pb-4">
                    <svg class="mt-4 mb-8" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                      viewBox="0 0 48 48">
                      <defs>
                        <mask id="ipTForbid4">
                          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="4">
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20"
                              clip-rule="evenodd" opacity="0.5" />
                            <path d="m15 15l18 18" />
                          </g>
                        </mask>
                      </defs>
                      <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTForbid4)" />
                    </svg>
                    <h6 class="mb-2 pb-0 px-0 fw-bolder">
                      You haven't earned any bonuses yet.
                    </h6>
                    <small class="pt-0 px-0">
                      The transactions related to the bonuses you've earned from your invitations will be listed here.
                    </small>
                    <a href="{{ route('page-team') }}"
                      class="btn btn-sm btn-primary bg-primary text-white py-2 px-3 mt-6 mb-2">
                      <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M13.803 5.333c0-1.84 1.5-3.333 3.348-3.333A3.34 3.34 0 0 1 20.5 5.333c0 1.841-1.5 3.334-3.349 3.334a3.35 3.35 0 0 1-2.384-.994l-4.635 3.156a3.34 3.34 0 0 1-.182 1.917l5.082 3.34a3.35 3.35 0 0 1 2.12-.753a3.34 3.34 0 0 1 3.348 3.334C20.5 20.507 19 22 17.151 22a3.34 3.34 0 0 1-3.348-3.333a3.3 3.3 0 0 1 .289-1.356L9.05 14a3.35 3.35 0 0 1-2.202.821A3.34 3.34 0 0 1 3.5 11.487a3.34 3.34 0 0 1 3.348-3.333c1.064 0 2.01.493 2.623 1.261l4.493-3.059a3.3 3.3 0 0 1-.161-1.023"
                          clip-rule="evenodd" opacity=".7"></path>
                      </svg>
                      <span>Invite Friends</span>
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
