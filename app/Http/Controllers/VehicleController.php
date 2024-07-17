<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all vehicles
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::all();

        return view('vehicles.create' , compact('vehicles'));
        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'type' => 'required|in:direksi,tamu,operasional',
        'description' => 'nullable|string',
        'is_rented' => 'required|in:Available,Tidak Tersedia',
        'stock' => 'integer|min:0',
        'thumbnail' => 'nullable|image|max:8192',
    ]);

    $path = null;
    if ($request->hasFile('thumbnail')) {
        $path = $request->file('thumbnail')->store('thumbnails', 'public');
    }

   
    $vehicle = new Vehicle();
    $vehicle->name = $validated['name'];
    $vehicle->type = $validated['type'];
    $vehicle->description = $validated['description'];
    $vehicle->stock = $validated['stock'];
    $vehicle->thumbnail = $path;
    $vehicle->save();

    return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
}

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle = Vehicle::where('id', $vehicle->id)->first();
        return view('vehicles.show', compact('vehicle'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
{

    // $vehicle = Vehicle::findOrFail($vehicle->id);
    // Validate incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|in:direksi,tamu,operasional',
        'is_rented' => 'required|in:Available,Tidak Tersedia',
        'stock' => 'required|integer|min:0',
    ]);

    // Update the vehicle attributes
  // Update the vehicle attributes
    $vehicle->name = $request->name;
    $vehicle->type = $request->type;
    $vehicle->is_rented = $request->is_rented;
    $vehicle->stock = $request->stock;
    $vehicle->save();


    // Redirect to index page with success message
    return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        // Delete the vehicle's thumbnail
        if ($vehicle->thumbnail) {
        Storage::disk('public')->delete($vehicle->thumbnail);
        }

        // Delete the vehicle
        $vehicle->delete();

        // Redirect back to vehicles index with success message
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
