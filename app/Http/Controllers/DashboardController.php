<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
{
    $cars = Vehicle::where('is_rented', 'Available')
                       ->where('stock', '>', 0)
                       ->orderBy('created_at', 'desc')
                       ->take(4)
                       ->get();
                       
    return view('dashboard', compact('cars'));
}

}
