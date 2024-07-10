<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_group_id',
        'comment'
    ];

    public function group()
    {
        return $this->belongsTo(StudentGroup::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
