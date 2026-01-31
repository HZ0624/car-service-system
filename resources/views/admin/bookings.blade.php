<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard - All Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold mb-4">Manage Appointments</h3>
                    
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Date</th>
                                <th class="py-3 px-6 text-left">Customer</th>
                                <th class="py-3 px-6 text-left">Vehicle</th>
                                <th class="py-3 px-6 text-left">Service</th>
                                <th class="py-3 px-6 text-center">Current Status</th>
                                <th class="py-3 px-6 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($bookings as $booking)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        {{ $booking->booking_date }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $booking->customer->name }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $booking->vehicle->license_plate }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $booking->service->service_name }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <!-- Form to Mark as Completed -->
                                        <form method="POST" action="{{ route('admin.update', $booking->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Completed">
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                Mark Complete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>