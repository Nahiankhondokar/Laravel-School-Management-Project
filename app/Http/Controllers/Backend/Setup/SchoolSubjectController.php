<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    // student class page show
    public function SubjectView(){

        $subject = SchoolSubject::all();
        return view('backend.setup.subject.subject_view', [
            'subject'      => $subject
        ]);

    }

    // student class add page show
    public function SubjectAdd(){

        return view('backend.setup.subject.subject_add');

    }

    // student class add
    public function SubjectStore(Request $request){

        // validation
        $request -> validate([
            'subject'    => 'required|unique:school_subjects,name'
        ]);

        // class store
        SchoolSubject::insert([
            'name'  => $request -> subject
        ]);

        // msg
        $notify = [
            'message'       => "Student Exam Type Created Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('subject.view') -> with($notify);
    }


    // student class edit page show
    public function SubjectEdit($id){

        $subject = SchoolSubject::find($id);
        return view('backend.setup.subject.subject_edit', [
            'subject'       => $subject
        ]);

    }


    // student class update page show
    public function SubjectUpdate($id, Request $request){

        // validation
        $request -> validate([
            'subject'    => 'required|unique:school_subjects,name,'.$id
        ]);

        // update
        $update = SchoolSubject::find($id);
        $update -> name = $request -> subject;
        $update -> update();

        // msg
        $notify = [
            'message'       => "Student subject Updated Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('subject.view') -> with($notify);


    }


    // student class delete page show
    public function SubjectDelete($id){

        $delete = SchoolSubject::find($id);
        $delete -> delete();

        // msg
        $notify = [
            'message'       => "Student subject Deleted Succefully",
            'alert-type'    => "info"
        ];
        
        return redirect() -> route('subject.view') -> with($notify);


    }
}
