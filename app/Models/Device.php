<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_device', 'deskripsi', 'status'
    ];

    public function sensorData()
    {
        return $this->hasMany(SensorData::class);
    }
}
