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
        if (array_key_exists('description', $validatedData)) {
            $review->description = $validatedData['description'];
        }
        $review->user_id = auth()->id(); // Assuming you are using authentication

        // Save the review for the current note
        $note->reviews()->save($review);

        // Optionally, you can return a response (e.g., redirect back to the note page)
        return redirect()->route('notes.describe', ['note' => $note->id])
            ->with('success', 'Review added successfully.');
    }
}
