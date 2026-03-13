<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                <span class="text-blue-600">Admin Panel:</span> {{ __('Manage Bookings') }}
            </h2>
            
            <!-- Direct Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-50 border border-red-200 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-100 hover:text-red-700 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Log Out
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Message Display -->
            @if (session('status'))
                <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 font-medium shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    
                    <!-- Title & Search/Filter Section -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
                        <div>
                            <h3 class="font-bold text-lg text-gray-900">Customer Service Requests</h3>
                            <p class="text-sm text-gray-500">View and update the status of all incoming customer vehicle repairs.</p>
                        </div>
                        
                        <!-- Search Bar & Status Filter -->
                        <div class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4 w-full md:w-auto">
                            <!-- Search Bar -->
                            <div class="relative w-full sm:w-64">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="text" id="searchInput" onkeyup="filterAdminTable(true)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 shadow-sm" placeholder="Search customer, vehicle...">
                            </div>

                            <!-- Filter Dropdown -->
                            <div class="flex items-center space-x-2 w-full sm:w-auto">
                                <span class="text-sm font-semibold text-gray-500 hidden sm:block">Filter:</span>
                                <select id="statusFilter" onchange="filterAdminTable(true)" class="block w-full sm:w-40 text-sm border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 pl-3 pr-8 bg-gray-50 font-medium text-gray-700 cursor-pointer">
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
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer Details</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Vehicle & Service</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Problem / Notes</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status Update</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white" id="adminBookingsTableBody">
                                    @foreach($bookings as $booking)
                                        <tr class="admin-booking-row hover:bg-gray-50 transition" data-status="{{ $booking->status }}">
                                            <!-- Date -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($booking->booking_date)->format('h:i A') }}</div>
                                            </td>
                                            
                                            <!-- Customer Info -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center font-bold">
                                                        {{ substr($booking->user->name, 0, 1) }}
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-semibold text-gray-900">{{ $booking->user->name }}</div>
                                                        <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Vehicle & Service -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-800">{{ $booking->vehicle->license_plate }}</div>
                                                <div class="text-xs text-gray-600">{{ $booking->vehicle->make }} {{ $booking->vehicle->model }}</div>
                                                <div class="text-xs font-semibold text-blue-600 mt-1">{{ $booking->service->service_name }}</div>
                                            </td>

                                            <!-- Notes -->
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-700 max-w-xs break-words">
                                                    <span class="font-bold text-[10px] uppercase text-gray-400 block">Customer Issue:</span>
                                                    {{ $booking->notes ? $booking->notes : 'No notes provided.' }}
                                                </div>
                                                @if($booking->mechanic_notes)
                                                <div class="mt-2 text-sm text-blue-800 max-w-xs break-words bg-blue-50 p-2 rounded-lg border-l-2 border-blue-500">
                                                    <span class="font-bold text-[10px] uppercase text-blue-600 block">Mechanic Findings:</span>
                                                    {{ $booking->mechanic_notes }}
                                                </div>
                                                @endif
                                            </td>

                                            <!-- Status Update Form (Dropdown) -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('admin.update', $booking->id) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 py-1.5 pl-3 pr-8 
                                                        {{ $booking->status === 'Scheduled' ? 'bg-yellow-50 text-yellow-800' : '' }}
                                                        {{ $booking->status === 'In Progress' ? 'bg-blue-50 text-blue-800' : '' }}
                                                        {{ $booking->status === 'Completed' ? 'bg-green-50 text-green-800' : '' }}
                                                        {{ $booking->status === 'Cancelled' ? 'bg-red-50 text-red-800' : '' }}
                                                    ">
                                                        <option value="Scheduled" {{ $booking->status == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                                                        <option value="In Progress" {{ $booking->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white p-1.5 rounded-md transition shadow-sm" title="Save Status">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                          <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- NEW: Pagination Controls -->
                        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 mt-4 rounded-xl border" id="pagination-controls" style="display: none;">
                            <div class="flex flex-1 justify-between sm:hidden">
                                <button onclick="changePage(-1)" id="prev-btn-mobile" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">Previous</button>
                                <button onclick="changePage(1)" id="next-btn-mobile" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">Next</button>
                            </div>
                            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing <span class="font-medium" id="page-start">1</span> to <span class="font-medium" id="page-end">8</span> of <span class="font-medium" id="total-items-count">{{ $bookings->count() }}</span> results
                                    </p>
                                </div>
                                <div>
                                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                        <button onclick="changePage(-1)" id="prev-btn" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed">
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

                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400 mb-3">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                            </svg>
                            <h3 class="text-gray-900 font-bold text-lg">No active requests</h3>
                            <p class="text-gray-500 mt-1">There are currently no customer bookings to manage.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Javascript to handle Smart Pagination, Search, and Status Filtering -->
    <script>
        let currentPage = 1;
        const rowsPerPage = 8;
        let filteredRows = [];

        function filterAdminTable(resetPage = true) {
            // Reset to page 1 whenever a new search or filter is applied
            if (resetPage) currentPage = 1;

            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const filterStatus = document.getElementById('statusFilter').value;
            const allRows = document.querySelectorAll('.admin-booking-row');
            
            filteredRows = []; // Clear the array of matches
            
            allRows.forEach(row => {
                const rowStatus = row.dataset.status;
                const rowText = row.innerText.toLowerCase();
                
                // Check if row matches the dropdown filter
                const matchesStatus = (filterStatus === 'All' || rowStatus === filterStatus);
                
                // Check if row matches the text search bar
                const matchesSearch = rowText.includes(searchText);
                
                // If both conditions are met, save it to our array of matching rows
                if (matchesStatus && matchesSearch) {
                    filteredRows.push(row);
                } else {
                    row.style.display = 'none'; // Hide it entirely if it doesn't match
                }
            });
            
            // Now paginate the filtered results
            updatePagination();
        }

        function updatePagination() {
            const totalItems = filteredRows.length;
            const totalPages = Math.ceil(totalItems / rowsPerPage) || 1;
            
            // Safety bounds
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;
            
            const startIdx = (currentPage - 1) * rowsPerPage;
            const endIdx = Math.min(startIdx + rowsPerPage, totalItems);
            
            // Loop through the valid matching rows and only display the ones for this specific page
            filteredRows.forEach((row, index) => {
                if (index >= startIdx && index < endIdx) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row (it's on another page)
                }
            });
            
            // Update the Pagination UI elements at the bottom
            const paginationControls = document.getElementById('pagination-controls');
            if (paginationControls) {
                if (totalItems > rowsPerPage) {
                    paginationControls.style.display = 'flex';
                    document.getElementById('page-start').innerText = startIdx + 1;
                    document.getElementById('page-end').innerText = endIdx;
                    document.getElementById('total-items-count').innerText = totalItems;
                    document.getElementById('page-indicator').innerText = `Page ${currentPage} of ${totalPages}`;
                    
                    const isFirst = currentPage === 1;
                    const isLast = currentPage === totalPages;
                    
                    // Disable prev/next buttons if at the start or end
                    document.getElementById('prev-btn').disabled = isFirst;
                    document.getElementById('next-btn').disabled = isLast;
                    document.getElementById('prev-btn-mobile').disabled = isFirst;
                    document.getElementById('next-btn-mobile').disabled = isLast;
                } else {
                    // Hide pagination completely if there are 8 or fewer items
                    paginationControls.style.display = 'none';
                }
            }
        }

        function changePage(direction) {
            currentPage += direction;
            filterAdminTable(false); // Run filter again but DON'T reset the page number
        }

        // Run the pagination and filter logic immediately when the page first loads
        document.addEventListener('DOMContentLoaded', () => {
            filterAdminTable(true);
        });
    </script>
</x-app-layout>