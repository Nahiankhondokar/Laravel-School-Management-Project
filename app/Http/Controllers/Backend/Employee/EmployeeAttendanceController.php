<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
     // employee view page 
     public function EmployeeAttendView(){

        $data['attend'] = EmployeeAttendance::select('date') -> groupBy('date') -> get();
        return view('backend.employee.employee_attend.employee_attend_view', $data);
    }



    // employee view page 
    public function EmployeeAttendCreate(){

        $data['employee'] = User::where('user_type', 'Employee') -> get();
        return view('backend.employee.employee_attend.employee_attend_add', $data);
    }


    // employee attendance store or update page 
    public function EmployeeAttendStore(Request $request, $date){

        // update by delete previous data
        EmployeeAttendance::where('date', date('Y-m-d', strtotime($date))) -> delete();

        $count_employee = count($request -> employee_id);
        // dd($count_employee);
        for ($i=0; $i < $count_employee; $i++) { 

            $attned_status = 'attend_status' . $i;
            $attend = new EmployeeAttendance();
            $attend -> atten_status = $request -> $attned_status;
            $attend ->  employee_id = $request -> employee_id[$i];
            $attend -> date         = $request -> attend_date;
            $attend -> save();
        }


         // msg
         $notify = [
            'message'       => "Emloyee Attendance Done",
            'alert-type'    => "success"
        ];

        return redirect() -> route('employee.attend.view') -> with($notify);


    }
    

    // employee edit page 
    public function EmployeeAttendEdit($date){

        $data['attend'] = EmployeeAttendance::where('date', $date) -> get();
        $data['date'] = $date;
        
        return view('backend.employee.employee_attend.employee_attend_edit', $data);

    }

}
