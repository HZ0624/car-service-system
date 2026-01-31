<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Message Notification -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Card 1: My Vehicles -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-2">🚗 My Vehicles</h3>
                        <p class="text-gray-600 mb-4">Manage your cars or add a new one.</p>
                        <a href="{{ route('vehicles.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Add Vehicle
                        </a>
                    </div>
                </div>

                <!-- Card 2: Book Service -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-2">📅 Book Service</h3>
                        <p class="text-gray-600 mb-4">Schedule a new appointment.</p>
                        <a href="{{ route('bookings.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Book Now
                        </a>
                    </div>
                </div>

                <!-- Card 3: History -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-2">📜 Service History</h3>
                        <p class="text-gray-600 mb-4">View past records and status.</p>
                        <a href="{{ route('bookings.index') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            View History
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>