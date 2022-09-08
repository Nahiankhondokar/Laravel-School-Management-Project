<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentRoleController extends Controller
{
    // role view page 
    public function StudetnRoleView(){
        $data['year'] = StudentYear::all();
        $data['class'] = StudentClass::all();

        return view('backend.student.student_role.student_role_view', $data);
    }


    // get students
    public function GetStudents(Request $request){
// return 'done';
        $allData['student'] = AssignStudent::with(['Student']) -> where('year_id', $request -> year) -> where('class_id', $request -> class) -> get();

        return response() -> json($allData);
    }



    // student roll generate
    public function StudentRollGenerate(Request $request) {

        $year = $request -> year;
        $class = $request -> class;

       if($request -> student_id != null){
        for ($i=0; $i < count($request -> student_id); $i++) { 
            AssignStudent::where('year_id', $year) -> where('class_id', $class) -> where('student_id', $request -> student_id[$i]) -> update(['roll'  => $request -> roll[$i]]);
        }

        // msg
        $notify = [
            'message'       => "Student Roll Updated Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('student.role.view') -> with($notify);

       }else {
            // msg
            $notify = [
                'message'       => "No Student Found !",
                'alert-type'    => "error"
            ];

            return redirect() -> back() -> with($notify);
       }

        

    }



}
