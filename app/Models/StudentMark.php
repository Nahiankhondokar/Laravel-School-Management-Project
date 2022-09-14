<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    use HasFactory;
    protected $guarded = [];


    // Relation ship for student id or name
    public function Student(){
        return $this -> belongsTo(User::class, 'student_id', 'id');
    }

    // Relation ship for year name
    public function StudentYear(){
        return $this -> belongsTo(StudentYear::class, 'year_id', 'id');
    }

    // Relation ship for Class name
    public function StudentClass(){
        return $this -> belongsTo(StudentClass::class, 'class_id', 'id');
    }

    // Relation ship for Class name
    public function Subject(){
        return $this -> belongsTo(SchoolSubject::class, 'assign_subject_id', 'id');
    }

    // Relation ship for exam name
    public function Exam(){
        return $this -> belongsTo(ExamType::class, 'exam_type_id', 'id');
    }
    

}
