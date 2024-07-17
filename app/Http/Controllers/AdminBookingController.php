<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'vehicle'])->get();

        return view('admin.bookings.index', compact('bookings'));
    }
}
