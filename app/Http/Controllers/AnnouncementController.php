<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    private $programs;

    public function __construct()
    {
        $this->programs = config('programs.list');
    }

    public function index()
    {
        $announcements = Announcement::orderBy('target_date', 'desc')->get();
        $totalAnnouncements = Announcement::count();
        $activeAnnouncements = Announcement::where('target_date', '>=', now())->count();

        return view('announcements.index', compact('announcements', 'totalAnnouncements', 'activeAnnouncements'));
    }

    public function create()
    {
        $programs = $this->programs;
        return view('announcements.create', compact('programs'));
    }

    public function edit(Announcement $announcement)
    {
        $programs = $this->programs;
        return view('announcements.edit', compact('announcement', 'programs'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'title' => 'required|string|max:255',
                'program' => 'required|string',
                'content' => 'required|string|max:150',
                'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:500480',
                'display_duration' => 'required|integer|min:1',
                'target_date' => 'required|date|after_or_equal:today',
                'signature_text' => 'required_without:signature_image',
                'signature_image' => 'required_without:signature_text|nullable|file|mimes:jpeg,png,jpg|max:20480',
            ]);

            // Create new announcement
            $announcement = new Announcement();
            $announcement->email = $validated['email'];
            $announcement->title = $validated['title'];
            $announcement->program = $validated['program'];
            $announcement->content = $validated['content'];
            $announcement->display_duration = $validated['display_duration'];
            $announcement->target_date = $validated['target_date'];

            // Handle signature (either text or image)
            if ($request->hasFile('signature_image')) {
                $signatureFile = $request->file('signature_image');
                $signaturePath = $signatureFile->store('signatures', 'public');
                $announcement->digital_signature = $signaturePath;
            } else {
                $announcement->digital_signature = $validated['signature_text'];
            }

            // Handle media upload if present
            if ($request->hasFile('media')) {
                $file = $request->file('media');
                $path = $file->store('announcements', 'public');
                $announcement->media_path = $path;
                $announcement->media_type = $file->getMimeType();
                
                if (str_starts_with($file->getMimeType(), 'video')) {
                    $announcement->video_length = $request->input('video_length', 0);
                }
            }

            $announcement->save();

            return response()->json(['success' => true, 'message' => 'Announcement created successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'program' => 'required|string',
            'target_date' => 'required|date',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,MP4|max:500480'
        ]);

        $announcement->title = $validated['title'];
        $announcement->content = $validated['content'];
        $announcement->program = $validated['program'];
        $announcement->target_date = $validated['target_date'];

        if ($request->hasFile('media')) {
            // Delete old media if exists
            if ($announcement->media_path) {
                Storage::disk('public')->delete($announcement->media_path);
            }

            $file = $request->file('media');
            $path = $file->store('announcements', 'public');
            $announcement->media_path = $path;
            $announcement->media_type = $file->getMimeType();
            
            if (str_starts_with($file->getMimeType(), 'video')) {
                $announcement->video_length = 0; // You would need to implement video length detection
            }
        }

        $announcement->save();

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully');
    }

    public function destroy(Announcement $announcement)
    {
        if ($announcement->media_path) {
            Storage::disk('public')->delete($announcement->media_path);
        }
        
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully');
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'type' => 'required|in:week,month,year'
        ]);

        $query = Announcement::query();

        switch ($request->type) {
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
                break;
            case 'year':
                $query->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()]);
                break;
        }

        $announcements = $query->get();
        
        $pdf = PDF::loadView('announcements.report', compact('announcements'));
        return $pdf->download('announcements-report.pdf');
    }

    public function filterByProgram(Request $request)
    {
        $request->validate([
            'programs' => 'required|array',
            'programs.*' => 'string'
        ]);

        $announcements = Announcement::whereIn('program', $request->programs)
            ->orderBy('target_date', 'desc')
            ->get();

        return response()->json($announcements);
    }

    public function generatePDF(Request $request)
    {
        $period = $request->period;
        $date = $request->date;
        
        $announcements = Announcement::when($period === 'week', function($query) use ($date) {
            return $query->whereBetween('target_date', [
                \Carbon\Carbon::parse($date)->startOfWeek(),
                \Carbon\Carbon::parse($date)->endOfWeek()
            ]);
        })->when($period === 'month', function($query) use ($date) {
            return $query->whereYear('target_date', \Carbon\Carbon::parse($date)->year)
                        ->whereMonth('target_date', \Carbon\Carbon::parse($date)->month);
        })->get();

        $pdf = PDF::loadView('announcements.pdf', compact('announcements'));
        return $pdf->download('announcements.pdf');
    }

    public function getFeatured()
    {
        $announcements = Announcement::orderBy('target_date', 'desc')->get();
        return view('announcements.featured', compact('announcements'));
    }

    public function getStats()
    {
        return response()->json([
            'totalAnnouncements' => Announcement::count(),
            'activeAnnouncements' => Announcement::where('target_date', '>=', now())->count()
        ]);
    }

    public function getLatest()
    {
        $announcement = Announcement::orderBy('created_at', 'desc')->first();
        return response()->json([
            'announcement' => $announcement
        ]);
    }
}