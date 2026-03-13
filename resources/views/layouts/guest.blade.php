<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AutoCare') }} - Authentication</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased selection:bg-blue-500 selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blue-900 relative">
            
            <!-- Premium Background Pattern/Image -->
            <div class="absolute inset-0 opacity-20">
                <img src="https://images.unsplash.com/photo-1613214149922-f1809c99b414?q=80&w=2070&auto=format&fit=crop" alt="Background" class="w-full h-full object-cover" />
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-blue-900/80 to-blue-900"></div>

            <!-- Login/Register Card -->
            <div class="relative z-10 w-full sm:max-w-md mt-6 px-10 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border border-gray-100">
                
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <a href="/" class="flex items-center text-3xl font-bold text-blue-700 tracking-wider hover:opacity-80 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 inline-block mr-2 -mt-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        AutoCare
                    </a>
                </div>
                
                <!-- Page Content (Form goes here) -->
                {{ $slot }}

            </div>
            
            <div class="relative z-10 text-blue-200 mt-8 text-sm">
                &copy; {{ date('Y') }} AutoCare System. All rights reserved.
            </div>
        </div>
    </body>
</html>