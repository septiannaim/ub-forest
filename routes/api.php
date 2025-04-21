<?php

use App\Http\Controllers\SensorDataController;
use Illuminate\Support\Facades\Route;

// Basic CRUD routes for Sensor Data
Route::get('/sensor-data', [SensorDataController::class, 'index']);
Route::get('/sensor-data/{id}', [SensorDataController::class, 'show']);
Route::post('/sensor-data', [SensorDataController::class, 'store']);  // To handle LoRa sensor data submission
Route::put('/sensor-data/{id}', [SensorDataController::class, 'update']);
Route::delete('/sensor-data/{id}', [SensorDataController::class, 'destroy']);

// Additional route for getting the latest data for a device
Route::get('/sensor-data/latest/{deviceId}', [SensorDataController::class, 'latestByDevice']);
