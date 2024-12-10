<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.5/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .custom-lime {
            color: #84cc16;
        }
        .bg-custom-lime {
            background-color: #84cc16;
        }
        .border-custom-lime {
            border-color: #84cc16;
        }
        .hover\:bg-custom-lime:hover {
            background-color: #84cc16;
        }
        .text-custom-lime {
            color: #84cc16;
        }
        .bg-custom-lime-50 {
            background-color: #f7fee7;
        }
        .text-custom-lime-600 {
            color: #65a30d;
        }
        .focus\:ring-custom-lime:focus {
            --tw-ring-color: #84cc16;
        }
        .focus\:border-custom-lime:focus {
            border-color: #84cc16;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            animation: fadeIn 0.2s ease-in-out;
        }

        .modal-content {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            margin: 2rem auto;
            position: relative;
            transform: translateY(-20px);
            opacity: 0;
            animation: slideIn 0.3s ease-out forwards;
        }

        .modal-header {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 1rem;
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

        .modal.show {
            display: flex;
            align-items: flex-start;
            padding-top: 2rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #84cc16;
            ring: 2px;
            ring-color: rgba(132, 204, 22, 0.2);
        }

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: #84cc16;
            color: white;
        }

        .btn-primary:hover {
            background-color: #65a30d;
        }

        .btn-secondary {
            background-color: white;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-secondary:hover {
            background-color: #f3f4f6;
        }

        /* Add these styles for the toggle button */
        .duration-toggle {
            transition: all 0.2s ease-in-out;
        }

        .duration-toggle:hover {
            background-color: #d9f99d;
        }

        .form-input.pr-16 {
            padding-right: 4rem;
        }

        /* Create Announcement Button Styles */
        .create-announcement-btn {
            background-color: #84cc16;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
            border: 2px solid transparent;
        }

        .create-announcement-btn:hover {
            background-color: #65a30d;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .create-announcement-btn:active {
            transform: translateY(0);
        }

        .create-announcement-btn:focus {
            outline: none;
            ring: 2px;
            ring-offset: 2px;
            ring-color: rgba(132, 204, 22, 0.5);
        }

        /* Header Layout Styles */
        .header-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Search Input Styles */
        .search-input {
            border-color: #e5e7eb;
            transition: all 0.2s ease-in-out;
        }

        .search-input:focus {
            border-color: #84cc16;
            box-shadow: 0 0 0 3px rgba(132, 204, 22, 0.1);
        }

        /* Program Filter Select Styles */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            transition: all 0.2s ease-in-out;
        }

        select:focus {
            border-color: #84cc16;
            box-shadow: 0 0 0 3px rgba(132, 204, 22, 0.1);
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .header-controls {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .search-input {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .create-announcement-btn {
                width: 100%;
                justify-content: center;
            }
        }

        .main-content {
            padding-top: 7rem; /* 64px to match the nav height */
        }

        /* Add these styles in your <style> section */
.announcement-slide {
    display: none;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.announcement-slide.active {
    display: block;
    opacity: 1;
}

.fade {
    animation-name: fade;
    animation-duration: 0.5s;
}

@keyframes fade {
    from {opacity: 0.4}
    to {opacity: 1}
}

/* Add this to your existing <style> section */
.featured-content-border {
    border: 2px solid #84cc16;
    
}

/* Add this to your existing <style> section */
.announcement-content-container {
    border: 1px solid #84cc16;
    background-color: #ecfccb;
}

.media-container {
    width: 60%;
    height: 360px; /* Fixed height for 16:9 ratio (640x360) */
    position: relative;
    overflow: hidden;
}

.content-container {
    width: 40%;
    padding-left: 1rem;
    height: 360px; /* Match media container height */
}

.media-aspect-ratio {
    position: relative;
    width: 640px; /* Fixed width */
    height: 360px; /* Fixed height - 16:9 ratio */
    margin: 0 auto;
}

.media-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain; /* Changed to contain to maintain aspect ratio */
    border-radius: 0.5rem;
    background-color: #000; /* Black background for letterboxing */
}

.featured-slideshow {
    display: flex;
    height: 360px;
    background-color: #fff;
}

/* Ensure slides maintain aspect ratio */
.announcement-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}

/* Media queries for responsive scaling while maintaining 16:9 */
@media (max-width: 1280px) {
    .media-aspect-ratio {
        width: 480px;
        height: 270px;
    }
    .media-container, .content-container, .featured-slideshow {
        height: 270px;
    }
}

@media (max-width: 1024px) {
    .media-aspect-ratio {
        width: 400px;
        height: 225px;
    }
    .media-container, .content-container, .featured-slideshow {
        height: 225px;
    }
}
    </style>
</head>
<body class="bg-white min-h-screen">
@include('layouts\admin') 
    <!-- Fixed Navigation Bar -->
    <nav class="bg-white border-b fixed top-0 left-0 right-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <i class="fas  custom-lime text-2xl mr-3"></i>
                    <h1 class="text-gray-900 text-xl font-bold">Announcements Dashboard</h1>
                </div>
                
                <!-- Right side - Tab Navigation -->
                <div class="flex items-center space-x-8">
                    <button onclick="showTab('featured')" 
                        class="tab-button text-gray-500 hover:text-lime-500 transition-colors duration-200 px-3 py-2 text-sm font-medium">
                        Featured & Stats
                    </button>
                    <div class="relative inline-block text-left">
                        <button id="announcementsDropdown" 
                                type="button"
                                class="tab-button text-gray-500 hover:text-lime-500 transition-colors duration-200 px-3 py-2 text-sm font-medium inline-flex items-center"
                                onclick="toggleDropdown()">
                            Lists
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="announcementsMenu" 
                             class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1" role="menu">
                                <button onclick="showTab('latest-announcements')"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-lime-50 hover:text-lime-500">
                                    Latest & Upcoming
                                </button>
                                <button onclick="showTab('past-announcements')"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-lime-50 hover:text-lime-500">
                                    Completed Announcements
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 main-content">
        <!-- Featured & Stats Tab Content -->
        <div id="featured-tab" class="tab-content">
            <!-- Featured Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Combined Media and Content Container -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-xl shadow-sm p-4 featured-content-border min-h-[400px]">
                        @php
                            $activeAnnouncements = $announcements->filter(function($announcement) {
                                $targetDate = Carbon\Carbon::parse($announcement->target_date)->startOfDay();
                                $now = now()->startOfDay();
                                return $targetDate->equalTo($now) || $targetDate->greaterThan($now);
                            })->sortBy('target_date');
                        @endphp
                        
                        @if($activeAnnouncements->count() > 0)
                            <div class="featured-slideshow">
                                <!-- Media Section (Left side) -->
                                <div class="media-container">
                                    @foreach($activeAnnouncements as $index => $announcement)
                                        <div class="announcement-slide fade {{ $index === 0 ? 'active' : '' }}" 
                                             data-duration="{{ str_starts_with($announcement->media_type, 'video') ? ($announcement->video_length * 1000) : 10000 }}">
                                            <div class="media-aspect-ratio">
                                                @if($announcement->media_path)
                                                    @if(str_starts_with($announcement->media_type, 'image'))
                                                        <img src="{{ asset('storage/' . $announcement->media_path) }}" 
                                                             class="media-content" 
                                                             alt="Announcement media">
                                                    @elseif(str_starts_with($announcement->media_type, 'video'))
                                                        <video class="media-content" controls>
                                                            <source src="{{ asset('storage/' . $announcement->media_path) }}" 
                                                                    type="{{ $announcement->media_type }}">
                                                        </video>
                                                    @endif
                                                @else
                                                    <img src="{{ asset('images/backgrounds/cas (1).png') }}" 
                                                         class="media-content" 
                                                         alt="Default announcement image">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Content Section (Right side) -->
                                <div class="content-container">
                                    <div class="h-full rounded-lg bg-white shadow-sm overflow-hidden">
                                        @foreach($activeAnnouncements as $index => $announcement)
                                            <div class="h-full p-4 rounded-lg hover:border-lime-200 transition-colors duration-200 bg-white shadow-sm {{ $index === 0 ? 'block' : 'hidden' }} flex flex-col" data-slide-content="{{ $index }}">
                                                <div class="flex-1 overflow-y-auto">
                                                    <!-- Program Badge -->
                                                    <div class="mb-3 sticky top-0 bg-white pt-1">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-lime-50 text-green-800 border border-lime-100">
                                                            <i class="fas fa-university mr-2"></i>
                                                            {{ $announcement->program }}
                                                        </span>
                                                    </div>
                                                    <!-- Title -->
                                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                                        {{ $announcement->title }}
                                                    </h3>

                                                    <!-- Content -->
                                                    <p class="text-sm text-gray-600">
                                                        {{ $announcement->content }}
                                                    </p>
                                                </div>

                                                <!-- Fixed Footer -->
                                                <div class="mt-auto pt-3 bg-white">
                                                    <div class="flex justify-between items-center text-xs text-gray-500 pt-3 border-t border-gray-100">
                                                        <span class="flex items-center">
                                                            <i class="far fa-calendar-alt mr-1"></i>
                                                            Posted: {{ $announcement->created_at->format('M d, Y') }}
                                                        </span>
                                                        <span class="flex items-center">
                                                            <i class="far fa-clock mr-1"></i>
                                                            Target: {{ $announcement->target_date->format('M d, Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Dots -->
                            <div class="flex justify-center space-x-1.5 mt-3">
                                @foreach($activeAnnouncements as $index => $announcement)
                                    <button onclick="showSlide({{ $index }})" 
                                            class="h-1.5 w-1.5 rounded-full transition-colors duration-200 dot {{ $index === 0 ? 'bg-black' : 'bg-gray-300' }}">
                                    </button>
                                @endforeach
                            </div>
                        @else
                            <div class="h-full flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-bullhorn text-gray-300 text-5xl mb-4"></i>
                                    <p class="text-gray-500">No active announcements available</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistics Container with fixed heights -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Total Announcements Card -->
                <div class="bg-white p-6 rounded-xl border shadow-sm min-h-[160px]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Announcements</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $announcements->count() }}</h3>
                        </div>
                        <div class="p-3 bg-lime-50 rounded-lg">
                            <i class="fas fa-bullhorn text-lime-500 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="flex items-center text-lime-500">
                                <i class="fas fa-arrow-up mr-1"></i>
                                12%
                            </span>
                            <span class="ml-2">vs last month</span>
                        </div>
                    </div>
                </div>

                <!-- Blank container with fixed height -->
                <div class="bg-white p-10 rounded-xl border shadow-sm lg:col-span-2 min-h-[160px]">
                    <div class="h-full flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-chart-bar text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500">No data available</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Announcements Display Tab Content -->
        <div id="announcements-tab" class="tab-content hidden">
            <div class="bg-white rounded-xl border shadow-sm relative">
                <!-- Fixed Header -->
                <div class="p-6 border-b sticky top-0 bg-white z-10">
                    <div class="flex justify-between items-center">
                        
                        <div class="flex space-x-4">
                            <div class="relative">
                                <input type="text" 
                                    placeholder="Search announcements..." 
                                    class="w-64 pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:border-lime-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <select id="programFilter" class="border rounded-lg px-4 py-2 focus:outline-none focus:border-lime-500" onchange="filterAnnouncements()">
                                <option value="">All Programs</option>
                                <option value="Bachelor of Performing Arts">Bachelor of Performing Arts</option>
                                <option value="Bachelor of Public Administration">Bachelor of Public Administration</option>
                                <option value="Bachelor of Science in Biology">Bachelor of Science in Biology</option>
                                <option value="Bachelor of Science in Environmental Science">Bachelor of Science in Environmental Science</option>
                                <option value="Bachelor of Science in Exercise Sports and Sciences">Bachelor of Science in Exercise Sports and Sciences</option>
                                <option value="Bachelor of Science in Mathematics">Bachelor of Science in Mathematics</option>
                                <option value="Bachelor of Science in Social Work">Bachelor of Science in Social Work</option>
                            </select>

                            <!-- Add Announcement Button -->
                            <button onclick="openModal()" 
                                    class="create-announcement-btn">
                                <i class="fas fa-plus mr-2"></i>
                                Create Announcement
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Scrollable Content -->
                <div class="overflow-y-auto" style="max-height: calc(100vh - 16rem);">
                    <!-- Announcements List -->
                    <div class="p-6">
                        @forelse($announcements as $announcement)
                            <div class="mb-6 bg-white border rounded-lg overflow-hidden hover:shadow-md transition-shadow flex h-64">
                                <!-- Left: Media Section - Fixed width -->
                                <div class="w-64 flex-shrink-0 relative group">
                                    @if($announcement->media_path)
                                        @if(str_starts_with($announcement->media_type, 'image'))
                                            <img src="{{ asset('storage/' . $announcement->media_path) }}" 
                                                 class="w-full h-full object-cover" 
                                                 alt="Announcement media">
                                            <button onclick="previewMedia('{{ asset('storage/' . $announcement->media_path) }}', 'image')" 
                                                    class="absolute inset-0 bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                                <i class="fas fa-eye text-2xl"></i>
                                            </button>
                                        @else
                                            <video class="w-full h-full object-cover">
                                                <source src="{{ asset('storage/' . $announcement->media_path) }}" 
                                                        type="{{ $announcement->media_type }}">
                                            </video>
                                            <button onclick="previewMedia('{{ asset('storage/' . $announcement->media_path) }}', 'video')" 
                                                    class="absolute inset-0 bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                                <i class="fas fa-play text-2xl"></i>
                                            </button>
                                        @endif
                                    @else
                                    <div class="w-full h-full flex items-center justify-center bg-lime-50">
            <img src="{{ asset('images/backgrounds/cas (1).png') }}" 
                 class="w-full h-full object-cover rounded-lg" 
                 alt="Default announcement image">
            <button onclick="openMediaUploadModal('{{ $announcement->id }}')" 
                    class="absolute inset-0 flex flex-col items-center text-white justify-center text-lime-500 hover:text-lime-600 transition-colors duration-200 bg-black bg-opacity-50 opacity-0 hover:opacity-100">
                <i class="fas fa-eye text-2xl"></i>
                <span class="block text-sm mt-2"></span>
            </button>
        </div>
                                    @endif
                                </div>

                                <!-- Right: Content Section - Scrollable -->
                                <div class="flex-1 p-6 flex flex-col min-w-0">
                                    <!-- Header - Fixed -->
                                    <div class="flex items-center justify-between mb-3 flex-shrink-0">
                                        <div class="flex items-center">
                                            <span class="px-3 py-1 bg-lime-100 text-lime-700 rounded-full text-sm truncate flex items-center">
                                                <i class="fas fa-university mr-2"></i>
                                                {{ $announcement->program }}
                                            </span>
                                        </div>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm flex-shrink-0">
                                            Active
                                        </span>
                                    </div>

                                    <!-- Scrollable Content Area -->
                                    <div class="flex-1 overflow-y-auto min-h-0">
                                        <!-- Title -->
                                        <h3 class="text-xl font-semibold mb-3">{{ $announcement->title }}</h3>

                                        <!-- Content -->
                                        <p class="text-gray-600 mb-4">{{ $announcement->content }}</p>
                                    </div>

                                    <!-- Footer -->
                                    <div class="mt-auto">
                                        <div class="flex flex-col sm:flex-row justify-between items-center gap-2 p-3 bg-gray-50 rounded-lg border-t border-gray-100">
                                            <!-- Posted Date -->
                                            <div class="flex items-center text-xs text-gray-600 bg-white px-3 py-2 rounded-full shadow-sm">
                                                <i class="far fa-calendar-alt text-lime-500 mr-2"></i>
                                                <div class="flex flex-col">
                                                    <span class="font-medium">Posted</span>
                                                    <span>{{ $announcement->created_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>

                                            <!-- Divider for mobile -->
                                            <div class="hidden sm:block h-8 w-px bg-gray-200"></div>

                                            <!-- Target Date -->
                                            <div class="flex items-center text-xs text-gray-600 bg-white px-3 py-2 rounded-full shadow-sm">
                                                <i class="far fa-clock text-lime-500 mr-2"></i>
                                                <div class="flex flex-col">
                                                    <span class="font-medium">Target</span>
                                                    <span>{{ $announcement->target_date->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4"></i>
                                <p>No announcements available</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="p-6 border-t">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to 
                                <span class="font-medium">9</span> of 
                                <span class="font-medium">{{ $announcements->count() }}</span> announcements
                            </p>
                            <div class="flex space-x-2">
                                <button class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50">
                                    Previous
                                </button>
                                <button class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Announcement Modal -->
    <div id="announcementModal" class="modal">
        <div class="modal-content">
            <!-- Add a new progress container at the top of the modal -->
            <div id="submitProgress" class="hidden px-6 py-3 bg-gray-50 border-b">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm text-gray-600">Submitting announcement...</span>
                    <span id="submitProgressPercent" class="text-sm font-medium text-lime-600">0%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div id="submitProgressBar" 
                         class="bg-lime-500 h-2 rounded-full transition-all duration-300" 
                         style="width: 0%">
                    </div>
                </div>
            </div>

            <div class="modal-header">
                <h3 class="text-lg font-semibold text-gray-900">Create New Announcement</h3>
                <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Update the form to use multipart/form-data and add proper enctype -->
                <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data" class="p-6" id="announcementForm">
                    @csrf
                    <div class="space-y-4">
                        <!-- Requester Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Requester Name</label>
                                <input type="text" name="requester_name" required 
                                    class="form-input focus:ring-custom-lime focus:border-custom-lime">
                            </div>
                            <div>
                                <label class="form-label">Email</label>
                                <input type="email" name="email" required 
                                    class="form-input focus:ring-custom-lime focus:border-custom-lime">
                            </div>
                        </div>

                        <!-- Department Selection -->
                        <div>
                            <label class="form-label">Department</label>
                            <select name="program" required 
                                class="form-input focus:ring-custom-lime focus:border-custom-lime">
                                <option value="">Select Department</option>
                                <option value="Bachelor of Performing Arts">Bachelor of Performing Arts</option>
                                <option value="Bachelor of Public Administration">Bachelor of Public Administration</option>
                                <option value="Bachelor of Science in Biology">Bachelor of Science in Biology</option>
                                <option value="Bachelor of Science in Environmental Science">Bachelor of Science in Environmental Science</option>
                                <option value="Bachelor of Science in Exercise Sports and Sciences">Bachelor of Science in Exercise Sports and Sciences</option>
                                <option value="Bachelor of Science in Mathematics">Bachelor of Science in Mathematics</option>
                                <option value="Bachelor of Science in Social Work">Bachelor of Science in Social Work</option>
                            </select>
                        </div>

                        <!-- Announcement Details -->
                        <div>
                            <label class="form-label">Announcement Title</label>
                            <input type="text" name="title" required 
                                class="form-input focus:ring-custom-lime focus:border-custom-lime">
                        </div>

                        <div>
                            <label class="form-label">Announcement Content</label>
                            <textarea name="content" rows="4" required 
                                class="form-input focus:ring-custom-lime focus:border-custom-lime"
                                onkeyup="updateCharacterCount(this)"></textarea>
                            <div class="text-xs text-gray-500 mt-1">
                                <span id="charCount">0</span>/150 characters
                            </div>
                        </div>

                        <!-- Media Upload and Duration -->
                        <div class="space-y-4">
                            <div>
                                <label class="form-label">Media Upload</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-custom-lime">
                                    <div class="space-y-1 text-center">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                                        <div class="flex text-sm text-gray-600">
                                            <label class="relative cursor-pointer bg-white rounded-md font-medium text-custom-lime hover:text-custom-lime-600">
                                                <span>Upload a file</span>
                                                <input type="file" name="media" class="sr-only" accept="image/*,video/*" id="mediaInput" onchange="handleMediaUpload(this)">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF, MP4 up to 10MB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Display Duration Field -->
                            <div>
                                <label class="form-label">Display Duration (in seconds)</label>
                                <input type="number" name="display_duration" required min="1" max="300"
                                    class="form-input focus:ring-custom-lime focus:border-custom-lime"
                                    placeholder="Enter duration in seconds (1-300)">
                                <p class="text-xs text-gray-500 mt-1">For images: How long to display. For videos: Will be set automatically.</p>
                            </div>

                            <!-- Video Duration Field (Hidden by default) -->
                            <div id="videoDurationField" class="hidden">
                                <label class="form-label">Video Length</label>
                                <input type="text" id="videoLength" name="video_length" readonly
                                    class="form-input focus:ring-custom-lime focus:border-custom-lime">
                                <p class="text-xs text-gray-500 mt-1">Duration: <span id="durationDisplay">0:00</span></p>
                            </div>

                            <!-- Upload Progress -->
                            <div id="uploadProgress" class="hidden mt-2">
                                <div class="bg-gray-200 rounded-full h-2.5">
                                    <div id="uploadProgressBar" class="bg-custom-lime h-2.5 rounded-full" style="width: 0%"></div>
                                </div>
                                <p id="uploadStatus" class="text-sm mt-1"></p>
                            </div>
                        </div>

                        <!-- Target Date and Priority -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Target Date</label>
                                <input type="date" name="target_date" required 
                                    class="form-input focus:ring-custom-lime focus:border-custom-lime"
                                    onchange="validateTargetDate(this)">
                            </div>
                            <div>
                                <label class="form-label">Priority Level</label>
                                <select name="priority" required 
                                    class="form-input focus:ring-custom-lime focus:border-custom-lime">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                        </div>

                        <!-- Digital Signature -->
                        <div>
                            <label class="form-label">Digital Signature</label>
                            <div class="space-y-4">
                                <!-- Signature Type Toggle -->
                                <div class="flex space-x-4">
                                    <button type="button" onclick="toggleSignatureType('text')"
                                            class="px-3 py-1 rounded-lg text-sm signature-toggle active"
                                            id="textSignatureBtn">
                                        Type Signature
                                    </button>
                                    <button type="button" onclick="toggleSignatureType('image')"
                                            class="px-3 py-1 rounded-lg text-sm signature-toggle"
                                            id="imageSignatureBtn">
                                        Upload Signature
                                    </button>
                                </div>

                                <!-- Text Signature Input -->
                                <div id="textSignatureInput">
                                    <input type="text" 
                                           name="signature_text" 
                                           placeholder="Type your signature" 
                                           class="form-input focus:ring-custom-lime focus:border-custom-lime">
                                </div>

                                <!-- Image Signature Input -->
                                <div id="imageSignatureInput" class="hidden">
                                    <input type="file" 
                                           name="signature_image" 
                                           accept="image/*" 
                                           class="form-input focus:ring-custom-lime focus:border-custom-lime">
                                    <p class="text-xs text-gray-500 mt-1">Upload a signature image (PNG, JPG)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Error Messages -->
                        <div id="errorMessages" class="hidden text-red-500 text-sm"></div>

                        <!-- Form Buttons -->
                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="reset" 
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                Clear Form
                            </button>
                            <button type="submit" 
                                class="px-4 py-2 bg-custom-lime text-white rounded-lg hover:bg-custom-lime-600">
                                Submit Announcement
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Tab functionality


         
        

       

        

      

  

        // Modal functionality
        function openModal() {
            const modal = document.getElementById('announcementModal');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('announcementModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('announcementModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Program filter functionality
        const programCheckboxes = document.querySelectorAll('input[type="checkbox"]');
        programCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.value === 'All Programs') {
                    programCheckboxes.forEach(cb => {
                        cb.checked = this.checked;
                    });
                } else {
                    const allProgramsCheckbox = document.querySelector('input[value="All Programs"]');
                    if (!this.checked) {
                        allProgramsCheckbox.checked = false;
                    }
                    const allOthersChecked = Array.from(programCheckboxes)
                        .filter(cb => cb.value !== 'All Programs')
                        .every(cb => cb.checked);
                    if (allOthersChecked) {
                        allProgramsCheckbox.checked = true;
                    }
                }
                filterAnnouncements();
            });
        });

        function filterAnnouncements() {
            const selectedPrograms = Array.from(programCheckboxes)
                .filter(cb => cb.checked && cb.value !== 'All Programs')
                .map(cb => cb.value);

            const announcements = document.querySelectorAll('.announcement-slide, [data-program]');
            announcements.forEach(announcement => {
                const program = announcement.dataset.program;
                if (selectedPrograms.length === 0 || selectedPrograms.includes(program)) {
                    announcement.style.display = '';
                } else {
                    announcement.style.display = 'none';
                }
            });
        }

        // File input preview functionality
        const fileInput = document.querySelector('input[type="file"]');
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log('File selected:', file.name);
                };
                reader.readAsDataURL(file);
            }
        });

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Show first announcement
            showSlide(0);
            
            // Initialize filters
            filterAnnouncements();

            // Add animation classes
            document.querySelectorAll('.bg-white').forEach(el => {
                el.classList.add('transition-all', 'duration-200');
            });
        });

        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            
            // Show selected tab content
            if (tabName === 'latest-announcements' || tabName === 'past-announcements') {
                document.getElementById('announcements-tab').classList.remove('hidden');
                
                // Filter announcements based on date
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Set to start of day
                const announcements = document.querySelectorAll('.mb-6.bg-white.border.rounded-lg');
                
                announcements.forEach(announcement => {
                    const targetDateElement = announcement.querySelector('.text-gray-600 span:last-child');
                    if (!targetDateElement) return;
                    
                    // Extract the date string and parse it
                    const dateStr = targetDateElement.textContent.trim();
                    const targetDate = new Date(dateStr.replace('Target: ', ''));
                    targetDate.setHours(0, 0, 0, 0); // Set to start of day
                    
                    if (tabName === 'latest-announcements') {
                        // Show announcements with target dates today or in the future
                        announcement.style.display = targetDate >= today ? 'flex' : 'none';
                    } else {
                        // Show announcements with target dates in the past
                        announcement.style.display = targetDate < today ? 'flex' : 'none';
                    }
                });
            } else {
                document.getElementById(tabName + '-tab').classList.remove('hidden');
            }
            
            // Update tab button styles
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('text-lime-500', 'border-lime-500');
                button.classList.add('text-gray-500', 'border-transparent');
            });
            
            // Close dropdown after selection
            document.getElementById('announcementsMenu').classList.add('hidden');
        }

        // Show featured tab by default
        document.addEventListener('DOMContentLoaded', function() {
            showTab('featured');
        });

        document.getElementById('announcementForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitProgress = document.getElementById('submitProgress');
            const submitProgressBar = document.getElementById('submitProgressBar');
            const submitProgressPercent = document.getElementById('submitProgressPercent');
            const submitButton = this.querySelector('button[type="submit"]');
            const errorMessages = document.getElementById('errorMessages');
            
            // Clear previous error messages
            errorMessages.innerHTML = '';
            errorMessages.classList.add('hidden');
            
            // Show progress bar
            submitProgress.classList.remove('hidden');
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            
            // Simulate progress steps
            let progress = 0;
            const progressSteps = [
                { percent: 15, message: 'Validating form...' },
                { percent: 30, message: 'Processing media...' },
                { percent: 60, message: 'Uploading content...' },
                { percent: 85, message: 'Finalizing...' },
                { percent: 100, message: 'Complete!' }
            ];
            
            let currentStep = 0;
            
            const updateProgress = () => {
                if (currentStep < progressSteps.length) {
                    const step = progressSteps[currentStep];
                    progress = step.percent;
                    submitProgressBar.style.width = `${progress}%`;
                    submitProgressPercent.textContent = `${progress}%`;
                    currentStep++;
                }
            };

            // Start progress animation
            const progressInterval = setInterval(updateProgress, 800);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                clearInterval(progressInterval);
                
                // Set progress to 100% on success
                submitProgressBar.style.width = '100%';
                submitProgressPercent.textContent = '100%';
                
                if (data.success) {
                    // Add success state to progress bar
                    submitProgressBar.classList.add('bg-green-500');
                    
                    // Show success message
                    const successMessage = document.createElement('div');
                    successMessage.className = 'text-sm text-green-600 mt-2 text-center';
                    successMessage.textContent = 'Announcement created successfully!';
                    submitProgress.appendChild(successMessage);
                    
                    // Close modal and refresh after delay
                    setTimeout(() => {
                        closeModal();
                        this.reset();
                        location.reload();
                    }, 1500);
                } else {
                    // Handle error state
                    submitProgressBar.classList.add('bg-red-500');
                    errorMessages.classList.remove('hidden');
                    if (typeof data.message === 'string') {
                        errorMessages.innerHTML = `<p class="text-red-500">${data.message}</p>`;
                    } else {
                        const errors = Object.values(data.message).flat();
                        errorMessages.innerHTML = errors
                            .map(error => `<p class="text-red-500">${error}</p>`)
                            .join('');
                    }
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Submit Announcement';
                }
            })
            .catch(error => {
                clearInterval(progressInterval);
                submitProgressBar.classList.add('bg-red-500');
                console.error('Error:', error);
                errorMessages.classList.remove('hidden');
                errorMessages.innerHTML = '<p class="text-red-500">An error occurred while creating the announcement.</p>';
                submitButton.disabled = false;
                submitButton.innerHTML = 'Submit Announcement';
            });
        });

        function refreshAnnouncements() {
            // Reload the featured announcement section
            fetch('/announcements/featured')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('featured-tab').innerHTML = html;
                });
                
            // Update the quick stats
            fetch('/announcements/stats')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('[data-stat="total"]').textContent = data.totalAnnouncements;
                    document.querySelector('[data-stat="active"]').textContent = data.activeAnnouncements;
                });
        }

        function showNotification(title, message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white max-w-md z-50`;
            
            notification.innerHTML = `
                <h4 class="font-bold">${title}</h4>
                <p>${message}</p>
            `;
            
            document.body.appendChild(notification);
            
            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Function to refresh the featured announcement
        function refreshFeaturedAnnouncement() {
            fetch('/announcements/latest')
                .then(response => response.json())
                .then(data => {
                    if (data.announcement) {
                        updateFeaturedAnnouncement(data.announcement);
                    }
                });
        }

        // Function to update the featured announcement content
        function updateFeaturedAnnouncement(announcement) {
            const mediaSection = document.querySelector('.bg-lime-100');
            const programBadge = document.querySelector('.text-gray-600');
            const title = document.querySelector('.text-xl.font-semibold');
            const content = document.querySelector('.text-gray-600.mb-4');
            const postedDate = document.querySelector('.text-gray-500 span:first-child');
            const targetDate = document.querySelector('.text-gray-500 span:last-child');

            // Update content
            if (announcement.media_path) {
                // Update media content based on type
                if (announcement.media_type.startsWith('image')) {
                    mediaSection.innerHTML = `<img src="/storage/${announcement.media_path}" class="w-full h-full object-cover rounded-lg" alt="Announcement media">`;
                } else {
                    mediaSection.innerHTML = `<video class="w-full h-full object-cover rounded-lg" controls><source src="/storage/${announcement.media_path}" type="${announcement.media_type}"></video>`;
                }
            }

            programBadge.textContent = announcement.program;
            title.textContent = announcement.title;
            content.textContent = announcement.content;
            postedDate.textContent = `Posted: ${new Date(announcement.created_at).toLocaleDateString()}`;
            targetDate.textContent = `Target Date: ${new Date(announcement.target_date).toLocaleDateString()}`;
        }

        // Refresh featured announcement every 5 minutes
        setInterval(refreshFeaturedAnnouncement, 300000);

        let isMinutes = true;

        function handleMediaUpload(input) {
            const videoDurationField = document.getElementById('videoDurationField');
            const videoLengthInput = document.getElementById('videoLength');
            const durationDisplay = document.getElementById('durationDisplay');
            const displayDurationInput = document.querySelector('input[name="display_duration"]');
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                if (file.type.startsWith('video/')) {
                    videoDurationField.style.display = 'block';
                    displayDurationInput.readOnly = true;
                    
                    // Create video element to get duration
                    const video = document.createElement('video');
                    video.preload = 'metadata';
                    
                    video.onloadedmetadata = function() {
                        const durationInSeconds = Math.ceil(video.duration);
                        const minutes = Math.floor(durationInSeconds / 60);
                        const seconds = durationInSeconds % 60;
                        
                        // Format duration display for UI
                        const formattedDuration = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                        durationDisplay.textContent = formattedDuration;
                        
                        // Set the display duration to match video length
                        displayDurationInput.value = durationInSeconds;
                        
                        // Store duration in seconds for database
                        videoLengthInput.value = durationInSeconds;
                        videoLengthInput.dataset.duration = durationInSeconds;
                        
                        URL.revokeObjectURL(video.src);
                    };
                    
                    video.src = URL.createObjectURL(file);
                } else {
                    // Reset for images
                    videoDurationField.style.display = 'none';
                    displayDurationInput.readOnly = false;
                    displayDurationInput.value = '';
                    videoLengthInput.value = '';
                    durationDisplay.textContent = '0:00';
                }
            }
        }

        let slideIndex = 0;
        let slideTimer;

        function showSlide(index) {
            const slides = document.getElementsByClassName("announcement-slide");
            const dots = document.getElementsByClassName("dot");
            
            if (slideTimer) clearTimeout(slideTimer);
            
            // Reset all slides
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
                dots[i].classList.remove("bg-black");
                dots[i].classList.add("bg-gray-300");
                
                const video = slides[i].querySelector('video');
                if (video) {
                    video.pause();
                    video.currentTime = 0;
                }
            }
            
            // Show current slide
            slideIndex = index;
            slides[slideIndex].classList.add("active");
            dots[slideIndex].classList.remove("bg-gray-300");
            dots[slideIndex].classList.add("bg-black");
            
            // Handle media content
            const currentSlide = slides[slideIndex];
            const video = currentSlide.querySelector('video');
            
            if (video) {
                // Video handling
                video.play();
                
                // Get exact video duration
                video.addEventListener('loadedmetadata', function() {
                    const exactDuration = video.duration * 1000; // Convert to milliseconds
                    slideTimer = setTimeout(() => {
                        showSlide((slideIndex + 1) % slides.length);
                    }, exactDuration);
                });
                
                video.addEventListener('ended', function() {
                    showSlide((slideIndex + 1) % slides.length);
                });
            } else {
                // Image handling - keep default 10 seconds
                slideTimer = setTimeout(() => {
                    showSlide((slideIndex + 1) % slides.length);
                }, 10000);
            }

            // Update content display
            document.querySelectorAll('[data-slide-content]').forEach(content => {
                content.classList.add('hidden');
            });
            document.querySelector(`[data-slide-content="${index}"]`).classList.remove('hidden');
        }

        function nextSlide() {
            showSlide((slideIndex + 1) % document.getElementsByClassName("announcement-slide").length);
        }

        // Start the slideshow when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            showSlide(0);
        });

        // Add event listeners for video endings
        document.querySelectorAll('.announcement-slide video').forEach(video => {
            video.addEventListener('ended', nextSlide);
        });

        // Optional: Pause slideshow when tab is not visible
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                if (slideTimer) clearTimeout(slideTimer);
                const currentVideo = document.querySelector('.announcement-slide.active video');
                if (currentVideo) currentVideo.pause();
            } else {
                const currentVideo = document.querySelector('.announcement-slide.active video');
                if (currentVideo) {
                    currentVideo.play();
                } else {
                    nextSlide();
                }
            }
        });

        function updateCharacterCount(textarea) {
            const maxLength = 150;
            const currentLength = textarea.value.length;
            const charCountSpan = document.getElementById('charCount');
            
            // Update the counter
            charCountSpan.textContent = currentLength;
            
            // Optional: Add color indication when approaching limit
            if (currentLength >= maxLength) {
                charCountSpan.classList.add('text-red-500');
                charCountSpan.classList.remove('text-gray-500');
            } else if (currentLength >= maxLength * 0.8) {
                charCountSpan.classList.add('text-yellow-500');
                charCountSpan.classList.remove('text-gray-500', 'text-red-500');
            } else {
                charCountSpan.classList.add('text-gray-500');
                charCountSpan.classList.remove('text-yellow-500', 'text-red-500');
            }
            
            // Prevent further input if max length is reached
            if (currentLength > maxLength) {
                textarea.value = textarea.value.substring(0, maxLength);
            }
        }

        // Reset character count when modal is opened
        document.getElementById('announcementForm').addEventListener('reset', function() {
            document.getElementById('charCount').textContent = '0';
            document.getElementById('charCount').classList.remove('text-yellow-500', 'text-red-500');
            document.getElementById('charCount').classList.add('text-gray-500');
        });

        function filterAnnouncements() {
            const selectedProgram = document.getElementById('programFilter').value;
            const announcements = document.querySelectorAll('.mb-6.bg-white.border.rounded-lg'); // Select all announcement cards
            let visibleCount = 0;

            announcements.forEach(announcement => {
                const programElement = announcement.querySelector('.text-lime-700'); // Select the program badge
                const programText = programElement ? programElement.textContent.trim() : '';

                if (!selectedProgram || programText === selectedProgram) {
                    announcement.style.display = 'flex';
                    visibleCount++;
                } else {
                    announcement.style.display = 'none';
                }
            });

            // Update the showing count in pagination
            const showingStart = document.querySelector('.text-gray-700 .font-medium:nth-child(1)');
            const showingEnd = document.querySelector('.text-gray-700 .font-medium:nth-child(2)');
            const totalCount = document.querySelector('.text-gray-700 .font-medium:nth-child(3)');
            
            if (showingStart && showingEnd && totalCount) {
                showingStart.textContent = visibleCount > 0 ? '1' : '0';
                showingEnd.textContent = visibleCount.toString();
                totalCount.textContent = visibleCount.toString();
            }

            // Show/hide "no announcements" message
            const noAnnouncementsMessage = document.querySelector('.text-center.py-12');
            if (noAnnouncementsMessage) {
                noAnnouncementsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        // Optional: Add search functionality that works with the filter
        const searchInput = document.querySelector('input[placeholder="Search announcements..."]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const selectedProgram = document.getElementById('programFilter').value;
                const announcements = document.querySelectorAll('.mb-6.bg-white.border.rounded-lg');
                let visibleCount = 0;

                announcements.forEach(announcement => {
                    const programElement = announcement.querySelector('.text-lime-700');
                    const programText = programElement ? programElement.textContent.trim() : '';
                    const title = announcement.querySelector('.text-xl.font-semibold').textContent.toLowerCase();
                    const content = announcement.querySelector('.text-gray-600').textContent.toLowerCase();

                    const matchesSearch = title.includes(searchTerm) || content.includes(searchTerm);
                    const matchesProgram = !selectedProgram || programText === selectedProgram;

                    if (matchesSearch && matchesProgram) {
                        announcement.style.display = 'flex';
                        visibleCount++;
                    } else {
                        announcement.style.display = 'none';
                    }
                });

                // Update counts and messages as in filterAnnouncements()
                const showingStart = document.querySelector('.text-gray-700 .font-medium:nth-child(1)');
                const showingEnd = document.querySelector('.text-gray-700 .font-medium:nth-child(2)');
                const totalCount = document.querySelector('.text-gray-700 .font-medium:nth-child(3)');
                
                if (showingStart && showingEnd && totalCount) {
                    showingStart.textContent = visibleCount > 0 ? '1' : '0';
                    showingEnd.textContent = visibleCount.toString();
                    totalCount.textContent = visibleCount.toString();
                }

                const noAnnouncementsMessage = document.querySelector('.text-center.py-12');
                if (noAnnouncementsMessage) {
                    noAnnouncementsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
                }
            });
        }

        // Add this JavaScript function
        function validateTargetDate(input) {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            const selectedDate = new Date(input.value);
            selectedDate.setHours(0, 0, 0, 0);
            
            if (selectedDate < today) {
                alert('Please select a date on or after today');
                input.value = '';
            }
        }

        // Add validation to form submission
        document.getElementById('announcementForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            // Ensure video_length is sent as a number
            const videoLengthInput = document.getElementById('videoLength');
            if (videoLengthInput && videoLengthInput.value) {
                formData.set('video_length', parseInt(videoLengthInput.value));
            }
            
            // Rest of your form submission code...
        });

        function toggleDropdown() {
            const menu = document.getElementById('announcementsMenu');
            menu.classList.toggle('hidden');
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function closeDropdown(e) {
                if (!e.target.closest('#announcementsDropdown') && !e.target.closest('#announcementsMenu')) {
                    menu.classList.add('hidden');
                    document.removeEventListener('click', closeDropdown);
                }
            });
        }

        function toggleSignatureType(type) {
            const textInput = document.getElementById('textSignatureInput');
            const imageInput = document.getElementById('imageSignatureInput');
            const textBtn = document.getElementById('textSignatureBtn');
            const imageBtn = document.getElementById('imageSignatureBtn');
            
            // Reset form inputs
            textInput.querySelector('input').required = false;
            imageInput.querySelector('input').required = false;
            
            if (type === 'text') {
                textInput.classList.remove('hidden');
                imageInput.classList.add('hidden');
                textInput.querySelector('input').required = true;
                textBtn.classList.add('bg-lime-100', 'text-lime-700');
                imageBtn.classList.remove('bg-lime-100', 'text-lime-700');
            } else {
                textInput.classList.add('hidden');
                imageInput.classList.remove('hidden');
                imageInput.querySelector('input').required = true;
                imageBtn.classList.add('bg-lime-100', 'text-lime-700');
                textBtn.classList.remove('bg-lime-100', 'text-lime-700');
            }
        }

        // Initialize signature type toggle
        document.addEventListener('DOMContentLoaded', function() {
            toggleSignatureType('text'); // Default to text signature
        });
    </script>
</body>
</html>