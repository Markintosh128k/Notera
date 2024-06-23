<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Get all notes of the subject that a specific user has uploaded.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function notesByUser($userId)
    {
        return $this->notes()->where('user_id', $userId)->get();
    }
}
