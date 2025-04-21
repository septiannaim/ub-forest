@extends('layouts.app')

@section('title', 'Detail Device: ' . $device->nama_device)

@section('content')
<div class="container-fluid py-4">
     <!-- Tombol Back -->
     <a href="{{ url()->previous() }}" class="btn btn-warning mb-3">
        &laquo; Back
    </a>
    <!-- Info Device -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>{{ $device->nama_device }}</h2>
        </div>
        <div class="card-body">
            <p>{{ $device->deskripsi }}</p>
            <p>Status: {{ $device->status }}</p>
        </div>
    </div>

    <!-- Sensor Cards -->
    <div class="row">
        <!-- Card untuk Suhu -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Suhu</p>
                            <h4 class="mb-0" id="suhuValue">{{ $latestSensorData->suhu ?? 'N/A' }}°C</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">thermostat</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm">
                        <span class="text-success font-weight-bolder">
                            {{ isset($latestSensorData->suhu, $previousSensorData->suhu) 
                                ? ($latestSensorData->suhu - $previousSensorData->suhu) . '°C' 
                                : 'N/A' 
                            }}
                        </span>
                        dari kemarin
                    </p>
                </div>
            </div>
        </div>

        <!-- Card untuk Kelembapan -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Kelembapan</p>
                            <h4 class="mb-0" id="kelembapanValue">{{ $latestSensorData->kelembapan ?? 'N/A' }}%</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">water_drop</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm">
                        <span class="text-success font-weight-bolder">
                            {{ isset($latestSensorData->kelembapan, $previousSensorData->kelembapan) 
                                ? ($latestSensorData->kelembapan - $previousSensorData->kelembapan) . '%' 
                                : 'N/A' 
                            }}
                        </span>
                        dari kemarin
                    </p>
                </div>
            </div>
        </div>

        <!-- Card untuk Sensor Switch Door -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Sensor Switch Door</p>
                            <h4 class="mb-0" id="pintuStatusValue">
                                {{ isset($latestSensorData->pintu_status) 
                                    ? ($latestSensorData->pintu_status ? 'Tertutup' : 'Terbuka') 
                                    : 'N/A' 
                                }}
                            </h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">door_sliding</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm">
                        <span class="text-danger font-weight-bolder">Tertutup</span> selama 2 jam terakhir
                    </p>
                </div>
            </div>
        </div>

        <!-- Card untuk Vibrasi -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Vibrasi</p>
                            <h4 class="mb-0" id="vibrasiValue">{{ $latestSensorData->vibrasi ?? 'N/A' }} m/s²</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">vibration</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm">
                        <span class="text-danger font-weight-bolder">+1.1</span> dari normal
                    </p>
                </div>
            </div>
        </div>

        <!-- Card untuk Getaran -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Getaran</p>
                            <h4 class="mb-0" id="getaranValue">{{ $latestSensorData->getaran ?? 'N/A' }} Hz</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="material-symbols-rounded opacity-10">sensors</i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm">
                        <span class="text-success font-weight-bolder">Normal</span> tidak ada perubahan
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="container-fluid py-4">
    <div class="row">
        <!-- Filter Tanggal -->
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Filter Data Sensor</h4>
                    <div class="d-flex">
                        <input type="date" id="startDate" class="form-control w-auto">
                        <input type="date" id="endDate" class="form-control w-auto ms-2">
                        <button class="btn btn-primary ms-2" onclick="updateCharts()">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Suhu -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Suhu</h4>
                </div>
                <div class="card-body">
                    <canvas id="temperatureChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Kelembapan -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Kelembapan</h4>
                </div>
                <div class="card-body">
                    <canvas id="humidityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Sensor Switch Door -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Sensor Switch Door</h4>
                </div>
                <div class="card-body">
                    <canvas id="doorSwitchChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Vibrasi -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Vibrasi</h4>
                </div>
                <div class="card-body">
                    <canvas id="vibrationChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Getaran -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Getaran</h4>
                </div>
                <div class="card-body">
                    <canvas id="shockChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Sertakan Chart.js dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ambil ID device agar data tidak tertukar
    let deviceId = "{{ $device->id }}";

    // Global data untuk grafik, awalnya kosong, nanti diisi dengan data historis dari database
    let sensorData = {
        labels: [],
        temperature: [],
        humidity: [],
        doorSwitch: [],
        vibration: [],
        shock: []
    };

    // Fungsi untuk membuat chart
    function createChart(ctx, label, data, color) {
        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: sensorData.labels,
                datasets: [{
                    label: label,
                    data: data,
                    borderColor: color,
                    backgroundColor: color.replace('1)', '0.2)'),
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { type: 'category' },
                    y: { beginAtZero: false }
                }
            }
        });
    }

    // Inisialisasi chart dengan data awal kosong
    let temperatureChart = createChart(
        document.getElementById('temperatureChart').getContext('2d'),
        "Suhu (°C)",
        sensorData.temperature,
        'rgba(255, 99, 132, 1)'
    );

    let humidityChart = createChart(
        document.getElementById('humidityChart').getContext('2d'),
        "Kelembapan (%)",
        sensorData.humidity,
        'rgba(54, 162, 235, 1)'
    );

    let doorSwitchChart = createChart(
        document.getElementById('doorSwitchChart').getContext('2d'),
        "Switch Door (0 = Terbuka, 1 = Tertutup)",
        sensorData.doorSwitch,
        'rgba(255, 206, 86, 1)'
    );

    let vibrationChart = createChart(
        document.getElementById('vibrationChart').getContext('2d'),
        "Vibrasi (m/s²)",
        sensorData.vibration,
        'rgba(75, 192, 192, 1)'
    );

    let shockChart = createChart(
        document.getElementById('shockChart').getContext('2d'),
        "Getaran (Hz)",
        sensorData.shock,
        'rgba(153, 102, 255, 1)'
    );

    // Fungsi untuk mengambil data historis dari database menggunakan AJAX
    function fetchHistoricalData() {
        fetch(`/api/sensor-data/latest/${deviceId}`)
            .then(response => response.json())
            .then(data => {
                // Data diharapkan berupa array record
                // Reset array sensorData
                sensorData.labels = [];
                sensorData.temperature = [];
                sensorData.humidity = [];
                sensorData.doorSwitch = [];
                sensorData.vibration = [];
                sensorData.shock = [];

                // Iterasi setiap record dan masukkan ke array
                data.forEach(record => {
                    sensorData.labels.push(record.timestamp);
                    sensorData.temperature.push(record.suhu);
                    sensorData.humidity.push(record.kelembapan);
                    sensorData.doorSwitch.push(record.pintu_status === 'tertutup' ? 1 : 0);
                    sensorData.vibration.push(record.vibrasi);
                    sensorData.shock.push(record.getaran);
                });

                // Perbarui semua chart dengan data historis
                temperatureChart.data.labels = sensorData.labels;
                temperatureChart.data.datasets[0].data = sensorData.temperature;
                temperatureChart.update();

                humidityChart.data.labels = sensorData.labels;
                humidityChart.data.datasets[0].data = sensorData.humidity;
                humidityChart.update();

                doorSwitchChart.data.labels = sensorData.labels;
                doorSwitchChart.data.datasets[0].data = sensorData.doorSwitch;
                doorSwitchChart.update();

                vibrationChart.data.labels = sensorData.labels;
                vibrationChart.data.datasets[0].data = sensorData.vibration;
                vibrationChart.update();

                shockChart.data.labels = sensorData.labels;
                shockChart.data.datasets[0].data = sensorData.shock;
                shockChart.update();
            })
            .catch(error => console.error("Error fetching historical data:", error));
    }

    // Panggil fungsi untuk mengambil data historis saat halaman dimuat
    fetchHistoricalData();

    // Fungsi untuk update data sensor terbaru secara real-time
    function fetchLatestSensor() {
        // Memanggil endpoint show untuk mengambil data sensor terbaru berdasarkan device_id
        fetch(`/api/sensor-data/latest/${deviceId}`)
            .then(response => response.json())
            .then(data => {
                if (data.message === "Data tidak ditemukan") {
                    console.log("Data sensor tidak ditemukan untuk device_id =", deviceId);
                    return;
                }
                console.log("Data sensor terbaru:", data);

                // Update sensor cards
                if (data.suhu !== undefined) {
                    document.getElementById('suhuValue').innerText = data.suhu + "°C";
                }
                if (data.kelembapan !== undefined) {
                    document.getElementById('kelembapanValue').innerText = data.kelembapan + "%";
                }
                if (data.pintu_status !== undefined) {
                    document.getElementById('pintuStatusValue').innerText =
                        (data.pintu_status === 'tertutup') ? 'Tertutup' : 'Terbuka';
                }
                if (data.vibrasi !== undefined) {
                    document.getElementById('vibrasiValue').innerText = data.vibrasi + " m/s²";
                }
                if (data.getaran !== undefined) {
                    document.getElementById('getaranValue').innerText = data.getaran + " Hz";
                }

                // Jika data timestamp baru belum ada di sensorData, tambahkan data baru ke array
                if (data.timestamp && !sensorData.labels.includes(data.timestamp)) {
                    sensorData.labels.push(data.timestamp);
                    sensorData.temperature.push(data.suhu ?? 0);
                    sensorData.humidity.push(data.kelembapan ?? 0);
                    sensorData.doorSwitch.push(data.pintu_status === 'tertutup' ? 1 : 0);
                    sensorData.vibration.push(data.vibrasi ?? 0);
                    sensorData.shock.push(data.getaran ?? 0);

                    // Perbarui semua chart dengan data terbaru
                    temperatureChart.data.labels = sensorData.labels;
                    temperatureChart.data.datasets[0].data = sensorData.temperature;
                    temperatureChart.update();

                    humidityChart.data.labels = sensorData.labels;
                    humidityChart.data.datasets[0].data = sensorData.humidity;
                    humidityChart.update();

                    doorSwitchChart.data.labels = sensorData.labels;
                    doorSwitchChart.data.datasets[0].data = sensorData.doorSwitch;
                    doorSwitchChart.update();

                    vibrationChart.data.labels = sensorData.labels;
                    vibrationChart.data.datasets[0].data = sensorData.vibration;
                    vibrationChart.update();

                    shockChart.data.labels = sensorData.labels;
                    shockChart.data.datasets[0].data = sensorData.shock;
                    shockChart.update();
                }
            })
            .catch(error => console.error("Error fetching sensor data:", error));
    }

    // Panggil fungsi update data sensor terbaru setiap 2 detik
    setInterval(fetchLatestSensor, 2000);

    // Fungsi filter chart berdasarkan tanggal (sama seperti sebelumnya)
    function updateCharts() {
        let startDate = document.getElementById('startDate').value;
        let endDate = document.getElementById('endDate').value;

        if (!startDate || !endDate) {
            alert("Silakan pilih rentang tanggal.");
            return;
        }

        let filteredLabels = [];
        let filteredTemperature = [];
        let filteredHumidity = [];
        let filteredDoorSwitch = [];
        let filteredVibration = [];
        let filteredShock = [];

        for (let i = 0; i < sensorData.labels.length; i++) {
            if (sensorData.labels[i] >= startDate && sensorData.labels[i] <= endDate) {
                filteredLabels.push(sensorData.labels[i]);
                filteredTemperature.push(sensorData.temperature[i]);
                filteredHumidity.push(sensorData.humidity[i]);
                filteredDoorSwitch.push(sensorData.doorSwitch[i]);
                filteredVibration.push(sensorData.vibration[i]);
                filteredShock.push(sensorData.shock[i]);
            }
        }

        temperatureChart.data.labels = filteredLabels;
        temperatureChart.data.datasets[0].data = filteredTemperature;
        temperatureChart.update();

        humidityChart.data.labels = filteredLabels;
        humidityChart.data.datasets[0].data = filteredHumidity;
        humidityChart.update();

        doorSwitchChart.data.labels = filteredLabels;
        doorSwitchChart.data.datasets[0].data = filteredDoorSwitch;
        doorSwitchChart.update();

        vibrationChart.data.labels = filteredLabels;
        vibrationChart.data.datasets[0].data = filteredVibration;
        vibrationChart.update();

        shockChart.data.labels = filteredLabels;
        shockChart.data.datasets[0].data = filteredShock;
        shockChart.update();
    }
</script>
@endpush
