<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThesisTopic;

class AdminShowCommentController extends Controller
{
    public function showcomment() {
        $thesisTopics = ThesisTopic::with(['studentGroup.students', 'studentGroup.comments', 'scoreAndComments.user'])
            ->whereHas('scoreAndComments', function ($query) {
                $query->whereNotNull('thesis_topic_id');
            })
            ->paginate(10);


        return view('admin.comment', compact('thesisTopics'));
    }
}
