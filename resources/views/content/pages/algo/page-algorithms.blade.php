@php
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Algorithms')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/algorithms.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/algorithms.js'])
@endsection

@section('content')
  <div class="page-algorithms">
    <h5 class="mb-3 lh-1">Algorithms</h5>
    <p class="lh-1 mb-7">See our pre-defined strategy packs for optimized algo-trading.</p>

    <div class="row">

    </div>
  </div>
@endsection
