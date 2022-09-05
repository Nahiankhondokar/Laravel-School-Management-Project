<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCategoryAmount extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relation ship for fee category amount name
    public function FeeCategory(){
        return $this -> belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }

    
}
