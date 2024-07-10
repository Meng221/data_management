<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisEdit extends Model
{
    use HasFactory;

    protected $fillable = [
        'thesis_topic_id',
        'accept_edit_id'
    ];


    public function thesisTopic()
    {
        return $this->belongsTo(ThesisTopic::class, 'thesis_topic_id');
    }

    public function acceptEdit()
    {
        return $this->belongsTo(AcceptEdit::class, 'accept_edit_id');
    }


}
