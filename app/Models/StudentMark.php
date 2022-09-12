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
    
}
