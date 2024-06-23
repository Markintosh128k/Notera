<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\Subject;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Total notes uploaded by the user
        $totalNotes = Note::where('user_id', $user->id)->count();

        // Notes per subject
        $notesPerSubject = Note::select('subject_id', Subject::raw('count(*) as total'))
            ->where('user_id', $user->id)
            ->groupBy('subject_id')
            ->with('subject')
            ->get();



        // Total number of downloads
        $totalDownloads = Note::where('user_id', $user->id)->sum('download_count');

        return view('account.dashboard', compact('totalNotes', 'notesPerSubject', 'totalDownloads'));
    }
}
