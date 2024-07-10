<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreAndComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'thesis_topic_id',
        'student_id',
        'user_id',
        'lesson_4',
        'lesson_5',
        'thesis',
        'poster',
        'project',
        'presentation',
        'q_and_a',
        'average',
        'comment'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
