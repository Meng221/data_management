<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThesisEdit;
use App\Models\ThesisTopic;


class AcceptEdit extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $thesisTopics = ThesisTopic::with(['edits', 'studentGroup'])->paginate(10);
        return view('accept', compact('thesisTopics'));
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
    public function change($id)
    {
        $ThesisEdit = ThesisEdit::findOrFail($id);

        // Toggle the status
        $ThesisEdit->accept = !$ThesisEdit->accept;

        // Save the changes
        $ThesisEdit->save();
        return redirect()->route('accept');
    }
}
