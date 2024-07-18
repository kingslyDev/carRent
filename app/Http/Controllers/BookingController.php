<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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


    

    public function exportBookings(Request $request)
    {
        
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $bookings = Booking::whereBetween('start_time', [$startDate, $endDate])->get();

      
        $spreadsheet = new Spreadsheet();

      
        $spreadsheet->getProperties()
                    ->setCreator('Your Name')
                    ->setTitle('Daftar Booking')
                    ->setDescription('Daftar booking berdasarkan tanggal start time');

       
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Peminjam');
        $sheet->setCellValue('B1', 'Kendaraan');
        $sheet->setCellValue('C1', 'Start Time');
        $sheet->setCellValue('D1', 'End Time');
        $sheet->setCellValue('E1', 'Status');
        $sheet->setCellValue('F1', 'Driver');
        $sheet->setCellValue('G1', 'Approval');

        // Fill data rows
        $row = 2; // Starting row for data
        foreach ($bookings as $booking) {
            $sheet->setCellValue('A' . $row, $booking->user->name);
            $sheet->setCellValue('B' . $row, $booking->vehicle->name);
            $sheet->setCellValue('C' . $row, \Carbon\Carbon::parse($booking->start_time)->format('d F Y'));
            $sheet->setCellValue('D' . $row, \Carbon\Carbon::parse($booking->end_time)->format('d F Y'));
            $sheet->setCellValue('E' . $row, $booking->status);
            $sheet->setCellValue('F' . $row, $booking->driver_id ? $booking->driver->name : '');
            $sheet->setCellValue('G' . $row, $booking->approver_id ? $booking->approver->name : '');
            $row++;
        }

        // Set auto size for columns
        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create Excel file
        $filename = 'bookings_' . date('YmdHis') . '.xlsx';

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Create Excel writer
        $writer = new Xlsx($spreadsheet);

        // Save Excel file to output
        $writer->save('php://output');

        exit;
    }


}


