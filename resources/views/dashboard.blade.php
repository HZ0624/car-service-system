<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Welcome back, ') }} <span class="text-blue-600">{{ Auth::user()->name }}!</span>
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

    <!-- Professional 5-Image EDGE-TO-EDGE Hero Slideshow -->
    <div class="relative w-full h-[50vh] md:h-[60vh] min-h-[400px] overflow-hidden shadow-xl group bg-gray-900">
        
        <!-- Slide 1: Premium Car -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100 z-10">
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-60" alt="Premium Car Care">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/50 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">Premium AutoCare</span>
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 uppercase tracking-tight leading-tight text-white">The Best <br>Gets Better</h2>
                        <p class="text-lg text-gray-300 mb-8 max-w-lg">Experience unparalleled service and diagnostic precision for your vehicle. Book your next appointment today.</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('bookings.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg">Book a Service</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2: Mechanic Working -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-60" alt="Expert Mechanics">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/50 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">Trusted Professionals</span>
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 uppercase tracking-tight leading-tight text-white">Expert Mechanics<br>You Can Trust</h2>
                        <p class="text-lg text-gray-300 mb-8 max-w-lg">Our certified technicians treat every car like it's their own, ensuring safety and performance on every drive.</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('vehicles.create') }}" class="bg-white text-gray-900 hover:bg-gray-100 font-bold py-3 px-8 rounded-lg transition shadow-lg">Register Vehicle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3: Clean Detailing/Bodywork -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="https://images.unsplash.com/photo-1601362840469-51e4d8d58785?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-60" alt="Body and Paint">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/50 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">Detailing & Polish</span>
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 uppercase tracking-tight leading-tight text-white">Showroom<br>Shine</h2>
                        <p class="text-lg text-gray-300 mb-8 max-w-lg">From minor scratch removals to full premium detailing, we restore your vehicle's aesthetic perfection.</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('bookings.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg">View Services</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 4: Wheel and Brakes -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="https://images.unsplash.com/photo-1580274455191-1c62238fa333?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-60" alt="Genuine Parts">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/50 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">Quality Guaranteed</span>
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 uppercase tracking-tight leading-tight text-white">Genuine Parts<br>Last Longer</h2>
                        <p class="text-lg text-gray-300 mb-8 max-w-lg">We only use OEM and premium aftermarket components to ensure maximum safety and durability on the road.</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('bookings.create') }}" class="bg-white text-gray-900 hover:bg-gray-100 font-bold py-3 px-8 rounded-lg transition shadow-lg">Book Maintenance</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 5: Professional Workshop -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="https://images.unsplash.com/photo-1599256621730-535171e28e50?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-60" alt="Transparent Service">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/50 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">Live Updates</span>
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 uppercase tracking-tight leading-tight text-white">Track Every<br>Repair</h2>
                        <p class="text-lg text-gray-300 mb-8 max-w-lg">Stay updated with live status changes and read detailed mechanic findings directly from your dashboard.</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('bookings.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg">Check Vehicle Status</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide Navigation Arrows -->
        <button id="prev-slide" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-white/10 hover:bg-white/30 text-white p-2 rounded-full backdrop-blur-sm transition opacity-0 group-hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
        </button>
        <button id="next-slide" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-white/10 hover:bg-white/30 text-white p-2 rounded-full backdrop-blur-sm transition opacity-0 group-hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        </button>

        <!-- Slide Indicators (Dots) -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex space-x-2">
            <button class="slide-dot w-2.5 h-2.5 rounded-full bg-white transition-all"></button>
            <button class="slide-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all"></button>
            <button class="slide-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all"></button>
            <button class="slide-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all"></button>
            <button class="slide-dot w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all"></button>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success Message Display -->
            @if (session('status'))
                <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 font-medium">
                    {{ session('status') }}
                </div>
            @endif
            
            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Book a Service Card -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl shadow-sm p-6 text-white col-span-1 md:col-span-3 lg:col-span-1 flex flex-col justify-between h-full transform transition hover:-translate-y-1 hover:shadow-lg">
                    <div>
                        <div class="bg-blue-500/30 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Book a Service</h3>
                        <p class="text-blue-100 text-sm mb-6">Schedule your next maintenance or repair appointment instantly.</p>
                    </div>
                    <a href="{{ route('bookings.create') ?? '#' }}" class="block text-center w-full bg-white text-blue-700 font-bold py-3 px-4 rounded-xl hover:bg-gray-50 transition shadow-sm">
                        Start Booking &rarr;
                    </a>
                </div>

                <!-- My Vehicles Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col h-full hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-100 text-green-600 w-10 h-10 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">My Vehicles</h3>
                        </div>
                        <span class="text-2xl font-black text-gray-800">{{ $vehicles->count() }}</span>
                    </div>
                    
                    <div class="flex-grow flex flex-col mb-4 overflow-hidden">
                        @if($vehicles->count() > 0)
                            <div class="space-y-3 mt-2 overflow-y-auto max-h-56 pr-2">
                                @foreach($vehicles as $vehicle)
                                    <div class="bg-gray-50 border border-gray-100 rounded-lg p-3 flex justify-between items-center">
                                        <div>
                                            <p class="font-bold text-gray-800">{{ $vehicle->license_plate }}</p>
                                            <p class="text-xs text-gray-500">{{ $vehicle->make }} {{ $vehicle->model }} ({{ $vehicle->year }})</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">You haven't registered any vehicles yet. Add a vehicle to easily book services.</p>
                        @endif
                    </div>
                    
                    <a href="{{ route('vehicles.create') }}" class="text-blue-600 text-sm font-semibold hover:text-blue-800 border-t border-gray-100 pt-4 text-left flex items-center w-full mt-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                        Manage Vehicles &rarr;
                    </a>
                </div>

                <!-- Upcoming Bookings Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col h-full hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-purple-100 text-purple-600 w-10 h-10 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Upcoming</h3>
                        </div>
                        <span class="text-2xl font-black text-gray-800">{{ $upcomingBookings->count() }}</span>
                    </div>
                    
                    <div class="flex-grow flex flex-col mb-4 overflow-hidden">
                        @if($upcomingBookings->count() > 0)
                            <div class="space-y-3 mt-2 overflow-y-auto max-h-56 pr-2">
                                @foreach($upcomingBookings as $booking)
                                    <div class="bg-gray-50 border border-gray-100 rounded-lg p-3 flex justify-between items-center">
                                        <div>
                                            <p class="font-bold text-gray-800 text-sm">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y, h:i A') }}</p>
                                            <p class="text-xs text-gray-500">{{ $booking->service->service_name }} ({{ $booking->vehicle->license_plate }})</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-bold rounded-full shadow-sm
                                            {{ $booking->status === 'Scheduled' ? 'bg-yellow-50 text-yellow-800 border border-yellow-200' : '' }}
                                            {{ $booking->status === 'In Progress' ? 'bg-blue-50 text-blue-800 border border-blue-200' : '' }}
                                            {{ $booking->status === 'Completed' ? 'bg-green-50 text-green-800 border border-green-200' : '' }}
                                            {{ $booking->status === 'Cancelled' ? 'bg-red-50 text-red-800 border border-red-200' : '' }}">
                                            {{ $booking->status }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">You have no upcoming service appointments scheduled.</p>
                        @endif
                    </div>
                    
                    <a href="{{ route('bookings.index') ?? '#' }}" class="text-gray-600 text-sm font-semibold hover:text-gray-800 border-t border-gray-100 pt-4 text-left flex items-center w-full mt-auto">
                        View Past History &rarr;
                    </a>
                </div>

            </div>
            
            <!-- BOTTOM SECTION: Professional Items (Promotions & Tips) -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Current Promotions -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition duration-200">
                    <div class="flex items-center mb-6">
                        <div class="bg-yellow-100 text-yellow-600 w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Current Promotions</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-yellow-50 border border-yellow-100 p-4 rounded-xl flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-yellow-800">10% Off Major Services</h4>
                                <p class="text-xs text-yellow-600 mt-1">Valid until the end of the month. Use code <span class="font-mono font-bold">MAJOR10</span></p>
                            </div>
                            <span class="bg-yellow-200 text-yellow-800 text-xs font-bold px-2 py-1 rounded-md">PROMO</span>
                        </div>
                        <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-blue-800">Free Aircon Inspection</h4>
                                <p class="text-xs text-blue-600 mt-1">Included free with every Basic Oil Change scheduled this week.</p>
                            </div>
                            <span class="bg-blue-200 text-blue-800 text-xs font-bold px-2 py-1 rounded-md">NEW</span>
                        </div>
                    </div>
                </div>

                <!-- Maintenance Tips -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition duration-200">
                    <div class="flex items-center mb-6">
                        <div class="bg-indigo-100 text-indigo-600 w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.82 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.496 1.509 1.333 1.509 2.316V18" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">AutoCare Tips</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800">Check Your Tire Pressure</h4>
                                <p class="text-xs text-gray-500 mt-1">Maintaining correct tire pressure improves gas mileage and extends tire life.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800">Don't Ignore Warning Lights</h4>
                                <p class="text-xs text-gray-500 mt-1">A flashing check engine light means you need to stop driving immediately to prevent damage.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800">Replace Wipers Annually</h4>
                                <p class="text-xs text-gray-500 mt-1">Good visibility is crucial for safety. Ensure your wiper blades aren't streaking.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
            </div>

        </div>
    </div>

    <!-- Script to handle the auto-playing Hero Slideshow with Dot Navigation -->
    <script>
        (function() {
            let currentSlide = 0;
            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.slide-dot');
            const totalSlides = slides.length;

            if (totalSlides === 0) return;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.classList.remove('opacity-0', 'z-0');
                        slide.classList.add('opacity-100', 'z-10');
                        dots[i].classList.replace('bg-white/40', 'bg-white');
                    } else {
                        slide.classList.remove('opacity-100', 'z-10');
                        slide.classList.add('opacity-0', 'z-0');
                        dots[i].classList.replace('bg-white', 'bg-white/40');
                    }
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(currentSlide);
            }

            // Automatically switch slides every 5.5 seconds
            let slideInterval = setInterval(nextSlide, 5500);

            function resetTimer() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5500);
            }

            // Navigate using arrows
            document.getElementById('next-slide').addEventListener('click', () => {
                nextSlide();
                resetTimer();
            });

            document.getElementById('prev-slide').addEventListener('click', () => {
                prevSlide();
                resetTimer();
            });

            // Navigate using dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                    resetTimer();
                });
            });
            
            // Force the first slide to show immediately
            showSlide(0);
        })();
    </script>
</x-app-layout>