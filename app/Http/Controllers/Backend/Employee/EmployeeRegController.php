<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmployeeSaleryLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeRegController extends Controller
{
    // employee view page 
    public function EmployeeRegView(){
        $data['employee'] = User::where('user_type', 'Employee') -> get();

        return view('backend.employee.employee_reg.employee_reg_view', $data);
    }

    // employee class add page show
    public function EmployeeCreate(){
        
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_reg.employee_reg_create', $data);

    }


    // employee store
    public function EmployeeStore(Request $request) {

        /**
         *  Multi Table Data Store
         */
        DB::transaction(function() use($request){

            $checkYear = date('Ym', strtotime($request -> join_date));
            $emloyee = User::where('user_type', 'Emloyee') -> orderBy('id', 'DESC') -> first();

            if( $emloyee == NULL){
                $emloyeeId = 1;
                if($emloyeeId < 10){
                    $id_no = '000' . $emloyeeId;
                }else if($emloyeeId < 100){
                    $id_no = '00' . $emloyeeId;
                }else if($emloyeeId < 1000){
                    $id_no = '0' . $emloyeeId;
                }
            }else {
                $emloyee = User::where('user_type', 'Emloyee') -> orderBy('id', 'DESC') -> first() -> id;
                $emloyeeId = $emloyee + 1;
                if($emloyeeId < 10){
                    $id_no = '000' . $emloyeeId;
                }else if($emloyeeId < 100){
                    $id_no = '00' . $emloyeeId;
                }else if($emloyeeId < 1000){
                    $id_no = '0' . $emloyeeId;
                }
            }


            // img upload 
            if($request -> hasFile('file')){

                $img = $request -> file('file');
                $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
                $img -> move(public_path('media/employee'), $unique);

            }


            // user table data store
            $code = rand(0000,9999);
            $user = new User();
            $user -> id_no                = $checkYear . $id_no;
            $user -> f_name               = $request -> f_name;
            $user -> m_name               = $request -> m_name;
            $user -> address              = $request -> address;
            $user ->cell                  = $request -> cell;
            $user ->gender                = $request -> gender;
            $user -> religion              = $request -> religion;
            $user -> name                  = $request -> name;
            $user -> dob                   = date('Y-m-d', strtotime($request -> dob));
            $user -> user_type             = 'Employee';
            $user -> code                  = $code;
            $user -> password              = bcrypt($code);
            $user ->  designation_id       = $request -> designation;
            $user ->  join_date             = date('Y-m-d', strtotime($request -> join_date));
            $user ->  salary                = $request -> salery;
            $user ->  image                = $unique;
            $user -> save();


            // assign student table data store
            $assign_elpy = new EmployeeSaleryLog();
            $assign_elpy -> employee_id         = $user -> id;
            $assign_elpy -> previous_salery        = $request -> salery;
            $assign_elpy -> present_salery          = $request -> salery;
            $assign_elpy -> effected_salery        = date('Y-m-d', strtotime($request -> dob));
            $assign_elpy -> increment_salery        = '0';
            $assign_elpy -> save();

        });
        


        // msg
        $notify = [
            'message'       => "Emloyee inserted Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('employee.reg.view') -> with($notify);

    }
      
    
    
    // employee edit page show
    public function EmployeeEdit($id){
        
        $data['designation'] = Designation::all();
        $data['employee'] = User::where('id', $id) -> first();

        return view('backend.employee.employee_reg.employee_reg_edit', $data);

    }


    // Employee Update 
    public function EmployeeUpdate($id, Request $request) {

        /**
         *  Multi Table Data Store
         */
        DB::transaction(function() use($request, $id){

            // img upload 
            if($request -> hasFile('file')){

                $img = $request -> file('file');
                $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
                $img -> move(public_path('media/employee'), $unique);

                // image delete
               @unlink('media/employee/' . $request -> old_img);

            }else{ 
                $unique = $request -> old_img;
            }



            // user table data store
            $user = User::find($id);
            $user -> f_name               = $request -> f_name;
            $user -> m_name               = $request -> m_name;
            $user -> address              = $request -> address;
            $user ->cell                  = $request -> cell;
            $user ->gender                = $request -> gender;
            $user -> religion              = $request -> religion;
            $user -> name                  = $request -> name;
            $user -> dob                   = date('Y-m-d', strtotime($request -> dob));
            $user -> user_type             = 'Employee';
            $user ->  designation_id       = $request -> designation;
            $user ->  join_date             = date('Y-m-d', strtotime($request -> join_date));
            $user ->  salary                = $request -> salery;
            $user ->  image                = $unique;
            $user -> update();


            // assign student table data store
            $assign_elpy = EmployeeSaleryLog::where('employee_id', $id) -> first();
            $assign_elpy -> previous_salery        = $request -> salery;
            $assign_elpy -> present_salery          = $request -> salery;
            $assign_elpy -> effected_salery        = date('Y-m-d', strtotime($request -> dob));
            $assign_elpy -> increment_salery        = '0';
            $assign_elpy -> update();

        });
        


        // msg
        $notify = [
            'message'       => "Emloyee Updated Succefully",
            'alert-type'    => "info"
        ];

        return redirect() -> route('employee.reg.view') -> with($notify);

    }
        

    // student details
    public function EmployeeDetails($id){

        $details = User::with(['Designation']) -> where('id', $id) -> first() -> toArray();
        // dd($details); die;

        $pdf = Pdf::loadView('backend.employee.employee_reg.employee_details_pdf', compact('details')) -> setPaper('a4', 'landscape');
        return $pdf->download('backend.employee.employee_reg.employee_details_pdf');

        // return view('backend.employee.employee_reg.employee_details_pdf', compact('details'));

    }


}
