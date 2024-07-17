<!-- booking/index.blade.php -->

@extends('layouts.app') <!-- Sesuaikan dengan layout Anda -->

@section('content')
    <div class="container">
        <h1>Daftar Booking</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th class="p-5">Nama Peminjam</th>
                    <th class="p-5">Kendaraan</th>
                    <th class="p-5">Start Time</th>
                    <th class="p-5">End Time</th>
                    <th class="p-5">Status</th>
                    <!-- Kolom untuk option pilih driver -->
                    <th class="p-5">Pilih Driver</th>
                    <!-- Kolom untuk option persetujuan approver -->
                    <th class="p-5">Approval</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->vehicle->name }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            <!-- Option untuk memilih driver -->
                            <!-- Misalnya, menggunakan select box -->
                            <select name="driver">
                                <option value="">Pilih Driver</option>
                                <!-- Daftar driver yang tersedia -->
                                <!-- Contoh: -->
                                <option value="driver1">Driver 1</option>
                                <option value="driver2">Driver 2</option>
                                <!-- Tambahkan opsi driver sesuai kebutuhan -->
                            </select>
                        </td>
                        <td>
                            <!-- Option untuk persetujuan approver -->
                            <!-- Misalnya, menggunakan checkbox -->
                            <input type="checkbox" name="approval" value="{{ $booking->id }}">
                            <!-- Label untuk checkbox -->
                            <!-- Sesuaikan dengan kebutuhan approver -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
