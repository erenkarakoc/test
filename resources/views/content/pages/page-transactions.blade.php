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
  @vite(['resources/assets/js/ui-popover.js', 'resources/assets/js/pages/transactions.js', 'resources/assets/js/components/transaction-modal.js'])
@endsection

@section('content')
  <div class="page-transactions">
    <h5 class="mb-3 lh-1">Transactions</h5>
    <p class="lh-1 mb-7">See a history of your transactions</p>

    <div class="row row-gap-4">
      <div class="col col-3">
        <div class="card bg-primary bg-glow total-transaction-item">
          <div class="p-4">
            <div class="d-flex justify-content-between align-items-start">
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
            <div class="d-flex justify-content-between align-items-start">
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
            <div class="d-flex justify-content-between align-items-start">
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
            <div class="d-flex justify-content-between align-items-start">
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

    <div class="nav-tabs-shadow nav-align-right mt-12">
      <ul class="nav nav-tabs bg-light" role="tablist">
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
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#locked"
            aria-controls="locked" aria-selected="false">
            <svg class="me-2" width="24" height="24" viewBox="0 0 80 80" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path opacity="0.5"
                d="M40 6.66666C21.59 6.66666 6.66667 21.59 6.66667 40C6.66667 58.41 21.59 73.3333 40 73.3333C58.41 73.3333 73.3333 58.41 73.3333 40C73.3333 21.59 58.41 6.66666 40 6.66666Z"
                fill="currentColor" />
              <path opacity="0.5"
                d="M21 47.3876C21 41.9143 21 39.1757 22.7012 37.4764C24.4005 35.7752 27.1391 35.7752 32.6124 35.7752H48.0956C53.5689 35.7752 56.3075 35.7752 58.0068 37.4764C59.708 39.1757 59.708 41.9143 59.708 47.3876C59.708 52.8609 59.708 55.5995 58.0068 57.2988C56.3075 59 53.5689 59 48.0956 59H32.6124C27.1391 59 24.4005 59 22.7012 57.2988C21 55.5995 21 52.8609 21 47.3876Z"
                fill="currentColor" />
              <path
                d="M41.0211 52.4179C42.0477 52.4179 43.0322 52.0101 43.7581 51.2842C44.484 50.5583 44.8919 49.5737 44.8919 48.5471C44.8919 47.5205 44.484 46.536 43.7581 45.8101C43.0322 45.0841 42.0477 44.6763 41.0211 44.6763C39.9945 44.6763 39.0099 45.0841 38.284 45.8101C37.5581 46.536 37.1503 47.5205 37.1503 48.5471C37.1503 49.5737 37.5581 50.5583 38.284 51.2842C39.0099 52.0101 39.9945 52.4179 41.0211 52.4179ZM30.8602 33.0639C30.8602 30.3691 31.9307 27.7847 33.8363 25.8791C35.7418 23.9736 38.3262 22.9031 41.0211 22.9031C43.7159 22.9031 46.3003 23.9736 48.2059 25.8791C50.1114 27.7847 51.1819 30.3691 51.1819 33.0639V36.9425C52.2793 36.9522 53.2412 36.9773 54.085 37.0392V33.0639C54.085 29.5992 52.7086 26.2763 50.2587 23.8263C47.8087 21.3764 44.4858 20 41.0211 20C37.5563 20 34.2334 21.3764 31.7835 23.8263C29.3335 26.2763 27.9571 29.5992 27.9571 33.0639V37.0412C28.9236 36.978 29.8917 36.9451 30.8602 36.9425V33.0639Z"
                fill="currentColor" />
            </svg>
            Locked
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#earned"
            aria-controls="earned" aria-selected="false">
            <svg class="me-2" width="24" height="24" viewBox="0 0 80 80" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path opacity="0.5"
                d="M40 6.66666C21.59 6.66666 6.66666 21.59 6.66666 40C6.66666 58.41 21.59 73.3333 40 73.3333C58.41 73.3333 73.3333 58.41 73.3333 40C73.3333 21.59 58.41 6.66666 40 6.66666Z"
                fill="currentColor" />
              <path opacity="0.5"
                d="M44.375 53.9998H47.4821C52.2816 53.9895 54.8523 53.8714 56.7456 52.6037C57.6505 51.9996 58.4275 51.2233 59.0324 50.3189C60.4286 48.2268 60.4286 45.3185 60.4286 39.4998C60.4286 33.6812 60.4286 30.7729 59.0324 28.6828C58.4275 27.7785 57.6505 27.0021 56.7456 26.3981C54.8502 25.1303 52.2816 25.0123 47.4821 25.0019H44.375V33.2856H45.9286C47.5767 33.2856 49.1573 33.9403 50.3227 35.1057C51.4881 36.2711 52.1429 37.8517 52.1429 39.4998C52.1429 41.148 51.4881 42.7286 50.3227 43.894C49.1573 45.0594 47.5767 45.7141 45.9286 45.7141H44.375V53.9998ZM35.0536 53.9998V45.7141H33.5C31.8519 45.7141 30.2712 45.0594 29.1058 43.894C27.9404 42.7286 27.2857 41.148 27.2857 39.4998C27.2857 37.8517 27.9404 36.2711 29.1058 35.1057C30.2712 33.9403 31.8519 33.2856 33.5 33.2856H35.0536V25.0019H31.9464C27.1469 25.0123 24.5784 25.1303 22.683 26.3981C21.7781 27.0021 21.001 27.7785 20.3961 28.6828C19 30.7729 19 33.6833 19 39.4998C19 45.3206 19 48.2288 20.3961 50.3189C21.001 51.2233 21.7781 51.9996 22.683 52.6037C24.5784 53.8714 27.1469 53.9895 31.9464 53.9998H35.0536Z"
                fill="currentColor" />
              <path opacity="0.8" d="M35.0536 54H44.375V25H35.0536V54Z" fill="currentColor" />
            </svg>
            Earned
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#bonus"
            aria-controls="bonus" aria-selected="false">
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
          <h6 class="mb-2 lh-1">All Transactions</h6>
          <small class="lh-1 mb-7">
            All transactions made throughout your journey
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$transactions->isEmpty())
                  @foreach ($transactions as $transaction)
                    <div class="transaction-item transaction-item-in" data-tnx-id="{{ $transaction->tnx_id }}">
                      <div class="d-flex align-items-start">
                        <div class="transaction-item-icon">
                          @if ($transaction->type === 'received')
                            <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                              viewBox="0 0 24 24">
                              <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" opacity=".5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                              </g>
                            </svg>
                          @elseif ($transaction->type === 'sent')
                            <svg class="text-danger" width="28" height="28" viewBox="0 0 28 28"
                              xmlns="http://www.w3.org/2000/svg" fill="none">
                              <path opacity="0.5"
                                d="M14 25.6667C20.4433 25.6667 25.6667 20.4433 25.6667 14C25.6667 7.55668 20.4433 2.33333 14 2.33333C7.55668 2.33333 2.33333 7.55668 2.33333 14C2.33333 20.4433 7.55668 25.6667 14 25.6667Z"
                                stroke="currentColor" stroke-width="1.75" />
                              <path d="M10.5 17.5L17.5 10.5M17.5 10.5L17.5 15.75M17.5 10.5L12.25 10.5"
                                stroke="currentColor" stroke-width="1.75" stroke-linecap="round"
                                stroke-linejoin="round" />
                            </svg>
                          @elseif ($transaction->type === 'locked')
                            <svg class="text-light" width="28" height="28" viewBox="0 0 80 80" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
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
                          @elseif ($transaction->type === 'earned')
                            <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                              viewBox="0 0 24 24">
                              <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" opacity=".5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                              </g>
                            </svg>
                          @elseif ($transaction->type === 'bonus')
                            <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                              viewBox="0 0 24 24">
                              <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" opacity=".5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15 9l-6 6m0 0v-4.5M9 15h4.5" />
                              </g>
                            </svg>
                          @endif
                        </div>
                        <div class="d-flex flex-column">
                          <h6 class="mb-0">
                            @if ($transaction->type === 'received')
                              Received via {{ $transaction->asset }}
                            @elseif ($transaction->type === 'sent')
                              Sent via {{ $transaction->asset }}
                            @elseif ($transaction->type === 'locked')
                              Locked via {{ $transaction->asset }}
                            @elseif ($transaction->type === 'earned')
                              Earned via {{ $transaction->asset }}
                            @elseif ($transaction->type === 'bonus')
                              Bonus via {{ $transaction->asset }}
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
                                'text-danger' =>
                                    $transaction->status === 'rejected' ||
                                    $transaction->status === 'cancelled',
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
                          <span @class([
                              'transaction-usd-amount',
                              'text-danger' => $transaction->type === 'sent',
                              'text-success' =>
                                  $transaction->type !== 'sent' || $transaction->type !== 'locked',
                              'text-light' => $transaction->type === 'locked',
                          ])
                            class="transaction-usd-amount">{{ $transaction->type === 'locked' ? '' : ($transaction->type === 'sent' ? '-' : '+') }}{{ number_format($transaction->amount_in_usd, 2) }}$</span>
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
                    </div>
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

              <x-paginator :paginator="$transactions" :tab="'all'" />
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="received" role="tabpanel" aria-labelledby="all" tabindex="0">
          <h6 class="mb-2 lh-1">Received</h6>
          <small class="lh-1 mb-7">
            View all transactions related to the funds you've received in your account
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$receivedTransactions->isEmpty())
                  @foreach ($receivedTransactions as $transaction)
                    <div class="transaction-item transaction-item-in" data-tnx-id="{{ $transaction->tnx_id }}">
                      <div class="d-flex align-items-start">
                        <div class="transaction-item-icon">
                          <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                            viewBox="0 0 24 24">
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
                                'text-danger' =>
                                    $transaction->status === 'rejected' ||
                                    $transaction->status === 'cancelled',
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
                            class="transaction-usd-amount text-success">+{{ number_format($transaction->amount_in_usd, 2) }}$</span>
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
                    </div>
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
                    <small class="pt-0 px-0">Transactions related to received funds will be listed here.</small>
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

              <x-paginator :paginator="$receivedTransactions" :tab="'received'" />
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent" tabindex="0">
          <h6 class="mb-2 lh-1">Sent</h6>
          <small class="lh-1 mb-7">
            View all transactions related to the funds you've sent from your account
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$sentTransactions->isEmpty())
                  @foreach ($sentTransactions as $transaction)
                    <div class="transaction-item transaction-item-in" data-tnx-id="{{ $transaction->tnx_id }}">
                      <div class="d-flex align-items-start">
                        <div class="transaction-item-icon">
                          <svg class="text-danger" width="28" height="28" viewBox="0 0 28 28"
                            xmlns="http://www.w3.org/2000/svg" fill="none">
                            <path opacity="0.5"
                              d="M14 25.6667C20.4433 25.6667 25.6667 20.4433 25.6667 14C25.6667 7.55668 20.4433 2.33333 14 2.33333C7.55668 2.33333 2.33333 7.55668 2.33333 14C2.33333 20.4433 7.55668 25.6667 14 25.6667Z"
                              stroke="currentColor" stroke-width="1.75" />
                            <path d="M10.5 17.5L17.5 10.5M17.5 10.5L17.5 15.75M17.5 10.5L12.25 10.5"
                              stroke="currentColor" stroke-width="1.75" stroke-linecap="round"
                              stroke-linejoin="round" />
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
                                'text-danger' =>
                                    $transaction->status === 'rejected' ||
                                    $transaction->status === 'cancelled',
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
                            class="transaction-usd-amount text-danger">-{{ number_format($transaction->amount_in_usd, 2) }}$</span>
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
                    </div>
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
                    <small class="pt-0 px-0">The transactions related to sent funds will be listed here.</small>
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

              <x-paginator :paginator="$sentTransactions" :tab="'sent'" />
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="locked" role="tabpanel" aria-labelledby="locked" tabindex="0">
          <h6 class="mb-2 lh-1">Locked</h6>
          <small class="lh-1 mb-7">
            View all transactions related to the funds you've locked in a strategy
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$lockedTransactions->isEmpty())
                  @foreach ($lockedTransactions as $transaction)
                    <div class="transaction-item transaction-item-in" data-tnx-id="{{ $transaction->tnx_id }}">
                      <div class="d-flex align-items-start">
                        <div class="transaction-item-icon">
                          <svg class="text-light" width="28" height="28" viewBox="0 0 80 80" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
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
                        </div>
                        <div class="d-flex flex-column">
                          <h6 class="mb-0">
                            Locked via {{ $transaction->asset }}
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
                                'text-danger' =>
                                    $transaction->status === 'rejected' ||
                                    $transaction->status === 'cancelled',
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
                            class="transaction-usd-amount text-light">{{ number_format($transaction->amount_in_usd, 2) }}$</span>
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
                    </div>
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
                      You haven't locked any funds yet.
                    </h6>
                    <small class="pt-0 px-0">The transactions related to locked funds will be listed here.</small>
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
                      <span>View Strategy Packs</span>
                    </a>
                  </div>
                @endif
              </div>

              <x-paginator :paginator="$lockedTransactions" :tab="'locked'" />
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="earned" role="tabpanel" aria-labelledby="earned" tabindex="0">
          <h6 class="mb-2 lh-1">Earned</h6>
          <small class="lh-1 mb-7">
            View all transactions related to your incomes from strategies
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$earnedTransactions->isEmpty())
                  @foreach ($earnedTransactions as $transaction)
                    <div class="transaction-item transaction-item-in" data-tnx-id="{{ $transaction->tnx_id }}">
                      <div class="d-flex align-items-start">
                        <div class="transaction-item-icon">
                          <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                            viewBox="0 0 24 24">
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
                                'text-danger' =>
                                    $transaction->status === 'rejected' ||
                                    $transaction->status === 'cancelled',
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
                            class="transaction-usd-amount text-success">+{{ number_format($transaction->amount_in_usd, 2) }}$</span>
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
                    </div>
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
                      You haven't earned any profits yet.
                    </h6>
                    <small class="pt-0 px-0">
                      The transactions related to your incomes from strategies will be listed here.
                    </small>
                    <a href="{{ route('page-strategy-packs') }}"
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
                      <span>View Strategy Packs</span>
                    </a>
                  </div>
                @endif
              </div>

              <x-paginator :paginator="$earnedTransactions" :tab="'earned'" />
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="bonus" role="tabpanel" aria-labelledby="bonus" tabindex="0">
          <h6 class="mb-2 lh-1">Bonuses</h6>
          <small class="lh-1 mb-7">
            View all transactions related to the bonuses you've earned from your invitations
          </small>

          <div class="card bg-light mt-7">
            <div class="card-body">
              <div class="transaction-items">
                @if (!$bonusTransactions->isEmpty())
                  @foreach ($bonusTransactions as $transaction)
                    <div class="transaction-item transaction-item-in" data-tnx-id="{{ $transaction->tnx_id }}">
                      <div class="d-flex align-items-start">
                        <div class="transaction-item-icon">
                          <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                            viewBox="0 0 24 24">
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
                                'text-danger' =>
                                    $transaction->status === 'rejected' ||
                                    $transaction->status === 'cancelled',
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
                            class="transaction-usd-amount text-success">+{{ number_format($transaction->amount_in_usd, 2) }}$</span>
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
                    </div>
                  @endforeach
                @else
                  <div class="d-flex flex-column justify-content-center align-items-center text-center pb-4">
                    <svg class="mt-4 mb-8" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                      viewBox="0 0 48 48">
                      <defs>
                        <mask id="ipTForbid5">
                          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="4">
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20"
                              clip-rule="evenodd" opacity="0.5" />
                            <path d="m15 15l18 18" />
                          </g>
                        </mask>
                      </defs>
                      <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTForbid5)" />
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

              <x-paginator :paginator="$bonusTransactions" :tab="'bonus'" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('components.transaction-modal')
@endsection
