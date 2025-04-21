<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{ asset('dashboard-admin/assets/css/nucleo-icons.css') }}" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('landing-page/assets/img/logo-ub-forest.png')}}">
  <link href="{{ asset('dashboard-admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link id="pagestyle" href="{{ asset('dashboard-admin/assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
 
  <style>
    /* Pastikan map punya tinggi agar peta terlihat */
    #map {
      height: 500px;
      width: 100%;
    }
  </style>

  @stack('styles') <!-- Memuat CSS tambahan dari setiap halaman -->
</head>

<body class="g-sidenav-show bg-gray-100">
  <!-- Sidebar -->
  @include('layouts.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    @include('layouts.navigation')

    <div class="container-fluid py-4">
      @yield('content')
    </div>

    <!-- Footer -->
    @include('layouts.footer')
  </main>

  <!-- Core JS Files -->
  <script src="{{ asset('dashboard-admin/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>


  @stack('scripts') <!-- Memuat script tambahan dari setiap halaman -->
</body>

</html>
