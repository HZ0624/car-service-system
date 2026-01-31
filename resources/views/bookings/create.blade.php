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
                            <select id="vehicle_id" name="vehicle_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->license_plate }} - {{ $vehicle->model }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select Service -->
                        <div class="mt-4">
                            <x-input-label for="service_id" :value="__('Select Service Package')" />
                            <select id="service_id" name="service_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }} (RM {{ $service->price }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mt-4">
                            <x-input-label for="booking_date" :value="__('Preferred Date')" />
                            <x-text-input id="booking_date" class="block mt-1 w-full" type="datetime-local" name="booking_date" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Confirm Booking') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
