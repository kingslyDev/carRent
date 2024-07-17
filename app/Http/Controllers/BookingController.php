<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    
    public function index()
    {
        $bookings = Booking::with(['user', 'vehicle', 'driver', 'approver'])->get();
        return view('bookings.index', compact('bookings'));
    }


    public function myBookings()
    {
        $user_id = auth()->id(); 
        $bookings = Booking::where('user_id', $user_id)->get();

        return view('employee.bookings.my-bookings', compact('bookings'));
    }


    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approvers = User::role('approver')->get();
        return view('bookings.create', compact('vehicles', 'drivers', 'approvers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'driver_id' => 'required|exists:drivers,id',
            'approver_id' => 'required|exists:users,id',
        ]);

        Booking::create(array_merge($validated, [
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]));

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approvers = User::role('approver')->get();
        return view('bookings.edit', compact('booking', 'vehicles', 'drivers', 'approvers'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'driver_id' => 'required|exists:drivers,id',
            'approver_id' => 'required|exists:users,id',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(int $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully');
    }
}


