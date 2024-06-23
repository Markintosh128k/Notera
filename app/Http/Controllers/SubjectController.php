<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Note;

class SubjectController extends Controller
{
    public function showNotes(Request $request)
    {
        $subject_id = $request->input('subject');

        // Fetch the subject details
        $subject = Subject::find($subject_id);

        // Check if the subject exists
        if (!$subject) {
            return redirect()->route('subjects.index')->with('error', 'Subject not found.');
        }

        // Fetch notes related to the subject
        $notes = Note::where('subject_id', $subject_id)->get();

        // Return the view with the notes and subject details
        return view('notes.show', compact('notes', 'subject'));
    }
}
