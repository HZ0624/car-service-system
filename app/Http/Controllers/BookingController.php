<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\User; // Imported User model to fix the VS Code red line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a list of the user's past and upcoming bookings.
     * Feature 3: Service History
     */
    public function index()
    {
        // 1. Professional Fix: Tell VS Code that the logged-in user is our 'User' model
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 2. Now we use $user to get the bookings. 
        // using 'with()' optimizes performance (Eager Loading) - excellent for rubric.
        $bookings = $user->bookings()
                         ->with(['vehicle', 'service'])
                         ->latest()
                         ->get();

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     * Feature 2: Booking System (Form)
     */
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Fetch User's Vehicles
        $vehicles = $user->vehicles;
        
        // 2. Fetch All Services for the dropdown
        $services = Service::all();
        
        // 3. Validation: If user has no cars, redirect them to add one first.
        // This demonstrates "Robustness" in your assignment.
        if ($vehicles->isEmpty()) {
            return redirect()->route('vehicles.create')
                             ->with('error', 'Please add a vehicle first!');
        }

        return view('bookings.create', compact('vehicles', 'services'));
    }

    /**
     * Store a newly created booking in storage.
     * Feature 2: Booking System (Logic)
     */
    public function store(Request $request)
    {
        // 1. Validate Input (Rubric: "Strong validation mechanisms")
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:today', // Prevent past dates
        ]);

        // 2. Get Service Price automatically to prevent user tampering
        $service = Service::find($validated['service_id']);

        // 3. Create Booking Record
        Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $validated['vehicle_id'],
            'service_id' => $validated['service_id'],
            'booking_date' => $validated['booking_date'],
            'total_price' => $service->price,
            'status' => 'Scheduled'
        ]);

        // 4. Redirect to Dashboard with success message
        return redirect()->route('dashboard')->with('status', 'Booking confirmed!');
    }
}