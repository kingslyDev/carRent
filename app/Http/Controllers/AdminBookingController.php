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
        $bookings = Booking::with(['user', 'vehicle'])->get();
        $drivers = Driver::all();
        $approvers = User::role('approver')->get();

        return view('admin.bookings.index', compact('bookings', 'drivers', 'approvers'));
    }

    public function execute(Request $request, $id)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'approver_id' => 'required|exists:users,id',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(array_merge($validated, [
            'status' => 'approved', // Misalnya status langsung diubah menjadi approved setelah dieksekusi
        ]));

        return redirect()->route('admin.bookings.index')->with('success', 'Booking executed successfully.');
    }
}
