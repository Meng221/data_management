<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;

    // Explicitly specify the table name if it doesn't follow the convention
    protected $table = 'tbplans';
}
