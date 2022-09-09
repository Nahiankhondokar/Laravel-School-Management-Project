<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class RegistrationFeeController extends Controller
{
    // role view page 
    public function RegFeeView(){
        $data['year'] = StudentYear::all();
        $data['class'] = StudentClass::all();

        return view('backend.student.registration_fee.reg_fee_view', $data);
    }
}
