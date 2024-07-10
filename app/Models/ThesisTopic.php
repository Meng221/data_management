<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'type_id',
        'topic_name',
        'topic_name_eng',
    ];

    // define relation with Student Group table
    public function studentGroup()
    {
        return $this->hasOne(StudentGroup::class);
    }

    // define relation with types table
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // define relation with Thesis book table
    public function book()
    {
        return $this->belongsTo(ThesisBook::class, 'book_id');
    }

    // define relation with Thesis book table
    public function thesisedit()
    {
        return $this->hasOne(ThesisEdit::class);
    }
    public function scoreAndComments()
    {
        return $this->hasMany(ScoreAndComment::class);
    }

    public function edits()
    {
        return $this->hasMany(ThesisEdit::class, 'thesis_topic_id');
    }

    protected $table = 'thesis_topics';
}
