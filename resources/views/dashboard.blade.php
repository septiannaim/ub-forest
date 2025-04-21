@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <!-- Leaflet Map Full Width -->
            <div id="map" style="height: 90vh; width: 100%;"></div>
        </div>
    </div>
</div>

<!-- Modal untuk Data Sensor -->
<div class="modal fade" id="sensorModal" tabindex="-1" aria-labelledby="sensorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100" id="sensorModalLabel">📡 LoRa Device</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-4">
                        <div class="card p-3 bg-light shadow-sm">
                            <h4 class="fw-bold text-danger"><span id="tempValue">-</span>°C</h4>
                            <p class="text-muted small">Suhu 🌡️</p>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card p-3 bg-light shadow-sm">
                            <h4 class="fw-bold text-primary"><span id="humidityValue">-</span>%</h4>
                            <p class="text-muted small">Kelembapan 💧</p>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card p-3 bg-light shadow-sm">
                            <h4 class="fw-bold text-warning"><span id="vibrationValue">-</span> m/s²</h4>
                            <p class="text-muted small">Vibrasi 🔄</p>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="card p-3 bg-light shadow-sm">
                            <h3 class="fw-bold" id="sensorPIR">-</h3>
                            <p class="text-muted small">PIR Sensor 👀</p>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="card p-3 bg-light shadow-sm">
                            <h3 class="fw-bold" id="sensorDoor">-</h3>
                            <p class="text-muted small">Status Pintu</p>
                        </div>
                    </div>

                    <!-- Tombol ke Halaman Grafik dan Card -->
                    <div class="col-12 mt-4">
                        <a id="viewGraphBtn" href="#" class="btn btn-primary w-100" target="_blank">
                            📊 Lihat Grafik dan Data
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="{{ asset('assets/leaflet/leaflet.css') }}" />
@endpush

@push('scripts')
<!-- Leaflet JS -->
<script src="{{ asset('assets/leaflet/leaflet.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Menggunakan Esri World Imagery sebagai tile layer satelit
        var map = L.map("map").setView([-2.5, 117], 5); // Default pusat Indonesia
    
        L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}", {
            attribution: "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community"
        }).addTo(map);
    
        let markersLayer = L.layerGroup().addTo(map); // Layer untuk menyimpan marker
    
        function fetchSensorData() {
            fetch("/api/sensor-data") // Sesuaikan dengan API endpoint Anda
                .then((response) => response.json())
                .then((data) => {
                    console.log("Sensor Data:", data); // Debug API response
    
                    markersLayer.clearLayers(); // Hapus marker lama
    
                    data.forEach((sensor) => {
                        let lat = parseFloat(sensor.latitude);
                        let lon = parseFloat(sensor.longitude);
                        let statusColor = sensor.pintu_status === "terbuka" ? "red" : "green";
    
                        if (!isNaN(lat) && !isNaN(lon)) {
                            let marker = L.marker([lat, lon]).addTo(markersLayer);
    
                            marker.bindPopup(
                                `<b>Device ID: ${sensor.device_id}</b><br>
                                Suhu: ${sensor.suhu}°C<br>
                                Kelembapan: ${sensor.kelembapan}%<br>
                                Getaran: ${sensor.getaran} m/s²<br>
                                PIR: ${sensor.pir}<br>
                                Pintu: <b style="color:${statusColor}">${sensor.pintu_status}</b>`
                            );
    
                            marker.on("click", function () {
                                updateModal(sensor);
                            });
                        } else {
                            console.warn("Invalid coordinates for Device:", sensor.device_id, lat, lon);
                        }
                    });
                })
                .catch((error) => console.error("Error fetching sensor data:", error));
        }
    
        function updateModal(sensor) {
            document.getElementById("sensorModalLabel").innerText = `📡 LoRa Device ${sensor.device_id}`;
            document.getElementById("tempValue").innerText = sensor.suhu;
            document.getElementById("humidityValue").innerText = sensor.kelembapan;
            document.getElementById("vibrationValue").innerText = sensor.getaran;
            document.getElementById("sensorPIR").innerText = sensor.pir;
            document.getElementById("sensorDoor").innerText = sensor.pintu_status;
    
            // Update link tombol ke halaman grafik yang sesuai dengan ID device
            document.getElementById("viewGraphBtn").href = `/devices/${sensor.device_id}/show`;
    
            var sensorModal = new bootstrap.Modal(document.getElementById("sensorModal"));
            sensorModal.show();
        }
    
        fetchSensorData(); // Load pertama kali
        setInterval(fetchSensorData, 5000); // Update setiap 5 detik tanpa mengubah zoom atau posisi peta
    });
</script>
@endpush
