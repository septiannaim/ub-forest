<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DeviceController extends Controller
{
    // Display a list of devices
    public function index()
    {
        // Retrieve all device records
        $devices = DB::table('devices')->get();

        return view('devices.index', compact('devices'));
    }

    public function show($id)
    {
        // Ambil data device
        $device = DB::table('devices')->where('id', $id)->first();

        // Ambil data sensor terkait device ini (berdasarkan device_id)
        $sensorData = DB::table('sensor_data')->where('device_id', $id)->get();

        // Kembalikan view yang menampilkan detail device + sensor
        return view('devices.show', compact('device', 'sensorData'));
    }


    // Show form for adding a new device
    public function create()
    {
        return view('devices.create');
    }

    // Store a new device
    public function store(Request $request)
    {
        // Validate input fields menggunakan nama kolom yang sesuai dengan tabel
        $validated = $request->validate([
            'nama_device' => 'required|string|max:255',
            'deskripsi'   => 'required|string|max:255',
            'status'      => 'required|string',
        ]);

        // Insert the new device into the database menggunakan kolom yang benar
        DB::table('devices')->insert([
            'nama_device' => $request->nama_device,
            'deskripsi'   => $request->deskripsi,
            'status'      => $request->status,
        ]);

        return redirect()->route('devices.index')->with('success', 'Device added successfully!');
    }

    // Show the form to edit a device
    public function edit($id)
    {
        // Retrieve the device record
        $device = DB::table('devices')->where('id', $id)->first();

        return view('devices.edit', compact('device'));
    }

    // Update a device
    public function update(Request $request, $id)
    {
        // Validate input fields menggunakan nama kolom yang sesuai
        $validated = $request->validate([
            'nama_device' => 'required|string|max:255',
            'deskripsi'   => 'required|string|max:255',
            'status'      => 'required|string',
        ]);

        // Update the device record dengan menggunakan kolom yang benar
        DB::table('devices')->where('id', $id)->update([
            'nama_device' => $request->nama_device,
            'deskripsi'   => $request->deskripsi,
            'status'      => $request->status,
        ]);

        return redirect()->route('devices.index')->with('success', 'Device updated successfully!');
    }

    // Delete a device
    public function destroy($id)
    {
        // Delete the device record
        DB::table('devices')->where('id', $id)->delete();

        return redirect()->route('devices.index')->with('success', 'Device deleted successfully!');
    }
}
