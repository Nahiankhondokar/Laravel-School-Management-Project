<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    // student class page show
    public function FeeAmountView(){

        // $student = FeeCategoryAmount::all();
        $student = FeeCategoryAmount::select('fee_category_id') -> groupBy('fee_category_id') -> get();

        return view('backend.setup.fee_category_amount.fee_category_amount_view', [
            'student'      => $student
        ]);

    }

    // student class add page show
    public function FeeAmountAdd(){

        $fee_category = FeeCategory::all();
        $class = StudentClass::all();
        return view('backend.setup.fee_category_amount.fee_category_amount_add', [
            'fee_category'      => $fee_category,
            'class'             => $class
        ]);

    }


    // fee amount store
    public function FeeAmountStore(Request $request){

        // class store
        $class_count = count($request -> class);
        if($class_count != NULL){

            for ($i=0; $i < $class_count; $i++) { 
                FeeCategoryAmount::create([
                    'fee_category_id'           => $request -> fee_category,
                    'class_id'                  => $request -> class[$i],
                    'amount'                    => $request -> amount[$i]
                ]);
            }

        }
        // msg
        $notify = [
            'message'       => " Fee Category Amount Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('fee.amount.view') -> with($notify);
    }


    // fee category amount eidit
    public function FeeAmountEdit($fee_category_id){

        $fee_amount = FeeCategoryAmount::where('fee_category_id', $fee_category_id) -> orderBy('class_id', 'ASC') -> get();
        $fee_category = FeeCategory::all();
        $class = StudentClass::all();

        return view('backend.setup.fee_category_amount.fee_category_amount_edit', [
            'fee_amount'            => $fee_amount,
            'fee_category'          => $fee_category,
            'class'                 => $class
        ]);

    }



    // fee amount store
    public function FeeAmountUpdate($fee_category_id, Request $request){

        // checking
        if($request -> class == NULL){

                // msg
                $notify = [
                'message'       => "Class & Amount Feilds are required",
                'alert-type'    => "error"
            ];
            
            return redirect() -> back() -> with($notify);

        }else {
            // class store
            $class_count = count($request -> class);
            if($class_count != NULL){
                FeeCategoryAmount::where('fee_category_id', $fee_category_id) -> delete();
                for ($i=0; $i < $class_count; $i++) { 
                    FeeCategoryAmount::create([
                        'fee_category_id'           => $request -> fee_category,
                        'class_id'                  => $request -> class[$i],
                        'amount'                    => $request -> amount[$i]
                    ]);
                }
    
            }
            // msg
            $notify = [
                'message'       => " Fee Category Amount Updated Succefully",
                'alert-type'    => "success"
            ];
            
            return redirect() -> route('fee.amount.view') -> with($notify);
        }
        
    }
    


    // fee category amount Details
    public function FeeAmountDetails($fee_category_id){

        $fee_amount = FeeCategoryAmount::where('fee_category_id', $fee_category_id) -> orderBy('class_id', 'ASC') -> get();

        return view('backend.setup.fee_category_amount.fee_category_amount_details', [
            'fee_amount'            => $fee_amount
        ]);

    }
    


    // student class delete page show
    public function FeeAmountDelete($fee_category_id){

        $delete = FeeCategoryAmount::where('fee_category_id', $fee_category_id);
        $delete -> delete();

        // msg
        $notify = [
            'message'       => "Student Fee Category Deleted Succefully",
            'alert-type'    => "info"
        ];
        
        return redirect() -> back() -> with($notify);


    }
        

}
