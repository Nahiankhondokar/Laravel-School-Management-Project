<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavePurpose extends Model
{
    use HasFactory;

    protected $guarded = [];


    // Relation ship for student id or name
    public function Student(){
        return $this -> belongsTo(User::class, 'employee_id', 'id');
    }
    
    // Relation ship for leave purpose name
    public function LeavePurpose(){
        return $this -> belongsTo(LeavePurpose::class, 'leave_purposes_id', 'id');
    }
    

}
