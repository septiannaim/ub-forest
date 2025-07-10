@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Log Data Sensor untuk {{ $device->nama_device }}</h1>
    <p>Data sensor untuk perangkat ini.</p>

    <!-- Tombol Back -->
    <a href="{{ url()->previous() }}" class="btn btn-warning mb-3">
        &laquo; Back
    </a>

    <!-- Form Filter -->
    <form action="{{ route('logs.show', $device->id) }}" method="GET" class="row g-3 align-items-center mb-3">
        <div class="col-auto">
            <label for="start_date" class="col-form-label">Select date start</label>
        </div>
        <div class="col-auto">
            <input 
                type="date" 
                class="form-control" 
                name="start_date" 
                value="{{ $startDate ?? '' }}"
            >
        </div>
        <div class="col-auto">
            <label for="end_date" class="col-form-label">to</label>
        </div>
        <div class="col-auto">
            <input 
                type="date" 
                class="form-control" 
                
                name="end_date" 
                value="{{ $endDate ?? '' }}"
            >
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>

        <!-- Tombol Export CSV -->
        <div class="col-auto">
            <a 
                href="{{ route('logs.exportCsv', [
                    'device'     => $device->id, 
                    'start_date' => $startDate, 
                    'end_date'   => $endDate
                ]) }}" 
                class="btn btn-success"
            >
                Download CSV
            </a>
        </div>

        <!-- Tombol Export PDF -->
        <div class="col-auto">
            <a 
                href="{{ route('logs.exportPdf', [
                    'device'     => $device->id, 
                    'start_date' => $startDate, 
                    'end_date'   => $endDate
                ]) }}" 
                class="btn btn-danger"
            >
                Download PDF
            </a>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Suhu</th>
                <th>Kelembapan</th>
                <th>Getaran</th>
                <th>Pintu</th>
                <th>PIR</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->timestamp }}</td>
                <td>{{ $log->suhu }}°C</td>
                <td>{{ $log->kelembapan }}%</td>
                <td>{{ $log->getaran }}</td>
                <td>{{ $log->pintu_status }}</td>
                <td>{{ $log->pir }}</td>
                <td>{{ $log->latitude }}</td>
                <td>{{ $log->longitude }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $logs->links() }}
    </div>
</div>
@endsection
