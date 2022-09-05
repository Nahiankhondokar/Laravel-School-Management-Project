<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;

    
    protected $guarded = [];

    // Relation ship for fee category amount name
    public function FeeCategory(){
        return $this -> belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }


    // Relation ship for Class name
    public function StudentClass(){
        return $this -> belongsTo(StudentClass::class, 'class_id', 'id');
    }
}
