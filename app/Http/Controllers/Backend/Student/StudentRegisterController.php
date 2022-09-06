<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentRegister;
use App\Models\StudentShift;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentRegisterController extends Controller
{
    // user view page
    public function StudetnRegView(){
        $student = StudentRegister::all();
        return view('backend.student.student_reg.student_view', [
            'student'  => $student
        ]);
    }


    // user add page
    public function StudetnRegAdd(){

        $year = StudentYear::all();
        $class = StudentClass::all();
        $group = StudentGroup::all();
        $shift = StudentShift::all();

        return view('backend.student.student_reg.student_add', compact('year', 'class', 'group', 'shift'));
    }


    // student add
    public function StudetnRegStore(Request $request) {

        // validation
        $this -> validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'user_type'     => 'required'
        ]);

        // img upload 
        if($request -> hasFile('file')){

            $img = $request -> file('file');
            $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
            $img -> move(public_path('media/user'), $unique);

            if(file_exists('media/user/' . $request -> old_img)){
                unlink('media/user/' . $request -> old_img);
            }


        }else {
            $unique = $request -> old_img;
        }

        // user store
        $updaet_data = User::find($id);
        $updaet_data -> name                = $request -> name;
        $updaet_data -> email               = $request -> email;
        $updaet_data -> cell                = $request -> cell;
        $updaet_data -> address             = $request -> address;
        $updaet_data -> gender              = $request -> gender;
        $updaet_data -> user_type           = $request -> user_type;
        $updaet_data -> profile_photo_path  = $unique;
        $updaet_data -> update();
    

        // msg
        $notify = [
            'message'       => "User Profile Updated Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('profile.view') -> with($notify);

    }
    
}
