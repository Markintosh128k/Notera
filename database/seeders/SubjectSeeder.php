<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            "Mathematics" => 1,
            "Science" => 2,
            "History" => 3,
            "Physics" => 4,
            "Chemistry" => 5,
            "Biology" => 6,
            "Informatics" => 7,
            "Art" => 8,
            "Sociology" => 9,
            "Engineering" => 10,
            "Medicine" => 11,
            "Philosophy" => 12,
            "Economics" => 13,
            "Law" => 14,
            "Business" => 15,
            "Psychology" => 16
        ];

        foreach ($subjects as $name => $id) {
            DB::table('subjects')->insert([
                'id' => $id,
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
