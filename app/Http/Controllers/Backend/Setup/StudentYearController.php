<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    // student year page show
    public function StudentView(){

        $student = StudentYear::all();
        return view('backend.setup.student_year.student_year_view', [
            'student'      => $student
        ]);

    }

    // student class add page show
    public function StudentYearAdd(){

        return view('backend.setup.student_year.student_year_add');

    }



    // student class add
    public function StudentYearStore(Request $request){

        // validation
        $request -> validate([
            'year'    => 'required|unique:student_years,name'
        ]);

        // class store
        StudentYear::create([
            'name'  => $request -> year
        ]);

        // msg
        $notify = [
            'message'       => "Student Year Created Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.year.view') -> with($notify);
    }
    

    // student class add page show
    public function StudentYearEdit($id){

        $student = StudentYear::find($id);
        return view('backend.setup.student_year.student_year_edit', [
            'student'       => $student
        ]);

    }
    
    

    // student class update page show
    public function StudenYearUpdate($id, Request $request){

        // validation
        $request -> validate([
            'year'    => 'required|unique:student_years,name,'.$id
        ]);

        // update
        $update = StudentYear::find($id);
        $update -> name = $request -> year;
        $update -> update();

        // msg
        $notify = [
            'message'       => "Student year Updated Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.year.view') -> with($notify);


    }


    // student class delete page show
    public function StudentYearDelete($id){

        $delete = StudentYear::find($id);
        $delete -> delete();

        // msg
        $notify = [
            'message'       => "Student year Deleted Succefully",
            'alert-type'    => "info"
        ];
        
        return redirect() -> route('student.year.view') -> with($notify);


    }
        
        


    
}
