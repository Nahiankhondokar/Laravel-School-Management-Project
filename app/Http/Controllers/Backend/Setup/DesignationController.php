<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    // student class page show
   public function DesignationView(){

        // $assign_sub = AssignSubject::all();
        $designation = Designation::all();

        return view('backend.setup.designation.designation_view', [
            'designation'      => $designation
        ]);
    }


     // student class add page show
     public function DesignationAdd(){

        return view('backend.setup.designation.designation_add');

    }

    // student class add
    public function DesignationStore(Request $request){

        // validation
        $request -> validate([
            'designation'    => 'required|unique:student_classes,name'
        ]);

        // class store
        Designation::insert([
            'name'  => $request -> designation
        ]);

        // msg
        $notify = [
            'message'       => "Student designation Created Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('designation.view') -> with($notify);
    }


    // student class edit page show
    public function DesignationEdit($id){

        $designation = Designation::find($id);
        return view('backend.setup.designation.designation_edit', [
            'designation'       => $designation
        ]);

    }


    // student class update page show
    public function DesignationUpdate($id, Request $request){

        // validation
        $request -> validate([
            'designation'    => 'required|unique:student_classes,name,'.$id
        ]);

        // update
        $update = Designation::find($id);
        $update -> name = $request -> designation;
        $update -> update();

        // msg
        $notify = [
            'message'       => "Student designation Updated Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('designation.view') -> with($notify);


    }
    

    // student class delete page show
    public function DesignationDelete($id){

        $delete = Designation::find($id);
        $delete -> delete();

        // msg
        $notify = [
            'message'       => "Student designation Deleted Succefully",
            'alert-type'    => "info"
        ];
        
        return redirect() -> route('designation.view') -> with($notify);


    }
    

}

