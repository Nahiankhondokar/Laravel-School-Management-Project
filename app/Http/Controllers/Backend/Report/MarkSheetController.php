<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentGrade;
use App\Models\StudentMark;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function MarkSheetGet(Request $request, $pdf=null){

        // get all data
        $year = $request->year;
        $class = $request->class;
        $exam = $request->exam;
        $id_no = $request->id_no;

        // fails subject count
        $fail_count = StudentMark::where('year_id', $request -> year) -> where('class_id', $request -> class) -> where('exam_type_id', $request -> exam) -> where('id_no', $request -> id_no) -> where('marks', '<', '33') -> get() -> count();
        
        // single student 
        $single_student = StudentMark::where('year_id', $request -> year) -> where('class_id', $request -> class) -> where('exam_type_id', $request -> exam) -> where('id_no', $request -> id_no) -> first();

        if($single_student == true){
        
            $all_marks = StudentMark::with(['Subject', 'StudentYear']) -> where('year_id',      $request -> year) -> where('class_id', $request -> class) -> where('exam_type_id', $request -> exam) -> where('id_no', $request -> id_no) -> get();
            
            $all_grades = StudentGrade::all();
            
            return view('backend.report.mark_sheet.mark_sheet', compact('all_marks', 'all_grades', 'fail_count', 'year', 'class', 'exam', 'id_no'));

        }else {

             // msg
            $notify = [
                'message'       => "Data Not Found",
                'alert-type'    => "error"
            ];

            return redirect() -> back() -> with($notify);

        }
        
    }



    // marksheet pdf download 
    public function MarkSheetDownload($year, $class, $exam, $id_no){

        // $request = new Request(['year'=>$year, 'class'=>$class, 'exam'=>$exam, 'id_no'=>$id_no]);
        // $pdf = true;
        // $this->MarkSheetGet($request, $pdf);

        // fails subject count
        $fail_count = StudentMark::where('year_id', $year) -> where('class_id', $class) -> where('exam_type_id', $exam) -> where('id_no', $id_no) -> where('marks', '<', '33') -> get() -> count();
        
        // single student 
        $single_student = StudentMark::where('year_id', $year) -> where('class_id', $class) -> where('exam_type_id', $exam) -> where('id_no', $id_no) -> first();

        if($single_student == true){
        
            $all_marks = StudentMark::with(['Subject', 'StudentYear']) -> where('year_id', $year) -> where('class_id', $class) -> where('exam_type_id', $exam) -> where('id_no', $id_no) -> get();
            
            $all_grades = StudentGrade::all();

            // return view('backend.report.mark_sheet.mark_sheet_pdf', compact('all_marks', 'all_grades', 'fail_count'));
            

            $pdf_file = Pdf::loadView('backend.report.mark_sheet.mark_sheet_pdf', compact('all_marks', 'all_grades', 'fail_count'));
            return $pdf_file->download('backend.report.mark_sheet.mark_sheet_pdf.pdf');

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
