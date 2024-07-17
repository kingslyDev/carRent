<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'vehicle', 'driver', 'approver'])->get();
        $drivers = Driver::all();
        $approvers = User::role('approver')->get();

        // Filter drivers who are already assigned to a booking
        $assignedDrivers = Booking::whereNotNull('driver_id')->pluck('driver_id')->toArray();
        $availableDrivers = $drivers->whereNotIn('id', $assignedDrivers);

        return view('admin.bookings.index', compact('bookings', 'availableDrivers', 'approvers'));
    }

    public function execute(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->driver_id = $request->input('driver_id');
        $booking->approver_id = $request->input('approver_id');
        $booking->status = 'pending'; 
        $booking->save();

        // Redirect ke halaman atau route yang sesuai
        return redirect()->route('admin.bookings.index')->with('success', 'Driver telah ditetapkan untuk booking.');
    }
}
