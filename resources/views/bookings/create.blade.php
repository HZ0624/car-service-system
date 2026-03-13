<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book a Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf

                        <!-- Select Vehicle -->
                        <div>
                            <x-input-label for="vehicle_id" :value="__('Select Vehicle')" />
                            <select id="vehicle_id" name="vehicle_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="" disabled selected>-- Choose your vehicle --</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->license_plate }} - {{ $vehicle->model }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select Service -->
                        <div class="mt-4">
                            <x-input-label for="service_id" :value="__('Select Service Package')" />
                            <select id="service_id" name="service_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="" disabled selected>-- Choose a service package --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }} (RM {{ $service->price }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mt-4">
                            <x-input-label for="booking_date" :value="__('Preferred Date')" />
                            <!-- ADDED min attribute to prevent selecting past dates -->
                            <x-text-input id="booking_date" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500" type="datetime-local" name="booking_date" min="{{ now()->format('Y-m-d\TH:i') }}" required />
                        </div>

                        <!-- Problem Description (Optional) -->
                        <div class="mt-4">
                            <x-input-label for="notes" :value="__('Describe your problem (Optional)')" />
                            <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="e.g., My car makes a weird noise when braking, or I need my aircon checked..."></textarea>
                            <p class="text-sm text-gray-500 mt-1">Feel free to leave this blank if you are just coming in for a standard service.</p>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Confirm Booking') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>