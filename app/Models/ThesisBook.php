<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_file',
        'type'
    ];

    public function topic()
    {
        return $this->hasOne(ThesisTopic::class, 'book_id');
    }
}