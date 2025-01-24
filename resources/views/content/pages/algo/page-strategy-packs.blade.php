@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Strategy Packs')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/strategy-packs.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/strategy-packs.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="page-strategy-packs">
    <div class="row">
      <div class="col col-7">
        <h5 class="mb-3 lh-1">Strategy Packs</h5>
        <p class="lh-1 mb-7">See our pre-defined strategy packs for optimized algo-trading</p>

        <div class="swiper-container" id="strategy-packs">
          <div class="swiper-wrapper">
            @foreach ($strategyPacks as $strategyPack)
              @php
                $strategyAlgorithms = collect(json_decode($strategyPack->algorithms));

                $basicAlgorithms = $algorithms
                    ->filter(function ($algorithm) {
                        return $algorithm['category'] === 'BASIC';
                    })
                    ->map(function ($algorithm) {
                        return collect($algorithm)->only([
                            'title',
                            'subtitle',
                            'description',
                            'icon',
                            'profit_contribution',
                            'category',
                        ]);
                    });

                $strategySpecificAlgorithms = $strategyAlgorithms
                    ->map(function ($algorithmTitle) use ($algorithms) {
                        $algorithm = $algorithms->firstWhere('title', $algorithmTitle);
                        return $algorithm
                            ? collect($algorithm)->only([
                                'title',
                                'subtitle',
                                'description',
                                'icon',
                                'profit_contribution',
                                'category',
                            ])
                            : null;
                    })
                    ->filter();

                $allStrategyAlgorithms = $basicAlgorithms
                    ->merge($strategySpecificAlgorithms)
                    ->unique('title')
                    ->values();
              @endphp

              <div class="swiper-slide" data-title="{{ $strategyPack->title }}"
                data-description="{{ $strategyPack->description }}"
                data-algorithms="{{ json_encode($allStrategyAlgorithms) }}">
                <div class="strategy-pack">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                          <img src="{{ asset('assets/img/illustrations/' . strtolower($strategyPack->title) . '.png') }}"
                            alt="{{ $strategyPack->title }}" height="80" class="strategy-pack-img">
                          <h5 class="strategy-pack-title ms-5">
                            {{ $strategyPack->title }}
                          </h5>
                          <small class="fw-medium ms-2 strategy-pack-text-bg" data-bs-toggle="popover"
                            data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                            data-bs-content="Total contribution rate of algorithms">
                            ≈{{ $strategyPack->total_contribution_rate }}%
                          </small>
                        </div>
                        <button type="button" class="strategy-pack-btn" data-title="{{ $strategyPack->title }}"
                          data-algorithms="{{ json_encode($allStrategyAlgorithms) }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m9 5l6 7l-6 7"></path>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>

        <div class="d-flex flex-column mt-7">
          <h6 class="mb-2 lh-1" data-tab-element="title">Content</h6>
          <small class="mb-7" data-tab-element="subtitle">
            Review the contents of each strategy pack.
          </small>

          <div class="card bg-light border">
            <div class="card-body">
              <div class="d-flex flex-column mb-6">
                <p class="text-white mb-2" id="pack-title">
                  Momentum
                </p>
                <small id="pack-description">
                  Focuses on momentum and reversal strategies. Includes algorithms for identifying mean reversion
                  opportunities and trading within trends and short-term momentum for consistent but low-risk returns.
                </small>
              </div>

              <small class="text-heading">Algorithms</small>
              <div class="mt-2 p-2 rounded border">
                <div class="d-flex flex-column row-gap-2" id="algorithm-sm-items"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col col-5">
        <div class="d-flex flex-column" id="lock-strategy">
          <h6 class="mb-2 lh-1">Lock Strategy Pack</h6>
          <small class="mb-7">
            Enter amount and unlock date for the estimated results
          </small>

          <div class="card bg-light border">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div id="chosen-pack-img">
                  @foreach ($strategyPacks as $strategyPack)
                    <img src="{{ asset('assets/img/illustrations/' . strToLower($strategyPack->title) . '.png') }}"
                      alt="{{ $strategyPack->title }}" width="50" class="d-none"
                      id="{{ $strategyPack->title }}-img">
                  @endforeach
                </div>
                <span class="text-heading fw-bold ms-4" id="chosen-pack-title">Momentum</span>
                <div id="algorithm-glow" class="ms-auto"></div>
              </div>

              <div class="bg-light border rounded p-5 mt-6">
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-column w-100">
                    <label class="text-nowrap mb-2" for="lock_amount">Amount to Lock</label>
                    <div class="input-group flex-nowrap">
                      <small class="input-group-text text-white">$</small>
                      <input type="number" class="form-control w-100" placeholder="0.00" id="lock_amount" min="1"
                        data-max="{{ $userTotalBalance }}" pattern="^\d*(\.\d{0,2})?$">
                      <button type="button" class="input-group-text"
                        onclick="if ({{ $userTotalBalance }}) document.querySelector('#lock_amount').value = ({{ $userTotalBalance }}).toFixed(2)"
                        id="max_button">Max.</button>
                    </div>
                  </div>
                </div>

                <label class="d-flex flex-column mt-4" for="unlock_date">
                  <label class="d-flex align-items-center text-nowrap mb-2" for="unlock_date">
                    <span>Unlock Date</span>
                    <span class="popover-trigger text-light cursor-pointer ms-1" data-bs-html="true"
                      data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                      data-bs-custom-class="popover-dark"
                      data-bs-content="<span class='me-4'>You can lock balances for:</span><br />- min. 14 days<br />- max. 365 days">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                        <path fill="currentColor"
                          d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                      </svg>
                    </span>
                  </label>
                  <div class="input-group flex-nowrap">
                    <small class="input-group-text text-light">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor"
                          d="M6.96 2c.418 0 .756.31.756.692V4.09c.67-.012 1.422-.012 2.268-.012h4.032c.846 0 1.597 0 2.268.012V2.692c0-.382.338-.692.756-.692s.756.31.756.692V4.15c1.45.106 2.403.368 3.103 1.008c.7.641.985 1.513 1.101 2.842v1H2V8c.116-1.329.401-2.2 1.101-2.842c.7-.64 1.652-.902 3.103-1.008V2.692c0-.382.339-.692.756-.692" />
                        <path fill="currentColor"
                          d="M22 14v-2c0-.839-.013-2.335-.026-3H2.006c-.013.665 0 2.161 0 3v2c0 3.771 0 5.657 1.17 6.828C4.349 22 6.234 22 10.004 22h4c3.77 0 5.654 0 6.826-1.172S22 17.771 22 14"
                          opacity=".5" />
                        <path fill="currentColor" fill-rule="evenodd"
                          d="M14 12.25A1.75 1.75 0 0 0 12.25 14v2a1.75 1.75 0 1 0 3.5 0v-2A1.75 1.75 0 0 0 14 12.25m0 1.5a.25.25 0 0 0-.25.25v2a.25.25 0 1 0 .5 0v-2a.25.25 0 0 0-.25-.25"
                          clip-rule="evenodd" />
                        <path fill="currentColor"
                          d="M11.25 13a.75.75 0 0 0-1.28-.53l-1.5 1.5a.75.75 0 0 0 1.06 1.06l.22-.22V17a.75.75 0 0 0 1.5 0z" />
                      </svg>
                    </small>
                    <input class="form-control flatpickr" id="unlock_date" type="date" name="unlock_date"
                      pattern="\d{2}.\d{2}.\d{4}" placeholder="mm.dd.yyyy">
                  </div>
                </label>
              </div>

              <h6 class="mb-0 lh-1 fw-normal mt-8 mb-4">Summary</h6>

              <div class="table-responsive border rounded overflow-hidden">
                <table class="table">
                  <tbody class="table-border-bottom-0">
                    <tr class="d-none unlock_after_wrap">
                      <td><small class="text-light">Unlock After</small></td>
                      <td class="text-end"></td>
                      <td class="text-end"><span class="text-white" id="unlock_after">0 days</span></td>
                    </tr>
                    <tr>
                      <td><small class="text-light">Algorithm Cost</small></td>
                      <td class="text-end"></td>
                      <td class="text-end"><span class="text-white" id="algorithm_cost">0.00$</span></td>
                    </tr>
                    <tr>
                      <td><small class="text-light">Amount After Purchase</small></td>
                      <td class="text-end"></td>
                      <td class="text-end"><span class="text-white" id="amount_after_purchase">0.00$</span></td>
                    </tr>
                    <tr>
                      <td><small class="text-light">Income</small></td>
                      <td class="text-end"></td>
                      <td class="text-end"><span class="text-white" id="income">0.00$</span></td>
                    </tr>
                    <tr>
                      <td><small class="text-light">Amount After Unlock</small></td>
                      <td class="text-end"><span class="text-white"
                          id="total_amount_after_unlock_percentage">0.00%</span>
                      </td>
                      <td class="text-end"><span class="text-white" id="total_amount_after_unlock">0.00$</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <small class="d-flex align-items-start text-primary gap-2 mt-4">
                <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                  viewBox="0 0 24 24">
                  <path fill="currentColor"
                    d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z"
                    opacity=".4" />
                  <path fill="currentColor"
                    d="M12 7.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0V8a.75.75 0 0 1 .75-.75M12 16a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                </svg>
                <span>
                  Above specified amounts are estimated values and may change up to 15% at the end of the lock period
                  depending on market fluctuation.
                </span>
              </small>

              <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn btn-sm btn-primary" id="lock-amount-button" disabled>
                  <svg class="loading-hidden" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                    viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="4">
                      <path stroke-dasharray="16" stroke-dashoffset="16" d="M12 3c4.97 0 9 4.03 9 9">
                        <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.3s" values="16;0" />
                        <animateTransform attributeName="transform" dur="1s" repeatCount="indefinite"
                          type="rotate" values="0 12 12;360 12 12" />
                      </path>
                      <path stroke-dasharray="64" stroke-dashoffset="64" stroke-opacity=".3"
                        d="M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z">
                        <animate fill="freeze" attributeName="stroke-dashoffset" dur="1.2s" values="64;0" />
                      </path>
                    </g>
                  </svg>
                  <span>Lock</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="strategy-packs-table row mt-7">
      <h6 class="mb-2 lh-1">Details</h6>
      <small class="lh-1 mb-7">Review the contents of each strategy pack and choose the one that best fits you</small>

      <div class="row">
        <div class="col-12">
          <div class="table-responsive bg-light border border-top-0 rounded">
            <table class="table table-striped text-center mb-0">
              <thead>
                <tr>
                  <th scope="col">
                    <p class="text-start mb-0">Algorithms</p>
                  </th>
                  <th scope="col">
                    <div class="d-flex aling-items-center">
                      <p class="text-center mb-0">
                        Gems
                      </p>
                      <span class="popover-trigger text-light cursor-pointer lh-1 ms-1 mb-1" data-bs-html="true"
                        data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                        data-bs-custom-class="popover-dark"
                        data-bs-content="Gems that you can earn by including an algorithm in your strategy bundle.">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                          <path fill="currentColor"
                            d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                          <path fill="currentColor"
                            d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                        </svg>
                      </span>
                    </div>
                  </th>
                  <th scope="col">
                    <p class="text-center mb-0">Momentum</p>
                  </th>
                  <th scope="col">
                    <p class="text-center mb-0">Scalper</p>
                  </th>
                  <th scope="col">
                    <p class="text-center mb-0">Swift</p>
                  </th>
                  <th scope="col">
                    <p class="text-end mb-0">Category</p>
                  </th>
                </tr>
              </thead>
              <tbody>
                @php
                  $sortOrder = ['BASIC', 'TF', 'MR', 'MSE', 'MLP'];
                  $sortedAlgorithms = $algorithms->sortBy(function ($algorithm) use ($sortOrder) {
                      return array_search($algorithm->category, $sortOrder);
                  });
                @endphp
                @foreach ($sortedAlgorithms as $algorithm)
                  <tr>
                    <td class="text-start text-heading">
                      <div class="d-flex align-items-center">

                        <div class="d-flex flex-column">
                          <div class="d-flex align-items-center">
                            <span class="lh-1">{{ $algorithm->title }}</span>
                            <small
                              class="algorithms-table-contribution-rate">≈{{ $algorithm->profit_contribution }}%</small>
                            <span class="popover-trigger text-light cursor-pointer lh-1 ms-1 mb-1" data-bs-html="true"
                              data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="top"
                              data-bs-custom-class="popover-dark" data-bs-content="{{ $algorithm->description }}">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                  d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                  opacity=".3" />
                                <path fill="currentColor"
                                  d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                              </svg>
                            </span>
                          </div>
                          <small class="text-light">{{ $algorithm->subtitle }}</small>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/img/illustrations/algorithms/algorithm-' . $algorithm->icon) }}.svg"
                          alt="{{ $algorithm->title }}" width="30" draggable="false">
                      </div>
                    </td>
                    <td>
                      @if ($algorithm->category === 'BASIC')
                        <div class="d-flex justify-content-center">
                          <span class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M16.03 8.97a.75.75 0 0 1 0 1.06l-5 5a.75.75 0 0 1-1.06 0l-2-2a.75.75 0 1 1 1.06-1.06l1.47 1.47l2.235-2.235L14.97 8.97a.75.75 0 0 1 1.06 0" />
                            </svg>
                          </span>
                        </div>
                      @elseif (collect(json_decode($strategyPacks->where('title', 'Momentum')->first()->algorithms))->contains($algorithm->title))
                        <div class="d-flex justify-content-center">
                          <span class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M16.03 8.97a.75.75 0 0 1 0 1.06l-5 5a.75.75 0 0 1-1.06 0l-2-2a.75.75 0 1 1 1.06-1.06l1.47 1.47l2.235-2.235L14.97 8.97a.75.75 0 0 1 1.06 0" />
                            </svg>
                          </span>
                        </div>
                      @else
                        <span class="algorithm-table-not-containing">─</span>
                      @endif
                    </td>
                    <td>
                      @if ($algorithm->category === 'BASIC')
                        <div class="d-flex justify-content-center">
                          <span class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M16.03 8.97a.75.75 0 0 1 0 1.06l-5 5a.75.75 0 0 1-1.06 0l-2-2a.75.75 0 1 1 1.06-1.06l1.47 1.47l2.235-2.235L14.97 8.97a.75.75 0 0 1 1.06 0" />
                            </svg>
                          </span>
                        </div>
                      @elseif (collect(json_decode($strategyPacks->where('title', 'Scalper')->first()->algorithms))->contains($algorithm->title))
                        <div class="d-flex justify-content-center">
                          <span class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M16.03 8.97a.75.75 0 0 1 0 1.06l-5 5a.75.75 0 0 1-1.06 0l-2-2a.75.75 0 1 1 1.06-1.06l1.47 1.47l2.235-2.235L14.97 8.97a.75.75 0 0 1 1.06 0" />
                            </svg>
                          </span>
                        </div>
                      @else
                        <span class="algorithm-table-not-containing">─</span>
                      @endif
                    </td>
                    <td>
                      @if ($algorithm->category === 'BASIC')
                        <div class="d-flex justify-content-center">
                          <span class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M16.03 8.97a.75.75 0 0 1 0 1.06l-5 5a.75.75 0 0 1-1.06 0l-2-2a.75.75 0 1 1 1.06-1.06l1.47 1.47l2.235-2.235L14.97 8.97a.75.75 0 0 1 1.06 0" />
                            </svg>
                          </span>
                        </div>
                      @elseif (collect(json_decode($strategyPacks->where('title', 'Swift')->first()->algorithms))->contains($algorithm->title))
                        <div class="d-flex justify-content-center">
                          <span class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M16.03 8.97a.75.75 0 0 1 0 1.06l-5 5a.75.75 0 0 1-1.06 0l-2-2a.75.75 0 1 1 1.06-1.06l1.47 1.47l2.235-2.235L14.97 8.97a.75.75 0 0 1 1.06 0" />
                            </svg>
                          </span>
                        </div>
                      @else
                        <span class="algorithm-table-not-containing">─</span>
                      @endif
                    </td>
                    <td class="text-end">
                      <p class="mb-0">
                        @if ($algorithm->category === 'BASIC')
                          <span class="badge bg-label-primary">Basic Algorithms</span>
                        @elseif ($algorithm->category === 'TF')
                          <span class="badge bg-label-primary">Trend-Following</span>
                        @elseif ($algorithm->category === 'MR')
                          <span class="badge bg-label-primary">Mean Reversion</span>
                        @elseif ($algorithm->category === 'MSE')
                          <span class="badge bg-label-primary">MS & Execution</span>
                        @elseif ($algorithm->category === 'MLP')
                          <span class="badge bg-label-primary">ML & Predictive Models</span>
                        @endif
                      </p>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      flatpickr('#unlock_date', {
        dateFormat: 'm.d.Y',
        minDate: new Date().fp_incr(14),
        maxDate: new Date().fp_incr(365),
        disable: [{
          from: '1970-01-01',
          to: new Date().setHours(0, 0, 0, 0)
        }]
      });
    });
  </script>
@endsection
