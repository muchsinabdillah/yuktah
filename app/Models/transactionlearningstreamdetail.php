<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionlearningstreamdetail extends Model
{
    use HasFactory;
    protected $table = "transactionlearningstreamdetails";

    protected $fillable = [
        'uuid',  
        'learningtrsuuid',  
        'learninguuid',  
        'minutesprogress',   
        'minutesstart',
        'kuisionerscore',
        'pretestscore',
        'posttestscore',
        'observasiscore',
        'examscore',
        'finalscore',
        'jp',
        'learningdetailuuid',
        'streamuuid',
        'isfinish' 
    ];
    
    public $incrementing = true;
}
