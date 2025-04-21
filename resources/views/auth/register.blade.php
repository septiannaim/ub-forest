<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register - Laravel Breeze</title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
  <link id="pagestyle" href="{{ asset('dashboard-admin/assets/css/material-dashboard.css') }}" rel="stylesheet" />
</head>

<body>
  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100 ">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Register</h4>
                  <p class="mb-0">Enter your details to create an account</p>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="name">Name</label>
                      <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                      <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="email">Email</label>
                      <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="password">Password</label>
                      <input id="password" type="password" name="password" class="form-control" required>
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label" for="password_confirmation">Confirm Password</label>
                      <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-dark w-100 mt-4 mb-0">Register</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script src="{{ asset('dashboard-admin/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard-admin/assets/js/material-dashboard.min.js') }}"></script>
</body>

</html>
