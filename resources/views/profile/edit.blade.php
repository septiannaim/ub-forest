@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Success Message (Optional) -->
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Edit Profile Form -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Profile</h4>
                </div>
                <div class="card-body">
                    <!-- Profile Edit Form -->
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <!-- Name Field -->
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                            <label for="name">Nama</label>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3 form-floating">
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                            <label for="email">Email</label>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3 form-floating position-relative">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Leave empty if you don't want to change the password">
                            <label for="password">Password</label>
                            <i id="togglePassword" class="fas fa-eye position-absolute" style="top: 50%; right: 10px; cursor: pointer;"></i>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-3 form-floating">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your new password">
                            <label for="password_confirmation">Confirm Password</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this script to make password visibility toggle work -->
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function (e) {
        // Toggle the type attribute to show or hide the password
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the eye icon
        this.classList.toggle('fa-eye-slash');
    });
</script>
@endsection
