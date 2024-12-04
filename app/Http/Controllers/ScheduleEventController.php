<?php

namespace App\Http\Controllers;

use App\Models\ScheduleEvent;
use Illuminate\Http\Request;
use PDF;

class ScheduleEventController extends Controller
{
    public function index()
    {
        $events = ScheduleEvent::all();
        return view('schedule.index', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'program' => 'required|string',
            'email' => 'required|email',
            'description' => 'required|string'
        ]);

        ScheduleEvent::create($validated);

        return redirect()->route('schedule.index')
            ->with('success', 'Event created successfully.');
    }

    public function getEvents()
    {
        $events = ScheduleEvent::all()->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->date . ' ' . $event->start_time,
                'end' => $event->date . ' ' . $event->end_time,
                'url' => route('schedule.show', $event->id)
            ];
        });

        return response()->json($events);
    }

    public function generatePDF()
    {
        $events = ScheduleEvent::all();
        $pdf = PDF::loadView('schedule.pdf', compact('events'));
        return $pdf->download('schedule-events.pdf');
    }
    
}
