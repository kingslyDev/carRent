<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BookingRequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Rute untuk semua pengguna yang terautentikasi
Route::middleware('auth')->group(function () {

    // Rute untuk admin dan karyawan
    Route::middleware('role:admin|karyawan')->group(function () {
        Route::resource('vehicles', VehicleController::class); // CRUD untuk vehicles
        Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.baru'); // Update vehicle
        Route::get('/bookings/{vehicle}', [BookingController::class, 'index'])->name('bookings.vehicles.index');
        Route::delete('/my-bookings/{id}', [BookingRequestController::class, 'destroy'])->name('my-bookings.destroy');
    });

    Route::middleware('role:karyawan')->group(function () {
        Route::resource('booking-requests', BookingRequestController::class);
        Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my-bookings');
        
        
});




    

    // Rute khusus untuk admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index'); // Index bookings untuk admin
        Route::resource('drivers', DriverController::class)->except(['show']); // CRUD untuk drivers
        Route::put('/drivers/{driver}', [DriverController::class, 'update'])->name('drivers.baru'); // Update driver
        Route::resource('bookings', BookingController::class)->except(['show']); // CRUD untuk bookings
        Route::resource('employees', EmployeeController::class)->except(['show']); // CRUD untuk employees
    });

    // Rute untuk approver
    Route::middleware('role:approver')->group(function () {
        Route::resource('approvals', ApprovalController::class)->only(['index', 'update']); // CRUD untuk approvals
    });

});

// Rute autentikasi
require __DIR__.'/auth.php';
