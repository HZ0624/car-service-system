<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $bookings = $user->bookings()
                         ->with(['vehicle', 'service'])
                         ->latest()
                         ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $vehicles = $user->vehicles;
        $services = Service::all();
        
        if ($vehicles->isEmpty()) {
            return redirect()->route('vehicles.create')
                             ->with('error', 'Please add a vehicle first!');
        }

        return view('bookings.create', compact('vehicles', 'services'));
    }

    public function store(Request $request)
    {
        // 1. Validate Input
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:today', 
            'notes' => 'nullable|string|max:1000',
        ]);

        $service = Service::find($validated['service_id']);

        // 2. Create Booking Record
        Booking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $validated['vehicle_id'],
            'service_id' => $validated['service_id'],
            'booking_date' => $validated['booking_date'],
            'total_price' => $service->price,
            'status' => 'Scheduled',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('dashboard')->with('status', 'Booking confirmed!');
    }

    /**
     * UPDATE METHOD ADDED TO HANDLE CANCELLATIONS
     */
    public function update(Request $request, Booking $booking)
    {
        // 1. Make sure the user actually owns this booking!
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 2. Check if this is a cancellation request
        if ($request->has('cancel')) {
            if ($booking->status === 'Scheduled') {
                $booking->status = 'Cancelled';
                $booking->save();
                return redirect()->back()->with('status', 'Your booking has been cancelled successfully.');
            }
        }

        return redirect()->back();
    }
}