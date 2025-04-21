<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login - UB-forest</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{ asset('dashboard-admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('dashboard-admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link id="pagestyle" href="{{ asset('dashboard-admin/assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
</head>

<body class="bg-gray-200">
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('{{ asset('dashboard-admin/assets/img/bg-login.png') }}');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                </div>
              </div>
              <div class="card-body">
                 <!-- Notifikasi error general -->
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<!-- Notifikasi error dari session (opsional) -->
@if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif
                <form method="POST" action="{{ route('login') }}" class="text-start">
                  @csrf
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                  </div>
                  @if (Route::has('password.request'))
                    <p class="mt-2 text-sm text-center">
                      <a href="{{ route('password.request') }}" class="text-primary text-gradient font-weight-bold">Forgot your password?</a>
                    </p>
                  @endif
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="{{ asset('dashboard-admin/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin//assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>
</html>
