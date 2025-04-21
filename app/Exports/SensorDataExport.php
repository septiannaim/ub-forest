<?php

namespace App\Exports;

use App\Models\SensorData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SensorDataExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;
    
    /**
     * Konstruktor untuk menerima filter tanggal (opsional)
     */
    public function __construct($startDate = null, $endDate = null) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    /**
     * Mengembalikan collection data sensor untuk diexport.
     */
    public function collection()
    {
        $query = SensorData::query();

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('timestamp', [$this->startDate, $this->endDate]);
        }

        return $query->orderBy('timestamp', 'desc')->get();
    }

    /**
     * Header kolom di file Excel.
     */
    public function headings(): array
    {
        return [
            'Timestamp',
            'Device ID',
            'Suhu',
            'Kelembapan',
            'Pintu Status',
            'Getaran',
            'Latitude',
            'Longitude',
        ];
    }
}
