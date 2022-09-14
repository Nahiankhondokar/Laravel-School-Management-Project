<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAccountSalary extends Model
{
    use HasFactory;


    protected $guarded = [];


    // Relation ship for year name
    public function StudentYear(){
        return $this -> belongsTo(StudentYear::class, 'year_id', 'id');
    }

    // Relation ship for Class name
    public function StudentClass(){
        return $this -> belongsTo(StudentClass::class, 'class_id', 'id');
    }

    // Relation ship for student id or name
    public function StudentGroup(){
        return $this -> belongsTo(StudentGroup::class, 'group_id', 'id');
    }
        

    // Relation ship for student id or name
    public function StudentShift(){
        return $this -> belongsTo(StudentShift::class, 'shift_id', 'id');
    }

    // Relation ship for student id or name
    public function Student(){
        return $this -> belongsTo(User::class, 'employee_id', 'id');
    }


    // Relation ship for student id or name
    public function StudentDiscount(){
        return $this -> belongsTo(DiscountStudent::class, 'id', 'assign_student_id');
    }

    // Relation ship for fee category amount name
    public function FeeCategory(){
        return $this -> belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }
    
        
}
