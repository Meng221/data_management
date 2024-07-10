<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptEdit extends Model
{
    use HasFactory;

    public function edits()
    {
        return $this->hasMany(ThesisEdit::class, 'accept_edit_id');
    }
}
