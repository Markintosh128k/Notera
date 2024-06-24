<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\Subject;
use Carbon\Carbon;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Total notes uploaded by the user
        $totalNotes = Note::where('user_id', $user->id)->get();

        // Notes per subject
        $notesPerSubject = Note::select('subject_id', Subject::raw('count(*) as total'))
            ->where('user_id', $user->id)
            ->groupBy('subject_id')
            ->with('subject')
            ->get();

        // Total number of downloads
        $totalDownloads = Note::where('user_id', $user->id)->sum('download_count');

        // Prepare data for the graph
        $startDate = Carbon::now()->subYear(); // Last year
        $endDate = Carbon::now();
        $notesPerDay = Note::where('user_id', $user->id)
                            ->whereBetween('created_at', [$startDate, $endDate])
                            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get();

        // Get all subjects (assuming you have a Subject model)
        $subjects = Subject::all();

        return view('account.dashboard', compact('user', 'totalNotes', 'notesPerSubject', 'totalDownloads', 'notesPerDay', 'subjects'));
    }

    public function settings()
    {
        $user = Auth::user();

        return view('account.settings', compact('user'));

    }
}
