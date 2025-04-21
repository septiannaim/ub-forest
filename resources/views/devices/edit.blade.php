@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Device</h1>

    <!-- Menampilkan pesan sukses (jika ada) -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan pesan error umum (jika ada) -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('devices.update', $device->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Device Name -->
        <div class="form-group mb-3">
            <label for="nama_device">Device Name</label>
            <input
                type="text"
                class="form-control @error('nama_device') is-invalid @enderror"
                id="nama_device"
                name="nama_device"
                value="{{ old('nama_device', $device->nama_device) }}"
                required
            >
            @error('nama_device')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <!-- Description -->
        <div class="form-group mb-3">
            <label for="deskripsi">Description</label>
            <input
                type="text"
                class="form-control @error('deskripsi') is-invalid @enderror"
                id="deskripsi"
                name="deskripsi"
                value="{{ old('deskripsi', $device->deskripsi) }}"
                required
            >
            @error('deskripsi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <!-- Status -->
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select
                class="form-control @error('status') is-invalid @enderror"
                id="status"
                name="status"
                required
            >
                <option value="active" {{ old('status', $device->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $device->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex">
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
        </div>
    </form>
</div>
@endsection
