<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendReportController extends Controller
{

    // mark sheet view
    public function AttendReportView(){

        $data['employee'] = User::where('user_type', 'Employee')-> get();

        return view('backend.report.attend_report.attend_report_view', $data);
    }


    // mark sheet view
    public function AttendReportGet(Request $request){


        $date = date('Y-m', strtotime($request -> date));
 
        $singleEmply = EmployeeAttendance::with(['Student']) -> where('employee_id', $request -> employee_id) -> where('date', 'like', $date.'%') -> get();

        if($singleEmply){

             
            $data['allData'] = EmployeeAttendance::with(['Student']) -> where('date', 'like', $date.'%') -> get();

            // dd($data['allData']);

            $data['absent'] = EmployeeAttendance::with(['Student']) -> where('employee_id', $request -> employee_id) -> where('date', 'like', $date.'%')  -> where('atten_status', 'Absent') -> get() -> count();

            $data['leave'] = EmployeeAttendance::with(['Student']) -> where('employee_id', $request -> employee_id) -> where('date', 'like', $date.'%')  -> where('atten_status', 'Leave') -> get() -> count();

            $data['month'] =  date('m-Y', strtotime($request -> date));



             // dd($details);
        
            // $pdf = PDF::loadView('backend.student.registration_fee.registration_fee_pdf', $details);
            // $pdf->SetProtection(['copy', 'print'], '', 'pass');
            // return $pdf->stream('document.pdf');
        
            return view('backend.report.attend_report.attend_report_pdf', $data);

        } else {

            // msg
            $notify = [
                'message'       => "Data Not Found",
                'alert-type'    => "error"
            ];

            return redirect() -> back() -> with($notify);


        }

    }



    // profit pdf
    // public function MontlyProfitPDF(Request $request){

    //     // get data
    //     $date['start_date']= date('Y-m-d', strtotime($request -> start_date));
    //     $date['end_date']= date('Y-m-d', strtotime($request -> end_date));

    //     // dd($details);
    
    //     // $pdf = PDF::loadView('backend.student.registration_fee.registration_fee_pdf', $details);
    //     // $pdf->SetProtection(['copy', 'print'], '', 'pass');
    //     // return $pdf->stream('document.pdf');
    
    //     return view('backend.report.attend_report.attend_report_pdf', $date);

    // }







}
