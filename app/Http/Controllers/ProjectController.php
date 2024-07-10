<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\StudentGroup;
use App\Models\Student;
use App\Models\ThesisTopic;

class ProjectController extends Controller
{

    function home() {
        // $types  = Type::all();
        return view('auth.login');
    }
    function advisor() {
        return view('advisor');
    }
    function defense() {
        $studentGroups = StudentGroup::with(['students', 'thesisTopic.type'])->get();

        return view('defense', compact('studentGroups'));
    }
    function group() {
        return view('group');
    }
    function plan() {
        return view('plan');
    }
    function about() {
        return view('about');
    }
     function scoreAndComment() {
        return view('scoreform');
    }

    public function addtype(Request $request) {

        $request->validate([
            'typename' => 'required'
        ]);

        $type = Type::where('name', $request->input('typename'))->first();
        if ($type) {
            return redirect()->back()->withErrors(['Type' => 'Type already exists.']);
        }

        Type::create([
            'name' => $request->input('typename')
        ]);

        return redirect()->back()->with('success', 'Type added successfully.');
    }
}
