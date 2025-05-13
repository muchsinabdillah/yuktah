<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionlearningstream extends Model
{
    use HasFactory;
    protected $table = "transactionlearningstreams";

    protected $fillable = [
        'uuid',  
        'learningtrsuuid',  
        'certprogress',  
        'totalmodul',  
        'useruuid',
        'totalfinish',  
        'learninguuid',
        'isfinish' 
    ];
    
    public $incrementing = true;
}
