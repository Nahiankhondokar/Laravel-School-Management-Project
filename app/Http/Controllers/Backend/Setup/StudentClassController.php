<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    // student class page show
    public function StudentView(){

        $student = StudentClass::all();
        return view('backend.setup.student_class.student_class_view', [
            'student'      => $student
        ]);

    }

    // student class add page show
    public function StudentClassAdd(){

        $student = StudentClass::all();
        return view('backend.setup.student_class.student_class_add');

    }

    // student class add
    public function StudentClassStore(Request $request){

        // validation
        $request -> validate([
            'class_name'    => 'required|unique:student_classes,name'
        ]);

        // class store
        StudentClass::insert([
            'name'  => $request -> class_name
        ]);

        // msg
        $notify = [
            'message'       => "Student Class Created Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.class.view') -> with($notify);
    }


    // student class add page show
    public function StudentClassEdit($id){

        $student = StudentClass::find($id);
        return view('backend.setup.student_class.student_class_edit', [
            'student'       => $student
        ]);

    }


    // student class add page show
    public function StudentClassUpdate($id, Request $request){

        // validation
        $request -> validate([
            'class_name'    => 'required|unique:student_classes,name'
        ]);

        // update
        $update = StudentClass::find($id);
        $update -> name = $request -> class_name;
        $update -> update();

        // msg
        $notify = [
            'message'       => "Student Class Updated Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.class.view') -> with($notify);


    }
    


}
