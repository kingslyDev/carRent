@extends('layouts.app')

@section('content')
<div class="container mx-auto bg-white rounded-lg shadow-lg p-6 mt-10">
    <h1 class="text-3xl font-semibold mb-6 text-blue-600">Create New Vehicle</h1>
    <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
            <input type="text" name="name" id="name" class="form-input w-full @error('name') border-red-500 @enderror" value="{{ old('name') }}" required autofocus>
            @error('name')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Type -->
        <div class="mb-4">
            <label for="type" class="block text-gray-700 font-bold mb-2">Type</label>
            <select name="type" id="type" class="form-select w-full @error('type') border-red-500 @enderror" required>
                <option value="" disabled selected>Select Type</option>
                <option value="direksi" @if(old('type') == 'direksi') selected @endif class="text-blue-600">Direksi</option>
                <option value="tamu" @if(old('type') == 'tamu') selected @endif class="text-blue-600">Tamu</option>
                <option value="operasional" @if(old('type') == 'operasional') selected @endif class="text-blue-600">Operasional</option>
            </select>
            @error('type')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" for="description" id="description" rows="3" class="form-textarea w-full @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Stock -->
        <div class="mb-4">
            <label for="stock" class="block text-gray-700 font-bold mb-2">Stock</label>
            <input type="number" name="stock" id="stock" class="form-input w-full @error('stock') border-red-500 @enderror" value="{{ old('stock', 0) }}" min="0" required>
            @error('stock')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Thumbnail -->
        <div class="mb-4">
            <label for="thumbnail" class="block text-gray-700 font-bold mb-2">Thumbnail</label>
            <input type="file" name="thumbnail" for="thumbnail" id="thumbnail" class="form-input w-full @error('thumbnail') border-red-500 @enderror" accept="image/*">
            @error('thumbnail')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Is Rented -->
        <div class="form-group">
                <label for="type">Is Rented</label>
                <select name="is_rented" id="is_rented" class="form-control" required>
                    <option value="Available">Available</option>
                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                </select>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-800 text-black rounded hover:bg-blue-700 focus:bg-blue-800 focus:outline-none">Create Vehicle</button>
        </div>
    </form>
</div>
@endsection
