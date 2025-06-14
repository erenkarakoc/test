@php
  $configData = Helper::appClasses();
  $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Terms Of Service')

@section('page-style')
  {{-- Page Css files --}}
  @vite('resources/assets/vendor/scss/pages/page-auth.scss')
@endsection

@section('content')
  <div class="authentication-wrapper authentication-basic px-6">
    <div class="authentication-inner py-6">
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link">
              <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 150, 'withbg' => 'fill: #fff;'])</span>
            </a>
          </div>
          <!-- /Logo -->
          {!! $terms !!}
        </div>
      </div>
    </div>
  </div>
@endsection
