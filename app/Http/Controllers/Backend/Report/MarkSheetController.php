<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentGrade;
use App\Models\StudentMark;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarkSheetController extends Controller
{
    // mark sheet view
    public function MarkSheetView(){

        $data['year'] = StudentYear::orderBy('id', 'DESC') -> get();
        $data['class'] = StudentClass::orderBy('id', 'DESC') -> get();
        $data['exam_type'] = ExamType::orderBy('id', 'DESC') -> get();

        return view('backend.report.mark_sheet.mark_sheet_view', $data);
    }


    // marksheet get
    public function MarkSheetGet(Request $request){

        $fail_count = StudentMark::where('year_id', $request -> year) -> where('class_id', $request -> class) -> where('exam_type_id', $request -> exam) -> where('id_no', $request -> id_no) -> where('marks', '<', '33') -> get() -> count();
        
        $single_student = StudentMark::where('year_id', $request -> year) -> where('class_id', $request -> class) -> where('exam_type_id', $request -> exam) -> where('id_no', $request -> id_no) -> first();

        if($single_student == true){
        
            $all_marks = StudentMark::with(['Subject', 'StudentYear']) -> where('year_id',      $request -> year) -> where('class_id', $request -> class) -> where('exam_type_id', $request -> exam) -> where('id_no', $request -> id_no) -> get();
            

            $all_grades = StudentGrade::all();

             // $pdf = PDF::loadView('backend.student.registration_fee.registration_fee_pdf', $details);
            // $pdf->SetProtection(['copy', 'print'], '', 'pass');
            // return $pdf->stream('document.pdf');

            return view('backend.report.mark_sheet.mark_sheet_pdf', compact('all_marks', 'all_grades', 'fail_count'));

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
