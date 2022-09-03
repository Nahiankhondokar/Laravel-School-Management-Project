<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    // student year page show
    public function StudentView(){

        $student = StudentGroup::all();
        return view('backend.setup.student_group.student_group_view', [
            'student'      => $student
        ]);

    }

    // student class add page show
    public function StudentGroupAdd(){

        return view('backend.setup.student_group.student_group_add');

    }



    // student class add
    public function StudentGroupStore(Request $request){

        // validation
        $request -> validate([
            'group'    => 'required|unique:student_groups,name'
        ]);

        // group store
        $student_add = new StudentGroup();
        $student_add -> name = $request -> group;
        $student_add -> save();

        // msg
        $notify = [
            'message'       => "Student group Created Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.group.view') -> with($notify);
    }
    

    // student class add page show
    public function StudentGroupEdit($id){

        $student = StudentGroup::find($id);
        return view('backend.setup.student_group.student_group_edit', [
            'student'       => $student
        ]);

    }
    
    

    // student class update page show
    public function StudenGroupUpdate($id, Request $request){

        // validation
        $request -> validate([
            'group'    => 'required|unique:student_groups,name,'.$id
        ]);

        // update
        $update = StudentGroup::find($id);
        $update -> name = $request -> group;
        $update -> update();

        // msg
        $notify = [
            'message'       => "Student group Updated Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('student.group.view') -> with($notify);


    }


    // student class delete page show
    public function StudentGroupDelete($id){

        $delete = StudentGroup::find($id);
        $delete -> delete();

        // msg
        $notify = [
            'message'       => "Student group Deleted Succefully",
            'alert-type'    => "info"
        ];
        
        return redirect() -> route('student.group.view') -> with($notify);


    }
        
}
