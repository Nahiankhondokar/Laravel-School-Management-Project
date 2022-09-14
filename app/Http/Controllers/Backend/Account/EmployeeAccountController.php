<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAccountSalary;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class EmployeeAccountController extends Controller
{
    // student mark view page
    public function EmployeeAccountView(){
        $data['employeeSalay'] = EmployeeAccountSalary::with(['Student']) -> orderBy('id', 'DESC') -> get();
        return view('backend.account.employee_salary.employee_salary_view', $data);
    }

    
    // student mark view page
    public function EmployeeSalaryAdd(){

        return view('backend.account.employee_salary.employee_salary_add');

    }


    // employee monthly salaray payment
    public function MonthlySalaryGet(Request $request){

        $date = date('Y-m', strtotime($request -> slry_date));

        $allData = EmployeeAttendance::select('employee_id') -> groupBy('employee_id') -> where('date', 'like', $date.'%') -> with(['Student']) -> get();
        

        $t_body = '';
        foreach ($allData as $key => $v) {

            $acc_salary = EmployeeAccountSalary::where('employee_id', $v -> employee_id) -> where('date', 'like', $date.'%') -> first();

            // select checking
            if($acc_salary == null){
                $checked = '';
            }else {
                $checked = 'checked';
            }

            // absent calculation
            $attend_data = EmployeeAttendance::where('employee_id', $v-> employee_id) -> where('atten_status', 'Absent') -> get();

            // total salary after absent cutting
            $totalAbsent = count($attend_data);
            $perDaySalary = $v['Student']['salary']/30;
            $reduceSalary = $perDaySalary * $totalAbsent;
            $totalSalary = $v['Student']['salary'] - $reduceSalary;

            $t_body .= '<tr>';
            $t_body .= '<td>'.($key+1).'</td>';
            $t_body .= '<td>'.$v['Student']['id_no']. '</td>';

            $t_body .= '<td>'.$v['Student']['name'].'</td>';
            $t_body .= '<td>'.$v['Student']['salary'].'</td>';

            $t_body .= '<td>'. round($totalSalary) . '<input type="hidden" name="amount[]"  value="'. round($totalSalary) .'">' .'</td>';

            $t_body .= '<td>'. 
            '<input type="hidden" name="student_id[]" value="'. $v -> employee_id .'">' .
            '<input type="checkbox" class="form-check-input" id="checkbox_'.$key.'" name="checkmanage[]" style="transform : scale(1.5); margin-left: 10px;" '. $checked .' value="'. $key .'"><label class="form-check-label" for="checkbox_'.$key.'"></label>'.
            '</td>';
            $t_body .= '</tr>';

        }


        return $t_body;

    }



    // employee salary Store or payment
    public function EmployeeAccountSalaryStore(Request $request){

        $date = date('Y-m', strtotime($request -> date));
        
        /**
         *  previous all similar date data delete.
         *  then which data is checked, this data insert again.
         */
        EmployeeAccountSalary::where('date', 'like', $date.'%') -> delete();

        $checkdata = $request -> checkmanage;
        if($checkdata != null){
            for ($i=0; $i < count($checkdata) ; $i++) { 

                $employee = new EmployeeAccountSalary();
                $employee -> employee_id  = $request -> student_id[$i];
                $employee -> date  = $request -> date;
                $employee -> amount  = $request -> amount[$i]; 
                $employee -> save();

            }

            // msg
            $notify = [
                'message'       => "employee Payment Succefully",
                'alert-type'    => "success"
            ];

            return redirect() -> route('account.employee.view') -> with($notify);
            
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
