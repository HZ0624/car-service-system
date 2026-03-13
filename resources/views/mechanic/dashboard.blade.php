<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                🔧 {{ __('Manage Repairs') }}
            </h2>

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

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('status'))
                <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 font-medium shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg text-gray-900">Active Workshop Queue</h3>
                        <p class="text-sm text-gray-500">Update job statuses and record your findings here.</p>
                    </div>

                    @if($jobs->count() > 0)
                        <div class="overflow-x-auto bg-white rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date & Time</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Vehicle & Service</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer Issue</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-64">Repair Status & Findings</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($jobs as $job)
                                        <tr class="hover:bg-gray-50 transition">
                                            
                                            <!-- Date -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($job->booking_date)->format('d M Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($job->booking_date)->format('h:i A') }}</div>
                                            </td>

                                            <!-- Vehicle & Service -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-800">{{ $job->vehicle->license_plate }}</div>
                                                <div class="text-xs text-gray-600">{{ $job->vehicle->make }} {{ $job->vehicle->model }}</div>
                                                <div class="text-xs font-semibold text-blue-600 mt-1">{{ $job->service->service_name }}</div>
                                            </td>

                                            <!-- Customer Notes -->
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-700 max-w-xs break-words italic">
                                                    {{ $job->notes ? '"' . $job->notes . '"' : 'No issue described.' }}
                                                </div>
                                            </td>

                                            <!-- Form with Findings Dropdown -->
                                            <td class="px-6 py-4 align-top">
                                                <form action="{{ route('mechanic.update', $job->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    
                                                    <!-- Dropdown & Save Button -->
                                                    <div class="flex items-center space-x-2">
                                                        <select name="status" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 py-1.5 pl-3 pr-8 
                                                            {{ $job->status === 'Scheduled' ? 'bg-yellow-50 text-yellow-800' : '' }}
                                                            {{ $job->status === 'In Progress' ? 'bg-blue-50 text-blue-800' : '' }}
                                                        ">
                                                            <option value="Scheduled" {{ $job->status == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                                                            <option value="In Progress" {{ $job->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                            <option value="Completed">Completed</option>
                                                        </select>
                                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-1.5 rounded-md transition shadow-sm" title="Save Status">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <!-- Clickable Toggle Button for Findings -->
                                                    <button type="button" onclick="toggleNotes('{{ $job->id }}')" class="mt-2 text-[11px] font-bold text-blue-600 hover:text-blue-800 flex items-center transition uppercase tracking-wider">
                                                        <svg id="icon-plus-{{ $job->id }}" style="{{ $job->mechanic_notes ? 'display: none;' : '' }}" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                                        <svg id="icon-minus-{{ $job->id }}" style="{{ $job->mechanic_notes ? '' : 'display: none;' }}" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                                                        <span id="text-toggle-{{ $job->id }}">{{ $job->mechanic_notes ? 'Edit Findings' : '+ Add Findings' }}</span>
                                                    </button>
                                                    
                                                    <!-- Expandable Textarea -->
                                                    <div id="notes-{{ $job->id }}" style="{{ $job->mechanic_notes ? '' : 'display: none;' }}" class="mt-2 w-full min-w-[220px]">
                                                        <textarea name="mechanic_notes" rows="3" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2" placeholder="Write findings here...">{{ $job->mechanic_notes }}</textarea>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            <div class="text-4xl mb-4 text-gray-300">🔧</div>
                            <h3 class="text-gray-900 font-bold text-lg">No active jobs in queue</h3>
                            <p class="text-gray-500 mt-1">All caught up! Check back later for new bookings.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Javascript added to handle the Add Findings click! -->
    <script>
        function toggleNotes(jobId) {
            const notesDiv = document.getElementById('notes-' + jobId);
            const iconPlus = document.getElementById('icon-plus-' + jobId);
            const iconMinus = document.getElementById('icon-minus-' + jobId);
            const textToggle = document.getElementById('text-toggle-' + jobId);
            
            if (notesDiv.style.display === 'none' || notesDiv.style.display === '') {
                notesDiv.style.display = 'block';
                iconPlus.style.display = 'none';
                iconMinus.style.display = 'block';
                textToggle.innerText = 'Hide Findings';
            } else {
                notesDiv.style.display = 'none';
                iconPlus.style.display = 'block';
                iconMinus.style.display = 'none';
                
                // If text exists, show 'Edit', otherwise '+ Add'
                const textarea = notesDiv.querySelector('textarea');
                textToggle.innerText = textarea.value.trim() !== '' ? 'Edit Findings' : '+ Add Findings';
            }
        }
    </script>
</x-app-layout>