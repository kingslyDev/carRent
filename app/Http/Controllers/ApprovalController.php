<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ApprovalController extends Controller
{
    //
    public function index()
{
    // Ambil approver yang sedang login
    $approverId = auth()->user()->id;

    // Ambil semua booking yang memiliki status 'pending' atau 'approved' dan disetujui oleh approver yang sedang login
    $bookings = Booking::with(['user', 'vehicle', 'driver', 'approver'])
                       ->where(function($query) use ($approverId) {
                           $query->where('status', 'pending')
                                 ->orWhere(function($query) use ($approverId) {
                                     $query->where('status', 'approved')
                                           ->where('approver_id', $approverId);
                                 });
                       })
                       ->get();

    // Tampilkan view 'approvals.index' dengan data bookings dan approverId
    return view('approvals.index', compact('bookings', 'approverId'));
}

public function approve(Request $request, $id)
{
    // Validasi request
    $request->validate([
        'status' => 'required|in:approved,rejected',
    ]);

    // Cari booking berdasarkan ID dan pastikan hanya booking dengan status 'pending'
    $booking = Booking::where('id', $id)
                      ->where('status', 'pending')
                      ->where('approver_id', auth()->user()->id) // Hanya booking yang diizinkan oleh approver yang sedang login
                      ->firstOrFail();
    
    // Simpan status booking sesuai dengan request
    $booking->status = $request->input('status');

    // Jika status adalah 'approved', kurangi stok kendaraan
    if ($request->input('status') === 'approved') {
    
        $vehicle = $booking->vehicle;
        $vehicle->stock -= 1; 
        $vehicle->save();
    }

    // Simpan perubahan booking
    $booking->save();

    // Redirect kembali ke halaman index dengan pesan sukses
    return redirect()->route('approvals.index')->with('success', 'Booking telah disetujui atau ditolak.');
}


public function export(Request $request)
    {
        // Misalnya, ambil bookings berdasarkan id approver yang diberikan
        $approverId = $request->input('approver_id');

        $bookings = Booking::where('approver_id', $approverId)->get();

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Tulis header
        $sheet->setCellValue('A1', 'Peminjam');
        $sheet->setCellValue('B1', 'Kendaraan');
        $sheet->setCellValue('C1', 'Start Time');
        $sheet->setCellValue('D1', 'End Time');
        $sheet->setCellValue('E1', 'Status');

        // Tulis data bookings
        $row = 2;
        foreach ($bookings as $booking) {
            $sheet->setCellValue('A' . $row, $booking->user->name);
            $sheet->setCellValue('B' . $row, $booking->vehicle->name);
            $sheet->setCellValue('C' . $row, \Carbon\Carbon::parse($booking->start_time)->format('d F Y'));
            $sheet->setCellValue('D' . $row, \Carbon\Carbon::parse($booking->end_time)->format('d F Y'));
            $sheet->setCellValue('E' . $row, $booking->status);
            $row++;
        }

        // Buat file Excel
        $fileName = 'bookings.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);

        // Download file Excel
        return response()->download($fileName)->deleteFileAfterSend(true);
    }


    

}
