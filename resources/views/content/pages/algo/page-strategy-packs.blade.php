@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Strategy Packs')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/strategy-packs.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/strategy-packs.js', 'resources/assets/js/ui-popover.js'])
@endsection

@section('content')
  <div class="page-strategy-packs">
    <h5 class="mb-3 lh-1">Strategy Packs</h5>
    <p class="lh-1 mb-7">See our pre-defined strategy packs for optimized algo-trading</p>

    <div class="row">
      <div class="col col-4">
        <div class="card bg-light border">
          <div class="card-body">
            <div class="d-flex flex-column row-gap-4">
              @foreach ($strategyPacks as $strategyPack)
                <label class="strategy-pack" for="{{ $strategyPack->id }}">
                  <input type="radio" id="{{ $strategyPack->id }}" name="strategy_pack"
                    {{ $strategyPack->title == 'Momentum' ? 'checked' : '' }}>
                  <span class="strategy-pack-radio"></span>

                  <div class="card bg-light border">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/img/illustrations/' . strtolower($strategyPack->title) . '.png') }}"
                          alt="{{ $strategyPack->title }}" height="60" class="strategy-pack-img">
                        <h5 class="strategy-pack-title ms-4">
                          {{ $strategyPack->title }}
                        </h5>
                      </div>
                    </div>
                  </div>
                </label>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="col col-8">
        <div class="card bg-light border">
          <div class="card-body">
            <div class="strategy-pack-algorithm">
              <div class="d-flex flex-column">
                <div class="d-flex align-items-center">
                  <span class="strategy-pack-algo-title lh-1">
                    t
                  </span>
                  <span class="popover-trigger text-white cursor-pointer ms-1 lh-1" data-bs-toggle="popover"
                    data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                    data-bs-content="desc">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                      <path fill="currentColor"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10" opacity=".3" />
                      <path fill="currentColor"
                        d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                    </svg>
                  </span>
                </div>
                <small class="strategy-pack-algo-subtitle">
                  t
                </small>
              </div>
              <span class="strategy-pack-algo-contribution">
                ≈5%
              </span>
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
                    <p class="text-center mb-0">Momentum</p>
                  </th>
                  <th scope="col">
                    <p class="text-center mb-0">Scalper</p>
                  </th>
                  <th scope="col">
                    <p class="text-center mb-0">Swift</p>
                  </th>
                  <th scope="col">
                    <p class="text-center mb-0">Category</p>
                  </th>
                  <th scope="col">
                    <p class="text-end mb-0">Contribution</p>
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
                      <div class="d-flex flex-column">
                        <span>{{ $algorithm->title }}</span>
                        <small class="text-light">{{ $algorithm->subtitle }}</small>
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
                        <div class="d-flex justify-content-center">
                          <span class="text-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M8.97 8.97a.75.75 0 0 1 1.06 0L12 10.94l1.97-1.97a.75.75 0 1 1 1.06 1.06L13.06 12l1.97 1.97a.75.75 0 0 1-1.06 1.06L12 13.06l-1.97 1.97a.75.75 0 0 1-1.06-1.06L10.94 12l-1.97-1.97a.75.75 0 0 1 0-1.06" />
                            </svg>
                          </span>
                        </div>
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
                        <div class="d-flex justify-content-center">
                          <span class="text-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M8.97 8.97a.75.75 0 0 1 1.06 0L12 10.94l1.97-1.97a.75.75 0 1 1 1.06 1.06L13.06 12l1.97 1.97a.75.75 0 0 1-1.06 1.06L12 13.06l-1.97 1.97a.75.75 0 0 1-1.06-1.06L10.94 12l-1.97-1.97a.75.75 0 0 1 0-1.06" />
                            </svg>
                          </span>
                        </div>
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
                        <div class="d-flex justify-content-center">
                          <span class="text-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                              <path fill="currentColor"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                                opacity=".5" />
                              <path fill="currentColor"
                                d="M8.97 8.97a.75.75 0 0 1 1.06 0L12 10.94l1.97-1.97a.75.75 0 1 1 1.06 1.06L13.06 12l1.97 1.97a.75.75 0 0 1-1.06 1.06L12 13.06l-1.97 1.97a.75.75 0 0 1-1.06-1.06L10.94 12l-1.97-1.97a.75.75 0 0 1 0-1.06" />
                            </svg>
                          </span>
                        </div>
                      @endif
                    </td>
                    <td>
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
                    <td class="text-end">
                      <small>≈{{ $algorithm->profit_contribution }}%</small>
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
@endsection
