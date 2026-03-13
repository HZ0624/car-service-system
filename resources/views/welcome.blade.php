<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AutoCare - Car Service Booking System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts (Loads Tailwind CSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-sans selection:bg-blue-500 selection:text-white">
    
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm absolute w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <!-- Logo Text -->
                    <span class="text-2xl font-bold text-blue-700 tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline-block mr-2 -mt-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        AutoCare
                    </span>
                </div>
                
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-blue-600 transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150 shadow-md">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Professional 5-Image EDGE-TO-EDGE Hero Slideshow -->
    <div class="relative w-full h-[70vh] md:h-[85vh] min-h-[600px] overflow-hidden shadow-xl group bg-gray-900 mt-20">
        
        <!-- Slide 1: Premium Car -->
        <div class="welcome-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100 z-10">
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-50" alt="Premium Car Care">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/40 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-left">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">Premium AutoCare</span>
                        <h2 class="text-5xl md:text-6xl lg:text-7xl font-black mb-4 tracking-tight leading-tight text-white">
                            Premium Service <br><span class="text-blue-500">At Your Fingertips</span>
                        </h2>
                        <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-lg leading-relaxed">
                            Book your next vehicle maintenance, repair, or inspection online with ease. Trusted mechanics and transparent pricing.
                        </p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Go to Dashboard</a>
                            @else
                                <a href="{{ route('register') }}" class="text-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Book an Appointment</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2: Mechanic Working -->
        <div class="welcome-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-50" alt="Expert Mechanics">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/40 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-left">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">Trusted Professionals</span>
                        <h2 class="text-5xl md:text-6xl lg:text-7xl font-black mb-4 tracking-tight leading-tight text-white">
                            Expert Mechanics <br><span class="text-blue-500">You Can Trust</span>
                        </h2>
                        <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-lg leading-relaxed">
                            Our certified technicians treat every car like it's their own, ensuring absolute safety and peak performance on every drive.
                        </p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Go to Dashboard</a>
                            @else
                                <a href="{{ route('register') }}" class="text-center bg-white text-blue-900 hover:bg-gray-100 font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Get Started Today</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3: Clean Detailing/Bodywork -->
        <div class="welcome-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="https://images.unsplash.com/photo-1601362840469-51e4d8d58785?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-50" alt="Body and Paint">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/40 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-left">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">Detailing & Polish</span>
                        <h2 class="text-5xl md:text-6xl lg:text-7xl font-black mb-4 tracking-tight leading-tight text-white">
                            Restore The <br><span class="text-blue-500">Showroom Shine</span>
                        </h2>
                        <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-lg leading-relaxed">
                            From minor scratch removals to full premium detailing, we restore your vehicle's aesthetic perfection inside and out.
                        </p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Go to Dashboard</a>
                            @else
                                <a href="{{ route('register') }}" class="text-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Book Detailing</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 4: Wheel and Brakes -->
        <div class="welcome-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="https://images.unsplash.com/photo-1580274455191-1c62238fa333?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-50" alt="Genuine Parts">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/40 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-left">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">Quality Guaranteed</span>
                        <h2 class="text-5xl md:text-6xl lg:text-7xl font-black mb-4 tracking-tight leading-tight text-white">
                            Genuine Parts <br><span class="text-blue-500">Last Longer</span>
                        </h2>
                        <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-lg leading-relaxed">
                            We only use OEM and premium aftermarket components to ensure maximum safety and reliability on the road.
                        </p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Go to Dashboard</a>
                            @else
                                <a href="{{ route('register') }}" class="text-center bg-white text-blue-900 hover:bg-gray-100 font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Register Now</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 5: Professional Workshop -->
        <div class="welcome-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="https://images.unsplash.com/photo-1599256621730-535171e28e50?q=80&w=2070&auto=format&fit=crop" class="object-cover w-full h-full opacity-50" alt="Transparent Service">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/40 to-transparent flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-left">
                    <div class="max-w-2xl">
                        <span class="text-blue-400 font-bold tracking-wider uppercase text-sm mb-2 block">100% Transparent</span>
                        <h2 class="text-5xl md:text-6xl lg:text-7xl font-black mb-4 tracking-tight leading-tight text-white">
                            Track Every <br><span class="text-blue-500">Single Repair</span>
                        </h2>
                        <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-lg leading-relaxed">
                            Stay updated with live status changes and read detailed mechanic findings directly from your personal dashboard.
                        </p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Go to Dashboard</a>
                            @else
                                <a href="{{ route('register') }}" class="text-center bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-full transition shadow-lg text-lg">Experience It Today</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide Navigation Arrows -->
        <button id="welcome-prev-slide" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-white/10 hover:bg-white/30 text-white p-3 rounded-full backdrop-blur-sm transition opacity-0 group-hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
        </button>
        <button id="welcome-next-slide" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-white/10 hover:bg-white/30 text-white p-3 rounded-full backdrop-blur-sm transition opacity-0 group-hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        </button>

        <!-- Slide Indicators (Dots) -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex space-x-3">
            <button class="welcome-dot w-3 h-3 rounded-full bg-white transition-all"></button>
            <button class="welcome-dot w-3 h-3 rounded-full bg-white/40 hover:bg-white/70 transition-all"></button>
            <button class="welcome-dot w-3 h-3 rounded-full bg-white/40 hover:bg-white/70 transition-all"></button>
            <button class="welcome-dot w-3 h-3 rounded-full bg-white/40 hover:bg-white/70 transition-all"></button>
            <button class="welcome-dot w-3 h-3 rounded-full bg-white/40 hover:bg-white/70 transition-all"></button>
        </div>
    </div>

    <!-- Services Feature Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Our Services</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Everything your car needs
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Service 1 -->
                <div class="bg-gray-50 rounded-xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-600 group-hover:text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.681-4.682a2.652 2.652 0 003.75-3.75l-4.681 4.682m9.126 3.784L21 17.25m-9.58-14.492a2.652 2.652 0 00-3.75 3.75l4.681-4.682z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">General Service</h3>
                    <p class="text-gray-600 leading-relaxed">Regular maintenance including oil changes, filter replacements, and fluid top-ups to keep your engine running smoothly.</p>
                </div>

                <!-- Service 2 -->
                <div class="bg-gray-50 rounded-xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-600 group-hover:text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Engine Diagnostics</h3>
                    <p class="text-gray-600 leading-relaxed">Advanced computer diagnostics to quickly and accurately identify any underlying issues with your vehicle.</p>
                </div>

                <!-- Service 3 -->
                <div class="bg-gray-50 rounded-xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 group">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-600 group-hover:text-white">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Repair & Parts</h3>
                    <p class="text-gray-600 leading-relaxed">From brake replacements to transmission fixes, we use genuine parts to ensure your safety on the road.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">
                &copy; {{ date('Y') }} AutoCare System (FYP Project). All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Script to handle the auto-playing Welcome Hero Slideshow -->
    <script>
        (function() {
            let currentSlide = 0;
            const slides = document.querySelectorAll('.welcome-slide');
            const dots = document.querySelectorAll('.welcome-dot');
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
            document.getElementById('welcome-next-slide').addEventListener('click', () => {
                nextSlide();
                resetTimer();
            });

            document.getElementById('welcome-prev-slide').addEventListener('click', () => {
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
</body>
</html>