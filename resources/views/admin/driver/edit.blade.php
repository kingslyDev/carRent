@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Drivers</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="card bg-white rounded-lg shadow-md">
                <div class="card-body">
                    <h2 class="text-lg font-semibold mb-4">Suting Profile Driver</h2>
                    <form action="{{ route('drivers.baru', $drivers->id)}}" method="POST">
                        @csrf
                        
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" name="name" id="name" value="{{ $drivers->name }}" class="form-input mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="city" class="block text-sm font-medium text-gray-700">City:</label>
                            <input type="text" name="city" id="city" value="{{ $drivers->city }}" class="form-input mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <input type="hidden" name="status" id="status" value="{{ $drivers->status }}" class="form-input mt-1 block w-full" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Informasi</button>
                    </form>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                </div>
            </div>
            @endsection
            