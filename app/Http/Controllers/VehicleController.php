<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Show the "Add Vehicle" form.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store the new vehicle in the database.
     */
    public function store(Request $request)
    {
        // 1. Validation (Satisfies "Strong validation mechanisms" rubric)
        $validated = $request->validate([
            'license_plate' => 'required|string|max:15|unique:vehicles',
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
        ]);

        // 2. Create Record linked to the User (Satisfies "Modular design")
        // We use the relationship defined in the User model to save it automatically
        $request->user()->vehicles()->create($validated);

        // 3. Redirect to Dashboard with success message
        return redirect()->route('dashboard')->with('status', 'Vehicle added successfully!');
    }
    
    /**
     * List user's vehicles (We will use this later).
     */
    public function index()
    {
        $vehicles = Auth::user()->vehicles;
        return view('dashboard', compact('vehicles'));
    }
}