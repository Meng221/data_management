<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScoreAndComment;
use App\Models\StudentGroup;
use App\Models\ThesisTopic;
use App\Models\Comment;

class AdminShowController extends Controller
{
    public function showscore() {
        $thesisTopics = ThesisTopic::with(['studentGroup.students', 'scoreAndComments'])
            ->whereHas('scoreAndComments', function ($query) {
                $query->whereNotNull('thesis_topic_id');
            })
            ->paginate(10);

        return view('admin.scores', compact('thesisTopics'));
    }
}
