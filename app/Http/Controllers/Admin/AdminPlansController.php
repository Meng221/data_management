<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Plans;


class AdminPlansController extends Controller
{
    function insert(Request $request) {
        $request->validate(
            [
                'title'=>'required|max:100',
                // 'description'=>'required',
                'file' => 'required|file|mimes:pdf,jpeg,png'
            ],
            [
                'title.required' => 'ກະລຸນາປ້ອນຊື່ຫົວຂໍ້!',
                'title.max' => 'ຊື່ທີ່ທ່ານຕັ້ງຍາວເກີນໄປ!',
                // 'description' => 'ກະລຸນາປ້ອນຄໍາອະທິບາຍແດ່!',
                'file.required' => 'ກະລຸນາອັບໂຫຼດໄຟລ໌!'
            ]
        );

        // Store the file
        $path = $request->file('file')->store('public/files');

        // Remove 'public/' from the path
        $cleanPath = str_replace('public/', '', $path);
        $data = [
            'plan_title' => $request->title,
            'description' => $request->description,
            'pdf_data' => $cleanPath,
            'created_at' => now(),
            'updated_at' => now()
        ];


        DB::table('tbplans')->insert($data);

        $request->session()->flash('success', 'Data inserted successfully.');
        return redirect()->route('admin.plan');
    }

    function getPost() {
        $posts = Plans::all();
        return view('admin.plan', compact('posts'));
    }

    function delete($id) {
        $plan = DB::table('tbplans')->where('id', $id)->first();

        // Check if the plan record exists
        if ($plan) {
            // Delete the associated file if it exists
            if ($plan->pdf_data && \Storage::exists('public/' . $plan->pdf_data)) {
                \Storage::delete('public/' . $plan->pdf_data);
            }

            // Delete the database record
            DB::table('tbplans')->where('id', $id)->delete();
        }

        return redirect()->route('admin.plan');
    }

    function edit($id) {
        $plan = DB::table('tbplans')->where('id', $id)->first();
        return view('edit.planedit', compact('plan'));
    }

    public function update(Request $request, $id) {
        $request->validate(
            [
                'title'=>'required|max:100',
                'file' => 'required|mimes:pdf,jpeg,png'
            ],
            [
                'title.required' => 'ກະລຸນາປ້ອນຊື່ຫົວຂໍ້!',
                'title.max' => 'ຊື່ທີ່ທ່ານຕັ້ງຍາວເກີນໄປ!',
                // 'description' => 'ກະລຸນາປ້ອນຄໍາອະທິບາຍແດ່!',
                'file.required' => 'ກະລຸນາອັບໂຫຼດໄຟລ໌!'
            ]
        );

        $plan = DB::table('tbplans')->where('id', $id)->first();

        // Check if the plan exists
        if (!$plan) {
            $request->session()->flash('error', 'Plan not found.');
            return redirect()->route('admin.plan');
        }

        // Prepare the data array for updating
        $data = [
            'plan_title' => $request->title,
            'description' => $request->descript�ion,
            'updated_at' => now()
        ];

        // Handle file upload if a file is provided
        if ($request->hasFile('file')) {
            // Delete the old file if it exists
            if ($plan->pdf_data && \Storage::exists('public/' . $plan->pdf_data)) {
                \Storage::delete('public/' . $plan->pdf_data);
            }

            // Store the new file
            $path = $request->file('file')->store('public/files');
            $cleanPath = str_replace('public/', '', $path);
            $data['pdf_data'] = $cleanPath; // Add the new file path to the data array
        }

        // Update the plan record in the database
        DB::table('tbplans')->where('id', $id)->update($data);

        // Redirect with a success message
        $request->session()->flash('success', 'Data updated successfully.');
        return redirect()->route('admin.plan');
    }
}
