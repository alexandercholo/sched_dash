<div class="flex items-start space-x-4">
    <!-- Date Box -->
    <div class="flex-shrink-0 w-16 bg-lime-100 rounded-lg p-2 text-center">
        <div class="text-2xl font-bold text-lime-600">{{ $event->date->format('d') }}</div>
        <div class="text-sm text-lime-600">{{ $event->date->format('M') }}</div>
    </div>

    <!-- Event Details -->
    <div class="flex-1 bg-gray-50 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <h3 class="font-medium text-gray-800">{{ $event->title }}</h3>
            <button class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-chevron-down"></i>
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
    </div>
</div> 