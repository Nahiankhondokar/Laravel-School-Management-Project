<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    // student year page show
    public function StudentView(){

        $student = StudentShift::all();
        return view('backend.setup.student_shift.student_shift_view', [
            'student'      => $student
        ]);

    }

    // student class add page show
    public function StudentShiftAdd(){

        return view('backend.setup.student_shift.student_shift_add');

    }



    // student class add
    public function StudentShiftStore(Request $request){

        // validation
        $request -> validate([
            'shift'    => 'required|unique:student_shifts,name'
        ]);

        // group store
        $student_add = new StudentShift();
        $student_add -> name = $request -> shift;
        $student_add -> save();

        // msg
        $notify = [
            'message'       => "Student shift Created Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.shift.view') -> with($notify);
    }
    

    // student class add page show
    public function StudentShiftEdit($id){

        $student = StudentShift::find($id);
        return view('backend.setup.student_shift.student_shift_edit', [
            'student'       => $student
        ]);

    }
    
    

    // student class update page show
    public function StudenShiftUpdate($id, Request $request){

        // validation
        $request -> validate([
            'shift'    => 'required|unique:student_shifts,name,'.$id
        ]);

        // update
        $update = StudentShift::find($id);
        $update -> name = $request -> shift;
        $update -> update();

        // msg
        $notify = [
            'message'       => "Student shift Updated Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.shift.view') -> with($notify);


    }


    // student class delete page show
    public function StudentShiftDelete($id){

        $delete = StudentShift::find($id);
        $delete -> delete();

        // msg
        $notify = [
            'message'       => "Student shift Deleted Succefully",
            'alert-type'    => "info"
        ];
        
        return redirect() -> route('student.shift.view') -> with($notify);


    }
}
