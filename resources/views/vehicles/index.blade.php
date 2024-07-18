@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-5 justify-items-center">
    <a href="#" class="mb-5 font-bold text-xl">Manage Mobil</a>
</div> 
    <h1 class="mb-5 font-bold">Vehicles</h1>
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary mb-3">Add Vehicle</a>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($vehicles as $vehicle)
        <div class="col">
            <div class="card shadow-sm">
                @if ($vehicle->thumbnail)
                <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" class="card-img-top img-fluid" alt="Vehicle Thumbnail">
                @else
                <img src="{{ asset('images/default-vehicle.jpg') }}" class="card-img-top img-fluid" alt="Default Vehicle Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $vehicle->name }}</h5>
                    <p class="card-text"><strong>Type:</strong> {{ $vehicle->type }}</p>
                    <p class="card-text"><strong>Is Rented:</strong> {{ $vehicle->is_rented }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $vehicle->stock }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
