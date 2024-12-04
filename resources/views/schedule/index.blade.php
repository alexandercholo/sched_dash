<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Schedule Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public\images\backgrounds\cas-logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public\images\backgrounds\cas-logo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
         
        
       .calendar-container {
        width: 100%;
        height: calc(100vh - 160px); /* Adjust based on your layout */
        overflow: auto;
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border-radius: 1rem;
        padding: 1rem !important;
        scrollbar-width: thin;
        scrollbar-color: #84cc16 #f3f4f6;
        animation: fadeIn 0.4s ease-out;
    }

     


        .event-card {
            transition: transform 0.2s;
        }
        
        .event-card:hover {
            transform: translateY(-2px);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .event-tooltip {
            display: none;
            position: absolute;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            z-index: 50;
        }

        .event-card:hover .event-tooltip {
            display: block;
        }

        .time-section {
            margin-bottom: 2rem;
        }

        .time-section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #84cc16;
        }

        .event-card {
    transition: transform 0.2s;
    border-radius: 1rem; /* Add rounded corners to the entire card */
    overflow: hidden; /* Ensure child elements don't overflow the rounded corners */
}

/* Update the date box styles */
.flex-shrink-0.w-16.bg-lime-100 {
    background-color: #ecfccb !important;
}

/* Update the event details container */
.flex-1.bg-gray-50 {
    border-radius: 0.75rem; /* Match the radius of the date box */
}

/* Update the hidden details section */
.event-details {
    border-radius: 0.5rem; /* Slightly smaller radius for the expanded details */
}

/* Update the "No events" message container */
.bg-gray-50.rounded-lg.p-4.text-gray-600.text-center {
    border-radius: 1rem; /* Match the main card radius */
}
        
        .time-section {
            margin-bottom: 2rem;
        }
        
        .time-section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #84cc16;
            display: flex;
            align-items: center;
        }
        
        .time-section-title i {
            margin-right: 0.5rem;
            color: #84cc16;
        }
        
        .no-events {
            text-align: center;
            padding: 1rem;
            color: #6b7280;
            font-style: italic;
            background: #f9fafb;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }

        .left-container {
        width: 300px; /* Adjusted width to accommodate the new layout */
        flex-shrink: 0;
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Event list container */
    .space-y-3 {
        max-height: 400px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #84cc16 #f3f4f6;
    }

    .space-y-3::-webkit-scrollbar {
        width: 4px;
    }

    .space-y-3::-webkit-scrollbar-track {
        background: #f3f4f6;
    }

    .space-y-3::-webkit-scrollbar-thumb {
        background-color: #84cc16;
        border-radius: 2px;
    }

    /* Event item styles */
    .flex {
        margin-bottom: 0.75rem;
    }

    .flex:last-child {
        margin-bottom: 0;
    }

    /* Add left container styles */
    .left-container {
        width: 300px;
        flex-shrink: 0;
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Optional: Add hover effects for buttons */
    .left-container button:hover {
        background-color: #f3f4f6;
    }

    #currentDate {
        font-size: 4.5rem;
        line-height: 1;
        color: #84cc16; /* lime-500 */
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    #currentDay {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    #currentMonth {
        color: #666;
        font-weight: 500;
    }

    /* Upcoming events styles */
    #upcomingEventsList {
        max-height: 300px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #84cc16 #f3f4f6;
    }

    #upcomingEventsList::-webkit-scrollbar {
        width: 6px;
    }

    #upcomingEventsList::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 3px;
    }

    #upcomingEventsList::-webkit-scrollbar-thumb {
        background-color: #84cc16;
        border-radius: 3px;
    }

    .flex-shrink-0.w-16.h-16.bg-lime-100.rounded-lg.flex.flex-col.items-center.justify-center.mr-3 {
        background-color: #bef264 !important; /* lime-500 */
    }


    /* Add these new styles */
    .has-event {
        background-color: #ecfccb !important; /* Light lime background */
        border: 2px solid #84cc16 !important; /* Lime border */
        border-radius: 0.5rem !important;
    }

    .fc-event {
        background-color: #84cc16 !important; /* Lime background for events */
        border: none !important;
        padding: 2px 4px !important;
        margin: 1px 0 !important;
        border-radius: 4px !important;
        color: white !important;
    }

    /* Custom scrollbar for the right content area */
