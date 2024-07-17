@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Manage Drivers</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="card bg-white rounded-lg shadow-md">
                <div class="card-body">
                    <h2 class="text-lg font-semibold mb-4">Add New Driver</h2>
                    <form action="{{ route('drivers.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="city" class="block text-sm font-medium text-gray-700">City:</label>
                            <input type="text" name="city" id="city" class="form-input mt-1 block w-full" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Driver</button>
                    </form>
                </div>
            </div>

            <div class="card bg-white rounded-lg shadow-md">
                <div class="card-body mt-5">
                    <h2 class="text-lg font-semibold mb-4">List of Drivers</h2>
                    @if ($drivers->isEmpty())
                        <p>No drivers found.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table-auto w-full border-collapse border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">City</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drivers as $driver)
                                        <tr class="border-b border-gray-200">
                                            <td class="px-4 py-2 text-sm">{{ $driver->name }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $driver->city }}</td>
                                            <td class="px-4 py-2 text-sm">{{ $driver->status }}</td>
                                            <td class="px-4 py-2">
                                                {{-- Edit button --}}
                                                <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-sm bg-red-600">Edit</a>
                                                {{-- Delete button --}}
                                                <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this driver?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
