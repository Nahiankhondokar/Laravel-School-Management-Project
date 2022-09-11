<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class MonthlySalaryController extends Controller
{
    // employee monthly salaray view page
    public function MonthlySalaryView(){

        return view('backend.employee.employee_salery.employee_salary_view');

    }


    // employee monthly salaray get
    public function MonthlySalaryGet(Request $request){

        $date = date('Y-m', strtotime($request -> slry_date));

        $allData = EmployeeAttendance::select('employee_id') -> groupBy('employee_id') -> where('date', 'like', $date.'%') -> with(['Student']) -> get();
        

        $t_body = '';
        foreach ($allData as $key => $v) {
            // absent calculation
            $attend_data = EmployeeAttendance::where('employee_id', $v-> employee_id) -> where('atten_status', 'Absent') -> get();

            // total salary after absent cutting
            $totalAbsent = count($attend_data);
            $perDaySalary = $v['Student']['salary']/30;
            $reduceSalary = $perDaySalary * $totalAbsent;
            $totalSalary = $v['Student']['salary'] - $reduceSalary;

            $t_body .= '<tr>';
            $t_body .= '<td>'.($key+1).'</td>';
            $t_body .= '<td>'.$v['Student']['name'].'</td>';
            $t_body .= '<td>'.$v['Student']['salary'].'</td>';
            $t_body .= '<td>'. round($totalSalary) .'</td>';
            $t_body .= '<td>'. '<a title="PDF" target="_blank" href="'. route("employee.monthly.salary.pdf", $v -> employee_id).'" class="btn btn-primary btn-sm">Pay Slipe</a>'.'</td>';
            $t_body .= '</tr>';

        }


        return $t_body;

    }
    



     // pdf Pay slip
     public function MonthlySalaryPayslip(Request $request, $employee_id){

        // get data from group data id
        $employee = EmployeeAttendance::where('employee_id', $employee_id) -> first();

        $date = date('Y-m', strtotime($employee -> date));

        $details = EmployeeAttendance::with(['Student']) -> where('date', 'like', $date.'%') -> where('employee_id', $employee_id) -> get();

        // dd($details);
    
        // $pdf = PDF::loadView('backend.student.registration_fee.registration_fee_pdf', $details);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        // return $pdf->stream('document.pdf');
    
        return view('backend.employee.employee_salery.employee_salary_pdf', compact('details'));
        
    }



}
