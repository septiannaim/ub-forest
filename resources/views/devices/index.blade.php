@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Device List</h1>
    <p>Manage your IoT devices here.</p>

    <a href="{{ route('devices.create') }}" class="btn btn-success mb-3">Add New Device</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Device Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $device)
            <tr>
                <td>{{ $device->nama_device }}</td>
                <td>{{ $device->deskripsi }}</td>
                <td>{{ $device->status }}</td>
                <td>
                    <a href="{{ route('devices.show', $device->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <!-- Tombol Delete memicu modal konfirmasi -->
                    <button type="button" class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-url="{{ route('devices.destroy', $device->id) }}">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this device?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    // Saat modal konfirmasi tampil, ambil URL dari tombol yang memicu dan set ke action form delete.
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var url = button.getAttribute('data-url');
        document.getElementById('deleteForm').action = url;
    });
</script>
@endpush
