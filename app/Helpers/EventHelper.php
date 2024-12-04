<?php

if (!function_exists('isActiveEvent')) {
    function isActiveEvent($event) {
        $eventEndDateTime = Carbon\Carbon::parse($event->date->format('Y-m-d') . ' ' . $event->end_time);
        return $eventEndDateTime->isFuture();
    }
} 