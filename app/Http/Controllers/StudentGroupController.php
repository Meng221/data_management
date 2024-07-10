<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentGroup;
use App\Models\Student;
use App\Models\ThesisTopic;



class StudentGroupController extends Controller
{
    //
    public function store(Request $request)
    {

        $request->validate(
            [
                'year' => 'required|string',
                'room' => 'required|string',
                'academic_year' => 'required|string',
                'level' => 'required|string',
                'major' => 'required|string',
                'system' => 'required|string',
                'study_time' => 'required|string',
                'type' => 'required|exists:types,id',
                'topic_name' => 'required|string',
                'topic_name_eng' => 'required|string',
                'advisor' => 'required|string',
                'students.*.student_id' => 'nullable|string',
                'students.*.name' => 'nullable|string',
                'students.*.phone' => 'nullable|string',
            ],
            [
                'year.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບຕາມທີ່ໄດ້ລະບຸໃນແບບຟອມນີ້'
            ]
        );

        $availableGroupNumber = $this->getAvailableGroupNumber();
        // dd($request->all());
        $topic = ThesisTopic::create([
            'type_id' => $request->type,
            'topic_name' => $request->input('topic_name'),
            'topic_name_eng' => $request->input('topic_name_eng'),
        ]);


        $group = StudentGroup::create([
            'group_number' => $availableGroupNumber,
            'thesis_topic_id' => $topic->id,
            'year' => $request->input('year'),
            'room' => $request->input('room'),
            'academic_year' => $request->input('academic_year'),
            'degree' => $request->has('degree'),
            'level' => $request->input('level'),
            'major' => $request->input('major'),
            'system' => $request->input('system'),
            'study_time' => $request->input('study_time'),
            'advisor' => $request->input('advisor'),
        ]);

        $students = $request->input('students', []);
        foreach ($students as $student) {
            if (!empty($student['student_id'])) {
                Student::create([
                    'group_id' => $group->id,
                    'student_id' => $student['student_id'],
                    'name' => $student['name'],
                    'phone' => $student['phone'],
                ]);
            }
        }




        return redirect()->back()->with([
            'success' => 'Student group created successfully.'
        ]);
    }

    public function groupview() {
        $studentGroups = StudentGroup::with(['students', 'thesisTopic.type'])->get();

        return view('group', compact('studentGroups'));
    }

    private function getAvailableGroupNumber()
    {
        $existingGroupNumbers = StudentGroup::pluck('group_number')->toArray();
        $groupNumber = 1;
        while (in_array($groupNumber, $existingGroupNumbers)) {
            $groupNumber++;
        }
        return $groupNumber;
    }
}
