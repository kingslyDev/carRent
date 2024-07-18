<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'vehicle', 'driver', 'approver'])->get();
        $drivers = Driver::all();
        $approvers = User::role('approver')->get();

        $assignedDrivers = Booking::whereNotNull('driver_id')->pluck('driver_id')->toArray();
        $availableDrivers = $drivers->whereNotIn('id', $assignedDrivers);

        return view('admin.bookings.index', compact('bookings', 'availableDrivers', 'approvers'));
    }

    public function execute(Request $request, $id)
    {
        try {
            $request->validate([
                'driver_id' => 'required|exists:drivers,id',
                'approver_id' => 'required|exists:users,id',
            ]);

            $booking = Booking::findOrFail($id);

            $driverId = $request->input('driver_id');
            $approverId = $request->input('approver_id');

            $driver = Driver::findOrFail($driverId);

            $driver->status = 'tidak';
            $driver->save();

            $booking->driver_id = $driverId;
            $booking->approver_id = $approverId;
            $booking->status = 'pending';

            $booking->save();

            $logMessage = "Booking ID: {$booking->id} updated - Driver ID: {$driverId}, Approver ID: {$approverId}, Status: pending";
            Log::info($logMessage);

            return redirect()->route('admin.bookings.index')->with('success', 'Driver dan approver telah ditetapkan untuk booking.');
        } catch (\Exception $e) {
            Log::error("Error updating booking with ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menetapkan driver atau approver untuk booking.');
        }
    }
}
