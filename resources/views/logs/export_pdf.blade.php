<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Data Sensor - {{ $device->nama_device }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Log Data Sensor untuk {{ $device->nama_device }}</h1>
    <p>Periode: {{ $startDate ?? 'Semua' }} - {{ $endDate ?? 'Semua' }}</p>

    <table>
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Suhu (°C)</th>
                <th>Kelembapan (%)</th>
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
                <td>{{ $log->suhu }}</td>
                <td>{{ $log->kelembapan }}</td>
                <td>{{ $log->getaran }}</td>
                <td>{{ $log->pintu_status }}</td>
                <td>{{ $log->pir }}</td>
                <td>{{ $log->latitude }}</td>
                <td>{{ $log->longitude }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
