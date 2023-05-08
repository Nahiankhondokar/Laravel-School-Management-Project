<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MonthlyFeeControlller extends Controller
{
    // monthly fee view page 
    public function MonthlyFeeView(){
        $data['year'] = StudentYear::all();
        $data['class'] = StudentClass::all();

        return view('backend.student.monthly_fee.monthly_fee_view', $data);
    }

    // monthly fee class data
    public function MonthlyFeeClassData(Request $request){

        $year_id = $request->year;
        $class_id = $request->class;
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }
        $allStudent = AssignStudent::with(['StudentDiscount'])->where($where)->get();
        // dd($allStudent);
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Monthly Fee</th>';
        $html['thsource'] .= '<th>Discount </th>';
        $html['thsource'] .= '<th>Student Fee </th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($allStudent as $key => $v) {
            $registrationfee = FeeCategoryAmount::where('fee_category_id','4')->where('class_id',$v->class_id)->first();
            // dd($v->class_id);
            if($registrationfee == null){
                $html[$key]['tdsource']  = '<h3 class="text-danger text-center">'. 'Data Not Found !' .'</h3>';
                
            }else {
                
                $color = 'success';
                $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['Student']['id_no'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['Student']['name'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
                $html[$key]['tdsource'] .= '<td>'. $registrationfee->amount .'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['StudentDiscount']['discount'].'%'.'</td>';
                
                $originalfee = $registrationfee->amount;
                // dd($originalfee);
                $discount = $v['StudentDiscount']['discount'];
                $discounttablefee = $discount/100*$originalfee;
                $finalfee = (float)$originalfee-(float)$discounttablefee;

                $html[$key]['tdsource'] .='<td>'.$finalfee .' $'.'</td>';
                $html[$key]['tdsource'] .='<td>';
                $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.monthly.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&month='. $request -> month .'">Fee Slip</a>';
                $html[$key]['tdsource'] .= '</td>';
            }

        }  
        return response()->json(@$html);

    }


    // pdf Pay slip
    public function MonthlyFeePayslip(Request $request){

    $student_id = $request -> student_id;
    $class_id = $request -> class_id;
    $month = $request -> month;

    $details = AssignStudent::with(['Student', 'StudentDiscount']) -> where('student_id', $student_id) -> where('class_id', $class_id) -> first();

    // Student monthly payslip PDF
    $pdf = PDF::loadView('backend.student.monthly_fee.monthly_fee_pdf', compact('details', 'month'));
    return $pdf->download('backend.student.monthly_fee.monthly_fee_pdf.pdf');

    // return view('backend.student.monthly_fee.monthly_fee_pdf', compact('details', 'month'));
    
    }
    
}
