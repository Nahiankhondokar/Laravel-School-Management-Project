<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    // student class page show
    public function FeeCategoryView(){

        $student = FeeCategory::all();
        return view('backend.setup.fee_category.fee_category_view', [
            'student'      => $student
        ]);

    }

    // student class add page show
    public function FeeCategoryAdd(){

        return view('backend.setup.fee_category.fee_category_add');

    }

    // student class add
    public function FeeCategoryStore(Request $request){

        // validation
        $request -> validate([
            'fee_cat'    => 'required|unique:fee_categories,name'
        ]);

        // class store
        FeeCategory::insert([
            'name'  => $request -> fee_cat
        ]);

        // msg
        $notify = [
            'message'       => "Student Fee Category Created Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('fee.cat.view') -> with($notify);
    }


    // student class edit page show
    public function FeeCategoryEdit($id){

        $student = FeeCategory::find($id);
        return view('backend.setup.fee_category.fee_category_edit', [
            'student'       => $student
        ]);

    }


    // student class update page show
    public function FeeCategoryUpdate($id, Request $request){

        // validation
        $request -> validate([
            'fee_cat'    => 'required|unique:fee_categories,name,'.$id
        ]);

        // update
        $update = FeeCategory::find($id);
        $update -> name = $request -> fee_cat;
        $update -> update();

        // msg
        $notify = [
            'message'       => "Student Class Updated Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('fee.cat.view') -> with($notify);


    }
    

    // student class delete page show
    public function FeeCategoryDelete($id){

        $delete = FeeCategory::find($id);
        $delete -> delete();

        // msg
        $notify = [
            'message'       => "Student Class Deleted Succefully",
            'alert-type'    => "info"
        ];
        
        return redirect() -> route('fee.cat.view') -> with($notify);


    }
        
}
