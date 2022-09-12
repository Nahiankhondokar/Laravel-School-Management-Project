<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMark;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentMarksController extends Controller
{
    // student mark view page
    public function StudentMakrView(){

        $data['year'] = StudentYear::all();
        $data['class'] = StudentClass::all();
        $data['exam'] = ExamType::all();

        return view('backend.student.student_mark.student_mark_view', $data);
    }


    // class wise subject load
    public function StudentSubjectLoad($class_id) {
        
        $subjects = AssignSubject::with(['SchoolSubject']) -> where('class_id', $class_id) -> orderBy('id', 'DESC') -> get();

        return $subjects;

    }


    // student get mark
    public function StudentGetMark(Request $request){
        
        // return $request -> class_id . 'or' . $request -> year_id;
        $allData = AssignStudent::with(['Student']) -> where('class_id', $request -> class_id) -> where('year_id', $request -> year_id) ->get();

        // dd($allData);
        return $allData;

    }


    // student mark generate
    public function StudentMarkGenerate(Request $request){

        // student id count
        $student_id = count($request -> student_id);

       for ($i=0; $i < $student_id; $i++) { 
        
        StudentMark::insert([
            'student_id'        => $request -> student_id[$i],
            'class_id'          => $request -> class,
            'year_id'           => $request -> year,
            'marks'             => $request -> marks[$i],
            'assign_subject_id' => $request -> subject,
            'id_no'             => $request -> id_no[$i],
            'exam_type_id'      => $request -> exam,
        ]);

       }

        // msg
        $notify = [
            'message'       => "Student Mark Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('student.mark.view') -> with($notify);

    }


    // student mark edit 
    public function StudentMarkEdit(){
        
        $data['year'] = StudentYear::all();
        $data['class'] = StudentClass::all();
        $data['exam'] = ExamType::all();


        return view('backend.student.student_mark.student_mark_edit', $data);

    }


    // edit mark 
    public function MarkEditGetStudent(Request $request){

        // return $request -> class_id . 'or' . $request -> year_id;
        $allData = StudentMark::with(['Student']) -> where('class_id', $request -> class_id) -> where('year_id', $request -> year_id) -> where('exam_type_id', $request -> exam_id) -> where('assign_subject_id', $request -> subject_id) ->get();

        // dd($allData);
        return $allData;
        
    }


    // student mark update
    public function StudentMarkUpdate(Request $request){
        // dd($request -> all());

       // student mark delete and  restore again for updateing
       StudentMark::with(['Student']) -> where('class_id', $request -> class) -> where('year_id', $request -> year) -> where('exam_type_id', $request -> exam) -> where('assign_subject_id', $request -> subject) -> delete();

        // restore again
       $student_id = count($request -> student_id);
       for ($i=0; $i < $student_id; $i++) { 
        
            $update = new StudentMark();
            $update -> student_id        = $request -> student_id[$i];
            $update -> class_id          = $request -> class;
            $update -> year_id           = $request -> year;
            $update -> marks             = $request -> marks[$i];
            $update -> assign_subject_id = $request -> subject;
            $update -> id_no             = $request -> id_no[$i];
            $update -> exam_type_id      = $request -> exam;
            $update -> save();

       }

        // msg
        $notify = [
            'message'       => "Student Mark Updated Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('student.mark.view') -> with($notify);
        

    }



}
