<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    // student class page show
    public function ExamTypeView(){

        $exam_type = ExamType::all();
        return view('backend.setup.exam_type.exam_type_view', [
            'exam_type'      => $exam_type
        ]);

    }

    // student class add page show
    public function ExamTypeAdd(){

        return view('backend.setup.exam_type.exam_type_add');

    }

    // student class add
    public function ExamTypeStore(Request $request){

        // validation
        $request -> validate([
            'exam_type'    => 'required|unique:exam_types,name'
        ]);

        // class store
        ExamType::insert([
            'name'  => $request -> exam_type
        ]);

        // msg
        $notify = [
            'message'       => "Student Exam Type Created Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('exam.type.view') -> with($notify);
    }


    // student class edit page show
    public function ExamTypeEdit($id){

        $exam_type = ExamType::find($id);
        return view('backend.setup.exam_type.exam_type_edit', [
            'exam_type'       => $exam_type
        ]);

    }


    // student class update page show
    public function ExamTypeUpdate($id, Request $request){

        // validation
        $request -> validate([
            'exam_type'    => 'required|unique:exam_types,name,'.$id
        ]);

        // update
        $update = ExamType::find($id);
        $update -> name = $request -> exam_type;
        $update -> update();

        // msg
        $notify = [
            'message'       => "Student Exam Type Updated Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('exam.type.view') -> with($notify);


    }
    

    // student class delete page show
    public function ExamTypeDelete($id){

        $delete = ExamType::find($id);
        $delete -> delete();

        // msg
        $notify = [
            'message'       => "Student Exam Type Deleted Succefully",
            'alert-type'    => "info"
        ];
        
        return redirect() -> route('exam.type.view') -> with($notify);


    }
        
}
