@php
  use Illuminate\Support\Facades\Auth;

  $configData = Helper::appClasses();
@endphp

@extends('layouts/adminLayout')

@section('title', 'Admin')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/blank.scss'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages/blank.js'])
@endsection

@section('content')
  <div class="row">
    <div class="col col-12 mt-7">
      <div class="card text-white bg-light">
        <div class="card-body py-10">
          <div class="card-header">
            <h5 class="text-white d-flex align-items-center mb-0">
              Admin Dashboard
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
