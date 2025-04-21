@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sensor Log</h1>
    <p>Monitor your IoT sensor data.</p>


    <table class="table table-striped" id="sensorTable">
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
                    <a href="{{ route('logs.show', $device->id) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

@push('scripts')
<script>
    function filterByDate() {
        let startDate = document.getElementById('start_date').value;
        let endDate = document.getElementById('end_date').value;
        if (startDate && endDate) {
            window.location.href = `?start_date=${startDate}&end_date=${endDate}`;
        } else {
            alert("Please select both start and end dates.");
        }
    }
</script>
@endpush
