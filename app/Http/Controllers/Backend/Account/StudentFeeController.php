<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentAccountFee;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    // student mark view page
    public function StudentFeeView(){
        $data['accFee'] = StudentAccountFee::with(['Student', 'StudentYear', 'StudentClass', 'FeeCategory']) -> orderBy('id', 'DESC') -> get();
        return view('backend.account.student_fee.student_fee_view', $data);
    }

    // student mark view page
    public function StudentFeeAdd(){

        $data['class'] = StudentClass::all();
        $data['year'] = StudentYear::all();
        $data['feeCategory'] = FeeCategory::all();

        return view('backend.account.student_fee.student_fee_add', $data);

    }


    // student account fee get student
    public function GetStudentAccountFee(Request $request){

        // return $request -> fee_cat_id;
        $date = date('Y-m', strtotime($request -> date));

        $allStu = AssignStudent::with(['Student', 'StudentDiscount']) -> where('year_id', $request -> year_id) -> where('class_id', $request -> class_id) -> get();

        $t_body = '';
        foreach ($allStu as $key => $v) {
            // absent calculation
            $category_fee = FeeCategoryAmount::where('fee_category_id', $request -> fee_cat_id) -> where('class_id', $request -> class_id) -> first();

            // dd($category_fee);
            $originalFee = $category_fee -> amount;
            $discount = $v['StudentDiscount']['discount'];
            $discountAbleFee = $discount/100*$originalFee;
            $finalFee = $originalFee - $discountAbleFee;

            $stuAccFee = StudentAccountFee::where('student_id', $v -> student_id) -> where('year_id', $v -> year_id) -> where('class_id', $v -> class_id) -> where('fee_category_id', $request -> fee_cat_id) -> where('date', 'like', $date.'%') -> first();
            

            // select checking
            if($stuAccFee == null){
                $checked = '';
            }else {
                $checked = 'checked';
            }

            $t_body .= '<tr>';
            $t_body .= '<td>'.($key+1).'</td>';
            $t_body .= '<td>'.$v['Student']['id_no'] . '<input type="hidden" name="fee_cat_id[]"  value="'. $request -> fee_cat_id .'">' .'</td>';

            $t_body .= '<td>'.$v['Student']['name']. '<input type="hidden" name="year_id" value="'. $request -> year_id .'">' .'</td>';

            $t_body .= '<td>'.$v['Student']['f_name']. '<input type="hidden" name="class_id"  value="'. $request -> class_id .'">' .'</td>';

            $t_body .= '<td>'. $originalFee . '<input type="hidden" name="date" value="'. $request -> date .'">' .'</td>';

            $t_body .= '<td>'. $v['StudentDiscount']['discount'].'%'.'</td>';

            $t_body .= '<td>'. '<input class="form-control" type="text" name="amount[]" value="'. round($finalFee ) .'">' .'</td>';

            $t_body .= '<td>'. 
            '<input type="hidden" name="student_id[]" value="'. $v -> student_id .'">' .
            '<input type="checkbox" class="form-check-input" id="checkbox_'.$key.'" name="checkmanage[]" style="transform : scale(1.5); margin-left: 10px;" '. $checked .' value="'. $key .'"><label class="form-check-label" for="checkbox_'.$key.'"></label>'.
            
            '</td>';
            $t_body .= '</tr>';

        }


        return $t_body;

    }



    // student fee due payment
    public function StudentFeePayment(Request $request){

        $date = date('Y-m', strtotime($request -> date));

        // previous data delete for new same data update
        StudentAccountFee::where('year_id', $request -> year_id) -> where('class_id', $request -> class_id) -> where('fee_category_id', $request -> fee_cat_id) -> where('date', 'like', $date.'%') ->delete();

        $checkManage = $request -> checkmanage;
        if($checkManage != null){
            for ($i=0; $i < count($checkManage) ; $i++) { 

                $student_fee = new StudentAccountFee();
                $student_fee -> student_id  = $request -> student_id[$checkManage[$i]];
                $student_fee -> class_id  = $request -> class_id;
                $student_fee -> year_id  = $request -> year_id;
                $student_fee -> fee_category_id  = $request -> fee_cat_id[$i];
                $student_fee -> date  = date('Y-m-d', strtotime($request -> date)); 
                $student_fee -> amount  = $request -> amount[$checkManage[$i]]; 
                $student_fee -> save();

            }
        }

        if(!empty(@$student_fee) || empty($checkManage)){
            // msg
            $notify = [
                'message'       => "Student Payment Succefully",
                'alert-type'    => "success"
            ];

            return redirect() -> route('student.fee.view') -> with($notify);
        } else {
            // msg
            $notify = [
                'message'       => "Data Not Found",
                'alert-type'    => "error"
            ];

            return redirect() -> back() -> with($notify);
        }

    }

}
