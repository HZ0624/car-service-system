<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('My Vehicles') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Success Message Display -->
            @if (session('status'))
                <div class="bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                    <div class="flex">
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were some problems with your submission</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TOP SECTION: Register Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Register a New Vehicle</h3>
                        <p class="text-sm text-gray-500">Enter your car details to easily book services later.</p>
                    </div>

                    <form method="POST" action="{{ route('vehicles.store') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="license_plate" class="block text-sm font-medium text-gray-700">License Plate Number</label>
                                <input type="text" name="license_plate" id="license_plate" value="{{ old('license_plate') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 bg-gray-50 text-gray-900 uppercase" placeholder="e.g. ABC 1234" required>
                            </div>
                            <div>
                                <label for="make" class="block text-sm font-medium text-gray-700">Car Brand</label>
                                <input type="text" name="make" id="make" value="{{ old('make') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 bg-gray-50 text-gray-900" placeholder="e.g. Honda, Toyota, Proton" required>
                            </div>
                            <div>
                                <label for="model" class="block text-sm font-medium text-gray-700">Car Model</label>
                                <input type="text" name="model" id="model" value="{{ old('model') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 bg-gray-50 text-gray-900" placeholder="e.g. Civic, Myvi, X50" required>
                            </div>
                            <div>
                                <label for="year" class="block text-sm font-medium text-gray-700">Manufacturing Year</label>
                                <input type="number" name="year" id="year" value="{{ old('year') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 bg-gray-50 text-gray-900" placeholder="e.g. 2018" min="1990" max="{{ date('Y') + 1 }}" required>
                            </div>
                            <div>
                                <label for="mileage" class="block text-sm font-medium text-gray-700">Current Mileage (km)</label>
                                <input type="number" name="mileage" id="mileage" value="{{ old('mileage') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-3 bg-gray-50 text-gray-900" placeholder="e.g. 45000">
                            </div>
                        </div>

                        <div class="mt-8 pt-5 border-t border-gray-100 flex items-center justify-end space-x-4">
                            <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                Save Vehicle
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- BOTTOM SECTION: Registered Vehicles Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg text-gray-900">My Registered Vehicles</h3>
                    </div>

                    @if($vehicles->count() > 0)
                        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">License Plate</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Make & Model</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Year</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mileage</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white" id="vehicle-table-body">
                                    @foreach($vehicles as $index => $vehicle)
                                        @php $pageNumber = floor($index / 5) + 1; @endphp
                                        <tr class="vehicle-row hover:bg-gray-50 transition" data-page="{{ $pageNumber }}" style="{{ $pageNumber > 1 ? 'display: none;' : '' }}">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="inline-flex items-center px-3 py-1 rounded-md bg-gray-100 border border-gray-300 text-sm font-bold text-gray-800 uppercase tracking-wide">
                                                    {{ $vehicle->license_plate }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $vehicle->make }}</div>
                                                <div class="text-sm text-gray-500">{{ $vehicle->model }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-700">{{ $vehicle->year }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-700">
                                                    {{ $vehicle->mileage ? number_format($vehicle->mileage) . ' km' : 'Not specified' }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Controls -->
                        @if($vehicles->count() > 5)
                            <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 mt-4 rounded-xl border">
                                <div class="flex flex-1 justify-between sm:hidden">
                                    <button onclick="changePage(-1)" id="prev-btn-mobile" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" disabled>Previous</button>
                                    <button onclick="changePage(1)" id="next-btn-mobile" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">Next</button>
                                </div>
                                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700">
                                            Showing <span class="font-medium" id="page-start">1</span> to <span class="font-medium" id="page-end">5</span> of <span class="font-medium">{{ $vehicles->count() }}</span> vehicles
                                        </p>
                                    </div>
                                    <div>
                                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                            <button onclick="changePage(-1)" id="prev-btn" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                                <span class="sr-only">Previous</span>
                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>
                                            </button>
                                            <span id="page-indicator" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0 bg-gray-50">Page 1</span>
                                            <button onclick="changePage(1)" id="next-btn" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed">
                                                <span class="sr-only">Next</span>
                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>
                                            </button>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                            <script>
                                let currentPage = 1;
                                const totalPages = {{ ceil($vehicles->count() / 5) }};
                                const totalItems = {{ $vehicles->count() }};

                                function changePage(direction) {
                                    currentPage += direction;
                                    
                                    if (currentPage < 1) currentPage = 1;
                                    if (currentPage > totalPages) currentPage = totalPages;

                                    document.querySelectorAll('.vehicle-row').forEach(row => {
                                        row.style.display = 'none';
                                    });

                                    document.querySelectorAll(`.vehicle-row[data-page="${currentPage}"]`).forEach(row => {
                                        row.style.display = '';
                                    });

                                    const isFirst = currentPage === 1;
                                    const isLast = currentPage === totalPages;
                                    
                                    document.getElementById('prev-btn').disabled = isFirst;
                                    document.getElementById('next-btn').disabled = isLast;
                                    document.getElementById('prev-btn-mobile').disabled = isFirst;
                                    document.getElementById('next-btn-mobile').disabled = isLast;

                                    const start = (currentPage - 1) * 5 + 1;
                                    const end = Math.min(currentPage * 5, totalItems);
                                    
                                    document.getElementById('page-start').innerText = start;
                                    document.getElementById('page-end').innerText = end;
                                    document.getElementById('page-indicator').innerText = 'Page ' + currentPage;
                                }
                            </script>
                        @endif

                    @else
                        <div class="text-center py-8 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400 mb-3">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                            <h3 class="text-gray-900 font-bold text-lg">No vehicles registered yet</h3>
                            <p class="text-gray-500 mt-1">Add your first vehicle using the form above.</p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>