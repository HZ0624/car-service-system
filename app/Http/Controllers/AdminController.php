<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of ALL bookings (for the Manager).
     */
    public function index()
    {
        // 1. Fetch all bookings with customer info
        $bookings = Booking::with(['customer', 'vehicle', 'service'])
                           ->latest()
                           ->get();

        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Update the status of a specific booking.
     */
    public function update(Request $request, $id)
    {
        // 1. Find the booking
        $booking = Booking::findOrFail($id);
        
        // 2. Update status
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('status', 'Booking status updated!');
    }
}
