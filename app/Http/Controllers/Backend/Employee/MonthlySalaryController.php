<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class MonthlySalaryController extends Controller
{
    // employee monthly salaray view page
    public function MonthlySalaryView(){

        return view('backend.employee.employee_salary.employee_salary_view');

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
            $t_body .= '<td>'. '<a href="" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>'.'</td>';
            $t_body .= '</tr>';

        }


        return $t_body;

    }
    
}
