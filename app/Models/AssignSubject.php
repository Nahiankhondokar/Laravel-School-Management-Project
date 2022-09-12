<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;

    
    protected $guarded = [];

    // Relation ship for subject name
    public function SchoolSubject(){
        return $this -> belongsTo(SchoolSubject::class, 'subject_id', 'id');
    }


    // Relation ship for Class name
    public function StudentClass(){
        return $this -> belongsTo(StudentClass::class, 'class_id', 'id');
    }


    // Relation ship for student id or name
    public function Student(){
        return $this -> belongsTo(User::class, 'student_id', 'id');
    }

        

}
