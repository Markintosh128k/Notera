<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Note;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all subjects from the database
        $subjects = Subject::all();

        // Define emojis for subjects
        $emojis = [
            "Mathematics" => "📐",
            "Science" => "🔬",
            "History" => "📜",
            "Physics" => "⚛️",
            "Chemistry" => "🧪",
            "Biology" => "🧬",
            "Informatics" => "💻",
            "Art" => "🎨",
            "Sociology" => "📊",
            "Engineering" => "🛠️",
            "Medicine" => "🩺",
            "Philosophy" => "📚",
            "Economics" => "💵",
            "Law" => "⚖️",
            "Business" => "📈",
            "Psychology" => "🧠",
        ];
        $default_emoji = "📘";

        // Return the home view and pass the subjects and emojis data
        return view('home', compact('subjects', 'emojis', 'default_emoji'));
    }

}
