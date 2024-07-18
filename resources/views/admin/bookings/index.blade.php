@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Daftar Booking</h1>

    <!-- Form untuk memilih rentang tanggal -->
    <form action="{{ route('export.bookings') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="col-md-4">
                <label for="end_date">End Date:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <div class="col-md-4">
                <label class="invisible">Submit</label><br>
                <button type="submit" class="btn btn-primary mt-2">Export</button>
            </div>
        </div>
    </form>

    <!-- Tabel daftar booking -->
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
                    <td class="p-5">
                        @if (!$booking->driver_id)
                            <form action="{{ route('admin.bookings.execute', $booking->id) }}" method="POST">
                                @csrf
                                <select name="driver_id" required>
                                    <option value="">Pilih Driver</option>
                                    @foreach ($availableDrivers as $driver)
                                        @if ($driver->status == 'siap')
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                        @else
                            {{ $booking->driver->name }}
                        @endif
                    </td>
                    <td class="p-2">
                        <form action="{{ route('admin.bookings.execute', $booking->id) }}" method="POST">
                            @csrf
                            <select name="approver_id" required>
                                <option value="">Pilih Approver</option>
                                @foreach ($approvers as $approver)
                                    <option value="{{ $approver->id }}" @if ($booking->approver_id == $approver->id) selected @endif>
                                        {{ $approver->name }}
                                    </option>
                                @endforeach
                            </select>
                    </td>
                    <td class="p-5">
                        @if ($booking->status == 'pending')
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
</div>
@endsection
