<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\ScheduleEvent;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get total number of students
        $totalStudents = User::where('role', 'student')->count();

        // Get upcoming schedule events
        $scheduleEvents = ScheduleEvent::where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->orderBy('start_time')
            ->take(5)
            ->get();

        // Get active announcements
        $announcements = Announcement::where('target_date', '>=', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('admin.AdminDashboard', compact(
            'totalStudents',
            'scheduleEvents',
            'announcements'
        ));
    }
} 