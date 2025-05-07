<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SensorDataController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter device_id jika ada di query string
        $deviceId = $request->query('device_id');

        // Jika ada device_id, tampilkan data berdasarkan device_id
        if ($deviceId) {
            $data = SensorData::where('device_id', $deviceId)
                ->orderBy('timestamp', 'asc')
                ->get();
        } else {
            // Jika tidak ada device_id, tampilkan semua data
            $data = SensorData::all();
        }

        // Kembalikan response dalam bentuk JSON
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = SensorData::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'device_id' => 'required|integer',
            'suhu' => 'required|numeric',
            'kelembapan' => 'required|numeric',
            'getaran' => 'required|numeric',
            'pintu_status' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'pir' => 'required|string',
        ]);

        // Menyimpan data ke dalam database
        $sensorData = new SensorData();
        $sensorData->device_id = $request->device_id;
        $sensorData->suhu = $request->suhu;
        $sensorData->kelembapan = $request->kelembapan;
        $sensorData->getaran = $request->getaran;
        $sensorData->pintu_status = $request->pintu_status;
        $sensorData->latitude = $request->latitude;
        $sensorData->longitude = $request->longitude;

        // Menyimpan timestamp otomatis menggunakan Carbon
        $sensorData->timestamp = Carbon::now();  // Menggunakan waktu sekarang untuk kolom 'timestamp'

        $sensorData->pir = $request->pir;
        $sensorData->save();

        return response()->json([
            'message' => 'Data sensor berhasil disimpan',
            'data' => $sensorData
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = SensorData::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Update data with incoming request data
        $validated = $request->validate([
            'suhu'         => 'nullable|numeric',
            'kelembapan'   => 'nullable|numeric',
            'pintu_status' => 'nullable|string',
            'pir'          => 'nullable|numeric',
            'getaran'      => 'nullable|numeric',
            'latitude'     => 'nullable|numeric',
            'longitude'    => 'nullable|numeric',
            'timestamp'    => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        $data->update($validated);

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $data = SensorData::find($id);

        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Data deleted successfully'], 200);
    }

    public function getAllData()
    {
        $sensorData = SensorData::all();
        return response()->json($sensorData);
    }

    public function latestByDevice($deviceId)
    {
        $data = SensorData::where('device_id', $deviceId)
            ->orderBy('timestamp', 'desc')
            ->first();

        if (!$data) {
            return response()->json(['message' => 'No data found'], 404);
        }

        return response()->json($data, 200);
    }
}
