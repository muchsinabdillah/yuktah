<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learning extends Model
{
    use HasFactory;
    protected $table = "learnings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',     
        'useruuid',
        'title',
        'shortdescription',
        'studentcount',
        'ratingcount',
        'rating',
        'mentoruuid',
        'learndetail',
        'benefitcourse',
        'requirment',
        'description',
        'price',
        'status' 
    ];
    
    public $incrementing = true;
}
