@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail User</h1>
    <p>Data pengguna dapat dilihat di sini.</p>

    <!-- Card untuk menampilkan data pengguna -->
    <div class="card">
        <div class="card-body">
            <!-- Menampilkan Nama -->
            <div class="row mb-3">
                <div class="col-md-4"><strong>Nama user</strong></div>
                <div class="col-md-8">{{ $user->name }}</div>
            </div>

            <!-- Menampilkan Email -->
            <div class="row mb-3">
                <div class="col-md-4"><strong>Email</strong></div>
                <div class="col-md-8">{{ $user->email }}</div>
            </div>

            <!-- Menampilkan Role -->
            <div class="row mb-3">
                <div class="col-md-4"><strong>Role</strong></div>
                <div class="col-md-8">
                    <span class="badge bg-primary">{{ $user->roles->first()->name ?? 'No Role' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Back -->
    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back</a>
    
    <!-- Tombol Edit -->
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-3">Edit</a>
</div>
@endsection
