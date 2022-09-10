<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSaleryLog;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeSaleryController extends Controller
{
    // employee view page 
    public function EmployeeSaleryView(){
        $data['employee'] = User::where('user_type', 'Employee') -> get();

        return view('backend.employee.employee_salery.employee_salery_view', $data);
    }


    // employee salery increment view page 
    public function EmployeeSaleryIncrement($id){
        $data['employee'] = User::find($id);

        return view('backend.employee.employee_salery.employee_salery_increment', $data);
    }


    // increment salery store
    public function EmployeeIncrementStore(Request $request, $id){
        // dd($id);

        // user table udpate
        $user = User::find($id);
        
        $incremen_salery = (float)$user -> salary + (float)$request -> increment_salery;
        $previous_salery = $user -> salary;
        $present_salery = $incremen_salery;

        $user -> salary = $incremen_salery;
        $user -> update();

        // employee salery table update
        EmployeeSaleryLog::insert([
            'employee_id'               => $id,
            'present_salery'            => $incremen_salery,
            'previous_salery'           => $previous_salery,
            'increment_salery'          => $request -> increment_salery,
            'effected_salery'           => date('Y-m-d', strtotime($request -> effected_salery))
        ]);
        
        // msg
        $notify = [
            'message'       => "Emloyee Salery Incremented Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('employee.salery.view') -> with($notify);


    }

    // salery details
    public function EmployeeDetails($id){

        $user = User::find($id);
        $salery = EmployeeSaleryLog::where('employee_id', $id) -> get();

        return view('backend.employee.employee_salery.employee_salery_details', compact('salery', 'user'));
    }
}
