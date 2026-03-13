<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    /**
     * Show the Mechanic's Work Queue (Active Jobs).
     */
    public function index()
    {
        $jobs = Booking::with(['user', 'vehicle', 'service'])
                       ->whereIn('status', ['Scheduled', 'In Progress'])
                       ->orderBy('booking_date', 'asc')
                       ->get();

        return view('mechanic.dashboard', compact('jobs'));
    }

    /**
     * Show the Mechanic's Service History (Completed/Cancelled Jobs).
     */
    public function history()
    {
        $jobs = Booking::with(['user', 'vehicle', 'service'])
                       ->whereIn('status', ['Completed', 'Cancelled'])
                       ->orderBy('updated_at', 'desc')
                       ->get();

        return view('mechanic.history', compact('jobs'));
    }

    /**
     * Update status and save mechanic findings
     */
    public function updateStatus(Request $request, $id)
    {
        // Added 'Scheduled' so the dropdown doesn't throw a validation error
        $request->validate([
            'status' => 'required|string|in:Scheduled,In Progress,Completed',
            'mechanic_notes' => 'nullable|string|max:1000'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        
        // Save the findings if the mechanic typed anything
        if ($request->has('mechanic_notes')) {
            $booking->mechanic_notes = $request->mechanic_notes;
        }
        
        $booking->save();

        // NOTE: Email sending logic has been removed so the app doesn't crash!

        return redirect()->back()->with('status', 'Job updated successfully!');
    }
}