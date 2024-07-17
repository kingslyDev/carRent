@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Vehicle</h1>
        <form action="{{ route('vehicles.baru', $vehicle->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $vehicle->name }}" required>
            </div>
            
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="direksi" {{ $vehicle->type == 'direksi' ? 'selected' : '' }}>Direksi</option>
                    <option value="tamu" {{ $vehicle->type == 'tamu' ? 'selected' : '' }}>Tamu</option>
                    <option value="operasional" {{ $vehicle->type == 'operasional' ? 'selected' : '' }}>Operasional</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="type">Is Rented</label>
                <select name="is_rented" id="is_rented" class="form-control" required>
                    <option value=""></option>
                    <option value="Available">Available</option>
                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $vehicle->stock }}" min="0" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Vehicle</button>
        </form>
    </div>
@endsection

