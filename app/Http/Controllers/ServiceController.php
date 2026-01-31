<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of services and the form to add one.
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services', compact('services'));
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:15',
        ]);

        Service::create($validated);

        return redirect()->back()->with('status', 'New Service Package Created!');
    }

    /**
     * Delete a service.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('status', 'Service deleted successfully.');
    }
}
