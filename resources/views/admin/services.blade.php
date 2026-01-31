<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Service Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notification -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- LEFT COLUMN: List of Services -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Current Services</h3>
                    <ul class="divide-y divide-gray-200">
                        @foreach($services as $service)
                            <li class="py-4 flex justify-between items-center">
                                <div>
                                    <p class="font-medium">{{ $service->service_name }}</p>
                                    <p class="text-sm text-gray-500">RM {{ $service->price }} ({{ $service->duration_minutes }} mins)</p>
                                </div>
                                <form method="POST" action="{{ route('services.destroy', $service->id) }}" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- RIGHT COLUMN: Add New Service -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Add New Service</h3>
                    <form method="POST" action="{{ route('services.store') }}">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="service_name" :value="__('Service Name')" />
                            <x-text-input id="service_name" class="block mt-1 w-full" type="text" name="service_name" required />
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <x-input-label for="price" :value="__('Price (RM)')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" required />
                        </div>

                        <!-- Duration -->
                        <div class="mb-4">
                            <x-input-label for="duration_minutes" :value="__('Duration (Minutes)')" />
                            <x-text-input id="duration_minutes" class="block mt-1 w-full" type="number" name="duration_minutes" required />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description (Optional)')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>

                        <x-primary-button>
                            {{ __('Add Service') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>