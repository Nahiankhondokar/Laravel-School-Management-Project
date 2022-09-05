<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AssignSubjectControlller extends Controller
{
   // student class page show
   public function AssignSubjectView(){

        // $assign_sub = AssignSubject::all();
        $group_sub = AssignSubject::select('class_id') -> groupBy('class_id') -> get();

        return view('backend.setup.assign_subject.assign_subject_view', [
            'assign_sub'      => $group_sub
        ]);
   }


    // student class add page show
    public function AssignSubjectAdd(){

        $subject = SchoolSubject::all();
        $class = StudentClass::all();
        return view('backend.setup.assign_subject.assign_subject_add', [
            'subject'      => $subject,
            'class'        => $class
        ]);

    }



    // assign subject store
    public function AssignSubjectStore(Request $request){

        // class store
        $subject_count = count($request -> subject);
        // dd($subject_count);

        if($subject_count != NULL){

            for ($i=0; $i < $subject_count; $i++) { 
                AssignSubject::create([
                    'class_id'              => $request -> class,
                    'subject_id'            => $request -> subject[$i],
                    'full_mark'             => $request -> full_mark[$i],
                    'pass_mark'             => $request -> pass_mark[$i],
                    'subjective_mark'       => $request -> subjective_mark[$i]
                ]);
            }

        }
        // msg
        $notify = [
            'message'       => " Fee Assign Subjeect Created Succefully",
            'alert-type'    => "success"
        ];
        
        return redirect() -> route('assign.subject.view') -> with($notify);
    }
    

    // fee category amount eidit
    public function AssignSubjectEdit($class_id){

        $assign_sub = AssignSubject::where('class_id', $class_id) -> get();
        $class = StudentClass::all();
        $subject = SchoolSubject::all();

        return view('backend.setup.assign_subject.assign_subject_edit', [
            'assign_sub'       => $assign_sub,
            'subject'          => $subject,
            'class'            => $class
        ]);

    }


    
    // fee amount store
    public function AssignSubjectUpdate($class_id, Request $request){

        // checking
        if($request -> subject == NULL){

                // msg
                $notify = [
                'message'       => "subject Feild id required",
                'alert-type'    => "error"
            ];
            
            return redirect() -> back() -> with($notify);

        }else {
            // subject counting
            $subject_count = count($request -> subject);
            if($subject_count != NULL){
                // delete all data 
                AssignSubject::where('class_id', $class_id) -> delete();
                for ($i=0; $i < $subject_count; $i++) { 
                    // again create data
                    AssignSubject::create([
                        'class_id'              => $request -> class,
                        'subject_id'            => $request -> subject[$i],
                        'full_mark'             => $request -> full_mark[$i],
                        'pass_mark'             => $request -> pass_mark[$i],
                        'subjective_mark'       => $request -> subjective_mark[$i]
                    ]);
                }
    
            }
            // msg
            $notify = [
                'message'       => " Fee Assign Subject Updated Succefully",
                'alert-type'    => "success"
            ];
            
            return redirect() -> route('assign.subject.view') -> with($notify);
        }
        
    }
    
    
   
}