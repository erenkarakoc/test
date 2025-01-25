<!DOCTYPE html>
@php
  $menuFixed =
      $configData['layout'] === 'vertical'
          ? $menuFixed ?? ''
          : ($configData['layout'] === 'front'
              ? ''
              : $configData['headerType']);
  $navbarType =
      $configData['layout'] === 'vertical'
          ? $configData['navbarType'] ?? ''
          : ($configData['layout'] === 'front'
              ? 'layout-navbar-fixed'
              : '');
  $isFront = ($isFront ?? '') == true ? 'Front' : '';
  $contentLayout = isset($container) ? ($container === 'container-xxl' ? 'layout-compact' : 'layout-wide') : '';
@endphp

<html lang="{{ session()->get('locale') ?? app()->getLocale() }}"
  class="{{ $configData['style'] }}-style {{ $contentLayout ?? '' }} {{ $navbarType ?? '' }} {{ $menuFixed ?? '' }} {{ $menuCollapsed ?? '' }} {{ $menuFlipped ?? '' }} {{ $menuOffcanvas ?? '' }} {{ $footerFixed ?? '' }} {{ $customizerHidden ?? '' }}"
  dir="{{ $configData['textDirection'] }}" data-theme="{{ $configData['theme'] }}"
  data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{ url('/') }}" data-framework="laravel"
  data-template="{{ $configData['layout'] . '-menu-' . $configData['themeOpt'] . '-' . $configData['styleOpt'] }}"
  data-style="{{ $configData['styleOptVal'] }}">

  <head>
    <meta name="robots" content="noindex">
    <meta charset="utf-8" />
    <meta name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') |
      {{ config('variables.templateName') ? config('variables.templateName') : 'TemplateName' }} -
      {{ config('variables.templateSuffix') ? config('variables.templateSuffix') : 'TemplateSuffix' }}
    </title>
    <meta name="description"
      content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta name="keywords"
      content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.svg') }}" />


    <!-- Include Styles -->
    <!-- $isFront is used to append the front layout styles only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/styles' . $isFront)

    <!-- Include Scripts for customizer, helper, analytics, config -->
    <!-- $isFront is used to append the front layout scriptsIncludes only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/scriptsIncludes' . $isFront)
  </head>

  <body class="gdz-body-loading-content">

    <!-- Loader -->
    <div id="gdzLoadingContent">
      <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
        <defs>
          <linearGradient id="mingcuteLoadingLine0" x1="50%" x2="50%" y1="5.271%" y2="91.793%">
            <stop offset="0%" stop-color="currentColor" />
            <stop offset="100%" stop-color="currentColor" stop-opacity=".55" />
          </linearGradient>
          <linearGradient id="mingcuteLoadingLine1" x1="50%" x2="50%" y1="8.877%" y2="90.415%">
            <stop offset="0%" stop-color="currentColor" stop-opacity="0" />
            <stop offset="100%" stop-color="currentColor" stop-opacity=".55" />
          </linearGradient>
        </defs>
        <g fill="none">
          <path
            d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
          <path fill="url(#mingcuteLoadingLine0)"
            d="M8.886.006a1 1 0 0 1 .22 1.988A8.001 8.001 0 0 0 10 17.944v2c-5.523 0-10-4.476-10-10C0 4.838 3.848.566 8.886.007Z"
            transform="translate(2 2.055)" />
          <path fill="url(#mingcuteLoadingLine1)"
            d="M14.322 1.985a1 1 0 0 1 1.392-.248A9.99 9.99 0 0 1 20 9.945c0 5.523-4.477 10-10 10v-2a8 8 0 0 0 4.57-14.567a1 1 0 0 1-.248-1.393"
            transform="translate(2 2.055)" />
        </g>
      </svg>
    </div>
    <!--/ Loader -->

    <!-- Layout Content -->
    @yield('layoutContent')
    <!--/ Layout Content -->

    {{-- remove while creating package --}}
    {{-- remove while creating package end --}}

    <!-- Include Scripts -->
    <!-- $isFront is used to append the front layout scripts only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/scripts' . $isFront)

  </body>

</html>
