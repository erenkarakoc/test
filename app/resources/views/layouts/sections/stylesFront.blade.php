<!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

<!-- Icons -->
@vite(['resources/assets/vendor/fonts/tabler-icons.scss'])

<!-- Core CSS -->
@vite([
  'resources/assets/vendor/scss'.$configData['rtlSupport'].'/core' .($configData['style'] !== 'light' ? '-' . $configData['style'] : '') .'.scss',
  'resources/assets/vendor/scss'.$configData['rtlSupport'].'/' .$configData['theme'] .($configData['style'] !== 'light' ? '-' . $configData['style'] : '') .'.scss',
  'resources/assets/css/custom.css',
  'resources/assets/vendor/libs/node-waves/node-waves.scss',
  'resources/assets/vendor/scss/pages/front-page.scss'
])

<!-- Vendor Styles -->
@yield('vendor-style')


<!-- Page Styles -->
@yield('page-style')
