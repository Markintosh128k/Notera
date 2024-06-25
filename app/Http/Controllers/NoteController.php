<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function create()
    {
        $subjects = Subject::all();
        $languages = ['English', 'Spanish', 'French', 'German']; // Replace with your actual languages
        return view('notes.create', compact('subjects', 'languages'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx',
            'subject_id' => 'required|exists:subjects,id',
            'language' => 'required|string|max:255',
        ]);

        $note = new Note();
        $note->title = $request->input('title');
        $note->description = $request->input('description');
        $note->subject_id = $request->input('subject_id');
        $note->language = $request->input('language');
        $note->user_id = Auth::id();
        if ($request->hasFile('file')) {
            $note->path = $request->file('file')->store('notes', 'public');
        }
        $note->save();

        return redirect('/')
            ->with('success', 'Note has been uploaded successfully.');
    }


    public function destroy(Note $note)
    {
        if (! Gate::allows('delete-note', $note)) {
            abort(403);
        }

        $note->delete();

        return redirect()->route('account.dashboard')
                         ->with('delete-ok', 'Note deleted successfully.');
    }

    public function describe(Note $note)
    {
        $note->load('reviews.user'); // Eager load the reviews and their associated users
        return view('notes.describe', compact('note'));
    }
}
