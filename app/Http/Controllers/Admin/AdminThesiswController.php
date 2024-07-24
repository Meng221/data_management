<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThesisBook;
use App\Models\ThesisTopic;
use App\Models\Advisor;
use App\Models\StudentGroup;

class AdminThesiswController extends Controller
{
    public function show()
    {
        $thesisTopics = ThesisTopic::with(['book', 'edits'])->whereNotNull('book_id')->paginate(10);
        return view('admin.thesis', compact('thesisTopics'));
    }
}
