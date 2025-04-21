<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    public function index(Request $request)
{
    // Tangkap device_id dari query parameter
    $deviceId = $request->query('device_id');

    // Jika ada device_id, filter datanya
    if ($deviceId) {
        $data = SensorData::where('device_id', $deviceId)
                          ->orderBy('timestamp', 'asc')
                          ->get();
    } else {
        // Jika tidak ada device_id, ambil semua data
        $data = SensorData::all();
    }

    return response()->json($data, 200);
}


    // Ambil data berdasarkan ID (opsional, jika ingin menampilkan detail satu data)
    public function show($id)
    {
        $data = SensorData::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($data, 200);
    }

  // Store the sensor data sent from the LoRa Sender
public function store(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'device_id'    => 'required',
        'suhu'         => 'required|numeric',
        'kelembapan'   => 'required|numeric',
        'pintu_status' => 'required|string',
        'vibrasi'      => 'required|numeric',
        'getaran'      => 'required|numeric',
        'latitude'     => 'required|numeric',
        'longitude'    => 'required|numeric',
        'timestamp'    => 'required|date_format:Y-m-d H:i:s',
    ]);

    // Create a new record in the database
    $data = SensorData::create([
        'device_id'    => $request->device_id,
        'suhu'         => $request->suhu,
        'kelembapan'   => $request->kelembapan,
        'pintu_status' => $request->pintu_status,
        'vibrasi'      => $request->vibrasi,
        'getaran'      => $request->getaran,
        'latitude'     => $request->latitude,
        'longitude'    => $request->longitude,
        'timestamp'    => $request->timestamp,
    ]);

    return response()->json($data, 201);
}

    // Update data
    public function update(Request $request, $id)
    {
        $data = SensorData::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Bisa lakukan validasi ulang di sini jika diperlukan
        // Contoh validasi sederhana:
        $request->validate([
            'suhu'         => 'numeric|nullable',
            'kelembapan'   => 'numeric|nullable',
            'pintu_status' => 'string|nullable',
            'vibrasi'      => 'numeric|nullable',
            'getaran'      => 'numeric|nullable',
            'latitude'     => 'numeric|nullable',
            'longitude'    => 'numeric|nullable',
            'timestamp'    => 'date_format:Y-m-d H:i:s|nullable',
        ]);

        // Update data
        $data->update($request->all());

        return response()->json($data, 200);
    }

    // Hapus data
    public function destroy($id)
    {
        $data = SensorData::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
    public function getAllData()
    {
        $sensorData = SensorData::all();
        return response()->json($sensorData);
    }

    public function latestByDevice($deviceId)
{
    // Ambil record paling baru (timestamp terbaru) untuk device tertentu
    $data = SensorData::where('device_id', $deviceId)
                      ->orderBy('timestamp', 'desc')
                      ->first();

    if (!$data) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    return response()->json($data, 200);
}

   

    
}
