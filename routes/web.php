<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookingRequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/maps',function(){
    return view('about');
})->name('maps');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('admin/register', [RegisteredUserController::class, 'create'])->name('admin.register');
Route::post('admin/register', [RegisteredUserController::class, 'store'])->name('admin.register.submit');
Route::get('approver/register', [RegisteredUserController::class, 'create'])->name('approver.register');
Route::post('approver/register', [RegisteredUserController::class, 'store'])->name('approver.register.submit');


Route::middleware('auth')->group(function () {

    // karyawan dan admin
    Route::middleware('role:admin|karyawan')->group(function () {
        Route::resource('vehicles', VehicleController::class); 
        Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.baru'); // Update vehicle
        Route::get('/bookings/{vehicle}', [BookingController::class, 'index'])->name('bookings.vehicles.index');
        Route::delete('/my-bookings/{id}', [BookingRequestController::class, 'destroy'])->name('my-bookings.destroy');
    });

    // karyawan
    Route::middleware('role:karyawan')->group(function () {
        Route::resource('booking-requests', BookingRequestController::class);
        Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my-bookings');
        
    });

    
    // admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        Route::get('/export-bookings', [BookingController::class, 'exportBookings'])->name('export.bookings');
        Route::post('/admin/bookings/{id}/execute', [AdminBookingController::class, 'execute'])->name('admin.bookings.execute');
        Route::resource('drivers', DriverController::class)->except(['show']); 
        Route::put('/drivers/{driver}', [DriverController::class, 'update'])->name('drivers.baru'); 
        Route::resource('bookings', BookingController::class)->except(['show']);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index'); 
       
    });

    // Approver
    Route::middleware('role:approver')->group(function () {
        Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
        Route::post('/approvals/{id}/approve', [ApprovalController::class, 'approve'])->name('approvals.approve');
        Route::get('/approvals/export', [ApprovalController::class, 'export'])->name('approvals.export');
    });
    

});

// Rute autentikasi
require __DIR__.'/auth.php';
