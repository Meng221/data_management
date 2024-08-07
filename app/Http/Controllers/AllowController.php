<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThesisTopic;
use App\Models\StudentGroup;

class AllowController extends Controller
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
        $studentGroups = StudentGroup::with('thesisTopic')->where('allow', false)->get();
        return view('request', compact('studentGroups'));
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
        $StudentGroup = StudentGroup::findOrFail($id);

        // Toggle the status
        $StudentGroup->allow = !$StudentGroup->allow;

        // Save the changes
        $StudentGroup->save();
        return redirect()->back();
    }
}
