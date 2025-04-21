@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data User</h1>
    <p>Data User dapat ditambah, diedit, dan diganti oleh Superadmin</p>

    <!-- Button to add new user -->
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->first()->name ?? 'No Role' }}</td>
                <td>
                    <!-- Tombol Lihat -->
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    
                    <!-- Tombol Edit -->
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Tombol Hapus memicu modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#deleteModal" data-url="{{ route('users.destroy', $user->id) }}">
                        Hapus
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
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus user ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    // Saat modal konfirmasi ditampilkan, ambil URL dari tombol delete yang diklik dan set ke form delete
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var url = button.getAttribute('data-url');
        document.getElementById('deleteForm').action = url;
    });
</script>
@endpush
