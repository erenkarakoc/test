@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Bundled Packs')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/bundled-packs.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/bundled-packs.js', 'resources/assets/js/ui-popover.js', 'resources/assets/js/components/trade-transaction-modal.js'])
@endsection

@section('content')
  <div class="page-bundled-packs">
    <div class="row">
      <div class="col col-7">
        <h5 class="mb-3 lh-1">Bundled Packs</h5>
        <p class="mb-12 lh-1">View the packs you’ve bundled and their real-time activity</p>
      </div>

      <div class="col col-5"></div>

      <div class="col col-7">
        <h6 class="mb-2 lh-1">Active Packs</h6>
        <small class="lh-1 mb-7">
          Packs that are currently being executed
        </small>

        <div class="row mt-7 row-gap-6">
          @if ($bundledPacks->count() > 0)
            @foreach ($bundledPacks as $pack)
              <div class="col col-6">
                <div class="card bg-light border bg-glow h-100" data-pack-id="{{ $pack->id }}">
                  <div class="card-body">
                    <div class="d-flex flex-column row-gap-6 h-100">
                      <div class="d-flex align-items-center">
                        <div class="border border-light rounded p-1">
                          <div class="position-relative">
                            <svg width="32" height="32" viewBox="0 0 236 236" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M125.375 73.7493C125.375 71.7934 126.152 69.9175 127.535 68.5344C128.918 67.1514 130.794 66.3743 132.75 66.3743H177C178.956 66.3743 180.832 67.1514 182.215 68.5344C183.598 69.9175 184.375 71.7934 184.375 73.7493C184.375 75.7053 183.598 77.5812 182.215 78.9643C180.832 80.3473 178.956 81.1244 177 81.1244H132.75C130.794 81.1244 128.918 80.3473 127.535 78.9643C126.152 77.5812 125.375 75.7053 125.375 73.7493ZM59 179.458C57.044 179.458 55.1682 178.681 53.7851 177.298C52.402 175.915 51.625 174.039 51.625 172.083V152.416C51.625 150.46 52.402 148.584 53.7851 147.201C55.1682 145.818 57.044 145.041 59 145.041C60.956 145.041 62.8318 145.818 64.2149 147.201C65.598 148.584 66.375 150.46 66.375 152.416V172.083C66.375 174.039 65.598 175.915 64.2149 177.298C62.8318 178.681 60.956 179.458 59 179.458ZM59 90.9577C57.044 90.9577 55.1682 90.1807 53.7851 88.7976C52.402 87.4145 51.625 85.5387 51.625 83.5827V63.916C51.625 61.96 52.402 60.0842 53.7851 58.7011C55.1682 57.318 57.044 56.541 59 56.541C60.956 56.541 62.8318 57.318 64.2149 58.7011C65.598 60.0842 66.375 61.96 66.375 63.916V83.5827C66.375 85.5387 65.598 87.4145 64.2149 88.7976C62.8318 90.1807 60.956 90.9577 59 90.9577ZM88.5 179.458C86.544 179.458 84.6682 178.681 83.2851 177.298C81.902 175.915 81.125 174.039 81.125 172.083V152.416C81.125 150.46 81.902 148.584 83.2851 147.201C84.6682 145.818 86.544 145.041 88.5 145.041C90.456 145.041 92.3318 145.818 93.7149 147.201C95.098 148.584 95.875 150.46 95.875 152.416V172.083C95.875 174.039 95.098 175.915 93.7149 177.298C92.3318 178.681 90.456 179.458 88.5 179.458ZM88.5 90.9577C86.544 90.9577 84.6682 90.1807 83.2851 88.7976C81.902 87.4145 81.125 85.5387 81.125 83.5827V63.916C81.125 61.96 81.902 60.0842 83.2851 58.7011C84.6682 57.318 86.544 56.541 88.5 56.541C90.456 56.541 92.3318 57.318 93.7149 58.7011C95.098 60.0842 95.875 61.96 95.875 63.916V83.5827C95.875 85.5387 95.098 87.4145 93.7149 88.7976C92.3318 90.1807 90.456 90.9577 88.5 90.9577Z"
                                fill="currentColor" />
                              <path
                                d="M98.3337 29.5H137.667C174.749 29.5 193.294 29.5 204.809 41.0247C216.324 52.5493 216.334 71.0852 216.334 108.167V110.625H19.667V108.167C19.667 71.0852 19.667 52.5395 31.1917 41.0247C42.7163 29.5098 61.2522 29.5 98.3337 29.5Z"
                                fill="currentColor" opacity=".4" />
                              <path
                                d="M31.1917 194.975C42.7065 206.5 61.2522 206.5 98.3337 206.5H127.474C122.716 198.083 120 188.359 120 178C120 154.69 133.751 134.592 153.583 125.375H19.667V127.833C19.667 164.915 19.6768 183.451 31.1917 194.975Z"
                                fill="currentColor" opacity=".4" />
                              <path
                                d="M216.334 127.833V125.375H202.418C207.498 127.736 212.178 130.811 216.331 134.47C216.334 132.326 216.334 130.115 216.334 127.833Z"
                                fill="currentColor" opacity=".4" />
                              <path
                                d="M19.667 125.375V110.625H216.334V125.375H202.418C194.996 121.926 186.723 120 178 120C169.277 120 161.004 121.926 153.583 125.375H19.667Z"
                                fill="currentColor" />
                            </svg>
                            <svg class="running-pack-spin" xmlns="http://www.w3.org/2000/svg" width="15"
                              height="15" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V4h2v7h-7V9h4.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.925 0 3.475-1.1T17.65 14h2.1q-.7 2.65-2.85 4.325T12 20" />
                            </svg>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center w-100 ms-4">
                          <div class="d-flex flex-column">
                            <h5 class="mb-1 lh-1">
                              Pack {{ $pack->id }}
                            </h5>
                          </div>

                          <span @class([
                              'px-2 rounded ms-4',
                              'bg-primary' => $pack->status === 'executing',
                              'bg-dark' => $pack->status === 'completed',
                              'bg-warning' => $pack->status === 'pending',
                              'bg-danger' => $pack->status === 'cancelled',
                          ])>
                            @if ($pack->status === 'executing')
                              <small class="text-white lh-1" style="font-size: 11px; font-weight: 600;">
                                Running
                              </small>
                            @elseif ($pack->status === 'completed')
                              <small class="text-black lh-1" style="font-size: 11px; font-weight: 600;">
                                Completed
                              </small>
                            @elseif ($pack->status === 'pending')
                              <small class="text-white lh-1" style="font-size: 11px; font-weight: 600;">
                                Pending
                              </small>
                            @else
                              <small class="text-white lh-1" style="font-size: 11px; font-weight: 600;">
                                Stopped
                              </small>
                            @endif
                          </span>
                        </div>
                      </div>

                      <div class="row row-gap-3">
                        <div class="col col-6">
                          <div class="d-flex flex-column">
                            <small>Locked Amount</small>
                            <span class="h6 mb-0">{{ @formatUsdBalance($pack->amount) }}$</span>
                          </div>
                        </div>

                        <div class="col col-6">
                          <div class="d-flex flex-column">
                            <div class="d-flex align-items-center">
                              <small>P&L</small>
                              <span class="popover-trigger text-light cursor-pointer ms-1 mb-1" data-bs-html="true"
                                data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                                data-bs-custom-class="popover-dark" data-bs-content="Total profit and loss until now">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                  <path fill="currentColor"
                                    d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                    opacity=".3" />
                                  <path fill="currentColor"
                                    d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                                </svg>
                              </span>
                            </div>
                            @if (isset($pnl[$pack->id]))
                              <div class="d-flex align-items-start">
                                <span
                                  @class([
                                      'text-danger' => $pnl[$pack->id]['amount'] < 0,
                                      'text-success' => $pnl[$pack->id]['amount'] > 0,
                                      'h6',
                                      'mb-0',
                                      'me-1',
                                      'pack-pnl-amount',
                                  ])>{{ $pnl[$pack->id]['amount'] > 0 ? '+' : '' }}{{ @formatUsdBalance($pnl[$pack->id]['amount']) }}$</span>
                                <small style="font-size: 11px;"
                                  @class([
                                      'text-danger' => $pnl[$pack->id]['amount'] < 0,
                                      'text-success' => $pnl[$pack->id]['amount'] > 0,
                                      'pack-pnl-percentage',
                                  ])>{{ $pnl[$pack->id]['percentage'] > 0 ? '+' : '' }}{{ @formatUsdBalance($pnl[$pack->id]['percentage']) }}%</small>
                              </div>
                            @else
                              <div class="d-flex align-items-start">
                                <span class="h6 mb-0 me-1 pack-pnl-amount">0.00$</span>
                                <small style="font-size: 11px;" class="pack-pnl-percentage">0.00%</small>
                              </div>
                            @endif
                          </div>
                        </div>

                        <div class="col col-6">
                          <div class="d-flex flex-column">
                            <small>Period</small>
                            <span class="h6 mb-0">{{ $pack->period }} days</span>
                          </div>
                        </div>

                        <div class="col col-6">
                          <div class="d-flex flex-column">
                            <small>Remaining</small>
                            <small c class="text-heading mt-1">
                              @php
                                $endDate = \Carbon\Carbon::parse($pack->created_at)->addDays($pack->period);
                                $remaining = now()->diff($endDate);

                                if ($remaining->invert) {
                                    echo 'Completed';
                                } else {
                                    if ($remaining->d > 0) {
                                        echo $remaining->d . ' days, ' . $remaining->h . ' hours';
                                    } elseif ($remaining->h > 0) {
                                        echo $remaining->h . ' hours, ' . $remaining->i . ' minutes';
                                    } else {
                                        echo $remaining->i . ' minutes';
                                    }
                                }
                              @endphp
                            </small>
                          </div>
                        </div>
                      </div>

                      <div class="d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                          <span class="h6 fw-medium mb-0">Algorithms</span>
                          <div class="d-flex align-items-center">
                            <small class="text-muted">{{ @formatUsdBalance($pack->algorithms_cost) }}$</small>
                            <span class="popover-trigger text-light cursor-pointer ms-1" data-bs-html="true"
                              data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                              data-bs-custom-class="popover-dark"
                              data-bs-content="The amount you've spent on algorithms.">
                              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                  d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                  opacity=".3" />
                                <path fill="currentColor"
                                  d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                              </svg>
                            </span>
                          </div>
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-2 rounded p-2"
                          style="background-color: #191919;">
                          @foreach (json_decode($pack->chosen_algorithms, true) as $algorithm)
                            <span class="badge bg-primary flex-grow-1"
                              style="color: #f5f4fb;">{{ $algorithm['title'] }}</span>
                          @endforeach
                        </div>

                        @if ($pack->strategy_pack_id)
                          <small class="text-muted fw-medium mb-0 mt-2" style="font-size: 11px;">
                            Bundled with <a
                              href="{{ route('page-strategy-packs') }}?strategy_pack={{ $strategyPacks->where('id', $pack->strategy_pack_id)->value('title') }}">{{ $strategyPacks->where('id', $pack->strategy_pack_id)->value('title') }}</a>
                          </small>
                        @endif
                      </div>

                      <button type="button" class="btn btn-sm btn-default border mt-auto">
                        View Trades
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="col col-12">
              <div class="card bg-light border bg-glow">
                <div class="card-body">
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
                      You don't have any active packs.
                    </h6>
                    <small class="pt-0 px-0">
                      Packs that are being executed will be listed here.
                      <br />
                      Go to <a href="{{ route('page-strategy-packs') }}">Strategy Packs</a> or <a
                        href="{{ route('page-algorithms') }}">Algorithms</a> to start trading.
                    </small>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>

      <div class="col col-5">
        <h6 class="mb-2 lh-1">Trades</h6>
        <small class="lh-1 mb-7">
          Monitor the real-time trading activity
        </small>

        <div class="card text-white bg-light border mt-7 trade-transactions-wrapper">
          <div class="card-body">
            <div class="transaction-items position-relative">
              @if (!$transactions->isEmpty())
                @foreach ($transactions as $transaction)
                  <div
                    class="transaction-item trade-transaction-item{{ $transaction->status === 'completed' ? ' trade-item-has-detail' : '' }}"
                    data-tnx-id="{{ $transaction->tnx_id }}" data-trade-info="{{ $transaction->trade_info }}"
                    data-status="{{ $transaction->status }}" data-pack-id="{{ $transaction->locked_pack_id }}">
                    <div class="d-flex align-items-start">
                      <div class="transaction-item-icon">
                        @if ($transaction->status === 'completed')
                          @if (json_decode($transaction->trade_info, true)['direction'] === 1)
                            <svg class="text-success" width="28" height="28" viewBox="0 0 100 100"
                              fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                d="M50.0016 88.5384C71.2876 88.5384 88.5433 71.2827 88.5433 49.9967C88.5433 28.7108 71.2876 11.4551 50.0016 11.4551C28.7157 11.4551 11.46 28.7108 11.46 49.9967C11.46 71.2827 28.7156 88.5384 50.0016 88.5384ZM94.7933 49.9967C94.7933 74.7345 74.7394 94.7884 50.0016 94.7884C25.2639 94.7884 5.20996 74.7345 5.20996 49.9967C5.20996 25.259 25.2639 5.20508 50.0016 5.20508C74.7394 5.20508 94.7933 25.259 94.7933 49.9967Z"
                                fill="currentColor" />
                              <path
                                d="M60.5459 45.7449C59.7836 45.7449 59.0526 45.4421 58.5135 44.9033C57.9745 44.3644 57.6717 43.6335 57.6717 42.8715C57.6717 42.1094 57.9745 41.3785 58.5135 40.8396C59.0526 40.3008 59.7836 39.998 60.5459 39.998H70.1267C70.889 39.998 71.6201 40.3008 72.1591 40.8397C72.6982 41.3785 73.001 42.1094 73.001 42.8715V52.4495C73.001 53.2116 72.6982 53.9424 72.1591 54.4813C71.6201 55.0202 70.889 55.3229 70.1267 55.3229C69.3644 55.3229 68.6334 55.0202 68.0943 54.4813C67.5553 53.9424 67.2525 53.2116 67.2525 52.4495V49.806L59.538 57.5182C58.2804 58.7745 56.5753 59.4803 54.7974 59.4803C53.0196 59.4803 51.3145 58.7745 50.0569 57.5182L43.9788 51.4419C43.8898 51.3527 43.7841 51.2819 43.6677 51.2336C43.5513 51.1853 43.4265 51.1605 43.3005 51.1605C43.1745 51.1605 43.0497 51.1853 42.9333 51.2336C42.8169 51.2819 42.7112 51.3527 42.6222 51.4419L33.8347 60.2268C33.2898 60.7344 32.5691 61.0107 31.8245 60.9976C31.0799 60.9845 30.3694 60.6829 29.8428 60.1564C29.3162 59.63 29.0146 58.9197 29.0014 58.1753C28.9883 57.4309 29.2647 56.7105 29.7724 56.1658L38.5599 47.3808C39.8175 46.1245 41.5226 45.4187 43.3005 45.4187C45.0784 45.4187 46.7835 46.1245 48.0411 47.3808L54.1191 53.4571C54.2081 53.5463 54.3139 53.6171 54.4303 53.6653C54.5466 53.7136 54.6714 53.7385 54.7975 53.7385C54.9235 53.7385 55.0483 53.7136 55.1647 53.6653C55.281 53.6171 55.3868 53.5463 55.4758 53.4571L63.1864 45.7449H60.5459Z"
                                fill="currentColor" />
                            </svg>
                          @else
                            <svg class="text-danger" width="28" height="28" viewBox="0 0 100 100"
                              fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                d="M50.0016 88.5384C71.2876 88.5384 88.5433 71.2827 88.5433 49.9967C88.5433 28.7108 71.2876 11.4551 50.0016 11.4551C28.7157 11.4551 11.46 28.7108 11.46 49.9967C11.46 71.2827 28.7156 88.5384 50.0016 88.5384ZM94.7933 49.9967C94.7933 74.7345 74.7394 94.7884 50.0016 94.7884C25.2639 94.7884 5.20996 74.7345 5.20996 49.9967C5.20996 25.259 25.2639 5.20508 50.0016 5.20508C74.7394 5.20508 94.7933 25.259 94.7933 49.9967Z"
                                fill="currentColor" />
                              <path
                                d="M60.545 55.2512C59.7827 55.2512 59.0516 55.554 58.5126 56.0928C57.9735 56.6317 57.6707 57.3626 57.6707 58.1246C57.6707 58.8867 57.9735 59.6176 58.5126 60.1564C59.0516 60.6953 59.7827 60.998 60.545 60.998H70.1258C70.8881 60.998 71.6191 60.6953 72.1582 60.1564C72.6972 59.6176 73 58.8867 73 58.1246V48.5466C73 47.7845 72.6972 47.0537 72.1582 46.5148C71.6191 45.9759 70.8881 45.6732 70.1258 45.6732C69.3635 45.6732 68.6324 45.9759 68.0934 46.5148C67.5543 47.0537 67.2515 47.7845 67.2515 48.5466V51.1901L59.5371 43.4779C58.2795 42.2216 56.5743 41.5158 54.7965 41.5158C53.0186 41.5158 51.3135 42.2216 50.0559 43.4779L43.9778 49.5542C43.8888 49.6434 43.7831 49.7142 43.6667 49.7625C43.5503 49.8107 43.4255 49.8356 43.2995 49.8356C43.1735 49.8356 43.0487 49.8107 42.9323 49.7625C42.8159 49.7142 42.7102 49.6434 42.6212 49.5542L33.8337 40.7692C33.2888 40.2617 32.5682 39.9854 31.8235 39.9985C31.0789 40.0116 30.3685 40.3132 29.8418 40.8397C29.3152 41.3661 29.0136 42.0764 29.0004 42.8208C28.9873 43.5652 29.2637 44.2856 29.7714 44.8303L38.5589 53.6153C39.8165 54.8716 41.5216 55.5774 43.2995 55.5774C45.0774 55.5774 46.7825 54.8716 48.0401 53.6153L54.1182 47.539C54.2071 47.4498 54.3129 47.379 54.4293 47.3307C54.5457 47.2825 54.6705 47.2576 54.7965 47.2576C54.9225 47.2576 55.0473 47.2825 55.1637 47.3307C55.2801 47.379 55.3858 47.4498 55.4748 47.539L63.1854 55.2512H60.545Z"
                                fill="currentColor" />
                            </svg>
                          @endif
                        @else
                          <div class="d-flex align-items-center justify-content-center"
                            style="height: 28px; width: 28px;">
                            <div class="d-flex align-items-center justify-content-center"
                              style="height: 25px; width: 25px; border-radius: 50%; border: 2px solid rgba(var(--bs-primary-rgb), 0.4);">
                              <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="13"
                                height="13" viewBox="0 0 24 24">
                                <circle cx="4" cy="12" r="0" fill="currentColor">
                                  <animate fill="freeze" attributeName="r"
                                    begin="0;{{ $transaction->tnx_id }}svgSpinners3DotsMove1.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="0;3" />
                                  <animate fill="freeze" attributeName="cx"
                                    begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove7.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="4;12" />
                                  <animate fill="freeze" attributeName="cx"
                                    begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove5.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="12;20" />
                                  <animate id="{{ $transaction->tnx_id }}svgSpinners3DotsMove0" fill="freeze"
                                    attributeName="r" begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove3.end"
                                    calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0" />
                                  <animate id="{{ $transaction->tnx_id }}svgSpinners3DotsMove1" fill="freeze"
                                    attributeName="cx" begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove0.end"
                                    dur="0.001s" values="20;4" />
                                </circle>
                                <circle cx="4" cy="12" r="3" fill="currentColor">
                                  <animate fill="freeze" attributeName="cx"
                                    begin="0;{{ $transaction->tnx_id }}svgSpinners3DotsMove1.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="4;12" />
                                  <animate fill="freeze" attributeName="cx"
                                    begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove7.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="12;20" />
                                  <animate id="{{ $transaction->tnx_id }}svgSpinners3DotsMove2" fill="freeze"
                                    attributeName="r" begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove5.end"
                                    calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0" />
                                  <animate id="{{ $transaction->tnx_id }}svgSpinners3DotsMove3" fill="freeze"
                                    attributeName="cx" begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove2.end"
                                    dur="0.001s" values="20;4" />
                                  <animate fill="freeze" attributeName="r"
                                    begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove3.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="0;3" />
                                </circle>
                                <circle cx="12" cy="12" r="3" fill="currentColor">
                                  <animate fill="freeze" attributeName="cx"
                                    begin="0;{{ $transaction->tnx_id }}svgSpinners3DotsMove1.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="12;20" />
                                  <animate id="{{ $transaction->tnx_id }}svgSpinners3DotsMove4" fill="freeze"
                                    attributeName="r" begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove7.end"
                                    calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0" />
                                  <animate id="{{ $transaction->tnx_id }}svgSpinners3DotsMove5" fill="freeze"
                                    attributeName="cx" begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove4.end"
                                    dur="0.001s" values="20;4" />
                                  <animate fill="freeze" attributeName="r"
                                    begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove5.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="0;3" />
                                  <animate fill="freeze" attributeName="cx"
                                    begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove3.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="4;12" />
                                </circle>
                                <circle cx="20" cy="12" r="3" fill="currentColor">
                                  <animate id="{{ $transaction->tnx_id }}svgSpinners3DotsMove6" fill="freeze"
                                    attributeName="r" begin="0;{{ $transaction->tnx_id }}svgSpinners3DotsMove1.end"
                                    calcMode="spline" dur="0.5s" keySplines=".36,.6,.31,1" values="3;0" />
                                  <animate id="{{ $transaction->tnx_id }}svgSpinners3DotsMove7" fill="freeze"
                                    attributeName="cx" begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove6.end"
                                    dur="0.001s" values="20;4" />
                                  <animate fill="freeze" attributeName="r"
                                    begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove7.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="0;3" />
                                  <animate fill="freeze" attributeName="cx"
                                    begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove5.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="4;12" />
                                  <animate fill="freeze" attributeName="cx"
                                    begin="{{ $transaction->tnx_id }}svgSpinners3DotsMove3.end" calcMode="spline"
                                    dur="0.5s" keySplines=".36,.6,.31,1" values="12;20" />
                                </circle>
                              </svg>
                            </div>
                          </div>
                        @endif
                      </div>
                      <div class="d-flex flex-column">
                        <h6 class="mb-0">
                          @if ($transaction->status === 'completed')
                            <span>
                              {{ json_decode($transaction->trade_info, true)['direction'] === 1 ? 'Long ' : 'Short ' }}
                              {{ $transaction->asset }}
                            </span>
                          @else
                            <span>Trading {{ $transaction->asset }}</span>
                          @endif
                          <span class="text-muted ms-1">→</span>
                          <span class="text-muted ms-1">Pack {{ $transaction->locked_pack_id }}</span>
                        </h6>
                        <div class="d-flex align-items-center">
                          <small class="text-light">
                            @if ($transaction->status === 'pending')
                              {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M, Y, H:i') }}
                            @else
                              {{ \Carbon\Carbon::parse($transaction->updated_at)->format('d M, Y, H:i') }}
                            @endif
                          </small>
                          <small @class([
                              'transaction-status',
                              'text-success' => $transaction->amount_in_usd > 0,
                              'text-danger' => $transaction->amount_in_usd < 0,
                              'text-primary' => $transaction->status === 'pending',
                          ])>
                            @if ($transaction->status === 'pending')
                              Trading
                            @elseif ($transaction->amount_in_usd > 0)
                              Profit
                            @else
                              Loss
                            @endif
                          </small>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="d-flex flex-column align-items-end text-right">
                        <span @class([
                            'transaction-usd-amount',
                            'text-danger' => $transaction->amount_in_usd < 0,
                            'text-success' => $transaction->amount_in_usd > 0,
                            'text-light' =>
                                $transaction->status === 'pending' || $transaction->amount_in_usd == 0,
                        ])>
                          @if ($transaction->status === 'pending')
                            0.00$
                          @else
                            {{ $transaction->amount_in_usd > 0 ? '+' : '' }}{{ @formatUsdBalance($transaction->amount_in_usd) }}$
                          @endif
                        </span>
                        <span style="font-size: 12px" @class([
                            'transaction-asset-amount',
                            'text-danger' => $transaction->amount_in_usd < 0,
                            'text-success' => $transaction->amount_in_usd > 0,
                            'text-light' =>
                                $transaction->status === 'pending' || $transaction->amount_in_usd == 0,
                        ])>
                          @if ($transaction->status === 'pending')
                            0.00
                          @else
                            {{ $transaction->amount_in_usd > 0 ? '+' : '' }}{{ @formatBalance($transaction->amount_in_asset) }}
                          @endif
                          {{ $transaction->asset }}
                        </span>
                      </div>
                      <span class="transaction-item-view">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5" d="m9 5l6 7l-6 7" />
                        </svg>
                      </span>
                    </div>

                    @if ($transaction->status === 'completed')
                      <div class="trade-transaction-item-detail">
                        <div class="trade-transaction-item-chart"></div>

                        <div class="d-flex justify-content-between align-items-center column-gap-2 w-100 mt-4">
                          <div class="d-flex flex-column">
                            <small class="text-muted">Entry Price</small>
                            <span class="text-heading">
                              {{ bcdiv(json_decode($transaction->trade_info, true)['entry_price'], 1, 4) }}$
                            </span>
                            <small class="text-muted" style="font-size: 11px;">
                              {{ \Carbon\Carbon::parse(json_decode($transaction->trade_info, true)['entry_time'])->format('d M, Y, H:i') }}
                            </small>
                          </div>

                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="1.5">
                              <path d="m11 19l6-7l-6-7" opacity=".5" />
                              <path d="m7 19l6-7l-6-7" opacity=".5" />
                            </g>
                          </svg>

                          <div class="d-flex flex-column">
                            <small class="text-muted">Exit Price</small>
                            <span class="text-heading">
                              {{ bcdiv(json_decode($transaction->trade_info, true)['exit_price'], 1, 6) }}$
                            </span>
                            <small class="text-muted" style="font-size: 11px;">
                              {{ \Carbon\Carbon::parse(json_decode($transaction->trade_info, true)['exit_time'])->format('d M, Y, H:i') }}
                            </small>
                          </div>
                        </div>

                        <div class="d-flex justify-content-start w-100 text-start mt-3">
                          <small class="text-muted">
                            Realized P&L:
                            {{ $transaction->amount_in_usd > 0 ? '+' : '-' }}{{ json_decode($transaction->trade_info, true)['profit_rate'] }}%
                          </small>
                        </div>
                      </div>
                    @endif
                  </div>
                @endforeach
              @else
                <div class="d-flex flex-column justify-content-center align-items-center text-center pb-4">
                  <h6 class="text-light mt-4 mb-2 pb-0 px-0 fw-bolder">
                    No executed trades yet.
                  </h6>
                  <small class="text-light pt-0 px-0">
                    Trades will be listed here once executed.
                  </small>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
