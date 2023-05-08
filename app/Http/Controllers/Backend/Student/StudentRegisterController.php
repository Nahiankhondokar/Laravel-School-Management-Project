<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StuendtRegisterRequest;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentRegister;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentRegisterController extends Controller
{
    // user view page
    public function StudetnRegView(){

        $data['year'] = StudentYear::all();
        $data['class'] = StudentClass::all();
        
        $data['year_id'] = StudentYear::orderBy('id', 'DESC') -> first() -> id;
        $data['class_id'] = StudentClass::orderBy('id', 'DESC') -> first() -> id;

        $data['student'] = AssignStudent::where('year_id', $data['year_id']) -> where('class_id', $data['class_id']) -> get();

        return view('backend.student.student_reg.student_view', $data);
    }


    // user add page
    public function StudetnRegAdd(){

        $year = StudentYear::all();
        $class = StudentClass::all();
        $group = StudentGroup::all();
        $shift = StudentShift::all();

        return view('backend.student.student_reg.student_add', compact('year', 'class', 'group', 'shift'));
    }


    // student store
    public function StudetnRegStore(StuendtRegisterRequest $request) {

        /**
         *  Multi Table Data Store
         */
        DB::transaction(function() use($request){

            $checkYear = StudentYear::find($request -> year) -> name;
            $student = User::where('user_type', 'Student') -> orderBy('id', 'DESC') -> first();

            if( $student == NULL){
                $studentId = 1;
                if($studentId < 10){
                    $id_no = '000' . $studentId;
                }else if($studentId < 100){
                    $id_no = '00' . $studentId;
                }else if($studentId < 1000){
                    $id_no = '0' . $studentId;
                }
            }else {
                $student = User::where('user_type', 'Student') -> orderBy('id', 'DESC') -> first() -> id;
                $studentId = $student + 1;
                if($studentId < 10){
                    $id_no = '000' . $studentId;
                }else if($studentId < 100){
                    $id_no = '00' . $studentId;
                }else if($studentId < 1000){
                    $id_no = '0' . $studentId;
                }
            }


            // img upload 
            if($request -> hasFile('file')){

                $img = $request -> file('file');
                $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
                $img -> move(public_path('media/student'), $unique);

            }else {
                $unique = '';
            }


            // user table data store
            $code = rand(0000,9999);
            $user = new User();
            $user -> id_no                = $checkYear . $id_no;
            $user -> f_name               = $request -> f_name;
            $user -> m_name               = $request -> m_name;
            $user -> address              = $request -> address;
            $user ->cell                  = $request -> cell;
            $user ->gender                = $request -> gender;
            $user -> religion              = $request -> religion;
            $user -> name                  = $request -> name;
            $user -> dob                   = date('Y-m-d', strtotime($request -> dob));
            $user -> user_type             = 'Student';
            $user -> code                  = $code;
            $user -> email                  = 'student@gmail.com';
            $user -> password              = bcrypt($code);
            $user ->  image                = $unique;
            $user -> save();


            // assign student table data store
            $assign_stu = new AssignStudent();
            $assign_stu ->student_id        = $user -> id;
            $assign_stu ->class_id          = $request -> class;
            $assign_stu ->year_id           = $request -> year;
            $assign_stu ->group_id          = $request -> group;
            $assign_stu ->shift_id          = $request -> shift;
            $assign_stu -> save();



            // discount student table data store
            $discount_stu = new DiscountStudent();
            $discount_stu -> assign_student_id  = $assign_stu -> id;
            $discount_stu -> fee_category_id    = '1';
            $discount_stu -> discount           = $request -> discount;
            $discount_stu -> save();

        });
       


        // msg
        $notify = [
            'message'       => "Student inserted Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('student.view') -> with($notify);

    }
    

    // student search by year or class wise 
    public function StudetntSearchYearClassWise (Request $request) {

        $data['year'] = StudentYear::all();
        $data['class'] = StudentClass::all();

        $data['student'] = AssignStudent::where('year_id', $request -> year) -> where('class_id', $request -> class) -> get();

        return view('backend.student.student_reg.student_view', $data);


    }


    // student edit page load 
    public function StudentEdit($student_id){
        $year = StudentYear::all();
        $class = StudentClass::all();
        $group = StudentGroup::all();
        $shift = StudentShift::all();

        $student = AssignStudent::where('student_id', $student_id) -> first();
        $discount = DiscountStudent::where('assign_student_id', $student -> id) -> first();
        // dd($discount);
        return view('backend.student.student_reg.student_edit', compact('year', 'class', 'group', 'shift', 'student', 'discount'));
    }

    // student edit page load 
    public function StudentUpdate($student_id, Request $request){
   

        /**
         *  Multi Table Data Store
         */
        DB::transaction(function() use($request, $student_id){

            // img upload 
            if($request -> hasFile('file')){

                $img = $request -> file('file');
                $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
                $img -> move(public_path('media/student'), $unique);

                // image delete
                if(file_exists('media/student/' . $request -> old_img)){
                    unlink('media/student/' . $request -> old_img);
                }

            }else{ 
                $unique = $request -> old_img;
            }


            // // user table data store
            $user = User::where('id', $student_id) -> first();
            $user -> f_name               = $request -> f_name;
            $user -> m_name               = $request -> m_name;
            $user -> address              = $request -> address;
            $user -> cell                  = $request -> cell;
            $user -> gender                = $request -> gender;
            $user -> religion              = $request -> religion;
            $user -> name                  = $request -> name;
            $user -> dob                   = date('Y-m-d', strtotime($request -> dob));
            $user -> user_type             = 'Student';
            $user -> image                  = $unique;
            $user -> update();


            // assign student table data store
            $assign_stu = AssignStudent::where('student_id', $student_id) -> first();
            $assign_stu ->class_id          = $request -> class;
            $assign_stu ->year_id           = $request -> year;
            $assign_stu ->group_id          = $request -> group;
            $assign_stu ->shift_id          = $request -> shift;
            $assign_stu -> update();



            // // discount student table data store
            $discount_stu = DiscountStudent::where('assign_student_id', $assign_stu -> id) -> first();
            $discount_stu -> fee_category_id    = '1';
            $discount_stu -> discount           = $request -> discount;
            $discount_stu -> update();
            // dd($user -> id);
        });
    
        // msg
        $notify = [
            'message'       => "Student Updated Succefully",
            'alert-type'    => "info"
        ];

        return redirect() -> route('student.view') -> with($notify);
    }



    // student edit page load 
    public function StudentPromotion($student_id, Request $request){
        
        $year = StudentYear::all();
        $class = StudentClass::all();
        $group = StudentGroup::all();
        $shift = StudentShift::all();

        $student = AssignStudent::where('student_id', $student_id) -> first();
        $discount = DiscountStudent::where('assign_student_id', $student -> id) -> first();
        // dd($discount);
        return view('backend.student.student_reg.student_promotion', compact('year', 'class', 'group', 'shift', 'student', 'discount'));

        
    }




    // student edit page load 
    public function StudentPromotionUpdate($student_id, Request $request){
    

        /**
         *  Multi Table Data Store
         */
        DB::transaction(function() use($request, $student_id){

            // img upload 
            if($request -> hasFile('file')){

                $img = $request -> file('file');
                $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
                $img -> move(public_path('media/student'), $unique);

                // image delete
                if(file_exists('media/student/' . $request -> old_img)){
                    unlink('media/student/' . $request -> old_img);
                }

            }else{ 
                $unique = $request -> old_img;
            }


            // user table data store
            $user = User::where('id', $student_id) -> first();
            $user -> f_name               = $request -> f_name;
            $user -> m_name               = $request -> m_name;
            $user -> address              = $request -> address;
            $user -> cell                  = $request -> cell;
            $user -> gender                = $request -> gender;
            $user -> religion              = $request -> religion;
            $user -> name                  = $request -> name;
            $user -> dob                   = date('Y-m-d', strtotime($request -> dob));
            $user -> user_type             = 'Student';
            $user -> image                  = $unique;
            $user -> update();


            // assign student table data store
            $assign_stu = new AssignStudent();
            $assign_stu ->student_id        = $student_id;
            $assign_stu ->class_id          = $request -> class;
            $assign_stu ->year_id           = $request -> year;
            $assign_stu ->group_id          = $request -> group;
            $assign_stu ->shift_id          = $request -> shift;
            $assign_stu -> save();



            // discount student table data store
            $discount_stu = new DiscountStudent();
            $discount_stu -> assign_student_id      = $assign_stu -> id;
            $discount_stu -> fee_category_id        = '1';
            $discount_stu -> discount               = $request -> discount;
            $discount_stu -> save();
            
        });
    
        // msg
        $notify = [
            'message'       => "Student Promoted Succefully",
            'alert-type'    => "info"
        ];

        return redirect() -> route('student.view') -> with($notify);

    }



    // student details
    public function StudentDetails($student_id){

        $details = AssignStudent::with(['Student', 'StudentDiscount', 'StudentYear', 'StudentClass','StudentGroup', 'StudentShift']) -> where('student_id', $student_id) -> first();


        // Student details PDF
        $pdf = Pdf::loadView('backend.student.student_reg.student_details_pdf', compact('details'))->setPaper('a4', 'landscape');
        return $pdf->download('backend.student.student_reg.student_details_pdf.pdf');

        // return view('backend.student.student_reg.student_details_pdf', compact('details'));

    }


}
