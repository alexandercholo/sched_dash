<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .animate-scroll {
            animation: scroll 20s linear infinite;
            backface-visibility: hidden;
            perspective: 1000px;
            transform: translateZ(0);
            animation-play-state: running !important;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1rem;
            padding: 1rem;
        }

        .date-container {
            grid-column: span 2;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .schedule-container {
            grid-column: span 2;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .announcements-container {
            grid-column: span 3;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .content-section {
            padding: 1.5rem;
            height: 100%;
        }

        .date-display {
            background: linear-gradient(rgba(0, 150, 0, 0.1), rgba(0, 150, 0, 0.1));
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .announcement-slide img {
            width: 100%;
            height: auto;
            aspect-ratio: 16 / 9;
            object-fit: cover;
        }

        .announcement-slide {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            display: none;
        }

        .announcement-slide:not(.hidden) {
            opacity: 1;
            display: block;
        }
    </style>
</head>
<body class="bg-gray-50">
@include('layouts\admin') 
    <!-- Fixed Navigation Bar -->
    <nav class="bg-white border-b fixed top-0 left-0 right-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <h1 class="text-gray-900 text-xl font-bold"></h1>
                </div>
            </div>
        </div>
    </nav>

    <!-- Adjust main content padding to account for fixed navbar -->
    <main class="px-2 py-8 mt-16">
        <div class="dashboard-grid">
            <!-- Schedule Container (moved up) -->
            <div class="schedule-container">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Schedules</h3>
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

            <!-- Date Container (moved down) -->
            <div class="date-container">
                <div class="content-section">
                    <div class="date-display">
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="text-2xl font-medium text-black mb-1" id="currentDay">Wednesday</div>
                            <div class="flex items-center gap-1 mb-2">
                                <div class="text-5xl font-bold text-black" id="currentTime">09:40</div>
                                <div class="text-xl font-medium text-black" id="currentPeriod">AM</div>
                            </div>
                            <div class="text-sm font-medium text-black" id="currentMonth">December 4</div>
                            <div class="text-sm font-medium text-black" id="currentYear">2024</div>
                        </div>
                    </div>

                    <!-- Reminder Section -->
                    <div class="mt-4 p-4 bg-white rounded-lg border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-3">Todays Reminders</h4>
                        <div class="space-y-3">
                            @foreach($announcements as $announcement)
                                @if(!$announcement->media_path)
                                    <div class="flex gap-2 text-sm">
                                        <i class="fas fa-bell text-yellow-500 mt-1"></i>
                                        <div>
                                            <div class="text-gray-800 font-medium">
                                                {{ $announcement->title }} - {{ $announcement->target_date->format('g:i A') }}
                                            </div>
                                            <p class="text-gray-600 mt-1">{{ $announcement->content }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Announcements Container -->
            <div class="announcements-container">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Announcements</h3>
                    </div>
                    <div class="relative h-[500px]">
                        <!-- Announcement Slideshow -->
                        <div class="announcement-slideshow h-full">
                            @php
                                $mediaAnnouncements = $announcements->filter(function($announcement) {
                                    return !empty($announcement->media_path);
                                });
                            @endphp
                            
                            @foreach($mediaAnnouncements as $index => $announcement)
                                <div class="announcement-slide bg-white rounded-lg border border-gray-100 h-full {{ $index === 0 ? '' : 'hidden' }}">
                                    <div class="w-full relative" style="padding-top: 56.25%;">
                                        @if($announcement->media_path)
                                            @if(str_starts_with($announcement->media_type, 'image'))
                                                <img src="{{ asset('storage/' . $announcement->media_path) }}" 
                                                     alt="Announcement media"
                                                     class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg"/>
                                            @elseif(str_starts_with($announcement->media_type, 'video'))
                                                <video class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg" controls>
                                                    <source src="{{ asset('storage/' . $announcement->media_path) }}" 
                                                            type="{{ $announcement->media_type }}">
                                                </video>
                                            @endif
                                        @else
                                            <img src="{{ asset('images/placeholder.jpg') }}" 
                                                 alt="Default announcement image"
                                                 class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg"/>
                                        @endif
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center gap-2 mb-3">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-bullhorn text-green-600"></i>
                                            </div>
                                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                {{ $announcement->program }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                Posted: {{ $announcement->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <h4 class="font-medium text-gray-900 mb-2">{{ $announcement->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $announcement->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation Dots -->
                        <div class="absolute bottom-2 left-0 right-0 flex justify-center gap-2">
                            @foreach($mediaAnnouncements as $index => $announcement)
                                <button class="w-2 h-2 rounded-full {{ $index === 0 ? 'bg-blue-600' : 'bg-gray-300' }}" 
                                        onclick="showSlide({{ $index }})">
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo Carousel -->
            
        </div>
    </main>

    <!-- Scripts -->
    <script>
        // Date and Time Update
        function updateDateTime() {
            const now = new Date();
            
            // Update Day
            document.getElementById('currentDay').textContent = 
                now.toLocaleDateString('en-US', { weekday: 'long' });
            
            // Update Time and Period
            const hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const period = hours >= 12 ? 'PM' : 'AM';
            const displayHours = String(hours % 12 || 12).padStart(2, '0');
            
            document.getElementById('currentTime').textContent = `${displayHours}:${minutes}`;
            document.getElementById('currentPeriod').textContent = period;
            
            // Update Date
            document.getElementById('currentMonth').textContent = 
                now.toLocaleDateString('en-US', { month: 'long', day: 'numeric' });
            document.getElementById('currentYear').textContent = 
                now.getFullYear();
        }

        // Update immediately and then every second
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Slideshow functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.announcement-slide');
        const dots = document.querySelectorAll('.bottom-2 button');
        let slideTimer;

        function showSlide(n) {
            // Handle array bounds
            if (n >= slides.length) n = 0;
            if (n < 0) n = slides.length - 1;
            
            // Clear existing timer
            if (slideTimer) clearTimeout(slideTimer);
            
            // Hide all slides and reset videos
            slides.forEach((slide, index) => {
                slide.style.display = 'none';
                slide.classList.add('hidden');
                const video = slide.querySelector('video');
                if (video) {
                    video.pause();
                    video.currentTime = 0;
                }
            });
            
            // Update dots
            dots.forEach(dot => {
                dot.classList.remove('bg-blue-600');
                dot.classList.add('bg-gray-300');
            });
            
            // Show current slide
            currentSlide = n;
            slides[currentSlide].style.display = 'block';
            slides[currentSlide].classList.remove('hidden');
            dots[currentSlide].classList.remove('bg-gray-300');
            dots[currentSlide].classList.add('bg-blue-600');
            
            // Handle media content
            const currentSlideElement = slides[currentSlide];
            const video = currentSlideElement.querySelector('video');
            
            if (video) {
                // For videos
                video.play().catch(e => console.log('Video playback failed:', e));
                video.onended = () => {
                    showSlide(currentSlide + 1);
                };
            } else {
                // For images, advance after 5 seconds
                slideTimer = setTimeout(() => {
                    showSlide(currentSlide + 1);
                }, 5000);
            }
        }

        // Initialize slideshow when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            if (slides.length > 0) {
                // Set initial display state for all slides
                slides.forEach((slide, index) => {
                    slide.style.display = index === 0 ? 'block' : 'none';
                });
                showSlide(0);
            }
        });

        // Handle visibility changes
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                if (slideTimer) clearTimeout(slideTimer);
                const currentVideo = slides[currentSlide].querySelector('video');
                if (currentVideo) currentVideo.pause();
            } else {
                const currentVideo = slides[currentSlide].querySelector('video');
                if (currentVideo) {
                    currentVideo.play().catch(e => console.log('Video playback failed:', e));
                } else {
                    showSlide(currentSlide);
                }
            }
        });

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