.overflow-y-auto {
    scrollbar-width: thin;
    scrollbar-color: #84cc16 #f3f4f6;
}

.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f3f4f6;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background-color: #84cc16;
    border-radius: 3px;
}



    

    /* Add these new calendar styles */
    .custom-calendar {
        width: 100%;
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.5rem;
        transition: opacity 0.2s ease-out;
    }

    .calendar-grid.changing {
        opacity: 0;
    }

    .calendar-day-header {
        text-align: center;
        font-weight: 600;
        color: #374151;
        padding: 0.5rem;
    }

    .calendar-day {
        aspect-ratio: 1;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.5rem;
        cursor: pointer;
        position: relative;
        animation: scaleIn 0.3s ease-out;
    }

    .calendar-day:hover {
        background-color: #f3f4f6;
    }

    .calendar-day.today {
        background-color: #ecfccb;
        border-color: #84cc16;
        font-weight: 600;
    }

    .calendar-day.has-event {
        background-color: #f7fee7;
        border-color: #84cc16;
    }

    .calendar-day.has-event::after {
        content: '';
        position: absolute;
        bottom: 0.25rem;
        left: 50%;
        transform: translateX(-50%);
        width: 0.25rem;
        height: 0.25rem;
        background-color: #84cc16;
        border-radius: 50%;
    }

    .event-preview {
        position: absolute;
        bottom: 100%;
        left: -50%;
        transform: translateX(-20%);
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.75rem;
        min-width: 200px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        z-index: 10;
        display: none;
        animation: slideIn 0.2s ease-out forwards;
        opacity: 0;
    }

    .calendar-day:hover .event-preview {
        display: block;
    }

    .event-preview-item {
        padding: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .event-preview-item:last-child {
        border-bottom: none;
    }

    /* Add these new animation keyframes */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(2px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes scaleIn {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    @keyframes slideIn {
        from { transform: translateX(-1px); opacity: 0; }
        to { transform: translateX(0); opacity: 0.8; }
    }

    .nav-button:hover {
        background-color: #ecfccb;
    }

    .add-nav-button {
        width: 100%;
        padding: 12px;
        background-color: #84cc16;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        transition: background-color 0.2s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .add-nav-button:hover {
        background-color: #65a30d;
    }

    .add-nav-button i {
        margin-right: 8px;
    }

    .nav-buttons-container {
        margin-top: 8px;
    }

    .event-card.past {
        opacity: 0.8;
    }

    .event-card.past:hover {
        opacity: 1;
    }

    .past-event-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.75rem;
        background-color: #f3f4f6;
        color: #6b7280;
        border-radius: 9999px;
    }

    /* Style for past events date box */
    .event-card.past .flex-shrink-0 {
        background-color: #f3f4f6 !important;
    }

    .event-card.past .text-lime-600 {
        color: #6b7280;
    }

    .custom-calendar {
        width: 100%;
        background: transparent;
      
        padding: 1.5rem;
        height: calc(100vh - 160px);
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    }

    .events-container {
        height: calc(100% - 4rem); /* Subtract header height */
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #84cc16 #f3f4f6;
    }

    .events-container::-webkit-scrollbar {
        width: 6px;
    }

    .events-container::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 3px;
    }

    .events-container::-webkit-scrollbar-thumb {
        background-color: #84cc16;
        border-radius: 3px;
    }

    .section-content {
        padding: 0.5rem;
    }

    .section-content:not(.hidden) {
        display: block;
    }

    /* Remove margin bottom from last section */
    .section-content:last-child {
        margin-bottom: 0;
    }

    /* Add spacing between events */
    .space-y-4 > * + * {
        margin-top: 1rem;
    }

    /* Calendar View Styles */
    .custom-calendar-view {
        width: 100%;
        background: transparent;
        padding: 1.5rem;
        height: calc(100vh - 160px);
       
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.5rem;
        transition: opacity 0.2s ease-out;
    }

    .calendar-grid.changing {
        opacity: 0;
    }

    .calendar-day-header {
        text-align: center;
        font-weight: 600;
        color: #374151;
        padding: 0.5rem;
    }

    .calendar-day {
        aspect-ratio: 1;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.5rem;
        cursor: pointer;
        position: relative;
        animation: scaleIn 0.3s ease-out;
    }

    .calendar-day:hover {
        background-color: #f3f4f6;
    }

    .calendar-day.today {
        background-color: #ecfccb;
        border-color: #84cc16;
        font-weight: 600;
    }

    .calendar-day.has-event {
        background-color: #f7fee7;
        border-color: #84cc16;
    }

    .calendar-day.has-event::after {
        content: '';
        position: absolute;
        bottom: 0.25rem;
        left: 50%;
        transform: translateX(-50%);
        width: 0.25rem;
        height: 0.25rem;
        background-color: #84cc16;
        border-radius: 50%;
    }

    /* Events List View Styles */
    .custom-calendar-list {
        width: 100%;
        background: white;
        padding: 1.5rem;
        height: calc(100vh - 160px);
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    }

    .events-container {
        height: calc(100% - 4rem);
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #84cc16 #f3f4f6;
    }

    .events-container::-webkit-scrollbar {
        width: 6px;
    }

    .events-container::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 3px;
    }

    .events-container::-webkit-scrollbar-thumb {
        background-color: #84cc16;
        border-radius: 3px;
    }

    .section-content {
        padding: 0.5rem;
    }

    .section-content:not(.hidden) {
        display: block;
    }

    .section-content:last-child {
        margin-bottom: 0;
    }

    .space-y-4 > * + * {
        margin-top: 1rem;
    }

    </style>
