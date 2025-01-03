@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Team')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/_team.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/team.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="page-team">
    <h5 class="mb-3 lh-1">Team</h5>
    <p class="lh-1 mb-7">See your team & your bonus statistics from your team</p>

    <div class="row">
      <div class="col col-12 gdz-refer-friends">
        <div class="card text-white bg-light">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-4">
                <div class="d-flex align-items-center">
                  <span class="text-primary">
                    <svg width="28" height="28" viewBox="0 0 100 100" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M14.4335 85.5673C20.5418 91.6673 30.3585 91.6673 50.0002 91.6673C69.6418 91.6673 79.4627 91.6673 85.5627 85.5631C91.6668 79.4673 91.6668 69.6423 91.6668 50.0006C91.6668 30.359 91.6668 20.5382 85.5627 14.434C79.4668 8.33398 69.6418 8.33398 50.0002 8.33398C30.3585 8.33398 20.5377 8.33398 14.4335 14.434C8.3335 20.5423 8.3335 30.359 8.3335 50.0006C8.3335 69.6423 8.3335 79.4673 14.4335 85.5673Z"
                        fill="currentColor" />
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M53.6211 34.0721C53.6211 29.6159 57.2057 26 61.6219 26C62.6704 25.9972 63.7093 26.2037 64.6791 26.6079C65.6488 27.0121 66.5305 27.6059 67.2737 28.3555C68.0169 29.1052 68.6071 29.9959 69.0106 30.9767C69.414 31.9576 69.6228 33.0095 69.625 34.0721C69.625 38.5308 66.0404 42.1467 61.6219 42.1467C60.5623 42.1474 59.5132 41.9351 58.5352 41.5218C57.5573 41.1086 56.67 40.5027 55.9248 39.7393L44.8485 47.3827C45.1564 48.94 45.0052 50.5547 44.4136 52.0255L56.5581 60.1145C57.9889 58.9329 59.7786 58.2887 61.6243 58.2909C62.6728 58.2883 63.7116 58.4952 64.6813 58.8996C65.6509 59.3041 66.5324 59.8982 67.2754 60.6481C68.0184 61.3979 68.6083 62.2888 69.0115 63.2698C69.4146 64.2508 69.6231 65.3027 69.625 66.3654C69.625 70.8216 66.0404 74.4375 61.6219 74.4375C60.5735 74.44 59.5349 74.2332 58.5654 73.8289C57.5959 73.4246 56.7145 72.8307 55.9716 72.0811C55.2286 71.3315 54.6386 70.4409 54.2353 69.4602C53.832 68.4795 53.6233 67.4278 53.6211 66.3654C53.6193 65.2335 53.8547 64.1141 54.3118 63.0813L42.2629 55.0625C40.8033 56.3475 38.9341 57.0538 37.0007 57.0509C35.9522 57.0534 34.9134 56.8465 33.9437 56.4421C32.9741 56.0376 32.0926 55.4435 31.3496 54.6936C30.6066 53.9438 30.0167 53.0529 29.6135 52.0719C29.2104 51.0909 29.0019 50.039 29 48.9763C29.0022 47.9139 29.2109 46.8622 29.6142 45.8815C30.0175 44.9008 30.6075 44.0102 31.3504 43.2606C32.0934 42.511 32.9748 41.9171 33.9443 41.5128C34.9138 41.1085 35.9524 40.9017 37.0007 40.9042C39.5434 40.9042 41.804 42.0982 43.2689 43.9582L54.0059 36.5497C53.7498 35.7495 53.6199 34.9134 53.6211 34.0721Z"
                        fill="#fff"opacity=".7" />
                    </svg>
                  </span>
                  <h5 class="d-flex align-items-center ms-2 mb-0">
                    Your invitation link
                    <div class="popover-trigger text-light cursor-pointer ms-2 mb-1" data-bs-toggle="popover"
                      data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                      data-bs-content="Share your invitation link with your friends and bring them to Gedzen. You will be able to earn bonuses from your friends' investments when they sign-up with your invitation code.">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                        <path fill="currentColor"
                          d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                      </svg>
                    </div>
                  </h5>
                </div>
              </div>
              <div class="col-8">
                <div class="refer-wrapper">
                  <div class="input-group">
                    <span class="input-group-text">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2.5">
                          <path d="M14 12a6 6 0 1 1-6-6" />
                          <path d="M10 12a6 6 0 1 1 6 6" opacity=".5" />
                        </g>
                      </svg>
                    </span>
                    <input type="text" class="form-control"
                      value="{{ route('register') }}?invite={{ Auth::user()->ref_code }}" readonly disabled
                      id='ref-copy-input' />
                    <span class="input-group-text cursor-pointer"
                      onclick="navigator.clipboard.writeText('{{ route('register') }}?invite={{ Auth::user()->ref_code }}');document.querySelector('#ref-copy-link-text').textContent = 'Copied';">
                      <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847s-.843-2.21-.843-4.936z" />
                          <path fill="currentColor"
                            d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2S5.343 2 4.172 3.172"
                            opacity=".5" />
                        </svg>
                        <small class="ms-1 text-heading" id="ref-copy-link-text">Copy</small>
                      </div>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-7">
        <div class="col-8">
          <div class="col col-12 gdz-referred-friends">
            <div class="card">
              <h6 class="card-header p-0 mb-3">Invited Users</h6>
              @if (!$invitedUsers->isEmpty())
                <div class="table-responsive">
                  <table class="table card-table rounded bg-light">
                    <thead>
                      <tr>
                        <th class="w-25">Username</th>
                        <th class="w-25">Join Date</th>
                        <th class="w-25"></th>
                        <th class="w-25">
                          <div class="d-flex justify-content-end text-right">
                            Earned
                          </div>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach ($invitedUsers as $user)
                        @php
                          $earnedFromUserAmount = $transactions->sum('amount_in_usd');
                        @endphp
                        <tr>
                          <td class="w-25">{{ $user->username }}</td>
                          <td class="w-25">{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</td>
                          <td class="w-25"></td>
                          <td class="w-25">
                            <div class="d-flex justify-content-end text-right">
                              <span @class(['h6', 'mb-0', 'text-success' => $earnedFromUserAmount > 0])>
                                {{ $earnedFromUserAmount > 0 ? '+' . number_format($earnedFromUserAmount, 2) : '0.00' }}$
                              </span>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="table-responsive">
                  <div class="table card-table rounded bg-light">
                    <div class="card-body">
                      <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <h6 class="mb-2 pb-0 px-0 fw-bolder">
                          You haven't invited anyone yet.
                        </h6>
                        <small class="p-0">Invite your friends using your link in order to earn extra cash.</small>
                        <button type="button" class="btn btn-sm btn-primary bg-primary text-white p-2 mt-6 mb-2"
                          id="inviteFriendsButton">
                          <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                              d="M13.803 5.333c0-1.84 1.5-3.333 3.348-3.333A3.34 3.34 0 0 1 20.5 5.333c0 1.841-1.5 3.334-3.349 3.334a3.35 3.35 0 0 1-2.384-.994l-4.635 3.156a3.34 3.34 0 0 1-.182 1.917l5.082 3.34a3.35 3.35 0 0 1 2.12-.753a3.34 3.34 0 0 1 3.348 3.334C20.5 20.507 19 22 17.151 22a3.34 3.34 0 0 1-3.348-3.333a3.3 3.3 0 0 1 .289-1.356L9.05 14a3.35 3.35 0 0 1-2.202.821A3.34 3.34 0 0 1 3.5 11.487a3.34 3.34 0 0 1 3.348-3.333c1.064 0 2.01.493 2.623 1.261l4.493-3.059a3.3 3.3 0 0 1-.161-1.023"
                              clip-rule="evenodd" opacity='.7' />
                          </svg>
                          <span>Start Inviting</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="col col-12 gdz-referred-friends mt-7">
            <div class="card">
              <h6 class="card-header p-0 mb-3">Bonuses</h6>
              @if (!$transactions->isEmpty())
                <div class="card-body p-0">
                  <div class="transaction-items">
                    @foreach ($transactions as $transaction)
                      <a href="#" class="transaction-item transaction-item-bonus">
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
                            <h6 class="mb-0">Earned via {{ $transaction->asset }}</h6>
                            <div class="d-flex align-items-center">
                              <small
                                class="text-light">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M, Y') }}</small>
                              <small @class([
                                  'transaction-status',
                                  'transaction-status-completed' => $transaction->status === 'completed',
                                  'transaction-status-pending' => $transaction->status === 'pending',
                                  'transaction-status-rejected' => $transaction->status === 'rejected',
                                  'transaction-status-cancelled' => $transaction->status === 'cancelled',
                              ])>
                                {{ $transaction->status === 'completed'
                                    ? 'Completed'
                                    : ($transaction->status === 'pending'
                                        ? 'Pending'
                                        : ($transaction->status === 'rejected'
                                            ? 'Rejected'
                                            : ($transaction->status === 'cancelled'
                                                ? 'Cancelled'
                                                : ''))) }}
                              </small>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column align-items-end text-right">
                            <div class="d-flex flex-column align-items-end text-right">
                              <span class="transaction-usd-amount">+{{ $transaction->amount_in_usd }}$</span>
                              <span class="transaction-asset-amount text-light">
                                {{ $transaction->amount_in_asset }}
                                {{ $transaction->asset }}
                              </span>
                            </div>
                          </div>
                          <span class="transaction-item-view">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2.5" d="m9 5l6 7l-6 7" />
                            </svg>
                          </span>
                        </div>
                      </a>
                    @endforeach
                  </div>
                </div>
              @else
                <div class="table-responsive">
                  <div class="table card-table rounded bg-light">
                    <div class="card-body">
                      <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <h6 class="mb-2 pb-0 px-0 fw-bolder">
                          You haven't earned any bonuses yet.
                        </h6>
                        <small class="pt-0 px-0">The transactions related earned bonuses will be listed here.</small>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="col-4 mt-8 earn-together">
          <div class="card bg-light">
            <div class="card-header pb-3">
              <h5 class="fw-bold mb-0 text-center">Earn Together!</h5>
            </div>
            <div class="card-body">
              <div class="d-flex flex-column justify-content-center align-items-center text-center">
                <small class="w-75">
                  Now benefit generous bonuses by building-up a team with your friends and earn with them.
                </small>
                <img src="{{ asset('assets/img/illustrations/earn-together.png') }}" class="earn-together-img mt-12"
                  alt="Earn Together!" draggable="false" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
