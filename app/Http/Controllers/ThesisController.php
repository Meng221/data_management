<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThesisBook;
use App\Models\ThesisTopic;
use App\Models\Advisor;
use App\Models\StudentGroup;

class ThesisController extends Controller
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
                'advisor' => 'required|max:255',
                'email' => 'required|email',
                'group_number' => 'required|integer',
                'thesis_topic' => 'required|max:255',
                'file' => 'required|mimes:pdf', // Corrected validation rule
            ],
            [
                'advisor.required' => 'ກະລຸນາປ້ອນຊື່ອາຈານທີ່ປຶກສາ',
                'email.required' => 'ຕ້ອງປ້ອນ email',
                'group_number.required' => 'ຕ້ອງລະບຸເລກກຸ່ມ',
                'group_number.integer' => 'ເລກກຸ່ມຕ້ອງເປັນຕົວເລກຈໍານວນເຕັມ',
                'thesis_topic.required' => 'ກະລຸນາປ້ອນຊື່ຫົວຂໍ້',
                'file.mimes' => 'ຕ້ອງເປັນໄຟລ໌ PDF ເທົ່່ານັ້ນ',
                'file.required' => 'ຕ້ອງອັບໂຫລດໄຟລ໌',
            ]
        );

        // dd($request->all());
        // Check if the advisor exists
        $advisor = Advisor::where('email', $request->input('email'))->first();
        if (!$advisor) {
            return redirect()->back()->withErrors(['advisor' => 'Advisor not found.']);
        }

        // Check if the group number exists
        $group = StudentGroup::where('group_number', $request->input('group_number'))->first();
        if (!$group) {
            return redirect()->back()->withErrors(['group_number' => 'Group number does not exist.']);
        }

        // Check if the thesis topic matches
        $thesisTopic = ThesisTopic::where('topic_name', $request->input('thesis_topic'))
            ->where('id', $group->thesis_topic_id)
            ->first();
        if (!$thesisTopic) {
            return redirect()->back()->withErrors(['thesis_topic' => 'Thesis topic does not match.']);
        }

        // Handle the file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('thesis_files', $filename, 'public');

            // Save the file information to the thesis_books table
            $thesisBook = new ThesisBook();
            $thesisBook->book_file = $filePath;
            $thesisBook->type = 'pdf';
            $thesisBook->save();

            // Update the thesis_topics table with the book_id
            $thesisTopic->book_id = $thesisBook->id;
            $thesisTopic->save();
        }
        return redirect()->back()->with('success', 'Thesis Book send successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $thesisTopics = ThesisTopic::with(['book', 'edits'])->whereNotNull('book_id')->paginate(10);
        return view('thesis', compact('thesisTopics'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function allowSendingThesis()
    {
        $thesisTopics = ThesisTopic::with('book')->whereNotNull('book_id')->paginate(10);
        return view('allowsentthesis', compact('thesisTopics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function allow($id)
    {
        $ThesisEdit = ThesisBook::findOrFail($id);

        // Toggle the status
        $ThesisEdit->verified = !$ThesisEdit->verified;

        // Save the changes
        $ThesisEdit->save();
        return redirect()->route('accept');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
