<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScoreAndComment;
use App\Models\StudentGroup;
use App\Models\ThesisTopic;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScoreAndCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('Form submitted');
        // dd($request->all());

        $request->validate([
            'comment' => 'required|string',
            'status' => 'required|in:0,1',
            'student_id' => 'required|array',
            'student_id.*' => 'required|integer|exists:students,id',
            'lesson_4_score' => 'required|array',
            'lesson_4_score.*' => 'required|integer',
            'lesson_5_score' => 'required|array',
            'lesson_5_score.*' => 'required|integer',
            'thesis_score' => 'required|array',
            'thesis_score.*' => 'required|integer',
            'poster_score' => 'required|array',
            'poster_score.*' => 'required|integer',
            'project_score' => 'required|array',
            'project_score.*' => 'required|integer',
            'present_score' => 'required|array',
            'present_score.*' => 'required|integer',
            'qascore' => 'required|array',
            'qascore.*' => 'required|integer',
            'total' => 'required|array',
            'total.*' => 'required|integer'
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get the authenticated user's ID
            $user_id = Auth::id();

            // Save scores and comments for each student
            foreach ($request->student_id as $index => $student_id) {
                ScoreAndComment::create([
                    'thesis_topic_id' => $request->input('thesis_topic_id'),
                    'student_id' => $student_id,
                    'user_id' => $user_id,
                    'lesson_4' => $request->lesson_4_score[$index],
                    'lesson_5' => $request->lesson_5_score[$index],
                    'thesis' => $request->thesis_score[$index],
                    'poster' => $request->poster_score[$index],
                    'project' => $request->project_score[$index],
                    'q_and_a' => $request->qascore[$index],
                    'presentation' => $request->present_score[$index],
                    'average' => $request->total[$index],
                ]);
            }

            // Save a general comment about the group's performance
            Comment::create([
                'student_group_id' => $request->input('group_id'),
                'comment' => $request->comment,
                'user_id' => $user_id,
            ]);

            // Create or update the student group status
            $studentGroup = StudentGroup::find($request->input('group_id'));
            if ($studentGroup) {
                $studentGroup->status = $request->status;
                $studentGroup->save();
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('home')->with('success', 'Scores and comments have been successfully saved.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $request->validate(
            [
                'group_number' => 'required'
            ],
            [
                'group_number.required' => 'ກະລຸນາໃສ່ເລກກຸ່ມ'
            ]
        );

        $groupNumber = $request->input('group_number');

        // Find the group by ID
        $group = StudentGroup::with(['students', 'thesisTopic.type'])->where('group_number', $groupNumber)->first();

        if (!$group) {
            return redirect()->back()->with('error', 'ເລກກຸ່ມທີ່ທ່ານຄົ້ນຫາບໍ່ມີໃນລະບົບຂອງເຮົາ');
        }

        // Check if the thesis topic has a book_id
        $thesisTopic = ThesisTopic::where('id', $group->thesis_topic_id)->first();

        $thesistype = ThesisTopic::with('type')->get();


        if (!$thesisTopic || is_null($thesisTopic->book_id)) {
            return redirect()->back()->with('error',
            'ກຸ່ມທີ່ ' . $groupNumber . ' ຍັງບໍ່ໄດ້ສົ່ງປື້ມບົດຈົບຊັ້ນສະນັ້ນຈະບໍ່ສາມາດໃຫ້ຄະແນນໄດ້');
        }


        return view('scoreform', compact('group', 'thesisTopic', 'thesistype'));
        // return view('scoreform', [
        //     'success' => 'Send thesis successfuly',
        //     'group' => $group,
        //     'thesisTopic' => $thesisTopic
        // ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showcomment() {
        $thesisTopics = ThesisTopic::with(['studentGroup.students', 'studentGroup.comments', 'scoreAndComments.user'])
            ->whereHas('scoreAndComments', function ($query) {
                $query->whereNotNull('thesis_topic_id');
            })
            ->paginate(10);


        return view('comment', compact('thesisTopics'));
    }
    public function showscore() {
        $thesisTopics = ThesisTopic::with(['studentGroup.students', 'scoreAndComments'])
            ->whereHas('scoreAndComments', function ($query) {
                $query->whereNotNull('thesis_topic_id');
            })
            ->paginate(10);

        return view('scores', compact('thesisTopics'));
    }
}
