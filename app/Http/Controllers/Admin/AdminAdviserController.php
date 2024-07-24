<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAdviserController extends Controller
{
    function insert(Request $request) {
        $request->validate(
            [
                'fullname'=>'required|max:100',
                'email'=>'required',
                'image' => 'required|file|mimes:jpg,jpeg,png'
            ],
            [
                'fullname.required' => 'ກະລຸນາປ້ອນຊື່ອາຈານທີ່ປຶກສາ!',
                'fullname.max' => 'ຊື່ທີ່ທ່ານຕັ້ງຍາວເກີນໄປ!',
                'email' => 'ກະລຸນາປ້ອນອີເມລ!',
                'image.required' => 'ກະລຸນາອັບໂຫຼດຮູບພາບ!',
                'image.mimes' => 'ກະລຸນາເລືອກໄຟລ໌ທີ່ເປັນ jpg, jpeg, ຫຼື png!',

                // 'image.max' => 'ຂະໜາດໄຟລ໌ບໍ່ຄວນເກີນ 2048 KB!'
            ]
        );

        // Store the file
        $path = $request->file('image')->store('public/img');
        $cleanPath = str_replace('public/', '', $path);
        // Save other data and the file path in the database
        $data = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'picture' => $cleanPath, // Store the relative path
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('advisors')->insert($data);

        // Redirect with success message
        $request->session()->flash('success', 'Data inserted successfully.');
        return redirect()->route('admin.advisor');

    }

    function getPost() {
        $posts = DB::table('advisors')->get();
        // $date_part = substr($timestamp, 0, 10);
        // $date = $posts->updated_at;
        // $date = $dateTime->format('d-m-Y');
        return view('admin.advisor', compact('posts'));
    }

    function delete($id) {
        // DB::table('advisors')->where('id',$id)->delete();
        // return redirect('/advisor');

        $advisor = DB::table('advisors')->where('id', $id)->first();

        // Check if the plan record exists
        if ($advisor) {
            // Delete the associated file if it exists
            if ($advisor->picture && \Storage::exists('public/' . $advisor->picture)) {
                \Storage::delete('public/' . $advisor->picture);
            }

            // Delete the database record
            DB::table('advisors')->where('id', $id)->delete();
        }

        return redirect()->route('admin.advisor');
    }

    function edit($id) {
        $advisors = DB::table('advisors')->where('id', $id)->first();
        return view('admin.editadvisor', compact('advisors'));
    }
    public function update(Request $request, $id) {
        $request->validate(
            [
                'fullname' => 'required|max:100',
                'email' => 'required|email|unique:advisors,email,' . $id,
                'image' => 'nullable|file|mimes:jpg,jpeg,png'
            ],
            [
                'fullname.required' => 'ກະລຸນາປ້ອນຊື່ອາຈານທີ່ປຶກສາ!',
                'fullname.max' => 'ຊື່ທີ່ທ່ານຕັ້ງຍາວເກີນໄປ!',
                'email.required' => 'ກະລຸນາປ້ອນອີເມລ!',
                'email.unique' => 'ອີເມລນີ້ໃຊ້ງານແລ້ວ!',
                'image.mimes' => 'ກະລຸນາເລືອກໄຟລ໌ທີ່ເປັນ jpg, jpeg, ຫຼື png!',
                // 'image.max' => 'ຂະໜາດໄຟລ໌ບໍ່ຄວນເກີນ 2048 KB!'
            ]
        );

        // Get the advisor from the database
        $advisor = DB::table('advisors')->where('id', $id)->first();

        // Check if the advisor exists
        if (!$advisor) {
            $request->session()->flash('error', 'Advisor not found.');
            return redirect()->route('admin.advisor');
        }

        // Prepare the data array for updating
        $data = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'updated_at' => now()
        ];

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($advisor->picture && \Storage::exists('public/' . $advisor->picture)) {
                \Storage::delete('public/' . $advisor->picture);
            }
            // Store the new image
            $path = $request->file('image')->store('public/img');
            $cleanPath = str_replace('public/', '', $path);
            $data['picture'] = $cleanPath; // Add the new image path to the data array
        }

        // Update the advisor record in the database
        DB::table('advisors')->where('id', $id)->update($data);

        // Redirect with a success message
        $request->session()->flash('success', 'Data updated successfully.');
        return redirect()->route('admin.advisor');
    }
}
