<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Vehicle Status') }}
            </h2>
            <a href="{{ route('bookings.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                + Book a Service
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success/Error Message Display -->
            @if (session('status'))
                <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 font-medium shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">Service History & Status</h3>
                            <p class="text-sm text-gray-500">Track the progress of your vehicle repairs.</p>
                        </div>
                        
                        <!-- FILTER DROPDOWN -->
                        <div class="mt-4 sm:mt-0">
                            <label for="statusFilter" class="sr-only">Filter by Status</label>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-semibold text-gray-500">Filter:</span>
                                <select id="statusFilter" onchange="filterTable()" class="block w-48 text-sm border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 pl-3 pr-10 bg-gray-50 font-medium text-gray-700 cursor-pointer">
                                    <option value="All">All Statuses</option>
                                    <option value="Scheduled">Scheduled</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @if($bookings->count() > 0)
                        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date & Time</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Vehicle</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Service Package</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-64">Status & Findings</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white" id="bookingsTableBody">
                                    @foreach($bookings as $booking)
                                        <!-- Note the 'data-status' tag added here so JavaScript can read it -->
                                        <tr class="booking-row hover:bg-gray-50 transition" data-status="{{ $booking->status }}">
                                            
                                            <!-- Date -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($booking->booking_date)->format('h:i A') }}</div>
                                            </td>

                                            <!-- Vehicle -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-800">{{ $booking->vehicle->license_plate }}</div>
                                                <div class="text-xs text-gray-600">{{ $booking->vehicle->make }} {{ $booking->vehicle->model }}</div>
                                            </td>

                                            <!-- Service -->
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $booking->service->service_name }}
                                            </td>

                                            <!-- Status & Findings -->
                                            <td class="px-6 py-4">
                                                <div class="mb-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold shadow-sm border
                                                        {{ $booking->status === 'Scheduled' ? 'bg-yellow-50 text-yellow-800 border-yellow-200' : '' }}
                                                        {{ $booking->status === 'In Progress' ? 'bg-blue-50 text-blue-800 border-blue-200' : '' }}
                                                        {{ $booking->status === 'Completed' ? 'bg-green-50 text-green-800 border-green-200' : '' }}
                                                        {{ $booking->status === 'Cancelled' ? 'bg-red-50 text-red-800 border-red-200' : '' }}">
                                                        {{ $booking->status }}
                                                    </span>
                                                </div>
                                                
                                                @if($booking->mechanic_notes)
                                                <div class="mt-2 text-xs text-gray-700 bg-gray-50 p-2 rounded border-l-2 border-blue-400 italic">
                                                    <span class="font-bold text-blue-600 block not-italic mb-0.5">Mechanic Update:</span>
                                                    {{ $booking->mechanic_notes }}
                                                </div>
                                                @elseif($booking->status !== 'Completed' && $booking->status !== 'Cancelled')
                                                <div class="mt-2 text-[11px] text-gray-400 italic">
                                                    Waiting for mechanic update...
                                                </div>
                                                @endif
                                            </td>

                                            <!-- Price -->
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700 text-right">
                                                RM {{ number_format($booking->total_price, 2) }}
                                            </td>

                                            <!-- Actions Column (Cancel Button) -->
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                @if($booking->status === 'Scheduled')
                                                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.');">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="cancel" value="1">
                                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md transition font-bold border border-red-200 shadow-sm">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-300">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            <div class="text-4xl mb-4 text-gray-300">📋</div>
                            <h3 class="text-gray-900 font-bold text-lg">No bookings found</h3>
                            <p class="text-gray-500 mt-1">You haven't booked any services yet.</p>
                            <a href="{{ route('bookings.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition shadow-sm">
                                Book Now
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Javascript added to handle the Filter logic -->
    <script>
        function filterTable() {
            const filter = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('.booking-row');
            
            rows.forEach(row => {
                // If the filter is 'All' OR the row's data-status matches the dropdown value
                if (filter === 'All' || row.dataset.status === filter) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        }
    </script>
</x-app-layout>