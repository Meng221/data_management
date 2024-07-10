<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studentgroup;
use App\Models\ThesisTopic;
use App\Models\ThesisEdit;

class ThesisEditController extends Controller
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
        $request->validate(
            [
                'group_number' => 'required|integer',
                'topic' => 'required',
                'file' => 'required|mimes:pdf'
            ],
            [
                'group_number.required' => 'ຕ້ອງປ້ອນເລກກຸ່ມ',
                'topic.required' => 'ຕ້ອງປ້ອນຊື່ຫົວຂໍ້ບົດຈົບຊັ້ນ',
                'file.required' => 'ຍັງບໍ່ໄດ້ອັບໂຫຼດໄຟລ໌ປື້ມບົດຈົບ'
            ]
        );

        $group = StudentGroup::where('group_number', $request->input('group_number'))->first();
        if (!$group) {
            return redirect()->back()->withErrors(['group_number' => 'Group number does not exist.']);
        }

        // Check if the thesis topic matches
        $thesisTopic = ThesisTopic::where('topic_name', $request->input('topic'))
            ->where('id', $group->thesis_topic_id)
            ->first();
        if (!$thesisTopic) {
            return redirect()->back()->withErrors(['thesis_topic' => 'Thesis topic does not match.']);
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('thesis_edits', $filename, 'public');

            // Save the file information to the thesis_books table
            $thesisEdit = new ThesisEdit();
            $thesisEdit->thesis_topic_id = $thesisTopic->id;
            $thesisEdit->thesis_edit_file = $filePath;
            $thesisEdit->save();
        }
        return redirect()->back()->with('success', 'Thesis Book send successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
