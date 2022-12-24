<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use App\Models\EmployeeAccountSalary;
use App\Models\StudentAccountFee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfitController extends Controller
{
    // other cost view
    public function MontlyProfitView(){
        return view('backend.report.profit.monthly_profit_view');
    }


    // data search by date wise
    public function MontlyProfitByDateWise(Request $request){

        $start_date = date('Y-m-d', strtotime($request -> start_date));
        $end_date = date('Y-m-d', strtotime($request -> end_date));

        $student_fee = StudentAccountFee::whereBetween('date', [$start_date, $end_date]) -> sum('amount');

        $other_cost = AccountOtherCost::whereBetween('date', [$start_date, $end_date]) -> sum('amount');

        $employ_slry = EmployeeAccountSalary::whereBetween('date', [$start_date, $end_date]) -> sum('amount');

        // profit calculation
        $total_cost = $other_cost + $employ_slry;
        $profit = $student_fee - $total_cost;
        

        $t_body = '';
        $t_body .= '<tr>';
        $t_body .= '<td>'. $student_fee .'</td>';
        $t_body .= '<td>'. $employ_slry . '</td>';

        $t_body .= '<td>'. $other_cost .'</td>';
        $t_body .= '<td>'. $total_cost.'</td>';
        $t_body .= '<td>'. $profit.'</td>';

        $t_body .= '<td>'. '<a title="PDF" target="_blank" href="'. route('monthly.profit.pdf') . '?start_date='.$start_date.'&end_date='.$end_date.'" class="tn btn-info btn-sm"><i class="fa fa-file-pdf" aria-hidden="true">PDF</i></a>' .'</td>';
        $t_body .= '</tr>';

        return $t_body;

    }


    // profit pdf
    public function MontlyProfitPDF(Request $request){

        // get data
        $date['start_date']= date('Y-m-d', strtotime($request -> start_date));
        $date['end_date']= date('Y-m-d', strtotime($request -> end_date));

        // dd($details);

        $pdf = Pdf::loadView('backend.report.profit.profit_pdf', $date) -> setPaper('a4', 'landscape');
        return $pdf->download('backend.report.profit.profit_pdf');
    
        // return view('backend.report.profit.profit_pdf', $date);

    }

}
