@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Booking</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th class="p-5">Peminjam</th>
                <th class="p-5">Kendaraan</th>
                <th class="p-5">Start Time</th>
                <th class="p-5">End Time</th>
                <th class="p-5">Status</th>
                <th class="p-5">Driver</th>
                <th class="p-5">Approval</th>
                <th class="p-5">Eksekusi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td class="p-5">{{ $booking->user->name }}</td>
                    <td class="p-5">{{ $booking->vehicle->name }}</td>
                    <td class="p-5">{{ \Carbon\Carbon::parse($booking->start_time)->format('d F Y') }}</td>
                    <td class="p-5">{{ \Carbon\Carbon::parse($booking->end_time)->format('d F Y') }}</td>
                    <td class="p-5">{{ $booking->status }}</td>
                    <td class="p-5">{{ $booking->driver_id ? $booking->driver->name : 'Belum ditentukan' }}</td>
                    <td class="p-5">{{ $booking->approver_id ? $booking->approver->name : 'Belum ditentukan' }}</td>
                    <td class="p-5">
                        @if ($booking->status == 'pending')
                            <form action="{{ route('approvals.approve', $booking->id) }}" method="POST">
                                @csrf
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="approve{{ $booking->id }}" value="approved">
                                    <label class="form-check-label" for="approve{{ $booking->id }}">Approve</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="rejected{{ $booking->id }}" value="rejected">
                                    <label class="form-check-label" for="rejected{{ $booking->id }}">Reject</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Eksekusi</button>
                            </form>
                        @else
                            Sudah dieksekusi
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Tombol untuk ekspor ke Excel --}}
    <a href="{{ route('approvals.export', ['approver_id' => $approverId]) }}" class="btn btn-secondary mb-3">Export to Excel</a>
</div>
@endsection
