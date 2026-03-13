<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            <span class="text-blue-600">Admin Panel:</span> {{ __('Manage Services') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message Display -->
            @if (session('status'))
                <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 font-medium shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- LEFT COLUMN: List of Services -->
                <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6">
                    <h3 class="font-bold text-lg text-gray-900 mb-4">Current Service Packages</h3>
                    
                    @if(isset($services) && $services->count() > 0)
                        <ul class="divide-y divide-gray-200">
                            @foreach($services as $service)
                                <li class="py-4 flex justify-between items-center hover:bg-gray-50 px-2 rounded-lg transition">
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $service->service_name }}</p>
                                        <p class="text-sm text-gray-500 max-w-lg">{{ $service->description }}</p>
                                        <p class="text-sm font-semibold text-blue-600 mt-1">RM {{ number_format($service->price, 2) }} &bull; <span class="text-gray-500 font-normal">{{ $service->duration_minutes }} mins</span></p>
                                    </div>
                                    
                                    <!-- FIXED: Changed 'services.destroy' to 'admin.services.destroy' -->
                                    <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" onsubmit="return confirm('Are you sure you want to delete this service?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-800 font-semibold py-2 px-4 rounded-lg text-sm transition shadow-sm">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-8 border-2 border-dashed border-gray-200 rounded-xl">
                            <p class="text-gray-500 text-sm">No services available. Add one using the form.</p>
                        </div>
                    @endif
                </div>

                <!-- RIGHT COLUMN: Add New Service Form -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6 self-start">
                    <h3 class="font-bold text-lg text-gray-900 mb-4">Add New Service</h3>
                    
                    <!-- FIXED: Changed 'services.store' to 'admin.services.store' -->
                    <form method="POST" action="{{ route('admin.services.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label for="service_name" class="block text-sm font-medium text-gray-700">Service Name</label>
                            <input type="text" name="service_name" id="service_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50" placeholder="e.g. Basic Oil Change" required>
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="2" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50" placeholder="Details about what is included..."></textarea>
                        </div>
                        
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Price (RM)</label>
                            <input type="number" step="0.01" name="price" id="price" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50" placeholder="0.00" required>
                        </div>
                        
                        <div>
                            <label for="duration_minutes" class="block text-sm font-medium text-gray-700">Duration (Minutes)</label>
                            <input type="number" name="duration_minutes" id="duration_minutes" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50" placeholder="e.g. 60" required>
                        </div>
                        
                        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition mt-2">
                            + Add Service
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>