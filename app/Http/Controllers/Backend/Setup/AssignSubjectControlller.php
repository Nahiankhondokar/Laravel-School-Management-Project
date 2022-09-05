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

        $assign_sub = AssignSubject::all();
        // $student = AssignSubject::select('fee_category_id') -> groupBy('fee_category_id') -> get();

        return view('backend.setup.assign_subject.assign_subject_view', [
            'assign_sub'      => $assign_sub
        ]);
   }


    // student class add page show
    public function FeeAmountAdd(){

        $subject = SchoolSubject::all();
        $class = StudentClass::all();
        return view('backend.setup.assign_subject.assign_subject_add', [
            'subject'      => $subject,
            'class'        => $class
        ]);

    }

   
}
