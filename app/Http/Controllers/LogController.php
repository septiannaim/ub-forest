<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SensorDataExport;
use Barryvdh\DomPDF\Facade\Pdf;

class LogController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua perangkat dari tabel 'devices'
        $devices = DB::table('devices')->get();

        // Ambil parameter filter tanggal jika ada
        $startDate = $request->get('start_date');
        $endDate   = $request->get('end_date');

        // Query data sensor dengan join ke tabel devices
        $query = DB::table('sensor_data')
            ->join('devices', 'sensor_data.device_id', '=', 'devices.id')
            ->select(
                'sensor_data.*', 
                'devices.nama_device'
            );

        // Jika ada filter tanggal, tambahkan whereBetween
        if ($startDate && $endDate) {
            $query->whereBetween('sensor_data.timestamp', [$startDate, $endDate]);
        }

        // Ambil data sensor dengan pagination
        $logs = $query->orderBy('sensor_data.timestamp', 'desc')->paginate(10);

        return view('logs.index', compact('logs', 'devices', 'startDate', 'endDate'));
    }

    public function show($device_id, Request $request)
    {
        // Ambil filter tanggal jika ada
        $startDate = $request->get('start_date');
        $endDate   = $request->get('end_date');

        // Ambil data sensor berdasarkan device_id
        $query = DB::table('sensor_data')
            ->where('device_id', $device_id)
            ->orderBy('timestamp', 'desc');

        if ($startDate && $endDate) {
            $query->whereBetween('timestamp', [$startDate, $endDate]);
        }

        $logs = $query->paginate(10);

        // Ambil informasi perangkat
        $device = DB::table('devices')->where('id', $device_id)->first();

        if (!$device) {
            abort(404, "Device not found");
        }

        return view('logs.show', compact('logs', 'device', 'startDate', 'endDate'));
    }



    public function exportCsv($device_id, Request $request)
    {
        // Ambil filter tanggal jika ada
        $startDate = $request->get('start_date');
        $endDate   = $request->get('end_date');
    
        // Query data sensor, hanya untuk device tertentu
        $query = DB::table('sensor_data')
            ->join('devices', 'sensor_data.device_id', '=', 'devices.id')
            ->select(
                'sensor_data.timestamp',
                'devices.nama_device',
                'sensor_data.suhu',
                'sensor_data.kelembapan',
                'sensor_data.getaran',
                'sensor_data.pintu_status',
                'sensor_data.pir',
                'sensor_data.latitude',
                'sensor_data.longitude'
            )
            ->where('sensor_data.device_id', $device_id);
    
        // Jika ada filter tanggal
        if ($startDate && $endDate) {
            $query->whereBetween('sensor_data.timestamp', [$startDate, $endDate]);
        }
    
        // Ambil data
        $logs = $query->orderBy('sensor_data.timestamp', 'desc')->get();
    
        // Nama file export
        $filename = "sensor_logs_device{$device_id}_" . date('Ymd_His') . ".csv";
    
        // Header HTTP agar browser mendownload file CSV
        $header = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
    
        // Header kolom di file CSV (bisa tambahkan kolom spacer '' jika ingin)
        $columns = [
            'Timestamp',
            'Device Name',
            'Suhu',
            'Kelembapan',
            'Getaran',
            'Pintu Status',
            'PIR',
            'Latitude',
            'Longitude'
        ];
    
        $callback = function () use ($logs, $columns) {
            $file = fopen('php://output', 'w');
    
            // Tambahkan BOM agar Excel kenali UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
    
            // Agar Excel tahu delimiter ';'
            fputs($file, "sep=;\n");
    
            // Tulis header kolom
            fputcsv($file, $columns, ';');
    
            // Tambahkan baris kosong setelah header (opsional)
            fputcsv($file, [], ';');
    
            // Tulis data
            foreach ($logs as $row) {
                // Misal tambahkan suffix
                $suhu = $row->suhu . ' °C';
                $kelembapan = $row->kelembapan . ' %';
    
                // Kolom spacer (opsional), sisipkan '' di posisi sama seperti columns
                fputcsv($file, [
                    $row->timestamp,
                    $row->nama_device,
                    $suhu,
                    $kelembapan,
                    $row->getaran,
                    $row->pintu_status,
                    $row->pir == 'aktif' ? 'Ada Gerakan' : 'Tidak Ada Gerakan', // PIR output diubah
                    $row->latitude,
                    $row->longitude
                ], ';');
            }
    
            fclose($file); 
        };
    
        return Response::stream($callback, 200, $header);
    }
    



        public function exportExcel(Request $request)
        {
            // Ambil filter tanggal jika ada
            $startDate = $request->get('start_date');
            $endDate   = $request->get('end_date');
        
            // Mengembalikan file Excel dengana nama sensor_data.xlsx
            return Excel::download(new SensorDataExport($startDate, $endDate), 'sensor_data.xlsx');
        }


        public function exportPdf(Request $request, $device_id)
    {
        // Ambil parameter filter tanggal jika ada
        $startDate = $request->get('start_date');
        $endDate   = $request->get('end_date');

        // Ambil data perangkat berdasarkan ID
        $device = DB::table('devices')->where('id', $device_id)->first();
        if (!$device) {
            abort(404, "Device not found");
        }

        // Query data sensor dengan filter tanggal jika ada
        $query = DB::table('sensor_data')
            ->where('device_id', $device_id)
            ->orderBy('timestamp', 'desc');

        if ($startDate && $endDate) {
            $query->whereBetween('sensor_data.timestamp', [$startDate, $endDate]);
        }

        $logs = $query->get();

        // Load view PDF dan kirim data
        $pdf = Pdf::loadView('logs.export_pdf', compact('logs', 'device', 'startDate', 'endDate'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download("sensor_logs_{$device->id}_" . date('Ymd_His') . ".pdf");
    }
    
}
