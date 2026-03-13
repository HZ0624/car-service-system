<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of ALL bookings for the Admin.
     */
    public function index()
    {
        // FIXED: Changed 'customer' to 'user' to match your database structure
        $bookings = Booking::with(['user', 'vehicle', 'service'])
                           ->orderBy('booking_date', 'desc') // Show newest bookings at the top
                           ->get();

        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Update the status of a specific booking.
     */
    public function update(Request $request, $id)
    {
        // 1. Validate the incoming status from the dropdown
        $request->validate([
            'status' => 'required|string|in:Scheduled,In Progress,Completed,Cancelled'
        ]);

        // 2. Find the booking
        $booking = Booking::findOrFail($id);
        
        // 3. Update status
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('status', 'Booking status updated successfully!');
    }
}