</head>
<body class="bg-gray-50 min-h-screen">
@include('layouts\admin') 
    <!-- Navigation Bar -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-4">
                    <i class="fas text-lime-500 text-2xl"></i>
                    <h1 class="text-xl font-bold text-gray-800">Academic Calendar</h1>
                </div>

                <!-- Tab Navigation - Moved here -->
                <div class="flex items-center">
                    <nav class="flex space-x-8" aria-label="Tabs">
                        <button onclick="switchTab('calendar')" 
                            class="tab-btn border-lime-500 text-lime-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Calendar View
                        </button>
                        <button onclick="switchTab('upcoming')" 
                            class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Lists
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-20 pb-15">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Calendar Tab Content -->
            <div id="calendar-tab" class="tab-content active">
    <div class="flex"> <!-- Add this wrapper div -->
        <!-- Left container content -->
<div class="left-container bg-white rounded-xl shadow-sm p-6 mr-6">
    <!-- Real-time date display -->
    <div class="text-center mb-6">
        <div class="text-6xl font-bold text-gray-800" id="currentDate">19</div>
        <div class="text-lg text-gray-600 mt-1" id="currentDay">Wednesday</div>
        <div class="text-sm text-gray-500 mt-1" id="currentMonth">March 2024</div>
    </div>
    
    <!-- This Week's Events -->
    <div class="mt-6">
        <h4 class="text-sm font-semibold text-gray-600 mb-3">
            <i class="fas text-lime-500 mr-2"></i>
            This Week's Events
        </h4>
        
        @php
            $today = now()->startOfDay();
            $weekEvents = $events->filter(function($event) use ($today) {
                // Only show today's and future events within this week
                return $event->date->isCurrentWeek() && 
                       $event->date->startOfDay()->greaterThanOrEqualTo($today);
            })->sortBy('date'); // Sort by date to show nearest events first
        @endphp
        
        @if($weekEvents->count() > 0)
            <div class="space-y-3">
                @foreach($weekEvents as $event)
                <div class="flex">
                    <!-- Date Box -->
                    <div class="flex-shrink-0 w-16 h-16 {{ $event->date->isToday() ? 'bg-lime-200' : 'bg-lime-100' }} rounded-lg flex flex-col items-center justify-center mr-3">
                        <span class="text-2xl font-bold text-lime-500">{{ $event->date->format('d') }}</span>
                        <span class="text-xs text-lime-600">{{ $event->date->format('M') }}</span>
                    </div>
                    
                    <!-- Event Details Box -->
                    <div class="flex-grow w-16 h-16 bg-gray-100 rounded-lg p-3">
                        <div class="text-sm font-medium text-gray-800">{{ $event->title }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ date('H:i', strtotime($event->start_time)) }} - {{ date('H:i', strtotime($event->end_time)) }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-sm text-gray-600 italic">
                No upcoming events scheduled for this week
            </div>
        @endif
    </div>

    <!-- See All Activities Button -->
    <div class="mt-6 text-center">
        <a onclick="switchTab('upcoming')"  
           class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-lime-600 bg-white border border-lime-500 rounded-lg hover:bg-lime-50 transition-colors duration-200">
            <i class="fas fa-calendar-alt mr-2"></i>
            See All Activities
        </a>
    </div>
</div>


        <!-- Simplified calendar container -->
        <div class="calendar-container">
            <div class="custom-calendar-view">
                <div class="calendar-header">
                    <button onclick="previousMonth()" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <h2 id="currentMonthYear" class="text-xl font-semibold text-gray-800"></h2>
                    <button onclick="nextMonth()" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="calendar-grid" id="calendarDays">
                    <!-- Day headers -->
                    <div class="calendar-day-header">Sun</div>
                    <div class="calendar-day-header">Mon</div>
                    <div class="calendar-day-header">Tue</div>
                    <div class="calendar-day-header">Wed</div>
                    <div class="calendar-day-header">Thu</div>
                    <div class="calendar-day-header">Fri</div>
                    <div class="calendar-day-header">Sat</div>
                    <!-- Calendar days will be inserted here by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

          <!-- Upcoming Events Tab Content -->
<div id="upcoming-tab" class="tab-content h-[calc(100vh-150px)]">
    <div class="flex space-x-6 h-full"> <!-- Removed relative -->
        <!-- Left sidebar - Fixed width placeholder -->
        <div class="w-72 flex-shrink-0"> <!-- This div acts as a placeholder -->
            <!-- Fixed position navigation -->
            <div class="w-72 bg-white rounded-xl shadow-sm p-4 fixed">
                <button onclick="openModal()" class="add-nav-button">
                    <i class="fas fa-plus mr-2"></i>
                    Add Event
                </button>
                
                <div class="nav-buttons-container">
                    <button onclick="scrollToSection('today')" class="nav-button w-full text-left px-4 py-3 rounded-lg text-gray-600 mb-2">
                        <i class="fas fa-calendar-day mr-2"></i>
                        Today's Events
                    </button>
                    <button onclick="scrollToSection('week')" class="nav-button w-full text-left px-4 py-3 rounded-lg text-gray-600 mb-2">
                        <i class="fas fa-calendar-week mr-2"></i>
                        This Week's Events
                    </button>
                    <button onclick="scrollToSection('month')" class="nav-button w-full text-left px-4 py-3 rounded-lg text-gray-600 mb-2">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        This Month's Events
                    </button>
                    <button onclick="scrollToSection('future')" class="nav-button w-full text-left px-4 py-3 rounded-lg text-gray-600 mb-2">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Future Events
                    </button>
                    <button onclick="scrollToSection('past')" class="nav-button w-full text-left px-4 py-3 rounded-lg text-gray-600">
                        <i class="fas fa-history mr-2"></i>
                        Past Events
                    </button>
                </div>
            </div>
        </div>

        <!-- Right content area -->
        <div class="flex-1">
            <!-- Add a container with matching calendar styles -->
            <div class="custom-calendar-list rounded-xl">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Events Lists</h2>
                    <a href="{{ route('schedule.pdf') }}" class="text-gray-600 hover:text-gray-700">
                        <i class="fas fa-share-alt mr-2"></i>
                        generate reports
                    </a>
                </div>

                <!-- Scrollable container for sections -->
                <div class="events-container">
                    <!-- All sections wrapper -->
                    <div class="sections-wrapper">
                        <!-- Today's Events Section -->
                        <div id="today-section" class="section-content hidden">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <i class="fas text-lime-500 mr-2"></i>
                                
                            </h3>
                            @php
                                $todayEvents = $events->filter(function($event) {
                                    return $event->date->isToday();
                                })->sortBy('start_time');
                            @endphp

                            @if($todayEvents->count() > 0)
                                <div class="space-y-4">
                                    @foreach($todayEvents as $event)
                                    <div class="flex items-start space-x-4 event-card hover:shadow-md transition-all duration-200">
                                        <!-- Date Box -->
                                        <div class="flex-shrink-0 w-16 bg-lime-100 rounded-lg p-2 text-center">
                                            <div class="text-2xl font-bold text-lime-600">{{ $event->date->format('d') }}</div>
                                            <div class="text-sm text-lime-600">{{ $event->date->format('M') }}</div>
                                        </div>

                                        <!-- Event Details -->
                                        <div class="flex-1 bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-center justify-between">
                                                <h3 class="font-medium text-gray-800">{{ $event->title }}</h3>
                                                <button class="text-gray-400 hover:text-gray-600 toggle-details">
                                                    <i class="fas fa-chevron-down transition-transform duration-200"></i>
                                                </button>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                <div class="flex items-center mb-1">
                                                    <i class="far fa-clock mr-2"></i>
                                                    {{ date('H:i', strtotime($event->start_time)) }} - {{ date('H:i', strtotime($event->end_time)) }}
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    {{ $event->location }}
                                                </div>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                For: {{ $event->program }}
                                            </div>
                                            <!-- Hidden details section -->
                                            <div class="hidden event-details mt-3 pt-3 border-t border-gray-200">
                                                <p class="text-sm text-gray-600">{{ $event->description }}</p>
                                                <div class="mt-2 text-sm text-gray-500">
                                                    <div><i class="fas fa-envelope mr-2"></i>{{ $event->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-4 text-gray-600 text-center">
                                    No events scheduled for today
                                </div>
                            @endif
                        </div>

                        <!-- Week's Events Section -->
                        <div id="week-section" class="section-content hidden">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <i class="fas  text-lime-500 mr-2"></i>
                                
                            </h3>
                            @php
                                $weekEvents = $events->filter(function($event) {
                                    // Only show current week's future events and today's events
                                    return $event->date->isCurrentWeek() && 
                                           ($event->date->isToday() || $event->date->isFuture());
                                })->sortBy('date');
                            @endphp

                            @if($weekEvents->count() > 0)
                                <div class="space-y-4">
                                    @foreach($weekEvents as $event)
                                    <div class="flex items-start space-x-4 event-card hover:shadow-md transition-all duration-200">
                                        <!-- Date Box -->
                                        <div class="flex-shrink-0 w-16 bg-lime-100 rounded-lg p-2 text-center">
                                            <div class="text-2xl font-bold text-lime-600">{{ $event->date->format('d') }}</div>
                                            <div class="text-sm text-lime-600">{{ $event->date->format('M') }}</div>
                                        </div>

                                        <!-- Event Details -->
                                        <div class="flex-1 bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-center justify-between">
                                                <h3 class="font-medium text-gray-800">{{ $event->title }}</h3>
                                                <button class="text-gray-400 hover:text-gray-600 toggle-details">
                                                    <i class="fas fa-chevron-down transition-transform duration-200"></i>
                                                </button>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                <div class="flex items-center mb-1">
                                                    <i class="far fa-clock mr-2"></i>
                                                    {{ date('H:i', strtotime($event->start_time)) }} - {{ date('H:i', strtotime($event->end_time)) }}
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    {{ $event->location }}
                                                </div>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                For: {{ $event->program }}
                                            </div>
                                            <!-- Hidden details section -->
                                            <div class="hidden event-details mt-3 pt-3 border-t border-gray-200">
                                                <p class="text-sm text-gray-600">{{ $event->description }}</p>
                                                <div class="mt-2 text-sm text-gray-500">
                                                    <div><i class="fas fa-envelope mr-2"></i>{{ $event->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-4 text-gray-600 text-center">
                                    No events scheduled for this week
                                </div>
                            @endif
                        </div>

                        <!-- Month's Events Section -->
                        <div id="month-section" class="section-content hidden">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <i class="fas  text-lime-500 mr-2"></i>
                               
                            </h3>
                            @php
                                $monthEvents = $events->filter(function($event) {
                                    // Only show current month's future events and exclude current week
                                    return $event->date->isCurrentMonth() && 
                                           !$event->date->isCurrentWeek() && 
                                           $event->date->isFuture();
                                })->sortBy('date');
                            @endphp

                            @if($monthEvents->count() > 0)
                                <div class="space-y-4">
                                    @foreach($monthEvents as $event)
                                    <div class="flex items-start space-x-4 event-card hover:shadow-md transition-all duration-200">
                                        <!-- Date Box -->
                                        <div class="flex-shrink-0 w-16 bg-lime-100 rounded-lg p-2 text-center">
                                            <div class="text-2xl font-bold text-lime-600">{{ $event->date->format('d') }}</div>
                                            <div class="text-sm text-lime-600">{{ $event->date->format('M') }}</div>
                                        </div>

                                        <!-- Event Details -->
                                        <div class="flex-1 bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-center justify-between">
                                                <h3 class="font-medium text-gray-800">{{ $event->title }}</h3>
                                                <button class="text-gray-400 hover:text-gray-600 toggle-details">
                                                    <i class="fas fa-chevron-down transition-transform duration-200"></i>
                                                </button>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                <div class="flex items-center mb-1">
                                                    <i class="far fa-clock mr-2"></i>
                                                    {{ date('H:i', strtotime($event->start_time)) }} - {{ date('H:i', strtotime($event->end_time)) }}
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    {{ $event->location }}
                                                </div>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                For: {{ $event->program }}
                                            </div>
                                            <!-- Hidden details section -->
                                            <div class="hidden event-details mt-3 pt-3 border-t border-gray-200">
                                                <p class="text-sm text-gray-600">{{ $event->description }}</p>
                                                <div class="mt-2 text-sm text-gray-500">
                                                    <div><i class="fas fa-envelope mr-2"></i>{{ $event->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-4 text-gray-600 text-center">
                                    No events scheduled for this month
                                </div>
                            @endif
                        </div>

                        <!-- Future Events Section -->
                        <div id="future-section" class="section-content hidden">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <i class="fas  text-lime-500 mr-2"></i>
                                
                            </h3>
                            @php
                                $futureEvents = $events->filter(function($event) {
                                    // Only show events after current month
                                    return $event->date->isAfter(now()->endOfMonth());
                                })->sortBy('date');
                            @endphp

                            @if($futureEvents->count() > 0)
                                <div class="space-y-4">
                                    @foreach($futureEvents as $event)
                                    <div class="flex items-start space-x-4 event-card hover:shadow-md transition-all duration-200">
                                        <!-- Date Box -->
                                        <div class="flex-shrink-0 w-16 bg-lime-100 rounded-lg p-2 text-center">
                                            <div class="text-2xl font-bold text-lime-600">{{ $event->date->format('d') }}</div>
                                            <div class="text-sm text-lime-600">{{ $event->date->format('M') }}</div>
                                        </div>

                                        <!-- Event Details -->
                                        <div class="flex-1 bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-center justify-between">
                                                <h3 class="font-medium text-gray-800">{{ $event->title }}</h3>
                                                <button class="text-gray-400 hover:text-gray-600 toggle-details">
                                                    <i class="fas fa-chevron-down transition-transform duration-200"></i>
                                                </button>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                <div class="flex items-center mb-1">
                                                    <i class="far fa-clock mr-2"></i>
                                                    {{ date('H:i', strtotime($event->start_time)) }} - {{ date('H:i', strtotime($event->end_time)) }}
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    {{ $event->location }}
                                                </div>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                For: {{ $event->program }}
                                            </div>
                                            <!-- Hidden details section -->
                                            <div class="hidden event-details mt-3 pt-3 border-t border-gray-200">
                                                <p class="text-sm text-gray-600">{{ $event->description }}</p>
                                                <div class="mt-2 text-sm text-gray-500">
                                                    <div><i class="fas fa-envelope mr-2"></i>{{ $event->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-4 text-gray-600 text-center">
                                    No future events scheduled
                                </div>
                            @endif
                        </div>

                        <!-- Past Events Section -->
                        <div id="past-section" class="section-content hidden">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <i class="fas  text-lime-500 mr-2"></i>
                                
                            </h3>
                            @php
                                $pastEvents = $events->filter(function($event) {
                                    // Show all past events except today
                                    return $event->date->isPast() && !$event->date->isToday();
                                })->sortByDesc('date');
                            @endphp

                            @if($pastEvents->count() > 0)
                                <div class="space-y-4">
                                    @foreach($pastEvents as $event)
                                    <div class="flex items-start space-x-4 event-card hover:shadow-md transition-all duration-200">
                                        <!-- Date Box -->
                                        <div class="flex-shrink-0 w-16 bg-gray-100 rounded-lg p-2 text-center">
                                            <div class="text-2xl font-bold text-gray-600">{{ $event->date->format('d') }}</div>
                                            <div class="text-sm text-gray-600">{{ $event->date->format('M') }}</div>
                                        </div>

                                        <!-- Event Details -->
                                        <div class="flex-1 bg-gray-50 rounded-lg p-4">
                                            <div class="flex items-center justify-between">
                                                <h3 class="font-medium text-gray-800">{{ $event->title }}</h3>
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-xs px-2 py-1 bg-gray-200 text-gray-600 rounded-full">Past</span>
                                                    <button class="text-gray-400 hover:text-gray-600 toggle-details">
                                                        <i class="fas fa-chevron-down transition-transform duration-200"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                <div class="flex items-center mb-1">
                                                    <i class="far fa-clock mr-2"></i>
                                                    {{ date('H:i', strtotime($event->start_time)) }} - {{ date('H:i', strtotime($event->end_time)) }}
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    {{ $event->location }}
                                                </div>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-2">
                                                For: {{ $event->program }}
                                            </div>
                                            <!-- Hidden details section -->
                                            <div class="hidden event-details mt-3 pt-3 border-t border-gray-200">
                                                <p class="text-sm text-gray-600">{{ $event->description }}</p>
                                                <div class="mt-2 text-sm text-gray-500">
                                                    <div><i class="fas fa-envelope mr-2"></i>{{ $event->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-4 text-gray-600 text-center">
                                    No past events found
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Create Event Modal -->
    <div id="eventModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-xl">
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-xl font-semibold text-gray-800">Create New Event</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="{{ route('schedule.store') }}" method="POST" class="p-6">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Event Title</label>
                            <input type="text" name="title" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date</label>
                                <input type="date" name="date" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Start Time</label>
                                <input type="time" name="start_time" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">End Time</label>
                                <input type="time" name="end_time" required
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Program</label>
                            <select name="program" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                <option value="">Select a program</option>
                                <option value="Bachelor of Performing Arts">Bachelor of Performing Arts</option>
                                <option value="Bachelor of Public Administration">Bachelor of Public Administration</option>
                                <option value="Bachelor of Science in Biology">Bachelor of Science in Biology</option>
                                <option value="Bachelor of Science in Environmental Science">Bachelor of Science in Environmental Science</option>
                                <option value="Bachelor of Science in Exercise Sports and Sciences">Bachelor of Science in Exercise Sports and Sciences</option>
                                <option value="Bachelor of Science in Mathematics">Bachelor of Science in Mathematics</option>
                                <option value="Bachelor of Science in Social Work">Bachelor of Science in Social Work</option>
                                <option value="Liberal Arts Program">Liberal Arts Program</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="3" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-lime-500 text-white rounded-lg hover:bg-lime-600">
                            Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal -->
<div id="editEventModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-xl font-semibold text-gray-800">Edit Event</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editEventForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <!-- Form fields will be populated via JavaScript -->
                <div class="space-y-6">
                    <!-- Same form fields as create modal, but with id="edit_fieldname" -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Event Title</label>
                        <input type="text" name="title" id="edit_title" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                    </div>
                    <!-- ... rest of the form fields ... -->
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-lime-500 text-white rounded-lg hover:bg-lime-600">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        

        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });

            // Remove active state from all tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-lime-500', 'text-lime-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(`${tabName}-tab`).classList.add('active');

            // Update active tab button
            event.currentTarget.classList.remove('border-transparent', 'text-gray-500');
            event.currentTarget.classList.add('border-lime-500', 'text-lime-600');
        }

        function openModal() {
            document.getElementById('eventModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }


         // Function to update the date display
    function updateDateTime() {
        const now = new Date();
        
        // Update date number
        document.getElementById('currentDate').textContent = now.getDate();
        
        // Update day name
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        document.getElementById('currentDay').textContent = days[now.getDay()];
        
        // Update month and year
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 
                       'July', 'August', 'September', 'October', 'November', 'December'];
        document.getElementById('currentMonth').textContent = `${months[now.getMonth()]} ${now.getFullYear()}`;
    }

    // Update immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);

    document.addEventListener('DOMContentLoaded', function() {
    // Scroll to specific position after a slight delay to ensure content is loaded
    setTimeout(() => {
        window.scrollTo({
            top: 100, // Adjust this value to control how far down to scroll
            behavior: 'smooth'
        });
    }, 100);
});

// Function to scroll to specific section
function scrollToSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.section-content').forEach(section => {
        section.classList.add('hidden');
    });
    
    // Show selected section
    const section = document.getElementById(sectionId + '-section');
    if (section) {
        section.classList.remove('hidden');
        
        // Scroll container to top when switching sections
        document.querySelector('.events-container').scrollTop = 0;
        
        // Update active state of buttons
        document.querySelectorAll('.w-72 button').forEach(btn => {
            btn.classList.remove('bg-lime-100', 'text-lime-700');
            btn.classList.add('text-gray-600');
        });
        
        // Add active state to clicked button
        event.currentTarget.classList.remove('text-gray-600');
        event.currentTarget.classList.add('bg-lime-100', 'text-lime-700');
    }
}
// Toggle event details
document.addEventListener('click', function(e) {
    if (e.target.closest('.toggle-details')) {
        const button = e.target.closest('.toggle-details');
        const detailsSection = button.closest('.flex-1').querySelector('.event-details');
        const icon = button.querySelector('i');
        
        detailsSection.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
});

// Automatically scroll to today's events when the list view is opened
document.addEventListener('DOMContentLoaded', function() {
    scrollToSection('today');
});

let currentDate = new Date();
let events = @json($events); // Pass Laravel events to JavaScript

function formatTime(timeString) {
    // Extract only the time portion if there's a date included
    const timePart = timeString.split(' ')[1] || timeString;
    // Ensure consistent 24-hour format with leading zeros
    const [hours, minutes] = timePart.split(':');
    const formattedHours = String(hours).padStart(2, '0');
    const formattedMinutes = String(minutes).padStart(2, '0');
    return `${formattedHours}:${formattedMinutes}`;
}

function renderCalendar() {
    const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
    const startingDay = firstDay.getDay();
    const monthDays = lastDay.getDate();

    // Update header
    document.getElementById('currentMonthYear').textContent = firstDay.toLocaleDateString('en-US', { 
        month: 'long', 
        year: 'numeric' 
    });
    

    // Clear existing calendar days
    const calendarDays = document.getElementById('calendarDays');
    const dayHeaders = Array.from(calendarDays.querySelectorAll('.calendar-day-header'));
    calendarDays.innerHTML = '';    
    dayHeaders.forEach(header => calendarDays.appendChild(header));

    // Add empty cells for days before the first day of the month
    for (let i = 0; i < startingDay; i++) {
        const emptyDay = document.createElement('div');
        emptyDay.className = 'calendar-day';
        calendarDays.appendChild(emptyDay);
    }

    // Add days of the month
    for (let day = 1; day <= monthDays; day++) {
        const dayCell = document.createElement('div');
        dayCell.className = 'calendar-day';
        
        const currentDateString = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayEvents = events.filter(event => event.date.startsWith(currentDateString));

        // Check if it's today
        const today = new Date();
        if (day === today.getDate() && 
            currentDate.getMonth() === today.getMonth() && 
            currentDate.getFullYear() === today.getFullYear()) {
            dayCell.classList.add('today');
        }

        // Add event indicators
        if (dayEvents.length > 0) {
            dayCell.classList.add('has-event');
            
            // Create event preview
            const preview = document.createElement('div');
            preview.className = 'event-preview';
            
            dayEvents.forEach(event => {
                const eventItem = document.createElement('div');
                eventItem.className = 'event-preview-item';
                eventItem.innerHTML = `
                    <div class="flex-grow bg-gray-100 rounded-lg p-3">
                        <div class="text-sm font-medium text-gray-800">${event.title}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            ${date('H:i', strtotime(event.start_time))} - ${date('H:i', strtotime(event.end_time))}
                        </div>
                    </div>
                `;
                preview.appendChild(eventItem);
            });
            
            dayCell.appendChild(preview);
        }

        dayCell.innerHTML += `<div>${day}</div>`;
        calendarDays.appendChild(dayCell);
    }
}

function previousMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

// Initial render
renderCalendar();

// Add these helper functions to mimic PHP's date and strtotime functions
function strtotime(timeStr) {
    return new Date(timeStr).getTime();
}

function date(format, timestamp) {
    const date = new Date(timestamp);
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
}

    </script>
</body>
</html>