<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    protected $table = 'sensor_data'; // Pastikan sesuai dengan nama tabel di DB
    
    protected $fillable = [
        'device_id',
        'suhu',
        'kelembapan',
        'pintu_status',
        'vibrasi',
        'getaran',
        'latitude',
        'longitude',
        'timestamp',
    ];
}
