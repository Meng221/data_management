<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThesisEdit;
use App\Models\ThesisTopic;

class AdminAcceptThesisController extends Controller
{
    public function show()
    {
        $thesisTopics = ThesisTopic::with(['edits', 'studentGroup'])->paginate(10);
        return view('admin.accept', compact('thesisTopics'));
    }
}
