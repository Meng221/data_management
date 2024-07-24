<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_number',
        'thesis_topic_id',
        'year',
        'room',
        'academic_year',
        'degree',
        'level',
        'major',
        'system',
        'study_time',
        'advisor',
        'allow',
        'user_id',
        'advisor_id',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'group_id');
    }
    public function thesisTopic()
    {
        // return $this->belongsTo(ThesisTopic::class, 'thesis_topic_id');
        return $this->belongsTo(ThesisTopic::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
