<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a list of the user's past and upcoming bookings.
     * (This is the new function for Feature 3: Service History)
     */
    public function index()
    {
        // Get all bookings for the logged-in user, ordered by newest first
        // We use 'with' to load the vehicle and service details efficiently
        $bookings = Auth::user()->bookings()->with(['vehicle', 'service'])->latest()->get();

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        // 1. Fetch User's Vehicles
        $vehicles = Auth::user()->vehicles;
        // 2. Fetch All Services
        $services = Service::all();
        
        // Validation: If user has no cars, send them to add one first
        if ($vehicles->isEmpty()) {
            return redirect()->route('vehicles.create')->with('error', 'Please add a vehicle first!');
        }

        return view('bookings.create', compact('vehicles', 'services'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate Input
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:today', // Prevent past dates
        ]);

        // 2. Get Service Price
        $service = Service::find($validated['service_id']);

        // 3. Create Booking
        Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $validated['vehicle_id'],
            'service_id' => $validated['service_id'],
            'booking_date' => $validated['booking_date'],
            'total_price' => $service->price,
            'status' => 'Scheduled'
        ]);

        // Redirect to the Dashboard
        return redirect()->route('dashboard')->with('status', 'Booking confirmed!');
    }
}