<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Note $note)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string',
            'description' => 'nullable|string'
        ]);

        // Create the review
        $review = new Review();
        $review->rating = $validatedData['rating'];
        $review->title = $validatedData['title'];
        $review->description = $validatedData['description'] ?? null; // Ensure description is nullable
        $review->user_id = auth()->id(); // Assuming you are using authentication

        // Save the review for the current note
        $note->reviews()->save($review);

        // Optionally, you can return a response (e.g., redirect back to the note page)
        return redirect()->route('notes.describe', ['note' => $note->id])
            ->with('success', 'Review added successfully.');
    }

    public function update(Request $request, Note $note, Review $review)
    {
        // Check if the current user is authorized to update the review
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update the attributes of the existing $review object
        $review->rating = $request->input('rating');
        $review->title = $request->input('title');
        $review->description = $request->input('description');

        // Save the updated review to the database
        $review->save();

        // Redirect back with a success message
        return redirect()->route('notes.describe', ['note' => $review->note_id])
            ->with('success', 'Review updated successfully.');
    }

    
}
