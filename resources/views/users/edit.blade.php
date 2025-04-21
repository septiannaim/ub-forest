@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <p>Formulir untuk mengedit informasi pengguna.</p>

    <!-- Form untuk mengedit pengguna -->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Input untuk Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama User</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Input untuk Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Dropdown untuk Role -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input untuk Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password (Leave blank to keep current)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <!-- Input untuk Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to Users List</a>
</div>
@endsection
