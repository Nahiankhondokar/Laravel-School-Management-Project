<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    // other cost view
    public function OtherCostView(){
        $other_cost = AccountOtherCost::all();
        return view('backend.account.other_cost.other_cost_view', compact('other_cost'));
    }


    // other cost view
    public function OtherCostAdd(){
        $other_cost = AccountOtherCost::all();
        return view('backend.account.other_cost.other_cost_add', compact('other_cost'));
    }


    // student store
    public function OtherCostStore(Request $request) {


        // validation 
        $this -> validate($request, [
            'amount'        => 'required',
            'date'        => 'required'
        ]);

         // img upload 
        if($request -> hasFile('file')){

            $img = $request -> file('file');
            $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
            $img -> move(public_path('media/other-cost'), $unique);

        }else {
            $unique = '';
        }


        // other cost store
        $other_cost = new AccountOtherCost();
        $other_cost -> amount                = $request -> amount;
        $other_cost -> desc                  = $request -> desc;
        $other_cost -> date                  = date('Y-m-d', strtotime($request -> date));
        $other_cost -> image                 = $unique;
        $other_cost -> save();


        // msg
        $notify = [
            'message'       => "Other Cost inserted Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('other.cost.view') -> with($notify);


    }
    

    // other cost view
    public function OtherCostEdit($id){
        $edit_data = AccountOtherCost::find($id);
        return view('backend.account.other_cost.other_cost_edit', compact('edit_data'));
    }
    

    // other cost view
    public function OtherCostUpdate($id, Request $request){

        // file upload
        if($request -> hasFile('file')){

            $img = $request -> file('file');
            $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
            $img -> move(public_path('media/other-cost'), $unique);

            @unlink('media/other-cost/' . $request -> old_img);

        }else {
            $unique = $request -> old_img;
        }

        // update data
        $edit_data = AccountOtherCost::find($id);
        $edit_data -> amount = $request -> amount;
        $edit_data -> desc = $request -> desc;
        $edit_data -> image = $unique;
        $edit_data -> date = date('Y-m-d', strtotime($request -> date));
        $edit_data -> update();

        // msg
        $notify = [
            'message'       => "Other Cost Updated Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('other.cost.view') -> with($notify);

    }

    // other cost delete
    public function OtherCostDelete($id){
        $delete = AccountOtherCost::find($id);
        $delete -> delete();

        // msg
        $notify = [
            'message'       => "Other Cost Deleted Succefully",
            'alert-type'    => "info"
        ];

        return redirect() -> route('other.cost.view') -> with($notify);

    }

    


}
