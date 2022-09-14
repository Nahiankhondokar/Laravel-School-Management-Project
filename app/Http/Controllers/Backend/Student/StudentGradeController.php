<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentGrade;
use Illuminate\Http\Request;

class StudentGradeController extends Controller
{
    // student mark view page
    public function StudentGradeView(){

        $data['grade'] = StudentGrade::all();

        return view('backend.student.student_grade.student_grade_view', $data);
    }


    // student mark view page
    public function StudentGradeAdd(){

        return view('backend.student.student_grade.student_grade_add');
    }


    // student mark view page
    public function StudentGradeStore(Request $request){

        StudentGrade::insert([
            'grade_name'            => $request -> grade_name,
            'grade_point'           => $request -> grade_point,
            'start_marks'           => $request -> start_marks,
            'end_marks'             => $request -> end_mark,
            'start_point'           => $request -> start_point,
            'end_point'             => $request -> end_point,
            'remarks'               => $request -> remark,
        ]);

        // msg
        $notify = [
            'message'       => "Student Grade inserted Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.grade.view') -> with($notify);

    }
    

    // student mark view page
    public function StudentGradeEdit($id){

        $data['grade'] = StudentGrade::find($id);

        return view('backend.student.student_grade.student_grade_edit', $data);
    }

    

    // student mark view page
    public function StudentGradeUpdate(Request $request, $id){

        $update = StudentGrade::find($id);
        $update -> grade_name            = $request -> grade_name;
        $update -> grade_point           = $request -> grade_point;
        $update -> start_marks           = $request -> start_marks;
        $update -> end_marks             = $request -> end_mark;
        $update -> start_point           = $request -> start_point;
        $update -> end_point             = $request -> end_point;
        $update -> remarks               = $request -> remark;
        $update -> update();

        // msg
        $notify = [
            'message'       => "Student Grade Updated Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.grade.view') -> with($notify);

    }
    
        


}
