<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class BookingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vehicles = Vehicle::all();
        $vehicleId = $request->query('vehicle');
    
        if ($vehicleId) {
            $vehicle = Vehicle::find($vehicleId);
        } else {
            $vehicle = null;
        }
    
        return view('booking_requests.index', compact('vehicles', 'vehicle'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $vehicleId = $request->query('vehicle');

        // Fetch the vehicle based on the vehicleId parameter
        $vehicle = Vehicle::findOrFail($vehicleId);

        return view('booking_requests.create', compact('vehicle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input dari form request booking
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);
    
        // Simpan data booking ke database dengan status 'pending'
        Booking::create([
            'user_id' => $validated['user_id'], // Mengambil user_id dari input yang divalidasi
            'vehicle_id' => $validated['vehicle_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'status' => 'pending',
            
        ]);


    
        return redirect()->route('my-bookings')->with('success', 'Booking request created successfully.');
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking_requests.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking_requests.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data input dari form request booking
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Hapus data booking berdasarkan ID
        $booking = Booking::findOrFail($id);
        $booking->delete();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('booking-requests.index')->with('success', 'Booking request deleted successfully.');
    }
}
