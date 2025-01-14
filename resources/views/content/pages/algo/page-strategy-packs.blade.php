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
      @foreach ($strategyPacks as $strategyPack)
        <div class="col col-lg-4 strategy-pack">
          <div class="card bg-primary">
            <div class="card-header">
              <div class="d-flex align-items-center mb-4">
                <img src="{{ asset('assets/img/illustrations/' . strtolower($strategyPack->title) . '.png') }}"
                  alt="{{ $strategyPack->title }}" height="60" class="strategy-pack-img">
                <h5 class="strategy-pack-title ms-4">
                  {{ $strategyPack->title }}
                </h5>
              </div>
              <small class="strategy-pack-desc">{{ $strategyPack->description }}</small>
            </div>
            <div class="card-body">
              <div class="d-flex flex-column row-gap-2 strategy-pack-algorithms mb-7 d-none">
                @foreach (json_decode($strategyPack->algorithms) as $algorithm)
                  <div class="strategy-pack-algorithm">
                    <div class="d-flex flex-column">
                      <div class="d-flex align-items-center">
                        <span class="strategy-pack-algo-title lh-1">
                          {{ $algorithm }}
                        </span>
                        <span class="popover-trigger text-white cursor-pointer ms-1 lh-1" data-bs-toggle="popover"
                          data-bs-trigger="hover" data-bs-placement="top" data-bs-custom-class="popover-dark"
                          data-bs-content="{{ $algorithms->where('title', $algorithm)->value('description') }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                            <path fill="currentColor"
                              d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"
                              opacity=".3" />
                            <path fill="currentColor"
                              d="M12 17.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
                          </svg>
                        </span>
                      </div>
                      <small class="strategy-pack-algo-subtitle">
                        {{ $algorithms->where('title', $algorithm)->value('subtitle') }}
                      </small>
                    </div>
                    <span class="strategy-pack-algo-contribution">
                      ≈{{ $algorithms->where('title', $algorithm)->value('profit_contribution') }}%
                    </span>
                  </div>
                @endforeach
              </div>
              <button type="button" class="btn btn-sm btn-primary w-100 rounded strategy-pack-algo-btn"
                data-collapsed-text="Details" data-expanded-text="Collapse">Details</button>
              <button type="button" class="btn btn-label-primary w-100 mt-2">Purchase</button>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="strategy-packs-table row mt-7">
      <h6 class="mb-2 lh-1">Details</h6>
      <small class="lh-1 mb-7">Review the contents of each strategy pack and choose the one that best fits you</small>

      <div class="row">
        <div class="col-12">
          <div class="table-responsive border border-top-0 rounded">
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
                    <p class="text-end mb-0">Contribution</p>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($algorithms->sortBy('profit_contribution') as $algorithm)
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
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="ti ti-check"></i>
                          </span>
                        </div>
                      @elseif (collect(json_decode($strategyPacks->where('title', 'Momentum')->first()->algorithms))->contains($algorithm->title))
                        <div class="d-flex justify-content-center">
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="ti ti-check"></i>
                          </span>
                        </div>
                      @else
                        <div class="d-flex justify-content-center">
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                            <i class="ti ti-x"></i>
                          </span>
                        </div>
                      @endif
                    </td>
                    <td>
                      @if ($algorithm->category === 'BASIC')
                        <div class="d-flex justify-content-center">
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="ti ti-check"></i>
                          </span>
                        </div>
                      @elseif (collect(json_decode($strategyPacks->where('title', 'Scalper')->first()->algorithms))->contains($algorithm->title))
                        <div class="d-flex justify-content-center">
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="ti ti-check"></i>
                          </span>
                        </div>
                      @else
                        <div class="d-flex justify-content-center">
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                            <i class="ti ti-x"></i>
                          </span>
                        </div>
                      @endif
                    </td>
                    <td>
                      @if ($algorithm->category === 'BASIC')
                        <div class="d-flex justify-content-center">
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="ti ti-check"></i>
                          </span>
                        </div>
                      @elseif (collect(json_decode($strategyPacks->where('title', 'Swift')->first()->algorithms))->contains($algorithm->title))
                        <div class="d-flex justify-content-center">
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-primary p-0">
                            <i class="ti ti-check"></i>
                          </span>
                        </div>
                      @else
                        <div class="d-flex justify-content-center">
                          <span class="badge badge-center rounded-pill w-px-20 h-px-20 bg-label-secondary p-0">
                            <i class="ti ti-x"></i>
                          </span>
                        </div>
                      @endif
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
