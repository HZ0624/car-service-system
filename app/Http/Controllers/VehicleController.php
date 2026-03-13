<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- This fixes the "App\Models\Auth" error

class VehicleController extends Controller
{
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Fetch vehicles so we can display the table on the "My Vehicles" page
        $vehicles = $user->vehicles;

        return view('vehicles.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'license_plate' => 'required|string|max:20|unique:vehicles,license_plate',
            'make'          => 'required|string|max:50',
            'model'         => 'required|string|max:50',
            'year'          => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'mileage'       => 'nullable|integer|min:0',
        ]);

        // Save to Database
        $vehicle = new Vehicle();
        $vehicle->user_id = Auth::id(); 
        $vehicle->license_plate = strtoupper($request->license_plate);
        $vehicle->make = $request->make;
        $vehicle->model = $request->model;
        $vehicle->year = $request->year;
        $vehicle->mileage = $request->mileage; 
        
        $vehicle->save();

        // Redirect back to the vehicles page
        return redirect()->route('vehicles.create')->with('status', 'Vehicle added successfully!');
    }
    
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ==========================================
        // ROLE REDIRECTION LOGIC
        // ==========================================
        
        // If user is an Admin (Role 2), send them to Admin Panel
        if ($user->role == 2) {
            return redirect()->route('admin.bookings');
        }

        // If user is a Mechanic (Role 3), send them to Mechanic Dashboard
        if ($user->role == 3) {
            return redirect()->route('mechanic.dashboard');
        }

        // ==========================================
        // ROLE 1 (CUSTOMER) DASHBOARD
        // ==========================================
        $vehicles = $user->vehicles;

        $upcomingBookings = $user->bookings()
                                 ->with(['service', 'vehicle'])
                                 ->where('booking_date', '>=', now())
                                 ->orderBy('booking_date', 'asc')
                                 ->get();

        return view('dashboard', compact('vehicles', 'upcomingBookings'));
    }
}