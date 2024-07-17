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
                    <!-- Kolom untuk tombol eksekusi -->
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
                            <!-- Option untuk memilih driver -->
                            <!-- Misalnya, menggunakan select box -->
                            <select name="driver">
                            <option value="">Pilih Driver</option>
                            @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                            </select>
                        </td>
                        <td class="p-5">
                            <!-- Option untuk memilih approval -->
                            <select name="approver">
                            <option value="">Pilih Approval</option>
                            @foreach ($approvers as $approver)
                            <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                            @endforeach
                            </select>

                        </td>
                        <td class="">
                            <!-- Tombol untuk eksekusi -->
                            <!-- Misalnya, tombol 'Eksekusi' dengan link atau form -->
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Eksekusi</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
