<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::user()->role == 1 ? route('dashboard') : (Auth::user()->role == 2 ? route('admin.bookings') : route('mechanic.dashboard')) }}" class="flex items-center text-2xl font-bold text-blue-700 tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        AutoCare
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    
                    <!-- ADMIN LINKS (Role 2) -->
                    @if(Auth::user()->role == 2)
                        <x-nav-link :href="route('admin.bookings')" :active="request()->routeIs('admin.bookings')" class="text-base font-medium">
                            {{ __('Manage Bookings') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')" class="text-base font-medium">
                            {{ __('Manage Services') }}
                        </x-nav-link>
                        <!-- NEW: Manage Customers Link for Admin -->
                        <x-nav-link :href="route('admin.customers.index')" :active="request()->routeIs('admin.customers.*')" class="text-base font-medium">
                            {{ __('Manage Customers') }}
                        </x-nav-link>
                        
                    <!-- MECHANIC LINKS (Role 3) -->
                    @elseif(Auth::user()->role == 3)
                        <x-nav-link :href="route('mechanic.dashboard')" :active="request()->routeIs('mechanic.dashboard')" class="text-base font-medium">
                            {{ __('Manage Repairs') }}
                        </x-nav-link>
                        <x-nav-link :href="route('mechanic.history')" :active="request()->routeIs('mechanic.history')" class="text-base font-medium">
                            {{ __('Service History') }}
                        </x-nav-link>
                        
                    <!-- CUSTOMER LINKS (Role 1) -->
                    @else
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-base font-medium">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('vehicles.create')" :active="request()->routeIs('vehicles.*')" class="text-base font-medium">
                            {{ __('My Vehicles') }}
                        </x-nav-link>
                        <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')" class="text-base font-medium">
                            {{ __('My Vehicle Status') }}
                        </x-nav-link>
                    @endif

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:text-blue-600 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center font-bold text-base border border-blue-200">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col items-start">
                                    <span class="font-bold text-gray-800 text-sm leading-tight">{{ Auth::user()->name }}</span>
                                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">
                                        {{ Auth::user()->role == 2 ? 'Admin' : (Auth::user()->role == 3 ? 'Mechanic' : 'Customer') }}
                                    </span>
                                </div>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:bg-red-50">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile Menu) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role == 2)
                <x-responsive-nav-link :href="route('admin.bookings')" :active="request()->routeIs('admin.bookings')">
                    {{ __('Manage Bookings') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                    {{ __('Manage Services') }}
                </x-responsive-nav-link>
                <!-- NEW: Manage Customers Link for Admin (Mobile) -->
                <x-responsive-nav-link :href="route('admin.customers.index')" :active="request()->routeIs('admin.customers.*')">
                    {{ __('Manage Customers') }}
                </x-responsive-nav-link>
                
            @elseif(Auth::user()->role == 3)
                <x-responsive-nav-link :href="route('mechanic.dashboard')" :active="request()->routeIs('mechanic.dashboard')">
                    {{ __('Manage Repairs') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('mechanic.history')" :active="request()->routeIs('mechanic.history')">
                    {{ __('Service History') }}
                </x-responsive-nav-link>
                
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('vehicles.create')" :active="request()->routeIs('vehicles.*')">
                    {{ __('My Vehicles') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                    {{ __('My Vehicle Status') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>