<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Note;
use App\Models\Subject;
use Carbon\Carbon;

class NotesTableSeeder extends Seeder
{
    public function run()
    {
        $userId = 1; // Assuming you have a user with ID 1, or change accordingly

        // Fetch existing subjects
        $subjectIds = Subject::pluck('id')->toArray();

        for ($i = 0; $i < 1000; $i++) {
            Note::create([
                'title' => 'Sample Note ' . Str::random(5),
                'language' => 'English',
                'path' => 'path/to/file' . Str::random(5) . '.txt',
                'description' => 'This is a sample note description.',
                'download_count' => rand(1, 100),
                'user_id' => $userId,
                'subject_id' => $subjectIds[array_rand($subjectIds)],
                'created_at' => Carbon::now()->subDays(rand(0, 365)),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
