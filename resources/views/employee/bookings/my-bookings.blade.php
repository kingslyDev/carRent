@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">My Bookings</h1>
        
        @if ($bookings->isEmpty())
            <p>No bookings found.</p>
        @else
            <div class="table-responsive">
                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Vehicle</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Start Time</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">End Time</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                            <!-- Tambahan kolom jika diperlukan -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-2 text-sm">{{ $booking->vehicle->name }}</td>
                                <td class="px-4 py-2 text-sm">{{ $booking->start_time }}</td>
                                <td class="px-4 py-2 text-sm">{{ $booking->end_time }}</td>
                                <td class="px-4 py-2 text-sm">{{ $booking->status }}</td>
                                <td class="px-4 py-2 text-sm">
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Batalkan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <p class="text-sm mt-5">*Pending belum di Approve / *Rejected ditolak / *Approved disetujui dan silahkan langsung menuju POOL</p>
    </div>
@endsection
