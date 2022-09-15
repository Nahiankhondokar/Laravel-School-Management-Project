<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMark;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class ResultReportController extends Controller
{
    // other cost view
    public function ResultReportView(){

        $data['year'] = StudentYear::orderBy('id', 'DESC') -> get();
        $data['class'] = StudentClass::orderBy('id', 'DESC') -> get();
        $data['exam_type'] = ExamType::orderBy('id', 'DESC') -> get();

        return view('backend.report.student_result_report.student_result_view', $data);
    }


    // student resutl report get
    public function StudentResultReportGet(Request $request){
        
        $single_student = StudentMark::where('year_id', $request -> year) -> where('class_id', $request -> class) -> where('exam_type_id', $request -> exam) -> first();
        // dd($single_student);

        if($single_student == true){
        
            $data['allData'] = StudentMark::select('year_id', 'class_id', 'exam_type_id', 'student_id') -> where('year_id', $request -> year) -> where('class_id', $request -> class) -> where('exam_type_id', $request -> exam) -> groupBy('year_id') -> groupBy('class_id') -> groupBy('exam_type_id') -> groupBy('student_id') -> get();

            // dd($data['allData']);

             // $pdf = PDF::loadView('backend.student.registration_fee.registration_fee_pdf', $details);
            // $pdf->SetProtection(['copy', 'print'], '', 'pass');
            // return $pdf->stream('document.pdf');

            return view('backend.report.student_result_report.student_result_pdf', $data);

        }else {

                // msg
            $notify = [
                'message'       => "Data Not Found",
                'alert-type'    => "error"
            ];

            return redirect() -> back() -> with($notify);

        }
        
    }



    // Student id card
    public function StudentIdCardView(){

        $data['year'] = StudentYear::orderBy('id', 'DESC') -> get();
        $data['class'] = StudentClass::orderBy('id', 'DESC') -> get();

        return view('backend.report.student_idcard.student_idcard_view', $data);
    }



    // Student id card get
    public function StudentIdCardGet(Request $request){
        
        $check_data = AssignStudent::where('year_id', $request -> year) -> where('class_id', $request -> class) -> first();

        if($check_data == true){
        
            $data['allData'] = AssignStudent::where('year_id', $request -> year) -> where('class_id', $request -> class) -> get();
            
            // dd($data['allData'] -> toArray());

             // $pdf = PDF::loadView('backend.student.registration_fee.registration_fee_pdf', $details);
            // $pdf->SetProtection(['copy', 'print'], '', 'pass');
            // return $pdf->stream('document.pdf');

            return view('backend.report.student_idcard.student_idcard_pdf', $data);

        }else {

             // msg
            $notify = [
                'message'       => "Data Not Found",
                'alert-type'    => "error"
            ];

            return redirect() -> back() -> with($notify);

        }

    }


    
}
