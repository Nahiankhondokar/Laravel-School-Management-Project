<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    // employee view page 
    public function EmployeeLeaveView(){

        $data['leave'] = EmployeeLeave::orderBy('id', 'DESC') -> get();
        return view('backend.employee.employee_leave.employee_leave_view', $data);
    }


    // employee view page 
    public function EmployeeCreateLeave(){

        $data['employee'] = User::where('user_type', 'Employee') -> get();
        $data['purpose'] = LeavePurpose::orderBy('id', 'DESC') -> get();

        return view('backend.employee.employee_leave.employee_leave_create', $data);
    }




    // increment salery store
    public function EmployeeLeaveStore(Request $request){
        // dd($id);
        
        // checking leave purpose 
        if($request -> leave_purpose == '0'){
            $leave_purpose = new LeavePurpose();
            $leave_purpose -> name  = $request -> new_purpose;
            $leave_purpose -> save();

            $leave_purpose_id = $leave_purpose -> id;

        }else {
            $leave_purpose_id = $request -> leave_purpose_id;
        }


        // employee leave table store
        EmployeeLeave::insert([
            'employee_id'             => $request -> employee_id,
            'leave_purposes_id'        => $leave_purpose_id,
            'start_date'              => date('Y-m-d', strtotime($request -> start_date)),
            'end_date'                => date('Y-m-d', strtotime($request -> end_date))
        ]);
        
        // msg
        $notify = [
            'message'       => "Emloyee Vacation Confirmed",
            'alert-type'    => "success"
        ];

        return redirect() -> route('employee.leave.view') -> with($notify);


    }


    // employee edit page 
    public function EmployeeLeaveEdit($id){

        $data['leave'] = EmployeeLeave::find($id);
        $data['employee'] = User::where('id', $data['leave'] -> employee_id) -> first();

        $data['purpose'] = LeavePurpose::orderBy('id', 'DESC') -> get();
        $data['user'] = User::where('user_type', 'Employee') -> get();

        return view('backend.employee.employee_leave.employee_leave_edit', $data);

    }
    
    

    // increment salery update
    public function EmployeeLeaveUpdate(Request $request, $id){

        // checking leave purpose 
        if($request -> leave_purpose == '0'){
            $leave_purpose = new LeavePurpose();
            $leave_purpose -> name = $request -> new_purpose;
            $leave_purpose -> save();

            $leave_purpose_id = $leave_purpose -> id;

        }else {
            $leave_purpose_id = $request -> leave_purpose_id;
        }


        // employee leave table store
        $update = EmployeeLeave::find($id);
        $update -> employee_id            = $request -> employee_id;
        $update -> leave_purposes_id      = $leave_purpose_id;
        $update -> start_date             = date('Y-m-d', strtotime($request -> start_date));
        $update -> end_date               = date('Y-m-d', strtotime($request -> end_date));
        $update -> update();
        
        // msg
        $notify = [
            'message'       => "Emloyee Vacation Updated",
            'alert-type'    => "success"
        ];

        return redirect() -> route('employee.leave.view') -> with($notify);


    }
    

    // employee leave delete
    public function EmployeeLeaveDelete($id){

        $delete = EmployeeLeave::find($id);
        $delete -> delete();

         // msg
         $notify = [
            'message'       => "Emloyee Vacation Deleted",
            'alert-type'    => "info"
        ];

        return redirect() -> route('employee.leave.view') -> with($notify);

    }
    


}
