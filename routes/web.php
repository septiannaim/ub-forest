<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SensorDataController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// Home route
Route::get('/', function () {
    return view('home');
});

// Dashboard route dengan proteksi middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users management routes
    Route::resource('users', UserController::class); 
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');

    // Route sederhana untuk menampilkan view "device"
    Route::get('/device', function () {
        return view('device');
    })->name('device');

    // Resource controller untuk devices
    Route::resource('devices', DeviceController::class);

    // Route manual untuk menampilkan device (opsi 2)
    Route::get('/devices/{id}', [DeviceController::class, 'show'])->name('devices.show');
    Route::get('/devices/{device}/show', [DeviceController::class, 'show'])->name('devices.show');


    //Route Untuk log Data sensor 
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/logs/{device_id}', [LogController::class, 'show'])->name('logs.show');
    Route::get('/logs/export', [LogController::class, 'exportCsv'])->name('logs.export');
    Route::get('/logs/{device}', [LogController::class, 'show'])->name('logs.show');
    Route::get('/export-sensor-data', [LogController::class, 'exportExcel'])->name('logs.exportExcel');
Route::get('/logs/{device}/export-csv', [LogController::class, 'exportCsv'])
     ->name('logs.exportCsv');
//route untuk export pdf
Route::get('/logs/exportPdf/{device}', [LogController::class, 'exportPdf'])->name('logs.exportPdf');


    Route::get('/sensor/{id}', [SensorDataController::class, 'getLatestData']);
});

// Mengimpor route bawaan autentikasi (Laravel Breeze, dll.)
require __DIR__.'/auth.php';
