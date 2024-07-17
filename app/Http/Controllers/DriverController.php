<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $drivers = Driver::all();
        return view('admin.driver.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
        ]);
    
       
        $drivers = new Driver();
        $drivers->name = $validated['name'];
        $drivers->city = $validated['city'];
        $drivers->save();
    
        return redirect()->back()->with('success', 'Driver created successfully');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        
        $drivers = Driver::findOrFail($id);
        return view('admin.driver.edit', compact('drivers'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'status' => 'required|in:siap,tidak',
        ]);
    
        // Update the vehicle attributes
      // Update the vehicle attributes
        $drivers = Driver::findOrFail($id);
        $drivers->name = $request->name;
        $drivers->city = $request->city;
        $drivers->status = $request->status;
        $drivers->save();
    
    
        // Redirect to index page with success message
        return redirect()->route('drivers.index')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $drivers = Driver::findOrFail($id);
        $drivers->delete();
        return redirect()->back()->with('success', 'Driver deleted successfully');
   
    }
}
