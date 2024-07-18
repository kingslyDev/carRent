<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Query untuk mendapatkan data pemakaian kendaraan berdasarkan hari, nama kendaraan, dan rentang tanggal
        $bookings = Booking::select(
            DB::raw('vehicle_id'),
            DB::raw('MONTH(start_time) as month'),
            DB::raw('count(*) as usage_count')
        )
        ->whereYear('start_time', date('Y')) // Filter data untuk tahun ini
        ->groupBy('vehicle_id', 'month')
        ->with('vehicle:id,name')
        ->get();
    

        // Persiapkan data untuk chart
        $chartsData = [];

// Inisialisasi data untuk setiap kendaraan
$vehicles = Vehicle::select('id', 'name')->get(); // Ambil daftar kendaraan
foreach ($vehicles as $vehicle) {
    $vehicleName = $vehicle->name;
    $chartsData[$vehicleName] = [
        'January' => 0,
        'February' => 0,
        'March' => 0,
        'April' => 0,
        'May' => 0,
        'June' => 0,
        'July' => 0,
        'August' => 0,
        'September' => 0,
        'October' => 0,
        'November' => 0,
        'December' => 0,
    ];
}

// Masukkan data penggunaan yang diambil dari query ke dalam $chartsData
        foreach ($bookings as $booking) {
        $vehicleName = $booking->vehicle->name;
        $monthName = date('F', mktime(0, 0, 0, $booking->month, 1));
        $chartsData[$vehicleName][$monthName] = $booking->usage_count;
    }

        return view('reports.index', compact('chartsData'));

    }
}
