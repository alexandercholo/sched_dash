<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    @include('layouts\admin') 


    <!-- Main Content -->
    <main class="px-2 py-8">
        <div class="grid gap-4 md:grid-cols-7">
            <!-- Stats/Charts Container -->
            <div class="bg-white rounded-lg shadow-sm md:col-span-2">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Statistics</h3>
                    </div>
                    <!-- Sample Stats Cards -->
                    <div class="space-y-4">
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-blue-600 font-medium">Total Students</p>
                                    <h4 class="text-2xl font-bold text-blue-700">1,234</h4>
                                </div>
                                <div class="p-2 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-green-50 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-green-600 font-medium">Active Courses</p>
                                    <h4 class="text-2xl font-bold text-green-700">42</h4>
                                </div>
                                <div class="p-2 bg-green-100 rounded-full">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Sample Chart Container -->
                        <div class="mt-6 h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                            <p class="text-gray-500">Chart Placeholder</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule Container -->
            <div class="bg-white rounded-lg shadow-sm md:col-span-2">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Schedules</h3>
                    </div>
                    
                    <!-- Real-time date display -->
                    <div class="text-center mb-6 p-4 border border-green-500 rounded-lg relative overflow-hidden">
                        <!-- Background Image with Blur -->
                        <div class="absolute inset-0 z-0">
                            <img src="{{ asset('images/backgrounds/cas (4).png') }}" alt="" class="w-full h-full object-cover"/>
                            <div class="absolute inset-0 backdrop-blur-[7px] bg-green-500/25"></div>
                        </div>
                        
                        <!-- Content (with z-index to appear above the background) -->
                        <div class="relative z-10 flex flex-col items-center">
                            <!-- Day of Week -->
                            <div class="text-2xl font-medium text-black mb-1" id="scheduleCurrentDay">Wednesday</div>
                            
                            <!-- Time with small AM/PM -->
                            <div class="flex items-center gap-1 mb-2">
                                <div class="text-5xl font-bold text-black" id="scheduleCurrentTime">09:40</div>
                            </div>
                            
                            <!-- Date -->
                            <div class="text-sm font-medium text-black" id="scheduleCurrentMonth">December 4</div>
                            <div class="text-sm font-medium text-black" id="scheduleCurrentYear">2024</div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @foreach($scheduleEvents as $event)
                            <!-- Schedule Item -->
                            <div class="flex items-center gap-4">
                                <div class="flex flex-col items-center min-w-[60px] bg-green-100 rounded-lg p-2">
                                    <span class="text-sm font-medium text-green-600">{{ $event->date->format('M') }}</span>
                                    <span class="text-2xl font-bold text-green-600">{{ $event->date->format('d') }}</span>
                                </div>
                                <div class="flex-1 p-4 border rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $event->title }}</h4>
                                            <p class="text-sm text-gray-500">
                                                {{ $event->start_time->format('g:i A') }} - {{ $event->end_time->format('g:i A') }}
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-full">
                                            Upcoming
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Future Schedule Slots -->
                        @if(isset($futureSchedules) && $scheduleEvents->count() < 3)
                            @foreach($futureSchedules as $future)
                                @if($loop->index < (3 - $scheduleEvents->count()))
                                <div class="flex items-center gap-4">
                                    <div class="flex flex-col items-center min-w-[60px] bg-yellow-100 rounded-lg p-2">
                                        <span class="text-sm font-medium text-yellow-600">{{ $future->date->format('M') }}</span>
                                        <span class="text-2xl font-bold text-yellow-600">{{ $future->date->format('d') }}</span>
                                    </div>
                                    <div class="flex-1 p-4 border border-yellow-200 rounded-lg">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $future->title }}</h4>
                                                <p class="text-sm text-gray-500">
                                                    {{ $future->start_time->format('g:i A') }} - {{ $future->end_time->format('g:i A') }}
                                                </p>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-medium text-yellow-600 bg-yellow-100 rounded-full">
                                                Future Schedule
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @else
                            @for ($i = 0; $i < max(0, 3 - $scheduleEvents->count()); $i++)
                            <div class="flex items-center gap-4 opacity-50">
                                <div class="flex flex-col items-center min-w-[60px] bg-gray-100 rounded-lg p-2">
                                    <span class="text-sm font-medium text-gray-600">--</span>
                                    <span class="text-2xl font-bold text-gray-600">--</span>
                                </div>
                                <div class="flex-1 p-4 border border-gray-200 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-medium text-gray-900">No Schedule</h4>
                                            <p class="text-sm text-gray-500">
                                                No schedule available
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">
                                            Empty Slot
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>

            <!-- Announcements Container -->
            <div class="bg-white rounded-lg shadow-sm md:col-span-3">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Announcements</h3>
                        
                    </div>
                    <div class="relative h-96"> <!-- Increased height to accommodate media -->
                        <!-- Announcement Slideshow -->
                        <div class="announcement-slideshow">
                            <!-- Announcement 1 -->
                            <div class="announcement-slide bg-white rounded-lg border border-gray-100">
                                <div class="aspect-w-16 aspect-h-9 mb-4">
                                    <img src="/api/placeholder/800/400" alt="" class="w-full h-48 bg-green-100 object-cover rounded-t-lg"/>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">All Colleges</span>
                                        <span class="text-xs text-gray-500">Posted: Oct 23, 2024</span>
                                    </div>
                                    <h4 class="font-medium text-gray-900 mb-2">Library Hours Update</h4>
                                    <p class="text-sm text-gray-600">The library will have extended hours during the final examination period.</p>
                                </div>
                            </div>

                            <!-- Announcement 2 -->
                            <div class="announcement-slide bg-white rounded-lg border border-gray-100 hidden">
                                <div class="aspect-w-16 aspect-h-9 mb-4">
                                    <img src="/api/placeholder/800/400" alt="" class="w-full h-48 bg-green-100 object-cover rounded-t-lg"/>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                        </div>
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Important</span>
                                        <span class="text-xs text-gray-500">Posted: Oct 24, 2024</span>
                                    </div>
                                    <h4 class="font-medium text-gray-900 mb-2">Campus Network Maintenance</h4>
                                    <p class="text-sm text-gray-600">Scheduled network maintenance this Saturday.</p>
                                </div>
                            </div>

                            <!-- Announcement 3 -->
                            <div class="announcement-slide bg-white rounded-lg border border-gray-100 hidden">
                                <div class="aspect-w-16 aspect-h-9 mb-4">
                                    <img src="/api/placeholder/800/400" alt="" class="w-full h-48  object-cover bg-green-100 rounded-t-lg"/>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                            </svg>
                                        </div>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Event</span>
                                        <span class="text-xs text-gray-500">Posted: Oct 25, 2024</span>
                                    </div>
                                    <h4 class="font-medium text-gray-900 mb-2">Campus Career Fair</h4>
                                    <p class="text-sm text-gray-600">Join us for the annual Career Fair on November 15th.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Dots -->
                        <div class="absolute bottom-2 left-0 right-0 flex justify-center gap-2">
                            <button class="w-2 h-2 rounded-full bg-blue-600" onclick="showSlide(0)"></button>
                            <button class="w-2 h-2 rounded-full bg-gray-300" onclick="showSlide(1)"></button>
                            <button class="w-2 h-2 rounded-full bg-gray-300" onclick="showSlide(2)"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script>
        // Date and Time Update
        function updateDateTime() {
            const now = new Date();
            
            // Update Time
            const timeElement = document.getElementById('currentTime');
            timeElement.textContent = now.toLocaleTimeString('en-US', { 
                hour: '2-digit', 
                minute: '2-digit'
            });
            
            // Update Date
            const dateElement = document.getElementById('currentDate');
            dateElement.textContent = now.toLocaleDateString('en-US', { 
                weekday: 'long',
                year: 'numeric', 
                month: 'long', 
                day: 'numeric'
            });
        }

        // Update immediately and then every second
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Slideshow functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.announcement-slide');
        const dots = document.querySelectorAll('.bottom-2 button');

        function showSlide(n) {
            slides.forEach(slide => slide.classList.add('hidden'));
            dots.forEach(dot => dot.classList.replace('bg-blue-600', 'bg-gray-300'));
            
            slides[n].classList.remove('hidden');
            dots[n].classList.replace('bg-gray-300', 'bg-blue-600');
            currentSlide = n;
        }

        function nextSlide() {
            let next = currentSlide + 1;
            if (next >= slides.length) {
                next = 0;
            }
            showSlide(next);
        }

        // Auto advance slides every 5 seconds
        setInterval(nextSlide, 5000);

        // Add slide animations
        slides.forEach(slide => {
            slide.style.transition = 'opacity 0.5s ease-in-out';
        });

        // Add fade effect
        const slideStyles = document.createElement('style');
        slideStyles.textContent = `
            .announcement-slide {
                opacity: 0;
                transition: opacity 0.5s ease-in-out;
            }
            .announcement-slide:not(.hidden) {
                opacity: 1;
            }
            .announcement-slide.hidden {
                display: none;
            }
        `;
        document.head.appendChild(slideStyles);

        // Update Schedule Date Display
        function updateScheduleDateTime() {
            const now = new Date();
            
            // Update Day
            document.getElementById('scheduleCurrentDay').textContent = 
                now.toLocaleDateString('en-US', { weekday: 'long' });
            
            // Update Time
            const hours = String(now.getHours() % 12 || 12).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const period = now.getHours() >= 12 ? 'pm' : 'am';
            
            document.getElementById('scheduleCurrentTime').textContent = `${hours}:${minutes}`;
            document.getElementById('scheduleCurrentPeriod').textContent = period;
            
            // Update Date
            document.getElementById('scheduleCurrentMonth').textContent = 
                now.toLocaleDateString('en-US', { month: 'long', day: 'numeric' });
            document.getElementById('scheduleCurrentYear').textContent = 
                now.getFullYear();
        }

        // Update immediately and then every second
        updateScheduleDateTime();
        setInterval(updateScheduleDateTime, 1000);
    </script>
</body>
</html>